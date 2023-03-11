-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2023 at 06:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nickname`, `email`, `nohp`, `jabatan`) VALUES
(1, 'vall', '202cb962ac59075b964b07152d234b70', 'Valleria', 'valleria@gmail.com', '081080801919', 'Admin'),
(2, 'angel', 'ab1dbd386662b62477b62087a389256a', 'Angel', 'amaliayuya@gmail.com', '081944946015', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(12) NOT NULL,
  `idx` int(12) NOT NULL,
  `tgl` date NOT NULL,
  `nsj` varchar(50) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(12) NOT NULL,
  `idx` int(12) NOT NULL,
  `tgl` date NOT NULL,
  `npo` varchar(50) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nohp` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_stock_opname`
--

CREATE TABLE `detail_stock_opname` (
  `id` int(11) NOT NULL,
  `id_so` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_stok_so` int(11) NOT NULL,
  `jumlah_stok_sistem` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_stock_opname`
--

INSERT INTO `detail_stock_opname` (`id`, `id_so`, `id_barang`, `jumlah_stok_so`, `jumlah_stok_sistem`, `status`) VALUES
(1, 3, 1, 1000, 1000, 'reject'),
(2, 3, 2, 111, 122, 'reject'),
(3, 4, 1, 100, 1000, 'pending'),
(4, 4, 2, 11, 122, 'pending'),
(5, 5, 1, 1000, 1000, 'accept'),
(6, 5, 2, 111, 122, 'accept'),
(7, 6, 1, 1000, 1000, 'pending'),
(8, 6, 2, 111, 111, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `notes` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_opname`
--

INSERT INTO `stock_opname` (`id`, `tanggal`, `notes`, `status`) VALUES
(3, '2023-03-04 00:00:00', 'test opname tanggal 5 Maret 2023', 'reject'),
(5, '2023-03-05 00:00:00', 'coba SO tanggal 5', 'accept'),
(6, '2023-03-06 00:00:00', 'SO TGL 6 MARET 2023', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `idx` int(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `stock` int(12) NOT NULL,
  `harga` int(20) NOT NULL,
  `pic` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`idx`, `nama`, `jenis`, `stock`, `harga`, `pic`) VALUES
(1, 'Serat Fiber', 'RM', 1000, 1200, 'Valleria'),
(2, 'Tepung Terigu', 'RM', 111, 200, 'Valleria');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(12) NOT NULL,
  `namasupplier` varchar(50) NOT NULL,
  `namaperusahaan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_stock_opname`
--
ALTER TABLE `detail_stock_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_stock_opname`
--
ALTER TABLE `detail_stock_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `idx` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
