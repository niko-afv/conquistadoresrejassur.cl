-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-01-2013 a las 01:02:28
-- Versión del servidor: 5.1.66
-- Versión de PHP: 5.3.2-1ubuntu4.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `conquis_rejas_sur`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `APODERADOS`
--

CREATE TABLE IF NOT EXISTS `APODERADOS` (
  `RUT` varchar(10) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDO` varchar(50) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`RUT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `APODERADOS`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INTEGRANTES`
--

CREATE TABLE IF NOT EXISTS `INTEGRANTES` (
  `RUT` varchar(10) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `APELLIDO` varchar(100) DEFAULT NULL,
  `EDAD` int(2) unsigned NOT NULL,
  `TELEFONO_PRINCIPAL` varchar(15) DEFAULT NULL,
  `TELEFONO_AUXILIAR` varchar(15) DEFAULT NULL,
  `DIRECCION` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `RANGO` int(11) NOT NULL,
  `FOTO` varchar(255) DEFAULT NULL,
  `ESTADO` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`RUT`),
  KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `INTEGRANTES`
--

INSERT INTO `INTEGRANTES` (`RUT`, `NOMBRE`, `APELLIDO`, `EDAD`, `TELEFONO_PRINCIPAL`, `TELEFONO_AUXILIAR`, `DIRECCION`, `EMAIL`, `RANGO`, `FOTO`, `ESTADO`) VALUES
('17390878-4', 'Nicolás', 'Fredes', 22, '90628013', '02-6980878', 'Av. Libertador Bernardo O''Higgins', 'niko.afv@gmail.com', 0, '/ruta/a /la/foto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UNIDADES`
--

CREATE TABLE IF NOT EXISTS `UNIDADES` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) NOT NULL,
  `FUNDADO` varchar(10) DEFAULT NULL,
  `ESTADO` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `UNIDADES`
--

INSERT INTO `UNIDADES` (`ID`, `NOMBRE`, `FUNDADO`, `ESTADO`) VALUES
(1, 'Centuriones', '2008', 1),
(2, 'Exploradores', '2010', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UNIDADES_TRAYECTORIAS`
--

CREATE TABLE IF NOT EXISTS `UNIDADES_TRAYECTORIAS` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TEMPORADA` varchar(10) NOT NULL,
  `FOTO_UNIDAD` varchar(255) DEFAULT NULL,
  `GRITO_UNIDAD` varchar(255) DEFAULT NULL,
  `ID_UNIDAD` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_UNIDAD` (`ID_UNIDAD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `UNIDADES_TRAYECTORIAS`
--

INSERT INTO `UNIDADES_TRAYECTORIAS` (`ID`, `TEMPORADA`, `FOTO_UNIDAD`, `GRITO_UNIDAD`, `ID_UNIDAD`) VALUES
(1, '2008', 'foto/2008', 'grito/2008', 1),
(2, '2009', 'foto/2009', 'grito2009', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UNIDAD_INTEGRANTE`
--

CREATE TABLE IF NOT EXISTS `UNIDAD_INTEGRANTE` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_UNIDAD` int(11) unsigned NOT NULL,
  `RUT_INTEGRANTE` varchar(10) NOT NULL,
  `TEMPORADA` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_UNIDAD` (`ID_UNIDAD`),
  KEY `ID_INTEGRANTE` (`RUT_INTEGRANTE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `UNIDAD_INTEGRANTE`
--

INSERT INTO `UNIDAD_INTEGRANTE` (`ID`, `ID_UNIDAD`, `RUT_INTEGRANTE`, `TEMPORADA`) VALUES
(1, 1, '17390878-4', '2008'),
(2, 1, '17390878-4', '2009');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE IF NOT EXISTS `USUARIOS` (
  `NOMBRE` varchar(15) NOT NULL,
  `CLAVE` varchar(255) NOT NULL,
  `ESTADO` int(1) unsigned NOT NULL DEFAULT '1',
  `ULTIMA_VISITA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`NOMBRE`, `CLAVE`, `ESTADO`, `ULTIMA_VISITA`) VALUES
('nks', '*F7B4286024AE7F9F7F415414C48D7A0F1872513A', 1, '2013-01-25 00:17:35');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `UNIDADES_TRAYECTORIAS`
--
ALTER TABLE `UNIDADES_TRAYECTORIAS`
  ADD CONSTRAINT `UNIDADES_TRAYECTORIAS_ibfk_1` FOREIGN KEY (`ID_UNIDAD`) REFERENCES `UNIDADES` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `UNIDAD_INTEGRANTE`
--
ALTER TABLE `UNIDAD_INTEGRANTE`
  ADD CONSTRAINT `UNIDAD_INTEGRANTE_ibfk_1` FOREIGN KEY (`ID_UNIDAD`) REFERENCES `UNIDADES` (`ID`),
  ADD CONSTRAINT `UNIDAD_INTEGRANTE_ibfk_2` FOREIGN KEY (`RUT_INTEGRANTE`) REFERENCES `INTEGRANTES` (`RUT`) ON DELETE CASCADE ON UPDATE CASCADE;
