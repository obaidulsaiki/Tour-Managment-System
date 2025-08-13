<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('No package ID provided.'); window.location.href='manage_packages.php';</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM package WHERE PID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$package = $result->fetch_assoc();

if (!$package) {
    echo "<script>alert('Package not found.'); window.location.href='manage_packages.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_name    = $_POST['package_name'];
    $type_of_tour    = $_POST['type_of_tour'];
    $duration        = $_POST['duration'];
    $meals           = $_POST['meals'];
    $tour_details_1  = $_POST['tour_details_1'];
    $tour_details_2  = $_POST['tour_details_2'];
    $tour_details_3  = $_POST['tour_details_3'];
    $include         = $_POST['include'];

    // Handle new image upload
    $package_pic = $package['package_pic'];
    if ($_FILES['package_pic']['name']) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $package_pic = $target_dir . basename($_FILES["package_pic"]["name"]);
        move_uploaded_file($_FILES["package_pic"]["tmp_name"], $package_pic);
    }

    $stmt = $conn->prepare("UPDATE package SET package_name=?, type_of_tour=?, package_pic=?, duration=?, meals=?, tour_details_1=?, tour_details_2=?, tour_details_3=?, `include`=? WHERE PID=?");
    $stmt->bind_param("sssssssssi", $package_name, $type_of_tour, $package_pic, $duration, $meals, $tour_details_1, $tour_details_2, $tour_details_3, $include, $id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Package updated successfully!'); window.location.href='manage_packages.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to update package.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Tour Package</title>
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

<div class="container mt-5">
  <div class="col-12 col-lg-6 d-flex justify-content-start mb-3">
    <a href="manage_packages.php" class="btn btn-light text-dark fw-bold"><i class="fa fa-arrow-left"></i> Back</a>
  </div>

  <div class="col-md-10 col-lg-8 mx-auto">
    <div class="card p-4 rounded-4">
      <h3 class="text-center text-white mb-4">✏️ Edit Tour Package</h3>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label text-white">Package Name</label>
          <input type="text" name="package_name" class="form-control" value="<?= htmlspecialchars($package['package_name']) ?>" required />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Type of Tour</label>
          <select name="type_of_tour" class="form-select" required>
            <option class="text-dark" value="">-- Select Type --</option>
            <option class="text-dark" value="Day" <?= $package['type_of_tour'] == 'Day' ? 'selected' : '' ?>>Day</option>
            <option class="text-dark" value="Long" <?= $package['type_of_tour'] == 'Long' ? 'selected' : '' ?>>Long</option>
            <option class="text-dark" value="Day Long" <?= $package['type_of_tour'] == 'Day Long' ? 'selected' : '' ?>>Day Long</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Change Image (optional)</label>
          <input type="file" name="package_pic" class="form-control" accept="image/*" />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Duration</label>
          <input type="text" name="duration" class="form-control" value="<?= htmlspecialchars($package['duration']) ?>" required />
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Meals</label>
          <textarea name="meals" class="form-control"><?= htmlspecialchars($package['meals']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Tour Details 1</label>
          <textarea name="tour_details_1" class="form-control"><?= htmlspecialchars($package['tour_details_1']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Tour Details 2</label>
          <textarea name="tour_details_2" class="form-control"><?= htmlspecialchars($package['tour_details_2']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Tour Details 3</label>
          <textarea name="tour_details_3" class="form-control"><?= htmlspecialchars($package['tour_details_3']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-white">Includes</label>
          <textarea name="include" class="form-control"><?= htmlspecialchars($package['include']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-warning w-100 fw-bold">Update Package</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
