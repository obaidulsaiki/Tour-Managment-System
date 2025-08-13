<?php
include 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('❌ Invalid user ID'); window.location.href='manage_users.php';</script>";
    exit;
}

$userId = intval($_GET['id']);

// Fetch user data
$stmt = $conn->prepare("SELECT id, name, email, phone, address FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    echo "<script>alert('❌ User not found'); window.location.href='manage_users.php';</script>";
    exit;
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, address=?, password=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $phone, $address, $hashedPassword, $userId);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, address=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $phone, $address, $userId);
    }

    if ($stmt->execute()) {
        echo "<script>alert('✅ User updated successfully'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('❌ Error updating user: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Favicon -->
  <link rel="icon" type="image/png" href="../tour_packages/assets/favicon.png" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<style>
  body {
      background-image: url(images/bg.jpeg);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: white;
  }
  .card {
      background-color: rgba(0, 0, 0, 0.75);
      color: white;
  }
  .form-control, .form-control:focus {
      background-color: rgba(255, 255, 255, 0.1);
      border: 1px solid #ccc;
      color: white;
  }
  .form-control::placeholder {
      color: #ccc;
  }
</style>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Dynamic Tour Group</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item mx-2">
          <a class="btn btn-outline-light" href="../user/logout.php">Log out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Edit Form -->
<div class="container mt-5">
  <div class="col-12 col-lg-6 d-flex justify-content-start mb-2">
    <a href="manage_users.php" class="btn btn-light fw-bold shadow px-3 py-1 rounded">
      <i class="fa fa-arrow-left"></i> Back
    </a>
  </div>

  <div class="col-lg-8 mx-auto">
    <div class="card shadow-lg p-4 rounded-4">
      <h3 class="mb-4 text-center"><i class="fa fa-user-edit me-2"></i>Edit User</h3>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email (read-only)</label>
          <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control" rows="2" required><?= htmlspecialchars($user['address']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">New Password (optional)</label>
          <div class="input-group">
         <input type="password" name="password" class="form-control" id="passwordField" placeholder="Leave blank to keep current password">
         <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()" id="toggleBtn">
         <i class="fa fa-eye" id="toggleIcon"></i>
         </button>
    </div>
</div>

        <button type="submit" class="btn btn-success w-100">Update</button>
      </form>
    </div>
  </div>
</div>

<!-- For password hide and unhide -->
 <script>
function togglePassword() {
  const passwordField = document.getElementById("passwordField");
  const toggleIcon = document.getElementById("toggleIcon");

  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.classList.remove("fa-eye");
    toggleIcon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    toggleIcon.classList.remove("fa-eye-slash");
    toggleIcon.classList.add("fa-eye");
  }
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
