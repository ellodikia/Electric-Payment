<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM payment_tarif ORDER BY id DESC") or die(mysqli_error($koneksi));
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
        <a href="beranda.php" class="btn btn-primary me-2"><i class="fa-solid fa-house"></i> Beranda</a>
                <a href="login.php" class="btn btn-secondary"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
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
                        <a class="nav-link active" aria-current="page" href="beranda.php"><i class="fa-solid fa-house-user me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_tarif.php"><i class="fa-solid fa-rupiah-sign me-1"></i> Data Tarif</a>
                    </li>
                </ul>
            </div>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="search_komite.php" class="btn-search"><i class="fa-solid fa-search me-1"></i> Cari Data</a>
    </div>

    <div class="card card-table p-3">
        <h4 class="mb-3 fw-bold">Data Tarif</h4>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Kode Tarif</th>
                    <th>Daya</th>
                    <th>Tarif Per KWH</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td class='text-center'>{$no}</td>";
                    echo "<td>{$row['kodetarif']}</td>";
                    echo "<td>{$row['daya']}</td>";
                    echo "<td>{$row['tarifperkwh']}</td>";

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
