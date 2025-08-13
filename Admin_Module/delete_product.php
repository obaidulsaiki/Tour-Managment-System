<?php
include 'config.php';

if (!isset($_GET['PrID'])) {
    echo "<script>alert('No product ID provided.'); window.location.href='manage_shop.php';</script>";
    exit;
}

$PrID = $_GET['PrID'];

$stmt = $conn->prepare("DELETE FROM product WHERE PrID = ?");
$stmt->bind_param("i", $PrID);

if ($stmt->execute()) {
    echo "<script>alert('🗑️ Product deleted successfully!'); window.location.href='manage_shop.php';</script>";
} else {
    echo "<script>alert('❌ Failed to delete product.'); window.location.href='manage_shop.php';</script>";
}
?>
