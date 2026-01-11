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
    <title>Log Penggunaan | Electro Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
    </style>
</head>

<body class="bg-zinc-950 text-zinc-100 min-h-screen">

    <?php include 'nav.php'; ?>

    <main class="max-w-7xl mx-auto px-4 pt-4 pb-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tighter uppercase italic">Log <span class="text-yellow-brand">Penggunaan</span></h2>
                <p class="text-zinc-500 text-sm mt-2 uppercase tracking-widest font-bold">Monitoring Record kWh Meter</p>
            </div>
            <a href="form_add_penggunaan.php" class="bg-yellow-brand hover:bg-yellow-400 text-zinc-950 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-lg shadow-yellow-900/20">
                <i class="fa-solid fa-plus text-sm"></i> Input Meter Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php
                while ($row = mysqli_fetch_array($query)) {
                    $konsumsi = $row['meterakhir'] - $row['meterawal'];
            ?>
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 hover:border-yellow-400/30 transition-all group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4">
                    <span class="bg-zinc-800 text-zinc-400 text-[10px] font-black px-3 py-1 rounded-full border border-zinc-700 uppercase tracking-tighter">
                        <?= $row['bulan'] ?> / <?= $row['tahun'] ?>
                    </span>
                </div>

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-zinc-800 rounded-2xl flex items-center justify-center text-zinc-500 group-hover:bg-yellow-400/10 group-hover:text-yellow-400 transition-colors">
                        <i class="fa-solid fa-gauge-high text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-zinc-500 font-black uppercase tracking-widest mb-0.5">ID Pelanggan</p>
                        <h3 class="text-white font-mono font-bold text-lg leading-tight tracking-wider"><?= $row['id_pelanggan']; ?></h3>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="bg-zinc-950/50 border border-zinc-800 rounded-2xl p-3">
                        <p class="text-[9px] text-zinc-600 font-black uppercase mb-1">Meter Awal</p>
                        <p class="text-sm font-mono font-bold text-zinc-400"><?= number_format($row['meterawal'], 0, ',', '.'); ?> <span class="text-[10px] font-normal">kWh</span></p>
                    </div>
                    <div class="bg-zinc-950/50 border border-zinc-800 rounded-2xl p-3">
                        <p class="text-[9px] text-zinc-600 font-black uppercase mb-1">Meter Akhir</p>
                        <p class="text-sm font-mono font-bold text-yellow-brand"><?= number_format($row['meterakhir'], 0, ',', '.'); ?> <span class="text-[10px] font-normal">kWh</span></p>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-emerald-500/5 border border-emerald-500/10 rounded-2xl mb-8">
                    <span class="text-[10px] font-black text-emerald-500/50 uppercase tracking-widest">Total Konsumsi</span>
                    <div class="text-right">
                        <span class="text-2xl font-black text-emerald-400 font-mono"><?= $konsumsi ?></span>
                        <span class="text-[10px] font-bold text-emerald-500 uppercase ml-1 text-zinc-500">kWh</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="form_edit_penggunaan.php?Id=<?= $row['id'] ?>" class="flex items-center justify-center gap-2 py-3 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-zinc-700">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <a href="delete_data_penggunaan.php?Id=<?= $row['id'] ?>" class="flex items-center justify-center gap-2 py-3 bg-zinc-800 hover:bg-red-600/20 hover:text-red-500 text-zinc-500 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-zinc-700 hover:border-red-500/50" onclick="return confirm('Hapus record penggunaan ini?')">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>

        <?php if (mysqli_num_rows($query) == 0): ?>
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-20 text-center">
            <div class="w-20 h-20 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-6 text-zinc-700">
                <i class="fa-solid fa-gauge-simple text-4xl"></i>
            </div>
            <h3 class="text-zinc-400 font-bold mb-1 italic">Data Record Kosong</h3>
            <p class="text-zinc-600 text-xs uppercase tracking-widest">Belum ada aktivitas penggunaan meter yang dicatat.</p>
        </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>