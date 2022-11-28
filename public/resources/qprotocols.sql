-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране: 28 ное 2022 в 15:23
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
-- Структура на таблица `qprotocols`
--

DROP TABLE IF EXISTS `qprotocols`;
CREATE TABLE IF NOT EXISTS `qprotocols` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `farmer_id` int(11) NOT NULL,
  `farmer_name` varchar(100) NOT NULL,
  `farmer_address` varchar(500) NOT NULL,
  `farmer_phone` varchar(50) NOT NULL,
  `farmer_vin` varchar(50) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `trader_name` varchar(100) NOT NULL,
  `trader_address` varchar(500) NOT NULL,
  `trader_phone` varchar(50) DEFAULT NULL,
  `trader_vin` varchar(50) NOT NULL,
  `unregulated_id` int(11) NOT NULL,
  `unregulated_name` varchar(100) NOT NULL,
  `unregulated_address` varchar(500) NOT NULL,
  `unregulated_phone` varchar(50) NOT NULL,
  `unregulated_vin` varchar(50) NOT NULL,
  `number_protocol` int(11) NOT NULL,
  `date_protocol` int(11) NOT NULL,
  `crops` tinyint(2) NOT NULL,
  `crops_name` varchar(100) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `quality_class` tinyint(2) NOT NULL,
  `quality_naw` tinyint(2) NOT NULL,
  `tara` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `type_package` tinyint(2) NOT NULL,
  `different` varchar(50) NOT NULL,
  `variety` text NOT NULL,
  `documents` text NOT NULL,
  `marking` tinyint(3) NOT NULL,
  `cleanliness` tinyint(3) NOT NULL,
  `coloring` tinyint(3) NOT NULL,
  `dimensions` tinyint(3) NOT NULL,
  `appearance` tinyint(3) NOT NULL,
  `maturity` tinyint(3) NOT NULL,
  `damage` tinyint(3) NOT NULL,
  `shape` tinyint(3) NOT NULL,
  `defects` tinyint(3) NOT NULL,
  `diseases` tinyint(3) NOT NULL,
  `matches` tinyint(4) NOT NULL,
  `mark` tinyint(1) NOT NULL DEFAULT '0',
  `repackaging` tinyint(1) NOT NULL DEFAULT '0',
  `processing` tinyint(1) NOT NULL DEFAULT '0',
  `low` tinyint(1) NOT NULL DEFAULT '0',
  `relabeling` tinyint(1) NOT NULL DEFAULT '0',
  `fodder` tinyint(1) NOT NULL DEFAULT '0',
  `resort` tinyint(1) NOT NULL DEFAULT '0',
  `destruction` tinyint(1) NOT NULL DEFAULT '0',
  `actions` text NOT NULL,
  `name_trader` varchar(500) NOT NULL,
  `place` varchar(100) NOT NULL,
  `inspectors` int(11) NOT NULL,
  `inspector_name` varchar(100) NOT NULL,
  `date_update` varchar(20) NOT NULL,
  `updated_by` tinyint(2) NOT NULL,
  `date_add` varchar(20) NOT NULL,
  `added_by` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `qprotocols`
--

