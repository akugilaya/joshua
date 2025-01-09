<?php
include('config.php');

$transaction_id = intval($_GET['transaksi_id'] ?? 0);

// Ambil data transaksi
$query = "SELECT t.*, c.name AS customer_name, c.address AS customer_address 
          FROM transaksi t 
          JOIN customers c ON t.customer_id = c.id 
          WHERE t.id = $transaction_id";
$result = $conn->query($query);

if (!$result) {
    die("Error executing query for transaction data: " . $conn->error);
}

$transaction = $result->fetch_assoc();

if (!$transaction) {
    die("Transaksi tidak ditemukan!");
}

// Ambil detail transaksi
$query_details = "SELECT product_name, harga, quantity 
                  FROM transaksi_detail 
                  WHERE transaksi_id = $transaction_id";
$details = $conn->query($query_details);

if (!$details) {
    die("Error executing query for transaction details: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Selesai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Pesanan Selesai</h1>
        <p>Terima kasih atas pesanan Anda!</p>
        <h3>Detail Pembeli</h3>
        <p>Nama: <?php echo $transaction['customer_name']; ?></p>
        <p>Alamat: <?php echo $transaction['customer_address']; ?></p>
        <h3>Detail Transaksi</h3>
        <p>Total: Rp <?php echo number_format($transaction['total_price'], 2, ',', '.'); ?></p>
        <h4>Barang</h4>
        <ul>
            <?php while ($row = $details->fetch_assoc()): ?>
                <li>
                    <?php echo $row['product_name']; ?> - 
                    Rp <?php echo number_format($row['harga'], 2, ',', '.'); ?> 
                    (<?php echo $row['quantity']; ?> pcs)
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
