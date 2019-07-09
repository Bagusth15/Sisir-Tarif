-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2019 at 12:35 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sisirtarif`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat_pelanggan`
--

CREATE TABLE `alat_pelanggan` (
  `id_alat` int(11) NOT NULL,
  `id_pel` varchar(50) NOT NULL,
  `nama_peralatan` varchar(100) NOT NULL,
  `keperluan_untuk` enum('Bisnis','Rumah Tangga') NOT NULL,
  `daya` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `total_daya` varchar(100) NOT NULL,
  `pemakaian_alat` varchar(50) NOT NULL,
  `pemakaian_perkwh` varchar(50) NOT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_pelanggan`
--

INSERT INTO `alat_pelanggan` (`id_alat`, `id_pel`, `nama_peralatan`, `keperluan_untuk`, `daya`, `jumlah`, `total_daya`, `pemakaian_alat`, `pemakaian_perkwh`, `foto`) VALUES
(26, '546302876037', 'Mesin Cuci', 'Bisnis', 200, 1, '200', '20', '4', '546302876037 - Peralatan -Mesin Cuci-26.jpg'),
(27, '546302876037', 'Dispenser', 'Rumah Tangga', 350, 1, '350', '10', '3.5', '546302876037 - Peralatan -Dispenser-27.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `data_daya_tarif`
--

CREATE TABLE `data_daya_tarif` (
  `id_ddt` int(11) NOT NULL,
  `id_daya_tarif` int(11) NOT NULL,
  `daya_tarif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_daya_tarif`
--

INSERT INTO `data_daya_tarif` (`id_ddt`, `id_daya_tarif`, `daya_tarif`) VALUES
(1, 1, 'B-1/450 VA'),
(2, 2, 'B-1/900 VA'),
(4, 3, 'B-1/1300 VA'),
(5, 4, 'B-1/2200 VA'),
(6, 5, 'B-1/3500 VA'),
(7, 6, 'B-1/4400 VA'),
(8, 7, 'B-1/5500 VA');

-- --------------------------------------------------------

--
-- Table structure for table `data_hasil`
--

CREATE TABLE `data_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_pel` varchar(50) NOT NULL,
  `kwh_rt` varchar(50) NOT NULL,
  `kwh_bisnis` varchar(50) NOT NULL,
  `id_daya_tarif` int(11) NOT NULL,
  `id_peruntukan_persil` int(11) NOT NULL,
  `hasil` enum('Disetujui','Tidak Disetujui') NOT NULL,
  `jarak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_peruntukan_persil`
--

CREATE TABLE `data_peruntukan_persil` (
  `id_pp` int(11) NOT NULL,
  `id_peruntukan_persil` int(11) NOT NULL,
  `peruntukan_persil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_peruntukan_persil`
--

INSERT INTO `data_peruntukan_persil` (`id_pp`, `id_peruntukan_persil`, `peruntukan_persil`) VALUES
(1, 1, 'Murni Bisnis'),
(2, 2, 'Bisnis dan Tempat Tinggal'),
(3, 3, 'Bisnis Kosong (Tidak Dihuni)'),
(4, 4, 'Lain - lain');

-- --------------------------------------------------------

--
-- Table structure for table `data_proses`
--

CREATE TABLE `data_proses` (
  `id_proses` int(11) NOT NULL,
  `id_pel` varchar(50) NOT NULL,
  `kwh_rt` varchar(50) NOT NULL,
  `kwh_bisnis` varchar(50) NOT NULL,
  `id_daya_tarif` int(11) NOT NULL,
  `id_peruntukan_persil` int(11) NOT NULL,
  `hasil` enum('Disetujui','Tidak Disetujui') NOT NULL,
  `jarak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_testing`
--

CREATE TABLE `data_testing` (
  `id_testing` int(11) NOT NULL,
  `id_pel` varchar(50) NOT NULL,
  `kwh_rt` varchar(50) NOT NULL,
  `kwh_bisnis` varchar(50) NOT NULL,
  `id_daya_tarif` int(11) NOT NULL,
  `id_peruntukan_persil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_testing`
--

INSERT INTO `data_testing` (`id_testing`, `id_pel`, `kwh_rt`, `kwh_bisnis`, `id_daya_tarif`, `id_peruntukan_persil`) VALUES
(3, '546302876037', '3.5', '4', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_training`
--

CREATE TABLE `data_training` (
  `id_dt` int(11) NOT NULL,
  `kwh_rt` varchar(50) NOT NULL,
  `kwh_bisnis` varchar(50) NOT NULL,
  `id_daya_tarif` int(11) NOT NULL,
  `id_peruntukan_persil` int(11) NOT NULL,
  `hasil` enum('Disetujui','Tidak Disetujui') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_training`
--

INSERT INTO `data_training` (`id_dt`, `kwh_rt`, `kwh_bisnis`, `id_daya_tarif`, `id_peruntukan_persil`, `hasil`) VALUES
(1, '0', '109.36', 7, 1, 'Disetujui'),
(2, '0', '32,48', 6, 1, 'Disetujui'),
(3, '0', '24,38', 4, 1, 'Disetujui'),
(4, '2,87', '2,64', 3, 2, 'Tidak Disetujui'),
(5, '4,3', '2,22', 3, 2, 'Tidak Disetujui'),
(6, '0', '0', 3, 3, 'Disetujui'),
(7, '0,75', '6,39', 1, 1, 'Disetujui'),
(8, '4,19', '15,32', 3, 2, 'Disetujui'),
(9, '9,03', '10,33', 3, 2, 'Disetujui'),
(10, '15,99', '0', 3, 4, 'Tidak Disetujui'),
(11, '0', '0', 3, 3, 'Disetujui'),
(12, '0', '0,96', 3, 3, 'Disetujui'),
(13, '0', '14,37', 3, 1, 'Disetujui'),
(14, '8,01', '0', 1, 4, 'Tidak Disetujui'),
(15, '9,1', '5,19', 3, 2, 'Tidak Disetujui'),
(16, '5,27', '0', 1, 4, 'Tidak Disetujui'),
(17, '6,47', '0', 2, 4, 'Tidak Disetujui'),
(18, '7,95', '7,8', 3, 2, 'Tidak Disetujui'),
(19, '6,9', '2,16', 3, 2, 'Tidak Disetujui'),
(20, '1,05', '12,44', 3, 2, 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `id_pel` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp_pel` varchar(20) NOT NULL,
  `alamat_pel` text NOT NULL,
  `id_daya_tarif` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `id_peruntukan_persil` int(11) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `foto_1` varchar(50) NOT NULL,
  `foto_2` varchar(50) NOT NULL,
  `foto_3` varchar(50) NOT NULL,
  `foto_4` varchar(50) NOT NULL,
  `hits` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nik`, `id_pel`, `nama`, `no_telp_pel`, `alamat_pel`, `id_daya_tarif`, `date`, `id_peruntukan_persil`, `keterangan`, `foto_1`, `foto_2`, `foto_3`, `foto_4`, `hits`) VALUES
(7, 201531251, '546302876037', 'Muh Lufti Rangkuty', '082111269036', 'JL PULO HARAPAN INDAH RT 12 RW 10', 1, '2019-05-27 07:46:09', 2, 'Masih Kosong', '546302876037 - Gambar Usaha0.jpg', 'default.jpg', 'default.jpg', 'default.jpg', '0');

--
-- Triggers `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `edit_pelanggan_data_testing` AFTER UPDATE ON `pelanggan` FOR EACH ROW BEGIN   
UPDATE data_testing SET id_daya_tarif = new.id_daya_tarif, id_peruntukan_persil = new.id_peruntukan_persil
WHERE id_pel = NEW.id_pel; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nik` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `hak_akses` enum('SuperAdmin','Admin','Karyawan') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `tgl_buat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nik`, `nama_lengkap`, `email`, `no_telp`, `jenis_kelamin`, `alamat`, `gambar`, `username`, `password`, `pass`, `hak_akses`, `status`, `tgl_buat`) VALUES
(201531089, 'Intania CS', 'Intan@gmail.com', '0812345678', 'Wanita', 'Jln....', 'default.png', 'ICS', 'b1098cab9c2db3eb9f576eb66c33449c', 'intan', 'Admin', 'Aktif', '1557468976'),
(201531250, 'Vhiendy', 'Vhindy@gmail.com', '0812345678', 'Wanita', 'Jln. keluar', 'default.jpg', 'VISP', '202cb962ac59075b964b07152d234b70', '123', 'Karyawan', 'Aktif', '2019-05-23 17:38:04'),
(201531251, 'Bagus TH', 'Bagustri15@gmail.com', '081290220996', 'Pria', 'Jln. Bedahan RT.09/01', 'default.png', 'BTH', '17b38fc02fd7e92f3edeb6318e3066d8', 'bagus', 'SuperAdmin', 'Aktif', '1557452590');

-- --------------------------------------------------------

--
-- Table structure for table `user_online`
--

CREATE TABLE `user_online` (
  `nik` int(11) NOT NULL,
  `history` varchar(50) NOT NULL,
  `status_ol` enum('ONLINE','OFFLINE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_online`
--

INSERT INTO `user_online` (`nik`, `history`, `status_ol`) VALUES
(201531251, '2019-05-23 18:58:13', 'ONLINE'),
(201531251, '2019-05-23 18:59:26', 'OFFLINE'),
(201531250, '2019-05-23 18:59:32', 'ONLINE'),
(201531250, '2019-05-23 19:02:38', 'OFFLINE'),
(201531089, '2019-05-23 19:02:44', 'ONLINE'),
(201531251, '2019-05-23 20:38:21', 'ONLINE'),
(201531251, '2019-05-23 22:54:34', 'OFFLINE'),
(201531251, '2019-05-24 08:48:00', 'ONLINE'),
(201531251, '2019-05-25 10:17:00', 'ONLINE'),
(201531251, '2019-05-25 16:52:14', 'ONLINE'),
(201531251, '2019-05-25 16:52:43', 'OFFLINE'),
(201531250, '2019-05-25 16:52:49', 'ONLINE'),
(201531250, '2019-05-25 17:43:12', 'OFFLINE'),
(201531251, '2019-05-25 17:43:18', 'ONLINE'),
(201531251, '2019-05-25 21:22:01', 'ONLINE'),
(201531251, '2019-05-26 09:03:11', 'ONLINE'),
(201531251, '2019-05-27 05:51:20', 'ONLINE'),
(201531250, '2019-05-27 06:19:27', 'ONLINE'),
(201531089, '2019-05-27 16:38:37', 'OFFLINE'),
(201531251, '2019-05-28 08:11:59', 'ONLINE'),
(3, '2019-05-28 18:47:56', 'OFFLINE'),
(201531251, '2019-05-28 18:48:03', 'ONLINE'),
(201531251, '2019-05-28 18:50:06', 'OFFLINE'),
(201531251, '2019-05-31 08:54:14', 'ONLINE'),
(201531251, '2019-05-31 10:36:43', 'OFFLINE'),
(3, '2019-05-31 10:36:47', 'OFFLINE'),
(201531251, '2019-05-31 10:38:08', 'ONLINE'),
(201531251, '2019-05-31 10:38:14', 'OFFLINE'),
(201531251, '2019-05-31 10:42:55', 'ONLINE'),
(201531251, '2019-05-31 14:48:14', 'OFFLINE'),
(3, '2019-05-31 14:48:18', 'OFFLINE'),
(201531089, '2019-05-31 14:48:44', 'ONLINE'),
(201531089, '2019-05-31 14:51:02', 'OFFLINE'),
(201531251, '2019-06-06 18:50:45', 'ONLINE'),
(201531251, '2019-06-08 13:32:51', 'ONLINE'),
(201531251, '2019-06-08 14:36:09', 'OFFLINE'),
(201531089, '2019-06-08 14:36:16', 'ONLINE'),
(201531251, '2019-06-13 13:08:33', 'ONLINE'),
(201531251, '2019-06-16 15:17:54', 'ONLINE'),
(201531251, '2019-06-16 17:26:09', 'OFFLINE'),
(3, '2019-06-16 17:26:12', 'OFFLINE'),
(201531251, '2019-06-16 17:26:51', 'ONLINE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat_pelanggan`
--
ALTER TABLE `alat_pelanggan`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `data_daya_tarif`
--
ALTER TABLE `data_daya_tarif`
  ADD PRIMARY KEY (`id_ddt`);

--
-- Indexes for table `data_hasil`
--
ALTER TABLE `data_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `data_peruntukan_persil`
--
ALTER TABLE `data_peruntukan_persil`
  ADD PRIMARY KEY (`id_pp`);

--
-- Indexes for table `data_proses`
--
ALTER TABLE `data_proses`
  ADD PRIMARY KEY (`id_proses`);

--
-- Indexes for table `data_testing`
--
ALTER TABLE `data_testing`
  ADD PRIMARY KEY (`id_testing`);

--
-- Indexes for table `data_training`
--
ALTER TABLE `data_training`
  ADD PRIMARY KEY (`id_dt`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat_pelanggan`
--
ALTER TABLE `alat_pelanggan`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `data_daya_tarif`
--
ALTER TABLE `data_daya_tarif`
  MODIFY `id_ddt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_hasil`
--
ALTER TABLE `data_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_peruntukan_persil`
--
ALTER TABLE `data_peruntukan_persil`
  MODIFY `id_pp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_proses`
--
ALTER TABLE `data_proses`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `data_testing`
--
ALTER TABLE `data_testing`
  MODIFY `id_testing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_training`
--
ALTER TABLE `data_training`
  MODIFY `id_dt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
