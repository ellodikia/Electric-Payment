# ⚡ Electro Payment System

Electro Payment adalah aplikasi berbasis web sederhana untuk mengelola tagihan listrik pelanggan. Aplikasi ini memungkinkan admin untuk mengelola data tarif, data pelanggan, pencatatan penggunaan meteran, hingga proses pembayaran dan cetak struk.

## 🚀 Fitur Utama

* **Autentikasi:** Sistem login untuk Admin.
* **Manajemen Tarif:** Tambah, edit, dan hapus data golongan daya listrik.
* **Manajemen Pelanggan:** Pengelolaan data identitas pelanggan dan nomor meter.
* **Pencatatan Penggunaan:** Input meter awal dan meter akhir bulanan.
* **Sistem Tagihan:** Otomatisasi status tagihan (Lunas/Belum Lunas).
* **Riwayat & Cetak Struk:** Mencatat riwayat pembayaran dan mencetak bukti bayar dalam format PDF (menggunakan FPDF).

## 🛠️ Teknologi yang Digunakan

* **Bahasa Pemrograman:** PHP 8.x
* **Database:** MySQL / MariaDB
* **Frontend Framework:** Bootstrap 5
* **Icon:** FontAwesome 6
* **Library PDF:** FPDF

## 📦 Instalasi

1.  **Clone atau Download:**
    Ekstrak file proyek ke dalam direktori server lokal Anda (contoh: `C:/xampp/htdocs/electro-payment`).

2.  **Persiapan Database:**
    * Buka **phpMyAdmin**.
    * Buat database baru dengan nama `listrik`.
    * Import file `listrik.sql` yang tersedia di folder proyek ke dalam database tersebut.

3.  **Konfigurasi Koneksi:**
    Buka file `koneksi.php` dan sesuaikan kredensial database Anda jika berbeda:
    ```php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "listrik";
    ```

4.  **Jalankan Aplikasi:**
    Buka browser dan akses `http://localhost/electro-payment/beranda.php`.

## 🔑 Akun Login (Default)

## 📂 Struktur Folder

* `css/` & `js/` - File aset Bootstrap.
* `image/` - Logo dan gambar pendukung.
* `fpdf.php` - Library untuk pembuatan dokumen PDF.
* `data_...` - Halaman tampilan data (Read).
* `form_add_...` & `form_edit_...` - Halaman formulir (Create & Update).
* `insert_...`, `update_...`, `delete_...` - Logika pemrosesan database.

## 📜 Lisensi

Proyek ini dilisensikan di bawah [MIT License](license.txt).
