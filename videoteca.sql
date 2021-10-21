-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2021 a las 17:17:48
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `cod` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `NombrePelicula` varchar(60) NOT NULL,
  `Anio` year(4) NOT NULL,
  `Duracion_Minutos` varchar(3) NOT NULL,
  `CostoBlueRay` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`cod`, `id_usuario`, `NombrePelicula`, `Anio`, `Duracion_Minutos`, `CostoBlueRay`) VALUES
(101, 1, 'El Padrino', 1972, '175', '3300'),
(102, 2, 'Scarface', 1983, '170', '5900'),
(103, 2, 'Psicosis', 1960, '109', '3700'),
(104, 1, 'El bueno, el malo y el feo', 1966, '161', '4500'),
(105, 1, 'Aliens: el regreso', 1986, '137', '6300'),
(106, 2, 'El secreto de sus ojos', 2009, '129', '5800'),
(107, 2, 'Casino Royale', 2006, '144', '7100'),
(108, 2, 'Un dolar marcado', 1965, '69', '2700'),
(109, 3, 'Lo que el viento se llevo', 1939, '238', '4200'),
(112, 3, 'Apocslipsis Now', 1979, '182', '5000'),
(118, 1, 'Perros de la calle', 1992, '99', '2800'),
(120, 2, 'Matrix', 1999, '136', '3500'),
(125, 3, 'Spectre', 2015, '148', '3850'),
(130, 1, 'Dracula', 1992, '127', '2800'),
(139, 3, 'No respires', 2016, '88', '3200');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nombre`, `apellido`) VALUES
(1, 'Administrador', '$2y$10$fJb240.lsBDoUU4RCSVmKuI1nup.6.MtiysEsvWwWZlVkdCugdlNi', 'Carlos', 'Figueredo'),
(2, 'Falduti', '$2y$10$TX2jAM3iYszzQu7rl7jMjOveTrNPb9ZWjRpmjspdVlsROcdOXQEJe', 'Cesar', 'Falduti'),
(3, 'EmpleadoQuintana', '$2y$10$Ai/FJV2QAA2AYtzINlx35O8OFGtPKgQrWQRaf8ToVof.zavKUXa5e', 'Juan', 'Quintana');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
