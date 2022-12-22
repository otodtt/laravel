-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране: 22 дек 2022 в 15:15
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
-- База данни: `haskovo`
--

-- --------------------------------------------------------

--
-- Структура на таблица `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type` tinyint(1) NOT NULL,
  `document_name` varchar(500) NOT NULL,
  `document_short` varchar(300) NOT NULL,
  `document_path` varchar(500) NOT NULL,
  `document_for` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_create` varchar(25) NOT NULL,
  `date_update` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `documents`
--

INSERT INTO `documents` (`id`, `document_type`, `document_name`, `document_short`, `document_path`, `document_for`, `is_active`, `created_by`, `updated_by`, `date_create`, `date_update`) VALUES
(1, 2, 'Задължително избери една от следните възможности!', 'Задължително избери', 'C:\\wamp\\www\\laravel\\public\\documents\\', 1, 1, 0, 0, '', ''),
(2, 1, ' Reglament Задължително избери една от следните възможности!', '', 'C:\\wamp\\www\\laravel\\public\\documents\\', 0, 1, 0, 0, '', ''),
(3, 1, '2 Reglament Задължително избери една от следните възможности!', '2 Reglament  Задължително избери', 'C:\\wamp\\www\\laravel\\public\\documents\\', 0, 1, 2, 0, '22.12.2022', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
