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
-- Структура на таблица `qcertificates`
--

DROP TABLE IF EXISTS `qcertificates`;
CREATE TABLE IF NOT EXISTS `qcertificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `import` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `qcertificates`
--

INSERT INTO `qcertificates` (`id`, `import`, `is_all`, `what_7`, `type_crops`, `importer_id`, `importer_name`, `importer_address`, `importer_vin`, `packer_id`, `packer_name`, `packer_address`, `stamp_number`, `authority_bg`, `authority_en`, `id_country`, `for_country_bg`, `for_country_en`, `observations`, `transport`, `from_country`, `customs_bg`, `customs_en`, `place_bg`, `place_en`, `date_issue`, `valid_until`, `invoice_id`, `invoice_number`, `invoice_date`, `sum`, `inspector_bg`, `inspector_en`, `date_add`, `date_update`, `added_by`, `updated_by`, `is_lock`) VALUES
(1, 1001, 1, 2, 2, 1, 'Emi Frut Eood', 'ASENOVGRAD, UL. GOTCE DELCHEV 91', '200493997', 1, 'LIDER GIDA SANAYI VE DIS TICARET LTD STI.', 'CARSI MAH.DEREBOYU SOK.NO:18/1/ ORTAHISAR/ TRABZON/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 1, 'Австрия', 'Austria', '', '07AAG455/ 15AAS175', 'Турция/Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1595710800, '28.10.2022', 1, '6571020601', 1595710800, 11.35, 'Мария Чанкова', 'Marya Chankova', '26.10.2022', '28.10.2022', 10, 10, 0),
(2, 1002, 1, 2, 1, 2, 'Forever 9 Eood', 'BULGARIA, SOFIA, DRUJBA BL. 9, VH. J, AP. 11', '203020031', 2, 'Degirmenciler Zirai Urun Isleme Paketleme Pazarlama Ve Tasimacilik Ticaret Ve San Ltd Sti', 'KULAK MAH.INONU  BLV NO. 7102  HUZURKENT-AKDENIZ/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 7, 'Белгия', 'Belgium', '', '07AAG455/ 15AAS175', 'Турция/Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1600117200, '28.10.2022', 6, '6571020602', 1600117200, 10, 'Мария Чанкова', 'Marya Chankova', '26.10.2022', '28.10.2022', 10, 10, 0),
(3, 1003, 1, 2, 1, 3, 'Kolla Munchen Gbmh', 'MAISTRASSE 45 D-80337, MUNCHEN, GERMANY', 'EORI:DE2402149 VAT NO:BG 3074097765', 3, 'KOLLA TURKEY TARIM VE GIDA TICARET ANONIM SIRKETI', 'ATIFBEY MAH. 67 SOKAK NO.33, D.59 35410  GAZIEMIR/ IZMIR/ TURKEY', 'X-108', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 9, 'България', 'Bulgaria', '', 'as232/ sds333', 'България', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1612562400, '28.10.2022', 5, '6571020603', 1612562400, 25, 'Антон Тонев', 'Anton Tonev', '26.10.2022', '', 9, 0, 0),
(4, 1004, 1, 2, 2, 7, 'Ogl - Food Trade Lebensmittelvertrieb Gmbh', 'EICHENSTRASSE 11-A-D, DE-85445 OBERDING, GERMANY', 'ATU57056358', 4, 'HERG GOCTAR FROZAN ARAS TABZIR/ IRAN', '', 'X-108', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 12, 'Германия', 'Germany', '', 'as232/ sds333', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1626814800, '29.10.2022', 7, '6571020604', 1627074000, 24, 'Антон Тонев', 'Anton Tonev', '26.10.2022', '28.10.2022', 9, 10, 0),
(5, 1005, 1, 2, 1, 5, 'Goldan Fruts 2016 Ltd ', 'Bulgaria, Sliven, ul. Felix Kanix 7A ', '203883835', 1, 'LIDER GIDA SANAYI VE DIS TICARET LTD STI.', 'CARSI MAH.DEREBOYU SOK.NO:18/1/ ORTAHISAR/ TRABZON/ TURKEY', 'X-106', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 12, 'Германия', 'Germany', '', 'as232/ sds333', 'България', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1637964000, '28.10.2022', 8, '6571020605', 1638223200, 55, 'Владимир Наков', 'Vladimir Nakov', '26.10.2022', '28.10.2022', 8, 10, 0),
(6, 1006, 1, 2, 1, 13, 'G.m.g. Bulgaria', 'IZGREV DIANANABAD NO: 3, ENT. 3 FLOOR 4, SOFIA 1172', '201931548', 2, 'Degirmenciler Zirai Urun Isleme Paketleme Pazarlama Ve Tasimacilik Ticaret Ve San Ltd Sti', 'KULAK MAH.INONU  BLV NO. 7102  HUZURKENT-AKDENIZ/ TURKEY', 'X-106', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 29, 'Малта', 'Malta', '', 'as232/ sds333', 'България', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1637964000, '29.10.2022', 9, '6571020606', 1638223200, 66, 'Владимир Наков', 'Vladimir Nakov', '26.10.2022', '', 8, 0, 0),
(7, 1007, 1, 2, 1, 11, 'Balkan Fruit Ltd Michele Mastropasqua P.lva ', 'VIA G. BENCOVSKI N 14, SOFIA/ BULGARIA', '819411799', 999, 'SENOL HOCAOGLU KORUK ORGANIK TARIM URUNLERI', 'HURRIET MAH 1058 SK NO:43/2/ GAZIEMIR/ IZMIR/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 49, 'Чехия', 'Czech Republic', '', 'as232/ sds333', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1647295200, '28.10.2022', 2, '6571020607', 1666818000, 339, 'Мария Чанкова', 'Marya Chankova', '26.10.2022', '', 10, 0, 0),
(8, 1008, 1, 2, 1, 3, 'Kolla Munchen Gbmh', 'MAISTRASSE 45 D-80337, MUNCHEN, GERMANY', 'EORI:DE2402149 VAT NO:BG 3074097765', 4, 'HERG GOCTAR FROZAN ARAS TABZIR/ IRAN', '', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 32, 'Нидерландия', 'Netherlands', '', 'as232/ sds333', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1657314000, '29.10.2022', 3, '6571020608', 1666818000, 505, 'Мария Чанкова', 'Marya Chankova', '27.10.2022', '28.10.2022', 10, 10, 1),
(9, 1009, 1, 2, 1, 5, 'Goldan Fruts 2016 Ltd ', 'Bulgaria, Sliven, ul. Felix Kanix 7A ', '203883835', 2, 'Degirmenciler Zirai Urun Isleme Paketleme Pazarlama Ve Tasimacilik Ticaret Ve San Ltd Sti', 'KULAK MAH.INONU  BLV NO. 7102  HUZURKENT-AKDENIZ/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 36, 'Румъния', 'Romania', '', '07AAG455/ 15AAS175', 'България', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1666818000, '30.10.2022', 4, '6571020609', 1666645200, 12, 'Мария Чанкова', 'Marya Chankova', '27.10.2022', '', 10, 0, 0),
(10, 1010, 1, 2, 1, 9, 'Rodopi Agro Ltd', 'BUL. ILINDEN 47A, 6300, HASKOVO, BULGARIA ', '203227133', 1, 'LIDER GIDA SANAYI VE DIS TICARET LTD STI.', 'CARSI MAH.DEREBOYU SOK.NO:18/1/ ORTAHISAR/ TRABZON/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 22, 'Кипър', 'Cyprus', '', '07AAG455/ 15AAS175', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1666818000, '30.10.2022', 10, '6571020610', 1666299600, 99.7, 'Мария Чанкова', 'Marya Chankova', '27.10.2022', '01.11.2022', 10, 10, 0),
(11, 1011, 1, 2, 1, 7, 'Ogl - Food Trade Lebensmittelvertrieb Gmbh', 'EICHENSTRASSE 11-A-D, DE-85445 OBERDING, GERMANY', 'ATU57056358', 3, 'KOLLA TURKEY TARIM VE GIDA TICARET ANONIM SIRKETI', 'ATIFBEY MAH. 67 SOKAK NO.33, D.59 35410  GAZIEMIR/ IZMIR/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 36, 'Румъния', 'Romania', '', '31AJN161/ 31 AJH166', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1666818000, '30.10.2022', 11, '6571020611', 1666818000, 11.35, 'Мария Чанкова', 'Marya Chankova', '27.10.2022', '28.10.2022', 10, 10, 1),
(12, 1012, 1, 2, 1, 7, 'Ogl - Food Trade Lebensmittelvertrieb Gmbh', 'EICHENSTRASSE 11-A-D, DE-85445 OBERDING, GERMANY', 'ATU57056358', 3, 'KOLLA TURKEY TARIM VE GIDA TICARET ANONIM SIRKETI', 'ATIFBEY MAH. 67 SOKAK NO.33, D.59 35410  GAZIEMIR/ IZMIR/ TURKEY', 'X-106', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 12, 'Германия', 'Germany', '', 'ass454/dfdf6453', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1666818000, '30.10.2022', 0, '', 0, 0, 'Владимир Наков', 'Vladimir Nakov', '27.10.2022', '27.10.2022', 8, 8, 1),
(13, 1013, 1, 2, 1, 13, 'G.m.g. Bulgaria', 'IZGREV DIANANABAD NO: 3, ENT. 3 FLOOR 4, SOFIA 1172', '201931548', 4, 'HERG GOCTAR FROZAN ARAS TABZIR/ IRAN', '', 'X-108', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 49, 'Чехия', 'Czech Republic', '', 'as232/ sds333', 'Turkey', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1666904400, '30.10.2022', 0, '', 0, 0, 'Антон Тонев', 'Anton Tonev', '28.10.2022', '28.10.2022', 9, 9, 1),
(14, 1014, 1, 2, 1, 9, 'Rodopi Agro Ltd', 'BUL. ILINDEN 47A, 6300, HASKOVO, BULGARIA ', '203227133', 5, 'SENOL HOCAOGLU KORUK ORGANIK TARIM URUNLERI', 'HURRIET MAH 1058 SK NO:43/2/ GAZIEMIR/ IZMIR/ TURKEY', 'X-103', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 9, 'България', 'Bulgaria', '', '33 EKK 74', 'TURKEY/ТУРЦИЯ', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1667512800, '08.11.2022', 15, '6571020842', 1667340000, 71, 'Мария Чанкова', 'Marya Chankova', '04.11.2022', '', 10, 0, 1),
(15, 1015, 1, 2, 1, 1, 'Emi Frut Eood', 'ASENOVGRAD, UL. GOTCE DELCHEV 91', '200493997', 1, 'LIDER GIDA SANAYI VE DIS TICARET LTD STI.', 'CARSI MAH.DEREBOYU SOK.NO:18/1/ ORTAHISAR/ TRABZON/ TURKEY', 'X-032', 'БАБХ: ОДБХ-Хасково', 'BFSA: RDFS-Haskovo', 36, 'Румъния', 'Romania', '', 'DF56 HJ/SA23NK', 'TURKEY/ТУРЦИЯ', 'МБ Свиленград', 'CP Svilengrad', 'Свиленград', 'Svilengrad', 1667512800, '17.11.2022', 0, '', 0, 0, 'Мария Чанкова', 'Marya Chankova', '04.11.2022', '', 10, 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
