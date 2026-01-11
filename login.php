<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_SESSION['user'])) {
    header("Location: index2.php");
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
                header("Location: index2.php");
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
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Login Administrator | Electro Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        .border-yellow-brand { border-color: #FACC15; }
    </style>
</head>
<body class="bg-zinc-950 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 bg-zinc-900 rounded-2xl overflow-hidden shadow-2xl border border-zinc-800">
        
        <div class="bg-yellow-brand p-8 flex flex-col justify-center items-center text-zinc-950">
            <img src="image/5.png" alt="Ilustrasi Login" class="w-2/3 md:w-3/4 h-auto drop-shadow-xl mb-6">
            <div class="text-center">
                <h4 class="text-2xl font-bold uppercase tracking-tighter italic">Electro Payment System</h4>
                <div class="h-1 w-12 bg-zinc-950 mx-auto my-2 rounded-full"></div>
                <p class="text-sm font-medium opacity-80">Secure Administrator Access</p>
            </div>
        </div>

        <div class="p-8 md:p-12 flex flex-col justify-center bg-zinc-900">
            <div class="mb-8">
                <h3 class="text-white text-3xl font-bold flex items-center gap-3">
                    <span class="bg-yellow-brand text-zinc-900 p-2 rounded-lg">
                        <i class="fa-solid fa-shield-halved"></i>
                    </span>
                    Login
                </h3>
                <p class="text-zinc-400 mt-2 text-sm">Silahkan masukkan kredensial admin Anda.</p>
            </div>

            <?php if ($error): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-3 rounded-lg text-sm mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label for="username" class="block text-zinc-300 text-sm font-medium mb-2">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-500 group-focus-within:text-yellow-brand transition-colors">
                            <i class="fa-solid fa-user text-sm"></i>
                        </div>
                        <input type="text" 
                               id="username" 
                               name="user" 
                               class="block w-full pl-10 pr-3 py-3 bg-zinc-800 border border-zinc-700 text-zinc-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand transition-all placeholder-zinc-500" 
                               placeholder="AdminID" 
                               required 
                               autocomplete="off">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-zinc-300 text-sm font-medium mb-2">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-500 group-focus-within:text-yellow-brand transition-colors">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="pass" 
                               class="block w-full pl-10 pr-3 py-3 bg-zinc-800 border border-zinc-700 text-zinc-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand transition-all placeholder-zinc-500" 
                               placeholder="••••••••" 
                               required>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full bg-yellow-brand hover:bg-yellow-500 text-zinc-950 font-bold py-3 px-4 rounded-xl shadow-lg shadow-yellow-900/10 transform transition-all active:scale-[0.98] flex items-center justify-center gap-2 group">
                        <span>MASUK KE DASHBOARD</span>
                        <i class="fa-solid fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </form>

           <?php include 'footer.php'; ?>

        </div>
    </div>

</body>
</html>