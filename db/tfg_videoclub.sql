-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2026 a las 00:25:00
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
-- Base de datos: `tfg_videoclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id_alquiler` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_juego` int(11) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT current_timestamp(),
  `fecha_fin` datetime DEFAULT NULL,
  `estado` enum('activo','expirado') DEFAULT 'activo',
  `id_pedido_item` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_item`
--

CREATE TABLE `carrito_item` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_juego` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Fútbol'),
(2, 'Deportes'),
(3, 'Carreras'),
(4, 'Acción'),
(5, 'Aventura'),
(6, 'RPG'),
(7, 'Shooter'),
(8, 'Terror'),
(9, 'Estrategia'),
(10, 'Indie'),
(11, 'Simulación'),
(12, 'Narrativo'),
(13, 'Plataformas'),
(14, 'Mundo Abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `id_foro` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`id_foro`, `nombre`, `descripcion`) VALUES
(1, 'CANA GAY', 'APOYAMOS A QUE CANA ES GAY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_juego` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_alquiler` decimal(6,2) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `ventas` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id_juego`, `titulo`, `descripcion`, `precio_alquiler`, `imagen`, `ventas`, `stock`) VALUES
(1, 'Inazuma Eleven 2: Ventisca Eterna', 'RPG de fútbol lanzado en 2009 para Nintendo DS.', 1.50, './img/inazuma_eleven_2_ventisca_eterna.jpg', 0, 10),
(2, 'FIFA 19', 'Simulador de fútbol lanzado en 2018 para PS4, Xbox One y PC.', 2.50, './img/fifa_19.jpg', 0, 10),
(3, 'Star Wars Battlefront', 'Shooter en primera persona lanzado en 2015 para PS4, Xbox One y PC.', 2.00, './img/star_wars_battlefront.jpg', 0, 10),
(4, 'Need for Speed Most Wanted', 'Juego de carreras arcade lanzado en 2005 para múltiples plataformas.', 1.50, './img/need_for_speed_most_wanted.jpg', 0, 10),
(5, 'PES 2015', 'Simulador de fútbol lanzado en 2014 para PS3, PS4, Xbox y PC.', 2.00, './img/pes_2015.jpg', 0, 10),
(6, 'Overcooked', 'Juego cooperativo de cocina lanzado en 2016 para consolas y PC.', 2.00, './img/overcooked.jpg', 0, 10),
(7, 'Hollow Knight', 'Metroidvania indie lanzado en 2017 para PC y consolas.', 2.50, './img/hollow_knight.jpg', 0, 10),
(8, 'Call of Duty: Black Ops III', 'Shooter en primera persona lanzado en 2015 para PS4, Xbox One y PC.', 3.00, './img/call_of_duty_black_ops_iii.jpg', 0, 10),
(9, 'Cyberpunk 2077', 'RPG de mundo abierto lanzado en 2020 para consolas y PC.', 3.50, './img/cyberpunk_2077.jpg', 0, 10),
(10, 'Devil May Cry HD Collection', 'Colección de acción hack and slash lanzada en 2012.', 2.00, './img/devil_may_cryl_hd_collection.jpg', 0, 10),
(11, 'GTA San Andreas', 'Juego de acción en mundo abierto lanzado en 2004.', 1.50, './img/gta_san_andreas.jpg', 0, 10),
(12, 'Outlast', 'Juego de terror en primera persona lanzado en 2013.', 2.00, './img/outlast.jpg', 0, 10),
(13, 'Until Dawn', 'Juego de terror narrativo lanzado en 2015 para PS4.', 2.50, './img/until_dawn.jpg', 0, 10),
(14, 'Persona 3 Reload', 'Remake del JRPG clásico lanzado en 2024 para consolas y PC.', 3.50, './img/persona_3_reload.jpg', 0, 10),
(15, 'Persona 4 Golden', 'JRPG lanzado originalmente en 2012 y relanzado en PC y consolas.', 2.50, './img/persona_4_golden.jpg', 0, 10),
(16, 'Persona 5 Royal', 'JRPG lanzado en 2020 para PS4 y otras plataformas.', 3.00, './img/persona_5_royal.jpg', 0, 10),
(17, 'Plantas Contra Zombies', 'Juego de estrategia y defensa de torres lanzado en 2009.', 1.50, './img/plantas_contra_zombies.jpg', 0, 10),
(18, 'Slime Rancher', 'Juego de simulación y exploración lanzado en 2017.', 2.50, './img/slime_rancher.jpg', 0, 10),
(19, 'Uncharted', 'Aventura de acción lanzada en 2007 para PS3.', 2.00, './img/uncharted_1.jpg', 0, 10),
(20, 'Uncharted 2', 'Aventura de acción lanzada en 2009 para PS3.', 2.00, './img/uncharted_2.jpg', 0, 10),
(21, 'Uncharted 3', 'Aventura de acción lanzada en 2011 para PS3.', 2.00, './img/uncharted_3.jpg', 0, 10),
(22, 'Uncharted 4', 'Aventura de acción lanzada en 2016 para PS4.', 2.50, './img/uncharted_4.jpg', 0, 10),
(23, 'The Last of Us', 'Juego de acción y supervivencia lanzado en 2013 para PS3.', 2.50, './img/the_last_of_us.jpg', 0, 10),
(24, 'The Last of Us Part II', 'Juego de acción y supervivencia lanzado en 2020 para PlayStation 4.', 3.50, './img/the_last_of_us_part_2.jpg', 0, 10),
(39, 'asfasf', 'asfasf', 0.99, 'img/DragonLegacy.png', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego_categoria`
--

CREATE TABLE `juego_categoria` (
  `id_juego` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juego_categoria`
--

INSERT INTO `juego_categoria` (`id_juego`, `id_categoria`) VALUES
(1, 1),
(1, 2),
(1, 6),
(2, 1),
(2, 2),
(3, 4),
(3, 7),
(4, 3),
(4, 14),
(5, 1),
(5, 2),
(6, 9),
(6, 10),
(7, 4),
(7, 10),
(7, 13),
(8, 4),
(8, 7),
(9, 4),
(9, 6),
(9, 14),
(10, 4),
(11, 4),
(11, 14),
(12, 8),
(13, 8),
(13, 12),
(14, 6),
(14, 12),
(15, 6),
(15, 12),
(16, 6),
(16, 12),
(17, 9),
(17, 12),
(18, 10),
(18, 11),
(19, 4),
(19, 5),
(20, 4),
(20, 5),
(21, 4),
(21, 5),
(22, 4),
(22, 5),
(23, 4),
(23, 12),
(24, 4),
(24, 5),
(24, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `id_logro` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_metodo` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_metodo`, `descripcion`) VALUES
(1, 'Tarjeta de crédito'),
(2, 'PayPal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `estado` enum('pagado','reembolsado') NOT NULL DEFAULT 'pagado',
  `fecha_reembolso` datetime DEFAULT NULL,
  `motivo_reembolso` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario`, `Fecha`, `metodo_pago`, `estado`, `fecha_reembolso`, `motivo_reembolso`) VALUES
(24, 3, '2026-05-25 23:37:02', 1, 'pagado', NULL, NULL),
(32, 3, '2026-05-26 00:07:48', 1, 'pagado', NULL, NULL),
(33, 3, '2026-05-26 18:19:49', 1, 'pagado', NULL, NULL),
(34, 3, '2026-05-26 18:44:42', 1, 'pagado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_item`
--

CREATE TABLE `pedido_item` (
  `id_item` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_juego` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `canjeado` tinyint(1) NOT NULL,
  `codigo` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_item`
--

INSERT INTO `pedido_item` (`id_item`, `id_pedido`, `id_juego`, `duracion`, `precio`, `canjeado`, `codigo`) VALUES
(414956, 24, 4, 4, 1.50, 0, 'A5DEFFD21EBEFDB0'),
(414957, 24, 18, 1, 2.50, 0, '2A66DEAF91DFFB27'),
(414970, 32, 8, 6, 3.00, 0, '619168F580C55BB0'),
(414971, 32, 13, 7, 2.50, 0, '3F48731AEAAEB0E6'),
(414972, 33, 3, 10, 2.00, 0, '82CD0CD0353D185F'),
(414973, 33, 4, 3, 1.50, 0, 'F6AF417044B3BE3C'),
(414974, 33, 2, 4, 2.50, 0, '94F478C9928EC703'),
(414975, 33, 8, 5, 3.00, 0, 'F2A225F02F74702D'),
(414976, 34, 3, 3, 2.00, 0, '9406317988D959C9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE `recibos` (
  `id_recibo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `numero_factura` varchar(50) NOT NULL,
  `nombre_fichero` varchar(255) NOT NULL,
  `estado` enum('pagado','cancelado','reembolsado') DEFAULT 'pagado',
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `fecha_emision` datetime DEFAULT current_timestamp(),
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id_recibo`, `id_usuario`, `numero_factura`, `nombre_fichero`, `estado`, `stripe_session_id`, `fecha_emision`, `id_pedido`) VALUES
(2, 3, 'FAC-20260525233702', 'FAC-20260525233702.pdf', 'pagado', 'cs_test_b1Sg2qvij5oiXFRNB78VZThjPY4e296LLqXxrPyuge7QherKDZ8yht3EYh', '2026-05-25 23:37:04', 24),
(10, 3, 'FAC-20260526000748', 'FAC-20260526000748.pdf', 'pagado', 'cs_test_b1ksFslOmNrF7xtx4aENa66mNX0hFVzgudDQXpmlro9Q5zTXazrEusGPqc', '2026-05-26 00:07:51', 32),
(11, 3, 'FAC-20260526181949', 'FAC-20260526181949.pdf', 'pagado', 'cs_test_b14t0f43yLJtbjOFLqDC2J8Q8YPuJSUXGWq4ceA4etrbXeFm3DvGyYPtV9', '2026-05-26 18:19:53', 33),
(12, 3, 'FAC-20260526184442', 'FAC-20260526184442.pdf', 'pagado', 'cs_test_a1AdSiwkfcSMVQ9TsoB56THffMshBd5GhusXnVPRsKmrWQ2NbmQKpIhnLu', '2026-05-26 18:44:44', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `contenido` text DEFAULT NULL,
  `id_tema` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id_respuesta`, `contenido`, `id_tema`, `id_usuario`, `fecha_respuesta`) VALUES
(1, 'JAJAJA ES VERDAD', 1, 3, '2026-05-17 17:10:33'),
(2, 'XD', 1, 3, '2026-05-17 17:10:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(0, 'Base'),
(1, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `id_foro` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id_tema`, `titulo`, `id_foro`, `id_usuario`, `fecha_creacion`) VALUES
(1, 'XD', 1, 3, '2026-05-17 17:10:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `asunto` varchar(200) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `estado` enum('abierto','cerrado') DEFAULT 'abierto',
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nivel` int(11) DEFAULT 1,
  `estado` enum('activo','bloqueado') DEFAULT 'activo',
  `id_rol` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `foto`, `nivel`, `estado`, `id_rol`, `fecha_registro`) VALUES
(1, 'canaGay', 'canagay@gmail.com', '$2y$10$GGDD98gmL1CGoNrXhHcIJuR7PBs5W2Io4eoRDElMJR0eJd3jOzKtq', NULL, 1, 'activo', 0, '2026-03-11 10:50:10'),
(3, 'ADMINISTRADOR', 'felipe777gaymer@gmail.com', '$2y$10$kWgaWC02Blg5JYbWTy4R0OwvfgjE/dttxKE.qqNJKHNsShlm/9qeS', NULL, 1, 'activo', 1, '2026-03-30 14:45:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_logros`
--

CREATE TABLE `usuarios_logros` (
  `id_usuario` int(11) NOT NULL,
  `id_logro` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id_alquiler`),
  ADD KEY `idx_usuario` (`id_usuario`),
  ADD KEY `idx_juego` (`id_juego`),
  ADD KEY `idx_pedido_item` (`id_pedido_item`),
  ADD KEY `idx_pedido` (`id_pedido`);

--
-- Indices de la tabla `carrito_item`
--
ALTER TABLE `carrito_item`
  ADD PRIMARY KEY (`id_carrito`),
  ADD UNIQUE KEY `unique_usuario_juego` (`id_usuario`,`id_juego`),
  ADD KEY `fk_carrito_juego` (`id_juego`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`id_foro`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`);

--
-- Indices de la tabla `juego_categoria`
--
ALTER TABLE `juego_categoria`
  ADD PRIMARY KEY (`id_juego`,`id_categoria`),
  ADD KEY `fk_id_categorias_juego_categoria` (`id_categoria`);

--
-- Indices de la tabla `logros`
--
ALTER TABLE `logros`
  ADD PRIMARY KEY (`id_logro`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_metodo`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido_metodo` (`metodo_pago`),
  ADD KEY `fk_pedido_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedido_item`
--
ALTER TABLE `pedido_item`
  ADD PRIMARY KEY (`id_item`),
  ADD UNIQUE KEY `uq_codigo` (`codigo`),
  ADD KEY `fk_pitems_pedido` (`id_pedido`),
  ADD KEY `fk_pitems_juego` (`id_juego`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`id_recibo`),
  ADD UNIQUE KEY `numero_factura` (`numero_factura`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `idx_id_pedido` (`id_pedido`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `fk_tema_respuestas` (`id_tema`),
  ADD KEY `fk_usuario_respuestas` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `fk_foro_tema` (`id_foro`),
  ADD KEY `fk_usuario_tema` (`id_usuario`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `fk_usuario_tickets` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_rol_usuarios` (`id_rol`);

--
-- Indices de la tabla `usuarios_logros`
--
ALTER TABLE `usuarios_logros`
  ADD PRIMARY KEY (`id_usuario`,`id_logro`),
  ADD KEY `fk_id_logro_usu_logro` (`id_logro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id_alquiler` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrito_item`
--
ALTER TABLE `carrito_item`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `id_foro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `logros`
--
ALTER TABLE `logros`
  MODIFY `id_logro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `pedido_item`
--
ALTER TABLE `pedido_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414977;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id_recibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `fk_juegos_alquileres` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedido_alquileres` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedidoitem_alquileres` FOREIGN KEY (`id_pedido_item`) REFERENCES `pedido_item` (`id_item`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_alquileres` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito_item`
--
ALTER TABLE `carrito_item`
  ADD CONSTRAINT `fk_carrito_juego` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juego_categoria`
--
ALTER TABLE `juego_categoria`
  ADD CONSTRAINT `fk_id_categorias_juego_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_juego_juego_categoria` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_metodo` FOREIGN KEY (`metodo_pago`) REFERENCES `metodo_pago` (`id_metodo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_item`
--
ALTER TABLE `pedido_item`
  ADD CONSTRAINT `fk_pitems_juego` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pitems_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD CONSTRAINT `fk_recibos_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `recibos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_tema_respuestas` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_respuestas` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `fk_foro_tema` FOREIGN KEY (`id_foro`) REFERENCES `foros` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_tema` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_usuario_tickets` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_rol_usuarios` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_logros`
--
ALTER TABLE `usuarios_logros`
  ADD CONSTRAINT `fk_id_logro_usu_logro` FOREIGN KEY (`id_logro`) REFERENCES `logros` (`id_logro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_usu_logro` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

