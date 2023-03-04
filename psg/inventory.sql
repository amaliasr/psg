-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 07:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nickname`, `email`, `nohp`, `jabatan`) VALUES
(1, 'vall', '123', 'Valleria Chen', 'valleria@gmail.com', '081290908787', 'Admin'),
(3, 'jody', '123', 'jodyy', 'jody@gmail.com', '08977777888', 'Direktur'),
(4, 'leleave', '123', 'mawar j', 'jody@gmail.com', '1111112', 'Direktur');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `idx`, `tgl`, `nsj`, `jumlah`, `penerima`, `keterangan`, `pic`) VALUES
(1, 1, '2022-12-03', 'PO/14112022/RM', 50, 'Valencia', '-', 'Valleria Chen'),
(3, 1, '2022-12-03', 'PO/14112022/RM', 150, 'Valencia', '', 'Valleria Chen');

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
  `pic` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `idx`, `tgl`, `npo`, `jumlah`, `keterangan`, `pic`) VALUES
(1, 1, '2022-12-02', 'PO/2022/001', 100, 'PT. Akrilik Indonesia Satu', 'Valleria Chen'),
(3, 4, '2022-12-03', 'PO/2022/002', 1000000, 'PT. Akrilik Indonesia Satu', 'Valleria Chen');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`idx`, `nama`, `jenis`, `stock`, `harga`, `pic`) VALUES
(1, 'Akriliks 10m x 10m', 'RM', 0, 500000, 'Valleria Chen'),
(4, 'akrilik 5cm x 5cm', 'FG', 1000150, 50000, 'Valleria Chen'),
(3, 'akrilik piala', 'RM', 100, 1000000, 'Valleria Chen');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `namasupplier`, `namaperusahaan`, `alamat`, `email`, `nohp`) VALUES
(1, 'Valentino', 'PT. Akrilik Indonesia Satu', 'Jakarta Barat', 'as@gmail.com', '0812090911'),
(2, 'Sandy', 'PT.ABC', 'tangerang', 'abc@gmail.com', '0877777777');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `idx` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
