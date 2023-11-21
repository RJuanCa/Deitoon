-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2023 a las 00:04:06
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_deitoon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `descripción` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `descripción`) VALUES
(1, 'administrador'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitos_descrip`
--

CREATE TABLE `remitos_descrip` (
  `id_remito` int(11) NOT NULL,
  `nro_remito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_artículos`
--

CREATE TABLE `tab_artículos` (
  `id_artículo` int(11) NOT NULL,
  `cod_articulo` int(20) NOT NULL,
  `producto` varchar(70) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `precio` float NOT NULL,
  `cant_existencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_clientes`
--

CREATE TABLE `tab_clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(70) NOT NULL,
  `apellido` varchar(70) NOT NULL,
  `telefono` int(20) NOT NULL,
  `cuil/cuit` varchar(20) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `e-mail` varchar(70) NOT NULL,
  `movimientos` varchar(70) DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_remito`
--

CREATE TABLE `tab_remito` (
  `nro_remito` int(11) NOT NULL,
  `fecha_rem` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total_artic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_usuarios`
--

CREATE TABLE `tab_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `email_usu` varchar(70) NOT NULL,
  `contraseña` varchar(70) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `apellido` varchar(70) NOT NULL,
  `hash_` varchar(32) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tab_usuarios`
--

INSERT INTO `tab_usuarios` (`id_usuario`, `usuario`, `email_usu`, `contraseña`, `nombre`, `apellido`, `hash_`, `id_cargo`, `activo`) VALUES
(1, 'RomeroR', 'juanerylu@gmail.com', '12345', 'Ramon', 'Romero', '', 1, 0),
(2, 'EugeniaM', 'eugenia128@gmail.com', '12345', 'Eugenia', 'Molinas', '', 2, 0),
(5, '', '', '', ' ', '', '', 2, 0),
(6, 'EzequielZ', 'zerdaezequiel55@gmail.com', '12345', 'Ezequiel ', 'Zerda', '', 2, 0),
(7, '', '', '', ' ', '', '', 2, 0),
(8, '', '', '', ' ', '', '', 2, 0),
(9, '', '', '', ' ', '', '', 2, 0),
(10, '', '', '', ' ', '', '', 2, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `remitos_descrip`
--
ALTER TABLE `remitos_descrip`
  ADD PRIMARY KEY (`id_remito`,`nro_remito`),
  ADD KEY `nro_remito` (`nro_remito`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `tab_artículos`
--
ALTER TABLE `tab_artículos`
  ADD PRIMARY KEY (`id_artículo`);

--
-- Indices de la tabla `tab_clientes`
--
ALTER TABLE `tab_clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tab_remito`
--
ALTER TABLE `tab_remito`
  ADD PRIMARY KEY (`nro_remito`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `remitos_descrip`
--
ALTER TABLE `remitos_descrip`
  MODIFY `id_remito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tab_artículos`
--
ALTER TABLE `tab_artículos`
  MODIFY `id_artículo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tab_clientes`
--
ALTER TABLE `tab_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `remitos_descrip`
--
ALTER TABLE `remitos_descrip`
  ADD CONSTRAINT `remitos_descrip_ibfk_1` FOREIGN KEY (`nro_remito`) REFERENCES `tab_remito` (`nro_remito`),
  ADD CONSTRAINT `remitos_descrip_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tab_artículos` (`id_artículo`);

--
-- Filtros para la tabla `tab_clientes`
--
ALTER TABLE `tab_clientes`
  ADD CONSTRAINT `tab_clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tab_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tab_remito`
--
ALTER TABLE `tab_remito`
  ADD CONSTRAINT `tab_remito_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tab_clientes` (`id_cliente`);

--
-- Filtros para la tabla `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  ADD CONSTRAINT `tab_usuarios_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
