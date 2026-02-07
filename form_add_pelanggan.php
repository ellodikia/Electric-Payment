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
    <title>Tambah Pelanggan | Electro Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">

<?php include 'nav.php'; ?>

<main class="max-w-3xl mx-auto px-4 py-12 pt-4">
    <div class="mb-8 flex items-center gap-4">
        <a href="data_pelanggan.php" class="w-10 h-10 bg-zinc-900 border border-zinc-800 flex items-center justify-center rounded-xl text-zinc-400 hover:text-yellow-400 transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold">Tambah Pelanggan Baru</h2>
            <p class="text-zinc-500 text-sm">Lengkapi formulir di bawah ini.</p>
        </div>
    </div>

    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-xl p-8">
        <form action="insert_pelanggan.php" method="POST" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-xs font-bold text-zinc-500 uppercase">ID Pelanggan</label>
                    <input type="number" name="id_pelanggan" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 outline-none focus:border-yellow-400" required>
                </div>
                <div>
                    <label class="block mb-2 text-xs font-bold text-zinc-500 uppercase">Nomor Meter</label>
                    <input type="number" name="nometer" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 outline-none focus:border-yellow-400" required>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-xs font-bold text-zinc-500 uppercase">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 outline-none focus:border-yellow-400" required>
            </div>

            <div>
                <label class="block mb-2 text-xs font-bold text-zinc-500 uppercase">Alamat</label>
                <textarea name="alamat" rows="2" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 outline-none focus:border-yellow-400"></textarea>
            </div>

            <div>
                <label class="block mb-2 text-xs font-bold text-zinc-500 uppercase">Golongan Tarif</label>
                <select name="kodetarif" class="w-full bg-zinc-800 border border-zinc-700 text-white text-sm rounded-xl py-3 px-4 outline-none cursor-pointer" required>
                    <option value="">-- Pilih Golongan Daya --</option>
                    <?php 
                    if ($tarif && mysqli_num_rows($tarif) > 0) {
                        while ($row = mysqli_fetch_assoc($tarif)) {
                            echo "<option value='".$row['kodetarif']."' class='bg-zinc-900'>".$row['kodetarif']." — ".number_format($row['daya'], 0, ',', '.')." VA</option>";
                        }
                    } else {
                        echo "<option value=''>Data tarif gagal dimuat</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="pt-4 flex flex-col gap-3">
                <button type="submit" name="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-zinc-950 font-black py-4 rounded-xl shadow-lg flex items-center justify-center gap-2 transition-all active:scale-95 uppercase tracking-widest">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Data Pelanggan
                </button>
                <a href="data_pelanggan.php" class="w-full bg-zinc-800 text-zinc-300 py-3 rounded-xl flex items-center justify-center font-bold">
                    Batal
                </a>
            </div>

        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>