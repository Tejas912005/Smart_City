<?php
include '../config.php'; // Get DB connection and start session

// --- SECURITY CHECK ---
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get data from the form
    $report_id = $_POST['report_id'];
    $new_status = $_POST['status'];

    // Basic validation
    if (!empty($report_id) && !empty($new_status)) {
        
        // Update the database
        $stmt = $conn->prepare("UPDATE reports SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $report_id);
        
        if ($stmt->execute()) {
            // Success
        } else {
            // Handle error, maybe set a session flash message
        }
        $stmt->close();
    }
}

// Redirect back to the dashboard, to the reports table
header("Location: admin_dashboard.php#reports-table");
exit;
?>