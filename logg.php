<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Logging di Browser</title>
</head>
<body>
    <h1>Selamat datang di halaman contoh log!</h1>
    <p>Periksa konsol untuk melihat log yang telah dicatat.</p>

    <script>
        // Log Informasi
        console.log("Informasi: Halaman dimuat dengan sukses.");

        // Log Debug
        let debugData = { userID: 123, userName: "Nathan" };
        console.debug("Debug: Informasi pengguna untuk keperluan debug", debugData);

        // Log Peringatan (Warning)
        console.warn("Peringatan: Pengguna mencoba mengakses fitur yang belum tersedia.");

        // Log Kesalahan (Error)
        try {
            // Contoh kesalahan jika ada elemen yang tidak ditemukan
            let element = document.getElementById("tidakAdaElemen");
            if (!element) throw new Error("Elemen tidak ditemukan di halaman.");
        } catch (error) {
            console.error("Kesalahan:", error.message);
        }

        // Log khusus untuk 404 jika halaman tidak ditemukan
        if (window.location.pathname.includes("404")) {
            console.warn("Peringatan: Halaman tidak ditemukan (404). URL:", window.location.href);
        }
    </script>
</body>
</html>
