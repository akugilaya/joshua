<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Travel- Slicing</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container nav-wrapper">
                <img src="uploads/josh.png" alt="" style="width: 200px;
                height: 200px;
                object-fit: cover">
                <div class="menu-wrapper">
                    <ul class="menu">
                        <li class="menu-item"><a href="login.php" class="menu-link active">Beranda</a></li>
                        <li class="menu-item"><a href="#service" class="menu-link">Tentang Kami</a></li>
                        <li class="menu-item"><a href="login.php" class="menu-link">Kategori</a></li>
                        
                        <li class="menu-item"><a href="#hubungikami" class="menu-link">Hubungi Kami</a></li>
                    </ul>
                    <a href="login.php" class="btn-member">MASUK</a>
                    <a href="reg.php" class="btn-member">DAFTAR</a>
                </div>
                <div class="menu-toggle bx bxs-grid-alt">
                </div>
            </div>
        </nav>

        <section class="home" id="home">
            <div class="container home-wrapper">
                <div class="content-left" data-aos="fade-right">
                    <h1 class="heading">Temukan jasa titip barang yang kamu inginkan di<span>SINI</span></h1>
                    <p class="subheading">Kami menyediakan dan membentuk komunitas disini,Bergabunglah bersama kami.</p>
                    <div class="box-wrapper">
                        <div class="box">
                            <i class='bx bxs-check-square'></i>
                            <p>Open Jasa</p>
                        </div>
                        <div class="box">
                            <i class='bx bxs-check-square'></i>
                            <p>Beli Jasa</p>
                        </div>
                    </div>
                    <div class="form-panel">
                        <img src="assets/img/form.png" alt="">
                        <div class="title-form">
                            <p>Open Jasa</p>
                        </div>
                       
                        <div class="form-date">
                            <i class='bx bxs-calendar-alt cal'></i>
                            <div class="date">
                                <p>Date <i class='bx bx-chevron-down'></i></p>
                                <input type="date">
                            </div>
                        </div>
                        <div class="btn-search">
                            <i class='bx bx-search'></i>
                        </div>
                    </div>
                    <p class="sugestion">Popular search : Yogyakarta,Bandung,Surabaya</p>
                </div>
                <div class="content-right" data-aos="fade-left">
                    <div class="img-wrapper">
                        <img src="uploads/joshtip.png" alt="">
                    </div>

                </div>

            </div>
        </section>
    </header>

    <!-- Service Start -->
    <section class="service" id="service">
        <div class="container service-wrapper">
            <div class="row1">
                <p class="label-service">Apa yang kami sediakan disini?</p>
                <h1 class="heading-service">Kami siap membantu anda</h1>
                <p class="subheading-service">Beberapa layanan yang kamu temukan disini</p>
            </div>
            <div class="row2" data-aos="fade-up">
                <div class="box-service">
                    <i class='bx bx-globe'></i>
                    <h3>Banyak Pilihan</h3>
                    <p>Banyak pilihan barang yang baru setiap hari</p>

                    <div class="btn-learn">
                        <a href="#">Pelajari selengkapnya</a>
                    </div>
                </div>
                <div class="box-service">
                    <i class='bx bxs-notepad'></i>
                    <h3>Temukan komunitas</h3>
                    <p>Temukan teman dan buat komunitas baru</p>

                    <div class="btn-learn">
                        <a href="#">Pelajari selengkapnya</a>
                    </div>
                </div>
                <div class="box-service">
                    <i class='bx bxs-cart-add'></i>
                    <h3>Transaksi Mudah</h3>
                    <p>Transaksi yang mudah</p>

                    <div class="btn-learn">
                        <a href="#">Pelajari selengkapnya</a>
                    </div>
                </div>
                <div class="box-service">
                    <i class='bx bxs-hotel'></i>
                    <h3>Harga Terjangkau</h3>
                    <p>Banyak pilihan barang dengan harga yang terjangkau</p>

                    <div class="btn-learn">
                        <a href="#">Pelajari selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service End -->

    <!-- Produk start -->
    <html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Cara Pemesanan
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class=>
  <div class="container mx-auto px-4 py-8">
   <h1 class="text-3xl font-bold text-center mb-8">
    Cara pemesanan
   </h1>
   <div class="flex flex-col md:flex-row items-center justify-center space-y-8 md:space-y-0 md:space-x-8">
    <div class="flex-1 text-center">
     <div class="bg-gray-100 p-4 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold mb-2">
       Buat Permintaan
      </h2>
      <p class="text-gray-600">
       Lengkapi formulir pemesanan dengan detail informasi produk yang diinginkan, seperti link barang, nama produk, pilihan tambahan, berat dan volume, dan informasi lain yang membantu kalkulasi biaya.
      </p>
     </div>
    </div>
    <div class="flex-1 text-center">
     <div class="relative">
            <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center">
       <div class="flex items-center justify-center space-x-4">
        <div class="bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold">
         1
        </div>
        <div class="bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold">
         3
        </div>
       </div>
       <div class="mt-4">
              </div>
       <div class="mt-4">
        <div class="bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold">
         2
        </div>
       </div>
       <div class="mt-4">
        <div class="bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold">
         4
        </div>
       </div>
      </div>
     </div>
    </div>
    <div class="flex-1 text-center">
     <div class="bg-gray-100 p-4 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold mb-2">
       Deal dan Transaksi
      </h2>
      <p class="text-gray-600">
       Setelah menerima estimasi biaya yang kami berikan, Anda dapat melanjutkan dengan melakukan pembayaran sesuai dengan jenis layanan yang Anda pilih.
      </p>
     </div>
    </div>
   </div>
   <div class="flex flex-col md:flex-row items-center justify-center space-y-8 md:space-y-0 md:space-x-8 mt-8">
    <div class="flex-1 text-center">
     <div class="bg-gray-100 p-4 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold mb-2">
       Penawaran Harga
      </h2>
      <p class="text-gray-600">
       Kami memberikan penawaran harga setelah menerima formulir pemesanan Anda. Silakan hubungi kami untuk pertanyaan atau kebutuhan khusus.
      </p>
     </div>
    </div>
    <div class="flex-1 text-center">
     <div class="bg-gray-100 p-4 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold mb-2">
       Tunggu Pesanan Datang
      </h2>
      <p class="text-gray-600">
       Great, sekarang kamu tinggal tunggu barangnya datang, kami yang akan beliin, kirimin dan urusin. ngga perlu ribet
      </p>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>
