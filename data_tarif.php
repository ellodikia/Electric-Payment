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

    <?php include 'nav.php'; ?>

    <main class="max-w-7xl mx-auto px-4 py-10 pt-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tighter uppercase italic">Konfigurasi <span class="text-yellow-brand">Tarif</span></h2>
                <p class="text-zinc-500 text-xs font-bold uppercase tracking-widest mt-1">Atur golongan daya dan biaya per kWh sistem.</p>
            </div>
            <div class="flex gap-3">
                <a href="form_add_tarif.php" class="bg-yellow-brand hover:bg-yellow-400 text-zinc-950 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-yellow-900/20 active:scale-95">
                    <i class="fa-solid fa-plus"></i> Tambah Golongan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php
                while ($row = mysqli_fetch_array($query)) {
            ?>
            <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-6 hover:border-zinc-700 transition-all group relative flex flex-col justify-between overflow-hidden">
                <div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-zinc-800 rounded-2xl flex items-center justify-center text-yellow-brand group-hover:bg-yellow-400 group-hover:text-zinc-950 transition-all duration-300">
                            <i class="fa-solid fa-bolt-lightning text-xl"></i>
                        </div>
                        <span class="bg-zinc-950 border border-zinc-800 text-zinc-500 text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-widest">
                            <?= $row['kodetarif'] ?>
                        </span>
                    </div>

                    <p class="text-[9px] text-zinc-600 font-black uppercase tracking-widest mb-1">Kapasitas Daya</p>
                    <h3 class="text-3xl font-mono font-black text-white mb-6">
                        <?= number_format($row['daya'], 0, ',', '.'); ?>
                        <span class="text-xs font-bold text-zinc-600 uppercase">VA</span>
                    </h3>

                    <div class="bg-zinc-950/50 rounded-2xl p-4 border border-zinc-800/50 mb-6">
                        <p class="text-[9px] text-zinc-600 font-black uppercase mb-1">Tarif per kWh</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-xs font-bold text-zinc-500">IDR</span>
                            <span class="text-xl font-black text-emerald-400 font-mono">
                                <?= number_format($row['tarifperkwh'], 0, ',', '.'); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-4 border-t border-zinc-800/50">
                    <a href="form_edit_tarif.php?Id=<?= $row['id'] ?>" 
                       class="flex items-center justify-center gap-2 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 rounded-xl text-[10px] font-black uppercase tracking-tighter transition-colors">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <a href="delete_data_tarif.php?Id=<?= $row['id'] ?>" 
                       class="flex items-center justify-center gap-2 py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl text-[10px] font-black uppercase tracking-tighter transition-all"
                       onclick="return confirm('Hapus golongan tarif ini?')">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                    </a>
                </div>

                <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-brand/5 rounded-full -mr-12 -mt-12 blur-2xl group-hover:bg-yellow-brand/10 transition-colors"></div>
            </div>
            <?php } ?>
        </div>

        <?php if (mysqli_num_rows($query) == 0): ?>
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-20 text-center">
            <i class="fa-solid fa-database text-zinc-800 text-6xl mb-4"></i>
            <p class="text-zinc-500 italic">Data tarif tidak ditemukan.</p>
        </div>
        <?php endif; ?>
        
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

    <?php include 'footer.php'; ?>

</body>
</html>