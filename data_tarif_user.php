<?php
session_start();
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM payment_tarif ORDER BY id DESC") or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Data Tarif | ElectroPay</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .glass-card {
            background: rgba(24, 24, 27, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 selection:bg-yellow-400 selection:text-zinc-900">

    <nav class="bg-zinc-950/70 backdrop-blur-xl border-b border-white/5 sticky top-0 z-[60]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-4 group cursor-pointer">
                    <div class="w-11 h-11 bg-yellow-400 rounded-2xl flex items-center justify-center text-zinc-950 transition-transform group-hover:rotate-12 duration-300">
                        <i class="fa-solid fa-bolt-lightning text-xl"></i>
                    </div>
                    <span class="font-black text-2xl tracking-tighter uppercase italic">ELECTRO<span class="text-yellow-400">PAY</span></span>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="hidden md:flex items-center gap-8 mr-4">
                        <a href="index.php" class="text-sm font-bold text-zinc-400 hover:text-white transition-colors tracking-wide uppercase">Beranda</a>
                        <a href="data_tarif.php" class="text-sm font-bold text-yellow-400 tracking-wide uppercase">Tarif</a>
                    </div>
                    <a href="login.php" class="bg-white text-zinc-950 px-6 py-3 rounded-2xl text-xs font-black transition-all hover:bg-yellow-400 hover:scale-105 flex items-center gap-2 uppercase tracking-widest shadow-xl shadow-white/5">
                        <i class="fa-solid fa-user-shield"></i> Portal Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="sticky top-20 z-40 bg-zinc-950/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex overflow-x-auto gap-10 no-scrollbar">
                <a href="index.php" class="py-6 flex items-center gap-3 text-sm font-bold uppercase tracking-[0.2em] text-zinc-500 hover:text-zinc-200 transition-colors">
                    <i class="fa-solid fa-bolt-lightning"></i> Cek Tagihan
                </a>
                <a href="data_tarif.php" class="border-b-2 border-yellow-400 py-6 flex items-center gap-3 text-sm font-black uppercase tracking-[0.2em] text-yellow-400">
                    <i class="fa-solid fa-chart-simple"></i> List Tarif
                </a>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 animate-[fadeIn_0.5s_ease-out]">
            <div>
                <span class="text-yellow-400 text-[10px] font-black uppercase tracking-[0.4em] mb-2 block">Transparency Report</span>
                <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tighter leading-none italic">Data <span class="text-yellow-400">Tarif</span> Listrik</h2>
                <p class="text-zinc-500 text-sm font-medium mt-3 max-w-md">Daftar transparansi golongan daya dan standarisasi biaya per kWh yang berlaku saat ini.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php while ($row = mysqli_fetch_array($query)) { ?>
            <div class="glass-card rounded-[2.5rem] p-8 hover:border-yellow-400/30 transition-all group relative overflow-hidden animate-[fadeIn_0.5s_ease-out]">
                
                <div class="flex justify-between items-start mb-10">
                    <div class="w-14 h-14 bg-zinc-900/50 rounded-2xl flex items-center justify-center text-yellow-400 border border-white/5 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-xl">
                        <i class="fa-solid fa-bolt text-2xl"></i>
                    </div>
                    <span class="text-[10px] font-black text-zinc-500 bg-zinc-950/50 px-3 py-1.5 rounded-xl border border-white/5 uppercase tracking-widest group-hover:text-yellow-400 transition-colors">
                        #<?= $row['kodetarif']; ?>
                    </span>
                </div>

                <div class="mb-8">
                    <p class="text-[10px] text-zinc-500 font-black uppercase tracking-[0.2em] mb-2">Power Capacity</p>
                    <h3 class="text-4xl font-black text-white leading-none tracking-tighter italic">
                        <?= number_format($row['daya'], 0, ',', '.'); ?>
                        <span class="text-xs font-bold text-zinc-600 ml-1 uppercase not-italic tracking-normal">VA</span>
                    </h3>
                </div>

                <div class="bg-zinc-950/50 rounded-[1.5rem] p-6 border border-white/5 group-hover:border-yellow-400/20 transition-all">
                    <p class="text-[10px] text-zinc-500 font-black uppercase tracking-[0.2em] mb-3">Rate per kWh</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-xs font-bold text-yellow-400/50">IDR</span>
                        <span class="text-2xl font-black text-emerald-400 tracking-tighter">
                            <?= number_format($row['tarifperkwh'], 0, ',', '.'); ?>
                        </span>
                        <span class="text-[10px] text-zinc-600 font-black uppercase ml-1">/ Unit</span>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 h-1 bg-yellow-400 w-0 group-hover:w-full transition-all duration-500 shadow-[0_0_15px_rgba(250,204,21,0.5)]"></div>
            </div>
            <?php } ?>
        </div>

        <?php if (mysqli_num_rows($query) == 0): ?>
        <div class="glass-card rounded-[3rem] p-24 text-center border-dashed border-2 border-white/5 mt-10">
            <div class="w-24 h-24 bg-zinc-900 text-zinc-700 flex items-center justify-center rounded-full mx-auto mb-8 text-4xl">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <h3 class="text-xl font-black text-white uppercase tracking-widest mb-2">Database Kosong</h3>
            <p class="text-zinc-500 text-sm font-medium">Data tarif belum diinput ke dalam sistem.</p>
        </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>