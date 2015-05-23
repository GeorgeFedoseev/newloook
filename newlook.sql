-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 22 2015 г., 01:08
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `newlook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id_district` int(4) NOT NULL AUTO_INCREMENT,
  `name_district` varchar(20) NOT NULL,
  PRIMARY KEY (`id_district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id_location` int(10) NOT NULL AUTO_INCREMENT,
  `id_district` int(4) NOT NULL,
  `id_type_location` int(10) NOT NULL,
  `Name_photo` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `price` int(5) NOT NULL,
  `link_web` varchar(30) NOT NULL,
  `keywords` varchar(3000) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `order_photoproject`
--

CREATE TABLE IF NOT EXISTS `order_photoproject` (
  `id_order` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_project` int(10) NOT NULL,
  `date_order` date NOT NULL,
  `time_order` time NOT NULL,
  `id_location` int(10) NOT NULL,
  `moderation` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `order_photosession`
--

CREATE TABLE IF NOT EXISTS `order_photosession` (
  `id_order` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `date_order` date NOT NULL,
  `time_order` time NOT NULL,
  `amount_hours` int(2) NOT NULL,
  `id_style` int(2) NOT NULL,
  `id_location` int(10) NOT NULL,
  `amount_people` int(2) NOT NULL,
  `amount_makeup` int(2) NOT NULL,
  `amount_hairstylist` int(2) NOT NULL,
  `amount_florist` int(2) NOT NULL,
  `price_location` int(10) NOT NULL,
  `total price` int(10) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `photoproject`
--

CREATE TABLE IF NOT EXISTS `photoproject` (
  `id_project` int(10) NOT NULL AUTO_INCREMENT,
  `name_folder` varchar(15) NOT NULL,
  `name_project` varchar(30) NOT NULL,
  `date_start` date NOT NULL,
  `date_over` date NOT NULL,
  `about_project` varchar(3000) NOT NULL,
  `price` int(10) NOT NULL,
  `makeup` tinyint(1) NOT NULL,
  `hairstylist` tinyint(1) NOT NULL,
  `florist` tinyint(1) NOT NULL,
  `id_location` int(10) NOT NULL,
  `color` varchar(7) NOT NULL,
  `color_butt_txt` varchar(7) NOT NULL,
  `color_butt` varchar(7) NOT NULL,
  PRIMARY KEY (`id_project`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `photoproject`
--

INSERT INTO `photoproject` (`id_project`, `name_folder`, `name_project`, `date_start`, `date_over`, `about_project`, `price`, `makeup`, `hairstylist`, `florist`, `id_location`, `color`, `color_butt_txt`, `color_butt`) VALUES
(1, 'briz', 'Морской бриз', '2015-05-01', '2015-05-31', 'Крутой фотопроект', 4000, 1, 1, 0, 0, 'B25A88', 'FFA7D5', 'B20071'),
(3, 'aviator', 'Авиатор', '2015-05-01', '2015-05-31', 'Авиаторавиаторавиаторавиатор! Побудь навысоте, когда волосы развиваются по ветру, а в лицо брыжжет вода ляляля', 1000, 1, 1, 1, 0, '', '', ''),
(4, 'dolcevita', 'Дольче Вита', '2015-05-01', '2015-05-31', 'Прекрасный замечательный проект. Окунись в атмосферу любви и спокойствия, почувствую себя богиней итд', 2000, 0, 0, 0, 1, '', '', ''),
(5, 'hollywood', 'Голливуд', '2015-05-01', '2015-05-08', 'Оляля', 1111, 1, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id_photo` int(5) NOT NULL AUTO_INCREMENT,
  `way_photo` varchar(20) NOT NULL,
  `style_photo` int(10) NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id_photo`, `way_photo`, `style_photo`) VALUES
(1, '1.jpg', 1),
(2, '2.jpg', 2),
(3, '3.jpg', 1),
(5, '1.jpg', 1),
(6, '2.jpg', 2),
(15, '1.jpg', 1),
(25, '-Xn22Ga5Xjo.jpg', 1),
(26, '1.jpg', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `price_list`
--

CREATE TABLE IF NOT EXISTS `price_list` (
  `service` varchar(20) NOT NULL,
  `price_per_hour` int(10) NOT NULL,
  PRIMARY KEY (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `studio`
--

CREATE TABLE IF NOT EXISTS `studio` (
  `id_photostudio` int(10) NOT NULL AUTO_INCREMENT,
  `name_studio` varchar(30) NOT NULL,
  `id_district` int(4) NOT NULL,
  `name_photo` varchar(20) NOT NULL,
  `name_hall` varchar(30) NOT NULL,
  `price_per_hour` int(5) NOT NULL,
  `link_web` varchar(30) NOT NULL,
  `address` varchar(40) NOT NULL,
  `keywords` varchar(3000) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_photostudio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `style`
--

CREATE TABLE IF NOT EXISTS `style` (
  `id_style` int(10) NOT NULL AUTO_INCREMENT,
  `style_photo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_style`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `style`
--

INSERT INTO `style` (`id_style`, `style_photo`) VALUES
(1, 'Портреты'),
(2, 'Свадьбы');

-- --------------------------------------------------------

--
-- Структура таблицы `type_location`
--

CREATE TABLE IF NOT EXISTS `type_location` (
  `id_type_location` int(4) NOT NULL AUTO_INCREMENT,
  `name_type_location` varchar(20) NOT NULL,
  PRIMARY KEY (`id_type_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` int(2) NOT NULL,
  `FIO` varchar(40) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `role`, `FIO`) VALUES
(2, 'lera', '1234567890', 10, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
