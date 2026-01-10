<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

// Ambil data untuk referensi jika diperlukan
$tarif = mysqli_query($koneksi, "SELECT kodetarif, daya FROM payment_tarif");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Tambah Tarif | Electro Payment</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        
        /* Custom Input Styling */
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
                    <a href="data_tarif.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
                        <i class="fa-solid fa-bolt-lightning"></i> Atur Tarif
                    </a>
                </li>
                <li>
                    <a href="data_penggunaan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
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
                <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-brand/10 text-yellow-brand rounded-2xl mb-4">
                    <i class="fa-solid fa-bolt-lightning text-2xl"></i>
                </div>
                <h2 class="text-3xl font-black tracking-tight">Tambah Golongan Tarif</h2>
                <p class="text-zinc-500 mt-2">Daftarkan kategori daya baru ke dalam sistem billing.</p>
            </div>

            <div class="w-full max-w-md bg-zinc-900 border border-zinc-800 rounded-3xl p-8 shadow-2xl">
                <form action="insert_tarif.php" method="post" class="space-y-6">
                    
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-zinc-500 mb-2">Kode Tarif</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-600">
                                <i class="fa-solid fa-hashtag"></i>
                            </span>
                            <input type="text" name="kodetarif" placeholder="Contoh: R1/900" required
                                class="form-input-custom w-full pl-10 pr-4 py-3 rounded-xl text-sm font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-zinc-500 mb-2">Besar Daya (VA)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-600">
                                <i class="fa-solid fa-plug-circle-bolt"></i>
                            </span>
                            <input type="text" name="daya" placeholder="900" required
                                class="form-input-custom w-full pl-10 pr-4 py-3 rounded-xl text-sm font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-zinc-500 mb-2">Biaya Per KWH</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-600 font-bold text-xs">
                                Rp
                            </span>
                            <input type="number" name="tarifperkwh" placeholder="1350" required
                                class="form-input-custom w-full pl-10 pr-4 py-3 rounded-xl text-sm font-medium">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-yellow-brand hover:bg-yellow-400 text-zinc-950 font-black py-4 rounded-xl transition-all flex items-center justify-center gap-2 uppercase tracking-widest text-xs active:scale-[0.98]">
                            <i class="fa-solid fa-save"></i> Simpan Golongan
                        </button>
                    </div>

                </form>

                <div class="mt-6 text-center">
                    <a href="data_tarif.php" class="text-zinc-600 hover:text-zinc-400 text-xs font-bold uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Batal & Kembali
                    </a>
                </div>
            </div>

            <p class="mt-8 text-zinc-600 text-[10px] uppercase tracking-[0.2em] font-medium text-center max-w-xs leading-relaxed">
                Pastikan data yang dimasukkan akurat karena akan menjadi dasar perhitungan tagihan seluruh pelanggan.
            </p>

        </div>
    </main>

</body>
</html>