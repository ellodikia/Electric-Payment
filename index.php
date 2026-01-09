<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro Pay | Admin Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</head>
<body class="bg-[#121212] text-white min-h-screen">

    <header class="sticky top-0 z-50 bg-[#1e1e1e] border-b border-white/10 shadow-xl">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-black text-yellow-400 flex items-center gap-2 uppercase tracking-tighter">
                <i class="fa-solid fa-bolt-lightning text-white"></i> Electro Pay
            </a>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span class="text-xs text-gray-400 font-medium">Sesi Aktif</span>
                    <span class="text-sm font-bold">Admin Utama</span>
                </div>
                <a href="logout.php" class="bg-yellow-400 hover:bg-yellow-500 text-black px-5 py-2.5 rounded-xl text-sm font-black transition-all">LOGOUT</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <nav class="mb-10 overflow-x-auto scrollbar-hide">
            <ul class="flex items-center gap-3 min-w-max pb-4">
                <li>
                    <a href="index.php?page=dashboard" class="flex items-center gap-3 <?= ($page == 'dashboard') ? 'bg-yellow-400 text-black shadow-xl shadow-yellow-400/10' : 'bg-[#1e1e1e] text-gray-300 border border-white/5' ?> px-6 py-3.5 rounded-2xl text-sm font-black transition">
                        <i class="fa-solid fa-chart-line <?= ($page == 'dashboard') ? '' : 'text-yellow-400' ?>"></i> DASHBOARD
                    </a>
                </li>
                <li>
                    <a href="index.php?page=pelanggan" class="flex items-center gap-3 <?= ($page == 'pelanggan' || $page == 'tambah_pelanggan') ? 'bg-yellow-400 text-black shadow-xl shadow-yellow-400/10' : 'bg-[#1e1e1e] text-gray-300 border border-white/5' ?> px-6 py-3.5 rounded-2xl text-sm font-black transition">
                        <i class="fa-solid fa-users-viewfinder <?= ($page == 'pelanggan' || $page == 'tambah_pelanggan') ? '' : 'text-yellow-400' ?>"></i> PELANGGAN
                    </a>
                </li>
                <li>
                    <a href="index.php?page=pembayaran" class="flex items-center gap-3 <?= ($page == 'pembayaran') ? 'bg-yellow-400 text-black shadow-xl shadow-yellow-400/10' : 'bg-[#1e1e1e] text-gray-300 border border-white/5' ?> px-6 py-3.5 rounded-2xl text-sm font-black transition">
                        <i class="fa-solid fa-file-invoice-dollar <?= ($page == 'pembayaran') ? '' : 'text-yellow-400' ?>"></i> PEMBAYARAN
                    </a>
                </li>
                <li>
                    <a href="index.php?page=tarif" class="flex items-center gap-3 <?= ($page == 'tarif') ? 'bg-yellow-400 text-black shadow-xl shadow-yellow-400/10' : 'bg-[#1e1e1e] text-gray-300 border border-white/5' ?> px-6 py-3.5 rounded-2xl text-sm font-black transition">
                        <i class="fa-solid fa-layer-group <?= ($page == 'tarif') ? '' : 'text-yellow-400' ?>"></i> DATA TARIF
                    </a>
                </li>
                <li>
                    <a href="index.php?page=penggunaan" class="flex items-center gap-3 <?= ($page == 'penggunaan') ? 'bg-yellow-400 text-black shadow-xl shadow-yellow-400/10' : 'bg-[#1e1e1e] text-gray-300 border border-white/5' ?> px-6 py-3.5 rounded-2xl text-sm font-black transition">
                        <i class="fa-solid fa-gauge-high <?= ($page == 'penggunaan') ? '' : 'text-yellow-400' ?>"></i> PENGGUNAAN
                    </a>
                </li>
                <li>
                    <a href="index.php?page=tagihan" class="flex items-center gap-3 <?= ($page == 'tagihan') ? 'bg-yellow-400 text-black shadow-xl shadow-yellow-400/10' : 'bg-[#1e1e1e] text-gray-300 border border-white/5' ?> px-6 py-3.5 rounded-2xl text-sm font-black transition">
                        <i class="fa-solid fa-receipt <?= ($page == 'tagihan') ? '' : 'text-yellow-400' ?>"></i> TAGIHAN
                    </a>
                </li>
            </ul>
        </nav>

        <div class="animate-fadeIn">
            <?php 
                switch ($page) {
                    case 'pelanggan':
                        include "data_pelanggan.php";
                        break;
                    case 'tambah_pelanggan':
                        include "tambah_pelanggan.php";
                        break;
                    case 'pembayaran':
                        include "data_pembayaran.php";
                        break;
                    case 'tarif':
                        include "data_tarif.php";
                        break;
                    case 'penggunaan':
                        include "data_penggunaan.php";
                        break;
                    case 'tagihan':
                        include "data_tagihan.php";
                        break;
                    case 'dashboard':
                    default:
                        include "dashboard_content.php";
                        break;
                }
            ?>
        </div>
    </main>

    <footer class="container mx-auto px-4 py-10 mt-10 border-t border-white/5 text-center text-gray-600">
        <p class="text-xs font-bold uppercase tracking-widest">&copy; 2026 Electro Payment System</p>
    </footer>

</body>
</html>