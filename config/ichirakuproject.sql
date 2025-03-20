-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2025 a las 20:09:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ichirakuproject`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animes`
--

CREATE TABLE `animes` (
  `anime_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `total_chapters` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animes`
--

INSERT INTO `animes` (`anime_id`, `title`, `description`, `year`, `genre`, `total_chapters`) VALUES
(1, 'Naruto', 'Un ninja adolescent que somia ser Hokage.', 2002, 'Acció, Aventura, Shonen', 220),
(2, 'One Piece', 'Un pirata anomenat Luffy busca el tresor One Piece.', 1999, 'Aventura, Acció, Shonen', 1100),
(3, 'Bleach', 'Ichigo Kurosaki obté poders de Shinigami.', 2004, 'Acció, Sobrenatural, Shonen', 366),
(4, 'Dragon Ball', 'Goku viatja pel món buscant les Boles de Drac.', 1986, 'Acció, Aventura, Shonen', 153),
(5, 'Black Clover', 'Dos orfes volen convertir-se en el Rei Mag.', 2017, 'Acció, Fantasia, Shonen', 170);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anime_stats`
--

CREATE TABLE `anime_stats` (
  `stat_id` int(11) NOT NULL,
  `stat_name` enum('Vist','Seguint','Pensat Veure','Deixat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anime_stats`
--

INSERT INTO `anime_stats` (`stat_id`, `stat_name`) VALUES
(1, 'Vist'),
(2, 'Seguint'),
(3, 'Pensat Veure'),
(4, 'Deixat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anime_users`
--

CREATE TABLE `anime_users` (
  `anime_users_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `anime_id` int(11) DEFAULT NULL,
  `stat_id` int(11) DEFAULT NULL,
  `chapter` int(11) DEFAULT NULL,
  `updatet_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anime_users`
--

INSERT INTO `anime_users` (`anime_users_id`, `user_id`, `anime_id`, `stat_id`, `chapter`, `updatet_at`) VALUES
(1, 1, 1, 1, 1, '2025-02-27 18:17:49'),
(2, 1, 2, 2, 2, '2025-02-27 18:17:49'),
(3, 3, 3, 3, 1, '2025-02-27 18:17:49'),
(4, 3, 4, 4, 2, '2025-02-27 18:17:49'),
(5, 6, 5, 1, 1, '2025-02-27 18:17:49'),
(6, 6, 1, 3, 2, '2025-02-27 18:40:05'),
(7, 6, 1, 1, 3, '2025-03-13 18:10:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `anime_id` int(11) DEFAULT NULL,
  `score` decimal(3,1) DEFAULT NULL CHECK (`score` between 1 and 10),
  `comment` text DEFAULT NULL,
  `release_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`rating_id`, `user_id`, `anime_id`, `score`, `comment`, `release_date`) VALUES
(1, 1, 1, 9.5, 'Naruto és un clàssic!', '2025-02-27 18:11:42'),
(2, 1, 2, 10.0, 'One Piece és increïble!', '2025-02-27 18:11:42'),
(3, 3, 3, 8.0, 'Bleach està bé, però té massa farciment.', '2025-02-27 18:11:42'),
(4, 3, 4, 7.5, 'Dragon Ball és una llegenda.', '2025-02-27 18:11:42'),
(5, 6, 5, 9.0, 'Black Clover és molt emocionant!', '2025-02-27 18:11:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats`
--

CREATE TABLE `stats` (
  `user_id` int(11) NOT NULL,
  `total_hours_watched` int(11) DEFAULT 0,
  `total_anime_completed` int(11) DEFAULT 0,
  `total_anime_following` int(11) DEFAULT 0,
  `total_anime_planned_to_watch` int(11) DEFAULT 0,
  `total_anime_dropped` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stats`
--

INSERT INTO `stats` (`user_id`, `total_hours_watched`, `total_anime_completed`, `total_anime_following`, `total_anime_planned_to_watch`, `total_anime_dropped`) VALUES
(1, 500, 1, 1, 0, 0),
(3, 300, 1, 0, 1, 0),
(6, 150, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Pepe', 'pepe@gmail.com', '12345678'),
(3, 'Fidel', 'fidel@gmail.com', '12345678'),
(6, 'Guillem', 'guillem@gmail.com', '1234'),
(7, 'Joan', 'joan@gmail.com', '$2y$10$LDO1Wo.dNgHyloLikdbFO.5ajVZ/LhSO2EqJ6dmtUvQ.CeTtZA5Na'),
(8, 'admin', 'admin@admin.com', 'admin'),
(10, 'test', 'test@test.com', '$2y$10$RUwWgd1zRqC9FefNhn3gl.OGIgcNxns2qBdCKIzJu04HLKWU.Hw/6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`anime_id`);

--
-- Indices de la tabla `anime_stats`
--
ALTER TABLE `anime_stats`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indices de la tabla `anime_users`
--
ALTER TABLE `anime_users`
  ADD PRIMARY KEY (`anime_users_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `stat_id` (`stat_id`);

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Indices de la tabla `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animes`
--
ALTER TABLE `animes`
  MODIFY `anime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `anime_stats`
--
ALTER TABLE `anime_stats`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `anime_users`
--
ALTER TABLE `anime_users`
  MODIFY `anime_users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anime_users`
--
ALTER TABLE `anime_users`
  ADD CONSTRAINT `anime_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `anime_users_ibfk_2` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`anime_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `anime_users_ibfk_3` FOREIGN KEY (`stat_id`) REFERENCES `anime_stats` (`stat_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`anime_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `stats_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
