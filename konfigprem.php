<?php
$host = "localhost"; // Nama host
$db_name = "joshua"; // Nama database
$username = "root"; // Username database
$password = ""; // Password database (kosong jika default di localhost)

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
