-- phpMyAdmin SQL Dump
-- version 4.0.9deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2014 at 12:01 AM
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
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `7maru_admins`
--

INSERT INTO `7maru_admins` (`admin_id`, `username`, `password`, `first_name`, `last_name`) VALUES
('04341632', 'dac123', 'c43fb84bbc003fe3632593b283f82716ef234a93', 'dac', 'hoang'),
('2bd87658', 'adminbua', 'b02421b8eb3058e499d901819d43d0d0e60f8b17', 'bua', 'bua'),
('3a8b6a20', 'admin', 'a4af7832a6e969eafb671bc80d016c259aeafc0c', 'dac', 'hoang'),
('45045432', '管理０', '39eb703ac168702b40de481d7d2d74a4d85a2f68', 'タット', 'ダック');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_admin_ips`
--

CREATE TABLE IF NOT EXISTS `7maru_admin_ips` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `7maru_admin_ips`
--

INSERT INTO `7maru_admin_ips` (`ip_id`, `ip`) VALUES
(3, '127.0.0.1'),
(4, '192.168.23.5'),
(5, '192.168.137.82'),
(6, '192.168.137.1'),
(7, '192.168.1.13'),
(8, '192.168.1.12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=128 ;

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
  `money` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  UNIQUE KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_configs`
--

