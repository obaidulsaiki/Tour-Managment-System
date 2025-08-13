<?php
include 'config.php';

// Fetch products
$result = $conn->query("SELECT * FROM product ORDER BY PrID DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../tour_packages/assets/favicon.png" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
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
        <a href="add_product.php" class="btn btn-success fw-bold">➕ Add New Product</a>
    </div>

    <h2 class="text-center mb-4">🛍️ Manage Shop Products</h2>
    <table class="table table-bordered table-striped table-hover bg-white text-dark">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Product</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['PrID'] ?></td>
                    <td><?= htmlspecialchars($row['brand_name']) ?></td>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td><?= htmlspecialchars($row['color_available']) ?></td>
                    <td><?= htmlspecialchars($row['size_available']) ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= number_format($row['price'], 2) ?></td>
                    <td>
                        <?php if (!empty($row['product_image'])): ?>
                            <img src="<?= htmlspecialchars($row['product_image']) ?>" alt="Product Image" width="50">
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_product.php?PrID=<?= $row['PrID'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="delete_product.php?PrID=<?= $row['PrID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
