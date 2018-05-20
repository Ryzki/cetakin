-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2018 at 02:53 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cetakin`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'petugas', 'petugas'),
(3, 'pelanggan', 'pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `harga_foto`
--

CREATE TABLE `harga_foto` (
  `id` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL,
  `nama` varchar(45) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `info_harga`
--

CREATE TABLE `info_harga` (
  `id` int(11) NOT NULL,
  `idpercetakan` int(11) UNSIGNED NOT NULL,
  `kategori` enum('0','1') NOT NULL,
  `nama` varchar(45) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_harga`
--

INSERT INTO `info_harga` (`id`, `idpercetakan`, `kategori`, `nama`, `harga`, `satuan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 7, '0', 'Kertas A4', 250, 'Lembar', '2018-04-05 15:14:36', 18, '2018-04-21 11:46:26', 18),
(7, 7, '0', 'Kertas A3', 1000, 'Lembar', '2018-04-05 15:19:08', 18, '2018-04-21 11:46:32', 18);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_saldo`
--

CREATE TABLE `pembelian_saldo` (
  `id` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL,
  `nama_rekening` varchar(45) NOT NULL,
  `jumlah_transfer` int(11) NOT NULL,
  `bukti` varchar(200) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `percetakan`
--

CREATE TABLE `percetakan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `email_percetakan` varchar(45) NOT NULL,
  `phone_percetakan` varchar(45) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `status_dokumen` enum('0','1') NOT NULL DEFAULT '0',
  `status_foto` enum('0','1') NOT NULL DEFAULT '0',
  `status_percetakan` enum('0','1') NOT NULL DEFAULT '0',
  `status_verifikasi` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `percetakan`
--

INSERT INTO `percetakan` (`id`, `nama`, `slug`, `email_percetakan`, `phone_percetakan`, `foto`, `alamat`, `status_dokumen`, `status_foto`, `status_percetakan`, `status_verifikasi`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(7, 'Dimas Printing', 'dimas', 'dimas@gmail.com', '098765', 'CTK_UROFCKSO_20180421104611.jpg', 'kabat', '1', '1', '0', '1', '2018-04-03 05:22:14', 1, '2018-04-21 11:34:10', 1),
(8, 'Kanissa', 'kanissa', 'kanissa@gmail.com', '087633', 'CTK_MLWSQCMT_20180421104626.jpg', 'pakistaji', '1', '1', '0', '1', '2018-04-03 05:36:48', 1, '2018-04-21 11:34:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL,
  `idpercetakan` int(11) NOT NULL,
  `pesan` varchar(200) NOT NULL,
  `waktu` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_dokumen`
--

CREATE TABLE `pesanan_dokumen` (
  `id` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL,
  `idpercetakan` int(11) NOT NULL,
  `jenis_cetak` enum('0','1','2') NOT NULL,
  `jumlah_sisi` enum('0','1') NOT NULL,
  `jumlah_copy` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  `status_jilid` enum('0','1') DEFAULT NULL,
  `kode_pengambilan` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_dokumen`
--

INSERT INTO `pesanan_dokumen` (`id`, `idusers`, `idpercetakan`, `jenis_cetak`, `jumlah_sisi`, `jumlah_copy`, `file`, `status_jilid`, `kode_pengambilan`, `catatan`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(5, 12, 7, '0', '0', 1, 'FL_YGOCLVSY_20180403113202.pdf', NULL, 'DOK-001', 'aaaaaaaaaaaa', '0', '2018-04-03 11:32:02', 12, NULL, NULL),
(6, 12, 7, '0', '0', 50, 'FL_MWCYRCBE_20180403022800.pdf', NULL, 'DOK-002', 'ttytyt', '0', '2018-04-03 14:28:00', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_foto`
--

CREATE TABLE `pesanan_foto` (
  `id` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL,
  `idpercetakan` int(11) NOT NULL,
  `ukuran` varchar(45) NOT NULL,
  `jumlah_cetak` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  `kode_pengambilan` int(11) NOT NULL,
  `catatan` int(11) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL,
  `idpercetakan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `idusers`, `idpercetakan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 18, 7, '2018-04-03 05:22:15', 1, NULL, NULL),
(7, 19, 8, '2018-04-03 05:36:48', 1, NULL, NULL),
(8, 23, 7, '2018-04-21 09:35:46', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `saldo_has_percetakan`
--

CREATE TABLE `saldo_has_percetakan` (
  `id` int(11) NOT NULL,
  `idsaldo` int(11) NOT NULL,
  `idpercetakan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saldo_has_user`
--

CREATE TABLE `saldo_has_user` (
  `id` int(11) NOT NULL,
  `idsaldo` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saldo_user`
--

CREATE TABLE `saldo_user` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `keterangan` text,
  `waktu` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sdk`
--

CREATE TABLE `sdk` (
  `id` int(11) NOT NULL,
  `idusers` int(11) UNSIGNED NOT NULL,
  `nama` varchar(45) NOT NULL,
  `deskripsi` text NOT NULL,
  `target` enum('0','1','2') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `no_telp` varchar(45) NOT NULL,
  `alamat` text NOT NULL,
  `hak_akses` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `alamat` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `group_id`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `alamat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '', 1, 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 0, 1524301928, 1, 'Admin', 'Istrator', 'Admin', '082', 'alamat', NULL, 0, NULL, NULL),
(2, '', 2, 'petugas', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'petugas@petugas.com', NULL, NULL, NULL, NULL, 0, 1521167630, 1, 'Petugas', 'Istrator', 'Petugas', '992', 'alamat', NULL, 0, NULL, NULL),
(12, '', 3, 'pelanggan', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'pelanggan@pelanggan.com', NULL, NULL, NULL, NULL, 0, 1522820880, 1, 'hendri', 'Istrator', 'Pelanggan', '082', 'aaaaaaa', NULL, 0, '2018-03-21 11:43:43', 1),
(14, '', 2, 'petugas', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'dokumen@dokumen.com', NULL, NULL, NULL, NULL, 0, 1522488381, 1, 'Pelanggan', 'Istrator', 'Pelanggan', '082', 'alamat', NULL, 0, NULL, NULL),
(18, '::1', 2, NULL, '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'pdimas1@petugas.com', NULL, NULL, NULL, NULL, 0, 1524303569, 1, 'pdimas1', NULL, NULL, '09863', NULL, '2018-04-03 05:22:15', 1, '2018-04-21 10:58:39', 1),
(19, '::1', 2, NULL, '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'pkanissa@petugas.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'petugas kanissa', NULL, NULL, '234834', NULL, '2018-04-03 05:36:48', 1, '2018-04-21 10:58:16', 1),
(22, '::1', 3, NULL, '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'hendriyanto@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'hendriyanto', NULL, NULL, '0834231', 'lorem', '2018-04-03 06:42:20', 1, NULL, NULL),
(23, '::1', 2, NULL, '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'pdimas2@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'pdimas2', NULL, NULL, '93453', NULL, '2018-04-21 09:35:46', 1, '2018-04-21 10:58:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'petugas', 'Petugas'),
(3, 'pelanggan', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga_foto`
--
ALTER TABLE `harga_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_info_harga_users` (`idusers`);

--
-- Indexes for table `info_harga`
--
ALTER TABLE `info_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_saldo`
--
ALTER TABLE `pembelian_saldo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pembelian_saldo_users` (`idusers`);

--
-- Indexes for table `percetakan`
--
ALTER TABLE `percetakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pesan_percetakan` (`idpercetakan`),
  ADD KEY `FK_pesan_users` (`idusers`);

--
-- Indexes for table `pesanan_dokumen`
--
ALTER TABLE `pesanan_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pesanan_dokumen_percetakan` (`idpercetakan`),
  ADD KEY `FK_pesanan_dokumen_users` (`idusers`);

--
-- Indexes for table `pesanan_foto`
--
ALTER TABLE `pesanan_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pesanan_foto_percetakan` (`idpercetakan`),
  ADD KEY `FK_pesanan_foto_users` (`idusers`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_petugas_percetakan` (`idpercetakan`),
  ADD KEY `FK_petugas_users` (`idusers`);

--
-- Indexes for table `saldo_has_percetakan`
--
ALTER TABLE `saldo_has_percetakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_saldo_has_percetakan_saldo` (`idsaldo`),
  ADD KEY `FK_saldo_has_percetakan_percetakan` (`idpercetakan`);

--
-- Indexes for table `saldo_has_user`
--
ALTER TABLE `saldo_has_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_saldo_has_user_saldo` (`idsaldo`),
  ADD KEY `FK_saldo_has_user_users` (`idusers`);

--
-- Indexes for table `saldo_user`
--
ALTER TABLE `saldo_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdk`
--
ALTER TABLE `sdk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_syarat_dan_ketentuan_users` (`idusers`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_groups` (`group_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `harga_foto`
--
ALTER TABLE `harga_foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_harga`
--
ALTER TABLE `info_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pembelian_saldo`
--
ALTER TABLE `pembelian_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `percetakan`
--
ALTER TABLE `percetakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pesanan_dokumen`
--
ALTER TABLE `pesanan_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pesanan_foto`
--
ALTER TABLE `pesanan_foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `saldo_has_percetakan`
--
ALTER TABLE `saldo_has_percetakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saldo_has_user`
--
ALTER TABLE `saldo_has_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saldo_user`
--
ALTER TABLE `saldo_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sdk`
--
ALTER TABLE `sdk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `harga_foto`
--
ALTER TABLE `harga_foto`
  ADD CONSTRAINT `harga_foto_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Constraints for table `pembelian_saldo`
--
ALTER TABLE `pembelian_saldo`
  ADD CONSTRAINT `FK_pembelian_saldo_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `FK_pesan_percetakan` FOREIGN KEY (`idpercetakan`) REFERENCES `percetakan` (`id`),
  ADD CONSTRAINT `FK_pesan_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Constraints for table `pesanan_dokumen`
--
ALTER TABLE `pesanan_dokumen`
  ADD CONSTRAINT `FK_pesanan_dokumen_percetakan` FOREIGN KEY (`idpercetakan`) REFERENCES `percetakan` (`id`),
  ADD CONSTRAINT `FK_pesanan_dokumen_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Constraints for table `pesanan_foto`
--
ALTER TABLE `pesanan_foto`
  ADD CONSTRAINT `FK_pesanan_foto_percetakan` FOREIGN KEY (`idpercetakan`) REFERENCES `percetakan` (`id`),
  ADD CONSTRAINT `FK_pesanan_foto_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `FK_petugas_percetakan` FOREIGN KEY (`idpercetakan`) REFERENCES `percetakan` (`id`),
  ADD CONSTRAINT `FK_petugas_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Constraints for table `saldo_has_percetakan`
--
ALTER TABLE `saldo_has_percetakan`
  ADD CONSTRAINT `FK_saldo_has_percetakan_percetakan` FOREIGN KEY (`idpercetakan`) REFERENCES `percetakan` (`id`),
  ADD CONSTRAINT `FK_saldo_has_percetakan_saldo` FOREIGN KEY (`idsaldo`) REFERENCES `saldo_user` (`id`);

--
-- Constraints for table `saldo_has_user`
--
ALTER TABLE `saldo_has_user`
  ADD CONSTRAINT `FK_saldo_has_user_saldo` FOREIGN KEY (`idsaldo`) REFERENCES `saldo_user` (`id`),
  ADD CONSTRAINT `FK_saldo_has_user_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Constraints for table `sdk`
--
ALTER TABLE `sdk`
  ADD CONSTRAINT `FK_syarat_dan_ketentuan_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
