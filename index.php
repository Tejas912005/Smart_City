<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart City Portal - Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-city me-2"></i>Smart City
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a href="index.php" class="nav-link active"><i class="fas fa-home me-1"></i>Home</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link"><i class="fas fa-envelope me-1"></i>Contact</a></li>
          <li class="nav-item"><a href="feedback.php" class="nav-link"><i class="fas fa-comment-dots me-1"></i>Feedback</a></li>
          <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item"><a href="user_dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
            <li class="nav-item"><a href="logout.php" class="btn btn-outline-light btn-sm ms-2"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a href="login.php" class="nav-link"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link"><i class="fas fa-user-plus me-1"></i>Sign Up</a></li>
            <li class="nav-item"><a href="admin/admin_login.php" class="nav-link"><i class="fas fa-user-shield me-1"></i>Admin</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
    </div>
    <div class="container">
      <div class="row align-items-center min-vh-100">
        <div class="col-lg-6">
          <div class="hero-content">
            <span class="hero-badge"><i class="fas fa-bolt me-1"></i>Making Cities Smarter</span>
            <h1>Build a Better City <span class="text-gradient">Together</span></h1>
            <p>Report civic issues, track progress, and help create a cleaner, safer community for everyone.</p>
            <div class="hero-buttons">
              <?php if(isset($_SESSION['user_id'])): ?>
              <a href="submit_report.php" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle me-2"></i>Report an Issue
              </a>
              <a href="user_dashboard.php" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-tachometer-alt me-2"></i>My Dashboard
              </a>
              <?php else: ?>
              <a href="register.php" class="btn btn-primary btn-lg">
                <i class="fas fa-rocket me-2"></i>Get Started Free
              </a>
              <a href="#howItWorks" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-play-circle me-2"></i>See How It Works
              </a>
              <?php endif; ?>
            </div>
            <div class="hero-stats">
              <div class="hero-stat">
                <strong></strong>
                <span></span>
              </div>
              <div class="hero-stat">
                <strong></strong>
                <span></span>
              </div>
              <div class="hero-stat">
                <strong></strong>
                <span></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div class="hero-image-wrapper">
            <img src="assets/images/hero-city.png" alt="Smart City" class="hero-image">
            <div class="hero-badge-float badge-1">
              <i class="fas fa-check-circle text-success"></i>
              <span>Issue Resolved!</span>
            </div>
            <div class="hero-badge-float badge-2">
              <i class="fas fa-bolt text-warning"></i>
              <span>Fast Response</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features-section" id="howItWorks">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-badge">How It Works</span>
        <h2>Simple, Fast & Effective</h2>
        <p>Three easy steps to make your city better</p>
      </div>
      
      <div class="row g-4 mt-4">
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
              <i class="fas fa-camera"></i>
            </div>
            <div class="feature-step">Step 1</div>
            <h3>Report an Issue</h3>
            <p>Snap a photo, add location & description. It takes less than a minute!</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
              <i class="fas fa-search-location"></i>
            </div>
            <div class="feature-step">Step 2</div>
            <h3>Track Progress</h3>
            <p>Get real-time updates on your dashboard as authorities take action.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
              <i class="fas fa-check-double"></i>
            </div>
            <div class="feature-step">Step 3</div>
            <h3>See Results</h3>
            <p>Watch your city improve and get notified when issues are resolved.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Categories Section -->
  <section class="categories-section">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-badge">Report Categories</span>
        <h2>What Can You Report?</h2>
      </div>
      
      <div class="row g-3 mt-4">
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-road"></i>
            <span>Potholes</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-lightbulb"></i>
            <span>Street Lights</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-trash-alt"></i>
            <span>Garbage</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-water"></i>
            <span>Drainage</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-tree"></i>
            <span>Parks</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-traffic-light"></i>
            <span>Traffic</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-tint"></i>
            <span>Water Supply</span>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="category-card">
            <i class="fas fa-ellipsis-h"></i>
            <span>Others</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section - Vibrant -->
  <section class="cta-section-new">
    <div class="cta-bg-shapes">
      <div class="cta-shape cta-shape-1"></div>
      <div class="cta-shape cta-shape-2"></div>
      <div class="cta-shape cta-shape-3"></div>
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="cta-content">
            <span class="cta-badge"><i class="fas fa-rocket me-2"></i>Join The Movement</span>
            <h2>Be The Change Your City Needs</h2>
            <p>Every report matters. Every voice counts. Together, we've already fixed <strong>5,000+</strong> issues and counting!</p>
            <div class="cta-buttons">
              <a href="register.php" class="cta-btn-primary">
                <i class="fas fa-arrow-right me-2"></i>Start Reporting Now
              </a>
              <a href="#howItWorks" class="cta-btn-secondary">
                <i class="fas fa-play-circle me-2"></i>Watch Demo
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="cta-image-wrapper">
            <img src="assets/images/report-illustration.png" alt="Report Issues" class="cta-image">
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
  .cta-section-new {
    position: relative;
    padding: 100px 0;
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
    overflow: hidden;
  }
  .cta-bg-shapes {
    position: absolute;
    inset: 0;
    overflow: hidden;
  }
  .cta-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
  }
  .cta-shape-1 {
    width: 400px;
    height: 400px;
    background: #818cf8;
    top: -100px;
    left: -100px;
    animation: float 8s ease-in-out infinite;
  }
  .cta-shape-2 {
    width: 300px;
    height: 300px;
    background: #c084fc;
    bottom: -50px;
    right: 10%;
    animation: float 6s ease-in-out infinite reverse;
  }
  .cta-shape-3 {
    width: 200px;
    height: 200px;
    background: #22d3ee;
    top: 50%;
    right: -50px;
    animation: float 10s ease-in-out infinite;
  }
  @keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(10deg); }
  }
  .cta-content {
    position: relative;
    z-index: 2;
  }
  .cta-badge {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    color: #a5b4fc;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 20px;
    backdrop-filter: blur(5px);
  }
  .cta-content h2 {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 15px;
    line-height: 1.2;
  }
  .cta-content p {
    font-size: 1.15rem;
    color: #c7d2fe;
    margin-bottom: 30px;
  }
  .cta-content p strong {
    color: #fbbf24;
  }
  .cta-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
  }
  .cta-btn-primary {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    padding: 16px 32px;
    border-radius: 12px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
  }
  .cta-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(245, 158, 11, 0.4);
    color: white;
  }
  .cta-btn-secondary {
    background: rgba(255,255,255,0.1);
    color: white;
    padding: 16px 32px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    border: 2px solid rgba(255,255,255,0.2);
    transition: all 0.3s;
  }
  .cta-btn-secondary:hover {
    background: rgba(255,255,255,0.2);
    color: white;
  }
  .cta-image-wrapper {
    position: relative;
    z-index: 2;
  }
  .cta-image {
    width: 100%;
    max-width: 450px;
    border-radius: 20px;
    animation: float 6s ease-in-out infinite;
  }
  /* Hero Image Styles */
  .hero-image-wrapper {
    position: relative;
  }
  .hero-image {
    width: 100%;
    max-width: 500px;
    border-radius: 20px;
    animation: float 6s ease-in-out infinite;
  }
  .hero-badge-float {
    position: absolute;
    background: white;
    padding: 12px 18px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    font-weight: 600;
    font-size: 0.9rem;
  }
  .hero-badge-float.badge-1 {
    top: 20%;
    right: 0;
    animation: floatBadge 4s ease-in-out infinite;
  }
  .hero-badge-float.badge-2 {
    bottom: 20%;
    left: 0;
    animation: floatBadge 5s ease-in-out infinite reverse;
  }
  @keyframes floatBadge {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }
  @media (max-width: 991px) {
    .cta-content h2 { font-size: 2rem; }
    .cta-section-new { padding: 60px 0; }
  }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
<?php require_once 'footer.php'; ?>
</body>
</html>
