<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM payment_tarif ORDER BY id DESC") or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tarif | Electro Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#121212] text-white min-h-screen">

    <header class="sticky top-0 z-50 bg-[#1e1e1e]/90 backdrop-blur-lg border-b border-white/5 shadow-xl">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a class="text-2xl font-black text-yellow-400 flex items-center gap-2 uppercase tracking-tighter">
                <i class="fa-solid fa-bolt-lightning text-white"></i> Electro Pay
            </a>
            <div class="flex items-center gap-3">
                <a href="beranda.php" class="flex items-center gap-2 bg-[#2a2a2a] text-white hover:bg-white hover:text-black px-5 py-2 rounded-xl text-sm font-bold transition border border-white/10">
                    <i class="fa-solid fa-house text-yellow-400"></i> <span class="hidden sm:inline">HOME</span>
                </a>
                <a href="login.php" class="flex items-center gap-2 bg-yellow-400 text-black px-5 py-2 rounded-xl text-sm font-black transition transform hover:scale-105">
                    <i class="fa-solid fa-right-to-bracket"></i> LOGIN
                </a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <nav class="mb-8 overflow-x-auto">
            <ul class="flex items-center gap-3 min-w-max pb-2">
                <li>
                    <a href="beranda.php" class="flex items-center gap-2 bg-[#1e1e1e] hover:bg-[#2a2a2a] text-gray-400 px-6 py-3 rounded-2xl text-sm font-bold transition border border-white/5">
                        <i class="fa-solid fa-gauge-high text-yellow-400"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="data_tarif.php" class="flex items-center gap-2 bg-yellow-400 text-black px-6 py-3 rounded-2xl text-sm font-black shadow-lg shadow-yellow-400/10 transition">
                        <i class="fa-solid fa-rupiah-sign"></i> Data Tarif
                    </a>
                </li>
            </ul>
        </nav>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter">List <span class="text-yellow-400">Data Tarif</span></h2>
                <p class="text-gray-500 font-medium text-sm">Informasi klasifikasi daya dan harga per KWH</p>
            </div>
            <a href="search_komite.php" class="flex items-center gap-2 bg-white hover:bg-yellow-400 text-black px-6 py-3 rounded-2xl font-black text-sm transition-all shadow-lg hover:shadow-yellow-400/20 uppercase tracking-widest">
                <i class="fa-solid fa-magnifying-glass"></i> Cari Data
            </a>
        </div>

        <div class="bg-[#1e1e1e] rounded-[2rem] border border-white/5 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#252525] border-b border-white/5">
                            <th class="px-6 py-5 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center w-20">No</th>
                            <th class="px-6 py-5 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Kode Tarif</th>
                            <th class="px-6 py-5 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Kapasitas Daya</th>
                            <th class="px-6 py-5 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Tarif Per KWH</th>
                            <th class="px-6 py-5 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-5 text-sm font-black text-gray-500 text-center"><?= $no; ?></td>
                            <td class="px-6 py-5">
                                <span class="text-white font-bold tracking-wider"><?= $row['kodetarif']; ?></span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-yellow-400/10 flex items-center justify-center text-yellow-400 text-xs">
                                        <i class="fa-solid fa-bolt"></i>
                                    </div>
                                    <span class="text-gray-300 font-semibold"><?= $row['daya']; ?> <span class="text-[10px] text-gray-500">VA</span></span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-yellow-400 font-black tracking-tight">Rp <?= number_format($row['tarifperkwh'], 0, ',', '.'); ?></span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 bg-green-500/10 text-green-500 text-[10px] font-black rounded-lg uppercase border border-green-500/20">Active</span>
                            </td>
                        </tr>
                        <?php
                        $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between px-4">
            <p class="text-xs text-gray-600 font-bold uppercase tracking-widest">Total: <?= mysqli_num_rows($query); ?> Entri Data</p>
            <div class="flex gap-2">
                <button class="p-2 w-10 h-10 rounded-xl bg-[#1e1e1e] border border-white/5 text-gray-500 hover:text-yellow-400 transition cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button class="p-2 w-10 h-10 rounded-xl bg-[#1e1e1e] border border-white/5 text-gray-500 hover:text-yellow-400 transition">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </main>

    <footer class="mt-20 py-10 border-t border-white/5 text-center">
        <p class="text-gray-600 text-[10px] font-black uppercase tracking-[0.2em]">
            &copy; 2026 Electro Payment System. Data Management Terminal.
        </p>
    </footer>

</body>
</html>