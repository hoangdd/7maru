-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2014 at 10:21 PM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `7maru`
--
CREATE DATABASE IF NOT EXISTS `7maru` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `7maru`;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_admins`
--

CREATE TABLE IF NOT EXISTS `7maru_admins` (
  `admin_id` char(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `7maru_admins`
--

INSERT INTO `7maru_admins` (`admin_id`, `username`, `password`) VALUES
('0b254e63', 'linhadmin1', '4246b5ce3d8d217d5cc28536742d006d4a3d10bf'),
('0e7bbb88', 'admin6', '4a1c920b3cdef9a951b4452801d80c6443bb1004'),
('1', 'admin', 'a4af7832a6e969eafb671bc80d016c259aeafc0c'),
('10d3d127', 'admin11', 'bc2331daa7533637ef634dbbbee560859b263291'),
('2fd24344', 'admin123456', '63f76668b0d7f77d0545d60b4ddcef2dbafa02b7'),
('566c8022', 'hoangdac', '0304abcedf0c0ed5a484fc1bff1bdca9437abff9'),
('665963c9', 'admin1', 'af178307cdc518451a583286ea0d0aa7283b209c'),
('68def93c', 'admin10', 'a63f91789181adde105d5918ebe41d3304f91251'),
('76769393', 'admin7', '4ee86ea3e70c9529637cab61d37fe27ea7156d98'),
('78f10966', 'admin16', '349d28c4f53273b9110bef6c7c4e384856acb54a'),
('7df159f6', 'hoangdac123', '01a127912601f744e968979d530528480f426928'),
('866cc3a5', 'admin5', '0c266ec0cd1a23ab0f75be905bc8b622606a5e8a'),
('88eb5950', 'admin14', '02f90e2900f768ec6f78dbfb6b498d948c9122c5'),
('964333ff', 'admin3', '870b5366e1ab4a9189653f8f8e83f800e9a2e37d'),
('98c4a90a', 'admin12', 'd945ca7aae534b8b247872bcc69c767c943a10c0'),
('a6322310', 'admin9', '6949ee72e167713f076730676c69987154f35bf0'),
('de3f0b0b', 'admin8', 'fdf90a5a8eba2a30ec43ca72538f965e49124bd2'),
('e0c98111', 'admin13', 'b81460fa15fa4603dd0079c70b4ebe328d253b9c'),
('ee4e1be4', 'admin2', '0d2cc48da9bcd713a2df28b6ce7cc05e1146a8a8'),
('f0e6714b', 'admin15', 'b365ac534fa1fedc77414d1e6eb8a4383654ed01'),
('fe61ebbe', 'admin4', 'e5b47a79ffc7f1743fd7ee7b6a43b49f9ba3c496');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_admin_admins`
--

