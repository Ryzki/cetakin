-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2018 at 11:24 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cetakin`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_transfer`
--

CREATE TABLE `bukti_transfer` (
  `id` int(11) NOT NULL,
  `id_saldo` int(11) NOT NULL,
  `nama_rek` varchar(50) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `foto` varchar(70) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti_transfer`
--

INSERT INTO `bukti_transfer` (`id`, `id_saldo`, `nama_rek`, `no_rek`, `foto`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 1, 'Dimas', '564654', 'BKT_FJIHFPTL_20180505082155.jpg', '2018-05-05 08:21:55', 12, NULL, NULL),
(4, 3, 'Rahmat', '5224266', 'BKT_GAQUGJCM_20180505095843.jpg', '2018-05-05 09:58:43', 12, NULL, NULL),
(5, 4, 'Rahmat Ramadhan', '16542154', 'BKT_ZKJXREPO_20180505024517.jpg', '2018-05-05 14:45:17', 26, NULL, NULL),
(6, 6, 'Rahmat Ramadhan', '564654', 'BKT_QFLGCGTZ_20180510113253.jpg', '2018-05-10 11:32:53', 35, NULL, NULL),
(7, 9, 'ads', 'dasdasd', 'BKT_GNOKZUZI_20180513104838.jpg', '2018-05-13 10:48:38', 12, NULL, NULL),
(8, 10, 'Rahmat Ramadhan', '564654', 'BKT_DJODBDUC_20180523123607.png', '2018-05-23 00:36:07', 40, NULL, NULL),
(9, 13, '13', '13', NULL, '2018-05-23 10:50:32', 40, NULL, NULL),
(10, 14, 'Rahmat Ramadhan', '123123123', 'BKT_MRSHDOEY_20180523105326.png', '2018-05-23 10:53:26', 40, NULL, NULL);

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
(7, 7, '0', 'Kertas A3', 1000, 'Lembar', '2018-04-05 15:19:08', 18, '2018-04-21 11:46:32', 18),
(8, 8, '0', 'Kertas A4', 500, 'Lembar', '2018-05-05 15:23:53', 19, '2018-05-05 15:23:59', 19),
(9, 8, '0', 'Kertas F4', 300, 'Lembar', '2018-05-05 15:24:32', 19, NULL, NULL);

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
(8, 'Kanissa Print', 'kanissa', 'kanissa@gmail.com', '087633', 'CTK_MLWSQCMT_20180421104626.jpg', 'pakistaji', '1', '0', '0', '1', '2018-04-03 05:36:48', 1, '2018-05-05 15:05:42', 1);

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
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0:belum diproses, 1:diproses,2:selesai, 3:ditolak,4:dibatalkan',
  `catatan_percetakan` varchar(255) NOT NULL,
  `biaya_cetak` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_dokumen`
--

INSERT INTO `pesanan_dokumen` (`id`, `idusers`, `idpercetakan`, `jenis_cetak`, `jumlah_sisi`, `jumlah_copy`, `file`, `status_jilid`, `kode_pengambilan`, `catatan`, `status`, `catatan_percetakan`, `biaya_cetak`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(5, 12, 7, '0', '0', 1, 'FL_YGOCLVSY_20180403113202.pdf', NULL, 'DOK-001', 'aaaaaaaaaaaa', '1', '0', 0, '2018-04-03 11:32:02', 12, '2018-05-10 08:07:35', 23),
(6, 12, 7, '0', '0', 50, 'FL_MWCYRCBE_20180403022800.pdf', NULL, 'DOK-002', 'ttytyt', '2', 'ok', 20000, '2018-04-03 14:28:00', 12, '2018-05-10 06:07:12', 23),
(7, 12, 7, '0', '0', 1, 'FL_PTDDLVMJ_20180505051220.docx', NULL, 'DOK-003', 'oke', '2', '0', 0, '2018-05-05 05:12:20', 12, '2018-05-05 06:01:53', 23),
(8, 26, 8, '1', '0', 2, 'FL_IFRRBGWJ_20180505033324.pdf', NULL, 'DOK-004', 'secepatnya ya mas', '0', '0', 0, '2018-05-05 15:33:24', 26, '2018-05-13 10:49:43', 19),
(9, 35, 7, '0', '0', 2, 'FL_JVYZNOFA_20180510112143.docx', NULL, 'DOK-005', 'asd', '2', 'asd', 20000, '2018-05-10 11:21:43', 35, '2018-05-10 11:33:34', 23),
(10, 35, 7, '0', '0', 2, 'FL_TRSWYYKD_20180510120557.pdf', NULL, 'DOK-006', 's', '1', '', 20000, '2018-05-10 12:05:57', 35, '2018-05-10 12:34:52', 23),
(11, 12, 8, '0', '1', 1, 'FL_YIXHNIFT_20180513104059.doc', NULL, 'DOK-007', 'oke sudah', '3', '', 0, '2018-05-13 10:40:59', 12, '2018-05-13 10:45:31', 19),
(12, 12, 8, '0', '0', 1, 'FL_STRHHIED_20180513104403.doc', NULL, 'DOK-008', 'eh oke lagi', '2', 'ambil saja sudah', 20000, '2018-05-13 10:44:03', 12, '2018-05-13 10:45:15', 19),
(13, 40, 7, '0', '0', 1, 'FL_EYTETZXM_20180523110915.docx', NULL, 'DOK-009', 'lorem ipsum', '2', 'sip', 25000, '2018-05-23 11:09:15', 40, '2018-05-23 11:21:41', 23);

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
  `kode_pengambilan` varchar(50) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_foto`
--

INSERT INTO `pesanan_foto` (`id`, `idusers`, `idpercetakan`, `ukuran`, `jumlah_cetak`, `file`, `kode_pengambilan`, `catatan`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 40, 7, '3x4', 0, 'FT_HJMHQYPF_20180523122015.png', 'FT-001', 'asd', '2', '2018-05-23 00:20:15', 40, '2018-05-23 00:37:53', 23);

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
-- Table structure for table `saldo_percetakan`
--

CREATE TABLE `saldo_percetakan` (
  `id` int(11) NOT NULL,
  `id_percetakan` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('0','1','2','3','4') DEFAULT '2' COMMENT '0:pemasukan, 1:pengeluaran, 2:konfirmasi tf, 3:menunggu konfirmasi, 4:gagal',
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `saldo_percetakan`
--

INSERT INTO `saldo_percetakan` (`id`, `id_percetakan`, `nominal`, `status`, `keterangan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(13, 7, 25000, '0', 'Melakukan percetakan dengan kode DOK-009', '2018-05-23 11:21:41', 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `saldo_user`
--

CREATE TABLE `saldo_user` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('0','1','2','3','4') DEFAULT '2' COMMENT '0:pemasukan, 1:pengeluaran, 2:konfirmasi tf, 3:menunggu konfirmasi, 4:gagal',
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo_user`
--

INSERT INTO `saldo_user` (`id`, `id_users`, `nominal`, `status`, `keterangan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 12, 10000, '0', 'Pengisian Saldo', '2018-05-05 06:49:18', 12, '2018-05-05 09:48:38', 1),
(2, 12, 2000, '2', 'Pengisian Saldo', '2018-05-05 08:27:42', 12, NULL, NULL),
(3, 12, 200000, '0', 'Pengisian Saldo', '2018-05-05 09:58:23', 12, '2018-05-05 09:59:52', 1),
(4, 26, 20000, '0', 'Pengisian Saldo', '2018-05-05 14:44:55', 26, '2018-05-05 14:46:35', 1),
(5, 12, 20000, '1', 'Melakukan percetakan dengan kode DOK-002', '2018-05-10 06:07:12', 23, NULL, NULL),
(6, 35, 500000, '0', 'Pengisian Saldo', '2018-05-10 11:32:38', 35, '2018-05-10 11:33:03', 1),
(7, 35, 20000, '1', 'Melakukan percetakan dengan kode DOK-005', '2018-05-10 11:33:35', 23, NULL, NULL),
(8, 12, 20000, '1', 'Melakukan percetakan dengan kode DOK-008', '2018-05-13 10:45:15', 19, NULL, NULL),
(9, 12, 20000, '0', 'Pengisian Saldo', '2018-05-13 10:48:19', 12, '2018-05-13 11:27:40', 1),
(10, 40, 100000, '0', 'Pengisian Saldo', '2018-05-23 00:35:46', 40, '2018-05-23 00:36:42', 1),
(11, 40, 5000, '1', 'Melakukan percetakan dengan kode FT-001', '2018-05-23 00:37:53', 23, NULL, NULL),
(12, 40, 10000, '2', 'Pengisian Saldo', '2018-05-23 10:37:19', 40, NULL, NULL),
(13, 40, 10000, '0', 'Pengisian Saldo', '2018-05-23 10:50:32', 40, '2018-05-23 11:00:13', 1),
(14, 40, 20000, '0', 'Pengisian Saldo', '2018-05-23 10:53:26', 40, '2018-05-23 11:00:15', 1),
(15, 40, 25000, '1', 'Melakukan percetakan dengan kode DOK-009', '2018-05-23 11:21:41', 23, NULL, NULL);

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
-- Table structure for table `token_user`
--

CREATE TABLE `token_user` (
  `id` int(11) NOT NULL,
  `id_users` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token_user`
--

INSERT INTO `token_user` (`id`, `id_users`, `token`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 35, 'dIevfmd4puM:APA91bG35Bmb_Iex239BPRF1QPwLj-6Ngoaby5MSb6_J_uYJ3kPjwnKe9_aU3TSHBBh8GEYWwadNcAU2k3Q4bX4eVbQGIAKBh_y0pqofk2ZC1si2VVLzNCtsQ-94Yprz5G4UemT5q3ra', '2018-05-10 11:19:31', 35, NULL, NULL),
(2, 35, 'fsumYkPOgM4:APA91bHlpfcKjligfqGp961GuAg38HvN5ChRXIBl6xiDx0E8Je9Cl0AnW93qVzO3kRITo3J1qimUv9qG4F0BwtEAEWcZjOfGQsonIR7bQDBh39bgcTOybyVx676XiG3T2-WuWpx1kgGl', '2018-05-10 14:23:06', 35, NULL, NULL),
(3, 35, 'e3F9BIk8vcI:APA91bFgecENgjL0FIY7pz9KdWJpSfknizyfq8uLFYsq4-WyMrIXLSN1e0UjKAPmKuzsGV6QT2gRQTvJU6auJwcH5WApNjxA_7sRcAhdvKnY6Ev6bZAFOwtC2xsCXaLc6kOLmaK6ukn5', '2018-05-10 14:23:43', 35, NULL, NULL),
(4, 35, 'e3F9BIk8vcI:APA91bFgecENgjL0FIY7pz9KdWJpSfknizyfq8uLFYsq4-WyMrIXLSN1e0UjKAPmKuzsGV6QT2gRQTvJU6auJwcH5WApNjxA_7sRcAhdvKnY6Ev6bZAFOwtC2xsCXaLc6kOLmaK6ukn5', '2018-05-10 14:26:28', 35, NULL, NULL),
(5, 35, 'e1gWlK10UN8:APA91bF_MhKk15AZEFvF1rGW_r0cyu_WrJLDGAK0KV4uYOczT_CT_hxV_d0BCTyqM781DjpRJsfrzaWr4rlBIoeUAozZkmTHU4jOLcNXdAEegFxYKEm8oxHRaJFHtXE5szQLbeBxZHU1', '2018-05-10 14:34:21', 35, NULL, NULL),
(6, 35, 'cLPDc4bSsn0:APA91bE6P-FsTJo4i3QP98s7nuSpY4_aCstlOBOxEpAR405S7XYzdAiAZofK0nfzr0ucUQM3n1_4K07EA_P2AQvqtpMsFTTANDrl15LDlks8xDlPdU5jRywV5OkaoMwam2tsiW-k_Y3m', '2018-05-10 17:09:11', 35, NULL, NULL),
(7, 35, 'dHjXW7Jxx_c:APA91bEFysoDxXumhUpq3BaWOfQ46eJfx3eZv7VSe6IrHf8W2VxjHccqB64YJegClFy5umpMy9zz5im2MfqoFOcb1CSXEisMW04VKvs8Oo9d9D7UYWzy7R7w982UBKt7g-FVC-c32OSf', '2018-05-10 17:11:10', 35, NULL, NULL);

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
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `group_id`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `alamat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '', 1, 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 0, 1527065677, 1, 'Admin', 'Istrator', 'Admin', '082', 'alamat', NULL, 0, NULL, NULL),
(2, '', 2, 'petugas', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'petugas@petugas.com', NULL, NULL, NULL, NULL, 0, 1521167630, 1, 'Petugas', 'Istrator', 'Petugas', '992', 'alamat', NULL, 0, NULL, NULL),
(12, '::1', 3, 'pelanggan', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'pelanggan@pelanggan.com', NULL, NULL, NULL, NULL, 0, 1526203445, 1, 'Rahmat Ramadhan Putri', 'Istrator', 'Pelanggan', '082146631959', 'perum. rogojampi', NULL, 0, '2018-05-13 11:21:19', 12),
(14, '', 2, 'petugas', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'dokumen@dokumen.com', NULL, NULL, NULL, NULL, 0, 1522488381, 1, 'Pelanggan', 'Istrator', 'Pelanggan', '082', 'alamat', NULL, 0, NULL, NULL),
(18, '::1', 2, NULL, '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'pdimas1@petugas.com', NULL, NULL, NULL, NULL, 0, 1525955608, 1, 'pdimas1', NULL, NULL, '09863', NULL, '2018-04-03 05:22:15', 1, '2018-04-21 10:58:39', 1),
(19, '::1', 2, NULL, '$2y$10$wTsx68wt9ahRiU1Y4Dn2u.6remiEfwVg6U9meXgdoRTur8pzsm7o.', '', 'kanisa@gmail.com', NULL, NULL, NULL, NULL, 0, 1526205015, 1, 'Admin Kanisa Print', NULL, NULL, '234834', NULL, '2018-04-03 05:36:48', 1, '2018-05-05 15:19:19', 1),
(22, '::1', 3, NULL, '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'hendriyanto@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'hendriyanto', NULL, NULL, '0834231', 'lorem', '2018-04-03 06:42:20', 1, NULL, NULL),
(23, '::1', 2, NULL, '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'pdimas2@gmail.com', NULL, NULL, NULL, NULL, 0, 1527066846, 1, 'Dimas Ferian', NULL, NULL, '93453', NULL, '2018-04-21 09:35:46', 1, '2018-04-21 10:58:56', 1),
(24, '::1', 3, NULL, '$2y$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'rahmat@rahmat.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Rahmat', NULL, NULL, '85735030674', 'Rogojampi', '2018-05-05 05:09:16', 1, NULL, NULL),
(25, '::1', 3, NULL, '$2y$10$1QpIECPm20bKOZnstYPF3uTcZ2WIV457xAEAdG.CAichgGQ6g3xwu', '', 'messi@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Lionel Messi', NULL, NULL, '082146631959', 'rogojampi', '2018-05-05 14:27:41', 1, NULL, NULL),
(26, '::1', 3, NULL, '$2y$10$RcrJ/RaOw1N5BsS7nUGc1uw1ZHBSrPx3H6LYJCEBVl1BJ33Qe1gRa', '', 'rahmatramadhan.ti.doliwangi@gmail.com', NULL, NULL, NULL, NULL, 0, 1525536631, 1, 'Rahmat Rdn P.', NULL, NULL, '85735030674', 'Rogojampi', '2018-05-05 14:33:51', 1, '2018-05-05 14:35:09', 26),
(30, '::1', 3, 'angon@gmail.com', '$2y$08$r5jOyRqzpe5ltq3joFxqzu2zC5rCoMwuAdzY/Eczhpm0E1fL4wLd6', '', 'angon@gmail.com', NULL, NULL, NULL, NULL, 1525928738, NULL, 1, 'Rahmat', NULL, NULL, '85735030674', NULL, NULL, 1, NULL, NULL),
(35, '::1', 3, 'rahmatramadhan.ti.poliwangi@gmail.com', '$2y$08$PiXBn9X0O47OQ7Ld7pgQ6u8fHA7RhEVxS7rrA8wb4Y6R6zsdYwiHa', '', 'rahmatramadhan.ti.poliwangi@gmail.com', NULL, NULL, NULL, NULL, 1525932078, 1525965015, 1, 'Rahmat', NULL, NULL, '85735030674', NULL, NULL, 0, NULL, NULL),
(39, '::1', 3, 'hendriyanto12@gmail.com', '$2y$08$DlF4B4.CAWUfihZZnsNIXety2Yv4FaTcNVYrTKhVbXrKZH/dUscEq', '', 'hendriyanto12@gmail.com', '28328f61414767d13f5a9755ce3c128ec23e227a', NULL, NULL, NULL, 1526205753, NULL, 0, 'hendriyanto', NULL, NULL, '123456', NULL, NULL, 0, NULL, NULL),
(40, '::1', 3, 'rahmat@labkode.org', '$2y$08$Zfm3WMWJKq4qmIuAcxFvTuFEch4/JfZiu2l5ErShtiWc79fb7/5JC', '', 'rahmat@labkode.org', 'e372702a2d253f387a3ce6abaf1523c7cfb2e6bd', NULL, NULL, NULL, 1526630214, 1527066033, 1, 'Rahmat', NULL, NULL, '85735030674', NULL, NULL, 0, NULL, NULL),
(41, '::1', 3, 'angon.team@gmail.com', '$2y$08$4Q5fY2YGx5CV/wnz6mgO2er8OHKqFy6JeJMF.9.TlfH8dr07QaRXG', '', 'angon.team@gmail.com', '87e48337263a2c39fbbdc37b1c38e5fbcb8edd82', NULL, NULL, NULL, 1527043352, NULL, 0, 'Rahmat', NULL, NULL, '85735030674', NULL, NULL, 0, NULL, NULL);

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
-- Indexes for table `bukti_transfer`
--
ALTER TABLE `bukti_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_konfirmasi_transfer_saldo_user` (`id_saldo`);

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
-- Indexes for table `saldo_percetakan`
--
ALTER TABLE `saldo_percetakan`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `token_user`
--
ALTER TABLE `token_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__users` (`id_users`);

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
-- AUTO_INCREMENT for table `bukti_transfer`
--
ALTER TABLE `bukti_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pesanan_foto`
--
ALTER TABLE `pesanan_foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `saldo_percetakan`
--
ALTER TABLE `saldo_percetakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `saldo_user`
--
ALTER TABLE `saldo_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sdk`
--
ALTER TABLE `sdk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token_user`
--
ALTER TABLE `token_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukti_transfer`
--
ALTER TABLE `bukti_transfer`
  ADD CONSTRAINT `FK_konfirmasi_transfer_saldo_user` FOREIGN KEY (`id_saldo`) REFERENCES `saldo_user` (`id`);

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

--
-- Constraints for table `token_user`
--
ALTER TABLE `token_user`
  ADD CONSTRAINT `FK__users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
