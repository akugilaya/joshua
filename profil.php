<?php
session_start();
$conn = new mysqli("localhost", "root", "", "joshua");

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifikasi data login (pastikan password di-hash untuk keamanan)
    $sql = "SELECT nama, password FROM reg WHERE nama = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $nama['password'])) {
        // Jika login berhasil, simpan user_id di sesi
        $_SESSION['user_id'] = $user['user_id'];
        echo "Login berhasil!";
    } else {
        echo "Username atau password salah!";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="style.css">
    <style>
      /* Gaya dasar untuk navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #333;
    color: white;
}

.nav-links {
    list-style-type: none;
    display: flex;
    gap: 15px;
}

.nav-links li a {
    color: white;
    text-decoration: none;
}

/* Gaya untuk profil pengguna */
.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.user-profile span {
    font-size: 16px;
    font-weight: bold;
    color: white;
}

    </style>
</head>
<body>
    <!-- Navbar atau Header -->
    <header>
        <nav class="navbar">
            <div class="logo">MyApp</div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

            <!-- Profil Pengguna -->
            <div class="user-profile">
                <img id="profile-picture" src="default-profile.png" alt="Foto Profil" />
                <span id="username">Nama Pengguna</span>
            </div>
        </nav>
    </header>

    <!-- Konten lainnya -->
    <main>
        <h1>Selamat Datang di MyApp!</h1>
        <p>Ini adalah halaman utama aplikasi Anda.</p>
    </main>

    <script src="script.js"></script>
    
</body>
</html>