CREATE TABLE IF NOT EXISTS `7maru_configs` (
  `config_id` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `name` (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `7maru_configs`
--

INSERT INTO `7maru_configs` (`config_id`, `value`, `created`, `modified`) VALUES
('backup_period', 30, '2014-04-16 06:48:10', '2014-04-16 06:48:10'),
('block_time', 15, '2014-04-16 06:48:10', '2014-04-16 06:48:10'),
('error_login_times', 3, '2014-04-16 06:48:10', '2014-04-16 06:48:10'),
('limit_learn_day', 7, '2014-04-16 06:48:10', '2014-04-16 06:48:10'),
('limit_session_time', 30, '2014-04-16 06:48:10', '2014-04-16 06:48:10'),
('money_per_lesson', 20000, '2014-04-16 06:48:10', '2014-04-16 06:48:10'),
('teacher_profit_percentage', 60, '2014-04-16 06:48:10', '2014-04-16 06:48:10');

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
  `is_block` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_ip_of_admins`
--

CREATE TABLE IF NOT EXISTS `7maru_ip_of_admins` (
  `ip_of_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `ip_id` int(11) NOT NULL,
  PRIMARY KEY (`ip_of_admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `7maru_ip_of_admins`
--

INSERT INTO `7maru_ip_of_admins` (`ip_of_admin_id`, `admin_id`, `ip_id`) VALUES
(5, '04341632', 7),
(6, '2bd87658', 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_report_comas`
--

CREATE TABLE IF NOT EXISTS `7maru_report_comas` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `coma_id` int(11) DEFAULT NULL,
  `user_id` char(20) DEFAULT NULL,
  `report_reason` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`report_id`),
  UNIQUE KEY `report_id` (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
('173629a9', 'AY53656EBBC12323', '1', '2014-04-18 23:42:31', '2014-04-18 23:53:13'),
('63618b5c', 'AY53656EBBC123223', '1', '2014-04-18 23:50:27', '2014-04-18 23:50:27'),
('7d0bb8d8', 'AY53656EBBC12322', '2', '2014-04-18 23:44:51', '2014-04-18 23:44:51');

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
('2b60dbb3', 'A76886899BCF', 'HUST', 'girl', '2014-04-18 23:39:46', '2014-04-18 23:39:46'),
('912b7452', 'A76886899BCD', 'HUST', 'girl', '2014-04-18 23:32:30', '2014-04-18 23:32:30'),
('c8f24bc4', 'A76886899BCE', 'HUST', 'girl', '2014-04-18 23:38:41', '2014-04-18 23:38:41');

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
('4c6b0195', 'hoangnm', 'hoang', 'nguyen', '1991-04-02', 'Ha noi - Viet Nam', '2a723ac9879000d7530698d8d64c3a29fccf8167', 1, 'hoangnm@email.com', '1649635920', '2014-04-18 23:32:30', '2014-04-18 23:33:03', '912b7452', 'f4028c825fe7fd641a18427faf54fb88f05c5887', '0cd9899c5f1e22894fdd4bd1667c725fa24feea2', 1, 1, '2a723ac9879000d7530698d8d64c3a29fccf8167', '0cd9899c5f1e22894fdd4bd1667c725fa24feea2', 'f4028c825fe7fd641a18427faf54fb88f05c5887', 'default_avatar.jpg', 0, 1, NULL),
('59bd686f', 'vietnt', 'viet', 'nguyen', '1991-04-01', 'thanh hoa', '5a3cf8c8c8ca0e421b4f337c5fda0a621fe2b6ac', 1, 'viet@email.com', '0128297497129', '2014-04-18 23:38:42', '2014-04-18 23:38:42', 'c8f24bc4', 'a64cb58d9bf45bf15abd80d61e26c4e3dfa88def', '21da517302adbff98aff5dcae3b2c60b9d0b387d', 1, 1, '5a3cf8c8c8ca0e421b4f337c5fda0a621fe2b6ac', '21da517302adbff98aff5dcae3b2c60b9d0b387d', 'a64cb58d9bf45bf15abd80d61e26c4e3dfa88def', 'default_avatar.jpg', 0, 1, NULL),
('87403f64', 'datnt', 'dat', 'nguyen', '1991-04-01', 'Ha noi - Viet Nam', 'a9d54ca4faf99bc206de4cc28ad81ca565bd1bbe', 2, 'datnt@email.com', '016496359214', '2014-04-18 23:44:51', '2014-04-18 23:44:51', '7d0bb8d8', 'affd4ee973cba7277d26b796d61f5120eb15566c', '7bd3639f8f0f50e19d5a88eb00fa6ebf027f440f', 1, 1, 'a9d54ca4faf99bc206de4cc28ad81ca565bd1bbe', '7bd3639f8f0f50e19d5a88eb00fa6ebf027f440f', 'affd4ee973cba7277d26b796d61f5120eb15566c', 'default_avatar.jpg', 0, 1, NULL),
('9b9dd830', 'dacht', 'dac', 'hoang', '1991-04-01', 'Linh Nam, Hoang Mai, Ha Noi', '36a015861425d0118f97791e3b0d7effa3c7c9da', 2, 'dacht@email.com', '01649635921', '2014-04-18 23:50:27', '2014-04-18 23:50:27', '63618b5c', '2350af1253ea5acfaf61f9c714bc7c2c2ac9bc6c', '06ef3d00a2c32d38b25ede875ae9768aa7991480', 0, 1, '36a015861425d0118f97791e3b0d7effa3c7c9da', '06ef3d00a2c32d38b25ede875ae9768aa7991480', '2350af1253ea5acfaf61f9c714bc7c2c2ac9bc6c', 'default_avatar.jpg', 0, 1, NULL),
('e046b762', 'vietdh', 'viet', 'do', '1991-04-01', 'Ha noi - Viet Nam', 'ee2d29de0028495cc3853b85815347de3aced429', 2, 'vietdh@email.com', '019278348734', '2014-04-18 23:42:31', '2014-04-18 23:53:13', '173629a9', 'ebc10a513ea69037352c5f9a3260b6164c54ecdc', '690c3f2dd60e2c74d166edaf27aeb1ec7d666eb8', 1, 1, 'ee2d29de0028495cc3853b85815347de3aced429', '690c3f2dd60e2c74d166edaf27aeb1ec7d666eb8', 'ebc10a513ea69037352c5f9a3260b6164c54ecdc', 'default_avatar.jpg', 0, 1, NULL),
('f77af572', 'hoangdd', 'hoang', 'do', '1991-04-01', 'Thai Binh', 'cfef2d46e732b84f056785a752747669bf7743e4', 1, 'hoangdd@email.com', '01649635921', '2014-04-18 23:39:46', '2014-04-18 23:39:46', '2b60dbb3', 'd644541c478a2939599ffb6fa874bc7b5742528d', '1bf70e152a83549bbd51279cd88633f72f14241f', 1, 1, 'cfef2d46e732b84f056785a752747669bf7743e4', '1bf70e152a83549bbd51279cd88633f72f14241f', 'd644541c478a2939599ffb6fa874bc7b5742528d', 'default_avatar.jpg', 0, 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
