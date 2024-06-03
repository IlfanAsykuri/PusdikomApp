-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 03:04 PM
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
-- Database: `db_pusdikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `email`, `password`, `foto`) VALUES
('6645cca2ab2af', 'Sayang....!!', 'sayang@gmail.com', '$2y$10$J/RD2D3d2oCTKzDw5wiQj.MB2m3hjHtaA/2zq/a2bBDwm5vRk.Aza', '6645cca2a8961.jpg'),
('6645cf4f2c2dc', 'Adsf', 'asdf@gmail.com', '$2y$10$NxCPlN1neutnEyd9BJIBreOLtiAcd74VcdFeqZATYFtiIJnZe3RQe', '6645cf4f2c113.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_devisi`
--

CREATE TABLE `tb_devisi` (
  `kode_devisi` varchar(15) NOT NULL,
  `devisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_devisi`
--

INSERT INTO `tb_devisi` (`kode_devisi`, `devisi`) VALUES
('D001', 'Excellent Language'),
('D002', 'Tahsinul Qur\'an'),
('D003', 'Tahfidzuul Qur\'an'),
('D004', 'Amtsilati');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `kode_kamar` varchar(15) NOT NULL,
  `kamar` varchar(50) NOT NULL,
  `kode_devisi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kamar`
--

INSERT INTO `tb_kamar` (`kode_kamar`, `kamar`, `kode_devisi`) VALUES
('K001', 'Cambridge', 'D001'),
('K002', 'Al - Madaniyah', 'D001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `kode_peminjaman` int(11) NOT NULL,
  `niup` varchar(15) NOT NULL,
  `waktu_pinjam` timestamp NULL DEFAULT NULL,
  `waktu_kembali` timestamp NULL DEFAULT NULL,
  `status_peminjaman` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`kode_peminjaman`, `niup`, `waktu_pinjam`, `waktu_kembali`, `status_peminjaman`) VALUES
(1, '11620004802', '2024-05-16 02:31:47', '2024-05-16 07:32:09', 0),
(2, '12020611680', '2024-05-16 02:32:18', '2024-05-17 12:58:09', 0),
(3, '11920309094', '2024-05-16 02:32:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_santri`
--

CREATE TABLE `tb_santri` (
  `niup` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` char(2) NOT NULL,
  `mac_address` varchar(15) NOT NULL,
  `merk_laptop` varchar(15) NOT NULL,
  `tipe_laptop` varchar(15) NOT NULL,
  `no_lemari` int(3) NOT NULL,
  `status_ketersediaan` int(2) NOT NULL,
  `kode_kamar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_santri`
--

INSERT INTO `tb_santri` (`niup`, `nama`, `jk`, `mac_address`, `merk_laptop`, `tipe_laptop`, `no_lemari`, `status_ketersediaan`, `kode_kamar`) VALUES
('11620004802', 'Fatimatus Zahro, S.Kom', 'p', 'E1:3B:E9:AC:7C:', 'LENOVO', 'LEGION', 3, 1, 'K001'),
('11920208731', 'Najwa Aurelia Safina Ramadani', 'p', 'E0:2B:E9:DC:7E:', 'Mac Book', 'Mac', 4, 1, 'K001'),
('11920309094', 'Muhammad Ilfan Asykuri', 'l', 'E0:2B:E9:DC:7E:', 'ASUS', 'ROG', 1, 0, 'K001'),
('12020611680', 'Reti Kartika Silfani Putri', 'p', 'E0:2B:E9:AC:7C:', 'ASUS', 'TUF GAMING', 2, 1, 'K001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_devisi`
--
ALTER TABLE `tb_devisi`
  ADD PRIMARY KEY (`kode_devisi`);

--
-- Indexes for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`kode_kamar`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`kode_peminjaman`);

--
-- Indexes for table `tb_santri`
--
ALTER TABLE `tb_santri`
  ADD PRIMARY KEY (`niup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `kode_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
