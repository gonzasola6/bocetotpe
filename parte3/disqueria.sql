-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 21:47:53
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
-- Base de datos: `disqueria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `ID_Album` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `lanzamiento` date NOT NULL,
  `cantCanciones` int(11) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `ID_Autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`ID_Album`, `nombre`, `lanzamiento`, `cantCanciones`, `genero`, `ID_Autor`) VALUES
(9, 'Clics Modernos', '1983-11-05', 9, 'Rock', 2),
(10, 'The Wall', '1979-11-30', 26, 'Rock', 3),
(11, 'Loba', '2009-10-09', 17, 'Pop', 4),
(12, 'Para los árboles', '2003-07-28', 12, 'Rock', 1),
(13, 'Yendo de la cama al living', '1982-10-28', 23, 'Rock', 2),
(14, 'Artaud', '1973-10-11', 9, 'Rock', 1),
(25, 'Post mortem', '2021-12-01', 9, 'Trap', 5),
(26, 'Sale el sol', '2010-04-05', 11, 'Pop', 4),
(40, 'afas', '0122-04-04', 1, 'pop', 1),
(42, 'Peluson Of Milk', '1991-12-01', 13, 'Rock', 1),
(43, 'Lo malo de ser bueno', '2010-04-02', 10, 'Rock', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `ID_Autor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `cantAlbumes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`ID_Autor`, `nombre`, `pais`, `cantAlbumes`) VALUES
(1, 'Luis Alberto Spinetta', 'Argentina', 19),
(2, 'Charly García', 'Argentina', 20),
(3, 'Pink Floyd', 'Reino Unido', 16),
(4, 'Shakira', 'Colombia', 12),
(5, 'Dillom', 'Argentina', 5),
(12, 'Cuarteto de Nos', 'Uruguay', 11),
(13, 'jose', 'arg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_User` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_User`, `username`, `password`) VALUES
(1, 'gonza@gmail.com', '$2y$10$dbRvBzBAvuQ4qKA7nwXSd.xnStNO.1YVgm15rm0BMF8oIElg/bBg6'),
(2, 'webadmin', '$2y$10$4wtamgv74E1JzhIaQPRnlu1x0hrmmJqgpBhaSyFFZE5ugG8wUgpGu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`ID_Album`),
  ADD KEY `ID_Autor` (`ID_Autor`);

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`ID_Autor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_User`),
  ADD UNIQUE KEY `email` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `ID_Album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `ID_Autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `albumes_ibfk_1` FOREIGN KEY (`ID_Autor`) REFERENCES `autores` (`ID_Autor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
