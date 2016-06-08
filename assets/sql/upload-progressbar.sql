-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2016 at 06:18 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `upload-progressbar`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL,
  `src` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `src`, `date`) VALUES
(1, 'assets/images/0x14653583621.png', '2016-06-08 05:59:22'),
(2, 'assets/images/0x14653583622.jpg', '2016-06-08 05:59:23'),
(3, 'assets/images/0x14653583623.png', '2016-06-08 05:59:23'),
(4, 'assets/images/0x14653583624.jpg', '2016-06-08 05:59:23'),
(5, 'assets/images/0x14653583625.png', '2016-06-08 05:59:23'),
(6, 'assets/images/0x14653583626.jpg', '2016-06-08 05:59:23'),
(7, 'assets/images/0x14653583627.png', '2016-06-08 05:59:23'),
(8, 'assets/images/0x14653583628.jpg', '2016-06-08 05:59:23'),
(9, 'assets/images/0x14653583629.png', '2016-06-08 05:59:23'),
(10, 'assets/images/0x146535836210.jpg', '2016-06-08 05:59:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
