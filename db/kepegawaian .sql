-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 02:44 PM
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
-- Database: `kepegawaian`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPegawaiInfo` ()   BEGIN
    SELECT 
        pegawai.id_pegawai,
        pegawai.nama,
        pegawai.alamat,
        pegawai.email,
        jabatan.nama_jabatan,
        depertemen.nama_depertemen,
        jabatan.gaji_pokok AS GAJI_POKOK
    FROM pegawai
    JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan
    JOIN depertemen ON pegawai.id_depertemen = depertemen.id_depertemen;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `depertemen`
--

CREATE TABLE `depertemen` (
  `id_depertemen` int(11) NOT NULL,
  `nama_depertemen` varchar(255) NOT NULL,
  `id_manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `depertemen`
--

INSERT INTO `depertemen` (`id_depertemen`, `nama_depertemen`, `id_manager`) VALUES
(2, 'Keuangan', 1),
(3, 'Penyiaran', 0),
(4, 'Kreatif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `GAJI_POKOK` decimal(10,2) NOT NULL,
  `tunjangan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `GAJI_POKOK`, `tunjangan`) VALUES
(2, 'Manager', 10000000.00, 2000000.00),
(3, 'sekretaris', 600000.00, 50000.00),
(6, 'sekretaris', 50000000.00, 99999999.99);

-- --------------------------------------------------------

--
-- Table structure for table `log_perubahan_email`
--

CREATE TABLE `log_perubahan_email` (
  `id_log` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `email_lama` varchar(100) DEFAULT NULL,
  `email_baru` varchar(100) DEFAULT NULL,
  `waktu_perubahan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_perubahan_email`
--

INSERT INTO `log_perubahan_email` (`id_log`, `id_pegawai`, `email_lama`, `email_baru`, `waktu_perubahan`) VALUES
(1, 1, 'andi@exam.com', 'newemail@example.com', '2025-02-09 13:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telpon` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_depertemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `tanggal_lahir`, `jk`, `alamat`, `no_telpon`, `email`, `id_jabatan`, `id_depertemen`) VALUES
(1, 'Andi Firmasnyahsss', '1990-05-15', 'L', 'Jl. Merdeka No.10, Jakarta', '081234567', 'newemail@example.com', 2, 2),
(2, 'dguiwagiuwakkkkkk', '2025-02-09', 'L', 'bandung', '000', 'balqissahraa@gmail.com', 2, 2);

--
-- Triggers `pegawai`
--
DELIMITER $$
CREATE TRIGGER `after_update_email` AFTER UPDATE ON `pegawai` FOR EACH ROW BEGIN
    -- Cek apakah email berubah
    IF OLD.email <> NEW.email THEN
        INSERT INTO log_perubahan_email (id_pegawai, email_lama, email_baru, waktu_perubahan)
        VALUES (NEW.id_pegawai, OLD.email, NEW.email, NOW());
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `depertemen`
--
ALTER TABLE `depertemen`
  ADD PRIMARY KEY (`id_depertemen`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `log_perubahan_email`
--
ALTER TABLE `log_perubahan_email`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_depertemen` (`id_depertemen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `depertemen`
--
ALTER TABLE `depertemen`
  MODIFY `id_depertemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_perubahan_email`
--
ALTER TABLE `log_perubahan_email`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_perubahan_email`
--
ALTER TABLE `log_perubahan_email`
  ADD CONSTRAINT `log_perubahan_email_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_depertemen`) REFERENCES `depertemen` (`id_depertemen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
