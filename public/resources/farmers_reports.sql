-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране: 27 окт 2023 в 14:18
-- Версия на сървъра: 8.0.31
-- Версия на PHP: 7.4.33

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
-- Структура на таблица `farmers_reports`
--

DROP TABLE IF EXISTS `farmers_reports`;
CREATE TABLE IF NOT EXISTS `farmers_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `opinion_id` int NOT NULL,
  `farmer_id` int NOT NULL,
  `number_report` int NOT NULL,
  `starting_time` varchar(50) NOT NULL,
  `final_hour` varchar(50) NOT NULL,
  `date_report` int NOT NULL,
  `check_id` tinyint NOT NULL,
  `check_type` tinyint NOT NULL,
  `where_check` tinyint NOT NULL DEFAULT '0',
  `place` varchar(100) NOT NULL,
  `dimensions` varchar(250) NOT NULL,
  `crops` varchar(250) NOT NULL,
  `inspector` tinyint NOT NULL,
  `inspector_two` tinyint NOT NULL,
  `inspector_three` tinyint NOT NULL,
  `inspector_another` varchar(250) NOT NULL,
  `inspector_from` varchar(250) NOT NULL,
  `opinions` tinyint NOT NULL,
  `description` varchar(100) NOT NULL,
  `firm` tinyint NOT NULL,
  `name` varchar(250) NOT NULL,
  `sex` tinyint NOT NULL,
  `pin` varchar(50) NOT NULL,
  `bulstat` varchar(11) NOT NULL,
  `egn_eik` tinyint NOT NULL DEFAULT '1',
  `owner` varchar(250) NOT NULL,
  `areas_id` int NOT NULL,
  `district_id` int NOT NULL,
  `city_id` int NOT NULL,
  `tvm` tinyint NOT NULL,
  `location` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `district_object` tinyint NOT NULL,
  `location_farm` varchar(250) NOT NULL,
  `inspector_name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `position_short` varchar(50) NOT NULL,
  `inspector_two_name` varchar(50) NOT NULL,
  `position_two` varchar(50) NOT NULL,
  `position_short_two` varchar(50) NOT NULL,
  `inspector_three_name` varchar(50) NOT NULL,
  `position_three` varchar(50) NOT NULL,
  `position_short_three` varchar(50) NOT NULL,
  `alphabet` tinyint NOT NULL,
  `date_add` int NOT NULL,
  `added_by` tinyint NOT NULL,
  `date_update` int NOT NULL,
  `updated_by` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_all` tinyint NOT NULL DEFAULT '0',
  `first` tinyint NOT NULL DEFAULT '0',
  `second` tinyint NOT NULL DEFAULT '0',
  `third` tinyint NOT NULL DEFAULT '0',
  `fourth` tinyint NOT NULL DEFAULT '0',
  `fifth` tinyint NOT NULL DEFAULT '0',
  `sixth` tinyint NOT NULL DEFAULT '0',
  `diary` tinyint NOT NULL,
  `diary_note` varchar(200) NOT NULL,
  `primaryR` tinyint NOT NULL,
  `primary_note` varchar(200) NOT NULL,
  `seeds` tinyint NOT NULL,
  `seeds_note` varchar(200) NOT NULL,
  `certificate` tinyint NOT NULL,
  `certificate_note` varchar(200) NOT NULL,
  `testing` tinyint NOT NULL,
  `testing_note` varchar(200) NOT NULL,
  `contract` tinyint NOT NULL,
  `contract_note` varchar(200) NOT NULL,
  `permit` tinyint NOT NULL,
  `permit_note` varchar(200) NOT NULL,
  `disclosure` tinyint NOT NULL,
  `disclosure_note` varchar(200) NOT NULL,
  `spraying` tinyint NOT NULL,
  `spraying_note` varchar(200) NOT NULL,
  `original` tinyint NOT NULL,
  `original_note` varchar(200) NOT NULL,
  `unauthorized` tinyint NOT NULL,
  `unauthorized_note` varchar(200) NOT NULL,
  `expiry` tinyint NOT NULL,
  `expiry_note` varchar(200) NOT NULL,
  `allocation` tinyint NOT NULL,
  `allocation_note` varchar(200) NOT NULL,
  `metal` tinyint NOT NULL,
  `metal_note` varchar(200) NOT NULL,
  `empty` tinyint NOT NULL,
  `empty_note` varchar(200) NOT NULL,
  `permission` tinyint NOT NULL,
  `permission_note` varchar(200) NOT NULL,
  `relevant` tinyint NOT NULL,
  `relevant_note` varchar(200) NOT NULL,
  `concentration` tinyint NOT NULL,
  `concentration_note` varchar(200) NOT NULL,
  `phenophase` tinyint NOT NULL,
  `phenophase_note` varchar(200) NOT NULL,
  `distances` tinyint NOT NULL,
  `distances_note` varchar(200) NOT NULL,
  `buildings` tinyint NOT NULL,
  `buildings_note` varchar(200) NOT NULL,
  `watersheds` tinyint NOT NULL,
  `watersheds_note` varchar(200) NOT NULL,
  `irrigation` tinyint NOT NULL,
  `irrigation_note` varchar(200) NOT NULL,
  `protected` tinyint NOT NULL,
  `protected_note` varchar(200) NOT NULL,
  `cleaning` tinyint NOT NULL,
  `cleaning_note` varchar(200) NOT NULL,
  `evidence` tinyint NOT NULL,
  `evidence_note` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pin` (`pin`),
  KEY `number_report` (`number_report`),
  KEY `date_report` (`date_report`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Схема на данните от таблица `farmers_reports`
--

INSERT INTO `farmers_reports` (`id`, `opinion_id`, `farmer_id`, `number_report`, `starting_time`, `final_hour`, `date_report`, `check_id`, `check_type`, `where_check`, `place`, `dimensions`, `crops`, `inspector`, `inspector_two`, `inspector_three`, `inspector_another`, `inspector_from`, `opinions`, `description`, `firm`, `name`, `sex`, `pin`, `bulstat`, `egn_eik`, `owner`, `areas_id`, `district_id`, `city_id`, `tvm`, `location`, `address`, `district_object`, `location_farm`, `inspector_name`, `position`, `position_short`, `inspector_two_name`, `position_two`, `position_short_two`, `inspector_three_name`, `position_three`, `position_short_three`, `alphabet`, `date_add`, `added_by`, `date_update`, `updated_by`, `created_at`, `updated_at`, `is_all`, `first`, `second`, `third`, `fourth`, `fifth`, `sixth`, `diary`, `diary_note`, `primaryR`, `primary_note`, `seeds`, `seeds_note`, `certificate`, `certificate_note`, `testing`, `testing_note`, `contract`, `contract_note`, `permit`, `permit_note`, `disclosure`, `disclosure_note`, `spraying`, `spraying_note`, `original`, `original_note`, `unauthorized`, `unauthorized_note`, `expiry`, `expiry_note`, `allocation`, `allocation_note`, `metal`, `metal_note`, `empty`, `empty_note`, `permission`, `permission_note`, `relevant`, `relevant_note`, `concentration`, `concentration_note`, `phenophase`, `phenophase_note`, `distances`, `distances_note`, `buildings`, `buildings_note`, `watersheds`, `watersheds_note`, `irrigation`, `irrigation_note`, `protected`, `protected_note`, `cleaning`, `cleaning_note`, `evidence`, `evidence_note`) VALUES
(10, 0, 1, 1, '22.10.2023 в 10:00', '22.10.2023 в 11:00', 1697922000, 1, 1, 1, 'Хасково', '22', 'домати', 2, 3, 4, 'Инспек', 'ОДБХ Хасково', 0, 'Проверка на ЗС', 1, 'Нина Юлиянова Русева', 2, '9101118512', '', 2, '', 26, 1, 4858, 1, 'Хасково', 'ул Захари Стоянов 57', 1, 'с. Малко градище', 'Д. Тенев', 'Главен инспектор', 'Гл. инспектор', 'Ю. Василева', 'Главен инспектор', 'Гл. инспектор', 'П. Петров', 'Главен инспектор', 'Гл. инспектор', 14, 1698414222, 2, 1698414239, 2, '2023-10-27 13:43:42', '2023-10-27 14:01:48', 4, 1, 1, 1, 1, 0, 0, 1, '', 1, '', 1, '', 2, 'Забележка 4', 1, '', 2, 'Забележка 6', 2, '', 1, '', 1, '', 1, '', 1, '', 3, '', 2, 'Забележка 13', 3, 'Забележка 14', 3, 'Забележка 15', 2, 'Забележка 16', 2, 'Забележка 17', 3, '', 3, '', 3, '', 3, '', 3, '', 3, '', 2, 'Забележка 204', 3, '', 3, ''),
(11, 0, 34, 2, '24.10.2023 в 14:00', '24.10.2023 в 16:49', 1698094800, 3, 2, 1, 'хасков', '33', 'домати', 4, 3, 9, 'Инспек', 'ОДБХ Хасково', 0, 'Кръстосанo', 4, 'Агрофермер-2002', 0, '126618229', '126618229', 2, 'Митю Вълчев Иванов', 26, 2, 1405, 1, 'Димитровград', 'ул Д. Благоев 29-А-2', 2, 'с. Голямо Асеново', 'П. Петров', 'Главен инспектор', 'Гл. инспектор', 'Ю. Василева', 'Главен инспектор', 'Гл. инспектор', 'А. Тонев', 'Инспектор', 'Инспектор', 1, 1698414607, 2, 0, 0, '2023-10-27 13:50:07', '2023-10-27 13:50:07', 1, 1, 0, 0, 0, 0, 0, 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
