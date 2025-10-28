-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2025 at 02:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobajoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` varchar(6) NOT NULL,
  `nama_dosen` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`) VALUES
('AB1234', 'mpu gandring'),
('AS1234', 'siapa saja'),
('BS1234', 'kukubeluk'),
('DG1234', 'saya satpol'),
('DS1234', 'aku saja');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `kode_mk` varchar(6) NOT NULL,
  `nama_matkul` varchar(20) NOT NULL,
  `id_dosen` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`kode_mk`, `nama_matkul`, `id_dosen`) VALUES
('A1234', 'jurus sampingan', 'AS1234'),
('B1234', 'jurus andalan', 'BS1234'),
('C1234', 'jurus rawarontek', 'AB1234'),
('D1234', 'pagi pak guru', 'DS1234'),
('G1234', 'goreng tahu blat', 'DG1234');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `nim` int(11) NOT NULL,
  `nama_mhs` varchar(25) NOT NULL,
  `prodi` varchar(15) NOT NULL,
  `kode_mk` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`nim`, `nama_mhs`, `prodi`, `kode_mk`) VALUES
(2304046, 'si buta', 'informatika', 'A1234'),
(2305087, 'probe', 'agribisnis', 'D1234'),
(2305088, 'probe', 'informatika', 'C1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`kode_mk`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `kode_mk` (`kode_mk`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `matkul_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`);

--
-- Constraints for table `mhs`
--
ALTER TABLE `mhs`
  ADD CONSTRAINT `mhs_ibfk_1` FOREIGN KEY (`kode_mk`) REFERENCES `matkul` (`kode_mk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
