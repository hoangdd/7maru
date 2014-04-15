-- phpMyAdmin SQL Dump
-- version 4.0.9deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2014 at 04:40 PM
-- Server version: 5.5.35-0ubuntu0.12.04.2
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
('1', 'admin', 'a4af7832a6e969eafb671bc80d016c259aeafc0c'),
('2fd24344', 'admin123456', '63f76668b0d7f77d0545d60b4ddcef2dbafa02b7'),
('566c8022', 'hoangdac', '0304abcedf0c0ed5a484fc1bff1bdca9437abff9'),
('7df159f6', 'hoangdac123', '01a127912601f744e968979d530528480f426928');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_admin_ips`
--

CREATE TABLE IF NOT EXISTS `7maru_admin_ips` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `7maru_admin_ips`
--

INSERT INTO `7maru_admin_ips` (`ip_id`, `ip`) VALUES
(3, '127.0.0.1'),
(4, '192.168.23.5'),
(5, '192.168.137.82'),
(6, '192.168.137.1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `7maru_comas`
--

INSERT INTO `7maru_comas` (`coma_id`, `author`, `name`, `title`, `description`, `created`, `modified`, `cover`, `is_block`) VALUES
(71, 'd289f257', '数学と歌学の関係', NULL, '数学と歌学の関係を説明します。                                    ', '2014-04-14 11:10:24', '2014-04-15 12:39:28', '2256068393.gif', 0),
(73, 'd289f257', '機械学習', NULL, '基本機械学習を説明します。                                    ', '2014-04-14 11:21:24', '2014-04-15 11:58:20', '3802604664.jpg', 1),
(76, 'f06d488d', '124', NULL, '144', '2014-04-14 14:16:23', '2014-04-15 12:55:17', 'default_cover.jpg', 1),
(79, '36576644', 'nise koi', NULL, '                                                       gdfgdfgfdggggggggggggggggggggggggggg                 ', '2014-04-14 15:02:59', '2014-04-14 15:02:59', 'default_cover.jpg', 0),
(80, '72e67d29', 'moi tao', NULL, 'cha co gi                                    ', '2014-04-14 15:05:41', '2014-04-14 15:05:41', '3644085422.jpeg', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `7maru_coma_categories`
--

INSERT INTO `7maru_coma_categories` (`id`, `coma_id`, `category_id`, `created`, `modified`) VALUES
(100, 71, 3, '2014-04-14 11:10:25', '2014-04-14 11:10:25'),
(101, 71, 10, '2014-04-14 11:10:25', '2014-04-14 11:10:25'),
(104, 73, 3, '2014-04-14 11:21:24', '2014-04-14 11:21:24'),
(105, 73, 4, '2014-04-14 11:21:24', '2014-04-14 11:21:24'),
(106, 73, 6, '2014-04-14 11:21:24', '2014-04-14 11:21:24'),
(107, 73, 7, '2014-04-14 11:21:24', '2014-04-14 11:21:24'),
(111, 76, 4, '2014-04-14 14:16:23', '2014-04-14 14:16:23'),
(112, 76, 5, '2014-04-14 14:16:23', '2014-04-14 14:16:23'),
(115, 80, 4, '2014-04-14 15:05:41', '2014-04-14 15:05:41'),
(116, 80, 5, '2014-04-14 15:05:41', '2014-04-14 15:05:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `7maru_coma_transactions`
--

INSERT INTO `7maru_coma_transactions` (`transaction_id`, `coma_id`, `student_id`, `created`, `modified`) VALUES
(3, 71, '324ab90a', '2014-04-14 11:31:47', '2014-04-14 11:31:47'),
(4, 71, '794e71c6', '2014-04-14 11:44:31', '2014-04-14 11:44:31'),
(5, 71, '794e71c6', '2014-04-14 11:50:47', '2014-04-14 11:50:47'),
(6, 73, '794e71c6', '2014-04-14 11:51:27', '2014-04-14 11:51:27'),
(7, 76, '794e71c6', '2014-04-14 14:19:10', '2014-04-14 14:19:10'),
(9, 76, '59bd686f', '2014-04-14 14:40:11', '2014-04-14 14:40:11'),
(11, 80, '794e71c6', '2014-04-14 15:10:59', '2014-04-14 15:10:59'),
(12, 79, '794e71c6', '2014-04-14 15:15:07', '2014-04-14 15:15:07'),
(13, 73, '72e67d29', '2014-04-14 15:34:28', '2014-04-14 15:34:28'),
(14, 80, '72e67d29', '2014-04-14 15:46:22', '2014-04-14 15:46:22'),
(15, 71, '14312f33', '2014-04-15 14:18:31', '2014-04-15 14:18:31'),
(16, 79, '14312f33', '2014-04-15 14:20:27', '2014-04-15 14:20:27');

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
(13, 'd289f257', '88aa3351', '2014-04-14 11:11:17', '2014-04-14 11:11:17', '綺麗な歌ですね！！'),
(14, 'd289f257', '88aa3351', '2014-04-14 11:29:34', '2014-04-14 11:29:34', 'これは次のコメントです！！！'),
(15, '324ab90a', '88aa3351', '2014-04-14 11:32:57', '2014-04-14 11:32:57', '素敵だね!'),
(16, '794e71c6', '88aa3351', '2014-04-14 11:46:09', '2014-04-14 11:46:09', 'sao k comment dc?'),
(17, '794e71c6', 'f55a9a82', '2014-04-14 14:21:00', '2014-04-14 14:21:00', 'hay thees'),
(18, '794e71c6', 'f55a9a82', '2014-04-14 14:21:26', '2014-04-14 14:21:26', 'avatar dep k\n\n'),
(20, '59bd686f', 'f55a9a82', '2014-04-14 14:40:42', '2014-04-14 14:40:42', '=))\n'),
(21, '72e67d29', '9d062ec0', '2014-04-14 15:06:55', '2014-04-14 15:06:55', '1224234324'),
(22, '794e71c6', 'e17ededc', '2014-04-14 15:10:44', '2014-04-14 15:10:44', 'cai clgt\n');

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
('15741f5a', 'Tim - Truc Nhan Van Mai Huong', '15741f5a.mp3', 56, 'mp3', NULL, '2014-04-09 01:15:25', '2014-04-09 01:15:25'),
('3fa46514', 'db', '3fa46514.swf', 76, 'pdf', NULL, '2014-04-14 14:16:23', '2014-04-14 14:16:23'),
('88aa3351', 'How long will I love you - Jon Boden, Sam Sweeney & Ben Coleman', '88aa3351.mp3', 71, 'mp3', NULL, '2014-04-14 11:10:25', '2014-04-14 11:10:25'),
('9d062ec0', '60662ae9', '9d062ec0.mp3', 80, 'mp3', NULL, '2014-04-14 15:05:41', '2014-04-14 15:05:41'),
('a1d47bc9', '[Lyric Vietsub YANST] All Rise - Blue', 'a1d47bc9.mp4', 79, 'mp4', NULL, '2014-04-14 15:02:59', '2014-04-14 15:02:59'),
('e17ededc', 'DTM-SentimentAnalysisAndOpinionMining-BingLiu', 'e17ededc.swf', 73, 'pdf', NULL, '2014-04-14 11:21:24', '2014-04-14 11:21:24'),
('ededffdd', '60662ae9', 'ededffdd.mp3', 80, 'mp3', NULL, '2014-04-14 15:05:41', '2014-04-14 15:05:41'),
('f55a9a82', 'Beethoven Virus - Diana Boncheva', 'f55a9a82.mp3', 76, 'mp3', NULL, '2014-04-14 14:16:23', '2014-04-14 14:16:23');

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
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `content` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_notifications`
--

