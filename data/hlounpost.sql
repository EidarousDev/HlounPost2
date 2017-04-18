-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2017 at 01:01 AM
-- Server version: 5.7.17-0ubuntu0.16.04.2
-- PHP Version: 5.6.30-7+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hlounpost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `first_name`, `last_name`, `password`) VALUES
(1, 'bw4@hotmail.it', 'Bahaa', 'Odeh', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `keyword` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `site_name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `site_status` enum('open','close') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `close_msg` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `home_msg` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `home_ad` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `app_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `app_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fb_page` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `reg_msg` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `reg_text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `privacy` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `home_reg_msg` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `title`, `url`, `keyword`, `description`, `site_name`, `site_status`, `close_msg`, `home_msg`, `home_ad`, `app_id`, `app_key`, `fb_page`, `reg_msg`, `reg_text`, `privacy`, `home_reg_msg`) VALUES
(1, 'HlounPost3', 'http://localhost/post2/basic/web/', 'abc', 'abc', 'Hloun Post', 'open', '<p>abc</p>\r\n', '<p>Welcome To Hloun Post 3 Please Register Now !</p>\r\n', '<center><img src="https://placeholdit.imgix.net/~text?txtsize=40&txt=720x90+HOME+AD&w=720&h=90" /></center>', '1312689062143593', 'c8444c79c4324b8bf896d7707324c081', 'https://web.facebook.com/?_rdc=1&_rdr', '1', 'welcome to app', '<p><strong>Personal identification information</strong></p>\r\n\r\n<p>We may collect personal identification information from Users in a variety of ways, including</p>\r\n\r\n<p>, but not limited to, when Users visit our site, register on the site, and in connection with other activities,</p>\r\n\r\n<p>&nbsp;services, features or resources we make available on our Site. Users may be asked for, as appropriate,</p>\r\n\r\n<p>&nbsp;name, email address. We will collect personal identification information from Users only if they voluntarily</p>\r\n\r\n<p>submit such information to us. Users can always refuse to supply personally identification information</p>\r\n\r\n<p>, except that it may prevent them from engaging in certain Site related activities.Non-personal</p>\r\n\r\n<p>&nbsp;<strong>identification information</strong></p>\r\n\r\n<p>We may collect non-personal identification information about Users</p>\r\n\r\n<p>&nbsp;whenever they interact with our Site. Non-personal identification information may include the browser name,</p>\r\n\r\n<p>&nbsp;the type of computer and technical information about Users means of connection to our Site,</p>\r\n\r\n<p>such as the operating system and the</p>\r\n\r\n<p>&nbsp;Internet service providers utilized and other similar information.</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n', 'welcomex');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `page_name` varchar(500) COLLATE utf8_bin NOT NULL,
  `last_share` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `date` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` enum('text','link','image') COLLATE utf8_bin NOT NULL,
  `is_shared` enum('yes','no') COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `link` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------
--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `time` text NOT NULL,
  `posts` text NOT NULL,
  `count` text NOT NULL,
  `gander` text NOT NULL,
  `isfinish` int(11) NOT NULL,
  `idnow` int(11) NOT NULL,
  `taskfor` text NOT NULL,
  `totalcount` int(11) NOT NULL,
  `successed` int(11) NOT NULL,
  `failed` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fb_id` text COLLATE utf8_bin NOT NULL,
  `fb_name` text COLLATE utf8_bin NOT NULL,
  `fb_email` text COLLATE utf8_bin NOT NULL,
  `fb_access` text COLLATE utf8_bin NOT NULL,
  `fb_gender` text COLLATE utf8_bin NOT NULL,
  `reg_date` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `country_code` text COLLATE utf8_bin,
  `last_share` int(11) NOT NULL,
  `birthday` text COLLATE utf8_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;