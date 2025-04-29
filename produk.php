<?php
require "koneksi.php";

$querykategori = mysqli_query($koneksi, "SELECT * FROM kategori");

//get produk by nama produk
if (isset($_GET['keyword'])) {
    $queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}

//get produkby kategori
elseif (isset($_GET['kategori'])) {
    $querygetkategoriid = mysqli_query($koneksi, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriid = mysqli_fetch_array($querygetkategoriid);

    $queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori_id='$kategoriid[id]'");
}

//get produk default
else {
    $queryproduk = mysqli_query($koneksi, "SELECT * FROM produk");
}

$countdata = mysqli_num_rows($queryproduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizz Cloth | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php require "navbar.php"; ?>

    <!-- Banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>

    <!-- Body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($querykategori)) { ?>
                        <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                            <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                    if ($countdata < 1) {
                        ?>
                        <h4 class="text-center my-5">Produk yang ada cari tidak tersedia</h4>
                        <?php
                    }
                    ?>

                    <?php while ($produk = mysqli_fetch_array($queryproduk)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="image-box">
                                    <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $produk['nama']; ?> </h4>
                                    <p class="card-text text-truncate"> <?php echo $produk['detail']; ?></p>
                                    <p class="card-text text-harga">Rp.<?php echo $produk['harga']; ?></p>
                                    <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>"
                                        class="btn btn-primary warnaku">Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
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