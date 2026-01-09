-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2026 pada 01.49
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_electric_payment`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_login`
--

CREATE TABLE `payment_login` (
  `id` int(15) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(90) NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_login`
--

INSERT INTO `payment_login` (`id`, `user`, `pass`, `level`) VALUES
(1, 'elladmin', '12345', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_pelanggan`
--

CREATE TABLE `payment_pelanggan` (
  `id` int(10) NOT NULL,
  `id_pelanggan` varchar(100) DEFAULT NULL,
  `nometer` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kodetarif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_pelanggan`
--

INSERT INTO `payment_pelanggan` (`id`, `id_pelanggan`, `nometer`, `nama`, `alamat`, `kodetarif`) VALUES
(3, '14314', '312', 'Gabriel', 'Jl. Perjuangan', 'R-1/900 VA'),
(4, '14310', '123341', 'Budi', 'Jl. Karya Tani', 'R-1/450 VA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_pembayaran`
--

CREATE TABLE `payment_pembayaran` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `id_bayar` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `bulanbayar` varchar(50) NOT NULL,
  `biayaadmin` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_penggunaan`
--

CREATE TABLE `payment_penggunaan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `meterawal` int(11) NOT NULL,
  `meterakhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_penggunaan`
--

INSERT INTO `payment_penggunaan` (`id`, `id_pelanggan`, `bulan`, `tahun`, `meterawal`, `meterakhir`) VALUES
(4, '14314', 'November', '2018', 200, 450),
(5, '14310', 'September', '2025', 100, 200),
(6, '14310', 'Mei', '2026', 290, 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_tagihan`
--

CREATE TABLE `payment_tagihan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(100) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `jumlahmeter` int(11) NOT NULL,
  `jumlahtagihan` varchar(50) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_tagihan`
--

INSERT INTO `payment_tagihan` (`id`, `id_pelanggan`, `bulan`, `tahun`, `jumlahmeter`, `jumlahtagihan`, `status`) VALUES
(1, '14314', 'November', '2018', 250, '126500', 0),
(2, '14310', 'September', '2025', 100, '41500', 0),
(3, '14310', 'Mei', '2026', 210, '87150', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_tarif`
--

CREATE TABLE `payment_tarif` (
  `id` int(11) NOT NULL,
  `kodetarif` varchar(50) DEFAULT NULL,
  `daya` varchar(50) NOT NULL,
  `tarifperkwh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_tarif`
--

INSERT INTO `payment_tarif` (`id`, `kodetarif`, `daya`, `tarifperkwh`) VALUES
(1, 'R-1/450 VA', 'Subsidi/451 VA', '415'),
(2, 'R-1/900 VA', 'Subsidi/901 VA', '506');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `payment_login`
--
ALTER TABLE `payment_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_pelanggan`
--
ALTER TABLE `payment_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `kodetarif` (`kodetarif`);

--
-- Indeks untuk tabel `payment_pembayaran`
--
ALTER TABLE `payment_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `payment_penggunaan`
--
ALTER TABLE `payment_penggunaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `payment_tagihan`
--
ALTER TABLE `payment_tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `payment_tarif`
--
ALTER TABLE `payment_tarif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kodetarif` (`kodetarif`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `payment_login`
--
ALTER TABLE `payment_login`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `payment_pelanggan`
--
ALTER TABLE `payment_pelanggan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `payment_pembayaran`
--
ALTER TABLE `payment_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payment_penggunaan`
--
ALTER TABLE `payment_penggunaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `payment_tagihan`
--
ALTER TABLE `payment_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `payment_tarif`
--
ALTER TABLE `payment_tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payment_pelanggan`
--
ALTER TABLE `payment_pelanggan`
  ADD CONSTRAINT `payment_pelanggan_ibfk_1` FOREIGN KEY (`kodetarif`) REFERENCES `payment_tarif` (`kodetarif`);

--
-- Ketidakleluasaan untuk tabel `payment_pembayaran`
--
ALTER TABLE `payment_pembayaran`
  ADD CONSTRAINT `payment_pembayaran_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `payment_pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `payment_penggunaan`
--
ALTER TABLE `payment_penggunaan`
  ADD CONSTRAINT `payment_penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `payment_pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `payment_tagihan`
--
ALTER TABLE `payment_tagihan`
  ADD CONSTRAINT `payment_tagihan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `payment_pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
