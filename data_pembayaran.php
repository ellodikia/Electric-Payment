<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT payment_pembayaran.*, payment_pelanggan.nama 
                                 FROM payment_pembayaran 
                                 JOIN payment_pelanggan ON payment_pembayaran.id_pelanggan = payment_pelanggan.id_pelanggan 
                                 ORDER BY payment_pembayaran.id DESC") or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="" />
    <title>Riwayat Pembayaran | Electro Payment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0,0,0,.9);
            font-weight: 500;
        }
        .btn-print {
            background-color: #8BC34A;
            color: white !important;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            text-decoration: none;
            transition: 0.3s;
            border: none;
        }
        .btn-print:hover {
            background-color: #689F38;
            color: white !important;
        }
        .btn-search {
            background-color: #03A9F4;
            color: white !important;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-search:hover {
            background-color: #0288D1;
        }
        .card-table {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-light">

<nav class="navbar navbar-light bg-light shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold">Electro Payment <i class="fa-solid fa-bolt"></i></a>
        <div class="d-flex">
            <a href="index.php" class="btn btn-primary me-2 d-flex align-items-center">
                Admin <i class="fa-solid fa-user-tie ms-2"></i>
            </a>
            <a href="logout.php" class="btn btn-secondary d-flex align-items-center">
                Keluar <i class="fa-solid fa-right-from-bracket ms-2"></i>
            </a>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light mt-3 shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php"><i class="fa-solid fa-house-user me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_pelanggan.php"><i class="fa-solid fa-tachograph-digital me-1"></i> Data Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_pembayaran.php"><i class="fa-solid fa-tag me-1"></i> Data Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_tarif.php"><i class="fa-solid fa-rupiah-sign me-1"></i> Data Tarif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_penggunaan.php"><i class="fa-solid fa-database me-1"></i> Data Penggunaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_tagihan.php"><i class="fa-solid fa-server me-1"></i> Data Tagihan</a>
                    </li>
                </ul>
            </div>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button onclick="window.print()" class="btn-print"><i class="fa-solid fa-print me-1"></i> Cetak Laporan</button>
        <a href="#" class="btn-search"><i class="fa-solid fa-search me-1"></i> Cari Transaksi</a>
    </div>

    <div class="card card-table p-3 bg-white">
        <h4 class="mb-1 fw-bold">Riwayat Pembayaran</h4>
        <p class="text-muted small mb-3">Daftar seluruh transaksi pelanggan yang telah lunas</p>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>ID Bayar</th>
                        <th>Nama Pelanggan</th>
                        <th>Tgl Bayar</th>
                        <th>Bulan</th>
                        <th>Admin</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="fw-bold text-muted"><?= $row['id_bayar']; ?></td>
                        <td>
                            <div class="fw-bold"><?= $row['nama']; ?></div>
                            <small class="text-muted"><?= $row['id_pelanggan']; ?></small>
                        </td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                        <td class="text-center"><?= $row['bulanbayar']; ?></td>
                        <td>Rp <?= number_format($row['biayaadmin'], 0, ',', '.'); ?></td>
                        <td class="fw-bold text-success">Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <td class="text-center">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fa-solid fa-check me-1"></i> <?= $row['status']; ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>