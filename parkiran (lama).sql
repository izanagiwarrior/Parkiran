-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 08:17 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkiran`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `role` varchar(255) NOT NULL,
  `csrf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `nama_lengkap`, `password`, `email`, `nohp`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `role`, `csrf`) VALUES
(22, 'admin', 'Ini Admin', '123', 'lynxzlexia39@gmail.com', '69691', 'awww2@', 'laki-laki', '2020-10-10', 'admin', 'QVuGYoiZd0QxonRVpTMSCRQgxQJaqoPLMA3RJHdg'),
(23, 'user', 'Ini User', '123', 'awdawd@awdawd.awd', '123407654343', 'awdawd', 'laki-laki', '2020-10-10', 'pengguna', 'eetevhDQhV3YsPPRxjBEdTIU0FFkq3oHhFFgxG7p'),
(24, 'mhdfarelan', 'Farell', 'Lintang123', 'lintangaryasatya24@gmail.com', '081268597024', 'Jl Swakarya Perum RIL blok k  no 4', 'laki-laki', '2020-10-10', 'petugas', 'aStD2eefSYkNYYJ33hZ1FJzWet7h2lzlZVZvyYrx'),
(25, 'diananggraini6376', 'Kost AA', 'Lintang123', 'dsadsa@gg', '123', 'asdsa', 'laki-laki', '2020-10-10', 'klien', ''),
(26, 'chandrikaw4', 'chandrikaw4', 'Lintang123', 'dasdsa@qw', '321', 'Jl Swakarya Perum RIL blok k  no 4dd', 'laki-laki', '2020-10-10', 'klien', ''),
(27, 'admin', 'admin', 'Lintang123', 'asdasxz@ee', '4444', 'aaaa', 'laki-laki', '2020-10-10', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id` int(255) NOT NULL,
  `metode` varchar(255) NOT NULL DEFAULT '',
  `gambar` varchar(255) NOT NULL DEFAULT '',
  `id_akun` int(255) NOT NULL DEFAULT 0,
  `id_produk` int(255) NOT NULL DEFAULT 0,
  `total_pembayaran` int(255) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'belum_diterima'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti_pembayaran`
--

INSERT INTO `bukti_pembayaran` (`id`, `metode`, `gambar`, `id_akun`, `id_produk`, `total_pembayaran`, `status`) VALUES
(14, 'bank_mandiri', '/foto/WhatsApp Image 2021-04-17 at 20.19.13.jpeg', 24, 5, 0, 'diterima'),
(15, 'bank_mandiri', '/foto/WhatsApp Image 2021-04-17 at 20.19.13.jpeg', 22, 5, 0, 'diterima'),
(16, 'bank_mandiri', '/foto/WhatsApp Image 2021-04-17 at 20.19.13.jpeg', 22, 8, 0, 'diterima'),
(17, 'bank_mandiri', '/foto/WhatsApp Image 2021-04-17 at 20.19.13.jpeg', 22, 2, 0, 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(255) NOT NULL,
  `id_produk` int(255) NOT NULL,
  `id_pembeli` int(255) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkiran`
--

CREATE TABLE `parkiran` (
  `id` int(255) NOT NULL,
  `nama_parkiran` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `detail_parkiran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parkiran`
--

INSERT INTO `parkiran` (`id`, `nama_parkiran`, `harga`, `kategori`, `gambar`, `detail_parkiran`) VALUES
(1, 'Parkiran PVJJ', 30000, 'Barat,reserved', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(2, 'Parkiran TSM', 100000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(5, 'Parkiran BIP', 100000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(6, 'Parkiran Braga', 75000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(7, 'Parkiran Ciwalk', 35000, 'Utara,reserved', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(8, 'Parkiran Paskal', 25000, 'Utara,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(9, 'Parkiran Festival Citylink', 33000, 'Utara,bestseller', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(10, 'Parkiran Istana Plaza', 40000, 'Utara,bestseller', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(12, 'Parkiran BTC', 45000, 'Selatan,reserved', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(13, 'Parkiran Kings Plaza', 25000, 'Selatan,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(14, 'Parkiran BEC', 25000, 'Selatan', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(15, 'Parkiran Click Square', 45000, 'Selatan', 'foto/parkir.png', 'Parkiran Tersedia 20'),
(16, 'Parkiran Dago', 33000, 'Barat', 'foto/parkir.png', 'Parkiran Tersedia 20');

-- --------------------------------------------------------

--
-- Table structure for table `teracc`
--

CREATE TABLE `teracc` (
  `id` int(255) NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT '',
  `id_akun` int(255) NOT NULL DEFAULT 0,
  `id_produk` int(255) NOT NULL DEFAULT 0,
  `total_pembayaran` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teracc`
--

INSERT INTO `teracc` (`id`, `gambar`, `id_akun`, `id_produk`, `total_pembayaran`) VALUES
(13, '', 24, 5, 0),
(14, '', 24, 5, 0),
(15, '', 24, 5, 0),
(16, '', 24, 5, 0),
(17, '', 24, 5, 0),
(18, '', 22, 5, 0),
(19, '', 22, 8, 0),
(20, '', 22, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parkiran`
--
ALTER TABLE `parkiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teracc`
--
ALTER TABLE `teracc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `parkiran`
--
ALTER TABLE `parkiran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `teracc`
--
ALTER TABLE `teracc`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
