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
?>
