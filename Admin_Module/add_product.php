<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand_name      = $_POST['brand_name'];
    $product_name    = $_POST['product_name'];
    $color_available = $_POST['color_available'];
    $size_available  = $_POST['size_available'];
    $quantity        = $_POST['quantity'];
    $price           = $_POST['price'];


    // Handle image upload
    $product_image = '';
    if ($_FILES['product_image']['name']) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $product_image = $target_dir . basename($_FILES["product_image"]["name"]);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $product_image);
    }

    $stmt = $conn->prepare("INSERT INTO product (brand_name, product_name, product_image, color_available, size_available, quantity, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssid", $brand_name, $product_name, $product_image, $color_available, $size_available, $quantity, $price);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Product added successfully!'); window.location.href='manage_shop.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to add product.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Product</title>
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

    .card {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid #ccc;
    }

    .form-control::placeholder {
        color: #bbb;
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
  <div class="col-12 col-lg-6 d-flex justify-content-start mb-3">
    <a href="manage_shop.php" class="btn btn-info text-dark fw-bold"><i class="fa fa-arrow-left"></i> Back</a>
  </div>

  <div class="col-md-10 col-lg-8 mx-auto">
    <div class="card p-4 rounded-4">
      <h3 class="text-center text-white mb-4">➕ Add New Product</h3>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label text-white">Brand Name</label>
          <input type="text" name="brand_name" class="form-control" required />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Product Name</label>
          <input type="text" name="product_name" class="form-control" required />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Product Image</label>
          <input type="file" name="product_image" class="form-control" accept="image/*" />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Color Available</label>
          <input type="text" name="color_available" class="form-control" />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Size Available</label>
          <input type="text" name="size_available" class="form-control" />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Quantity</label>
          <input type="number" name="quantity" class="form-control" required min="0"/>
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Price</label>
          <input type="number" step="0.01" name="price" class="form-control" required  min="0"/>
        </div>

        <button type="submit" class="btn btn-success w-100 fw-bold">Add Product</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
