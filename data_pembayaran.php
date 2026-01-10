<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT payment_pembayaran.*, payment_pelanggan.nama 
                                 FROM payment_pembayaran 
                                 JOIN payment_pelanggan ON payment_pembayaran.id_pelanggan = payment_pelanggan.id_pelanggan 
                                 ORDER BY payment_pembayaran.id DESC") or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Riwayat Pembayaran | Electro Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; color: black !important; }
            .card-table { border: none !important; box-shadow: none !important; }
            table { color: black !important; border: 1px solid #ccc !important; }
            th { background-color: #f3f4f6 !important; color: black !important; }
        }
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
                    <a href="data_pembayaran.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
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
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 no-print">
            <div>
                <h2 class="text-3xl font-bold">Riwayat Pembayaran</h2>
                <p class="text-zinc-500 mt-1 uppercase text-xs tracking-widest font-semibold">Log Transaksi Sukses</p>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()" class="bg-zinc-800 hover:bg-zinc-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 border border-zinc-700 transition-all">
                    <i class="fa-solid fa-print"></i> CETAK LAPORAN
                </button>
                <a href="#" class="bg-yellow-brand hover:bg-yellow-500 text-zinc-950 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-magnifying-glass"></i> CARI TRANSAKSI
                </a>
            </div>
        </div>

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-xl overflow-hidden card-table">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/50 text-zinc-400 text-xs uppercase tracking-widest border-b border-zinc-800">
                            <th class="px-6 py-5 text-center">No</th>
                            <th class="px-6 py-5">Info Pembayaran</th>
                            <th class="px-6 py-5 text-center">Waktu</th>
                            <th class="px-6 py-5">Biaya Admin</th>
                            <th class="px-6 py-5 font-bold text-yellow-brand text-right">Total Bayar</th>
                            <th class="px-6 py-5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr class="hover:bg-zinc-800/30 transition-colors group">
                            <td class="px-6 py-5 text-center text-zinc-500 font-mono text-sm"><?= $no++; ?></td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="text-white font-bold group-hover:text-yellow-brand transition-colors"><?= $row['nama']; ?></span>
                                    <span class="text-zinc-500 text-xs uppercase tracking-tighter">ID: <?= $row['id_bayar']; ?> / PEL: <?= $row['id_pelanggan']; ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium"><?= date('d/m/Y', strtotime($row['tanggal'])); ?></span>
                                    <span class="text-[10px] text-zinc-500 uppercase font-bold"><?= $row['bulanbayar']; ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-zinc-400 font-mono text-sm">
                                Rp <?= number_format($row['biayaadmin'], 0, ',', '.'); ?>
                            </td>
                            <td class="px-6 py-5 text-right font-bold text-emerald-400 font-mono">
                                Rp <?= number_format($row['total'], 0, ',', '.'); ?>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="bg-emerald-500/10 text-emerald-500 px-3 py-1 rounded-full text-[10px] font-black uppercase border border-emerald-500/20">
                                    <i class="fa-solid fa-circle-check mr-1"></i> <?= $row['status']; ?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="text-center py-10 border-t border-zinc-900 no-print">
        <p class="text-zinc-600 text-[10px] uppercase tracking-[0.3em] font-black">
            ELECTRO PAYMENT &bull; Secure Financial Transaction Log &bull; <?= date('Y'); ?>
        </p>
    </footer>

</body>
</html>