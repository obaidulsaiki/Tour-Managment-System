<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "admin@gmail.com" && $password == "admin123") {
        $_SESSION['user_name'] = "Admin";
        $_SESSION['user_type'] = "admin";
        echo "<script>alert('✅ Admin login successful!'); window.location.href='../Admin_Module/admin_panel.html';</script>";
        exit;
    }

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $name, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            session_regenerate_id(true); // For security
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $name;
            echo "<script>alert('✅ Login successful!'); window.location.href='user_panel.php';</script>";
        } else {
            echo "<script>alert('❌ Invalid password'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ Email not registered'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!-- Login HTML form below -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Dynamic Tour Group</title>
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

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            border: none;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid #ccc;
        }

        .form-control::placeholder {
            color: white;
        }

        .form-check-label {
            color: #ccc;
        }
    </style>
</head>

<body>

    <div class="container login-container">
        <div class="col-md-6 col-lg-4">
            <div class="card p-4 shadow-lg rounded-4">
                <h3 class="text-center mb-4 text-white"><i class="fas fa-sign-in-alt me-2"></i>Login</h3>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" class="form-control pe-5" id="password" name="password" placeholder="Password" required />
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3 mt-3" style="cursor: pointer;" onclick="togglePassword()">
                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                        </span>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" />
                        <label class="form-check-label text-white" for="rememberMe">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="#" class="text-white text-decoration-none">Forgot password?</a>
                </div>
                <div class="text-center mt-2">
                    <span class="text-white">Don't have an account?</span>
                    <a href="signup.php" class="text-white text-decoration-none">Create one</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.getElementById("togglePasswordIcon");
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }
    </script>

</body>

</html>