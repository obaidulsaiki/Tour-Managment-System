<?php
session_start();
include("config.php");

if (!isset($_GET['pid'])) {
  echo "Package ID not provided.";
  exit();
}

$pid = $_GET['pid'];
$sql = "SELECT package_name, duration, tour_details_1, include FROM package WHERE PID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo "Package not found.";
  exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>More Details | Dynamic Tour Group</title>
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

    .details-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.2);
      max-width: 900px;
      margin: auto;
    }

    h2,
    h4 {
      color: #ffc107;
      margin-top: 20px;
    }

    ul {
      padding-left: 1.2rem;
    }

    ul li {
      margin-bottom: 0.5rem;
    }

    .btn-back {
      margin-top: 30px;
    }

    footer {
      margin-top: auto;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Dynamic Tour Group</a>
      <a class="btn btn-outline-light" href="tour.php"><i class="fas fa-arrow-left"></i> Back to Tours</a>
    </div>
  </nav>

  <main class="container py-5">
    <div class="details-container">
      <h2><i class="fas fa-map-marker-alt" style="color: red;"></i> <?= htmlspecialchars($row['package_name']) ?></h2>
      <p><?= nl2br(htmlspecialchars($row['tour_details_1'])) ?></p>

      <h4>🏨 Accommodation</h4>
      <p>Standard A/C rooms with breakfast included.</p>

      <h4>✅ Inclusions</h4>
      <ul>
        <?php
        $includes = explode(',', $row['include']);
        foreach ($includes as $item) {
          echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
        }
        ?>
      </ul>

      <h4>❌ Exclusions</h4>
      <ul>
        <li>Personal shopping</li>
        <li>Extra meals not mentioned</li>
        <li>Tips for guide/driver</li>
      </ul>

      <h4>📌 Terms & Conditions</h4>
      <ul>
        <li>Advance payment required to confirm booking</li>
        <li>Non-refundable for cancellations within 5 days of travel</li>
        <li>Tour availability depends on weather and road conditions</li>
      </ul>

      <a class="btn btn-warning btn-back" href="user_panel.php"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
  </main>

  <footer class="bg-dark text-white pt-4">
    <div class="text-center py-3 bg-secondary mt-3">
      © 2025 Dynamic Tour Group. All rights reserved.
    </div>
  </footer>

</body>

</html>