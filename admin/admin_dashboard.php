<?php
include 'admin_header.php';
include '../config.php';
include '../includes/csrf.php';

// Get filter values
$filter_category = $_GET['category'] ?? '';
$filter_status = $_GET['status'] ?? '';
$filter_date_from = $_GET['date_from'] ?? '';
$filter_date_to = $_GET['date_to'] ?? '';

// Build query with filters
$where_clauses = [];
$params = [];
$types = '';

if (!empty($filter_category)) {
    $where_clauses[] = "r.category = ?";
    $params[] = $filter_category;
    $types .= 's';
}

if (!empty($filter_status)) {
    $where_clauses[] = "r.status = ?";
    $params[] = $filter_status;
    $types .= 's';
}

if (!empty($filter_date_from)) {
    $where_clauses[] = "DATE(r.created_at) >= ?";
    $params[] = $filter_date_from;
    $types .= 's';
}

if (!empty($filter_date_to)) {
    $where_clauses[] = "DATE(r.created_at) <= ?";
    $params[] = $filter_date_to;
    $types .= 's';
}

$where_sql = count($where_clauses) > 0 ? 'WHERE ' . implode(' AND ', $where_clauses) : '';

// Pagination settings
$per_page = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $per_page;

// Get total count for pagination
$count_query = "SELECT COUNT(*) as total FROM reports r $where_sql";
if (count($params) > 0) {
    $count_stmt = $conn->prepare($count_query);
    $count_stmt->bind_param($types, ...$params);
    $count_stmt->execute();
    $total_filtered = $count_stmt->get_result()->fetch_assoc()['total'];
    $count_stmt->close();
} else {
    $total_filtered = $conn->query($count_query)->fetch_assoc()['total'];
}
$total_pages = ceil($total_filtered / $per_page);

// Fetch Stats
$total_users = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$total_reports = $conn->query("SELECT COUNT(*) AS count FROM reports")->fetch_assoc()['count'];
$pending_reports = $conn->query("SELECT COUNT(*) AS count FROM reports WHERE status = 'Pending'")->fetch_assoc()['count'];
$total_feedback = $conn->query("SELECT COUNT(*) AS count FROM feedback")->fetch_assoc()['count'];

// Fetch filtered reports with pagination
$query = "
    SELECT r.*, u.name AS user_name 
    FROM reports r
    LEFT JOIN users u ON r.user_id = u.id
    $where_sql
    ORDER BY r.status = 'Pending' DESC, r.id DESC
    LIMIT $per_page OFFSET $offset
";

if (count($params) > 0) {
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $reports_result = $stmt->get_result();
} else {
    $reports_result = $conn->query($query);
}

// Get unique categories for filter dropdown
$categories_result = $conn->query("SELECT DISTINCT category FROM reports ORDER BY category");

// Get all users
$users_result = $conn->query("SELECT * FROM users ORDER BY id DESC");

// Get all feedback
$feedback_result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>

<style>
.filter-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}
.filter-card .form-label {
    font-weight: 600;
    font-size: 0.85rem;
    color: #64748b;
}
.filter-btn {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border: none;
    padding: 10px 25px;
    border-radius: 10px;
    color: white;
    font-weight: 600;
}
.clear-btn {
    background: #f1f5f9;
    border: none;
    padding: 10px 25px;
    border-radius: 10px;
    color: #64748b;
    font-weight: 600;
}
.stat-card {
    border-radius: 16px !important;
}
.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
}
</style>

