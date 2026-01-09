<?php
include "koneksi.php";

$kodetarif = mysqli_real_escape_string($koneksi, $_POST['kodetarif']);
$daya = mysqli_real_escape_string($koneksi, $_POST['daya']);
$tarifperkwh = mysqli_real_escape_string($koneksi, $_POST['tarifperkwh']);
$query = "INSERT INTO payment_tarif (kodetarif, daya, tarifperkwh) 
          VALUES ('$kodetarif', '$daya', '$tarifperkwh')";
 
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data Tarif berhasil ditambahkan!'); document.location='data_tarif.php';</script>";
} else {
    die("Gagal menambah data: " . mysqli_error($koneksi));
}
?>