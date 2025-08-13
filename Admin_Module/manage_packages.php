<?php
include 'config.php';

// Fetch packages
$result = $conn->query("SELECT * FROM package ORDER BY PID DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Tour Packages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-image: url('images/bg.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
    }
</style>
<body>

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

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="admin_panel.html" class="btn btn-light fw-bold">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <a href="add_package.php" class="btn btn-success fw-bold">➕ Add New Package</a>
    </div>

    <h2 class="text-center mb-4">📦 Manage Tour Packages</h2>
    <table class="table table-bordered table-striped table-hover bg-white text-dark">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Package Name</th>
                <th>Type</th>
                <th>Duration</th>
                <th>Meals</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['PID'] ?></td>
                    <td><?= htmlspecialchars($row['package_name']) ?></td>
                    <td><?= $row['type_of_tour'] ?></td>
                    <td><?= $row['duration'] ?></td>
                    <td><?= htmlspecialchars($row['meals']) ?></td>
                    <td>
                        <a href="edit_package.php?id=<?= $row['PID'] ?>" class="btn btn-sm btn-primary">Edit</a>

                        <a href="delete_package.php?id=<?= $row['PID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this package?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
