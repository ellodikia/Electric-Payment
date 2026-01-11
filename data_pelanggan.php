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
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

    <?php include 'nav.php'; ?>

    <main class="max-w-7xl mx-auto px-4 pt-4 pb-12">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tighter uppercase italic">Data <span class="text-yellow-brand">Pelanggan</span></h2>
                <p class="text-zinc-500 mt-2 text-sm max-w-md">Manajemen informasi entitas pelanggan untuk monitoring distribusi daya listrik.</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <form action="search_pelanggan.php" method="GET" class="flex items-center gap-2 group w-full sm:w-auto">
                    <div class="relative w-full">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-zinc-600 group-focus-within:text-yellow-400"></i>
                        <input type="text" name="keyword" placeholder="Cari nama / ID..." class="bg-zinc-900 border border-zinc-800 text-zinc-200 text-sm rounded-xl py-3 pl-11 pr-4 w-full lg:w-72 focus:ring-2 focus:ring-yellow-400/20 focus:border-yellow-400 outline-none transition-all placeholder:text-zinc-700" required>
                    </div>
                </form>
                <a href="form_add_pelanggan.php" class="bg-yellow-brand hover:bg-yellow-500 text-zinc-950 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-lg shadow-yellow-400/10">
                    <i class="fa-solid fa-plus text-sm"></i> Tambah Pelanggan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php while ($row = mysqli_fetch_array($query)): ?>
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 hover:border-yellow-400/30 transition-all group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4">
                    <span class="bg-yellow-brand/10 text-yellow-brand text-[10px] font-black px-3 py-1 rounded-full border border-yellow-brand/20 uppercase tracking-tighter">
                        <?php echo $row['kodetarif']; ?>
                    </span>
                </div>

                <div class="flex items-start gap-4 mb-6">
                    <div class="w-14 h-14 bg-zinc-800 rounded-2xl flex items-center justify-center text-zinc-500 group-hover:bg-yellow-400/10 group-hover:text-yellow-400 transition-colors shadow-inner">
                        <i class="fa-solid fa-user-gear text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg leading-tight group-hover:text-yellow-brand transition-colors"><?php echo $row['nama']; ?></h3>
                        <p class="text-zinc-600 text-xs font-mono mt-1 tracking-tighter">ID: #<?php echo $row['id_pelanggan']; ?></p>
                    </div>
                </div>

                <div class="space-y-3 mb-8">
                    <div class="flex items-center gap-3 text-zinc-400">
                        <i class="fa-solid fa-gauge-high text-xs w-4"></i>
                        <span class="text-xs font-bold tracking-widest uppercase"><?php echo $row['nometer']; ?> <span class="text-zinc-600 font-normal lowercase">(Nometer)</span></span>
                    </div>
                    <div class="flex items-start gap-3 text-zinc-500">
                        <i class="fa-solid fa-location-dot text-xs w-4 mt-1"></i>
                        <span class="text-xs italic leading-relaxed line-clamp-2"><?php echo $row['alamat']; ?></span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="form_edit_pelanggan.php?Id=<?php echo $row['id']; ?>" class="flex items-center justify-center gap-2 py-3 bg-zinc-800 hover:bg-blue-600 text-zinc-300 hover:text-white rounded-xl text-xs font-bold transition-all border border-zinc-700 hover:border-blue-500">
                        <i class="fa-solid fa-pen-to-square"></i> EDIT
                    </a>
                    <a href="delete_data_pelanggan.php?Id=<?php echo $row['id']; ?>" class="flex items-center justify-center gap-2 py-3 bg-zinc-800 hover:bg-red-600 text-zinc-300 hover:text-white rounded-xl text-xs font-bold transition-all border border-zinc-700 hover:border-red-500" onclick="return confirm('Hapus data pelanggan ini?')">
                        <i class="fa-solid fa-trash-can"></i> HAPUS
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <?php if (mysqli_num_rows($query) == 0): ?>
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-20 text-center">
            <div class="w-20 h-20 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-6 text-zinc-600">
                <i class="fa-solid fa-users-slash text-3xl"></i>
            </div>
            <h3 class="text-zinc-300 font-bold mb-1">Database Kosong</h3>
            <p class="text-zinc-600 text-sm">Belum ada pelanggan yang terdaftar dalam sistem.</p>
        </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>