<!-- Produk end -->

    <html>
        <head>
         <script src="https://cdn.tailwindcss.com">
         </script>
         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        </head>
        <body class="bg-sky-100">
         <div class="container mx-auto p-8">
          <div class="flex justify-between items-center mb-8">
           <h1 class="text-2xl font-bold">
            Kategori
           </h1>
           <div class="flex space-x-4">
            <button class="bg-white p-2 rounded-full shadow-md">
             <i class="fas fa-chevron-left">
             </i>
            </button>
            <button class="bg-white p-2 rounded-full shadow-md">
             <i class="fas fa-chevron-right">
             </i>
            </button>
           </div>
          </div>
          <div class="grid grid-cols-4 gap-6">
           <div class="bg-white p-4 rounded-lg shadow-md text-center">
            <img alt="Aksesoris" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/kZYFUifMEAQnO6XGrofFDTrgPBbWUBSxsx4e0L0wtRf304BPB.jpg" width="100"/>
            <p class="font-semibold">
             Aksesoris
            </p>
           </div>
           <div class="bg-pink-200 p-4 rounded-lg shadow-md text-center">
            <img alt="Kosmetik" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/eglsqJrVeWlZAUoDJl1vsl1kiV3NPBtNIPcuSU9SdbCSNegnA.jpg" width="100"/>
            <p class="font-semibold">
             Kosmetik
            </p>
           </div>
           <div class="bg-gray-200 p-4 rounded-lg shadow-md text-center">
            <img alt="Hampers" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/ClfFZuiHheiAMURtwxzpW3PB6Ct8fF1ehiA4dyX3herwpxDeE.jpg" width="100"/>
            <p class="font-semibold">
             Hampers
            </p>
           </div>
           <div class="bg-yellow-200 p-4 rounded-lg shadow-md text-center">
            <img alt="Minuman" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/bBWzTr22tua8Dt7mPVbhKC3eMRT7DQhAi6bYKfCsvuTUNegnA.jpg" width="100"/>
            <p class="font-semibold">
             Minuman
            </p>
           </div>
           <div class="bg-white p-4 rounded-lg shadow-md text-center">
            <img alt="Alat Tulis Kantor" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/jDKGncH5LT4WHtnBfD3ODB7cHy0oKd8ajnr0k7QUGD5qGP4JA.jpg" width="100"/>
            <p class="font-semibold">
             Alat Tulis Kantor
            </p>
           </div>
           <div class="bg-green-200 p-4 rounded-lg shadow-md text-center">
            <img alt="Makanan" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/PeWWJoTlTTRmUqaWOqSmHI85hrj3d2w4yV6H7I5RRxsnGP4JA.jpg" width="100"/>
            <p class="font-semibold">
             Makanan
            </p>
           </div>
           <div class="bg-blue-200 p-4 rounded-lg shadow-md text-center">
            <img alt="Sepatu" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/0P8Xp5HEZk4POtGqwJKUq4aKzxOexvYtQ4nNkpmNZIHoGP4JA.jpg" width="100"/>
            <p class="font-semibold">
             Sepatu
            </p>
           </div>
           <div class="bg-yellow-100 p-4 rounded-lg shadow-md text-center">
            <img alt="Baju Pakaian" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/wfTEOFpJj6x8J6tltJLzvtB4L5i39jUeRrW8o26PAmVRNegnA.jpg" width="100"/>
            <p class="font-semibold">
             Baju Pakaian
            </p>
           </div>
          </div>
          <div class="flex justify-center mt-8">
           <button class="bg-white px-4 py-2 rounded-full shadow-md">
            Lebih banyak
           </button>
          </div>
         </div>
        </body>
       </html>
        <!-- statistik end -->

    <!-- TESTI START -->
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

