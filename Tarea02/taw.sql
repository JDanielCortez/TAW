-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2019 a las 18:04:05
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` varchar(7) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`matricula`, `nombre`, `carrera`, `email`, `telefono`) VALUES
('1630136', 'Daniel', 'ITI', '1630136@upv.edu.mx', '8341022912'),
('', '', '', '', ''),
('1630137', 'Juan', 'ITI', '1630137@upv.edu.mx', '98797'),
('', '', '', '', ''),
('1630136', 'Daniel', 'ITI', '1630136@upv.edu.mx', '8341022912'),
('1630136', 'Daniel', 'ITI', '1630136@upv.edu.mx', '8341022912'),
('1630136', 'Daniel', 'ITI', '1630136@upv.edu.mx', '8341022912'),
('', '', '', '', ''),
('', '', '', '', ''),
('', '', '', '', ''),
('', '', '', '', ''),
('1630136', 'daniel', 'iti', '1630136@upv.edu.mx', '8341022912'),
('', '', '', '', ''),
('', '', '', '', ''),
('', '', '', '', ''),
('', '', '', '', ''),
('', '', '', '', ''),
('', '', '', '', ''),
('1630136', 'Daniel', 'iti', '1630136@upv.edu.mx', '8341022912'),
('1630136', 'Daniel', 'IM', '1630136@upv.edu.mx', '8341022912'),
('1630136', 'Daniel', 'IM', '1630136@upv.edu.mx', '8341022912'),
('1630136', 'Daniel', 'IM', '1630136@upv.edu.mx', '8341022912'),
('', '', '', '', ''),
('1630136', 'Daniel', 'ISA', '1630136@upv.edu.mx', '8341022912');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `no_empleado` varchar(10) NOT NULL,
  `carrera` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`no_empleado`, `carrera`, `nombre`, `telefono`) VALUES
('', '', '', ''),
('', '', '', ''),
('', '', '', ''),
('', '', '', ''),
('0001', 'ITI', 'Daniel', '8341022912'),
('', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
