-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-10-16 10:46:57
-- 伺服器版本: 5.6.25
-- PHP 版本： 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ordersystem`
--

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menuId` int(11) NOT NULL COMMENT '菜單ID',
  `name` varchar(200) NOT NULL COMMENT '產品名稱',
  `firstClass` varchar(100) NOT NULL COMMENT '第一層分類',
  `supportStatus` int(1) unsigned NOT NULL COMMENT '產品支援狀態',
  `isCancel` smallint(1) NOT NULL COMMENT '是否取消販賣',
  `updateTime` datetime NOT NULL,
  `createTime` datetime NOT NULL,
  `classPrice1` int(11) NOT NULL,
  `className1` varchar(30) NOT NULL,
  `classPrice2` int(11) NOT NULL,
  `className2` varchar(30) NOT NULL,
  `classPrice3` int(11) NOT NULL,
  `className3` varchar(30) NOT NULL,
  `classPrice4` int(11) NOT NULL,
  `className4` varchar(30) NOT NULL,
  `classPrice5` int(11) NOT NULL,
  `className5` varchar(30) NOT NULL,
  `classPrice6` int(11) NOT NULL,
  `className6` varchar(30) NOT NULL,
  `classPrice7` int(11) NOT NULL,
  `className7` varchar(30) NOT NULL,
  `classPrice8` int(11) NOT NULL,
  `className8` varchar(30) NOT NULL,
  `classPrice9` int(11) NOT NULL,
  `className9` varchar(30) NOT NULL,
  `classPrice10` int(11) NOT NULL,
  `className10` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='菜單內容';

--
-- 資料表的匯出資料 `menu`
--

INSERT INTO `menu` (`menuId`, `name`, `firstClass`, `supportStatus`, `isCancel`, `updateTime`, `createTime`, `classPrice1`, `className1`, `classPrice2`, `className2`, `classPrice3`, `className3`, `classPrice4`, `className4`, `classPrice5`, `className5`, `classPrice6`, `className6`, `classPrice7`, `className7`, `classPrice8`, `className8`, `classPrice9`, `className9`, `classPrice10`, `className10`) VALUES
(1, '西瓜汁', '果汁', 0, 0, '2016-10-16 16:12:07', '0000-00-00 00:00:00', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(2, '-999', '化工', 0, 0, '2016-10-16 16:40:26', '2016-10-16 14:57:24', 312, '小', 32, '中', 100, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(3, '柳橙', '果汁', 0, 0, '2016-10-16 14:58:12', '2016-10-16 14:58:12', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(4, 'test1', 'test', 0, -1, '2016-10-16 15:25:42', '2016-10-16 15:00:11', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(5, 'test1', 'test', 0, 0, '2016-10-16 15:04:18', '2016-10-16 15:04:18', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(6, '頻果汁', 'A級', 0, 0, '2016-10-16 16:41:27', '2016-10-16 16:41:27', 0, '小', 55, '中', 0, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `menuId` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜單ID',AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
