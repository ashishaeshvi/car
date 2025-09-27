-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2025 at 02:44 PM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `subject_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `event` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'ra_document', 'RA document has been updated', 'App\\Models\\RaDocument', 'updated', 4, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-08-22 10:14:23', '2025-08-22 10:14:23'),
(2, 'ra_document', 'RA document has been updated', 'App\\Models\\RaDocument', 'updated', 4, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-08-22 10:14:38', '2025-08-22 10:14:38'),
(3, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', NULL, '2025-08-24 08:30:48', '2025-08-24 08:30:48'),
(4, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 50, \"ra_document_id\": 1}, \"attributes\": {\"vacancy\": 10, \"ra_document_id\": 2}}', NULL, '2025-08-24 08:33:19', '2025-08-24 08:33:19'),
(5, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 23123, \"sponsor_id\": null, \"fe_stamp_id\": null, \"sponsor_name\": null, \"ra_document_id\": 1, \"individual_or_company\": \"individual\"}, \"attributes\": {\"vacancy\": 10, \"sponsor_id\": \"aasdasd\", \"fe_stamp_id\": 13, \"sponsor_name\": \"SADASDASD\", \"ra_document_id\": 2, \"individual_or_company\": \"company\"}}', NULL, '2025-08-24 08:36:39', '2025-08-24 08:36:39'),
(6, 'user', 'User has been created', 'App\\Models\\User', 'created', 16, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"staff\", \"email\": \"staff@gmail.com\", \"mobile\": null, \"status\": \"inactive\", \"address\": null, \"role_id\": 2}}', NULL, '2025-08-24 10:15:44', '2025-08-24 10:15:44'),
(7, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', NULL, '2025-08-24 10:16:01', '2025-08-24 10:16:01'),
(8, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 16, '{\"ip\": \"127.0.0.1\", \"agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', NULL, '2025-08-24 10:16:13', '2025-08-24 10:16:13'),
(9, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', NULL, '2025-08-24 10:16:26', '2025-08-24 10:16:26'),
(10, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 16, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-08-24 10:16:59', '2025-08-24 10:16:59'),
(11, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', NULL, '2025-08-24 10:17:14', '2025-08-24 10:17:14'),
(12, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 16, '{\"ip\": \"127.0.0.1\", \"agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', NULL, '2025-08-24 10:17:20', '2025-08-24 10:17:20'),
(13, 'ra_document', 'RA document has been created', 'App\\Models\\RaDocument', 'created', 5, 'App\\Models\\User', 16, '{\"attributes\": {\"status\": \"active\", \"address\": \"DGDFGDFG\", \"ra_name\": \"SDFSFSF\", \"ra_sign\": \"ra_docs/ZRXmS02WMzpZfcTJZ6F8xr8U1KRsGiw5Z1VeSLWX.jpg\", \"user_id\": 16, \"ra_stamp\": \"ra_docs/aXfF1plB48uMYrOoIYy3HWB1VE5VNFpAnZfvYk47.jpg\", \"agency_name\": \"FSDFSDFSDFS\", \"ra_name_hindi\": \"SDFSDFSDF\", \"registration_no\": \"SDFSDFSDFSDFSD\"}}', NULL, '2025-08-24 10:21:22', '2025-08-24 10:21:22'),
(14, 'fe_document', 'Fe document has been created', 'App\\Models\\FeDocument', 'created', 16, 'App\\Models\\User', 16, '{\"attributes\": {\"name\": \"FSDFSD\", \"type\": \"sign\", \"status\": \"active\", \"user_id\": 16}}', NULL, '2025-08-24 10:22:16', '2025-08-24 10:22:16'),
(15, 'fe_document', 'Fe document has been created', 'App\\Models\\FeDocument', 'created', 17, 'App\\Models\\User', 16, '{\"attributes\": {\"name\": \"VXCXV\", \"type\": \"stamp\", \"status\": \"active\", \"user_id\": 16}}', NULL, '2025-08-24 10:23:07', '2025-08-24 10:23:07'),
(16, 'user_document', 'User Passport has been created', 'App\\Models\\UserPassport', 'created', 4, 'App\\Models\\User', 16, '{\"attributes\": {\"job\": \"3434\", \"fe_no\": \"12345\", \"fe_age\": 34, \"salary\": \"3432.00\", \"status\": \"active\", \"fe_name\": \"FSDFSFS\", \"user_id\": 16, \"vacancy\": 10, \"fe_sign_id\": 1, \"sponsor_id\": null, \"fe_phone_no\": \"55452345\", \"fe_stamp_id\": null, \"passport_no\": \"4234234234\", \"sponsor_name\": null, \"all_country_id\": 1, \"candidate_sign\": \"candidate_sign/h0QeZKxMgjy5HqWu6wYbKw23BYGv9jGv5WokAtz6.jpg\", \"ra_document_id\": 2, \"candidate_photo\": null, \"individual_or_company\": \"individual\"}}', NULL, '2025-08-24 10:24:07', '2025-08-24 10:24:07'),
(17, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 16, 'App\\Models\\User', 16, '{\"old\": {\"name\": \"staff\"}, \"attributes\": {\"name\": \"staff1\"}}', NULL, '2025-08-24 11:51:35', '2025-08-24 11:51:35'),
(18, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 16, 'App\\Models\\User', 16, '{\"old\": {\"address\": null}, \"attributes\": {\"address\": \"sdadasda\"}}', NULL, '2025-08-24 11:53:16', '2025-08-24 11:53:16'),
(19, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 16, 'App\\Models\\User', 16, '{\"old\": {\"email\": \"staff@gmail.com\"}, \"attributes\": {\"email\": \"staff1@gmail.com\"}}', NULL, '2025-08-24 11:54:12', '2025-08-24 11:54:12'),
(20, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 138.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-08-27 09:28:34', '2025-08-27 09:28:34'),
(21, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 139.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-08-28 10:16:12', '2025-08-28 10:16:12'),
(22, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_no\": \"324234\", \"fe_age\": 23, \"fe_sign_id\": 1, \"sponsor_id\": \"aasdasd\", \"fe_phone_no\": \"55454234\", \"fe_stamp_id\": 13, \"sponsor_name\": \"SADASDASD\", \"all_country_id\": 1, \"individual_or_company\": \"company\"}, \"attributes\": {\"fe_no\": \"1234567\", \"fe_age\": 24, \"fe_sign_id\": 14, \"sponsor_id\": null, \"fe_phone_no\": \"55454567\", \"fe_stamp_id\": null, \"sponsor_name\": null, \"all_country_id\": 3, \"individual_or_company\": \"individual\"}}', NULL, '2025-08-28 10:30:15', '2025-08-28 10:30:15'),
(23, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"passport_no\": \"asdas\"}, \"attributes\": {\"passport_no\": \"ASDAS\"}}', NULL, '2025-08-28 10:40:45', '2025-08-28 10:40:45'),
(24, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_age\": 24, \"fe_sign_id\": 14, \"passport_no\": \"ASDAS\", \"all_country_id\": 3}, \"attributes\": {\"fe_age\": 34, \"fe_sign_id\": 1, \"passport_no\": \"asdas\", \"all_country_id\": 1}}', NULL, '2025-08-28 10:41:26', '2025-08-28 10:41:26'),
(25, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_age\": 34, \"fe_sign_id\": 1, \"all_country_id\": 1}, \"attributes\": {\"fe_age\": 55, \"fe_sign_id\": 14, \"all_country_id\": 4}}', NULL, '2025-08-28 10:43:46', '2025-08-28 10:43:46'),
(26, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_no\": \"1234567\", \"fe_age\": 55, \"fe_phone_no\": \"55454567\", \"all_country_id\": 4}, \"attributes\": {\"fe_no\": \"123456\", \"fe_age\": 53, \"fe_phone_no\": \"55453456\", \"all_country_id\": 5}}', NULL, '2025-08-28 10:44:18', '2025-08-28 10:44:18'),
(27, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_age\": 53, \"fe_sign_id\": 14, \"all_country_id\": 5}, \"attributes\": {\"fe_age\": 44, \"fe_sign_id\": 2, \"all_country_id\": 2}}', NULL, '2025-08-28 10:44:55', '2025-08-28 10:44:55'),
(28, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_no\": \"123456\", \"fe_sign_id\": 2, \"fe_phone_no\": \"55453456\", \"all_country_id\": 2}, \"attributes\": {\"fe_no\": \"1234567\", \"fe_sign_id\": 1, \"fe_phone_no\": \"55454567\", \"all_country_id\": 5}}', NULL, '2025-08-28 10:45:26', '2025-08-28 10:45:26'),
(29, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_age\": 44, \"fe_sign_id\": 1, \"all_country_id\": 5}, \"attributes\": {\"fe_age\": 45, \"fe_sign_id\": 13, \"all_country_id\": 1}}', NULL, '2025-08-28 10:49:21', '2025-08-28 10:49:21'),
(30, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 10}, \"attributes\": {\"vacancy\": 60}}', NULL, '2025-08-28 10:50:46', '2025-08-28 10:50:46'),
(31, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 60}, \"attributes\": {\"vacancy\": 70}}', NULL, '2025-08-28 10:52:43', '2025-08-28 10:52:43'),
(32, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 70}, \"attributes\": {\"vacancy\": 80}}', NULL, '2025-08-28 10:52:52', '2025-08-28 10:52:52'),
(33, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 80}, \"attributes\": {\"vacancy\": 65535}}', NULL, '2025-08-28 10:54:26', '2025-08-28 10:54:26'),
(34, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-08-28 10:57:12', '2025-08-28 10:57:12'),
(35, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-08-28 10:57:22', '2025-08-28 10:57:22'),
(36, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 65535}, \"attributes\": {\"vacancy\": 12345}}', NULL, '2025-08-28 10:57:46', '2025-08-28 10:57:46'),
(37, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 12345}, \"attributes\": {\"vacancy\": 65535}}', NULL, '2025-08-28 10:57:54', '2025-08-28 10:57:54'),
(38, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"vacancy\": 65535}, \"attributes\": {\"vacancy\": 10}}', NULL, '2025-08-28 11:00:42', '2025-08-28 11:00:42'),
(39, 'user_document', 'User Passport has been created', 'App\\Models\\UserPassport', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\": {\"job\": \"34ASD\", \"fe_no\": \"2345\", \"fe_age\": 23, \"salary\": \"55.00\", \"status\": \"active\", \"fe_name\": \"AASDASD\", \"user_id\": 1, \"vacancy\": 10, \"fe_sign_id\": 1, \"sponsor_id\": null, \"fe_phone_no\": \"55452345\", \"fe_stamp_id\": null, \"passport_no\": \"ASDAD\", \"sponsor_name\": null, \"all_country_id\": 1, \"candidate_sign\": \"candidate_sign/dC7H4g5kFUZlisdu0kQir4Tm4psanosYaGQ3wCED.jpg\", \"ra_document_id\": 2, \"candidate_photo\": null, \"individual_or_company\": \"individual\"}}', NULL, '2025-08-28 12:57:27', '2025-08-28 12:57:27'),
(40, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 139.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-08-29 12:29:06', '2025-08-29 12:29:06'),
(41, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"sponsor_id\": null, \"fe_stamp_id\": null, \"sponsor_name\": null, \"individual_or_company\": \"individual\"}, \"attributes\": {\"sponsor_id\": \"asdasd\", \"fe_stamp_id\": 14, \"sponsor_name\": \"DASDSAD\", \"individual_or_company\": \"company\"}}', NULL, '2025-08-29 12:33:56', '2025-08-29 12:33:56'),
(42, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"fe_sign_id\": 13, \"fe_stamp_id\": 14}, \"attributes\": {\"fe_sign_id\": 14, \"fe_stamp_id\": 2}}', NULL, '2025-08-29 12:40:46', '2025-08-29 12:40:46'),
(43, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 16, 'App\\Models\\User', 1, '{\"old\": {\"mobile\": null}, \"attributes\": {\"mobile\": \"8888888888\"}}', NULL, '2025-08-29 12:54:18', '2025-08-29 12:54:18'),
(44, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 139.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-08-29 12:54:28', '2025-08-29 12:54:28'),
(45, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 16, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 139.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-08-29 12:54:36', '2025-08-29 12:54:36'),
(46, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 16, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 139.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-08-29 12:55:12', '2025-08-29 12:55:12'),
(47, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 139.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-02 11:11:15', '2025-09-02 11:11:15'),
(48, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 5, 'App\\Models\\User', 1, '{\"old\": {\"pobox\": null, \"ref_no\": null, \"pin_code\": null}, \"attributes\": {\"pobox\": 566564, \"ref_no\": \"7666\", \"pin_code\": 566556}}', NULL, '2025-09-02 11:49:24', '2025-09-02 11:49:24'),
(49, 'user_document', 'User Passport has been updated', 'App\\Models\\UserPassport', 'updated', 5, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-09-02 11:59:35', '2025-09-02 11:59:35'),
(50, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-08 23:36:59', '2025-09-08 23:36:59'),
(51, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-09 01:29:06', '2025-09-09 01:29:06'),
(52, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-09 01:29:09', '2025-09-09 01:29:09'),
(53, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-10 21:27:36', '2025-09-10 21:27:36'),
(54, 'user', 'User has been created', 'App\\Models\\User', 'created', 17, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"dsfgf\", \"email\": \"admin1@gmail.com\", \"mobile\": \"2134566645\", \"status\": \"inactive\", \"address\": null, \"role_id\": 2}}', NULL, '2025-09-10 22:09:19', '2025-09-10 22:09:19'),
(55, 'user', 'User has been created', 'App\\Models\\User', 'created', 18, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"aszdxfcghjk\", \"email\": \"admin67@gmail.com\", \"mobile\": \"1234567890\", \"status\": \"inactive\", \"address\": null, \"role_id\": 2}}', NULL, '2025-09-10 22:13:31', '2025-09-10 22:13:31'),
(56, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 18, 'App\\Models\\User', 1, '{\"old\": {\"address\": null}, \"attributes\": {\"address\": \"sdzxcvhjkllvvbn\"}}', NULL, '2025-09-11 00:41:11', '2025-09-11 00:41:11'),
(57, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 18, 'App\\Models\\User', 1, '{\"old\": {\"mobile\": \"1234567890\"}, \"attributes\": {\"mobile\": \"1234567891\"}}', NULL, '2025-09-11 00:44:18', '2025-09-11 00:44:18'),
(58, 'user', 'User has been created', 'App\\Models\\User', 'created', 19, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"asdasdasd\", \"email\": \"adminasd@gmail.com\", \"mobile\": \"2424324234\", \"status\": \"inactive\", \"address\": \"23432434\", \"role_id\": 2}}', NULL, '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(59, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 19, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-09-11 01:12:30', '2025-09-11 01:12:30'),
(60, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 19, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-09-11 01:13:26', '2025-09-11 01:13:26'),
(61, 'user', 'User has been deleted', 'App\\Models\\User', 'deleted', 19, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"asdasdasd\", \"email\": \"adminasd@gmail.com\", \"mobile\": \"2424324234\", \"status\": \"inactive\", \"address\": \"23432434\", \"role_id\": 2}}', NULL, '2025-09-11 01:22:34', '2025-09-11 01:22:34'),
(62, 'user', 'User has been created', 'App\\Models\\User', 'created', 20, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"dsfsfs\", \"email\": \"adminsdsad@gmail.com\", \"mobile\": \"3242342343\", \"status\": \"inactive\", \"address\": \"23wfdfsdf\", \"role_id\": 4}}', NULL, '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(63, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:28:48', '2025-09-11 01:28:48'),
(64, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:28:50', '2025-09-11 01:28:50'),
(65, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:28:55', '2025-09-11 01:28:55'),
(66, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:28:56', '2025-09-11 01:28:56'),
(67, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:29:01', '2025-09-11 01:29:01'),
(68, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:29:26', '2025-09-11 01:29:26'),
(69, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:31:48', '2025-09-11 01:31:48'),
(70, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:32:31', '2025-09-11 01:32:31'),
(71, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:32:33', '2025-09-11 01:32:33'),
(72, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:32:34', '2025-09-11 01:32:34'),
(73, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:32:36', '2025-09-11 01:32:36'),
(74, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:32:44', '2025-09-11 01:32:44'),
(75, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:32:57', '2025-09-11 01:32:57'),
(76, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:33:27', '2025-09-11 01:33:27'),
(77, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:33:29', '2025-09-11 01:33:29'),
(78, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:35:50', '2025-09-11 01:35:50'),
(79, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:35:52', '2025-09-11 01:35:52'),
(80, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-11 01:36:00', '2025-09-11 01:36:00'),
(81, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-11 01:36:01', '2025-09-11 01:36:01'),
(82, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-09-11 01:37:12', '2025-09-11 01:37:12'),
(83, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-16 23:29:26', '2025-09-16 23:29:26'),
(84, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-17 23:21:34', '2025-09-17 23:21:34'),
(85, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-18 17:21:01', '2025-09-18 17:21:01'),
(86, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-18 10:40:01', '2025-09-18 10:40:01'),
(87, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-19 08:40:26', '2025-09-19 08:40:26'),
(88, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-19 11:55:17', '2025-09-19 11:55:17'),
(89, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-20 11:52:49', '2025-09-20 11:52:49'),
(90, 'brand', 'brand has been created', 'App\\Models\\Brand', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"sdsdas\", \"status\": \"active\", \"user_id\": 0, \"brandImg\": null}}', NULL, '2025-09-20 15:53:24', '2025-09-20 15:53:24'),
(91, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"sdsdas\"}, \"attributes\": {\"name\": \"sdsdassdf\"}}', NULL, '2025-09-20 16:07:33', '2025-09-20 16:07:33'),
(92, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-20 16:08:15', '2025-09-20 16:08:15'),
(93, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-20 16:08:17', '2025-09-20 16:08:17'),
(94, 'brand', 'brand has been deleted', 'App\\Models\\Brand', 'deleted', 1, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"sdsdassdf\", \"status\": \"active\", \"user_id\": 0, \"brandImg\": null}}', NULL, '2025-09-20 16:08:20', '2025-09-20 16:08:20'),
(95, 'brand', 'brand has been created', 'App\\Models\\Brand', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"asddas\", \"status\": \"active\", \"user_id\": 0, \"brandImg\": null}}', NULL, '2025-09-20 16:09:24', '2025-09-20 16:09:24'),
(96, 'brand', 'brand has been created', 'App\\Models\\Brand', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"dad\", \"status\": \"active\", \"user_id\": 0, \"brandImg\": \"brand/ce1e9647-e63e-44a4-8d2b-e6dab8949b25.webp\"}}', NULL, '2025-09-20 16:19:23', '2025-09-20 16:19:23'),
(97, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 3, 'App\\Models\\User', 1, '{\"old\": {\"brandImg\": \"brand/ce1e9647-e63e-44a4-8d2b-e6dab8949b25.webp\"}, \"attributes\": {\"brandImg\": \"brand/506f98f5-0f67-4288-9d23-f0596411e084.webp\"}}', NULL, '2025-09-20 16:20:18', '2025-09-20 16:20:18'),
(98, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 3, 'App\\Models\\User', 1, '{\"old\": {\"brandImg\": \"brand/506f98f5-0f67-4288-9d23-f0596411e084.webp\"}, \"attributes\": {\"brandImg\": \"brand/a7f88c0c-30dd-4ba9-9c11-310ffb364297.webp\"}}', NULL, '2025-09-20 16:20:27', '2025-09-20 16:20:27'),
(99, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-20 16:26:45', '2025-09-20 16:26:45'),
(100, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-20 16:26:46', '2025-09-20 16:26:46'),
(101, 'brand', 'brand has been deleted', 'App\\Models\\Brand', 'deleted', 3, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"dad\", \"status\": \"active\", \"user_id\": 0, \"brandImg\": \"brand/a7f88c0c-30dd-4ba9-9c11-310ffb364297.webp\"}}', NULL, '2025-09-20 16:26:49', '2025-09-20 16:26:49'),
(102, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-21 09:31:48', '2025-09-21 09:31:48'),
(103, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-22 10:21:06', '2025-09-22 10:21:06'),
(104, 'brand', 'brand has been created', 'App\\Models\\Banner', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": null, \"status\": \"active\", \"user_id\": 0, \"brandImg\": null}}', NULL, '2025-09-22 10:56:15', '2025-09-22 10:56:15'),
(105, 'banner', 'banner has been created', 'App\\Models\\Banner', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\": {\"status\": \"active\", \"user_id\": 1, \"bannerImg\": \"banner/b8f86892-eb3a-43a2-925f-8cf0142af2be.webp\"}}', NULL, '2025-09-22 10:58:32', '2025-09-22 10:58:32'),
(106, 'banner', 'banner has been deleted', 'App\\Models\\Banner', 'deleted', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\", \"user_id\": 1, \"bannerImg\": \"banner/b8f86892-eb3a-43a2-925f-8cf0142af2be.webp\"}}', NULL, '2025-09-22 11:01:09', '2025-09-22 11:01:09'),
(107, 'banner', 'banner has been updated', 'App\\Models\\Banner', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-22 11:01:11', '2025-09-22 11:01:11'),
(108, 'banner', 'banner has been updated', 'App\\Models\\Banner', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-22 11:01:13', '2025-09-22 11:01:13'),
(109, 'banner', 'banner has been updated', 'App\\Models\\Banner', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-22 11:01:14', '2025-09-22 11:01:14'),
(110, 'City', 'City has been created', 'App\\Models\\City', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"zfsfsd\", \"status\": \"active\", \"user_id\": 1}}', NULL, '2025-09-22 13:04:32', '2025-09-22 13:04:32'),
(111, 'City', 'City has been updated', 'App\\Models\\City', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"zfsfsd\"}, \"attributes\": {\"name\": \"zfsfsddf\"}}', NULL, '2025-09-22 13:04:36', '2025-09-22 13:04:36'),
(112, 'City', 'City has been updated', 'App\\Models\\City', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-22 13:04:38', '2025-09-22 13:04:38'),
(113, 'City', 'City has been updated', 'App\\Models\\City', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"zfsfsddf\"}, \"attributes\": {\"name\": \"Lucknow\"}}', NULL, '2025-09-22 13:04:45', '2025-09-22 13:04:45'),
(114, 'City', 'City has been deleted', 'App\\Models\\City', 'deleted', 1, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"Lucknow\", \"status\": \"inactive\", \"user_id\": 1}}', NULL, '2025-09-22 13:04:48', '2025-09-22 13:04:48'),
(115, 'City', 'City has been created', 'App\\Models\\City', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"Lucknow1\", \"status\": \"active\", \"user_id\": 1}}', NULL, '2025-09-22 13:05:09', '2025-09-22 13:05:09'),
(116, 'City', 'City has been updated', 'App\\Models\\City', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"Lucknow1\"}, \"attributes\": {\"name\": \"Lucknow\"}}', NULL, '2025-09-22 13:13:02', '2025-09-22 13:13:02'),
(117, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-22 13:20:19', '2025-09-22 13:20:19'),
(118, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-22 13:21:50', '2025-09-22 13:21:50'),
(119, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-22 13:22:52', '2025-09-22 13:22:52'),
(120, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"asddas\"}, \"attributes\": {\"name\": \"Mart\"}}', NULL, '2025-09-22 13:23:13', '2025-09-22 13:23:13'),
(121, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-22 13:23:23', '2025-09-22 13:23:23'),
(122, 'brand', 'brand has been updated', 'App\\Models\\Brand', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-22 13:23:24', '2025-09-22 13:23:24'),
(123, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-22 13:26:15', '2025-09-22 13:26:15'),
(124, 'default', 'User logged in', NULL, 'login', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-22 13:26:28', '2025-09-22 13:26:28'),
(125, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 9, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-22 13:27:20', '2025-09-22 13:27:20'),
(126, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"active\"}, \"attributes\": {\"status\": \"inactive\"}}', NULL, '2025-09-22 13:28:02', '2025-09-22 13:28:02'),
(127, 'user', 'User has been updated', 'App\\Models\\User', 'updated', 20, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"inactive\"}, \"attributes\": {\"status\": \"active\"}}', NULL, '2025-09-22 13:28:03', '2025-09-22 13:28:03'),
(128, 'default', 'User logged out', NULL, 'logout', NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"device\": \"WebKit\", \"browser\": \"Chrome 140.0.0.0\", \"platform\": \"Windows\"}', NULL, '2025-09-22 13:30:05', '2025-09-22 13:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `all_countries`
--

DROP TABLE IF EXISTS `all_countries`;
CREATE TABLE IF NOT EXISTS `all_countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phonecode` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `capital` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `all_countries`
--

INSERT INTO `all_countries` (`id`, `name`, `phonecode`, `capital`, `updated_at`, `created_at`) VALUES
(1, 'Bahrain', '+973', 'Manama', '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(2, 'Kuwait', '+965', 'Kuwait City', '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(3, 'Oman', '+968', 'Muscat', '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(4, 'Qatar', '+974', 'Doha', '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(5, 'Saudi Arabia', '+966', 'Riyadh', '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(6, 'United Arab Emirates', '+971', 'Abu Dhabi', '2025-07-09 17:11:11', '2025-07-09 17:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `all_states`
--

DROP TABLE IF EXISTS `all_states`;
CREATE TABLE IF NOT EXISTS `all_states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `all_states_country_id_foreign` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `all_states`
--

