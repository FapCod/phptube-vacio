-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2020 a las 18:40:42
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phptube`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(6) NOT NULL,
  `nombre_users` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_users` timestamp NOT NULL DEFAULT current_timestamp(),
  `email_users` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_users` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_users` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ultimo_login_users` timestamp NULL DEFAULT NULL,
  `imagen_users` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_users`, `nombre_users`, `fecha_users`, `email_users`, `password_users`, `ip_users`, `ultimo_login_users`, `imagen_users`) VALUES
(1, 'fapcod', '2020-02-02 18:56:03', 'frankantonio881@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '::1', '2020-02-03 23:29:00', 'archivos/logoFapCd.png'),
(3, 'ronal', '2020-02-02 19:07:17', 'frankantonio889@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '::1', NULL, ''),
(4, 'prueba', '2020-02-02 19:08:32', 'frankantoniopiato@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '::1', NULL, '');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usuarios_y_videos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `usuarios_y_videos` (
`nombre_users` varchar(200)
,`url_videos` varchar(200)
,`fecha_users` timestamp
,`email_users` varchar(90)
,`password_users` varchar(200)
,`ip_users` varchar(30)
,`ultimo_login_users` timestamp
,`imagen_users` varchar(200)
,`id_users` int(6)
,`fecha_videos` timestamp
,`id_videos` int(6)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id_videos` int(6) NOT NULL,
  `fecha_videos` timestamp NOT NULL DEFAULT current_timestamp(),
  `url_videos` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarioid_videos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id_videos`, `fecha_videos`, `url_videos`, `usuarioid_videos`) VALUES
(1, '2020-02-02 22:50:23', 'archivos/IntroFAPCOD2.mp4', 1),
(2, '2020-02-02 23:50:25', 'archivos/intro.mp4', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `usuarios_y_videos`
--
DROP TABLE IF EXISTS `usuarios_y_videos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fapcod`@`%` SQL SECURITY DEFINER VIEW `usuarios_y_videos`  AS  select `users`.`nombre_users` AS `nombre_users`,`videos`.`url_videos` AS `url_videos`,`users`.`fecha_users` AS `fecha_users`,`users`.`email_users` AS `email_users`,`users`.`password_users` AS `password_users`,`users`.`ip_users` AS `ip_users`,`users`.`ultimo_login_users` AS `ultimo_login_users`,`users`.`imagen_users` AS `imagen_users`,`users`.`id_users` AS `id_users`,`videos`.`fecha_videos` AS `fecha_videos`,`videos`.`id_videos` AS `id_videos` from (`users` join `videos` on(`users`.`id_users` = `videos`.`usuarioid_videos`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_videos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id_videos` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
