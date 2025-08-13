<?php
session_start();


// Example user session check (optional redirect)
 if (!isset($_SESSION['user_id'])) {
         header("Location: login.php");
     exit(); }
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Store</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        #carouselExampleCaptions {
            margin-top: 2rem;
            position: relative;
            display: flex;
            justify-content: center;
        }
        #carouselExampleCaptions .carousel-inner {
            max-width: 70%;
        }
        .carousel-item img {
            max-height: 450px;
            max-width: 100%;
            object-fit: cover;
            margin: 0 auto;
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }
        .carousel-control-prev { left: calc(15%); }
        .carousel-control-next { right: calc(15%); }
        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 1rem;
            border-radius: 0.5rem;
        }
        body { background-color: #f8f9fa; }
        .card-title { font-weight: 600; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand me-3" href="#">Dynamic Tour Group</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center ms-auto gap-3 flex-column flex-lg-row">
                <ul class="navbar-nav d-flex flex-row align-items-center">
                    <li class="nav-item mx-2 my-2"><a class="btn btn-outline-secondary" href="../index.php">Home</a></li>
                    <li class="nav-item mx-2 my-2"><a class="btn btn-outline-secondary active" href="#">Store</a></li>
                    <li class="nav-item mx-2 my-2"><a class="btn btn-outline-secondary" href="../tour_packages/tour.php">Tour</a></li>
                    <li class="nav-item mx-2 my-2"><a class="btn btn-outline-secondary" href="../user/user_panel.php">Profile</a></li>
                    <li class="nav-item mx-2 my-2">
                        <a class="btn btn-outline-secondary d-flex align-items-center" href="#">
                            <i class="bi bi-cart me-1"></i> Cart
                        </a>
                    </li>
                    <?php$username = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'User';?> 
                        <li class="nav-item mx-2 my-2"><a class="btn btn-outline-success" href="#">Welcome, <?php echo $username ?></a></li>
                        <li class="nav-item mx-2 my-2"><a class="btn btn-outline-danger" href="logout.php">Logout</a></li>
                        <li class="nav-item mx-2 my-2"><a class="btn btn-outline-light" href="login.php">Login</a></li>
                </ul>

                <form class="d-flex mt-2 mt-lg-0" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search Products" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Carousel -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/backpack2.avif" class="d-block w-100" alt="Trekking backpack">
            <div class="carousel-caption d-none d-md-block">
                <h2>Trekking Backpack</h2>
                <p>A trekking backpack is an essential piece of gear for any hiking.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/T_Shirt11.jpg" class="d-block w-100" alt="Trekking T-Shirt">
            <div class="carousel-caption d-none d-md-block">
                <h2>Trekking T-Shirt</h2>
                <p>A trekking T-shirt combines breathable comfort and performance for the ultimate trail experience.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/tent6.jpg" class="d-block w-100" alt="Camping Tent">
            <div class="carousel-caption d-none d-md-block">
                <h2>Camping Tent</h2>
                <p>Camping tent is a portable shelter that provides protection and comfort.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Products Section -->
<section class="hero mt-5">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-auto text-center">
                <p class="fs-1 fw-bolder shadow p-3 mb-1 rounded bg-success">Grab Your Desired Products</p>
                <hr>
            </div>
        </div>
        <div class="row g-4">
            <!-- Card Example: Backpack -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-lg">
                    <img src="images/backpack.jpg" class="card-img-top" alt="backpack">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">Trekking Backpack</h5>
                        <hr>
                        <p class="card-text text-center">Essential gear for any hiking or outdoor adventure.</p>
                        <div class="mt-auto d-flex justify-content-center gap-3 flex-wrap">
                            <span class="fs-6 bg-primary-subtle fw-bold shadow px-3 py-1 rounded">5000৳</span>
                            <span class="fs-6 bg-success-subtle fw-bold shadow px-3 py-1 rounded">Add to Cart</span>
                            <a href="backpack_more.html" class="btn bg-info-subtle fw-bold shadow px-3 py-1 rounded">More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeat other product cards as needed -->
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white pt-4 mt-5">
    <div class="container text-center text-md-start">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5><i class="fas fa-rocket me-2"></i>About Us</h5>
                <p>Dynamic Tour Store is your one-stop destination for all essential travel and outdoor adventure gear...</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Store</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Tour</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Profile</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Follow Us</h5>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
            </div>
        </div>
    </div>
    <div class="text-center py-3 bg-secondary mt-3">
        © 2025 Dynamic Tour Group. All rights reserved.
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
