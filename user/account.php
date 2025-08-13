<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, phone, address FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $phone, $address);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Personal Info | Dynamic Tour Group</title>
  <link rel="icon" type="image/png" href="../tour_packages/assets/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-image: url('./images/userBG.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: white;
      font-family: 'Segoe UI', sans-serif;
    }

    .glass-box {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      padding: 30px;
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.2);
      max-width: 600px;
      margin: auto;
    }

    .glass-box h2 {
      margin-bottom: 30px;
      color: #ffc107;
    }

    .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .info-item i {
      font-size: 24px;
      margin-right: 15px;
      color: #ffc107;
      width: 30px;
    }

    .info-item span {
      font-weight: 600;
    }

    .edit-btn {
      margin-top: 20px;
      background-color: #ffc107;
      color: black;
      font-weight: 600;
    }

    .edit-btn:hover {
      background-color: #e0a800;
    }

    footer {
      margin-top: auto;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Dynamic Tour Group</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item btn btn-outline-secondary mx-2 my-2">
            <a class="nav-link" href="../user/user_panel.php">Back</a>
          </li>
          <li class="nav-item btn btn-outline-warning mx-2 my-2">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="flex-grow-1 container py-5">
    <div class="glass-box text-white fw-bold">
      <h2 class="text-center"><i class="fas fa-user"></i> Personal Information</h2>
      <div class="info-item">
        <i class="fas fa-user"></i>
        <span>Username:</span> &nbsp; <?= htmlspecialchars($name) ?>
      </div>

      <div class="info-item">
        <i class="fas fa-envelope"></i>
        <span>Email:</span> &nbsp; <?= htmlspecialchars($email) ?>
      </div>

      <div class="info-item">
        <i class="fas fa-phone"></i>
        <span>Phone:</span> &nbsp; <?= htmlspecialchars($phone) ?>
      </div>

      <div class="info-item">
        <i class="fas fa-map-marker-alt"></i>
        <span>Address:</span> &nbsp; <?= htmlspecialchars($address) ?>
      </div>

      <div class="text-center">
        <a href="edit_profile.php" class="btn edit-btn"><i class="fas fa-edit"></i> Edit Info</a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white pt-4">
    <div class="text-center py-3 bg-secondary mt-3">
      © 2025 Dynamic Tour Group. All rights reserved.
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>