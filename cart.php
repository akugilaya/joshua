<?php
// Start session
session_start();


include('config.php');


if (isset($_POST['checkout'])) {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<script>alert('Keranjang kosong!');</script>";
    } else {
        $can_checkout = true;
        $out_of_stock_items = [];

        foreach ($_SESSION['cart'] as $item) {
            $product_name = $item['product_name'];
            $quantity = $item['quantity'];

            // Periksa stok di database
            $sql = "SELECT quantity FROM produk WHERE product_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $product_name);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if ($product['quantity'] < $quantity) {
                $can_checkout = false;
                $out_of_stock_items[] = $product_name;
            }
        }

        if ($can_checkout) {
            // Kurangi stok untuk setiap produk di keranjang
            foreach ($_SESSION['cart'] as $item) {
                $product_name = $item['product_name'];
                $quantity = $item['quantity'];

                $sql = "UPDATE produk SET quantity = quantity - ? WHERE product_name = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('is', $quantity, $product_name);
                $stmt->execute();
            }

            // Kosongkan keranjang setelah checkout
            $_SESSION['cart'] = [];
            echo "<script>alert('Checkout berhasil! Silakan lakukan konfirmasi pembayaran.'); window.location.href = 'payment_confirmation.php';</script>";
        } else {
            $item_list = implode(', ', $out_of_stock_items);
            echo "<script>alert('Checkout gagal! Stok tidak mencukupi untuk: $item_list.'); window.location.href = 'cart.php';</script>";
        }
    }
}

// Handle Remove Item
if (isset($_GET['remove'])) {
    $remove_item = $_GET['remove'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_name'] === $remove_item) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    echo "<script>alert('Item dihapus dari keranjang.'); window.location.href = 'cart.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f3f4f5, #f8f9fa);
            font-family: 'Arial', sans-serif;
        }

        .cart-container {
            padding: 30px 15px;
        }

        .cart-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .cart-table th, .cart-table td {
            text-align: center;
            vertical-align: middle;
        }

        .cart-table img {
            max-width: 70px;
            border-radius: 10px;
        }

        .cart-summary {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .cart-summary .total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
        }

        .btn-success {
            background: linear-gradient(90deg, #28a745, #218838);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(90deg, #dc3545, #c82333);
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header text-center bg-primary text-white py-3 shadow-sm">
        <h1>Keranjang Belanja</h1>
    </div>

    <!-- Cart Container -->
    <div class="container cart-container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped table-hover cart-table">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            $total = 0;
                            foreach ($_SESSION['cart'] as $key => $item) {
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                                echo "<tr>
                                        <td>" . ($key + 1) . "</td>
                                        <td><img src='uploads/products/' alt='{$item['product_name']}'></td>
                                        <td>{$item['product_name']}</td>
                                        <td>Rp " . number_format($item['price'], 0, ',', '.') . "</td>
                                        <td>{$item['quantity']}</td>
                                        <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                                        <td>
                                            <a href='cart.php?remove={$item['product_name']}' class='btn btn-danger btn-sm'>Hapus</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr>
                                    <td colspan='7' class='text-center'>Keranjang Anda kosong.</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="cart-summary">
                    <h4>Ringkasan Belanja</h4>
                    <hr>
                    <p><strong>Total Item:</strong> <?= count($_SESSION['cart'] ?? []); ?></p>
                    <p class="total">Total: Rp <?= isset($total) ? number_format($total, 0, ',', '.') : '0'; ?></p>
                    <div class="mt-4">
                        <a href="beli.html" class="btn btn-primary w-100 mb-2">Lanjut Belanja</a>
                        <form method="post">
                            <button type="submit" name="checkout" class="btn btn-success w-100">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
