-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2025 a las 18:50:16
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
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `cod_cargo` int(11) NOT NULL,
  `nom_cargo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cod_cli` int(11) NOT NULL,
  `nom_cli` varchar(150) NOT NULL,
  `doc_cli` int(11) NOT NULL,
  `tipo_doc_cli` enum('NIT','CC','CE') NOT NULL,
  `dir_cli` varchar(150) NOT NULL,
  `tel_cli` varchar(12) NOT NULL,
  `email_cli` varchar(12) NOT NULL,
  `cod_tipoinm` int(11) NOT NULL,
  `valor_maximo` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cod_emp` int(11) DEFAULT NULL,
  `NOTAS_CLIENTE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `cod_emp` int(11) NOT NULL,
  `ced_emp` int(11) NOT NULL,
  `tipo_doc` enum('CEDULA','CE','TI') NOT NULL,
  `nom_emp` varchar(100) NOT NULL,
  `dir_emp` varchar(255) NOT NULL,
  `tel_emp` varchar(12) DEFAULT NULL,
  `email_emp` varchar(50) DEFAULT NULL,
  `rh_emp` varchar(3) NOT NULL,
  `fec_nac` date NOT NULL,
  `cod_cargo` int(11) NOT NULL,
  `cod_ofi` int(11) NOT NULL,
  `salario` int(20) DEFAULT NULL,
  `gastos` int(20) DEFAULT NULL,
  `comision` int(20) DEFAULT NULL,
  `fecha_ing` date NOT NULL,
  `fecha_ret` date DEFAULT NULL,
  `nom_contacto` varchar(100) NOT NULL,
  `dir_contacto` varchar(50) NOT NULL,
  `tel_contacto` varchar(12) NOT NULL,
  `email_contacto` varchar(50) NOT NULL,
  `relacion_contacto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `cod_inm` int(11) NOT NULL,
  `dir_inm` varchar(150) NOT NULL,
  `barrio_inm` varchar(100) NOT NULL,
  `ciudad_inm` varchar(100) NOT NULL,
  `departamento_inm` varchar(100) NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `web_p1` varchar(255) NOT NULL,
  `web_p2` varchar(255) NOT NULL,
  `cod_tipoinm` int(11) NOT NULL,
  `cod_propietarios` int(11) NOT NULL,
  `num_hab` int(11) NOT NULL,
  `precio_alq` decimal(10,2) NOT NULL,
  `caracteristica_inm` enum('CONJUNTO','URBANIZACION') NOT NULL,
  `notas_inm` text NOT NULL,
  `cod_emp` int(11) NOT NULL,
  `cod_ofi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE `oficina` (
  `cod_ofi` int(11) NOT NULL,
  `nom_ofi` varchar(100) NOT NULL,
  `dir_ofi` varchar(255) NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `foto_ofi` varchar(255) DEFAULT NULL,
  `tel_ofi` varchar(12) DEFAULT NULL,
  `email_ofi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `cod_propietarios` int(11) NOT NULL,
  `tipo_empresa` enum('Persona Natural','Jurídica') NOT NULL,
  `tipo_doc` enum('CC','NIT','CE') NOT NULL,
  `num_doc` int(11) NOT NULL,
  `nombre_propietario` varchar(100) DEFAULT NULL,
  `dir_propietario` varchar(150) DEFAULT NULL,
  `tel_propietario` varchar(12) DEFAULT NULL,
  `email_propietario` varchar(50) NOT NULL,
  `contacto_propietario` varchar(100) DEFAULT NULL,
  `tel_contacto_propietario` varchar(12) DEFAULT NULL,
  `email_contacto_propietario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_inmueble`
--

CREATE TABLE `tipo_inmueble` (
  `cod_tipoinm` int(11) NOT NULL,
  `nom_tipoinm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`cod_cargo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cli`),
  ADD KEY `cod_tipoinm` (`cod_tipoinm`),
  ADD KEY `cod_emp` (`cod_emp`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`cod_emp`),
  ADD KEY `cod_cargo` (`cod_cargo`),
  ADD KEY `cod_ofi` (`cod_ofi`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`cod_inm`),
  ADD KEY `cod_tipoinm` (`cod_tipoinm`),
  ADD KEY `cod_propietarios` (`cod_propietarios`),
  ADD KEY `cod_emp` (`cod_emp`),
  ADD KEY `cod_ofi` (`cod_ofi`);

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`cod_ofi`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`cod_propietarios`);

--
-- Indices de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
  ADD PRIMARY KEY (`cod_tipoinm`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `cod_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `cod_emp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `cod_inm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `cod_ofi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `cod_propietarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
  MODIFY `cod_tipoinm` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`cod_tipoinm`) REFERENCES `tipo_inmueble` (`cod_tipoinm`),
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`cod_emp`) REFERENCES `empleados` (`cod_emp`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`cod_cargo`) REFERENCES `cargos` (`cod_cargo`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`cod_ofi`) REFERENCES `oficina` (`cod_ofi`);

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `inmuebles_ibfk_1` FOREIGN KEY (`cod_tipoinm`) REFERENCES `tipo_inmueble` (`cod_tipoinm`),
  ADD CONSTRAINT `inmuebles_ibfk_2` FOREIGN KEY (`cod_propietarios`) REFERENCES `propietarios` (`cod_propietarios`),
  ADD CONSTRAINT `inmuebles_ibfk_3` FOREIGN KEY (`cod_emp`) REFERENCES `empleados` (`cod_emp`),
  ADD CONSTRAINT `inmuebles_ibfk_4` FOREIGN KEY (`cod_ofi`) REFERENCES `oficina` (`cod_ofi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
