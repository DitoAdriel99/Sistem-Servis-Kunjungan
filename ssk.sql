-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 01:32 PM
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
-- Table structure for table `tb_keluhan`
--

CREATE TABLE `tb_keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `nama_keluhan` varchar(225) DEFAULT NULL,
  `grup` varchar(255) DEFAULT NULL,
  `harga_keluhan` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_keluhan`
--

INSERT INTO `tb_keluhan` (`id_keluhan`, `nama_keluhan`, `grup`, `harga_keluhan`) VALUES
(1, 'ac', 'A', '150000'),
(2, 'water headet', 'B', '23232323'),
(3, 'genset', 'A', '4343434'),
(4, 'Pompa air', 'B', '7000'),
(5, 'solar gard', 'C', '999999999'),
(6, 'GAS', 'B', '7000'),
(7, 'lurrr', 'C', '999999999');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(225) NOT NULL,
  `id_user` int(255) DEFAULT NULL,
  `nama_customer` varchar(225) DEFAULT NULL,
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
  `status_pekerjaan` varchar(255) DEFAULT NULL,
  `verifikasi_selesai` varchar(1) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_user`, `nama_customer`, `no_hp`, `alamat`, `keluhan`, `detail_keluhan`, `gambar`, `harga`, `teknisi`, `status`, `jam_mulai`, `jam_selesai`, `gambar_pekerjaan`, `status_pekerjaan`, `verifikasi_selesai`, `bukti_pembayaran`) VALUES
(231, 13, 'yeyen', '0000000', 'ueueueueuuee', '2', 'kok panass ya', 'CASELLA_-_ES_10D-550x55014.png', '23232323', '7', '1', '3', '03:17:54', 'wiwi17.jpg', '1', '1', 'VALORANT_Champions_allmode.png'),
(232, 2, 'customer', '2147483647', 'jl kenari', '6', 'sdsdsd', 'wiwi6.jpg', '7000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 14, 'yose', '3434343434', 'jdnfjdnfjdf', '5', 'adasasas', 'wati6.jpg', '999999999', '11', '1', '03:34:11pm', '03:34:30pm', 'wati13.jpg', '1', NULL, NULL);

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
  `level` varchar(20) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `grup` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `no_hp`, `email`, `alamat`, `password`, `level`, `status`, `grup`) VALUES
(1, 'Admin', NULL, NULL, NULL, 'admin', '1', '', NULL),
(2, 'customer', '2147483647', 'willlll@@@@', 'jl kenari', 'customer', '3', NULL, NULL),
(5, 'teknisi', NULL, NULL, NULL, 'teknisi', '2', '1', 'A'),
(7, 'wilfrifud', '2134234324', 'asasda@gmailndndndnd', 'jl solong', 'teknisi', '2', '1', 'B'),
(9, 'surya', '5968568561', 'knkfbkfbk', 'kmvkmvkf', 'surya', '3', '', NULL),
(11, 'jessy', '515151', 'kndfndfkdf', '51dsd', 'jessy', '2', '0', 'C'),
(13, 'yeyen', '0000000', 'uueueueu', 'ueueueueuuee', 'yeyen', '3', NULL, NULL),
(14, 'yose', '3434343434', 'jdnfjdnf', 'jdnfjdnfjdf', 'yose', '3', NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tb_keluhan`
--
ALTER TABLE `tb_keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
