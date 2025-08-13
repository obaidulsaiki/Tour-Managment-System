<?php
session_start();
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = $error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    if ($name && $email && $phone && $address) {
        $sql = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $phone, $address, $user_id);

        if ($stmt->execute()) {
            $success = "Profile updated successfully.";
        } else {
            $error = "Failed to update profile.";
        }
        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
}

// Fetch current user info
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
    <title>Edit Profile | Dynamic Tour Group</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
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

        .form-label {
            font-weight: 600;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            border: none;
            border-radius: 10px;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.4);
            color: white;
        }

        .btn-warning {
            font-weight: bold;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Dynamic Tour Group</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2">
                        <a class="nav-link" href="account.php">Back</a>
                    </li>
                    <li class="nav-item btn btn-outline-warning mx-2 my-2">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="glass-box text-white">
            <h2 class="text-center mb-4"><i class="fas fa-edit"></i> Edit Profile</h2>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php elseif ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($name) ?>" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($phone) ?>" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($address) ?>" required />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-warning px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-4 mt-auto">
        <div class="text-center py-3 bg-secondary mt-3">
            © 2025 Dynamic Tour Group. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>