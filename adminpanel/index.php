<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($koneksi, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i>Home
                </li>
            </ol>
        </nav>
        <h2>Halo <?php echo $_SESSION['username']; ?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-list fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-4">Kategori</h3>
                                <p class="fs-2"><?php echo $jumlahKategori; ?> Kategori</p>
                                <p><a href="kategori.php" class="text-light text-decoration-none">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-list fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-4">Produk</h3>
                                <p class="fs-2"><?php echo $jumlahProduk; ?> Produk</p>
                                <p><a href="produk.php" class="text-light text-decoration-none">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>