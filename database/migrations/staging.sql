-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: imhero-staging.cluster-coixemogwlma.ap-southeast-1.rds.amazonaws.com:3306
-- Generation Time: May 28, 2024 at 01:45 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tendo_stag`
--

-- --------------------------------------------------------

--
-- Table structure for table `sw_account_admin`
--

CREATE TABLE `sw_account_admin` (
  `id` int NOT NULL,
  `admin_id` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `web3_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nickname` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tag` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `authenticator` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('active','inactivated','freezed','suspended') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_account_admin`
--

INSERT INTO `sw_account_admin` (`id`, `admin_id`, `created_at`, `updated_at`, `deleted_at`, `web3_address`, `nickname`, `password`, `tag`, `email`, `authenticator`, `status`, `remark`) VALUES
(1, 'E9QMJCW7K23A5QT1', '2024-01-09 14:51:17', '2024-05-27 02:01:54', NULL, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', 'eric', NULL, NULL, NULL, 'web3_address', 'active', NULL),
(2, 'E9QMJCW7K23A5QT5', '2024-01-10 13:13:17', '2024-04-23 14:31:15', NULL, '0xDe600b6b32aba9c01c86580F5b1Cfd90B6d91166', 'david', NULL, NULL, NULL, 'web3_address', 'active', NULL),
(3, 'O14XIXHVHYOJHXMO', '2024-01-23 16:53:42', '2024-01-23 16:53:42', NULL, '0x0e1497245518320e8F089Eb648c8533DB636C696', 'zk', NULL, NULL, NULL, NULL, 'active', NULL),
(4, 'T0OXJT7AXEFB86VE', '2024-01-24 19:03:56', '2024-01-24 19:03:56', NULL, '0x014bFF04b584A372A06401AE228D1Bd1E6c4d5c9', 'clement', NULL, NULL, NULL, NULL, 'active', NULL),
(5, 'T0OXJT7AXEFB86VC', '2024-01-24 19:03:56', '2024-01-24 19:03:56', NULL, '0x41E28e5693d3dF66C5f6E0B996220fea592ADb4f', 'richie', NULL, NULL, NULL, NULL, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_account_user`
--

