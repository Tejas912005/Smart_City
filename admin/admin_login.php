<?php
include '../config.php'; // Go UP one level to find config.php
include '../includes/csrf.php';
include '../includes/rate_limit.php';

// If admin is already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$error_msg = '';
$rate_limiter = new RateLimiter(5, 900); // 5 attempts, 15 min lockout
$client_ip = get_client_ip();

// Check if IP is blocked
if ($rate_limiter->isBlocked($client_ip)) {
    $remaining = ceil($rate_limiter->getRemainingTime($client_ip) / 60);
    $error_msg = "Too many failed attempts. Please try again in {$remaining} minutes.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error_msg)) {
    if (!csrf_verify()) {
        $error_msg = "Invalid request. Please try again.";
    } else {
        $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
        $password = $_POST['password'];

        $authenticated = false;
        $admin_name = '';

        // Try database authentication first
        $stmt = $conn->prepare("SELECT id, username, password, name FROM admins WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $admin = $result->fetch_assoc();
                if (password_verify($password, $admin['password'])) {
                    $authenticated = true;
                    $admin_name = $admin['name'];
                }
            }
            $stmt->close();
        }
        
        // Fallback to hardcoded credentials if DB auth fails or table doesn't exist
        if (!$authenticated && $username === 'tejas' && $password === 'tejas123') {
            $authenticated = true;
            $admin_name = 'Tejas';
        }

        if ($authenticated) {
            // Success - regenerate session ID to prevent fixation
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $admin_name;
            $rate_limiter->reset($client_ip);
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $rate_limiter->recordFailure($client_ip);
            $error_msg = "Invalid admin credentials.";
        }
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
      <?php echo csrf_field(); ?>
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