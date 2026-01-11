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
        
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; color: black !important; }
            .card-item { border: 1px solid #ddd !important; break-inside: avoid; }
        }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

    <div class="no-print">
        <?php include 'nav.php'; ?>
    </div>

    <main class="max-w-7xl mx-auto px-4 pt-4 pb-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tighter uppercase italic">Riwayat <span class="text-yellow-brand">Transaksi</span></h2>
                <p class="text-zinc-500 mt-2 text-sm uppercase tracking-widest font-bold">Log Pembayaran Berhasil</p>
            </div>
            <div class="no-print">
                <button onclick="window.print()" class="w-full sm:w-auto bg-zinc-900 hover:bg-zinc-800 text-white px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest border border-zinc-800 flex items-center justify-center gap-3 transition-all">
                    <i class="fa-solid fa-print"></i> Cetak Laporan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php 
            while ($row = mysqli_fetch_array($query)) { 
            ?>
            <div class="card-item bg-zinc-900 border border-zinc-800 rounded-3xl p-6 relative overflow-hidden group hover:border-emerald-500/30 transition-all flex flex-col justify-between">
                <div>
                    <div class="absolute top-0 right-0 p-4 no-print">
                        <span class="bg-emerald-500/10 text-emerald-500 px-3 py-1 rounded-full text-[10px] font-black uppercase border border-emerald-500/20">
                            <i class="fa-solid fa-circle-check mr-1"></i> <?= $row['status']; ?>
                        </span>
                    </div>

                    <div class="mb-6">
                        <p class="text-[10px] text-zinc-500 font-black uppercase tracking-[0.2em] mb-1">Invoice ID</p>
                        <h3 class="text-white font-mono font-bold"><?= $row['id_bayar']; ?></h3>
                    </div>

                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-zinc-800 rounded-2xl flex items-center justify-center text-zinc-500 group-hover:bg-emerald-500/10 group-hover:text-emerald-500 transition-colors">
                            <i class="fa-solid fa-receipt text-xl"></i>
                        </div>
                        <div>
                            <p class="text-white font-bold leading-tight"><?= $row['nama']; ?></p>
                            <p class="text-zinc-500 text-xs mt-1">Pelanggan: #<?= $row['id_pelanggan']; ?></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 py-4 border-y border-zinc-800/50 mb-6">
                        <div>
                            <p class="text-[10px] text-zinc-500 font-bold uppercase mb-1">Tanggal</p>
                            <p class="text-xs font-semibold"><?= date('d M Y', strtotime($row['tanggal'])); ?></p>
                        </div>
                        <div>
                            <p class="text-[10px] text-zinc-500 font-bold uppercase mb-1">Periode</p>
                            <p class="text-xs font-semibold italic"><?= $row['bulanbayar']; ?></p>
                        </div>
                    </div>

                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-zinc-500">Biaya Admin</span>
                            <span class="text-zinc-300 font-mono">Rp <?= number_format($row['biayaadmin'], 0, ',', '.'); ?></span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-[10px] text-zinc-100 font-black uppercase tracking-widest">Total Bayar</span>
                            <span class="text-xl font-black text-emerald-400 font-mono">Rp <?= number_format($row['total'], 0, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="no-print pt-4 border-t border-zinc-800/50">
                    <a href="cetak_struk.php?id_bayar=<?= $row['id_bayar']; ?>" target="_blank" class="w-full bg-emerald-500 hover:bg-emerald-600 text-zinc-950 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-lg shadow-emerald-500/10 active:scale-95">
                        <i class="fa-solid fa-file-invoice"></i> Cetak Struk
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>

        <?php if (mysqli_num_rows($query) == 0): ?>
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-20 text-center">
            <i class="fa-solid fa-box-open text-zinc-800 text-6xl mb-4"></i>
            <p class="text-zinc-500 italic">Belum ada riwayat transaksi yang tercatat.</p>
        </div>
        <?php endif; ?>
    </main>

    <div class="no-print">
        <?php include 'footer.php'; ?>
    </div>

</body>
</html>