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
    <title>Login | Electro Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-[#121212] text-white min-h-screen flex items-center justify-center p-4">

    <div class="max-w-4xl w-full grid md:grid-cols-2 bg-[#1e1e1e] rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5">
        
        <div class="hidden md:flex flex-col justify-center items-center p-12 bg-yellow-400 relative overflow-hidden">
            <i class="fa-solid fa-bolt-lightning absolute -top-10 -left-5 text-[15rem] text-black/5 rotate-12"></i>
            <img src="image/5.png" alt="Login" class="w-64 h-64 object-contain relative z-10 grayscale brightness-50 contrast-150">
            <div class="text-center mt-8 relative z-10">
                <h2 class="text-3xl font-black text-black uppercase tracking-tighter italic">Electro Pay</h2>
                <p class="text-black/60 font-bold text-sm uppercase tracking-widest">Administrator Access</p>
            </div>
        </div>

        <div class="p-8 md:p-12 flex flex-col justify-center">
            <div class="mb-10 text-center md:text-left">
                <h3 class="text-3xl font-black uppercase tracking-tight italic">Welcome <span class="text-yellow-400">Back.</span></h3>
                <p class="text-gray-500 font-medium">Silakan masuk ke akun administrator Anda.</p>
            </div>

            <?php if ($error): ?>
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-center gap-3 text-red-500 text-sm font-bold">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2 ml-2">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-600">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        <input type="text" name="user" required 
                            class="w-full pl-12 pr-5 py-4 bg-[#121212] border border-white/10 rounded-2xl focus:outline-none focus:ring-2 focus:ring-yellow-400 transition text-white font-bold"
                            placeholder="Username" autocomplete="off">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2 ml-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-600">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="pass" required 
                            class="w-full pl-12 pr-5 py-4 bg-[#121212] border border-white/10 rounded-2xl focus:outline-none focus:ring-2 focus:ring-yellow-400 transition text-white font-bold"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" 
                    class="w-full py-4 bg-yellow-400 hover:bg-yellow-500 text-black rounded-2xl font-black uppercase tracking-widest transition transform hover:scale-[1.02] shadow-xl shadow-yellow-400/10">
                    Sign In <i class="fa-solid fa-arrow-right-to-bracket ml-2"></i>
                </button>
            </form>

            <div class="mt-10 text-center">
                <a href="beranda.php" class="text-xs font-black text-gray-600 hover:text-yellow-400 uppercase tracking-widest transition">
                    <i class="fa-solid fa-chevron-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</body>
</html>