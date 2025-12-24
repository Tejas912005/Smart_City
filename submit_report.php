<?php
include 'config.php'; // Includes DB Connection and session_start()

// --- SECURITY CHECK ---
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success_msg = '';
$error_msg = '';

// --- FORM HANDLING ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $description = $_POST['description'];
    $image_name = ''; // Default to no image

    // --- File Upload Logic ---
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $upload_dir = 'uploads/'; // The folder we created in Step 1
        
        // Create a unique filename to prevent overwriting
        $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $image_name;

        // Move the uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // File upload was successful
        } else {
            $error_msg = "Sorry, there was an error uploading your file.";
            $image_name = ''; // Clear image name on failure
        }
    }

    // Only proceed if there was no upload error (or no file was uploaded)
    if (empty($error_msg)) {
        // Use prepared statements to insert into DB
        $stmt = $conn->prepare("INSERT INTO reports (user_id, category, description, image, status) VALUES (?, ?, ?, ?, 'Pending')");
        $stmt->bind_param("isss", $user_id, $category, $description, $image_name);

        if ($stmt->execute()) {
            $success_msg = "Your report has been submitted successfully! You will be redirected to your dashboard.";
            // Redirect back to dashboard after 3 seconds
            header("refresh:3;url=user_dashboard.php");
        } else {
            $error_msg = "There was an error submitting your report. Please try again.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<?php include 'header.php'; // Includes <head>, <body>, and <nav> ?>

<main class="container my-5">

  <div class="page-header animate-up">
    <h1>Submit a New Report</h1>
  </div>

  <div class="form-container-light animate-up" style="animation-delay: 0.2s;">
    
    <?php if (!empty($success_msg)): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $success_msg; ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($error_msg)): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error_msg; ?>
      </div>
    <?php endif; ?>

    <?php if (empty($success_msg)): ?>
      <form method="POST" action="submit_report.php" enctype="multipart/form-data">
        
        <div class="mb-3">
          <label for="category" class="form-label-styled">Category</label>
          <select class="form-select form-control-light" id="category" name="category" required>
            <option value="">Select a category...</option>
            <option value="Pothole">Pothole</option>
            <option value="Garbage">Garbage / Waste</option>
            <option value="Streetlight">Broken Streetlight</option>
            <option value="Water Leak">Water Leak</option>
            <option value="Other">Other</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-styled">Description</label>
          <textarea class="form-control form-control-light" id="description" name="description" rows="5" placeholder="Please provide details about the issue, including location." required></textarea>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-styled">Upload Image (Optional)</label>
          <input class="form-control form-control-light" type="file" id="image" name="image" accept="image/png, image/jpeg">
          <div class="form-text">Uploading a photo helps us resolve the issue faster.</div>
        </div>

        <button type="submit" class="btn btn-custom w-100 mt-3">Submit Report</button>
      
      </form>
    <?php endif; ?>

  </div>
</main>

<?php include 'footer.php'; // Includes <footer> and closing </body>/</html> ?>