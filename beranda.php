<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="" />
    <title>Electro Payment - Beranda</title>
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
        }
        
        
        .social-icons a i {
            color: #0d6efd;
            transition: color 0.3s;
        }
        .social-icons a i:hover {
            color: #0a58ca;
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
    <div class="container mt-4">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow">
                <div class="carousel-item active">
                    <img src="image/6.png" class="d-block w-100" alt="Iklan Pembayaran Listrik 1">
                </div>
                <div class="carousel-item">
                    <img src="image/2.png" class="d-block w-100" alt="Iklan Pembayaran Listrik 1">
                </div>
                <div class="carousel-item">
                    <img src="image/3.png" class="d-block w-100" alt="Iklan Pembayaran Listrik 2">
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-4 shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" aria-current="page" href="#"><i class="fa-solid fa-house"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_tarif_user.php"><i class="fa-solid fa-rupiah-sign"></i> Tarif</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 col-12 mb-5 mb-md-0">
                <h2 class="mb-3">Cek Tagihan</h2>
                <form>
                    <div style="max-width: 400px;">
                        <input 
                            type="text" 
                            placeholder="ID Pelanggan" 
                            class="form-control" 
                            name="id_pelanggan"
                            required
                        >
                        <button type="submit" class="btn btn-success mt-3">Cek</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 col-12 d-flex flex-column align-items-md-end align-items-start">
                <h2 class="mb-3">Media Sosial</h2>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook fa-2x me-3"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram fa-2x me-3"></i></a>
                    <a href="#"><i class="fa-solid fa-phone fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>