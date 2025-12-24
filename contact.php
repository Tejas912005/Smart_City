<?php 
include 'config.php';

$success_msg = '';
$error_msg = '';

// Handle contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // For now, just show success (you can add email sending logic later)
    if (!empty($name) && !empty($email) && !empty($message)) {
        $success_msg = "Thank you for reaching out! We'll get back to you within 24-48 hours.";
    } else {
        $error_msg = "Please fill in all required fields.";
    }
}
?>

<?php include 'header.php'; ?>

<main class="container my-5">

  <div class="page-header animate-up">
    <h1><i class="fas fa-headset me-2 text-primary"></i>Contact Us</h1>
    <p class="text-muted mb-0">Have questions? We're here to help you 24/7</p>
  </div>

  <div class="row mt-4">
    <!-- Contact Information Cards -->
    <div class="col-lg-5 mb-4">
      <div class="animate-up" style="animation-delay: 0.2s;">
        
        <!-- Email Card -->
        <div class="contact-info-card mb-3">
          <div class="contact-icon-box">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="contact-info-content">
            <h5>Email Us</h5>
            <p>For general inquiries and support</p>
            <a href="mailto:support@smartcity.gov.in" class="contact-link">support@smartcity.gov.in</a>
          </div>
        </div>

        <!-- Phone Card -->
        <div class="contact-info-card mb-3">
          <div class="contact-icon-box">
            <i class="fas fa-phone-alt"></i>
          </div>
          <div class="contact-info-content">
            <h5>Call Us</h5>
            <p>For urgent issues and emergencies</p>
            <a href="tel:+919876543210" class="contact-link">+91 987 654 3210</a>
          </div>
        </div>

        <!-- Address Card -->
        <div class="contact-info-card mb-3">
          <div class="contact-icon-box">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="contact-info-content">
            <h5>Visit Us</h5>
            <p>Smart City Municipal Corp.<br>123 Tech Park Road<br>Mumbai, Maharashtra 400001</p>
          </div>
        </div>

        <!-- Office Hours Card -->
        <div class="contact-info-card">
          <div class="contact-icon-box">
            <i class="fas fa-clock"></i>
          </div>
          <div class="contact-info-content">
            <h5>Office Hours</h5>
            <p class="mb-1"><strong>Mon - Fri:</strong> 9:00 AM - 6:00 PM</p>
            <p class="mb-1"><strong>Saturday:</strong> 10:00 AM - 4:00 PM</p>
            <p class="mb-0"><strong>Sunday:</strong> Closed</p>
          </div>
        </div>

      </div>
    </div>

    <!-- Contact Form -->
    <div class="col-lg-7">
      <div class="form-container-light animate-up" style="animation-delay: 0.3s;">
        <h4 class="fw-bold mb-4"><i class="fas fa-paper-plane me-2 text-primary"></i>Send Us a Message</h4>
        
        <?php if (!empty($success_msg)): ?>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo $success_msg; ?>
          </div>
        <?php endif; ?>
        
        <?php if (!empty($error_msg)): ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?php echo $error_msg; ?>
          </div>
        <?php endif; ?>

        <?php if (empty($success_msg)): ?>
        <form method="POST" action="contact.php">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label-styled">Your Name <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control form-control-light" id="name" name="name" placeholder="John Doe" required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label-styled">Your Email <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control form-control-light" id="email" name="email" placeholder="you@example.com" required>
              </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="subject" class="form-label-styled">Subject</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-tag"></i></span>
              <input type="text" class="form-control form-control-light" id="subject" name="subject" placeholder="How can we help?">
            </div>
          </div>
          
          <div class="mb-3">
            <label for="message" class="form-label-styled">Message <span class="text-danger">*</span></label>
            <textarea class="form-control form-control-light" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
          </div>
          
          <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 14px; border-radius: 12px; font-weight: 600; border: none;">
            <i class="fas fa-paper-plane me-2"></i>Send Message
          </button>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Map Section -->
  <div class="mt-5 animate-up" style="animation-delay: 0.4s;">
    <div class="form-container-light">
      <h4 class="fw-bold mb-3"><i class="fas fa-map me-2 text-primary"></i>Find Us on Map</h4>
      <div class="map-container">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.11609823277!2d72.74109995709657!3d19.08219783958221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1701234567890!5m2!1sen!2sin" 
          width="100%" 
          height="350" 
          style="border:0; border-radius: 12px;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </div>

</main>

<?php include 'footer.php'; ?>