-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2019 at 04:57 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a162016`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_permohonans`
--

CREATE TABLE IF NOT EXISTS `dokumen_permohonans` (
  `dokumen_permohonan_id` int(10) unsigned NOT NULL,
  `permohonan_id` int(10) unsigned NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `komen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `versi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_permohonans`
--

INSERT INTO `dokumen_permohonans` (`dokumen_permohonan_id`, `permohonan_id`, `file_name`, `file_link`, `file_size`, `komen`, `versi`, `created_at`, `updated_at`) VALUES
(1, 1, 'TUTORIAL 5 A162016.pdf', 'TUTORIAL 5 A162016_1557316526.pdf', 145, NULL, 1, '2019-05-08 11:55:26', '2019-05-08 11:55:26'),
(2, 2, 'TUTORIAL 5 A162016.pdf', 'TUTORIAL 5 A162016_1557317036.pdf', 145, NULL, 1, '2019-05-08 12:03:56', '2019-05-08 12:03:56'),
(3, 10, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 7, '2019-03-03 22:31:33', '2019-05-12 08:53:28'),
(4, 7, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 2, '2016-07-05 22:07:08', '2019-05-12 08:53:28'),
(5, 17, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2018-02-02 02:51:51', '2019-05-12 08:53:28'),
(6, 5, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 3, '2017-01-02 13:35:25', '2019-05-12 08:53:28'),
(7, 8, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 7, '2018-11-27 19:39:22', '2019-05-12 08:53:28'),
(8, 8, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 8, '2017-12-28 07:06:46', '2019-05-12 08:53:28'),
(9, 16, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2016-05-12 23:32:12', '2019-05-12 08:53:28'),
(10, 9, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 3, '2018-08-05 09:24:41', '2019-05-12 08:53:28'),
(11, 31, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2014-07-14 09:01:16', '2019-05-12 08:53:28'),
(12, 30, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 5, '2016-07-09 14:44:20', '2019-05-12 08:53:28'),
(13, 11, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 5, '2015-09-19 14:40:16', '2019-05-12 08:53:28'),
(14, 25, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 3, '2019-04-27 04:50:01', '2019-05-12 08:53:28'),
(15, 3, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 3, '2015-10-29 00:00:29', '2019-05-12 08:53:28'),
(16, 3, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2014-08-11 15:29:23', '2019-05-12 08:53:28'),
(17, 23, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2015-12-14 03:10:57', '2019-05-12 08:53:28'),
(18, 25, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2015-09-11 23:55:28', '2019-05-12 08:53:28'),
(19, 27, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2017-05-05 17:21:21', '2019-05-12 08:53:28'),
(20, 13, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2014-06-22 12:42:35', '2019-05-12 08:53:28'),
(21, 2, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2018-12-05 03:01:06', '2019-05-12 08:53:28'),
(22, 6, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 5, '2018-10-26 22:44:29', '2019-05-12 08:53:28'),
(23, 12, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2017-02-01 09:38:53', '2019-05-12 08:53:28'),
(24, 24, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2014-12-20 08:02:35', '2019-05-12 08:53:28'),
(25, 11, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2018-08-28 16:04:09', '2019-05-12 08:53:28'),
(26, 23, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2017-10-04 20:36:14', '2019-05-12 08:53:28'),
(27, 20, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2015-06-14 21:13:55', '2019-05-12 08:53:28'),
(28, 14, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2017-04-01 05:53:21', '2019-05-12 08:53:28'),
(29, 11, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 2, '2016-12-12 16:13:32', '2019-05-12 08:53:28'),
(30, 12, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2014-08-10 16:49:17', '2019-05-12 08:53:28'),
(31, 11, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2014-11-13 00:58:30', '2019-05-12 08:53:28'),
(32, 10, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2014-12-09 00:04:23', '2019-05-12 08:53:28'),
(33, 9, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 5, '2017-08-31 01:45:48', '2019-05-12 08:53:28'),
(34, 12, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2016-07-13 01:19:43', '2019-05-12 08:53:28'),
(35, 24, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 2, '2016-11-14 12:24:12', '2019-05-12 08:53:28'),
(36, 10, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2015-10-31 19:25:50', '2019-05-12 08:53:28'),
(37, 17, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 5, '2018-03-06 05:19:42', '2019-05-12 08:53:28'),
(38, 2, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 2, '2017-08-20 03:48:52', '2019-05-12 08:53:28'),
(39, 24, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2016-06-30 06:17:00', '2019-05-12 08:53:28'),
(40, 6, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 8, '2016-07-18 15:06:34', '2019-05-12 08:53:28'),
(41, 12, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 5, '2019-02-19 18:07:57', '2019-05-12 08:53:28'),
(42, 18, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2017-04-09 18:46:17', '2019-05-12 08:53:28'),
(43, 12, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 8, '2014-09-10 05:49:39', '2019-05-12 08:53:28'),
(44, 1, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2015-12-10 23:27:16', '2019-05-12 08:53:28'),
(45, 15, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 3, '2017-04-26 05:22:22', '2019-05-12 08:53:28'),
(46, 28, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2014-07-18 05:25:05', '2019-05-12 08:53:28'),
(47, 16, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2015-07-12 19:17:51', '2019-05-12 08:53:28'),
(48, 29, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2017-09-11 05:19:49', '2019-05-12 08:53:28'),
(49, 7, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 4, '2016-01-25 04:32:18', '2019-05-12 08:53:28'),
(50, 32, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 7, '2017-02-28 21:40:39', '2019-05-12 08:53:28'),
(51, 10, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 2, '2015-09-06 23:00:35', '2019-05-12 08:53:28'),
(52, 22, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2016-11-23 12:33:29', '2019-05-12 08:53:28'),
(53, 7, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 8, '2018-12-31 05:39:52', '2019-05-12 08:53:28'),
(54, 32, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2017-11-16 13:27:29', '2019-05-12 08:53:28'),
(55, 11, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 6, '2018-11-23 09:10:13', '2019-05-12 08:53:28'),
(56, 7, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2017-06-02 22:04:55', '2019-05-12 08:53:28'),
(57, 30, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 2, '2018-05-19 23:54:53', '2019-05-12 08:53:28'),
(58, 13, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 5, '2017-02-08 02:45:21', '2019-05-12 08:53:28'),
(59, 25, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 1, '2017-03-27 00:02:48', '2019-05-12 08:53:28'),
(60, 28, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 3, '2017-10-31 11:34:20', '2019-05-12 08:53:28'),
(61, 16, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 3, '2016-06-07 17:00:49', '2019-05-12 08:53:28'),
(62, 22, 'permohonan.pdf', 'permohonan45634.pdf', 123, NULL, 2, '2017-09-16 02:32:06', '2019-05-12 08:53:28'),
(63, 33, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558802101.pdf', 124, NULL, 1, '2019-05-25 16:35:01', '2019-05-25 16:35:01'),
(64, 34, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558802507.pdf', 124, NULL, 1, '2019-05-25 16:41:47', '2019-05-25 16:41:47'),
(65, 35, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558803307.pdf', 124, NULL, 1, '2019-05-25 16:55:07', '2019-05-25 16:55:07'),
(66, 36, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558803387.pdf', 124, NULL, 1, '2019-05-25 16:56:27', '2019-05-25 16:56:27'),
(67, 37, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558803441.pdf', 124, NULL, 1, '2019-05-25 16:57:21', '2019-05-25 16:57:21'),
(68, 38, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558803780.pdf', 124, NULL, 1, '2019-05-25 17:03:00', '2019-05-25 17:03:00'),
(69, 39, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558803863.pdf', 124, NULL, 1, '2019-05-25 17:04:23', '2019-05-25 17:04:23'),
(70, 40, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558803894.pdf', 124, NULL, 1, '2019-05-25 17:04:54', '2019-05-25 17:04:54'),
(71, 41, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558803910.pdf', 124, NULL, 1, '2019-05-25 17:05:10', '2019-05-25 17:05:10'),
(72, 42, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558804036.pdf', 124, NULL, 1, '2019-05-25 17:07:16', '2019-05-25 17:07:16'),
(73, 43, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558804094.pdf', 124, NULL, 1, '2019-05-25 17:08:14', '2019-05-25 17:08:14'),
(74, 44, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558804198.pdf', 124, NULL, 1, '2019-05-25 17:09:58', '2019-05-25 17:09:58'),
(75, 45, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558847681.pdf', 124, NULL, 1, '2019-05-26 05:14:41', '2019-05-26 05:14:41'),
(76, 46, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558847790.pdf', 124, NULL, 1, '2019-05-26 05:16:30', '2019-05-26 05:16:30'),
(77, 47, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558858207.pdf', 124, NULL, 1, '2019-05-26 08:10:07', '2019-05-26 08:10:07'),
(78, 48, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558880162.pdf', 124, NULL, 1, '2019-05-26 14:16:02', '2019-05-26 14:16:02'),
(79, 49, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558880247.pdf', 124, NULL, 1, '2019-05-26 14:17:28', '2019-05-26 14:17:28'),
(80, 50, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558880300.pdf', 124, NULL, 1, '2019-05-26 14:18:20', '2019-05-26 14:18:20'),
(81, 51, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558880369.pdf', 124, NULL, 1, '2019-05-26 14:19:29', '2019-05-26 14:19:29'),
(82, 52, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558880389.pdf', 124, NULL, 1, '2019-05-26 14:19:49', '2019-05-26 14:19:49'),
(83, 53, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558959021.pdf', 124, NULL, 1, '2019-05-27 12:10:21', '2019-05-27 12:10:21'),
(84, 54, 'akademik.pdf', 'akademik_1561548567.pdf', 48, NULL, 1, '2019-06-26 11:29:27', '2019-06-26 11:29:27'),
(85, 55, 'akademik.pdf', 'akademik_1561548599.pdf', 48, NULL, 1, '2019-06-26 11:29:59', '2019-06-26 11:29:59'),
(86, 56, 'akademik.pdf', 'akademik_1561548762.pdf', 48, NULL, 1, '2019-06-26 11:32:42', '2019-06-26 11:32:42'),
(87, 57, 'akademik.pdf', 'akademik_1561549547.pdf', 48, NULL, 1, '2019-06-26 11:45:47', '2019-06-26 11:45:47'),
(88, 58, 'akademik.pdf', 'akademik_1561549915.pdf', 48, NULL, 1, '2019-06-26 11:51:55', '2019-06-26 11:51:55'),
(89, 59, 'akademik.pdf', 'akademik_1561551294.pdf', 48, NULL, 1, '2019-06-26 12:14:54', '2019-06-26 12:14:54'),
(90, 60, '7thSeptember.pdf', '7thSeptember_1561551333.pdf', 61, NULL, 1, '2019-06-26 12:15:33', '2019-06-26 12:15:33'),
(91, 61, 'akademik.pdf', 'akademik_1561551382.pdf', 48, NULL, 1, '2019-06-26 12:16:22', '2019-06-26 12:16:22'),
(92, 62, 'akademik.pdf', 'akademik_1561551447.pdf', 48, NULL, 1, '2019-06-26 12:17:27', '2019-06-26 12:17:27'),
(93, 63, 'akademik.pdf', 'akademik_1561551702.pdf', 48, NULL, 1, '2019-06-26 12:21:42', '2019-06-26 12:21:42'),
(94, 64, 'akademik.pdf', 'akademik_1561551920.pdf', 48, NULL, 1, '2019-06-26 12:25:20', '2019-06-26 12:25:20'),
(95, 65, 'akademik.pdf', 'akademik_1561551931.pdf', 48, NULL, 1, '2019-06-26 12:25:31', '2019-06-26 12:25:31'),
(96, 66, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1561917824.pdf', 124, NULL, 1, '2019-06-30 18:03:45', '2019-06-30 18:03:45'),
(97, 66, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1561917892.pdf', 124, NULL, 2, '2019-06-30 18:04:52', '2019-06-30 18:04:52'),
(98, 66, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1561918510.pdf', 124, NULL, 3, '2019-06-30 18:15:10', '2019-06-30 18:15:10'),
(99, 67, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1562001342.pdf', 124, NULL, 1, '2019-07-01 17:15:42', '2019-07-01 17:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `fakultis`
--

CREATE TABLE IF NOT EXISTS `fakultis` (
  `fakulti_id` int(10) unsigned NOT NULL,
  `f_nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fnama_kod` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultis`
--

INSERT INTO `fakultis` (`fakulti_id`, `f_nama`, `fnama_kod`, `created_at`, `updated_at`) VALUES
(1, 'Fakulti Sains Sosial dan Kemanusiaan', 'FSSK', NULL, NULL),
(2, 'Fakulti Sains dan Teknologi', 'FST', NULL, NULL),
(3, 'Fakulti Ekonomi dan Pengurusan', 'FEP', NULL, NULL),
(4, 'Fakulti Farmasi', 'FARMASI', NULL, NULL),
(5, 'Fakulti Pengajian Islam', 'FPI', NULL, NULL),
(6, 'Fakulti Sains Kesihatan', 'FSK', NULL, NULL),
(7, 'Fakulti Kejuruteraan dan Alam Bina', 'FKAB', NULL, NULL),
(8, 'Fakulti Undang-Undang', 'FUU', NULL, NULL),
(9, 'Fakulti Pergigian', 'FPERG', NULL, NULL),
(10, 'Fakulti Pendidikan', 'FPEND', NULL, NULL),
(11, 'Fakulti Perubatan', 'FPER', NULL, NULL),
(12, 'Fakulti Teknologi dan Sains Maklumat', 'FTSM', NULL, NULL),
(13, 'UKM-GSB Pusat Pengajian Siswazah Perniagaan', 'GSB', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_permohonans`
--

CREATE TABLE IF NOT EXISTS `jenis_permohonans` (
  `id` int(10) unsigned NOT NULL,
  `jenis_permohonan_kod` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_permohonan_huraian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_permohonans`
--

INSERT INTO `jenis_permohonans` (`id`, `jenis_permohonan_kod`, `jenis_permohonan_huraian`, `created_at`, `updated_at`) VALUES
(1, 'program_baharu', 'Program Pengajian Baharu', NULL, NULL),
(2, 'semakan_program', 'Semakan Program Pengajian', NULL, NULL),
(3, 'kursus_teras_baharu', 'Kursus Teras Baharu', NULL, NULL),
(4, 'kursus_elektif_baharu', 'Kursus Elektif Baharu', NULL, NULL),
(5, 'semakan_kursus_teras', 'Semakan Kursus Teras', NULL, NULL),
(6, 'semakan_kursus_elektif', 'Semakan Kursus Elektif', NULL, NULL),
(7, 'akreditasi_penuh', 'Akreditasi Penuh/Audit Pemantauan', NULL, NULL),
(8, 'penjumudan_program', 'Penjumudan Program Pengajian', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kemajuan_permohonans`
--

CREATE TABLE IF NOT EXISTS `kemajuan_permohonans` (
  `id` int(10) unsigned NOT NULL,
  `permohonan_id` int(10) unsigned NOT NULL,
  `status_permohonan` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kemajuan_permohonans`
--

INSERT INTO `kemajuan_permohonans` (`id`, `permohonan_id`, `status_permohonan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-05-08 11:55:26', '2019-05-08 11:55:26'),
(2, 2, 1, '2019-05-08 12:03:56', '2019-05-08 12:03:56'),
(3, 2, 9, '2019-05-17 06:44:41', '2019-05-17 06:44:41'),
(4, 33, 1, '2019-05-25 16:35:01', '2019-05-25 16:35:01'),
(5, 34, 1, '2019-05-25 16:41:47', '2019-05-25 16:41:47'),
(6, 35, 1, '2019-05-25 16:55:07', '2019-05-25 16:55:07'),
(7, 36, 1, '2019-05-25 16:56:27', '2019-05-25 16:56:27'),
(8, 37, 1, '2019-05-25 16:57:21', '2019-05-25 16:57:21'),
(9, 38, 1, '2019-05-25 17:03:00', '2019-05-25 17:03:00'),
(10, 39, 1, '2019-05-25 17:04:23', '2019-05-25 17:04:23'),
(11, 40, 1, '2019-05-25 17:04:54', '2019-05-25 17:04:54'),
(12, 41, 1, '2019-05-25 17:05:10', '2019-05-25 17:05:10'),
(13, 42, 1, '2019-05-25 17:07:16', '2019-05-25 17:07:16'),
(14, 43, 1, '2019-05-25 17:08:14', '2019-05-25 17:08:14'),
(15, 44, 1, '2019-05-25 17:09:58', '2019-05-25 17:09:58'),
(16, 45, 1, '2019-05-26 05:14:41', '2019-05-26 05:14:41'),
(17, 46, 1, '2019-05-26 05:16:30', '2019-05-26 05:16:30'),
(18, 47, 1, '2019-05-26 08:10:07', '2019-05-26 08:10:07'),
(19, 48, 1, '2019-05-26 14:16:02', '2019-05-26 14:16:02'),
(20, 49, 1, '2019-05-26 14:17:28', '2019-05-26 14:17:28'),
(21, 50, 1, '2019-05-26 14:18:20', '2019-05-26 14:18:20'),
(22, 51, 1, '2019-05-26 14:19:29', '2019-05-26 14:19:29'),
(23, 52, 1, '2019-05-26 14:19:49', '2019-05-26 14:19:49'),
(24, 52, 2, '2019-05-26 14:56:31', '2019-05-26 14:56:31'),
(25, 52, 2, '2019-05-26 14:57:07', '2019-05-26 14:57:07'),
(26, 52, 2, '2019-05-26 14:57:40', '2019-05-26 14:57:40'),
(27, 52, 2, '2019-05-26 15:03:39', '2019-05-26 15:03:39'),
(28, 52, 2, '2019-05-26 15:04:21', '2019-05-26 15:04:21'),
(29, 52, 2, '2019-05-26 15:05:05', '2019-05-26 15:05:05'),
(30, 52, 2, '2019-05-26 15:05:13', '2019-05-26 15:05:13'),
(31, 52, 2, '2019-05-26 15:05:47', '2019-05-26 15:05:47'),
(32, 1, 2, '2019-05-27 11:09:25', '2019-05-27 11:09:25'),
(33, 1, 3, '2019-05-27 11:13:15', '2019-05-27 11:13:15'),
(34, 53, 1, '2019-05-27 12:10:21', '2019-05-27 12:10:21'),
(35, 53, 2, '2019-05-27 12:23:30', '2019-05-27 12:23:30'),
(36, 53, 3, '2019-05-27 12:27:10', '2019-05-27 12:27:10'),
(37, 53, 4, '2019-05-27 12:34:57', '2019-05-27 12:34:57'),
(38, 53, 5, '2019-05-27 12:38:49', '2019-05-27 12:38:49'),
(39, 53, 5, '2019-05-27 12:40:22', '2019-05-27 12:40:22'),
(40, 53, 5, '2019-05-27 12:45:29', '2019-05-27 12:45:29'),
(41, 53, 5, '2019-05-27 12:51:02', '2019-05-27 12:51:02'),
(42, 33, 2, '2019-06-26 10:17:30', '2019-06-26 10:17:30'),
(43, 33, 2, '2019-06-26 10:17:46', '2019-06-26 10:17:46'),
(44, 35, 2, '2019-06-26 10:20:06', '2019-06-26 10:20:06'),
(45, 35, 2, '2019-06-26 10:21:09', '2019-06-26 10:21:09'),
(46, 35, 2, '2019-06-26 10:24:16', '2019-06-26 10:24:16'),
(47, 35, 2, '2019-06-26 10:24:51', '2019-06-26 10:24:51'),
(48, 35, 2, '2019-06-26 10:25:19', '2019-06-26 10:25:19'),
(49, 35, 2, '2019-06-26 10:25:31', '2019-06-26 10:25:31'),
(50, 35, 2, '2019-06-26 10:26:21', '2019-06-26 10:26:21'),
(51, 35, 2, '2019-06-26 10:26:35', '2019-06-26 10:26:35'),
(52, 35, 2, '2019-06-26 10:26:50', '2019-06-26 10:26:50'),
(53, 35, 2, '2019-06-26 10:30:43', '2019-06-26 10:30:43'),
(54, 35, 2, '2019-06-26 10:33:56', '2019-06-26 10:33:56'),
(55, 35, 2, '2019-06-26 10:41:32', '2019-06-26 10:41:32'),
(56, 35, 2, '2019-06-26 10:43:00', '2019-06-26 10:43:00'),
(57, 35, 2, '2019-06-26 10:48:17', '2019-06-26 10:48:17'),
(58, 35, 2, '2019-06-26 11:28:24', '2019-06-26 11:28:24'),
(59, 54, 1, '2019-06-26 11:29:27', '2019-06-26 11:29:27'),
(60, 55, 1, '2019-06-26 11:29:59', '2019-06-26 11:29:59'),
(61, 56, 1, '2019-06-26 11:32:42', '2019-06-26 11:32:42'),
(62, 57, 1, '2019-06-26 11:45:47', '2019-06-26 11:45:47'),
(63, 58, 1, '2019-06-26 11:51:55', '2019-06-26 11:51:55'),
(64, 59, 1, '2019-06-26 12:14:54', '2019-06-26 12:14:54'),
(65, 60, 1, '2019-06-26 12:15:33', '2019-06-26 12:15:33'),
(66, 61, 1, '2019-06-26 12:16:22', '2019-06-26 12:16:22'),
(67, 62, 1, '2019-06-26 12:17:27', '2019-06-26 12:17:27'),
(68, 63, 1, '2019-06-26 12:21:42', '2019-06-26 12:21:42'),
(69, 64, 1, '2019-06-26 12:25:20', '2019-06-26 12:25:20'),
(70, 65, 1, '2019-06-26 12:25:31', '2019-06-26 12:25:31'),
(71, 34, 2, '2019-06-26 15:20:42', '2019-06-26 15:20:42'),
(72, 34, 3, '2019-06-26 16:19:51', '2019-06-26 16:19:51'),
(73, 34, 4, '2019-06-26 16:56:39', '2019-06-26 16:56:39'),
(74, 66, 1, '2019-06-30 18:03:45', '2019-06-30 18:03:45'),
(75, 66, 9, '2019-06-30 18:04:21', '2019-06-30 18:04:21'),
(76, 66, 13, '2019-06-30 18:04:52', '2019-06-30 18:04:52'),
(77, 66, 9, '2019-06-30 18:14:11', '2019-06-30 18:14:11'),
(78, 66, 13, '2019-06-30 18:15:10', '2019-06-30 18:15:10'),
(79, 67, 1, '2019-07-01 17:15:42', '2019-07-01 17:15:42'),
(80, 67, 2, '2019-07-01 17:16:50', '2019-07-01 17:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE IF NOT EXISTS `laporans` (
  `laporan_id` int(10) unsigned NOT NULL,
  `dokumen_permohonan_id` int(10) unsigned NOT NULL,
  `id_penghantar` int(10) unsigned NOT NULL,
  `tajuk_fail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tajuk_fail_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `versi_laporan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`laporan_id`, `dokumen_permohonan_id`, `id_penghantar`, `tajuk_fail`, `tajuk_fail_link`, `komen`, `versi_laporan`, `created_at`, `updated_at`) VALUES
(1, 21, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558075481.pdf', NULL, 1, '2019-05-17 06:44:41', '2019-05-17 06:44:41'),
(2, 44, 3, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558955539.pdf', NULL, 1, '2019-05-27 11:12:19', '2019-05-27 11:12:19'),
(3, 44, 3, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558955564.pdf', NULL, 1, '2019-05-27 11:12:44', '2019-05-27 11:12:44'),
(4, 44, 3, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558955589.pdf', NULL, 1, '2019-05-27 11:13:09', '2019-05-27 11:13:09'),
(5, 44, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558958013.pdf', NULL, 1, '2019-05-27 11:53:33', '2019-05-27 11:53:33'),
(6, 44, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558958033.pdf', NULL, 1, '2019-05-27 11:53:53', '2019-05-27 11:53:53'),
(7, 44, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558958054.pdf', NULL, 1, '2019-05-27 11:54:14', '2019-05-27 11:54:14'),
(8, 44, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558958080.pdf', NULL, 1, '2019-05-27 11:54:40', '2019-05-27 11:54:40'),
(9, 44, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558958103.pdf', NULL, 1, '2019-05-27 11:55:03', '2019-05-27 11:55:03'),
(10, 44, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558958208.pdf', NULL, 1, '2019-05-27 11:56:48', '2019-05-27 11:56:48'),
(11, 83, 3, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960024.pdf', NULL, 1, '2019-05-27 12:27:04', '2019-05-27 12:27:04'),
(12, 83, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960370.pdf', NULL, 1, '2019-05-27 12:32:50', '2019-05-27 12:32:50'),
(13, 83, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960491.pdf', NULL, 2, '2019-05-27 12:34:51', '2019-05-27 12:34:51'),
(14, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960729.pdf', NULL, 1, '2019-05-27 12:38:49', '2019-05-27 12:38:49'),
(15, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960822.pdf', NULL, 2, '2019-05-27 12:40:22', '2019-05-27 12:40:22'),
(16, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960863.pdf', NULL, 3, '2019-05-27 12:41:03', '2019-05-27 12:41:03'),
(17, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960933.pdf', NULL, 4, '2019-05-27 12:42:13', '2019-05-27 12:42:13'),
(18, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960942.pdf', NULL, 5, '2019-05-27 12:42:22', '2019-05-27 12:42:22'),
(19, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960955.pdf', NULL, 6, '2019-05-27 12:42:35', '2019-05-27 12:42:35'),
(20, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558960992.pdf', NULL, 7, '2019-05-27 12:43:12', '2019-05-27 12:43:12'),
(21, 83, 5, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558961123.pdf', NULL, 8, '2019-05-27 12:45:23', '2019-05-27 12:45:23'),
(22, 83, 15, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1558961456.pdf', NULL, 1, '2019-05-27 12:50:56', '2019-05-27 12:50:56'),
(23, 64, 3, 'akademik.pdf', 'akademik_1561565986.pdf', NULL, 1, '2019-06-26 16:19:46', '2019-06-26 16:19:46'),
(24, 64, 2, 'akademik.pdf', 'akademik_1561568194.pdf', NULL, 1, '2019-06-26 16:56:34', '2019-06-26 16:56:34'),
(25, 96, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1561917861.pdf', NULL, 1, '2019-06-30 18:04:21', '2019-06-30 18:04:21'),
(26, 97, 2, 'Agile Gantt chart1.pdf', 'Agile Gantt chart1_1561918450.pdf', NULL, 2, '2019-06-30 18:14:11', '2019-06-30 18:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_20_223422_create_jenis_permohonans_table', 1),
(19, '2019_02_13_144136_create_status_permohonans_table', 8),
(28, '2019_01_24_225806_create_kemajuan_permohonans_table', 9),
(48, '2018_10_21_142158_create_permohonans_table', 15),
(49, '2019_03_23_173450_create_dokumen_permohonans_table', 15),
(52, '2019_01_30_235401_create_laporans_table', 16),
(54, '2019_04_29_201414_create_fakultis_table', 17),
(58, '2014_10_12_000000_create_users_table', 18),
(59, '2019_04_30_183007_add_fakulti_id_to_users', 18),
(61, '2019_05_26_110526_create_notifications_table', 19),
(63, '2019_06_26_102331_create_penilaian_panels_table', 21),
(64, '2019_05_26_212304_create_tetapan_aliran_kerjas_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notifications_id` int(10) unsigned NOT NULL,
  `notificationDetails` int(10) unsigned NOT NULL,
  `notificationLocation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userFired` int(10) unsigned NOT NULL,
  `userToNotify` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notifications_id`, `notificationDetails`, `notificationLocation`, `userFired`, `userToNotify`, `created_at`, `updated_at`) VALUES
(1, 16, 'senaraiPermohonanBaharu', 1, 2, '2019-05-26 05:16:30', '2019-05-26 05:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_panels`
--

CREATE TABLE IF NOT EXISTS `penilaian_panels` (
  `penilaian_id` int(10) unsigned NOT NULL,
  `permohonanID` int(10) unsigned NOT NULL,
  `id_pelantik` int(10) unsigned NOT NULL,
  `id_penilai` int(10) unsigned NOT NULL,
  `tarikhAkhir` datetime NOT NULL,
  `tempoh` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian_panels`
--

INSERT INTO `penilaian_panels` (`penilaian_id`, `permohonanID`, `id_pelantik`, `id_penilai`, `tarikhAkhir`, `tempoh`, `created_at`, `updated_at`) VALUES
(1, 34, 2, 3, '2019-10-01 12:00:00', 96, '2019-06-26 15:20:45', '2019-06-26 15:20:45'),
(2, 67, 2, 3, '2018-12-31 12:00:00', 182, '2019-07-01 17:16:50', '2019-07-01 17:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `permohonans`
--

CREATE TABLE IF NOT EXISTS `permohonans` (
  `permohonan_id` int(10) unsigned NOT NULL,
  `doc_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_permohonan_id` int(10) unsigned NOT NULL,
  `id_penghantar` int(10) unsigned NOT NULL,
  `status_permohonan_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonans`
--

INSERT INTO `permohonans` (`permohonan_id`, `doc_title`, `jenis_permohonan_id`, `id_penghantar`, `status_permohonan_id`, `created_at`, `updated_at`) VALUES
(1, 'Sarjana Muda A', 1, 1, 4, '2019-05-08 11:55:26', '2019-05-27 11:53:33'),
(2, 'Sarjana Muda A', 2, 1, 9, '2019-05-08 12:03:56', '2019-05-17 06:44:41'),
(3, 'permohonan.pdf', 6, 6, 4, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(4, 'permohonan.pdf', 4, 6, 6, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(5, 'permohonan.pdf', 2, 6, 4, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(6, 'permohonan.pdf', 7, 7, 10, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(7, 'permohonan.pdf', 6, 6, 10, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(8, 'permohonan.pdf', 7, 1, 15, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(9, 'permohonan.pdf', 5, 1, 2, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(10, 'permohonan.pdf', 2, 1, 7, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(11, 'permohonan.pdf', 1, 7, 3, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(12, 'permohonan.pdf', 4, 1, 11, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(13, 'permohonan.pdf', 4, 7, 14, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(14, 'permohonan.pdf', 5, 6, 2, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(15, 'permohonan.pdf', 3, 6, 1, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(16, 'permohonan.pdf', 1, 7, 7, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(17, 'permohonan.pdf', 3, 7, 12, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(18, 'permohonan.pdf', 5, 1, 12, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(19, 'permohonan.pdf', 5, 6, 5, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(20, 'permohonan.pdf', 4, 1, 11, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(21, 'permohonan.pdf', 1, 1, 13, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(22, 'permohonan.pdf', 7, 1, 2, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(23, 'permohonan.pdf', 2, 7, 4, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(24, 'permohonan.pdf', 2, 1, 9, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(25, 'permohonan.pdf', 8, 7, 15, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(26, 'permohonan.pdf', 2, 6, 7, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(27, 'permohonan.pdf', 5, 6, 3, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(28, 'permohonan.pdf', 4, 6, 14, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(29, 'permohonan.pdf', 8, 7, 11, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(30, 'permohonan.pdf', 8, 1, 5, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(31, 'permohonan.pdf', 2, 1, 14, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(32, 'permohonan.pdf', 8, 1, 14, '2019-05-12 08:41:16', '2019-05-12 08:41:16'),
(33, 'Sarjana Muda A', 1, 1, 2, '2019-05-25 16:35:01', '2019-06-26 10:17:30'),
(34, 'Sarjana Muda A', 1, 1, 4, '2019-05-25 16:41:47', '2019-06-26 16:56:34'),
(35, 'Sarjana Muda A', 1, 1, 2, '2019-05-25 16:55:07', '2019-06-26 10:20:06'),
(36, 'A', 1, 1, 1, '2019-05-25 16:56:27', '2019-05-25 16:56:27'),
(37, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 16:57:21', '2019-05-25 16:57:21'),
(38, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 17:03:00', '2019-05-25 17:03:00'),
(39, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 17:04:23', '2019-05-25 17:04:23'),
(40, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 17:04:54', '2019-05-25 17:04:54'),
(41, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 17:05:10', '2019-05-25 17:05:10'),
(42, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 17:07:16', '2019-05-25 17:07:16'),
(43, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 17:08:14', '2019-05-25 17:08:14'),
(44, 'Sarjana Muda A', 1, 1, 1, '2019-05-25 17:09:58', '2019-05-25 17:09:58'),
(45, 'Sarjana Muda A', 1, 1, 1, '2019-05-26 05:14:41', '2019-05-26 05:14:41'),
(46, 'Sarjana Muda A', 1, 1, 1, '2019-05-26 05:16:30', '2019-05-26 05:16:30'),
(47, 'Sarjana Muda A', 1, 1, 1, '2019-05-26 08:10:07', '2019-05-26 08:10:07'),
(48, 'Sarjana Muda A', 1, 1, 1, '2019-05-26 14:16:02', '2019-05-26 14:16:02'),
(49, 'Sarjana Muda A', 1, 1, 1, '2019-05-26 14:17:28', '2019-05-26 14:17:28'),
(50, 'Sarjana Muda A', 1, 1, 1, '2019-05-26 14:18:20', '2019-05-26 14:18:20'),
(51, 'Sarjana Muda A', 1, 1, 1, '2019-05-26 14:19:29', '2019-05-26 14:19:29'),
(52, 'Sarjana Muda A', 1, 1, 2, '2019-05-26 14:19:49', '2019-05-26 14:56:31'),
(53, 'Sarjana Muda A', 1, 1, 5, '2019-05-27 12:10:21', '2019-05-27 12:38:49'),
(54, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 11:29:27', '2019-06-26 11:29:27'),
(55, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 11:29:59', '2019-06-26 11:29:59'),
(56, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 11:32:42', '2019-06-26 11:32:42'),
(57, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 11:45:47', '2019-06-26 11:45:47'),
(58, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 11:51:55', '2019-06-26 11:51:55'),
(59, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 12:14:54', '2019-06-26 12:14:54'),
(60, 'Sarjana Muda', 1, 1, 1, '2019-06-26 12:15:33', '2019-06-26 12:15:33'),
(61, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 12:16:22', '2019-06-26 12:16:22'),
(62, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 12:17:27', '2019-06-26 12:17:27'),
(63, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 12:21:42', '2019-06-26 12:21:42'),
(64, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 12:25:20', '2019-06-26 12:25:20'),
(65, 'Sarjana Muda A', 1, 1, 1, '2019-06-26 12:25:31', '2019-06-26 12:25:31'),
(66, 'Sarjana Muda A', 1, 1, 13, '2019-06-30 18:03:45', '2019-06-30 18:15:10'),
(67, 'Sarjana Muda A', 1, 1, 2, '2019-07-01 17:15:42', '2019-07-01 17:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `status_permohonans`
--

CREATE TABLE IF NOT EXISTS `status_permohonans` (
  `status_id` int(10) unsigned NOT NULL,
  `status_permohonan_huraian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_permohonans`
--

INSERT INTO `status_permohonans` (`status_id`, `status_permohonan_huraian`, `created_at`, `updated_at`) VALUES
(1, 'Belum disemak ', NULL, NULL),
(2, 'Diluluskan oleh PJK, permohonan akan disemak oleh panel penilai', NULL, NULL),
(3, 'Diluluskan oleh panel penilai', NULL, NULL),
(4, 'Perakuan PJK telah dimuat naik, permohonan akan disemak oleh JPPA', NULL, NULL),
(5, 'Diluluskan oleh JPPA, permohonan akan disemak oleh pihak Senat', NULL, NULL),
(6, 'Diluluskan oleh Senat, permohonan telah diluluskan sepenuhnya', NULL, NULL),
(7, 'Perakuan PJK telah dimuat naik, permohonan diluluskan sepenuhnya ', NULL, NULL),
(8, 'Perlu penambahbaikkan (Panel Penilai)', NULL, NULL),
(9, 'Perlu penambahbaikkan (PJK)', NULL, NULL),
(10, 'Perlu penambahbaikkan (JPPA)', NULL, NULL),
(11, 'Perlu penambahbaikkan (Senat)', NULL, NULL),
(12, 'Dokumen penambahbaikkan telah dimuat naik (Panel Penilai)', NULL, NULL),
(13, 'Dokumen penambahbaikkan telah dimuat naik (PJK)', NULL, NULL),
(14, 'Dokumen penambahbaikkan telah dimuat naik (JPPA)', NULL, NULL),
(15, 'Dokumen penambahbaikkan telah dimuat naik (Senat)', NULL, NULL),
(16, 'Permohonan baharu untuk disemak', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tetapan_aliran_kerjas`
--

CREATE TABLE IF NOT EXISTS `tetapan_aliran_kerjas` (
  `tetapan_id` int(10) unsigned NOT NULL,
  `id_pjk` int(10) unsigned NOT NULL,
  `id_jppa` int(10) unsigned NOT NULL,
  `id_senat` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tetapan_aliran_kerjas`
--

INSERT INTO `tetapan_aliran_kerjas` (`tetapan_id`, `id_pjk`, `id_jppa`, `id_senat`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fakulti_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `fakulti_id`) VALUES
(1, 'Siti', 'fakulti', 'fakulti@gmail.com', NULL, '$2y$10$lEWIaBxks3MDljNXvuTSNe9NV40m6GC7gfGOP/h71t9abM03Ybqk2', 'EKHBEqkbH1AbHle3TBQ9QXueEX0p1C7N0ET9MpQlMUk7YYuayeerwT2AKBnb', '2019-04-30 10:53:41', '2019-05-12 13:52:03', 1),
(2, 'Dalbir Singh', 'pjk', 'dalbir@gmail.com', NULL, '$2y$10$XJH2EzccTNY6qLTLlIUq0O4M0Q1cxkXNqpRXB28q28THN8l5UrG0S', 'zlxxyxAOyNnGjfTsIWf1tJvJRdsYEtvSfa0JyqDOWWDSOL1lew6XdZcoCzCi', '2019-04-30 10:56:33', '2019-05-15 15:20:59', NULL),
(3, 'Penilai 1', 'penilai', 'penilai1@gmail.com', NULL, '$2y$10$L9sVV4yXaG8YBzdJ7oY22umwij1a3mOSB2ACU8DA6muKTL4nQw3Hq', 'GocJxPubiFrzDJ5Ha2Cc3q5MZcD1rY8tDNHWztqj14Xv0BRONbLWsyfmm5ZP', '2019-04-30 10:56:47', '2019-04-30 10:56:47', NULL),
(4, 'Penilai 2', 'penilai', 'penilai2@gmail.com', NULL, '$2y$10$Ze8r4yIMtTYOu2nG3XIKieeSRG6AqVD3qOe2WdqA5d3q/eBaOCnDO', NULL, '2019-04-30 10:57:00', '2019-04-30 10:57:00', NULL),
(5, 'JPPA', 'jppa', 'jppa@gmail.com', NULL, '$2y$10$vsxH6ubYeuoj0wsNgGVxLero34tpWq0WiwrLZ8SKm06utVTdxTDqq', 'EKeVxq5cKMLXbCHnrFEXLd02pJvkyk27qz3VxCFn8Vvtd84EGvNXl7w43Lka', '2019-04-30 10:57:15', '2019-04-30 10:57:15', NULL),
(6, 'Fakulti 2', 'fakulti', 'fakulti2@gmail.com', NULL, '$2y$10$fX23ZJEZKeBA6hJ.jjFwBe04HzHBpCpWDROqi3nyLcVOM7nfcvwPG', 'Pf3Qd0SnPxNk9sWPNnd1K57j5LHgHheQd4P8CVJtCHSTFigdMIHP9cz8jXLU', '2019-04-30 11:32:53', '2019-04-30 11:32:53', 4),
(7, 'Rozi', 'fakulti', 'fakulti4@gmail.com', NULL, '$2y$10$3ReeQcFbM/4A595MqMV2huQK8XuuWJyu/02WdRr.inrJ65FXbUaP.', 'PVrgy5Z8F9CE55U5VvfMikwiDTi4CZOsrJbbVyb1s5K2IWCGHM0Vqp4FGKZt', '2019-05-02 14:15:31', '2019-05-02 14:15:42', 12),
(15, 'Syazany', 'senat', 'senat@gmail.com', NULL, '$2y$10$XJH2EzccTNY6qLTLlIUq0O4M0Q1cxkXNqpRXB28q28THN8l5UrG0S', NULL, '2019-05-27 09:49:50', '2019-05-27 09:49:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_permohonans`
--
ALTER TABLE `dokumen_permohonans`
  ADD PRIMARY KEY (`dokumen_permohonan_id`),
  ADD KEY `dokumen_permohonans_permohonan_id_foreign` (`permohonan_id`);

--
-- Indexes for table `fakultis`
--
ALTER TABLE `fakultis`
  ADD PRIMARY KEY (`fakulti_id`);

--
-- Indexes for table `jenis_permohonans`
--
ALTER TABLE `jenis_permohonans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kemajuan_permohonans`
--
ALTER TABLE `kemajuan_permohonans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kemajuan_permohonans_status_permohonan_foreign` (`status_permohonan`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`laporan_id`),
  ADD KEY `laporans_dokumen_permohonan_id_foreign` (`dokumen_permohonan_id`),
  ADD KEY `laporans_id_penghantar_foreign` (`id_penghantar`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notifications_id`),
  ADD KEY `notifications_userfired_foreign` (`userFired`),
  ADD KEY `notifications_notificationdetails_foreign` (`notificationDetails`),
  ADD KEY `notifications_usertonotify_foreign` (`userToNotify`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penilaian_panels`
--
ALTER TABLE `penilaian_panels`
  ADD PRIMARY KEY (`penilaian_id`),
  ADD KEY `penilaian_panels_permohonanid_foreign` (`permohonanID`),
  ADD KEY `penilaian_panels_id_pelantik_foreign` (`id_pelantik`),
  ADD KEY `penilaian_panels_id_penilai_foreign` (`id_penilai`);

--
-- Indexes for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD PRIMARY KEY (`permohonan_id`),
  ADD KEY `permohonans_id_penghantar_foreign` (`id_penghantar`),
  ADD KEY `permohonans_jenis_permohonan_id_foreign` (`jenis_permohonan_id`),
  ADD KEY `permohonans_status_permohonan_id_foreign` (`status_permohonan_id`);

--
-- Indexes for table `status_permohonans`
--
ALTER TABLE `status_permohonans`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tetapan_aliran_kerjas`
--
ALTER TABLE `tetapan_aliran_kerjas`
  ADD PRIMARY KEY (`tetapan_id`),
  ADD KEY `tetapan_aliran_kerjas_id_pjk_foreign` (`id_pjk`),
  ADD KEY `tetapan_aliran_kerjas_id_jppa_foreign` (`id_jppa`),
  ADD KEY `tetapan_aliran_kerjas_id_senat_foreign` (`id_senat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_fakulti_id_foreign` (`fakulti_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_permohonans`
--
ALTER TABLE `dokumen_permohonans`
  MODIFY `dokumen_permohonan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `fakultis`
--
ALTER TABLE `fakultis`
  MODIFY `fakulti_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `jenis_permohonans`
--
ALTER TABLE `jenis_permohonans`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kemajuan_permohonans`
--
ALTER TABLE `kemajuan_permohonans`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `laporan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notifications_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `penilaian_panels`
--
ALTER TABLE `penilaian_panels`
  MODIFY `penilaian_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permohonans`
--
ALTER TABLE `permohonans`
  MODIFY `permohonan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `status_permohonans`
--
ALTER TABLE `status_permohonans`
  MODIFY `status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tetapan_aliran_kerjas`
--
ALTER TABLE `tetapan_aliran_kerjas`
  MODIFY `tetapan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_permohonans`
--
ALTER TABLE `dokumen_permohonans`
  ADD CONSTRAINT `dokumen_permohonans_permohonan_id_foreign` FOREIGN KEY (`permohonan_id`) REFERENCES `permohonans` (`permohonan_id`);

--
-- Constraints for table `kemajuan_permohonans`
--
ALTER TABLE `kemajuan_permohonans`
  ADD CONSTRAINT `kemajuan_permohonans_status_permohonan_foreign` FOREIGN KEY (`status_permohonan`) REFERENCES `status_permohonans` (`status_id`);

--
-- Constraints for table `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_dokumen_permohonan_id_foreign` FOREIGN KEY (`dokumen_permohonan_id`) REFERENCES `dokumen_permohonans` (`dokumen_permohonan_id`),
  ADD CONSTRAINT `laporans_id_penghantar_foreign` FOREIGN KEY (`id_penghantar`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_notificationdetails_foreign` FOREIGN KEY (`notificationDetails`) REFERENCES `status_permohonans` (`status_id`),
  ADD CONSTRAINT `notifications_userfired_foreign` FOREIGN KEY (`userFired`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_usertonotify_foreign` FOREIGN KEY (`userToNotify`) REFERENCES `users` (`id`);

--
-- Constraints for table `penilaian_panels`
--
ALTER TABLE `penilaian_panels`
  ADD CONSTRAINT `penilaian_panels_id_pelantik_foreign` FOREIGN KEY (`id_pelantik`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penilaian_panels_id_penilai_foreign` FOREIGN KEY (`id_penilai`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penilaian_panels_permohonanid_foreign` FOREIGN KEY (`permohonanID`) REFERENCES `permohonans` (`permohonan_id`);

--
-- Constraints for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD CONSTRAINT `permohonans_id_penghantar_foreign` FOREIGN KEY (`id_penghantar`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permohonans_jenis_permohonan_id_foreign` FOREIGN KEY (`jenis_permohonan_id`) REFERENCES `jenis_permohonans` (`id`),
  ADD CONSTRAINT `permohonans_status_permohonan_id_foreign` FOREIGN KEY (`status_permohonan_id`) REFERENCES `status_permohonans` (`status_id`);

--
-- Constraints for table `tetapan_aliran_kerjas`
--
ALTER TABLE `tetapan_aliran_kerjas`
  ADD CONSTRAINT `tetapan_aliran_kerjas_id_jppa_foreign` FOREIGN KEY (`id_jppa`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tetapan_aliran_kerjas_id_pjk_foreign` FOREIGN KEY (`id_pjk`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tetapan_aliran_kerjas_id_senat_foreign` FOREIGN KEY (`id_senat`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fakulti_id_foreign` FOREIGN KEY (`fakulti_id`) REFERENCES `fakultis` (`fakulti_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
