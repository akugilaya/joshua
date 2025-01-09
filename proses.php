<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $masukan = htmlspecialchars($_POST["message"]);

    
    $to = "nathan.srkrtns@gmail.com"; 
    $subject = "Pesan dari $nama melalui Form Kontak";
    $body = "Nama: $nama\nEmail: $email\nPesan:\n$masukan";

    if (mail($to, $subject, $body)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
