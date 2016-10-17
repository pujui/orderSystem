-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-17 11:03:19
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ordersystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='菜單內容';

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuId`, `name`, `firstClass`, `supportStatus`, `isCancel`, `updateTime`, `createTime`, `classPrice1`, `className1`, `classPrice2`, `className2`, `classPrice3`, `className3`, `classPrice4`, `className4`, `classPrice5`, `className5`, `classPrice6`, `className6`, `classPrice7`, `className7`, `classPrice8`, `className8`, `classPrice9`, `className9`, `classPrice10`, `className10`) VALUES
(1, '西瓜汁', '新鮮現打果汁', 0, 0, '2016-10-17 09:17:38', '2016-10-17 09:17:38', 0, '小', 0, '中', 30, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(2, '蜂蜜檸檬', '檸檬', 0, 0, '2016-10-17 09:21:35', '2016-10-17 09:18:08', 0, '小', 0, '中', 35, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(3, '金桔檸檬', '檸檬', 0, 0, '2016-10-17 09:21:39', '2016-10-17 09:18:52', 0, '小', 0, '中', 35, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(4, '西瓜牛奶', '牛奶', 0, 0, '2016-10-17 11:12:38', '2016-10-17 09:19:06', 0, '小', 0, '中', 40, '大', 35, '折價-5', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(5, '木瓜牛奶', '牛奶', 0, 0, '2016-10-17 09:21:15', '2016-10-17 09:19:49', 0, '小', 0, '中', 40, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(6, '酪梨牛奶', '牛奶', 0, 0, '2016-10-17 09:21:18', '2016-10-17 09:20:43', 0, '小', 0, '中', 65, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(7, '蘋果蔓越莓', '新鮮現打果汁', 0, 0, '2016-10-17 09:22:16', '2016-10-17 09:22:16', 0, '小', 0, '中', 50, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(8, '蘋果奇異果', '新鮮現打果汁', 0, 0, '2016-10-17 09:22:40', '2016-10-17 09:22:40', 0, '小', 0, '中', 50, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(9, '蘋果牛奶', '牛奶', 0, 0, '2016-10-17 09:23:11', '2016-10-17 09:23:11', 0, '小', 0, '中', 40, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(10, '藍莓牛奶', '牛奶', 0, 0, '2016-10-17 09:23:24', '2016-10-17 09:23:24', 0, '小', 0, '中', 70, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(11, '香蕉牛奶', '牛奶', 0, 0, '2016-10-17 09:23:37', '2016-10-17 09:23:37', 0, '小', 0, '中', 40, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(12, '奇異果果汁', '新鮮現打果汁', 0, 0, '2016-10-17 09:23:55', '2016-10-17 09:23:55', 0, '小', 0, '中', 35, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(13, '柳橙奇異果', '新鮮現打果汁', 0, 0, '2016-10-17 09:24:26', '2016-10-17 09:24:26', 0, '小', 0, '中', 50, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(14, '蘋果柳橙', '新鮮現打果汁', 0, 0, '2016-10-17 09:24:45', '2016-10-17 09:24:45', 0, '小', 0, '中', 50, '大', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
`orderDetailId` int(10) unsigned NOT NULL,
  `orderId` int(10) unsigned NOT NULL,
  `menuId` int(11) NOT NULL,
  `price` int(1) NOT NULL,
  `itemCount` int(1) unsigned NOT NULL,
  `itemTotal` int(1) unsigned NOT NULL,
  `status` smallint(1) unsigned NOT NULL,
  `createTime` datetime NOT NULL,
  `updateTime` datetime NOT NULL,
  `memo` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='訂單明細';

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderDetailId`, `orderId`, `menuId`, `price`, `itemCount`, `itemTotal`, `status`, `createTime`, `updateTime`, `memo`) VALUES
(1, 1, 6, 65, 6, 390, 0, '2016-10-17 16:03:20', '0000-00-00 00:00:00', '酪梨牛奶 大 無糖無冰'),
(2, 1, 12, 35, 3, 105, 0, '2016-10-17 16:03:20', '0000-00-00 00:00:00', '奇異果果汁 大 中糖中冰'),
(3, 1, 14, 50, 1, 50, 0, '2016-10-17 16:03:20', '0000-00-00 00:00:00', '蘋果柳橙 大 正糖正冰'),
(4, 1, 4, 40, 11, 440, 0, '2016-10-17 16:03:20', '0000-00-00 00:00:00', '西瓜牛奶 大 正糖正冰'),
(5, 1, 5, 40, 6, 240, 0, '2016-10-17 16:03:20', '0000-00-00 00:00:00', '木瓜牛奶 大 正糖中冰'),
(6, 1, 4, 35, 1, 35, 0, '2016-10-17 16:03:20', '0000-00-00 00:00:00', '西瓜牛奶 折價-5 正糖正冰'),
(7, 2, 6, 65, 6, 390, 0, '2016-10-17 16:04:42', '0000-00-00 00:00:00', '酪梨牛奶 大 無糖無冰'),
(8, 2, 12, 35, 3, 105, 0, '2016-10-17 16:04:42', '0000-00-00 00:00:00', '奇異果果汁 大 中糖中冰'),
(9, 2, 14, 50, 1, 50, 0, '2016-10-17 16:04:42', '0000-00-00 00:00:00', '蘋果柳橙 大 正糖正冰'),
(10, 2, 4, 40, 11, 440, 0, '2016-10-17 16:04:42', '0000-00-00 00:00:00', '西瓜牛奶 大 正糖正冰'),
(11, 2, 5, 40, 6, 240, 0, '2016-10-17 16:04:42', '0000-00-00 00:00:00', '木瓜牛奶 大 正糖中冰'),
(12, 2, 4, 35, 1, 35, 0, '2016-10-17 16:04:42', '0000-00-00 00:00:00', '西瓜牛奶 折價-5 正糖正冰'),
(13, 3, 4, 35, 1, 35, 0, '2016-10-17 16:12:06', '0000-00-00 00:00:00', '西瓜牛奶 折價-5 正糖正冰'),
(14, 3, 5, 40, 1, 40, 0, '2016-10-17 16:12:06', '0000-00-00 00:00:00', '木瓜牛奶 大 正糖正冰'),
(15, 4, 9, 40, 11, 440, 0, '2016-10-17 16:12:22', '0000-00-00 00:00:00', '蘋果牛奶 大 無糖無冰');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE IF NOT EXISTS `orderlist` (
`orderId` int(10) unsigned NOT NULL,
  `creater` int(10) unsigned NOT NULL,
  `priceTotal` int(1) NOT NULL,
  `createTime` datetime NOT NULL,
  `updateTime` datetime NOT NULL,
  `status` smallint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='訂單列表';

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`orderId`, `creater`, `priceTotal`, `createTime`, `updateTime`, `status`) VALUES
(1, 1, 1260, '2016-10-17 16:03:20', '0000-00-00 00:00:00', 0),
(2, 1, 1260, '2016-10-17 16:04:42', '0000-00-00 00:00:00', 0),
(3, 1, 75, '2016-10-17 16:12:06', '0000-00-00 00:00:00', 0),
(4, 1, 440, '2016-10-17 16:12:22', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userId` int(10) unsigned NOT NULL,
  `account` varchar(50) NOT NULL COMMENT '帳號',
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `password` varchar(100) NOT NULL COMMENT '密碼',
  `privateKey` varchar(100) NOT NULL COMMENT '私用key',
  `createTime` datetime NOT NULL COMMENT '建立時間',
  `isActive` smallint(1) NOT NULL COMMENT '-1 刪除, 0 未啟用, 1 啟用, 2 管理者',
  `updateTime` datetime NOT NULL COMMENT '最後活動時間'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='使用者資料表';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `account`, `name`, `password`, `privateKey`, `createTime`, `isActive`, `updateTime`) VALUES
(1, 'root001', 'root', '20e5629ef82a8b4486f4081a98cff52a79e28c5c', 'asdfqwe', '2016-10-17 00:00:00', 2, '2016-10-17 09:10:18'),
(2, 'EP001', 'employee', '90390fd6538309165393a13e485e08f98bba9160', 'asdfqwe', '2016-10-17 09:13:38', 1, '2016-10-17 09:13:38'),
(3, 'wqd', 'qwe', '4e33a6e1a4008ea404095bb31c55761383b2d36a', 'asdfqwe', '2016-10-17 14:28:31', 0, '2016-10-17 14:28:37'),
(4, '4324', '4324', 'aa16e46a2cacaa37e11091b6706db21c09a92169', 'asdfqwe', '2016-10-17 14:31:16', 0, '2016-10-17 14:31:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`menuId`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
 ADD PRIMARY KEY (`orderDetailId`), ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
 ADD PRIMARY KEY (`orderId`), ADD KEY `createTime` (`createTime`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userId`), ADD UNIQUE KEY `account` (`account`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `menuId` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜單ID',AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
MODIFY `orderDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
MODIFY `orderId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
