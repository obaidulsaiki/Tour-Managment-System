<?php
session_start();

// Redirect to login page if user not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Optional: Include database connection or user config if needed
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shop | Dynamic Tour Group</title>
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

    .shop-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      padding: 20px;
      color: white;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      transition: 0.3s;
    }

    .shop-card:hover {
      background-color: rgba(255, 193, 7, 0.8);
      color: black;
    }

    .btn-back {
      margin-top: 20px;
    }

    footer {
      margin-top: auto;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Dynamic Tour Group</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item btn btn-outline-warning mx-2 my-2">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="col-12 col-lg-6 d-flex justify-content-start mb-3 mt-5 mx-2">
    <a href="user_panel.php" class="btn btn-light text-dark fw-bold">
      <i class="fa fa-arrow-left"></i> Back
    </a>
  </div>

  <main class="container py-5">
    <h2 class="text-center mb-4 text-warning">
      <i class="fas fa-store"></i> Item Purchased
    </h2>
    <div class="row g-4">

      <!-- Example shop item -->
      <div class="col-md-4">
        <div class="shop-card text-center">
          <i class="fas fa-suitcase-rolling fa-2x mb-3"></i>
          <h5>Travel Backpack</h5>
          <p>High-quality waterproof travel backpack for your journey.</p>
          <button class="btn btn-warning">Purchased</button>
        </div>
      </div>

    </div>
  </main>

  <footer class="bg-dark text-white pt-4">
    <div class="text-center py-3 bg-secondary mt-3">
      © 2025 Dynamic Tour Group. All rights reserved.
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>