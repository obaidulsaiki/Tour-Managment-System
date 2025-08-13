<?php
session_start();
include("../user/config.php");

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Fetch bookings with joined package info
$sql = "SELECT 
            b.booking_id,
            b.booking_date,
            b.travel_date,
            b.number_of_guests,
            b.status,
            p.package_name,
            p.type_of_tour,
            p.price
        FROM booking b
        JOIN package p ON b.tour_id = p.PID
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Booked Tours | Dynamic Tour Group</title>
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

    .booking-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      padding: 20px;
      color: white;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      transition: 0.3s;
    }

    .booking-card:hover {
      transform: scale(1.08);
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
          <li class="nav-item btn btn-outline-secondary mx-2 my-2">
            <a class="nav-link" href="user_panel.php">Back</a>
          </li>
          <li class="nav-item btn btn-outline-warning mx-2 my-2">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-5">
    <h2 class="text-center mb-4 text-warning"><i class="fas fa-calendar-check"></i> Booked Tours</h2>
    <div class="row g-4">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="col-md-4">
            <div class="booking-card">
              <h5><?php echo htmlspecialchars($row['package_name']); ?></h5>
              <p><strong>Date:</strong> <?php echo date('d M Y', strtotime($row['booking_date'])); ?></p>
              <p><strong>Tour type:</strong> <?php echo htmlspecialchars($row['type_of_tour']); ?></p>
              <p><strong>Guests:</strong> <?php echo $row['number_of_guests']; ?></p>
              <p><strong>Amount Paid:</strong> tk <?php echo $row['number_of_guests'] * $row['price']; ?></p>
              <a href="view_details.php?booking_id=<?php echo $row['booking_id']; ?>" class="btn btn-light">View Details</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center text-light">No bookings found.</p>
      <?php endif; ?>
    </div>
  </main>

  <footer class="bg-dark text-white pt-4">
    <div class="text-center py-3 bg-secondary mt-3">
      © 2025 Dynamic Tour Group. All rights reserved.
    </div>
  </footer>
</body>

</html>