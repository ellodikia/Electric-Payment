-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2026 at 05:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listrik`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_login`
--

CREATE TABLE `payment_login` (
  `id` int(15) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(90) NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_login`
--

INSERT INTO `payment_login` (`id`, `user`, `pass`, `level`) VALUES
(1, 'elladmin', '12345', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_pelanggan`
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
-- Dumping data for table `payment_pelanggan`
--

INSERT INTO `payment_pelanggan` (`id`, `id_pelanggan`, `nometer`, `nama`, `alamat`, `kodetarif`) VALUES
(45, '900990', '890890', 'Gabriell', 'Jl. Karya Jasa', 'R1/900');

-- --------------------------------------------------------

--
-- Table structure for table `payment_pembayaran`
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

--
-- Dumping data for table `payment_pembayaran`
--

INSERT INTO `payment_pembayaran` (`id`, `id_pelanggan`, `id_bayar`, `tanggal`, `bulanbayar`, `biayaadmin`, `total`, `status`) VALUES
(1, '900990', 'PAY-1768060751', '2026-01-10', 'Januari', 2500, '270000', 'Lunas'),
(2, '900990', 'PAY-1768142274', '2026-01-11', 'Februari', 2500, '10935000', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `payment_penggunaan`
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
-- Dumping data for table `payment_penggunaan`
--

INSERT INTO `payment_penggunaan` (`id`, `id_pelanggan`, `bulan`, `tahun`, `meterawal`, `meterakhir`) VALUES
(22, '900990', 'Januari', '2026', 100, 300),
(23, '900990', 'Februari', '2026', 900, 9000);

-- --------------------------------------------------------

--
-- Table structure for table `payment_tagihan`
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
-- Dumping data for table `payment_tagihan`
--

INSERT INTO `payment_tagihan` (`id`, `id_pelanggan`, `bulan`, `tahun`, `jumlahmeter`, `jumlahtagihan`, `status`) VALUES
(22, '900990', 'Januari', '2026', 200, '270000', 1),
(23, '900990', 'Februari', '2026', 8100, '10935000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_tarif`
--

CREATE TABLE `payment_tarif` (
  `id` int(11) NOT NULL,
  `kodetarif` varchar(50) DEFAULT NULL,
  `daya` varchar(50) NOT NULL,
  `tarifperkwh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_tarif`
--

INSERT INTO `payment_tarif` (`id`, `kodetarif`, `daya`, `tarifperkwh`) VALUES
(5, 'R1/900', '900', '1350');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_login`
--
ALTER TABLE `payment_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_pelanggan`
--
ALTER TABLE `payment_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `kodetarif` (`kodetarif`);

--
-- Indexes for table `payment_pembayaran`
--
ALTER TABLE `payment_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `payment_penggunaan`
--
ALTER TABLE `payment_penggunaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `payment_tagihan`
--
ALTER TABLE `payment_tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `payment_tarif`
--
ALTER TABLE `payment_tarif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kodetarif` (`kodetarif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_login`
--
ALTER TABLE `payment_login`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_pelanggan`
--
ALTER TABLE `payment_pelanggan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `payment_pembayaran`
--
ALTER TABLE `payment_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_penggunaan`
--
ALTER TABLE `payment_penggunaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment_tagihan`
--
ALTER TABLE `payment_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment_tarif`
--
ALTER TABLE `payment_tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_pelanggan`
--
ALTER TABLE `payment_pelanggan`
  ADD CONSTRAINT `payment_pelanggan_ibfk_1` FOREIGN KEY (`kodetarif`) REFERENCES `payment_tarif` (`kodetarif`);

--
-- Constraints for table `payment_pembayaran`
--
ALTER TABLE `payment_pembayaran`
  ADD CONSTRAINT `payment_pembayaran_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `payment_pelanggan` (`id_pelanggan`);

--
-- Constraints for table `payment_penggunaan`
--
ALTER TABLE `payment_penggunaan`
  ADD CONSTRAINT `payment_penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `payment_pelanggan` (`id_pelanggan`);

--
-- Constraints for table `payment_tagihan`
--
ALTER TABLE `payment_tagihan`
  ADD CONSTRAINT `payment_tagihan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `payment_pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
