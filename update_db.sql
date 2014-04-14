-- phpMyAdmin SQL Dump
-- version 4.0.9deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2014 at 03:05 PM
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
('1', 'admin', 'a4af7832a6e969eafb671bc80d016c259aeafc0c');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_admin_ips`
--

CREATE TABLE IF NOT EXISTS `7maru_admin_ips` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `7maru_admin_ips`
--

INSERT INTO `7maru_admin_ips` (`ip_id`, `ip`) VALUES
(1, '192.168.1.3'),
(2, '192.168.2.4'),
(3, '192.168.1.2'),
(4, '192.168.23.5');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
(15, '高学校', NULL, NULL, NULL);

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
  PRIMARY KEY (`coma_id`),
  UNIQUE KEY `coma_id` (`coma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `7maru_comas`
--

INSERT INTO `7maru_comas` (`coma_id`, `author`, `name`, `title`, `description`, `created`, `modified`, `cover`) VALUES
(60, 'f06d488d', 'fghjk', NULL, 'etryuinbv                                 ', '2014-04-13 07:49:22', '2014-04-13 07:49:22', '2879148791.png'),
(61, 'f06d488d', 'fghjk', NULL, 'etryuinbv                                 ', '2014-04-13 07:52:48', '2014-04-13 07:52:48', '3803437284.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `7maru_coma_categories`
--

INSERT INTO `7maru_coma_categories` (`id`, `coma_id`, `category_id`, `created`, `modified`) VALUES
(82, 60, 3, '2014-04-13 07:49:22', '2014-04-13 07:49:22'),
(83, 60, 4, '2014-04-13 07:49:22', '2014-04-13 07:49:22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `7maru_coma_transactions`
--

INSERT INTO `7maru_coma_transactions` (`transaction_id`, `coma_id`, `student_id`, `created`, `modified`) VALUES
(1, 60, '72e67d29', '2014-04-13 14:20:50', '2014-04-13 14:20:50'),
(2, 60, '4859b470', '2014-04-13 14:59:40', '2014-04-13 14:59:40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `7maru_comments`
--

INSERT INTO `7maru_comments` (`comment_id`, `user_id`, `file_id`, `created`, `modified`, `content`) VALUES
(4, 'f06d488d', '9c792fca', '2014-04-13 08:07:16', '2014-04-13 08:07:16', 'hay that');

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
('43fab64b', 'CakePHPCookbook', '43fab64b.swf', 61, 'pdf', NULL, '2014-04-13 07:52:48', '2014-04-13 07:52:48'),
('9c792fca', 'Chay Mua - Nguyen Dinh Thanh Tam', '9c792fca.mp3', 61, 'mp3', NULL, '2014-04-13 07:52:48', '2014-04-13 07:52:48'),
('b25dce30', 'Chay Mua - Nguyen Dinh Thanh Tam', 'b25dce30.mp3', 60, 'mp3', NULL, '2014-04-13 07:49:22', '2014-04-13 07:49:22');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
('779ea719', 'AY53656', '1', '2014-04-13 14:57:54', '2014-04-13 14:57:54'),
('e1b9f159', '12356767AFGDFREGDF', '1', '2014-04-07 07:20:17', '2014-04-07 07:20:17'),
('f8628eda', '2423536ADFDFF', '1', '2014-04-13 14:43:52', '2014-04-13 14:43:52');

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
('a924aafe', 'A76886899BCD', 'HUST', 'thich da bong, mao hiem', '2014-04-01 23:02:28', '2014-04-03 16:46:33');

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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `7maru_users`
--

INSERT INTO `7maru_users` (`user_id`, `username`, `firstname`, `lastname`, `date_of_birth`, `address`, `password`, `user_type`, `mail`, `phone_number`, `created`, `modified`, `foreign_id`, `verifycode_question`, `verifycode_answer`, `approved`, `activated`, `original_password`, `original_verifycode_answer`, `original_verifycode_question`, `profile_picture`, `comment`, `gender`) VALUES
('45bd5262', 'hoangtat', 'hoang', 'dac', '0000-00-00', 'address', '9b0fc4ba2a05afa67d9c89c433ab9e7958db9f0f', 2, 'hotada_29@gmail.com', '0128297497129', '2014-04-13 14:43:52', '2014-04-13 14:43:52', 'f8628eda', 'a4f81beb4dd26fa157f4718fff89dddfe01dfa30', '1b3131b8bd586f6495eb2dc1639221c524f44d6a', 1, 1, '9b0fc4ba2a05afa67d9c89c433ab9e7958db9f0f', '1b3131b8bd586f6495eb2dc1639221c524f44d6a', 'a4f81beb4dd26fa157f4718fff89dddfe01dfa30', '', 0, 1),
('4859b470', 'dac_91hoang', 'dac', 'hoang', '0000-00-00', '3tefsdfdg', '5f7f5cfbe947af8f543f75a4635f9ada626b1e91', 2, 'arsert@yahoo.com', '01649635921', '2014-04-13 14:57:54', '2014-04-13 14:57:54', '779ea719', 'd6d5bf89bff358120d6001ff1dc17da5b6335d13', '6cdfd53218a93fbcfd827111535bc161b5fda07f', 1, 1, '5f7f5cfbe947af8f543f75a4635f9ada626b1e91', '6cdfd53218a93fbcfd827111535bc161b5fda07f', 'd6d5bf89bff358120d6001ff1dc17da5b6335d13', 'default_avatar.jpg', 0, 1),
('4d316489', 'dac_12345', 'sdff32', 'asdfdff14', '1991-12-28', '3tefsdfdg', 'f913eeb3504d46c79f70a95517b8164c28630759', 1, 'hota12323da_2923@gmail.com', '345673456653', '2014-04-13 15:01:14', '2014-04-13 15:01:14', '0bf29ce6', 'ca828a5d2da3fcf04b52a3a954d0d5c182f6f03d', '785f14957a16a2c39a36e4f514a55494acb528e0', 1, 1, 'f913eeb3504d46c79f70a95517b8164c28630759', '785f14957a16a2c39a36e4f514a55494acb528e0', 'ca828a5d2da3fcf04b52a3a954d0d5c182f6f03d', 'default_avatar.jpg', 0, 1),
('72e67d29', 'dachoang', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', 'af04214ad5717122399d77fe878320fbdeb07bf1', 2, 'blood@yahoo.com', '01649635921', '2014-04-07 07:20:17', '2014-04-07 07:20:17', 'e1b9f159', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '0383cecedd8a58f07f94303eb906252c7f1682e3', 1, 1, 'af04214ad5717122399d77fe878320fbdeb07bf1', '0383cecedd8a58f07f94303eb906252c7f1682e3', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '72e67d29.jpeg', 0, 1),
('8be569f4', 'hoangtatdac', 'dac', 'hoang', '0000-00-00', 'address', 'ee31e9e1ed037b919fc7f63d7cfc0d915621a3a7', 2, 'bloodfire91@yahoo.com', '027468163937394', '2014-04-13 14:49:58', '2014-04-13 14:49:58', '11f54f77', '8b838d010d856ab0611236306fde9a1879e16105', '8b18bf30c0c53caf00508d2838e558abae9ad6be', 0, 1, 'ee31e9e1ed037b919fc7f63d7cfc0d915621a3a7', '8b18bf30c0c53caf00508d2838e558abae9ad6be', '8b838d010d856ab0611236306fde9a1879e16105', '8be569f4.', 0, 1),
('9d70546e', 'hoangdactat', 'dac', 'hoang', '0000-00-00', 'address', 'b63bb064b64b2289a6eb9db77025eb7725c9bb31', 2, 'hotada_2923@gmail.com', '845678356534', '2014-04-13 14:53:59', '2014-04-13 14:53:59', '301db882', 'cd88d9eb00a0692f3835fe6117400ad86be16d1a', 'd50d00e889a9349ef8c919489901781964c4811d', 0, 1, 'b63bb064b64b2289a6eb9db77025eb7725c9bb31', 'd50d00e889a9349ef8c919489901781964c4811d', 'cd88d9eb00a0692f3835fe6117400ad86be16d1a', 'default_avatar.jpg', 0, 1),
('f06d488d', 'dac_123', 'dac', 'hoang', '1991-12-28', 'Linh Nam, Hoang Mai, Ha Noi', '6ced97670065d7bc4f2558f13a52108d1c2b0831', 1, 'hotada91@gmail.com', '01649635921', '2014-04-01 23:02:28', '2014-04-03 16:46:31', 'a924aafe', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', 1, 1, '6ced97670065d7bc4f2558f13a52108d1c2b0831', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'f06d488d.jpeg', 0, 1),
('f40cdec6', 'bloodfire91', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', '7662cb69c385d2dce8ac6b97e9fbc10f39a0ead1', 2, 'bloodfire345@gmail.com', '016291262023', '2014-04-02 05:50:44', '2014-04-03 16:05:19', '2e29b04f', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', '6e2b2a4ca778f34731d2013d6c220108bae634bb', 1, 1, '2ba88158aaea184af824f1bcd38ef564032208ad', '6e2b2a4ca778f34731d2013d6c220108bae634bb', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', 'f40cdec6.jpeg', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
