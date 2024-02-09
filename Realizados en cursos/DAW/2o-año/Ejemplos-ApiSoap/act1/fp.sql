-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2021 a las 14:05:08
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fp`
--
CREATE DATABASE fp;
USE fp;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `curso_escolar` varchar(255) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `especialidad` varchar(255) NOT NULL,
  `nomenclatura_modulo` varchar(255) NOT NULL,
  `curso` int(11) NOT NULL,
  `numalumnos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `curso_escolar`, `departamento`, `nivel`, `especialidad`, `nomenclatura_modulo`, `curso`, `numalumnos`) VALUES
(1, '2020/2021', 'Informática y Comunicaciones', 'Ciclo Formativo Superior', 'CFGS - Desarrollo de Aplicaciones Web', 'DSW', 2, 30),
(2, '2020/2021', 'Informática y Comunicaciones', 'Ciclo Formativo Superior', 'CFGS - Desarrollo de Aplicaciones Web', 'FOL', 2, 18),
(3, '2020/2021', 'Administración y Gestión', 'Ciclo Formativo de Grado Superior', 'CFGM - Gestión Administrativa', 'TDE', 1, 25),
(4, '2020/2021', 'Informática y Comunicaciones', 'Ciclo Formativo de Grado Medio', 'CFGM - Sistemas Microinformáticos y Redes', 'MJE', 1, 28);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;