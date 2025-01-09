<?php
// Start session
session_start();

// Include database configuration
include('config.php');

// Fetch order details by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM payments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
} else {
    echo "<script>alert('Pesanan tidak ditemukan!'); window.location.href = 'minuman.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 12px 12px 0 0;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">Detail Pesanan</h2>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Struk Pesanan</h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> <?= htmlspecialchars($order['name']); ?></p>
                <p><strong>Alamat:</strong> <?= nl2br(htmlspecialchars($order['address'])); ?></p>
                <p><strong>No HP:</strong> <?= htmlspecialchars($order['phone']); ?></p>
                <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($order['payment_method']); ?></p>
                <p><strong>Status Pembayaran:</strong> <span class="badge bg-<?php 
                    echo $order['status'] === 'Approved' ? 'success' : ($order['status'] === 'Rejected' ? 'danger' : 'warning'); ?>">
                    <?= htmlspecialchars($order['status']); ?>
                </span></p>
                <?php if ($order['payment_method'] !== 'COD' && $order['payment_proof']): ?>
                    <p><strong>Bukti Pembayaran:</strong></p>
                    <a href="<?= htmlspecialchars($order['payment_proof']); ?>" target="_blank">
                        <img src="<?= htmlspecialchars($order['payment_proof']); ?>" alt="Bukti Pembayaran" style="max-width: 200px; border-radius: 10px;">
                    </a>
                <?php endif; ?>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="minuman.php" class="btn btn-secondary">Kembali ke Daftar Minuman</a>
                    <a href="rating.php?name=<?= urlencode($order['name']); ?>" class="btn btn-primary">Beri Rating Website</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
