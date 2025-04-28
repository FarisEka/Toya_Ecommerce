<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['k'];
$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php 
    require "navbar.php"
    ?>
    <div class="container mt-5">
    <h2>Detail Kategori</h2>
    <div class="col-12 com-md-6">
    <form action="" method="post">
        <div>
        <label for="kategori">Kategori</label>
        <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama'] ?>">
        </div>
        <div class="mt-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
            <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
        </div>
    </form>

    <?php
        if (isset($_POST['editBtn'])) {
            $kategori = htmlspecialchars($_POST['kategori']);

            if($data['nama']==$kategori){
                ?>
                <meta http-equiv="refresh" content="0; url=kategori.php" />
                <?php
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama='$kategori'");
                $jumlahData = mysqli_num_rows($query);
                if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-danger mt-3" role="alert">
                        Kategori Sudah Ada
                    </div>
                    <?php
                } else {
                    $querySimpan = mysqli_query($koneksi, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                    if ($querySimpan) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            Berhasil Terupdate
                        </div>
                        <meta http-equiv="refresh" content="0; url=kategori.php" />
                        <?php
                    } else {
                        echo mysqli_error($koneksi);
                    }
                }
            }
        }

        if (isset($_POST['deleteBtn'])) {
            $querycheck = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori_id = '$id'");
            $datacount = mysqli_num_rows($querycheck);
            if ($datacount>0) {
                ?>
                <div class="alert alert-warning mt-3" role="alert">
                            Kategori tidak bisa dihapus karena sudah ada produk
                        </div>
                <?php
                die();
            }
            $queryDelete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id='$id'");
            if($queryDelete){
                ?>
                    <div class="alert alert-primary" role="alert">
                            Berhasil Dihapus
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