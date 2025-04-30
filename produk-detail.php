<?php
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryproduk);

$auereyprodukterkait = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizz Cloth || Produk-Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <!-- Detail Produk -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <img src="image/<?php echo $produk['foto']; ?>" alt="" class="w-100">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p class="fs-5"><?php echo $produk['detail']; ?></p>
                    <p class="fs-3">
                        Rp.<?php echo $produk['harga']; ?>
                    </p>
                    <p class="fs-5">Status Ketersediaan: <strong><?php echo $produk['ketersediaan_stok']; ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="container-fluid py-5 warnaku">
        <div class="container">
            <h2 class="text-center text-white">Produk Terkait</h2>
            <div class="row">
                <?php
                    while ($data=mysqli_fetch_array($auereyprodukterkait)) {
                ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                    <img src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail produk-terkait-image" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

            <!-- footer -->
            <?php require "footer.php"; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="fontawesome/js/all.min.js"></script>

</body>

</html>