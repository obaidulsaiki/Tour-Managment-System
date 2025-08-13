<?php
session_start();

// Database connection
include 'config.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Fetch wishlist items for the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT w.id, p.package_name, p.package_pic, p.duration, p.price
        FROM wishlist w
        JOIN package p ON w.package_id = p.PID
        WHERE w.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Add item to wishlist
if (isset($_POST['add_to_wishlist'])) {
    $package_id = $_POST['package_id'];
    $sql = "INSERT INTO wishlist (user_id, package_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $package_id);
    if ($stmt->execute()) {
        header("Location: wishlist.php");
        exit;
    }
}

// Remove item from wishlist
if (isset($_GET['remove'])) {
    $wishlist_id = $_GET['remove'];
    $sql = "DELETE FROM wishlist WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $wishlist_id, $user_id);
    if ($stmt->execute()) {
        header("Location: wishlist.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wishlist | Dynamic Tour Group</title>
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
            font-family: 'Segoe UI', sans-serif;
            color: white;
        }

        .wishlist-container {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .wishlist-item {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .wishlist-item img {
            width: 120px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 15px;
        }

        .wishlist-info h5 {
            margin: 0;
            color: #ffc107;
        }

        .wishlist-info p {
            margin: 0;
            font-size: 0.9rem;
        }

        .btn-remove {
            background-color: #dc3545;
            border: none;
            color: white;
        }

        .btn-remove:hover {
            background-color: #b02a37;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Dynamic Tour Group</a>
            <a class="btn btn-outline-light" href="user_panel.php"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </nav>

    <!-- Wishlist Content -->
    <main class="container py-5">
        <div class="wishlist-container">
            <h2 class="text-center text-warning mb-4"><i class="fas fa-heart"></i> Your Wishlist</h2>

            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="wishlist-item">
                        <div class="d-flex align-items-center">
                            <img src="../tour_packages/<?php echo $row['package_pic']; ?>" alt="<?php echo $row['package_name']; ?>" />
                            <div class="wishlist-info">
                                <h5><?php echo $row['package_name']; ?></h5>
                                <p><?php echo $row['duration']; ?> | From tk <?php echo $row['price']; ?></p>
                            </div>
                        </div>
                        <div>
                            <a href="../tour_packages/<?php echo $row['package_name']; ?>/<?php echo $row['package_name']; ?>_more.html" class="btn btn-outline-warning btn-sm">View</a>
                            <a href="wishlist.php?remove=<?php echo $row['id']; ?>" class="btn btn-remove btn-sm"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="text-center text-warning">No items in your wishlist.</p>
            <?php endif; ?>

            <div class="text-end">
                <a href="book.html" class="btn btn-warning mt-3">Proceed to Booking</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-4">
        <div class="text-center py-3 bg-secondary mt-3">
            © 2025 Dynamic Tour Group. All rights reserved.
        </div>
    </footer>

</body>

</html>