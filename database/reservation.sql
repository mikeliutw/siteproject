-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2019 年 11 月 25 日 17:36
-- 伺服器版本: 10.1.37-MariaDB
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `reservation`
--
CREATE DATABASE IF NOT EXISTS `reservation` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `reservation`;

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `accountid` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pw` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

--
-- 資料表的匯出資料 `account`
--

INSERT INTO `account` (`accountid`, `username`, `pw`, `name`, `email`) VALUES
(1, 'admin', '1234', 'administrator', 'taiwanliu@gmail.com'),
(5, 'test', '1234', 'test', 'taiwanliu@gmail.com'),
(4, 'mike', '123', 'JHIH-WEI LIU', 'taiwanliu@gmail.com');

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `category`
--

INSERT INTO `category` (`categoryid`, `category`, `createtime`) VALUES
(1, 'Japanese', '2019-11-25 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `memberid` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `members`
--

INSERT INTO `members` (`memberid`, `name`, `username`, `passwd`, `createtime`) VALUES
(1, 'mike', 'root', 'P@ssw0rd', '2019-11-25 23:13:33');

-- --------------------------------------------------------

--
-- 資料表結構 `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `reservationid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `people` int(11) NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `reservation`
--

INSERT INTO `reservation` (`reservationid`, `memberid`, `shopid`, `people`, `date`, `time`, `createtime`) VALUES
(1, 1, 2, 1, '1125', '1100', '2019-11-25 23:03:26');

-- --------------------------------------------------------

--
-- 資料表結構 `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `shopid` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `opentime` datetime NOT NULL,
  `categoryid` int(11) NOT NULL,
  `createtime` datetime NOT NULL,
  `peoplelimit` int(11) NOT NULL DEFAULT '100',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `shop`
--

INSERT INTO `shop` (`shopid`, `name`, `opentime`, `categoryid`, `createtime`, `peoplelimit`, `content`, `username`, `passwd`) VALUES
(2, '足立壽司', '0000-00-00 00:00:00', 1, '2019-11-25 00:00:00', 100, '足立壽司足立壽司足立壽司足立壽司足立壽司足立壽司足立壽司足立壽司足立壽司', 'zuli', 'zuli');

-- --------------------------------------------------------

--
-- 資料表結構 `shoptimetable`
--

DROP TABLE IF EXISTS `shoptimetable`;
CREATE TABLE `shoptimetable` (
  `shoptimetableid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `week` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `limitpeople` int(11) NOT NULL DEFAULT '50'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `webprofile`
--

DROP TABLE IF EXISTS `webprofile`;
CREATE TABLE `webprofile` (
  `webprofileid` int(11) NOT NULL,
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activityfile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activityname` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `webprofile`
--

INSERT INTO `webprofile` (`webprofileid`, `contact`, `name`, `activityfile`, `activityname`) VALUES
(1, '', '中原大學通識中心', 'https://cge.cycu.edu.tw/uploads/files/108-1manual.pdf', '108-1學期通識活動電子檔');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountid`);

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberid`);

--
-- 資料表索引 `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationid`);

--
-- 資料表索引 `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shopid`);

--
-- 資料表索引 `shoptimetable`
--
ALTER TABLE `shoptimetable`
  ADD PRIMARY KEY (`shoptimetableid`);

--
-- 資料表索引 `webprofile`
--
ALTER TABLE `webprofile`
  ADD PRIMARY KEY (`webprofileid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `accountid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `memberid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表 AUTO_INCREMENT `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表 AUTO_INCREMENT `shop`
--
ALTER TABLE `shop`
  MODIFY `shopid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表 AUTO_INCREMENT `shoptimetable`
--
ALTER TABLE `shoptimetable`
  MODIFY `shoptimetableid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `webprofile`
--
ALTER TABLE `webprofile`
  MODIFY `webprofileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
