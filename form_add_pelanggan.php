<?php
if (!isset($koneksi)) {
    include 'koneksi.php';
}
$tarif = mysqli_query($koneksi, "SELECT kodetarif, daya FROM payment_tarif");
?>

<div class="max-w-2xl mx-auto animate-fadeIn">
    <div class="mb-6">
        <a href="index.php?page=pelanggan" class="text-gray-400 hover:text-yellow-400 transition flex items-center gap-2 text-sm font-bold uppercase tracking-wider">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Data Pelanggan
        </a>
    </div>

    <div class="bg-[#1e1e1e] border border-white/5 rounded-3xl p-8 shadow-2xl">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-black uppercase tracking-tight text-white">Tambah Pelanggan</h2>
        </div>

        <form action="insert_pelanggan.php" method="post" class="space-y-6">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-yellow-400 mb-2">ID Pelanggan</label>
                <input type="number" name="id_pelanggan" required class="w-full bg-[#121212] border border-white/10 rounded-xl px-4 py-3.5 text-white focus:outline-none focus:border-yellow-400 transition">
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-yellow-400 mb-2">Golongan Tarif</label>
                <select name="kodetarif" required class="w-full bg-[#121212] border border-white/10 rounded-xl px-4 py-3.5 text-white focus:outline-none focus:border-yellow-400 appearance-none">
                    <option value="">-- Pilih Kode Tarif --</option>
                    <?php while ($row = mysqli_fetch_assoc($tarif)) { ?>
                        <option value="<?= $row['kodetarif'] ?>"><?= $row['kodetarif'] ?> - <?= $row['daya'] ?> VA</option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-black py-4 rounded-2xl transition-all uppercase tracking-widest mt-4">
                Simpan Data
            </button>
        </form>
    </div>
</div>