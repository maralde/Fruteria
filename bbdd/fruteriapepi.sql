-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 13:44:44
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
-- Base de datos: `fruteriapepi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_categoria` int(11) NOT NULL,
  `Nombre_cat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id_categoria`, `Nombre_cat`) VALUES
(1, 'cítricos'),
(2, 'hueso'),
(3, 'tropicales'),
(4, 'bayas'),
(5, 'de hoja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `Id_historial` int(11) NOT NULL,
  `Cantidad_compra` int(11) NOT NULL,
  `Precio_compra` float NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Fecha_compra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`Id_historial`, `Cantidad_compra`, `Precio_compra`, `Id_producto`, `Fecha_compra`) VALUES
(1, 1, 4.6, 12, '30-09-2024'),
(2, 3, 6, 12, '30-09-2024'),
(3, 2, 2, 15, '30-09-2024'),
(10, 12, 4.72, 12, '04-10-2024'),
(11, 1, 2, 12, '04-10-2024'),
(12, 1, 2, 12, '04-10-2024'),
(13, 1, 3, 12, '04-10-2024'),
(14, 1, 3, 14, '04-10-2024'),
(15, 1, 3, 14, '04-10-2024'),
(16, 0, 0, 15, '04-10-2024'),
(17, 1, 3, 14, '04-10-2024');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id_producto` int(11) NOT NULL,
  `Nombre_prod` varchar(500) NOT NULL,
  `Id_tipo` int(11) NOT NULL,
  `Id_categoria` int(11) NOT NULL,
  `Id_temporada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id_producto`, `Nombre_prod`, `Id_tipo`, `Id_categoria`, `Id_temporada`) VALUES
(12, 'manzana', 1, 1, 1),
(14, 'Naranja', 1, 1, 1),
(15, 'Pera', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `Id_stock` int(11) NOT NULL,
  `Cantidad_venta` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Precio_venta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporada`
--

CREATE TABLE `temporada` (
  `Id_temporada` int(11) NOT NULL,
  `Nombre_temp` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temporada`
--

INSERT INTO `temporada` (`Id_temporada`, `Nombre_temp`) VALUES
(1, 'invierno'),
(2, 'primavera'),
(3, 'verano'),
(4, 'otoño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `Id_tipo` int(11) NOT NULL,
  `Nombre_tipo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`Id_tipo`, `Nombre_tipo`) VALUES
(1, 'fruta'),
(2, 'verdura');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_categoria`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`Id_historial`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id_producto`),
  ADD KEY `Id_tipo` (`Id_tipo`),
  ADD KEY `Id_categoria` (`Id_categoria`),
  ADD KEY `Id_temporada` (`Id_temporada`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Id_stock`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indices de la tabla `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`Id_temporada`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`Id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=613;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `Id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `Id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temporada`
--
ALTER TABLE `temporada`
  MODIFY `Id_temporada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `Id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`Id_tipo`) REFERENCES `tipo` (`Id_tipo`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`Id_categoria`) REFERENCES `categorias` (`Id_categoria`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`Id_temporada`) REFERENCES `temporada` (`Id_temporada`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
