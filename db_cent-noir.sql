-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2025 a las 01:39:05
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
-- Base de datos: `db_cent-noir`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion`, `activo`) VALUES
(1, 'Guitarras', 0),
(2, 'Bajos', 0),
(3, 'Baterias', 0),
(4, 'Componentes', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tipo_consulta` varchar(20) DEFAULT NULL,
  `mensaje` varchar(100) NOT NULL,
  `fecha_consulta` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_respuesta` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `respuesta` varchar(100) NOT NULL,
  `leida` tinyint(4) DEFAULT 0,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `nombre`, `email`, `tipo_consulta`, `mensaje`, `fecha_consulta`, `fecha_respuesta`, `respuesta`, `leida`, `id_usuario`) VALUES
(1, 'Esteban Junior Centurion', 'esteban.centu@gmail.com', NULL, 'Buen dia, necesito catalogo de guitarras acusticas para concierto por mayor.Gracias', '2025-06-24 09:50:00', '2025-06-24 09:50:00', 'Buenos dias, en instantes enviamos catalogo por correo.', 1, 2),
(2, 'Lujan Campos', 'lujan.90@yahoo.com', NULL, 'Hola estaria necesitando bajo para jazz, que me recomendarias? Gracias', '2025-06-24 09:47:36', '2025-06-24 09:47:36', '', 0, NULL),
(3, 'Gabriel Mendoza', 'gabrielM20@gmail.com', NULL, 'Buenas tardes, amplificadaores fender van a incorporar este mes ? gracias', '2025-06-24 16:24:30', '2025-06-24 16:24:30', '', 0, 6),
(4, 'Rocio  Orquera', 'rorquera@gmail.com', NULL, 'Buenas Noches. Estoy necesitando una guitarra acustica Yamaha para concierto premium.Gracias', '2025-06-24 16:25:52', '2025-06-24 16:25:52', '', 0, 7),
(5, 'Tomas Fernandez', 'tomas10@gmail.com', NULL, 'Buenas necesito bateria para practica escolar.Gracias', '2025-06-24 16:27:21', '2025-06-24 16:27:21', '', 0, NULL),
(6, 'Sebas Cano', 'cano1994@gmail.com', NULL, 'Hola que tal, necesito bajo Fender para estudio de alta gama, que me podes traer de Estados Unidos. ', '2025-06-24 16:28:33', '2025-06-24 16:28:33', '', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `id_domicilio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `codigo_postal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id_domicilio`, `id_usuario`, `direccion`, `telefono`, `ciudad`, `pais`, `dni`, `codigo_postal`) VALUES
(1, 3, 'España 3302', '3794478365', 'Corrientes Capital', 'Argentina', '32547895', 3400),
(3, 4, 'Matheu 5', '3794904535', 'Corrientes Capital', 'Argentina', '38876107', 3400),
(4, 6, 'Calle Reconqusita 3302', '3794904534', 'Corrientes Capital', 'Argentina', '25789654', 3500),
(6, 7, 'Gra.Paz 1458', '3794478721', 'Corrientes Capital', 'Chile', '45795123', 3400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_usuario`
--

CREATE TABLE `log_usuario` (
  `id_log` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo_origen` enum('usuario','visitante','admin') DEFAULT 'usuario',
  `accion` varchar(100) NOT NULL,
  `detalle` text DEFAULT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `log_usuario`
--

INSERT INTO `log_usuario` (`id_log`, `id_usuario`, `tipo_origen`, `accion`, `detalle`, `fecha_hora`) VALUES
(1, 2, 'usuario', 'Consulta enviada', 'Esteban Junior Centurion (esteban.centu@gmail.com) envió una consulta. Mensaje: Buen dia, necesito catalogo de guitarras acusticas para concierto por mayor.Gracias...', '2025-06-24 09:46:55'),
(2, NULL, 'visitante', 'Consulta enviada', 'Lujan Campos (lujan.90@yahoo.com) envió una consulta. Mensaje: Hola estaria necesitando bajo para jazz, que me recomendarias? Gracias...', '2025-06-24 09:47:36'),
(3, 6, 'usuario', 'Consulta enviada', 'Gabriel Mendoza (gabrielM20@gmail.com) envió una consulta. Mensaje: Buenas tardes, amplificadaores fender van a incorporar este mes ? gracias...', '2025-06-24 16:24:31'),
(4, 7, 'usuario', 'Consulta enviada', 'Rocio  Orquera (rorquera@gmail.com) envió una consulta. Mensaje: Buenas Noches. Estoy necesitando una guitarra acustica Yamaha para concierto premium.Gracias...', '2025-06-24 16:25:52'),
(5, NULL, 'visitante', 'Consulta enviada', 'Tomas Fernandez (tomas10@gmail.com) envió una consulta. Mensaje: Buenas necesito bateria para practica escolar.Gracias...', '2025-06-24 16:27:21'),
(6, NULL, 'visitante', 'Consulta enviada', 'Sebas Cano (cano1994@gmail.com) envió una consulta. Mensaje: Hola que tal, necesito bajo Fender para estudio de alta gama, que me podes traer de Estados Unidos. ...', '2025-06-24 16:28:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion_producto` varchar(255) NOT NULL,
  `imagen` longblob NOT NULL,
  `stock` int(50) NOT NULL,
  `stock_min` int(50) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0,
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre_producto`, `id_categoria`, `precio`, `descripcion_producto`, `imagen`, `stock`, `stock_min`, `estado`, `fecha_modificacion`) VALUES
(1, 'Guitarra Electro acustica Fender', 1, 255000, 'Guitarra electroacústica con ecualizador incorporado. Sonido natural amplificado.', 0x313734393537353938345f64346237616663323165386634623762616332362e706e67, 8, 1, 1, '2025-06-18 09:47:40'),
(2, 'Bateria YAMAHA ', 3, 680000, 'Sonido clásico y profundo, ideal para rock, jazz o cualquier estilo. Calidad profesional.', 0x313734393537363130395f36316264386334343563353663313538306266622e706e67, 2, 1, 1, '2025-06-24 14:53:52'),
(3, 'Bajo electrico', 2, 360000, 'Bajo eléctrico de 4 cuerdas con gran versatilidad. Ideal para todo nivel.', 0x313734393537363235385f63646431373535643832326234653466663436312e706e67, 14, 1, 1, '2025-06-24 10:30:27'),
(4, 'Micrófono Studio', 4, 375000, 'Micrófono condensador con excelente respuesta de frecuencia.', 0x313735303731303138305f34656138346538376535643866623066343632662e706e67, 14, 1, 0, '2025-06-24 09:43:42'),
(5, 'Guitarra Ibanez', 1, 780000, 'Versátil y liviana, ideal para principiantes o guitarristas intermedios.', 0x313734393539323638365f35633235393735373339313965323333656436612e706e67, 18, 1, 1, '2025-06-24 12:49:37'),
(6, 'Batería Yamaha Rock', 3, 575000, 'Configuración ideal para tocar en vivo con presencia y potencia.', 0x313734393539323739355f33623137303763303832383230653766363965612e706e67, 2, 1, 1, '2025-06-18 14:24:02'),
(7, 'Micrófono Profesional', 4, 315000, 'Respuesta clara y precisa, ideal para vocalistas y locutores.', 0x313734393539323834325f32313832643933383535333436323731336566392e706e67, 11, 1, 1, '2025-06-24 12:51:15'),
(8, 'Bajo Eléctrico Activo', 2, 745852, 'Electrónica activa para mayor potencia y control del tono.\r\n\r\n', 0x313735303135393232355f31613066643732353261643763653238613533332e706e67, 2, 2, 1, '2025-06-17 08:20:26'),
(9, 'Palillos para bateria', 4, 30300, 'Palillos de madera balanceados para prácticas y presentaciones.', 0x313735303135393431335f61653365653462323235393666356538313164322e706e67, 12, 1, 1, '2025-06-24 11:16:48'),
(10, 'Microfono Studio Condensador', 4, 550000, 'Alta sensibilidad para grabaciones profesionales en estudio.', 0x313735303135393438365f63333237343532383737616130323234633639372e706e67, 1, 1, 1, '2025-06-24 14:53:52'),
(11, 'Bateria Pearl Export', 3, 870000, 'Una de las líneas más vendidas, robusta y de gran respuesta sonora.', 0x313735303135393631345f35303634623461663331373561346332623238642e706e67, 2, 1, 1, '2025-06-24 14:53:52'),
(12, 'Guitarra Fender', 1, 790000, 'Diseñada para músicos avanzados que buscan un sonido profesional y clásico.', 0x313735303135393735395f66383637363561613934363536333330366563302e706e67, 2, 1, 1, '2025-06-24 10:28:49'),
(13, 'Puas fender ', 4, 35000, 'Experimenta el clásico tono Fender con estas púas de alta calidad, ideales para todo tipo de guitarristas.', 0x313735303738343133315f37363735316332623061303133356361383634632e706e67, 3, 1, 1, '2025-06-24 14:01:52'),
(14, 'Puas Gibson', 4, 40000, 'Púas Gibson originales diseñadas para un ataque suave y controlado. Perfectas para quienes buscan versatilidad y durabilidad', 0x313735303738343138315f33373433623631643032353638616336353461362e706e67, 10, 1, 1, '2025-06-24 13:56:21'),
(15, 'Cuerdas para guitarra (eléctrica o acústica)', 4, 15000, 'Cuerdas de alto rendimiento que brindan un tono brillante, excelente sustain y una sensación suave al tocar.', 0x313735303738343234345f34313866306164633636383836336532336632342e706e67, 20, 1, 1, '2025-06-24 13:57:24'),
(16, 'Guitarra acustica Yamaha', 1, 565400, 'Descubrí el equilibrio perfecto entre calidez, proyección y comodidad con esta guitarra acústica. Diseñada para músicos de todos los niveles', 0x313735303738343331355f38343532333432643338613364376665366232612e706e67, 9, 1, 1, '2025-06-24 14:02:30'),
(17, 'Guitarra acustica Gibson negra', 1, 355000, 'Guitarra de gama premium concierto, ofrece un sonido unico gracias a sus materiales de madera de primera calidad', 0x313735303738383037375f35353734393237363733613361326335643536632e706e67, 10, 1, 1, '2025-06-24 15:01:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0,
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_registro` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `usuario`, `password`, `id_perfil`, `estado`, `fecha_modificacion`, `fecha_registro`) VALUES
(1, 'Esteban Nahuel', 'Admin', 'user_admin@gmail.com', '', '$2y$10$so4SmB3ujrO5gzVzgaOVuu6hV54Cjle9jNAX/v/PC623zdwpKf8d2', 1, 1, '2025-06-24 09:38:58', '2025-06-24 09:38:58'),
(2, 'Esteban Junior', 'Centurion', 'esteban.centu@gmail.com', 'esteban_cent', '$2y$10$s7UcfVucUi/vwtwgeLR6OuuZdMdX8zYzPkzjkllZtc3UwzGR6CQ.e', 2, 1, '2025-06-24 09:40:13', '2025-06-24 09:40:13'),
(3, 'Juan ', 'Rodriguez', 'juan90@gmail.com', '', '$2y$10$3X0XPBW9iZ1fHICoToaGeu6PcGFBBH/9FvrS4JAXURfua6GCK67bK', 2, 0, '2025-06-24 14:04:07', '2025-06-24 14:04:07'),
(4, 'User ', 'facena UNNE', 'user_facena@unne.com', '', '$2y$10$C5ySjS.IyNMsq7cx1pmNgu8d2gYFxSGpm55EveqnNgxolOnzEzS8K', 2, 1, '2025-06-23 11:46:51', '2025-06-23 11:46:51'),
(5, 'Esteban Agustín', 'Centurión', 'agustincent95@gmail.com', '', '$2y$10$iu.btFcq/ascg2G7wORxe.E1DakEhaQce6ceaOPSwybpZ2oNyqIlq', 2, 1, '2025-06-10 20:50:16', '2025-06-10 20:50:16'),
(6, 'Gabriel', 'Mendoza', 'gabrielM20@gmail.com', '', '$2y$10$ANpPRpZgjMT5ZHheH3wctOEuw4UJyZ/KVE73jezvZRY0ramLDdDI.', 2, 1, '2025-06-24 14:00:14', '2025-06-24 14:00:14'),
(7, 'Rocio ', 'Orquera', 'rorquera@gmail.com', '', '$2y$10$yzWQmx9ywo97LPr2i0TlD.g2WKjV5gh14R05GVTxV9xaXQXG//mzy', 2, 1, '2025-06-23 19:44:43', '2025-06-23 19:44:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_id` int(11) NOT NULL DEFAULT 0,
  `total_venta` float(10,2) NOT NULL,
  `estado` varchar(50) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id`, `fecha`, `usuario_id`, `total_venta`, `estado`) VALUES
(1, '2025-06-01 08:47:16', 4, 790000.00, 'entregado'),
(2, '2025-06-11 12:31:10', 4, 360000.00, 'preparando'),
(3, '2025-06-11 12:31:40', 4, 900300.00, 'preparando'),
(4, '2025-06-13 11:21:12', 4, 780000.00, 'pendiente'),
(5, '2025-06-24 12:49:36', 7, 1330000.00, 'pendiente'),
(6, '2025-06-24 12:51:15', 7, 315000.00, 'pendiente'),
(7, '2025-06-24 14:01:51', 6, 70000.00, 'pendiente'),
(8, '2025-06-24 14:02:30', 6, 565400.00, 'pendiente'),
(9, '2025-06-24 14:53:52', 3, 2100000.00, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 12, 1, 790000),
(2, 2, 3, 1, 360000),
(3, 3, 11, 1, 870000),
(4, 3, 9, 1, 30300),
(5, 4, 5, 1, 780000),
(6, 5, 10, 1, 550000),
(7, 5, 5, 1, 780000),
(8, 6, 7, 1, 315000),
(9, 7, 13, 2, 35000),
(10, 8, 16, 1, 565400),
(11, 9, 2, 1, 680000),
(12, 9, 10, 1, 550000),
(13, 9, 11, 1, 870000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `fk_usuario_consulta` (`id_usuario`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`id_domicilio`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `log_usuario`
--
ALTER TABLE `log_usuario`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `categoria` (`id_categoria`),
  ADD KEY `categoria_2` (`id_categoria`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_perfil_2` (`id_perfil`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `log_usuario`
--
ALTER TABLE `log_usuario`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `fk_usuario_consulta` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `domicilio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `log_usuario`
--
ALTER TABLE `log_usuario`
  ADD CONSTRAINT `log_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

--
-- Filtros para la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD CONSTRAINT `ventas_cabecera_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `ventas_detalle_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `ventas_detalle_ibfk_4` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
