<?php
include 'koneksi.php';

$tarif = mysqli_query($koneksi, "SELECT kodetarif, daya FROM payment_tarif");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="" />
    <title>Tambah Data Pelanggan | Electro Payment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0,0,0,.9);
            font-weight: 500;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                <h3 class="mb-3 text-center">Tambah Data Pelanggan</h3>

                <form action="insert_pelanggan.php" method="post">

                    <label class="form-label">ID Pelanggan</label>
                    <input type="number" class="form-control" name="id_pelanggan" required>

                    <label class="form-label mt-3">Nometer</label>
                    <input type="number" class="form-control" name="nometer" required>

                    <label class="form-label mt-3">Nama</label>
                    <input type="text" class="form-control" name="nama" required>

                    <label class="form-label mt-3">Alamat</label>
                    <input type="text" class="form-control" name="alamat">

                    <label class="form-label mt-3">Kode Tarif</label>
                    <select name="kodetarif" class="form-select" required>
                        <option value="">-- Pilih Kode Tarif --</option>
                        <?php while ($row = mysqli_fetch_assoc($tarif)) { ?>
                            <option value="<?= $row['kodetarif'] ?>">
                                <?= $row['kodetarif'] ?> - <?= $row['daya'] ?> VA
                            </option>
                        <?php } ?>
                    </select>

                    <button type="submit" class="btn btn-success w-100 mt-4">Simpan</button>

                </form>

                <a href="data_pelanggan.php" class="btn btn-outline-secondary w-100 mt-3">
                    Kembali
                </a>

            </div>

        </div>
    </div>
</div>

</body>
</html>
