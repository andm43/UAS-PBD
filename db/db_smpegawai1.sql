-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 09:15 AM
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
-- Database: `db_smpegawai1`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_d` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `banyak_anggota` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_d`, `nama_departemen`, `banyak_anggota`) VALUES
(1, 'HRD', 12),
(2, 'Keuangan', 11),
(3, 'IT', 13),
(4, 'Pemasaran', 9),
(5, 'Produksi', 6);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_k` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` enum('Direktur','Manager','Supervisor','Staff') NOT NULL,
  `departemen_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_k`, `nip`, `nama`, `jabatan`, `departemen_id`, `email`, `tanggal_masuk`, `foto`) VALUES
(1, '10122401', 'Christy', 'Manager', 3, 'christy@gmail.com', '2025-01-14', 'uploads/10.png'),
(2, '10122402', 'Budi', 'Staff', 1, 'budi@example.com', '2023-02-10', NULL),
(13, '10122403', 'Pablo', 'Manager', 3, 'pablo@example.com', '2025-02-15', ''),
(17, '10122410', 'Arif Setiawan', 'Manager', 3, 'arif.setiawan@example.com', '2025-02-15', NULL),
(18, '10122411', 'Budi Pratama', 'Staff', 1, 'budi.pratama@example.com', '2025-02-15', NULL),
(19, '10122412', 'Chandra Kusuma', 'Supervisor', 2, 'chandra.kusuma@example.com', '2025-02-15', NULL),
(20, '10122413', 'Dewi Lestari', 'Manager', 3, 'dewi.lestari@example.com', '2025-02-15', NULL),
(21, '10122414', 'Eka Purnama', 'Staff', 5, 'eka.purnama@example.com', '2025-02-15', NULL),
(22, '10122415', 'Fajar Maulana', 'Supervisor', 4, 'fajar.maulana@example.com', '2025-02-15', NULL),
(23, '10122416', 'Gita Safitri', 'Manager', 2, 'gita.safitri@example.com', '2025-02-15', NULL),
(24, '10122417', 'Hendra Gunawan', 'Staff', 1, 'hendra.gunawan@example.com', '2025-02-15', NULL),
(25, '10122418', 'Ira Wulandari', 'Supervisor', 3, 'ira.wulandari@example.com', '2025-02-15', NULL),
(26, '10122419', 'Joko Waluyo', 'Direktur', 1, 'joko.waluyo@example.com', '2025-02-15', NULL),
(27, '10122420', 'Karina Putri', 'Staff', 2, 'karina.putri@example.com', '2025-02-15', NULL),
(28, '10122421', 'Lukman Hakim', 'Manager', 3, 'lukman.hakim@example.com', '2025-02-15', NULL),
(29, '10122422', 'Maya Sari', 'Supervisor', 4, 'maya.sari@example.com', '2025-02-15', NULL),
(30, '10122423', 'Nina Andriani', 'Staff', 5, 'nina.andriani@example.com', '2025-02-15', NULL),
(31, '10122424', 'Omar Priyadi', 'Manager', 2, 'omar.priyadi@example.com', '2025-02-15', NULL),
(32, '10122425', 'Puti Rahma', 'Supervisor', 1, 'puti.rahma@example.com', '2025-02-15', NULL),
(33, '10122426', 'Qori Handayani', 'Staff', 3, 'qori.handayani@example.com', '2025-02-15', NULL),
(34, '10122427', 'Rizal Kurniawan', 'Manager', 4, 'rizal.kurniawan@example.com', '2025-02-15', NULL),
(35, '10122428', 'Sinta Melati', 'Supervisor', 5, 'sinta.melati@example.com', '2025-02-15', NULL),
(36, '10122429', 'Tomi Wicaksono', 'Direktur', 2, 'tomi.wicaksono@example.com', '2025-02-15', NULL),
(37, '10122430', 'Umi Salamah', 'Staff', 1, 'umi.salamah@example.com', '2025-02-15', NULL),
(38, '10122431', 'Vina Kusumo', 'Manager', 2, 'vina.kusumo@example.com', '2025-02-15', NULL),
(39, '10122432', 'Wahyu Hartono', 'Supervisor', 3, 'wahyu.hartono@example.com', '2025-02-15', NULL),
(40, '10122433', 'Xena Paramita', 'Staff', 4, 'xena.paramita@example.com', '2025-02-15', NULL),
(41, '10122434', 'Yogi Pratama', 'Manager', 5, 'yogi.pratama@example.com', '2025-02-15', NULL),
(42, '10122435', 'Zahra Rahmani', 'Supervisor', 1, 'zahra.rahmani@example.com', '2025-02-15', NULL),
(43, '10122436', 'Alya Kurniati', 'Staff', 2, 'alya.kurniati@example.com', '2025-02-15', NULL),
(44, '10122437', 'Budi Wicaksono', 'Manager', 3, 'budi.wicaksono@example.com', '2025-02-15', NULL),
(45, '10122438', 'Citra Puspa', 'Supervisor', 4, 'citra.puspa@example.com', '2025-02-15', NULL),
(47, '10122440', 'Erni Yuliana', 'Staff', 1, 'erni.yuliana@example.com', '2025-02-15', NULL),
(48, '10122441', 'Fikri Ramadhan', 'Manager', 2, 'fikri.ramadhan@example.com', '2025-02-15', NULL),
(49, '10122442', 'Gina Suryani', 'Supervisor', 3, 'gina.suryani@example.com', '2025-02-15', NULL),
(50, '10122443', 'Hana Wijaya', 'Staff', 4, 'hana.wijaya@example.com', '2025-02-15', NULL),
(51, '10122444', 'Indra Lesmana', 'Manager', 5, 'indra.lesmana@example.com', '2025-02-15', ''),
(52, '10122445', 'Johan Halim', 'Supervisor', 1, 'johan.halim@example.com', '2025-02-15', NULL),
(53, '10122446', 'Kiki Safira', 'Staff', 2, 'kiki.safira@example.com', '2025-02-15', NULL),
(54, '10122447', 'Lestari Cahaya', 'Manager', 3, 'lestari.cahaya@example.com', '2025-02-15', NULL),
(55, '10122448', 'Mahdi Rasyid', 'Supervisor', 4, 'mahdi.rasyid@example.com', '2025-02-15', NULL),
(57, '10122450', 'Oscar Firmansyah', 'Staff', 1, 'oscar.firmansyah@example.com', '2025-02-15', NULL),
(58, '10122451', 'Putra Santoso', 'Manager', 2, 'putra.santoso@example.com', '2025-02-15', NULL),
(59, '10122452', 'Qila Sasmita', 'Supervisor', 3, 'qila.sasmita@example.com', '2025-02-15', NULL),
(60, '10122453', 'Rina Yulia', 'Staff', 4, 'rina.yulia@example.com', '2025-02-15', NULL),
(61, '10122470', 'Sultan Rangga', 'Manager', 5, 'sultan.prakoso@example.com', '2025-02-15', 'uploads/f1.jpeg'),
(62, '10122455', 'Tania Ardhana', 'Supervisor', 1, 'tania.ardhana@example.com', '2025-02-15', NULL),
(63, '10122456', 'Ujang Rahmat', 'Staff', 2, 'ujang.rahmat@example.com', '2025-02-15', NULL),
(64, '10122457', 'Vita Andriani', 'Manager', 3, 'vita.andriani@example.com', '2025-02-15', NULL),
(65, '10122458', 'Windi Surya', 'Supervisor', 4, 'windi.surya@example.com', '2025-02-15', NULL),
(67, '10122405', 'Andre', 'Direktur', 1, 'andre@example.com', '2025-02-15', 'uploads/kaze2.jpg');

