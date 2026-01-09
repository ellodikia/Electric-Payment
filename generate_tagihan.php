<?php
include 'koneksi.php';

$query_penggunaan = mysqli_query($koneksi, "SELECT p.*, pl.kodetarif, t.tarifperkwh 
    FROM payment_penggunaan p
    JOIN payment_pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
    JOIN payment_tarif t ON pl.kodetarif = t.kodetarif");

$berhasil = 0;
$skipping = 0;

while ($data = mysqli_fetch_assoc($query_penggunaan)) {
    $id_pel = $data['id_pelanggan'];
    $bulan = $data['bulan'];
    $tahun = $data['tahun'];
    
    $cek = mysqli_query($koneksi, "SELECT * FROM payment_tagihan 
           WHERE id_pelanggan = '$id_pel' AND bulan = '$bulan' AND tahun = '$tahun'");
    
    if (mysqli_num_rows($cek) == 0) {
        $jumlah_meter = $data['meter_akhir'] - $data['meter_awal'];
        $total_tagihan = $jumlah_meter * $data['tarifperkwh'];
        
        $insert = mysqli_query($koneksi, "INSERT INTO payment_tagihan 
            (id_pelanggan, bulan, tahun, jumlahmeter, status, jumlahtagihan) 
            VALUES ('$id_pel', '$bulan', '$tahun', '$jumlah_meter', 0, '$total_tagihan')");
        
        if ($insert) $berhasil++;
    } else {
        $skipping++;
    }
}

echo "<script>
    alert('Generate Selesai! $berhasil tagihan baru dibuat. $skipping tagihan sudah ada sebelumnya.');
    window.location='index.php?page=tagihan';
</script>";
?>