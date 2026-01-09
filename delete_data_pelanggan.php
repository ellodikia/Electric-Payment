<?php
include "koneksi.php";

$id = (int) $_GET['Id'];
$query = "DELETE FROM payment_pelanggan WHERE Id = $id";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data Pelanggan berhasil dihapus!'); document.location='data_pelanggan.php';</script>";
} else {
    die("Gagal menghapus data: " . mysqli_error($koneksi));
}
?>