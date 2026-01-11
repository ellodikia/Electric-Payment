<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Dashboard Admin | Electro Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-yellow-brand { background-color: #FACC15; }
        .text-yellow-brand { color: #FACC15; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100">

    <?php include 'nav.php'; ?>
    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative h-56 overflow-hidden rounded-2xl md:h-96 border border-zinc-800 shadow-2xl">
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="image/1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="Slide 1">
                </div>
            </div>
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                <button type="button" class="w-3 h-3 rounded-full bg-yellow-brand" aria-current="true" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-zinc-500" aria-current="false" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-zinc-500" aria-current="false" data-carousel-slide-to="2"></button>
            </div>
        </div>
    </div>


    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <div class="md:col-span-7 bg-zinc-900 p-8 rounded-3xl border border-zinc-800 shadow-xl h-fit">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-yellow-brand/10 text-yellow-brand flex items-center justify-center rounded-2xl text-xl">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h2 class="text-2xl font-bold">Cek Tagihan Pelanggan</h2>
                </div>
                <form class="space-y-4" id="form-cek">
                    <div class="relative">
                        <label class="block text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2 ml-1">ID Pelanggan</label>
                        <input type="text" id="input-id" placeholder="Masukkan ID Pelanggan" class="w-full bg-zinc-800 border border-zinc-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-brand/50 focus:border-yellow-brand transition-all">
                    </div>
                    <button type="button" id="btn-periksa" class="w-full bg-yellow-brand hover:bg-yellow-500 text-zinc-950 font-black py-4 rounded-xl shadow-lg shadow-yellow-900/20 flex items-center justify-center gap-2 transition-transform active:scale-95">
                        PERIKSA DATA <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div id="hasil-pencarian" class="mt-6"></div>
            </div>

            <div class="md:col-span-5 flex flex-col items-center">
                <div class="bg-zinc-900 w-full max-w-sm rounded-3xl border border-zinc-800 shadow-xl overflow-hidden group">
                    <div class="h-24 bg-yellow-brand flex items-end justify-center">
                        <div class="p-1 bg-zinc-900 rounded-full translate-y-1/2 border-4 border-zinc-900">
                            <img src="image/5.png" class="rounded-full w-32 h-32 object-cover border-4 border-zinc-800 group-hover:scale-105 transition-transform" alt="Admin">
                        </div>
                    </div>
                    <div class="pt-20 pb-8 px-8 text-center">
                        <h5 class="text-xl font-bold text-white mb-1 uppercase tracking-tight italic">Profil Administrator</h5>
                        <p class="text-zinc-400 text-sm mb-6">Selamat datang kembali di Dashboard!</p>
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-center bg-zinc-950/50 p-3 rounded-xl border border-zinc-800">
                                <span class="text-zinc-500 text-xs font-bold uppercase">Status</span>
                                <span class="text-xs font-bold text-green-500 flex items-center gap-1">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> ONLINE
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        document.getElementById('btn-periksa').addEventListener('click', function() {
            const idPelanggan = document.getElementById('input-id').value;
            const kontainerHasil = document.getElementById('hasil-pencarian');

            if (idPelanggan === "") {
                alert("Silakan masukkan ID Pelanggan terlebih dahulu!");
                return;
            }

            this.innerHTML = '<i class="fa-solid fa-spinner animate-spin"></i> MEMPROSES...';
            this.disabled = true;

            fetch('proses_cek_tagihan.php?id=' + idPelanggan)
                .then(response => response.text())
                .then(data => {
                    kontainerHasil.innerHTML = data;
                    this.innerHTML = 'PERIKSA DATA <i class="fa-solid fa-arrow-right"></i>';
                    this.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.disabled = false;
                });
        });
    </script>
</body>
</html>