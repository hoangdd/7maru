-- phpMyAdmin SQL Dump
-- version 4.0.9deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2014 at 12:08 AM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
