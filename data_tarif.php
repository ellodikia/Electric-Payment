<?php
$query = mysqli_query($koneksi, "SELECT * FROM payment_tarif ORDER BY id DESC") or die(mysqli_error($koneksi));
?>

<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 animate-fadeIn">
    <div>
        <h2 class="text-3xl md:text-5xl font-black uppercase italic tracking-tighter text-white">
            Pricing <span class="text-yellow-400">& Tarif</span>
        </h2>
        <p class="text-gray-400 mt-2 font-medium text-sm">Konfigurasi golongan daya dan biaya per kWh sistem.</p>
    </div>
    <div class="flex gap-3 w-full md:w-auto">
        <a href="form_add_tarif.php" class="flex-grow md:flex-none flex items-center justify-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-4 rounded-2xl font-black text-xs transition transform hover:scale-105 shadow-xl shadow-yellow-400/20 uppercase tracking-widest">
            <i class="fa-solid fa-plus text-base"></i> Tambah Tarif
        </a>
    </div>
</div>

<div class="bg-[#1e1e1e] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl relative group">
    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-yellow-400/5 rounded-full blur-3xl group-hover:bg-yellow-400/10 transition"></div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#252525] border-b border-white/5">
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center w-16">No</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Kode Golongan</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Daya Listrik</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em]">Biaya / kWh</th>
                    <th class="px-6 py-6 text-[10px] font-black text-yellow-400 uppercase tracking-[0.2em] text-center">Aksi</th>
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
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-yellow-400/10 flex items-center justify-center text-yellow-400">
                                <i class="fa-solid fa-bolt-lightning text-xs"></i>
                            </div>
                            <span class="text-white font-black tracking-widest italic uppercase"><?= $row['kodetarif']; ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <span class="text-gray-300 font-bold"><?= $row['daya']; ?></span>
                        <span class="text-[10px] text-gray-500 font-black uppercase ml-1">VA</span>
                    </td>
                    <td class="px-6 py-6">
                        <div class="text-[10px] text-gray-500 font-bold uppercase tracking-tighter">Rate:</div>
                        <div class="text-sm text-white font-black italic">Rp <?= number_format($row['tarifperkwh'], 0, ',', '.'); ?></div>
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex items-center justify-center gap-2">
                            <a href="form_edit_tarif.php?Id=<?= $row['id']; ?>" class="w-10 h-10 flex items-center justify-center bg-[#121212] hover:bg-white text-gray-500 hover:text-black rounded-xl transition-all border border-white/5 shadow-lg group/btn">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                            <a href="delete_data_tarif.php?Id=<?= $row['id']; ?>" onclick="return confirm('Hapus tarif ini? Tindakan ini dapat mempengaruhi data tagihan.')" class="w-10 h-10 flex items-center justify-center bg-[#121212] hover:bg-red-500 text-gray-500 hover:text-white rounded-xl transition-all border border-white/5 shadow-lg">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='px-6 py-10 text-center text-gray-500 italic'>Belum ada data tarif yang dikonfigurasi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="bg-[#252525] px-8 py-5 border-t border-white/5 flex justify-between items-center">
        <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">
            Total Golongan: <span class="text-white"><?= mysqli_num_rows($query); ?> Kategori</span>
        </p>
        <div class="text-[9px] text-gray-600 font-bold italic tracking-tighter">
            *Pastikan tarif sesuai dengan kebijakan PLN terbaru.
        </div>
    </div>
</div>