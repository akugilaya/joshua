<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .category-header {
            text-align: center;
            background-color: #343a40;
            color: #fff;
            padding: 50px 0;
        }

        .category-header h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .category-container {
            padding: 30px 15px;
        }

        .category-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .category-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .category-card .card-body {
            text-align: center;
            background-color: #fff;
            padding: 20px;
        }

        .category-card .card-body h5 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #343a40;
        }

        .category-card .card-body p {
            font-size: 1rem;
            color: #6c757d;
        }

        .category-card .btn {
            margin-top: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .category-card .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Category Header -->
    <div class="category-header">
        <h1>Jelajahi Kategori Kami</h1>
        <p>Temukan produk yang ada</p>
    </div>

    <!-- Category Container -->
    <div class="container category-container">
        <div class="row">
            <!-- Category 1 -->
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/aksesoris.png" alt="Smartphones">
                    <div class="card-body">
                        <h5>Aksesoris</h5>
                        <p>Beli barang titipan berupa cinderamata</p>
                        <a href="aksesoris.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- Category 2 -->
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/makanan.png" alt="Laptops">
                    <div class="card-body">
                        <h5>Makanan</h5>
                        <p>Makanan juga bisa dititipin lo</p>
                        <a href="makanan.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- Category 3 -->
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/minuman.png" alt="Accessories">
                    <div class="card-body">
                        <h5>Minuman</h5>
                        <p>Minuman juga bisa lo kak</p>
                        <a href="minuman.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/atk.png" alt="Accessories">
                    <div class="card-body">
                        <h5>Alat tulis kantor</h5>
                        <p>Cari alat tulis kantor disini</p>
                        <a href="atk.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/pakaian.png" alt="Accessories">
                    <div class="card-body">
                        <h5>Pakaian</h5>
                        <p>Pakaian juga ada disini</p>
                        <a href="pakaian.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/kado.png" alt="Accessories">
                    <div class="card-body">
                        <h5>Kado</h5>
                        <p>Hadiah untuk orang tercinta ada disini</p>
                        <a href="kado.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/sepatu.png" alt="Accessories">
                    <div class="card-body">
                        <h5>Sepatu</h5>
                        <p>Beli sepatu kesukaanmu disini</p>
                        <a href="sepatu.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <img src="foto/kosmetik.png" alt="Accessories">
                    <div class="card-body">
                        <h5>Kosmetik</h5>
                        <p>Buat dirimu dan pasanganmu terlihat mempesona</p>
                        <a href="kosmetik.php" class="btn btn-primary">Jelajahi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
