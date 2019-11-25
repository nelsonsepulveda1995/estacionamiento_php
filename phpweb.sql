-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2019 a las 16:17:39
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
-- Base de datos: `phpweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `PATENTE` varchar(10) NOT NULL,
  `ID` int(11) NOT NULL,
  `DNI` varchar(30) NOT NULL,
  `NOMBRE_CLIENTE` varchar(50) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`PATENTE`, `ID`, `DNI`, `NOMBRE_CLIENTE`, `EMAIL`) VALUES
('BU777JA', 2, '20767334', 'Horacio Cardenicio', 'horacioCar@gmail.com'),
('KI810JU', 2, '229890101', 'Hugo Vilas', 'hugovilas@gmail.com'),
('KK981OK', 1, '10000000', 'Gabriel Pereyra', 'gabrielpereyra1997@gmail.com'),
('UH891KM', 1, '92893876', 'Ariel García', 'arielGar@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadia`
--

CREATE TABLE `estadia` (
  `ID_ESTADIA` bigint(20) NOT NULL,
  `PATENTE` varchar(10) NOT NULL,
  `ID_USUARIO` bigint(20) NOT NULL,
  `ID_PRECIO` bigint(20) NOT NULL,
  `INGRESO` datetime NOT NULL,
  `EGRESO` datetime DEFAULT NULL,
  `TOTAL` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadia`
--

INSERT INTO `estadia` (`ID_ESTADIA`, `PATENTE`, `ID_USUARIO`, `ID_PRECIO`, `INGRESO`, `EGRESO`, `TOTAL`) VALUES
(55, 'KK981OK', 4, 2, '2019-11-24 17:29:52', '2019-11-24 17:30:44', 100),
(56, 'KK981OK', 4, 2, '2019-11-24 17:30:58', '2019-11-24 17:31:04', 100),
(58, 'KK981OK', 4, 2, '2019-11-24 17:47:57', '2019-11-24 17:50:15', 100),
(59, 'KK981OK', 4, 2, '2019-11-24 17:51:52', '2019-11-24 17:52:01', 100),
(60, 'KK981OK', 4, 1, '2019-11-24 18:07:04', '2019-11-24 18:07:16', 0),
(62, 'KK981OK', 4, 1, '2019-11-24 18:15:25', '2019-11-24 18:15:45', 0),
(63, 'KK981OK', 4, 2, '2019-11-24 18:16:15', '2019-11-24 18:18:28', 100),
(64, 'KK981OK', 4, 2, '2019-11-24 18:18:35', '2019-11-24 18:18:49', 100),
(65, 'KK981OK', 4, 1, '2019-11-24 18:19:47', '2019-11-24 18:19:49', 0),
(66, 'UH891KM', 4, 2, '2019-11-24 19:30:41', '2019-11-24 19:31:13', 100),
(67, 'BU777JA', 4, 2, '2019-11-25 01:18:10', '2019-11-25 01:18:19', 100),
(68, 'BU777JA', 4, 2, '2019-11-25 03:39:54', '2019-11-25 03:40:48', 100),
(69, 'KK981OK', 4, 1, '2019-11-25 03:43:25', '2019-11-25 03:43:29', 0),
(70, 'UH891KM', 4, 1, '2019-11-25 03:43:59', '2019-11-25 03:44:10', 0),
(71, 'KI810JU', 4, 2, '2019-11-25 03:45:36', '2019-11-25 03:45:48', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpagos`
--

CREATE TABLE `historialpagos` (
  `ID_PAGOMENSUAL` bigint(20) NOT NULL,
  `PATENTE` varchar(10) NOT NULL,
  `ID_PRECIO` bigint(20) NOT NULL,
  `FECHA_PAGO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historialpagos`
--

INSERT INTO `historialpagos` (`ID_PAGOMENSUAL`, `PATENTE`, `ID_PRECIO`, `FECHA_PAGO`) VALUES
(10, 'KK981OK', 3, '2019-11-25 01:18:39'),
(11, 'UH891KM', 3, '2018-11-25 02:00:07'),
(12, 'UH891KM', 3, '2019-11-25 02:36:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `ID` bigint(20) NOT NULL,
  `CANTIDAD` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`ID`, `CANTIDAD`) VALUES
(1, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `ID_PERMISO` bigint(20) NOT NULL,
  `DESCRIPCION_PERMISO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`ID_PERMISO`, `DESCRIPCION_PERMISO`) VALUES
(1, 'Crear_usuario'),
(2, 'deshabilitar_usuario'),
(3, 'crear_cliente'),
(4, 'registrar_estadia'),
(5, 'cerrar_estadia'),
(6, 'ver_usuarios'),
(7, 'ver_estadisticas'),
(8, 'editar_cliente'),
(9, 'editar_empleado'),
(10, 'pago_abonado'),
(11, 'registrar_abonado'),
(12, 'reporte_ganancia_dia'),
(13, 'todas_estadias'),
(14, 'todos_clientes'),
(15, 'xxxxxx'),
(16, 'xxxxxx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `ID_PRECIO` bigint(20) NOT NULL,
  `PRECIO` decimal(10,2) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`ID_PRECIO`, `PRECIO`, `DESCRIPCION`) VALUES
(1, '0.00', 'Estadia de abonado'),
(2, '100.00', 'No abonado'),
(3, '5000.00', 'Abonado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `ID` bigint(20) NOT NULL,
  `DESCRIPCION` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`ID`, `DESCRIPCION`) VALUES
(1, 'Gerente'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto_permiso`
--

CREATE TABLE `puesto_permiso` (
  `ID_PUESTO_PERMISO` bigint(20) NOT NULL,
  `ID_PUESTO` bigint(20) NOT NULL,
  `ID_PERMISO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puesto_permiso`
--

INSERT INTO `puesto_permiso` (`ID_PUESTO_PERMISO`, `ID_PUESTO`, `ID_PERMISO`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 8),
(9, 1, 9),
(10, 2, 10),
(11, 2, 11),
(12, 1, 12),
(13, 2, 13),
(14, 2, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `ID` int(11) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`ID`, `DESCRIPCION`) VALUES
(1, 'abonado'),
(2, 'no abonado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` bigint(20) NOT NULL,
  `ID` bigint(20) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `ESTADO` int(11) NOT NULL,
  `USUARIO` varchar(30) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `ID`, `NOMBRE`, `ESTADO`, `USUARIO`, `PASSWORD`) VALUES
(1, 1, 'Gabriel Pereyra', 1, 'admin', 'admin'),
(4, 2, 'Edgar Tonie', 1, 'cajero', 'cajero1234'),
(5, 2, 'Nelson Sepúlveda', 1, 'elchetodelciber', 'elchetodelciber');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`PATENTE`),
  ADD KEY `ID` (`ID`);

--
-- Indices de la tabla `estadia`
--
ALTER TABLE `estadia`
  ADD PRIMARY KEY (`ID_ESTADIA`),
  ADD KEY `PATENTE` (`PATENTE`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_PRECIO` (`ID_PRECIO`);

--
-- Indices de la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD PRIMARY KEY (`ID_PAGOMENSUAL`),
  ADD KEY `PATENTE` (`PATENTE`),
  ADD KEY `ID_PRECIO` (`ID_PRECIO`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`ID_PERMISO`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`ID_PRECIO`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  ADD PRIMARY KEY (`ID_PUESTO_PERMISO`),
  ADD KEY `ID` (`ID_PUESTO`),
  ADD KEY `ID_PERMISO` (`ID_PERMISO`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estadia`
--
ALTER TABLE `estadia`
  MODIFY `ID_ESTADIA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  MODIFY `ID_PAGOMENSUAL` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `ID_PERMISO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `ID_PRECIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  MODIFY `ID_PUESTO_PERMISO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `tipo` (`ID`);

--
-- Filtros para la tabla `estadia`
--
ALTER TABLE `estadia`
  ADD CONSTRAINT `estadia_ibfk_1` FOREIGN KEY (`PATENTE`) REFERENCES `cliente` (`PATENTE`),
  ADD CONSTRAINT `estadia_ibfk_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`),
  ADD CONSTRAINT `estadia_ibfk_3` FOREIGN KEY (`ID_PRECIO`) REFERENCES `precio` (`ID_PRECIO`);

--
-- Filtros para la tabla `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD CONSTRAINT `historialpagos_ibfk_1` FOREIGN KEY (`PATENTE`) REFERENCES `cliente` (`PATENTE`),
  ADD CONSTRAINT `historialpagos_ibfk_2` FOREIGN KEY (`ID_PRECIO`) REFERENCES `precio` (`ID_PRECIO`);

--
-- Filtros para la tabla `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  ADD CONSTRAINT `puesto_permiso_ibfk_1` FOREIGN KEY (`ID_PUESTO`) REFERENCES `puesto` (`ID`),
  ADD CONSTRAINT `puesto_permiso_ibfk_2` FOREIGN KEY (`ID_PERMISO`) REFERENCES `permiso` (`ID_PERMISO`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `puesto` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
