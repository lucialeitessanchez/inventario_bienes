-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-07-2022 a las 10:34:23
-- Versión del servidor: 8.0.29-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stock_consumibles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumible`
--

CREATE TABLE `consumible` (
  `id` bigint NOT NULL,
  `cantidad` double NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `dispositivo_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `consumible`
--

INSERT INTO `consumible` (`id`, `cantidad`, `modelo`, `nombre`, `dispositivo_id`) VALUES
(1, 2, '120 Gb', 'SSD HP', 1),
(2, 2, '550w', 'Fuente Performance', 1),
(4, 3, 'ES - Latam', 'Teclado Performance', 1),
(5, 2, 'ES - Latam', 'Mouse Performance', 1),
(6, 16, '1,5m Cat 6', 'Patchcord FURUKAWA', 1),
(7, 6, '3.2 64 Gb', 'Pendrive KINGSTON', 1),
(8, 2, 'L0S68A - EPH954XLY', 'Cartucho GNEISS amarillo', 5),
(9, 1, 'L0S65A - EPH954XLM', 'Cartucho GNEISS magenta', 5),
(10, 1, 'L0S62A - EPH954XLC', 'Cartucho GNEISS cyan', 5),
(11, 2, 'L0S71A - EPH954XLB', 'Cartucho GNEISS negro', 5),
(15, 9, 'cf217A c/ chip', 'Toner genérico', 6),
(16, 3, 'cf219A c/ chip', 'Tambor genérico', 6),
(19, 2, '550w reciclada', 'Fuente genérica', 1),
(20, 0, 'CF226 sin chip', 'Toner genérico', 4),
(21, 3, '2,5m Cat 6', 'Patchcord FURUKAWA', 1),
(22, 10, 'ES - Latam', 'Combo inalámbrico Genius', 1),
(23, 7, 'TN660', 'Toner genérico', 7),
(24, 3, 'DR660', 'Tambor genérico', 7),
(25, 3, 'SAMD101S', 'Toner genérico', 8),
(26, 13, 'SP3710DN', 'Toner-Tambor genérico', 3),
(27, 0, 'TN1060', 'Toner genérico', 9),
(28, 0, 'DR1060', 'Tambor genérico', 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consumible`
--
ALTER TABLE `consumible`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK5p2sthxgu6rr1i2albw79itk3` (`dispositivo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consumible`
--
ALTER TABLE `consumible`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consumible`
--
ALTER TABLE `consumible`
  ADD CONSTRAINT `FK5p2sthxgu6rr1i2albw79itk3` FOREIGN KEY (`dispositivo_id`) REFERENCES `dispositivo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
