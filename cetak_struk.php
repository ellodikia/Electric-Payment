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

$idb = mysqli_real_escape_string($koneksi, $_GET['id'] ?? '');

if (empty($idb)) {
    die("ID Pembayaran tidak ditemukan.");
}

$query = mysqli_query($koneksi, "SELECT p.*, pl.nama, pl.alamat, pl.nometer, t.daya, t.tarifperkwh, tg.jumlahmeter 
    FROM payment_pembayaran p 
    JOIN payment_pelanggan pl ON p.id_pelanggan = pl.id_pelanggan 
    JOIN payment_tarif t ON pl.kodetarif = t.kodetarif 
    JOIN payment_tagihan tg ON p.id_pelanggan = tg.id_pelanggan AND p.bulanbayar = tg.bulan
    WHERE p.id_bayar = '$idb' LIMIT 1");

$row = mysqli_fetch_assoc($query);

if (!$row) {
    die("Data pembayaran tidak ditemukan di database.");
}

$pdf = new FPDF('P', 'mm', array(210, 297));
$pdf->AddPage();
$pdf->SetFont('Courier', 'B', 14);

$pdf->Cell(0, 7, 'ELECTRO PAYMENT', 0, 1, 'C');
$pdf->SetFont('Courier', '', 10);
$pdf->Cell(0, 5, str_repeat('=', 65), 0, 1, 'C');
$pdf->Cell(0, 5, 'STRUK PEMBAYARAN TAGIHAN LISTRIK', 0, 1, 'C');
$pdf->Ln(4);

$pdf->Cell(45, 6, 'TANGGAL BAYAR  :', 0, 0); $pdf->Cell(60, 6, date('d/m/Y', strtotime($row['tanggal'])), 0, 0);
$pdf->Cell(25, 6, 'BANK     :', 0, 0); $pdf->Cell(0, 6, 'BANK BNI', 0, 1);

$pdf->Cell(45, 6, 'ID TRANSAKSI   :', 0, 0); $pdf->Cell(0, 6, $row['id_bayar'], 0, 1);
$pdf->Cell(45, 6, 'ID PELANGGAN   :', 0, 0); $pdf->Cell(0, 6, $row['id_pelanggan'], 0, 1);
$pdf->Cell(45, 6, 'NAMA           :', 0, 0); $pdf->Cell(0, 6, strtoupper($row['nama']), 0, 1);
$pdf->Cell(45, 6, 'ALAMAT         :', 0, 0); $pdf->Cell(0, 6, strtoupper($row['alamat']), 0, 1);
$pdf->Cell(45, 6, 'TARIF/DAYA     :', 0, 0); $pdf->Cell(0, 6, $row['daya'] . ' VA', 0, 1);
$pdf->Cell(45, 6, 'BULAN/TAHUN    :', 0, 0); $pdf->Cell(0, 6, strtoupper($row['bulanbayar']), 0, 1);
$pdf->Cell(45, 6, 'STAND METER    :', 0, 0); $pdf->Cell(0, 6, $row['jumlahmeter'] . ' kWh', 0, 1);

$pdf->Cell(0, 5, str_repeat('-', 65), 0, 1, 'C');

$pdf->Cell(45, 6, 'RP TAG PLN     :', 0, 0); $pdf->Cell(0, 6, 'Rp ' . number_format($row['total'] - $row['biayaadmin'], 0, ',', '.'), 0, 1);
$pdf->Cell(45, 6, 'ADMIN BANK     :', 0, 0); $pdf->Cell(0, 6, 'Rp ' . number_format($row['biayaadmin'], 0, ',', '.'), 0, 1);
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(45, 6, 'TOTAL BAYAR    :', 0, 0); $pdf->Cell(0, 6, 'Rp ' . number_format($row['total'], 0, ',', '.'), 0, 1);
$pdf->SetFont('Courier', 'I', 9);
$pdf->Cell(45, 6, 'TERBILANG      :', 0, 0); $pdf->Cell(0, 6, strtoupper(terbilang($row['total'])) . ' RUPIAH', 0, 1);

$pdf->Ln(4);
$pdf->SetFont('Courier', '', 9);
$pdf->Cell(0, 5, str_repeat('=', 65), 0, 1, 'C');
$pdf->Cell(0, 5, 'Listrik adalah energi untuk kehidupan yang lebih baik.', 0, 1, 'C');
$pdf->Cell(0, 5, 'Terima Kasih.', 0, 1, 'C');
$pdf->Cell(0, 5, str_repeat('=', 65), 0, 1, 'C');

$pdf->Output('I', 'Struk_' . $row['id_pelanggan'] . '.pdf');
?>