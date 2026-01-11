<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$id_pelanggan_query = mysqli_query($koneksi, "SELECT id_pelanggan, nama FROM payment_pelanggan ORDER BY id_pelanggan ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Input Penggunaan | Electro Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        
        .form-input-custom {
            background-color: #18181b;
            border: 1px solid #27272a;
            color: #f4f4f5;
            transition: all 0.3s ease;
        }
        .form-input-custom:focus {
            border-color: #FACC15;
            outline: none;
            box-shadow: 0 0 0 2px rgba(250, 204, 21, 0.1);
        }
        select option {
            background-color: #18181b;
            color: #f4f4f5;
        }
    </style>
</head>

<body class="bg-zinc-950 text-zinc-100 min-h-screen">


<?php include 'nav.php'; ?>

    <main class="max-w-7xl mx-auto px-4 py-12 pt-4">
        <div class="flex flex-col items-center">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-brand/10 text-yellow-brand rounded-2xl mb-4">
                    <i class="fa-solid fa-gauge-high text-2xl"></i>
                </div>
                <h2 class="text-3xl font-black tracking-tight uppercase">Pencatatan <span class="text-yellow-brand">Meter</span></h2>
                <p class="text-zinc-500 mt-2 text-sm uppercase tracking-widest font-bold">Input penggunaan listrik bulanan pelanggan</p>
            </div>

            <div class="w-full max-w-xl bg-zinc-900 border border-zinc-800 rounded-3xl p-8 shadow-2xl">
                <form action="insert_penggunaan_tagihan.php" method="post" class="space-y-6">
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Pilih Pelanggan</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-600">
                                <i class="fa-solid fa-user-gear"></i>
                            </span>
                            <select name="id_pelanggan" class="form-input-custom w-full pl-10 pr-4 py-3 rounded-xl text-sm font-bold appearance-none cursor-pointer" required>
                                <option value="">-- Pilih ID Pelanggan --</option>
                                <?php while ($row = mysqli_fetch_assoc($id_pelanggan_query)) { ?>
                                    <option value="<?= $row['id_pelanggan'] ?>">
                                        <?= $row['id_pelanggan'] ?> - <?= $row['nama'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Bulan</label>
                            <select name="bulan" class="form-input-custom w-full px-4 py-3 rounded-xl text-sm font-bold appearance-none cursor-pointer" required>
                                <option value="" disabled selected>Pilih Bulan</option>
                                <?php 
                                $bulan_list = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                                foreach ($bulan_list as $bln) {
                                    echo "<option value='$bln'>$bln</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Tahun</label>
                            <input type="number" name="tahun" value="<?= date('Y') ?>" placeholder="2024" required
                                class="form-input-custom w-full px-4 py-3 rounded-xl text-sm font-bold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Meter Awal (kWh)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-600">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                </span>
                                <input type="number" name="meterawal" placeholder="0" required
                                    class="form-input-custom w-full pl-10 pr-4 py-3 rounded-xl text-sm font-bold">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Meter Akhir (kWh)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-600">
                                    <i class="fa-solid fa-circle-arrow-left"></i>
                                </span>
                                <input type="number" name="meterakhir" placeholder="0" required
                                    class="form-input-custom w-full pl-10 pr-4 py-3 rounded-xl text-sm font-bold text-yellow-brand">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-yellow-brand hover:bg-yellow-400 text-zinc-950 font-black py-4 rounded-xl transition-all flex items-center justify-center gap-3 uppercase tracking-widest text-xs active:scale-[0.98] shadow-lg shadow-yellow-900/20">
                            <i class="fa-solid fa-file-invoice-dollar"></i> Simpan & Generate Tagihan
                        </button>
                    </div>

                </form>

                <div class="mt-8 text-center border-t border-zinc-800 pt-6">
                    <a href="data_penggunaan.php" class="text-zinc-600 hover:text-zinc-400 text-[10px] font-black uppercase tracking-[0.2em] transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <div class="mt-8 max-w-md bg-zinc-900/50 border border-zinc-800/50 rounded-2xl p-4 flex gap-4 items-center">
                <div class="w-10 h-10 bg-zinc-800 text-zinc-400 rounded-full flex items-center justify-center flex-shrink-0 border border-zinc-700">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <p class="text-zinc-500 text-[10px] leading-relaxed font-medium uppercase tracking-wider">
                    Pastikan <span class="text-zinc-300">Meter Akhir</span> lebih besar dari <span class="text-zinc-300">Meter Awal</span>. Sistem akan otomatis menghitung tagihan berdasarkan tarif pelanggan.
                </p>
            </div>

        </div>
    </main>
<?php include 'footer.php'; ?>

</body>
</html>