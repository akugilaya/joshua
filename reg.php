<?php
// Koneksi ke database
include('config.php');

// Function untuk log aktivitas ke file
function logToFile($message) {
    $logfile = 'login_log.txt'; // Nama file log
    $current_time = date('Y-m-d H:i:s'); // Waktu sekarang
    $log_message = "[$current_time] - $message\n"; // Format pesan log
    file_put_contents($logfile, $log_message, FILE_APPEND); // Simpan ke file
}

// Function untuk log ke database
function logToDatabase($username, $email, $status, $status_code) {
    include('config.php');

    // Validasi koneksi database
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO register_logs (username, email, status, status_code, timestamp) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Kesalahan SQL: " . $conn->error . " | Kueri: " . $sql);
    }

    // Masukkan data ke tabel `register_logs`
    $timestamp = date('Y-m-d H:i:s');
    $stmt->bind_param("sssis", $username, $email, $status, $status_code, $timestamp);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

// Pesan registrasi untuk ditampilkan
$registerMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Upload file foto
    $photo = $_FILES['photo'];
    $photoName = $photo['name'];
    $photoTmpName = $photo['tmp_name'];
    $photoSize = $photo['size'];
    $photoError = $photo['error'];
    $photoType = $photo['type'];

    // Lokasi penyimpanan foto
    $photoDestination = 'uploads/' . $photoName;

    // Validasi dan proses file foto
    if ($photoError === 0) {
        if ($photoSize < 1000000) { // Maksimal ukuran 1MB
            if (move_uploaded_file($photoTmpName, $photoDestination)) {
                // Simpan data ke tabel `reg`
                $sql = "INSERT INTO reg (nama, phone, email, photoName, date, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $nama, $phone, $email, $photoName, $date, $password);

                if ($stmt->execute()) {
                    $status = "Registrasi berhasil";
                    $status_code = 200; // Status kode berhasil
                    $registerMessage = "Registrasi berhasil! <a href='login.php'>Klik di sini untuk login</a>";

                    // Log ke file dan database
                    logToFile("[$status_code] Registrasi berhasil: $nama, Email: $email");
                    logToDatabase($nama, $email, $status, $status_code);
                } else {
                    $status = "Kesalahan server: " . $conn->error;
                    $status_code = 500; // Status kode server error
                    $registerMessage = $status;

                    // Log ke file dan database
                    logToFile("[$status_code] Registrasi gagal: $nama, Error: " . $conn->error);
                    logToDatabase($nama, $email, $status, $status_code);
                }

                $stmt->close();
            } else {
                $status = "Gagal mengupload foto!";
                $status_code = 400; // Status kode gagal upload
                $registerMessage = $status;

                // Log ke file dan database
                logToFile("[$status_code] Upload foto gagal: $nama, Photo: $photoName");
                logToDatabase($nama, $email, $status, $status_code);
            }
        } else {
            $status = "Ukuran file terlalu besar!";
            $status_code = 413; // Status kode ukuran file terlalu besar
            $registerMessage = $status;

            // Log ke file dan database
            logToFile("[$status_code] File terlalu besar: $nama, Size: $photoSize");
            logToDatabase($nama, $email, $status, $status_code);
        }
    } else {
        $status = "Terjadi kesalahan saat mengupload foto!";
        $status_code = 400; // Status kode gagal upload
        $registerMessage = $status;

        // Log ke file dan database
        logToFile("[$status_code] Upload gagal: $nama, Error code: $photoError");
        logToDatabase($nama, $email, $status, $status_code);
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
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
            height: 100vh;
            background-image: url('uploads/joshtip.png'); /* Add your logo as the background */
            background-size: cover;
            background-position: center;
        }

        .register-container {
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            color: white;
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #fff;
        }

        .register-container label {
            font-size: 14px;
            color: #fff;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }

        .register-container input[type="text"],
        .register-container input[type="password"],
        .register-container input[type="tel"],
        .register-container input[type="email"],
        .register-container input[type="file"],
        .register-container input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: transparent;
            color: white;
        }

        .register-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #3081fa;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: #45a049;
        }

        #registerMessage {
            margin-top: 15px;
            color: #ff0000;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrasi</h2>
        <form action="reg.php" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>

            <label for="password">Masukan Password</label>
            <input type="password" id="password" name="password" required>

            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" required pattern="[0-9]{10,13}" placeholder="Masukkan No HP">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="photo">Foto</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>

            <label for="date">Tanggal</label>
            <input type="date" id="date" name="date" required>

            <button type="submit">Daftar</button>
        </form>
        <p id="registerMessage"><?php echo $registerMessage; ?></p>
    </div>
</body>
</html>
