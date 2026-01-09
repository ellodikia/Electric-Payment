<?php
include "koneksi.php";

$id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
$bulan = mysqli_real_escape_string($koneksi, $_POST['bulan']);
$tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);
$meterawal = mysqli_real_escape_string($koneksi, $_POST['meterawal']);
$meterakhir = mysqli_real_escape_string($koneksi, $_POST['meterakhir']);

$jumlahmeter = $meterakhir - $meterawal;

$q = mysqli_query($koneksi, 
    "SELECT payment_tarif.tarifperkwh 
     FROM payment_pelanggan 
     JOIN payment_tarif ON payment_pelanggan.kodetarif = payment_tarif.kodetarif
     WHERE payment_pelanggan.id_pelanggan='$id_pelanggan'"
);

$tarif = mysqli_fetch_assoc($q);
$tarifperkwh = $tarif['tarifperkwh'];

$jumlahtagihan = $jumlahmeter * $tarifperkwh;


$query1 = "INSERT INTO payment_penggunaan 
           (id_pelanggan, bulan, tahun, meterawal, meterakhir) 
           VALUES 
           ('$id_pelanggan', '$bulan', '$tahun', '$meterawal', '$meterakhir')";


$query2 = "INSERT INTO payment_tagihan 
           (id_pelanggan, bulan, tahun, jumlahmeter, jumlahtagihan, status)
           VALUES 
           ('$id_pelanggan', '$bulan', '$tahun', '$jumlahmeter', '$jumlahtagihan', 0)";

if (mysqli_query($koneksi, $query1)) {
    if (mysqli_query($koneksi, $query2)) {
        echo "<script>alert('Data berhasil ditambahkan!'); document.location='data_penggunaan.php';</script>";
    } else {
        die("Gagal menambah data ke payment_tagihan: " . mysqli_error($koneksi));
    }
} else {
    die("Gagal menambah data ke payment_penggunaan: " . mysqli_error($koneksi));
}
?>
