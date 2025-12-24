<?php
session_start();
require 'db/connect.php';
$user_id = $_SESSION['user_id'] ?? null;
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>My Reports</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="p-4">
<div class="container">
  <h3><?php echo $user_id ? 'My Reports' : 'All Reports'; ?></h3>
  <?php
  if($user_id) $res = $conn->query("SELECT r.*, u.name FROM reports r LEFT JOIN users u ON r.user_id=u.id WHERE r.user_id=$user_id ORDER BY r.id DESC");
  else $res = $conn->query("SELECT r.*, u.name FROM reports r LEFT JOIN users u ON r.user_id=u.id ORDER BY r.id DESC");
  while($row = $res->fetch_assoc()):
  ?>
  <div class="card mb-3">
    <div class="row g-0">
      <div class="col-md-4"><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid rounded-start"></div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($row['category']); ?> — <small><?php echo htmlspecialchars($row['status']); ?></small></h5>
          <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
          <p class="card-text"><small class="text-muted">By <?php echo htmlspecialchars($row['name'] ?? 'Unknown'); ?></small></p>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; $res->free(); $conn->close(); ?>
</div>
</body>
</html>
