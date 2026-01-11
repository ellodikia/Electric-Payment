<?php
include "koneksi.php";

$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

if ($id != "") {
    $query = mysqli_query($koneksi, "SELECT t.*, p.nama FROM payment_tagihan t 
                                    JOIN payment_pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                                    WHERE t.id_pelanggan = '$id' AND t.status = '0' LIMIT 1");
    
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        echo '
        <div class="bg-zinc-800/50 border border-zinc-700 p-6 rounded-2xl shadow-xl">
            <h3 class="text-yellow-brand text-xs font-bold uppercase mb-4 tracking-widest">Tagihan Ditemukan</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-zinc-400 text-sm">Nama</span>
                    <span class="text-white font-bold text-sm">'.$data['nama'].'</span>
                </div>
                <div class="flex justify-between border-t border-zinc-800 pt-3 mt-3">
                    <span class="text-zinc-400 text-sm">Total Bayar</span>
                    <span class="text-yellow-brand font-black text-xl">Rp '.number_format($data['jumlahtagihan'], 0, ',', '.').'</span>
                </div>
            </div>
            <a href="data_pembayaran.php?id_pelanggan='.$id.'" class="block w-full text-center bg-yellow-brand text-zinc-950 font-bold py-3 rounded-xl mt-6">
                PROSES PEMBAYARAN
            </a>
        </div>';
    } else {
        echo '
        <div class="bg-red-500/10 border border-red-500/20 p-4 rounded-xl text-center">
            <p class="text-red-400 text-sm">ID Pelanggan tidak ditemukan atau tagihan sudah lunas.</p>
        </div>';
    }
}
?>