-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: 2016 年 10 月 19 日 20:51
-- 伺服器版本: 5.5.52-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `ordersystem`
--

-- --------------------------------------------------------

--
-- 資料表結構 `extramenu`
--

CREATE TABLE IF NOT EXISTS `extramenu` (
  `extraId` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `className` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `selected` smallint(1) NOT NULL COMMENT '1預設值',
  `price` int(11) NOT NULL,
  PRIMARY KEY (`extraId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='額外選項' AUTO_INCREMENT=36 ;

--
-- 資料表的匯出資料 `extramenu`
--

INSERT INTO `extramenu` (`extraId`, `className`, `name`, `selected`, `price`) VALUES
(1, 'ice', '正常', 1, 0),
(2, 'ice', '多冰', 0, 0),
(3, 'ice', '少冰', 0, 0),
(4, 'ice', '微冰', 0, 0),
(5, 'ice', '去冰', 0, 0),
(6, 'ice', '', 0, 0),
(7, 'ice', '', 0, 0),
(8, 'ice', '', 0, 0),
(9, 'ice', '', 0, 0),
(10, 'ice', '', 0, 0),
(11, 'sugar', '正常', 1, 0),
(12, 'sugar', '半糖', 0, 0),
(13, 'sugar', '少糖', 0, 0),
(14, 'sugar', '微糖', 0, 0),
(15, 'sugar', '無糖', 0, 0),
(16, 'sugar', '', 0, 0),
(17, 'sugar', '', 0, 0),
(18, 'sugar', '', 0, 0),
(19, 'sugar', '', 0, 0),
(20, 'sugar', '', 0, 0),
(21, 'extra', '少蜂蜜', 0, 0),
(22, 'extra', '去蜂蜜', 0, 0),
(23, 'extra', '加蜂蜜', 0, 0),
(24, 'extra', '酸一點', 0, 0),
(25, 'extra', '全奶+10', 0, 10),
(26, 'extra', '加牛奶+10', 0, 10),
(27, 'extra', '加布丁+15', 0, 15),
(28, 'extra', '去布丁', 0, 0),
(29, 'extra', '去牛奶-10', 0, -10),
(30, 'extra', '去牛奶-5', 0, -5),
(31, 'extra', '', 0, 0),
(32, 'extra', '', 0, 0),
(33, 'extra', '', 0, 0),
(34, 'extra', '', 0, 0),
(35, 'extra', '', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menuId` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜單ID',
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
  `className10` varchar(30) NOT NULL,
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='菜單內容' AUTO_INCREMENT=18 ;

--
-- 資料表的匯出資料 `menu`
--

INSERT INTO `menu` (`menuId`, `name`, `firstClass`, `supportStatus`, `isCancel`, `updateTime`, `createTime`, `classPrice1`, `className1`, `classPrice2`, `className2`, `classPrice3`, `className3`, `classPrice4`, `className4`, `classPrice5`, `className5`, `classPrice6`, `className6`, `classPrice7`, `className7`, `classPrice8`, `className8`, `classPrice9`, `className9`, `classPrice10`, `className10`) VALUES
(1, '西瓜汁', '新鮮現打果汁', 0, 0, '2016-10-19 17:48:11', '2016-10-17 09:17:38', 30, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(2, '蜂蜜檸檬', '檸檬', 0, 0, '2016-10-19 17:47:43', '2016-10-17 09:18:08', 35, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(3, '金桔檸檬', '檸檬', 0, 0, '2016-10-19 17:47:55', '2016-10-17 09:18:52', 35, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(4, '西瓜牛奶', '牛奶', 0, 0, '2016-10-19 17:43:49', '2016-10-17 09:19:06', 40, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(5, '木瓜牛奶', '牛奶', 0, 0, '2016-10-19 17:44:24', '2016-10-17 09:19:49', 40, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(6, '酪梨牛奶', '牛奶', 0, 0, '2016-10-19 17:44:37', '2016-10-17 09:20:43', 65, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(7, '蘋果蔓越莓', '新鮮現打果汁', 0, 0, '2016-10-19 17:48:37', '2016-10-17 09:22:16', 50, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(8, '蘋果奇異果', '新鮮現打果汁', 0, 0, '2016-10-19 17:49:05', '2016-10-17 09:22:40', 50, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(9, '蘋果牛奶', '牛奶', 0, 0, '2016-10-19 17:44:58', '2016-10-17 09:23:11', 40, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(10, '藍莓牛奶', '牛奶', 0, 0, '2016-10-19 17:45:15', '2016-10-17 09:23:24', 70, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(11, '香蕉牛奶', '牛奶', 0, 0, '2016-10-19 17:45:34', '2016-10-17 09:23:37', 40, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(12, '奇異果汁', '新鮮現打果汁', 0, 0, '2016-10-19 17:49:39', '2016-10-17 09:23:55', 35, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(13, '柳橙奇異果', '新鮮現打果汁', 0, 0, '2016-10-19 17:50:08', '2016-10-17 09:24:26', 50, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(14, '蘋果柳橙', '新鮮現打果汁', 0, 0, '2016-10-19 17:50:31', '2016-10-17 09:24:45', 50, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(15, '鳳梨蘋果牛奶', '牛奶', 0, 0, '2016-10-19 17:47:03', '2016-10-19 17:47:03', 40, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(16, '芭樂汁', '新鮮現打果汁', 0, 0, '2016-10-19 17:51:32', '2016-10-19 17:51:32', 40, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(17, '柳丁原汁', '新鮮現打果汁', 0, 0, '2016-10-19 17:52:00', '2016-10-19 17:52:00', 60, '(', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `orderDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(10) unsigned NOT NULL,
  `menuId` int(11) NOT NULL,
  `price` int(1) NOT NULL COMMENT '價錢',
  `itemCount` int(1) unsigned NOT NULL,
  `itemTotal` int(1) unsigned NOT NULL,
  `status` smallint(1) unsigned NOT NULL COMMENT '處理狀態 0 未處理, 1已處理完畢',
  `createTime` datetime NOT NULL,
  `updateTime` datetime NOT NULL,
  `memo` varchar(200) NOT NULL COMMENT '備註',
  PRIMARY KEY (`orderDetailId`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='訂單明細' AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `orderdetail`
--

INSERT INTO `orderdetail` (`orderDetailId`, `orderId`, `menuId`, `price`, `itemCount`, `itemTotal`, `status`, `createTime`, `updateTime`, `memo`) VALUES
(1, 1, 4, 30, 3, 90, 0, '2016-10-19 17:15:07', '0000-00-00 00:00:00', '西瓜牛奶 半糖多冰 去牛奶-10'),
(2, 2, 6, 75, 1, 75, 0, '2016-10-19 17:59:05', '0000-00-00 00:00:00', '酪梨牛奶 半糖微冰 全奶+10'),
(3, 3, 6, 75, 4, 300, 0, '2016-10-19 18:10:34', '0000-00-00 00:00:00', '酪梨牛奶 正常正常 全奶+10');

-- --------------------------------------------------------

--
-- 資料表結構 `orderlist`
--

CREATE TABLE IF NOT EXISTS `orderlist` (
  `orderId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '訂單號碼',
  `todayOrderNo` varchar(13) NOT NULL COMMENT '20160821O0001',
  `creater` int(10) unsigned NOT NULL COMMENT '建立者',
  `priceTotal` int(1) NOT NULL COMMENT '總價錢',
  `createTime` datetime NOT NULL,
  `updateTime` datetime NOT NULL,
  `status` smallint(1) NOT NULL COMMENT '處理狀態 0取消訂單, 1訂單成立',
  PRIMARY KEY (`orderId`),
  KEY `createTime` (`createTime`),
  KEY `todayOrderNo` (`todayOrderNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='訂單列表' AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `orderlist`
--

INSERT INTO `orderlist` (`orderId`, `todayOrderNo`, `creater`, `priceTotal`, `createTime`, `updateTime`, `status`) VALUES
(1, '20161019O0001', 1, 90, '2016-10-19 17:15:07', '0000-00-00 00:00:00', 1),
(2, '20161019O0002', 1, 75, '2016-10-19 17:59:05', '0000-00-00 00:00:00', 1),
(3, '20161019O0003', 1, 300, '2016-10-19 18:10:34', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL COMMENT '帳號',
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `password` varchar(100) NOT NULL COMMENT '密碼',
  `privateKey` varchar(100) NOT NULL COMMENT '私用key',
  `createTime` datetime NOT NULL COMMENT '建立時間',
  `isActive` smallint(1) NOT NULL COMMENT '-1 刪除, 0 未啟用, 1 啟用, 2 管理者',
  `updateTime` datetime NOT NULL COMMENT '最後活動時間',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='使用者資料表' AUTO_INCREMENT=5 ;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`userId`, `account`, `name`, `password`, `privateKey`, `createTime`, `isActive`, `updateTime`) VALUES
(1, 'root001', 'root', '20e5629ef82a8b4486f4081a98cff52a79e28c5c', 'asdfqwe', '2016-10-17 00:00:00', 2, '2016-10-17 09:10:18'),
(2, 'EP001', 'employee', '90390fd6538309165393a13e485e08f98bba9160', 'asdfqwe', '2016-10-17 09:13:38', 1, '2016-10-17 09:13:38'),
(3, 'wqd', 'qwe', '4e33a6e1a4008ea404095bb31c55761383b2d36a', 'asdfqwe', '2016-10-17 14:28:31', 0, '2016-10-17 14:28:37'),
(4, '4324', '4324', 'aa16e46a2cacaa37e11091b6706db21c09a92169', 'asdfqwe', '2016-10-17 14:31:16', 0, '2016-10-17 14:31:16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
