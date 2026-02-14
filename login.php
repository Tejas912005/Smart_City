<?php
include 'config.php';
include 'includes/csrf.php';
include 'includes/rate_limit.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Success - regenerate session ID to prevent fixation
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $rate_limiter->reset($client_ip); // Clear failed attempts
                header("Location: index.php");
                exit;
            } else {
                $rate_limiter->recordFailure($client_ip);
                $error_msg = "Invalid email or password.";
            }
        } else {
            $rate_limiter->recordFailure($client_ip);
            $error_msg = "Invalid email or password.";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<?php include 'header.php'; ?>

<main class="auth-page">
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-5">
      <div class="col-md-5">
        <div class="auth-card animate-up">
          <div class="auth-header">
            <div class="auth-icon">
              <i class="fas fa-user"></i>
            </div>
            <h1>Welcome Back!</h1>
            <p>Sign in to continue to your dashboard</p>
          </div>

          <?php if (!empty($error_msg)): ?>
            <div class="auth-alert error">
              <i class="fas fa-exclamation-circle"></i>
              <?php echo $error_msg; ?>
            </div>
          <?php endif; ?>

            <form method="POST" action="login.php" class="auth-form" role="form" aria-label="Login form">
              <?php echo csrf_field(); ?>
              <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                  <i class="fas fa-envelope" aria-hidden="true"></i>
                  <input type="email" name="email" id="email" placeholder="you@example.com" required autocomplete="email" aria-required="true">
                </div>
              </div>

            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-wrapper">
                <i class="fas fa-lock" aria-hidden="true"></i>
                <input type="password" name="password" id="password" placeholder="••••••••" required autocomplete="current-password" aria-required="true">
                <button type="button" class="toggle-btn" onclick="togglePass('password')" aria-label="Toggle password visibility">
                  <i class="fas fa-eye" aria-hidden="true"></i>
                </button>
              </div>
            </div>

            <div class="form-options">
              <label class="remember-me">
                <input type="checkbox" name="remember" id="remember">
                <span>Remember me</span>
              </label>
              <a href="#" class="forgot-link">Forgot Password?</a>
            </div>

            <button type="submit" class="auth-btn" aria-label="Login to your account">
              <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
              <span>Login</span>
            </button>
          </form>

          <div class="auth-footer">
            <p>Don't have an account? <a href="register.php">Create Account</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'includes/auth-styles.php'; ?>

<?php include 'footer.php'; ?>