INSERT INTO `qprotocols` (`id`, `farmer_id`, `farmer_name`, `farmer_address`, `farmer_phone`, `farmer_vin`, `trader_id`, `trader_name`, `trader_address`, `trader_phone`, `trader_vin`, `unregulated_id`, `unregulated_name`, `unregulated_address`, `unregulated_phone`, `unregulated_vin`, `number_protocol`, `date_protocol`, `crops`, `crops_name`, `origin`, `quality_class`, `quality_naw`, `tara`, `number`, `type_package`, `different`, `variety`, `documents`, `marking`, `cleanliness`, `coloring`, `dimensions`, `appearance`, `maturity`, `damage`, `shape`, `defects`, `diseases`, `matches`, `mark`, `repackaging`, `processing`, `low`, `relabeling`, `fodder`, `resort`, `destruction`, `actions`, `name_trader`, `place`, `inspectors`, `inspector_name`, `date_update`, `updated_by`, `date_add`, `added_by`) VALUES
(1, 44, 'Калоян Тонев Тонев', 'обл. Хасково, общ. Димитровград, гр. Димитровград, ул. Васил Левски 28', '', '7304068609', 0, '', '', '', '', 0, '', '', '', '', 555, 1668981600, 18, 'Картофи', 'Турция', 1, 3, '4534/4334', 3, 4, '', '7. Други идентификационни белези', '8. Придружаващи стоката документи', 1, 5, 8, 2, 6, 9, 3, 7, 10, 4, 0, 1, 1, 1, 1, 1, 1, 1, 1, 'Действия на търговеца в ', 'Трите имена на търговеца', 'Хасково', 10, '', '', 0, '28.11.2022', 10),
(2, 43, 'ЗКПУ Бряст', 'обл. Хасково, общ. Димитровград, с. Бряст, с. Бряст', '', '836035947', 0, '', '', '', '', 0, '', '', '', '', 5556, 1669327200, 20, '', 'Турция', 1, 2, '4534/4334', 3, 4, '', '7. Други идентификационни белези', '8. Придружаващи стоката документи', 1, 5, 8, 2, 6, 9, 3, 7, 10, 4, 0, 1, 1, 1, 1, 1, 1, 1, 1, 'Действия на търговеца в определен от него срок съ', 'Трите имена на търговеца', 'Хасково', 8, '', '', 0, '28.11.2022', 10),
(3, 124, 'Агроефект ЕООД', 'обл. Стара Загора, общ. Стара Загора, гр. Стара Загора, ул. Никола Петков 55', '', '123734050', 0, '', '', '', '', 0, '', '', '', '', 2334, 1669154400, 20, 'Патладжан', 'Турция', 2, 3, '4534/4334', 3, 4, '', '7. Други иден', '8. Придружава', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Действия на търговеца в определен от него срок съгласно', 'Трите имена на търговеца', 'Хасково', 10, 'М. Чанкова', '', 0, '28.11.2022', 10),
(4, 122, 'Агро Макс 2006 ЕООД', 'обл. Стара Загора, общ. Стара Загора, гр. Стара Загора, ул. Хрищиян Воевода 28', '', '128615819', 0, '', '', '', '', 0, '', '', '', '', 11, 1669154400, 18, 'Картофи', 'Турция', 1, 2, '4534/4334', 609, 4, '', '', '', 1, 5, 8, 2, 6, 9, 3, 7, 10, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'дфб фдбдф', 'Хасково', 8, 'В. Наков', '', 0, '28.11.2022', 10),
(5, 122, 'Агро Макс 2006 ЕООД', 'обл. Стара Загора, общ. Стара Загора, гр. Стара Загора, ул. Хрищиян Воевода 28', '', '128615819', 0, '', '', '', '', 0, '', '', '', '', 333, 1669154400, 20, 'Патладжан', 'Турция', 1, 3, '4534/4334', 33, 4, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, '', 'дфб фдбдф', 'Хасково', 9, 'А. Тонев', '', 0, '28.11.2022', 10),
(6, 43, 'ЗКПУ Бряст', 'обл. Хасково, общ. Димитровград, с. Бряст, с. Бряст', '', '836035947', 0, '', '', '', '', 0, '', '', '', '', 33, 1669068000, 19, 'Домати ', 'Турция', 1, 2, '4534/4334', 609, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 1, 1, 1, 1, 1, 1, 1, 1, '', 'дфб фдбдф', 'Хасково', 9, 'А. Тонев', '', 0, '28.11.2022', 10),
(7, 18, 'Валя Грудева Димитрова', 'обл. Хасково, общ. Димитровград, гр. Димитровград, ул. Волгоград 12', '', '6710308492', 0, '', '', '', '', 0, '', '', '', '', 33, 1669068000, 19, 'Домати ', 'Турция', 1, 2, '4534/4334', 609, 127, 'чували', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 1, 0, 0, 0, 1, 1, 1, 0, '', 'дфб фдбдф', 'Димитровград', 10, 'М. Чанкова', '', 0, '28.11.2022', 10),
(8, 0, '', '', '', '', 1, 'ЩАБ ФРУТ ЕООД ', 'с. Минзухар, м-ла \"Ключово\", общ. Черноочене, обл. Кърджали', NULL, '201017702', 0, '', '', '', '', 77, 1669068000, 28, '', 'Турция', 1, 1, '55/66', 3, 127, 'чували', '7. Други идентификационни белези', '8. Придружаващи стоката документи', 1, 5, 8, 2, 6, 9, 3, 7, 10, 4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Действия на търговец', 'Трите имена на търговеца', 'Димитровград', 9, 'А. Тонев', '', 0, '28.11.2022', 10),
(9, 0, '', '', '', '', 4, 'ИНУЕНДО ЕООД', 'с. Черноочене, ул. Централна, 5, бл. Административна сгра, ет. 2', NULL, '200443001', 0, '', '', '', '', 555, 1669154400, 21, 'Сладки Пиперки', 'Турция', 1, 2, '234/4534', 3, 127, 'чували', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, '', 'Трите имена на търговеца', 'Хасково', 9, 'А. Тонев', '', 0, '28.11.2022', 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
