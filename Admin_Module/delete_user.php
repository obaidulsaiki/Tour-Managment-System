<?php
include 'config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<script>alert('✅ User deleted successfully'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('❌ Error deleting user: " . $stmt->error . "'); window.location.href='manage_users.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('❌ Invalid user ID'); window.location.href='manage_users.php';</script>";
}
?>
