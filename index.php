<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="electropay, electro-pay,aplikasi pembayaran listrik, cek tagihan listrik online, manajemen daya listrik, bayar listrik perkwh, sistem informasi pln, aplikasi admin listrik, pengelolaan data pelanggan listrik, tarif listrik terbaru, monitoring penggunaan listrik">
    <meta name="description" content="ElectroPay - Solusi cerdas manajemen dan pembayaran daya listrik praktis, transparan, dan efisien.">
    <meta name="author" content="ElectroPay, electro-pay">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroPay</title>
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
        .yellow-glow:hover {
            box-shadow: 0 0 20px rgba(250, 204, 21, 0.15);
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        
        @keyframes subtle-float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-anim { animation: subtle-float 6s ease-in-out infinite; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 selection:bg-yellow-400 selection:text-zinc-900 overflow-x-hidden">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-yellow-400/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[30%] bg-blue-500/5 blur-[100px] rounded-full"></div>
    </div>

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
                        <a href="index.php" class="text-sm font-bold text-yellow-400 tracking-wide uppercase">Beranda</a>
                        <a href="data_tarif_user.php" class="text-sm font-bold text-zinc-400 hover:text-white transition-colors tracking-wide uppercase">Tarif</a>
                    </div>
                    <a href="login.php" class="bg-white text-zinc-950 px-6 py-3 rounded-2xl text-xs font-black transition-all hover:bg-yellow-400 hover:scale-105 flex items-center gap-2 uppercase tracking-widest shadow-xl shadow-white/5">
                        <i class="fa-solid fa-user-shield"></i> Portal Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 mt-10">
        <div id="default-carousel" class="relative w-full group" data-carousel="slide">
            <div class="relative h-56 overflow-hidden rounded-[2.5rem] md:h-96 border border-white/5 shadow-2xl">
                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                    <img src="image/1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover h-full brightness-75 transition-all group-hover:scale-105" alt="Banner">
                    <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/40 to-transparent flex items-center px-12">
                        <div class="max-w-md space-y-4">
                            <span class="bg-yellow-400 text-zinc-900 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Eksklusif</span>
                            <h2 class="text-4xl md:text-5xl font-black leading-none">Bayar Listrik <br><span class="text-yellow-400">Tanpa Antri.</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute z-30 flex -translate-x-1/2 bottom-8 left-1/2 space-x-3">
                <button type="button" class="w-12 h-1.5 rounded-full bg-yellow-400" aria-current="true" data-carousel-slide-to="0"></button>
                <button type="button" class="w-12 h-1.5 rounded-full bg-white/20" aria-current="false" data-carousel-slide-to="1"></button>
            </div>
        </div>
    </div>

    <div class="mt-12 sticky top-20 z-40 bg-zinc-950/80 backdrop-blur-md border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex overflow-x-auto gap-10 no-scrollbar">
                <a href="#" class="border-b-2 border-yellow-400 py-6 flex items-center gap-3 text-sm font-black uppercase tracking-[0.2em] text-yellow-400">
                    <i class="fa-solid fa-bolt-lightning"></i> Cek Tagihan
                </a>
                <a href="data_tarif_user.php" class="py-6 flex items-center gap-3 text-sm font-bold uppercase tracking-[0.2em] text-zinc-500 hover:text-zinc-200 transition-colors">
                    <i class="fa-solid fa-chart-simple"></i> List Tarif
                </a>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <div class="lg:col-span-5 lg:sticky lg:top-44">
                <div class="glass-card p-10 rounded-[3rem] shadow-3xl relative overflow-hidden group">
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-yellow-400/5 rounded-full blur-3xl group-hover:bg-yellow-400/10 transition-colors"></div>
                    
                    <div class="relative space-y-8">
                        <div>
                            <div class="w-16 h-16 bg-yellow-400/10 text-yellow-400 flex items-center justify-center rounded-2xl text-2xl mb-6">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <h2 class="text-3xl font-black tracking-tighter text-white">Cek Tagihan</h2>
                            <p class="text-zinc-400 font-medium mt-2 leading-relaxed">Masukkan ID pelanggan Anda untuk mengakses rincian tagihan secara real-time.</p>
                        </div>
                        
                        <form action="" method="GET" class="space-y-6">
                            <div class="space-y-3">
                                <label class="block text-zinc-500 text-[10px] font-black uppercase tracking-[0.3em] ml-2">ID Pelanggan</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-zinc-600 font-mono">ID</span>
                                    <input 
                                        type="text" 
                                        name="id_pelanggan"
                                        value="<?= isset($_GET['id_pelanggan']) ? htmlspecialchars($_GET['id_pelanggan']) : '' ?>"
                                        placeholder="0000 0000 0000" 
                                        class="w-full bg-zinc-900/50 border border-white/10 text-white pl-12 pr-6 py-5 rounded-[2rem] focus:outline-none focus:ring-4 focus:ring-yellow-400/10 focus:border-yellow-400 transition-all text-xl font-mono tracking-[0.2em] placeholder:text-zinc-800"
                                        required
                                    >
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-zinc-950 font-black py-6 rounded-[2rem] shadow-2xl shadow-yellow-400/10 flex items-center justify-center gap-4 transition-all hover:scale-[1.02] active:scale-95 uppercase tracking-widest text-xs">
                                Periksa Tagihan <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <?php if (isset($_GET['id_pelanggan'])): 
                    $id_pel = mysqli_real_escape_string($koneksi, $_GET['id_pelanggan']);
                    $q_pel = mysqli_query($koneksi, "SELECT p.*, t.daya FROM payment_pelanggan p JOIN payment_tarif t ON p.kodetarif = t.kodetarif WHERE p.id_pelanggan = '$id_pel'");
                    $d_pel = mysqli_fetch_assoc($q_pel);
                ?>
                <div class="animate-[fadeIn_0.6s_ease-out]">
                    <?php if ($d_pel): 
                        $q_tag = mysqli_query($koneksi, "SELECT * FROM payment_tagihan WHERE id_pelanggan = '$id_pel' AND status = 0 ORDER BY id DESC");
                    ?>
                        <div class="glass-card rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl">
                            <div class="p-10 border-b border-white/5 bg-white/5 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                <div class="flex items-center gap-5">
                                    <div class="w-16 h-16 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-400 border border-white/10">
                                        <i class="fa-solid fa-user-check text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-black text-white"><?= $d_pel['nama'] ?></h3>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-zinc-500 text-xs font-bold font-mono">#<?= $d_pel['id_pelanggan'] ?></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-zinc-700"></span>
                                            <span class="text-yellow-400 text-xs font-black uppercase tracking-tighter"><?= $d_pel['kodetarif'] ?> / <?= $d_pel['daya'] ?> VA</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-5 py-2.5 rounded-full bg-emerald-500/10 border border-emerald-500/20">
                                    <span class="text-emerald-400 text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Terverifikasi
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-10">
                                <?php if (mysqli_num_rows($q_tag) > 0): ?>
                                    <h4 class="text-xs font-black text-zinc-500 uppercase tracking-[0.3em] mb-8">Tagihan Belum Terbayar</h4>
                                    <div class="grid grid-cols-1 gap-6">
                                        <?php while ($tag = mysqli_fetch_assoc($q_tag)): ?>
                                            <div class="bg-zinc-900/40 p-8 rounded-[2rem] border border-white/5 hover:border-yellow-400/30 transition-all group relative overflow-hidden">
                                                <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-red-500/5 to-transparent"></div>
                                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative z-10">
                                                    <div class="flex items-center gap-6">
                                                        <div class="w-14 h-14 bg-zinc-800 rounded-2xl flex items-center justify-center text-zinc-500 group-hover:text-yellow-400 transition-colors">
                                                            <i class="fa-solid fa-file-invoice text-xl"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-zinc-500 text-[10px] font-black uppercase tracking-widest"><?= $tag['bulan'] ?> <?= $tag['tahun'] ?></p>
                                                            <h4 class="text-white font-black text-3xl mt-1 tracking-tighter">Rp <?= number_format($tag['jumlahtagihan'], 0, ',', '.') ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col items-end">
                                                        <span class="bg-red-500/10 text-red-500 text-[10px] font-black px-4 py-2 rounded-full uppercase border border-red-500/10 mb-2">Tunggakan</span>
                                                        <p class="text-zinc-600 text-[10px] font-bold italic">Batas bayar: Tgl 20</p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                    <div class="mt-10 p-6 bg-yellow-400/5 rounded-[2rem] border border-yellow-400/10 flex items-start gap-5">
                                        <div class="p-3 bg-yellow-400 rounded-xl text-zinc-950">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </div>
                                        <div>
                                            <p class="text-zinc-200 text-sm font-bold">Instruksi Pembayaran</p>
                                            <p class="text-zinc-500 text-xs leading-relaxed mt-1">Gunakan ID Pelanggan Anda untuk membayar melalui m-Banking, ATM, atau agen POS/PPOB terdekat.</p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-20 bg-emerald-500/[0.02] rounded-[3rem]">
                                        <div class="w-24 h-24 bg-emerald-500/10 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-8 float-anim">
                                            <i class="fa-solid fa-check-double text-4xl"></i>
                                        </div>
                                        <h4 class="text-3xl font-black text-white tracking-tight">Tagihan Beres!</h4>
                                        <p class="text-zinc-500 mt-4 max-w-sm mx-auto font-medium">Terima kasih atas disiplin Anda. Semua tagihan telah dilunasi dengan sukses.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="bg-red-500/5 border border-red-500/10 p-12 rounded-[3rem] text-center">
                            <div class="w-20 h-20 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-8">
                                <i class="fa-solid fa-ghost text-3xl"></i>
                            </div>
                            <h4 class="text-white font-black text-2xl tracking-tight italic">ID Tidak Dikenali</h4>
                            <p class="text-zinc-500 mt-3 font-medium">Maaf, data pelanggan untuk <span class="text-red-400 font-mono font-black"><?= htmlspecialchars($id_pel) ?></span> tidak ditemukan di jaringan kami.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <?php else: ?>
                <div class="bg-zinc-900/40 border border-white/5 rounded-[3rem] p-12 flex flex-col items-center text-center">
                     <div class="w-32 h-32 bg-yellow-400/5 rounded-full flex items-center justify-center mb-8">
                        <i class="fa-solid fa-bolt-lightning text-yellow-400 text-5xl"></i>
                     </div>
                     <h3 class="text-2xl font-black text-white italic">Hemat Energi, Hemat Biaya.</h3>
                     <p class="text-zinc-500 mt-4 max-w-md leading-relaxed font-medium">Dapatkan laporan penggunaan listrik bulanan dan tips penghematan energi hanya di aplikasi ElectroPay.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>