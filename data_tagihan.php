<?php
include 'koneksi.php';
session_start(); 

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Logika Pembayaran
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
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body class="bg-zinc-950 text-zinc-100 min-h-screen">

    <?php if (isset($_SESSION['cetak_id'])) : ?>
    <script>
        window.open('cetak_struk.php?id=<?= $_SESSION['cetak_id']; ?>', '_blank');
    </script>
    <?php unset($_SESSION['cetak_id']); endif; ?>

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
                    <a href="data_penggunaan.php" class="text-zinc-400 hover:text-yellow-brand font-medium flex items-center gap-2 whitespace-nowrap transition-colors">
                        <i class="fa-solid fa-gauge-high"></i> Penggunaan
                    </a>
                </li>
                <li>
                    <a href="data_tagihan.php" class="text-yellow-brand font-bold flex items-center gap-2 whitespace-nowrap border-b-2 border-yellow-brand pb-1">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-black">Data Tagihan</h2>
                <p class="text-zinc-500 text-xs uppercase tracking-[0.2em] mt-1">Management & Billing System</p>
            </div>
            <div class="flex gap-2">
                <a href="#" class="bg-zinc-800 hover:bg-zinc-700 text-white px-5 py-3 rounded-xl font-bold text-xs flex items-center gap-2 border border-zinc-700 transition-all">
                    <i class="fa-solid fa-magnifying-glass"></i> CARI TAGIHAN
                </a>
            </div>
        </div>

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/50 text-zinc-500 text-[10px] uppercase tracking-[0.2em] border-b border-zinc-800">
                            <th class="px-6 py-5 text-center">No</th>
                            <th class="px-6 py-5">Identitas Pelanggan</th>
                            <th class="px-6 py-5">Periode</th>
                            <th class="px-6 py-5">Volume Penggunaan</th>
                            <th class="px-6 py-5">Total Billing</th>
                            <th class="px-6 py-5 text-center">Status / Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                                $status = $row['status'];
                        ?>
                        <tr class="hover:bg-zinc-800/30 transition-all group">
                            <td class="px-6 py-5 text-center text-zinc-600 font-mono text-sm"><?= $no++; ?></td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="text-zinc-400 text-[10px] font-bold uppercase tracking-tighter">Account ID</span>
                                    <span class="text-yellow-brand font-mono font-bold tracking-wider"><?= $row['id_pelanggan']; ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-zinc-800 text-zinc-300 px-3 py-1 rounded-lg text-xs font-bold">
                                    <?= $row['bulan'] ?> / <?= $row['tahun'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2">
                                    <span class="text-zinc-200 font-bold"><?= $row['jumlahmeter']; ?></span>
                                    <span class="text-zinc-600 text-[10px] font-black uppercase">kWh</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-emerald-400 font-mono font-bold">Rp <?= number_format($row['jumlahtagihan'], 0, ',', '.'); ?></span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <?php if ($status == 1) : ?>
                                    <span class="bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 px-4 py-1.5 rounded-full text-[10px] font-black uppercase inline-flex items-center gap-2">
                                        <i class="fa-solid fa-check-double"></i> Paid / Lunas
                                    </span>
                                <?php else : ?>
                                    <a href="?bayar_id=<?= $row['id']; ?>" 
                                       class="bg-yellow-brand hover:bg-yellow-400 text-zinc-950 px-4 py-2 rounded-xl text-[10px] font-black uppercase flex items-center justify-center gap-2 transition-all active:scale-95 shadow-lg shadow-yellow-900/10"
                                       onclick="return confirm('Proses pembayaran tagihan ini?')">
                                        <i class="fa-solid fa-cash-register text-xs"></i> Bayar Sekarang
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="text-center py-10 border-t border-zinc-900">
        <p class="text-zinc-700 text-[10px] font-black uppercase tracking-[0.5em]">
            &copy; <?= date('Y'); ?> Electro Payment System &bull; Billing Core V2
        </p>
    </footer>

</body>
</html>