<?php
include "koneksi.php";

$id = (int) $_POST['id'];

$id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
$nometer = mysqli_real_escape_string($koneksi, $_POST['nometer']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$kodetarif = mysqli_real_escape_string($koneksi, $_POST['kodetarif']);

$query = "UPDATE payment_pelanggan SET
            id_pelanggan = '$id_pelanggan',
            nometer = '$nometer',
            nama = '$nama',
            alamat = '$alamat',
            kodetarif = '$kodetarif'
          WHERE id = '$id'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data pelanggan berhasil diperbarui!'); document.location='data_pelanggan.php';</script>";
} else {
    die('Gagal mengupdate: ' . mysqli_error($koneksi));
}
?>
