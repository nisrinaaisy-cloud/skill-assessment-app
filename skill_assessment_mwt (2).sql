-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2026 at 03:47 AM
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
-- Database: `skill_assessment_mwt`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foreman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_foreman` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `foreman_note` text DEFAULT NULL,
  `foreman_approved_at` timestamp NULL DEFAULT NULL,
  `kabag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_kabag` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `kabag_note` text DEFAULT NULL,
  `kabag_approved_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `assessment_id`, `created_at`, `updated_at`, `foreman_id`, `status_foreman`, `foreman_note`, `foreman_approved_at`, `kabag_id`, `status_kabag`, `kabag_note`, `kabag_approved_at`, `status`) VALUES
(2, 2, '2026-07-07 10:05:22', '2026-07-15 07:34:19', 15, 'approved', NULL, '2026-07-07 10:13:48', 19, 'approved', NULL, '2026-07-15 07:34:19', 'approved'),
(3, 8, '2026-07-13 08:25:53', '2026-07-13 08:26:42', 15, 'approved', NULL, '2026-07-13 08:26:21', 19, 'approved', NULL, '2026-07-13 08:26:42', 'approved'),
(4, 7, '2026-07-13 09:19:08', '2026-07-13 09:19:08', 15, 'pending', NULL, NULL, 19, 'pending', NULL, NULL, 'pending'),
(5, 9, '2026-07-15 07:32:20', '2026-07-15 07:32:20', 15, 'pending', NULL, NULL, 19, 'pending', NULL, NULL, 'pending'),
(6, 4, '2026-07-15 07:32:40', '2026-07-15 07:34:13', 15, 'approved', NULL, '2026-07-15 07:33:25', 19, 'approved', NULL, '2026-07-15 07:34:13', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_process_id` bigint(20) UNSIGNED DEFAULT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL,
  `attempt_no` int(11) NOT NULL DEFAULT 1,
  `status` enum('draft','submitted','dinilai','lulus','tidak_lulus') NOT NULL DEFAULT 'draft',
  `input_nama_part` varchar(255) DEFAULT NULL,
  `input_no_part` varchar(255) DEFAULT NULL,
  `input_proses` varchar(255) DEFAULT NULL,
  `is_master_valid` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_foreman_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_foreman_at` timestamp NULL DEFAULT NULL,
  `approved_kabag_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_kabag_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `verification_code`, `operator_id`, `part_id`, `sub_process_id`, `periode_id`, `attempt_no`, `status`, `input_nama_part`, `input_no_part`, `input_proses`, `is_master_valid`, `created_at`, `updated_at`, `approved_foreman_by`, `approved_foreman_at`, `approved_kabag_by`, `approved_kabag_at`) VALUES
(1, NULL, 2, 1, 88, 4, 1, 'submitted', 'Assy Component BODY', 'AA 00514OO', 'STAMPING', 1, '2026-07-02 00:13:04', '2026-07-02 01:10:25', NULL, NULL, NULL, NULL),
(2, NULL, 17, 194, 69, 5, 1, 'lulus', 'PLATE OIL PUMP GEAR', '15134-K1AL-N801-H1', 'STAMPING', 1, '2026-07-06 21:34:19', '2026-07-15 07:34:19', NULL, NULL, NULL, NULL),
(3, NULL, 31, 113, 88, 3, 1, 'tidak_lulus', 'BAND INSULATOR', '17255-KWN -9001', 'STAMPING', 1, '2026-07-06 23:07:03', '2026-07-15 07:42:46', NULL, NULL, NULL, NULL),
(4, NULL, 31, 1, 88, 3, 1, 'lulus', 'Assy Component BODY', 'AA 00514OO', 'STAMPING', 1, '2026-07-06 23:24:20', '2026-07-15 07:34:13', NULL, NULL, NULL, NULL),
(5, NULL, 14, 1, 88, 6, 1, 'dinilai', 'Assy Component BODY', 'AA 00514OO', 'STAMPING', 1, '2026-07-06 23:33:16', '2026-07-07 10:02:38', NULL, NULL, NULL, NULL),
(6, NULL, 1, 1, 88, 2, 1, 'submitted', 'Assy Component BODY', 'AA 00514OO', 'STAMPING', 1, '2026-07-07 06:40:04', '2026-07-07 06:57:59', NULL, NULL, NULL, NULL),
(7, NULL, 1, 113, 88, 2, 1, 'dinilai', 'BAND INSULATOR', '17255-KWN -9001', 'STAMPING', 1, '2026-07-07 06:42:24', '2026-07-13 09:19:08', NULL, NULL, NULL, NULL),
(8, NULL, 30, 106, 11, 3, 1, 'lulus', 'BAND, COMP BATTERY', '80102-K64 -N000', 'STAMPING', 1, '2026-07-13 07:49:15', '2026-07-13 08:26:42', NULL, NULL, NULL, NULL),
(9, NULL, 30, 1, 88, 3, 1, 'dinilai', 'Assy Component BODY', 'AA 00514OO', 'STAMPING', 1, '2026-07-15 07:30:09', '2026-07-15 07:32:20', NULL, NULL, NULL, NULL),
(10, NULL, 1, 147, 88, 2, 1, 'tidak_lulus', 'BASE,FIRE EXTINGUISHER (BODY)', '02D-2020-00', 'STAMPING', 1, '2026-07-15 07:40:01', '2026-07-15 07:49:27', NULL, NULL, NULL, NULL),
(11, NULL, 2, 78, 43, 4, 1, 'draft', 'BAR ASSY, L P STEP (PATCH)', '5071B-KZL -A007-IN', 'STAMPING', 1, '2026-07-16 06:51:27', '2026-07-16 06:51:27', NULL, NULL, NULL, NULL),
(12, NULL, 26, 1, 88, 7, 1, 'submitted', 'Assy Component BODY', 'AA 00514OO', 'STAMPING', 1, '2026-07-24 07:01:54', '2026-07-24 07:02:21', NULL, NULL, NULL, NULL),
(13, NULL, 26, 233, 188, 7, 1, 'draft', 'CLAMPER A ,RR BRK CABLE', '43458 -K2SM -N801', 'STAMPING', 1, '2026-07-25 02:46:26', '2026-07-25 02:46:26', NULL, NULL, NULL, NULL),
(14, 'SA-20260727-00014', 33, 1, 88, 8, 1, 'submitted', 'Assy Component BODY', 'AA 00514OO', 'STAMPING', 1, '2026-07-27 08:03:32', '2026-07-27 08:09:21', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assessment_answers`
--

CREATE TABLE `assessment_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `flow_process` text DEFAULT NULL,
  `nama_subpart` text DEFAULT NULL,
  `q_point` text DEFAULT NULL,
  `standard_packing` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment_answers`
--

INSERT INTO `assessment_answers` (`id`, `assessment_id`, `flow_process`, `nama_subpart`, `q_point`, `standard_packing`, `created_at`, `updated_at`) VALUES
(1, 1, 'Material Coil → Blanking → Forming → Restrike → Final Inspection', 'SP-005 Inner Plate', 'Tidak boleh ada crack pada area bending dan bentuk part harus sesuai standar.', NULL, '2026-07-02 00:13:04', '2026-07-02 01:10:25'),
(2, 2, '- Bahan Baku\r\n- Blank/ Compond\r\n- Barel\r\n- Harden\r\n- Packing\r\n- FG', 'SP HL - PO T 3.0 X 100 X COIL', '- Tidak Burry\r\n- Tidak Gompal\r\n- Tidak Scracth\r\n- Tidak Karat\r\n-Tidak Dented\r\n- Harus masuk jig\r\n- Tid', NULL, '2026-07-06 21:34:19', '2026-07-06 21:42:38'),
(3, 3, 'Material Incoming\r\nBlanking\r\nPiercing\r\nForming\r\nInspection\r\nPacking', 'Steel Plate (SPCC)', '- Tidak boleh ada burr.\r\n- Dimensi sesuai drawing.\r\n- Lubang tidak meleset.\r\n- Sudut bending sesuai standar.\r\n- Permukaan bebas gores, penyok, dan karat.', NULL, '2026-07-06 23:07:03', '2026-07-06 23:10:06'),
(4, 4, 'Blank dipasang pada Jig sesuai orientasi.', 'BODY', 'Pastikan posisi part sesuai jig, tidak terbalik, dan hasil spot welding sesuai standar.', NULL, '2026-07-06 23:24:20', '2026-07-06 23:25:31'),
(5, 5, 'Ambil part dari trolley → Pasang pada jig → Lakukan spot welding sesuai standar → Cek visual hasil welding → Letakkan part pada pallet OK.', 'BODY', 'Pastikan tidak ada burr, crack, penyok (dent), goresan, atau deformasi. Lubang dan dimensi sesuai standar drawing serta bentuk part sesuai master check.', NULL, '2026-07-06 23:33:16', '2026-07-06 23:35:23'),
(6, 6, 'Material diambil dari rak → Dipasang pada dies → Proses stamping dilakukan → Hasil part diperiksa secara visual → Part OK ditempatkan pada pallet.', 'BODY', 'Pastikan tidak ada burr, crack, penyok (dent), goresan, atau deformasi. Lubang dan dimensi sesuai standar drawing serta bentuk part sesuai master check.', NULL, '2026-07-07 06:40:04', '2026-07-07 06:40:46'),
(7, 7, NULL, NULL, NULL, NULL, '2026-07-07 06:42:24', '2026-07-07 06:42:24'),
(8, 8, '1. Penerimaan material Band Comp Battery\r\n2. Pemeriksaan visual material\r\n3. Proses Press Forming\r\n4. Proses Piercing\r\n5. Deburring\r\n6. Cleaning Part\r\n7. Final Inspection\r\n8. Packing', 'Band Comp Battery\r\nSPCC Steel Plate 0.8 mm', '1. Tidak burr\r\n2. Tidak penyok (No Dent)\r\n3. Tidak crack\r\n4. Dimensi sesuai drawing\r\n5. Hole sesuai ukuran\r\n6. Permukaan bersih\r\n7. Tidak karat\r\n8. Visual OK', NULL, '2026-07-13 07:49:15', '2026-07-13 08:19:18'),
(9, 9, '- Bahan baku\r\n- Machining / forming\r\n- Subcont / proses', 'Assy Component', '- Tidak burry\r\n- Tidak dented\r\n- Marking jelas\r\n- Dimensi sesuai standar\r\n- Visual OK', NULL, '2026-07-15 07:30:09', '2026-07-15 07:31:03'),
(10, 10, '- Bahan baku\r\n- Machining / forming\r\n- Subcont / proses', '- Assy Component BODY', '- Tidak burry\r\n- Tidak dented\r\n- Marking jelas\r\n- Dimensi sesuai standar\r\n- Visual OK', NULL, '2026-07-15 07:40:01', '2026-07-15 07:48:25'),
(11, 11, NULL, NULL, NULL, NULL, '2026-07-16 06:51:27', '2026-07-16 06:51:27'),
(12, 12, 'aa', 'bb', 'cc', NULL, '2026-07-24 07:01:54', '2026-07-24 07:02:21'),
(13, 13, NULL, NULL, NULL, NULL, '2026-07-25 02:46:26', '2026-07-25 02:46:26'),
(14, 14, '..', '..', '..', NULL, '2026-07-27 08:03:33', '2026-07-27 08:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_rules`
--

CREATE TABLE `assessment_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `bobot_flow` int(11) NOT NULL DEFAULT 0,
  `bobot_subpart` int(11) NOT NULL DEFAULT 0,
  `bobot_qpoint` int(11) NOT NULL DEFAULT 0,
  `bobot_packing` int(11) NOT NULL DEFAULT 0,
  `nilai_min_lulus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_divisi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Stamping', '2026-06-26 07:04:36', '2026-06-26 07:04:36'),
(2, 'Welding', '2026-06-26 08:12:47', '2026-06-26 08:12:47'),
(3, 'Machining', '2026-06-26 08:12:47', '2026-06-26 08:12:47'),
(4, 'Packing', '2026-06-26 08:12:47', '2026-06-26 08:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leader_assignments`
--

CREATE TABLE `leader_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leader_id` bigint(20) UNSIGNED DEFAULT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leader_assignments`
--

INSERT INTO `leader_assignments` (`id`, `leader_id`, `divisi_id`, `is_active`, `created_at`, `updated_at`) VALUES
(5, NULL, 1, 0, '2026-08-04 04:20:57', '2026-08-10 07:11:15'),
(6, NULL, 1, 0, '2026-08-04 04:31:21', '2026-08-10 07:11:15'),
(7, NULL, 1, 0, '2026-08-10 04:11:46', '2026-08-10 07:11:15'),
(8, 5, 1, 1, '2026-08-10 07:44:29', '2026-08-10 07:44:29'),
(9, 6, 1, 1, '2026-08-10 09:15:20', '2026-08-10 09:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_20_093521_create_divisi_table', 1),
(5, '2026_04_20_093522_create_shift_table', 1),
(6, '2026_04_20_093523_create_operators_table', 1),
(7, '2026_04_20_093523_create_parts_table', 1),
(8, '2026_04_20_093524_create_subparts_table', 1),
(9, '2026_04_20_093525_create_assessment_rules_table', 1),
(10, '2026_04_20_093525_create_periode_table', 1),
(11, '2026_04_20_093526_create_assessment_answers_table', 1),
(12, '2026_04_20_093526_create_assessments_table', 1),
(13, '2026_04_20_093527_create_penilaian_table', 1),
(14, '2026_04_20_093528_create_approvals_table', 1),
(15, '2026_04_20_093528_create_notifications_table', 1),
(16, '2026_04_20_093529_create_qr_tokens_table', 1),
(17, '2026_04_20_093530_create_settings_table', 1),
(18, '2026_04_21_064705_add_divisi_id_to_users_table', 1),
(19, '2026_04_21_064755_add_leader_id_to_operators_table', 1),
(20, '2026_04_21_091713_add_username_to_users_table', 1),
(21, '2026_05_28_080716_add_unique_no_part_to_parts_table', 1),
(22, '2026_05_31_065733_add_fields_to_assessment_answers_table', 1),
(23, '2026_06_03_042805_add_approval_columns_to_assessments_table', 1),
(24, '2026_06_03_061437_add_columns_to_approvals_table', 1),
(25, '2026_06_08_093242_add_kabag_approval_columns_to_approvals_table', 1),
(26, '2026_06_17_071210_add_manual_part_fields_to_assessments_table', 1),
(27, '2026_06_26_034643_create_sub_processes_table', 1),
(28, '2026_06_26_034644_create_part_sub_processes_table', 1),
(29, '2026_06_30_105800_add_divisi_id_to_parts_table', 2),
(30, '2026_07_02_071056_add_sub_process_id_to_assessments_table', 3),
(31, '2026_07_07_162407_add_signature_to_users_table', 4),
(32, '2026_07_07_163940_create_user_divisi_table', 5),
(33, '2026_07_16_124135_add_email_to_operators_table', 6),
(34, '2026_07_24_134735_add_verification_code_to_assessments_table', 7),
(35, '2026_07_27_140318_create_leader_assignments_table', 8),
(36, '2026_07_28_134923_create_leader_assignments_table', 9),
(37, '2026_07_29_135408_add_foreign_key_to_leader_assignments_table', 10),
(38, '2026_08_04_131610_create_part_divisions_table', 11),
(40, '2026_08_04_143834_remove_old_columns_from_parts_table', 12),
(43, '2026_08_04_131736_create_part_processes_table', 13),
(44, '2026_08_07_134748_add_operator_id_and_is_active_to_users_table', 14),
(45, '2026_08_10_113614_add_employee_nik_to_users_table', 15),
(46, '2026_08_10_112500_revise_leader_assignments', 16),
(47, '2026_08_10_125950_revise_leader_assignments_table', 17),
(48, '2026_08_10_144121_remove_employee_id_from_leader_assignments_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assessment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `assessment_id`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 6, 4, 'Assessment Baru Masuk', 'AGIL KURNIAWAN baru mengisi assessment part Assy Component BODY periode 05/2024. Menunggu penilaian leader.', 0, '2026-07-06 23:25:31', '2026-07-06 23:25:31'),
(2, 1, 4, 'Assessment Baru Masuk', 'AGIL KURNIAWAN baru mengisi assessment part Assy Component BODY periode 05/2024. Menunggu penilaian leader.', 1, '2026-07-06 23:25:31', '2026-08-10 09:03:22'),
(3, 5, 5, 'Assessment Baru Masuk', 'KURNIA IMAN SAPUTRA baru mengisi assessment part Assy Component BODY periode 05/2025. Menunggu penilaian leader.', 0, '2026-07-06 23:35:23', '2026-07-06 23:35:23'),
(4, 1, 5, 'Assessment Baru Masuk', 'KURNIA IMAN SAPUTRA baru mengisi assessment part Assy Component BODY periode 05/2025. Menunggu penilaian leader.', 1, '2026-07-06 23:35:23', '2026-08-10 09:03:22'),
(5, 5, 6, 'Assessment Baru Masuk', 'ABDUL AZIZ baru mengisi assessment part Assy Component BODY periode 07/2025. Menunggu penilaian leader.', 0, '2026-07-07 06:40:46', '2026-07-07 06:40:46'),
(6, 1, 6, 'Assessment Baru Masuk', 'ABDUL AZIZ baru mengisi assessment part Assy Component BODY periode 07/2025. Menunggu penilaian leader.', 1, '2026-07-07 06:40:46', '2026-08-10 09:03:22'),
(7, NULL, 6, 'Assessment Tidak Lulus', 'ABDUL AZIZ dinyatakan TIDAK LULUS oleh Leader. Assessment tidak masuk approval Foreman.', 0, '2026-07-07 06:57:59', '2026-07-07 06:57:59'),
(8, 1, 6, 'Assessment Menunggu Approval Foreman', 'ABDUL AZIZ dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 1, '2026-07-07 06:57:59', '2026-08-10 09:03:22'),
(9, NULL, 5, 'Assessment Tidak Lulus', 'KURNIA IMAN SAPUTRA dinyatakan TIDAK LULUS oleh Leader. Assessment tidak masuk approval Foreman.', 0, '2026-07-07 06:58:24', '2026-07-07 06:58:24'),
(10, 1, 5, 'Assessment Menunggu Approval Foreman', 'KURNIA IMAN SAPUTRA dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 1, '2026-07-07 06:58:24', '2026-08-10 09:03:22'),
(11, NULL, 2, 'Assessment Menunggu Approval', 'MULYADI dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 0, '2026-07-07 07:07:16', '2026-07-07 07:07:16'),
(12, NULL, 2, 'Assessment Menunggu Approval Kabag', 'MULYADI sudah disetujui Foreman Foreman dan menunggu approval Kabag.', 0, '2026-07-07 07:15:21', '2026-07-07 07:15:21'),
(13, 1, 2, 'Assessment Telah Disetujui Kabag', 'MULYADI telah disetujui Kabag Kabag dan status assessment sudah final.', 1, '2026-07-07 07:17:13', '2026-08-10 09:03:22'),
(14, 15, 2, 'Assessment Menunggu Approval', 'MULYADI dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 0, '2026-07-07 10:05:22', '2026-07-07 10:05:22'),
(15, 19, 2, 'Assessment Menunggu Approval Kabag', 'MULYADI telah disetujui Foreman Indrayadi dan menunggu approval Kabag.', 0, '2026-07-07 10:13:48', '2026-07-07 10:13:48'),
(16, 6, 8, 'Assessment Baru Masuk', 'ADITYA ERLANGGA baru mengisi assessment part BAND, COMP BATTERY periode 05/2024. Menunggu penilaian leader.', 0, '2026-07-13 08:19:18', '2026-07-13 08:19:18'),
(17, 1, 8, 'Assessment Baru Masuk', 'ADITYA ERLANGGA baru mengisi assessment part BAND, COMP BATTERY periode 05/2024. Menunggu penilaian leader.', 1, '2026-07-13 08:19:18', '2026-08-10 09:03:22'),
(18, 15, 8, 'Assessment Menunggu Approval', 'ADITYA ERLANGGA dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 0, '2026-07-13 08:25:53', '2026-07-13 08:25:53'),
(19, 19, 8, 'Assessment Menunggu Approval Kabag', 'ADITYA ERLANGGA telah disetujui Foreman Indrayadi dan menunggu approval Kabag.', 0, '2026-07-13 08:26:21', '2026-07-13 08:26:21'),
(20, 1, 8, 'Assessment Final', 'ADITYA ERLANGGA telah disetujui Kabag.', 1, '2026-07-13 08:26:42', '2026-08-10 09:03:22'),
(21, 15, 7, 'Assessment Menunggu Approval', 'ABDUL AZIZ dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 0, '2026-07-13 09:19:08', '2026-07-13 09:19:08'),
(22, 6, 9, 'Assessment Baru Masuk', 'ADITYA ERLANGGA baru mengisi assessment part Assy Component BODY periode 05/2024. Menunggu penilaian leader.', 0, '2026-07-15 07:31:03', '2026-07-15 07:31:03'),
(23, 1, 9, 'Assessment Baru Masuk', 'ADITYA ERLANGGA baru mengisi assessment part Assy Component BODY periode 05/2024. Menunggu penilaian leader.', 1, '2026-07-15 07:31:03', '2026-08-10 09:03:22'),
(24, 15, 9, 'Assessment Menunggu Approval', 'ADITYA ERLANGGA dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 0, '2026-07-15 07:32:20', '2026-07-15 07:32:20'),
(25, 15, 4, 'Assessment Menunggu Approval', 'AGIL KURNIAWAN dinyatakan LULUS oleh Leader dan menunggu approval Foreman.', 0, '2026-07-15 07:32:40', '2026-07-15 07:32:40'),
(26, 19, 4, 'Assessment Menunggu Approval Kabag', 'AGIL KURNIAWAN telah disetujui Foreman Indrayadi dan menunggu approval Kabag.', 0, '2026-07-15 07:33:25', '2026-07-15 07:33:25'),
(27, 1, 4, 'Assessment Final', 'AGIL KURNIAWAN telah disetujui Kabag.', 1, '2026-07-15 07:34:13', '2026-08-10 09:03:22'),
(28, 1, 2, 'Assessment Final', 'MULYADI telah disetujui Kabag.', 1, '2026-07-15 07:34:19', '2026-08-10 09:03:22'),
(29, 5, 10, 'Assessment Baru Masuk', 'ABDUL AZIZ baru mengisi assessment part BASE,FIRE EXTINGUISHER (BODY) periode 07/2025. Menunggu penilaian leader.', 0, '2026-07-15 07:48:25', '2026-07-15 07:48:25'),
(30, 1, 10, 'Assessment Baru Masuk', 'ABDUL AZIZ baru mengisi assessment part BASE,FIRE EXTINGUISHER (BODY) periode 07/2025. Menunggu penilaian leader.', 1, '2026-07-15 07:48:25', '2026-08-10 09:03:22'),
(31, 6, 14, 'Assessment Baru Masuk', 'ALIF SUBEHI baru mengisi assessment part Assy Component BODY periode 01/2026. Menunggu penilaian leader.', 0, '2026-07-27 08:09:22', '2026-07-27 08:09:22'),
(32, 1, 14, 'Assessment Baru Masuk', 'ALIF SUBEHI baru mengisi assessment part Assy Component BODY periode 01/2026. Menunggu penilaian leader.', 1, '2026-07-27 08:09:22', '2026-08-10 09:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `leader_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `nama_lengkap`, `nik`, `email`, `jabatan`, `divisi_id`, `leader_id`, `shift_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ABDUL AZIZ', '3725.250701.CKR', 'abedul11@gmail.com', 'Leader', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(2, 'ACHMAD SYAIFULLAH', '4012.260615.CKR', 'achmads@gmail.com', 'Leader', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-04 04:20:57'),
(3, 'AHMAD KARTIKO', '3947.260303.CKR', NULL, 'Operator', 1, 5, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:58:38'),
(4, 'AKBAR HERNANTO', '3037.231030.CKR', NULL, 'Operator', 1, 5, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:58:38'),
(5, 'ALIF FAIQ RAIHATTAN', '3466.241021.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(6, 'ANDESTRI WIKORO WAHYU', '3140.240212.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(7, 'ARIS ALAMSYAH', '3036.231030.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(8, 'BAIM DIAN NUGRAHA', '3935.260213.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(9, 'EVAN FERDIAN AL-FATIH', '3461.241021.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(10, 'ERWIN NUREKO', '3469.241021.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(11, 'FAINSYA AZIMA IKHAK', '2919.230718.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(12, 'GOFUR', '4011.260615.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(13, 'KUAT TEGUH PRASETIYO', '3724.250701.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(14, 'KURNIA IMAN SAPUTRA', '3697.250528.CKR', 'kurnia@gmail.com', 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(15, 'MOHAMAD ALFARIZAL', '3759.250716.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(16, 'MUHAMMAD YUSUP KAMALUDIN', '3945.260303.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(17, 'MULYADI', '0086.091126.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(18, 'PANDU WIJAYA', '4010.260615.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(19, 'RAEHAN NUR SATRIO', '3937.260213.CKR', 'nisrina@gmail.com', 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(20, 'RAFA ADITYA RAHMAN', '3693.250520.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(21, 'RENDY YOGASWARA', '3286.240527.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(22, 'RIFAN ALFA RIZKI', '3805.250915.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(23, 'ROBBY', '3207.240429.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(24, 'ROBIH MUSYAFA', '3694.250520.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(25, 'SAEFUL HALIM', '3219.240502.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(26, 'SAHIL ABIDI', '3963.260213.CKR', 'sahilab@gmail.com', 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(27, 'SATRIA DWITAMA', '3222.240502.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(28, 'SUNANDI', '3949.260303.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(29, 'TADZUDDIN KHARMANI', '3038.231030.CKR', NULL, 'Operator', 1, NULL, 1, 1, '2026-06-26 09:32:59', '2026-08-10 07:23:25'),
(30, 'ADITYA ERLANGGA', '3287.240527.CKR', 'adit@gmail.com', 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 09:08:32'),
(31, 'AGIL KURNIAWAN', '3235.240508.CKR', 'windautia1504@gmail.com', 'Leader', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-04 04:32:09'),
(32, 'AINUL LUKMAN HALIM', '3238.240513.CKR', 'ainuy@gmail.com', 'Operator', 1, 6, 2, 1, '2026-06-26 09:34:10', '2026-08-10 09:15:27'),
(33, 'ALIF SUBEHI', '3890.260115.CKR', 'nisrina@gmail.com', 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(34, 'ALI JAMALUDIN', '3762.250722.CKR', NULL, 'Operator', 1, 6, 2, 1, '2026-06-26 09:34:10', '2026-08-10 09:15:27'),
(35, 'ALPIN SEPTIAWAN', '3698.250528.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(36, 'ANANG SHEVA EGY KUNCORO', '3934.260213.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(37, 'ARIEL RAMADAN', '3225.240502.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(38, 'AWAL RAMADHAN', '3758.250716.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(39, 'DHEVA ADHITYA PRATAMA', '3946.260303.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(40, 'DIANO ROMADON', '3687.250520.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(41, 'EDI SUPRIADI', '0040.020204.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(42, 'DESTA TRI PRAMUDITA', '3933.260213.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(43, 'FREDI ARDIANSYAH', '3333.240620.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(44, 'KHANIF SUBEKTI', '3510.241115.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(45, 'KURNIAWAN IQBAL FAUZI', '3245.241129.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(46, 'MAHARDIKA PUTRO', '3525.241129.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(47, 'MARUF ARIANSYAH', '3576.250114.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(48, 'MAS\'UD SIDIQ', '3410.240904.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(49, 'MUHAMMAD NUR ADITYA', '3528.241129.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(50, 'MUHAMMAD RAFLI ARDIANSYAH', '3765.250730.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(51, 'RADHITYA AGESTA PRATAMA', '3577.250114.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(52, 'RIZKI ANDRIYANO', '3961.260328.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(53, 'SARIF NUR HIDAYAT', '3948.260303.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(54, 'SIGIT HENDRA HIMAWAN', '3380.240722.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25'),
(55, 'TEGAR FIRMANSYAH', '3760.250716.CKR', NULL, 'Operator', 1, NULL, 2, 1, '2026-06-26 09:34:10', '2026-08-10 07:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_part` varchar(100) NOT NULL,
  `nama_part` varchar(150) NOT NULL,
  `kategori` enum('stamping','machining','welding','packing') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `no_part`, `nama_part`, `kategori`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'AA 00514OO', 'Assy Component BODY', 'stamping', 1, '2026-06-26 09:14:26', '2026-06-26 09:14:26'),
(2, '80102-K45 -N000', 'BAND COMP, BATTERY', 'stamping', 1, '2026-06-26 09:14:26', '2026-06-26 09:14:26'),
(3, '17511-K18 -9000-H1', 'BRKT COMP, R SHROUD (BODY)', 'stamping', 1, '2026-06-26 09:14:26', '2026-06-26 09:14:26'),
(4, '17511-K18A-9000-22.BB', 'PATCH B R-BB', 'stamping', 1, '2026-06-26 09:14:26', '2026-06-26 09:14:26'),
(5, '17511-K18A-9000-21.BB', 'PATCH A R-BB', 'stamping', 1, '2026-06-26 09:14:26', '2026-06-26 09:14:26'),
(6, '17512-K18 -9000-H1', 'BRKT COMP, L SHROUD (BODY)', 'stamping', 1, '2026-06-26 09:14:26', '2026-06-26 09:14:26'),
(7, '17512-K18A-9000-22.BB', 'PATCH B L-BB', 'stamping', 1, '2026-06-26 09:14:26', '2026-06-26 09:14:26'),
(8, '17512-K18A-9000-21.BB', 'PATCH A L-BB', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(9, '6132B-K15 -9300-IN', 'BRKT, L UNDER COWL ASSY', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(10, '6132A-K15 -9300-IN', 'BRKT, R UNDER COWL ASSY', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(11, '5010E-K59 -A101-IN', 'BRKT,PIVOT L (SOZAI)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(12, '32962-K44 -V000', 'CLAMP,ENG HARNESS', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(13, '11346-KTR -9402', 'CLAMPER A,OIL TEMP SENSOR CORD', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(14, '43455-KWN -9000', 'CLAMPER B,RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(15, '17925-K50 -T000', 'CLAMPER THROTTLE CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(16, '43455-KZL -9300', 'CLAMPER,RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(17, 'AUOG00600', 'Clevis + AU01041EO + AU01003OO (BODY)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(18, 'AUOG003OO', 'Clevis Sub Assy', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(19, 'AUOG00500', 'Clevis Sub Assy (500 + 50A) (BODY)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(20, '61103-KRY -9004', 'COLLAR A, FR FENDER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(21, '33715-GB0 -9003', 'COLLAR, T/L SET', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(22, '186861PR01', 'COUNTER WEIGHT', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(23, '18322-K15 -9200', 'COVER 02 SENSOR A', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(24, '15431-HF7 -0104', 'COVER, OIL FILTER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(25, '15431-KPH -9003', 'COVER,OIL FILTER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(26, '32123-K56 -N001', 'GUARD,CHANGE SWCODE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(27, '50175-KYJ -9000', 'HOLDER COMP,RR CUSHION UPPER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(28, '02TA-0007-11', 'OUTER CASE CUSHION CAP MOUNTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(29, '03TA-0001-11', 'PLATE 123X88 BUMPER RR SPRING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(30, '02TA-0001-11', 'PLATE E CUSION CAB MOUNTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(31, '02TA-0002-11', 'PLATE G CUSION CAB MOUNTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(32, '02TA-0003-11', 'PLATE H CUSION CAB MOUNTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(33, '02TA-0004-11', 'PLATE J CUSION CAB MOUNTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(34, '02TA-0005-11', 'PLATE P CUSION CAB MOUNTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(35, '13371-K56 -N001-H1', 'PLATE R CRANK SIDE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(36, '897086-442-3A', 'Plate Rb.Cab.Mounting', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(37, '50619-K15-9000', 'PLATE STEP SET', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(38, '23802-GN5 -9104', 'PLATE, FIXING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(39, '11108-KZL -9300', 'PLATE, MISSION BRG SET', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(40, '11117-KWN -9010', 'PLATE,BRG PUSH', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(41, '50109-K18 -9000-H1', 'PLATE,CENTER CROSS', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(42, '11342-KZL -9301', 'PLATE,L COVER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(43, '13371-KVY -9002-H1', 'PLATE,R CRANK SIDE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(44, '13371-KWN -9000-H1', 'PLATE,R CRANK SIDE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(45, '12211-KPH -9001', 'PLATE,STOPPER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(46, '22821-KSP -B001', 'RECEIVER,CLUTCH CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(47, '897086-442-3B', 'Ring Rb.Cab.Mounting (RING)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(48, 'B0UA284', 'SEPARATOR A', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(49, 'B0UA286', 'SEPARATOR B', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(50, 'B0UA449', 'STAY TAIL COVER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(51, '50160-K18 -9000-H1', 'STAY,R REAR FENDER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(52, '50170-K18 -9000-H1', 'STAY,L REAR FENDER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(53, 'AU1G001FO', 'U-PLATE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(54, '90403-KN6 -9301', 'WASHER 10X24', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(55, '90608-072-0000', 'Washer 12 mm', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(56, '22103-K44 -V000', 'WASHER 15X25X3', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(57, '90435-HB3 -0002', 'WASHER 6.1MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(58, '90475-KWB -6003', 'WASHER 8 MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(59, '90525-030 -0002', 'WASHER B, HANDLE HOLDER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(60, '90432-086 -0001', 'WASHER LOCK B', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(61, '90404-KPT -A003', 'WASHER PLAIN 12 MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(62, '90441-286 -0002', 'WASHER SEALING 8MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(63, '90407-KWW -7402', 'WASHER, 6.2X19X2.3', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(64, '90560-K18 -9000', 'WASHER, RR AXLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(65, '90463-ML7 -0002', 'Washer, Sealing 6.5mm (6.5 +6.2)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(66, '53216-GN5 -8302', 'WASHER, STEM NUT', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(67, '90535-K15 -9202', 'WASHER,HNDL UNDER HOLDER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(68, '90443-MB0 -0003', 'WASHER,SEALING 10MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(69, '90544-KF0 -0005', 'WASHER,SEALING 14MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(70, '90495-MN5 -0002', 'WASHER,SEALING 8MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(71, '90458-KVS -9001', 'WASHER,THRUST 17MM', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(72, '50123-K45 -N400-H1', 'PLATE B CROSS', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(73, '32121-K56 -N101', 'STAY RESERVE TANK & CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(74, 'A5DA001', 'STAY MUFFLER COMP K56F(YMI) B', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(75, '50164-K56 -N101-H1', 'GUSSET SUB PIPE LOWER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(76, '45130-K45 -N001', 'STAY COMP, FR BRAKE HOSE (STAY)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(77, '5071A-KZL -A007-IN', 'BAR , R P STEP (PATCH)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(78, '5071B-KZL -A007-IN', 'BAR ASSY, L P STEP (PATCH)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(79, '45156-K64 -N101', 'CLAMPER FR BRK HOSE LWR', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(80, '17507-K64 -N001-H1', 'PATCH FR STAY', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(81, '17508-KZZ -9000-H1', 'RING,FUEL PUMP SETTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(82, '17509-K64 -N001-H1', 'PATCH RR STAY', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(83, '17513-K64 -N001-H1', 'STAY R TANK COVER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(84, '17514-K64 -N001-H1', 'STAY L TANK COVER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(85, '17515-K64 -N001-H1', 'STAY R SIDE COVER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(86, '17516-K64 -N001-H1', 'STAY L SIDE COVER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(87, '17517-K64 -N001-H1', 'GUIDE TUBE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(88, '50538-K64 -N002', 'PLATE SIDE STAND SPG', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(89, '33411-K15 -9201', 'COLLAR WINKER (WASHER)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(90, '1752A-K64 -N001-IN', 'PLATE 1 (STAY UPR, TANK FR)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(91, '18630-K64 -N001', 'STAY COMP AISV (STAY)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(92, '61102-MW4 -3000', 'PLATE,CLAMPER SETTING', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(93, '61104-K64 -N000', 'COLLAR,FUEL TANK (WASHER)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(94, '80117-K64 -N001', 'PLATE HOOK', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(95, '38117-MGZ -J001', 'COLLAR, HORN SET', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(96, '64222-K64 -N001', 'STAY R, NUMBER PLATE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(97, '64232-K64 -N001', 'STAY L,NUMBER PLATE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(98, '64223-K64 -N003', 'COUPLER A (STAY, COUPLER)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(99, '77103-K64 -N001', 'COLLAR', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(100, '32962-K64 -N001', 'STAY ENG HARNESS', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(101, '18423-MGZ -J000', 'COLLAR,  EXH PIPE MOUNT', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(102, '35105-K64 -N000', 'STAY COMB SW (STAY  COMP COMB SW)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(103, '38514-K64 -N101', 'STAY VW SENSOR CORD', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(104, '90102-K64 -N001', 'COLLAR 6X30', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(105, '90103-K64 -N001', 'COLLAR 8.5X10', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(106, '80102-K64 -N000', 'BAND, COMP BATTERY', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(107, '17239-K64 -N001', 'Plate,PGM-FI Unit Set', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(108, '17512-K64 -N001-H1', 'PATCH,FR STAY UPPER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(109, 'AU0G0070A', 'Clevis Assembly', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(110, '22821-KRM -8402', 'RECEIVER, CLUTCH CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(111, '50386-K84A-9002', 'BAND COMP BATTERY', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(112, '17913-K35 -V000', 'CLAMPER B THROTTLE CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(113, '17255-KWN -9001', 'BAND INSULATOR', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(114, '17120-K97 -T001', 'STAY COMP HOSE CLAMPER (PLATE)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(115, '17912-K97 -T001', 'CLAMPER THROTTLE CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(116, '50105-K59 -A700-H1', 'BRKT, PIVOT R', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(117, '33415-KZZ-J000', 'WASHER COLLAR WINKER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(118, '50165-K16 -9000-H1', 'STAY, R RR FENDER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(119, '50166-K16 -9000-H1', 'STAY, L RR FENDER', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(120, '37-AX01I', 'IRON PLATE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(121, '17535-KSH -8901', 'COLLAR METER SET (WASHER)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(122, '6132A-K15 -6001-IN', 'BRKT R UNDER COWL', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(123, '6132B-K15 -6000-IN', 'BRKT L UNDER COWL', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(124, '61105-KEV -9001', 'COLLAR, HORN SET (WASHER)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(125, '45130-K45 -NB00', 'STAY COMP,FR BRK HOSE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(126, '6141A-K45 -NA00-IN', 'HOLDER ABS MOD STAY A', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(127, '13371-K0J -N000-H1', 'PLATE,R CRANK SIDE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(128, '43455-K0J -N000', 'CLAMPER A, RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(129, '43456-K0J -N000', 'CLAMPER B, RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(130, '5014B-K0J -N001-IN', 'PIPE LOWER CROSS (SPS)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(131, '5014D-K0J -N001-IN', 'GUSSET FR (PLATE A)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(132, '32961-K0J -N000', 'CLAMP,ACG CORD', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(133, '8470A-K0J -H001-DL', 'BRKT, NUMBER PLATE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(134, '2D0460-11', 'OUTER TUBE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(135, '33415-k64 -J001', 'COLLAR WINKER (WASHER)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(136, '50138-K1Z -J100-H1', 'STAY R,RR CARRIER (PATCH)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(137, '50139-K1Z -J100-H1', 'STAY L,RR CARRIER (PATCH)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(138, '53136-K1Z -J100', 'PLATE HNDL CUSHION', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(139, '12212-K0R -V001', 'IN PLATE,CYLINDER HEAD', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(140, '12213-K0R -V001', 'EX PLATE,CYLINDER HEAD', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(141, '13371-K0R -V001-H1', 'PLATE, R CRANK SIDE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(142, '17620-K29 -J030', 'CAP COMP FUEL FILLER (CAP INNER)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(143, '5071A-K25 -9005-IN', 'BAR ASSY, R P STEP (PATCH)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(144, '5071B-K25 -9005-IN', 'BAR ASSY, L P STEP (PATCH)', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(145, '38516-K45 -NM00', 'CLAMPER SENSOR CORD', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(146, '45156-K45 -NM00', 'CLAMPER B, FR BRAKE HOSE', 'stamping', 1, '2026-06-26 09:14:27', '2026-06-26 09:14:27'),
(147, '02D-2020-00', 'BASE,FIRE EXTINGUISHER (BODY)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(148, '6132A-K15 -7200-DL', 'BRKT, R UNDER COWL ASSY (P)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(149, '6132B-K15 -7201-DL', 'BRKT, L UNDER COWL ASSY (P)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(150, 'SUP-04-015 / 63611-VT150', 'RETAINER No.2 RH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(151, 'SUP-04-016 / 63611-VT160', 'RETAINER No.2 LH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(152, 'SUP-04-005 / 63612-VT030', 'SUPPORT,COLLER DUCT REGISTER, NO.2', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(153, 'SUP-04-006 / 63612-VT040', 'SUPPORT,COLLER DUCT REGISTER, NO.2', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(154, 'RET-02-023 / 63377-VT030', 'RETAINER ROOF HEADLING SUPPORT NO.1', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(155, 'SUP-04-007 / 63611-VT010', 'SUPPORT,COLLER DUCT REGISTER, NO.1', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(156, 'SUP-04-008 / 63611-VT020', 'SUPPORT,COLLER DUCT REGISTER, NO.1', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(157, 'SUP-04-013 / 63611-VT130', 'RETAINER COVER No.1 RH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(158, 'SUP-04-014 / 63611-VT140', 'RETAINER COVER No.1 LH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(159, 'RET-02-024 / 63377-VT010', 'RETAINER ROOF HEADLING SUPPORT NO.1', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(160, '30401-K2S -N000', 'COVER ENG CONTL UNIT', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(161, '17519-K64 -N001-H1', 'GUIDE, FUEL FEED HOSE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(162, '7-10008-781-0', 'LEVER SUB ASSY', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(163, '6132A-K3B -N000-DL', 'BRKT, R UNDER COWL ASSY', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(164, '90535-K3B -N002', 'WASHER, HNDL UNDER HOLDER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(165, '6132B-K3B -N000-DL', 'BRKT,CTR UNDER COWL, SET (STAY A)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(166, '2D0467-11', 'OUTER TUBE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(167, '17533-K0W -NA00', 'STAY COMP, HOSE CLAMPER (STAY)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(168, '33415-K64 -TG00', 'COLLAR WINKER (WASHER)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(169, '64223-K64 -NM00', 'STAY, COUPLER (COUPLER A)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(170, '84706-K64 -NP00', 'COLLAR MIDDLE (WASHER)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(171, '90441-KW7 -9303', 'PLATE, BRG HOLD', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(172, '17533-K1Z -J500', 'CLAMPER CABLE (STAY)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(173, '90401-K48 -A000', 'WASHER 15 X 25.8 X 4', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(174, '53137-K1Z -J500', 'WAHSER COMP, HNDL HOLDER (WASHER)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(175, 'RET-02-010 / 63383-0K010-A', 'RETAINER ROOF HEADLING TRIM RH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(176, 'RET-02-011 / 63384-0K010-A', 'RETAINER ROOF HEADLING TRIM LH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(177, '48341-BZ200-US', 'UPPER SUPPORT (CAP)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(178, '10.01.00.23', 'BRACKET BODY 1', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(179, '48341-B2180-US', 'UPPER SUPPORT (CAP) D74', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(180, '30515-K1Z -J500', 'STAY, IGN COIL', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(181, '50322-K3V -N000', 'STAY, ABS MOD', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(182, '50106-K59 -A100-H1', 'BRKT PIVOT L (PLATE)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(183, '77202-K3N -N002', 'HINGE,SEAT', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(184, '50718-K2C -V000', 'PLATE P STEP CLICK', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(185, '53115-K3N -N000', 'STAY,METER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(186, '5019A-K3N -N000-DL', 'STAY,L LUGGAGE (STAY)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(187, '50195-K3N -N000-H1', 'STAY,R LUGGAGE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(188, '64270-K3N -N000', 'STAY COMP,CONTACTOR (STAY)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(189, '1520A-K1A -N800-DL', 'JET PISTON ASSY (PLATE OIL JET)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(190, '5014D-K1A -N800-DL', 'PIPE, LOWER CROSS', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(191, '81110-K2F -NC00', 'BRKT,FR NUMBER PLATE (STAY)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(192, '50622-K1Y -DC00', 'STAY COMP ECU (PLATE A)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(193, '90428-KWP-9000', 'WASHER, TRUST 10MM', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(194, '15134-K1AL-N801-H1', 'PLATE OIL PUMP GEAR', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(195, '11349-K1AL-N801-H1', 'COLLAR, L COVER PLATE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(196, '1A815-K4B -D000', 'PLATE,RESOLVER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(197, '1A816-K4B -D000', 'PLATE,RESOLVER CODE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(198, '1A462-K4B -D000', 'STAY A,MOTOR CABLE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(199, '1A821-K4B -D000', 'STAY,MOTOR CABLE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(200, '1A461-K4B -D000', 'PLATE,MOTOR CABLE STAY', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(201, '90441-K4BA-D000', 'WASHER,14.2X29X2.5', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(202, '1A464-K3N -N000', 'STAY B,MOTOR CABLE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(203, '1A862-K4B -D000', 'STAY,THERMISTOR CLIP', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(204, '1A325-K4B -D000', 'COLLAR,MAGNET PLATE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(205, 'RET-02-027', 'RETAINER, REAR A/C INLET RH 4L45W 26MY', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(206, 'RET-02-028', 'RETAINER, REAR A/C INLET LH 4L45W 26MY', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(207, 'BRA-00-016', 'BRKT ROOF SIDE GARN 1 5J45', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(208, 'BRA-00-017', 'BRKT ROOF SIDE GARN 2 5J45', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(209, '5015A-K3N -N00-DL', 'BRKT,SEAT CATCH SUB ASSY (PLATE A)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(210, '5071A-KZL -A006-IN.1', 'BAR , R P STEP (PATCH) (CKD+MMP)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(211, '5071B-KZL -A006-IN.1', 'BAR ASSY, L P STEP (PATCH) (CKD+MMP)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(212, '90441-GY6 -9404', 'WASHER 12.2X29X2.5', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(213, '77236-GJR -N000', 'GUARD,SEAT CATCH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(214, '81143-K2T -C000', 'HINGE,INNER BOX (HINGE)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(215, '00346718', 'LOW HEAT PLATE LH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(216, '00346719', 'LOW HEAT PLATE RH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(217, '00346748', 'HIGH HEAT PLATE LH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(218, '00346749', 'HIGH HEAT PLATE RH', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(219, '90428-KVB-S500', 'WASHER 12 MM', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(220, '1A816-K4H-T000', 'PLATE, RESOLVER CORD', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(221, '1A462-K4H-T000', 'STAY A, MOTOR CABLE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(222, '1A862-K4H-T000', 'STAY, THERMISTOR CORD (STAY A)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(223, '17531-K2VM-N803', 'STAY COMP,FUEL HOSE CLAMPER A', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(224, '17535-K2VM-N803', 'STAY COMP,FUEL HOSE CLAMPER B', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(225, '30515-K2VM-N801', 'STAY COMP,IGN COIL', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(226, '5015E-K2VM-N801', 'BRKT,PIVOT L (PLATE)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(227, '17531-K2V -M400', 'STAY COMP,FUEL HOSE CLAMPER A', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(228, '17535-K2V -M400', 'STAY COMP,FUEL HOSE CLAMPER B', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(229, '10.50.45.43', 'BRACKET BODY NO.1', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(230, '74712-BZ060', 'BRACKET BODY', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(231, '13371 -K2Z -V200 -H1', 'PLATE ,R CRANK SIDE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(232, '32115 -K2S -V000', 'STAY COMP ,HARNESS', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(233, '43458 -K2SM -N801', 'CLAMPER A ,RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(234, '43459 -K2Z -V200', 'CLAMPER B ,RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(235, '5014A -K0J -NA01', 'GUSSET COMP ,FR (SOZAI)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(236, '50108 -K2SM -N801 -H1', 'STAY ,INNER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(237, '50105-K59 -A100-H1', 'BRKT,PIVOT R', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(238, '45156-KWW -A001', 'CLAMPER, BRK HOSE (AHM + HTI)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(239, '18422-KAF -7001', 'COLLAR,MUFF MOUNT', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(240, '18442-KRC -9001', 'COLLAR,MUFFLER MOUNT', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(241, 'GA 0E04700', 'Component Assy', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(242, 'GG0G00400', 'GROMMET ASSY(HILEX)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(243, '30515-K35 -V000', 'STAY COMP,IGN COIL (BODY + COUPLER MCT)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(244, '50194-K59 -A100-H1', 'STAY,LUGGAGE L (BODY +NUT)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(245, '50195-K59 -A100-H1', 'STAY,LUGGAGE R (BODY + NUT)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(246, '5071A-K2VM-N002', 'BAR,R P STEP SET (BAR)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(247, '5071B-K2VM-N002', 'BAR,L P STEP SET', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(248, '50313-K97 -T001', 'GUIDE BRK HOSE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(249, '17219-K97 -T001', 'CLAMPER TUBE BREATHER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(250, '5010J-K0J -N002-IN', 'STAY R FLOOR STEP FR (BODY + NUT KPH)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(251, '5010K-K0J -N002-IN', 'STAY L FLOOR STEP FR (BODY + NUT KPH)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(252, '50108-K0J -N000-H1', 'STAY INNER (PLATE + NUT KPH)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(253, '17506-K1Z -J100', 'PLATE,FUEL TANK', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(254, '50313-K1Z -J100', 'GUIDE,BRAKE HOSE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(255, '32963-K1Z -J100', 'STAY,ENG HARNESS', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(256, '17533-K0R -V001', 'STAY COMP HOSE CLAMPER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(257, '81110-K0J -N000', 'BRKT,FR NUMBER PLATE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(258, '32115-K1Z -J100', 'STAY SUB HARNESS ENG (GUIDE)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(259, '30515-K1N -V001', 'STAY COMP IGN COIL (STAY + WIRE)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(260, '5010E-K2S -N003-DL', 'STAY R FLOOR STEP FR  (STAY R + NUT KPH)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(261, '5010F-K2S -N000-DL', 'STAY INNER (BODY + NUT PROJECTION)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(262, '5014G-K2S -N001-DL', 'STAY R FUEL TANK (BODY + NUT HEX)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(263, '5014H-K2S -N001-DL', 'STAY L FUEL TANK', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(264, '50322-K2S -N100', 'STAY ABS MOD', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(265, '45156-K2S -N100', 'CLAMPER COMP A, BRAKE HOSE', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(266, '45156-K41 -NC01', 'WIRE CLAMPER COMP FR BRK HOSE K41', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(267, '5014C-K3V -N000-DL', 'STAY,R FUEL TANK (SOZAI)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(268, '5014D-K3V -N000-DL', 'STAY,L FUEL TANK (SOZAI)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(269, '30515-K2S -V000', 'STAY, IGN COIL', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(270, '5071B-K1A -N800-DL', 'BAR ASSY, L P STEP', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(271, '5071A-K1A -N800-DL', 'BAR ASSY, R P STEP (BAR R)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(272, '50108-K1A -N800-H1', 'STAY INNER (PLATE + NUT)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(273, '5010B-K1A -N800-DL', 'STAY L FLOOR STEP FR (STAY + NUT KVG)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(274, '5010D-K1A -N800-DL', 'STAY R FLOOR STEP FR (BODY + NUT KVG)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(275, '30515-K1Z -NA00', 'STAY COMP,IGN COIL', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(276, '50194-K2VM-N801-H1', 'STAY,LUGGAGE L', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(277, '50195-K2VM-N801-H1', 'STAY,LUGGAGE R', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(278, '5071A-K25 -9004-IN', 'BAR ASSY, R P STEP (BAR R)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(279, '5071B-K25 -9004-IN', 'BAR ASSY, L P STEP (BAR R)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(280, '35751-KPH -9003', 'CAP,CONTACT CHANGE SW (KPH/KRM)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(281, 'AQ 40100 FO', 'Clamp', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(282, '61104-428 -0100', 'COLLAR, FR. FENDER (COLLAR)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(283, '17232-KYJ -9000', 'COLLAR,AIR/C MOUNT (COLLAR)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(284, 'AN 11125 FO', 'Nipple End', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(285, '80108-K45 -N400', 'COLLAR RR FENDER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(286, '84706-163 -6703', 'COLLAR TAIL LIGHT (COLLAR)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(287, '94201-16150', 'PIN SPLIT 16X15', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(288, '94201-16180', 'PIN SPLIT 16X18', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(289, '94201-20120', 'PIN SPLIT 2 X 12', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(290, '94201-20150', 'PIN SPLIT 2 X 15', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(291, '94201-30200', 'PIN SPLIT 3 X 20', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(292, '94201-30300', 'PIN SPLIT3 X 30', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(293, '90677-KAN-T004', 'Nut, Clip 5mm + (NON AHM)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(294, '1520A-K0J -N000-IN', 'JET,PISTON ASSY', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(295, '33707-K1Z -N200', 'COLLER,TAIL LIGHT (COLLAR)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(296, '1520A-K1Z -N200-DL', 'JET COMP PISTON ASSY (PIPE, OIL JET)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(297, '90344- KRB-9003', 'NUT CLIP 5 MM', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(298, '61104-KZZ -9002', 'COLLAR (COLLAR)', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(299, '81312-KW7 -9001', 'COLLAR, FR FENDER', 'stamping', 1, '2026-06-26 09:14:28', '2026-06-26 09:14:28'),
(300, 'T.3 IP-159007', 'METAL PIPE 22.4', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(301, '94251-06000', 'PIN LOCK 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(302, '90320-GC3-003', 'NUT, SPRING 5MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(303, '50386-K18-9000', 'BAND BATTERY', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(304, '53173-KVB -9200', 'BAND, HANDLE BRKT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(305, '32961-KWN -9000', 'CLAMP,ACG CORD', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(306, '17913-K59 -A100', 'CLAMPER THROTTLE CABLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(307, '32111-KYE -9001', 'CLAMPER,ACG CORD', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(308, '32961-K44 -V000', 'CLAMPER,ACG CORD', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(309, '90310-KWS-9000', 'COLLAR FRONT COWL', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(310, 'COLLAR MUFF PROTECTOR', 'COLLAR MUFF PROTECTOR', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(311, '38112-K41 -N001', 'COLLAR, HORN SET', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(312, '38112-KZL -A001', 'COLLAR,HORN SET', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(313, '40511-K15-9000', 'COLLAR DRIVE CHAIN CASE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(314, '30401-GGZ -J000', 'COVER, ENG CONTL UNIT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(315, '30401-K59 -A100', 'COVER, ENG CONTL UNIT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(316, '11230-KVB -9001', 'COVER,VENT HOLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(317, 'AH 51026 FO', 'Holder', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(318, '50523-KWB -9201', 'HOOK, MAIN STAND SPRING', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(319, '43129-KVR-6000', 'Metal Sliper', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(320, 'AN 10447 FD', 'Nipple End', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(321, 'AN 11155 FO', 'Nipple End', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(322, '90305-GK8-0002', 'NUT,CLIP 6 MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(323, '90302-KWW -A003', 'NUT SPRING 4MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(324, '90302-KWW -A002', 'NUT SPRING 4MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(325, '90302-GW3 -9800', 'NUT SPRING 4MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(326, '90677-KAN -T004', 'NUT, CLIP 5MM T', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(327, '90305-KWW -A001', 'NUT, CLIP 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(328, '23811-KR3 -6003', 'PLATE A2,FIXING', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(329, '50711-K15-9000', 'PLATE P STEP CLICK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(330, '11333-KGH-9000', 'Plate R Cover', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(331, '11218-KWW -7402', 'PLATE, OIL STOPPER', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(332, '11217-KRM -8403', 'PLATE,BRG PUSH (AHM + HTI)', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(333, '90441-KRM -8404', 'PLATE,BRG HOLD (AHM + HTI)', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(334, '22821-K56 -N001', 'RECEIVER,CLUTCH CABLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(335, '50168-K59 -A100-H1', 'STAY, L  FUEL TANK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(336, '50158-K59 -A100-H1', 'STAY, R  FUEL TANK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(337, '90485-040 -0004', 'WASHER 8 MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(338, '90431-GN5 -9102', 'WASHER LOCK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(339, '90402-KWW -7402', 'WASHER, 7.2X16X2.5', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(340, '90404-KWB -6001', 'WASHER, 8.5X26X2.3', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(341, '90122-KWB -6002', 'WASHER, PIVOT BOLT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(342, '90504-KW7 -9000', 'WASHER, RR AXLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(343, '90501-KST -9202', 'WASHER, SEAT MT. 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(344, '90412-KZL -8401', 'WASHER, THRUST. 10MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(345, '90439-KWZ -9002', 'WASHER,12X24X2.3', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(346, '90402-KRM -8400', 'WASHER,28.1X36X1.8', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(347, '90423-KW6-9000', 'Washer,7x13x1,2', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(348, '90483-KWN -9000', 'WASHER,8MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(349, '90417-KRM -8403', 'WASHER,DRUM STOPPER (AHM + HTI)', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(350, '94103-12000', 'WASHER,PLAIN 12MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(351, '94103-06000', 'WASHER,PLAIN 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(352, '94101-10800', 'WASHER,PLAIN,10MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(353, '90426-KZL -8400', 'WASHER,SPECIAL 14MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(354, '90402-KW7 -9001', 'WASHER,THRUST 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(355, '50201-K56 -N101', 'STAY HARNESS', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(356, '50606-K56 -N001', 'GUARD, R HEEL', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(357, '32962-K81 -N001', 'CLAMP,ENG HARNESS', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(358, '18295-GW0 -9202', 'COLLAR M5', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(359, '61102-KTY -D304', 'COLLAR RADIATOR MOUNT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(360, '90559-K84 -9002', 'WASHER, RR AXLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(361, '50718-K97 -T000', 'PLATE R P STEP  CLICK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(362, '50719-K97 -T000', 'PLATE L P STEP  CLICK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(363, '50718 - K59J - A701', 'PLATE, P STEP CLICK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(364, '90305-GEE -7100', 'NUT CLIP 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(365, '80102-K0JA-N000', 'NUT, CLIP 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(366, '11342-K0J -N000', 'PLATE L COVER', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(367, '11208-K0J -N000', 'PLATE, MISSION BRG SET', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(368, '90302-KWW-A000', 'NUT SPRING 4MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(369, '90311-MT3 -0002', 'NUT,CLIP 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(370, '5014G-K0J -N000-IN', 'STAY R LUGGAGE BOX', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(371, '5014H-K0J -N000-IN', 'STAY L LUGGAGE BOX', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(372, '30401-K1A -N000', 'COVER,ENG CONTL UNIT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(373, '5010L-K0J -N000-IN', 'PLATE INNER', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(374, '90502-KWN -6701', 'WASHER, 10MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(375, '94101-08800', 'WASHER PLAIN 8MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(376, '17912-K1Z -J100', 'CLAMPER,THROT CABLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(377, '50718-K1Z -J100', 'PLATE,R P STEP CLICK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(378, '50719-K1Z -J100', 'PLATE,L P STEP CLICK', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(379, '53137-K1Z -J102', 'WASHER,HNDL UNDER HOLDER', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(380, '11208-K40 -F001', 'PLATE, L CRANK BRG SET', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(381, '50310-K2F -N000', 'STAY ECU', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(382, '84601-HA7-6701', 'NUT FENDER SET', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(383, '64224-K0J -N000', 'COLLAR,8MM (COLLAR)', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(384, 'SUP-04-011 / 63612-VT010', 'SUPPORT,COLLER DUCT REGISTER, NO.2', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(385, 'SUP-04-012 / 63612-VT020', 'SUPPORT,COLLER DUCT REGISTER, NO.2', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(386, '32962-K0R -V000', 'STAY HARNESS CLIP & ENG EARTH', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(387, '32961-K0R -V001', 'CLAMP ACG CORD', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(388, '43458-K2S -N000', 'CLAMPER B RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(389, '43459-K1Y -D100', 'CLAMPER C RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(390, '50149-K1N -V000-H1', 'STAY HARNESS', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(391, '45157-K2S -N100', 'CLAMPER B BRAKE HOSE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(392, '61103-K3BA-N000', 'COLLAR, H/L MOUNT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(393, '64224-K2SA-N001', 'COLLAR,FR COVER STAY', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(394, '90404-KWW -7402', 'WASHER, 8.5X26X2.3', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(395, '94101-08000', 'WASHER PLAIN 8MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(396, '45156-K0W -NB00', 'CLAMPER A, FR BRAKE HOSE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(397, '45157-K0W -NB00', 'CLAMPER B, FR BRAKE HOSE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(398, 'RET-02-025 / 63378-VT010', 'RETAINER ROOF HL SUPPORT NO.2 NR', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(399, 'RET-02-026 / 63378-VT030', 'RETAINER ROOF HL SUPPORT NO.2 PR', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(400, 'SUP-04-002 / 63612-0K090-A', 'SUPPORT COOLER DUCT NO.2', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(401, '50321-K12 -V101', 'STAY, SMART ECU', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(402, '43455-K1A -N800', 'CLAMPER, A RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(403, '43456-K1A -N800', 'CLAMPER, B RR BRK CABLE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(404, '30401-K1A -N800', 'COVER, ENG CONTL UNIT', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(405, '45156-K1Y -DC00', 'CLAMPER A, FR BRK HOSE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(406, '45157-K1Y -DC00', 'CLAMPER B, FR BRK HOSE', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(407, '94251-05000', 'PIN LOCK 5MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(408, '90311-K1AL-N801', 'NUT,CLIP 6MM', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(409, '81145-K93 -N001', 'SPRING,LID', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(410, '93903-24380', 'SCREW, TAPPING 4 x 12', 'stamping', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `part_divisions`
--

CREATE TABLE `part_divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `part_divisions`
--

INSERT INTO `part_divisions` (`id`, `part_id`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-08-05 08:26:50', '2026-08-05 08:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `part_processes`
--

CREATE TABLE `part_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED NOT NULL,
  `sub_process_id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `part_processes`
--

INSERT INTO `part_processes` (`id`, `part_id`, `sub_process_id`, `urutan`, `created_at`, `updated_at`) VALUES
(3, 1, 88, 1, '2026-08-06 06:12:57', '2026-08-06 06:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `part_sub_processes`
--

CREATE TABLE `part_sub_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED NOT NULL,
  `sub_process_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `part_sub_processes`
--

INSERT INTO `part_sub_processes` (`id`, `part_id`, `sub_process_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 2, 1, NULL, NULL),
(6, 2, 5, NULL, NULL),
(7, 2, 6, NULL, NULL),
(8, 3, 1, NULL, NULL),
(9, 3, 2, NULL, NULL),
(10, 3, 7, NULL, NULL),
(11, 4, 8, NULL, NULL),
(12, 5, 8, NULL, NULL),
(13, 6, 1, NULL, NULL),
(14, 6, 2, NULL, NULL),
(15, 6, 7, NULL, NULL),
(16, 7, 8, NULL, NULL),
(17, 8, 8, NULL, NULL),
(18, 9, 1, NULL, NULL),
(19, 9, 2, NULL, NULL),
(20, 9, 9, NULL, NULL),
(21, 9, 7, NULL, NULL),
(22, 10, 1, NULL, NULL),
(23, 10, 2, NULL, NULL),
(24, 10, 9, NULL, NULL),
(25, 10, 7, NULL, NULL),
(26, 11, 1, NULL, NULL),
(27, 12, 1, NULL, NULL),
(28, 12, 10, NULL, NULL),
(29, 13, 11, NULL, NULL),
(30, 14, 1, NULL, NULL),
(31, 14, 12, NULL, NULL),
(32, 14, 13, NULL, NULL),
(33, 15, 14, NULL, NULL),
(34, 15, 15, NULL, NULL),
(35, 16, 1, NULL, NULL),
(36, 16, 5, NULL, NULL),
(37, 16, 16, NULL, NULL),
(38, 17, 17, NULL, NULL),
(39, 17, 2, NULL, NULL),
(40, 17, 3, NULL, NULL),
(41, 17, 4, NULL, NULL),
(42, 18, 1, NULL, NULL),
(43, 18, 2, NULL, NULL),
(44, 18, 18, NULL, NULL),
(45, 18, 6, NULL, NULL),
(46, 18, 4, NULL, NULL),
(47, 19, 1, NULL, NULL),
(48, 19, 19, NULL, NULL),
(49, 19, 5, NULL, NULL),
(50, 19, 4, NULL, NULL),
(51, 20, 17, NULL, NULL),
(52, 21, 17, NULL, NULL),
(53, 22, 1, NULL, NULL),
(54, 23, 1, NULL, NULL),
(55, 23, 5, NULL, NULL),
(56, 23, 20, NULL, NULL),
(57, 23, 2, NULL, NULL),
(58, 24, 1, NULL, NULL),
(59, 24, 2, NULL, NULL),
(60, 24, 6, NULL, NULL),
(61, 25, 1, NULL, NULL),
(62, 25, 2, NULL, NULL),
(63, 25, 6, NULL, NULL),
(64, 26, 17, NULL, NULL),
(65, 27, 1, NULL, NULL),
(66, 27, 6, NULL, NULL),
(67, 27, 2, NULL, NULL),
(68, 28, 21, NULL, NULL),
(69, 28, 22, NULL, NULL),
(70, 28, 23, NULL, NULL),
(71, 28, 24, NULL, NULL),
(72, 28, 6, NULL, NULL),
(73, 28, 25, NULL, NULL),
(74, 28, 9, NULL, NULL),
(75, 29, 1, NULL, NULL),
(76, 29, 2, NULL, NULL),
(77, 29, 6, NULL, NULL),
(78, 30, 1, NULL, NULL),
(79, 31, 1, NULL, NULL),
(80, 32, 1, NULL, NULL),
(81, 33, 1, NULL, NULL),
(82, 34, 1, NULL, NULL),
(83, 35, 1, NULL, NULL),
(84, 35, 2, NULL, NULL),
(85, 35, 6, NULL, NULL),
(86, 36, 26, NULL, NULL),
(87, 36, 6, NULL, NULL),
(88, 36, 27, NULL, NULL),
(89, 36, 28, NULL, NULL),
(90, 37, 1, NULL, NULL),
(91, 38, 1, NULL, NULL),
(92, 39, 1, NULL, NULL),
(93, 40, 1, NULL, NULL),
(94, 40, 29, NULL, NULL),
(95, 40, 6, NULL, NULL),
(96, 41, 1, NULL, NULL),
(97, 41, 26, NULL, NULL),
(98, 41, 2, NULL, NULL),
(99, 41, 30, NULL, NULL),
(100, 41, 6, NULL, NULL),
(101, 42, 17, NULL, NULL),
(102, 43, 1, NULL, NULL),
(103, 43, 2, NULL, NULL),
(104, 43, 6, NULL, NULL),
(105, 44, 1, NULL, NULL),
(106, 44, 2, NULL, NULL),
(107, 44, 6, NULL, NULL),
(108, 45, 1, NULL, NULL),
(109, 46, 1, NULL, NULL),
(110, 46, 2, NULL, NULL),
(111, 46, 7, NULL, NULL),
(112, 46, 11, NULL, NULL),
(113, 46, 18, NULL, NULL),
(114, 47, 1, NULL, NULL),
(115, 48, 31, NULL, NULL),
(116, 48, 21, NULL, NULL),
(117, 48, 25, NULL, NULL),
(118, 48, 32, NULL, NULL),
(119, 48, 6, NULL, NULL),
(120, 48, 33, NULL, NULL),
(121, 48, 27, NULL, NULL),
(122, 49, 31, NULL, NULL),
(123, 49, 21, NULL, NULL),
(124, 49, 25, NULL, NULL),
(125, 49, 32, NULL, NULL),
(126, 49, 6, NULL, NULL),
(127, 49, 33, NULL, NULL),
(128, 49, 27, NULL, NULL),
(129, 50, 1, NULL, NULL),
(130, 50, 2, NULL, NULL),
(131, 50, 34, NULL, NULL),
(132, 50, 32, NULL, NULL),
(133, 51, 1, NULL, NULL),
(134, 51, 2, NULL, NULL),
(135, 51, 7, NULL, NULL),
(136, 52, 1, NULL, NULL),
(137, 52, 2, NULL, NULL),
(138, 52, 7, NULL, NULL),
(139, 53, 1, NULL, NULL),
(140, 53, 2, NULL, NULL),
(141, 54, 1, NULL, NULL),
(142, 55, 1, NULL, NULL),
(143, 55, 35, NULL, NULL),
(144, 56, 1, NULL, NULL),
(145, 56, 36, NULL, NULL),
(146, 57, 1, NULL, NULL),
(147, 58, 37, NULL, NULL),
(148, 59, 1, NULL, NULL),
(149, 60, 17, NULL, NULL),
(150, 61, 1, NULL, NULL),
(151, 62, 1, NULL, NULL),
(152, 63, 1, NULL, NULL),
(153, 64, 1, NULL, NULL),
(154, 64, 2, NULL, NULL),
(155, 65, 1, NULL, NULL),
(156, 66, 1, NULL, NULL),
(157, 67, 1, NULL, NULL),
(158, 68, 1, NULL, NULL),
(159, 69, 1, NULL, NULL),
(160, 70, 1, NULL, NULL),
(161, 71, 1, NULL, NULL),
(162, 72, 1, NULL, NULL),
(163, 72, 2, NULL, NULL),
(164, 73, 1, NULL, NULL),
(165, 73, 2, NULL, NULL),
(166, 73, 6, NULL, NULL),
(167, 73, 7, NULL, NULL),
(168, 73, 11, NULL, NULL),
(169, 73, 38, NULL, NULL),
(170, 74, 1, NULL, NULL),
(171, 74, 39, NULL, NULL),
(172, 75, 1, NULL, NULL),
(173, 75, 2, NULL, NULL),
(174, 75, 7, NULL, NULL),
(175, 76, 1, NULL, NULL),
(176, 76, 40, NULL, NULL),
(177, 77, 41, NULL, NULL),
(178, 77, 42, NULL, NULL),
(179, 77, 43, NULL, NULL),
(180, 78, 41, NULL, NULL),
(181, 78, 42, NULL, NULL),
(182, 78, 43, NULL, NULL),
(183, 79, 1, NULL, NULL),
(184, 79, 40, NULL, NULL),
(185, 79, 13, NULL, NULL),
(186, 80, 44, NULL, NULL),
(187, 80, 2, NULL, NULL),
(188, 81, 1, NULL, NULL),
(189, 81, 45, NULL, NULL),
(190, 81, 25, NULL, NULL),
(191, 81, 6, NULL, NULL),
(192, 81, 42, NULL, NULL),
(193, 82, 46, NULL, NULL),
(194, 82, 47, NULL, NULL),
(195, 83, 1, NULL, NULL),
(196, 84, 1, NULL, NULL),
(197, 85, 1, NULL, NULL),
(198, 85, 2, NULL, NULL),
(199, 86, 1, NULL, NULL),
(200, 86, 2, NULL, NULL),
(201, 87, 1, NULL, NULL),
(202, 87, 48, NULL, NULL),
(203, 88, 1, NULL, NULL),
(204, 88, 2, NULL, NULL),
(205, 89, 41, NULL, NULL),
(206, 90, 1, NULL, NULL),
(207, 90, 2, NULL, NULL),
(208, 90, 9, NULL, NULL),
(209, 90, 7, NULL, NULL),
(210, 91, 1, NULL, NULL),
(211, 91, 40, NULL, NULL),
(212, 91, 6, NULL, NULL),
(213, 92, 1, NULL, NULL),
(214, 92, 2, NULL, NULL),
(215, 93, 41, NULL, NULL),
(216, 94, 1, NULL, NULL),
(217, 94, 49, NULL, NULL),
(218, 94, 7, NULL, NULL),
(219, 95, 41, NULL, NULL),
(220, 96, 50, NULL, NULL),
(221, 96, 51, NULL, NULL),
(222, 97, 50, NULL, NULL),
(223, 97, 51, NULL, NULL),
(224, 98, 1, NULL, NULL),
(225, 98, 2, NULL, NULL),
(226, 99, 41, NULL, NULL),
(227, 100, 1, NULL, NULL),
(228, 100, 2, NULL, NULL),
(229, 101, 41, NULL, NULL),
(230, 102, 1, NULL, NULL),
(231, 102, 2, NULL, NULL),
(232, 102, 52, NULL, NULL),
(233, 103, 1, NULL, NULL),
(234, 103, 2, NULL, NULL),
(235, 104, 41, NULL, NULL),
(236, 104, 1, NULL, NULL),
(237, 104, 40, NULL, NULL),
(238, 104, 11, NULL, NULL),
(239, 105, 41, NULL, NULL),
(240, 106, 1, NULL, NULL),
(241, 106, 40, NULL, NULL),
(242, 106, 11, NULL, NULL),
(243, 106, 6, NULL, NULL),
(244, 107, 1, NULL, NULL),
(245, 107, 40, NULL, NULL),
(246, 107, 53, NULL, NULL),
(247, 108, 1, NULL, NULL),
(248, 108, 2, NULL, NULL),
(249, 109, 17, NULL, NULL),
(250, 109, 2, NULL, NULL),
(251, 109, 54, NULL, NULL),
(252, 109, 4, NULL, NULL),
(253, 110, 55, NULL, NULL),
(254, 110, 56, NULL, NULL),
(255, 110, 57, NULL, NULL),
(256, 111, 41, NULL, NULL),
(257, 112, 58, NULL, NULL),
(258, 112, 59, NULL, NULL),
(259, 112, 60, NULL, NULL),
(260, 112, 61, NULL, NULL),
(261, 113, 55, NULL, NULL),
(262, 113, 62, NULL, NULL),
(263, 113, 63, NULL, NULL),
(264, 113, 58, NULL, NULL),
(265, 114, 58, NULL, NULL),
(266, 114, 59, NULL, NULL),
(267, 115, 58, NULL, NULL),
(268, 115, 59, NULL, NULL),
(269, 115, 60, NULL, NULL),
(270, 115, 61, NULL, NULL),
(271, 115, 42, NULL, NULL),
(272, 115, 64, NULL, NULL),
(273, 116, 58, NULL, NULL),
(274, 116, 65, NULL, NULL),
(275, 117, 41, NULL, NULL),
(276, 118, 58, NULL, NULL),
(277, 118, 65, NULL, NULL),
(278, 119, 58, NULL, NULL),
(279, 119, 65, NULL, NULL),
(280, 120, 58, NULL, NULL),
(281, 120, 66, NULL, NULL),
(282, 120, 65, NULL, NULL),
(283, 121, 41, NULL, NULL),
(284, 121, 58, NULL, NULL),
(285, 121, 59, NULL, NULL),
(286, 121, 67, NULL, NULL),
(287, 122, 58, NULL, NULL),
(288, 122, 59, NULL, NULL),
(289, 122, 60, NULL, NULL),
(290, 123, 58, NULL, NULL),
(291, 123, 59, NULL, NULL),
(292, 123, 60, NULL, NULL),
(293, 124, 41, NULL, NULL),
(294, 124, 58, NULL, NULL),
(295, 124, 59, NULL, NULL),
(296, 124, 68, NULL, NULL),
(297, 125, 69, NULL, NULL),
(298, 125, 65, NULL, NULL),
(299, 126, 70, NULL, NULL),
(300, 126, 40, NULL, NULL),
(301, 126, 11, NULL, NULL),
(302, 126, 2, NULL, NULL),
(303, 127, 58, NULL, NULL),
(304, 127, 2, NULL, NULL),
(305, 127, 6, NULL, NULL),
(306, 128, 70, NULL, NULL),
(307, 128, 40, NULL, NULL),
(308, 128, 11, NULL, NULL),
(309, 129, 70, NULL, NULL),
(310, 129, 40, NULL, NULL),
(311, 130, 65, NULL, NULL),
(312, 130, 66, NULL, NULL),
(313, 131, 41, NULL, NULL),
(314, 131, 58, NULL, NULL),
(315, 131, 40, NULL, NULL),
(316, 132, 41, NULL, NULL),
(317, 133, 71, NULL, NULL),
(318, 133, 65, NULL, NULL),
(319, 134, 55, NULL, NULL),
(320, 134, 72, NULL, NULL),
(321, 134, 73, NULL, NULL),
(322, 135, 41, NULL, NULL),
(323, 135, 58, NULL, NULL),
(324, 135, 65, NULL, NULL),
(325, 136, 58, NULL, NULL),
(326, 137, 58, NULL, NULL),
(327, 138, 41, NULL, NULL),
(328, 139, 69, NULL, NULL),
(329, 139, 74, NULL, NULL),
(330, 140, 69, NULL, NULL),
(331, 140, 74, NULL, NULL),
(332, 141, 58, NULL, NULL),
(333, 141, 65, NULL, NULL),
(334, 141, 66, NULL, NULL),
(335, 142, 58, NULL, NULL),
(336, 142, 75, NULL, NULL),
(337, 142, 76, NULL, NULL),
(338, 142, 77, NULL, NULL),
(339, 142, 78, NULL, NULL),
(340, 142, 79, NULL, NULL),
(341, 142, 80, NULL, NULL),
(342, 142, 81, NULL, NULL),
(343, 142, 82, NULL, NULL),
(344, 142, 41, NULL, NULL),
(345, 143, 41, NULL, NULL),
(346, 143, 42, NULL, NULL),
(347, 143, 43, NULL, NULL),
(348, 144, 41, NULL, NULL),
(349, 144, 42, NULL, NULL),
(350, 144, 43, NULL, NULL),
(351, 145, 58, NULL, NULL),
(352, 145, 56, NULL, NULL),
(353, 145, 83, NULL, NULL),
(354, 145, 42, NULL, NULL),
(355, 146, 58, NULL, NULL),
(356, 146, 56, NULL, NULL),
(357, 146, 83, NULL, NULL),
(358, 146, 84, NULL, NULL),
(359, 147, 58, NULL, NULL),
(360, 147, 85, NULL, NULL),
(361, 147, 86, NULL, NULL),
(362, 147, 65, NULL, NULL),
(363, 147, 68, NULL, NULL),
(364, 147, 87, NULL, NULL),
(365, 147, 88, NULL, NULL),
(366, 148, 71, NULL, NULL),
(367, 148, 59, NULL, NULL),
(368, 149, 71, NULL, NULL),
(369, 149, 59, NULL, NULL),
(370, 149, 67, NULL, NULL),
(371, 150, 58, NULL, NULL),
(372, 150, 89, NULL, NULL),
(373, 150, 90, NULL, NULL),
(374, 150, 91, NULL, NULL),
(375, 150, 92, NULL, NULL),
(376, 150, 93, NULL, NULL),
(377, 150, 94, NULL, NULL),
(378, 150, 95, NULL, NULL),
(379, 150, 96, NULL, NULL),
(380, 150, 97, NULL, NULL),
(381, 150, 66, NULL, NULL),
(382, 151, 58, NULL, NULL),
(383, 151, 89, NULL, NULL),
(384, 151, 90, NULL, NULL),
(385, 151, 91, NULL, NULL),
(386, 151, 92, NULL, NULL),
(387, 151, 93, NULL, NULL),
(388, 151, 94, NULL, NULL),
(389, 151, 95, NULL, NULL),
(390, 151, 96, NULL, NULL),
(391, 151, 97, NULL, NULL),
(392, 151, 66, NULL, NULL),
(393, 152, 58, NULL, NULL),
(394, 152, 65, NULL, NULL),
(395, 152, 46, NULL, NULL),
(396, 153, 58, NULL, NULL),
(397, 153, 65, NULL, NULL),
(398, 153, 46, NULL, NULL),
(399, 154, 58, NULL, NULL),
(400, 154, 98, NULL, NULL),
(401, 154, 59, NULL, NULL),
(402, 155, 58, NULL, NULL),
(403, 155, 99, NULL, NULL),
(404, 156, 58, NULL, NULL),
(405, 156, 99, NULL, NULL),
(406, 157, 92, NULL, NULL),
(407, 157, 93, NULL, NULL),
(408, 157, 94, NULL, NULL),
(409, 157, 95, NULL, NULL),
(410, 157, 96, NULL, NULL),
(411, 157, 97, NULL, NULL),
(412, 157, 100, NULL, NULL),
(413, 157, 66, NULL, NULL),
(414, 157, 58, NULL, NULL),
(415, 157, 99, NULL, NULL),
(416, 157, 79, NULL, NULL),
(417, 158, 92, NULL, NULL),
(418, 158, 93, NULL, NULL),
(419, 158, 94, NULL, NULL),
(420, 158, 95, NULL, NULL),
(421, 158, 96, NULL, NULL),
(422, 158, 97, NULL, NULL),
(423, 158, 100, NULL, NULL),
(424, 158, 66, NULL, NULL),
(425, 158, 58, NULL, NULL),
(426, 158, 99, NULL, NULL),
(427, 158, 25, NULL, NULL),
(428, 159, 58, NULL, NULL),
(429, 159, 98, NULL, NULL),
(430, 159, 59, NULL, NULL),
(431, 160, 71, NULL, NULL),
(432, 161, 101, NULL, NULL),
(433, 162, 1, NULL, NULL),
(434, 162, 66, NULL, NULL),
(435, 162, 2, NULL, NULL),
(436, 162, 102, NULL, NULL),
(437, 163, 1, NULL, NULL),
(438, 163, 103, NULL, NULL),
(439, 163, 67, NULL, NULL),
(440, 164, 104, NULL, NULL),
(441, 165, 1, NULL, NULL),
(442, 166, 55, NULL, NULL),
(443, 166, 66, NULL, NULL),
(444, 166, 27, NULL, NULL),
(445, 166, 46, NULL, NULL),
(446, 167, 58, NULL, NULL),
(447, 167, 40, NULL, NULL),
(448, 167, 105, NULL, NULL),
(449, 168, 17, NULL, NULL),
(450, 168, 58, NULL, NULL),
(451, 168, 65, NULL, NULL),
(452, 169, 106, NULL, NULL),
(453, 169, 2, NULL, NULL),
(454, 169, 40, NULL, NULL),
(455, 170, 17, NULL, NULL),
(456, 170, 58, NULL, NULL),
(457, 171, 58, NULL, NULL),
(458, 172, 71, NULL, NULL),
(459, 172, 40, NULL, NULL),
(460, 172, 66, NULL, NULL),
(461, 173, 69, NULL, NULL),
(462, 173, 74, NULL, NULL),
(463, 174, 69, NULL, NULL),
(464, 174, 107, NULL, NULL),
(465, 174, 42, NULL, NULL),
(466, 175, 58, NULL, NULL),
(467, 175, 108, NULL, NULL),
(468, 175, 109, NULL, NULL),
(469, 176, 58, NULL, NULL),
(470, 176, 108, NULL, NULL),
(471, 176, 109, NULL, NULL),
(472, 177, 55, NULL, NULL),
(473, 177, 110, NULL, NULL),
(474, 178, 58, NULL, NULL),
(475, 178, 111, NULL, NULL),
(476, 178, 112, NULL, NULL),
(477, 178, 113, NULL, NULL),
(478, 179, 66, NULL, NULL),
(479, 179, 114, NULL, NULL),
(480, 180, 58, NULL, NULL),
(481, 180, 66, NULL, NULL),
(482, 180, 115, NULL, NULL),
(483, 180, 42, NULL, NULL),
(484, 181, 106, NULL, NULL),
(485, 181, 115, NULL, NULL),
(486, 182, 106, NULL, NULL),
(487, 183, 106, NULL, NULL),
(488, 183, 46, NULL, NULL),
(489, 183, 116, NULL, NULL),
(490, 183, 66, NULL, NULL),
(491, 184, 106, NULL, NULL),
(492, 185, 106, NULL, NULL),
(493, 185, 117, NULL, NULL),
(494, 186, 118, NULL, NULL),
(495, 186, 115, NULL, NULL),
(496, 186, 2, NULL, NULL),
(497, 186, 119, NULL, NULL),
(498, 187, 106, NULL, NULL),
(499, 187, 115, NULL, NULL),
(500, 188, 118, NULL, NULL),
(501, 188, 115, NULL, NULL),
(502, 188, 11, NULL, NULL),
(503, 189, 58, NULL, NULL),
(504, 190, 65, NULL, NULL),
(505, 191, 41, NULL, NULL),
(506, 192, 106, NULL, NULL),
(507, 192, 120, NULL, NULL),
(508, 192, 9, NULL, NULL),
(509, 192, 2, NULL, NULL),
(510, 193, 41, NULL, NULL),
(511, 194, 69, NULL, NULL),
(512, 195, 69, NULL, NULL),
(513, 196, 41, NULL, NULL),
(514, 197, 41, NULL, NULL),
(515, 198, 55, NULL, NULL),
(516, 198, 115, NULL, NULL),
(517, 199, 41, NULL, NULL),
(518, 200, 41, NULL, NULL),
(519, 201, 58, NULL, NULL),
(520, 202, 41, NULL, NULL),
(521, 202, 121, NULL, NULL),
(522, 203, 41, NULL, NULL),
(523, 204, 122, NULL, NULL),
(524, 205, 55, NULL, NULL),
(525, 205, 120, NULL, NULL),
(526, 205, 79, NULL, NULL),
(527, 206, 55, NULL, NULL),
(528, 206, 120, NULL, NULL),
(529, 206, 79, NULL, NULL),
(530, 207, 123, NULL, NULL),
(531, 207, 124, NULL, NULL),
(532, 207, 79, NULL, NULL),
(533, 207, 66, NULL, NULL),
(534, 208, 123, NULL, NULL),
(535, 208, 79, NULL, NULL),
(536, 208, 66, NULL, NULL),
(537, 209, 125, NULL, NULL),
(538, 209, 2, NULL, NULL),
(539, 210, 41, NULL, NULL),
(540, 210, 42, NULL, NULL),
(541, 210, 43, NULL, NULL),
(542, 211, 41, NULL, NULL),
(543, 211, 42, NULL, NULL),
(544, 211, 43, NULL, NULL),
(545, 212, 1, NULL, NULL),
(546, 213, 1, NULL, NULL),
(547, 213, 115, NULL, NULL),
(548, 213, 126, NULL, NULL),
(549, 214, 1, NULL, NULL),
(550, 214, 115, NULL, NULL),
(551, 214, 127, NULL, NULL),
(552, 182, 1, NULL, NULL),
(553, 215, 55, NULL, NULL),
(554, 215, 72, NULL, NULL),
(555, 215, 73, NULL, NULL),
(556, 216, 55, NULL, NULL),
(557, 216, 72, NULL, NULL),
(558, 216, 73, NULL, NULL),
(559, 217, 55, NULL, NULL),
(560, 217, 72, NULL, NULL),
(561, 218, 55, NULL, NULL),
(562, 218, 72, NULL, NULL),
(563, 219, 69, NULL, NULL),
(564, 220, 41, NULL, NULL),
(565, 221, 55, NULL, NULL),
(566, 221, 128, NULL, NULL),
(567, 222, 41, NULL, NULL),
(568, 223, 41, NULL, NULL),
(569, 224, 41, NULL, NULL),
(570, 225, 41, NULL, NULL),
(571, 226, 58, NULL, NULL),
(572, 227, 41, NULL, NULL),
(573, 228, 41, NULL, NULL),
(574, 229, 58, NULL, NULL),
(575, 229, 66, NULL, NULL),
(576, 229, 129, NULL, NULL),
(577, 229, 88, NULL, NULL),
(578, 229, 130, NULL, NULL),
(579, 229, 101, NULL, NULL),
(580, 230, 41, NULL, NULL),
(581, 230, 58, NULL, NULL),
(582, 230, 56, NULL, NULL),
(583, 230, 66, NULL, NULL),
(584, 230, 131, NULL, NULL),
(585, 230, 132, NULL, NULL),
(586, 230, 101, NULL, NULL),
(587, 231, 58, NULL, NULL),
(588, 231, 46, NULL, NULL),
(589, 231, 66, NULL, NULL),
(590, 232, 41, NULL, NULL),
(591, 233, 133, NULL, NULL),
(592, 233, 56, NULL, NULL),
(593, 234, 133, NULL, NULL),
(594, 234, 56, NULL, NULL),
(595, 235, 133, NULL, NULL),
(596, 235, 134, NULL, NULL),
(597, 235, 65, NULL, NULL),
(598, 235, 135, NULL, NULL),
(599, 236, 133, NULL, NULL),
(600, 236, 59, NULL, NULL),
(601, 58, 35, NULL, NULL),
(602, 178, 88, NULL, NULL),
(603, 177, 114, NULL, NULL),
(604, 3, 136, NULL, NULL),
(605, 3, 142, NULL, NULL),
(607, 3, 137, NULL, NULL),
(608, 3, 143, NULL, NULL),
(610, 3, 138, NULL, NULL),
(611, 3, 144, NULL, NULL),
(613, 3, 139, NULL, NULL),
(614, 3, 141, NULL, NULL),
(616, 6, 136, NULL, NULL),
(617, 6, 142, NULL, NULL),
(619, 6, 137, NULL, NULL),
(620, 6, 143, NULL, NULL),
(622, 6, 138, NULL, NULL),
(623, 6, 144, NULL, NULL),
(625, 6, 139, NULL, NULL),
(626, 6, 141, NULL, NULL),
(628, 11, 140, NULL, NULL),
(629, 237, 136, NULL, NULL),
(630, 237, 142, NULL, NULL),
(632, 15, 136, NULL, NULL),
(633, 15, 142, NULL, NULL),
(635, 238, 136, NULL, NULL),
(636, 238, 142, NULL, NULL),
(638, 238, 137, NULL, NULL),
(639, 238, 143, NULL, NULL),
(641, 239, 136, NULL, NULL),
(642, 239, 142, NULL, NULL),
(644, 240, 136, NULL, NULL),
(645, 240, 142, NULL, NULL),
(647, 241, 136, NULL, NULL),
(648, 241, 142, NULL, NULL),
(650, 242, 136, NULL, NULL),
(651, 242, 142, NULL, NULL),
(653, 23, 136, NULL, NULL),
(654, 23, 142, NULL, NULL),
(656, 27, 136, NULL, NULL),
(657, 27, 142, NULL, NULL),
(659, 27, 139, NULL, NULL),
(660, 27, 141, NULL, NULL),
(662, 28, 136, NULL, NULL),
(663, 28, 142, NULL, NULL),
(665, 37, 136, NULL, NULL),
(666, 37, 142, NULL, NULL),
(668, 41, 136, NULL, NULL),
(669, 41, 142, NULL, NULL),
(671, 47, 136, NULL, NULL),
(672, 47, 142, NULL, NULL),
(674, 243, 136, NULL, NULL),
(675, 243, 142, NULL, NULL),
(677, 243, 137, NULL, NULL),
(678, 243, 143, NULL, NULL),
(680, 243, 138, NULL, NULL),
(681, 243, 144, NULL, NULL),
(683, 50, 136, NULL, NULL),
(684, 50, 142, NULL, NULL),
(686, 50, 139, NULL, NULL),
(687, 50, 141, NULL, NULL),
(689, 244, 136, NULL, NULL),
(690, 244, 142, NULL, NULL),
(692, 244, 137, NULL, NULL),
(693, 244, 143, NULL, NULL),
(695, 245, 136, NULL, NULL),
(696, 245, 142, NULL, NULL),
(698, 245, 137, NULL, NULL),
(699, 245, 143, NULL, NULL),
(701, 51, 136, NULL, NULL),
(702, 51, 142, NULL, NULL),
(704, 52, 136, NULL, NULL),
(705, 52, 142, NULL, NULL),
(707, 72, 136, NULL, NULL),
(708, 72, 142, NULL, NULL),
(710, 73, 136, NULL, NULL),
(711, 73, 142, NULL, NULL),
(713, 73, 137, NULL, NULL),
(714, 73, 143, NULL, NULL),
(716, 73, 138, NULL, NULL),
(717, 73, 144, NULL, NULL),
(719, 73, 145, NULL, NULL),
(720, 73, 146, NULL, NULL),
(721, 74, 136, NULL, NULL),
(722, 74, 142, NULL, NULL),
(724, 76, 147, NULL, NULL),
(725, 76, 148, NULL, NULL),
(726, 246, 149, NULL, NULL),
(727, 247, 149, NULL, NULL),
(728, 77, 149, NULL, NULL),
(729, 78, 149, NULL, NULL),
(730, 81, 88, NULL, NULL),
(731, 89, 147, NULL, NULL),
(732, 89, 148, NULL, NULL),
(733, 90, 147, NULL, NULL),
(734, 90, 148, NULL, NULL),
(735, 91, 147, NULL, NULL),
(736, 91, 148, NULL, NULL),
(737, 91, 150, NULL, NULL),
(738, 92, 88, NULL, NULL),
(739, 93, 88, NULL, NULL),
(740, 95, 88, NULL, NULL),
(741, 98, 147, NULL, NULL),
(742, 98, 148, NULL, NULL),
(743, 99, 88, NULL, NULL),
(744, 100, 88, NULL, NULL),
(745, 101, 88, NULL, NULL),
(746, 102, 147, NULL, NULL),
(747, 102, 148, NULL, NULL),
(748, 102, 150, NULL, NULL),
(749, 104, 88, NULL, NULL),
(750, 105, 88, NULL, NULL),
(751, 248, 151, NULL, NULL),
(752, 248, 88, NULL, NULL),
(753, 114, 151, NULL, NULL),
(754, 114, 88, NULL, NULL),
(755, 249, 88, NULL, NULL),
(756, 116, 88, NULL, NULL),
(757, 117, 152, NULL, NULL),
(758, 117, 153, NULL, NULL),
(759, 118, 154, NULL, NULL),
(760, 119, 154, NULL, NULL),
(761, 121, 152, NULL, NULL),
(762, 125, 152, NULL, NULL),
(763, 126, 147, NULL, NULL),
(764, 126, 148, NULL, NULL),
(765, 126, 150, NULL, NULL),
(766, 250, 88, NULL, NULL),
(767, 250, 152, NULL, NULL),
(768, 251, 88, NULL, NULL),
(769, 251, 152, NULL, NULL),
(770, 252, 147, NULL, NULL),
(771, 252, 148, NULL, NULL),
(772, 131, 88, NULL, NULL),
(773, 133, 155, NULL, NULL),
(774, 135, 147, NULL, NULL),
(775, 135, 148, NULL, NULL),
(776, 135, 150, NULL, NULL),
(777, 253, 139, NULL, NULL),
(778, 253, 141, NULL, NULL),
(780, 136, 147, NULL, NULL),
(781, 136, 148, NULL, NULL),
(782, 136, 150, NULL, NULL),
(783, 136, 139, NULL, NULL),
(784, 136, 141, NULL, NULL),
(786, 137, 147, NULL, NULL),
(787, 137, 148, NULL, NULL),
(788, 137, 150, NULL, NULL),
(789, 137, 139, NULL, NULL),
(790, 137, 141, NULL, NULL),
(792, 254, 147, NULL, NULL),
(793, 254, 148, NULL, NULL),
(794, 255, 147, NULL, NULL),
(795, 256, 147, NULL, NULL),
(796, 257, 147, NULL, NULL),
(797, 143, 149, NULL, NULL),
(798, 144, 149, NULL, NULL),
(799, 150, 147, NULL, NULL),
(800, 150, 148, NULL, NULL),
(801, 151, 147, NULL, NULL),
(802, 151, 148, NULL, NULL),
(803, 157, 147, NULL, NULL),
(804, 157, 148, NULL, NULL),
(805, 158, 147, NULL, NULL),
(806, 158, 148, NULL, NULL),
(807, 258, 88, NULL, NULL),
(808, 259, 156, NULL, NULL),
(809, 259, 157, NULL, NULL),
(810, 259, 158, NULL, NULL),
(811, 259, 139, NULL, NULL),
(812, 259, 141, NULL, NULL),
(814, 260, 147, NULL, NULL),
(815, 260, 148, NULL, NULL),
(816, 260, 150, NULL, NULL),
(817, 260, 139, NULL, NULL),
(818, 260, 141, NULL, NULL),
(820, 261, 159, NULL, NULL),
(821, 261, 160, NULL, NULL),
(822, 262, 147, NULL, NULL),
(823, 262, 137, NULL, NULL),
(824, 262, 143, NULL, NULL),
(826, 263, 161, NULL, NULL),
(827, 264, 161, NULL, NULL),
(828, 265, 162, NULL, NULL),
(829, 165, 163, NULL, NULL),
(830, 266, 163, NULL, NULL),
(831, 266, 164, NULL, NULL),
(832, 167, 163, NULL, NULL),
(833, 168, 163, NULL, NULL),
(834, 168, 164, NULL, NULL),
(835, 169, 163, NULL, NULL),
(836, 170, 163, NULL, NULL),
(837, 172, 163, NULL, NULL),
(838, 172, 164, NULL, NULL),
(839, 172, 165, NULL, NULL),
(840, 174, 163, NULL, NULL),
(841, 177, 88, NULL, NULL),
(842, 178, 151, NULL, NULL),
(843, 179, 88, NULL, NULL),
(844, 267, 147, NULL, NULL),
(845, 267, 148, NULL, NULL),
(846, 268, 88, NULL, NULL),
(847, 180, 136, NULL, NULL),
(848, 180, 142, NULL, NULL),
(850, 180, 137, NULL, NULL),
(851, 180, 143, NULL, NULL),
(853, 269, 136, NULL, NULL),
(854, 269, 142, NULL, NULL),
(856, 269, 137, NULL, NULL),
(857, 269, 143, NULL, NULL),
(859, 181, 88, NULL, NULL),
(860, 182, 136, NULL, NULL),
(861, 182, 142, NULL, NULL),
(863, 185, 88, NULL, NULL),
(864, 186, 147, NULL, NULL),
(865, 186, 148, NULL, NULL),
(866, 187, 147, NULL, NULL),
(867, 188, 88, NULL, NULL),
(868, 270, 149, NULL, NULL),
(869, 271, 149, NULL, NULL),
(870, 272, 147, NULL, NULL),
(871, 272, 148, NULL, NULL),
(872, 273, 88, NULL, NULL),
(873, 273, 152, NULL, NULL),
(874, 274, 88, NULL, NULL),
(875, 274, 152, NULL, NULL),
(876, 191, 88, NULL, NULL),
(877, 192, 136, NULL, NULL),
(878, 192, 142, NULL, NULL),
(880, 192, 137, NULL, NULL),
(881, 192, 143, NULL, NULL),
(883, 192, 138, NULL, NULL),
(884, 192, 144, NULL, NULL),
(886, 192, 145, NULL, NULL),
(887, 199, 136, NULL, NULL),
(888, 199, 142, NULL, NULL),
(890, 200, 136, NULL, NULL),
(891, 200, 142, NULL, NULL),
(893, 209, 136, NULL, NULL),
(894, 209, 142, NULL, NULL),
(896, 209, 137, NULL, NULL),
(897, 209, 143, NULL, NULL),
(899, 209, 138, NULL, NULL),
(900, 209, 144, NULL, NULL),
(902, 210, 149, NULL, NULL),
(903, 211, 149, NULL, NULL),
(904, 214, 149, NULL, NULL),
(905, 275, 166, NULL, NULL),
(906, 275, 167, NULL, NULL),
(907, 222, 136, NULL, NULL),
(908, 222, 142, NULL, NULL),
(910, 223, 136, NULL, NULL),
(911, 223, 142, NULL, NULL),
(913, 224, 136, NULL, NULL),
(914, 224, 142, NULL, NULL),
(916, 224, 137, NULL, NULL),
(917, 224, 143, NULL, NULL),
(919, 225, 136, NULL, NULL),
(920, 225, 142, NULL, NULL),
(922, 225, 137, NULL, NULL),
(923, 225, 143, NULL, NULL),
(925, 226, 140, NULL, NULL),
(926, 276, 136, NULL, NULL),
(927, 276, 142, NULL, NULL),
(929, 276, 137, NULL, NULL),
(930, 276, 143, NULL, NULL),
(932, 277, 136, NULL, NULL),
(933, 277, 142, NULL, NULL),
(935, 277, 137, NULL, NULL),
(936, 277, 143, NULL, NULL),
(938, 227, 140, NULL, NULL),
(939, 228, 136, NULL, NULL),
(940, 228, 142, NULL, NULL),
(942, 228, 137, NULL, NULL),
(943, 228, 143, NULL, NULL),
(945, 229, 168, NULL, NULL),
(946, 229, 169, NULL, NULL),
(947, 232, 136, NULL, NULL),
(948, 232, 142, NULL, NULL),
(950, 236, 136, NULL, NULL),
(951, 236, 142, NULL, NULL),
(953, 236, 137, NULL, NULL),
(954, 236, 143, NULL, NULL),
(956, 180, 139, NULL, NULL),
(957, 180, 141, NULL, NULL),
(959, 278, 149, NULL, NULL),
(960, 279, 149, NULL, NULL),
(961, 246, 170, NULL, NULL),
(962, 247, 170, NULL, NULL),
(963, 77, 114, NULL, NULL),
(964, 78, 114, NULL, NULL),
(965, 143, 114, NULL, NULL),
(966, 144, 114, NULL, NULL),
(967, 271, 114, NULL, NULL),
(968, 270, 114, NULL, NULL),
(969, 1, 171, NULL, NULL),
(970, 1, 172, NULL, NULL),
(971, 1, 88, NULL, NULL),
(972, 280, 173, NULL, NULL),
(973, 280, 174, NULL, NULL),
(974, 281, 175, NULL, NULL),
(975, 281, 174, NULL, NULL),
(976, 17, 88, NULL, NULL),
(977, 18, 176, NULL, NULL),
(978, 18, 88, NULL, NULL),
(979, 19, 88, NULL, NULL),
(980, 20, 177, NULL, NULL),
(981, 282, 68, NULL, NULL),
(982, 21, 177, NULL, NULL),
(983, 283, 68, NULL, NULL),
(984, 24, 175, NULL, NULL),
(985, 25, 175, NULL, NULL),
(986, 27, 19, NULL, NULL),
(987, 284, 171, NULL, NULL),
(988, 284, 172, NULL, NULL),
(989, 284, 178, NULL, NULL),
(990, 284, 174, NULL, NULL),
(991, 36, 177, NULL, NULL),
(992, 47, 171, NULL, NULL),
(993, 47, 19, NULL, NULL),
(994, 47, 179, NULL, NULL),
(995, 54, 180, NULL, NULL),
(996, 54, 181, NULL, NULL),
(997, 54, 174, NULL, NULL),
(998, 56, 182, NULL, NULL),
(999, 246, 183, NULL, NULL),
(1000, 246, 184, NULL, NULL),
(1001, 246, 185, NULL, NULL),
(1002, 246, 114, NULL, NULL),
(1003, 246, 186, NULL, NULL),
(1004, 246, 187, NULL, NULL),
(1005, 246, 188, NULL, NULL),
(1006, 247, 183, NULL, NULL),
(1007, 247, 184, NULL, NULL),
(1008, 247, 185, NULL, NULL),
(1009, 247, 114, NULL, NULL),
(1010, 247, 186, NULL, NULL),
(1011, 247, 187, NULL, NULL),
(1012, 247, 188, NULL, NULL),
(1013, 77, 151, NULL, NULL),
(1014, 77, 189, NULL, NULL),
(1015, 77, 183, NULL, NULL),
(1016, 77, 184, NULL, NULL),
(1017, 77, 185, NULL, NULL),
(1018, 77, 186, NULL, NULL),
(1019, 77, 187, NULL, NULL),
(1020, 77, 188, NULL, NULL),
(1021, 78, 151, NULL, NULL),
(1022, 78, 189, NULL, NULL),
(1023, 78, 183, NULL, NULL),
(1024, 78, 184, NULL, NULL),
(1025, 78, 185, NULL, NULL),
(1026, 78, 186, NULL, NULL),
(1027, 78, 187, NULL, NULL),
(1028, 78, 188, NULL, NULL),
(1029, 99, 190, NULL, NULL),
(1030, 285, 68, NULL, NULL),
(1031, 286, 46, NULL, NULL),
(1032, 109, 88, NULL, NULL),
(1033, 113, 191, NULL, NULL),
(1034, 113, 88, NULL, NULL),
(1035, 287, 192, NULL, NULL),
(1036, 287, 193, NULL, NULL),
(1037, 288, 192, NULL, NULL),
(1038, 288, 193, NULL, NULL),
(1039, 289, 192, NULL, NULL),
(1040, 289, 193, NULL, NULL),
(1041, 290, 192, NULL, NULL),
(1042, 290, 193, NULL, NULL),
(1043, 291, 192, NULL, NULL),
(1044, 291, 193, NULL, NULL),
(1045, 292, 192, NULL, NULL),
(1046, 292, 193, NULL, NULL),
(1047, 293, 17, NULL, NULL),
(1048, 293, 191, NULL, NULL),
(1049, 294, 194, NULL, NULL),
(1050, 294, 195, NULL, NULL),
(1051, 294, 196, NULL, NULL),
(1052, 294, 197, NULL, NULL),
(1053, 294, 198, NULL, NULL),
(1054, 294, 199, NULL, NULL),
(1055, 294, 200, NULL, NULL),
(1056, 294, 201, NULL, NULL),
(1057, 294, 202, NULL, NULL),
(1058, 294, 188, NULL, NULL),
(1059, 295, 46, NULL, NULL),
(1060, 139, 182, NULL, NULL),
(1061, 140, 182, NULL, NULL),
(1062, 143, 151, NULL, NULL),
(1063, 143, 189, NULL, NULL),
(1064, 143, 183, NULL, NULL),
(1065, 143, 184, NULL, NULL),
(1066, 143, 185, NULL, NULL),
(1067, 143, 186, NULL, NULL),
(1068, 143, 187, NULL, NULL),
(1069, 143, 188, NULL, NULL),
(1070, 144, 151, NULL, NULL),
(1071, 144, 189, NULL, NULL),
(1072, 144, 183, NULL, NULL),
(1073, 144, 184, NULL, NULL),
(1074, 144, 185, NULL, NULL),
(1075, 144, 186, NULL, NULL),
(1076, 144, 187, NULL, NULL),
(1077, 144, 188, NULL, NULL),
(1078, 296, 194, NULL, NULL),
(1079, 296, 196, NULL, NULL),
(1080, 296, 203, NULL, NULL),
(1081, 296, 198, NULL, NULL),
(1082, 296, 199, NULL, NULL),
(1083, 296, 200, NULL, NULL),
(1084, 296, 204, NULL, NULL),
(1085, 296, 205, NULL, NULL),
(1086, 297, 46, NULL, NULL),
(1087, 297, 206, NULL, NULL),
(1088, 298, 68, NULL, NULL),
(1089, 170, 46, NULL, NULL),
(1090, 299, 178, NULL, NULL),
(1091, 300, 171, NULL, NULL),
(1092, 300, 19, NULL, NULL),
(1093, 301, 46, NULL, NULL),
(1094, 270, 183, NULL, NULL),
(1095, 270, 184, NULL, NULL),
(1096, 270, 185, NULL, NULL),
(1097, 270, 186, NULL, NULL),
(1098, 270, 187, NULL, NULL),
(1099, 270, 188, NULL, NULL),
(1100, 271, 183, NULL, NULL),
(1101, 271, 184, NULL, NULL),
(1102, 271, 185, NULL, NULL),
(1103, 271, 186, NULL, NULL),
(1104, 271, 187, NULL, NULL),
(1105, 271, 188, NULL, NULL),
(1106, 189, 207, NULL, NULL),
(1107, 189, 196, NULL, NULL),
(1108, 189, 197, NULL, NULL),
(1109, 189, 198, NULL, NULL),
(1110, 189, 199, NULL, NULL),
(1111, 189, 200, NULL, NULL),
(1112, 189, 202, NULL, NULL),
(1113, 189, 201, NULL, NULL),
(1114, 189, 188, NULL, NULL),
(1115, 192, 184, NULL, NULL),
(1116, 192, 185, NULL, NULL),
(1117, 302, 46, NULL, NULL),
(1118, 302, 191, NULL, NULL),
(1119, 201, 182, NULL, NULL),
(1120, 204, 182, NULL, NULL),
(1121, 204, 190, NULL, NULL),
(1122, 210, 151, NULL, NULL),
(1123, 210, 189, NULL, NULL),
(1124, 210, 183, NULL, NULL),
(1125, 210, 184, NULL, NULL),
(1126, 210, 185, NULL, NULL),
(1127, 210, 114, NULL, NULL),
(1128, 210, 186, NULL, NULL),
(1129, 210, 187, NULL, NULL),
(1130, 210, 188, NULL, NULL),
(1131, 211, 151, NULL, NULL),
(1132, 211, 189, NULL, NULL),
(1133, 211, 183, NULL, NULL),
(1134, 211, 184, NULL, NULL),
(1135, 211, 185, NULL, NULL),
(1136, 211, 114, NULL, NULL),
(1137, 211, 186, NULL, NULL),
(1138, 211, 187, NULL, NULL),
(1139, 211, 188, NULL, NULL),
(1140, 212, 182, NULL, NULL),
(1141, 134, 177, NULL, NULL),
(1142, 166, 177, NULL, NULL),
(1143, 1, 188, NULL, NULL),
(1144, 303, 188, NULL, NULL),
(1145, 2, 208, NULL, NULL),
(1146, 304, 188, NULL, NULL),
(1147, 3, 188, NULL, NULL),
(1148, 6, 188, NULL, NULL),
(1149, 9, 209, NULL, NULL),
(1150, 10, 209, NULL, NULL),
(1151, 11, 188, NULL, NULL),
(1152, 237, 188, NULL, NULL),
(1153, 280, 188, NULL, NULL),
(1154, 281, 188, NULL, NULL),
(1155, 305, 188, NULL, NULL),
(1156, 12, 188, NULL, NULL),
(1157, 13, 188, NULL, NULL),
(1158, 14, 188, NULL, NULL),
(1159, 15, 188, NULL, NULL),
(1160, 306, 188, NULL, NULL),
(1161, 238, 188, NULL, NULL),
(1162, 307, 188, NULL, NULL),
(1163, 308, 188, NULL, NULL),
(1164, 16, 188, NULL, NULL),
(1165, 17, 188, NULL, NULL),
(1166, 18, 188, NULL, NULL),
(1167, 19, 188, NULL, NULL),
(1168, 20, 188, NULL, NULL),
(1169, 309, 188, NULL, NULL),
(1170, 310, 188, NULL, NULL),
(1171, 282, 188, NULL, NULL),
(1172, 311, 188, NULL, NULL),
(1173, 312, 188, NULL, NULL),
(1174, 313, 188, NULL, NULL),
(1175, 21, 188, NULL, NULL),
(1176, 283, 188, NULL, NULL),
(1177, 239, 188, NULL, NULL),
(1178, 240, 188, NULL, NULL),
(1179, 241, 208, NULL, NULL),
(1180, 242, 208, NULL, NULL),
(1181, 22, 188, NULL, NULL),
(1182, 23, 188, NULL, NULL),
(1183, 314, 188, NULL, NULL),
(1184, 315, 188, NULL, NULL),
(1185, 24, 188, NULL, NULL),
(1186, 25, 188, NULL, NULL),
(1187, 316, 188, NULL, NULL),
(1188, 26, 188, NULL, NULL),
(1189, 317, 188, NULL, NULL),
(1190, 27, 188, NULL, NULL),
(1191, 318, 188, NULL, NULL),
(1192, 319, 188, NULL, NULL),
(1193, 284, 188, NULL, NULL),
(1194, 320, 188, NULL, NULL),
(1195, 321, 188, NULL, NULL),
(1196, 322, 188, NULL, NULL),
(1197, 323, 188, NULL, NULL),
(1198, 324, 188, NULL, NULL),
(1199, 325, 188, NULL, NULL),
(1200, 326, 188, NULL, NULL),
(1201, 327, 188, NULL, NULL),
(1202, 28, 188, NULL, NULL),
(1203, 29, 188, NULL, NULL),
(1204, 328, 188, NULL, NULL),
(1205, 30, 188, NULL, NULL),
(1206, 31, 188, NULL, NULL),
(1207, 32, 188, NULL, NULL),
(1208, 33, 188, NULL, NULL),
(1209, 34, 188, NULL, NULL),
(1210, 329, 188, NULL, NULL),
(1211, 330, 188, NULL, NULL),
(1212, 35, 188, NULL, NULL),
(1213, 36, 188, NULL, NULL),
(1214, 37, 188, NULL, NULL),
(1215, 38, 188, NULL, NULL),
(1216, 39, 188, NULL, NULL),
(1217, 331, 188, NULL, NULL),
(1218, 40, 188, NULL, NULL),
(1219, 332, 188, NULL, NULL),
(1220, 333, 188, NULL, NULL),
(1221, 41, 188, NULL, NULL),
(1222, 42, 188, NULL, NULL),
(1223, 43, 188, NULL, NULL),
(1224, 44, 188, NULL, NULL),
(1225, 45, 188, NULL, NULL),
(1226, 334, 188, NULL, NULL),
(1227, 46, 188, NULL, NULL),
(1228, 47, 188, NULL, NULL),
(1229, 48, 188, NULL, NULL),
(1230, 49, 188, NULL, NULL),
(1231, 243, 188, NULL, NULL),
(1232, 50, 188, NULL, NULL),
(1233, 335, 188, NULL, NULL),
(1234, 336, 188, NULL, NULL),
(1235, 244, 188, NULL, NULL),
(1236, 245, 188, NULL, NULL),
(1237, 51, 188, NULL, NULL),
(1238, 52, 188, NULL, NULL),
(1239, 53, 188, NULL, NULL),
(1240, 54, 188, NULL, NULL),
(1241, 55, 188, NULL, NULL),
(1242, 56, 188, NULL, NULL),
(1243, 57, 188, NULL, NULL),
(1244, 337, 188, NULL, NULL),
(1245, 58, 188, NULL, NULL),
(1246, 59, 188, NULL, NULL),
(1247, 338, 188, NULL, NULL),
(1248, 60, 188, NULL, NULL),
(1249, 61, 188, NULL, NULL),
(1250, 62, 188, NULL, NULL),
(1251, 63, 188, NULL, NULL),
(1252, 339, 188, NULL, NULL),
(1253, 340, 188, NULL, NULL),
(1254, 341, 188, NULL, NULL),
(1255, 342, 188, NULL, NULL),
(1256, 64, 188, NULL, NULL),
(1257, 65, 188, NULL, NULL),
(1258, 343, 188, NULL, NULL),
(1259, 66, 188, NULL, NULL),
(1260, 344, 188, NULL, NULL),
(1261, 345, 188, NULL, NULL),
(1262, 346, 188, NULL, NULL),
(1263, 347, 188, NULL, NULL),
(1264, 348, 188, NULL, NULL),
(1265, 349, 188, NULL, NULL),
(1266, 67, 188, NULL, NULL),
(1267, 350, 188, NULL, NULL),
(1268, 351, 188, NULL, NULL),
(1269, 352, 188, NULL, NULL),
(1270, 68, 188, NULL, NULL),
(1271, 69, 188, NULL, NULL),
(1272, 70, 188, NULL, NULL),
(1273, 353, 188, NULL, NULL),
(1274, 71, 188, NULL, NULL),
(1275, 354, 188, NULL, NULL),
(1276, 72, 188, NULL, NULL),
(1277, 73, 188, NULL, NULL),
(1278, 74, 188, NULL, NULL),
(1279, 75, 188, NULL, NULL),
(1280, 355, 188, NULL, NULL),
(1281, 76, 188, NULL, NULL),
(1282, 356, 188, NULL, NULL),
(1283, 357, 188, NULL, NULL),
(1284, 79, 188, NULL, NULL),
(1285, 80, 188, NULL, NULL),
(1286, 81, 188, NULL, NULL),
(1287, 82, 188, NULL, NULL),
(1288, 83, 188, NULL, NULL),
(1289, 84, 188, NULL, NULL),
(1290, 85, 188, NULL, NULL),
(1291, 86, 188, NULL, NULL),
(1292, 87, 188, NULL, NULL),
(1293, 88, 188, NULL, NULL),
(1294, 89, 188, NULL, NULL),
(1295, 90, 188, NULL, NULL),
(1296, 91, 188, NULL, NULL),
(1297, 92, 188, NULL, NULL),
(1298, 93, 188, NULL, NULL),
(1299, 94, 188, NULL, NULL),
(1300, 95, 188, NULL, NULL),
(1301, 96, 188, NULL, NULL),
(1302, 97, 188, NULL, NULL),
(1303, 98, 188, NULL, NULL),
(1304, 358, 188, NULL, NULL),
(1305, 99, 188, NULL, NULL),
(1306, 100, 188, NULL, NULL),
(1307, 101, 188, NULL, NULL),
(1308, 102, 188, NULL, NULL),
(1309, 359, 188, NULL, NULL),
(1310, 285, 188, NULL, NULL),
(1311, 103, 188, NULL, NULL),
(1312, 104, 188, NULL, NULL),
(1313, 105, 188, NULL, NULL),
(1314, 106, 210, NULL, NULL),
(1315, 107, 210, NULL, NULL),
(1316, 286, 188, NULL, NULL),
(1317, 108, 188, NULL, NULL),
(1318, 109, 188, NULL, NULL),
(1319, 110, 188, NULL, NULL),
(1320, 360, 188, NULL, NULL),
(1321, 111, 210, NULL, NULL),
(1322, 112, 188, NULL, NULL),
(1323, 361, 188, NULL, NULL),
(1324, 362, 188, NULL, NULL),
(1325, 248, 188, NULL, NULL),
(1326, 113, 188, NULL, NULL),
(1327, 114, 188, NULL, NULL),
(1328, 249, 188, NULL, NULL),
(1329, 115, 188, NULL, NULL),
(1330, 116, 188, NULL, NULL),
(1331, 117, 188, NULL, NULL),
(1332, 118, 188, NULL, NULL),
(1333, 119, 188, NULL, NULL),
(1334, 363, 188, NULL, NULL),
(1335, 120, 188, NULL, NULL),
(1336, 287, 188, NULL, NULL),
(1337, 288, 188, NULL, NULL),
(1338, 289, 188, NULL, NULL),
(1339, 290, 188, NULL, NULL),
(1340, 291, 188, NULL, NULL),
(1341, 292, 188, NULL, NULL),
(1342, 121, 188, NULL, NULL),
(1343, 122, 209, NULL, NULL),
(1344, 123, 209, NULL, NULL),
(1345, 124, 188, NULL, NULL),
(1346, 364, 188, NULL, NULL),
(1347, 125, 188, NULL, NULL),
(1348, 126, 209, NULL, NULL),
(1349, 365, 188, NULL, NULL),
(1350, 127, 188, NULL, NULL),
(1351, 366, 188, NULL, NULL),
(1352, 367, 188, NULL, NULL),
(1353, 128, 188, NULL, NULL),
(1354, 129, 188, NULL, NULL),
(1355, 250, 188, NULL, NULL),
(1356, 251, 188, NULL, NULL),
(1357, 368, 188, NULL, NULL),
(1358, 293, 188, NULL, NULL),
(1359, 369, 188, NULL, NULL),
(1360, 370, 188, NULL, NULL),
(1361, 371, 188, NULL, NULL),
(1362, 252, 188, NULL, NULL),
(1363, 130, 188, NULL, NULL),
(1364, 131, 188, NULL, NULL),
(1365, 372, 188, NULL, NULL),
(1366, 132, 188, NULL, NULL),
(1367, 133, 188, NULL, NULL),
(1368, 373, 188, NULL, NULL),
(1369, 134, 188, NULL, NULL),
(1370, 374, 188, NULL, NULL),
(1371, 375, 188, NULL, NULL),
(1372, 135, 188, NULL, NULL),
(1373, 253, 188, NULL, NULL),
(1374, 376, 188, NULL, NULL),
(1375, 295, 188, NULL, NULL),
(1376, 136, 188, NULL, NULL),
(1377, 137, 188, NULL, NULL),
(1378, 254, 188, NULL, NULL),
(1379, 377, 188, NULL, NULL),
(1380, 378, 188, NULL, NULL),
(1381, 138, 188, NULL, NULL),
(1382, 379, 188, NULL, NULL),
(1383, 255, 188, NULL, NULL),
(1384, 380, 188, NULL, NULL),
(1385, 139, 188, NULL, NULL),
(1386, 140, 188, NULL, NULL),
(1387, 256, 188, NULL, NULL),
(1388, 141, 188, NULL, NULL),
(1389, 142, 147, NULL, NULL),
(1390, 142, 148, NULL, NULL),
(1391, 142, 150, NULL, NULL),
(1392, 142, 211, NULL, NULL),
(1393, 142, 212, NULL, NULL),
(1394, 257, 188, NULL, NULL),
(1395, 381, 188, NULL, NULL),
(1396, 382, 188, NULL, NULL),
(1397, 383, 188, NULL, NULL),
(1398, 145, 188, NULL, NULL),
(1399, 146, 188, NULL, NULL),
(1400, 147, 188, NULL, NULL),
(1401, 148, 209, NULL, NULL),
(1402, 149, 209, NULL, NULL),
(1403, 150, 213, NULL, NULL),
(1404, 150, 214, NULL, NULL),
(1405, 150, 188, NULL, NULL),
(1406, 151, 213, NULL, NULL),
(1407, 151, 214, NULL, NULL),
(1408, 151, 188, NULL, NULL),
(1409, 152, 213, NULL, NULL),
(1410, 152, 188, NULL, NULL),
(1411, 153, 213, NULL, NULL),
(1412, 153, 188, NULL, NULL),
(1413, 154, 213, NULL, NULL),
(1414, 154, 188, NULL, NULL),
(1415, 155, 213, NULL, NULL),
(1416, 155, 188, NULL, NULL),
(1417, 156, 213, NULL, NULL),
(1418, 156, 188, NULL, NULL),
(1419, 157, 213, NULL, NULL),
(1420, 157, 214, NULL, NULL),
(1421, 157, 188, NULL, NULL),
(1422, 158, 213, NULL, NULL),
(1423, 158, 214, NULL, NULL),
(1424, 158, 188, NULL, NULL),
(1425, 384, 213, NULL, NULL),
(1426, 384, 188, NULL, NULL),
(1427, 385, 213, NULL, NULL),
(1428, 385, 188, NULL, NULL),
(1429, 159, 213, NULL, NULL),
(1430, 159, 188, NULL, NULL),
(1431, 386, 188, NULL, NULL),
(1432, 258, 188, NULL, NULL),
(1433, 387, 188, NULL, NULL),
(1434, 259, 188, NULL, NULL),
(1435, 160, 188, NULL, NULL),
(1436, 388, 188, NULL, NULL),
(1437, 389, 188, NULL, NULL),
(1438, 260, 188, NULL, NULL),
(1439, 261, 188, NULL, NULL),
(1440, 262, 188, NULL, NULL),
(1441, 263, 188, NULL, NULL),
(1442, 390, 188, NULL, NULL),
(1443, 264, 188, NULL, NULL),
(1444, 265, 188, NULL, NULL),
(1445, 391, 188, NULL, NULL),
(1446, 161, 188, NULL, NULL),
(1447, 162, 188, NULL, NULL),
(1448, 392, 188, NULL, NULL),
(1449, 163, 215, NULL, NULL),
(1450, 164, 188, NULL, NULL),
(1451, 165, 215, NULL, NULL),
(1452, 166, 188, NULL, NULL),
(1453, 297, 188, NULL, NULL),
(1454, 393, 188, NULL, NULL),
(1455, 394, 188, NULL, NULL),
(1456, 395, 188, NULL, NULL),
(1457, 298, 188, NULL, NULL),
(1458, 266, 188, NULL, NULL),
(1459, 167, 188, NULL, NULL),
(1460, 396, 188, NULL, NULL),
(1461, 397, 188, NULL, NULL),
(1462, 168, 188, NULL, NULL),
(1463, 169, 188, NULL, NULL),
(1464, 170, 188, NULL, NULL),
(1465, 171, 188, NULL, NULL),
(1466, 172, 188, NULL, NULL),
(1467, 173, 188, NULL, NULL),
(1468, 174, 188, NULL, NULL),
(1469, 299, 188, NULL, NULL),
(1470, 398, 213, NULL, NULL),
(1471, 398, 188, NULL, NULL),
(1472, 399, 213, NULL, NULL),
(1473, 399, 188, NULL, NULL),
(1474, 175, 213, NULL, NULL),
(1475, 175, 188, NULL, NULL),
(1476, 176, 213, NULL, NULL),
(1477, 176, 188, NULL, NULL),
(1478, 400, 213, NULL, NULL),
(1479, 400, 188, NULL, NULL),
(1480, 177, 188, NULL, NULL),
(1481, 300, 188, NULL, NULL),
(1482, 178, 188, NULL, NULL),
(1483, 179, 188, NULL, NULL),
(1484, 267, 188, NULL, NULL),
(1485, 268, 188, NULL, NULL),
(1486, 180, 188, NULL, NULL),
(1487, 269, 188, NULL, NULL),
(1488, 181, 188, NULL, NULL),
(1489, 182, 188, NULL, NULL),
(1490, 183, 188, NULL, NULL),
(1491, 301, 188, NULL, NULL),
(1492, 184, 188, NULL, NULL),
(1493, 185, 188, NULL, NULL),
(1494, 186, 188, NULL, NULL),
(1495, 187, 188, NULL, NULL),
(1496, 188, 188, NULL, NULL),
(1497, 401, 188, NULL, NULL),
(1498, 402, 188, NULL, NULL),
(1499, 403, 188, NULL, NULL),
(1500, 404, 188, NULL, NULL),
(1501, 190, 188, NULL, NULL),
(1502, 272, 188, NULL, NULL),
(1503, 273, 188, NULL, NULL),
(1504, 274, 188, NULL, NULL),
(1505, 191, 188, NULL, NULL),
(1506, 405, 188, NULL, NULL),
(1507, 406, 188, NULL, NULL),
(1508, 407, 188, NULL, NULL),
(1509, 192, 188, NULL, NULL),
(1510, 408, 188, NULL, NULL),
(1511, 193, 188, NULL, NULL),
(1512, 194, 188, NULL, NULL),
(1513, 195, 188, NULL, NULL),
(1514, 409, 188, NULL, NULL),
(1515, 410, 188, NULL, NULL),
(1516, 302, 188, NULL, NULL),
(1517, 196, 188, NULL, NULL),
(1518, 197, 188, NULL, NULL),
(1519, 198, 188, NULL, NULL),
(1520, 199, 188, NULL, NULL),
(1521, 200, 188, NULL, NULL),
(1522, 201, 188, NULL, NULL),
(1523, 202, 188, NULL, NULL),
(1524, 203, 188, NULL, NULL),
(1525, 204, 188, NULL, NULL),
(1526, 205, 188, NULL, NULL),
(1527, 206, 188, NULL, NULL),
(1528, 207, 188, NULL, NULL),
(1529, 208, 188, NULL, NULL),
(1530, 209, 188, NULL, NULL),
(1531, 212, 188, NULL, NULL),
(1532, 213, 188, NULL, NULL),
(1533, 214, 188, NULL, NULL),
(1534, 275, 188, NULL, NULL),
(1535, 215, 188, NULL, NULL),
(1536, 216, 188, NULL, NULL),
(1537, 217, 188, NULL, NULL),
(1538, 218, 188, NULL, NULL),
(1539, 219, 216, NULL, NULL),
(1540, 220, 188, NULL, NULL),
(1541, 221, 188, NULL, NULL),
(1542, 222, 188, NULL, NULL),
(1543, 223, 188, NULL, NULL),
(1544, 224, 188, NULL, NULL),
(1545, 225, 188, NULL, NULL),
(1546, 226, 188, NULL, NULL),
(1547, 276, 188, NULL, NULL),
(1548, 277, 188, NULL, NULL),
(1549, 227, 188, NULL, NULL),
(1550, 228, 188, NULL, NULL),
(1551, 229, 188, NULL, NULL),
(1552, 230, 188, NULL, NULL),
(1553, 231, 188, NULL, NULL),
(1554, 232, 188, NULL, NULL),
(1555, 233, 188, NULL, NULL),
(1556, 234, 188, NULL, NULL),
(1557, 235, 188, NULL, NULL),
(1558, 236, 188, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_flow` int(11) NOT NULL DEFAULT 0,
  `nilai_subpart` int(11) NOT NULL DEFAULT 0,
  `nilai_qpoint` int(11) NOT NULL DEFAULT 0,
  `nilai_packing` int(11) NOT NULL DEFAULT 0,
  `total_nilai` int(11) NOT NULL DEFAULT 0,
  `status_lulus` tinyint(1) NOT NULL DEFAULT 0,
  `catatan_penilai` text DEFAULT NULL,
  `dinilai_oleh` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `assessment_id`, `nilai_flow`, `nilai_subpart`, `nilai_qpoint`, `nilai_packing`, `total_nilai`, `status_lulus`, `catatan_penilai`, `dinilai_oleh`) VALUES
(4, 5, 30, 30, 40, 0, 100, 1, 'lulus', 5),
(5, 2, 30, 30, 30, 0, 90, 1, NULL, 5),
(6, 8, 30, 30, 30, 0, 90, 1, 'lulus', 6),
(7, 7, 30, 30, 30, 0, 90, 1, NULL, 5),
(8, 9, 30, 30, 35, 0, 95, 1, NULL, 6),
(9, 4, 30, 30, 30, 0, 90, 1, NULL, 6),
(10, 3, 20, 20, 20, 0, 60, 0, NULL, 6),
(11, 10, 20, 20, 20, 0, 60, 0, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` tinyint(3) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `bulan`, `tahun`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, '2023', 'open', NULL, NULL),
(2, 7, '2025', 'open', NULL, NULL),
(3, 5, '2024', 'open', NULL, NULL),
(4, 6, '2026', 'open', NULL, NULL),
(5, 11, '2009', 'open', NULL, NULL),
(6, 5, '2025', 'open', NULL, NULL),
(7, 2, '2026', 'open', NULL, NULL),
(8, 1, '2026', 'open', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qr_tokens`
--

CREATE TABLE `qr_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_shift` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `nama_shift`, `created_at`, `updated_at`) VALUES
(1, 'Shift 1', '2026-06-26 07:04:36', '2026-06-26 07:04:36'),
(2, 'Shift 2', '2026-06-26 07:04:36', '2026-06-26 07:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `subparts`
--

CREATE TABLE `subparts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED NOT NULL,
  `nama_subpart` varchar(150) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_processes`
--

CREATE TABLE `sub_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_sub_proses` varchar(150) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_processes`
--

INSERT INTO `sub_processes` (`id`, `nama_sub_proses`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'BO', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(2, 'B1', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(3, 'PI+CH', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(4, 'MX', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(5, 'B1,B2', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(6, 'P1', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(7, 'B2', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(8, 'BLANK+EMBOS', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(9, 'FLANGING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(10, 'BI', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(11, 'B3', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(12, 'BI+B2', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(13, 'B3+B4', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(14, 'B5,B6', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(15, 'B7,RSTK', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(16, 'B3,B4', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(17, 'PROG', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(18, 'PLIT', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(19, 'CHAMPER', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(20, 'P1,RSTK', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(21, 'DRAW 1', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(22, 'DRAW 2', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(23, 'DRAW 3', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(24, 'DRAW 4', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(25, 'TRIMING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(26, 'EMBOS', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(27, 'BURRING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(28, 'TRIMING + P1', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(29, 'B1 + RSTK', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(30, 'PLANGING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(31, 'CUTTING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(32, 'RSTK', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(33, 'HEM CUTTING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(34, 'B2,P1', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(35, 'FLATNESS', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(36, 'CH', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(37, 'BLANK', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(38, 'B4', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(39, 'BD', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(40, 'B1+B2', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(41, 'PROGRESSIVE', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(42, 'RESTRIKE', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(43, 'ASSY PATCH', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(44, 'BO+MX', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(45, 'FORMING+MX', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(46, 'FORMING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(47, 'MX+TRIMMING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(48, 'BURRING+RESTRIKE', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(49, 'B1+EMBOSS', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(50, 'BO R/L', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(51, 'B1 R/L', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(52, 'BV', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(53, 'B3+P1', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(54, 'P1+CHAMPER', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(55, 'SEMI PROGRESSIVE', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(56, 'BENDING1+2', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(57, 'BENDING3+FLATNESS', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(58, 'BLANKING', 1, '2026-06-26 09:14:29', '2026-06-26 09:14:29'),
(59, 'BENDING 1+2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(60, 'BENDING 3+4', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(61, 'BENDING 5', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(62, 'HEMMING+PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(63, 'MANUAL ROLLING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(64, 'BENDING 6', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(65, 'BENDING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(66, 'PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(67, 'BENDING 3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(68, 'CURLING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(69, 'COMPOUND', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(70, 'BLANKING-PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(71, 'BLANKING + PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(72, 'FORMING1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(73, 'FORMING2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(74, 'CHAMFER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(75, 'DRAW1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(76, 'DRAW2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(77, 'DRAW3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(78, 'DRAW4', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(79, 'TRIMMING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(80, 'BENDING+PI', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(81, 'PIERCING CAM', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(82, 'DRILL (PIERCING)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(83, 'BENDING3+4', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(84, 'BENDING5+6', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(85, 'BENDING1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(86, 'BENDING2 + PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(87, 'BENDING + CURLING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(88, 'ASSY', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(89, 'FORMING 1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(90, 'FORMING 2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(91, 'FORMING 3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(92, 'BLANKING (R/L)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(93, 'DRAW 1 (R/L)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(94, 'DRAW 2  (R/L)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(95, 'DRAW 3  (R/L)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(96, 'TRIMING 1 (R/L)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(97, 'TRIMING 2 (R/L)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(98, 'FORMING + EMBOSS', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(99, 'BENDING + FORMING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(100, 'TRIMING 3+4 (R/L)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(101, 'ROLL', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(102, 'NECKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(103, 'BENDING 1 + 2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(104, 'BO + PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(105, 'P1+FLATNESS', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(106, 'B0+P1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(107, 'BENDING + CHAMFER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(108, 'BENDING1 (RH/LH)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(109, 'BENDING2 (RH/LH)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(110, 'PIERCING + MARKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(111, 'B1+P1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(112, 'P1+B1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(113, 'B1+CURLING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(114, 'BUFFING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(115, 'B1+2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(116, 'PIERCING 1+2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(117, 'P2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(118, 'B0', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(119, 'B2+3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(120, 'B1+FORMING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(121, 'B1+RSTK', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(122, 'PROG + RSTK', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(123, 'DRAW', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(124, 'EMBOSS', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(125, 'BLANK+PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(126, 'RISTRIKE', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(127, 'P1+2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(128, 'RESTRIKE 1+2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(129, 'B1+CAM', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(130, 'PIERCING + BENDING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(131, 'BENDING+SLITTING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(132, 'ASSY CURLING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(133, 'BLANKING+PIERCING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(134, 'FORMING+FLANGING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(135, 'RESTRIKE+PI', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(136, 'Assy 1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(137, 'Assy 2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(138, 'Assy 3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(139, 'Check', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(140, 'ASSY 1+2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(141, 'CHECK', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(142, 'ASSY 1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(143, 'ASSY 2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(144, 'ASSY 3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(145, 'ASSY 4', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(146, 'CHECK AFTER PLATING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(147, 'ASSY1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(148, 'ASSY2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(149, 'WELDING ROBOT', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(150, 'ASSY3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(151, 'SPOT WELDING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(152, 'SPOT WELDING1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(153, 'SPOT WELDING2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(154, 'ASSY WELDING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(155, 'SPOT', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(156, 'ASSY (GUIDE +STAY CLIP)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(157, 'ASSY (STAY + CLIP)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(158, 'SPOT (NUT SW + STAY)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(159, 'ASSY 1 (STAY R + NUT PROJECTION)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(160, 'ASSY 2 (STAY R + NUT SW)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(161, 'ASSY 1 (STAY + NUT SW)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(162, 'ASSY(CLAMPER + GUIDE)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(163, 'WELDING ASSY 1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(164, 'WELDING ASSY 2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(165, 'WELDING ASSY 3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(166, 'ASSY 1 (PLATE+GUIDE+STAY CLIP)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(167, 'ASSY 2(ASSY1+NUT)', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(168, 'ASSY1+BODY 2+3', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(169, 'ASSY2+STOPPER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(170, 'BUFFING2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(171, 'BUBUT AUTO', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(172, 'BUBUT,CHEMPER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(173, 'BUBUT+CH', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(174, 'CEK JIG', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(175, 'CHEMPER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(176, 'CHAMPER DALAM', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(177, 'BUBUT', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(178, 'BOR', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(179, 'KIKIR', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(180, 'BUBUT LUAR', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(181, 'BUBUT DALAM', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(182, 'SGR', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(183, 'DRILL', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(184, 'CUTTING 1', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(185, 'CUTTING 2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(186, 'SEMI ASSY RUBBER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(187, 'ASSY RUBBER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(188, 'PACKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(189, 'FINISHING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(190, 'CNC', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(191, 'TAPPING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(192, 'WIRE PRESS', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(193, 'CUTTING & B1+B2', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(194, 'SWAGING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(195, 'DRILLING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(196, 'BENDING ROLL', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(197, 'ASSY PIPE', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(198, 'ASSY WIRE', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(199, 'WELDING BRAZZING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(200, 'HITTING TEST', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(201, 'FINAL INSPECT', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(202, 'ASSY O-RING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(203, 'ASSY PIPE + PLATE', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(204, 'FUNCTION INSPECTION', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(205, 'ASSY O-RING+PACKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(206, 'CORRECTING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(207, 'EXPANDIG', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(208, 'PACKING + ASSY', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(209, 'ASSY + PACKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(210, 'PACKING+ASSY RUBBER', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(211, 'CLINCHING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(212, 'ASSY4 + PACKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(213, 'REMOVING  GREASE', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(214, 'ASSY NOW WOVEN', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(215, 'ASSY +PACKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30'),
(216, 'CEK + PACKING', 1, '2026-06-26 09:14:30', '2026-06-26 09:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `operator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `employee_nik` varchar(50) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `divisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `operator_id`, `name`, `employee_nik`, `username`, `email`, `role`, `divisi_id`, `email_verified_at`, `password`, `signature`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Administrator', NULL, 'adminsigma', 'adminsigma@mwt.local', 'admin', NULL, NULL, '$2y$12$LkXH9P7fdISRopsp/bSfEOdi.kWmJNuLUK328lNvSa2P2EI/FyA7a', NULL, 1, NULL, '2026-06-25 23:26:17', '2026-08-10 06:16:53'),
(5, NULL, 'ENDANG SARTONO', NULL, 'endang', 'endang@mwt.com', 'leader', 1, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'endang.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(6, NULL, 'ANDRI ISMAIL', NULL, 'andri', 'andri@mwt.com', 'leader', 1, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'andriismail.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(7, NULL, 'RAHMATULLOH', NULL, 'rahmat', 'rahmat@mwt.com', 'leader', 2, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'rahmatullah.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(8, NULL, 'REKHAN MAULIDI', NULL, 'rekhan', 'rekhan@mwt.com', 'leader', 2, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'rekhan.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(9, NULL, 'IWAN SUDRAJAT', NULL, 'iwan', 'iwan@mwt.com', 'leader', 2, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'iwan.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(10, NULL, 'CATUR ANDI', NULL, 'catur', 'catur@mwt.com', 'leader', 3, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'catur.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(11, NULL, 'BANGUN ADI', NULL, 'bangun', 'bangun@mwt.com', 'leader', 3, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'bangun.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(12, NULL, 'AGUS SUTISNA', NULL, 'agus', 'agus@mwt.com', 'leader', 3, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'agus.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(13, NULL, 'LASTRI', NULL, 'lastri', 'lastri@mwt.com', 'leader', 4, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'lastri.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(14, NULL, 'AULIA NUR', NULL, 'aulia', 'aulia@mwt.com', 'leader', 4, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'aulia.png', 1, NULL, '2026-06-26 08:11:27', '2026-07-13 08:23:25'),
(15, NULL, 'Indrayadi', NULL, 'indrayadi', 'indrayadi@mwt.com', 'foreman', 1, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'indrayadi.png', 1, NULL, '2026-07-07 09:36:06', '2026-07-13 08:23:25'),
(16, NULL, 'Jati Kusumo', NULL, 'jati', 'jati@mwt.com', 'foreman', 2, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'jati.png', 1, NULL, '2026-07-07 09:36:06', '2026-07-13 08:23:25'),
(17, NULL, 'AA Kurniawan', NULL, 'aa', 'aa@mwt.com', 'foreman', 3, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'aa.png', 1, NULL, '2026-07-07 09:36:06', '2026-07-13 08:23:25'),
(19, NULL, 'Andri Supriatna', NULL, 'andris', 'andris@mwt.com', 'kabag', NULL, NULL, '$2y$12$TDcZeqDiOK6BIZuyrULt6OZP2yNK3J7kEHNGfpwZl3FnuxRe1C7LG', 'andrisupriatna.png', 1, NULL, '2026-07-07 09:36:14', '2026-07-13 08:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_divisi`
--

CREATE TABLE `user_divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_divisi`
--

INSERT INTO `user_divisi` (`id`, `user_id`, `divisi_id`, `created_at`, `updated_at`) VALUES
(1, 15, 1, '2026-07-07 09:42:00', '2026-07-07 09:42:00'),
(2, 16, 2, '2026-07-07 09:42:00', '2026-07-07 09:42:00'),
(3, 17, 3, '2026-07-07 09:42:00', '2026-07-07 09:42:00'),
(4, 17, 4, '2026-07-07 09:42:00', '2026-07-07 09:42:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvals_foreman_id_foreign` (`foreman_id`),
  ADD KEY `approvals_kabag_id_foreign` (`kabag_id`),
  ADD KEY `approvals_assessment_id_foreign` (`assessment_id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assessments_verification_code_unique` (`verification_code`),
  ADD KEY `assessments_operator_id_foreign` (`operator_id`),
  ADD KEY `assessments_part_id_foreign` (`part_id`),
  ADD KEY `assessments_periode_id_foreign` (`periode_id`),
  ADD KEY `assessments_sub_process_id_foreign` (`sub_process_id`);

--
-- Indexes for table `assessment_answers`
--
ALTER TABLE `assessment_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_answers_assessment_id_foreign` (`assessment_id`);

--
-- Indexes for table `assessment_rules`
--
ALTER TABLE `assessment_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leader_assignments`
--
ALTER TABLE `leader_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leader_assignments_divisi_id_foreign` (`divisi_id`),
  ADD KEY `leader_assignments_leader_id_foreign` (`leader_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_assessment_id_foreign` (`assessment_id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operators_nik_unique` (`nik`),
  ADD KEY `operators_divisi_id_foreign` (`divisi_id`),
  ADD KEY `operators_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parts_no_part_unique` (`no_part`);

--
-- Indexes for table `part_divisions`
--
ALTER TABLE `part_divisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_divisions_part_id_foreign` (`part_id`),
  ADD KEY `part_divisions_division_id_foreign` (`division_id`);

--
-- Indexes for table `part_processes`
--
ALTER TABLE `part_processes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_processes_part_id_foreign` (`part_id`),
  ADD KEY `part_processes_sub_process_id_foreign` (`sub_process_id`);

--
-- Indexes for table `part_sub_processes`
--
ALTER TABLE `part_sub_processes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_sub_processes_part_id_foreign` (`part_id`),
  ADD KEY `part_sub_processes_sub_process_id_foreign` (`sub_process_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_assessment_id_foreign` (`assessment_id`),
  ADD KEY `penilaian_dinilai_oleh_foreign` (`dinilai_oleh`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_tokens`
--
ALTER TABLE `qr_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subparts`
--
ALTER TABLE `subparts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subparts_part_id_foreign` (`part_id`);

--
-- Indexes for table `sub_processes`
--
ALTER TABLE `sub_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_employee_nik_unique` (`employee_nik`),
  ADD KEY `users_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `user_divisi`
--
ALTER TABLE `user_divisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_divisi_user_id_foreign` (`user_id`),
  ADD KEY `user_divisi_divisi_id_foreign` (`divisi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assessment_answers`
--
ALTER TABLE `assessment_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assessment_rules`
--
ALTER TABLE `assessment_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leader_assignments`
--
ALTER TABLE `leader_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- AUTO_INCREMENT for table `part_divisions`
--
ALTER TABLE `part_divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `part_processes`
--
ALTER TABLE `part_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `part_sub_processes`
--
ALTER TABLE `part_sub_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1559;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `qr_tokens`
--
ALTER TABLE `qr_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subparts`
--
ALTER TABLE `subparts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_processes`
--
ALTER TABLE `sub_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_divisi`
--
ALTER TABLE `user_divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `approvals_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `approvals_kabag_id_foreign` FOREIGN KEY (`kabag_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessments_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assessments_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessments_sub_process_id_foreign` FOREIGN KEY (`sub_process_id`) REFERENCES `sub_processes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `assessment_answers`
--
ALTER TABLE `assessment_answers`
  ADD CONSTRAINT `assessment_answers_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leader_assignments`
--
ALTER TABLE `leader_assignments`
  ADD CONSTRAINT `leader_assignments_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leader_assignments_leader_id_foreign` FOREIGN KEY (`leader_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `operators_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `operators_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `part_divisions`
--
ALTER TABLE `part_divisions`
  ADD CONSTRAINT `part_divisions_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `part_divisions_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `part_processes`
--
ALTER TABLE `part_processes`
  ADD CONSTRAINT `part_processes_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `part_processes_sub_process_id_foreign` FOREIGN KEY (`sub_process_id`) REFERENCES `sub_processes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `part_sub_processes`
--
ALTER TABLE `part_sub_processes`
  ADD CONSTRAINT `part_sub_processes_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `part_sub_processes_sub_process_id_foreign` FOREIGN KEY (`sub_process_id`) REFERENCES `sub_processes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_dinilai_oleh_foreign` FOREIGN KEY (`dinilai_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subparts`
--
ALTER TABLE `subparts`
  ADD CONSTRAINT `subparts_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_divisi`
--
ALTER TABLE `user_divisi`
  ADD CONSTRAINT `user_divisi_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_divisi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
