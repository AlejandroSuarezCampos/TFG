-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2026 a las 19:39:38
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
(14, 'Mundo Abierto'),
(16, 'JAVIER');

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
(1, 'Primero Foro de la pagina', 'PrimerForo');

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
  `ventas` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `stock` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id_juego`, `titulo`, `descripcion`, `precio_alquiler`, `imagen`, `ventas`, `stock`) VALUES
(1, 'Inazuma Eleven 2: Ventisca Eterna', 'RPG de fútbol lanzado en 2009 para Nintendo DS.', 1.50, './img/inazuma_eleven_2_ventisca_eterna.jpg', 0, 0),
(2, 'FIFA 19', 'Simulador de fútbol lanzado en 2018 para PS4, Xbox One y PC.', 2.50, './img/fifa_19.jpg', 0, 10),
(3, 'Star Wars Battlefront', 'Shooter en primera persona lanzado en 2015 para PS4, Xbox One y PC.', 2.00, './img/star_wars_battlefront.jpg', 1, 9),
(4, 'Need for Speed Most Wanted', 'Juego de carreras arcade lanzado en 2005 para múltiples plataformas.', 1.50, './img/need_for_speed_most_wanted.jpg', 0, 10),
(5, 'PES 2015', 'Simulador de fútbol lanzado en 2014 para PS3, PS4, Xbox y PC.', 2.00, './img/pes_2015.jpg', 0, 10),
(6, 'Overcooked', 'Juego cooperativo de cocina lanzado en 2016 para consolas y PC.', 2.00, './img/overcooked.jpg', 2, 8),
(7, 'Hollow Knight', 'Metroidvania indie lanzado en 2017 para PC y consolas.', 2.50, './img/hollow_knight.jpg', 1, 9),
(8, 'Call of Duty: Black Ops III', 'Shooter en primera persona lanzado en 2015 para PS4, Xbox One y PC.', 3.00, './img/call_of_duty_black_ops_iii.jpg', 0, 10),
(9, 'Cyberpunk 2077', 'RPG de mundo abierto lanzado en 2020 para consolas y PC.', 3.50, './img/cyberpunk_2077.jpg', 0, 10),
(10, 'Devil May Cry HD Collection', 'Colección de acción hack and slash lanzada en 2012.', 2.00, './img/devil_may_cryl_hd_collection.jpg', 0, 10),
(11, 'GTA San Andreas', 'Juego de acción en mundo abierto lanzado en 2004.', 1.50, './img/gta_san_andreas.jpg', 0, 10),
(12, 'Outlast', 'Juego de terror en primera persona lanzado en 2013.', 2.00, './img/outlast.jpg', 0, 10),
(13, 'Until Dawn', 'Juego de terror narrativo lanzado en 2015 para PS4.', 2.50, './img/until_dawn.jpg', 0, 10),
(14, 'Persona 3 Reload', 'Remake del JRPG clásico lanzado en 2024 para consolas y PC.', 3.50, './img/persona_3_reload.jpg', 0, 10),
(15, 'Persona 4 Golden', 'JRPG lanzado originalmente en 2012 y relanzado en PC y consolas.', 2.50, './img/persona_4_golden.jpg', 0, 10),
(16, 'Persona 5 Royal', 'JRPG lanzado en 2020 para PS4 y otras plataformas.', 3.00, './img/persona_5_royal.jpg', 1, 9),
(17, 'Plantas Contra Zombies', 'Juego de estrategia y defensa de torres lanzado en 2009.', 1.50, './img/plantas_contra_zombies.jpg', 0, 10),
(18, 'Slime Rancher', 'Juego de simulación y exploración lanzado en 2017.', 2.50, './img/slime_rancher.jpg', 0, 10),
(19, 'Uncharted', 'Aventura de acción lanzada en 2007 para PS3.', 2.00, './img/uncharted_1.jpg', 0, 10),
(20, 'Uncharted 2', 'Aventura de acción lanzada en 2009 para PS3.', 2.00, './img/uncharted_2.jpg', 0, 10),
(21, 'Uncharted 3', 'Aventura de acción lanzada en 2011 para PS3.', 2.00, './img/uncharted_3.jpg', 0, 10),
(22, 'Uncharted 4', 'Aventura de acción lanzada en 2016 para PS4.', 2.50, './img/uncharted_4.jpg', 0, 10),
(23, 'The Last of Us', 'Juego de acción y supervivencia lanzado en 2013 para PS3.', 2.50, './img/the_last_of_us.jpg', 0, 10),
(24, 'The Last of Us Part II', 'Juego de acción y supervivencia lanzado en 2020 para PlayStation 4.', 3.50, './img/the_last_of_us_part_2.jpg', 0, 10),
(39, 'Dragon Legacy', 'Multijugador masivo en línea (MMO) de supervivencia en un mundo abierto', 1.00, 'img/DragonLegacy.png', 2, 0),
(40, 'Red Dead Redemption 2', 'Aventura de mundo abierto ambientada en el salvaje oeste lanzada en 2018.', 3.50, './img/red_dead_redemption_2.png', 1, 9),
(41, 'Minecraft', 'Juego de construcción y supervivencia lanzado oficialmente en 2011.', 2.00, './img/minecraft.png', 0, 15),
(42, 'Elden Ring', 'RPG de acción de mundo abierto desarrollado por FromSoftware y lanzado en 2022.', 4.00, './img/elden_ring.png', 0, 10),
(43, 'God of War Ragnarök', 'Aventura de acción mitológica lanzada en 2022 para PlayStation.', 4.00, './img/god_of_war_ragnarok.png', 0, 8),
(44, 'Mario Kart 8 Deluxe', 'Juego de carreras arcade de Nintendo lanzado para Switch en 2017.', 2.50, './img/mario_kart_8_deluxe.png', 0, 12),
(45, 'Resident Evil 4 Remake', 'Remake del clásico survival horror lanzado en 2023.', 3.50, './img/resident_evil_4_remake.png', 0, 10),
(46, 'Sekiro Shadows Die Twice', 'Juego de acción y samuráis desarrollado por FromSoftware lanzado en 2019.', 3.00, './img/sekiro_shadows_die_twice.jpg', 1, 8),
(47, 'Animal Crossing New Horizons', 'Simulador social y de vida lanzado para Nintendo Switch en 2020.', 2.50, './img/animal_crossing_new_horizons.png', 1, 13),
(48, 'Hades', 'Roguelike de acción inspirado en la mitología griega lanzado en 2020.', 2.50, './img/hades.png', 0, 11),
(49, 'Assassins Creed Valhalla', 'Juego de acción y exploración vikinga lanzado en 2020.', 3.00, './img/assassins_creed_valhalla.png', 1, 9),
(60, 'FC 26', 'Es la última evolución del simulador de fútbol de EA, destacando por una jugabilidad más pausada y realista, IA defensiva mejorada', 1.25, './img/fc26.png', 0, 0);

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
(24, 12),
(39, 4),
(39, 6),
(39, 14),
(40, 4),
(40, 5),
(40, 14),
(41, 5),
(41, 10),
(41, 11),
(41, 14),
(42, 4),
(42, 6),
(42, 14),
(43, 4),
(43, 5),
(43, 12),
(44, 2),
(44, 3),
(45, 4),
(45, 7),
(45, 8),
(46, 4),
(46, 5),
(46, 6),
(47, 10),
(47, 11),
(48, 4),
(48, 6),
(48, 10),
(49, 4),
(49, 5),
(49, 6),
(49, 14),
(60, 1),
(60, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `id_logro` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logros`
--

