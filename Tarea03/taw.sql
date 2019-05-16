-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2019 a las 09:51:27
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
-- Estructura de tabla para la tabla `basquetbolistas`
--

CREATE TABLE `basquetbolistas` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `posicion` varchar(30) NOT NULL,
  `carrera` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `basquetbolistas`
--

INSERT INTO `basquetbolistas` (`id`, `nombre`, `posicion`, `carrera`, `email`) VALUES
(2, 'Andres Alvarez Rivas ', 'Escolta', 'IM', '1630136@upv.edu.mx'),
(20, 'Ernesto Alvarez Rojas', 'Escolta', 'IM', '1830139@upv.edu.mx'),
(24, 'Manuel Moreno Morales', 'Alero', 'PyMES', '1730199@upv.edu.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `futbolistas`
--

CREATE TABLE `futbolistas` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `posicion` varchar(30) NOT NULL,
  `carrera` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `futbolistas`
--

INSERT INTO `futbolistas` (`id`, `nombre`, `posicion`, `carrera`, `email`) VALUES
(1, 'Manuel Ramos Rodriguez', 'Portero', 'ITI', '1630123@upv.edu.mx'),
(20, 'Ernesto Alvarez Rojas', 'Portero', 'IM', '1630136@upv.edu.mx'),
(240, 'Andres Alvarez Rivas', 'Portero', 'IM', '1630137@upv.edu.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `Id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`Id`, `Name`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `Id` int(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Pssw` varchar(30) NOT NULL,
  `Status_id` int(10) NOT NULL,
  `User_type_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`Id`, `Email`, `Pssw`, `Status_id`, `User_type_id`) VALUES
(1, 'admin@gmail.com', 'admin', 1, 1),
(2, 'jdcn@hotmial.com', 'jdcn', 1, 3),
(3, 'morales@outlook.com', 'moreles', 2, 2),
(4, 'rosales@gmail.com', 'rosales', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_log`
--

CREATE TABLE `user_log` (
  `Id` int(10) NOT NULL,
  `Date_logged` date NOT NULL,
  `User_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_log`
--

INSERT INTO `user_log` (`Id`, `Date_logged`, `User_id`) VALUES
(1, '2019-05-07', 1),
(2, '2019-05-08', 2),
(3, '2019-05-01', 4),
(4, '2019-05-01', 2),
(5, '2019-05-03', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_type`
--

CREATE TABLE `user_type` (
  `Id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_type`
--

INSERT INTO `user_type` (`Id`, `Name`) VALUES
(1, 'Admin'),
(2, 'Profesor'),
(3, 'Alumno'),
(4, 'Invitado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `basquetbolistas`
--
ALTER TABLE `basquetbolistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `futbolistas`
--
ALTER TABLE `futbolistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_type_id` (`User_type_id`),
  ADD KEY `Status_id` (`Status_id`);

--
-- Indices de la tabla `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indices de la tabla `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user_log`
--
ALTER TABLE `user_log`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user_type`
--
ALTER TABLE `user_type`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`User_type_id`) REFERENCES `user_type` (`Id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`Status_id`) REFERENCES `status` (`Id`);

--
-- Filtros para la tabla `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