<div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h1><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</h1>
        <p class="mb-0">Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>
    </div>
    <a href="analytics.php" class="btn btn-light">
        <i class="fas fa-chart-line me-2"></i>View Analytics
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card bg-white p-3 d-flex align-items-center gap-3">
            <div class="stat-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                <i class="fas fa-file-alt"></i>
            </div>
            <div>
                <div class="stat-card-title">Total Reports</div>
                <div class="stat-card-value"><?php echo $total_reports; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card bg-white p-3 d-flex align-items-center gap-3">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div class="stat-card-title">Pending</div>
                <div class="stat-card-value text-warning"><?php echo $pending_reports; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card bg-white p-3 d-flex align-items-center gap-3">
            <div class="stat-icon" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div class="stat-card-title">Total Users</div>
                <div class="stat-card-value"><?php echo $total_users; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card bg-white p-3 d-flex align-items-center gap-3">
            <div class="stat-icon" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                <i class="fas fa-comments"></i>
            </div>
            <div>
                <div class="stat-card-title">Feedback</div>
                <div class="stat-card-value"><?php echo $total_feedback; ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-card">
    <h5 class="fw-bold mb-3"><i class="fas fa-filter me-2"></i>Filter Reports</h5>
    <form method="GET" action="admin_dashboard.php">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    <?php while($cat = $categories_result->fetch_assoc()): ?>
                        <option value="<?php echo $cat['category']; ?>" <?php echo $filter_category == $cat['category'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['category']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="Pending" <?php echo $filter_status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="In Progress" <?php echo $filter_status == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Resolved" <?php echo $filter_status == 'Resolved' ? 'selected' : ''; ?>>Resolved</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">From Date</label>
                <input type="date" name="date_from" class="form-control" value="<?php echo $filter_date_from; ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">To Date</label>
                <input type="date" name="date_to" class="form-control" value="<?php echo $filter_date_to; ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="filter-btn me-2">
                    <i class="fas fa-search me-1"></i>Apply Filters
                </button>
                <a href="admin_dashboard.php" class="clear-btn btn">Clear</a>
            </div>
        </div>
    </form>
</div>

<!-- Reports Table -->
<div class="mt-4" id="reports-table">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0"><i class="fas fa-list-alt me-2"></i>Civic Reports</h3>
        <span class="badge bg-primary"><?php echo $reports_result->num_rows; ?> results</span>
    </div>
    <div class="table-responsive table-reports">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Submitted</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reports_result->num_rows > 0): ?>
                    <?php while($row = $reports_result->fetch_assoc()): ?>
                        <tr>
                            <td class="fw-bold"><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['user_name'] ?? 'N/A'); ?></td>
                            <td><span class="badge bg-light text-dark"><?php echo htmlspecialchars($row['category']); ?></span></td>
                            <td style="max-width: 200px;"><?php echo htmlspecialchars(substr($row['description'], 0, 50)) . '...'; ?></td>
                            <td>
                                <?php if (!empty($row['image'])): ?>
                                    <a href="../uploads/<?php echo htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
                                        <img src="../uploads/<?php echo htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Report Image" class="report-image-thumbnail" loading="lazy">
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <?php
                                    $status = htmlspecialchars($row['status']);
                                    $status_class = 'status-pending';
                                    if ($status == 'In Progress') $status_class = 'status-in-progress';
                                    if ($status == 'Resolved') $status_class = 'status-resolved';
                                ?>
                                <span class="status-badge <?php echo $status_class; ?>"><?php echo $status; ?></span>
                            </td>
                            <td>
                                <form method="POST" action="update_status.php" style="min-width: 180px;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="report_id" value="<?php echo $row['id']; ?>">
                                    <div class="input-group input-group-sm">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="Pending" <?php if($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                            <option value="In Progress" <?php if($row['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                                            <option value="Resolved" <?php if($row['status'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            No reports found matching your filters.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Navigation -->
    <?php if ($total_pages > 1): ?>
    <nav aria-label="Reports pagination" class="mt-3">
        <ul class="pagination justify-content-center mb-0">
            <?php 
            // Build query string for filters
            $query_params = $_GET;
            unset($query_params['page']);
            $query_string = http_build_query($query_params);
            $base_url = 'admin_dashboard.php?' . ($query_string ? $query_string . '&' : '');
            ?>
            
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?php echo $base_url . 'page=' . ($page - 1); ?>#reports-table">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            </li>
            
            <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo $base_url . 'page=' . $i; ?>#reports-table"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>
            
            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?php echo $base_url . 'page=' . ($page + 1); ?>#reports-table">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
        <p class="text-center text-muted mt-2 mb-0">
            Showing page <?php echo $page; ?> of <?php echo $total_pages; ?> 
            (<?php echo $total_filtered; ?> total reports)
        </p>
    </nav>
    <?php endif; ?>
</div>

<!-- Users Table -->
<div class="mt-5" id="users-table">
    <h3 class="fw-bold mb-3"><i class="fas fa-users me-2"></i>Registered Users</h3>
    <div class="table-responsive table-reports">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $users_result->fetch_assoc()): ?>
                    <tr>
                        <td class="fw-bold"><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Feedback Table -->
<div class="mt-5" id="feedback-table">
    <h3 class="fw-bold mb-3"><i class="fas fa-comments me-2"></i>User Feedback</h3>
    <div class="table-responsive table-reports">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submitted On</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $feedback_result->fetch_assoc()): ?>
                    <tr>
                        <td class="fw-bold"><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
include 'admin_footer.php'; 
?>