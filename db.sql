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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='user table';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`) VALUES
  (7, 'user', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86');

--
-- Indexes for dumped tables
--

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
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'user ID',AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;