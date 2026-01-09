<?php
$query = mysqli_query($koneksi, "SELECT payment_pembayaran.*, payment_pelanggan.nama 
                                 FROM payment_pembayaran 
                                 JOIN payment_pelanggan ON payment_pembayaran.id_pelanggan = payment_pelanggan.id_pelanggan 
                                 ORDER BY payment_pembayaran.id DESC") or die(mysqli_error($koneksi));
?>

<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 animate-fadeIn">
    <div>
        <h2 class="text-3xl md:text-5xl font-black uppercase italic tracking-tighter text-white">
            Riwayat <span class="text-yellow-400">Pembayaran</span>
        </h2>
        <p class="text-gray-400 mt-2 font-medium text-sm">Daftar seluruh transaksi pelanggan yang telah lunas diproses.</p>
    </div>
    <div class="flex gap-3 w-full md:w-auto">
        <button onclick="window.print()" class="flex-grow md:flex-none flex items-center justify-center gap-2 bg-[#1e1e1e] hover:bg-[#2a2a2a] text-white border border-white/10 px-6 py-4 rounded-2xl font-black text-xs transition uppercase tracking-widest">
            <i class="fa-solid fa-print text-yellow-400"></i> Cetak Laporan
        </button>
    </div>
</div>

<div class="bg-[#1e1e1e] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl relative group">
    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-yellow-400/5 rounded-full blur-3xl group-hover:bg-yellow-400/10 transition"></div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#252525] border-b border-white/5">
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center w-16">No</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">ID Transaksi</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Data Pelanggan</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Tgl Bayar</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Bulan</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Admin & Total</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php
                $no = 1;
                if(mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-6 text-sm font-black text-gray-600 text-center"><?= $no++; ?></td>
                    <td class="px-6 py-6">
                        <span class="font-mono text-xs font-bold text-gray-400 italic">#<?= $row['id_bayar']; ?></span>
                    </td>
                    <td class="px-6 py-6">
                        <div class="text-white font-extrabold tracking-tight uppercase"><?= $row['nama']; ?></div>
                        <div class="text-[10px] text-yellow-400 font-mono"><?= $row['id_pelanggan']; ?></div>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <span class="text-gray-300 text-xs font-bold"><?= date('d/m/Y', strtotime($row['tanggal'])); ?></span>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <span class="px-3 py-1 bg-white/5 text-gray-400 text-[10px] font-black rounded-lg border border-white/5 uppercase">
                            <?= $row['bulanbayar']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-6">
                        <div class="text-[10px] text-gray-500 font-bold uppercase tracking-tighter">Adm: Rp <?= number_format($row['biayaadmin'], 0, ',', '.'); ?></div>
                        <div class="text-sm text-yellow-400 font-black italic">Rp <?= number_format($row['total'], 0, ',', '.'); ?></div>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/10 text-green-500 rounded-xl border border-green-500/20 shadow-lg shadow-green-500/5">
                            <i class="fa-solid fa-circle-check text-[10px]"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest"><?= $row['status']; ?></span>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='px-6 py-10 text-center text-gray-500 italic'>Belum ada riwayat transaksi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="bg-[#252525] px-8 py-5 border-t border-white/5 flex justify-between items-center">
        <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">
            Total Transaksi: <span class="text-white"><?= mysqli_num_rows($query); ?> Lunas</span>
        </p>
        <div class="text-[10px] font-black text-yellow-400/50 uppercase italic tracking-widest">
            Verified by System
        </div>
    </div>
</div>