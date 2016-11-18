-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 18 2016 г., 20:30
-- Версия сервера: 5.5.50
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `country`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `id_country` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`, `id_country`) VALUES
(1, 'Киев', 1),
(2, 'Харьков', 1),
(3, 'Запорожье', 1),
(4, 'Днепропетровск', 1),
(5, 'Львов', 1),
(6, 'Одесса', 1),
(7, 'Черновцы', 1),
(8, 'Москва', 2),
(9, 'Хабаровск', 2),
(10, 'Тула', 2),
(11, 'Пермь', 2),
(12, 'Сочи', 2),
(29, 'Гоа', 27),
(31, 'Мумбаи', 27);

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Украина'),
(2, 'Россия'),
(3, 'Польша'),
(5, 'Словакия'),
(6, 'Черногория'),
(8, 'Австрия'),
(26, 'Вьетнам'),
(27, 'Индия'),
(28, 'Бангладеш');

-- --------------------------------------------------------

--
-- Структура таблицы `country_lang`
--

CREATE TABLE IF NOT EXISTS `country_lang` (
  `id` int(11) NOT NULL,
  `id_lang` int(11) NOT NULL,
  `id_country` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `country_lang`
--

INSERT INTO `country_lang` (`id`, `id_lang`, `id_country`) VALUES
(1, 1, 1),
(7, 1, 2),
(2, 2, 1),
(8, 2, 2),
(3, 3, 1),
(9, 3, 2),
(10, 4, 2),
(11, 6, 2),
(5, 7, 1),
(12, 7, 2),
(6, 8, 1),
(13, 8, 2),
(19, 17, 27);

-- --------------------------------------------------------

--
-- Структура таблицы `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lang`
--

INSERT INTO `lang` (`id`, `name`) VALUES
(1, 'Украинский'),
(2, 'Русский'),
(3, 'Белорусский'),
(4, 'Узбецкий'),
(6, 'Китайский'),
(7, 'Грузинский'),
(8, 'Армянский'),
(17, 'Английский');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_country` (`id_country`);

--
-- Индексы таблицы `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Индексы таблицы `country_lang`
--
ALTER TABLE `country_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lang` (`id_lang`,`id_country`),
  ADD KEY `id_country` (`id_country`);

--
-- Индексы таблицы `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `country_lang`
--
ALTER TABLE `country_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `country_lang`
--
ALTER TABLE `country_lang`
  ADD CONSTRAINT `country_lang_ibfk_2` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `country_lang_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
