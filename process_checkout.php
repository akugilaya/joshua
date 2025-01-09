<?php
// Include database configuration
include('config.php');

// Fetch products from the database
$sql = "SELECT * FROM produk WHERE category = 'aksesoris'";
$result = $conn->query($sql);

// Check if the query is successful
if (!$result) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aksesoris</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 30px 0;
        }
        .header h1 {
            font-size: 2.5rem;
        }
        .products-container {
            padding: 30px 15px;
        }
        .product-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Kategori Aksesoris</h1>
    </div>

    <div class="container products-container">
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card product-card">
                            <img src="uploads/products/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">
                            <div class="card-body text-center">
                                <h5><?php echo $row['product_name']; ?></h5>
                                <p>Rp <?php echo number_format($row['price'], 2, ',', '.'); ?></p>
                                <button class="btn btn-primary add-to-cart" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['product_name']; ?>" data-price="<?php echo $row['price']; ?>">Tambahkan ke Keranjang</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada produk tersedia.</p>
            <?php endif; ?>
        </div>
        <button id="checkout-btn" class="btn btn-success d-block mx-auto mt-4">Checkout</button>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCartCount() {
            document.getElementById('checkout-btn').textContent = `Checkout (${cart.length} items)`;
        }

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = parseFloat(button.getAttribute('data-price'));

                const item = cart.find(product => product.id === id);
                if (item) {
                    item.quantity++;
                } else {
                    cart.push({ id, name, price, quantity: 1 });
                }

                localStorage.setItem('cart', JSON.stringify(cart));
                alert(`${name} telah ditambahkan ke keranjang.`);
                updateCartCount();
            });
        });

        document.getElementById('checkout-btn').addEventListener('click', () => {
            if (cart.length === 0) {
                alert('Keranjang kosong. Tambahkan barang terlebih dahulu.');
                return;
            }

            fetch('aksesoris.php?action=checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(cart),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Checkout berhasil!');
                    localStorage.removeItem('cart');
                    cart = [];
                    updateCartCount();
                } else {
                    console.error('Error during checkout:', data.error);
                    alert('Terjadi kesalahan saat checkout: ' + (data.error || 'Tidak diketahui.'));
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Terjadi kesalahan jaringan. Silakan coba lagi.');
            });
        });

        updateCartCount();
    </script>
</body>
</html>

<?php
// Handle checkout action
if (isset($_GET['action']) && $_GET['action'] === 'checkout') {
    header('Content-Type: application/json');

    // Decode JSON request data
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input data
    if (empty($data) || !is_array($data)) {
        echo json_encode(['success' => false, 'error' => 'Data keranjang kosong atau tidak valid.']);
        exit;
    }

    $conn->begin_transaction();
    try {
        // Insert order
        $sql = "INSERT INTO orders (created_at) VALUES (NOW())";
        if (!$conn->query($sql)) {
            throw new Exception("Gagal menyimpan data order: " . $conn->error);
        }
        $orderId = $conn->insert_id;

        // Insert order details
        $stmt = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Gagal menyiapkan pernyataan: " . $conn->error);
        }

        foreach ($data as $item) {
            $productId = intval($item['id']);
            $quantity = intval($item['quantity']);
            $price = floatval($item['price']);

            if ($quantity <= 0 || $price <= 0) {
                throw new Exception("Data produk tidak valid: ID = $productId, Quantity = $quantity, Price = $price");
            }

            $stmt->bind_param('iiid', $orderId, $productId, $quantity, $price);
            if (!$stmt->execute()) {
                throw new Exception("Gagal menyimpan detail order: " . $stmt->error);
            }
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}
?>
