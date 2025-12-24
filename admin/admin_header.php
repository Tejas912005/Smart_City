<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- SECURITY CHECK ---
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Get current page for active nav
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Smart City</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">

<aside class="admin-sidebar">
  <div class="admin-sidebar-header">
    <i class="fas fa-city fa-2x mb-2" style="color: #6366f1;"></i>
    <h3>Admin Portal</h3>
  </div>
  
  <nav>
    <a href="admin_dashboard.php" class="admin-nav-link <?php echo $current_page == 'admin_dashboard.php' ? 'active' : ''; ?>">
      <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </a>
    <a href="analytics.php" class="admin-nav-link <?php echo $current_page == 'analytics.php' ? 'active' : ''; ?>">
      <i class="fas fa-chart-line me-2"></i>Analytics
    </a>
    <a href="admin_dashboard.php#reports-table" class="admin-nav-link">
      <i class="fas fa-file-alt me-2"></i>Reports
    </a>
    <a href="admin_dashboard.php#users-table" class="admin-nav-link">
      <i class="fas fa-users me-2"></i>Users
    </a>
    <a href="admin_dashboard.php#feedback-table" class="admin-nav-link">
      <i class="fas fa-comments me-2"></i>Feedback
    </a>
  </nav>

  <div class="admin-logout-link">
    <a href="logout.php" class="btn btn-outline-danger w-100">
      <i class="fas fa-sign-out-alt me-2"></i>Logout
    </a>
  </div>
</aside>

<main class="admin-main-content">