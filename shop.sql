-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 19 септ 2021 в 16:13
-- Версия на сървъра: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Структура на таблица `persons`
--

DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `person_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК',
  `username` varchar(16) NOT NULL COMMENT 'Потребителско име',
  `person_type` tinyint(1) NOT NULL COMMENT 'Тип потребител: 1-администратор',
  `pass` varchar(16) NOT NULL COMMENT 'Парола',
  `name` varchar(128) NOT NULL COMMENT 'Име',
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `persons`
--

INSERT INTO `persons` (`person_id`, `username`, `person_type`, `pass`, `name`) VALUES
(1, 'admin', 1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК',
  `product_kind_id` int(10) UNSIGNED NOT NULL COMMENT 'ВК към вид',
  `name` varchar(64) NOT NULL COMMENT 'Име на продукт',
  `race` varchar(32) DEFAULT NULL COMMENT 'Сорт',
  `price` int(4) DEFAULT NULL COMMENT 'Цена - само в цели числа',
  `info` text DEFAULT NULL COMMENT 'описание',
  `picture` varchar(32) DEFAULT NULL COMMENT 'относителен адрес до снимка',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Дата на регистрация в магазина',
  PRIMARY KEY (`product_id`),
  KEY `product_kind_id` (`product_kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='Животни';

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`product_id`, `product_kind_id`, `name`, `race`, `price`, `info`, `picture`, `registration_date`) VALUES
(1, 1, '4 СЕЗОНА ЗИМА', 'Червена череша', 45, NULL, '1.jpg', '2020-06-09 13:34:44'),
(2, 1, 'BOLLINGER SPECIAL CUVE', 'Круша', 45, NULL, '5.jpg', '2020-06-11 21:02:15'),
(3, 2, '4 СЕЗОНА ЗИМА', 'Червена череша', 34, NULL, '5.jpg', '2020-06-11 21:02:55'),
(4, 4, 'Whispering Angel Rosé', 'Сухо', 45, NULL, '6.jpg', '2020-06-11 21:03:27'),
(24, 3, 'Season', 'Деликатесно', 34, 'Деликатесно 750 мл', '1.jpg', '2020-06-12 22:30:53'),
(25, 3, 'Бебчо', 'Круша', 58, NULL, '1.jpg', '2020-06-22 10:08:21');

-- --------------------------------------------------------

--
-- Структура на таблица `wine_kinds`
--

DROP TABLE IF EXISTS `wine_kinds`;
CREATE TABLE IF NOT EXISTS `wine_kinds` (
  `wine_kind_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК',
  `kind` varchar(32) NOT NULL COMMENT 'вид',
  PRIMARY KEY (`wine_kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Видове животни';

--
-- Схема на данните от таблица `wine_kinds`
--

INSERT INTO `wine_kinds` (`wine_kind_id`, `kind`) VALUES
(1, 'Бяло'),
(2, 'Червено'),
(3, 'Розе'),
(4, 'Шампанско');

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_kind_id`) REFERENCES `wine_kinds` (`wine_kind_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
