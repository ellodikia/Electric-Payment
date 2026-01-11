<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';

$query_text = "SELECT p.*, t.daya 
               FROM payment_pelanggan p 
               JOIN payment_tarif t ON p.kodetarif = t.kodetarif 
               WHERE p.nama LIKE '%$keyword%' 
               OR p.id_pelanggan LIKE '%$keyword%' 
               OR p.nometer LIKE '%$keyword%'
               ORDER BY p.nama ASC";

$result = mysqli_query($koneksi, $query_text);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Pelanggan | Electro Payment</title>
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

    <div class="mt-4">
        <?php include 'nav.php'; ?>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-10 pt-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-2">Hasil Pencarian</h2>
            <p class="text-zinc-500 text-sm">Menampilkan hasil untuk kata kunci: <span class="text-yellow-brand font-bold">"<?= htmlspecialchars($keyword) ?>"</span></p>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-800/50 text-zinc-400 text-xs uppercase tracking-widest border-b border-zinc-800">
                        <th class="px-6 py-4 font-bold">ID Pelanggan</th>
                        <th class="px-6 py-4 font-bold">Nama</th>
                        <th class="px-6 py-4 font-bold">No. Meter</th>
                        <th class="px-6 py-4 font-bold">Tarif/Daya</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-zinc-800/30 transition-colors group">
                                <td class="px-6 py-4 font-mono text-yellow-brand text-sm"><?= $row['id_pelanggan'] ?></td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-zinc-100"><?= $row['nama'] ?></div>
                                    <div class="text-xs text-zinc-500 truncate max-w-[200px]"><?= $row['alamat'] ?></div>
                                </td>
                                <td class="px-6 py-4 text-zinc-300"><?= $row['nometer'] ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-zinc-800 text-zinc-300 rounded text-[10px] font-bold border border-zinc-700">
                                        <?= $row['kodetarif'] ?> / <?= number_format($row['daya'], 0, ',', '.') ?> VA
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="form_edit_pelanggan.php?Id=<?= $row['id'] ?>" class="p-2 bg-blue-600/10 text-blue-400 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="hapus_pelanggan.php?Id=<?= $row['id'] ?>" onclick="return confirm('Hapus pelanggan ini?')" class="p-2 bg-red-600/10 text-red-400 rounded-lg hover:bg-red-600 hover:text-white transition-all" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="text-zinc-600 mb-2"><i class="fa-solid fa-magnifying-glass text-4xl"></i></div>
                                <p class="text-zinc-500">Tidak ada pelanggan yang ditemukan dengan kata kunci tersebut.</p>
                                <a href="data_pelanggan.php" class="mt-4 inline-block text-yellow-brand hover:underline text-sm font-bold uppercase tracking-widest">Kembali ke Data Pelanggan</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
<?php include 'footer.php'; ?>

</body>
</html>