CREATE TABLE `sw_account_user` (
  `id` int NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `character` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `web3_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nickname` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tag` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `authenticator` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `membership` enum('normal','village_pass') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `status` enum('active','inactivated','freezed','suspended') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `telegram` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `discord` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telegram_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `discord_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_account_user`
--

INSERT INTO `sw_account_user` (`id`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `avatar`, `character`, `web3_address`, `nickname`, `password`, `tag`, `authenticator`, `membership`, `status`, `telegram`, `discord`, `twitter`, `google`, `telegram_name`, `discord_name`, `twitter_name`, `google_name`, `remark`) VALUES
(1, '5777TD8GGUGILS36', '2024-05-10 21:45:29', '2024-05-28 12:21:05', NULL, NULL, NULL, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', NULL, NULL, NULL, 'web3_address', 'village_pass', 'active', '6414116760', NULL, NULL, NULL, 'Eric Hong', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_admin_permission`
--

CREATE TABLE `sw_admin_permission` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `admin_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_admin',
  `role` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_admin_permission`
--

INSERT INTO `sw_admin_permission` (`id`, `created_at`, `updated_at`, `deleted_at`, `admin_uid`, `role`) VALUES
(1, '2023-11-24 17:39:06', '2023-11-24 17:39:09', NULL, 1, 1),
(2, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 2, 1),
(3, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 3, 1),
(4, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 4, 1),
(5, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_admin`
--

CREATE TABLE `sw_log_admin` (
  `id` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_admin',
  `by_admin_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_admin',
  `ip` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_table` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_id` int NOT NULL DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_cronjob`
--

CREATE TABLE `sw_log_cronjob` (
  `id` bigint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `used_at` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cronjob_code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `info` text COLLATE utf8mb4_general_ci,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_user`
--

CREATE TABLE `sw_log_user` (
  `id` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `by_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `ip` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_table` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_id` int NOT NULL DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_network_sponsor`
--

CREATE TABLE `sw_network_sponsor` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `upline_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_network_sponsor`
--

INSERT INTO `sw_network_sponsor` (`id`, `created_at`, `updated_at`, `deleted_at`, `uid`, `upline_uid`, `remark`) VALUES
(1, '2024-05-03 15:28:53', '2024-05-03 15:28:55', NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_permission_template`
--

CREATE TABLE `sw_permission_template` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `template_code` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rule` text COLLATE utf8mb4_general_ci,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_permission_template`
--

INSERT INTO `sw_permission_template` (`id`, `deleted_at`, `template_code`, `rule`, `remark`) VALUES
(1, NULL, 'admin', '[\"*\"]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_permission_warehouse`
--

CREATE TABLE `sw_permission_warehouse` (
  `id` int NOT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `from_site` varchar(128) COLLATE utf8mb4_general_ci DEFAULT 'common',
  `path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `action` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_permission_warehouse`
--

INSERT INTO `sw_permission_warehouse` (`id`, `code`, `deleted_at`, `from_site`, `path`, `action`, `remark`) VALUES
(1, 'admin_auth_request@get', NULL, 'admin', '/admin/auth/request', 'GET', NULL),
(2, 'admin_auth_verify@post', NULL, 'admin', '/admin/auth/verify', 'POST', NULL),
(3, 'admin_auth_logout@post', NULL, 'admin', '/admin/auth/logout', 'POST', NULL),
(4, 'admin_auth_rule@get', NULL, 'admin', '/admin/auth/rule', 'GET', NULL),
(5, 'admin_enumlist_list@get', NULL, 'admin', '/admin/enumList/list', 'GET', NULL),
(6, 'admin_account_admin_id@get', NULL, 'admin', '/admin/account/admin/{id:\\d+}', 'GET', NULL),
(7, 'admin_account_admin_list@get', NULL, 'admin', '/admin/account/admin/list', 'GET', NULL),
(8, 'admin_account_admin@get', NULL, 'admin', '/admin/account/admin', 'GET', NULL),
(9, 'admin_account_admin@post', NULL, 'admin', '/admin/account/admin', 'POST', NULL),
(10, 'admin_account_admin_id@put', NULL, 'admin', '/admin/account/admin/{id:\\d+}', 'PUT', NULL),
(11, 'admin_account_admin_id@delete', NULL, 'admin', '/admin/account/admin/{id:\\d+}', 'DELETE', NULL),
(12, 'admin_account_user_id@get', NULL, 'admin', '/admin/account/user/{id:\\d+}', 'GET', NULL),
(13, 'admin_account_user_list@get', NULL, 'admin', '/admin/account/user/list', 'GET', NULL),
(14, 'admin_account_user@get', NULL, 'admin', '/admin/account/user', 'GET', NULL),
(15, 'admin_account_user@post', NULL, 'admin', '/admin/account/user', 'POST', NULL),
(16, 'admin_account_user_id@put', NULL, 'admin', '/admin/account/user/{id:\\d+}', 'PUT', NULL),
(17, 'admin_account_user_id@delete', NULL, 'admin', '/admin/account/user/{id:\\d+}', 'DELETE', NULL),
(18, 'admin_account_user_viewbalance_id@get', NULL, 'admin', '/admin/account/user/viewBalance/{id:\\d+}', 'GET', NULL),
(19, 'admin_account_user_addbalance_id@put', NULL, 'admin', '/admin/account/user/addBalance/{id:\\d+}', 'PUT', NULL),
(20, 'admin_account_user_deductbalance_id@put', NULL, 'admin', '/admin/account/user/deductBalance/{id:\\d+}', 'PUT', NULL),
(21, 'admin_account_user_details@get', NULL, 'admin', '/admin/account/user/details', 'GET', NULL),
(22, 'admin_hierarchy_upline@get', NULL, 'admin', '/admin/hierarchy/upline', 'GET', NULL),
(23, 'admin_hierarchy_downline@get', NULL, 'admin', '/admin/hierarchy/downline', 'GET', NULL),
(24, 'admin_log_admin_id@get', NULL, 'admin', '/admin/log/admin/{id:\\d+}', 'GET', NULL),
(25, 'admin_log_admin_list@get', NULL, 'admin', '/admin/log/admin/list', 'GET', NULL),
(26, 'admin_log_admin@get', NULL, 'admin', '/admin/log/admin', 'GET', NULL),
(27, 'admin_log_admin@post', NULL, 'admin', '/admin/log/admin', 'POST', NULL),
(28, 'admin_log_admin_id@put', NULL, 'admin', '/admin/log/admin/{id:\\d+}', 'PUT', NULL),
(29, 'admin_log_admin_id@delete', NULL, 'admin', '/admin/log/admin/{id:\\d+}', 'DELETE', NULL),
(30, 'admin_log_api_id@get', NULL, 'admin', '/admin/log/api/{id:\\d+}', 'GET', NULL),
(31, 'admin_log_api_list@get', NULL, 'admin', '/admin/log/api/list', 'GET', NULL),
(32, 'admin_log_api@get', NULL, 'admin', '/admin/log/api', 'GET', NULL),
(33, 'admin_log_api@post', NULL, 'admin', '/admin/log/api', 'POST', NULL),
(34, 'admin_log_api_id@put', NULL, 'admin', '/admin/log/api/{id:\\d+}', 'PUT', NULL),
(35, 'admin_log_api_id@delete', NULL, 'admin', '/admin/log/api/{id:\\d+}', 'DELETE', NULL),
(36, 'admin_log_cronjob_id@get', NULL, 'admin', '/admin/log/cronjob/{id:\\d+}', 'GET', NULL),
(37, 'admin_log_cronjob_list@get', NULL, 'admin', '/admin/log/cronjob/list', 'GET', NULL),
(38, 'admin_log_cronjob@get', NULL, 'admin', '/admin/log/cronjob', 'GET', NULL),
(39, 'admin_log_cronjob@post', NULL, 'admin', '/admin/log/cronjob', 'POST', NULL),
(40, 'admin_log_cronjob_id@put', NULL, 'admin', '/admin/log/cronjob/{id:\\d+}', 'PUT', NULL),
(41, 'admin_log_cronjob_id@delete', NULL, 'admin', '/admin/log/cronjob/{id:\\d+}', 'DELETE', NULL),
(42, 'admin_log_user_id@get', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'GET', NULL),
(43, 'admin_log_user_list@get', NULL, 'admin', '/admin/log/user/list', 'GET', NULL),
(44, 'admin_log_user@get', NULL, 'admin', '/admin/log/user', 'GET', NULL),
(45, 'admin_log_user@post', NULL, 'admin', '/admin/log/user', 'POST', NULL),
(46, 'admin_log_user_id@put', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'PUT', NULL),
(47, 'admin_log_user_id@delete', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'DELETE', NULL),
(48, 'admin_network_sponsor_id@get', NULL, 'admin', '/admin/network/sponsor/{id:\\d+}', 'GET', NULL),
(49, 'admin_network_sponsor_list@get', NULL, 'admin', '/admin/network/sponsor/list', 'GET', NULL),
(50, 'admin_network_sponsor@get', NULL, 'admin', '/admin/network/sponsor', 'GET', NULL),
(51, 'admin_network_sponsor@post', NULL, 'admin', '/admin/network/sponsor', 'POST', NULL),
(52, 'admin_network_sponsor_id@put', NULL, 'admin', '/admin/network/sponsor/{id:\\d+}', 'PUT', NULL),
(53, 'admin_network_sponsor_id@delete', NULL, 'admin', '/admin/network/sponsor/{id:\\d+}', 'DELETE', NULL),
(54, 'admin_permission_admin_id@get', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'GET', NULL),
(55, 'admin_permission_admin_list@get', NULL, 'admin', '/admin/permission/admin/list', 'GET', NULL),
(56, 'admin_permission_admin@get', NULL, 'admin', '/admin/permission/admin', 'GET', NULL),
(57, 'admin_permission_admin@post', NULL, 'admin', '/admin/permission/admin', 'POST', NULL),
(58, 'admin_permission_admin_id@put', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'PUT', NULL),
(59, 'admin_permission_admin_id@delete', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'DELETE', NULL),
(60, 'admin_permission_template_id@get', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'GET', NULL),
(61, 'admin_permission_template_list@get', NULL, 'admin', '/admin/permission/template/list', 'GET', NULL),
(62, 'admin_permission_template@get', NULL, 'admin', '/admin/permission/template', 'GET', NULL),
(63, 'admin_permission_template@post', NULL, 'admin', '/admin/permission/template', 'POST', NULL),
(64, 'admin_permission_template_id@put', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'PUT', NULL),
(65, 'admin_permission_template_id@delete', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'DELETE', NULL),
(66, 'admin_permission_warehouse_id@get', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'GET', NULL),
(67, 'admin_permission_warehouse_list@get', NULL, 'admin', '/admin/permission/warehouse/list', 'GET', NULL),
(68, 'admin_permission_warehouse@get', NULL, 'admin', '/admin/permission/warehouse', 'GET', NULL),
(69, 'admin_permission_warehouse@post', NULL, 'admin', '/admin/permission/warehouse', 'POST', NULL),
(70, 'admin_permission_warehouse_id@put', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'PUT', NULL),
(71, 'admin_permission_warehouse_id@delete', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'DELETE', NULL),
(72, 'admin_reward_record_id@get', NULL, 'admin', '/admin/reward/record/{id:\\d+}', 'GET', NULL),
(73, 'admin_reward_record_list@get', NULL, 'admin', '/admin/reward/record/list', 'GET', NULL),
(74, 'admin_reward_record@get', NULL, 'admin', '/admin/reward/record', 'GET', NULL),
(75, 'admin_reward_record@post', NULL, 'admin', '/admin/reward/record', 'POST', NULL),
(76, 'admin_reward_record_id@put', NULL, 'admin', '/admin/reward/record/{id:\\d+}', 'PUT', NULL),
(77, 'admin_reward_record_id@delete', NULL, 'admin', '/admin/reward/record/{id:\\d+}', 'DELETE', NULL),
(78, 'admin_setting_airdrop_id@get', NULL, 'admin', '/admin/setting/airdrop/{id:\\d+}', 'GET', NULL),
(79, 'admin_setting_airdrop_list@get', NULL, 'admin', '/admin/setting/airdrop/list', 'GET', NULL),
(80, 'admin_setting_airdrop@get', NULL, 'admin', '/admin/setting/airdrop', 'GET', NULL),
(81, 'admin_setting_airdrop@post', NULL, 'admin', '/admin/setting/airdrop', 'POST', NULL),
(82, 'admin_setting_airdrop_id@put', NULL, 'admin', '/admin/setting/airdrop/{id:\\d+}', 'PUT', NULL),
(83, 'admin_setting_airdrop_id@delete', NULL, 'admin', '/admin/setting/airdrop/{id:\\d+}', 'DELETE', NULL),
(84, 'admin_setting_attribute_id@get', NULL, 'admin', '/admin/setting/attribute/{id:\\d+}', 'GET', NULL),
(85, 'admin_setting_attribute_list@get', NULL, 'admin', '/admin/setting/attribute/list', 'GET', NULL),
(86, 'admin_setting_attribute@get', NULL, 'admin', '/admin/setting/attribute', 'GET', NULL),
(87, 'admin_setting_attribute@post', NULL, 'admin', '/admin/setting/attribute', 'POST', NULL),
(88, 'admin_setting_attribute_id@put', NULL, 'admin', '/admin/setting/attribute/{id:\\d+}', 'PUT', NULL),
(89, 'admin_setting_attribute_id@delete', NULL, 'admin', '/admin/setting/attribute/{id:\\d+}', 'DELETE', NULL),
(90, 'admin_setting_blockchainnetwork_id@get', NULL, 'admin', '/admin/setting/blockchainNetwork/{id:\\d+}', 'GET', NULL),
(91, 'admin_setting_blockchainnetwork_list@get', NULL, 'admin', '/admin/setting/blockchainNetwork/list', 'GET', NULL),
(92, 'admin_setting_blockchainnetwork@get', NULL, 'admin', '/admin/setting/blockchainNetwork', 'GET', NULL),
(93, 'admin_setting_blockchainnetwork@post', NULL, 'admin', '/admin/setting/blockchainNetwork', 'POST', NULL),
(94, 'admin_setting_blockchainnetwork_id@put', NULL, 'admin', '/admin/setting/blockchainNetwork/{id:\\d+}', 'PUT', NULL),
(95, 'admin_setting_blockchainnetwork_id@delete', NULL, 'admin', '/admin/setting/blockchainNetwork/{id:\\d+}', 'DELETE', NULL),
(96, 'admin_setting_coin_id@get', NULL, 'admin', '/admin/setting/coin/{id:\\d+}', 'GET', NULL),
(97, 'admin_setting_coin_list@get', NULL, 'admin', '/admin/setting/coin/list', 'GET', NULL),
(98, 'admin_setting_coin@get', NULL, 'admin', '/admin/setting/coin', 'GET', NULL),
(99, 'admin_setting_coin@post', NULL, 'admin', '/admin/setting/coin', 'POST', NULL),
(100, 'admin_setting_coin_id@put', NULL, 'admin', '/admin/setting/coin/{id:\\d+}', 'PUT', NULL),
(101, 'admin_setting_coin_id@delete', NULL, 'admin', '/admin/setting/coin/{id:\\d+}', 'DELETE', NULL),
(102, 'admin_setting_deposit_id@get', NULL, 'admin', '/admin/setting/deposit/{id:\\d+}', 'GET', NULL),
(103, 'admin_setting_deposit_list@get', NULL, 'admin', '/admin/setting/deposit/list', 'GET', NULL),
(104, 'admin_setting_deposit@get', NULL, 'admin', '/admin/setting/deposit', 'GET', NULL),
(105, 'admin_setting_deposit@post', NULL, 'admin', '/admin/setting/deposit', 'POST', NULL),
(106, 'admin_setting_deposit_id@put', NULL, 'admin', '/admin/setting/deposit/{id:\\d+}', 'PUT', NULL),
(107, 'admin_setting_deposit_id@delete', NULL, 'admin', '/admin/setting/deposit/{id:\\d+}', 'DELETE', NULL),
(108, 'admin_setting_general_id@get', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'GET', NULL),
(109, 'admin_setting_general_list@get', NULL, 'admin', '/admin/setting/general/list', 'GET', NULL),
(110, 'admin_setting_general@get', NULL, 'admin', '/admin/setting/general', 'GET', NULL),
(111, 'admin_setting_general@post', NULL, 'admin', '/admin/setting/general', 'POST', NULL),
(112, 'admin_setting_general_id@put', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'PUT', NULL),
(113, 'admin_setting_general_id@delete', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'DELETE', NULL),
(114, 'admin_setting_level_id@get', NULL, 'admin', '/admin/setting/level/{id:\\d+}', 'GET', NULL),
(115, 'admin_setting_level_list@get', NULL, 'admin', '/admin/setting/level/list', 'GET', NULL),
(116, 'admin_setting_level@get', NULL, 'admin', '/admin/setting/level', 'GET', NULL),
(117, 'admin_setting_level@post', NULL, 'admin', '/admin/setting/level', 'POST', NULL),
(118, 'admin_setting_level_id@put', NULL, 'admin', '/admin/setting/level/{id:\\d+}', 'PUT', NULL),
(119, 'admin_setting_level_id@delete', NULL, 'admin', '/admin/setting/level/{id:\\d+}', 'DELETE', NULL),
(120, 'admin_setting_mission_id@get', NULL, 'admin', '/admin/setting/mission/{id:\\d+}', 'GET', NULL),
(121, 'admin_setting_mission_list@get', NULL, 'admin', '/admin/setting/mission/list', 'GET', NULL),
(122, 'admin_setting_mission@get', NULL, 'admin', '/admin/setting/mission', 'GET', NULL),
(123, 'admin_setting_mission@post', NULL, 'admin', '/admin/setting/mission', 'POST', NULL),
(124, 'admin_setting_mission_id@put', NULL, 'admin', '/admin/setting/mission/{id:\\d+}', 'PUT', NULL),
(125, 'admin_setting_mission_id@delete', NULL, 'admin', '/admin/setting/mission/{id:\\d+}', 'DELETE', NULL),
(126, 'admin_setting_nft_id@get', NULL, 'admin', '/admin/setting/nft/{id:\\d+}', 'GET', NULL),
(127, 'admin_setting_nft_list@get', NULL, 'admin', '/admin/setting/nft/list', 'GET', NULL),
(128, 'admin_setting_nft@get', NULL, 'admin', '/admin/setting/nft', 'GET', NULL),
(129, 'admin_setting_nft@post', NULL, 'admin', '/admin/setting/nft', 'POST', NULL),
(130, 'admin_setting_nft_id@put', NULL, 'admin', '/admin/setting/nft/{id:\\d+}', 'PUT', NULL),
(131, 'admin_setting_nft_id@delete', NULL, 'admin', '/admin/setting/nft/{id:\\d+}', 'DELETE', NULL),
(132, 'admin_setting_operator_id@get', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'GET', NULL),
(133, 'admin_setting_operator_list@get', NULL, 'admin', '/admin/setting/operator/list', 'GET', NULL),
(134, 'admin_setting_operator@get', NULL, 'admin', '/admin/setting/operator', 'GET', NULL),
(135, 'admin_setting_operator@post', NULL, 'admin', '/admin/setting/operator', 'POST', NULL),
(136, 'admin_setting_operator_id@put', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'PUT', NULL),
(137, 'admin_setting_operator_id@delete', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'DELETE', NULL),
(138, 'admin_setting_payment_id@get', NULL, 'admin', '/admin/setting/payment/{id:\\d+}', 'GET', NULL),
(139, 'admin_setting_payment_list@get', NULL, 'admin', '/admin/setting/payment/list', 'GET', NULL),
(140, 'admin_setting_payment@get', NULL, 'admin', '/admin/setting/payment', 'GET', NULL),
(141, 'admin_setting_payment@post', NULL, 'admin', '/admin/setting/payment', 'POST', NULL),
(142, 'admin_setting_payment_id@put', NULL, 'admin', '/admin/setting/payment/{id:\\d+}', 'PUT', NULL),
(143, 'admin_setting_payment_id@delete', NULL, 'admin', '/admin/setting/payment/{id:\\d+}', 'DELETE', NULL),
(144, 'admin_setting_wallet_id@get', NULL, 'admin', '/admin/setting/wallet/{id:\\d+}', 'GET', NULL),
(145, 'admin_setting_wallet_list@get', NULL, 'admin', '/admin/setting/wallet/list', 'GET', NULL),
(146, 'admin_setting_wallet@get', NULL, 'admin', '/admin/setting/wallet', 'GET', NULL),
(147, 'admin_setting_wallet@post', NULL, 'admin', '/admin/setting/wallet', 'POST', NULL),
(148, 'admin_setting_wallet_id@put', NULL, 'admin', '/admin/setting/wallet/{id:\\d+}', 'PUT', NULL),
(149, 'admin_setting_wallet_id@delete', NULL, 'admin', '/admin/setting/wallet/{id:\\d+}', 'DELETE', NULL),
(150, 'admin_setting_walletattribute_id@get', NULL, 'admin', '/admin/setting/walletAttribute/{id:\\d+}', 'GET', NULL),
(151, 'admin_setting_walletattribute_list@get', NULL, 'admin', '/admin/setting/walletAttribute/list', 'GET', NULL),
(152, 'admin_setting_walletattribute@get', NULL, 'admin', '/admin/setting/walletAttribute', 'GET', NULL),
(153, 'admin_setting_walletattribute@post', NULL, 'admin', '/admin/setting/walletAttribute', 'POST', NULL),
(154, 'admin_setting_walletattribute_id@put', NULL, 'admin', '/admin/setting/walletAttribute/{id:\\d+}', 'PUT', NULL),
(155, 'admin_setting_walletattribute_id@delete', NULL, 'admin', '/admin/setting/walletAttribute/{id:\\d+}', 'DELETE', NULL),
(156, 'admin_setting_withdraw_id@get', NULL, 'admin', '/admin/setting/withdraw/{id:\\d+}', 'GET', NULL),
(157, 'admin_setting_withdraw_list@get', NULL, 'admin', '/admin/setting/withdraw/list', 'GET', NULL),
(158, 'admin_setting_withdraw@get', NULL, 'admin', '/admin/setting/withdraw', 'GET', NULL),
(159, 'admin_setting_withdraw@post', NULL, 'admin', '/admin/setting/withdraw', 'POST', NULL),
(160, 'admin_setting_withdraw_id@put', NULL, 'admin', '/admin/setting/withdraw/{id:\\d+}', 'PUT', NULL),
(161, 'admin_setting_withdraw_id@delete', NULL, 'admin', '/admin/setting/withdraw/{id:\\d+}', 'DELETE', NULL),
(162, 'admin_stat_sponsor_id@get', NULL, 'admin', '/admin/stat/sponsor/{id:\\d+}', 'GET', NULL),
(163, 'admin_stat_sponsor_list@get', NULL, 'admin', '/admin/stat/sponsor/list', 'GET', NULL),
(164, 'admin_stat_sponsor@get', NULL, 'admin', '/admin/stat/sponsor', 'GET', NULL),
(165, 'admin_stat_sponsor@post', NULL, 'admin', '/admin/stat/sponsor', 'POST', NULL),
(166, 'admin_stat_sponsor_id@put', NULL, 'admin', '/admin/stat/sponsor/{id:\\d+}', 'PUT', NULL),
(167, 'admin_stat_sponsor_id@delete', NULL, 'admin', '/admin/stat/sponsor/{id:\\d+}', 'DELETE', NULL),
(168, 'admin_user_deposit_id@get', NULL, 'admin', '/admin/user/deposit/{id:\\d+}', 'GET', NULL),
(169, 'admin_user_deposit_list@get', NULL, 'admin', '/admin/user/deposit/list', 'GET', NULL),
(170, 'admin_user_deposit@get', NULL, 'admin', '/admin/user/deposit', 'GET', NULL),
(171, 'admin_user_deposit@post', NULL, 'admin', '/admin/user/deposit', 'POST', NULL),
(172, 'admin_user_deposit_id@put', NULL, 'admin', '/admin/user/deposit/{id:\\d+}', 'PUT', NULL),
(173, 'admin_user_deposit_id@delete', NULL, 'admin', '/admin/user/deposit/{id:\\d+}', 'DELETE', NULL),
(174, 'admin_user_group_id@get', NULL, 'admin', '/admin/user/group/{id:\\d+}', 'GET', NULL),
(175, 'admin_user_group_list@get', NULL, 'admin', '/admin/user/group/list', 'GET', NULL),
(176, 'admin_user_group@get', NULL, 'admin', '/admin/user/group', 'GET', NULL),
(177, 'admin_user_group@post', NULL, 'admin', '/admin/user/group', 'POST', NULL),
(178, 'admin_user_group_id@put', NULL, 'admin', '/admin/user/group/{id:\\d+}', 'PUT', NULL),
(179, 'admin_user_group_id@delete', NULL, 'admin', '/admin/user/group/{id:\\d+}', 'DELETE', NULL),
(180, 'admin_user_invitecode_id@get', NULL, 'admin', '/admin/user/inviteCode/{id:\\d+}', 'GET', NULL),
(181, 'admin_user_invitecode_list@get', NULL, 'admin', '/admin/user/inviteCode/list', 'GET', NULL),
(182, 'admin_user_invitecode@get', NULL, 'admin', '/admin/user/inviteCode', 'GET', NULL),
(183, 'admin_user_invitecode@post', NULL, 'admin', '/admin/user/inviteCode', 'POST', NULL),
(184, 'admin_user_invitecode_id@put', NULL, 'admin', '/admin/user/inviteCode/{id:\\d+}', 'PUT', NULL),
(185, 'admin_user_invitecode_id@delete', NULL, 'admin', '/admin/user/inviteCode/{id:\\d+}', 'DELETE', NULL),
(186, 'admin_user_character_id@get', NULL, 'admin', '/admin/user/character/{id:\\d+}', 'GET', NULL),
(187, 'admin_user_character_list@get', NULL, 'admin', '/admin/user/character/list', 'GET', NULL),
(188, 'admin_user_character@get', NULL, 'admin', '/admin/user/character', 'GET', NULL),
(189, 'admin_user_character@post', NULL, 'admin', '/admin/user/character', 'POST', NULL),
(190, 'admin_user_character_id@put', NULL, 'admin', '/admin/user/character/{id:\\d+}', 'PUT', NULL),
(191, 'admin_user_character_id@delete', NULL, 'admin', '/admin/user/character/{id:\\d+}', 'DELETE', NULL),
(192, 'admin_user_mission_id@get', NULL, 'admin', '/admin/user/mission/{id:\\d+}', 'GET', NULL),
(193, 'admin_user_mission_list@get', NULL, 'admin', '/admin/user/mission/list', 'GET', NULL),
(194, 'admin_user_mission@get', NULL, 'admin', '/admin/user/mission', 'GET', NULL),
(195, 'admin_user_mission@post', NULL, 'admin', '/admin/user/mission', 'POST', NULL),
(196, 'admin_user_mission_id@put', NULL, 'admin', '/admin/user/mission/{id:\\d+}', 'PUT', NULL),
(197, 'admin_user_mission_id@delete', NULL, 'admin', '/admin/user/mission/{id:\\d+}', 'DELETE', NULL),
(198, 'admin_user_nft_id@get', NULL, 'admin', '/admin/user/nft/{id:\\d+}', 'GET', NULL),
(199, 'admin_user_nft_list@get', NULL, 'admin', '/admin/user/nft/list', 'GET', NULL),
(200, 'admin_user_nft@get', NULL, 'admin', '/admin/user/nft', 'GET', NULL),
(201, 'admin_user_nft@post', NULL, 'admin', '/admin/user/nft', 'POST', NULL),
(202, 'admin_user_nft_id@put', NULL, 'admin', '/admin/user/nft/{id:\\d+}', 'PUT', NULL),
(203, 'admin_user_nft_id@delete', NULL, 'admin', '/admin/user/nft/{id:\\d+}', 'DELETE', NULL),
(204, 'admin_user_remark_id@get', NULL, 'admin', '/admin/user/remark/{id:\\d+}', 'GET', NULL),
(205, 'admin_user_remark_list@get', NULL, 'admin', '/admin/user/remark/list', 'GET', NULL),
(206, 'admin_user_remark@get', NULL, 'admin', '/admin/user/remark', 'GET', NULL),
(207, 'admin_user_remark@post', NULL, 'admin', '/admin/user/remark', 'POST', NULL),
(208, 'admin_user_remark_id@put', NULL, 'admin', '/admin/user/remark/{id:\\d+}', 'PUT', NULL),
(209, 'admin_user_remark_id@delete', NULL, 'admin', '/admin/user/remark/{id:\\d+}', 'DELETE', NULL),
(210, 'admin_user_withdraw_id@get', NULL, 'admin', '/admin/user/withdraw/{id:\\d+}', 'GET', NULL),
(211, 'admin_user_withdraw_list@get', NULL, 'admin', '/admin/user/withdraw/list', 'GET', NULL),
(212, 'admin_user_withdraw@get', NULL, 'admin', '/admin/user/withdraw', 'GET', NULL),
(213, 'admin_user_withdraw@post', NULL, 'admin', '/admin/user/withdraw', 'POST', NULL),
(214, 'admin_user_withdraw_id@put', NULL, 'admin', '/admin/user/withdraw/{id:\\d+}', 'PUT', NULL),
(215, 'admin_user_withdraw_id@delete', NULL, 'admin', '/admin/user/withdraw/{id:\\d+}', 'DELETE', NULL),
(216, 'admin_wallet_transaction_id@get', NULL, 'admin', '/admin/wallet/transaction/{id:\\d+}', 'GET', NULL),
(217, 'admin_wallet_transaction_list@get', NULL, 'admin', '/admin/wallet/transaction/list', 'GET', NULL),
(218, 'admin_wallet_transaction@get', NULL, 'admin', '/admin/wallet/transaction', 'GET', NULL),
(219, 'admin_wallet_transaction@post', NULL, 'admin', '/admin/wallet/transaction', 'POST', NULL),
(220, 'admin_wallet_transaction_id@put', NULL, 'admin', '/admin/wallet/transaction/{id:\\d+}', 'PUT', NULL),
(221, 'admin_wallet_transaction_id@delete', NULL, 'admin', '/admin/wallet/transaction/{id:\\d+}', 'DELETE', NULL),
(222, 'admin_wallet_transactiondetail_id@get', NULL, 'admin', '/admin/wallet/transactionDetail/{id:\\d+}', 'GET', NULL),
(223, 'admin_wallet_transactiondetail_list@get', NULL, 'admin', '/admin/wallet/transactionDetail/list', 'GET', NULL),
(224, 'admin_wallet_transactiondetail@get', NULL, 'admin', '/admin/wallet/transactionDetail', 'GET', NULL),
(225, 'admin_wallet_transactiondetail@post', NULL, 'admin', '/admin/wallet/transactionDetail', 'POST', NULL),
(226, 'admin_wallet_transactiondetail_id@put', NULL, 'admin', '/admin/wallet/transactionDetail/{id:\\d+}', 'PUT', NULL),
(227, 'admin_wallet_transactiondetail_id@delete', NULL, 'admin', '/admin/wallet/transactionDetail/{id:\\d+}', 'DELETE', NULL),
(228, 'global_redisflush@post', NULL, 'admin', '/global/redisFlush', 'POST', NULL),
(229, 'global_redis@post', NULL, 'admin', '/global/redis', 'POST', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_reward_record`
--

CREATE TABLE `sw_reward_record` (
  `id` bigint NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `pay_at` datetime DEFAULT NULL,
  `used_at` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `from_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `reward_type` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_operator',
  `amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `distribution` text COLLATE utf8mb4_general_ci,
  `ref_table` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_id` int NOT NULL DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_airdrop`
--

CREATE TABLE `sw_setting_airdrop` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `title` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_group_id` int NOT NULL DEFAULT '0',
  `total_amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `wallet_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_wallet',
  `current_claim_limit` int NOT NULL DEFAULT '0',
  `total_claim_limit` int NOT NULL DEFAULT '0',
  `level_required` int NOT NULL DEFAULT '0',
  `claim_cost` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `admin_id` int NOT NULL DEFAULT '0' COMMENT 'refer to account_admin',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_attribute`
--

CREATE TABLE `sw_setting_attribute` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filter` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_attribute`
--

INSERT INTO `sw_setting_attribute` (`id`, `deleted_at`, `code`, `category`, `filter`, `remark`) VALUES
(1, NULL, 'fee_wallet_id', 'wallet', 'wallet', NULL),
(2, NULL, 'to_self', 'action', 'wallet', NULL),
(3, NULL, 'to_other', 'action', 'wallet', NULL),
(4, NULL, 'to_self_fee', 'fee', 'wallet', NULL),
(5, NULL, 'to_other_fee', 'fee', 'wallet', NULL),
(6, NULL, 'to_self_rate', 'rate', 'wallet', NULL),
(7, NULL, 'to_other_rate', 'rate', 'wallet', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_blockchain_network`
--

CREATE TABLE `sw_setting_blockchain_network` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chain_id` int NOT NULL DEFAULT '0',
  `rpc_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_blockchain_network`
--

INSERT INTO `sw_setting_blockchain_network` (`id`, `deleted_at`, `code`, `type`, `chain_id`, `rpc_url`, `api_key`, `remark`) VALUES
(1, NULL, 'ton_mainnet', 'ton', 0, 'https://toncenter.com/api/v2', 'rlzBxsnF/+NiPmql0fwa9Dr2iYzEtRjiqrGc5n4u9gMLGbohAPAR3gtrrI1DpIGo8ic2otD6ByaIHz+WBQv7yf4nTVYHihoLI8dJPFZ90M8=', NULL),
(2, NULL, 'ton_testnet', 'ton', 0, 'https://testnet.toncenter.com/api/v2', 'j7cHGiIPUpk2rbrK89WyTugsLnI76rv3Gj6eLY0MWZOQBJFwcbTD2JJm/D8TnU63ixbe0aOBoRxcEXulO8n462fBoAWONAcrHg8I8gAkfIM=', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_coin`
--

CREATE TABLE `sw_setting_coin` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wallet_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_wallet',
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_coin`
--

INSERT INTO `sw_setting_coin` (`id`, `deleted_at`, `code`, `wallet_id`, `is_show`, `remark`) VALUES
(1, NULL, 'tendo', 4, 1, NULL),
(2, NULL, 'usdt', 5, 1, NULL),
(3, NULL, 'ton', 6, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_deposit`
--

CREATE TABLE `sw_setting_deposit` (
  `id` int NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `coin_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_coin',
  `token_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'contract address',
  `network` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_blockchain_network',
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `latest_block` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sw_setting_deposit`
--

INSERT INTO `sw_setting_deposit` (`id`, `sn`, `created_at`, `updated_at`, `deleted_at`, `coin_id`, `token_address`, `network`, `address`, `is_active`, `latest_block`, `remark`) VALUES
(1, 'PYKL0GJG6Y9L2HU8', '2024-05-07 19:48:55', '2024-05-07 19:48:55', NULL, 2, 'kQArPYNYOkdKWcJgsZ8MVL6E-sNY4gOCyW0XluIVITCPguRn', 2, 'EQCOA1amhd-Ol1m1pO0-axeX2U42FMamT-CNeXZmOgj3Aor-', 1, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_general`
--

CREATE TABLE `sw_setting_general` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `value` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_general`
--

INSERT INTO `sw_setting_general` (`id`, `deleted_at`, `category`, `code`, `value`, `is_show`, `remark`) VALUES
(1, NULL, 'log_reader', 'allow_access', '1', 1, NULL),
(2, NULL, 'maintenance', 'stop_dapp', '0', 1, NULL),
(3, NULL, 'maintenance', 'stop_admin', '0', 1, NULL),
(4, NULL, 'maintenance', 'stop_login', '0', 1, NULL),
(5, NULL, 'maintenance', 'stop_register', '0', 1, NULL),
(6, NULL, 'maintenance', 'stop_transfer', '0', 1, NULL),
(7, NULL, 'maintenance', 'stop_swap', '0', 1, NULL),
(8, NULL, 'maintenance', 'stop_deposit', '0', 1, NULL),
(9, NULL, 'maintenance', 'stop_withdraw', '0', 1, NULL),
(10, NULL, 'maintenance', 'stop_mission', '0', 1, NULL),
(11, NULL, 'maintenance', 'stop_character', '0', 1, NULL),
(12, NULL, 'maintenance', 'stop_airdrop', '0', 1, NULL),
(13, NULL, 'maintenance', 'stop_event', '0', 1, NULL),
(14, NULL, 'by_pass', 'api', '0', 1, NULL),
(15, NULL, 'deposit', 'deposit_min', '0.01', 1, NULL),
(16, NULL, 'deposit', 'deposit_max', '0', 1, NULL),
(17, NULL, 'withdraw', 'withdraw_min', '10', 1, NULL),
(18, NULL, 'withdraw', 'withdraw_max', '0', 1, NULL),
(19, NULL, 'withdraw', 'withdraw_fee_wallet', '1', 1, NULL),
(20, NULL, 'withdraw', 'withdraw_fee', '1', 1, NULL),
(21, NULL, 'withdraw', 'withdraw_gasprice_multiplier', '1', 1, NULL),
(22, NULL, 'telegram', 'bot_name', 'TendopiaBot', 1, NULL),
(23, NULL, 'telegram', 'bot_domain', 'https://stagcore.tendopia.com', 1, NULL),
(24, NULL, 'telegram', 'official_group', 'https://t.me/+fQkaeD8kdXI3ODc1', 1, NULL),
(25, NULL, 'website', 'dapp_website', 'https://stagdapp.tendopia.com', 1, NULL),
(26, NULL, 'website', 'official_website', 'https://stagportal.tendopia.com', 1, NULL),
(27, NULL, 'game', 'image', 'https://i.ibb.co/z7rgTSJ/image-2024-05-16-16-33-44.png', 1, NULL),
(28, NULL, 'mining_reward', 'upline_percent', '10', 1, NULL),
(29, NULL, 'social_reward', 'social_point', '0.15', 1, NULL),
(30, NULL, 'social_reward', 'social_point_wallet', '2', 1, NULL),
(31, NULL, 'social_reward', 'premium_multiplier', '10', 1, NULL),
(32, NULL, 'airdrop', 'token_wallet', '5,6', 1, NULL),
(33, NULL, 'airdrop', 'package_usdt', '1000-100,1500-150,2000-200', 1, NULL),
(34, NULL, 'airdrop', 'package_ton', '1000-15,1500-20,2000-25', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_level`
--

CREATE TABLE `sw_setting_level` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `level` int NOT NULL DEFAULT '0',
  `exp` int NOT NULL DEFAULT '0',
  `mining_rate` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_level`
--

INSERT INTO `sw_setting_level` (`id`, `deleted_at`, `level`, `exp`, `mining_rate`, `remark`) VALUES
(1, NULL, 1, 0, 0.0100000, NULL),
(2, NULL, 2, 400, 0.0300000, NULL),
(3, NULL, 3, 800, 0.0500000, NULL),
(4, NULL, 4, 1600, 0.0700000, NULL),
(5, NULL, 5, 3200, 0.0900000, NULL),
(6, NULL, 6, 6400, 0.1100000, NULL),
(7, NULL, 7, 12800, 0.1300000, NULL),
(8, NULL, 8, 25600, 0.1500000, NULL),
(9, NULL, 9, 51200, 0.1700000, NULL),
(10, NULL, 10, 102400, 0.1900000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_mission`
--

CREATE TABLE `sw_setting_mission` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `level` int NOT NULL DEFAULT '0',
  `currency_reward` text COLLATE utf8mb4_general_ci,
  `requirement` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `action` enum('internal','external','bot') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'internal',
  `type` enum('social','daily','weekly','permanent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'permanent',
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_mission`
--

INSERT INTO `sw_setting_mission` (`id`, `deleted_at`, `name`, `description`, `level`, `currency_reward`, `requirement`, `action`, `type`, `is_show`, `remark`) VALUES
(1, NULL, 'daily refer users', NULL, 1, '{\"1\":\"100\"}', '5', 'internal', 'daily', 1, NULL),
(2, NULL, 'chat in tendopia group I', NULL, 1, '{\"1\":\"30\"}', '5', 'bot', 'social', 1, NULL),
(3, NULL, 'chat in tendopia group with keyword tendopia I', NULL, 1, '{\"1\":\"30\"}', '5', 'bot', 'social', 1, NULL),
(4, NULL, 'watch this ads I', NULL, 1, '{\"1\":\"30\"}', 'https://youtu.be/f-1_1ZCQjsM', 'external', 'daily', 1, NULL),
(5, NULL, 'chat in tendopia group II', NULL, 5, '{\"1\":\"60\"}', '10', 'bot', 'social', 1, NULL),
(6, NULL, 'chat in tendopia group with keyword tendopia II', NULL, 5, '{\"1\":\"60\"}', '10', 'bot', 'social', 1, NULL),
(7, NULL, 'watch this ads II', NULL, 5, '{\"1\":\"60\"}', 'https://youtu.be/f-1_1ZCQjsM', 'external', 'daily', 1, NULL),
(8, NULL, 'chat in tendopia group III', NULL, 10, '{\"1\":\"120\"}', '15', 'bot', 'social', 1, NULL),
(9, NULL, 'chat in tendopia group with keyword tendopia III', NULL, 10, '{\"1\":\"120\"}', '15', 'bot', 'social', 1, NULL),
(10, NULL, 'watch this ads III', NULL, 10, '{\"1\":\"120\"}', 'https://youtu.be/f-1_1ZCQjsM', 'external', 'daily', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_nft`
--

CREATE TABLE `sw_setting_nft` (
  `id` int NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'contract address',
  `network` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_blockchain_network',
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `private_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `latest_block` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_operator`
--

CREATE TABLE `sw_setting_operator` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_operator`
--

INSERT INTO `sw_setting_operator` (`id`, `deleted_at`, `category`, `code`, `remark`) VALUES
(1, NULL, 'status', 'pending', NULL),
(2, NULL, 'status', 'processing', NULL),
(3, NULL, 'status', 'success', NULL),
(4, NULL, 'status', 'failed', NULL),
(5, NULL, 'status', 'accepted', NULL),
(6, NULL, 'status', 'rejected', NULL),
(7, NULL, 'status', 'collected', NULL),
(8, NULL, 'status', 'claimed', NULL),
(9, NULL, 'status', 'completed', NULL),
(10, NULL, 'status', 'expired', NULL),
(11, NULL, 'type', 'admin_top_up', NULL),
(12, NULL, 'type', 'admin_deduct', NULL),
(13, NULL, 'type', 'top_up', NULL),
(14, NULL, 'type', 'deduct', NULL),
(15, NULL, 'type', 'redeem', NULL),
(16, NULL, 'type', 'withdraw', NULL),
(17, NULL, 'type', 'withdraw_fee', NULL),
(18, NULL, 'type', 'withdraw_refund', NULL),
(19, NULL, 'type', 'withdraw_refund_fee', NULL),
(20, NULL, 'type', 'transfer_out', NULL),
(21, NULL, 'type', 'transfer_in', NULL),
(22, NULL, 'type', 'transfer_fee', NULL),
(23, NULL, 'type', 'swap_from', NULL),
(24, NULL, 'type', 'swap_to', NULL),
(25, NULL, 'type', 'swap_fee', NULL),
(26, NULL, 'type', 'purchase', NULL),
(27, NULL, 'type', 'level_up', NULL),
(28, NULL, 'type', 'social_point', NULL),
(29, NULL, 'type', 'airdrop', NULL),
(30, NULL, 'type', 'airdrop_claim_cost', NULL),
(31, NULL, 'type', 'create_personal_airdrop', NULL),
(32, NULL, 'type', 'create_group_airdrop', NULL),
(33, NULL, 'reward', 'mining_reward', NULL),
(34, NULL, 'reward', 'mission_reward', NULL),
(35, NULL, 'reward', 'event_reward', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_payment`
--

CREATE TABLE `sw_setting_payment` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `formula` text COLLATE utf8mb4_general_ci,
  `calc_formula` text COLLATE utf8mb4_general_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_payment`
--

INSERT INTO `sw_setting_payment` (`id`, `deleted_at`, `code`, `formula`, `calc_formula`, `is_active`, `remark`) VALUES
(1, NULL, 'tsa', '{\"2\":\"1\"}', '{\"2\":\"min\"}', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_wallet`
--

CREATE TABLE `sw_setting_wallet` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_wallet`
--

INSERT INTO `sw_setting_wallet` (`id`, `deleted_at`, `image`, `code`, `is_show`, `remark`) VALUES
(1, NULL, '/img/wallet/exp.png', 'exp', 1, NULL),
(2, NULL, '/img/wallet/tsa.png', 'tsa', 1, NULL),
(3, NULL, '/img/wallet/star.png', 'star', 1, NULL),
(4, NULL, '/img/wallet/tendo.png', 'tendo', 1, NULL),
(5, NULL, '/img/wallet/usdt.png', 'usdt', 1, NULL),
(6, NULL, '/img/wallet/ton.png', 'ton', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_wallet_attribute`
--

CREATE TABLE `sw_setting_wallet_attribute` (
  `id` int NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `from_wallet_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_wallet',
  `to_wallet_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_wallet',
  `attribute_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_attribute',
  `value` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_withdraw`
--

CREATE TABLE `sw_setting_withdraw` (
  `id` int NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `coin_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_coin',
  `token_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'contract address',
  `network` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_blockchain_network',
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `private_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sw_stat_sponsor`
--

CREATE TABLE `sw_stat_sponsor` (
  `id` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `from_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `stat_type` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `is_personal` tinyint(1) NOT NULL DEFAULT '0',
  `is_cumulative` tinyint(1) NOT NULL DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_character`
--

CREATE TABLE `sw_user_character` (
  `id` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `mining_cutoff_at` datetime DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `level` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_level',
  `mining_reserve` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_user_character`
--

INSERT INTO `sw_user_character` (`id`, `created_at`, `updated_at`, `deleted_at`, `mining_cutoff_at`, `uid`, `level`, `mining_reserve`, `remark`) VALUES
(1, '2024-05-10 21:45:29', '2024-05-10 21:45:29', NULL, '2024-05-10 21:45:29', 1, 1, 0.00000000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_deposit`
--

CREATE TABLE `sw_user_deposit` (
  `id` bigint NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `final_amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `status` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_operator',
  `coin_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_coin',
  `txid` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `log_index` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `from_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `to_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `network` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_blockchain_network',
  `token_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_group`
--

CREATE TABLE `sw_user_group` (
  `id` bigint NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `group_id` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_invite_code`
--

CREATE TABLE `sw_user_invite_code` (
  `id` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `code` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_user_invite_code`
--

INSERT INTO `sw_user_invite_code` (`id`, `created_at`, `updated_at`, `deleted_at`, `uid`, `code`, `remark`) VALUES
(1, '2024-05-10 21:45:29', '2024-05-10 21:45:29', NULL, 1, '92DOBL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_mission`
--

CREATE TABLE `sw_user_mission` (
  `id` bigint NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `mission_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_mission',
  `status` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_operator',
  `progress` int NOT NULL DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_nft`
--

CREATE TABLE `sw_user_nft` (
  `id` bigint NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `status` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_operator',
  `txid` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `log_index` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `from_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `to_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `network` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_blockchain_network',
  `token_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_table` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_id` int NOT NULL DEFAULT '0',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_remark`
--

CREATE TABLE `sw_user_remark` (
  `id` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `admin_id` int NOT NULL DEFAULT '0' COMMENT 'refer to account_admin',
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_withdraw`
--

CREATE TABLE `sw_user_withdraw` (
  `id` bigint NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `fee` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `distribution` text COLLATE utf8mb4_general_ci,
  `status` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_operator',
  `amount_wallet_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_wallet',
  `fee_wallet_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_wallet',
  `to_coin_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_coin',
  `txid` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `log_index` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `from_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `to_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `network` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_blockchain_network',
  `token_address` varchar(66) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_wallet_transaction`
--

CREATE TABLE `sw_wallet_transaction` (
  `id` bigint NOT NULL,
  `sn` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_type` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_operator',
  `uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `from_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `to_uid` int NOT NULL DEFAULT '0' COMMENT 'refer to account_user',
  `amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `distribution` text COLLATE utf8mb4_general_ci,
  `ref_table` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_id` text COLLATE utf8mb4_general_ci,
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_wallet_transaction_detail`
--

CREATE TABLE `sw_wallet_transaction_detail` (
  `id` bigint NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `wallet_transaction_id` int NOT NULL DEFAULT '0' COMMENT 'refer to wallet_transaction',
  `wallet_id` int NOT NULL DEFAULT '0' COMMENT 'refer to setting_wallet',
  `amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `before_amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `after_amount` decimal(30,8) NOT NULL DEFAULT '0.00000000',
  `remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sw_account_admin`
--
ALTER TABLE `sw_account_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD KEY `web3_address` (`web3_address`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `sw_account_user`
--
ALTER TABLE `sw_account_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `web3_address` (`web3_address`),
  ADD KEY `status` (`status`),
  ADD KEY `membership` (`membership`),
  ADD KEY `telegram` (`telegram`);

--
-- Indexes for table `sw_admin_permission`
--
ALTER TABLE `sw_admin_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_uid` (`admin_uid`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `sw_log_admin`
--
ALTER TABLE `sw_log_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`admin_uid`),
  ADD KEY `by_uid` (`by_admin_uid`);

--
-- Indexes for table `sw_log_cronjob`
--
ALTER TABLE `sw_log_cronjob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_log_user`
--
ALTER TABLE `sw_log_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `by_uid` (`by_uid`);

--
-- Indexes for table `sw_network_sponsor`
--
ALTER TABLE `sw_network_sponsor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `upline_uid` (`upline_uid`);

--
-- Indexes for table `sw_permission_template`
--
ALTER TABLE `sw_permission_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_code` (`template_code`);

--
-- Indexes for table `sw_permission_warehouse`
--
ALTER TABLE `sw_permission_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_reward_record`
--
ALTER TABLE `sw_reward_record`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `bonus_type` (`reward_type`),
  ADD KEY `uid` (`uid`),
  ADD KEY `from_uid` (`from_uid`);

--
-- Indexes for table `sw_setting_airdrop`
--
ALTER TABLE `sw_setting_airdrop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `sw_setting_attribute`
--
ALTER TABLE `sw_setting_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `category` (`category`),
  ADD KEY `filter` (`filter`);

--
-- Indexes for table `sw_setting_blockchain_network`
--
ALTER TABLE `sw_setting_blockchain_network`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `sw_setting_coin`
--
ALTER TABLE `sw_setting_coin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `wallet_id` (`wallet_id`),
  ADD KEY `is_show` (`is_show`);

--
-- Indexes for table `sw_setting_deposit`
--
ALTER TABLE `sw_setting_deposit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `coin_id` (`coin_id`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `sw_setting_general`
--
ALTER TABLE `sw_setting_general`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `code` (`code`),
  ADD KEY `is_show` (`is_show`);

--
-- Indexes for table `sw_setting_level`
--
ALTER TABLE `sw_setting_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `sw_setting_mission`
--
ALTER TABLE `sw_setting_mission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `is_show` (`is_show`);

--
-- Indexes for table `sw_setting_nft`
--
ALTER TABLE `sw_setting_nft`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `name` (`name`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `sw_setting_operator`
--
ALTER TABLE `sw_setting_operator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `sw_setting_payment`
--
ALTER TABLE `sw_setting_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `sw_setting_wallet`
--
ALTER TABLE `sw_setting_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `is_show` (`is_show`);

--
-- Indexes for table `sw_setting_wallet_attribute`
--
ALTER TABLE `sw_setting_wallet_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_wallet_id` (`from_wallet_id`),
  ADD KEY `to_wallet_id` (`to_wallet_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `sw_setting_withdraw`
--
ALTER TABLE `sw_setting_withdraw`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `coin_id` (`coin_id`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `sw_stat_sponsor`
--
ALTER TABLE `sw_stat_sponsor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `used_at` (`used_at`),
  ADD KEY `uid` (`uid`),
  ADD KEY `from_uid` (`from_uid`),
  ADD KEY `stat_type` (`stat_type`),
  ADD KEY `is_personal` (`is_personal`),
  ADD KEY `is_cumulative` (`is_cumulative`);

--
-- Indexes for table `sw_user_character`
--
ALTER TABLE `sw_user_character`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `sw_user_deposit`
--
ALTER TABLE `sw_user_deposit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `sw_user_group`
--
ALTER TABLE `sw_user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `sw_user_invite_code`
--
ALTER TABLE `sw_user_invite_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `sw_user_mission`
--
ALTER TABLE `sw_user_mission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`),
  ADD KEY `mission_id` (`mission_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `sw_user_nft`
--
ALTER TABLE `sw_user_nft`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `sw_user_remark`
--
ALTER TABLE `sw_user_remark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sw_user_withdraw`
--
ALTER TABLE `sw_user_withdraw`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `sw_wallet_transaction`
--
ALTER TABLE `sw_wallet_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`),
  ADD KEY `from_uid` (`from_uid`),
  ADD KEY `to_uid` (`to_uid`),
  ADD KEY `transaction_type` (`transaction_type`);

--
-- Indexes for table `sw_wallet_transaction_detail`
--
ALTER TABLE `sw_wallet_transaction_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transaction_id` (`wallet_transaction_id`),
  ADD KEY `wallet_id` (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sw_account_admin`
--
ALTER TABLE `sw_account_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sw_account_user`
--
ALTER TABLE `sw_account_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_admin_permission`
--
ALTER TABLE `sw_admin_permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sw_log_admin`
--
ALTER TABLE `sw_log_admin`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_log_cronjob`
--
ALTER TABLE `sw_log_cronjob`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_log_user`
--
ALTER TABLE `sw_log_user`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_network_sponsor`
--
ALTER TABLE `sw_network_sponsor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_permission_template`
--
ALTER TABLE `sw_permission_template`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_permission_warehouse`
--
ALTER TABLE `sw_permission_warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `sw_reward_record`
--
ALTER TABLE `sw_reward_record`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_airdrop`
--
ALTER TABLE `sw_setting_airdrop`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_attribute`
--
ALTER TABLE `sw_setting_attribute`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sw_setting_blockchain_network`
--
ALTER TABLE `sw_setting_blockchain_network`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sw_setting_coin`
--
ALTER TABLE `sw_setting_coin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sw_setting_deposit`
--
ALTER TABLE `sw_setting_deposit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_setting_general`
--
ALTER TABLE `sw_setting_general`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_level`
--
ALTER TABLE `sw_setting_level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sw_setting_mission`
--
ALTER TABLE `sw_setting_mission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sw_setting_nft`
--
ALTER TABLE `sw_setting_nft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_operator`
--
ALTER TABLE `sw_setting_operator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sw_setting_payment`
--
ALTER TABLE `sw_setting_payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sw_setting_wallet`
--
ALTER TABLE `sw_setting_wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sw_setting_wallet_attribute`
--
ALTER TABLE `sw_setting_wallet_attribute`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_withdraw`
--
ALTER TABLE `sw_setting_withdraw`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_stat_sponsor`
--
ALTER TABLE `sw_stat_sponsor`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_character`
--
ALTER TABLE `sw_user_character`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_user_deposit`
--
ALTER TABLE `sw_user_deposit`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_group`
--
ALTER TABLE `sw_user_group`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_invite_code`
--
ALTER TABLE `sw_user_invite_code`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_user_mission`
--
ALTER TABLE `sw_user_mission`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_nft`
--
ALTER TABLE `sw_user_nft`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_remark`
--
ALTER TABLE `sw_user_remark`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_withdraw`
--
ALTER TABLE `sw_user_withdraw`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_wallet_transaction`
--
ALTER TABLE `sw_wallet_transaction`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_wallet_transaction_detail`
--
ALTER TABLE `sw_wallet_transaction_detail`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
