<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

if (!isset($_GET['Id'])) {
    header("Location: data_pelanggan.php");
    exit();
}

$id = (int) $_GET['Id']; 

$q = mysqli_query($koneksi, "SELECT * FROM payment_pelanggan WHERE id = $id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    die("Data pelanggan tidak ditemukan.");
}

$tarif_query = mysqli_query($koneksi, "SELECT kodetarif, daya FROM payment_tarif");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Edit Pelanggan | Electro Payment</title>
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


    <main class="max-w-3xl mx-auto px-4 py-12 pt-4">
        <div class="mb-8 flex items-center gap-4">
            <a href="data_pelanggan.php" class="w-10 h-10 bg-zinc-900 border border-zinc-800 flex items-center justify-center rounded-xl text-zinc-400 hover:text-yellow-brand transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold">Perbarui Data Pelanggan</h2>
                <p class="text-zinc-500 text-sm">Mengubah informasi untuk: <span class="text-yellow-brand font-bold"><?= htmlspecialchars($data['nama']); ?></span></p>
            </div>
        </div>

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 shadow-xl">
            <form action="update_pelanggan.php" method="post" class="space-y-6">
                
                <input type="hidden" name="id" value="<?= $data['id']; ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-500">ID Pelanggan</label>
                        <input type="text" name="id_pelanggan" value="<?= htmlspecialchars($data['id_pelanggan']); ?>" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:border-yellow-brand outline-none" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold uppercase text-zinc-500">Nomor Meter</label>
                        <input type="number" name="nometer" value="<?= htmlspecialchars($data['nometer']); ?>" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:border-yellow-brand outline-none" required>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-500">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:border-yellow-brand outline-none" required>
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-500">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 focus:border-yellow-brand outline-none"><?= htmlspecialchars($data['alamat']); ?></textarea>
                </div>

                <div>
                    <label class="block mb-2 text-xs font-bold uppercase text-zinc-500">Golongan Tarif</label>
                    <select name="kodetarif" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl py-3 px-4 outline-none cursor-pointer" required>
                        <?php while ($row = mysqli_fetch_assoc($tarif_query)) : ?>
                            <option value="<?= $row['kodetarif']; ?>" <?= ($row['kodetarif'] == $data['kodetarif']) ? 'selected' : ''; ?>>
                                <?= $row['kodetarif']; ?> — (<?= number_format($row['daya'], 0, ',', '.'); ?> VA)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="pt-4 space-y-3">
                    <button type="submit" class="w-full bg-yellow-brand hover:bg-yellow-500 text-zinc-950 font-black py-4 rounded-xl transition-all uppercase tracking-widest">
                        <i class="fa-solid fa-rotate mr-2"></i> PERBARUI DATA
                    </button>
                    <a href="data_pelanggan.php" class="w-full bg-zinc-800 py-3 rounded-xl flex justify-center text-zinc-300 text-sm uppercase tracking-widest font-bold">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>
<?php include 'footer.php'; ?>

</body>
</html>