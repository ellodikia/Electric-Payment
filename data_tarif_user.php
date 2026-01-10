<?php
session_start();
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM payment_tarif ORDER BY id DESC") or die(mysqli_error($koneksi));
$is_admin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Data Tarif | Electro Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        
        /* Custom Scrollbar agar tabel tetap cantik di mobile */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100">

    <nav class="bg-zinc-900 border-b border-zinc-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-yellow-brand text-2xl"><i class="fa-solid fa-bolt"></i></span>
                    <span class="font-bold text-xl tracking-tight uppercase">ELECTRO<span class="text-yellow-brand">PAY</span></span>
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

    <div class="bg-zinc-900/50 border-y border-zinc-800">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex overflow-x-auto py-3 gap-8 no-scrollbar">
                <li>
                    <a href="beranda.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li>
                    <a href="data_tarif.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
                        <i class="fa-solid fa-rupiah-sign"></i> Data Tarif
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 gap-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold">Data Tarif Listrik</h2>
                    <p class="text-zinc-500 mt-1">Daftar golongan daya dan biaya per KWH yang berlaku.</p>
                </div>
                <a href="search_komite.php" class="inline-flex items-center justify-center gap-2 bg-zinc-900 border border-zinc-800 text-zinc-100 px-6 py-3 rounded-xl hover:border-yellow-brand hover:text-yellow-brand transition-all font-bold">
                    <i class="fa-solid fa-magnifying-glass"></i> CARI DATA
                </a>
            </div>

            <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-zinc-800/50 text-zinc-400 text-xs uppercase tracking-widest border-b border-zinc-800">
                                <th class="px-6 py-5 font-bold text-center w-20">No</th>
                                <th class="px-6 py-5 font-bold">Kode Tarif</th>
                                <th class="px-6 py-5 font-bold">Daya (VA)</th>
                                <th class="px-6 py-5 font-bold">Tarif / KWH</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            <?php
                                $no = 1;
                                while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr class="hover:bg-zinc-800/20 transition-colors group">
                                <td class="px-6 py-5 text-center text-zinc-500 font-medium"><?php echo $no; ?></td>
                                <td class="px-6 py-5">
                                    <span class="text-yellow-brand font-mono font-bold"><?php echo $row['kodetarif']; ?></span>
                                </td>
                                <td class="px-6 py-5 text-zinc-200 font-semibold">
                                    <?php echo number_format($row['daya'], 0, ',', '.'); ?> 
                                    <span class="text-zinc-600 text-xs font-normal ml-1 uppercase">VA</span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-1">
                                        <span class="text-zinc-500 text-xs font-normal">Rp</span>
                                        <span class="text-zinc-100 font-bold"><?php echo number_format($row['tarifperkwh'], 2, ',', '.'); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php if (mysqli_num_rows($query) == 0): ?>
                <div class="p-20 text-center">
                    <div class="w-20 h-20 bg-zinc-800 text-zinc-700 flex items-center justify-center rounded-full mx-auto mb-4 text-3xl">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <p class="text-zinc-500 italic">Data tarif tidak ditemukan.</p>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <footer class="text-center py-12 border-t border-zinc-900 mt-12">
        <p class="text-zinc-600 text-xs uppercase tracking-widest font-bold">
            &copy; <?php echo date('Y'); ?> Electro Payment System - All Secure
        </p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>