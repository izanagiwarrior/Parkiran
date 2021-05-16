-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 09:15 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

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
(22, 'admin', 'Admin', '123', 'admin@gmail.com', '081234567890', 'Bandung', 'laki-laki', '2020-10-10', 'admin', '3YiSbYUv4yavyBYQnfHDqXTLhkIp4hh5PVLEDzMl'),
(23, 'user', 'User', '123', 'user@gmail.com', '081234567890', 'Bandung', 'laki-laki', '2020-10-10', 'pengguna', 'fTFLf9dVdhtNSaHoiDVWuSPSgMeOWLVCIxluPxag'),
(24, 'petugas', 'Petugas', '123', 'petugas@gmail.com', '081234567890', 'Bandung', 'laki-laki', '2020-10-10', 'petugas', 'aStD2eefSYkNYYJ33hZ1FJzWet7h2lzlZVZvyYrx'),
(25, 'klien', 'Client', '123', 'client@gmail.com', '081234567890', 'Bandung', 'laki-laki', '2020-10-10', 'klien', 'tgQjBrpTkmK6YBZ3wNOeHmH4mKP8XmPnN8clUoMx');

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

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `detail_parkiran` text NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parkiran`
--

INSERT INTO `parkiran` (`id`, `nama_parkiran`, `harga`, `kategori`, `gambar`, `detail_parkiran`, `lat`, `lang`) VALUES
(1, 'Parkiran PVJJ (Biasa)', 5000, 'Barat,reserved', 'foto/parkir.png', 'Parkiran Tersedia 20', '-6.887650323544048', '107.59622923272897'),
(2, 'Parkiran PVJJ (Valey)', 20000, 'Barat,reserved', 'foto/parkir.png', 'Parkiran Tersedia 5', '-6.887650323544048', '107.59622923272897'),
(3, 'Parkiran TSM (Biasa)', 10000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20', '-6.926448779085916', '107.63636823937998'),
(4, 'Parkiran TSM (Valey)', 35000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 10', '-6.926448779085916', '107.63636823937998'),
(5, 'Parkiran BIP (Biasa)', 15000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 30', '-6.908683943108505', '107.61088760320149'),
(6, 'Parkiran BIP (Valey)', 25000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20', '-6.908683943108505', '107.61088760320149'),
(7, 'Parkiran Ciwalk (Biasa)', 12000, 'Utara,reserved', 'foto/parkir.png', 'Parkiran Tersedia 45', '-6.89334511293544', '107.60455018416832'),
(8, 'Parkiran Ciwalk (Valey)', 20000, 'Utara,reserved', 'foto/parkir.png', 'Parkiran Tersedia 15', '-6.89334511293544', '107.60455018416832'),
(9, 'Parkiran Festival Citylink (Biasa)', 13000, 'Utara,bestseller', 'foto/parkir.png', 'Parkiran Tersedia 50', '-6.929772503270773', '107.58662984183897'),
(10, 'Parkiran Festival Citylink (Valey)', 33000, 'Utara,bestseller', 'foto/parkir.png', 'Parkiran Tersedia 10', '-6.929772503270773', '107.58662984183897'),
(11, 'Parkiran BTC (Biasa)', 5000, 'Selatan,reserved', 'foto/parkir.png', 'Parkiran Tersedia 25', '-6.893350910367234', '107.58544752649803'),
(12, 'Parkiran BTC (Valey)', 25000, 'Selatan,reserved', 'foto/parkir.png', 'Parkiran Tersedia 5', '-6.893350910367234', '107.58544752649803'),
(13, 'Parkiran Kings Plaza (Biasa)', 5000, 'Selatan,kosong', 'foto/parkir.png', 'Parkiran Tersedia 40', '-6.923090589179086', '107.60470233975457'),
(14, 'Parkiran Kings Plaza (Valey)', 25000, 'Selatan,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20', '-6.923090589179086', '107.60470233975457'),
(15, 'Parkiran Click Square (Biasa)', 15000, 'Selatan,kosong', 'foto/parkir.png', 'Parkiran Tersedia 100', '-6.920699152290651', '107.61630258786104'),
(16, 'Parkiran Click Square (Valey)', 25000, 'Selatan,kosong', 'foto/parkir.png', 'Parkiran Tersedia 3', '-6.920699152290651', '107.61630258786104'),
(17, 'Parkiran Braga (Biasa)', 25000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 20', '-6.916642967640514', '107.60798178129784'),
(18, 'Parkiran Braga (Valey)', 75000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 4', '-6.916642967640514', '107.60798178129784'),
(19, 'Parkiran BEC (Biasa)', 5000, 'Selatan,kosong', 'foto/parkir.png', 'Parkiran Tersedia 38', '-6.909355177805484', '107.60930669368507'),
(20, 'Parkiran BEC (Valey)', 15000, 'Selatan,kosong', 'foto/parkir.png', 'Parkiran Tersedia 5', '-6.909355177805484', '107.60930669368507'),
(21, 'Parkiran Dago (Biasa)', 13000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 100', '-6.90100574331355', '107.61173973724634'),
(22, 'Parkiran Dago (Valey)', 23000, 'Barat,kosong', 'foto/parkir.png', 'Parkiran Tersedia 7', '-6.90100574331355', '107.61173973724634'),
(23, 'Parkiran Paskal (Biasa)', 15000, 'Utara,kosong', 'foto/parkir.png', 'Parkiran Tersedia 15', '-6.914857399754043', '-6.914857399754043'),
(24, 'Parkiran Paskal (Valey)', 35000, 'Utara,kosong', 'foto/parkir.png', 'Parkiran Tersedia 10', '-6.914857399754043', '-6.914857399754043');

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
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `parkiran`
--
ALTER TABLE `parkiran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `teracc`
--
ALTER TABLE `teracc`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
