<?php
include 'config.php'; // Includes DB Connection and session_start()
include 'includes/csrf.php';

$user_id = $_SESSION['user_id'] ?? null; // Get user ID if logged in, otherwise null
$user_name = '';
$user_email = '';
$success_msg = '';
$error_msg = '';

// If user is logged in, pre-fill their details
if ($user_id) {
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $user_name = $user['name'];
        $user_email = $user['email'];
    }
    $stmt->close();
}

// --- FORM HANDLING ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!csrf_verify()) {
        $error_msg = "Invalid request. Please try again.";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $rating = $_POST['rating'] ?? 5;
        $message = $_POST['message'];

        $stmt = $conn->prepare("INSERT INTO feedback (user_id, name, email, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $name, $email, $message);

        if ($stmt->execute()) {
            $success_msg = "Thank you for your feedback! We appreciate your input.";
        } else {
            $error_msg = "There was an error sending your feedback. Please try again.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<?php include 'header.php'; ?>

<main class="feedback-page">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        <div class="feedback-hero">
          <div class="feedback-hero-content">
            <span class="feedback-badge"><i class="fas fa-heart me-2"></i>We Love Hearing From You</span>
            <h1>Share Your Thoughts</h1>
            <p>Your feedback helps us improve Smart City Portal and serve you better!</p>
          </div>
          <div class="feedback-hero-illustration">
            <div class="feedback-icon-circle">
              <i class="fas fa-comments"></i>
            </div>
          </div>
        </div>
        
        <div class="row g-4 mt-4">
          <!-- Left Side - Why Feedback Matters -->
          <div class="col-lg-5">
            <div class="feedback-info-card">
              <h4><i class="fas fa-question-circle me-2"></i>Why Your Feedback Matters</h4>
              
              <div class="info-item">
                <div class="info-icon"><i class="fas fa-chart-line"></i></div>
                <div class="info-content">
                  <h5>Improve Services</h5>
                  <p>Help us identify areas that need enhancement</p>
                </div>
              </div>
              
              <div class="info-item">
                <div class="info-icon"><i class="fas fa-lightbulb"></i></div>
                <div class="info-content">
                  <h5>New Ideas</h5>
                  <p>Suggest features you'd like to see</p>
                </div>
              </div>
              
              <div class="info-item">
                <div class="info-icon"><i class="fas fa-bug"></i></div>
                <div class="info-content">
                  <h5>Report Issues</h5>
                  <p>Let us know if something isn't working</p>
                </div>
              </div>
              
              <div class="info-item">
                <div class="info-icon"><i class="fas fa-star"></i></div>
                <div class="info-content">
                  <h5>Share Success</h5>
                  <p>Tell us what's working well</p>
                </div>
              </div>
              
              <!-- <div class="feedback-stats">
                <div class="stat">
                  <strong>500+</strong>
                  <span>Feedbacks Received</span>
                </div>
                <div class="stat">
                  <strong>95%</strong>
                  <span>Acted Upon</span>
                </div>
              </div> -->
            </div>
          </div>
          
          <!-- Right Side - Feedback Form -->
          <div class="col-lg-7">
            <div class="feedback-form-card">
              
              <?php if (!empty($success_msg)): ?>
                <div class="success-animation">
                  <div class="success-icon">
                    <i class="fas fa-check"></i>
                  </div>
                  <h3>Thank You!</h3>
                  <p><?php echo $success_msg; ?></p>
                  <a href="index.php" class="btn-back-home">
                    <i class="fas fa-home me-2"></i>Back to Home
                  </a>
                </div>
              <?php else: ?>
              
              <h4><i class="fas fa-edit me-2"></i>Send Your Feedback</h4>
              
              <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                  <i class="fas fa-exclamation-circle me-2"></i>
                  <?php echo $error_msg; ?>
                </div>
              <?php endif; ?>
              
              <form method="POST" action="feedback.php">
                <?php echo csrf_field(); ?>
                <div class="form-row">
                  <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i>Your Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_name); ?>"required>
                  </div>
                  <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i>Your Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>"required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label><i class="fas fa-star"></i>Rate Your Experience</label>
                  <div class="rating-selector">
                    <input type="radio" name="rating" value="1" id="rate1"><label for="rate1">😞</label>
                    <input type="radio" name="rating" value="2" id="rate2"><label for="rate2">😐</label>
                    <input type="radio" name="rating" value="3" id="rate3"><label for="rate3">🙂</label>
                    <input type="radio" name="rating" value="4" id="rate4"><label for="rate4">😊</label>
                    <input type="radio" name="rating" value="5" id="rate5" checked><label for="rate5">🤩</label>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="message"><i class="fas fa-comment-alt"></i>Your Feedback</label>
                  <textarea id="message" name="message" rows="5" placeholder="Tell us what you think... What can we improve? What do you love?" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                  <i class="fas fa-paper-plane me-2"></i>Send Feedback
                </button>
              </form>
              
              <?php endif; ?>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</main>

<style>
.feedback-page {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  min-height: 100vh;
}
.feedback-hero {
  background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
  border-radius: 24px;
  padding: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: white;
  position: relative;
  overflow: hidden;
}
.feedback-hero::before {
  content: '';
  position: absolute;
  width: 300px;
  height: 300px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  top: -100px;
  right: -50px;
}
.feedback-badge {
  display: inline-block;
  background: rgba(255,255,255,0.2);
  padding: 8px 20px;
  border-radius: 30px;
  font-size: 0.9rem;
  margin-bottom: 15px;
}
.feedback-hero h1 {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 10px;
}
.feedback-hero p {
  font-size: 1.1rem;
  opacity: 0.9;
  margin: 0;
}
.feedback-icon-circle {
  width: 120px;
  height: 120px;
  background: rgba(255,255,255,0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  animation: float 3s ease-in-out infinite;
}
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}
.feedback-info-card {
  background: white;
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.08);
  height: 100%;
}
.feedback-info-card h4 {
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 25px;
}
.info-item {
  display: flex;
  gap: 15px;
  margin-bottom: 20px;
}
.info-icon {
  width: 45px;
  height: 45px;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
}
.info-content h5 {
  font-size: 1rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 3px;
}
.info-content p {
  font-size: 0.85rem;
  color: #64748b;
  margin: 0;
}
.feedback-stats {
  display: flex;
  gap: 30px;
  margin-top: 30px;
  padding-top: 20px;
  border-top: 1px solid #e5e7eb;
}
.feedback-stats .stat strong {
  display: block;
  font-size: 1.8rem;
  font-weight: 800;
  color: #6366f1;
}
.feedback-stats .stat span {
  font-size: 0.85rem;
  color: #64748b;
}
.feedback-form-card {
  background: white;
  border-radius: 20px;
  padding: 35px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}
