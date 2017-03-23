-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2017 at 07:36 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajarsymfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajar`
--

CREATE TABLE `ajar` (
  `dosen_nip` varchar(122) NOT NULL,
  `matakuliah_idmatkul` int(11) NOT NULL,
  `idajar` int(20) NOT NULL,
  `kelas` varchar(45) DEFAULT NULL,
  `jam` varchar(45) DEFAULT NULL,
  `hari` varchar(45) DEFAULT NULL,
  `ruang_idruang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ajar`
--

INSERT INTO `ajar` (`dosen_nip`, `matakuliah_idmatkul`, `idajar`, `kelas`, `jam`, `hari`, `ruang_idruang`) VALUES
('1', 1, 66, 'a', '1,2,3', 'senin', 1),
('1', 1, 67, 'b', '4,5,6', 'senin', 1),
('1', 9, 68, 'a', '7,8,9', 'senin', 1),
('1', 1, 69, 'c', '12,13', 'senin', 1),
('1', 48, 70, 'c', '4,5,6', 'jumat', 1),
('130090', 48, 71, 'b', '12,13,14', 'selasa', 1),
('130090', 83, 72, 'b', '1,2,3', 'selasa', 1),
('13484', 9, 73, 'c', '1,2,3', 'senin', 889),
('2', 7484, 74, 'a', '10,11,12', 'rabu', 1),
('3', 1, 75, 'd', '14,15', 'senin', 1),
('1', 434, 76, 'a', '1,2,3', 'kamis', 889),
('1', 83, 77, 'a', '1,2,3', 'minggu', 1),
('2', 1023, 78, 'a', '14,15', 'minggu', 1),
('13484', 7484, 79, 'b', '10,11', 'senin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(122) NOT NULL,
  `nama` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `nama`, `password`) VALUES
(1, 'hilmi', 'hilmi'),
(9, 'hilmi', 'dfdf'),
(10, 'sidad', 'ali'),
(11, 'lalu', 'lalu'),
(12, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(122) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`) VALUES
('1', 'herman yuliansyah'),
('130090', 'Jamalludin S.kom,Mt'),
('13484', 'Achmad Nugrohontooro S.kom,M.Cs'),
('2', 'sri winiarti'),
('3', 'wahyu pujiono'),
('4', 'murinto'),
('5', 'rusydi umar');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `idfakultas` int(11) NOT NULL,
  `namafakultas` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`idfakultas`, `namafakultas`) VALUES
(1, 'Fakultas Teknologi Industri'),
(2, 'Fakultas Farmasi'),
(738, 'MIPA');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(222) NOT NULL,
  `name` varchar(222) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `name`, `alamat`) VALUES
('12300', 'sidad ali', 'kediri lombok barat');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `idmatkul` int(11) NOT NULL,
  `nama_matkul` varchar(45) DEFAULT NULL,
  `program_studi_idprogram_studi` int(11) NOT NULL,
  `sks` int(20) DEFAULT NULL,
  `semester` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`idmatkul`, `nama_matkul`, `program_studi_idprogram_studi`, `sks`, `semester`) VALUES
(1, 'Algoritma Pemrograman', 1, 3, 2),
(9, 'Pemrograman Paralel', 1, 3, 6),
(48, 'Robotika', 2, 4, 5),
(83, 'Pemrograman Web', 1, 3, 2),
(120, 'Rekayasa Web', 1, 3, 6),
(434, 'Koding Bareng', 1, 3, 5),
(848, 'Android For Robotic', 2, 4, 5),
(1023, 'Basis Data', 1, 3, 3),
(7484, 'Sistem Informasi', 88, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `idprogram_studi` int(11) NOT NULL,
  `nama_prodi` varchar(45) DEFAULT NULL,
  `fakultas_idfakultas` int(11) NOT NULL,
  `kampus` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`idprogram_studi`, `nama_prodi`, `fakultas_idfakultas`, `kampus`) VALUES
(1, 'Teknik Informatika', 1, 'kampus 3'),
(2, 'Teknik Elektro', 1, 'kampus 3'),
(23, 'Teknik Industri', 1, 'kampus 3'),
(73, 'Teknik Kimia', 1, 'kampus 3'),
(87, 'Apoteker', 2, 'kampus 3'),
(88, 'Sistem Informasi', 738, 'kampus 3'),
(3874, 'Fisika Murni', 738, 'kampus 3');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `idruang` int(11) NOT NULL,
  `namaruang` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`idruang`, `namaruang`) VALUES
(1, '301'),
(12, '944'),
(344, '317'),
(889, '302');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajar`
--
ALTER TABLE `ajar`
  ADD PRIMARY KEY (`idajar`),
  ADD KEY `fk_dosen_has_matakuliah_matakuliah1_idx` (`matakuliah_idmatkul`),
  ADD KEY `fk_dosen_has_matakuliah_dosen1_idx` (`dosen_nip`),
  ADD KEY `fk_ajar_ruang1_idx` (`ruang_idruang`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`idfakultas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`idmatkul`),
  ADD KEY `fk_matakuliah_program_studi1_idx` (`program_studi_idprogram_studi`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`idprogram_studi`),
  ADD KEY `fk_program_studi_fakultas1_idx` (`fakultas_idfakultas`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`idruang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajar`
--
ALTER TABLE `ajar`
  MODIFY `idajar` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(122) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ajar`
--
ALTER TABLE `ajar`
  ADD CONSTRAINT `fk_ajar_ruang1` FOREIGN KEY (`ruang_idruang`) REFERENCES `ruang` (`idruang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dosen_has_matakuliah_dosen1` FOREIGN KEY (`dosen_nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dosen_has_matakuliah_matakuliah1` FOREIGN KEY (`matakuliah_idmatkul`) REFERENCES `matakuliah` (`idmatkul`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `fk_matakuliah_program_studi1` FOREIGN KEY (`program_studi_idprogram_studi`) REFERENCES `program_studi` (`idprogram_studi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `fk_program_studi_fakultas1` FOREIGN KEY (`fakultas_idfakultas`) REFERENCES `fakultas` (`idfakultas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
