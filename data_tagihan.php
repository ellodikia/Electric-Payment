<?php
include 'koneksi.php';

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
            
            echo "<script>
                    alert('Pembayaran Berhasil!');
                    window.location='index.php?page=tagihan'; 
                  </script>";
            exit;
        }
    }
}

$query = mysqli_query($koneksi, "SELECT t.*, p.id_bayar 
                                 FROM payment_tagihan t 
                                 LEFT JOIN payment_pembayaran p ON t.id_pelanggan = p.id_pelanggan AND t.bulan = p.bulanbayar
                                 ORDER BY t.id DESC");
?>

<?php if (isset($_SESSION['cetak_id'])) : ?>
<script>
    window.open('cetak_struk.php?id=<?= $_SESSION['cetak_id']; ?>', '_blank');
</script>
<?php 
    unset($_SESSION['cetak_id']);
endif; 
?>

<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 animate-fadeIn">
    <div>
        <h2 class="text-3xl md:text-5xl font-black uppercase italic tracking-tighter text-white">
            Billing <span class="text-yellow-400">& Tagihan</span>
        </h2>
        <p class="text-gray-400 mt-2 font-medium text-sm">Kelola penagihan pelanggan dan proses pembayaran instan.</p>
    </div>
    <div class="flex gap-3 w-full md:w-auto">
        <div class="relative group w-full md:w-64">
            <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input type="text" placeholder="Cari ID Pelanggan..." class="w-full bg-[#1e1e1e] border border-white/10 rounded-2xl py-4 pl-12 pr-4 text-xs font-bold text-white focus:outline-none focus:border-yellow-400 transition">
        </div>
    </div>
</div>

<div class="bg-[#1e1e1e] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl relative">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#252525] border-b border-white/5">
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center w-16">No</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Pelanggan</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Periode</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Konsumsi</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Total Tagihan</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Status / Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                ?>
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-6 text-sm font-black text-gray-600 text-center"><?= $no++; ?></td>
                    <td class="px-6 py-6">
                        <span class="bg-[#121212] px-3 py-1.5 rounded-lg border border-white/5 font-mono text-xs font-bold text-yellow-400 tracking-wider">
                            <?= $row['id_pelanggan']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-6 text-center text-xs font-bold text-white uppercase italic">
                        <?= $row['bulan']; ?> <span class="text-gray-500 not-italic"><?= $row['tahun']; ?></span>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <span class="text-white font-black"><?= $row['jumlahmeter']; ?></span>
                        <span class="text-[10px] text-gray-500 font-bold ml-1">kWh</span>
                    </td>
                    <td class="px-6 py-6">
                        <span class="text-yellow-400 font-black italic text-sm">Rp <?= number_format($row['jumlahtagihan'], 0, ',', '.'); ?></span>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <?php if ($row['status'] == 1) : ?>
                            <div class="flex items-center justify-center gap-2">
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/10 text-green-500 rounded-xl border border-green-500/20 shadow-lg shadow-green-500/5">
                                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                                    <span class="text-[10px] font-black uppercase tracking-widest">PAID</span>
                                </div>
                                <a href="cetak_struk.php?id=<?= $row['id_bayar']; ?>" target="_blank" class="w-10 h-10 flex items-center justify-center bg-[#121212] hover:bg-white text-gray-500 hover:text-black rounded-xl transition-all border border-white/5 shadow-lg">
                                    <i class="fa-solid fa-print text-xs"></i>
                                </a>
                            </div>
                        <?php else : ?>
                            <a href="index.php?page=tagihan&bayar_id=<?= $row['id']; ?>" 
                               onclick="return confirm('Konfirmasi pembayaran untuk ID <?= $row['id_pelanggan']; ?>?')"
                               class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-xl font-black text-[10px] transition transform hover:scale-105 uppercase tracking-widest shadow-lg shadow-yellow-400/20">
                                <i class="fa-solid fa-money-bill-wave"></i> Bayar Sekarang
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>