-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-07-2022 a las 10:34:52
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
-- Estructura de tabla para la tabla `dispositivo`
--

CREATE TABLE `dispositivo` (
  `id` bigint NOT NULL,
  `cantidad` int NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`id`, `cantidad`, `descripcion`, `ubicacion`) VALUES
(1, 1, 'Depósito Conducción Central', 'Corrientes 2879'),
(2, 1, 'Depósito Anexo', 'Juan de Garay 2967'),
(3, 2, 'Impresora RICOH SP 3710DN', 'Corrientes 2879'),
(4, 1, 'Impresora HP M426fdw', 'Juan de Garay 2967'),
(5, 2, 'Impresora HP OfficeJet Pro 8710', 'Corrientes 2879, Juan de Garay 2967'),
(6, 1, 'Impresora HP LaserJet MFP M130fw', 'Corrientes 2879'),
(7, 1, 'Impresora Brother MFC-L2720DW', 'Corrientes 2879'),
(8, 1, 'Impresora Samsung ML-2165W', 'Corrientes 2879'),
(9, 1, 'Impresora Brother DCP-1617nw', 'Salta 2549');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