INSERT INTO `all_states` (`id`, `name`, `country_id`, `updated_at`, `created_at`) VALUES
(1, '\'Isa', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(2, 'Badiyah', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(3, 'Hidd', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(4, 'Jidd Hafs', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(5, 'Mahama', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(6, 'Manama', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(7, 'Sitrah', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(8, 'al-Manamah', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(9, 'al-Muharraq', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(10, 'ar-Rifa\'a', 1, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(11, 'Al Asimah', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(12, 'Hawalli', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(13, 'Mishref', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(14, 'Qadesiya', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(15, 'Safat', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(16, 'Salmiya', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(17, 'al-Ahmadi', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(18, 'al-Farwaniyah', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(19, 'al-Jahra', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(20, 'al-Kuwayt', 2, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(21, 'Al Buraimi', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(22, 'Dhufar', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(23, 'Masqat', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(24, 'Musandam', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(25, 'Rusayl', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(26, 'Wadi Kabir', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(27, 'ad-Dakhiliyah', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(28, 'adh-Dhahirah', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(29, 'al-Batinah', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(30, 'ash-Sharqiyah', 3, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(31, 'Doha', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(32, 'Jarian-al-Batnah', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(33, 'Umm Salal', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(34, 'ad-Dawhah', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(35, 'al-Ghuwayriyah', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(36, 'al-Jumayliyah', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(37, 'al-Khawr', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(38, 'al-Wakrah', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(39, 'ar-Rayyan', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(40, 'ash-Shamal', 4, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(41, 'Al Khobar', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(42, 'Aseer', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(43, 'Ash Sharqiyah', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(44, 'Asir', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(45, 'Central Province', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(46, 'Eastern Province', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(47, 'Ha\'il', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(48, 'Jawf', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(49, 'Jizan', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(50, 'Makkah', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(51, 'Najran', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(52, 'Qasim', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(53, 'Tabuk', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(54, 'Western Province', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(55, 'al-Bahah', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(56, 'al-Hudud-ash-Shamaliyah', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(57, 'al-Madinah', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(58, 'ar-Riyad', 5, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(59, 'Abu Dhabi', 6, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(60, 'Ajman', 6, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(61, 'Dubai', 6, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(62, 'Ras al-Khaymah', 6, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(63, 'Sharjah', 6, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(64, 'Umm Al Quwain', 6, '2025-07-09 17:11:11', '2025-07-09 17:11:11'),
(65, 'al-Fujayrah', 6, '2025-07-09 17:11:11', '2025-07-09 17:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `bannerImg` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` enum('active','inactive','pending') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'active',
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `bannerImg`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'inactive', 0, NULL, '2025-09-22 10:56:15', '2025-09-22 11:01:14'),
(2, 'banner/b8f86892-eb3a-43a2-925f-8cf0142af2be.webp', 'active', 1, '2025-09-22 11:01:09', '2025-09-22 10:58:32', '2025-09-22 11:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `blog_title` text NOT NULL,
  `slug_uri` text NOT NULL,
  `blog_description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_img` text,
  `blog_thumbnail_img` text,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active',
  `no_of_view` varchar(255) DEFAULT NULL,
  `meta_title` text,
  `meta_keyword` text,
  `meta_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_title`, `slug_uri`, `blog_description`, `created_at`, `updated_at`, `blog_img`, `blog_thumbnail_img`, `status`, `no_of_view`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(7, 'ADASDS', 'adasds', '<p>ASDSADSA</p>', '2025-09-20 14:01:12', '2025-09-20 14:01:12', NULL, NULL, 'active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brandImg` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` enum('active','inactive','pending') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'active',
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `brandImg`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'sdsdassdf', NULL, 'active', 0, '2025-09-20 16:08:20', '2025-09-20 15:53:24', '2025-09-20 16:08:20'),
(2, 'Mart', NULL, 'active', 0, NULL, '2025-09-20 16:09:24', '2025-09-22 13:23:24'),
(3, 'dad', 'brand/a7f88c0c-30dd-4ba9-9c11-310ffb364297.webp', 'active', 0, '2025-09-20 16:26:49', '2025-09-20 16:19:23', '2025-09-20 16:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:6:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:7:\"heading\";s:1:\"c\";s:4:\"name\";s:1:\"d\";s:5:\"title\";s:1:\"e\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:48:{i:0;a:6:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Manage Role\";s:1:\"c\";s:11:\"role.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:1;a:6:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"Manage Role\";s:1:\"c\";s:9:\"role.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:2;a:6:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"Manage Role\";s:1:\"c\";s:9:\"role.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:3;a:6:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Manage Role\";s:1:\"c\";s:11:\"role.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:4;a:6:{s:1:\"a\";i:5;s:1:\"b\";s:14:\"Manage Dealer \";s:1:\"c\";s:11:\"dealer.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:5;a:6:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"Manage Dealer \";s:1:\"c\";s:13:\"dealer.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:6;a:6:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"Manage Dealer \";s:1:\"c\";s:11:\"dealer.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:7;a:6:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"Manage Dealer \";s:1:\"c\";s:13:\"dealer.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:8;a:6:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"Manage Dealer \";s:1:\"c\";s:13:\"dealer.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:9;a:6:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"Change Password\";s:1:\"c\";s:20:\"change-password.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:10;a:6:{s:1:\"a\";i:11;s:1:\"b\";s:11:\"Manage User\";s:1:\"c\";s:9:\"user.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:11;a:6:{s:1:\"a\";i:12;s:1:\"b\";s:11:\"Manage User\";s:1:\"c\";s:11:\"user.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:12;a:6:{s:1:\"a\";i:13;s:1:\"b\";s:11:\"Manage User\";s:1:\"c\";s:9:\"user.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:13;a:6:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"Manage User\";s:1:\"c\";s:11:\"user.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:14;a:6:{s:1:\"a\";i:15;s:1:\"b\";s:11:\"Manage User\";s:1:\"c\";s:11:\"user.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:15;a:6:{s:1:\"a\";i:16;s:1:\"b\";s:11:\"Manage User\";s:1:\"c\";s:17:\"user.show-profile\";s:1:\"d\";s:12:\"View Profile\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:16;a:6:{s:1:\"a\";i:17;s:1:\"b\";s:4:\"Blog\";s:1:\"c\";s:10:\"blogs.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:17;a:6:{s:1:\"a\";i:18;s:1:\"b\";s:4:\"Blog\";s:1:\"c\";s:12:\"blogs.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:18;a:6:{s:1:\"a\";i:19;s:1:\"b\";s:4:\"Blog\";s:1:\"c\";s:10:\"blogs.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:19;a:6:{s:1:\"a\";i:20;s:1:\"b\";s:4:\"Blog\";s:1:\"c\";s:12:\"blogs.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:20;a:6:{s:1:\"a\";i:21;s:1:\"b\";s:4:\"Blog\";s:1:\"c\";s:12:\"blogs.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:21;a:6:{s:1:\"a\";i:22;s:1:\"b\";s:11:\"Manage Cars\";s:1:\"c\";s:8:\"cars.add\";s:1:\"d\";s:3:\"Add\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:22;a:6:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"Manage Cars\";s:1:\"c\";s:9:\"cars.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:23;a:6:{s:1:\"a\";i:24;s:1:\"b\";s:11:\"Manage Cars\";s:1:\"c\";s:9:\"cars.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:24;a:6:{s:1:\"a\";i:25;s:1:\"b\";s:11:\"Manage Cars\";s:1:\"c\";s:11:\"cars.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:25;a:6:{s:1:\"a\";i:26;s:1:\"b\";s:11:\"Manage Cars\";s:1:\"c\";s:11:\"cars.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:26;a:6:{s:1:\"a\";i:27;s:1:\"b\";s:11:\"Manage Cars\";s:1:\"c\";s:23:\"candidate-form.download\";s:1:\"d\";s:8:\"Download\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:27;a:6:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"Manage Brand\";s:1:\"c\";s:10:\"brand.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:28;a:6:{s:1:\"a\";i:29;s:1:\"b\";s:12:\"Manage Brand\";s:1:\"c\";s:12:\"brand.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:29;a:6:{s:1:\"a\";i:30;s:1:\"b\";s:12:\"Manage Brand\";s:1:\"c\";s:10:\"brand.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:30;a:6:{s:1:\"a\";i:31;s:1:\"b\";s:12:\"Manage Brand\";s:1:\"c\";s:12:\"brand.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:31;a:6:{s:1:\"a\";i:32;s:1:\"b\";s:12:\"Manage Brand\";s:1:\"c\";s:12:\"brand.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:32;a:6:{s:1:\"a\";i:33;s:1:\"b\";s:8:\"Settings\";s:1:\"c\";s:13:\"settings.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:33;a:6:{s:1:\"a\";i:34;s:1:\"b\";s:18:\"Manage Home Banner\";s:1:\"c\";s:11:\"banner.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:6:{s:1:\"a\";i:35;s:1:\"b\";s:18:\"Manage Home Banner\";s:1:\"c\";s:13:\"banner.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:6:{s:1:\"a\";i:36;s:1:\"b\";s:18:\"Manage Home Banner\";s:1:\"c\";s:11:\"banner.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:6:{s:1:\"a\";i:37;s:1:\"b\";s:18:\"Manage Home Banner\";s:1:\"c\";s:13:\"banner.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:6:{s:1:\"a\";i:38;s:1:\"b\";s:18:\"Manage Home Banner\";s:1:\"c\";s:13:\"banner.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:6:{s:1:\"a\";i:39;s:1:\"b\";s:14:\"Manage Colours\";s:1:\"c\";s:11:\"colour.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:6:{s:1:\"a\";i:40;s:1:\"b\";s:14:\"Manage Colours\";s:1:\"c\";s:13:\"colour.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:6:{s:1:\"a\";i:41;s:1:\"b\";s:14:\"Manage Colours\";s:1:\"c\";s:11:\"colour.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:6:{s:1:\"a\";i:42;s:1:\"b\";s:14:\"Manage Colours\";s:1:\"c\";s:13:\"colour.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:6:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"Manage Colours\";s:1:\"c\";s:13:\"colour.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:6:{s:1:\"a\";i:44;s:1:\"b\";s:11:\"Manage City\";s:1:\"c\";s:9:\"city.view\";s:1:\"d\";s:4:\"View\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:6:{s:1:\"a\";i:45;s:1:\"b\";s:11:\"Manage City\";s:1:\"c\";s:11:\"city.create\";s:1:\"d\";s:6:\"Create\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:6:{s:1:\"a\";i:46;s:1:\"b\";s:11:\"Manage City\";s:1:\"c\";s:9:\"city.edit\";s:1:\"d\";s:4:\"Edit\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:6:{s:1:\"a\";i:47;s:1:\"b\";s:11:\"Manage City\";s:1:\"c\";s:11:\"city.delete\";s:1:\"d\";s:6:\"Delete\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:6:{s:1:\"a\";i:48;s:1:\"b\";s:11:\"Manage City\";s:1:\"c\";s:11:\"city.status\";s:1:\"d\";s:6:\"Status\";s:1:\"e\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"c\";s:5:\"Admin\";s:1:\"e\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"c\";s:5:\"Staff\";s:1:\"e\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"c\";s:6:\"Buyers\";s:1:\"e\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"c\";s:6:\"Dealer\";s:1:\"e\";s:3:\"web\";}}}', 1758653996);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint UNSIGNED NOT NULL,
  `brand` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `car_name` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `variant` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `registration_year` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `manufacture_year` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `car_condition` enum('New','Used') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Used',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `insurance_doc` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `ownership` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rto` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `car_image` tinytext COLLATE utf8mb3_unicode_ci,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rc_copy` text COLLATE utf8mb3_unicode_ci,
  `pollution` text COLLATE utf8mb3_unicode_ci,
  `image_360` tinytext COLLATE utf8mb3_unicode_ci,
  `gallery_image` text COLLATE utf8mb3_unicode_ci,
  `features` text COLLATE utf8mb3_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `dealer_id`, `brand`, `car_name`, `variant`, `price`, `registration_year`, `manufacture_year`, `car_condition`, `created_at`, `updated_at`, `insurance_doc`, `ownership`, `rto`, `car_image`, `description`, `rc_copy`, `pollution`, `image_360`, `gallery_image`, `features`, `status`) VALUES
(27, 20, 'sdfsdf', 'sddsf', 'sdf', 3.00, '123123', '0000', 'New', '2025-09-18 13:07:31', '2025-09-18 13:07:31', NULL, '123123', '1231', 'cars/ba0081e5-c702-4122-a0a3-db14341e5d06.webp', '<p>23424234</p>', NULL, NULL, NULL, NULL, NULL, 'active'),
(28, 20, 'ASA', 'Sas', 'AS', 21312.00, '12313', '0000', 'New', '2025-09-19 12:19:55', '2025-09-19 12:19:55', NULL, '123123', '12313', 'cars/57821149-31d8-44a7-b34e-4e38034a6413.webp', '<p>ASDASDAS</p>', NULL, NULL, NULL, NULL, NULL, 'active'),
(31, 20, 'sdfs', 'sfdf', 'sdf', 34.00, 'dgsdf', '1231', 'New', '2025-09-19 12:57:46', '2025-09-19 13:07:58', 'cars/wmsJ6b8W2E22KFmWY1LDPjwHEAl1yksgMGrDfmGF.jpg', '234234', '123', 'cars/ea7b77b3-03ea-40bd-b638-289e6c9cef89.webp', '<p>xcvxcvcx</p>', 'cars/IQUB3VgxctXpnstgHDmna8r5ipMIqD6FNRBL17tP.jpg', 'cars/aFl54NMz679PmWVmOpSBzTGn1nqkxVHU9RnGTkR4.jpg', 'cars/PZNBZcX1kfxK4Gre4u8ybgGoiU4s6rPioufG29wc.jpg', 'cars_gallery/AJczsos8pI4cH8w2y8aa3LcI0149ObZksjmR9Z5n.jpg', 'Power Steering,Sunroof', 'active'),
(32, 20, 'sdadasd', 'sdadasd', '2342', 7.90, '234', '2342', 'New', '2025-09-20 12:23:44', '2025-09-20 13:06:42', 'cars/lznQNjL9IhAS2zW9F8pJqZXF49OOfK4wrUxWTSJF.jpg', '234234', '23423', 'cars/655f5b7f-d7e0-45e5-9fa5-bb517bd850ba.webp', '<p>fsdfssdfsd</p>', 'cars/1Vbbw5MJZ0jQxYvBmUWF77r1QUYHiFnt96Ny9bRk.jpg', 'cars/Nwq4EpHratimc1upBKAd7EaFZBr4jEjZI2tDi2lb.jpg', 'cars/8dVmk1ul3FWxPSPhefeBlBbq7hy2XYdAPCX13Ztb.jpg', 'cars_gallery/6iVJpaF01h7YniwSzUwtOlS31QwEA1SjajySRMmE.jpg', 'Airbags,ABS,Power Steering', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `car_features`
--

DROP TABLE IF EXISTS `car_features`;
CREATE TABLE IF NOT EXISTS `car_features` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `car_id` bigint UNSIGNED NOT NULL,
  `feature_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `car_features_car_id_feature_id_unique` (`car_id`,`feature_id`),
  KEY `car_features_feature_id_foreign` (`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_specifications`
--

DROP TABLE IF EXISTS `car_specifications`;
CREATE TABLE IF NOT EXISTS `car_specifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `car_id` bigint UNSIGNED NOT NULL,
  `fuel_type` enum('Petrol','Diesel','CNG','Electric') COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `transmission` enum('Manual','Automatic') COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `engine_cc` int DEFAULT NULL,
  `mileage` decimal(5,2) DEFAULT NULL,
  `seating_capacity` int DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_specifications_fuel_type_index` (`fuel_type`),
  KEY `car_specifications_transmission_index` (`transmission`),
  KEY `car_specifications_engine_cc_index` (`engine_cc`),
  KEY `car_specifications_seating_capacity_index` (`seating_capacity`),
  KEY `car_specifications_color_index` (`color`),
  KEY `car_specifications_car_id_foreign` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `car_specifications`
--

INSERT INTO `car_specifications` (`id`, `car_id`, `fuel_type`, `transmission`, `engine_cc`, `mileage`, `seating_capacity`, `color`, `created_at`, `updated_at`) VALUES
(1, 27, 'Petrol', 'Manual', NULL, NULL, NULL, NULL, '2025-09-18 13:07:31', '2025-09-18 13:07:31'),
(2, 28, 'Petrol', 'Manual', NULL, NULL, NULL, NULL, '2025-09-19 12:19:55', '2025-09-19 12:19:55'),
(5, 31, 'Petrol', 'Automatic', NULL, NULL, NULL, NULL, '2025-09-19 12:57:46', '2025-09-19 13:07:58'),
(6, 32, 'Petrol', 'Manual', 24, 999.99, 4234, '23432', '2025-09-20 12:23:44', '2025-09-20 12:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` enum('active','inactive','pending') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'active',
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Lucknow', 'inactive', 1, '2025-09-22 13:04:48', '2025-09-22 13:04:32', '2025-09-22 13:04:48'),
(2, 'Lucknow', 'active', 1, NULL, '2025-09-22 13:05:09', '2025-09-22 13:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

DROP TABLE IF EXISTS `colours`;
CREATE TABLE IF NOT EXISTS `colours` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` enum('active','inactive','pending') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'active',
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`id`, `name`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'red', 'active', 1, '2025-09-22 12:48:02', '2025-09-22 12:43:58', '2025-09-22 12:48:02'),
(2, 'Red', 'active', 1, NULL, '2025-09-22 12:48:06', '2025-09-22 13:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `features_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `collection_name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(12, 'App\\Models\\Car', 20, '3c6b8bdc-c189-42ba-8ed2-f5913cb8054a', 'main_image', 'login_bg', 'login_bg.jpg', 'image/jpeg', 'public', 'public', 49441, '[]', '[]', '{\"webp\": true}', '[]', 1, '2025-09-18 17:42:20', '2025-09-18 17:42:20'),
(13, 'App\\Models\\Car', 21, '3f194aaf-22c1-4956-bd6c-bb6863bec916', 'main_image', 'WhatsApp Image 2025-09-07 at 10.30.35 AM', 'WhatsApp-Image-2025-09-07-at-10.30.35-AM.jpeg', 'image/jpeg', 'public', 'public', 88661, '[]', '[]', '{\"webp\": true}', '[]', 1, '2025-09-18 17:45:31', '2025-09-18 17:45:32'),
(14, 'App\\Models\\Car', 22, '4695a29f-6553-40c6-919e-3cdaa00822e3', 'main_image', 'login_bg', 'login_bg.jpg', 'image/jpeg', 'public', 'public', 49441, '[]', '[]', '{\"webp\": true}', '[]', 1, '2025-09-18 17:47:11', '2025-09-18 17:47:12'),
(17, 'App\\Models\\Car', 25, '9bc3e529-443f-4900-9ef0-d177cdc7ffe8', 'main_image', 'login_bg', 'login_bg.jpg', 'image/jpeg', 'public', 'public', 49441, '[]', '[]', '{\"webp\": true}', '[]', 1, '2025-09-18 18:13:10', '2025-09-18 18:13:11'),
(22, 'App\\Models\\Car', 23, '903dbb52-44ad-451c-abe4-ffa58b9ba1b3', 'main_image', 'WhatsApp Image 2025-09-06 at 9.33.21 AM', 'WhatsApp-Image-2025-09-06-at-9.33.21-AM.jpeg', 'image/jpeg', 'public', 'public', 208816, '[]', '[]', '{\"webp\": true}', '[]', 3, '2025-09-18 18:41:18', '2025-09-18 18:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_roles_table', 1),
(2, '0002_01_01_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_05_25_090217_create_all_countries_table', 1),
(7, '2025_05_25_090509_create_all_states_table', 1),
(8, '2025_05_25_090520_create_all_cities_table', 1),
(9, '2025_05_25_112316_create_fe_documents_table', 1),
(10, '2025_05_26_112328_create_ra_documents_table', 1),
(11, '2025_05_27_105439_create_user_passports_table', 1),
(12, '2025_05_29_174014_create_candidates_table', 1),
(13, '2025_06_19_153504_create_permissions_table', 1),
(14, '2025_06_19_153505_create_model_has_permissions_table', 1),
(15, '2025_06_19_153506_create_model_has_roles_table', 1),
(16, '2025_06_19_153507_create_role_has_permissions_table', 1),
(17, '2025_06_19_162601_create_website_setings_table', 1),
(18, '2025_06_19_175343_create_cache_table', 1),
(19, '2025_06_19_180820_create_sessions_table', 1),
(20, '2027_09_26_172251_create_role_user_table', 1),
(21, '2025_08_20_155904_create_activity_log_table', 2),
(22, '2025_08_20_155905_add_event_column_to_activity_log_table', 2),
(23, '2025_08_20_155906_add_batch_uuid_column_to_activity_log_table', 2),
(24, '2025_08_27_203253_add_status_to_candidates_table', 3),
(25, '2025_09_08_184524_create_user_metas_table', 4),
(26, '2025_09_16_181652_create_car_specifications_table', 5),
(27, '2025_09_16_181704_create_features_table', 6),
(28, '2025_09_16_181728_create_car_features_table', 7),
(29, 'create_media_table', 8),
(30, '2025_09_22_164306_create_colours_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `heading`, `name`, `title`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Manage Role', 'role.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(2, 'Manage Role', 'role.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(3, 'Manage Role', 'role.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(4, 'Manage Role', 'role.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(5, 'Manage Dealer ', 'dealer.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(6, 'Manage Dealer ', 'dealer.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(7, 'Manage Dealer ', 'dealer.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(8, 'Manage Dealer ', 'dealer.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(9, 'Manage Dealer ', 'dealer.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(10, 'Change Password', 'change-password.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(11, 'Manage User', 'user.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(12, 'Manage User', 'user.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(13, 'Manage User', 'user.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(14, 'Manage User', 'user.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(15, 'Manage User', 'user.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(16, 'Manage User', 'user.show-profile', 'View Profile', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(17, 'Blog', 'blogs.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(18, 'Blog', 'blogs.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(19, 'Blog', 'blogs.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(20, 'Blog', 'blogs.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(21, 'Blog', 'blogs.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(22, 'Manage Cars', 'cars.add', 'Add', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(23, 'Manage Cars', 'cars.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(24, 'Manage Cars', 'cars.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(25, 'Manage Cars', 'cars.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(26, 'Manage Cars', 'cars.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(27, 'Manage Cars', 'candidate-form.download', 'Download', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(28, 'Manage Brand', 'brand.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(29, 'Manage Brand', 'brand.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(30, 'Manage Brand', 'brand.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(31, 'Manage Brand', 'brand.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(32, 'Manage Brand', 'brand.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(33, 'Settings', 'settings.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(34, 'Manage Home Banner', 'banner.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(35, 'Manage Home Banner', 'banner.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(36, 'Manage Home Banner', 'banner.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(37, 'Manage Home Banner', 'banner.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(38, 'Manage Home Banner', 'banner.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(39, 'Manage Colours', 'colour.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(40, 'Manage Colours', 'colour.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(41, 'Manage Colours', 'colour.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(42, 'Manage Colours', 'colour.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(43, 'Manage Colours', 'colour.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(44, 'Manage City', 'city.view', 'View', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(45, 'Manage City', 'city.create', 'Create', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(46, 'Manage City', 'city.edit', 'Edit', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(47, 'Manage City', 'city.delete', 'Delete', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(48, 'Manage City', 'city.status', 'Status', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-07-09 11:41:09', '2025-07-09 11:41:09'),
(2, 'Staff', 'web', '2025-07-11 10:07:54', '2025-07-11 10:07:54'),
(3, 'Buyers', 'web', '2025-09-08 23:43:29', '2025-09-08 23:51:19'),
(4, 'Dealer', 'web', '2025-09-08 23:43:43', '2025-09-08 23:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2),
(4, 9, 2),
(5, 10, 2),
(6, 11, 2),
(7, 12, 2),
(8, 13, 2),
(9, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tYt4KFrb0IWMknEB2P8ycmzOflsptClOj2Yu1BGw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEpNUEl4VkFEZzFRcmVHcnRBU2xnT0Jsb3E3WmozNHpOaVBmdHV2eCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1758567605);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mobile` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `city` varchar(25) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pincode` varchar(15) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dealer_type` varchar(25) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_proof` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `profile_image` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'inactive',
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_added_by_foreign` (`added_by`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_id`, `password`, `mobile`, `address`, `city`, `pincode`, `dealer_type`, `id_proof`, `profile_image`, `added_by`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, 1, '$2y$12$J8fYy3A2Mg9gTwjae4P/kum70L1HUzKgJ0I9qUPTOdQ1ac2QAmQ3q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', NULL, NULL, '2025-07-09 11:41:11', '2025-07-19 13:10:17'),
(2, 'df', 'ashish.gupta052@gmail.com', NULL, 2, '$2y$12$1DSW.m43sdv8naU8j7.dF.gph2QUvDfdSGQV99W67UNP.31JeMqAK', '8912345678', 'fdsfsd', NULL, NULL, NULL, 'user_docs/T2mDpv8IqUgeCkAkgt9fbz7JNQiAf73NoPGiZkhu.jpg', 'user_docs/JypXJ7Vqb0RbkIaRmcnDU990VPNrMbLcnKqzh1Hb.jpg', 1, 'inactive', NULL, NULL, '2025-07-11 10:44:09', '2025-09-22 13:22:52'),
(3, 'Testing', 'testing@gmail.com', NULL, 2, '$2y$12$1Yf8V.Rk3q8IOJfhFlkEC.XLpc2dd7VZrMqoBILfIofjy0ENjsO3m', '9877665533', 'test', NULL, NULL, NULL, 'user_docs/71G0LkQzXIOFvxCP9I5AF79r5dED31ypFXcT0kuA.jpg', 'user_docs/3EjUDqoI0aTQyaK4YSZLk0yGzrgunTZpoC8uEAeE.png', 1, 'inactive', NULL, '2025-07-20 04:32:37', '2025-07-20 04:31:21', '2025-08-18 15:47:02'),
(9, 'adad', 'testing@gmail.com', NULL, 2, '$2y$12$g5CdK2I8aPJ7wUAJ0iD68ehHHApCmqKXnWeMlpyMrKl.KPslW3WwW', '8877889988', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', NULL, NULL, '2025-07-20 05:29:37', '2025-09-22 13:27:20'),
(10, 'sfsf', 'lunebasyso@mailinator', NULL, 2, '$2y$12$Z3F9Q/zv20iubm7RSsC.Z.qGyJLgKsTDTiZbEUZflbl0UM5hAXO82', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'inactive', NULL, '2025-07-20 08:57:27', '2025-07-20 08:40:38', '2025-07-20 14:53:03'),
(11, 'adada', 'lunebasyso@mailinator.com', NULL, 2, '$2y$12$G0diy0KLznzJVEQJRji7zeJ5UX/6M6F1QUFSSkM1dHVZDw.mhXUue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'inactive', NULL, '2025-07-20 09:19:01', '2025-07-20 08:57:43', '2025-07-20 09:19:01'),
(12, 'asda', 'lunebasyso@mailinator.com', NULL, 2, '$2y$12$vG8DNAJq01getx98TokRWurPQBCPxGTeEmh8FbFDDEzDndjRGTqbq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'active', NULL, NULL, '2025-07-20 09:19:15', '2025-08-18 15:55:46'),
(13, 'fgfdg', 'dgd@gmail.com', NULL, 2, '$2y$12$FnLULv6i7SDPdBnF4VoPOee/L.E3RBcs9Bj7LCRE9K5HqdZqPNVTu', '9876543212', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'inactive', NULL, NULL, '2025-08-04 12:17:41', '2025-08-04 12:17:41'),
(14, 'asdasd', 'asda@g.com', NULL, 2, '$2y$12$a7q3qpWJg8E7.4/6PrCDoulgwkaxQwTE.Xbx3ErgZ3TbBol.K8keG', '9876543216', 'czxcz', NULL, NULL, NULL, 'user_docs/UQ6htlaOym2KIyH6FObyTNmNw5VYk5UlJnVTdkmG.jpg', 'user_docs/3KAYuBpe91QQ5NVnysp4dT1Z3jYIghHPUSfL5Qnt.jpg', 1, 'inactive', NULL, NULL, '2025-08-21 08:57:43', '2025-08-21 08:57:43'),
(15, 'asdasd', 'asda1@g.com', NULL, 2, '$2y$12$bpTrz1hsksR3GfSOS9y6De7.Qi5VxZkiyP1Z4aQsU9MgV2Fs/KdL6', '9876543216', 'czxcz', NULL, NULL, NULL, 'user_docs/1Jnx8uVm60AJrgEmmVGrkRFOAUY9LwjutpvBR4td.jpg', 'user_docs/cHkCI2twauG0dg9T6HV1sh0DElLCIwJE8XEM7oBJ.jpg', 1, 'inactive', NULL, NULL, '2025-08-21 08:58:39', '2025-08-21 08:58:39'),
(16, 'staff1', 'staff1@gmail.com', NULL, 2, '$2y$12$8L0Wve49OonGj99Qim5L7OLnxD3m.3xXp2fa/yhmemfJ42s/KGWuu', '8888888888', 'sdadasda', NULL, NULL, NULL, 'user_docs/hGRSCE85NbfvDfz6BqBBgJthnlka16vpceYBkhlh.jpg', 'user_docs/Ro4iFiluv0icJAl0FjR02BNNWVrwE06xqtPhZcCa.jpg', 1, 'active', NULL, NULL, '2025-08-24 10:15:43', '2025-08-29 12:54:18'),
(17, 'dsfgf', 'admin1@gmail.com', NULL, 2, '$2y$12$YYIftp/uetrdS6QMwxsfXO8P7IFxsaohnBplwuPyCA8whzgYJ76y.', '2134566645', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'inactive', NULL, NULL, '2025-09-10 22:09:19', '2025-09-10 22:09:19'),
(18, 'aszdxfcghjk', 'admin67@gmail.com', NULL, 2, '$2y$12$Kb9URhxNTNKHtOYpNLuaAOM3s.tMEIg7HtLDIDBDZXKFQjIyiPuq2', '1234567891', 'sdzxcvhjkllvvbn', 'sdzdxfcghvjbknlm', '213456', NULL, NULL, NULL, NULL, 'inactive', NULL, NULL, '2025-09-10 22:13:31', '2025-09-11 00:44:18'),
(19, 'asdasdasd', 'adminasd@gmail.com', NULL, 2, '$2y$12$tOKGtpq.zV6Z95fjf2N75eDa2jre0xXyM5OoycTMgovS85s66fpxS', '2424324234', '23432434', '5', '234324', 'new', 'pan_card/5iR4QWLUEB6665fHphIkzJ8eU9wsIPw4URSXgC2e.png', 'dealer_logo/8HT7L3qdB8oaaqXpQNGGbgHqhEc48EAqVuMDa3Nw.jpg', NULL, 'inactive', NULL, '2025-09-11 01:22:34', '2025-09-11 01:09:38', '2025-09-11 01:22:34'),
(20, 'dsfsfs', 'adminsdsad@gmail.com', NULL, 4, '$2y$12$WF3iKjKQu5bQA2CNrzT7leyNBUIQXvV0EOuafzUt5l7IFdvX.BpUS', '3242342343', '23wfdfsdf', '16', '223432', 'new', 'pan_card/gKiu3XTCJ2KqntHiiDZ07RzZZGTGDeNno8smselP.png', 'dealer_logo/g2Ch5TyURW3mJOEUtV7DABi11iWRCne2mQxggQz9.jpg', 1, 'active', NULL, NULL, '2025-09-11 01:26:40', '2025-09-22 13:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_metas`
--

DROP TABLE IF EXISTS `user_metas`;
CREATE TABLE IF NOT EXISTS `user_metas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `meta_value` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_metas_user_id_meta_key_index` (`user_id`,`meta_key`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_metas`
--

INSERT INTO `user_metas` (`id`, `user_id`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 18, 'alternate_phone', '\"1234567890\"', '2025-09-10 22:13:31', '2025-09-10 22:13:31'),
(2, 18, 'dealership_name', '\"1234567890\"', '2025-09-10 22:13:31', '2025-09-10 22:13:31'),
(3, 18, 'dealer_code', '\"sdfghjkl;\"', '2025-09-10 22:13:31', '2025-09-10 22:13:31'),
(4, 18, 'dealer_type', '\"new\"', '2025-09-10 22:13:31', '2025-09-10 22:13:31'),
(5, 18, 'address', '\"asdzfxcghjbklm;,\"', '2025-09-10 22:13:31', '2025-09-10 22:13:31'),
(6, 18, 'city', '\"sdfghjkl;\"', '2025-09-10 22:13:32', '2025-09-10 22:13:32'),
(7, 18, 'pincode', '\"987654\"', '2025-09-10 22:13:32', '2025-09-10 22:13:32'),
(8, 18, 'contact_person', '\"sdfsfs\"', '2025-09-11 00:41:11', '2025-09-11 00:41:11'),
(9, 19, 'contact_person', '\"asdasdasd\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(10, 19, 'alternate_phone', '\"2342342342\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(11, 19, 'dealership_name', '\"23423423\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(12, 19, 'dealer_code', '\"423423\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(13, 19, 'dealer_type', '\"new\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(14, 19, 'established_year', '\"3243\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(15, 19, 'employees', '\"23423\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(16, 19, 'monthly_sales', '\"234234\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(17, 19, 'trade_license', '\"trade_license/NoJWs08ytvXghqmOkhKkFTJ4io6ufRqkvSZ40gte.png\"', '2025-09-11 01:09:38', '2025-09-11 01:09:38'),
(18, 20, 'contact_person', '\"fsdfsdfdsfsdf\"', '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(19, 20, 'alternate_phone', '\"4234234234\"', '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(20, 20, 'dealership_name', '\"43243rfd\"', '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(21, 20, 'dealer_code', '\"343242\"', '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(22, 20, 'established_year', '\"3243\"', '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(23, 20, 'employees', '\"43243\"', '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(24, 20, 'monthly_sales', '\"4234242\"', '2025-09-11 01:26:40', '2025-09-11 01:26:40'),
(25, 20, 'trade_license', '\"trade_license/DSnAkz33vYcDmkwqiEiRuIfd3sKJfa2O7Cb1wh39.png\"', '2025-09-11 01:36:17', '2025-09-11 01:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

DROP TABLE IF EXISTS `website_settings`;
CREATE TABLE IF NOT EXISTS `website_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `web_mobile_number` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `web_email_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `company_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `footer_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `website_logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `copyright_text` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `web_mobile_number`, `web_email_id`, `company_name`, `footer_description`, `company_address`, `website_logo`, `copyright_text`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '', '', 'CarkeMalik', NULL, NULL, 'website/UQbW0QHYZcDczzTKCMMCInR8XBgsmzCmiPyQS6uB.jpg', NULL, NULL, '2025-07-19 11:52:48', '2025-09-10 21:27:52');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_states`
--
ALTER TABLE `all_states`
  ADD CONSTRAINT `all_states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `all_countries` (`id`);

--
-- Constraints for table `car_features`
--
ALTER TABLE `car_features`
  ADD CONSTRAINT `car_features_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_features_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `car_specifications`
--
ALTER TABLE `car_specifications`
  ADD CONSTRAINT `car_specifications_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_metas`
--
ALTER TABLE `user_metas`
  ADD CONSTRAINT `user_metas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
