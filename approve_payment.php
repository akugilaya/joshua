<?php
// Start session
session_start();

// Include database configuration
include('config.php');

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];

    // Sanitize the ID to avoid SQL injection
    $payment_id = intval($payment_id);

    // Update the payment status to "approved"
    $sql = "UPDATE payments SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $payment_id);

    if ($stmt->execute()) {
        // Redirect to the payments page with a success message
        $_SESSION['message'] = "Pembayaran berhasil disetujui.";
        header("Location: admin_payments.php");
        exit();
    } else {
        // Error handling
        $_SESSION['error'] = "Terjadi kesalahan saat menyetujui pembayaran.";
        header("Location: admin_payments.php");
        exit();
    }
} else {
    // If no ID is provided, redirect to the payments page
    $_SESSION['error'] = "ID pembayaran tidak ditemukan.";
    header("Location: admin_payments.php");
    exit();
}
?>
