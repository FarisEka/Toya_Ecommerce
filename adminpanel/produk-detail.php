<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['k'];
$query = mysqli_query($koneksi, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString = $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5 mb-5">
        <h2>Detail Produk</h2>
        <div class="col-12 com-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" id="nama"
                        autocomplete="off" required>
                </div>
                <div class="mt-3">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id'] ?>"><?php echo $data['nama_kategori'] ?></option>
                        <?php
                        while ($datakategori = mysqli_fetch_array($queryKategori)) {
                            ?>
                            <option value="<?php echo $datakategori['id']; ?>">
                                <?php echo $datakategori['nama']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" value="<?php echo $data['harga'] ?>"
                        required>
                </div>

                <div>
                    <label for="current-foto">Foto Produk Sekarang</label>
                    <img src="../image/<?php echo $data['foto'] ?>" alt="" width="300px">
                </div>

                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['detail'] ?>
                    </textarea>
                </div>
                <div class="mt-3">
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php echo $data['ketersediaan_stok'] ?>">
                            <?php echo $data['ketersediaan_stok'] ?>
                        </option>
                        <?php
                        if ($data['ketersediaan_stok'] == 'tersedia') {
                            ?>
                            <option value="habis">Habis</option>
                            <?php
                        } else {
                            ?>
                            <option value="tersedia">Tersedia</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mt-4" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger mt-4" name="hapus">Hapus</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imagefiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $newname = $random_name . "." . $imagefiletype;

                if ($nama == '' || $kategori == '' || $harga == '') {
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Nama, Kategori dan Harga wajib diisi
                    </div>
                    <?php
                } else {
                    $queryupdate = mysqli_query($koneksi, "UPDATE produk SET kategori_id='$kategori',nama='$nama',harga='$harga',detail='$detail',ketersediaan_stok='$ketersediaan_stok' WHERE id='$id' ");

                    if ($nama_file != '') {
                        if ($image_size > 5000000) {
                            ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                File tidak boleh lebih dari 5 mb
                            </div>
                            <?php
                        } else {
                            if ($imagefiletype != 'jpg' && $imagefiletype != 'png' && $imagefiletype != 'jpeg') {
                                ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    File hanya JPG/PNG/JPEG
                                </div>
                                <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newname);

                                $queryupdate = mysqli_query($koneksi, "UPDATE produk SET foto='$newname' WHERE id='$id'");

                                if ($queryupdate) {
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        Produk Berhasil Terupdate
                                    </div>
                                    <meta http-equiv="refresh" content="1; url=produk.php" />
                                    <?php
                                } else {
                                    echo mysqli_error();
                                }
                            }
                        }
                    }
                }
            }
            if (isset($_POST['hapus'])) {
                $queryhapus = mysqli_query($koneksi, "DELETE FROM produk WHERE id='$id'");
                if ($queryhapus) {
                    ?>
                        <div class="alert alert-warning" role="alert">
                                Produk Berhasil Dihapus
                            </div>
                            <meta http-equiv="refresh" content="0; url=kategori.php" />
                    <?php
                } else {
                    echo mysqli_error($koneksi);
                }
            }
            ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>