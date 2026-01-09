<?php
include "koneksi.php";

$id = (int) $_GET['Id'];
$query = "DELETE FROM payment_tarif WHERE Id = $id";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data Tarif berhasil dihapus!'); document.location='data_tarif.php';</script>";
} else {
    die("Gagal menghapus data: " . mysqli_error($koneksi));
}
?>