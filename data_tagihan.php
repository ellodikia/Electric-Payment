<?php
include 'koneksi.php';
session_start(); 

if (isset($_GET['bayar_id'])) {
    $id_tagihan = mysqli_real_escape_string($koneksi, $_GET['bayar_id']);
    
    $cek_tagihan = mysqli_query($koneksi, "SELECT * FROM payment_tagihan WHERE id = '$id_tagihan'");
    $data = mysqli_fetch_assoc($cek_tagihan);

    if ($data && $data['status'] == 0) {
        $id_pel = $data['id_pelanggan'];
        $bulan  = $data['bulan'];
        $total  = $data['jumlahtagihan'];
        $tgl    = date("Y-m-d");
        $id_byr = "PAY-" . time(); 
        
        $sql_riwayat = "INSERT INTO payment_pembayaran (id_pelanggan, id_bayar, tanggal, bulanbayar, biayaadmin, total, status) 
                        VALUES ('$id_pel', '$id_byr', '$tgl', '$bulan', 2500, '$total', 'Lunas')";
        
        $sql_update_status = "UPDATE payment_tagihan SET status = 1 WHERE id = '$id_tagihan'";

        if (mysqli_query($koneksi, $sql_riwayat) && mysqli_query($koneksi, $sql_update_status)) {
            $_SESSION['cetak_id'] = $id_byr;
            
            echo "<script>
                    alert('Pembayaran Berhasil!');
                    window.location='data_tagihan.php'; 
                  </script>";
            exit;
        }
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM payment_tagihan ORDER BY id DESC");
?>

<?php if (isset($_SESSION['cetak_id'])) : ?>
<script>
    window.open('cetak_struk.php?id=<?= $_SESSION['cetak_id']; ?>', '_blank');
</script>
<?php 
    unset($_SESSION['cetak_id']);
endif; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="" />
    <title>Data Tagihan | Electro Payment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0,0,0,.9);
            font-weight: 500;
        }
        .btn-add-tagihan {
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
        .btn-add-tagihan:hover {
            background-color: #689F38;
        }
        .btn-search {
            background-color: #03A9F4;
            color: white !important;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .card-table {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .badge-lunas {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
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
        <a href="#" class="btn-search"><i class="fa-solid fa-search me-1"></i> Cari Tagihan</a>
    </div>

    <div class="card card-table p-3 bg-white mb-5">
        <h4 class="mb-3 fw-bold">Daftar Tagihan Pelanggan</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>ID Pelanggan</th>
                        <th>Bulan/Tahun</th>
                        <th>Jumlah Meter</th>
                        <th>Total Tagihan</th>
                        <th>Status / Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="fw-bold text-primary"><?= $row['id_pelanggan']; ?></td>
                        <td><?= $row['bulan'] . " " . $row['tahun']; ?></td>
                        <td class="text-center"><?= $row['jumlahmeter']; ?> kWh</td>
                        <td class="fw-bold text-success">Rp <?= number_format($row['jumlahtagihan'], 0, ',', '.'); ?></td>
                        <td class="text-center">
                            <?php if ($row['status'] == 1) : ?>
                                <span class="badge badge-lunas px-3 py-2 rounded-pill">
                                    <i class="fa-solid fa-check-circle me-1"></i> Lunas
                                </span>
                            <?php else : ?>
                                <a href="?bayar_id=<?= $row['id']; ?>" 
                                   class="btn btn-warning btn-sm fw-bold px-3"
                                   onclick="return confirm('Proses pembayaran tagihan ini?')">
                                   <i class="fa-solid fa-credit-card me-1"></i> Bayar Sekarang
                                </a>
                            <?php endif; ?>
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