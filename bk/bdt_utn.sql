-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-03-2018 a las 18:21:52
-- Versión del servidor: 5.7.21-log
-- Versión de PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdt_utn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bdt_usuarios`
--

CREATE TABLE `bdt_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permisos` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `token_session` varchar(200) NOT NULL,
  `ultimo_acceso` datetime NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bdt_usuarios`
--

INSERT INTO `bdt_usuarios` (`id`, `usuario`, `password`, `email`, `permisos`, `fecha_registro`, `token_session`, `ultimo_acceso`, `estado`) VALUES
(1, 'cristian', '154397', 'cristian@gmail.com', 3, '2018-01-19 20:49:30', '1WIQhJf4bsUA6ciu72aPSTXq5rj9eo', '2018-02-03 21:26:37', 0),
(2, 'segundo', '154397', 'mail@mail.com', 1, '2018-01-20 03:35:52', '', '2018-01-20 03:35:52', 1),
(3, 'jose', '154397', 'jose@mail.com', 1, '2018-01-20 03:35:52', '', '2018-01-20 03:35:52', 1),
(4, 'victoria', '123456', 'vic@mail.com', 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 1),
(31, 'Luciana', '123456789', 'luciana@mail.com', 10, '2018-01-25 00:39:17', '12345onsahudLuciana', '0000-00-00 00:00:00', 2147483647),
(32, 'Luciana', '123456789', 'luciana@mail.com', 10, '2018-01-25 00:39:18', '12345onsahudLuciana', '0000-00-00 00:00:00', 2147483647),
(33, 'o20995', '154397', 'o20995@frro.utn.edu.ar', 1, '2018-02-04 16:14:02', 'zPxKDB6JXSGnAE1blwaLiHhYuUyjcr', '2018-02-04 16:14:13', 1),
(34, 'caguillon', '154397', 'caguillon@frro.utn.edu.ar', 1, '2018-02-04 16:16:50', 'j5y3bBk6hNSMvU4TLw0sEnr79WXcH8', '2018-03-06 03:21:11', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bdt_usuarios`
--
ALTER TABLE `bdt_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bdt_usuarios`
--
ALTER TABLE `bdt_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