--
-- Triggers `karyawan`
--
DELIMITER $$
CREATE TRIGGER `tr_karyawan_set_tanggal_masuk` BEFORE INSERT ON `karyawan` FOR EACH ROW BEGIN
    -- Mengisi kolom tanggal_masuk dengan tanggal & waktu sekarang
    SET NEW.tanggal_masuk = NOW();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_karyawan_after_delete` AFTER DELETE ON `karyawan` FOR EACH ROW BEGIN
  UPDATE departemen
  SET banyak_anggota = banyak_anggota - 1
  WHERE id_d = OLD.departemen_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_karyawan_after_insert` AFTER INSERT ON `karyawan` FOR EACH ROW BEGIN
  UPDATE departemen
  SET banyak_anggota = banyak_anggota + 1
  WHERE id_d = NEW.departemen_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_karyawan_after_update` AFTER UPDATE ON `karyawan` FOR EACH ROW BEGIN
  -- Hanya jika departemen_id berubah
  IF NEW.departemen_id != OLD.departemen_id THEN
    UPDATE departemen
    SET banyak_anggota = banyak_anggota - 1
    WHERE id_d = OLD.departemen_id;

    UPDATE departemen
    SET banyak_anggota = banyak_anggota + 1
    WHERE id_d = NEW.departemen_id;
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_d`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_k`),
  ADD KEY `fk_departemen` (`departemen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `fk_departemen` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id_d`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
