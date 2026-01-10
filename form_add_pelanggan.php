<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$tarif = mysqli_query($koneksi, "SELECT kodetarif, daya FROM payment_tarif");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Tambah Pelanggan | Electro Payment</title>
    
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
                <li><a href="data_pembayaran.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 transition-colors whitespace-nowrap"><i class="fa-solid fa-money-bill-transfer"></i> Transaksi</a></li>
                <li><a href="data_tarif.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 transition-colors whitespace-nowrap"><i class="fa-solid fa-bolt-lightning"></i> Atur Tarif</a></li>
                <li><a href="data_penggunaan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 transition-colors whitespace-nowrap"><i class="fa-solid fa-gauge-high"></i> Penggunaan</a></li>
                <li><a href="data_tagihan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 transition-colors whitespace-nowrap"><i class="fa-solid fa-file-invoice-dollar"></i> Tagihan</a></li>
            </ul>
        </div>
    </div>

    <main class="max-w-3xl mx-auto px-4 py-12">
        <div class="mb-8 flex items-center gap-4">
            <a href="data_pelanggan.php" class="w-10 h-10 bg-zinc-900 border border-zinc-800 flex items-center justify-center rounded-xl text-zinc-400 hover:text-yellow-brand hover:border-yellow-brand transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold">Tambah Pelanggan Baru</h2>
                <p class="text-zinc-500 text-sm">Lengkapi formulir di bawah untuk mendaftarkan pelanggan.</p>
            </div>
        </div>

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-xl p-8">
            <form action="insert_pelanggan.php" method="post" class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-zinc-500">ID Pelanggan</label>
                        <input type="number" name="id_pelanggan" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand outline-none transition-all" placeholder="Contoh: 512023..." required>
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-zinc-500">Nomor Meter</label>
                        <input type="number" name="nometer" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand outline-none transition-all" placeholder="Contoh: 14092..." required>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-zinc-500">Nama Lengkap</label>
                    <input type="text" name="nama" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand outline-none transition-all" placeholder="Masukkan nama pelanggan..." required>
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-zinc-500">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand outline-none transition-all" placeholder="Alamat rumah atau lokasi meteran..."></textarea>
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-zinc-500">Golongan Tarif</label>
                    <select name="kodetarif" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand outline-none transition-all cursor-pointer" required>
                        <option value="" disabled selected>-- Pilih Golongan Daya --</option>
                        <?php while ($row = mysqli_fetch_assoc($tarif)) { ?>
                            <option value="<?= $row['kodetarif'] ?>" class="bg-zinc-900">
                                <?= $row['kodetarif'] ?> — (<?= number_format($row['daya'], 0, ',', '.') ?> VA)
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="pt-4 flex flex-col gap-3">
                    <button type="submit" class="w-full bg-yellow-brand hover:bg-yellow-500 text-zinc-950 font-black py-4 rounded-xl shadow-lg shadow-yellow-900/10 flex items-center justify-center gap-2 transition-all active:scale-95 uppercase tracking-widest">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data
                    </button>
                    <a href="data_pelanggan.php" class="w-full bg-zinc-800 hover:bg-zinc-700 text-zinc-300 font-bold py-3 rounded-xl flex items-center justify-center gap-2 transition-all">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </main>

    <footer class="text-center py-10 border-t border-zinc-900">
        <p class="text-zinc-600 text-xs uppercase tracking-widest font-bold">
            &copy; <?php echo date('Y'); ?> Electro Payment System - Security Enforced
        </p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>