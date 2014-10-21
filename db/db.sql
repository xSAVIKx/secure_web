-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2014 at 03:39 PM
-- Server version: 10.0.14-MariaDB-log
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `secure_web`
--
CREATE DATABASE IF NOT EXISTS `secure_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `secure_web`;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--
-- Creation: Oct 21, 2014 at 10:42 AM
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` char(128) NOT NULL,
  `set_time` char(10) NOT NULL,
  `data` text NOT NULL,
  `session_key` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `set_time`, `data`, `session_key`) VALUES
  ('slb1hll2ad92nqb2g5v4b6occ1vig7dbiaqa6ns7nnr3srvv3oqehg332000g7m68ia9u52a2nrnejg48mmes6gm8jmekrpgorujab1', '1413905950', 'vDHa77UehUuFzfgcRozNpKeFXQfFcMd3i7g/svbsmH8=', 'faaeda152d58f0cebbaa40e66010414171016a15d4e2a7f66b0c34ab5b47d4a038087055da4a05ae6c66746f93bd22a72792449840b03623a9e41b2873eb1553');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--
-- Creation: Oct 06, 2014 at 07:16 AM
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'website id',
  `title` varchar(100) DEFAULT NULL COMMENT 'website title',
  `url` varchar(256) NOT NULL COMMENT 'website URL'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Website table';

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `title`, `url`) VALUES
  (1, 'google', 'http://google.com/'),
  (2, 'gmail', 'http://gmail.com/'),
  (3, 'bashorg', 'http://bash.im');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Oct 08, 2014 at 06:42 AM
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'user ID',
  `name` char(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'user name',
  `password` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'user password'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='user table';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`) VALUES
  (9, 'test', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff'),
  (10, 'test1', 'b16ed7d24b3ecbd4164dcdad374e08c0ab7518aa07f9d3683f34c2b3c67a15830268cb4a56c1ff6f54c8e54a795f5b87c08668b51f82d0093f7baee7d2981181');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'website id',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'user ID',AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;