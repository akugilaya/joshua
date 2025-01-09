<?php
session_start();

// Include database configuration
include('config.php');

// Check if the cart session exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Tidak ada barang di keranjang belanja.</p>";
    echo "<a href='beli.html'>Kembali ke belanja</a>";
    exit;
}

// Process checkout
if (isset($_POST['process_payment'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $cart = json_encode($_SESSION['cart']);
    $grand_total = $_POST['grand_total'];

    // Insert transaction into database
    $sql = "INSERT INTO transactions (name, address, payment_method, cart, total) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssd", $name, $address, $payment_method, $cart, $grand_total);

    if ($stmt->execute()) {
        $_SESSION['cart'] = [];
        $transaction_id = $stmt->insert_id;

        // Log the successful checkout to a file
        $log_message = date("Y-m-d H:i:s") . " | Transaction ID: $transaction_id | Name: $name | Total: Rp " . number_format($grand_total, 0, ',', '.') . "\n";
        file_put_contents("login_log.txt", $log_message, FILE_APPEND);

        // Redirect to the rating page with the user's name
        header("Location: rating.php?name=" . urlencode($name));
        exit;
    } else {
        echo "<p>Terjadi kesalahan: " . $conn->error . "</p>";
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Marketplace</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 30px;
        }

        .table {
            background: #fff;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #007bff;
            color: white;
        }

        .header h1 {
            margin: 0;
        }

        .btn-checkout {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Checkout</h1>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grand_total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total = $item['price'] * $item['quantity'];
                    $grand_total += $total;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Grand Total</th>
                    <th>Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></th>
                </tr>
            </tfoot>
        </table>

        <form method="post">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="payment_method">Metode Pembayaran</label>
                <select class="form-control" id="payment_method" name="payment_method" required>
                    <option value="COD">COD</option>
                    <option value="DANA">DANA</option>
                    <option value="TF BANK">Transfer Bank</option>
                </select>
            </div>
            <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
            <button type="submit" name="process_payment" class="btn btn-success btn-block btn-checkout">Proses Pembayaran</button>
        </form>

        <div class="text-center mt-3">
            <a href="beli.html" class="btn btn-primary">Kembali ke Belanja</a>
        </div>
    </div>

    <footer class="text-center py-3" style="background-color: #f1f1f1; margin-top: 20px;">
        <p>&copy; 2024 Marketplace. All rights reserved.</p>
    </footer>
</body>
</html>
