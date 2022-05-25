-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 03:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssk`
--

-- --------------------------------------------------------

--
-- Table structure for table `harga_tambahan`
--

CREATE TABLE `harga_tambahan` (
  `id_tambahan` int(225) NOT NULL,
  `id_pesanan` int(225) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_barang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_tambahan`
--

INSERT INTO `harga_tambahan` (`id_tambahan`, `id_pesanan`, `nama_barang`, `harga_barang`) VALUES
(1, 256, 'bor', '20,000.00'),
(2, 256, 'biji', '1,515,151.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluhan`
--

CREATE TABLE `tb_keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `nama_keluhan` varchar(225) DEFAULT NULL,
  `grup` varchar(255) DEFAULT NULL,
  `harga_keluhan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_keluhan`
--

INSERT INTO `tb_keluhan` (`id_keluhan`, `nama_keluhan`, `grup`, `harga_keluhan`) VALUES
(36, 'AC', 'A', '50,000.00'),
(37, 'Water Heater', 'B', '75,000.00'),
(38, 'Genset', 'C', '80,000.00'),
(39, 'Kulkas', 'C', '900,000.00'),
(40, 'Pompa air', 'A', '780,000.00'),
(41, 'Bor', 'B', '60,000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(225) NOT NULL,
  `id_user` int(255) DEFAULT NULL,
  `tanggal_pesanan` varchar(255) DEFAULT NULL,
  `tanggal_perbaikan` varchar(255) DEFAULT NULL,
  `nama_customer` varchar(225) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `keluhan` varchar(255) DEFAULT NULL,
  `detail_keluhan` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `teknisi` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `jam_mulai` varchar(255) DEFAULT NULL,
  `jam_selesai` varchar(225) DEFAULT NULL,
  `gambar_pekerjaan` varchar(255) DEFAULT NULL,
  `barang_tambahan1` varchar(225) DEFAULT NULL,
  `harga_tambahan1` varchar(225) DEFAULT NULL,
  `barang_tambahan2` varchar(255) DEFAULT NULL,
  `harga_tambahan2` varchar(255) DEFAULT NULL,
  `barang_tambahan3` varchar(255) DEFAULT NULL,
  `harga_tambahan3` varchar(225) DEFAULT NULL,
  `status_pekerjaan` varchar(255) DEFAULT NULL,
  `verifikasi_selesai` varchar(1) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `verifikasi_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_user`, `tanggal_pesanan`, `tanggal_perbaikan`, `nama_customer`, `email`, `no_hp`, `alamat`, `keluhan`, `detail_keluhan`, `gambar`, `harga`, `teknisi`, `status`, `jam_mulai`, `jam_selesai`, `gambar_pekerjaan`, `barang_tambahan1`, `harga_tambahan1`, `barang_tambahan2`, `harga_tambahan2`, `barang_tambahan3`, `harga_tambahan3`, `status_pekerjaan`, `verifikasi_selesai`, `bukti_pembayaran`, `verifikasi_pembayaran`) VALUES
(256, 46, 'Selasa, 24 Mei 2022 ', 'Selasa, 24 Mei 2022 ', 'Yeyen', 'ditoadriel@gmail.com', '904587645', 'jl kledokan', '40', 'gak nge pompa', 'activity_drawio20.png', '780,000.00', '42', '1', '09:22:53pm', '09:23:07pm', 'DFD-level_2_drawio.png', 'biji', '20,000.00', NULL, '0.00', NULL, '0.00', '1', '1', 'activity_drawio29.png', '1'),
(257, 46, 'Rabu, 25 Mei 2022 ', 'Rabu, 25 Mei 2022 ', 'Yeyen', 'ditoadriel@gmail.com', '904587645', 'Jl kledokan', '38', 'Gak nyaala', 'activity_drawio30.png', '80,000.00', '47', '1', '07:48:33pm', '07:51:41pm', NULL, 'Sniper ', '20,000.00', 'Kukang', '6,565,656.00', '', '0.00', '1', '1', 'activity_drawio31.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `username` varchar(225) DEFAULT NULL,
  `no_hp` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `grup` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `no_hp`, `email`, `alamat`, `password`, `foto`, `level`, `status`, `grup`) VALUES
(1, 'Admin', NULL, NULL, NULL, 'admin', NULL, '1', '', NULL),
(41, 'Dito', '546456', 'budi@gmail.com', 'Jl.kenarixfdf', 'dito', NULL, '3', NULL, NULL),
(42, 'Jumadi', '394578349', NULL, NULL, 'jumadi', '2242080_1dc33eb5-05be-4692-9ae0-e7461fa8ae69.jpg', '2', '1', 'A'),
(43, 'wili', '083476346', NULL, NULL, 'wili', '2242080_1dc33eb5-05be-4692-9ae0-e7461fa8ae691.jpg', '2', '1', 'B'),
(44, 'customer', '082358835557', 'benedicto.adriel@si.ukdw.ac.id', 'Jl.kebumen', 'dito', NULL, '3', NULL, NULL),
(45, 'Yose', '09453879043', 'sdhgsdh@gfmai.com', 'jl.kekekekeba', 'yose', NULL, '3', NULL, NULL),
(46, 'Yeyen', '904587645', 'ditoadriel@gmail.com', NULL, 'yeyen', NULL, '3', '1', NULL),
(47, 'Ari', '078945867', NULL, NULL, 'ari', 'person.jpg', '2', '0', 'C'),
(48, 'Desta', '0222555', NULL, NULL, 'desta', 'person1.jpg', '2', '1', 'B'),
(49, 'Saputra', '082358835557', NULL, NULL, 'saputra', 'activity_drawio.png', '2', '1', 'A'),
(50, 'Dodit', '87978979', 'ditoadriel@gmail.com', NULL, 'dodit', NULL, '3', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harga_tambahan`
--
ALTER TABLE `harga_tambahan`
  ADD PRIMARY KEY (`id_tambahan`);

--
-- Indexes for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harga_tambahan`
--
ALTER TABLE `harga_tambahan`
  MODIFY `id_tambahan` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
