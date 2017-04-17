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

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- INSERT INTO `admins` (`id`, `email`, `first_name`, `last_name`, `password`) VALUES (1, 'bw4@hotmail.it', 'Bahaa', 'Odeh', '827ccb0eea8a706c4c34a16891f84e7b');
ALTER TABLE `admins` ADD PRIMARY KEY (`id`);
ALTER TABLE `admins` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `configs` (
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

INSERT INTO `configs` (`id`, `title`, `url`, `keyword`, `description`, `site_name`, `site_status`, `close_msg`, `home_msg`, `home_ad`, `app_id`, `app_key`, `fb_page`, `reg_msg`, `reg_text`, `privacy`, `home_reg_msg`) VALUES(1, 'HlounPost3', 'http://localhost/post2/basic/web/', 'abc', 'abc', 'Hloun Post', 'open', '<p>abc</p>\r\n', '<p>Welcome To Hloun Post 3 Please Register Now !</p>\r\n', '<center><img src="https://placeholdit.imgix.net/~text?txtsize=40&txt=720x90+HOME+AD&w=720&h=90" /></center>', '1312682143593', 'c84324b8bf896d7707324c081', 'https://web.facebook.com/?_rdc=1&_rdr', '1', 'welcome to app', 'privacy', 'welcomex');
ALTER TABLE `configs`  ADD PRIMARY KEY (`id`);
ALTER TABLE `configs`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `pages` CHANGE `user_id` `user_id` INT NOT NULL;
ALTER TABLE `pages` CHANGE `page_id` `page_id` INT NOT NULL;
ALTER TABLE `pages` CHANGE `page_name` `page_name` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `pages` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;
UPDATE `posts` SET `date`=DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y/%m/%d %H:%i:%s');
ALTER TABLE `posts` CHANGE `date` `date` DATE NOT NULL;
ALTER TABLE `posts` CHANGE `is_shared` `is_shared` TEXT NOT NULL;
UPDATE `posts` set `is_shared` = 'no' WHERE `is_shared` = 0;
UPDATE `posts` set `is_shared` = 'yes' WHERE `is_shared` = 1;
ALTER TABLE `posts` CHANGE `is_shared` `is_shared` ENUM('no','yes') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `posts` CHANGE `text` `text` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `posts` CHANGE `type` `type` TEXT NOT NULL;
Update `posts` set type = 'text' where type=1;
Update `posts` set type = 'link' where type=2;
Update `posts` set type = 'image' where type=3;
ALTER TABLE `posts` CHANGE `type` `type` ENUM('text','link','image') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `posts` CHANGE `link` `link` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `posts` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;
ALTER TABLE `task` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;
ALTER TABLE `users` CHANGE `fb_gander` `fb_gender` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `users` ADD `birthday` TEXT NULL DEFAULT NULL AFTER `last_share`;
UPDATE `users` SET `reg_date`=DATE_FORMAT(FROM_UNIXTIME(`reg_date`), '%Y/%m/%d %H:%i:%s');
UPDATE `users` SET `last_login`=DATE_FORMAT(FROM_UNIXTIME(`last_login`), '%Y/%m/%d %H:%i:%s');
ALTER TABLE `users` CHANGE `reg_date` `reg_date` DATE NOT NULL;
ALTER TABLE `users` CHANGE `last_login` `last_login` DATE NOT NULL;
ALTER TABLE `users` CHANGE `fb_id` `fb_id` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `users` CHANGE `fb_name` `fb_name` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `users` CHANGE `fb_email` `fb_email` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `users` CHANGE `fb_access` `fb_access` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `users` CHANGE `fb_gender` `fb_gender` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `users` CHANGE `country_code` `country_code` TEXT CHARACTER SET utf8 COLLATE utf8_bin NULL;
ALTER TABLE `users` CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin;






update configs SET url = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "url") ,
                   title = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "title") ,
                   keyword = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "keyword") ,
                   description = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "des") ,
                   site_name = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "site_name") ,
                   close_msg = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "close_msg") ,
                   home_msg = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "home_msg") ,
                   home_ad = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "home_ad") ,
                   app_id = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "app_id") ,
                   app_key = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "app_key") ,
                   fb_page = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "fb_page") ,
                   privacy = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "privacy") ,
                   home_reg_msg = (SELECT convert(cast(convert(`value` using latin1) as binary) using utf8) FROM settings st WHERE st.option = "home_reg_msg");




insert into `admins` (`email`,`first_name`,`last_name`,`password`) VALUES  ( (SELECT `value` FROM settings st WHERE st.option = "admin_email"),(SELECT `value` FROM settings st WHERE st.option = "admin_name"),'admin',(SELECT `value` FROM settings st WHERE st.option = "admin_pass")  );



update `posts` set `text` = convert(cast(convert(`text` using latin1) as binary) using utf8) ;

update `users` set `fb_name` = convert(cast(convert(`fb_name` using latin1) as binary) using utf8) ;

