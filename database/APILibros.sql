-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-09-2023 a las 06:26:13
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `APILibros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_libros`
--

CREATE TABLE `tbl_libros` (
  `id` int(11) NOT NULL,
  `nombre_libro` varchar(255) NOT NULL,
  `autor_libro` varchar(255) NOT NULL,
  `fecha_libro` date NOT NULL,
  `categoria_libro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_libros`
--

INSERT INTO `tbl_libros` (`id`, `nombre_libro`, `autor_libro`, `fecha_libro`, `categoria_libro`) VALUES
(2, 'Divina comedia', 'dante', '2023-09-15', 'poema'),
(3, 'Lost', 'Virgilio', '2023-09-16', 'horror'),
(4, 'Hola', 'Hola', '2023-09-16', 'horror'),
(5, 'Starwars', 'Lukasfilm', '2023-09-16', 'scifi'),
(7, 'honkai star rail', 'hoyoverse', '2023-09-16', 'scifi'),
(8, 'genshin', 'hoyoverse', '2023-09-16', 'poema');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_libros`
--
ALTER TABLE `tbl_libros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_libros`
--
ALTER TABLE `tbl_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
