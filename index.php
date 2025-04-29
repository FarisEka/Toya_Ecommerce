<?php
    require "koneksi.php";
    $queryproduk = mysqli_query($koneksi, "SELECT id,nama,harga,foto,detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizz Cloth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <!-- Banner -->
    <div class="container-fluid bannerku d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Rizz Cloth</h1>
            <h3>Mau Cari Apa</h3>
            <div class="col-md-8 offset-md-2">
                <form action="produk.php" method="get">
                    <div class="input-group my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang"
                            aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button class="btn btn-outline-warning" type="submit">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Highlight -->
    <div class="container-fluid py-4">
        <div class="container text-center">
            <h3>Best Seller</h3>
            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="best-seller kategori-sepatu d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Sepatu">Sepatu</a>
                        </h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="best-seller kategori-tas d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Tas">Tas</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="best-seller kategori-jaket d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Jaket">Jaket Pria</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="container-fluid py-5 warnaku">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo dignissimos alias reprehenderit illum ex
                voluptatibus nulla unde repellat corporis exercitationem, blanditiis sequi rem? Cum nulla aliquam
                repellendus unde asperiores eos reiciendis pariatur inventore perspiciatis, quam dignissimos, ducimus
                itaque commodi aut? Esse sapiente libero iste doloribus. Deserunt doloribus eveniet aliquam molestias
                quia architecto quidem corporis reprehenderit rerum eaque molestiae, officia adipisci non maxime
                veritatis optio commodi in nam ratione dicta rem odio minima nulla. Delectus culpa amet obcaecati eos
                dolor est vel, perferendis eaque quam ipsa cupiditate excepturi necessitatibus itaque saepe rerum!
                Placeat maiores illo quisquam, et nulla excepturi enim atque!
            </p>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">

                <?php while ($data = mysqli_fetch_array($queryproduk)) { ?>

                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                        <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?> </h4>
                            <p class="card-text text-truncate"> <?php echo $data['detail']; ?></p>
                                <p class="card-text text-harga">Rp.<?php echo $data['harga']; ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama'];?>" class="btn btn-primary warnaku">Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-warning" href="produk.php">See More</a>
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