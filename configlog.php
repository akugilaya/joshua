<?php
$servername = "localhost"; // Nama server, biasanya "localhost"
$username = "root";        // Username MySQL
$password = "";            // Password MySQL (biasanya kosong jika lokal)
$dbname = "joshua";      // Nama database yang dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
function log_activity($conn, $customer_id, $activity) {
    $query = "INSERT INTO activity_logs (customer_id, activity) VALUES ('$customer_id', '$activity')";
    $conn->query($query);
}
?>
