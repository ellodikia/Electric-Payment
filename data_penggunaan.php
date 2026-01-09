<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM payment_penggunaan ORDER BY id DESC") or die(mysqli_error($koneksi));
$is_admin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="" />
    <title>Data Tarif | Electro Payment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0,0,0,.9);
            font-weight: 500;
        }
        .btn-add {
            background-color: #8BC34A;
            color: white !important;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-add:hover {
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

<body>

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
        <a href="form_add_penggunaan.php" class="btn-add"><i class="fa-solid fa-plus me-1"></i> Tambah Data</a>
        <a href="#" class="btn-search"><i class="fa-solid fa-search me-1"></i> Cari Data</a>
    </div>

    <div class="card card-table p-3">
        <h4 class="mb-3 fw-bold">Data Tarif</h4>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Meter Awal</th>
                    <th>Meter Akhir</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td class='text-center'>{$no}</td>";
                    echo "<td>{$row['id_pelanggan']}</td>";
                    echo "<td>{$row['bulan']}</td>";
                    echo "<td>{$row['tahun']}</td>";
                    echo "<td>{$row['meterawal']}</td>";
                    echo "<td>{$row['meterakhir']}</td>";

                    echo "<td class='text-center'>
                        <a href='form_edit_penggunaan.php?Id={$row['id']}' class='text-primary fw-bold me-2'>Edit</a>
                        <a href='delete_data_penggunaan.php?Id={$row['id']}' class='text-danger fw-bold' onclick=\"return confirm('Yakin hapus data ini?')\">Hapus</a>
                    </td>";

                    echo "</tr>";
                    $no++;
                }
            ?>
            </tbody>
        </table>
    </div>

</div>


</body>
</html>
