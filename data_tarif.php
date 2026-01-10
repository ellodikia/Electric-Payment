<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM payment_tarif ORDER BY id DESC") or die(mysqli_error($koneksi));
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

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
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
                    <a href="data_pelanggan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-users-gear"></i> Data Pelanggan
                    </a>
                </li>
                <li>
                    <a href="data_pembayaran.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-money-bill-transfer"></i> Transaksi
                    </a>
                </li>
                <li>
                    <a href="data_tarif.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
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
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tighter">Konfigurasi Tarif</h2>
                <p class="text-zinc-500 text-sm mt-1">Atur golongan daya dan biaya per kWh sistem.</p>
            </div>
            <div class="flex gap-3">
                <a href="form_add_tarif.php" class="bg-yellow-brand hover:bg-yellow-400 text-zinc-950 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-yellow-900/20">
                    <i class="fa-solid fa-plus"></i> Tambah Golongan
                </a>
                <a href="#" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest flex items-center gap-2 border border-zinc-700 transition-all">
                    <i class="fa-solid fa-search"></i> Cari
                </a>
            </div>
        </div>

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/50 text-zinc-500 text-[10px] uppercase tracking-[0.2em] border-b border-zinc-800">
                            <th class="px-8 py-6 text-center">No</th>
                            <th class="px-8 py-6">Kode Golongan</th>
                            <th class="px-8 py-6">Kapasitas Daya</th>
                            <th class="px-8 py-6">Tarif per KWh</th>
                            <th class="px-8 py-6 text-center">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr class="hover:bg-zinc-800/30 transition-all group">
                            <td class="px-8 py-6 text-center text-zinc-600 font-mono text-sm"><?= $no++; ?></td>
                            <td class="px-8 py-6">
                                <span class="bg-zinc-800 text-yellow-brand border border-yellow-brand/20 px-3 py-1 rounded-md font-black text-xs tracking-widest">
                                    <?= $row['kodetarif'] ?>
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold text-zinc-200"><?= number_format($row['daya'], 0, ',', '.'); ?></span>
                                    <span class="text-[10px] font-black text-zinc-600 uppercase">VA</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-zinc-500 text-xs">IDR</span>
                                    <span class="text-emerald-400 font-mono font-bold text-lg"><?= number_format($row['tarifperkwh'], 0, ',', '.'); ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="form_edit_tarif.php?Id=<?= $row['id'] ?>" class="text-zinc-400 hover:text-yellow-brand transition-colors flex items-center gap-1 text-xs font-bold uppercase tracking-tighter">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <div class="w-px h-4 bg-zinc-800"></div>
                                    <a href="delete_data_tarif.php?Id=<?= $row['id'] ?>" 
                                       class="text-zinc-600 hover:text-red-500 transition-colors flex items-center gap-1 text-xs font-bold uppercase tracking-tighter"
                                       onclick="return confirm('Hapus golongan tarif ini? Data pelanggan terkait mungkin terdampak.')">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-8 p-6 bg-blue-500/5 border border-blue-500/10 rounded-2xl flex gap-4 items-center">
            <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-circle-info text-xl"></i>
            </div>
            <div>
                <h4 class="text-blue-400 font-bold text-sm uppercase tracking-wider">Informasi Sistem</h4>
                <p class="text-zinc-500 text-xs leading-relaxed">Perubahan tarif akan langsung berdampak pada perhitungan tagihan baru di periode penggunaan berikutnya. Pastikan kode tarif unik untuk setiap golongan daya.</p>
            </div>
        </div>
    </main>

    <footer class="text-center py-10 border-t border-zinc-900">
        <p class="text-zinc-700 text-[10px] font-black uppercase tracking-[0.5em]">
            &copy; <?= date('Y'); ?> Electro Payment System &bull; Tariff Configuration Core
        </p>
    </footer>

</body>
</html>