CREATE TABLE IF NOT EXISTS `7maru_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(20) DEFAULT NULL,
  `notification_type` text,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `7maru_notifications`
--

INSERT INTO `7maru_notifications` (`notification_id`, `user_id`, `notification_type`, `content`, `created`, `modified`, `viewed`) VALUES
(1, 'f40cdec6', NULL, 'Mày ngu bm', '2014-04-15 15:35:41', '2014-04-15 15:35:41', 0),
(2, '57d50221', NULL, 'Mày ngu bm', '2014-04-15 15:35:41', '2014-04-15 15:35:41', 0),
(3, '14312f33', NULL, 'Mày ngu bm', '2014-04-15 15:35:41', '2014-04-15 16:28:23', 1),
(4, 'f40cdec6', NULL, 'Mày ngu bm', '2014-04-15 15:36:24', '2014-04-15 15:36:24', 0),
(5, '57d50221', NULL, 'Mày ngu bm', '2014-04-15 15:36:24', '2014-04-15 15:36:24', 0),
(6, '14312f33', NULL, 'Mày ngu bm', '2014-04-15 15:36:24', '2014-04-15 16:28:23', 1),
(7, 'f40cdec6', NULL, 'Mày ngu bm', '2014-04-15 15:36:29', '2014-04-15 15:36:29', 0),
(8, '57d50221', NULL, 'Mày ngu bm', '2014-04-15 15:36:29', '2014-04-15 15:36:29', 0),
(9, '14312f33', NULL, 'Mày ngu bm', '2014-04-15 15:36:29', '2014-04-15 16:28:22', 1),
(10, 'f40cdec6', NULL, 'Mày ngu bm', '2014-04-15 15:37:01', '2014-04-15 15:37:01', 0),
(11, '57d50221', NULL, 'Mày ngu bm', '2014-04-15 15:37:01', '2014-04-15 15:37:01', 0),
(12, '14312f33', NULL, 'Mày ngu bm', '2014-04-15 15:37:01', '2014-04-15 16:28:22', 1),
(13, 'f40cdec6', NULL, 'Mày ngu bm', '2014-04-15 15:37:32', '2014-04-15 15:37:32', 0),
(14, '57d50221', NULL, 'Mày ngu bm', '2014-04-15 15:37:32', '2014-04-15 15:37:32', 0),
(15, '14312f33', NULL, 'Mày ngu bm', '2014-04-15 15:37:32', '2014-04-15 16:28:34', 1),
(16, 'f40cdec6', NULL, 'Mày ngu bm', '2014-04-15 15:38:35', '2014-04-15 15:38:35', 0),
(17, '57d50221', NULL, 'Mày ngu bm', '2014-04-15 15:38:35', '2014-04-15 15:38:35', 0),
(18, '14312f33', NULL, 'Mày ngu bm', '2014-04-15 15:38:35', '2014-04-15 16:28:30', 1),
(31, NULL, NULL, NULL, '2014-04-15 16:18:51', '2014-04-15 16:18:51', 1),
(32, NULL, NULL, NULL, '2014-04-15 16:18:51', '2014-04-15 16:18:51', 1),
(33, NULL, NULL, NULL, '2014-04-15 16:21:04', '2014-04-15 16:21:04', 1),
(34, NULL, NULL, NULL, '2014-04-15 16:21:51', '2014-04-15 16:21:51', 1),
(35, NULL, NULL, NULL, '2014-04-15 16:21:52', '2014-04-15 16:21:52', 1),
(36, NULL, NULL, NULL, '2014-04-15 16:21:54', '2014-04-15 16:21:54', 1),
(37, NULL, NULL, NULL, '2014-04-15 16:22:15', '2014-04-15 16:22:15', 1),
(38, NULL, NULL, NULL, '2014-04-15 16:22:16', '2014-04-15 16:22:16', 1),
(39, NULL, NULL, NULL, '2014-04-15 16:22:16', '2014-04-15 16:22:16', 1),
(40, NULL, NULL, NULL, '2014-04-15 16:22:16', '2014-04-15 16:22:16', 1),
(41, NULL, NULL, NULL, '2014-04-15 16:22:17', '2014-04-15 16:22:17', 1),
(42, NULL, NULL, NULL, '2014-04-15 16:22:17', '2014-04-15 16:22:17', 1),
(43, NULL, NULL, NULL, '2014-04-15 16:22:39', '2014-04-15 16:22:39', 1),
(44, NULL, NULL, NULL, '2014-04-15 16:22:39', '2014-04-15 16:22:39', 1),
(45, NULL, NULL, NULL, '2014-04-15 16:22:40', '2014-04-15 16:22:40', 1),
(46, NULL, NULL, NULL, '2014-04-15 16:22:42', '2014-04-15 16:22:42', 1),
(47, NULL, NULL, NULL, '2014-04-15 16:22:43', '2014-04-15 16:22:43', 1),
(48, NULL, NULL, NULL, '2014-04-15 16:22:44', '2014-04-15 16:22:44', 1),
(49, NULL, NULL, NULL, '2014-04-15 16:22:44', '2014-04-15 16:22:44', 1),
(50, NULL, NULL, NULL, '2014-04-15 16:23:10', '2014-04-15 16:23:10', 1),
(51, NULL, NULL, NULL, '2014-04-15 16:23:11', '2014-04-15 16:23:11', 1),
(52, NULL, NULL, NULL, '2014-04-15 16:23:11', '2014-04-15 16:23:11', 1),
(53, NULL, NULL, NULL, '2014-04-15 16:23:11', '2014-04-15 16:23:11', 1),
(54, NULL, NULL, NULL, '2014-04-15 16:23:12', '2014-04-15 16:23:12', 1),
(55, NULL, NULL, NULL, '2014-04-15 16:23:14', '2014-04-15 16:23:14', 1),
(56, NULL, NULL, NULL, '2014-04-15 16:23:17', '2014-04-15 16:23:17', 1),
(57, NULL, NULL, NULL, '2014-04-15 16:23:18', '2014-04-15 16:23:18', 1),
(58, NULL, NULL, NULL, '2014-04-15 16:23:18', '2014-04-15 16:23:18', 1),
(59, NULL, NULL, NULL, '2014-04-15 16:23:19', '2014-04-15 16:23:19', 1),
(60, NULL, NULL, NULL, '2014-04-15 16:23:19', '2014-04-15 16:23:19', 1),
(61, NULL, NULL, NULL, '2014-04-15 16:23:19', '2014-04-15 16:23:19', 1),
(62, NULL, NULL, NULL, '2014-04-15 16:26:16', '2014-04-15 16:26:16', 1),
(63, NULL, NULL, NULL, '2014-04-15 16:26:17', '2014-04-15 16:26:17', 1),
(64, NULL, NULL, NULL, '2014-04-15 16:26:29', '2014-04-15 16:26:29', 1),
(65, NULL, NULL, NULL, '2014-04-15 16:26:30', '2014-04-15 16:26:30', 1),
(66, NULL, NULL, NULL, '2014-04-15 16:26:31', '2014-04-15 16:26:31', 1),
(67, NULL, NULL, NULL, '2014-04-15 16:26:31', '2014-04-15 16:26:31', 1),
(68, NULL, NULL, NULL, '2014-04-15 16:27:40', '2014-04-15 16:27:40', 1),
(69, 'f06d488d', NULL, 'adfsdfdf', '2014-04-15 16:38:07', '2014-04-15 16:38:23', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `7maru_rate_comas`
--

INSERT INTO `7maru_rate_comas` (`rate_id`, `coma_id`, `student_id`, `rate`, `created`, `modified`) VALUES
(1, 71, '324ab90a', 5, '2014-04-14 11:31:52', '2014-04-14 11:31:52'),
(2, 73, '794e71c6', 5, '2014-04-14 11:51:24', '2014-04-14 11:51:24'),
(3, 76, '794e71c6', 3, '2014-04-14 14:19:07', '2014-04-14 14:19:07'),
(4, 76, '59bd686f', 5, '2014-04-14 14:40:22', '2014-04-14 14:40:22'),
(5, 71, '794e71c6', 4, '2014-04-14 14:49:18', '2014-04-14 14:49:18'),
(6, 80, '794e71c6', 1, '2014-04-14 15:12:07', '2014-04-14 15:12:07'),
(7, 79, '794e71c6', 3, '2014-04-14 15:14:20', '2014-04-14 15:14:20'),
(8, 71, '14312f33', 3, '2014-04-15 14:20:09', '2014-04-15 14:20:09');

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
('1b3e36d1', '21323543ASFDSFDF', '1', '2014-04-15 00:48:19', '2014-04-15 00:52:59'),
('2e29b04f', '73890GFDHKJKLSD', 'high school', '2014-04-02 05:50:44', '2014-04-03 16:05:19'),
('301db882', '45435sdfdfg', '1', '2014-04-13 14:53:58', '2014-04-13 14:53:58'),
('3368b9d4', 'htjrhgkdfhlskjgh', '', '2014-04-14 14:20:01', '2014-04-14 14:27:22'),
('779ea719', 'AY53656', '1', '2014-04-13 14:57:54', '2014-04-13 14:57:54'),
('9f844062', '123456789012', 'no', '2014-04-14 11:18:11', '2014-04-15 00:38:47'),
('a1b11ce0', 'ABC123', '3', '2014-04-14 11:42:04', '2014-04-14 11:42:04'),
('c16a7667', '2546AFDFFD', '1', '2014-04-15 01:00:19', '2014-04-15 01:10:48'),
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
('a924aafe', 'A76886899BCD', 'HUST', 'thich da bong, mao hiem', '2014-04-01 23:02:28', '2014-04-15 00:47:05'),
('c2ff4f19', 'hfgdhfgh', '', '', '2014-04-14 14:28:45', '2014-04-14 14:34:01'),
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
('14312f33', 'hotada91', 'dac', 'hoang', '0000-00-00', 'adsifsdfl', 'b3845a139151b57dc6d8239f7d7ce079be9fd377', 2, 'bloodfire129121@yahoo.com', '019278348734', '2014-04-15 00:48:19', '2014-04-15 00:52:59', '1b3e36d1', 'c19644398f5728b04cd9ba006c47cc740960ad74', 'f24ebf3e91f324714d253279816c302bcfba77be', 1, 1, 'b3845a139151b57dc6d8239f7d7ce079be9fd377', 'f24ebf3e91f324714d253279816c302bcfba77be', 'c19644398f5728b04cd9ba006c47cc740960ad74', '14312f33.jpeg', 0, 1, NULL),
('324ab90a', 'datmeo', 'Dat', 'Meo', '0000-00-00', 'Ha noi - Viet Nam', 'b02f54dbce5753b17605cf69b9865e06c4cbab75', 2, 'letuandat1991@gmail.com', '0987654321', '2014-04-14 11:18:12', '2014-04-15 00:38:47', '9f844062', '03e1cabc80d777f67a39090d6cc1fba42940eb83', 'f3e08f78d7f7b462ba4e398ad487eb20125fc5fc', 1, 1, 'b02f54dbce5753b17605cf69b9865e06c4cbab75', 'f3e08f78d7f7b462ba4e398ad487eb20125fc5fc', '03e1cabc80d777f67a39090d6cc1fba42940eb83', '324ab90a.jpeg', 0, 1, NULL),
('36576644', 'vietntnt', 'Viet', 'TEacher', '2013-01-16', 'dfsf', '96006d03fbfe697c8cf3efa4f11d7ef7c5a9d328', 1, 'vietbktn2@gmail.com', '5654', '2014-04-14 14:28:45', '2014-04-14 14:41:05', 'c2ff4f19', 'd947c7cd392b3d2fcaecb01e8893a85d771e7501', 'e1564ed0686278a1e047328b75cb85328c738d2f', 1, 1, '96006d03fbfe697c8cf3efa4f11d7ef7c5a9d328', 'e1564ed0686278a1e047328b75cb85328c738d2f', 'd947c7cd392b3d2fcaecb01e8893a85d771e7501', 'default_avatar.jpg', 0, 1, '192.168.137.1'),
('45bd5262', 'hoangtat', 'hoang', 'dac', '1980-05-13', 'address', '9b0fc4ba2a05afa67d9c89c433ab9e7958db9f0f', 2, 'hotada_29@gmail.com', '0128297497129', '2014-04-13 14:43:52', '2014-04-13 23:05:23', 'f8628eda', 'a4f81beb4dd26fa157f4718fff89dddfe01dfa30', '1b3131b8bd586f6495eb2dc1639221c524f44d6a', 1, 1, '9b0fc4ba2a05afa67d9c89c433ab9e7958db9f0f', '1b3131b8bd586f6495eb2dc1639221c524f44d6a', 'a4f81beb4dd26fa157f4718fff89dddfe01dfa30', '45bd5262.png', 0, 1, ''),
('4859b470', 'dac_91hoang', 'dac', 'hoang', '0000-00-00', '3tefsdfdg', '5f7f5cfbe947af8f543f75a4635f9ada626b1e91', 2, 'arsert@yahoo.com', '01649635921', '2014-04-13 14:57:54', '2014-04-13 14:57:54', '779ea719', 'd6d5bf89bff358120d6001ff1dc17da5b6335d13', '6cdfd53218a93fbcfd827111535bc161b5fda07f', 1, 1, '5f7f5cfbe947af8f543f75a4635f9ada626b1e91', '6cdfd53218a93fbcfd827111535bc161b5fda07f', 'd6d5bf89bff358120d6001ff1dc17da5b6335d13', 'default_avatar.jpg', 0, 1, ''),
('4d316489', 'dac_12345', 'sdff32', 'asdfdff14', '1991-12-28', '3tefsdfdg', 'f913eeb3504d46c79f70a95517b8164c28630759', 1, 'hota12323da_2923@gmail.com', '345673456653', '2014-04-13 15:01:14', '2014-04-13 15:01:14', '0bf29ce6', 'ca828a5d2da3fcf04b52a3a954d0d5c182f6f03d', '785f14957a16a2c39a36e4f514a55494acb528e0', 1, 1, 'f913eeb3504d46c79f70a95517b8164c28630759', '785f14957a16a2c39a36e4f514a55494acb528e0', 'ca828a5d2da3fcf04b52a3a954d0d5c182f6f03d', 'default_avatar.jpg', 0, 1, ''),
('57d50221', 'bloodfire_nowar', 'asdfdsf324324', 'asdfdf323', '2014-02-09', 'fasdfdf', 'd7da2e191682e99aeec561f1dd289c8cd135c79f', 2, 'hotada91@gma12il.com', '1244356567687', '2014-04-15 01:00:20', '2014-04-15 01:10:47', 'c16a7667', 'f2d6300456138ce9bb83744b65f5f306c8cb42ae', 'c59b46891c12fb3ebb28770d33f581904c8acf67', 1, 1, 'd7da2e191682e99aeec561f1dd289c8cd135c79f', 'c59b46891c12fb3ebb28770d33f581904c8acf67', 'f2d6300456138ce9bb83744b65f5f306c8cb42ae', '57d50221.jpeg', 0, 1, NULL),
('59bd686f', 'vietnt', 'viet', 'nguyen', '0000-00-00', 'TV NC TH', 'bffef826fef9a7934f11271584baa3935f1ad5a3', 2, 'vietbkn@gmail.com', '085745857348', '2014-04-14 14:20:01', '2014-04-14 14:27:21', '3368b9d4', '1316102bb51ad65f309d2f03e75c2fd6c3dd60b3', '9cca84ac3caa48940195874147d75e7b32219797', 1, 1, 'bffef826fef9a7934f11271584baa3935f1ad5a3', '9cca84ac3caa48940195874147d75e7b32219797', '1316102bb51ad65f309d2f03e75c2fd6c3dd60b3', '59bd686f.jpg', 0, 1, NULL),
('72e67d29', 'dachoang', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', 'a775c7d6de84f45852fef8ca867e2e59151ee58f', 2, 'blood@yahoo.com', '01649635921', '2014-04-07 07:20:17', '2014-04-14 15:05:00', 'e1b9f159', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '0383cecedd8a58f07f94303eb906252c7f1682e3', 1, 1, 'af04214ad5717122399d77fe878320fbdeb07bf1', '0383cecedd8a58f07f94303eb906252c7f1682e3', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '72e67d29.jpeg', 0, 1, '127.0.0.1'),
('794e71c6', 'naruto123', 'naruto', 'sasuke', '0000-00-00', 'Hà Nội', '654dce0575f5f7ce662254955d737f0130f0feb6', 2, 'naruto123@gmail.com', '0123456789', '2014-04-14 11:42:04', '2014-04-14 11:46:49', 'a1b11ce0', '7bbe64fa4071f2b92df72c3424b771ad7021da77', '82d92c796c9a71569b0e62da82d22401d38e7a91', 1, 1, '654dce0575f5f7ce662254955d737f0130f0feb6', '82d92c796c9a71569b0e62da82d22401d38e7a91', '7bbe64fa4071f2b92df72c3424b771ad7021da77', '794e71c6.jpg', 0, 1, NULL),
('8be569f4', 'hoangtatdac', 'dac', 'hoang', '0000-00-00', 'address', 'ee31e9e1ed037b919fc7f63d7cfc0d915621a3a7', 2, 'bloodfire91@yahoo.com', '027468163937394', '2014-04-13 14:49:58', '2014-04-13 14:49:58', '11f54f77', '8b838d010d856ab0611236306fde9a1879e16105', '8b18bf30c0c53caf00508d2838e558abae9ad6be', 1, 1, 'ee31e9e1ed037b919fc7f63d7cfc0d915621a3a7', '8b18bf30c0c53caf00508d2838e558abae9ad6be', '8b838d010d856ab0611236306fde9a1879e16105', '8be569f4.', 0, 1, ''),
('9d70546e', 'hoangdactat', 'dac', 'hoang', '0000-00-00', 'address', 'b63bb064b64b2289a6eb9db77025eb7725c9bb31', 2, 'hotada_2923@gmail.com', '845678356534', '2014-04-13 14:53:59', '2014-04-13 14:53:59', '301db882', 'cd88d9eb00a0692f3835fe6117400ad86be16d1a', 'd50d00e889a9349ef8c919489901781964c4811d', 1, 1, 'b63bb064b64b2289a6eb9db77025eb7725c9bb31', 'd50d00e889a9349ef8c919489901781964c4811d', 'cd88d9eb00a0692f3835fe6117400ad86be16d1a', 'default_avatar.jpg', 0, 1, ''),
('d289f257', 'meob0nmat', 'Dat', 'Meo', '2014-04-14', 'Ha noi - Viet Nam', '7aebbeac1ae537776a70dd69bdee988002fd6263', 1, 'datmeo1211@gmail.com', '01674548304', '2014-04-14 10:25:23', '2014-04-14 14:50:51', 'fa4b4018', '2173142a4eb25808dbbdb836de67e5a150988408', '0dea3551bb914fc5daa9c20f7da75e9b0f5c8113', 1, 1, '7aebbeac1ae537776a70dd69bdee988002fd6263', '0dea3551bb914fc5daa9c20f7da75e9b0f5c8113', '2173142a4eb25808dbbdb836de67e5a150988408', 'd289f257.gif', 0, 1, '192.168.137.82'),
('f06d488d', 'dac_123', 'dac', 'hoang123', '1991-12-24', 'Linh Nam123, Hoang Mai, Ha Noi', '6ced97670065d7bc4f2558f13a52108d1c2b0831', 1, 'hotada91@gml.com', '0164963592', '2014-04-01 23:02:28', '2014-04-15 16:38:17', 'a924aafe', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', 1, 1, '6ced97670065d7bc4f2558f13a52108d1c2b0831', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'f06d488d.jpeg', 0, 1, '127.0.0.1'),
('f40cdec6', 'bloodfire91', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', '7662cb69c385d2dce8ac6b97e9fbc10f39a0ead1', 2, 'bloodfire345@gmail.com', '016291262023', '2014-04-02 05:50:44', '2014-04-03 16:05:19', '2e29b04f', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', '6e2b2a4ca778f34731d2013d6c220108bae634bb', 1, 1, '2ba88158aaea184af824f1bcd38ef564032208ad', '6e2b2a4ca778f34731d2013d6c220108bae634bb', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', 'f40cdec6.jpeg', 0, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
