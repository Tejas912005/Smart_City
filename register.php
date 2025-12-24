<?php
include 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit;
}

$error_msg = '';
$success = false;
$user_name = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            <div class="form-group">
              <label>Full Name</label>
              <div class="input-wrapper">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="John Doe" required>
              </div>
            </div>

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

.register-icon {
  background: linear-gradient(135deg, #22c55e, #16a34a);
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
  margin-bottom: 18px;
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

.strength-bar {
  height: 5px;
  background: #e5e7eb;
  border-radius: 5px;
  margin-top: 8px;
  overflow: hidden;
}

.strength-fill {
  height: 100%;
  width: 0;
  transition: all 0.3s;
  border-radius: 5px;
}

.strength-text {
  font-size: 0.8rem;
  font-weight: 600;
  margin-top: 5px;
  display: block;
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
  text-decoration: none;
}

.auth-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(99, 102, 241, 0.35);
  color: white;
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

/* SUCCESS STYLES */
.success-card {
  text-align: center;
  padding: 50px 40px;
}

.success-animation {
  margin-bottom: 25px;
}

.checkmark-circle {
  width: 90px;
  height: 90px;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
  animation: scaleIn 0.5s ease, pulse 2s infinite;
}

.checkmark-circle i {
  font-size: 2.5rem;
  color: white;
}

@keyframes scaleIn {
  0% { transform: scale(0); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

@keyframes pulse {
  0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
  50% { box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); }
}

.success-card h1 {
  font-size: 1.6rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 10px;
}

.success-card > p {
  color: #64748b;
  margin-bottom: 25px;
}

.success-features {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-bottom: 30px;
}

.success-features .feature {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}

.success-features .feature i {
  font-size: 1.4rem;
  color: #6366f1;
}

.success-features .feature span {
  font-size: 0.85rem;
  font-weight: 600;
  color: #64748b;
}

.back-home {
  display: block;
  margin-top: 15px;
  color: #64748b;
  font-size: 0.9rem;
  text-decoration: none;
}

.back-home:hover {
  color: #6366f1;
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
  .success-features { gap: 15px; }
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

function checkStrength(password) {
  const fill = document.getElementById('strengthFill');
  const text = document.getElementById('strengthText');
  
  let strength = 0;
  if (password.length >= 8) strength++;
  if (password.match(/[a-z]/)) strength++;
  if (password.match(/[A-Z]/)) strength++;
  if (password.match(/[0-9]/)) strength++;
  if (password.match(/[^a-zA-Z0-9]/)) strength++;
  
  const levels = [
    { text: '', color: '#e5e7eb', width: 0 },
    { text: 'Weak', color: '#ef4444', width: 25 },
    { text: 'Fair', color: '#f59e0b', width: 50 },
    { text: 'Good', color: '#84cc16', width: 75 },
    { text: 'Strong', color: '#22c55e', width: 100 }
  ];
  
  const level = levels[Math.min(strength, 4)];
  fill.style.width = level.width + '%';
  fill.style.backgroundColor = level.color;
  text.textContent = password.length > 0 ? level.text : '';
  text.style.color = level.color;
}
</script>

<?php include 'footer.php'; ?>