<?php
include_once('../user/config.php');

// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to add to the wishlist.'); window.location.href='login.html';</script>";
    exit;
}

// Get the package ID from the URL
if (!isset($_GET['PID'])) {
    echo "<script>alert('Package ID not provided.'); window.location.href='tour.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$pid = $_GET['PID'];

// Check if the package is already in the wishlist
$sql = "SELECT * FROM wishlist WHERE user_id = ? AND package_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $pid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Package already in the wishlist, so remove it
    $delete_sql = "DELETE FROM wishlist WHERE user_id = ? AND package_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $user_id, $pid);
    $delete_stmt->execute();

    echo "<script>alert('Package removed from your wishlist.'); window.location.href='tourDetails.php?PID=$pid';</script>";
} else {
    // Package not in the wishlist, so add it
    $insert_sql = "INSERT INTO wishlist (user_id, package_id, created_at) VALUES (?, ?, NOW())";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $user_id, $pid);
    $insert_stmt->execute();

    echo "<script>alert('Package added to your wishlist.'); window.location.href='tourDetails.php?PID=$pid';</script>";
}
