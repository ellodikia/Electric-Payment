<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Electro Payment</title>
    <link rel="icon" href="image/logo.png" type="" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        .btn a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0;
        }
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0,0,0,.9);
            font-weight: 500;
        }
        
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            padding: 15px;
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

    <div class="container mt-4">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow">
                <div class="carousel-item active">
                    <img src="image/6.png" class="d-block w-100" alt="Iklan Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="image/2.png" class="d-block w-100" alt="Iklan Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="image/3.png" class="d-block w-100" alt="Iklan Slide 2">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-4 shadow-sm sticky-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="row">
            <div class="col-lg-7 col-md-6 mb-4 mb-md-0">
                <h2 class="mb-3">Cek Tagihan Pelanggan</h2>
                <div class="input-group" style="max-width: 450px;">
                    <input type="text" class="form-control" placeholder="Masukkan ID Pelanggan" aria-label="ID Pelanggan">
                    <button class="btn btn-primary" type="button">Cek</button>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 d-flex justify-content-md-end justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-3">Profil Admin</h5>
                        <img src="image/5.png" class="card-img-top rounded-circle mb-3" alt="Foto Profil Admin" style="width: 150px; height: 150px; object-fit: cover;">
                        <p class="card-text text-muted">Selamat datang kembali di Dashboard!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>