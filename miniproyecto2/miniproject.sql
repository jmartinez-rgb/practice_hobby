-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2020 a las 05:53:23
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miniproject`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exportaciones`
--

CREATE TABLE `exportaciones` (
  `id` int(11) NOT NULL,
  `id_relaciones` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL,
  `cantidad_vendida` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `exportaciones`
--

INSERT INTO `exportaciones` (`id`, `id_relaciones`, `id_productos`, `cantidad_vendida`, `total`) VALUES
(1, 7, 4, 201, 2412),
(2, 3, 3, 30, 900),
(3, 13, 3, 500, 15000),
(4, 8, 2, 30000, 750000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `pais` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `pais`) VALUES
(1, 'Peru'),
(2, 'Chile'),
(3, 'Argentina'),
(4, 'Colombia'),
(5, 'Ecuador'),
(6, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `precio_unitario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `precio_unitario`) VALUES
(1, 'papa', 25.5),
(2, 'cebolla', 25),
(3, 'tomate', 30),
(4, 'arroz', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relaciones`
--

CREATE TABLE `relaciones` (
  `id` int(11) NOT NULL,
  `id_pais1` int(11) NOT NULL,
  `id_pais2` int(11) NOT NULL,
  `fecha_relacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `relaciones`
--

INSERT INTO `relaciones` (`id`, `id_pais1`, `id_pais2`, `fecha_relacion`) VALUES
(1, 1, 3, '2020-05-03'),
(2, 1, 4, '2020-05-12'),
(3, 2, 1, '2020-05-16'),
(4, 3, 4, '2020-05-14'),
(5, 5, 3, '2020-05-29'),
(6, 3, 2, '2020-05-07'),
(7, 3, 1, '2020-05-21'),
(8, 4, 2, '2020-05-21'),
(9, 4, 3, '2020-05-02'),
(10, 5, 4, '2020-05-05'),
(11, 5, 2, '2020-05-14'),
(12, 2, 4, '2020-05-06'),
(13, 2, 3, '2020-05-16'),
(14, 1, 5, '2020-05-22'),
(15, 1, 6, '2020-05-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `tipo_user` varchar(50) NOT NULL DEFAULT 'user_g'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `contrasena`, `nombres`, `apellidos`, `dni`, `tipo_user`) VALUES
(1, 'josue@gmail.com', '1234', 'Josue', 'Martinez', '74098063', 'user_admin'),
(2, 'gblanco@gmail.com', '123456', 'Gustavo', 'Blanco', '12345678', 'user_g'),
(3, 'evila@gmail.com', '987654', 'Elsin', 'Vila', '98765432', 'user_admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `exportaciones`
--
ALTER TABLE `exportaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_relaciones` (`id_relaciones`),
  ADD KEY `idx_id_productos` (`id_productos`) USING BTREE;

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_descripcion` (`descripcion`);

--
-- Indices de la tabla `relaciones`
--
ALTER TABLE `relaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_pais1` (`id_pais1`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `contrasena` (`contrasena`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `relaciones`
--
ALTER TABLE `relaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `exportaciones`
--
ALTER TABLE `exportaciones`
  ADD CONSTRAINT `exportaciones_ibfk_1` FOREIGN KEY (`id_relaciones`) REFERENCES `relaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exportaciones_ibfk_2` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `relaciones`
--
ALTER TABLE `relaciones`
  ADD CONSTRAINT `relaciones_ibfk_1` FOREIGN KEY (`id_pais1`) REFERENCES `paises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
