-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2024 a las 23:39:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iniciosesioncapi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo`
--

CREATE TABLE `correo` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `correo`
--

INSERT INTO `correo` (`ID`, `name`, `mensaje`, `contacto`) VALUES
(6, 'Hola', 'Hola, me comunicaba con ud por el pantalon', '111569852'),
(7, 'Juan', 'hola', '444-5896'),
(9, 'Matias', 'Hola buenas', '261533698'),
(10, 'Mauricio', 'Buenas, quiero hablar con uds', 'maur@outlook.com'),
(11, 'SANTIAGO', 'Buenas, queria hablar con uds', 'scomes@gmail.com'),
(12, 'dwadfca', 'Hola\r\n', 'maur@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `Clave` varchar(255) NOT NULL,
  `Nombre_completo` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `nombre`, `Clave`, `Nombre_completo`, `admin`) VALUES
(10, 'ElAdmin', '$2y$10$/goz7THkF.ovhg8ZWKkVaechf1ke7oWqFBE44rJS9Ouy6IX/esaCS', 'Administrador', 1),
(12, 'Santiago', '$2y$10$19FPXOoHG4WfSt3bPyjzd.4XDrhFcAoPuDF50nszo95qpMrKH2t9O', 'Santiago Comes', 0),
(17, 'Mauricio', '$2y$10$/QkW3DsgJrxFrvccz6mZ/.74Cs45S09pHX3VLg1th37KY1kCs9/Xi', 'Mauri12!', 0),
(18, 'candelaria', '$2y$10$qHrQLP5TZl74PkObVyozHuKliTlMA1TiiZ528Vs1U0dbh.3nMof46', 'Candelaria Soto', 0),
(19, 'Rendir', '$2y$10$S3JH.46aFoRlbGowRN3mcuGw1FGF/DgpOZsza53yzrU5Ujchd7SoS', 'Rendir 1', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `correo`
--
ALTER TABLE `correo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `correo`
--
ALTER TABLE `correo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
