<?php
include 'admin_header.php';
include '../config.php';

// Fetch data for analytics
// 1. Reports by Category
$category_data = $conn->query("
    SELECT category, COUNT(*) as count 
    FROM reports 
    GROUP BY category 
    ORDER BY count DESC
");
$categories = [];
$category_counts = [];
while($row = $category_data->fetch_assoc()) {
    $categories[] = $row['category'];
    $category_counts[] = $row['count'];
}

// 2. Reports by Status
$status_data = $conn->query("
    SELECT status, COUNT(*) as count 
    FROM reports 
    GROUP BY status
");
$statuses = [];
$status_counts = [];
while($row = $status_data->fetch_assoc()) {
    $statuses[] = $row['status'];
    $status_counts[] = $row['count'];
}

// 3. Reports over time (last 7 days)
$daily_data = $conn->query("
    SELECT DATE(created_at) as date, COUNT(*) as count 
    FROM reports 
    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY DATE(created_at) 
    ORDER BY date
");
$dates = [];
$daily_counts = [];
while($row = $daily_data->fetch_assoc()) {
    $dates[] = date('M d', strtotime($row['date']));
    $daily_counts[] = $row['count'];
}

// 4. Key Stats
$total_reports = $conn->query("SELECT COUNT(*) as count FROM reports")->fetch_assoc()['count'];
$resolved = $conn->query("SELECT COUNT(*) as count FROM reports WHERE status = 'Resolved'")->fetch_assoc()['count'];
$pending = $conn->query("SELECT COUNT(*) as count FROM reports WHERE status = 'Pending'")->fetch_assoc()['count'];
$in_progress = $conn->query("SELECT COUNT(*) as count FROM reports WHERE status = 'In Progress'")->fetch_assoc()['count'];

$resolution_rate = $total_reports > 0 ? round(($resolved / $total_reports) * 100) : 0;

// 5. Recent activity
$recent_reports = $conn->query("
    SELECT r.*, u.name as user_name 
    FROM reports r 
    LEFT JOIN users u ON r.user_id = u.id 
    ORDER BY r.created_at DESC 
    LIMIT 5
");

$conn->close();
?>

<style>
.analytics-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    height: 100%;
}
.analytics-card h5 {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 20px;
}
.big-stat {
    text-align: center;
    padding: 20px;
}
.big-stat .number {
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.big-stat .label {
    color: #64748b;
    font-size: 0.9rem;
}
.stat-row {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}
.mini-stat {
    text-align: center;
}
.mini-stat .num {
    font-size: 1.5rem;
    font-weight: 700;
}
.mini-stat .lbl {
    font-size: 0.8rem;
    color: #64748b;
}
.recent-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}
.recent-item:last-child { border: none; }
.recent-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
}
.recent-info h6 { margin: 0; font-weight: 600; }
.recent-info small { color: #64748b; }
</style>

<div class="dashboard-header">
    <h1><i class="fas fa-chart-line me-2"></i>Analytics Dashboard</h1>
    <p class="mb-0">Insights and trends for civic reports</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="analytics-card">
            <div class="big-stat">
                <div class="number"><?php echo $total_reports; ?></div>
                <div class="label">Total Reports</div>
            </div>
            <div class="stat-row">
                <div class="mini-stat">
                    <div class="num text-warning"><?php echo $pending; ?></div>
                    <div class="lbl">Pending</div>
                </div>
                <div class="mini-stat">
                    <div class="num text-info"><?php echo $in_progress; ?></div>
                    <div class="lbl">In Progress</div>
                </div>
                <div class="mini-stat">
                    <div class="num text-success"><?php echo $resolved; ?></div>
                    <div class="lbl">Resolved</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="analytics-card">
            <div class="big-stat">
                <div class="number"><?php echo $resolution_rate; ?>%</div>
                <div class="label">Resolution Rate</div>
            </div>
            <div class="progress mt-3" style="height: 10px; border-radius: 10px;">
                <div class="progress-bar" role="progressbar" style="width: <?php echo $resolution_rate; ?>%; background: linear-gradient(135deg, #22c55e, #16a34a);" aria-valuenow="<?php echo $resolution_rate; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="analytics-card">
            <h5><i class="fas fa-clock me-2"></i>Recent Activity</h5>
            <?php while($report = $recent_reports->fetch_assoc()): ?>
            <div class="recent-item">
                <div class="recent-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="recent-info">
                    <h6><?php echo htmlspecialchars($report['category']); ?></h6>
                    <small>by <?php echo htmlspecialchars($report['user_name'] ?? 'Anonymous'); ?> • <?php echo date('M d, H:i', strtotime($report['created_at'])); ?></small>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="analytics-card">
            <h5><i class="fas fa-tags me-2"></i>Reports by Category</h5>
            <canvas id="categoryChart" height="250"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="analytics-card">
            <h5><i class="fas fa-chart-pie me-2"></i>Status Distribution</h5>
            <canvas id="statusChart" height="250"></canvas>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="analytics-card">
            <h5><i class="fas fa-chart-area me-2"></i>Reports Trend (Last 7 Days)</h5>
            <canvas id="trendChart" height="100"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Category Chart
new Chart(document.getElementById('categoryChart'), {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($categories); ?>,
        datasets: [{
            data: <?php echo json_encode($category_counts); ?>,
            backgroundColor: ['#6366f1', '#8b5cf6', '#a855f7', '#ec4899', '#f43f5e', '#f59e0b'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

// Status Chart
new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($statuses); ?>,
        datasets: [{
            data: <?php echo json_encode($status_counts); ?>,
            backgroundColor: ['#f59e0b', '#0ea5e9', '#22c55e'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

// Trend Chart
new Chart(document.getElementById('trendChart'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Reports',
            data: <?php echo json_encode($daily_counts); ?>,
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

<?php include 'admin_footer.php'; ?>
