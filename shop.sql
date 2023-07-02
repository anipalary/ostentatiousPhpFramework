-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 05 2023 г., 16:37
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` int NOT NULL,
  `category` int NOT NULL,
  `img` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `price`, `category`, `img`) VALUES
(1, 'Hard Drive, HDD, 500GB', 2000, 1, 'img/hard.png'),
(2, 'motherboard', 5000, 3, 'img/matb.png'),
(3, 'RАМ, 8GB', 1000, 2, 'img/ram.png'),
(4, 'RАМ, 8GB, RGB', 1500, 2, 'img/coolram.png'),
(5, 'SSD, 12068', 3000, 1, 'img/ssd.png'),
(6, 'GTX 1080 ti', 50000, 4, 'img/ti.png'),
(7, 'RАМ, 2x8GB', 4000, 2, 'img/2080.jpg'),
(8, 'LAPTOP RAM', 500, 2, 'img/lapt.jpg'),
(9, 'SATA SSD', 3000, 1, 'img/sata.jpg'),
(10, 'Kingstone drive', 1000, 1, 'img/king.jpg'),
(11, 'RTX 2080 ti', 100000, 4, 'img/2080.jpg'),
(12, 'gigabite GPU', 80000, 4, 'img/gg.jpg'),
(13, 'Paspberry Pi', 300, 3, 'img/malina.jpg'),
(14, 'MSI GeForce RTX 3070', 100000, 4, NULL),
(15, 'MSI RTX 3090 Gaming X Trio', 200000, 4, NULL),
(16, 'Nvidia GeForce RTX 3080 Ti', 30000, 4, NULL),
(17, 'Nvidia GeForce GTX 1660 Ti', 70000, 4, NULL),
(18, 'AMD Radeon RX 6800', 500000, 4, NULL),
(19, 'Gigabyte Aorus GeForce RTX 3080', 100000, 4, NULL),
(20, 'Paspbery Pi', 300, 3, 'img/malina.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `categorys`
--

CREATE TABLE `categorys` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categorys`
--

INSERT INTO `categorys` (`id`, `name`) VALUES
(1, 'Hard drives'),
(2, 'Ram'),
(3, 'Motherboards'),
(4, 'GPU\'s');

-- --------------------------------------------------------

--
-- Структура таблицы `kategorii`
--

CREATE TABLE `kategorii` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `kategorii`
--

INSERT INTO `kategorii` (`id`, `name`) VALUES
(1, 'OLED'),
(2, 'IPS');

-- --------------------------------------------------------

--
-- Структура таблицы `tovari`
--

CREATE TABLE `tovari` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` int NOT NULL,
  `category` int NOT NULL,
  `img` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tovari`
--

INSERT INTO `tovari` (`id`, `name`, `price`, `category`, `img`) VALUES
(21, 'SAMSUNG OLEG FULL HD', 20000, 1, 'img/1.png'),
(22, 'SONY IPS 4K', 50000, 2, 'img/2.png'),
(23, 'IBM IPS 480p', 2000, 2, 'img/3.png'),
(24, 'NOKIA 720p 120hz', 10000, 2, 'img/4.png'),
(25, 'LG OLED 2K', 40000, 1, 'img/5.png'),
(26, 'YANDEX SMART TV', 100000, 1, 'img/6.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `kategorii`
--
ALTER TABLE `kategorii`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tovari`
--
ALTER TABLE `tovari`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `kategorii`
--
ALTER TABLE `kategorii`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tovari`
--
ALTER TABLE `tovari`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
