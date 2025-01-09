<?php
// Include database configuration
include('config.php');

// Fetch products from the database
$sql = "SELECT product_name, category, price, description, image, quantity FROM produk";
$result = $conn->query($sql);

// Check if the query is successful
if (!$result) {
    die("Error in query: " . $conn->error); // Stop the script if query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f8f8f8;
            padding: 20px;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 15px;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .product-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .product-card .price {
            font-size: 16px;
            color: #3081fa;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .product-card .stock {
            font-size: 14px;
            color: #28a745;
            margin-bottom: 15px;
        }

        .product-card button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #3081fa;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .product-card button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin-bottom: 30px;">Barang Yang Sudah Kamu Jual</h1>
    <div class="product-container">
        <?php 
        // Check if there are results
        if ($result->num_rows > 0) {
            // Output each product
            while ($row = $result->fetch_assoc()) { ?>
                <div class="product-card">
                    <img src="uploads/products/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">
                    <h3><?php echo $row['product_name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <div class="price">Rp <?php echo number_format($row['price'], 2, ',', '.'); ?></div>
                    <div class="quantity">Stok: <?php echo $row['quantity']; ?></div>
                    
                </div>
            <?php }
        } else {
            echo "<p>No products found.</p>"; // If no products are found
        }
        ?>
    </div>
</body>
</html>
