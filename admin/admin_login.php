<?php
include '../config.php'; // Go UP one level to find config.php

// If admin is already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$error_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // --- Hardcoded Admin Credentials (as requested) ---
    // You can change 'tejas' and 'tejas123' to whatever you want
    if ($username === 'tejas' && $password === 'tejas123') {
        
        // Success! Set the session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = 'Tejas'; // You can store the name
        
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error_msg = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<main class="form-hero-background">
  <div class="glass-form-card animate-up">
    <h2>Admin Portal</h2>

    <?php if (!empty($error_msg)): ?>
      <div class="alert alert-danger form-error" role="alert">
        <?php echo $error_msg; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="admin_login.php">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control form-control-dark" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control form-control-dark" id="password" name="password" required>
      </div>
      
      <button type="submit" class="btn btn-custom w-100 mt-3">Login</button>
      
      <div class="text-center mt-4">
        <a href="../index.php" class="form-link">← Back to Site</a>
      </div>
    </form>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>