CREATE TABLE IF NOT EXISTS `7maru_admin_admins` (
  `admin_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_super` char(20) NOT NULL,
  `admin_sub` char(20) NOT NULL,
  PRIMARY KEY (`admin_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `7maru_admin_admins`
--

INSERT INTO `7maru_admin_admins` (`admin_level_id`, `admin_super`, `admin_sub`) VALUES
(7, '1', '78f10966');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_admin_ips`
--

CREATE TABLE IF NOT EXISTS `7maru_admin_ips` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `7maru_admin_ips`
--

INSERT INTO `7maru_admin_ips` (`ip_id`, `ip`) VALUES
(3, '127.0.0.1'),
(4, '192.168.23.5'),
(5, '192.168.137.82'),
(6, '192.168.137.1'),
(7, '192.168.1.1'),
(8, '192.168.1.1'),
(9, '192.168.1.1'),
(10, '192.168.1.2'),
(11, '192.168.1.3'),
(12, '192.168.1.3'),
(13, '192.168.1.3'),
(14, '192.168.1.4'),
(15, '192.168.1.4'),
(16, '192.168.1.4'),
(17, '192.168.1.5'),
(18, '192.168.1.6'),
(19, '192.168.1.7'),
(20, '192.168.1.8'),
(21, '192.168.1.8'),
(22, '192.168.1.8');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_block_students`
--

CREATE TABLE IF NOT EXISTS `7maru_block_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` char(20) NOT NULL,
  `student_id` char(20) NOT NULL,
  `block_reason` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_categories`
--

CREATE TABLE IF NOT EXISTS `7maru_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `7maru_categories`
--

INSERT INTO `7maru_categories` (`category_id`, `name`, `description`, `created`, `modified`) VALUES
(3, '数学', NULL, NULL, NULL),
(4, '科学', NULL, NULL, NULL),
(5, '生理学', NULL, NULL, NULL),
(6, '物理学', '', NULL, NULL),
(7, '地理学', NULL, NULL, NULL),
(8, '歴史', '歴史', NULL, NULL),
(9, '化学', '化学', NULL, NULL),
(10, '歌学', NULL, NULL, NULL),
(11, '画学', NULL, NULL, NULL),
(12, '小学校', NULL, NULL, NULL),
(13, '中学校', NULL, NULL, NULL),
(14, '大学', NULL, NULL, NULL),
(15, '高学校', NULL, NULL, NULL),
(16, '小説', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `7maru_comas`
--

CREATE TABLE IF NOT EXISTS `7maru_comas` (
  `coma_id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `cover` varchar(100) CHARACTER SET latin1 NOT NULL,
  `is_block` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`coma_id`),
  UNIQUE KEY `coma_id` (`coma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `7maru_comas`
--

INSERT INTO `7maru_comas` (`coma_id`, `author`, `name`, `title`, `description`, `created`, `modified`, `cover`, `is_block`) VALUES
(75, 'd289f257', 'Harry potter I', NULL, 'Harry Potter の小説                                    ', '2014-04-14 11:50:31', '2014-04-14 15:03:43', '897031436.gif', 1),
(76, 'f06d488d', '124', NULL, '144', '2014-04-14 14:16:23', '2014-04-16 20:30:18', 'default_cover.jpg', 0),
(79, '36576644', 'nise koi', NULL, '                                                       gdfgdfgfdggggggggggggggggggggggggggg                 ', '2014-04-14 15:02:59', '2014-04-14 15:02:59', 'default_cover.jpg', 0),
(80, '72e67d29', 'moi tao', NULL, 'cha co gi                                    ', '2014-04-14 15:05:41', '2014-04-14 15:05:41', '3644085422.jpeg', 0),
(81, '8399e2ae', 'Thép đã tôi thế đấy.', 'Thép đã tôi thế đấy.', 'Novel', '2014-04-15 02:18:54', '2014-04-15 02:18:54', '1075469643.png', 0),
(82, 'd289f257', '歌', '素敵な歌', '素敵な歌を聞きたいとき、ぜひこの授業を買ってください！！！！						', '2014-04-15 12:10:00', '2014-04-15 12:10:00', '2769951984.gif', 0),
(83, 'd289f257', 'Harry potter First Part', 'Harry Potter', 'Harry potter fan''s course', '2014-04-15 12:13:13', '2014-04-15 12:13:13', '2427918124.jpg', 0),
(85, '8399e2ae', 'Hello', 'Abort all pending jQuery AJAX requests', 'AAA', '2014-04-15 12:21:03', '2014-04-15 12:21:03', '2704663602.jpg', 0),
(86, '8399e2ae', 'Hello', 'Abort all pending jQuery AJAX requests', 'AAAxxxx', '2014-04-15 12:23:28', '2014-04-15 12:23:28', 'default_cover.jpg', 0),
(87, '8399e2ae', 'Book 1 ', 'The world is flat', 'Hellox', '2014-04-15 18:35:51', '2014-04-15 18:35:51', '1996043208.png', 0),
(88, '8399e2ae', 'Book 2', 'The world is flat', 'Hellox', '2014-04-15 18:37:54', '2014-04-15 18:37:54', '21093638.png', 0),
(89, '8399e2ae', 'Book 1 ', 'The world is flat', 'Hellox', '2014-04-15 18:40:27', '2014-04-15 18:40:27', '3494240231.png', 0),
(90, '8399e2ae', 'Book 1 ', 'The world is flat', 'Hellox', '2014-04-15 18:41:53', '2014-04-15 18:41:53', '2594695671.png', 0),
(91, '8399e2ae', 'Book 1 ', 'The world is flat', 'Hellox', '2014-04-15 18:45:48', '2014-04-15 18:45:48', '1602567522.png', 0),
(92, '8399e2ae', 'Boook3', 'Pie', 'Love', '2014-04-15 18:48:08', '2014-04-15 18:48:08', '2833417891.png', 0),
(93, '8399e2ae', 'Thép đã tôi thế đấy.', 'Thép đã tôi thế đấy.', 'Novel', '2014-04-15 21:23:35', '2014-04-15 21:23:35', 'default_cover.jpg', 0),
(94, '8399e2ae', 'Thép đã tôi thế đấy.', 'Thép đã tôi thế đấy.', 'Novel', '2014-04-15 21:24:28', '2014-04-15 21:24:28', 'default_cover.jpg', 0),
(95, '8399e2ae', 'Thép đã tôi thế đấy.', 'Thép đã tôi thế đấy.', 'Novel', '2014-04-15 21:38:12', '2014-04-15 21:38:12', 'default_cover.jpg', 0),
(96, NULL, 'Thép đã tôi thế đấy.', 'Thép đã tôi thế đấy.', 'Novel', '2014-04-15 22:56:16', '2014-04-15 22:56:16', 'default_cover.jpg', 0),
(98, '8399e2ae', 'Thép đã tôi thế đấy.', 'Thép đã tôi thế đấy.', 'Novel', '2014-04-15 23:16:20', '2014-04-15 23:16:20', 'default_cover.jpg', 0),
(99, '8399e2ae', 'Thép đã tôi thế đấy.', 'Thép đã tôi thế đấy.', 'Novel', '2014-04-15 23:17:29', '2014-04-15 23:17:29', '2005354501.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `7maru_coma_categories`
--

CREATE TABLE IF NOT EXISTS `7maru_coma_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coma_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `7maru_coma_categories`
--

INSERT INTO `7maru_coma_categories` (`id`, `coma_id`, `category_id`, `created`, `modified`) VALUES
(110, 75, 16, '2014-04-14 11:50:32', '2014-04-14 11:50:32'),
(111, 76, 4, '2014-04-14 14:16:23', '2014-04-14 14:16:23'),
(112, 76, 5, '2014-04-14 14:16:23', '2014-04-14 14:16:23'),
(115, 80, 4, '2014-04-14 15:05:41', '2014-04-14 15:05:41'),
(116, 80, 5, '2014-04-14 15:05:41', '2014-04-14 15:05:41'),
(117, 81, 9, '2014-04-15 02:18:54', '2014-04-15 02:18:54'),
(118, 82, 16, '2014-04-15 12:10:00', '2014-04-15 12:10:00'),
(119, 83, 16, '2014-04-15 12:13:13', '2014-04-15 12:13:13'),
(121, 85, 3, '2014-04-15 12:21:04', '2014-04-15 12:21:04'),
(122, 85, 4, '2014-04-15 12:21:04', '2014-04-15 12:21:04'),
(123, 86, 3, '2014-04-15 12:23:29', '2014-04-15 12:23:29'),
(124, 86, 4, '2014-04-15 12:23:29', '2014-04-15 12:23:29'),
(125, 87, 3, '2014-04-15 18:35:51', '2014-04-15 18:35:51'),
(126, 87, 5, '2014-04-15 18:35:51', '2014-04-15 18:35:51'),
(127, 88, 3, '2014-04-15 18:37:54', '2014-04-15 18:37:54'),
(128, 88, 5, '2014-04-15 18:37:54', '2014-04-15 18:37:54'),
(129, 89, 3, '2014-04-15 18:40:27', '2014-04-15 18:40:27'),
(130, 89, 5, '2014-04-15 18:40:27', '2014-04-15 18:40:27'),
(131, 90, 3, '2014-04-15 18:41:53', '2014-04-15 18:41:53'),
(132, 90, 5, '2014-04-15 18:41:53', '2014-04-15 18:41:53'),
(133, 91, 3, '2014-04-15 18:45:48', '2014-04-15 18:45:48'),
(134, 91, 5, '2014-04-15 18:45:48', '2014-04-15 18:45:48'),
(135, 92, 3, '2014-04-15 18:48:08', '2014-04-15 18:48:08'),
(136, 93, 9, '2014-04-15 21:23:35', '2014-04-15 21:23:35'),
(137, 94, 9, '2014-04-15 21:24:28', '2014-04-15 21:24:28'),
(138, 95, 9, '2014-04-15 21:38:12', '2014-04-15 21:38:12'),
(139, 96, 9, '2014-04-15 22:56:17', '2014-04-15 22:56:17'),
(141, 98, 9, '2014-04-15 23:16:20', '2014-04-15 23:16:20'),
(142, 99, 9, '2014-04-15 23:17:29', '2014-04-15 23:17:29'),
(143, 81, 9, '2014-04-15 23:20:08', '2014-04-15 23:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_coma_references`
--

CREATE TABLE IF NOT EXISTS `7maru_coma_references` (
  `reference_id` int(11) NOT NULL AUTO_INCREMENT,
  `coma_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `link` text CHARACTER SET utf8,
  `reference_type` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`reference_id`),
  UNIQUE KEY `reference_id` (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_coma_transactions`
--

CREATE TABLE IF NOT EXISTS `7maru_coma_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `coma_id` int(11) DEFAULT NULL,
  `student_id` char(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  UNIQUE KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `7maru_coma_transactions`
--

INSERT INTO `7maru_coma_transactions` (`transaction_id`, `coma_id`, `student_id`, `created`, `modified`) VALUES
(7, 76, '794e71c6', '2014-04-14 14:19:10', '2014-04-14 14:19:10'),
(9, 76, '59bd686f', '2014-04-14 14:40:11', '2014-04-14 14:40:11'),
(10, 75, '324ab90a', '2014-04-14 14:52:08', '2014-04-14 14:52:08'),
(11, 80, '794e71c6', '2014-04-14 15:10:59', '2014-04-14 15:10:59'),
(12, 79, '794e71c6', '2014-04-14 15:15:07', '2014-04-14 15:15:07'),
(14, 80, '72e67d29', '2014-04-14 15:46:22', '2014-04-14 15:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_comments`
--

CREATE TABLE IF NOT EXISTS `7maru_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(20) DEFAULT NULL,
  `file_id` char(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `7maru_comments`
--

INSERT INTO `7maru_comments` (`comment_id`, `user_id`, `file_id`, `created`, `modified`, `content`) VALUES
(17, '794e71c6', 'f55a9a82', '2014-04-14 14:21:00', '2014-04-14 14:21:00', 'hay thees'),
(18, '794e71c6', 'f55a9a82', '2014-04-14 14:21:26', '2014-04-14 14:21:26', 'avatar dep k\n\n'),
(20, '59bd686f', 'f55a9a82', '2014-04-14 14:40:42', '2014-04-14 14:40:42', '=))\n'),
(21, '72e67d29', '9d062ec0', '2014-04-14 15:06:55', '2014-04-14 15:06:55', '1224234324');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_files`
--

CREATE TABLE IF NOT EXISTS `7maru_files` (
  `file_id` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `coma_id` int(11) DEFAULT NULL,
  `type` text CHARACTER SET ascii,
  `isTest` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `7maru_files`
--

INSERT INTO `7maru_files` (`file_id`, `file_name`, `path`, `coma_id`, `type`, `isTest`, `created`, `modified`) VALUES
('02d68b27', '01W-04-内部設計書について', '02d68b27.swf', 87, 'pdf', NULL, '2014-04-15 18:35:51', '2014-04-15 18:35:51'),
('0f8e7e4f', 'db', '0f8e7e4f.swf', 81, 'pdf', NULL, '2014-04-15 02:18:54', '2014-04-15 02:18:54'),
('15741f5a', 'Tim - Truc Nhan Van Mai Huong', '15741f5a.mp3', 56, 'mp3', NULL, '2014-04-09 01:15:25', '2014-04-09 01:15:25'),
('319fac52', 'demo', '319fac52.swf', 81, 'pdf', NULL, '2014-04-15 23:20:08', '2014-04-15 23:20:08'),
('3fa46514', 'db', '3fa46514.swf', 76, 'pdf', NULL, '2014-04-14 14:16:23', '2014-04-14 14:16:23'),
('454ae29f', 'oscon-node-100723132853-phpapp01', '454ae29f.swf', 85, 'pdf', NULL, '2014-04-15 12:21:04', '2014-04-15 12:21:04'),
('48d1699b', '01W-04-内部設計書について', '48d1699b.swf', 88, 'pdf', NULL, '2014-04-15 18:37:54', '2014-04-15 18:37:54'),
('53f65ae0', 'demo', '53f65ae0.swf', 92, 'pdf', NULL, '2014-04-15 18:48:08', '2014-04-15 18:48:08'),
('66b1a2d9', 'HP1_Hon da phu thuy', '66b1a2d9.swf', 83, 'pdf', NULL, '2014-04-15 12:13:13', '2014-04-15 12:13:13'),
('7e919a0e', 'You Are the Apple of My Eye OST - Ho Ha', '7e919a0e.mp3', 82, 'mp3', NULL, '2014-04-15 12:10:00', '2014-04-15 12:10:00'),
('9d062ec0', '60662ae9', '9d062ec0.mp3', 80, 'mp3', NULL, '2014-04-14 15:05:41', '2014-04-14 15:05:41'),
('a1d47bc9', '[Lyric Vietsub YANST] All Rise - Blue', 'a1d47bc9.mp4', 79, 'mp4', NULL, '2014-04-14 15:02:59', '2014-04-14 15:02:59'),
('a249f4bb', 'api_20131031', 'a249f4bb.swf', 96, 'pdf', NULL, '2014-04-15 22:56:17', '2014-04-15 22:56:17'),
('a70c478c', 'demo', 'a70c478c.swf', 98, 'pdf', NULL, '2014-04-15 23:16:20', '2014-04-15 23:16:20'),
('cac8ad3c', 'play_framework_cookbook', 'cac8ad3c.swf', 86, 'pdf', NULL, '2014-04-15 12:23:29', '2014-04-15 12:23:29'),
('d2cb2e1f', 'testfile', 'd2cb2e1f.js', 81, 'tsv', 1, '2014-04-15 02:18:54', '2014-04-15 02:18:54'),
('de9fd61f', '01W-04-内部設計書について', 'de9fd61f.swf', 89, 'pdf', NULL, '2014-04-15 18:40:27', '2014-04-15 18:40:27'),
('e05dcc2b', '01W-04-内部設計書について', 'e05dcc2b.swf', 90, 'pdf', NULL, '2014-04-15 18:41:53', '2014-04-15 18:41:53'),
('e35e17fc', 'HP1_Hon da phu thuy', 'e35e17fc.swf', 75, 'pdf', NULL, '2014-04-14 11:50:32', '2014-04-14 11:50:32'),
('ededffdd', '60662ae9', 'ededffdd.mp3', 80, 'mp3', NULL, '2014-04-14 15:05:41', '2014-04-14 15:05:41'),
('f1c3830f', '01W-04-内部設計書について', 'f1c3830f.swf', 91, 'pdf', NULL, '2014-04-15 18:45:48', '2014-04-15 18:45:48'),
('f55a9a82', 'Beethoven Virus - Diana Boncheva', 'f55a9a82.mp3', 76, 'mp3', NULL, '2014-04-14 14:16:23', '2014-04-14 14:16:23'),
('f604ba89', 'demo', 'f604ba89.swf', 99, 'pdf', NULL, '2014-04-15 23:17:29', '2014-04-15 23:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_ip_of_admin`
--

CREATE TABLE IF NOT EXISTS `7maru_ip_of_admin` (
  `ip_of_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` char(20) NOT NULL,
  `ip_id` int(11) NOT NULL,
  PRIMARY KEY (`ip_of_admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_ip_of_admins`
--

CREATE TABLE IF NOT EXISTS `7maru_ip_of_admins` (
  `ip_of_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `ip_id` int(11) NOT NULL,
  PRIMARY KEY (`ip_of_admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `7maru_ip_of_admins`
--

INSERT INTO `7maru_ip_of_admins` (`ip_of_admin_id`, `admin_id`, `ip_id`) VALUES
(1, 'e0c98111', 19),
(2, '88eb5950', 20),
(3, 'f0e6714b', 21),
(4, '78f10966', 22);

-- --------------------------------------------------------

--
-- Table structure for table `7maru_login`
--

CREATE TABLE IF NOT EXISTS `7maru_login` (
  `user_id` char(20) NOT NULL,
  `access_token` char(30) DEFAULT NULL,
  `ip_address` varchar(30) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_logs`
--

CREATE TABLE IF NOT EXISTS `7maru_logs` (
  `log_id` int(11) NOT NULL DEFAULT '0',
  `actor` char(20) DEFAULT NULL,
  `action` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_notifications`
--

CREATE TABLE IF NOT EXISTS `7maru_notifications` (
  `notification_id` int(11) NOT NULL DEFAULT '0',
  `user_id` char(20) DEFAULT NULL,
  `notification_type` int(11) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_rate_comas`
--

CREATE TABLE IF NOT EXISTS `7maru_rate_comas` (
  `rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `coma_id` int(11) DEFAULT NULL,
  `student_id` char(20) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`rate_id`),
  UNIQUE KEY `rate_id` (`rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `7maru_rate_comas`
--

INSERT INTO `7maru_rate_comas` (`rate_id`, `coma_id`, `student_id`, `rate`, `created`, `modified`) VALUES
(3, 76, '794e71c6', 3, '2014-04-14 14:19:07', '2014-04-14 14:19:07'),
(4, 76, '59bd686f', 5, '2014-04-14 14:40:22', '2014-04-14 14:40:22'),
(6, 80, '794e71c6', 1, '2014-04-14 15:12:07', '2014-04-14 15:12:07'),
(7, 79, '794e71c6', 3, '2014-04-14 15:14:20', '2014-04-14 15:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_report_comas`
--

CREATE TABLE IF NOT EXISTS `7maru_report_comas` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `coma_id` int(11) DEFAULT NULL,
  `student_id` char(20) DEFAULT NULL,
  `report_reason` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`report_id`),
  UNIQUE KEY `report_id` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_students`
--

CREATE TABLE IF NOT EXISTS `7maru_students` (
  `student_id` char(20) CHARACTER SET utf8 NOT NULL,
  `credit_account` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `level` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `7maru_students`
--

INSERT INTO `7maru_students` (`student_id`, `credit_account`, `level`, `created`, `modified`) VALUES
('11f54f77', '345AFDDETR', '1', '2014-04-13 14:49:58', '2014-04-13 14:49:58'),
('2e29b04f', '73890GFDHKJKLSD', 'high school', '2014-04-02 05:50:44', '2014-04-03 16:05:19'),
('301db882', '45435sdfdfg', '1', '2014-04-13 14:53:58', '2014-04-13 14:53:58'),
('3368b9d4', 'htjrhgkdfhlskjgh', '', '2014-04-14 14:20:01', '2014-04-14 14:27:22'),
('779ea719', 'AY53656', '1', '2014-04-13 14:57:54', '2014-04-13 14:57:54'),
('9f844062', '1234567890', 'no', '2014-04-14 11:18:11', '2014-04-14 11:18:11'),
('a1b11ce0', 'ABC123', '3', '2014-04-14 11:42:04', '2014-04-14 11:42:04'),
('b8351b3c', '09009090990', '3', '2014-04-16 19:53:29', '2014-04-16 19:53:29'),
('e1b9f159', '12356767AFGDFREGDF', '1', '2014-04-07 07:20:17', '2014-04-07 07:20:17'),
('f8628eda', '2423536ADFDFF', '1', '2014-04-13 14:43:52', '2014-04-13 23:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_teachers`
--

CREATE TABLE IF NOT EXISTS `7maru_teachers` (
  `teacher_id` char(20) NOT NULL,
  `bank_account` varchar(30) DEFAULT NULL,
  `office` varchar(50) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `7maru_teachers`
--

INSERT INTO `7maru_teachers` (`teacher_id`, `bank_account`, `office`, `description`, `created`, `modified`) VALUES
('0bf29ce6', 'SDGSDFS45654', 'HUST', '4y6fdsfgd', '2014-04-13 15:01:14', '2014-04-13 15:01:14'),
('a924aafe', 'A76886899BCD', 'HUST', 'thich da bong, mao hiem', '2014-04-01 23:02:28', '2014-04-03 16:46:33'),
('c2ff4f19', 'hfgdhfgh', '', '', '2014-04-14 14:28:45', '2014-04-14 14:34:01'),
('f6f9ffa6', 'kjxkaqkjqwkask', 'BKHN', 'Nothing', '2014-04-15 02:15:54', '2014-04-15 02:15:54'),
('fa4b4018', 'qwertyuiop', 'bachkhoa', 'lala', '2014-04-14 10:25:23', '2014-04-14 10:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_users`
--

CREATE TABLE IF NOT EXISTS `7maru_users` (
  `user_id` char(20) NOT NULL,
  `username` char(30) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text,
  `password` char(50) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `foreign_id` char(20) NOT NULL,
  `verifycode_question` char(40) NOT NULL,
  `verifycode_answer` char(40) NOT NULL,
  `approved` int(11) NOT NULL,
  `activated` int(11) NOT NULL,
  `original_password` char(50) NOT NULL,
  `original_verifycode_answer` char(50) NOT NULL,
  `original_verifycode_question` char(50) NOT NULL,
  `profile_picture` varchar(20) NOT NULL,
  `comment` tinyint(4) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `login_ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `7maru_users`
--

INSERT INTO `7maru_users` (`user_id`, `username`, `firstname`, `lastname`, `date_of_birth`, `address`, `password`, `user_type`, `mail`, `phone_number`, `created`, `modified`, `foreign_id`, `verifycode_question`, `verifycode_answer`, `approved`, `activated`, `original_password`, `original_verifycode_answer`, `original_verifycode_question`, `profile_picture`, `comment`, `gender`, `login_ip`) VALUES
('2d031c56', 'linhstudent', 'Linh', 'Trinh', '2012-10-15', 'Thon ChÃ¹a', 'af600a1df33aed1b8fa80ad14814641f2d3b9701', 2, 'linhtrinhkhac@gmail.com', '0909090909', '2014-04-16 19:53:29', '2014-04-16 19:53:29', 'b8351b3c', '15ad8693d707d5b36c2c6614e2b19b23b6967991', 'f45a1b0b385a085f92625e29d5dc9c272bd78073', 1, 1, 'af600a1df33aed1b8fa80ad14814641f2d3b9701', 'f45a1b0b385a085f92625e29d5dc9c272bd78073', '15ad8693d707d5b36c2c6614e2b19b23b6967991', '2d031c56.png', 0, 1, NULL),
('324ab90a', 'datmeo', 'Dat', 'Meo', '0000-00-00', 'Ha noi - Viet Nam', 'b02f54dbce5753b17605cf69b9865e06c4cbab75', 2, 'letuandat1991@gmail.com', '0987654321', '2014-04-14 11:18:12', '2014-04-16 20:29:33', '9f844062', '03e1cabc80d777f67a39090d6cc1fba42940eb83', 'f3e08f78d7f7b462ba4e398ad487eb20125fc5fc', 1, 1, 'b02f54dbce5753b17605cf69b9865e06c4cbab75', 'f3e08f78d7f7b462ba4e398ad487eb20125fc5fc', '03e1cabc80d777f67a39090d6cc1fba42940eb83', '324ab90a.gif', 0, 1, NULL),
('36576644', 'vietntnt', 'Viet', 'TEacher', '2013-01-16', 'dfsf', '96006d03fbfe697c8cf3efa4f11d7ef7c5a9d328', 1, 'vietbktn2@gmail.com', '5654', '2014-04-14 14:28:45', '2014-04-14 14:41:05', 'c2ff4f19', 'd947c7cd392b3d2fcaecb01e8893a85d771e7501', 'e1564ed0686278a1e047328b75cb85328c738d2f', 1, 1, '96006d03fbfe697c8cf3efa4f11d7ef7c5a9d328', 'e1564ed0686278a1e047328b75cb85328c738d2f', 'd947c7cd392b3d2fcaecb01e8893a85d771e7501', 'default_avatar.jpg', 0, 1, '192.168.137.1'),
('45bd5262', 'hoangtat', 'hoang', 'dac', '1980-05-13', 'address', '9b0fc4ba2a05afa67d9c89c433ab9e7958db9f0f', 2, 'hotada_29@gmail.com', '0128297497129', '2014-04-13 14:43:52', '2014-04-13 23:05:23', 'f8628eda', 'a4f81beb4dd26fa157f4718fff89dddfe01dfa30', '1b3131b8bd586f6495eb2dc1639221c524f44d6a', 1, 1, '9b0fc4ba2a05afa67d9c89c433ab9e7958db9f0f', '1b3131b8bd586f6495eb2dc1639221c524f44d6a', 'a4f81beb4dd26fa157f4718fff89dddfe01dfa30', '45bd5262.png', 0, 1, ''),
('4859b470', 'dac_91hoang', 'dac', 'hoang', '0000-00-00', '3tefsdfdg', '5f7f5cfbe947af8f543f75a4635f9ada626b1e91', 2, 'arsert@yahoo.com', '01649635921', '2014-04-13 14:57:54', '2014-04-13 14:57:54', '779ea719', 'd6d5bf89bff358120d6001ff1dc17da5b6335d13', '6cdfd53218a93fbcfd827111535bc161b5fda07f', 1, 1, '5f7f5cfbe947af8f543f75a4635f9ada626b1e91', '6cdfd53218a93fbcfd827111535bc161b5fda07f', 'd6d5bf89bff358120d6001ff1dc17da5b6335d13', 'default_avatar.jpg', 0, 1, ''),
('4d316489', 'dac_12345', 'sdff32', 'asdfdff14', '1991-12-28', '3tefsdfdg', 'f913eeb3504d46c79f70a95517b8164c28630759', 1, 'hota12323da_2923@gmail.com', '345673456653', '2014-04-13 15:01:14', '2014-04-13 15:01:14', '0bf29ce6', 'ca828a5d2da3fcf04b52a3a954d0d5c182f6f03d', '785f14957a16a2c39a36e4f514a55494acb528e0', 1, 1, 'f913eeb3504d46c79f70a95517b8164c28630759', '785f14957a16a2c39a36e4f514a55494acb528e0', 'ca828a5d2da3fcf04b52a3a954d0d5c182f6f03d', 'default_avatar.jpg', 0, 1, ''),
('59bd686f', 'vietnt', 'viet', 'nguyen', '0000-00-00', 'TV NC TH', 'bffef826fef9a7934f11271584baa3935f1ad5a3', 2, 'vietbkn@gmail.com', '085745857348', '2014-04-14 14:20:01', '2014-04-14 14:27:21', '3368b9d4', '1316102bb51ad65f309d2f03e75c2fd6c3dd60b3', '9cca84ac3caa48940195874147d75e7b32219797', 1, 1, 'bffef826fef9a7934f11271584baa3935f1ad5a3', '9cca84ac3caa48940195874147d75e7b32219797', '1316102bb51ad65f309d2f03e75c2fd6c3dd60b3', '59bd686f.jpg', 0, 1, NULL),
('72e67d29', 'dachoang', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', 'a775c7d6de84f45852fef8ca867e2e59151ee58f', 2, 'blood@yahoo.com', '01649635921', '2014-04-07 07:20:17', '2014-04-14 15:05:00', 'e1b9f159', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '0383cecedd8a58f07f94303eb906252c7f1682e3', 1, 1, 'af04214ad5717122399d77fe878320fbdeb07bf1', '0383cecedd8a58f07f94303eb906252c7f1682e3', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '72e67d29.jpeg', 0, 1, '127.0.0.1'),
('794e71c6', 'naruto123', 'naruto', 'sasuke', '0000-00-00', 'Hà Nội', '654dce0575f5f7ce662254955d737f0130f0feb6', 2, 'naruto123@gmail.com', '0123456789', '2014-04-14 11:42:04', '2014-04-14 11:46:49', 'a1b11ce0', '7bbe64fa4071f2b92df72c3424b771ad7021da77', '82d92c796c9a71569b0e62da82d22401d38e7a91', 1, 1, '654dce0575f5f7ce662254955d737f0130f0feb6', '82d92c796c9a71569b0e62da82d22401d38e7a91', '7bbe64fa4071f2b92df72c3424b771ad7021da77', '794e71c6.jpg', 0, 1, NULL),
('8399e2ae', 'teacher', 'Nguyễn Văn', 'Tèo ', '2014-04-15', 'Đại học Y Thái Nguyên', '7b8d7dc74eb19d2bf8ce7973497e83e62f4cfe0c', 1, 'xxxxxx@asdkjakjas.xxx', '01019283822233', '2014-04-15 02:15:54', '2014-04-16 00:49:28', 'f6f9ffa6', '4c8b068d53d31635fd504c018796fc77c78f67e5', '8533fa896a18766d8a172126b6672518ebe3fe0e', 1, 1, '7b8d7dc74eb19d2bf8ce7973497e83e62f4cfe0c', '8533fa896a18766d8a172126b6672518ebe3fe0e', '4c8b068d53d31635fd504c018796fc77c78f67e5', 'default_avatar.jpg', 0, 1, '127.0.0.1'),
('8be569f4', 'hoangtatdac', 'dac', 'hoang', '0000-00-00', 'address', 'ee31e9e1ed037b919fc7f63d7cfc0d915621a3a7', 2, 'bloodfire91@yahoo.com', '027468163937394', '2014-04-13 14:49:58', '2014-04-16 20:29:02', '11f54f77', '8b838d010d856ab0611236306fde9a1879e16105', '8b18bf30c0c53caf00508d2838e558abae9ad6be', 1, 0, 'ee31e9e1ed037b919fc7f63d7cfc0d915621a3a7', '8b18bf30c0c53caf00508d2838e558abae9ad6be', '8b838d010d856ab0611236306fde9a1879e16105', '8be569f4.', 0, 1, ''),
('9d70546e', 'hoangdactat', 'dac', 'hoang', '0000-00-00', 'address', 'b63bb064b64b2289a6eb9db77025eb7725c9bb31', 2, 'hotada_2923@gmail.com', '845678356534', '2014-04-13 14:53:59', '2014-04-13 14:53:59', '301db882', 'cd88d9eb00a0692f3835fe6117400ad86be16d1a', 'd50d00e889a9349ef8c919489901781964c4811d', 1, 1, 'b63bb064b64b2289a6eb9db77025eb7725c9bb31', 'd50d00e889a9349ef8c919489901781964c4811d', 'cd88d9eb00a0692f3835fe6117400ad86be16d1a', 'default_avatar.jpg', 0, 1, ''),
('d289f257', 'meob0nmat', 'Dat', 'Meo', '2014-04-14', 'Ha noi - Viet Nam', '7aebbeac1ae537776a70dd69bdee988002fd6263', 1, 'datmeo1211@gmail.com', '01674548304', '2014-04-14 10:25:23', '2014-04-15 11:55:30', 'fa4b4018', '2173142a4eb25808dbbdb836de67e5a150988408', '0dea3551bb914fc5daa9c20f7da75e9b0f5c8113', 1, 1, '7aebbeac1ae537776a70dd69bdee988002fd6263', '0dea3551bb914fc5daa9c20f7da75e9b0f5c8113', '2173142a4eb25808dbbdb836de67e5a150988408', 'd289f257.gif', 0, 1, '192.168.137.82'),
('f06d488d', 'dac_123', 'dac', 'hoang', '1991-12-28', 'Linh Nam, Hoang Mai, Ha Noi', '6ced97670065d7bc4f2558f13a52108d1c2b0831', 1, 'hotada91@gmail.com', '01649635921', '2014-04-01 23:02:28', '2014-04-14 14:14:29', 'a924aafe', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', 1, 1, '6ced97670065d7bc4f2558f13a52108d1c2b0831', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'f06d488d.jpeg', 0, 1, '127.0.0.1'),
('f40cdec6', 'bloodfire91', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', '7662cb69c385d2dce8ac6b97e9fbc10f39a0ead1', 2, 'bloodfire345@gmail.com', '016291262023', '2014-04-02 05:50:44', '2014-04-03 16:05:19', '2e29b04f', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', '6e2b2a4ca778f34731d2013d6c220108bae634bb', 1, 1, '2ba88158aaea184af824f1bcd38ef564032208ad', '6e2b2a4ca778f34731d2013d6c220108bae634bb', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', 'f40cdec6.jpeg', 0, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
