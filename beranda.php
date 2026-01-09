<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro Pay - Solusi Pembayaran Listrik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#121212] text-white">

    <header class="sticky top-0 z-50 bg-[#1e1e1e]/90 backdrop-blur-lg border-b border-white/5">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a class="text-2xl font-black text-yellow-400 flex items-center gap-2 tracking-tighter uppercase">
                <i class="fa-solid fa-bolt-lightning text-white"></i> Electro Pay
            </a>
            <div class="flex items-center gap-3">
                <a href="beranda.php" class="flex items-center gap-2 bg-yellow-400 text-black px-5 py-2 rounded-xl text-sm font-black transition transform hover:scale-105">
                    <i class="fa-solid fa-house"></i> <span class="hidden sm:inline">HOME</span>
                </a>
                <a href="login.php" class="flex items-center gap-2 bg-[#2a2a2a] text-white hover:bg-white hover:text-black px-5 py-2 rounded-xl text-sm font-bold transition border border-white/10">
                    <i class="fa-solid fa-right-to-bracket text-yellow-400"></i> LOGIN
                </a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="relative overflow-hidden rounded-[2.5rem] shadow-2xl border border-white/5 bg-[#1e1e1e]">
            <div class="min-w-full h-64 md:h-96 relative">
                <img src="image/6.png" class="w-full h-full object-cover grayscale opacity-30" alt="Banner">
                <div class="absolute inset-0 bg-gradient-to-r from-[#121212] via-[#121212]/60 to-transparent"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-16">
                    <span class="text-yellow-400 font-black uppercase tracking-[0.3em] text-xs mb-4">Fast & Reliable</span>
                    <h2 class="text-white text-4xl md:text-6xl font-black max-w-2xl leading-none uppercase italic">Bayar Listrik <br><span class="text-yellow-400">Tanpa Ribet.</span></h2>
                    <p class="text-gray-400 mt-6 max-w-md font-medium text-lg">Layanan pembayaran listrik tercepat dengan sistem keamanan terenkripsi.</p>
                </div>
            </div>
        </div>

        <nav class="mt-12 flex justify-center">
            <div class="inline-flex bg-[#1e1e1e] p-2 rounded-2xl border border-white/5 gap-2">
                <a href="#" class="flex items-center gap-2 bg-yellow-400 text-black px-8 py-3 rounded-xl text-sm font-black uppercase transition shadow-lg shadow-yellow-400/10">
                    <i class="fa-solid fa-house"></i> Beranda
                </a>
                <a href="data_tarif_user.php" class="flex items-center gap-2 hover:bg-[#2a2a2a] text-gray-400 px-8 py-3 rounded-xl text-sm font-bold uppercase transition">
                    <i class="fa-solid fa-list-check"></i> Cek Tarif
                </a>
            </div>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-12">
            <div class="lg:col-span-7">
                <div class="bg-[#1e1e1e] p-10 rounded-[2.5rem] border border-white/5 relative overflow-hidden group shadow-2xl">
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-yellow-400/5 rounded-full blur-3xl group-hover:bg-yellow-400/10 transition-all"></div>
                    
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-yellow-400 rounded-2xl flex items-center justify-center text-black shadow-xl shadow-yellow-400/20">
                            <i class="fa-solid fa-receipt text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-black uppercase tracking-tight">Cek Tagihan</h2>
                            <p class="text-gray-500 font-medium italic">Masukkan ID pelanggan untuk validasi data</p>
                        </div>
                    </div>
                    
                    <form action="" method="GET" class="space-y-6 relative z-10">
                        <div class="relative">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-3 ml-2">Customer Identification Number</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-yellow-400">
                                    <i class="fa-solid fa-fingerprint text-xl"></i>
                                </span>
                                <input 
                                    type="text" 
                                    name="id_pelanggan"
                                    required
                                    placeholder="MASUKKAN ID PELANGGAN..." 
                                    class="w-full pl-14 pr-6 py-5 bg-[#121212] border border-white/10 rounded-2xl focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-all font-black text-lg placeholder:text-gray-700 tracking-wider"
                                >
                            </div>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-12 py-5 bg-white hover:bg-yellow-400 text-black rounded-2xl font-black transition-all shadow-xl hover:shadow-yellow-400/20 flex items-center justify-center gap-3 uppercase tracking-widest text-sm">
                            PROSES DATA <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col gap-6">
                <div class="bg-yellow-400 rounded-[2.5rem] p-10 text-black shadow-2xl relative overflow-hidden flex-grow">
                    <div class="relative z-10">
                        <h2 class="text-3xl font-black uppercase italic leading-none mb-4">Butuh <br>Bantuan?</h2>
                        <p class="text-black/60 font-bold mb-8 text-sm">Tim support kami siap melayani Anda 24 jam nonstop.</p>
                        
                        <div class="flex flex-wrap gap-3">
                            <a href="#" class="w-14 h-14 flex items-center justify-center bg-black text-white hover:bg-white hover:text-black rounded-2xl transition-all shadow-lg">
                                <i class="fa-brands fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="w-14 h-14 flex items-center justify-center bg-black text-white hover:bg-white hover:text-black rounded-2xl transition-all shadow-lg">
                                <i class="fa-brands fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="w-14 h-14 flex items-center justify-center bg-black text-white hover:bg-white hover:text-black rounded-2xl transition-all shadow-lg">
                                <i class="fa-brands fa-whatsapp text-xl"></i>
                            </a>
                            <a href="#" class="w-14 h-14 flex items-center justify-center bg-black text-white hover:bg-white hover:text-black rounded-2xl transition-all shadow-lg">
                                <i class="fa-solid fa-headset text-xl"></i>
                            </a>
                        </div>
                    </div>
                    <i class="fa-solid fa-bolt-lightning absolute -bottom-10 -right-5 text-[12rem] text-black/5 rotate-12"></i>
                </div>

                <div class="bg-[#1e1e1e] border border-yellow-400/20 rounded-3xl p-6 flex gap-5 items-center">
                    <div class="w-14 h-14 flex-shrink-0 bg-yellow-400/10 text-yellow-400 rounded-2xl flex items-center justify-center border border-yellow-400/20">
                        <i class="fa-solid fa-shield-halved text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-white uppercase tracking-wider">Keamanan Terjamin</h4>
                        <p class="text-xs text-gray-500 font-medium leading-relaxed">Sistem kami menggunakan enkripsi SSL 256-bit untuk melindungi transaksi Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-20 py-10 border-t border-white/5">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-gray-600 text-[10px] font-black uppercase tracking-[0.2em]">
                &copy; 2026 Electro Payment System. Global Infrastructure.
            </p>
            <div class="flex gap-8">
                <a href="#" class="text-[10px] font-black text-gray-600 hover:text-yellow-400 uppercase tracking-widest transition">Privacy Policy</a>
                <a href="#" class="text-[10px] font-black text-gray-600 hover:text-yellow-400 uppercase tracking-widest transition">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>
</html>