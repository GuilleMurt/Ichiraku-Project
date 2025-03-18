-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 27-02-2025 a les 19:22:23
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `ichirakuproject`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `amistats`
--

CREATE TABLE `amistats` (
  `id_amistat` int(11) NOT NULL,
  `id_usuari1` int(11) DEFAULT NULL,
  `id_usuari2` int(11) DEFAULT NULL,
  `estat` enum('Pendent','Acceptat','Rebutjat') DEFAULT 'Pendent',
  `data_sollicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `amistats`
--

INSERT INTO `amistats` (`id_amistat`, `id_usuari1`, `id_usuari2`, `estat`, `data_sollicitud`) VALUES
(4, 1, 3, 'Acceptat', '2025-02-27 18:20:18'),
(5, 3, 6, 'Pendent', '2025-02-27 18:20:18'),
(6, 6, 1, 'Acceptat', '2025-02-27 18:20:18');

-- --------------------------------------------------------

--
-- Estructura de la taula `animes`
--

CREATE TABLE `animes` (
  `id_anime` int(11) NOT NULL,
  `titol` varchar(255) NOT NULL,
  `descripcio` text DEFAULT NULL,
  `any` int(11) DEFAULT NULL,
  `genere` varchar(255) DEFAULT NULL,
  `total_episodis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `animes`
--

INSERT INTO `animes` (`id_anime`, `titol`, `descripcio`, `any`, `genere`, `total_episodis`) VALUES
(1, 'Naruto', 'Un ninja adolescent que somia ser Hokage.', 2002, 'Acció, Aventura, Shonen', 220),
(2, 'One Piece', 'Un pirata anomenat Luffy busca el tresor One Piece.', 1999, 'Aventura, Acció, Shonen', 1100),
(3, 'Bleach', 'Ichigo Kurosaki obté poders de Shinigami.', 2004, 'Acció, Sobrenatural, Shonen', 366),
(4, 'Dragon Ball', 'Goku viatja pel món buscant les Boles de Drac.', 1986, 'Acció, Aventura, Shonen', 153),
(5, 'Black Clover', 'Dos orfes volen convertir-se en el Rei Mag.', 2017, 'Acció, Fantasia, Shonen', 170);

-- --------------------------------------------------------

--
-- Estructura de la taula `episodis`
--

CREATE TABLE `episodis` (
  `id_episodi` int(11) NOT NULL,
  `id_anime` int(11) DEFAULT NULL,
  `numero_episodi` int(11) NOT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `duracio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `episodis`
--

INSERT INTO `episodis` (`id_episodi`, `id_anime`, `numero_episodi`, `titol`, `duracio`) VALUES
(1, 1, 1, 'Naruto Uzumaki!', 23),
(2, 1, 2, 'El meu nom és Konohamaru!', 23),
(3, 2, 1, 'Jo sóc Luffy! L’home que es convertirà en el Rei dels Pirates!', 24),
(4, 3, 1, 'El dia que em vaig convertir en Shinigami', 22),
(5, 4, 1, 'Bola de Drac apareix', 25),
(6, 5, 1, 'Asta i Yuno', 24);

-- --------------------------------------------------------

--
-- Estructura de la taula `episodis_vistos`
--

CREATE TABLE `episodis_vistos` (
  `id_vist` int(11) NOT NULL,
  `id_usuari` int(11) DEFAULT NULL,
  `id_episodi` int(11) DEFAULT NULL,
  `data_vist` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `episodis_vistos`
--

INSERT INTO `episodis_vistos` (`id_vist`, `id_usuari`, `id_episodi`, `data_vist`) VALUES
(1, 1, 1, '2025-02-27 18:13:53'),
(2, 3, 3, '2025-02-27 18:13:53'),
(3, 6, 6, '2025-02-27 18:13:53');

-- --------------------------------------------------------

--
-- Estructura de la taula `estadistiques`
--

CREATE TABLE `estadistiques` (
  `id_usuari` int(11) NOT NULL,
  `total_hores_vistes` int(11) DEFAULT 0,
  `total_animes_completats` int(11) DEFAULT 0,
  `total_animes_seguits` int(11) DEFAULT 0,
  `total_animes_pensats_veure` int(11) DEFAULT 0,
  `total_animes_deixats` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `estadistiques`
--

INSERT INTO `estadistiques` (`id_usuari`, `total_hores_vistes`, `total_animes_completats`, `total_animes_seguits`, `total_animes_pensats_veure`, `total_animes_deixats`) VALUES
(1, 500, 1, 1, 0, 0),
(3, 300, 1, 0, 1, 0),
(6, 150, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `estats_anime`
--

CREATE TABLE `estats_anime` (
  `id_estat` int(11) NOT NULL,
  `nom_estat` enum('Vist','Seguint','Pensat Veure','Deixat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `estats_anime`
--

INSERT INTO `estats_anime` (`id_estat`, `nom_estat`) VALUES
(1, 'Vist'),
(2, 'Seguint'),
(3, 'Pensat Veure'),
(4, 'Deixat');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuaris`
--

CREATE TABLE `usuaris` (
  `id_usuari` int(11) NOT NULL,
  `nom_usuari` varchar(50) NOT NULL,
  `correu_usuari` varchar(100) NOT NULL,
  `contrasenya_usuari` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `usuaris`
--

INSERT INTO `usuaris` (`id_usuari`, `nom_usuari`, `correu_usuari`, `contrasenya_usuari`) VALUES
(1, 'Pepe', 'pepe@gmail.com', '12345678'),
(3, 'Fidel', 'fidel@gmail.com', '12345678'),
(6, 'Guillem', 'guillem@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuari_anime`
--

CREATE TABLE `usuari_anime` (
  `id_usuari_anime` int(11) NOT NULL,
  `id_usuari` int(11) DEFAULT NULL,
  `id_anime` int(11) DEFAULT NULL,
  `id_estat` int(11) DEFAULT NULL,
  `data_actualitzacio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `usuari_anime`
--

INSERT INTO `usuari_anime` (`id_usuari_anime`, `id_usuari`, `id_anime`, `id_estat`, `data_actualitzacio`) VALUES
(1, 1, 1, 1, '2025-02-27 18:17:49'),
(2, 1, 2, 2, '2025-02-27 18:17:49'),
(3, 3, 3, 3, '2025-02-27 18:17:49'),
(4, 3, 4, 4, '2025-02-27 18:17:49'),
(5, 6, 5, 1, '2025-02-27 18:17:49');

-- --------------------------------------------------------

--
-- Estructura de la taula `valoracions`
--

CREATE TABLE `valoracions` (
  `id_valoracio` int(11) NOT NULL,
  `id_usuari` int(11) DEFAULT NULL,
  `id_anime` int(11) DEFAULT NULL,
  `puntuacio` decimal(3,1) DEFAULT NULL CHECK (`puntuacio` between 1 and 10),
  `comentari` text DEFAULT NULL,
  `data_publicacio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `valoracions`
--

INSERT INTO `valoracions` (`id_valoracio`, `id_usuari`, `id_anime`, `puntuacio`, `comentari`, `data_publicacio`) VALUES
(1, 1, 1, 9.5, 'Naruto és un clàssic!', '2025-02-27 18:11:42'),
(2, 1, 2, 10.0, 'One Piece és increïble!', '2025-02-27 18:11:42'),
(3, 3, 3, 8.0, 'Bleach està bé, però té massa farciment.', '2025-02-27 18:11:42'),
(4, 3, 4, 7.5, 'Dragon Ball és una llegenda.', '2025-02-27 18:11:42'),
(5, 6, 5, 9.0, 'Black Clover és molt emocionant!', '2025-02-27 18:11:42');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `amistats`
--
ALTER TABLE `amistats`
  ADD PRIMARY KEY (`id_amistat`),
  ADD KEY `id_usuari1` (`id_usuari1`),
  ADD KEY `id_usuari2` (`id_usuari2`);

--
-- Índexs per a la taula `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id_anime`);

--
-- Índexs per a la taula `episodis`
--
ALTER TABLE `episodis`
  ADD PRIMARY KEY (`id_episodi`),
  ADD KEY `id_anime` (`id_anime`);

--
-- Índexs per a la taula `episodis_vistos`
--
ALTER TABLE `episodis_vistos`
  ADD PRIMARY KEY (`id_vist`),
  ADD KEY `id_usuari` (`id_usuari`),
  ADD KEY `id_episodi` (`id_episodi`);

--
-- Índexs per a la taula `estadistiques`
--
ALTER TABLE `estadistiques`
  ADD PRIMARY KEY (`id_usuari`);

--
-- Índexs per a la taula `estats_anime`
--
ALTER TABLE `estats_anime`
  ADD PRIMARY KEY (`id_estat`);

--
-- Índexs per a la taula `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id_usuari`),
  ADD UNIQUE KEY `correu_usuari` (`correu_usuari`);

--
-- Índexs per a la taula `usuari_anime`
--
ALTER TABLE `usuari_anime`
  ADD PRIMARY KEY (`id_usuari_anime`),
  ADD KEY `id_usuari` (`id_usuari`),
  ADD KEY `id_anime` (`id_anime`),
  ADD KEY `id_estat` (`id_estat`);

--
-- Índexs per a la taula `valoracions`
--
ALTER TABLE `valoracions`
  ADD PRIMARY KEY (`id_valoracio`),
  ADD KEY `id_usuari` (`id_usuari`),
  ADD KEY `id_anime` (`id_anime`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `amistats`
--
ALTER TABLE `amistats`
  MODIFY `id_amistat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la taula `animes`
--
ALTER TABLE `animes`
  MODIFY `id_anime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `episodis`
--
ALTER TABLE `episodis`
  MODIFY `id_episodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la taula `episodis_vistos`
--
ALTER TABLE `episodis_vistos`
  MODIFY `id_vist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `estats_anime`
--
ALTER TABLE `estats_anime`
  MODIFY `id_estat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la taula `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id_usuari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la taula `usuari_anime`
--
ALTER TABLE `usuari_anime`
  MODIFY `id_usuari_anime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `valoracions`
--
ALTER TABLE `valoracions`
  MODIFY `id_valoracio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `amistats`
--
ALTER TABLE `amistats`
  ADD CONSTRAINT `amistats_ibfk_1` FOREIGN KEY (`id_usuari1`) REFERENCES `usuaris` (`id_usuari`) ON DELETE CASCADE,
  ADD CONSTRAINT `amistats_ibfk_2` FOREIGN KEY (`id_usuari2`) REFERENCES `usuaris` (`id_usuari`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `episodis`
--
ALTER TABLE `episodis`
  ADD CONSTRAINT `episodis_ibfk_1` FOREIGN KEY (`id_anime`) REFERENCES `animes` (`id_anime`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `episodis_vistos`
--
ALTER TABLE `episodis_vistos`
  ADD CONSTRAINT `episodis_vistos_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id_usuari`) ON DELETE CASCADE,
  ADD CONSTRAINT `episodis_vistos_ibfk_2` FOREIGN KEY (`id_episodi`) REFERENCES `episodis` (`id_episodi`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `estadistiques`
--
ALTER TABLE `estadistiques`
  ADD CONSTRAINT `estadistiques_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id_usuari`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `usuari_anime`
--
ALTER TABLE `usuari_anime`
  ADD CONSTRAINT `usuari_anime_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id_usuari`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuari_anime_ibfk_2` FOREIGN KEY (`id_anime`) REFERENCES `animes` (`id_anime`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuari_anime_ibfk_3` FOREIGN KEY (`id_estat`) REFERENCES `estats_anime` (`id_estat`);

--
-- Restriccions per a la taula `valoracions`
--
ALTER TABLE `valoracions`
  ADD CONSTRAINT `valoracions_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id_usuari`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoracions_ibfk_2` FOREIGN KEY (`id_anime`) REFERENCES `animes` (`id_anime`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
