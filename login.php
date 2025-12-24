<?php
include 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit;
        } else {
            $error_msg = "Invalid email or password.";
        }
    } else {
        $error_msg = "Invalid email or password.";
    }
    $stmt->close();
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

          <form method="POST" action="login.php" class="auth-form">
            <div class="form-group">
              <label>Email Address</label>
              <div class="input-wrapper">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="you@example.com" required>
              </div>
            </div>

            <div class="form-group">
              <label>Password</label>
              <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
                <button type="button" class="toggle-btn" onclick="togglePass('password')">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>

            <div class="form-options">
              <label class="remember-me">
                <input type="checkbox" name="remember">
                <span>Remember me</span>
              </label>
              <a href="#" class="forgot-link">Forgot Password?</a>
            </div>

            <button type="submit" class="auth-btn">
              <i class="fas fa-sign-in-alt"></i>
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

<style>
.auth-page {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  min-height: 100vh;
  padding-top: 80px;
}

.auth-card {
  background: white;
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.auth-header {
  text-align: center;
  margin-bottom: 30px;
}

.auth-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  font-size: 1.8rem;
  color: white;
}

.auth-header h1 {
  font-size: 1.6rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 5px;
}

.auth-header p {
  color: #64748b;
  font-size: 0.9rem;
}

.auth-alert {
  padding: 12px 16px;
  border-radius: 10px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.9rem;
}

.auth-alert.error {
  background: #fef2f2;
  color: #dc2626;
  border: 1px solid #fecaca;
}

.auth-form .form-group {
  margin-bottom: 20px;
}

.auth-form label {
  display: block;
  font-weight: 600;
  color: #374151;
  margin-bottom: 8px;
  font-size: 0.9rem;
}

.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.input-wrapper > i:first-child {
  position: absolute;
  left: 16px;
  color: #6366f1;
  font-size: 1rem;
}

.input-wrapper input {
  width: 100%;
  padding: 14px 45px;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-size: 1rem;
  transition: all 0.3s;
  background: #f9fafb;
}

.input-wrapper input:focus {
  border-color: #6366f1;
  background: white;
  outline: none;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.toggle-btn {
  position: absolute;
  right: 12px;
  background: none;
  border: none;
  color: #9ca3af;
  cursor: pointer;
  padding: 5px;
}

.toggle-btn:hover {
  color: #6366f1;
}

.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
}

.remember-me {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #64748b;
  font-size: 0.9rem;
  cursor: pointer;
}

.remember-me input {
  accent-color: #6366f1;
}

.forgot-link {
  color: #6366f1;
  font-size: 0.9rem;
  font-weight: 500;
  text-decoration: none;
}

.forgot-link:hover {
  text-decoration: underline;
}

.auth-btn {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  cursor: pointer;
  transition: all 0.3s;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: white;
}

.auth-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(99, 102, 241, 0.35);
}

.auth-footer {
  text-align: center;
  margin-top: 25px;
  padding-top: 25px;
  border-top: 1px solid #e5e7eb;
}

.auth-footer p {
  color: #64748b;
  font-size: 0.95rem;
}

.auth-footer a {
  color: #6366f1;
  font-weight: 600;
  text-decoration: none;
}

.auth-footer a:hover {
  text-decoration: underline;
}

.animate-up {
  animation: slideUp 0.5s ease;
}

@keyframes slideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 576px) {
  .auth-card { padding: 30px 25px; }
}
</style>

<script>
function togglePass(id) {
  const input = document.getElementById(id);
  const icon = input.nextElementSibling.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('fa-eye', 'fa-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.replace('fa-eye-slash', 'fa-eye');
  }
}
</script>

<?php include 'footer.php'; ?>