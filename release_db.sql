-- phpMyAdmin SQL Dump
-- version 4.0.9deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2014 at 10:52 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `7maru_comas`
--

INSERT INTO `7maru_comas` (`coma_id`, `author`, `name`, `title`, `description`, `created`, `modified`, `cover`) VALUES
(23, 'f06d488d', 'Sinh hoc lop 9', NULL, 'Sinh hoc lop 9                                    ', '2014-04-03 10:30:07', '2014-04-03 10:30:07', '2771751761.jpeg'),
(24, 'f06d488d', 'toan hoc lop 3', NULL, 'toan hoc lop 3', '2014-04-03 10:42:28', '2014-04-03 10:42:28', ''),
(25, 'f06d488d', 'bach khoa', NULL, 'bach khoa                                    ', '2014-04-03 14:09:25', '2014-04-03 14:09:25', '4280076951.jpeg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `7maru_coma_categories`
--

INSERT INTO `7maru_coma_categories` (`id`, `coma_id`, `category_id`, `created`, `modified`) VALUES
(40, 23, 5, '2014-04-03 10:30:07', '2014-04-03 10:30:07'),
(41, 24, 3, '2014-04-03 10:42:28', '2014-04-03 10:42:28'),
(43, 25, 5, '2014-04-03 14:09:25', '2014-04-03 14:09:25'),
(44, 25, 6, '2014-04-03 14:09:25', '2014-04-03 14:09:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `7maru_coma_transactions`
--

INSERT INTO `7maru_coma_transactions` (`transaction_id`, `coma_id`, `student_id`, `created`, `modified`) VALUES
(7, 25, 'f40cdec6', '2014-04-03 15:24:15', '2014-04-03 15:24:15'),
(8, 24, 'f40cdec6', '2014-04-03 16:12:07', '2014-04-03 16:12:07'),
(9, 23, 'f40cdec6', '2014-04-03 16:19:20', '2014-04-03 16:19:20'),
(10, 23, '72e67d29', '2014-04-07 07:21:39', '2014-04-07 07:21:39'),
(11, 25, '72e67d29', '2014-04-07 07:21:45', '2014-04-07 07:21:45'),
(12, 24, '72e67d29', '2014-04-07 07:22:06', '2014-04-07 07:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `7maru_comments`
--

CREATE TABLE IF NOT EXISTS `7maru_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(20) DEFAULT NULL,
  `coma_id` char(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `7maru_files`
--

CREATE TABLE IF NOT EXISTS `7maru_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `coma_id` int(11) DEFAULT NULL,
  `type` text CHARACTER SET ascii,
  `isTest` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2147483647 ;

--
-- Dumping data for table `7maru_files`
--

INSERT INTO `7maru_files` (`file_id`, `file_name`, `path`, `coma_id`, `type`, `isTest`, `created`, `modified`) VALUES
(4, 'db', '4eee56bf.swf', 24, 'pdf', NULL, '2014-04-03 10:42:28', '2014-04-03 10:42:28'),
(76, 'testfile', '76ebeb03.js', 24, 'tsv', 1, '2014-04-02 23:51:46', '2014-04-02 23:51:46'),
(2147483647, 'db', 'c59dda7c.swf', 25, 'pdf', NULL, '2014-04-03 14:09:26', '2014-04-03 14:09:26');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `7maru_rate_comas`
--

INSERT INTO `7maru_rate_comas` (`rate_id`, `coma_id`, `student_id`, `rate`, `created`, `modified`) VALUES
(1, 25, 'null', 3, '2014-04-03 16:19:04', '2014-04-03 16:19:04'),
(2, 23, 'f40cdec6', 4, '2014-04-03 16:19:18', '2014-04-03 16:19:18'),
(3, 24, 'null', 4, '2014-04-07 07:22:59', '2014-04-07 07:22:59'),
(4, 25, '72e67d29', 1, '2014-04-07 07:23:41', '2014-04-07 07:23:41');

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
('2e29b04f', '73890GFDHKJKLSD', 'high school', '2014-04-02 05:50:44', '2014-04-03 16:05:19'),
('e1b9f159', '12356767AFGDFREGDF', '1', '2014-04-07 07:20:17', '2014-04-07 07:20:17');

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
('72e67d29', 'dachoang', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', 'af04214ad5717122399d77fe878320fbdeb07bf1', 2, 'blood@yahoo.com', '01649635921', '2014-04-07 07:20:17', '2014-04-07 07:20:17', 'e1b9f159', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '0383cecedd8a58f07f94303eb906252c7f1682e3', 1, 1, 'af04214ad5717122399d77fe878320fbdeb07bf1', '0383cecedd8a58f07f94303eb906252c7f1682e3', '22ff4e41245742b3c4c626947c0b932e38dbe4d4', '72e67d29.jpeg', 0, 1),
('f06d488d', 'dac_123', 'dac', 'hoang', '1991-12-28', 'Linh Nam, Hoang Mai, Ha Noi', '6ced97670065d7bc4f2558f13a52108d1c2b0831', 1, 'hotada91@gmail.com', '01649635921', '2014-04-01 23:02:28', '2014-04-03 16:46:31', 'a924aafe', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', 1, 1, '6ced97670065d7bc4f2558f13a52108d1c2b0831', 'd71b1e2c1873ccd3c782260413e0e69942ba836b', '78d6ac1c6be3ea27864cf2dd4fbca6f257a8e0b3', 'f06d488d.jpeg', 0, 1),
('f40cdec6', 'bloodfire91', 'dac', 'hoang', '0000-00-00', 'Linh Nam, Hoang Mai, Ha Noi', '7662cb69c385d2dce8ac6b97e9fbc10f39a0ead1', 2, 'bloodfire345@gmail.com', '016291262023', '2014-04-02 05:50:44', '2014-04-03 16:05:19', '2e29b04f', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', '6e2b2a4ca778f34731d2013d6c220108bae634bb', 1, 1, '2ba88158aaea184af824f1bcd38ef564032208ad', '6e2b2a4ca778f34731d2013d6c220108bae634bb', '0154164cea946a00b7d20b44570bf6dd27cdc6c0', 'f40cdec6.jpeg', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
