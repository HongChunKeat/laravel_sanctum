-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2024 at 12:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `sw_account_admin`
--

CREATE TABLE `sw_account_admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `web3_address` varchar(255) DEFAULT NULL,
  `nickname` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `authenticator` varchar(64) DEFAULT NULL,
  `status` enum('active','inactivated','freezed','suspended') NOT NULL DEFAULT 'active',
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_account_admin`
--

INSERT INTO `sw_account_admin` (`id`, `admin_id`, `created_at`, `updated_at`, `deleted_at`, `web3_address`, `nickname`, `password`, `tag`, `email`, `authenticator`, `status`, `remark`) VALUES
(1, 'E9QMJCW7K23A5QT1', '2024-01-09 14:51:17', '2024-04-04 19:30:04', NULL, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', 'eric', NULL, NULL, NULL, 'web3_address', 'active', NULL),
(2, 'E9QMJCW7K23A5QT5', '2024-01-10 13:13:17', '2024-01-10 13:13:17', NULL, '0xDe600b6b32aba9c01c86580F5b1Cfd90B6d91166', 'david', NULL, NULL, NULL, NULL, 'active', NULL),
(3, 'O14XIXHVHYOJHXMO', '2024-01-23 16:53:42', '2024-01-23 16:53:42', NULL, '0x0e1497245518320e8F089Eb648c8533DB636C696', 'zk', NULL, NULL, NULL, NULL, 'active', NULL),
(4, 'T0OXJT7AXEFB86VE', '2024-01-24 19:03:56', '2024-01-24 19:03:56', NULL, '0xbB27805a57642671315587b1CbDE22683A169276', 'clement', NULL, NULL, NULL, NULL, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_account_user`
--

CREATE TABLE `sw_account_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `web3_address` varchar(255) DEFAULT NULL,
  `nickname` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `authenticator` varchar(64) DEFAULT NULL,
  `status` enum('active','inactivated','freezed','suspended') NOT NULL DEFAULT 'active',
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_account_user`
--

INSERT INTO `sw_account_user` (`id`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `web3_address`, `nickname`, `password`, `tag`, `authenticator`, `status`, `remark`) VALUES
(1, 'VNMMIV5OSJ6AYLMV', '2024-04-19 11:18:53', '2024-04-19 11:18:53', NULL, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', NULL, NULL, NULL, NULL, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_admin_permission`
--

CREATE TABLE `sw_admin_permission` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `admin_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_admin',
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_admin_permission`
--

INSERT INTO `sw_admin_permission` (`id`, `created_at`, `updated_at`, `deleted_at`, `admin_uid`, `role`) VALUES
(1, '2023-11-24 17:39:06', '2023-11-24 17:39:09', NULL, 1, 1),
(2, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 2, 1),
(3, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 3, 1),
(4, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_admin`
--

CREATE TABLE `sw_log_admin` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) DEFAULT NULL,
  `admin_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_admin',
  `by_admin_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_admin',
  `ip` varchar(255) DEFAULT NULL,
  `ref_table` varchar(64) DEFAULT NULL,
  `ref_id` int(11) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_cronjob`
--

CREATE TABLE `sw_log_cronjob` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `used_at` varchar(50) DEFAULT NULL,
  `cronjob_code` varchar(128) DEFAULT NULL,
  `info` text DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_user`
--

CREATE TABLE `sw_log_user` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `by_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `ip` varchar(255) DEFAULT NULL,
  `ref_table` varchar(64) DEFAULT NULL,
  `ref_id` int(11) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_network_sponsor`
--

CREATE TABLE `sw_network_sponsor` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `upline_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_network_sponsor`
--

INSERT INTO `sw_network_sponsor` (`id`, `created_at`, `updated_at`, `deleted_at`, `uid`, `upline_uid`, `remark`) VALUES
(1, '2024-03-27 13:16:06', '2024-03-27 13:16:06', NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_permission_template`
--

CREATE TABLE `sw_permission_template` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `template_code` varchar(64) DEFAULT NULL,
  `rule` text DEFAULT NULL,
  `remark` text DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `code` varchar(128) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `from_site` varchar(128) DEFAULT 'common',
  `path` varchar(255) DEFAULT NULL,
  `action` varchar(128) DEFAULT NULL,
  `remark` text DEFAULT NULL
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
(30, 'admin_log_cronjob_id@get', NULL, 'admin', '/admin/log/cronjob/{id:\\d+}', 'GET', NULL),
(31, 'admin_log_cronjob_list@get', NULL, 'admin', '/admin/log/cronjob/list', 'GET', NULL),
(32, 'admin_log_cronjob@get', NULL, 'admin', '/admin/log/cronjob', 'GET', NULL),
(33, 'admin_log_cronjob@post', NULL, 'admin', '/admin/log/cronjob', 'POST', NULL),
(34, 'admin_log_cronjob_id@put', NULL, 'admin', '/admin/log/cronjob/{id:\\d+}', 'PUT', NULL),
(35, 'admin_log_cronjob_id@delete', NULL, 'admin', '/admin/log/cronjob/{id:\\d+}', 'DELETE', NULL),
(36, 'admin_log_user_id@get', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'GET', NULL),
(37, 'admin_log_user_list@get', NULL, 'admin', '/admin/log/user/list', 'GET', NULL),
(38, 'admin_log_user@get', NULL, 'admin', '/admin/log/user', 'GET', NULL),
(39, 'admin_log_user@post', NULL, 'admin', '/admin/log/user', 'POST', NULL),
(40, 'admin_log_user_id@put', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'PUT', NULL),
(41, 'admin_log_user_id@delete', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'DELETE', NULL),
(42, 'admin_network_sponsor_id@get', NULL, 'admin', '/admin/network/sponsor/{id:\\d+}', 'GET', NULL),
(43, 'admin_network_sponsor_list@get', NULL, 'admin', '/admin/network/sponsor/list', 'GET', NULL),
(44, 'admin_network_sponsor@get', NULL, 'admin', '/admin/network/sponsor', 'GET', NULL),
(45, 'admin_network_sponsor@post', NULL, 'admin', '/admin/network/sponsor', 'POST', NULL),
(46, 'admin_network_sponsor_id@put', NULL, 'admin', '/admin/network/sponsor/{id:\\d+}', 'PUT', NULL),
(47, 'admin_network_sponsor_id@delete', NULL, 'admin', '/admin/network/sponsor/{id:\\d+}', 'DELETE', NULL),
(48, 'admin_permission_admin_id@get', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'GET', NULL),
(49, 'admin_permission_admin_list@get', NULL, 'admin', '/admin/permission/admin/list', 'GET', NULL),
(50, 'admin_permission_admin@get', NULL, 'admin', '/admin/permission/admin', 'GET', NULL),
(51, 'admin_permission_admin@post', NULL, 'admin', '/admin/permission/admin', 'POST', NULL),
(52, 'admin_permission_admin_id@put', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'PUT', NULL),
(53, 'admin_permission_admin_id@delete', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'DELETE', NULL),
(54, 'admin_permission_template_id@get', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'GET', NULL),
(55, 'admin_permission_template_list@get', NULL, 'admin', '/admin/permission/template/list', 'GET', NULL),
(56, 'admin_permission_template@get', NULL, 'admin', '/admin/permission/template', 'GET', NULL),
(57, 'admin_permission_template@post', NULL, 'admin', '/admin/permission/template', 'POST', NULL),
(58, 'admin_permission_template_id@put', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'PUT', NULL),
(59, 'admin_permission_template_id@delete', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'DELETE', NULL),
(60, 'admin_permission_warehouse_id@get', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'GET', NULL),
(61, 'admin_permission_warehouse_list@get', NULL, 'admin', '/admin/permission/warehouse/list', 'GET', NULL),
(62, 'admin_permission_warehouse@get', NULL, 'admin', '/admin/permission/warehouse', 'GET', NULL),
(63, 'admin_permission_warehouse@post', NULL, 'admin', '/admin/permission/warehouse', 'POST', NULL),
(64, 'admin_permission_warehouse_id@put', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'PUT', NULL),
(65, 'admin_permission_warehouse_id@delete', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'DELETE', NULL),
(66, 'admin_reward_record_id@get', NULL, 'admin', '/admin/reward/record/{id:\\d+}', 'GET', NULL),
(67, 'admin_reward_record_list@get', NULL, 'admin', '/admin/reward/record/list', 'GET', NULL),
(68, 'admin_reward_record@get', NULL, 'admin', '/admin/reward/record', 'GET', NULL),
(69, 'admin_reward_record@post', NULL, 'admin', '/admin/reward/record', 'POST', NULL),
(70, 'admin_reward_record_id@put', NULL, 'admin', '/admin/reward/record/{id:\\d+}', 'PUT', NULL),
(71, 'admin_reward_record_id@delete', NULL, 'admin', '/admin/reward/record/{id:\\d+}', 'DELETE', NULL),
(72, 'admin_setting_attribute_id@get', NULL, 'admin', '/admin/setting/attribute/{id:\\d+}', 'GET', NULL),
(73, 'admin_setting_attribute_list@get', NULL, 'admin', '/admin/setting/attribute/list', 'GET', NULL),
(74, 'admin_setting_attribute@get', NULL, 'admin', '/admin/setting/attribute', 'GET', NULL),
(75, 'admin_setting_attribute@post', NULL, 'admin', '/admin/setting/attribute', 'POST', NULL),
(76, 'admin_setting_attribute_id@put', NULL, 'admin', '/admin/setting/attribute/{id:\\d+}', 'PUT', NULL),
(77, 'admin_setting_attribute_id@delete', NULL, 'admin', '/admin/setting/attribute/{id:\\d+}', 'DELETE', NULL),
(78, 'admin_setting_blockchainnetwork_id@get', NULL, 'admin', '/admin/setting/blockchainNetwork/{id:\\d+}', 'GET', NULL),
(79, 'admin_setting_blockchainnetwork_list@get', NULL, 'admin', '/admin/setting/blockchainNetwork/list', 'GET', NULL),
(80, 'admin_setting_blockchainnetwork@get', NULL, 'admin', '/admin/setting/blockchainNetwork', 'GET', NULL),
(81, 'admin_setting_blockchainnetwork@post', NULL, 'admin', '/admin/setting/blockchainNetwork', 'POST', NULL),
(82, 'admin_setting_blockchainnetwork_id@put', NULL, 'admin', '/admin/setting/blockchainNetwork/{id:\\d+}', 'PUT', NULL),
(83, 'admin_setting_blockchainnetwork_id@delete', NULL, 'admin', '/admin/setting/blockchainNetwork/{id:\\d+}', 'DELETE', NULL),
(84, 'admin_setting_coin_id@get', NULL, 'admin', '/admin/setting/coin/{id:\\d+}', 'GET', NULL),
(85, 'admin_setting_coin_list@get', NULL, 'admin', '/admin/setting/coin/list', 'GET', NULL),
(86, 'admin_setting_coin@get', NULL, 'admin', '/admin/setting/coin', 'GET', NULL),
(87, 'admin_setting_coin@post', NULL, 'admin', '/admin/setting/coin', 'POST', NULL),
(88, 'admin_setting_coin_id@put', NULL, 'admin', '/admin/setting/coin/{id:\\d+}', 'PUT', NULL),
(89, 'admin_setting_coin_id@delete', NULL, 'admin', '/admin/setting/coin/{id:\\d+}', 'DELETE', NULL),
(90, 'admin_setting_deposit_id@get', NULL, 'admin', '/admin/setting/deposit/{id:\\d+}', 'GET', NULL),
(91, 'admin_setting_deposit_list@get', NULL, 'admin', '/admin/setting/deposit/list', 'GET', NULL),
(92, 'admin_setting_deposit@get', NULL, 'admin', '/admin/setting/deposit', 'GET', NULL),
(93, 'admin_setting_deposit@post', NULL, 'admin', '/admin/setting/deposit', 'POST', NULL),
(94, 'admin_setting_deposit_id@put', NULL, 'admin', '/admin/setting/deposit/{id:\\d+}', 'PUT', NULL),
(95, 'admin_setting_deposit_id@delete', NULL, 'admin', '/admin/setting/deposit/{id:\\d+}', 'DELETE', NULL),
(96, 'admin_setting_general_id@get', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'GET', NULL),
(97, 'admin_setting_general_list@get', NULL, 'admin', '/admin/setting/general/list', 'GET', NULL),
(98, 'admin_setting_general@get', NULL, 'admin', '/admin/setting/general', 'GET', NULL),
(99, 'admin_setting_general@post', NULL, 'admin', '/admin/setting/general', 'POST', NULL),
(100, 'admin_setting_general_id@put', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'PUT', NULL),
(101, 'admin_setting_general_id@delete', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'DELETE', NULL),
(102, 'admin_setting_level_id@get', NULL, 'admin', '/admin/setting/level/{id:\\d+}', 'GET', NULL),
(103, 'admin_setting_level_list@get', NULL, 'admin', '/admin/setting/level/list', 'GET', NULL),
(104, 'admin_setting_level@get', NULL, 'admin', '/admin/setting/level', 'GET', NULL),
(105, 'admin_setting_level@post', NULL, 'admin', '/admin/setting/level', 'POST', NULL),
(106, 'admin_setting_level_id@put', NULL, 'admin', '/admin/setting/level/{id:\\d+}', 'PUT', NULL),
(107, 'admin_setting_level_id@delete', NULL, 'admin', '/admin/setting/level/{id:\\d+}', 'DELETE', NULL),
(108, 'admin_setting_nft_id@get', NULL, 'admin', '/admin/setting/nft/{id:\\d+}', 'GET', NULL),
(109, 'admin_setting_nft_list@get', NULL, 'admin', '/admin/setting/nft/list', 'GET', NULL),
(110, 'admin_setting_nft@get', NULL, 'admin', '/admin/setting/nft', 'GET', NULL),
(111, 'admin_setting_nft@post', NULL, 'admin', '/admin/setting/nft', 'POST', NULL),
(112, 'admin_setting_nft_id@put', NULL, 'admin', '/admin/setting/nft/{id:\\d+}', 'PUT', NULL),
(113, 'admin_setting_nft_id@delete', NULL, 'admin', '/admin/setting/nft/{id:\\d+}', 'DELETE', NULL),
(114, 'admin_setting_operator_id@get', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'GET', NULL),
(115, 'admin_setting_operator_list@get', NULL, 'admin', '/admin/setting/operator/list', 'GET', NULL),
(116, 'admin_setting_operator@get', NULL, 'admin', '/admin/setting/operator', 'GET', NULL),
(117, 'admin_setting_operator@post', NULL, 'admin', '/admin/setting/operator', 'POST', NULL),
(118, 'admin_setting_operator_id@put', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'PUT', NULL),
(119, 'admin_setting_operator_id@delete', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'DELETE', NULL),
(120, 'admin_setting_wallet_id@get', NULL, 'admin', '/admin/setting/wallet/{id:\\d+}', 'GET', NULL),
(121, 'admin_setting_wallet_list@get', NULL, 'admin', '/admin/setting/wallet/list', 'GET', NULL),
(122, 'admin_setting_wallet@get', NULL, 'admin', '/admin/setting/wallet', 'GET', NULL),
(123, 'admin_setting_wallet@post', NULL, 'admin', '/admin/setting/wallet', 'POST', NULL),
(124, 'admin_setting_wallet_id@put', NULL, 'admin', '/admin/setting/wallet/{id:\\d+}', 'PUT', NULL),
(125, 'admin_setting_wallet_id@delete', NULL, 'admin', '/admin/setting/wallet/{id:\\d+}', 'DELETE', NULL),
(126, 'admin_setting_walletattribute_id@get', NULL, 'admin', '/admin/setting/walletAttribute/{id:\\d+}', 'GET', NULL),
(127, 'admin_setting_walletattribute_list@get', NULL, 'admin', '/admin/setting/walletAttribute/list', 'GET', NULL),
(128, 'admin_setting_walletattribute@get', NULL, 'admin', '/admin/setting/walletAttribute', 'GET', NULL),
(129, 'admin_setting_walletattribute@post', NULL, 'admin', '/admin/setting/walletAttribute', 'POST', NULL),
(130, 'admin_setting_walletattribute_id@put', NULL, 'admin', '/admin/setting/walletAttribute/{id:\\d+}', 'PUT', NULL),
(131, 'admin_setting_walletattribute_id@delete', NULL, 'admin', '/admin/setting/walletAttribute/{id:\\d+}', 'DELETE', NULL),
(132, 'admin_setting_withdraw_id@get', NULL, 'admin', '/admin/setting/withdraw/{id:\\d+}', 'GET', NULL),
(133, 'admin_setting_withdraw_list@get', NULL, 'admin', '/admin/setting/withdraw/list', 'GET', NULL),
(134, 'admin_setting_withdraw@get', NULL, 'admin', '/admin/setting/withdraw', 'GET', NULL),
(135, 'admin_setting_withdraw@post', NULL, 'admin', '/admin/setting/withdraw', 'POST', NULL),
(136, 'admin_setting_withdraw_id@put', NULL, 'admin', '/admin/setting/withdraw/{id:\\d+}', 'PUT', NULL),
(137, 'admin_setting_withdraw_id@delete', NULL, 'admin', '/admin/setting/withdraw/{id:\\d+}', 'DELETE', NULL),
(138, 'admin_system_nftusage_id@get', NULL, 'admin', '/admin/system/nftUsage/{id:\\d+}', 'GET', NULL),
(139, 'admin_system_nftusage_list@get', NULL, 'admin', '/admin/system/nftUsage/list', 'GET', NULL),
(140, 'admin_system_nftusage@get', NULL, 'admin', '/admin/system/nftUsage', 'GET', NULL),
(141, 'admin_system_nftusage@post', NULL, 'admin', '/admin/system/nftUsage', 'POST', NULL),
(142, 'admin_system_nftusage_id@put', NULL, 'admin', '/admin/system/nftUsage/{id:\\d+}', 'PUT', NULL),
(143, 'admin_system_nftusage_id@delete', NULL, 'admin', '/admin/system/nftUsage/{id:\\d+}', 'DELETE', NULL),
(144, 'admin_user_deposit_id@get', NULL, 'admin', '/admin/user/deposit/{id:\\d+}', 'GET', NULL),
(145, 'admin_user_deposit_list@get', NULL, 'admin', '/admin/user/deposit/list', 'GET', NULL),
(146, 'admin_user_deposit@get', NULL, 'admin', '/admin/user/deposit', 'GET', NULL),
(147, 'admin_user_deposit@post', NULL, 'admin', '/admin/user/deposit', 'POST', NULL),
(148, 'admin_user_deposit_id@put', NULL, 'admin', '/admin/user/deposit/{id:\\d+}', 'PUT', NULL),
(149, 'admin_user_deposit_id@delete', NULL, 'admin', '/admin/user/deposit/{id:\\d+}', 'DELETE', NULL),
(150, 'admin_user_invitecode_id@get', NULL, 'admin', '/admin/user/inviteCode/{id:\\d+}', 'GET', NULL),
(151, 'admin_user_invitecode_list@get', NULL, 'admin', '/admin/user/inviteCode/list', 'GET', NULL),
(152, 'admin_user_invitecode@get', NULL, 'admin', '/admin/user/inviteCode', 'GET', NULL),
(153, 'admin_user_invitecode@post', NULL, 'admin', '/admin/user/inviteCode', 'POST', NULL),
(154, 'admin_user_invitecode_id@put', NULL, 'admin', '/admin/user/inviteCode/{id:\\d+}', 'PUT', NULL),
(155, 'admin_user_invitecode_id@delete', NULL, 'admin', '/admin/user/inviteCode/{id:\\d+}', 'DELETE', NULL),
(156, 'admin_user_nft_id@get', NULL, 'admin', '/admin/user/nft/{id:\\d+}', 'GET', NULL),
(157, 'admin_user_nft_list@get', NULL, 'admin', '/admin/user/nft/list', 'GET', NULL),
(158, 'admin_user_nft@get', NULL, 'admin', '/admin/user/nft', 'GET', NULL),
(159, 'admin_user_nft@post', NULL, 'admin', '/admin/user/nft', 'POST', NULL),
(160, 'admin_user_nft_id@put', NULL, 'admin', '/admin/user/nft/{id:\\d+}', 'PUT', NULL),
(161, 'admin_user_nft_id@delete', NULL, 'admin', '/admin/user/nft/{id:\\d+}', 'DELETE', NULL),
(162, 'admin_user_remark_id@get', NULL, 'admin', '/admin/user/remark/{id:\\d+}', 'GET', NULL),
(163, 'admin_user_remark_list@get', NULL, 'admin', '/admin/user/remark/list', 'GET', NULL),
(164, 'admin_user_remark@get', NULL, 'admin', '/admin/user/remark', 'GET', NULL),
(165, 'admin_user_remark@post', NULL, 'admin', '/admin/user/remark', 'POST', NULL),
(166, 'admin_user_remark_id@put', NULL, 'admin', '/admin/user/remark/{id:\\d+}', 'PUT', NULL),
(167, 'admin_user_remark_id@delete', NULL, 'admin', '/admin/user/remark/{id:\\d+}', 'DELETE', NULL),
(168, 'admin_user_seed_id@get', NULL, 'admin', '/admin/user/seed/{id:\\d+}', 'GET', NULL),
(169, 'admin_user_seed_list@get', NULL, 'admin', '/admin/user/seed/list', 'GET', NULL),
(170, 'admin_user_seed@get', NULL, 'admin', '/admin/user/seed', 'GET', NULL),
(171, 'admin_user_seed@post', NULL, 'admin', '/admin/user/seed', 'POST', NULL),
(172, 'admin_user_seed_id@put', NULL, 'admin', '/admin/user/seed/{id:\\d+}', 'PUT', NULL),
(173, 'admin_user_seed_id@delete', NULL, 'admin', '/admin/user/seed/{id:\\d+}', 'DELETE', NULL),
(174, 'admin_user_tree_id@get', NULL, 'admin', '/admin/user/tree/{id:\\d+}', 'GET', NULL),
(175, 'admin_user_tree_list@get', NULL, 'admin', '/admin/user/tree/list', 'GET', NULL),
(176, 'admin_user_tree@get', NULL, 'admin', '/admin/user/tree', 'GET', NULL),
(177, 'admin_user_tree@post', NULL, 'admin', '/admin/user/tree', 'POST', NULL),
(178, 'admin_user_tree_id@put', NULL, 'admin', '/admin/user/tree/{id:\\d+}', 'PUT', NULL),
(179, 'admin_user_tree_id@delete', NULL, 'admin', '/admin/user/tree/{id:\\d+}', 'DELETE', NULL),
(180, 'admin_user_withdraw_id@get', NULL, 'admin', '/admin/user/withdraw/{id:\\d+}', 'GET', NULL),
(181, 'admin_user_withdraw_list@get', NULL, 'admin', '/admin/user/withdraw/list', 'GET', NULL),
(182, 'admin_user_withdraw@get', NULL, 'admin', '/admin/user/withdraw', 'GET', NULL),
(183, 'admin_user_withdraw@post', NULL, 'admin', '/admin/user/withdraw', 'POST', NULL),
(184, 'admin_user_withdraw_id@put', NULL, 'admin', '/admin/user/withdraw/{id:\\d+}', 'PUT', NULL),
(185, 'admin_user_withdraw_id@delete', NULL, 'admin', '/admin/user/withdraw/{id:\\d+}', 'DELETE', NULL),
(186, 'admin_wallet_transaction_id@get', NULL, 'admin', '/admin/wallet/transaction/{id:\\d+}', 'GET', NULL),
(187, 'admin_wallet_transaction_list@get', NULL, 'admin', '/admin/wallet/transaction/list', 'GET', NULL),
(188, 'admin_wallet_transaction@get', NULL, 'admin', '/admin/wallet/transaction', 'GET', NULL),
(189, 'admin_wallet_transaction@post', NULL, 'admin', '/admin/wallet/transaction', 'POST', NULL),
(190, 'admin_wallet_transaction_id@put', NULL, 'admin', '/admin/wallet/transaction/{id:\\d+}', 'PUT', NULL),
(191, 'admin_wallet_transaction_id@delete', NULL, 'admin', '/admin/wallet/transaction/{id:\\d+}', 'DELETE', NULL),
(192, 'admin_wallet_transactiondetail_id@get', NULL, 'admin', '/admin/wallet/transactionDetail/{id:\\d+}', 'GET', NULL),
(193, 'admin_wallet_transactiondetail_list@get', NULL, 'admin', '/admin/wallet/transactionDetail/list', 'GET', NULL),
(194, 'admin_wallet_transactiondetail@get', NULL, 'admin', '/admin/wallet/transactionDetail', 'GET', NULL),
(195, 'admin_wallet_transactiondetail@post', NULL, 'admin', '/admin/wallet/transactionDetail', 'POST', NULL),
(196, 'admin_wallet_transactiondetail_id@put', NULL, 'admin', '/admin/wallet/transactionDetail/{id:\\d+}', 'PUT', NULL),
(197, 'admin_wallet_transactiondetail_id@delete', NULL, 'admin', '/admin/wallet/transactionDetail/{id:\\d+}', 'DELETE', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_personal_access_tokens`
--

CREATE TABLE `sw_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_reward_record`
--

CREATE TABLE `sw_reward_record` (
  `id` bigint(20) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `pay_at` datetime DEFAULT NULL,
  `used_at` varchar(50) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `user_tree_id` int(11) DEFAULT NULL COMMENT 'refer to user_tree',
  `from_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `from_user_tree_id` int(11) DEFAULT NULL COMMENT 'refer to user_tree',
  `reward_type` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_operator',
  `amount` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `distribution` text DEFAULT NULL,
  `ref_table` varchar(64) DEFAULT NULL,
  `ref_id` int(11) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_attribute`
--

CREATE TABLE `sw_setting_attribute` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `filter` varchar(128) DEFAULT NULL,
  `remark` text DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `chain_id` int(11) NOT NULL DEFAULT 0,
  `rpc_url` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_blockchain_network`
--

INSERT INTO `sw_setting_blockchain_network` (`id`, `deleted_at`, `code`, `type`, `chain_id`, `rpc_url`, `remark`) VALUES
(1, NULL, 'Blast', 'blast', 81457, 'https://rpc.blast.io', NULL),
(2, NULL, 'Blast Sepolia', 'blast', 168587773, 'https://sepolia.blast.io', NULL),
(3, NULL, 'BSC Testnet', 'bsc', 97, 'https://data-seed-prebsc-1-s1.bnbchain.org:8545', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_coin`
--

CREATE TABLE `sw_setting_coin` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `wallet_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_wallet',
  `is_show` tinyint(1) NOT NULL DEFAULT 1,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_coin`
--

INSERT INTO `sw_setting_coin` (`id`, `deleted_at`, `code`, `wallet_id`, `is_show`, `remark`) VALUES
(1, NULL, 'RE', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_deposit`
--

CREATE TABLE `sw_setting_deposit` (
  `id` int(11) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `coin_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_coin',
  `token_address` varchar(66) DEFAULT NULL COMMENT 'contract address',
  `network` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_blockchain_network',
  `address` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `latest_block` varchar(255) DEFAULT '0',
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_general`
--

CREATE TABLE `sw_setting_general` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1,
  `remark` text DEFAULT NULL
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
(10, NULL, 'by_pass', 'api', '0', 1, NULL),
(11, NULL, 'deposit', 'deposit_min', '0.01', 1, NULL),
(12, NULL, 'deposit', 'deposit_max', '0', 1, NULL),
(13, NULL, 'withdraw', 'withdraw_min', '10', 1, NULL),
(14, NULL, 'withdraw', 'withdraw_max', '0', 1, NULL),
(15, NULL, 'withdraw', 'withdraw_fee_wallet', '1', 1, NULL),
(16, NULL, 'withdraw', 'withdraw_fee', '1', 1, NULL),
(17, NULL, 'withdraw', 'withdraw_gasprice_multiplier', '1', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_nft`
--

CREATE TABLE `sw_setting_nft` (
  `id` int(11) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `token_address` varchar(66) DEFAULT NULL COMMENT 'contract address',
  `network` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_blockchain_network',
  `address` varchar(255) DEFAULT NULL,
  `private_key` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `latest_block` bigint(20) DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sw_setting_nft`
--

INSERT INTO `sw_setting_nft` (`id`, `sn`, `created_at`, `updated_at`, `deleted_at`, `name`, `token_address`, `network`, `address`, `private_key`, `is_active`, `latest_block`, `remark`) VALUES
(1, '123OCULMGFW7RERT', '2024-02-21 21:52:40', '2024-04-04 19:26:01', NULL, 'plant', '0xcEcC5b9E82F5c8299c3be08e202dE109E3fE7D63', 2, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', 'gJ0bJe8Cu1o2ILgNCDt7SpR5m6ODNqznvz79QLm0XxDma/ePCODOe+WHR22ydrJJEVUY43jRXcDC258na1nR59yoIC+fIunXL2gH2p3U7ws=', 1, NULL, NULL),
(2, 'YUIOCULMGFW7DDFG', '2024-02-21 21:52:40', '2024-03-25 20:26:06', NULL, 'plant_validator', '0x55D9BaadBe77704a149913744F71Ff7c20C2DA33', 3, NULL, NULL, 1, NULL, NULL),
(3, 'ERTOCULMGFW456HJ', '2024-02-21 21:52:40', '2024-03-25 20:26:09', NULL, 'genesis_1', '0x4D7a44CbdE4Fd01045f170088619AC5606a59671', 3, NULL, NULL, 1, NULL, NULL),
(4, '1ERCCULMGFW7JOMM', '2024-02-21 21:52:40', '2024-03-25 20:26:12', NULL, 'genesis_2', '0x31b1a6A62ABcBb0D43D672449607E12DD3fD2d90', 3, NULL, NULL, 1, NULL, NULL),
(5, 'ABGCUGHJFW7J1897', '2024-02-21 21:52:40', '2024-03-25 20:26:12', NULL, 'potion', '0x1451a574eDe71bF4216b0FEDa1b70b12eC46fE6E', 2, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_operator`
--

CREATE TABLE `sw_setting_operator` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `remark` text DEFAULT NULL
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
(26, NULL, 'type', 'purchase', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_payment`
--

CREATE TABLE `sw_setting_payment` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `formula` text DEFAULT NULL,
  `calc_formula` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_wallet`
--

CREATE TABLE `sw_setting_wallet` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_wallet`
--

INSERT INTO `sw_setting_wallet` (`id`, `deleted_at`, `image`, `code`, `is_show`, `remark`) VALUES
(1, NULL, '/img/wallet/point.png', 'point', 1, NULL),
(2, NULL, '/img/wallet/re.png', 're', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_wallet_attribute`
--

CREATE TABLE `sw_setting_wallet_attribute` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `from_wallet_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_wallet',
  `to_wallet_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_wallet',
  `attribute_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_attribute',
  `value` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_wallet_attribute`
--

INSERT INTO `sw_setting_wallet_attribute` (`id`, `deleted_at`, `from_wallet_id`, `to_wallet_id`, `attribute_id`, `value`, `remark`) VALUES
(1, NULL, 1, 2, 1, '1', NULL),
(2, NULL, 1, 2, 2, '1', NULL),
(3, NULL, 1, 2, 3, '0', NULL),
(4, NULL, 1, 2, 4, '0', NULL),
(5, NULL, 1, 2, 5, '0', NULL),
(6, NULL, 1, 2, 6, '1', NULL),
(7, NULL, 1, 2, 7, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_withdraw`
--

CREATE TABLE `sw_setting_withdraw` (
  `id` int(11) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `coin_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_coin',
  `token_address` varchar(66) DEFAULT NULL COMMENT 'contract address',
  `network` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_blockchain_network',
  `address` varchar(255) DEFAULT NULL,
  `private_key` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_deposit`
--

CREATE TABLE `sw_user_deposit` (
  `id` bigint(20) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `amount` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_operator',
  `coin_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_coin',
  `txid` varchar(66) DEFAULT NULL,
  `log_index` varchar(64) DEFAULT NULL,
  `from_address` varchar(66) DEFAULT NULL,
  `to_address` varchar(66) DEFAULT NULL,
  `network` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_blockchain_network',
  `token_address` varchar(66) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_nft`
--

CREATE TABLE `sw_user_nft` (
  `id` bigint(20) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_operator',
  `txid` varchar(66) DEFAULT NULL,
  `log_index` varchar(64) DEFAULT NULL,
  `token_id` varchar(64) DEFAULT NULL,
  `from_address` varchar(66) DEFAULT NULL,
  `to_address` varchar(66) DEFAULT NULL,
  `network` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_blockchain_network',
  `token_address` varchar(66) DEFAULT NULL,
  `ref_table` varchar(64) DEFAULT NULL,
  `ref_id` int(11) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_remark`
--

CREATE TABLE `sw_user_remark` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_admin',
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_withdraw`
--

CREATE TABLE `sw_user_withdraw` (
  `id` bigint(20) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `amount` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `fee` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `distribution` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_operator',
  `amount_wallet_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_wallet',
  `fee_wallet_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_wallet',
  `to_coin_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_coin',
  `txid` varchar(66) DEFAULT NULL,
  `log_index` varchar(64) DEFAULT NULL,
  `from_address` varchar(66) DEFAULT NULL,
  `to_address` varchar(66) DEFAULT NULL,
  `network` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_blockchain_network',
  `token_address` varchar(66) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_wallet_transaction`
--

CREATE TABLE `sw_wallet_transaction` (
  `id` bigint(20) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) DEFAULT NULL,
  `transaction_type` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_operator',
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `from_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `to_uid` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to account_user',
  `amount` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `distribution` text DEFAULT NULL,
  `ref_table` varchar(64) DEFAULT NULL,
  `ref_id` text DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_wallet_transaction_detail`
--

CREATE TABLE `sw_wallet_transaction_detail` (
  `id` bigint(20) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `wallet_transaction_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to wallet_transaction',
  `wallet_id` int(11) NOT NULL DEFAULT 0 COMMENT 'refer to setting_wallet',
  `amount` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `before_amount` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `after_amount` decimal(30,8) NOT NULL DEFAULT 0.00000000,
  `remark` text DEFAULT NULL
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
  ADD KEY `web3_address` (`web3_address`);

--
-- Indexes for table `sw_account_user`
--
ALTER TABLE `sw_account_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `web3_address` (`web3_address`);

--
-- Indexes for table `sw_admin_permission`
--
ALTER TABLE `sw_admin_permission`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_permission_warehouse`
--
ALTER TABLE `sw_permission_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_personal_access_tokens`
--
ALTER TABLE `sw_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sw_personal_access_tokens_token_unique` (`token`),
  ADD KEY `sw_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sw_reward_record`
--
ALTER TABLE `sw_reward_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bonus_type` (`reward_type`),
  ADD KEY `uid` (`uid`),
  ADD KEY `from_uid` (`from_uid`),
  ADD KEY `user_pet_id` (`user_tree_id`),
  ADD KEY `from_user_pet_id` (`from_user_tree_id`);

--
-- Indexes for table `sw_setting_attribute`
--
ALTER TABLE `sw_setting_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_blockchain_network`
--
ALTER TABLE `sw_setting_blockchain_network`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_coin`
--
ALTER TABLE `sw_setting_coin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_deposit`
--
ALTER TABLE `sw_setting_deposit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `coin_id` (`coin_id`);

--
-- Indexes for table `sw_setting_general`
--
ALTER TABLE `sw_setting_general`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_nft`
--
ALTER TABLE `sw_setting_nft`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `sw_setting_operator`
--
ALTER TABLE `sw_setting_operator`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_wallet_attribute`
--
ALTER TABLE `sw_setting_wallet_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_withdraw`
--
ALTER TABLE `sw_setting_withdraw`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `coin_id` (`coin_id`);

--
-- Indexes for table `sw_user_deposit`
--
ALTER TABLE `sw_user_deposit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sw_user_nft`
--
ALTER TABLE `sw_user_nft`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sw_user_remark`
--
ALTER TABLE `sw_user_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_user_withdraw`
--
ALTER TABLE `sw_user_withdraw`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sw_wallet_transaction`
--
ALTER TABLE `sw_wallet_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`),
  ADD KEY `from_uid` (`from_uid`),
  ADD KEY `to_uid` (`to_uid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sw_account_user`
--
ALTER TABLE `sw_account_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_admin_permission`
--
ALTER TABLE `sw_admin_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sw_log_admin`
--
ALTER TABLE `sw_log_admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_log_cronjob`
--
ALTER TABLE `sw_log_cronjob`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_log_user`
--
ALTER TABLE `sw_log_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_network_sponsor`
--
ALTER TABLE `sw_network_sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_permission_template`
--
ALTER TABLE `sw_permission_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_permission_warehouse`
--
ALTER TABLE `sw_permission_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `sw_personal_access_tokens`
--
ALTER TABLE `sw_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_reward_record`
--
ALTER TABLE `sw_reward_record`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_attribute`
--
ALTER TABLE `sw_setting_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sw_setting_blockchain_network`
--
ALTER TABLE `sw_setting_blockchain_network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sw_setting_coin`
--
ALTER TABLE `sw_setting_coin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_setting_deposit`
--
ALTER TABLE `sw_setting_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_general`
--
ALTER TABLE `sw_setting_general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sw_setting_nft`
--
ALTER TABLE `sw_setting_nft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sw_setting_operator`
--
ALTER TABLE `sw_setting_operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sw_setting_payment`
--
ALTER TABLE `sw_setting_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_setting_wallet`
--
ALTER TABLE `sw_setting_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sw_setting_wallet_attribute`
--
ALTER TABLE `sw_setting_wallet_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sw_setting_withdraw`
--
ALTER TABLE `sw_setting_withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_deposit`
--
ALTER TABLE `sw_user_deposit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_nft`
--
ALTER TABLE `sw_user_nft`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_remark`
--
ALTER TABLE `sw_user_remark`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_user_withdraw`
--
ALTER TABLE `sw_user_withdraw`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_wallet_transaction`
--
ALTER TABLE `sw_wallet_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_wallet_transaction_detail`
--
ALTER TABLE `sw_wallet_transaction_detail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
