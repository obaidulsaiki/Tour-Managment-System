<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('No package ID provided.'); window.location.href='manage_packages.php';</script>";
    exit;
}

$id = $_GET['id'];

// Optional: delete image file from server here (if desired)

$stmt = $conn->prepare("DELETE FROM package WHERE PID = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('🗑️ Package deleted successfully.'); window.location.href='manage_packages.php';</script>";
} else {
    echo "<script>alert('❌ Failed to delete package.'); window.location.href='manage_packages.php';</script>";
}

$stmt->close();
$conn->close();
?>

