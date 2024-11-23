-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 08:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppks_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `nama_pelapor` varchar(255) NOT NULL,
  `jenis_identitas` enum('KTP','KTM') NOT NULL,
  `nomor_identitas` varchar(50) NOT NULL,
  `unit_kerja` varchar(255) DEFAULT NULL,
  `kategori` enum('Korban','Pelapor/Saksi') NOT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status_pelapor` enum('Mahasiswa','Dosen','Tenaga Kependidikan','Masyarakat Umum') NOT NULL,
  `nama_terlapor` varchar(255) DEFAULT NULL,
  `nomor_telepon_terlapor` varchar(20) DEFAULT NULL,
  `status_terlapor` enum('Mahasiswa','Dosen','Tenaga Kependidikan','Masyarakat Umum') NOT NULL,
  `tanggal_peristiwa` date DEFAULT NULL,
  `lokasi_peristiwa` varchar(255) DEFAULT NULL,
  `kronologi_peristiwa` text DEFAULT NULL,
  `status` enum('Belum Dikerjakan','Sedang Dikerjakan','Selesai') DEFAULT 'Belum Dikerjakan',
  `kode_laporan` varchar(20) DEFAULT NULL,
  `tanggal_laporan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `nama_pelapor`, `jenis_identitas`, `nomor_identitas`, `unit_kerja`, `kategori`, `alamat`, `nomor_telepon`, `email`, `status_pelapor`, `nama_terlapor`, `nomor_telepon_terlapor`, `status_terlapor`, `tanggal_peristiwa`, `lokasi_peristiwa`, `kronologi_peristiwa`, `status`, `kode_laporan`, `tanggal_laporan`) VALUES
(1, 'kazuma', '', '111111', 'ui', '', 'bekasi', '081391795829', '123@gmail.com', 'Mahasiswa', 'jinn kazama', '98912313', 'Mahasiswa', '2009-10-08', 'Poris', 'kazuya berubah menjadi jinn kazama', 'Sedang Dikerjakan', 'LAP-673F36A0ECC963.2', '2024-11-21 13:33:20'),
(2, 'kazuma', '', '111111', 'ui', '', 'poris', '081391795829', '123@gmail.com', 'Mahasiswa', 'jinn kazama', '98912313', 'Mahasiswa', '2005-10-19', 'Poris', 'kazuya berubah menjadi jinn kazama', 'Selesai', 'LAP-673F38417C2586.1', '2024-11-21 13:40:17'),
(3, 'blater', '', '111111', 'ui', '', 'poris', '081391795829', '123@gmail.com', 'Mahasiswa', 'jinn kazama', '98912313', 'Mahasiswa', '2009-09-23', 'Poris', 'blater meledak', 'Sedang Dikerjakan', 'LAP-67404D63C35F91.9', '2024-09-22 09:22:43'),
(4, 'blater', '', '111111', 'ui', '', 'poris', '081391795829', '123@gmail.com', 'Mahasiswa', 'jinn kazama', '98912313', 'Mahasiswa', '2009-09-23', 'Poris', 'blater meledak', 'Selesai', 'LAP-67404E9C91E688.2', '2024-11-22 09:27:56'),
(5, 'blater', '', '111111', 'ui', '', 'poris', '081391795829', '123@gmail.com', 'Mahasiswa', 'jinn kazama', '98912313', 'Mahasiswa', '2009-09-23', 'Poris', 'blater meledak', 'Selesai', 'LAP-674050429068C1.0', '2024-11-22 09:34:58'),
(6, 'bulan poris', '', '111111', 'ui', '', 'poris', '081391795829', '123@gmail.com', 'Mahasiswa', 'jinn kazama', '98912313', 'Mahasiswa', '2009-09-23', 'Poris', 'blater meledak', 'Selesai', 'LAP-674053ED978188.7', '2024-11-22 09:50:37'),
(7, 'Kayu jati', '', '222222', 'ugm', '', 'kyoto', '081391795829', '123@gmail.com', 'Mahasiswa', 'daun pisang', '98912313', 'Mahasiswa', '2009-02-18', 'bulan', 'kayu jatinya patah', 'Selesai', 'LAP-6740B22A8DC583.7', '2024-11-22 16:32:42'),
(8, 'oppo neo 5', '', '222222', 'ugm', '', 'kyoto', '081391795829', '123@gmail.com', 'Mahasiswa', 'daun pisang', '98912313', 'Mahasiswa', '2009-02-18', 'bulan', 'kayu jatinya patah', 'Sedang Dikerjakan', 'LAP-6740B2961264B6.4', '2024-11-22 16:34:30'),
(11, 'Paundra', 'KTP', '1372819912', 'UI/UX', 'Korban', 'Sokaraja', '08162', 'paundra@gevano.com', 'Mahasiswa', 'Andhika', '0816387299102', 'Mahasiswa', '2024-11-19', 'Ft blater', 'grep grep', 'Belum Dikerjakan', 'LAP-674184DAAA9BE8.4', '2024-11-23 07:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `satgas_logs`
--

CREATE TABLE `satgas_logs` (
  `id` int(11) NOT NULL,
  `id_satgas` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `tanggal_ambil` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satgas_logs`
--

INSERT INTO `satgas_logs` (`id`, `id_satgas`, `id_laporan`, `tanggal_ambil`) VALUES
(15, 4, 4, '2024-11-22 16:34:50'),
(16, 4, 5, '2024-11-22 16:35:03'),
(17, 4, 6, '2024-11-22 16:50:45'),
(18, 4, 4, '2024-11-22 17:03:48'),
(19, 4, 4, '2024-11-22 17:08:32'),
(20, 5, 7, '2024-11-22 23:33:03'),
(21, 5, 8, '2024-11-22 23:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `umur` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','satgas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `umur`, `email`, `alamat`, `username`, `password`, `role`) VALUES
(3, 'Kanye West', 30, 'ye@gmail.com', 'Jl. Admin No.1', 'admin', '123', 'admin'),
(4, 'Rias Gremory', 28, 'rias@gmail.com', 'Jl. Satgas No.2', 'rias', '123', 'satgas'),
(5, 'Kirigaya Kazuto', 25, 'kirigaya.kazuto@gmail.com', 'Mugas', 'kirito', '123', 'satgas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_laporan` (`kode_laporan`);

--
-- Indexes for table `satgas_logs`
--
ALTER TABLE `satgas_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_id` (`id_laporan`),
  ADD KEY `fk_id_satgas` (`id_satgas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `satgas_logs`
--
ALTER TABLE `satgas_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `satgas_logs`
--
ALTER TABLE `satgas_logs`
  ADD CONSTRAINT `fk_id_satgas` FOREIGN KEY (`id_satgas`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `satgas_logs_ibfk_2` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
