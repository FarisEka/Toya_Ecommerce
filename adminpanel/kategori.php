<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-decoration-none text-reset" href="../adminpanel"><i class="fas fa-home"></i>Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" class="form-control" name="kategori" id="kategori"
                        placeholder="Input Nama Kategori">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan_kategori'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                $cekNama = mysqli_query($koneksi, "SELECT nama FROM kategori WHERE nama='$kategori'");
                $jumlahDataKategoriBaru = mysqli_num_rows($cekNama);

                if ($jumlahDataKategoriBaru > 0) {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Kategori Sudah Ada
                    </div>
                    <?php
                } else {
                    $querySimpan = mysqli_query($koneksi, "INSERT INTO kategori(nama) VALUES ('$kategori')");

                    if ($querySimpan) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            Berhasil Tersimpan
                        </div>
                        <meta http-equiv="refresh" content="0; url=kategori.php" />
                        <?php
                    } else {
                        echo mysqli_error($koneksi);
                    }
                }
            }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $number = 1;
                        if ($jumlahKategori == 0) {
                            ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada kategori</td>
                            </tr>
                            <?php
                        } else {
                            while ($data = mysqli_fetch_array($queryKategori)) {
                                ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori-detail.php?k=<?php echo $data['id']; ?>" class="btn btn-info"><i
                                                class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $number++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>