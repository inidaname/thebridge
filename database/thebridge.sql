-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2016 at 08:10 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thebridge`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `surname` varchar(224) DEFAULT NULL,
  `othername` varchar(244) DEFAULT NULL,
  `picture` varchar(244) DEFAULT NULL,
  `gender` varchar(244) DEFAULT NULL,
  `marital` varchar(244) DEFAULT NULL,
  `tribe` varchar(244) DEFAULT NULL,
  `stateOrigin` varchar(244) DEFAULT NULL,
  `dateofbirth` varchar(244) DEFAULT NULL,
  `local_govt` varchar(244) DEFAULT NULL,
  `phone` varchar(244) DEFAULT NULL,
  `phone2` varchar(244) DEFAULT NULL,
  `email` varchar(244) DEFAULT NULL,
  `country` varchar(300) DEFAULT NULL,
  `res_address` text,
  `employment` varchar(244) DEFAULT NULL,
  `employer` varchar(244) DEFAULT NULL,
  `designation` varchar(244) DEFAULT NULL,
  `yearserved` varchar(244) DEFAULT NULL,
  `office_address` text,
  `locatthem` varchar(244) DEFAULT NULL,
  `accuracy` varchar(244) DEFAULT NULL,
  `UserAgent` varchar(244) DEFAULT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `surname`, `othername`, `picture`, `gender`, `marital`, `tribe`, `stateOrigin`, `dateofbirth`, `local_govt`, `phone`, `phone2`, `email`, `country`, `res_address`, `employment`, `employer`, `designation`, `yearserved`, `office_address`, `locatthem`, `accuracy`, `UserAgent`, `time_created`) VALUES
(1, 'Hassan', 'Sani', '53e9a77c19d79de4530194321943f31e.jpg', 'Male', 'Single', 'Nupe', 'Niger', 'Prefer Not To Mention', 'Local Govt', '08033189933', '08034271823', 'aleepac@yahoo.com', 'Nigeria', 'mhrftjvyr yrygfjh', 'Unemployed', '', '', '', 'jkhg,vkgjhnbvnnhg', 'Gordian Oranika Cl, Abuja, Nigeria', '12492', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', '2016-12-12 01:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE `user_auth` (
  `id` int(21) NOT NULL,
  `data` varchar(244) DEFAULT NULL,
  `user_auth` varchar(244) DEFAULT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_auth`
--

INSERT INTO `user_auth` (`id`, `data`, `user_auth`, `time_created`) VALUES
(1, '08033189933', '65a380418873845c742e0020f2a9c765', '2016-12-12 01:13:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_auth`
--
ALTER TABLE `user_auth`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
