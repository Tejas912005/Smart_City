<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart City Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
      <i class="fas fa-city me-2" style="color: #6366f1;"></i>Smart City
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a href="index.php" class="nav-link">
            <i class="fas fa-home me-1"></i>Home
          </a>
        </li>
        <li class="nav-item">
          <a href="contact.php" class="nav-link">
            <i class="fas fa-envelope me-1"></i>Contact
          </a>
        </li>
        <li class="nav-item">
          <a href="feedback.php" class="nav-link">
            <i class="fas fa-comment-dots me-1"></i>Feedback
          </a>
        </li>
        
        <?php if(isset($_SESSION['user_id'])): ?>
        <!-- LOGGED IN USER MENU -->
        <li class="nav-item">
          <a href="user_dashboard.php" class="nav-link">
            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="btn btn-outline-danger btn-sm ms-2">
            <i class="fas fa-sign-out-alt me-1"></i>Logout
          </a>
        </li>
        
        <?php else: ?>
        <!-- NOT LOGGED IN MENU -->
        <li class="nav-item">
          <a href="login.php" class="nav-link">
            <i class="fas fa-sign-in-alt me-1"></i>Login
          </a>
        </li>
        <li class="nav-item">
          <a href="register.php" class="nav-link">
            <i class="fas fa-user-plus me-1"></i>Sign Up
          </a>
        </li>
        <li class="nav-item">
          <a href="admin/admin_login.php" class="nav-link">
            <i class="fas fa-user-shield me-1"></i>Admin
          </a>
        </li>
        <?php endif; ?>
        
      </ul>
    </div>
  </div>
</nav>
<main class="py-4">
