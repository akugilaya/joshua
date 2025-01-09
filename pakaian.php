<?php
// Start session
session_start();

// Include database configuration
include('config.php');

// Handle Add to Cart functionality
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = 1; // Default quantity is 1

    // Check if the cart session already exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $is_in_cart = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_name'] === $product_name) {
            $item['quantity'] += 1;
            $is_in_cart = true;
            break;
        }
    }

    if (!$is_in_cart) {
        // Add the new product to the cart
        $_SESSION['cart'][] = [
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => $quantity
        ];
    }
}

// Search products from "pakaian" category
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT product_name, price, description, image, quantity FROM produk WHERE category = 'pakaian'";
if (!empty($search)) {
    $sql .= " AND product_name LIKE ?";
}

$stmt = $conn->prepare($sql);
if (!empty($search)) {
    $search_param = "%$search%";
    $stmt->bind_param("s", $search_param);
}
$stmt->execute();
$result = $stmt->get_result();

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
    <title>Kategori Pakaian</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .header {
            background: linear-gradient(45deg, #007bff, #00c6ff);
            color: white;
            text-align: center;
            padding: 30px 0;
            position: relative;
        }

        .header h1 {
            font-size: 2.5rem;
        }

        .search-bar {
            margin-top: -20px;
            position: relative;
        }

        .search-bar input {
            padding: 15px;
            border-radius: 25px;
            border: none;
            width: calc(100% - 60px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar button {
            position: absolute;
            top: 0;
            right: 0;
            border: none;
            background: none;
            color: #007bff;
            font-size: 1.2rem;
            padding: 15px;
            cursor: pointer;
        }

        .products-container {
            margin-top: 30px;
        }

        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-bar select {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        .product-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            height: 250px;
            object-fit: cover;
        }

        .product-card .card-body {
            text-align: center;
        }

        .product-card .btn {
            background: linear-gradient(45deg, #007bff, #00c6ff);
            color: white;
            border: none;
            border-radius: 20px;
        }

        .product-card .btn:hover {
            background: linear-gradient(45deg, #0056b3, #0096c6);
        }

        footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 30px;
        }

        /* Cart Icon Style */
        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 1.8rem;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
        }

        .cart-icon:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Kategori Pakaian</h1>
        <p>Temukan produk pakaian terbaik dengan mudah</p>
        <!-- Search Bar -->
        <div class="search-bar container">
            <form method="get">
                <input type="text" name="search" placeholder="Cari produk..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container products-container">
        <!-- Filter Bar -->
        <div class="filter-bar">
            <p><strong>Filter Harga:</strong></p>
            <form method="get" class="form-inline">
                <select name="price_range" class="form-control">
                    <option value="">Semua</option>
                    <option value="low" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == 'low') ? 'selected' : ''; ?>>Rp 0 - Rp 100,000</option>
                    <option value="mid" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == 'mid') ? 'selected' : ''; ?>>Rp 100,001 - Rp 500,000</option>
                    <option value="high" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == 'high') ? 'selected' : ''; ?>>Rp 500,001+</option>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Filter</button>
            </form>
        </div>

        <div class="row">
            <?php
            // Fetch filtered and searched products
            $search_query = isset($_GET['search']) ? $_GET['search'] : '';
            $price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';

            $sql = "SELECT product_name, price, description, image, quantity FROM produk WHERE category = 'pakaian'";

            if (!empty($search_query)) {
                $sql .= " AND product_name LIKE '%$search_query%'";
            }

            if (!empty($price_range)) {
                if ($price_range == 'low') {
                    $sql .= " AND price BETWEEN 0 AND 100000";
                } elseif ($price_range == 'mid') {
                    $sql .= " AND price BETWEEN 100001 AND 500000";
                } elseif ($price_range == 'high') {
                    $sql .= " AND price > 500000";
                }
            }

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>
                            <div class='card product-card'>
                                <img src='uploads/products/{$row['image']}' alt='{$row['product_name']}' />
                                <div class='card-body'>
                                    <h5>{$row['product_name']}</h5>
                                    <p>{$row['description']}</p>
                                    <p class='text-primary'>Rp " . number_format($row['price'], 0, ',', '.') . "</p>
                                    <p class='text-success'>Stok: {$row['quantity']}</p>
                                    <form method='post'>
                                        <input type='hidden' name='product_name' value='{$row['product_name']}'>
                                        <input type='hidden' name='price' value='{$row['price']}'>
                                        <button type='submit' name='add_to_cart' class='btn btn-primary'>Tambahkan ke Keranjang</button>
                                    </form>
                                </div>
                            </div>
                          </div>";
                }
            } else {
                echo "<p class='text-center w-100'>Tidak ada produk ditemukan.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Cart Icon -->
    <a href="cart.php" class="cart-icon">
        <i class="fas fa-shopping-cart"></i>
    </a>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Marketplace. All rights reserved.</p>
    </footer>
</body>
</html>