// Ambil data dari database
$sql = "SELECT name, rating, created_at FROM user_ratings ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <style>
        
        .container2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 250px));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card h2 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }
        .stars {
            color: gold;
            margin: 10px 0;
        }
        .date {
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <h3>USER RATINGS</h3>
    <div class="container2">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span><?php echo $i <= $row['rating'] ? "★" : "☆"; ?></span>
                        <?php endfor; ?>
                    </div>
                    <p class="date"><?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center;">No ratings found.</p>
        <?php endif; ?>
    </div>
    <?php $conn->close(); ?>
</body>
</html>


<!-- TESTI END -->

<html>
    <head>
        <title>Hubungi Kami</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <section id="hubungikami">
    <body class="bg-blue-100 font-sans">
        <div class="container mx-auto px-4 py-16">
            <h1 class="text-4xl font-bold mb-4">Hubungi kami</h1>
            <p class="text-xl text-gray-700 mb-8">Sampaikan kritik atau saran jika terjadi kesalahan dalam program website kami, kritik dan saran di persilahkan</p>
            <div class="flex">
                <div class="w-1/2"></div>
                <div class="w-1/2">
                    <form class="bg-white p-8 rounded-lg shadow-md" action="proses.php" method="POST" id="contactForm">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama</label>
                            <input 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="name" 
                                type="text" 
                                name="name" 
                                placeholder="Tuliskan nama" 
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                            <input 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="email" 
                                type="email" 
                                name="email" 
                                placeholder="Masukkan email" 
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Pesan</label>
                            <textarea 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="message" 
                                name="message" 
                                rows="4" 
                                placeholder="Tulis pesan Anda di sini" 
                                required></textarea>
                        </div>
                        <div class="flex items-center justify-between">
                            <button 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit">
                                Kirim
                            </button>
                        </div>
                    </form>
                    <div id="successMessage" class="hidden mt-4 text-green-500 font-bold">
                        Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.
                    </div>
                    
                </div>
            </div>
        </div>
        <footer class="bg-blue-100 py-8">
            <div class="container mx-auto px-4">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-blue-700">Joshua</h2>
                        <p class="text-gray-700 mt-2">Pelayanan terbaik kepada pelanggan adalah prioritas utama kami dalam membangun bisnis</p>
                        <div class="flex mt-4">
                            <a href="#" class="text-gray-700 mr-4"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-gray-700 mr-4"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-700"><i class="fab fa-instagram"></i></a>
                        </div>
                        <p class="text-gray-700 mt-4">© Copyright 2021 Joshua</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-2">Halaman</h3>
                        <ul class="text-gray-700">
                            <li class="mb-1"><a href="#">Tentang</a></li>
                            <li class="mb-1"><a href="#">Kategori</a></li>
                            <li class="mb-1"><a href="#">Hubungi kami</a></li>
                            <li class="mb-1"><a href="#">Daftar</a></li>
                            <li class="mb-1"><a href="#">Login</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-2">Mendukung</h3>
                        <ul class="text-gray-700">
                            <li class="mb-1"><a href="#">Akun</a></li>
                            <li class="mb-1"><a href="#">Pusat dukungan</a></li>
                            <li class="mb-1"><a href="#">Masukan</a></li>
                            <li class="mb-1"><a href="#">Hubungi kami</a></li>
                            <li class="mb-1"><a href="#">Aksesibilitas</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-2">Hubungi kami</h3>
                        <p class="text-gray-700 mb-2">Pertanyaan atau Masukan</p>
                        <button class="bg-white border border-gray-300 rounded-lg py-2 px-4 flex items-center">
                            <i class="fab fa-whatsapp text-green-500 mr-2"></i> WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</section>
    </html></footer>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 3000
        });
    </script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>