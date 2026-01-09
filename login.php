<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['user'] ?? '');
    $pass = trim($_POST['pass'] ?? '');
    
    if (empty($user) || empty($pass)) {
        $error = "Username dan Password harus diisi.";
    } else {
        $stmt = $koneksi->prepare("SELECT user, pass FROM payment_login WHERE user = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if ($pass === $row['pass']) {
                $_SESSION['user'] = $row['user'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="image/logo.png" type="" />
    <title>Login Administrator</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .login-img {
            max-width: 80%; 
            height: auto;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            border-radius: 8px;
        }
        .error-alert {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
        }
        .text-primary-brand {
            color: #0d6efd;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 text-center d-none d-md-block">
                <img src="image/5.png" alt="Ilustrasi Login" class="login-img img-fluid">
                <h4 class="mt-3 text-primary-brand">Electro Payment System</h4>
                <p class="text-muted">Akses ke sistem manajemen administrator.</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="login-container">
                    <h3 class="text-center mb-4"><i class="fa-solid fa-lock me-2"></i> Login</h3>
                    
                    <?php if ($error): ?>
                        <div class='error-alert'><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="user" required placeholder="Masukkan username" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                <input type="password" class="form-control" id="password" name="pass" required placeholder="Masukkan password">
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>