<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';

$query_text = "SELECT t.*, p.nama, p.id_pelanggan 
               FROM payment_tagihan t
               JOIN payment_pelanggan p ON t.id_pelanggan = p.id_pelanggan
               WHERE p.nama LIKE '%$keyword%' 
               OR t.id_pelanggan LIKE '%$keyword%' 
               OR t.bulan LIKE '%$keyword%'
               OR t.tahun LIKE '%$keyword%'
               ORDER BY t.tahun DESC, t.bulan DESC";

$result = mysqli_query($koneksi, $query_text);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Tagihan | Electro Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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

    <?php include 'nav.php'; ?>

    <main class="max-w-7xl mx-auto px-4 py-10 pt-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-2">Hasil Pencarian Tagihan</h2>
            <p class="text-zinc-500 text-sm">Menampilkan hasil untuk: <span class="text-yellow-400 font-bold">"<?= htmlspecialchars($keyword) ?>"</span></p>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/50 text-zinc-400 text-xs uppercase tracking-widest border-b border-zinc-800">
                            <th class="px-6 py-4 font-bold">Pelanggan</th>
                            <th class="px-6 py-4 font-bold">Periode</th>
                            <th class="px-6 py-4 font-bold">Meter</th>
                            <th class="px-6 py-4 font-bold">Total Tagihan</th>
                            <th class="px-6 py-4 font-bold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="hover:bg-zinc-800/30 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-zinc-100"><?= $row['nama'] ?></div>
                                        <div class="font-mono text-yellow-400 text-xs"><?= $row['id_pelanggan'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-zinc-300">
                                        <?= $row['bulan'] ?> <?= $row['tahun'] ?>
                                    </td>
                                    <td class="px-6 py-4 text-zinc-300">
                                        <?= number_format($row['jumlahmeter'], 0, ',', '.') ?> kWh
                                    </td>
                                    <td class="px-6 py-4 font-bold text-white">
                                        Rp <?= number_format($row['jumlahtagihan'], 0, ',', '.') ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?php if($row['status'] == 1): ?>
                                            <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-[10px] font-bold border border-green-500/20 uppercase">Lunas</span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 bg-red-500/10 text-red-400 rounded-full text-[10px] font-bold border border-red-500/20 uppercase">Belum Bayar</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="text-zinc-600 mb-2"><i class="fa-solid fa-file-invoice-dollar text-4xl"></i></div>
                                    <p class="text-zinc-500">Tagihan tidak ditemukan.</p>
                                    <a href="data_tagihan.php" class="mt-4 inline-block text-yellow-400 hover:underline text-sm font-bold">Kembali ke Data Tagihan</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="md:hidden divide-y divide-zinc-800">
                <?php 
                mysqli_data_seek($result, 0); 
                if (mysqli_num_rows($result) > 0): 
                    while ($row = mysqli_fetch_assoc($result)): 
                ?>
                    <div class="p-4 space-y-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-bold text-zinc-100"><?= $row['nama'] ?></div>
                                <div class="font-mono text-yellow-400 text-xs"><?= $row['id_pelanggan'] ?></div>
                            </div>
                            <?php if($row['status'] == 1): ?>
                                <span class="px-2 py-0.5 bg-green-500/10 text-green-400 rounded text-[10px] font-bold border border-green-500/20">LUNAS</span>
                            <?php else: ?>
                                <span class="px-2 py-0.5 bg-red-500/10 text-red-400 rounded text-[10px] font-bold border border-red-500/20">BELUM</span>
                            <?php endif; ?>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="text-zinc-500 uppercase text-[10px] font-bold tracking-wider">Periode</div>
                            <div class="text-zinc-500 uppercase text-[10px] font-bold tracking-wider text-right">Meter</div>
                            <div class="text-zinc-300"><?= $row['bulan'] ?> <?= $row['tahun'] ?></div>
                            <div class="text-zinc-300 text-right"><?= number_format($row['jumlahmeter'], 0, ',', '.') ?> kWh</div>
                        </div>
                        <div class="pt-2 border-t border-zinc-800/50 flex justify-between items-center">
                            <span class="text-xs text-zinc-500 font-bold uppercase">Total</span>
                            <span class="text-white font-black italic">Rp <?= number_format($row['jumlahtagihan'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                <?php endwhile; else: ?>
                    <div class="p-10 text-center text-zinc-500 text-sm italic">Data tidak ditemukan.</div>
                <?php endif; ?>
            </div>
        </div>
    </main>
<?php include 'footer.php'; ?>

</body>
</html>