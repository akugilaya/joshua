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
    <title>Admin Panel - Konfirmasi Pembayaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            flex-shrink: 0;
            padding: 20px;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .card img {
            max-width: 100px;
            height: auto;
        }
        .table img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <hr>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_payments.php" class="active">Konfirmasi Pembayaran</a>
        <a href="admin_products.php">Manajemen Produk</a>
        <a href="index.php">Keluar</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2 class="mb-4">Daftar Konfirmasi Pembayaran</h2>

        <!-- Payment Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pembayaran</h5>
                        <p class="card-text">Jumlah: <strong><?= $result->num_rows; ?></strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Review</h5>
                        <p class="card-text">Jumlah: <strong>
                            <?php
                            $pending_sql = "SELECT COUNT(*) as pending_count FROM payments WHERE status = 'Pending'";
                            $pending_result = $conn->query($pending_sql);
                            $pending_row = $pending_result->fetch_assoc();
                            echo $pending_row['pending_count'];
                            ?>
                        </strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th>Metode Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
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
                                <td><?= htmlspecialchars($row['payment_method']); ?></td>
                                <td>
                                    <?php if ($row['payment_method'] !== 'COD' && $row['payment_proof']): ?>
                                        <a href="uploads/payment_proofs/<?= $row['payment_proof']; ?>" target="_blank">
                                            <img src="uploads/payment_proofs/<?= $row['payment_proof']; ?>" alt="Bukti Pembayaran">
                                        </a>
                                    <?php else: ?>
                                        Tidak Ada Bukti
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td><?= $row['created_at']; ?></td>
                                <td>
                                    <?php if ($row['status'] === 'Pending'): ?>
                                        <a href="approve_payment.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                        <a href="reject_payment.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Belum ada konfirmasi pembayaran.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
