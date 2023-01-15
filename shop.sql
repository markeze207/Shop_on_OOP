-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 16 2023 г., 00:21
-- Версия сервера: 10.4.26-MariaDB-log
-- Версия PHP: 8.0.22

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
-- Структура таблицы `blog`
--

CREATE TABLE `blog` (
  `ID` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`ID`, `user_id`, `date`, `title`, `text`, `image`, `rating`) VALUES
(1, 1, '2023-01-15 17:05:27', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\n\n', 'blog-one.jpg', 0),
(2, 2, '2023-01-15 17:05:52', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\n\n', 'blog-three.jpg', 0),
(3, 2, '2023-01-15 17:05:52', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. HELLO WORLD\n\n', 'blog-two.jpg', 3),
(4, 1, '2023-01-15 18:57:08', 'dsadasd', 'asdasdsadasdasdasd', 'blog-three.jpg', 1),
(5, 1, '2023-01-15 18:57:08', 'dasdas', 'dsadad', 'blog-three.jpg', 1),
(6, 1, '2023-01-15 18:57:16', 'sdasdasdas', 'dasdasd', 'blog-three.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`ID`, `name`, `sort_order`, `status`) VALUES
(1, 'ACNE', 1, 1),
(2, 'Nike', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`ID`, `name`, `sort_order`, `status`) VALUES
(1, 'Женское', 1, 1),
(2, 'Мужское', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(2) NOT NULL,
  `brand_id` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availlabillity` int(11) NOT NULL,
  `brand` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_new` int(1) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`ID`, `name`, `category_id`, `brand_id`, `code`, `price`, `availlabillity`, `brand`, `image`, `description`, `is_new`, `status`) VALUES
(1, 'dsadad', 1, 1, 123, 2222, 1, 'ACNE', 'product1.jpg', 'dsad', 1, 1),
(2, 'dsadad', 1, 1, 123, 1234, 1, 'dsasd', 'product2.jpg', 'dsad', 1, 1),
(3, 'dsadad', 1, 1, 123, 12345, 1, 'NIKE', 'product3.jpg', 'dsad', 0, 1),
(4, 'dsadad', 1, 1, 123, 123456, 1, 'dsasd', 'product4.jpg', 'dsad', 1, 1),
(5, 'dsadad', 2, 2, 123, 12344, 1, 'NIKE', 'product5.jpg', 'dsad', 1, 1),
(6, 'dsadad', 1, 1, 123, 123, 1, 'dsasd', 'product6.jpg', 'dsad', 0, 1),
(7, 'вфывфы', 1, 1, 123, 1235, 1, '1', 'product1.jpg', '1231', 1, 1),
(8, 'вфывфы', 1, 0, 123, 12333, 1, '1', 'product2.jpg', '1231', 1, 1),
(9, 'вфывфы', 1, 1, 123, 1234, 1, '1', 'product3.jpg', '1231', 1, 1),
(10, 'вфывфы', 1, 1, 123, 1234, 1, '1', 'product4.jpg', '1231', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `ID` int(11) NOT NULL,
  `user_FCS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`ID`, `user_FCS`, `user_phone`, `user_address`, `user_id`, `date`, `products`, `status`) VALUES
(1, 'dsadasd', '1234567891', 'dsadasdas', 12, '2023-01-13 20:18:42', '12313', 1),
(2, 'xsaxadsasd', '1234567890', 'dsadas', NULL, '2023-01-13 20:19:58', '{\"10\":29,\"9\":9,\"8\":2,\"7\":1,\"6\":\"2\"}', 1),
(3, '12312', '123123', '12312', 0, '2023-01-13 20:22:08', '1231', 1),
(4, 'dasdasdasd', '1234567890', '123', NULL, '2023-01-13 20:23:22', '{\"10\":1}', 1),
(5, 'dasdasdasd', '1234567890', '123', NULL, '2023-01-13 20:23:53', 'false', 1),
(6, 'asdasd', '0957867816', 'Ул.Пушкина Д.Долбаебский', 4, '2023-01-13 20:25:19', '{\"10\":\"10\"}', 1),
(7, 'asdasd', '0957867816', 'Ул.Пушкина Д.Долбаебский', 4, '2023-01-13 20:25:36', 'false', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID`, `name`, `email`, `password`) VALUES
(1, 'dsad', 'markezeafu@gmail.com', '123'),
(2, 'sdasdasd', 'markezeafu1@gmail.com', '$2y$10$d2nFf1R1qixN6GiwBB0FHeTlU3u03IYc1xOMqt.T3aMwU2HMoaqL6'),
(3, 'sdasdasd', 'markezeafu12@gmail.com', '$2y$10$UoXCnT1NbpCYY58cqP7.MemhpcB7.okgE/D68JOdFcovJW2SHWIuC'),
(4, 'admin', 'admin@gmail.com', '$2y$10$jhiXrSFjiaLOf61aytxX5.J.ys.yn71kg8TlYIsqy7fNXeKFR9Xwq');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
