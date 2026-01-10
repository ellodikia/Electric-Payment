<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM payment_pelanggan ORDER BY id DESC") or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Data Pelanggan | Electro Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

    <nav class="bg-zinc-900 border-b border-zinc-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-yellow-brand text-2xl"><i class="fa-solid fa-bolt"></i></span>
                    <span class="font-bold text-xl tracking-tight uppercase">ELECTRO<span class="text-yellow-brand">PAY</span></span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center bg-zinc-800 px-3 py-1.5 rounded-lg border border-zinc-700 mr-2">
                        <span class="text-xs font-bold text-yellow-brand mr-2">ADMIN</span>
                        <span class="text-sm text-zinc-300"><?php echo $_SESSION['user']; ?></span>
                    </div>
                    <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i> <span class="hidden md:inline">Keluar</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-zinc-900/50 border-y border-zinc-800 sticky top-16 z-40 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex overflow-x-auto py-3 gap-8 no-scrollbar">
                <li>
                    <a href="index.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="data_pelanggan.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
                        <i class="fa-solid fa-users-gear"></i> Data Pelanggan
                    </a>
                </li>
                <li>
                    <a href="data_pembayaran.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-money-bill-transfer"></i> Transaksi
                    </a>
                </li>
                <li>
                    <a href="data_tarif.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-bolt-lightning"></i> Atur Tarif
                    </a>
                </li>
                <li>
                    <a href="data_penggunaan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-gauge-high"></i> Penggunaan
                    </a>
                </li>
                <li>
                    <a href="data_tagihan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold">Manajemen Pelanggan</h2>
                <p class="text-zinc-500 mt-1">Kelola data informasi pelanggan sistem Electro Payment.</p>
            </div>
            <div class="flex gap-3">
                <a href="form_add_pelanggan.php" class="bg-yellow-brand hover:bg-yellow-500 text-zinc-950 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-plus"></i> TAMBAH DATA
                </a>
                <a href="search_komite.php" class="bg-zinc-800 hover:bg-zinc-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 border border-zinc-700 transition-all">
                    <i class="fa-solid fa-magnifying-glass"></i> CARI
                </a>
            </div>
        </div>

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-zinc-800/50 text-zinc-400 text-xs uppercase tracking-widest border-b border-zinc-800">
                            <th class="px-6 py-5 font-bold text-center w-20">No</th>
                            <th class="px-6 py-5 font-bold">Informasi Pelanggan</th>
                            <th class="px-6 py-5 font-bold">Nometer</th>
                            <th class="px-6 py-5 font-bold text-center">Kode Tarif</th>
                            <th class="px-6 py-5 font-bold text-center">Aksi</th>
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
                                <div class="flex flex-col">
                                    <span class="text-white font-bold group-hover:text-yellow-brand transition-colors"><?php echo $row['nama']; ?></span>
                                    <span class="text-zinc-500 text-xs font-mono"><?php echo $row['id_pelanggan']; ?></span>
                                    <span class="text-zinc-400 text-xs mt-1 italic"><i class="fa-solid fa-location-dot mr-1"></i><?php echo $row['alamat']; ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-zinc-950 text-zinc-300 px-3 py-1 rounded-lg border border-zinc-800 font-mono text-sm">
                                    <?php echo $row['nometer']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="bg-yellow-brand/10 text-yellow-brand px-3 py-1 rounded-full text-xs font-bold border border-yellow-brand/20">
                                    <?php echo $row['kodetarif']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-2">
                                    <a href="form_edit_pelanggan.php?Id=<?php echo $row['id']; ?>" class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all" title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="delete_data_pelanggan.php?Id=<?php echo $row['id']; ?>" class="p-2 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all" onclick="return confirm('Yakin hapus data ini?')" title="Hapus Data">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
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
                <i class="fa-solid fa-users-slash text-zinc-800 text-6xl mb-4"></i>
                <p class="text-zinc-500 italic">Belum ada data pelanggan yang terdaftar.</p>
            </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="text-center py-10 border-t border-zinc-900 mt-auto">
        <p class="text-zinc-600 text-xs uppercase tracking-widest font-bold">
            &copy; <?php echo date('Y'); ?> Electro Payment System - Administrator Panel
        </p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>