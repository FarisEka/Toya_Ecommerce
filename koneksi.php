<?php
$koneksi = mysqli_connect ("localhost", "root", "", "toyyy_shop");
if (mysqli_connect_errno()) {
  echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>