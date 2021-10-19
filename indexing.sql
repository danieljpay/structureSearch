-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2021 a las 04:31:12
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

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
-- Estructura de tabla para la tabla `dictionary`
--

CREATE TABLE `dictionary` (
  `Keyword` varchar(70) NOT NULL COMMENT 'La keyword',
  `Keyword_Appearances` int(5) NOT NULL COMMENT 'Número de documentos en los que aparece la keyword'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Diccionario de documentos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keyword_post`
--

CREATE TABLE `keyword_post` (
  `Keyword` varchar(70) NOT NULL COMMENT 'Una keyword',
  `Document_ID` int(5) NOT NULL COMMENT 'El ID de undocumento',
  `Frequency` int(5) NOT NULL COMMENT 'La frecuencia de la keyword en el documento',
  `Positions` varchar(1000) NOT NULL COMMENT 'Las posiciones de la keyword en el documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de relación entre palabras clave y documentos';

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
-- Indices de la tabla `dictionary`
--
ALTER TABLE `dictionary`
  ADD PRIMARY KEY (`Keyword`);

--
-- Indices de la tabla `keyword_post`
--
ALTER TABLE `keyword_post`
  ADD PRIMARY KEY (`Keyword`,`Document_ID`);

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
