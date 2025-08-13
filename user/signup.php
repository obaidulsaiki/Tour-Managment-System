<?php
include 'config.php';

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string(trim($_POST["name"]));
    $email = $conn->real_escape_string(trim($_POST["email"]));
    $phone = $conn->real_escape_string(trim($_POST["phone"]));
    $address = $conn->real_escape_string(trim($_POST["address"]));
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $sql = "INSERT INTO users (name, email, phone, address, password) 
                VALUES ('$name', '$email', '$phone', '$address', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            $success = "Registration successful!";
            header("Location: login.html");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Dynamic Tour Group</title>

    <link rel="icon" type="image/png" href="../tour_packages/assets/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background-image: url('../tour_packages/assets/bg.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid #ccc;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.75);
            border: none;
        }

        .form-check-label {
            color: #ccc;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 col-lg-6">
            <div class="card p-4 shadow-lg rounded-4">
                <h3 class="text-center mb-4 text-white"><i class="fas fa-user-plus me-2"></i>Create Account</h3>

                <!-- Show error or success messages -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label text-white">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required />
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label text-white">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g., 0123456789" required />
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label text-white">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="Your address" required></textarea>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" class="form-control pe-5" name="password" id="password" placeholder="Create password" required />
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3 mt-3" style="cursor: pointer;" onclick="togglePassword('password', 'icon1')">
                            <i class="fa-solid fa-eye" id="icon1"></i>
                        </span>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="confirmPassword" class="form-label text-white">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control pe-5" id="confirmPassword" placeholder="Re-enter password" required />
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3 mt-3" style="cursor: pointer;" onclick="togglePassword('confirmPassword', 'icon2')">
                            <i class="fa-solid fa-eye" id="icon2"></i>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>

                <div class="text-center mt-3 text-white">
                    Already have an account?
                    <a href="login.html" class="text-white text-decoration-none">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>