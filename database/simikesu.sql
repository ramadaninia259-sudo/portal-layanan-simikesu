-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2026 at 02:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simikesu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_permohonan`
--

CREATE TABLE `tb_permohonan` (
  `id` int(11) NOT NULL,
  `nomor_permohonan` varchar(30) NOT NULL,
  `tanggal_permohonan` date NOT NULL,
  `nama_pemohon` varchar(100) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `instansi` varchar(150) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `nama_kegiatan` varchar(200) NOT NULL,
  `kategori` enum('Pemerintahan','Pendidikan','Kesehatan','Sosialisasi','Pariwisata','Budaya','Lainnya') NOT NULL,
  `lokasi_kegiatan` varchar(200) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `surat_permohonan` varchar(255) NOT NULL,
  `dokumen_pendukung` varchar(255) DEFAULT NULL,
  `materi_video` varchar(255) DEFAULT NULL,
  `materi_gambar` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu Verifikasi','Perbaikan Berkas','Diterima','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `catatan_petugas` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_permohonan`
--

INSERT INTO `tb_permohonan` (`id`, `nomor_permohonan`, `tanggal_permohonan`, `nama_pemohon`, `nik`, `instansi`, `jabatan`, `email`, `no_hp`, `alamat`, `nama_kegiatan`, `kategori`, `lokasi_kegiatan`, `tanggal_kegiatan`, `jam_mulai`, `jam_selesai`, `deskripsi`, `surat_permohonan`, `dokumen_pendukung`, `materi_video`, `materi_gambar`, `status`, `catatan_petugas`, `created_at`, `updated_at`) VALUES
(6, 'SIMIKESU-20260810-105054', '2026-08-10', 'nova', '020405238160016', 'icj', 'bendahara', 'novalia@gmail.com', '08765432110', 'jl.kptn m.jamil', 'project ultah', 'Sosialisasi', 'gor pancing', '2026-10-14', '19:00:00', '21:30:00', 'nobar james', 'simikesu_6a794a9ea0db65.70320094.pdf', 'simikesu_6a794a9ea0f861.38743134.jpeg', 'simikesu_6a794a9ea11c07.43744904.mp4', 'simikesu_6a794a9ea14241.04726965.png', 'Diterima', 'Permohonan diterima dan dapat diproses.', '2026-08-10 03:50:54', '2026-08-10 08:04:14'),
(7, 'SIMIKESU-20260810-151954', '2026-08-10', 'nia ramadani', '12345678910', 'rs', 'kepala', 'martin@gmail.com', '0812345678', 'jl.bunga', 'nobar', 'Pendidikan', 'alun alun', '2026-09-10', '17:00:00', '18:18:00', 'nonton bareng', 'simikesu_6a7989aa3e6716.62741461.pdf', 'simikesu_6a7989aa3ed924.12520732.jpeg', 'simikesu_6a7989aa3f20b6.51108700.mp4', 'simikesu_6a7989aa3f70b7.22355872.jpeg', 'Perbaikan Berkas', 'masih ada yang tidak memenuhi syarat', '2026-08-10 08:19:54', '2026-08-10 08:20:52'),
(8, 'SIMIKESU-20260810-155333', '2026-08-10', 'james', '14102005', 'cortis', 'ketua', 'james@gmail.com', '0814100510', 'jl.sanghai', 'informasi', 'Sosialisasi', 'taman bunga', '2026-08-28', '16:30:00', '18:50:00', 'sosialisasi', 'simikesu_6a79918d580684.05817666.pdf', 'simikesu_6a79918d589525.76675696.pdf', 'simikesu_6a79918d5921f8.60405130.mp4', 'simikesu_6a79918d59a9f6.30463165.jpg', 'Diterima', '', '2026-08-10 08:53:33', '2026-08-10 09:02:21'),
(9, 'SIMIKESU-20260811-085249', '2026-08-11', 'martin', '20030812345', 'cortis', 'wakil ketua', 'martin@gmail.com', '0812345678', 'jl.canada', 'project', 'Kesehatan', 'jalan raya', '2026-08-18', '19:00:00', '21:00:00', 'project eniv', 'simikesu_6a7a8071041ef4.58205108.pdf', 'simikesu_6a7a8071044352.85227500.pdf', 'simikesu_6a7a8071047f37.73742666.mp4', 'simikesu_6a7a807104b941.21402648.png', 'Ditolak', '', '2026-08-11 01:52:49', '2026-08-12 02:46:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_permohonan` (`nomor_permohonan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
