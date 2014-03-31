--
-- 数据库: `letsdate`
--
CREATE DATABASE IF NOT EXISTS `letsdate` DEFAULT  CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `letsdate`;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `passwd` char(50) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `is_phone_private` tinyint(1) NOT NULL DEFAULT '0',
  `location` text,
  `is_location_private` tinyint(1) NOT NULL DEFAULT '0',
  `intro` text,
  PRIMARY KEY (`email`)
);

-- --------------------------------------------------------

--
-- 表的结构 `date`
--

CREATE TABLE IF NOT EXISTS `date` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `begintime` datetime NOT NULL,
  `endtime` datetime DEFAULT NULL,
  `location` text,
  `bulletin` text,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`useremail`) REFERENCES `user` (`email`),
  KEY `useremail` (`useremail`)
);

-- --------------------------------------------------------

--
-- 表的结构 `datecomment`
--

CREATE TABLE IF NOT EXISTS `datecomment` (
  `id` int(11) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `comment` varchar(140) NOT NULL,
  FOREIGN KEY (`id`) REFERENCES `date` (`id`),
  KEY `id` (`id`)
);

-- --------------------------------------------------------

--
-- 表的结构 `datemember`
--

CREATE TABLE IF NOT EXISTS `datemember` (
  `id` int(11) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  FOREIGN KEY (`id`) REFERENCES `date` (`id`),
  KEY `id` (`id`)
);
