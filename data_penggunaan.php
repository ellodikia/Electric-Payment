<?php
// Query data penggunaan
$query = mysqli_query($koneksi, "SELECT * FROM payment_penggunaan ORDER BY id DESC") or die(mysqli_error($koneksi));
?>

<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 animate-fadeIn">
    <div>
        <h2 class="text-3xl md:text-5xl font-black uppercase italic tracking-tighter text-white">
            Data <span class="text-yellow-400">Penggunaan</span>
        </h2>
        <p class="text-gray-400 mt-2 font-medium text-sm">Monitoring angka meteran pelanggan setiap periode bulan.</p>
    </div>
    <div class="flex gap-3 w-full md:w-auto">
        <a href="form_add_penggunaan.php" class="flex-grow md:flex-none flex items-center justify-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-4 rounded-2xl font-black text-xs transition transform hover:scale-105 shadow-xl shadow-yellow-400/10 uppercase tracking-widest">
            <i class="fa-solid fa-plus text-base"></i> Tambah Penggunaan
        </a>
    </div>
</div>

<div class="bg-[#1e1e1e] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl relative group">
    <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-400/5 rounded-full blur-3xl group-hover:bg-blue-400/10 transition"></div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#252525] border-b border-white/5">
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center w-16">No</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">ID Pelanggan</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Periode</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Meter Awal</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Meter Akhir</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Pemakaian</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php
                $no = 1;
                if(mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                        $pemakaian = $row['meterakhir'] - $row['meterawal'];
                ?>
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-6 text-sm font-black text-gray-600 text-center"><?= $no++; ?></td>
                    <td class="px-6 py-6">
                        <span class="bg-[#121212] px-3 py-1.5 rounded-lg border border-white/5 font-mono text-xs font-bold text-yellow-400 tracking-wider">
                            <?= $row['id_pelanggan']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <div class="text-white font-bold text-xs uppercase"><?= $row['bulan']; ?></div>
                        <div class="text-[10px] text-gray-500 font-black"><?= $row['tahun']; ?></div>
                    </td>
                    <td class="px-6 py-6 text-center text-gray-400 font-mono text-sm"><?= $row['meterawal']; ?></td>
                    <td class="px-6 py-6 text-center text-gray-400 font-mono text-sm"><?= $row['meterakhir']; ?></td>
                    <td class="px-6 py-6 text-center">
                        <span class="text-white font-black"><?= $pemakaian; ?></span>
                        <span class="text-[10px] text-gray-500 font-bold uppercase ml-1 text-xs">kWh</span>
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex items-center justify-center gap-2">
                            <a href="form_edit_penggunaan.php?Id=<?= $row['id']; ?>" class="w-10 h-10 flex items-center justify-center bg-[#121212] hover:bg-white text-gray-500 hover:text-black rounded-xl transition-all border border-white/5 shadow-lg">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                            <a href="delete_data_penggunaan.php?Id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus data ini?')" class="w-10 h-10 flex items-center justify-center bg-[#121212] hover:bg-red-500 text-gray-500 hover:text-white rounded-xl transition-all border border-white/5 shadow-lg">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='px-6 py-10 text-center text-gray-500 italic'>Belum ada data penggunaan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="bg-[#252525] px-8 py-5 border-t border-white/5">
        <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">
            Total Record Penggunaan: <span class="text-white"><?= mysqli_num_rows($query); ?> Periode</span>
        </p>
    </div>
</div>