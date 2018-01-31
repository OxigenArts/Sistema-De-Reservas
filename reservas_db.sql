-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2018 a las 14:11:33
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apikey`
--

CREATE TABLE `apikey` (
  `id` int(11) NOT NULL,
  `api_key` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `apikey`
--

INSERT INTO `apikey` (`id`, `api_key`, `user_id`) VALUES
(1, '$2y$10$DMO4GyJuB.94DunV9ZPDde9TZX94vCSpphPPXZS6YNfgeZAn1ASBW', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Sin Categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `date`
--

CREATE TABLE `date` (
  `id` int(11) NOT NULL,
  `json` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `date`
--

INSERT INTO `date` (`id`, `json`, `user_id`) VALUES
(2, '{\r\n  \"name\": \"angel\",\r\n  \"lastname\": \"gonzales\"\r\n}', 12),
(3, '{\r\n  \"name\": \"yeni\",\r\n  \"lastname\": \"gonzales\"\r\n}', 12),
(4, '{\r\n  \"name\": \"jose\",\r\n  \"lastname\": \"gonzales\"\r\n}', 12),
(5, '{\r\n  \"name\": \"angel\",\r\n  \"lastname\": \"gonzales\"\r\n}', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directory`
--

CREATE TABLE `directory` (
  `id` int(11) NOT NULL,
  `json` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `json` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180127020450, 'CreateUsers', '2018-01-27 01:15:34', '2018-01-27 01:15:34', 0),
(20180127020456, 'CreateDate', '2018-01-27 01:15:34', '2018-01-27 01:15:35', 0),
(20180127020500, 'CreateCategory', '2018-01-27 01:15:35', '2018-01-27 01:15:36', 0),
(20180127020506, 'CreateSubcategory', '2018-01-27 01:15:36', '2018-01-27 01:15:39', 0),
(20180127020512, 'CreateProfile', '2018-01-27 01:15:39', '2018-01-27 01:15:43', 0),
(20180127020516, 'CreateRoutines', '2018-01-27 01:15:43', '2018-01-27 01:15:47', 0),
(20180127020519, 'CreateForms', '2018-01-27 01:15:48', '2018-01-27 01:15:54', 0),
(20180127020526, 'CreateDirectory', '2018-01-27 01:15:54', '2018-01-27 01:15:57', 0),
(20180130142552, 'CreateApikey', '2018-01-30 13:58:21', '2018-01-30 13:58:21', 0),
(20180130142634, 'CreateUsers', '2018-01-30 13:58:21', '2018-01-30 13:58:22', 0),
(20180130142722, 'CreateRoutines', '2018-01-30 13:58:22', '2018-01-30 13:58:23', 0),
(20180130142814, 'CreateProfile', '2018-01-30 13:58:23', '2018-01-30 13:58:24', 0),
(20180130142855, 'CreatePhotos', '2018-01-30 13:58:24', '2018-01-30 13:58:25', 0),
(20180130142925, 'CreateForms', '2018-01-30 13:58:25', '2018-01-30 13:58:26', 0),
(20180130142951, 'CreateDirectory', '2018-01-30 13:58:26', '2018-01-30 13:58:27', 0),
(20180130143024, 'CreateReservation', '2018-01-30 13:58:27', '2018-01-30 13:58:27', 0),
(20180130143244, 'CreateSubcategory', '2018-01-30 13:58:27', '2018-01-30 13:58:28', 0),
(20180130143500, 'CreateCategory', '2018-01-30 13:58:28', '2018-01-30 13:58:28', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `photos`
--

INSERT INTO `photos` (`id`, `url`, `user_id`) VALUES
(1, 'https://dxj1e0bbbefdtsyig.woldrssl.net/wp-content/uploads/2018/01/1205-205x137.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `json` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`id`, `json`, `user_id`, `photo_id`) VALUES
(13, 'Laksksajamsnb', 3, 1),
(15, 'Laksksajamsnb', 12, 1),
(16, 'qhshgjadbjd', 26, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('acepted','denied','pending') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routines`
--

CREATE TABLE `routines` (
  `id` int(11) NOT NULL,
  `json` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8_spanish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` enum('active','denied','pending','processing') COLLATE utf8_spanish_ci NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `category_id`, `status`, `subcategory_id`, `profile_id`) VALUES
(3, 'admin', '1234', 'admin', 1, 'active', 0, 0),
(10, 'jose', '$2y$10$jLO7KEG5/vx6jbZyZJadLu60jPZ.q/Y81MFi555vWu/NPEw9wgbf.', 'user', 1, 'active', 0, 0),
(11, 'angel', '$2y$10$KVqg75guXjiA.Yi90cq1teZspAChL7AjAOz4ZUpGaOzTuCDcO.smq', 'user', 1, 'active', 0, 0),
(12, 'yeni69', '$2y$10$.JLP7UwXs6PEdKipLRB2Aegg4IrgtZLdQlo6ClaNRJ7gbOpEEH6dO', 'admin', 1, 'active', 0, 0),
(13, 'valdemaro04', '$2y$10$fU3GAxgTnB0n3vz8FQ90S.DCU5RcwqU/o1UO8Ikt2OE4hxOF2TKdy', 'user', 1, 'active', 0, 0),
(14, 'Dissan', '', 'user', 1, 'active', 0, 0),
(15, 'carlos', '1234', 'user', 1, 'active', 0, 0),
(16, 'card', '1234', 'user', 1, 'active', 0, 0),
(17, 'cardy', '1234', 'user', 1, 'active', 0, 0),
(18, 'cardys', '1234', 'user', 1, 'active', 0, 0),
(19, 'cardysi', '$2y$10$qxCvx2dEjTVeVlUeVCwOnOZKyBIQWkNi8xHq9in38ztTHpwSaf7GG', 'user', 1, 'active', 0, 0),
(20, 'sedtri', '$2y$10$smP0XhKyRBK3dhr1dzTwe.r9AKHrdw5ECZRotP4z9gZt3Z7FK5ox.', 'user', 1, 'active', 0, 0),
(21, 'coso', '$2y$10$9EEEWJ022ueAUX02nnTPFO/3M3y0hOvbO2HWRzb6O0v31wX5EjVEq', 'user', 1, 'active', 0, 0),
(22, 'jAS', '$2y$10$mwLZ3XGT0szClhc.8.kmlOcjvvs9KqvTD/SskccTsH1WBiNGkkjua', 'user', 1, 'active', 0, 0),
(26, 'pepito', '$2y$10$Baj8jh38V0co04c7uDZxUu6XA42GgFEcrWcwkKpoYYs0KHSvOFRLC', 'admin', 1, 'active', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apikey`
--
ALTER TABLE `apikey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `directory`
--
ALTER TABLE `directory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `imagen_id` (`photo_id`);

--
-- Indices de la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_ibfk_1` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`category_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apikey`
--
ALTER TABLE `apikey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `date`
--
ALTER TABLE `date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `directory`
--
ALTER TABLE `directory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apikey`
--
ALTER TABLE `apikey`
  ADD CONSTRAINT `apikey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `date`
--
ALTER TABLE `date`
  ADD CONSTRAINT `date_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `directory`
--
ALTER TABLE `directory`
  ADD CONSTRAINT `directory_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `routines`
--
ALTER TABLE `routines`
  ADD CONSTRAINT `routines_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
