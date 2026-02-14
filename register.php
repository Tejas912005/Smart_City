<?php
include 'config.php';
include 'includes/csrf.php';

if (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit;
}

$error_msg = '';
$success = false;
$user_name = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!csrf_verify()) {
        $error_msg = "Invalid request. Please try again.";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($name) || empty($email) || empty($password)) {
            $error_msg = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_msg = "Invalid email format.";
        } elseif (strlen($password) < 8) {
            $error_msg = "Password must be at least 8 characters long.";
        } elseif ($password !== $confirm_password) {
            $error_msg = "Passwords do not match.";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error_msg = "An account with this email already exists.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt_insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $stmt_insert->bind_param("sss", $name, $email, $hashed_password);

                if ($stmt_insert->execute()) {
                    $success = true;
                    $user_name = $name;
                } else {
                    $error_msg = "Registration failed. Please try again.";
                }
                $stmt_insert->close();
            }
            $stmt->close();
        }
    }
}
$conn->close();
?>
<?php include 'header.php'; ?>

<main class="auth-page">
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-5">
      <div class="col-md-5">
        
        <?php if ($success): ?>
        <!-- SUCCESS PAGE -->
        <div class="auth-card success-card animate-up">
          <div class="success-animation">
            <div class="checkmark-circle">
              <i class="fas fa-check"></i>
            </div>
          </div>
          <h1>🎉 Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
          <p>Your account has been created successfully!</p>
          
          <div class="success-features">
            <div class="feature">
              <i class="fas fa-file-alt"></i>
              <span>Submit Reports</span>
            </div>
            <div class="feature">
              <i class="fas fa-search"></i>
              <span>Track Status</span>
            </div>
            <div class="feature">
              <i class="fas fa-bell"></i>
              <span>Get Updates</span>
            </div>
          </div>
          
          <a href="login.php" class="auth-btn">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login Now</span>
          </a>
          <a href="index.php" class="back-home">
            <i class="fas fa-home"></i> Back to Home
          </a>
        </div>
        
        <?php else: ?>
        <!-- REGISTER FORM -->
        <div class="auth-card animate-up">
          <div class="auth-header">
            <div class="auth-icon register-icon">
              <i class="fas fa-user-plus"></i>
            </div>
            <h1>Create Account</h1>
            <p>Join us and start reporting civic issues</p>
          </div>

          <?php if (!empty($error_msg)): ?>
            <div class="auth-alert error">
              <i class="fas fa-exclamation-circle"></i>
              <?php echo $error_msg; ?>
            </div>
          <?php endif; ?>

          <form method="POST" action="register.php" class="auth-form">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <label>Full Name</label>
              <div class="input-wrapper">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Enter your name" required>
              </div>
            </div>

            <div class="form-group">
              <label>Email Address</label>
              <div class="input-wrapper">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter your email" required>
              </div>
            </div>

            <div class="form-group">
              <label>Password</label>
              <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Min. 8 characters" required oninput="checkStrength(this.value)">
                <button type="button" class="toggle-btn" onclick="togglePass('password')">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              <div class="strength-bar">
                <div class="strength-fill" id="strengthFill"></div>
              </div>
              <span class="strength-text" id="strengthText"></span>
            </div>

            <div class="form-group">
              <label>Confirm Password</label>
              <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
                <button type="button" class="toggle-btn" onclick="togglePass('confirm_password')">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="auth-btn">
              <i class="fas fa-rocket"></i>
              <span>Create Account</span>
            </button>
          </form>

          <div class="auth-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
          </div>
        </div>
        <?php endif; ?>
        
      </div>
    </div>
  </div>
</main>

<?php include 'includes/auth-styles.php'; ?>
<?php include 'includes/register-styles.php'; ?>

<?php include 'footer.php'; ?>