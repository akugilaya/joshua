<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "joshua";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request to save rating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $rating = $_POST['rating'];

    if (!empty($name) && !empty($rating) && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
        $stmt = $conn->prepare("INSERT INTO user_ratings (name, rating) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $rating);

        if ($stmt->execute()) {
            $message = "Thank you for your feedback!";
        } else {
            $message = "Error saving your rating. Please try again.";
        }
        $stmt->close();
    } else {
        $message = "Invalid input.";
    }
}

// Get name from URL parameter
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .rating {
            display: flex;
            gap: 5px;
            cursor: pointer;
        }
        .star {
            font-size: 30px;
            color: #ccc;
        }
        .star.selected {
            color: gold;
        }
        .message {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <h5>Terimakasi sudah melakukan pembelian,selamat berbelanja</h5>
    <h1>Berikan penilaian anda</h1>

    <form method="POST">
        <label for="name">Nama Kamu:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
        <label>Berikan Bintang:</label><br>
        <div class="rating" id="starRating">
            <span class="star" data-value="1">★</span>
            <span class="star" data-value="2">★</span>
            <span class="star" data-value="3">★</span>
            <span class="star" data-value="4">★</span>
            <span class="star" data-value="5">★</span>
        </div><br>
        <input type="hidden" id="rating" name="rating" required>
        <button type="submit">Submit</button><br>
    </form>
    <?php if (!empty($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <script>
        const stars = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("rating");

        stars.forEach(star => {
            star.addEventListener("click", () => {
                stars.forEach(s => s.classList.remove("selected"));
                star.classList.add("selected");
                ratingInput.value = star.dataset.value;
            });
        });
    </script>
</body>
</html>
