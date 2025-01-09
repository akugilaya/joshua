<?php
// Start session
session_start();

// Include database configuration
include('config.php');

// Fetch payments
$sql = "SELECT * FROM payments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lihat Pembayaran</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Daftar Konfirmasi Pembayaran</h2>
        <table class="table table-bordered table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Nomor HP</th>
                    <th>Alamat</th>
                    <th>Bukti Pembayaran</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= nl2br(htmlspecialchars($row['address'])); ?></td>
                            <td>
                                <a href="uploads/payments/<?= $row['payment_proof']; ?>" target="_blank">
                                    <img src="uploads/payments/<?= $row['payment_proof']; ?>" alt="Bukti Pembayaran" style="max-width: 100px; height: auto;">
                                </a>
                            </td>
                            <td><?= $row['created_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada konfirmasi pembayaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
