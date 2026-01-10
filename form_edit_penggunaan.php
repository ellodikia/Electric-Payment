<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

$id = (int) $_GET['Id']; 

// Ambil data penggunaan yang akan diedit
$q = mysqli_query($koneksi, "SELECT * FROM payment_penggunaan WHERE id = $id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='data_penggunaan.php';</script>";
    exit;
}

// Ambil daftar pelanggan untuk dropdown
$pelanggan_list = mysqli_query($koneksi, "SELECT id_pelanggan, nama FROM payment_pelanggan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Edit Penggunaan | Electro Payment</title>
    
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
        select option { background-color: #18181b; }
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
                    <a href="data_pelanggan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-users-gear"></i> Data Pelanggan
                    </a>
                </li>
                <li>
                    <a href="data_pembayaran.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-money-bill-transfer"></i> Transaksi
                    </a>
                </li>
                <li>
                    <a href="data_tarif.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-bolt-lightning"></i> Atur Tarif
                    </a>
                </li>
                <li>
                    <a href="data_penggunaan.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
                        <i class="fa-solid fa-gauge-high"></i> Penggunaan
                    </a>
                </li>
                <li>
                    <a href="data_tagihan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col items-center">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500/10 text-blue-400 rounded-2xl mb-4">
                    <i class="fa-solid fa-gauge text-2xl"></i>
                </div>
                <h2 class="text-3xl font-black tracking-tight uppercase">Edit <span class="text-yellow-brand">Record Meter</span></h2>
                <p class="text-zinc-500 mt-2 text-sm font-mono tracking-widest">TRANSACTION_ID: #<?= $data['id'] ?></p>
            </div>

            <div class="w-full max-w-xl bg-zinc-900 border border-zinc-800 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-blue-500/50"></div>

                <form action="update_penggunaan.php" method="post" class="space-y-6">
                    
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Pelanggan</label>
                        <select name="id_pelanggan" class="form-input-custom w-full px-4 py-3 rounded-xl text-sm font-bold appearance-none cursor-not-allowed" required>
                            <?php while ($row = mysqli_fetch_assoc($pelanggan_list)) { 
                                $selected = ($row['id_pelanggan'] == $data['id_pelanggan']) ? "selected" : "";
                            ?>
                                <option value="<?= $row['id_pelanggan'] ?>" <?= $selected ?>>
                                    <?= $row['id_pelanggan'] ?> - <?= $row['nama'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Bulan Tagihan</label>
                            <select name="bulan" class="form-input-custom w-full px-4 py-3 rounded-xl text-sm font-bold" required>
                                <?php 
                                $bulan_list = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                                foreach ($bulan_list as $bln) {
                                    $s = ($bln == $data['bulan']) ? "selected" : "";
                                    echo "<option value='$bln' $s>$bln</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Tahun</label>
                            <input type="number" name="tahun" value="<?= $data['tahun'] ?>" required
                                class="form-input-custom w-full px-4 py-3 rounded-xl text-sm font-bold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Meter Awal</label>
                            <input type="number" name="meterawal" value="<?= $data['meterawal'] ?>" required
                                class="form-input-custom w-full px-4 py-3 rounded-xl text-sm font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-2">Meter Akhir</label>
                            <input type="number" name="meterakhir" value="<?= $data['meterakhir'] ?>" required
                                class="form-input-custom w-full px-4 py-3 rounded-xl text-sm font-bold text-yellow-brand">
                        </div>
                    </div>

                    <div class="pt-6 flex flex-col gap-3">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-xl transition-all flex items-center justify-center gap-3 uppercase tracking-widest text-xs">
                            <i class="fa-solid fa-rotate"></i> Update Record
                        </button>
                        <a href="data_penggunaan.php" class="w-full bg-zinc-800 hover:bg-zinc-700 text-zinc-400 font-bold py-3 rounded-xl transition-all text-center text-[10px] uppercase tracking-widest">
                            Batal
                        </a>
                    </div>

                </form>
            </div>

            <p class="mt-8 text-zinc-600 text-[10px] uppercase tracking-[0.3em] font-bold">
                ElectroPay Security Protocol Enabled
            </p>

        </div>
    </main>

</body>
</html>