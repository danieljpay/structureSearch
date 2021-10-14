-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2021 a las 07:31:18
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `indexing`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posting`
--

CREATE TABLE `posting` (
  `Document_ID` int(5) NOT NULL COMMENT 'ID del documento',
  `Document_Content` varchar(5000) NOT NULL COMMENT 'Contenido del documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de posting';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`Document_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posting`
--
ALTER TABLE `posting`
  MODIFY `Document_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ID del documento';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
