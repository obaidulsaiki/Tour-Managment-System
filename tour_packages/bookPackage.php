<?php
session_start();
include_once('../user/config.php');

// If not logged in, redirect to login with redirect info
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    echo "<script>alert('Please login to book a tour.'); window.location.href='../user/login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$pid = isset($_GET['PID']) ? intval($_GET['PID']) : 0;

// Validate PID
if ($pid <= 0) {
    echo "<script>alert('Invalid Package ID.'); window.location.href='tour.php';</script>";
    exit;
}

// Create booking
$booking_date = date("Y-m-d");
$travel_date = date("Y-m-d", strtotime("+7 days"));  // Default travel date
$number_of_guests = 1;
$status = "Booked";

$sql = "INSERT INTO booking (user_id, tour_id, booking_date, number_of_guests, travel_date, status)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissss", $user_id, $pid, $booking_date, $number_of_guests, $travel_date, $status);

if ($stmt->execute()) {
    echo "<script>alert('Booking successful!'); window.location.href='tour.php';</script>";
} else {
    echo "<script>alert('Booking failed.'); window.location.href='package_details.php?PID=$pid';</script>";
}
