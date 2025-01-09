<?php
// Start session
session_start();

// Include database configuration
include('config.php');

// Handle form submission
if (isset($_POST['submit_payment'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $payment_proof = $_FILES['payment_proof'];
    $status = 'Pending'; // Default status

    $payment_proof_path = null;

    // Handle file upload if not COD
    if ($payment_method !== 'COD') {
        $target_dir = "uploads/payment_proofs/";
        $target_file = $target_dir . basename($payment_proof['name']);
        move_uploaded_file($payment_proof['tmp_name'], $target_file);
        $payment_proof_path = $target_file;
    }

    // Simpan data ke database
    $sql = "INSERT INTO payments (name, phone, address, payment_method, payment_proof, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $phone, $address, $payment_method, $payment_proof_path, $status);
    if ($stmt->execute()) {
        // Redirect to detail page with the inserted payment ID
        $last_id = $conn->insert_id;
        header("Location: detail_order.php?id=$last_id");
        exit();
    } else {
        echo "<script>alert('Gagal mengirim konfirmasi pembayaran.'); window.location.href = 'payment_confirmation.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <h2>Konfirmasi Pembayaran</h2>
        <form action="payment_confirmation.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="BANK ABC">Transfer</option>
                    
                </select>
            </div>
            <div class="form-group" id="proof_section">
                <label>Unggah Bukti Transfer</label>
                <input type="file" name="payment_proof" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Rekening Tujuan</label>
                <ul>
                    <li><strong>BANK BCA - 647835692 - A/N Nathan</strong></li>
                    
                </ul>
                <p>E-Wallet:</p>
                <ul>
                    <li><strong>DANA - 0895363467241 - Nathan</strong></li>
                    
                </ul>
            </div>
            <button type="submit" name="submit_payment" class="btn btn-success">Kirim</button>
        </form>
    </div>

    <script>
        document.getElementById('payment_method').addEventListener('change', function() {
            const proofSection = document.getElementById('proof_section');
            if (this.value === 'COD') {
                proofSection.style.display = 'none';
            } else {
                proofSection.style.display = 'block';
            }
        });
    </script>
</body>
</html>
