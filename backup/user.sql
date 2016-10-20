-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-10-16 10:47:15
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
-- 資料表結構 `user`
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
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`userId`, `account`, `name`, `password`, `privateKey`, `createTime`, `isActive`, `updateTime`) VALUES
(1, '001', 'I''m Root', 'a99c8d5d5c0380b4e1d20f12019b04e94973ffee', 'asdfqwe', '2016-10-15 00:00:00', 2, '2016-10-16 16:44:58'),
(2, '002', '002', '73cd00e8f48330cfaa5fe84bff9435c5a35a78d8', 'asdfqwe', '2016-10-15 23:02:25', 1, '2016-10-16 10:51:27'),
(3, '003', '003', 'ccfcbc84fe936db9548b5e61b7483d12b90c23d0', 'asdfqwe', '2016-10-15 23:09:42', 0, '2016-10-15 23:09:42'),
(4, '004', '004', '504183d92ff1cd4f4456fc08d2f173eb6591079f', 'asdfqwe', '2016-10-15 23:39:19', 1, '2016-10-15 23:39:19');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `account` (`account`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
