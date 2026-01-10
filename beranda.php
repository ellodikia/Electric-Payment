<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Electro Payment - Beranda</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        .btn-yellow { @apply bg-yellow-brand hover:bg-yellow-500 text-zinc-900 font-bold transition-all px-4 py-2 rounded-lg flex items-center gap-2; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100">

    <nav class="bg-zinc-900 border-b border-zinc-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-yellow-brand text-2xl"><i class="fa-solid fa-bolt"></i></span>
                    <span class="font-bold text-xl tracking-tight">ELECTRO<span class="text-yellow-brand">PAY</span></span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="beranda.php" class="text-zinc-300 hover:text-yellow-brand px-3 py-2 text-sm font-medium transition-colors hidden sm:block">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                    <a href="login.php" class="bg-yellow-brand text-zinc-900 px-4 py-2 rounded-lg text-sm font-bold hover:bg-yellow-500 transition-all">
                        <i class="fa-solid fa-right-to-bracket mr-1"></i> MASUK
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative h-56 overflow-hidden rounded-2xl md:h-96 border border-zinc-800 shadow-2xl">
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="image/6.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="image/2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="image/3.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                </div>
            </div>
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                <button type="button" class="w-3 h-3 rounded-full bg-yellow-brand" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-zinc-500" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-zinc-500" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            </div>
        </div>
    </div>

    <div class="bg-zinc-900/50 border-y border-zinc-800 mt-8">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex overflow-x-auto py-3 gap-8 no-scrollbar">
                <li>
                    <a href="#" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li>
                    <a href="data_tarif_user.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-rupiah-sign"></i> Info Tarif
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            
            <div class="bg-zinc-900 p-8 rounded-3xl border border-zinc-800 shadow-xl">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-yellow-brand/10 text-yellow-brand flex items-center justify-center rounded-2xl text-xl">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Cek Tagihan</h2>
                </div>
                
                <form action="" method="GET" class="space-y-4">
                    <div class="relative group">
                        <label class="block text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2 ml-1">ID Pelanggan</label>
                        <input 
                            type="text" 
                            name="id_pelanggan"
                            placeholder="Contoh: 1209384XXX" 
                            class="w-full bg-zinc-800 border border-zinc-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand transition-all"
                            required
                        >
                    </div>
                    <button type="submit" class="w-full bg-yellow-brand hover:bg-yellow-500 text-zinc-950 font-black py-4 rounded-xl shadow-lg shadow-yellow-900/20 flex items-center justify-center gap-2 transition-transform active:scale-95">
                        PERIKSA SEKARANG <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <div class="flex flex-col md:items-end space-y-6">
                <div class="text-left md:text-right">
                    <h2 class="text-2xl font-bold mb-2">Hubungi Kami</h2>
                    <p class="text-zinc-500 text-sm">Layanan pelanggan tersedia 24/7 untuk membantu Anda.</p>
                </div>
                
                <div class="flex gap-4">
                    <a href="#" class="w-14 h-14 bg-zinc-900 border border-zinc-800 rounded-2xl flex items-center justify-center text-zinc-400 hover:text-yellow-brand hover:border-yellow-brand transition-all group">
                        <i class="fa-brands fa-facebook-f text-2xl"></i>
                    </a>
                    <a href="#" class="w-14 h-14 bg-zinc-900 border border-zinc-800 rounded-2xl flex items-center justify-center text-zinc-400 hover:text-yellow-brand hover:border-yellow-brand transition-all group">
                        <i class="fa-brands fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="w-14 h-14 bg-yellow-brand/5 border border-yellow-brand/20 rounded-2xl flex items-center justify-center text-yellow-brand hover:bg-yellow-brand hover:text-zinc-950 transition-all group">
                        <i class="fa-solid fa-phone text-2xl"></i>
                    </a>
                </div>
                
                <div class="bg-zinc-900/40 p-4 rounded-2xl border border-zinc-800/50 md:max-w-xs">
                    <p class="text-zinc-500 text-xs italic text-center md:text-right">
                        "Bayar listrik jadi lebih mudah, cepat, dan aman dengan sistem pembayaran digital kami."
                    </p>
                </div>
            </div>

        </div>
    </main>

    <footer class="text-center py-8 border-t border-zinc-900 mt-12">
        <p class="text-zinc-600 text-xs uppercase tracking-widest font-bold">
            &copy; <?php echo date('Y'); ?> Electro Payment System - All Secure
        </p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>