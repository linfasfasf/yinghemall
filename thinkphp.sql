-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 12 月 11 日 10:06
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `thinkphp`
--
CREATE DATABASE IF NOT EXISTS `thinkphp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `thinkphp`;

-- --------------------------------------------------------

--
-- 表的结构 `guanyintea`
--

CREATE TABLE IF NOT EXISTS `guanyintea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `old_price` int(11) DEFAULT NULL,
  `new_price` int(11) DEFAULT NULL,
  `is_show` int(11) DEFAULT NULL,
  `subhead` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `product_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `guanyintea`
--

INSERT INTO `guanyintea` (`id`, `image_url`, `title`, `product_id`, `old_price`, `new_price`, `is_show`, `subhead`, `weight`, `product_num`) VALUES
(1, '001.jpg', '八马茶叶 浓香铁观音 安溪铁观音茶叶浓韵500 简装250g', 10001, 260, 259, 1, '经典之作 武夷原产地', 80, 100),
(2, '002.jpg', '八马茶业 铁观音 浓香型安溪铁观音茶叶特级赛珍珠高档礼盒装133g', 10002, 300, 208, 1, NULL, NULL, NULL),
(3, '003.jpg', '八马茶叶 浓香铁观音 安溪铁观音茶叶浓韵500 简装250g', 10003, 260, 259, 1, NULL, NULL, NULL),
(4, '004.jpg', '八马茶业 铁观音 浓香型安溪铁观音茶叶特级赛珍珠高档礼盒装133g', 10004, 300, 208, 1, NULL, NULL, NULL),
(5, '003.jpg', '八马茶叶 浓香铁观音 安溪铁观音茶叶浓韵500 简装250g', 10005, 260, 259, 1, NULL, NULL, NULL),
(6, '004.jpg', '八马茶业 铁观音 浓香型安溪铁观音茶叶特级赛珍珠高档礼盒装133g', 10006, 300, 208, 1, NULL, NULL, NULL),
(7, '004.jpg', '八马茶业 铁观音 浓香型安溪铁观音茶叶特级赛珍珠高档礼盒装133g', 10007, 300, 208, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'lero_lin', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `user_file`
--

CREATE TABLE IF NOT EXISTS `user_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(254) NOT NULL,
  `path` varchar(254) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `user_file`
--

INSERT INTO `user_file` (`id`, `username`, `path`, `filename`, `title`) VALUES
(4, 'lero_lin', 'D:/wamp/www/lero/1/Uploads/bojfy862', 'test.txt', '这个功能很好用'),
(8, 'lero_lin', 'D:/wamp/www/lero/1/Uploads/0e1604ws', 'doupocangqing.txt', '斗破苍穹');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
