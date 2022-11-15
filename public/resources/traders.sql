-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 15 ное 2022 в 23:33
-- Версия на сървъра: 10.1.48-MariaDB-0+deb9u2
-- PHP Version: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haskovo`
--

-- --------------------------------------------------------

--
-- Структура на таблица `traders`
--

CREATE TABLE `traders` (
  `id` int(11) NOT NULL,
  `trader_name` varchar(100) NOT NULL,
  `trader_address` varchar(500) NOT NULL,
  `trader_vin` varchar(25) NOT NULL,
  `created_by` tinyint(2) NOT NULL,
  `updated_by` tinyint(2) NOT NULL,
  `date_create` varchar(30) NOT NULL,
  `date_update` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `traders`
--

INSERT INTO `traders` (`id`, `trader_name`, `trader_address`, `trader_vin`, `created_by`, `updated_by`, `date_create`, `date_update`) VALUES
(1, 'Ерос фрут ЕООД', 'с. Караманци, ул. \"Шестнадесета\" № 31', '202424373', 10, 0, '15.11.2022 22:30:06', ''),
(2, 'Уикенд ООД', 'гр. Димитровград, ул. \"П. Евтимий\" 7-Б-2', '126145986', 10, 0, '15.11.2022 22:31:54', ''),
(3, 'Адимар фрут ЕООД', 'гр. Свиленград, ул. \"В. Левски\" № 35', '205625292', 10, 10, '15.11.2022 22:33:26', '15.11.2022 22:39:29'),
(4, 'Щаб фрут ЕООД', 'с. Минзухар, м-ла \"Ключово\"', '201017702', 10, 0, '15.11.2022 22:34:53', ''),
(5, 'Дружба-2013 ЕООД', 'гр. Свиленград ул. \"Васил Друмев\"№ 8, вх. Б, ет. 1', '202678471', 10, 0, '15.11.2022 22:37:41', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `traders`
--
ALTER TABLE `traders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `traders`
--
ALTER TABLE `traders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
