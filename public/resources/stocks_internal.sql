-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране:  6 ное 2022 в 11:13
-- Версия на сървъра: 5.7.36
-- Версия на PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `kppz`
--

-- --------------------------------------------------------

--
-- Структура на таблица `stocks_internal`
--

DROP TABLE IF EXISTS `stocks_internal`;
CREATE TABLE IF NOT EXISTS `stocks_internal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_id` int(11) NOT NULL,
  `certificate_number` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `firm_name` varchar(200) NOT NULL,
  `date_issue` int(11) NOT NULL,
  `internal` int(11) NOT NULL,
  `type_crops` tinyint(1) NOT NULL,
  `type_pack` int(11) NOT NULL,
  `number_packages` int(11) NOT NULL,
  `different` varchar(100) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `crops_name` varchar(200) NOT NULL,
  `crop_en` varchar(200) NOT NULL,
  `variety` varchar(200) NOT NULL,
  `quality_class` varchar(100) NOT NULL,
  `weight` int(11) NOT NULL,
  `inspector_name` varchar(100) NOT NULL,
  `date_add` varchar(20) NOT NULL,
  `date_update` varchar(20) NOT NULL,
  `added_by` tinyint(2) NOT NULL,
  `updated_by` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