INSERT INTO `logros` (`id_logro`, `nombre`, `descripcion`, `foto`) VALUES
(1, 'Platino', 'Consigue todos los logros', 'https://www.laps4.com/foro/trofeos/psntrofeos/220627_tm.PNG'),
(2, 'New begining', 'Haz tu primera compra', 'https://i.psnprofiles.com/games/ec070c/trophies/1Se5d667.png'),
(3, 'Consumista', 'Gasta 50€ en la web', 'https://www.laps4.com/foro/trofeos/psntrofeos/109743_tm.PNG'),
(4, 'Comunidad', 'Crea tu primer tema', 'https://i.psnprofiles.com/games/472bfe/trophies/1Sd95001.png');

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
-- Estructura de tabla para la tabla `msgticket`
--

CREATE TABLE `msgticket` (
  `id_mensaje` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensaje` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `estado` enum('pagado','reembolsado') NOT NULL DEFAULT 'pagado',
  `fecha_reembolso` datetime DEFAULT NULL,
  `motivo_reembolso` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Disparadores `pedido_item`
--
DELIMITER $$
CREATE TRIGGER `trg_crear_alquiler` AFTER UPDATE ON `pedido_item` FOR EACH ROW BEGIN

    IF OLD.canjeado = 0 AND NEW.canjeado = 1 THEN

        INSERT INTO alquileres (
            id_usuario,
            id_juego,
            fecha_inicio,
            fecha_fin,
            estado,
            id_pedido_item,
            id_pedido
        )
        VALUES (
            (SELECT p.id_usuario
             FROM pedido p
             WHERE p.id_pedido = NEW.id_pedido
             LIMIT 1),
            NEW.id_juego,
            NOW(),
            DATE_ADD(NOW(), INTERVAL NEW.duracion HOUR),
            'activo',
            NEW.id_item,
            NEW.id_pedido
        );

    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE `recibos` (
  `id_recibo` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `numero_factura` varchar(50) NOT NULL,
  `nombre_fichero` varchar(255) NOT NULL,
  `estado` enum('pagado','cancelado','reembolsado') DEFAULT 'pagado',
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `fecha_emision` datetime DEFAULT current_timestamp(),
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'SuperAdmin'),
(2, 'Foros'),
(3, 'Usuarios'),
(4, 'Pedidos'),
(5, 'Categorias'),
(6, 'Juegos'),
(7, 'Tickets');

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
(1, 'Foro', 1, 3, '2026-05-17 17:10:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `asunto` varchar(200) DEFAULT NULL,
  `estado` enum('abierto','cerrado') DEFAULT 'abierto',
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `id_usuario`, `asunto`, `estado`, `fecha`) VALUES
(1, 3, 'Prueba', 'abierto', '2026-05-29 13:51:37');

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
  `id_rol` int(11) DEFAULT 0,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `foto`, `nivel`, `estado`, `id_rol`, `fecha_registro`) VALUES
(3, 'ADMINISTRADOR', 'administrador@gmail.com', '$2y$10$EN4xGAhqL/8d7W7rjecruON7CavhTZTkp62WaYncnlDGx8AGv31I6', './img/foto_usu.png', 1, 'activo', 1, '2026-03-30 14:45:24'),
(14, 'adminUsuario', 'correoUsuario@gmail.com', '$2y$10$d/C39def57jDbV.PvSmqXuc4SQlHi5QsUfjOQK/S0QAJN/1MJ17Ra', './img/foto_usu.png', 1, 'activo', 3, '2026-05-29 16:43:47'),
(15, 'adminForos', 'correoForos@gmail.com', '$2y$10$KAz3CHM/XrXjKGadzOkeBuMc/pGwKvVOYDk2ij7zDGD7L18ScKaW6', './img/foto_usu.png', 1, 'activo', 2, '2026-05-29 16:45:09'),
(16, 'adminPedidos', 'CorreoPedidos@gmail.com', '$2y$10$7xMYagr9F.Q1BM1cXFE7/.ELx5KLs66CcVEQiGH.QbTj5BaiE9a/2', './img/foto_usu.png', 1, 'activo', 4, '2026-05-29 16:48:23'),
(17, 'adminCategorias', 'correoCategorias@gmail.com', '$2y$10$ke2ooKE1OMHK42/./Qg5jewO70wz.ro9ubRetztkk16VBr8M3LG4C', './img/foto_usu.png', 1, 'activo', 5, '2026-05-29 16:48:56'),
(18, 'adminJuegos', 'correoJuegos@gmail.com', '$2y$10$fVupbLQZ9okK//Zq9WMfZOfMcrAS7RXUf/hhyP4.SQL1IvSHBDBhm', './img/foto_usu.png', 1, 'activo', 6, '2026-05-29 16:49:25'),
(19, 'adminTickets', 'correoTickets@gmail.com', '$2y$10$JW/q.zvZhDn96Iz9pLXKIevM3uowGC/3eOkr2CsF7Qpnm0p57FV5W', './img/foto_usu.png', 1, 'activo', 7, '2026-05-29 16:49:48'),
(24, 'Usuario', 'javitocanico@gmail.com', '$2y$10$dLpwA2o41PRBJXwWdxIzFeHlTpHn0L4qqTUXyzH.lJ3V3Kjz6UCp.', './img/foto_usu.png', 1, 'activo', 0, '2026-05-29 19:29:37');

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
-- Volcado de datos para la tabla `usuarios_logros`
--

INSERT INTO `usuarios_logros` (`id_usuario`, `id_logro`, `fecha`) VALUES
(3, 1, '2026-05-29 13:14:48'),
(3, 2, '2026-05-29 13:14:48'),
(3, 3, '2026-05-29 13:14:48'),
(3, 4, '2026-05-29 13:14:48'),
(24, 2, '2026-05-29 19:35:45');

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
-- Indices de la tabla `msgticket`
--
ALTER TABLE `msgticket`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `fk_msg_ticket` (`id_ticket`),
  ADD KEY `fk_msg_usuario` (`id_usuario`);

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
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `id_foro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `logros`
--
ALTER TABLE `logros`
  MODIFY `id_logro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `msgticket`
--
ALTER TABLE `msgticket`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `pedido_item`
--
ALTER TABLE `pedido_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415003;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id_recibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  ADD CONSTRAINT `fk_usuario_alquileres` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Filtros para la tabla `msgticket`
--
ALTER TABLE `msgticket`
  ADD CONSTRAINT `fk_msg_ticket` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id_ticket`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_msg_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_metodo` FOREIGN KEY (`metodo_pago`) REFERENCES `metodo_pago` (`id_metodo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `fk_recibos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_tema_respuestas` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_respuestas` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

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

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `FINALIZAR_ALQUILERES` ON SCHEDULE EVERY 1 MINUTE STARTS '2026-05-28 11:27:04' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE alquileres
SET estado = 'expirado'
WHERE fecha_fin <= NOW()
AND estado = 'activo'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
