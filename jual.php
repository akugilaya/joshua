<?php
// Include database configuration
include('config.php');

// Function to log activity
function logActivity($message) {
    $logfile = 'login_log.txt';  // Path to your log file
    $current_time = date('Y-m-d H:i:s');  // Get current timestamp
    $log_message = "[$current_time] - $message\n";  // Format the log message
    file_put_contents($logfile, $log_message, FILE_APPEND);  // Append the log message to the log file
}

$sellMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $productName = $_POST['product_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle image upload
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    // Specify upload location
    $uploadDir = __DIR__ . '/uploads/products/';
    $imageDestination = $uploadDir . basename($imageName);

    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            die("Failed to create upload directory: $uploadDir");
        }
    }

    // Validate and upload image
    if ($imageError === 0) {
        if ($imageSize < 2000000) { // Max size 2MB
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($imageType, $allowedTypes)) {
                if (move_uploaded_file($imageTmpName, $imageDestination)) {
                    // Insert data into database
                    $sql = "INSERT INTO produk (product_name, category, quantity, price, description, image) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    if (!$stmt) {
                        die("Prepare failed: " . $conn->error);
                    }
                    $stmt->bind_param("ssisss", $productName, $category, $quantity, $price, $description, $imageName );

                    if ($stmt->execute()) {
                        $sellMessage = "Product successfully listed!";
                        logActivity("Product listed: $productName, Category: $category, Quantity:$quantity,  Price: $price, Image: $imageName");
                    } else {
                        $sellMessage = "Failed to list product: " . $stmt->error;
                        logActivity("Failed to list product: $productName. Error: " . $stmt->error);
                    }

                    $stmt->close();
                } else {
                    $sellMessage = "Failed to move uploaded file!";
                    logActivity("Failed to move uploaded file for product: $productName");
                }
            } else {
                $sellMessage = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
                logActivity("Invalid file type for product: $productName. Type: $imageType");
            }
        } else {
            $sellMessage = "Image file is too large!";
            logActivity("File too large for product: $productName. Size: $imageSize");
        }
    } else {
        $sellMessage = "Error uploading image!";
        logActivity("Error uploading image for product: $productName. Error code: $imageError");
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell a Product</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f8f8;
        }

        .sell-container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .sell-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .sell-container label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }

        .sell-container input[type="text"],
        .sell-container input[type="number"],
        .sell-container input[type="file"],
        .sell-container textarea,
        .sell-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .sell-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #3081fa;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .sell-container button:hover {
            background-color: #45a049;
        }

        #sellMessage {
            margin-top: 15px;
            color: #ff0000;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="sell-container">
        <h2>Jual produk kamu</h2>
        <form action="jual.php" method="POST" enctype="multipart/form-data">
            <label for="product_name">Nama Produk</label>
            <input type="text" id="product_name" name="product_name" required>
            
            <label for="category">Kategori</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <option value="aksesoris">Aksesoris</option>
                <option value="atk">ATK</option>
                <option value="pakaian">Pakaian</option>
                <option value="kosmetik">Kosmetik</option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="sepatu">Sepatu</option>
                <option value="kado/hadiah">Kado/Hadiah</option>
                <!-- Add more categories as needed -->
            </select>

            <label for="quantity">quantity</label>
            <input type="number" id="quantity" name="quantity" required placeholder="" min="0">

            <label for="price">Price</label>
            <input type="number" id="price" name="price" required placeholder=""  min="0">

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required placeholder=""></textarea>

            <label for="image">Product Image</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Jual</button>
            <br>
            <a href="display.php">BARANG YANG KAMU JUAL</a>
        </form>
        <p id="sellMessage"><?php echo $sellMessage; ?></p>
    </div>
</body>
</html>
