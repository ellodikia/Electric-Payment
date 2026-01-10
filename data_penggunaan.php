<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM payment_penggunaan ORDER BY id DESC") or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Data Penggunaan | Electro Payment</title>
    
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
                    <a href="data_tarif.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-bolt-lightning"></i> Atur Tarif
                    </a>
                </li>
                <li>
                    <a href="data_penggunaan.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
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
                <h2 class="text-4xl font-black tracking-tighter uppercase">Log Penggunaan <span class="text-yellow-brand">Meter</span></h2>
                <p class="text-zinc-500 text-sm mt-1 uppercase tracking-widest font-semibold text-[10px]">Data pencatatan kWh meter awal dan akhir pelanggan.</p>
            </div>
            <div class="flex gap-3">
                <a href="form_add_penggunaan.php" class="bg-yellow-brand hover:bg-yellow-400 text-zinc-950 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-yellow-900/20">
                    <i class="fa-solid fa-plus"></i> Input Meter Baru
                </a>
            </div>
        </div>

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/50 text-zinc-500 text-[10px] uppercase tracking-[0.2em] border-b border-zinc-800">
                            <th class="px-8 py-6 text-center">No</th>
                            <th class="px-8 py-6">Akun Pelanggan</th>
                            <th class="px-8 py-6">Periode</th>
                            <th class="px-8 py-6">Record Meter (kWh)</th>
                            <th class="px-8 py-6">Total Pakai</th>
                            <th class="px-8 py-6 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                                $konsumsi = $row['meterakhir'] - $row['meterawal'];
                        ?>
                        <tr class="hover:bg-zinc-800/30 transition-all group">
                            <td class="px-8 py-6 text-center text-zinc-600 font-mono text-sm"><?= $no++; ?></td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-zinc-800 flex items-center justify-center text-yellow-brand border border-zinc-700">
                                        <i class="fa-solid fa-user-tag text-xs"></i>
                                    </div>
                                    <span class="text-zinc-200 font-mono font-bold tracking-wider text-sm"><?= $row['id_pelanggan']; ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-zinc-400 font-bold text-xs uppercase tracking-tighter">
                                    <?= $row['bulan'] ?> <span class="text-zinc-600 px-1">/</span> <?= $row['tahun'] ?>
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col gap-1">
                                    <div class="flex justify-between w-32">
                                        <span class="text-[9px] uppercase font-black text-zinc-600">Awal:</span>
                                        <span class="text-xs font-mono font-bold text-zinc-400"><?= number_format($row['meterawal'], 0, ',', '.'); ?></span>
                                    </div>
                                    <div class="flex justify-between w-32 border-t border-zinc-800 pt-1">
                                        <span class="text-[9px] uppercase font-black text-zinc-600">Akhir:</span>
                                        <span class="text-xs font-mono font-bold text-yellow-brand"><?= number_format($row['meterakhir'], 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2">
                                    <span class="bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-md font-black text-sm">
                                        <?= $konsumsi ?>
                                    </span>
                                    <span class="text-[9px] font-black text-zinc-600 uppercase">kWh</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="form_edit_penggunaan.php?Id=<?= $row['id'] ?>" class="w-8 h-8 rounded-lg bg-zinc-800 text-zinc-400 hover:text-yellow-brand hover:bg-zinc-700 flex items-center justify-center transition-all">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <a href="delete_data_penggunaan.php?Id=<?= $row['id'] ?>" 
                                       class="w-8 h-8 rounded-lg bg-zinc-800 text-zinc-600 hover:text-red-500 hover:bg-red-500/10 flex items-center justify-center transition-all"
                                       onclick="return confirm('Hapus record penggunaan ini? Tagihan terkait akan terpengaruh.')">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="text-center py-10 border-t border-zinc-900 mt-20">
        <p class="text-zinc-700 text-[10px] font-black uppercase tracking-[0.5em]">
            &copy; <?= date('Y'); ?> Electro Payment System &bull; Consumption Monitoring Core
        </p>
    </footer>

</body>
</html>