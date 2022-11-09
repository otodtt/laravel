-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране:  9 ное 2022 в 15:15
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
-- Структура на таблица `qincertificates`
--

DROP TABLE IF EXISTS `qincertificates`;
CREATE TABLE IF NOT EXISTS `qincertificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `internal` int(11) NOT NULL,
  `is_all` tinyint(1) NOT NULL DEFAULT '0',
  `what_7` tinyint(2) NOT NULL,
  `type_crops` tinyint(2) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `type_firm` tinyint(2) NOT NULL,
  `trader_id` tinyint(3) NOT NULL,
  `trader_name` varchar(300) NOT NULL,
  `trader_address` varchar(300) NOT NULL,
  `trader_vin` varchar(100) NOT NULL,
  `packer_name` varchar(300) NOT NULL,
  `packer_address` varchar(500) NOT NULL,
  `packer_vin` varchar(100) NOT NULL,
  `stamp_number` varchar(10) NOT NULL,
  `authority_bg` varchar(50) NOT NULL,
  `authority_en` varchar(50) NOT NULL,
  `id_country` tinyint(1) NOT NULL,
  `for_country_bg` varchar(300) NOT NULL,
  `for_country_en` varchar(300) NOT NULL,
  `observations` varchar(500) NOT NULL,
  `from_country` varchar(300) NOT NULL,
  `customs_bg` varchar(100) NOT NULL,
  `customs_en` varchar(100) NOT NULL,
  `place_bg` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `qincertificates`
--

INSERT INTO `qincertificates` (`id`, `internal`, `is_all`, `what_7`, `type_crops`, `farmer_id`, `type_firm`, `trader_id`, `trader_name`, `trader_address`, `trader_vin`, `packer_name`, `packer_address`, `packer_vin`, `stamp_number`, `authority_bg`, `authority_en`, `id_country`, `for_country_bg`, `for_country_en`, `observations`, `from_country`, `customs_bg`, `customs_en`, `place_bg`, `date_issue`, `valid_until`, `invoice_id`, `invoice_number`, `invoice_date`, `sum`, `inspector_bg`, `inspector_en`, `date_add`, `date_update`, `added_by`, `updated_by`, `is_lock`) VALUES
(1, 3001, 0, 1, 1, 2133, 1, 0, 'Диана Лозкова Чакърова', 'ул\"Одрин\" №2', '8906138592', '', '', '', 'X-032', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 9, 'България', 'Bulgaria', 'Когато се избира \"За преработка\" текста ', 'България/ Bulgaria', '', '', 'Свиленград', 1667944800, '16.11.2022', 0, '', 0, 0, 'Мария Чанкова', 'Marya Chankova', '09.11.2022', '', 10, 0, 0),
(2, 3002, 0, 1, 1, 28, 3, 0, 'КОКО', 'ул. Георги Попмаринов 20', '108565771', '', '', '', 'X-032', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 9, 'България', 'Bulgaria', ' НЕ СЕ ВЪВЕЖДА!!! Ще се изпиш', 'България/ Bulgaria', '', '', 'Свиленград', 1667944800, '16.11.2022', 0, '', 0, 0, 'Мария Чанкова', 'Marya Chankova', '09.11.2022', '', 10, 0, 0),
(3, 3003, 0, 1, 1, 0, 1, 0, 'Делчо Тенчев Тенев', 'бул. България 116, ап. 12', '6602178587', '', '', '', 'X-032', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 9, 'България', 'Bulgaria', 'Поле 13 ВАЖНО!!! Когато се избира \"За', 'Хасково', '', '', 'Хасково', 1667944800, '16.11.2022', 0, '', 0, 0, 'Мария Чанкова', 'Marya Chankova', '09.11.2022', '', 10, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
