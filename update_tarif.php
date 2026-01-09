<?php
include "koneksi.php";

$id = (int) $_POST['id'];

$kodetarif = mysqli_real_escape_string($koneksi, $_POST['kodetarif']);
$daya = mysqli_real_escape_string($koneksi, $_POST['daya']);
$tarifperkwh = mysqli_real_escape_string($koneksi, $_POST['tarifperkwh']);


$query = "UPDATE payment_tarif SET
            kodetarif = '$kodetarif',
            daya = '$daya',
            tarifperkwh = '$tarifperkwh'
          WHERE id = '$id'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data tarif berhasil diperbarui!'); document.location='data_tarif.php';</script>";
} else {
    die('Gagal mengupdate: ' . mysqli_error($koneksi));
}
?>
