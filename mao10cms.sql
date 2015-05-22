-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 19 日 03:04
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mao10cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `mc_action`
--

CREATE TABLE IF NOT EXISTS `mc_action` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `action_key` varchar(20) DEFAULT NULL,
  `action_value` text,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `mc_action`
--

INSERT INTO `mc_action` (`id`, `page_id`, `user_id`, `action_key`, `action_value`, `date`) VALUES
(1, 1, 1, 'trend', '0', 1432001503),
(2, 2, 2, 'ip', '127.0.0.1', 1432001688),
(3, 2, 2, 'trend', '0', 1432001693),
(4, 3, 3, 'ip', '127.0.0.1', 1432001809),
(10, 3, 3, 'trend', '0', 1432003956),
(6, 5, 3, 'perform', 'xihuan', 1432003074),
(7, 3, 3, 'coins', '3', 1432003171),
(11, 6, 1, 'publish', '', 1432004171);

-- --------------------------------------------------------

--
-- 表的结构 `mc_attached`
--

CREATE TABLE IF NOT EXISTS `mc_attached` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `src` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mc_meta`
--

CREATE TABLE IF NOT EXISTS `mc_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned DEFAULT NULL,
  `meta_key` varchar(20) DEFAULT NULL,
  `meta_value` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `mc_meta`
--

INSERT INTO `mc_meta` (`id`, `page_id`, `meta_key`, `meta_value`, `type`) VALUES
(1, 1, 'user_name', 'admin', 'user'),
(2, 1, 'user_pass', 'e41803ae2c20906e5119454dfc09a5ad', 'user'),
(3, 1, 'user_email', '', 'user'),
(4, 1, 'user_level', '10', 'user'),
(5, 2, 'user_name', '1@qq.com', 'user'),
(6, 2, 'user_pass', 'e1ca59907e9bd19f28bbd35c22ce8a5d', 'user'),
(7, 2, 'user_email', NULL, 'user'),
(8, 2, 'user_level', '1', 'user'),
(9, 3, 'user_name', '2', 'user'),
(10, 3, 'user_pass', '2641729751bfc2dd6afc037211fbaeef', 'user'),
(11, 3, 'user_email', NULL, 'user'),
(12, 3, 'user_level', '1', 'user'),
(13, 5, 'views', '1', 'basic'),
(14, 3, 'views', '7', 'basic'),
(15, 3, 'coins', '3', 'user'),
(16, 4, 'views', '3', 'basic'),
(17, 6, 'term', '', 'basic'),
(18, NULL, 'kucun', '10', 'basic'),
(19, NULL, 'price-old', '1', 'basic'),
(20, 6, 'xiaoliang', '10', 'basic'),
(21, 6, 'tb_name', '10', 'basic'),
(22, 6, 'price', '10', 'basic'),
(23, 6, 'author', '1', 'basic'),
(24, 6, 'views', '2', 'basic');

-- --------------------------------------------------------

--
-- 表的结构 `mc_option`
--

CREATE TABLE IF NOT EXISTS `mc_option` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(20) DEFAULT NULL,
  `meta_value` text,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `mc_option`
--

INSERT INTO `mc_option` (`id`, `meta_key`, `meta_value`, `type`) VALUES
(1, 'site_url', 'http://localhost/mao10cms', 'public'),
(2, 'site_name', 'Mao10CMS', 'public'),
(3, 'site_key', '1381908450', 'public'),
(4, 'theme', 'default', 'public'),
(5, 'page_size', '10', 'public'),
(6, 'site_version', '3.3', 'public');

-- --------------------------------------------------------

--
-- 表的结构 `mc_page`
--

CREATE TABLE IF NOT EXISTS `mc_page` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text,
  `content` longtext,
  `type` varchar(20) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `mc_page`
--

INSERT INTO `mc_page` (`id`, `title`, `content`, `type`, `date`) VALUES
(1, 'admin', '', 'user', 1432001431),
(2, '1@qq.com', '', 'user', 1432001688),
(3, '2', '', 'pro', 1432001809),
(4, '100', '2100', 'pro', NULL),
(5, 'fsdgsd', 'fgsad', 'article', NULL),
(6, '1111', '在这里添加商品的详细描述', 'pro', 1432004171);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
