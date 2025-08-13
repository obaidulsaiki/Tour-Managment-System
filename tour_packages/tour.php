<?php
include_once('../user/config.php');

// Get the filter and search values from the request
$type_filter = isset($_GET['type']) ? $_GET['type'] : '';
$destination_filter = isset($_GET['destination']) ? $_GET['destination'] : '';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare SQL query based on filters
$sql = "SELECT * FROM package WHERE 1=1"; // Start with '1=1' to make the AND conditions easy to append

if ($type_filter) {
    $sql .= " AND type_of_tour = '$type_filter'";
}
if ($destination_filter) {
    $sql .= " AND package_name LIKE '%$destination_filter%'";
}
if ($search_query) {
    $sql .= " AND package_name LIKE '%$search_query%'";
}

$result = $conn->query($sql);

// Function to render tour packages
function renderPackages($result)
{
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-lg">
                        <img src="' . $row['package_pic'] . '" class="card-img-top" alt="' . $row['package_name'] . '">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center">' . $row['package_name'] . '</h5>
                            <hr>
                            <p class="card-text text-center">' . $row['tour_details_1'] . '</p>
                            <div class="mt-auto d-flex justify-content-center gap-3 flex-wrap">
                                <span class="fs-6 bg-primary-subtle fw-bold shadow px-3 py-1 rounded">' . $row['price'] . '৳</span>
                                <span class="fs-6 bg-success-subtle fw-bold shadow px-3 py-1 rounded">' . $row['duration'] . '</span>
                                <a href="tourDetails.php?PID=' . $row['PID'] . '" class="btn bg-info-subtle fw-bold shadow px-3 py-1 rounded">More</a>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    } else {
        echo '<p class="text-center">No packages found.</p>';
    }
}

// Handle the "Add Package" form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_package'])) {
    $package_name = $_POST['package_name'];
    $type_of_tour = $_POST['type_of_tour'];
    $package_pic = $_POST['package_pic'];
    $duration = $_POST['duration'];
    $meals = $_POST['meals'];
    $tour_details_1 = $_POST['tour_details_1'];
    $include = $_POST['include'];
    $price = $_POST['price'];

    // Insert new package into the database
    $sql_insert = "INSERT INTO package (package_name, type_of_tour, package_pic, duration, meals, tour_details_1, `include`, price)
                   VALUES ('$package_name', '$type_of_tour', '$package_pic', '$duration', '$meals', '$tour_details_1', '$include', '$price')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('New package added successfully!'); window.location.href='tour.php';</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tour Packages</title>

    <!-- Custom Favicon -->
    <link rel="icon" type="image/png" href="assets/favicon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('assets/bg.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }

        .rotate {
            transform: rotate(-90deg);
            transition: transform 0.3s ease;
        }

        .rotate-icon {
            transition: transform 0.3s ease;
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
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link" href="../Tour_Store/index.html">Store</a></li>
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link active" href="./tour.php">Tour</a></li>
                    <li class="nav-item btn btn-outline-secondary mx-2 my-2"><a class="nav-link" href="../user/login.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Filter Section -->
    <div class="container mt-4">
        <div class="row justify-content-end">
            <div class="col-auto">
                <div class="dropdown">
                    <button id="typeDropdown" class="btn btn-secondary  d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Type <i class="fas fa-angle-left ms-2 rotate-icon " id="typeIcon"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?type=Day">Day</a></li>
                        <li><a class="dropdown-item" href="?type=Long">Long</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-auto">
                <div class="dropdown">
                    <button id="typeDropdown2" class="btn btn-secondary  d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        Destination <i class="fas fa-angle-left ms-2" id="typeIcon2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?destination=Sundarban">Sundarban</a></li>
                        <li><a class="dropdown-item" href="?destination=Cox’s Bazar">Cox’s Bazar</a></li>
                        <li><a class="dropdown-item" href="?destination=Srimangal">Srimangal</a></li>
                        <li><a class="dropdown-item" href="?destination=Chittagong">Chittagong </a></li>
                    </ul>
                </div>
            </div>

            <div class="col-auto">
                <div class="input-group">
                    <span class="input-group-text bg-white border-primary"><i class="fas fa-search text-primary"></i></span>
                    <form method="get" action="tour.php">
                        <input type="text" name="search" class="form-control border-primary" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                    <i class="fas fa-plus"></i> Add Package
                </button>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero mt-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-auto text-center">
                    <p class="fs-1 fw-bolder shadow p-3 mb-1 rounded">Tour Packages</p>
                    <hr>
                </div>
            </div>

            <div class="row g-4">
                <?php renderPackages($result); ?>
            </div>
        </div>
    </section>

    <!-- Add Package Modal -->
    <div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPackageModalLabel">Add New Tour Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color:black !important">
                    <form method="POST"
                        <form method="POST" action="tour.php">
                        <div class="mb-3">
                            <label for="package_name" class="form-label">Package Name</label>
                            <input type="text" class="form-control" id="package_name" name="package_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_of_tour" class="form-label">Type of Tour</label>
                            <select class="form-select" id="type_of_tour" name="type_of_tour" required>
                                <option value="Day">Day</option>
                                <option value="Long">Long</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="package_pic" class="form-label">Package Picture (Image File)</label>
                            <input type="text" class="form-control" id="package_pic" name="package_pic" required>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="meals" class="form-label">Meals</label>
                            <input type="text" class="form-control" id="meals" name="meals" required>
                        </div>
                        <div class="mb-3">
                            <label for="tour_details_1" class="form-label">Tour Details</label>
                            <textarea class="form-control" id="tour_details_1" name="tour_details_1" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="include" class="form-label">What is Included</label>
                            <textarea class="form-control" id="include" name="include" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_package">Add Package</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>