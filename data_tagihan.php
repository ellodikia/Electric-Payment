<?php
include 'koneksi.php';
session_start(); 

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['bayar_id'])) {
    $id_tagihan = mysqli_real_escape_string($koneksi, $_GET['bayar_id']);
    
    $cek_tagihan = mysqli_query($koneksi, "SELECT * FROM payment_tagihan WHERE id = '$id_tagihan'");
    $data = mysqli_fetch_assoc($cek_tagihan);

    if ($data && $data['status'] == 0) {
        $id_pel = $data['id_pelanggan'];
        $bulan  = $data['bulan'];
        $total  = $data['jumlahtagihan'];
        $tgl    = date("Y-m-d");
        $id_byr = "PAY-" . time(); 
        
        $sql_riwayat = "INSERT INTO payment_pembayaran (id_pelanggan, id_bayar, tanggal, bulanbayar, biayaadmin, total, status) 
                        VALUES ('$id_pel', '$id_byr', '$tgl', '$bulan', 2500, '$total', 'Lunas')";
        
        $sql_update_status = "UPDATE payment_tagihan SET status = 1 WHERE id = '$id_tagihan'";

        if (mysqli_query($koneksi, $sql_riwayat) && mysqli_query($koneksi, $sql_update_status)) {
            $_SESSION['cetak_id'] = $id_byr;
            echo "<script>alert('Pembayaran Berhasil!'); window.location='data_tagihan.php';</script>";
            exit;
        }
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM payment_tagihan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png" type="image/png" />
    <title>Data Tagihan | Electro Payment</title>
    
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

    <?php if (isset($_SESSION['cetak_id'])) : ?>
    <script>
        window.open('cetak_struk.php?id=<?= $_SESSION['cetak_id']; ?>', '_blank');
    </script>
    <?php unset($_SESSION['cetak_id']); endif; ?>

    <?php include 'nav.php'; ?>

    <main class="max-w-7xl mx-auto px-4 pt-4 pb-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tighter uppercase italic">Billing <span class="text-yellow-brand">Center</span></h2>
                <p class="text-zinc-500 text-sm mt-2 uppercase tracking-widest font-bold font-semibold">Manajemen Tagihan & Penagihan</p>
            </div>
            
            <form action="search_tagihan.php" method="GET" class="flex items-center gap-2">
                <div class="relative group">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500 group-focus-within:text-yellow-400 transition-colors"></i>
                    <input 
                        type="text" 
                        name="keyword" 
                        placeholder="Cari ID Pelanggan..." 
                        class="bg-zinc-900 border border-zinc-800 text-zinc-200 text-xs rounded-xl py-3 pl-11 pr-4 w-full md:w-64 focus:ring-2 focus:ring-yellow-400/20 focus:border-yellow-400 outline-none transition-all placeholder:text-zinc-600 font-bold uppercase tracking-widest"
                        required
                    >
                </div>
                <button type="submit" class="bg-zinc-800 hover:bg-zinc-700 text-white px-6 py-3 rounded-xl font-black text-[10px] tracking-widest transition-all active:scale-95 border border-zinc-700">
                    CARI
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php
                while ($row = mysqli_fetch_array($query)) {
                    $status = $row['status'];
            ?>
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 hover:border-zinc-700 transition-all group relative overflow-hidden flex flex-col justify-between">
                
                <div class="absolute top-0 right-0 p-4">
                    <?php if ($status == 1) : ?>
                        <span class="bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter">
                            <i class="fa-solid fa-check-double mr-1"></i> LUNAS
                        </span>
                    <?php else : ?>
                        <span class="bg-amber-500/10 text-amber-500 border border-amber-500/20 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter">
                            <i class="fa-solid fa-clock mr-1"></i> PENDING
                        </span>
                    <?php endif; ?>
                </div>

                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-zinc-800 rounded-2xl flex items-center justify-center text-zinc-500 group-hover:text-yellow-brand transition-colors">
                            <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-zinc-500 font-black uppercase tracking-widest">Customer ID</p>
                            <h3 class="text-white font-mono font-bold text-lg leading-tight tracking-wider"><?= $row['id_pelanggan']; ?></h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-y border-zinc-800/50 py-4">
                        <div>
                            <p class="text-[9px] text-zinc-600 font-black uppercase mb-1">Periode</p>
                            <p class="text-xs font-bold text-zinc-300 uppercase italic"><?= $row['bulan'] ?> / <?= $row['tahun'] ?></p>
                        </div>
                        <div>
                            <p class="text-[9px] text-zinc-600 font-black uppercase mb-1">Penggunaan</p>
                            <p class="text-xs font-bold text-zinc-300"><?= $row['jumlahmeter']; ?> <span class="text-[10px] text-zinc-500">kWh</span></p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">Total Billing</span>
                    <span class="text-2xl font-black text-emerald-400 font-mono">Rp <?= number_format($row['jumlahtagihan'], 0, ',', '.'); ?></span>
                </div>

                <?php if ($status == 0) : ?>
                    <a href="?bayar_id=<?= $row['id']; ?>" 
                       class="w-full bg-yellow-brand hover:bg-yellow-400 text-zinc-950 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all active:scale-95 shadow-xl shadow-yellow-900/10"
                       onclick="return confirm('Proses pembayaran tagihan ini?')">
                        <i class="fa-solid fa-cash-register text-sm"></i> Bayar Sekarang
                    </a>
                <?php else : ?>
                    <button disabled class="w-full bg-zinc-800 text-zinc-500 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 cursor-not-allowed">
                        <i class="fa-solid fa-circle-check text-sm text-emerald-500"></i> Transaksi Selesai
                    </button>
                <?php endif; ?>
            </div>
            <?php } ?>
        </div>

        <?php if (mysqli_num_rows($query) == 0): ?>
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-20 text-center">
            <i class="fa-solid fa-magnifying-glass text-zinc-800 text-6xl mb-4"></i>
            <p class="text-zinc-500 italic">Data tagihan tidak ditemukan.</p>
        </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>