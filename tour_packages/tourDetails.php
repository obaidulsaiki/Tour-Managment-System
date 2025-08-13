<?php
include_once('../user/config.php');

if (!isset($_GET['PID'])) {
    echo "<script>alert('Package ID not provided.'); window.location.href='tour.php';</script>";
    exit;
}

$pid = $_GET['PID'];
$sql = "SELECT * FROM package WHERE PID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Package not found.'); window.location.href='tour.php';</script>";
    exit;
}

$package = $result->fetch_assoc();

// Check if the package is already in the wishlist for the current user
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $favorite_sql = "SELECT * FROM wishlist WHERE user_id = ? AND package_id = ?";
    $favorite_stmt = $conn->prepare($favorite_sql);
    $favorite_stmt->bind_param("ii", $user_id, $pid);
    $favorite_stmt->execute();
    $favorite_result = $favorite_stmt->get_result();
    $is_favorite = $favorite_result->num_rows > 0;
} else {
    $is_favorite = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($package['package_name']); ?> - Package Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/favicon.png">

    <style>
        body {
            background-image: url('assets/bg.jpeg');
            background-size: cover;
            background-attachment: fixed;
            color: white;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        .card img {
            max-height: 400px;
            object-fit: cover;
        }

        .favorite-btn {
            margin-top: 10px;
        }
    </style>
</head>

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
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link" href="../index.html">Home</a></li>
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link" href="../Tour_Store/index.html">Store</a></li>
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link" href="./tour.php">Tour</a></li>
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link" href="../user/login.html">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Package Details -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <img src="assets/<?php echo htmlspecialchars($package['package_pic']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($package['package_name']); ?>">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3"><?php echo htmlspecialchars($package['package_name']); ?></h2>
                        <hr>
                        <p><strong>Type of Tour:</strong> <?php echo htmlspecialchars($package['type_of_tour']); ?></p>
                        <p><strong>Duration:</strong> <?php echo htmlspecialchars($package['duration']); ?></p>
                        <p><strong>Meals:</strong> <?php echo htmlspecialchars($package['meals']); ?></p>
                        <p><strong>Tour Details:</strong><br><?php echo nl2br(htmlspecialchars($package['tour_details_1'])); ?></p>
                        <p><strong>Includes:</strong><br><?php echo nl2br(htmlspecialchars($package['include'])); ?></p>
                        <h4 class="text-end text-success fw-bold">Price: <?php echo htmlspecialchars($package['price']); ?> ৳</h4>
                        <div class="text-center mt-4">
                            <a href="tour.php" class="btn btn-outline-light"><i class="fas fa-arrow-left"></i> Back to Packages</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Favorite and Book Now Buttons -->
    <div class="text-center mt-4">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="toggleWishlist.php?PID=<?php echo $package['PID']; ?>" class="btn btn-<?php echo $is_favorite ? 'danger' : 'outline-primary'; ?> favorite-btn">
                <i class="fas fa-heart"></i> <?php echo $is_favorite ? 'Remove from Wishlist' : 'Add to Wishlist'; ?>
            </a>
        <?php endif; ?>
        <a href="bookPackage.php?PID=<?php echo $package['PID']; ?>" class="btn btn-success"><i class="fas fa-check-circle"></i> Book Now</a>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-white py-3 mt-5">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Dynamic Tour Group. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>