-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране:  9 ное 2022 в 09:29
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
-- Структура на таблица `qxcertificates`
--

DROP TABLE IF EXISTS `qxcertificates`;
CREATE TABLE IF NOT EXISTS `qxcertificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `export` int(11) NOT NULL,
  `is_all` tinyint(1) NOT NULL DEFAULT '0',
  `what_7` tinyint(2) NOT NULL,
  `type_crops` tinyint(2) NOT NULL,
  `importer_id` int(11) NOT NULL,
  `importer_name` varchar(300) NOT NULL,
  `importer_address` varchar(300) NOT NULL,
  `importer_vin` varchar(100) NOT NULL,
  `packer_id` int(11) NOT NULL DEFAULT '0',
  `packer_name` varchar(300) NOT NULL,
  `packer_address` varchar(500) NOT NULL,
  `stamp_number` varchar(10) NOT NULL,
  `authority_bg` varchar(50) NOT NULL,
  `authority_en` varchar(50) NOT NULL,
  `id_country` tinyint(1) NOT NULL,
  `for_country_bg` varchar(300) NOT NULL,
  `for_country_en` varchar(300) NOT NULL,
  `observations` varchar(500) NOT NULL,
  `transport` varchar(100) NOT NULL,
  `from_country` varchar(300) NOT NULL,
  `customs_bg` varchar(100) NOT NULL,
  `customs_en` varchar(100) NOT NULL,
  `place_bg` varchar(100) NOT NULL,
  `place_en` varchar(100) NOT NULL,
  `date_issue` int(11) NOT NULL,
  `valid_until` varchar(20) NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `invoice_number` varchar(20) NOT NULL,
  `invoice_date` int(11) NOT NULL,
  `sum` float NOT NULL,
  `inspector_bg` varchar(50) NOT NULL,
  `inspector_en` varchar(50) NOT NULL,
  `date_add` varchar(20) NOT NULL,
  `date_update` varchar(20) NOT NULL,
  `added_by` tinyint(2) NOT NULL,
  `updated_by` tinyint(2) NOT NULL,
  `is_lock` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `qxcertificates`
--

INSERT INTO `qxcertificates` (`id`, `export`, `is_all`, `what_7`, `type_crops`, `importer_id`, `importer_name`, `importer_address`, `importer_vin`, `packer_id`, `packer_name`, `packer_address`, `stamp_number`, `authority_bg`, `authority_en`, `id_country`, `for_country_bg`, `for_country_en`, `observations`, `transport`, `from_country`, `customs_bg`, `customs_en`, `place_bg`, `place_en`, `date_issue`, `valid_until`, `invoice_id`, `invoice_number`, `invoice_date`, `sum`, `inspector_bg`, `inspector_en`, `date_add`, `date_update`, `added_by`, `updated_by`, `is_lock`) VALUES
(1, 2001, 1, 3, 1, 14, 'Euro Plants Ltd', 'Kostur, Svilengrad, Bulgaria/ 6533', '203782284', 1, 'LIDER GIDA SANAYI VE DIS TICARET LTD STI.', 'CARSI MAH.DEREBOYU SOK.NO:18/1/ ORTAHISAR/ TRABZON/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 12, 'Германия', 'Germany', 'ВАЖНО!!! Когато се избира \"За преработка\" текста \"', '07AAG455/ 15AAS175', 'България', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1588464000, '02.11.2022', 13, '6571020622', 1667253600, 11.95, 'Мария Чанкова', 'Marya Chankova', '31.10.2022', '01.11.2022', 10, 10, 1),
(2, 2002, 1, 3, 1, 14, 'Euro Plants Ltd', 'Kostur, Svilengrad, Bulgaria/ 6533', '203782284', 888, '', '', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 11, 'Великобритания', 'United Kingdom', '', 'CB4559 TH/CB2150 EA', 'България', 'МБ Пловдив', 'CP PLOVDIV', 'Хасково', 'HASKOVO', 1628985600, '06.11.2022', 14, '6571020835', 1667253600, 50, 'Мария Чанкова', 'Marya Chankova', '01.11.2022', '01.11.2022', 10, 10, 0),
(3, 2003, 1, 3, 1, 14, 'Euro Plants Ltd', 'Kostur, Svilengrad, Bulgaria/ 6533', '203782284', 1, 'LIDER GIDA SANAYI VE DIS TICARET LTD STI.', 'CARSI MAH.DEREBOYU SOK.NO:18/1/ ORTAHISAR/ TRABZON/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 25, 'Литва', 'Lithuania', '', 'AS54/AD876', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1667253600, '10.11.2022', 0, '', 0, 0, 'Мария Чанкова', 'Marya Chankova', '01.11.2022', '', 10, 0, 0),
(4, 2004, 1, 3, 1, 13, 'G.m.g. Bulgaria', 'IZGREV DIANANABAD NO: 3, ENT. 3 FLOOR 4, SOFIA 1172', '201931548', 1, 'LIDER GIDA SANAYI VE DIS TICARET LTD STI.', 'CARSI MAH.DEREBOYU SOK.NO:18/1/ ORTAHISAR/ TRABZON/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 17, 'Ирландия', 'Ireland', '', '07AAG455/ 15AAS175', 'България', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1667340000, '08.11.2022', 0, '', 0, 0, 'Мария Чанкова', 'Marya Chankova', '02.11.2022', '', 10, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
