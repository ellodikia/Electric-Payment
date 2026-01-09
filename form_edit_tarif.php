<?php
include "koneksi.php";

$id = (int) $_GET['Id']; 

$q = mysqli_query($koneksi, "SELECT * FROM payment_tarif WHERE id = $id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    die("Data tarif tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="" />
    <title>Edit Data Tarif</title>
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
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card p-4">
                <h3 class="text-center mb-3">Edit Data Tarif</h3>

                <form action="update_tarif.php" method="post">

                    <input type="hidden" name="id" value="<?= $data['id'] ?>"> <!-- FIX -->

                    <label class="form-label">Kode Tarif</label>
                    <input type="text" class="form-control" name="kodetarif" value="<?= $data['kodetarif'] ?>" required>

                    <label class="form-label mt-3">Daya</label>
                    <input type="text" class="form-control" name="daya" value="<?= $data['daya'] ?>" required>

                    <label class="form-label mt-3">Tarif Per KWH</label>
                    <input type="number" class="form-control" name="tarifperkwh" value="<?= $data['tarifperkwh'] ?>" required>


                    <button type="submit" class="btn btn-success w-100 mt-4">Update</button>

                </form>

                <a href="data_tarif.php" class="btn btn-secondary w-100 mt-3">Kembali</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
