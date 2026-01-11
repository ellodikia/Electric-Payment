<?php
include 'koneksi.php';
require('fpdf.php'); 

function terbilang($x) {
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
    if ($x < 12) return " " . $angka[(int)$x];
    elseif ($x < 20) return terbilang($x - 10) . " belas";
    elseif ($x < 100) return terbilang($x / 10) . " puluh" . terbilang($x % 10);
    elseif ($x < 200) return " seratus" . terbilang($x - 100);
    elseif ($x < 1000) return terbilang($x / 100) . " ratus" . terbilang($x % 100);
    elseif ($x < 2000) return " seribu" . terbilang($x - 1000);
    elseif ($x < 1000000) return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
    return " nilai terlalu besar";
}

$idb = mysqli_real_escape_string($koneksi, $_GET['id_bayar'] ?? $_GET['id'] ?? '');
if (empty($idb)) die("ID Pembayaran tidak ditemukan.");

$query_pembayaran = mysqli_query($koneksi, "SELECT * FROM payment_pembayaran WHERE id_bayar='$idb'");
$row = mysqli_fetch_assoc($query_pembayaran);

if (!$row) die("Data transaksi tidak valid.");

$id_pel = $row['id_pelanggan'];
$bulan  = $row['bulanbayar'];

$query_pelanggan = mysqli_query($koneksi, "SELECT * FROM payment_pelanggan WHERE id_pelanggan='$id_pel'");
$c = mysqli_fetch_assoc($query_pelanggan);

$query_penggunaan = mysqli_query($koneksi, "SELECT * FROM payment_penggunaan WHERE id_pelanggan='$id_pel' AND bulan='$bulan'");
$e = mysqli_fetch_assoc($query_penggunaan);

$nama    = strtoupper($c['nama'] ?? 'PELANGGAN');
$alamat  = $c['alamat'] ?? '-';
$tarif   = $c['id_tarif'] ?? '-';
$mawal   = $e['meter_awal'] ?? '0';
$makhir  = $e['meter_akhir'] ?? '0';
$total   = (float)$row['total'];
$admin   = (float)$row['biayaadmin'];
$jumlah  = $total - $admin;

$pdf = new FPDF('L','mm',array(210, 148));
$pdf->AddPage();
$pdf->SetFont('Courier','B',14);

$pdf->Cell(0,7,'ELEKTRO PAYMENT',0,1,'C');
$pdf->SetFont('Courier','',10);
$pdf->Cell(0,5,str_repeat('=', 65),0,1,'C');
$pdf->Cell(0,5,'STRUK PEMBAYARAN TAGIHAN LISTRIK',0,1,'C');
$pdf->Ln(4);

$pdf->Cell(45,6,'TANGGAL BAYAR  :',0,0); $pdf->Cell(60,6, date('d/m/Y', strtotime($row['tanggal'])),0,0);
$pdf->Cell(25,6,'BANK     :',0,0); $pdf->Cell(0,6,'BANK BNI',0,1);

$pdf->Cell(45,6,'ID TRANSAKSI   :',0,0); $pdf->Cell(0,6, $idb,0,1);
$pdf->Cell(45,6,'ID PELANGGAN   :',0,0); $pdf->Cell(0,6, $id_pel,0,1);
$pdf->Cell(45,6,'NAMA           :',0,0); $pdf->Cell(0,6, $nama,0,1);
$pdf->Cell(45,6,'ALAMAT         :',0,0); $pdf->Cell(0,6, $alamat,0,1);
$pdf->Cell(45,6,'STAND METER    :',0,0); $pdf->Cell(0,6, $mawal . ' - ' . $makhir,0,1);

$pdf->Cell(0,2,str_repeat('-', 65),0,1,'C');

$pdf->Cell(45,6,'JUMLAH TAGIHAN :',0,0); $pdf->Cell(0,6,'Rp '.number_format($jumlah,0,',','.'),0,1);
$pdf->Cell(45,6,'BIAYA ADMIN    :',0,0); $pdf->Cell(0,6,'Rp '.number_format($admin,0,',','.'),0,1);
$pdf->SetFont('Courier','B',12);
$pdf->Cell(45,8,'TOTAL BAYAR    :',0,0); $pdf->Cell(0,8,'Rp '.number_format($total,0,',','.'),0,1);

$pdf->SetFont('Courier','I',10);
$pdf->Cell(45,6,'TERBILANG      :',0,0); 
$pdf->MultiCell(0,6, strtoupper(terbilang($total))." RUPIAH",0,'L');

$pdf->Ln(5);
$pdf->SetFont('Courier','',9);
$pdf->Cell(0,5,'Simpan struk ini sebagai bukti pembayaran yang sah.',0,1,'C');

$pdf->Output('I', 'Struk_'.$idb.'.pdf');
?>