-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 11:22 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `PATENTE` varchar(10) NOT NULL,
  `ID` int(11) NOT NULL,
  `DNI` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`PATENTE`, `ID`, `DNI`) VALUES
('1111', 2, '11223355'),
('asd123', 1, '12345678'),
('qwe123', 1, '87654321');

-- --------------------------------------------------------

--
-- Table structure for table `estadia`
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
-- Dumping data for table `estadia`
--

INSERT INTO `estadia` (`ID_ESTADIA`, `PATENTE`, `ID_USUARIO`, `ID_PRECIO`, `INGRESO`, `EGRESO`, `TOTAL`) VALUES
(2, '1111', 3, 1, '2019-11-20 22:47:27', '2019-11-20 23:03:37', 100);

-- --------------------------------------------------------

--
-- Table structure for table `historialpagos`
--

CREATE TABLE `historialpagos` (
  `ID_PAGOMENSUAL` bigint(20) NOT NULL,
  `PATENTE` varchar(10) NOT NULL,
  `ID_PRECIO` bigint(20) NOT NULL,
  `FECHA_PAGO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historialpagos`
--

INSERT INTO `historialpagos` (`ID_PAGOMENSUAL`, `PATENTE`, `ID_PRECIO`, `FECHA_PAGO`) VALUES
(1, 'asd123', 2, '2019-11-21 02:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `lugares`
--

CREATE TABLE `lugares` (
  `ID` bigint(20) NOT NULL,
  `CANTIDAD` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lugares`
--

INSERT INTO `lugares` (`ID`, `CANTIDAD`) VALUES
(1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `ID_PERMISO` bigint(20) NOT NULL,
  `DESCRIPCION_PERMISO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`ID_PERMISO`, `DESCRIPCION_PERMISO`) VALUES
(1, 'Crear_usuario'),
(2, 'deshabilitar_usuario'),
(3, 'crear_cliente'),
(4, 'registrar_estadia'),
(5, 'cerrar_estadia'),
(6, 'ver_usuarios'),
(7, 'ver_estadisticas');

-- --------------------------------------------------------

--
-- Table structure for table `precio`
--

CREATE TABLE `precio` (
  `ID_PRECIO` bigint(20) NOT NULL,
  `PRECIO` decimal(10,2) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `precio`
--

INSERT INTO `precio` (`ID_PRECIO`, `PRECIO`, `DESCRIPCION`) VALUES
(1, '100.00', 'hora'),
(2, '5000.00', 'abonado'),
(3, '0.00', 'estadia para abonado');

-- --------------------------------------------------------

--
-- Table structure for table `puesto`
--

CREATE TABLE `puesto` (
  `ID` bigint(20) NOT NULL,
  `DESCRIPCION` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `puesto`
--

INSERT INTO `puesto` (`ID`, `DESCRIPCION`) VALUES
(1, 'Gerente'),
(2, 'Empleado'),
(3, 'gerente'),
(4, 'empleado');

-- --------------------------------------------------------

--
-- Table structure for table `puesto_permiso`
--

CREATE TABLE `puesto_permiso` (
  `ID_PUESTO_PERMISO` bigint(20) NOT NULL,
  `ID_PUESTO` bigint(20) NOT NULL,
  `ID_PERMISO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `puesto_permiso`
--

INSERT INTO `puesto_permiso` (`ID_PUESTO_PERMISO`, `ID_PUESTO`, `ID_PERMISO`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 1, 6),
(7, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `ID` int(11) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`ID`, `DESCRIPCION`) VALUES
(1, 'abonado'),
(2, 'no abonado');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` bigint(20) NOT NULL,
  `ID` bigint(20) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `ESTADO` int(11) NOT NULL,
  `USUARIO` varchar(10) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `ID`, `NOMBRE`, `ESTADO`, `USUARIO`, `PASSWORD`) VALUES
(1, 1, 'admin', 1, 'admin', 'admin'),
(2, 1, 'alejandro', 0, 'gerente', 'gerente'),
(3, 2, 'gabriel', 1, 'empleado', 'empleado');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`PATENTE`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `estadia`
--
ALTER TABLE `estadia`
  ADD PRIMARY KEY (`ID_ESTADIA`),
  ADD KEY `PATENTE` (`PATENTE`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_PRECIO` (`ID_PRECIO`);

--
-- Indexes for table `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD PRIMARY KEY (`ID_PAGOMENSUAL`),
  ADD KEY `PATENTE` (`PATENTE`),
  ADD KEY `ID_PRECIO` (`ID_PRECIO`);

--
-- Indexes for table `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`ID_PERMISO`);

--
-- Indexes for table `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`ID_PRECIO`);

--
-- Indexes for table `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  ADD PRIMARY KEY (`ID_PUESTO_PERMISO`),
  ADD KEY `ID` (`ID_PUESTO`),
  ADD KEY `ID_PERMISO` (`ID_PERMISO`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estadia`
--
ALTER TABLE `estadia`
  MODIFY `ID_ESTADIA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `historialpagos`
--
ALTER TABLE `historialpagos`
  MODIFY `ID_PAGOMENSUAL` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lugares`
--
ALTER TABLE `lugares`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `ID_PERMISO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `precio`
--
ALTER TABLE `precio`
  MODIFY `ID_PRECIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `puesto`
--
ALTER TABLE `puesto`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  MODIFY `ID_PUESTO_PERMISO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `tipo` (`ID`);

--
-- Constraints for table `estadia`
--
ALTER TABLE `estadia`
  ADD CONSTRAINT `estadia_ibfk_1` FOREIGN KEY (`PATENTE`) REFERENCES `cliente` (`PATENTE`),
  ADD CONSTRAINT `estadia_ibfk_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`),
  ADD CONSTRAINT `estadia_ibfk_3` FOREIGN KEY (`ID_PRECIO`) REFERENCES `precio` (`ID_PRECIO`);

--
-- Constraints for table `historialpagos`
--
ALTER TABLE `historialpagos`
  ADD CONSTRAINT `historialpagos_ibfk_1` FOREIGN KEY (`PATENTE`) REFERENCES `cliente` (`PATENTE`),
  ADD CONSTRAINT `historialpagos_ibfk_2` FOREIGN KEY (`ID_PRECIO`) REFERENCES `precio` (`ID_PRECIO`);

--
-- Constraints for table `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  ADD CONSTRAINT `puesto_permiso_ibfk_1` FOREIGN KEY (`ID_PUESTO`) REFERENCES `puesto` (`ID`),
  ADD CONSTRAINT `puesto_permiso_ibfk_2` FOREIGN KEY (`ID_PERMISO`) REFERENCES `permiso` (`ID_PERMISO`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `puesto` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
