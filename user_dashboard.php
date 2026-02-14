<?php
include 'config.php'; // Includes DB Connection and session_start()

// --- SECURITY CHECK ---
// If the user is not logged in, redirect to login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit; // Stop executing the script
}

// Get the user's ID and name from the session
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// --- DATABASE QUERIES ---
// Single query for all report counts + reports list
$stmt_stats = $conn->prepare("
  SELECT
    COUNT(*) AS total_reports,
    SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending_reports,
    SUM(CASE WHEN status = 'In Progress' THEN 1 ELSE 0 END) AS progress_reports,
    SUM(CASE WHEN status = 'Resolved' THEN 1 ELSE 0 END) AS resolved_reports
  FROM reports WHERE user_id = ?
");
$stmt_stats->bind_param("i", $user_id);
$stmt_stats->execute();
$stats = $stmt_stats->get_result()->fetch_assoc();
$stmt_stats->close();

$total_reports = (int) $stats['total_reports'];
$pending_reports = (int) $stats['pending_reports'];
$progress_reports = (int) $stats['progress_reports'];
$resolved_reports = (int) $stats['resolved_reports'];

// Get the list of all user's reports for the table
$stmt_reports = $conn->prepare("SELECT id, category, description, status, created_at FROM reports WHERE user_id = ? ORDER BY created_at DESC");
$stmt_reports->bind_param("i", $user_id);
$stmt_reports->execute();
$reports_result = $stmt_reports->get_result();

?>

<?php include 'header.php'; // Includes <head>, <body>, and <nav> ?>

<!-- Main Dashboard Content -->
<main class="container my-5">

  <!-- Header Section -->
  <div class="dashboard-header animate-up">
    <div>
      <h1><i class="fas fa-chart-line me-2"></i>Welcome back, <?php echo htmlspecialchars($user_name); ?>!</h1>
      <p class="lead mb-0">Here's a summary of your civic reports.</p>
    </div>
  </div>

  <!-- Stat Cards Section -->
  <div class="row">
    <div class="col-md-3 col-sm-6 animate-up" style="animation-delay: 0.2s;">
      <div class="stat-card stat-card-total">
        <div class="stat-card-icon">
          <i class="fas fa-file-alt"></i>
        </div>
        <div class="stat-card-content">
          <div class="stat-card-title">Total Reports</div>
          <div class="stat-card-value"><?php echo $total_reports; ?></div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 animate-up" style="animation-delay: 0.3s;">
      <div class="stat-card stat-card-pending">
        <div class="stat-card-icon">
          <i class="fas fa-clock"></i>
        </div>
        <div class="stat-card-content">
          <div class="stat-card-title">Pending</div>
          <div class="stat-card-value"><?php echo $pending_reports; ?></div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 animate-up" style="animation-delay: 0.4s;">
      <div class="stat-card stat-card-progress">
        <div class="stat-card-icon">
          <i class="fas fa-spinner"></i>
        </div>
        <div class="stat-card-content">
          <div class="stat-card-title">In Progress</div>
          <div class="stat-card-value"><?php echo $progress_reports; ?></div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 animate-up" style="animation-delay: 0.5s;">
      <div class="stat-card stat-card-resolved">
        <div class="stat-card-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-card-content">
          <div class="stat-card-title">Resolved</div>
          <div class="stat-card-value"><?php echo $resolved_reports; ?></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Reports Table Section -->
  <div class="d-flex justify-content-between align-items-center mb-3 animate-up" style="animation-delay: 0.6s;">
    <h3 class="fw-bold mb-0"><i class="fas fa-list-alt me-2 text-primary"></i>Your Submitted Reports</h3>
  </div>

  <div class="table-responsive table-reports animate-up" style="animation-delay: 0.7s;">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th scope="col"><i class="fas fa-tag me-2"></i>Category</th>
          <th scope="col"><i class="fas fa-align-left me-2"></i>Description</th>
          <th scope="col"><i class="fas fa-calendar me-2"></i>Date Submitted</th>
          <th scope="col"><i class="fas fa-info-circle me-2"></i>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($reports_result->num_rows > 0): ?>
          <?php while($row = $reports_result->fetch_assoc()): ?>
            <tr>
              <td class="fw-bold">
                <i class="fas fa-folder me-2 text-primary"></i>
                <?php echo htmlspecialchars($row['category']); ?>
              </td>
              <td><?php echo htmlspecialchars($row['description']); ?></td>
              <td>
                <i class="far fa-clock me-1 text-muted"></i>
                <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
              </td>
              <td>
                <?php
                  // Logic to apply the correct CSS class for the status
                  $status = htmlspecialchars($row['status']);
                  $status_class = 'status-pending'; // Default
                  $status_icon = 'fa-clock';
                  if ($status == 'In Progress') {
                    $status_class = 'status-in-progress';
                    $status_icon = 'fa-spinner fa-spin';
                  } elseif ($status == 'Resolved') {
                    $status_class = 'status-resolved';
                    $status_icon = 'fa-check-circle';
                  }
                ?>
                <span class="status-badge <?php echo $status_class; ?>">
                  <i class="fas <?php echo $status_icon; ?> me-1"></i>
                  <?php echo $status; ?>
                </span>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-center text-muted p-5">
              <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
              <p class="mb-0">You have not submitted any reports yet.</p>
              <a href="submit_report.php" class="btn btn-custom mt-3">Submit Your First Report</a>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</main>

<?php
  // Close the database connections
  $stmt_reports->close();
  $conn->close();
?>

<?php include 'footer.php'; // Includes <footer> and closing </body>/</html> ?>