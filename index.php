<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dynamic Tour Group</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/favicon.png" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('./tour_packages/assets/bg.jpeg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: white;
    }

    .promo-glow {
      border: 2px solid #292723;
      color: #fff700;
    }

    @keyframes glow {
      from {
        box-shadow: 0 0 5px #ffc107, 0 0 10px #ffc107;
      }

      to {
        box-shadow: 0 0 15px #ffc107, 0 0 30px #ffcd39;
      }
    }

    @keyframes blink {
      50% {
        opacity: 0;
      }
    }

    .carousel-wrapper {
      max-width: 1000px;
      margin: auto;
    }

    .carousel-inner {
      max-height: 500px;
      overflow: hidden;
    }

    .carousel-inner img {
      height: 100%;
      width: 100%;
      max-height: 450px;
      object-fit: cover;
    }

    /* Modal Custom Styling */
    .modal-content {
      background: linear-gradient(135deg, #343a40 0%, #495057 100%);
      border-radius: 15px;
      color: white;
    }

    .modal-header {
      border-bottom: 1px solid #6c757d;
    }

    .modal-title {
      color: #ffc107;
    }

    .modal-body {
      font-size: 1.1rem;
      text-align: center;
      padding: 20px;
      color: #fff;
    }

    .modal-footer {
      border-top: 1px solid #6c757d;
    }

    .btn-secondary {
      background-color: #ffc107;
      color: #343a40;
    }

    .btn-close {
      background-color: transparent;
      color: #ffc107;
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
          <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link"
              href="Tour_Store/index.php">Store</a></li>
          <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link"
              href="tour_packages/tour.php">Tour</a></li>
          <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link"
              href="user/login.php">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero py-5">
    <div class="container">

      <!-- Carousel -->
      <div class="carousel-wrapper mt-4">
        <div id="offerCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner rounded-4 shadow-lg">

            <div class="carousel-item active">
              <img src="tour_packages/Srimongol/g3.jpg" class="d-block" alt="Maldives Offer" />
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h5>Maldives Paradise Escape</h5>
                <p>Save 25% on luxury resorts this Eid season!</p>
              </div>
            </div>

            <div class="carousel-item">
              <img src="tour_packages/Sundarbon/g5.jpg" class="d-block" alt="Jaflong Tour" />
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h5>Jaflong Nature Retreat</h5>
                <p>Enjoy 3 nights with food & guide – now 20% off!</p>
              </div>
            </div>

            <div class="carousel-item">
              <img src="tour_packages/Zaflong/g5.jpg" class="d-block" alt="Sundarbans Adventure" />
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h5>Sundarbans Wildlife Tour</h5>
                <p>Book with friends & get group discount up to 30%!</p>
              </div>
            </div>

          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#offerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#offerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Promo Modal -->
  <div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true"
    style="margin-top: -30px !important;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="promoModalLabel">Limited Time Offer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center fs-5 fw-semibold shadow-lg promo-glow">
          🎉 Book now and get up to <strong>30% OFF</strong> on all summer tours!
          <br>
          🌟 Flash Sale: Get 15% OFF on all bookings this week only!
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Animate Modal Script -->
  <script>
    window.addEventListener('load', function() {
      var promoModalEl = document.getElementById('promoModal');
      promoModalEl.classList.add('animate');
      var promoModal = new bootstrap.Modal(promoModalEl);
      promoModal.show();
    });
  </script>

  <!-- Footer -->
  <footer class="bg-dark text-white pt-4 mt-5">
    <div class="container text-center text-md-start">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5><i class="fas fa-rocket me-2"></i>About Us</h5>
          <p>We build modern, responsive web experiences to help you grow online.</p>
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
</body>

</html>" make in in php add session and database php config.php do the backend