.feedback-form-card h4 {
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 25px;
}
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.form-group {
  margin-bottom: 20px;
}
.form-group label {
  display: block;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 8px;
  font-size: 0.9rem;
}
.form-group label i {
  margin-right: 8px;
  color: #6366f1;
}
.form-group input, .form-group textarea {
  width: 100%;
  padding: 14px 18px;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-size: 1rem;
  transition: all 0.3s;
}
.form-group input:focus, .form-group textarea:focus {
  border-color: #6366f1;
  outline: none;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}
.rating-selector {
  display: flex;
  gap: 10px;
}
.rating-selector input {
  display: none;
}
.rating-selector label {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.8rem;
  background: #f1f5f9;
  border-radius: 12px;
  cursor: pointer;
  transition: all 0.3s;
}
.rating-selector input:checked + label {
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  transform: scale(1.1);
}
.rating-selector label:hover {
  transform: scale(1.1);
}
.submit-btn {
  width: 100%;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: white;
  border: none;
  padding: 16px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 1.1rem;
  cursor: pointer;
  transition: all 0.3s;
}
.submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(99, 102, 241, 0.35);
}
.success-animation {
  text-align: center;
  padding: 40px;
}
.success-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  font-size: 2rem;
  color: white;
  animation: scaleIn 0.5s ease;
}
@keyframes scaleIn {
  0% { transform: scale(0); }
  50% { transform: scale(1.2); }
  100% { transform: scale(1); }
}
.success-animation h3 {
  font-size: 1.8rem;
  font-weight: 800;
  color: #1e293b;
  margin-bottom: 10px;
}
.success-animation p {
  color: #64748b;
  margin-bottom: 25px;
}
.btn-back-home {
  display: inline-block;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: white;
  padding: 14px 30px;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s;
}
.btn-back-home:hover {
  color: white;
  transform: translateY(-2px);
}
@media (max-width: 991px) {
  .feedback-hero { flex-direction: column; text-align: center; padding: 35px; }
  .feedback-hero h1 { font-size: 1.8rem; }
  .feedback-icon-circle { margin-top: 20px; width: 80px; height: 80px; font-size: 2rem; }
  .form-row { grid-template-columns: 1fr; }
}
</style>

<?php include 'footer.php'; ?>