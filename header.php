<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Compatibility -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Smart City Portal - Report civic issues and track their resolution">
  
  <!-- DNS Prefetch for faster CDN loading -->
  <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
  <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
  <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  
  <title>Smart City Portal</title>
  
  <!-- Critical CSS first -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" media="print" onload="this.media='all'">
  <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  
  <!-- Accessibility: Skip link styles -->
  <style>
    .skip-link {
      position: absolute;
      top: -40px;
      left: 0;
      background: #6366f1;
      color: white;
      padding: 8px 16px;
      z-index: 9999;
      text-decoration: none;
      border-radius: 0 0 4px 0;
    }
    .skip-link:focus {
      top: 0;
    }
  </style>
</head>
<body>
<!-- Accessibility: Skip to main content -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Noscript fallback -->
<noscript>
  <div style="background:#fef3cd;color:#856404;padding:15px;text-align:center;">
    <strong>JavaScript is disabled.</strong> Some features may not work properly. Please enable JavaScript for the best experience.
  </div>
</noscript>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm" role="navigation" aria-label="Main navigation">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php" aria-label="Smart City Portal Home">
      <i class="fas fa-city me-2" style="color: #6366f1;" aria-hidden="true"></i>Smart City
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center" role="menubar">
        <li class="nav-item" role="none">
          <a href="index.php" class="nav-link" role="menuitem">
            <i class="fas fa-home me-1" aria-hidden="true"></i>Home
          </a>
        </li>
        <li class="nav-item" role="none">
          <a href="contact.php" class="nav-link" role="menuitem">
            <i class="fas fa-envelope me-1" aria-hidden="true"></i>Contact
          </a>
        </li>
        <li class="nav-item" role="none">
          <a href="feedback.php" class="nav-link" role="menuitem">
            <i class="fas fa-comment-dots me-1" aria-hidden="true"></i>Feedback
          </a>
        </li>
        
        <?php if(isset($_SESSION['user_id'])): ?>
        <!-- LOGGED IN USER MENU -->
        <li class="nav-item" role="none">
          <a href="user_dashboard.php" class="nav-link" role="menuitem">
            <i class="fas fa-tachometer-alt me-1" aria-hidden="true"></i>Dashboard
          </a>
        </li>
        <li class="nav-item" role="none">
          <a href="logout.php" class="btn btn-outline-danger btn-sm ms-2" role="menuitem" aria-label="Logout from account">
            <i class="fas fa-sign-out-alt me-1" aria-hidden="true"></i>Logout
          </a>
        </li>
        
        <?php else: ?>
        <!-- NOT LOGGED IN MENU -->
        <li class="nav-item" role="none">
          <a href="login.php" class="nav-link" role="menuitem">
            <i class="fas fa-sign-in-alt me-1" aria-hidden="true"></i>Login
          </a>
        </li>
        <li class="nav-item" role="none">
          <a href="register.php" class="nav-link" role="menuitem">
            <i class="fas fa-user-plus me-1" aria-hidden="true"></i>Sign Up
          </a>
        </li>
        <li class="nav-item" role="none">
          <a href="admin/admin_login.php" class="nav-link" role="menuitem">
            <i class="fas fa-user-shield me-1" aria-hidden="true"></i>Admin
          </a>
        </li>
        <?php endif; ?>
        
      </ul>
    </div>
  </div>
</nav>
<main id="main-content" class="py-4" role="main">
