-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2018 at 04:24 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_permohonans`
--

CREATE TABLE `jenis_permohonans` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_permohonan_kod` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_permohonan_huraian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` int(10) UNSIGNED NOT NULL,
  `dokumen_id` int(10) UNSIGNED NOT NULL,
  `penilaian_pjk` int(10) UNSIGNED NOT NULL,
  `penilaian_panel_1` int(10) UNSIGNED NOT NULL,
  `penilaian_jppa` int(10) UNSIGNED DEFAULT NULL,
  `penilaian_senat` int(10) UNSIGNED DEFAULT NULL,
  `laporan_panel_penilai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_panel_penilai_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perakuan_pjk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perakuan_pjk_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perakuan_jppa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perakuan_jppa_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perakuan_senat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perakuan_senat_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `lecturer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakulti` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_permohonan_id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lecturer_id` int(10) UNSIGNED NOT NULL,
  `status_program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress_permohonans`
--

CREATE TABLE `progress_permohonans` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakulti` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_permohonans`
--
ALTER TABLE `jenis_permohonans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penilaians_dokumen_id_unique` (`dokumen_id`),
  ADD KEY `penilaians_penilaian_pjk_foreign` (`penilaian_pjk`),
  ADD KEY `penilaians_penilaian_panel_1_foreign` (`penilaian_panel_1`),
  ADD KEY `penilaians_penilaian_jppa_foreign` (`penilaian_jppa`),
  ADD KEY `penilaians_penilaian_senat_foreign` (`penilaian_senat`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_lecturer_id_foreign` (`lecturer_id`),
  ADD KEY `programs_jenis_permohonan_id_foreign` (`jenis_permohonan_id`);

--
-- Indexes for table `progress_permohonans`
--
ALTER TABLE `progress_permohonans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_permohonans`
--
ALTER TABLE `jenis_permohonans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_permohonans`
--
ALTER TABLE `progress_permohonans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_dokumen_id_foreign` FOREIGN KEY (`dokumen_id`) REFERENCES `programs` (`id`),
  ADD CONSTRAINT `penilaians_penilaian_jppa_foreign` FOREIGN KEY (`penilaian_jppa`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penilaians_penilaian_panel_1_foreign` FOREIGN KEY (`penilaian_panel_1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penilaians_penilaian_pjk_foreign` FOREIGN KEY (`penilaian_pjk`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penilaians_penilaian_senat_foreign` FOREIGN KEY (`penilaian_senat`) REFERENCES `users` (`id`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_jenis_permohonan_id_foreign` FOREIGN KEY (`jenis_permohonan_id`) REFERENCES `jenis_permohonans` (`id`),
  ADD CONSTRAINT `programs_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
