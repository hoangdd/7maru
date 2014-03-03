-- phpMyAdmin SQL Dump
-- version 4.0.9deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 12:10 AM
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
(1, 'văn học', NULL, NULL, NULL),
(2, 'Toán học', NULL, NULL, NULL),
(3, '数学', NULL, NULL, NULL),
(4, '科学', NULL, NULL, NULL),
(5, '生理学', NULL, NULL, NULL),
(6, '物理学', '', NULL, NULL),
(7, '地理学', NULL, NULL, NULL),
(8, '歴史', '歴史', NULL, NULL),
(9, '化学', '化学', NULL, NULL),
(10, '歌学', NULL, NULL, NULL),
(11, '画学', NULL, NULL, NULL),
(12, 'Lớp 1', NULL, NULL, NULL),
(13, 'Lớp 2', NULL, NULL, NULL),
(14, 'Lớp 3', NULL, NULL, NULL),
(15, 'Lớp 4', NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `7maru_comas`
--

INSERT INTO `7maru_comas` (`coma_id`, `author`, `name`, `title`, `description`, `created`, `modified`, `cover`) VALUES
(3, NULL, 'De hoc tot toan', 'cung nhau hoc ', 'lalalalalala', NULL, NULL, 'toan.png'),
(4, NULL, 'De hoc tot van', 'Van hoc nghe thuat', 'Gianh cho lua tuoi 18+.\r\nCuon sach ghi lai nhung thoi diem thang hoa cua cac tac gia tre. ', NULL, NULL, 'vanhoc.png'),
(5, NULL, 'De men phieu luu ki', 'tu sach thieu nhi', 'sach gianh cho lua tuoi 18-, \nCu?c phiêu l?u c?a chú d? 18+\n???????', NULL, NULL, 'demen.png'),
(6, NULL, 'Tay du ki', 'Tieu thuyet kinh dien', 'Đường tăng thiển kinh \r\n小説', NULL, NULL, 'tayduki.png'),
(7, NULL, 'Sherlock Holmes', 'Truyện trinh thám ', 'Tiểu thuyết hồi hộp gay cấn đến phút chót ', NULL, NULL, 'holme.png'),
(8, NULL, 'Tâm sinh lý tuổi dậy thì', 'Tâm sinh lý', 'Đề tài nóng bỏng', NULL, NULL, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `7maru_coma_categories`
--

INSERT INTO `7maru_coma_categories` (`id`, `coma_id`, `category_id`, `created`, `modified`) VALUES
(1, 1, 3, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 3, 4, NULL, NULL),
(6, 3, 6, NULL, NULL),
(7, 4, 6, NULL, NULL),
(8, 4, 7, NULL, NULL),
(9, 4, 12, NULL, NULL),
(10, 4, 13, NULL, NULL),
(11, 5, 11, NULL, NULL),
(12, 5, 12, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `7maru_coma_transactions`
--

INSERT INTO `7maru_coma_transactions` (`transaction_id`, `coma_id`, `student_id`, `created`, `modified`) VALUES
(1, 3, '2', NULL, NULL),
(2, 4, '1', NULL, NULL),
(3, 5, '2', NULL, NULL),
(4, 6, '3', NULL, NULL),
(5, 3, '2', NULL, NULL),
(6, 3, '4', NULL, NULL),
(7, 4, '5', NULL, NULL),
(8, 4, '6', NULL, NULL),
(9, 5, '4', NULL, NULL),
(10, 6, '4', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `7maru_comments`
--

INSERT INTO `7maru_comments` (`comment_id`, `user_id`, `coma_id`, `created`, `modified`, `content`) VALUES
(1, '1', '3', NULL, NULL, 'bai nay hay vl'),
(2, '1', '4', NULL, NULL, 'bai nay cung hay vl'),
(3, '2', '6', NULL, NULL, 'qua hay'),
(4, '3', '7', NULL, NULL, 'ngon'),
(5, '3', '5', NULL, NULL, 'qua ngon '),
(6, '4', '4', NULL, NULL, 'qua tuyet voi'),
(7, '6', '8', NULL, NULL, 'nuot');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `7maru_rate_comas`
--

INSERT INTO `7maru_rate_comas` (`rate_id`, `coma_id`, `student_id`, `rate`, `created`, `modified`) VALUES
(1, 3, '2', 1, NULL, NULL),
(2, 4, '3', 4, NULL, NULL),
(3, 5, '3', 4, NULL, NULL),
(4, 6, '3', 2, NULL, NULL);

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
('1', '92834DFKJSNOFOKSDF', '2', NULL, NULL),
('2', 'KJDKFLSKĐ23433', '3', NULL, NULL),
('3', '734JJGJHBDJSGFYU', '5', NULL, NULL),
('4', 'JNJDAKSDNIUJNKJDKJ', '3', NULL, NULL);

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
('1', 'JDBF874594id', 'HUST', 'giang day bo mon tam sinh ly', NULL, NULL),
('2', 'SDSBDFUYSHUDSN857678', 'NUDE', 'Giao duc gioi tinh', NULL, NULL),
('3', '636jhFGJBJH', 'NUC', 'Day co khi dong luc hoc', NULL, NULL),
('4', '3454HUKJKBJH', 'FPT', '4 nam kinh nghiem', NULL, NULL);

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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
