-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-04-2019 a las 22:09:11
-- Versión del servidor: 10.2.23-MariaDB-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eboxcl_labmarss`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_AgendaVisita`
--

CREATE TABLE `TBL_AgendaVisita` (
  `id_agendamiento_visita` int(10) NOT NULL,
  `rut_empresa` varchar(10) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `nombre_proyecto` varchar(100) NOT NULL,
  `direccion_proyecto` text NOT NULL,
  `contacto_proyecto` varchar(100) NOT NULL,
  `email_proyecto` varchar(100) NOT NULL,
  `telefono_proyecto` int(15) NOT NULL,
  `id_destino` int(2) NOT NULL,
  `id_laboratorista` int(3) NOT NULL,
  `fecha_agendamiento` date NOT NULL,
  `hora_ini_agendamiento` time NOT NULL,
  `hora_fin_agendamiento` time NOT NULL,
  `observaciones` longtext NOT NULL,
  `fecha_operacion` date NOT NULL,
  `id_cotizacion` int(10) NOT NULL,
  `id_form_aceptacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Agendamiento de visita';

--
-- Volcado de datos para la tabla `TBL_AgendaVisita`
--

INSERT INTO `TBL_AgendaVisita` (`id_agendamiento_visita`, `rut_empresa`, `razon_social`, `nombre_proyecto`, `direccion_proyecto`, `contacto_proyecto`, `email_proyecto`, `telefono_proyecto`, `id_destino`, `id_laboratorista`, `fecha_agendamiento`, `hora_ini_agendamiento`, `hora_fin_agendamiento`, `observaciones`, `fecha_operacion`, `id_cotizacion`, `id_form_aceptacion`) VALUES
(1, '997673374', 'Facturación PaloAlto AG', 'Obra Palo Alto AG', 'Circunvalación Sur S/N', 'Aceptante PaloAlto', 'CONTACTO@EBOX.CL', 2147483647, 75, 14, '2019-04-30', '12:30:00', '15:30:00', '', '2019-04-30', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_AgendaVisitaDetalle`
--

CREATE TABLE `TBL_AgendaVisitaDetalle` (
  `id_detalle_servicio_agendado` int(10) NOT NULL,
  `id_agendamiento_visita` int(10) NOT NULL,
  `id_tipo_ensayo` int(10) NOT NULL,
  `cantidad` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Detalle de servicios agendados';

--
-- Volcado de datos para la tabla `TBL_AgendaVisitaDetalle`
--

INSERT INTO `TBL_AgendaVisitaDetalle` (`id_detalle_servicio_agendado`, `id_agendamiento_visita`, `id_tipo_ensayo`, `cantidad`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_AgendaVisitaDetalleEquipo`
--

CREATE TABLE `TBL_AgendaVisitaDetalleEquipo` (
  `id_detalle_equipo_agendado` int(10) NOT NULL,
  `id_agendamiento_visita` int(10) NOT NULL,
  `id_equipo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Detalle de equipos agendados';

--
-- Volcado de datos para la tabla `TBL_AgendaVisitaDetalleEquipo`
--

INSERT INTO `TBL_AgendaVisitaDetalleEquipo` (`id_detalle_equipo_agendado`, `id_agendamiento_visita`, `id_equipo`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30),
(31, 1, 31),
(32, 1, 32),
(33, 1, 33),
(34, 1, 34),
(35, 1, 35),
(36, 1, 36),
(37, 1, 37),
(38, 1, 38),
(39, 1, 39),
(40, 1, 40),
(41, 1, 41),
(42, 1, 42),
(43, 1, 43),
(44, 1, 45),
(45, 1, 46),
(46, 1, 47),
(47, 1, 48),
(48, 1, 49),
(49, 1, 50),
(50, 1, 51),
(51, 1, 52),
(52, 1, 53),
(53, 1, 54),
(54, 1, 55),
(55, 1, 56),
(56, 1, 57),
(57, 1, 58),
(58, 1, 59),
(59, 1, 60),
(60, 1, 61),
(61, 1, 62),
(62, 1, 63),
(63, 1, 64),
(64, 1, 65),
(65, 1, 66),
(66, 1, 67),
(67, 1, 68),
(68, 1, 69),
(69, 1, 70),
(70, 1, 71),
(71, 1, 72),
(72, 1, 73),
(73, 1, 74),
(74, 1, 75),
(75, 1, 76),
(76, 1, 77),
(77, 1, 78),
(78, 1, 79),
(79, 1, 80),
(80, 1, 81),
(81, 1, 82),
(82, 1, 83),
(83, 1, 84),
(84, 1, 85),
(85, 1, 86),
(86, 1, 87),
(87, 1, 88),
(88, 1, 89),
(89, 1, 90),
(90, 1, 91);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CatSS`
--

CREATE TABLE `TBL_CatSS` (
  `id_categoria_item_solicitud_servicio` int(2) NOT NULL,
  `nombre_categoria_item_solicitud_servicio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='categorias solicitud de servicio';

--
-- Volcado de datos para la tabla `TBL_CatSS`
--

INSERT INTO `TBL_CatSS` (`id_categoria_item_solicitud_servicio`, `nombre_categoria_item_solicitud_servicio`) VALUES
(1, 'Mecánica de Suelo'),
(2, 'Densidad'),
(3, 'Áridos'),
(4, 'Aguas'),
(5, 'Hormigón'),
(6, 'Elementos y Componentes'),
(7, 'Asfalto'),
(8, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Cliente`
--

CREATE TABLE `TBL_Cliente` (
  `id_cliente` int(10) NOT NULL,
  `rut_cliente` varchar(10) NOT NULL,
  `nombre_cliente` varchar(30) NOT NULL,
  `razon_social` varchar(75) NOT NULL,
  `direccion_cliente` text NOT NULL,
  `contacto_cliente` varchar(50) NOT NULL,
  `telefono_cliente` varchar(15) NOT NULL,
  `email_cliente` varchar(50) NOT NULL,
  `tarifado` int(2) NOT NULL,
  `id_periodo_pago_cli` int(2) NOT NULL,
  `id_forma_pago_cli` int(2) NOT NULL,
  `libre_envio` int(2) NOT NULL,
  `id_estado_cliente` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_Cliente`
--

INSERT INTO `TBL_Cliente` (`id_cliente`, `rut_cliente`, `nombre_cliente`, `razon_social`, `direccion_cliente`, `contacto_cliente`, `telefono_cliente`, `email_cliente`, `tarifado`, `id_periodo_pago_cli`, `id_forma_pago_cli`, `libre_envio`, `id_estado_cliente`) VALUES
(1, '764183347', 'Tecnotrack', 'Tecnotrack SPA', 'Av Apoquindo 5583 Of 31 Las condes Santiago', 'Rodrigo Saavedra', '2121121212', 'contacto@tecnotrack.cl', 1, 3, 2, 0, 1),
(2, '76232460-K', 'Pro Invest', 'Paloalto AG', 'Las Hualtatas S/N', 'Alfredo Leal', '121212121', 'contacto@ebox.cl', 1, 3, 2, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_ClienteEstado`
--

CREATE TABLE `TBL_ClienteEstado` (
  `id_estado_cliente` int(2) NOT NULL,
  `nombre_estado` varchar(15) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_ClienteEstado`
--

INSERT INTO `TBL_ClienteEstado` (`id_estado_cliente`, `nombre_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_ClienteUsuarios`
--

CREATE TABLE `TBL_ClienteUsuarios` (
  `ClienteUsuarios_Id` int(10) NOT NULL,
  `ClienteUsuarios_Nombre` varchar(100) NOT NULL,
  `ClienteUsuarios_Email` varchar(100) NOT NULL,
  `ClienteUsuarios_IdCliente` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_ClienteUsuarios`
--

INSERT INTO `TBL_ClienteUsuarios` (`ClienteUsuarios_Id`, `ClienteUsuarios_Nombre`, `ClienteUsuarios_Email`, `ClienteUsuarios_IdCliente`) VALUES
(1, 'RODRIGO SAAVEDRA', 'CONTACTO@TECNOTRACK.CL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Comuna`
--

CREATE TABLE `TBL_Comuna` (
  `comuna_id` int(11) NOT NULL,
  `comuna_nombre` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_Comuna`
--

INSERT INTO `TBL_Comuna` (`comuna_id`, `comuna_nombre`, `provincia_id`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 2),
(4, 'Putre', 2),
(5, 'Alto Hospicio', 3),
(6, 'Iquique', 3),
(7, 'Camiña', 4),
(8, 'Colchane', 4),
(9, 'Huara', 4),
(10, 'Pica', 4),
(11, 'Pozo Almonte', 4),
(12, 'Antofagasta', 5),
(13, 'Mejillones', 5),
(14, 'Sierra Gorda', 5),
(15, 'Taltal', 5),
(16, 'Calama', 6),
(17, 'Ollague', 6),
(18, 'San Pedro de Atacama', 6),
(19, 'María Elena', 7),
(20, 'Tocopilla', 7),
(21, 'Chañaral', 8),
(22, 'Diego de Almagro', 8),
(23, 'Caldera', 9),
(24, 'Copiapó', 9),
(25, 'Tierra Amarilla', 9),
(26, 'Alto del Carmen', 10),
(27, 'Freirina', 10),
(28, 'Huasco', 10),
(29, 'Vallenar', 10),
(30, 'Canela', 11),
(31, 'Illapel', 11),
(32, 'Los Vilos', 11),
(33, 'Salamanca', 11),
(34, 'Andacollo', 12),
(35, 'Coquimbo', 12),
(36, 'La Higuera', 12),
(37, 'La Serena', 12),
(38, 'Paihuaco', 12),
(39, 'Vicuña', 12),
(40, 'Combarbalá', 13),
(41, 'Monte Patria', 13),
(42, 'Ovalle', 13),
(43, 'Punitaqui', 13),
(44, 'Río Hurtado', 13),
(45, 'Isla de Pascua', 14),
(46, 'Calle Larga', 15),
(47, 'Los Andes', 15),
(48, 'Rinconada', 15),
(49, 'San Esteban', 15),
(50, 'La Ligua', 16),
(51, 'Papudo', 16),
(52, 'Petorca', 16),
(53, 'Zapallar', 16),
(54, 'Hijuelas', 17),
(55, 'La Calera', 17),
(56, 'La Cruz', 17),
(57, 'Limache', 17),
(58, 'Nogales', 17),
(59, 'Olmué', 17),
(60, 'Quillota', 17),
(61, 'Algarrobo', 18),
(62, 'Cartagena', 18),
(63, 'El Quisco', 18),
(64, 'El Tabo', 18),
(65, 'San Antonio', 18),
(66, 'Santo Domingo', 18),
(67, 'Catemu', 19),
(68, 'Llaillay', 19),
(69, 'Panquehue', 19),
(70, 'Putaendo', 19),
(71, 'San Felipe', 19),
(72, 'Santa María', 19),
(73, 'Casablanca', 20),
(74, 'Concón', 20),
(75, 'Juan Fernández', 20),
(76, 'Puchuncaví', 20),
(77, 'Quilpué', 20),
(78, 'Quintero', 20),
(79, 'Valparaíso', 20),
(80, 'Villa Alemana', 20),
(81, 'Viña del Mar', 20),
(82, 'Colina', 21),
(83, 'Lampa', 21),
(84, 'Tiltil', 21),
(85, 'Pirque', 22),
(86, 'Puente Alto', 22),
(87, 'San José de Maipo', 22),
(88, 'Buin', 23),
(89, 'Calera de Tango', 23),
(90, 'Paine', 23),
(91, 'San Bernardo', 23),
(92, 'Alhué', 24),
(93, 'Curacaví', 24),
(94, 'María Pinto', 24),
(95, 'Melipilla', 24),
(96, 'San Pedro', 24),
(97, 'Cerrillos', 25),
(98, 'Cerro Navia', 25),
(99, 'Conchalí', 25),
(100, 'El Bosque', 25),
(101, 'Estación Central', 25),
(102, 'Huechuraba', 25),
(103, 'Independencia', 25),
(104, 'La Cisterna', 25),
(105, 'La Granja', 25),
(106, 'La Florida', 25),
(107, 'La Pintana', 25),
(108, 'La Reina', 25),
(109, 'Las Condes', 25),
(110, 'Lo Barnechea', 25),
(111, 'Lo Espejo', 25),
(112, 'Lo Prado', 25),
(113, 'Macul', 25),
(114, 'Maipú', 25),
(115, 'Ñuñoa', 25),
(116, 'Pedro Aguirre Cerda', 25),
(117, 'Peñalolén', 25),
(118, 'Providencia', 25),
(119, 'Pudahuel', 25),
(120, 'Quilicura', 25),
(121, 'Quinta Normal', 25),
(122, 'Recoleta', 25),
(123, 'Renca', 25),
(124, 'San Miguel', 25),
(125, 'San Joaquín', 25),
(126, 'San Ramón', 25),
(127, 'Santiago', 25),
(128, 'Vitacura', 25),
(129, 'El Monte', 26),
(130, 'Isla de Maipo', 26),
(131, 'Padre Hurtado', 26),
(132, 'Peñaflor', 26),
(133, 'Talagante', 26),
(134, 'Codegua', 27),
(135, 'Coínco', 27),
(136, 'Coltauco', 27),
(137, 'Doñihue', 27),
(138, 'Graneros', 27),
(139, 'Las Cabras', 27),
(140, 'Machalí', 27),
(141, 'Malloa', 27),
(142, 'Mostazal', 27),
(143, 'Olivar', 27),
(144, 'Peumo', 27),
(145, 'Pichidegua', 27),
(146, 'Quinta de Tilcoco', 27),
(147, 'Rancagua', 27),
(148, 'Rengo', 27),
(149, 'Requínoa', 27),
(150, 'San Vicente de Tagua Tagua', 27),
(151, 'La Estrella', 28),
(152, 'Litueche', 28),
(153, 'Marchihue', 28),
(154, 'Navidad', 28),
(155, 'Peredones', 28),
(156, 'Pichilemu', 28),
(157, 'Chépica', 29),
(158, 'Chimbarongo', 29),
(159, 'Lolol', 29),
(160, 'Nancagua', 29),
(161, 'Palmilla', 29),
(162, 'Peralillo', 29),
(163, 'Placilla', 29),
(164, 'Pumanque', 29),
(165, 'San Fernando', 29),
(166, 'Santa Cruz', 29),
(167, 'Cauquenes', 30),
(168, 'Chanco', 30),
(169, 'Pelluhue', 30),
(170, 'Curicó', 31),
(171, 'Hualañé', 31),
(172, 'Licantén', 31),
(173, 'Molina', 31),
(174, 'Rauco', 31),
(175, 'Romeral', 31),
(176, 'Sagrada Familia', 31),
(177, 'Teno', 31),
(178, 'Vichuquén', 31),
(179, 'Colbún', 32),
(180, 'Linares', 32),
(181, 'Longaví', 32),
(182, 'Parral', 32),
(183, 'Retiro', 32),
(184, 'San Javier', 32),
(185, 'Villa Alegre', 32),
(186, 'Yerbas Buenas', 32),
(187, 'Constitución', 33),
(188, 'Curepto', 33),
(189, 'Empedrado', 33),
(190, 'Maule', 33),
(191, 'Pelarco', 33),
(192, 'Pencahue', 33),
(193, 'Río Claro', 33),
(194, 'San Clemente', 33),
(195, 'San Rafael', 33),
(196, 'Talca', 33),
(197, 'Arauco', 34),
(198, 'Cañete', 34),
(199, 'Contulmo', 34),
(200, 'Curanilahue', 34),
(201, 'Lebu', 34),
(202, 'Los Álamos', 34),
(203, 'Tirúa', 34),
(204, 'Alto Biobío', 35),
(205, 'Antuco', 35),
(206, 'Cabrero', 35),
(207, 'Laja', 35),
(208, 'Los Ángeles', 35),
(209, 'Mulchén', 35),
(210, 'Nacimiento', 35),
(211, 'Negrete', 35),
(212, 'Quilaco', 35),
(213, 'Quilleco', 35),
(214, 'San Rosendo', 35),
(215, 'Santa Bárbara', 35),
(216, 'Tucapel', 35),
(217, 'Yumbel', 35),
(218, 'Chiguayante', 36),
(219, 'Concepción', 36),
(220, 'Coronel', 36),
(221, 'Florida', 36),
(222, 'Hualpén', 36),
(223, 'Hualqui', 36),
(224, 'Lota', 36),
(225, 'Penco', 36),
(226, 'San Pedro de La Paz', 36),
(227, 'Santa Juana', 36),
(228, 'Talcahuano', 36),
(229, 'Tomé', 36),
(230, 'Bulnes', 37),
(231, 'Chillán', 37),
(232, 'Chillán Viejo', 37),
(233, 'Cobquecura', 37),
(234, 'Coelemu', 37),
(235, 'Coihueco', 37),
(236, 'El Carmen', 37),
(237, 'Ninhue', 37),
(238, 'Ñiquen', 37),
(239, 'Pemuco', 37),
(240, 'Pinto', 37),
(241, 'Portezuelo', 37),
(242, 'Quillón', 37),
(243, 'Quirihue', 37),
(244, 'Ránquil', 37),
(245, 'San Carlos', 37),
(246, 'San Fabián', 37),
(247, 'San Ignacio', 37),
(248, 'San Nicolás', 37),
(249, 'Treguaco', 37),
(250, 'Yungay', 37),
(251, 'Carahue', 38),
(252, 'Cholchol', 38),
(253, 'Cunco', 38),
(254, 'Curarrehue', 38),
(255, 'Freire', 38),
(256, 'Galvarino', 38),
(257, 'Gorbea', 38),
(258, 'Lautaro', 38),
(259, 'Loncoche', 38),
(260, 'Melipeuco', 38),
(261, 'Nueva Imperial', 38),
(262, 'Padre Las Casas', 38),
(263, 'Perquenco', 38),
(264, 'Pitrufquén', 38),
(265, 'Pucón', 38),
(266, 'Saavedra', 38),
(267, 'Temuco', 38),
(268, 'Teodoro Schmidt', 38),
(269, 'Toltén', 38),
(270, 'Vilcún', 38),
(271, 'Villarrica', 38),
(272, 'Angol', 39),
(273, 'Collipulli', 39),
(274, 'Curacautín', 39),
(275, 'Ercilla', 39),
(276, 'Lonquimay', 39),
(277, 'Los Sauces', 39),
(278, 'Lumaco', 39),
(279, 'Purén', 39),
(280, 'Renaico', 39),
(281, 'Traiguén', 39),
(282, 'Victoria', 39),
(283, 'Corral', 40),
(284, 'Lanco', 40),
(285, 'Los Lagos', 40),
(286, 'Máfil', 40),
(287, 'Mariquina', 40),
(288, 'Paillaco', 40),
(289, 'Panguipulli', 40),
(290, 'Valdivia', 40),
(291, 'Futrono', 41),
(292, 'La Unión', 41),
(293, 'Lago Ranco', 41),
(294, 'Río Bueno', 41),
(295, 'Ancud', 42),
(296, 'Castro', 42),
(297, 'Chonchi', 42),
(298, 'Curaco de Vélez', 42),
(299, 'Dalcahue', 42),
(300, 'Puqueldón', 42),
(301, 'Queilén', 42),
(302, 'Quemchi', 42),
(303, 'Quellón', 42),
(304, 'Quinchao', 42),
(305, 'Calbuco', 43),
(306, 'Cochamó', 43),
(307, 'Fresia', 43),
(308, 'Frutillar', 43),
(309, 'Llanquihue', 43),
(310, 'Los Muermos', 43),
(311, 'Maullín', 43),
(312, 'Puerto Montt', 43),
(313, 'Puerto Varas', 43),
(314, 'Osorno', 44),
(315, 'Puero Octay', 44),
(316, 'Purranque', 44),
(317, 'Puyehue', 44),
(318, 'Río Negro', 44),
(319, 'San Juan de la Costa', 44),
(320, 'San Pablo', 44),
(321, 'Chaitén', 45),
(322, 'Futaleufú', 45),
(323, 'Hualaihué', 45),
(324, 'Palena', 45),
(325, 'Aisén', 46),
(326, 'Cisnes', 46),
(327, 'Guaitecas', 46),
(328, 'Cochrane', 47),
(329, 'O\'higgins', 47),
(330, 'Tortel', 47),
(331, 'Coihaique', 48),
(332, 'Lago Verde', 48),
(333, 'Chile Chico', 49),
(334, 'Río Ibáñez', 49),
(335, 'Antártica', 50),
(336, 'Cabo de Hornos', 50),
(337, 'Laguna Blanca', 51),
(338, 'Punta Arenas', 51),
(339, 'Río Verde', 51),
(340, 'San Gregorio', 51),
(341, 'Porvenir', 52),
(342, 'Primavera', 52),
(343, 'Timaukel', 52),
(344, 'Natales', 53),
(345, 'Torres del Paine', 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Correlativo`
--

CREATE TABLE `TBL_Correlativo` (
  `Correlativo_Id` int(10) NOT NULL,
  `Correlativo_Numero` varchar(10) NOT NULL,
  `Correlativo_IdLaboratorista` int(2) NOT NULL,
  `Correlativo_Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CorrelativoEstado`
--

CREATE TABLE `TBL_CorrelativoEstado` (
  `CorrelativoEstado_Id` int(10) NOT NULL,
  `CorrelativoEstado_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_CorrelativoEstado`
--

INSERT INTO `TBL_CorrelativoEstado` (`CorrelativoEstado_Id`, `CorrelativoEstado_Nombre`) VALUES
(1, 'Disponible'),
(2, 'Nulo'),
(3, 'En Uso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Cotizacion`
--

CREATE TABLE `TBL_Cotizacion` (
  `id_cotizacion` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_tipo_descuento` int(2) NOT NULL,
  `id_origen` int(2) NOT NULL,
  `id_estado_cotizacion` int(2) NOT NULL,
  `numero_cotizacion` varchar(20) NOT NULL,
  `version_cotizacion` int(2) NOT NULL,
  `nombre_proyecto` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_estado_envio` int(2) NOT NULL,
  `nombre_contacto` varchar(50) NOT NULL,
  `email_contacto` varchar(50) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_lab_asignado` int(11) DEFAULT NULL,
  `id_correlativo_cotizacion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_Cotizacion`
--

INSERT INTO `TBL_Cotizacion` (`id_cotizacion`, `id_cliente`, `id_tipo_descuento`, `id_origen`, `id_estado_cotizacion`, `numero_cotizacion`, `version_cotizacion`, `nombre_proyecto`, `fecha_creacion`, `id_estado_envio`, `nombre_contacto`, `email_contacto`, `id_usuario`, `id_lab_asignado`, `id_correlativo_cotizacion`) VALUES
(1, 1, 3, 2, 2, 'SCL-1-2019', 1, 'TECNOTRACK SPA', '2019-04-30 18:07:19', 1, 'RODRIGO SAAVEDRA', 'CONTACTO@TECNOTRACK.CL', 1, 15, 1),
(2, 2, 3, 1, 4, 'SCL-2-2019', 1, 'PALOALTO AG', '2019-04-30 18:30:11', 1, 'ALFREDO LEAL', 'CONTACTO@EBOX.CL', 1, 15, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CotizacionCorr`
--

CREATE TABLE `TBL_CotizacionCorr` (
  `id_correlativo_cotizacion` int(10) NOT NULL,
  `codigo_sucursal` varchar(10) NOT NULL,
  `ano` year(4) NOT NULL,
  `id_estado_correlativo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='correlativo de cotizaciones';

--
-- Volcado de datos para la tabla `TBL_CotizacionCorr`
--

INSERT INTO `TBL_CotizacionCorr` (`id_correlativo_cotizacion`, `codigo_sucursal`, `ano`, `id_estado_correlativo`) VALUES
(1, 'SCL', 2019, 1),
(2, 'SCL', 2019, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CotizacionDetalleDestino`
--

CREATE TABLE `TBL_CotizacionDetalleDestino` (
  `id_detalle_destino_cotizacion` int(10) NOT NULL,
  `id_correlativo_cotizacion` int(10) NOT NULL,
  `numero_cotizacion` varchar(20) NOT NULL,
  `version_cotizacion` int(2) NOT NULL,
  `id_destino` int(2) NOT NULL,
  `precio_destino` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_CotizacionDetalleDestino`
--

INSERT INTO `TBL_CotizacionDetalleDestino` (`id_detalle_destino_cotizacion`, `id_correlativo_cotizacion`, `numero_cotizacion`, `version_cotizacion`, `id_destino`, `precio_destino`) VALUES
(1, 1, 'SCL-1-2019', 1, 75, 2.00),
(2, 2, 'SCL-2-2019', 1, 52, 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CotizacionDetalleEnsayos`
--

CREATE TABLE `TBL_CotizacionDetalleEnsayos` (
  `id_detalle_ensayo_cotizacion` int(10) NOT NULL,
  `id_correlativo_cotizacion` int(10) NOT NULL,
  `numero_cotizacion` varchar(20) NOT NULL,
  `version_cotizacion` int(2) NOT NULL,
  `id_ensayo` int(10) NOT NULL,
  `valor_ensayo` double(10,2) NOT NULL,
  `id_estado_ensayo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='detalle de ensayos cotizados';

--
-- Volcado de datos para la tabla `TBL_CotizacionDetalleEnsayos`
--

INSERT INTO `TBL_CotizacionDetalleEnsayos` (`id_detalle_ensayo_cotizacion`, `id_correlativo_cotizacion`, `numero_cotizacion`, `version_cotizacion`, `id_ensayo`, `valor_ensayo`, `id_estado_ensayo`) VALUES
(1, 1, 'SCL-1-2019', 1, 8, 0.63, 1),
(2, 2, 'SCL-2-2019', 1, 51, 0.53, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CotizacionEstado`
--

CREATE TABLE `TBL_CotizacionEstado` (
  `id_estado_cotizacion` int(2) NOT NULL,
  `nombre_estado_cotizacion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='estado de cotizaciones';

--
-- Volcado de datos para la tabla `TBL_CotizacionEstado`
--

INSERT INTO `TBL_CotizacionEstado` (`id_estado_cotizacion`, `nombre_estado_cotizacion`) VALUES
(1, 'Creada'),
(2, 'Enviada'),
(3, 'Aceptada'),
(4, 'Agendada'),
(5, 'Rechazada'),
(6, 'Nula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CotizacionGestion`
--

CREATE TABLE `TBL_CotizacionGestion` (
  `id_historial_cotizacion` int(10) NOT NULL,
  `id_cotizacion` int(10) NOT NULL,
  `detalle_historial_cotizacion` longtext NOT NULL,
  `fecha_historial_cotizacion` datetime NOT NULL,
  `id_usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Historial de gestion por cotizacion';

--
-- Volcado de datos para la tabla `TBL_CotizacionGestion`
--

INSERT INTO `TBL_CotizacionGestion` (`id_historial_cotizacion`, `id_cotizacion`, `detalle_historial_cotizacion`, `fecha_historial_cotizacion`, `id_usuario`) VALUES
(1, 1, 'Cotizacion enviada a cliente', '2019-04-30 18:07:31', 1),
(2, 2, 'Cotizacion aceptada por el cliente', '2019-04-30 18:43:06', 1),
(3, 2, 'Se agenda visita para el 2019-04-30 de 12:30 a 15:30 horas.', '2019-04-30 18:49:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_CotizacionLaboratorista`
--

CREATE TABLE `TBL_CotizacionLaboratorista` (
  `id_lab_asignado` int(11) NOT NULL,
  `id_laboratorista` int(3) NOT NULL,
  `id_cotizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='laboratorista asignado a cotizacion';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Destino`
--

CREATE TABLE `TBL_Destino` (
  `id_destino` int(2) NOT NULL,
  `nombre_destino` varchar(25) NOT NULL,
  `precio` double(10,2) NOT NULL,
  `id_origen` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='destino de servicios';

--
-- Volcado de datos para la tabla `TBL_Destino`
--

INSERT INTO `TBL_Destino` (`id_destino`, `nombre_destino`, `precio`, `id_origen`) VALUES
(1, 'Los Andes', 1.00, 3),
(2, 'san felipe', 1.00, 3),
(3, 'rinconada', 1.10, 3),
(4, 'curimon', 1.10, 3),
(5, 'panquehue', 1.10, 3),
(6, 'putaendo', 1.30, 3),
(7, 'llay llay', 1.50, 3),
(8, 'catemu', 1.50, 3),
(9, 'hijuelas', 1.50, 3),
(10, 'coronel', 34.00, 5),
(11, 'mejillones', 15.03, 5),
(12, 'valparaiso', 1.10, 2),
(13, 'viña del mar', 1.00, 2),
(14, 'quilpue', 1.30, 2),
(15, 'el belloto', 1.30, 2),
(16, 'villa alemana', 1.30, 2),
(17, 'limache', 1.60, 2),
(18, 'quillota', 1.90, 2),
(19, 'la cruz', 1.90, 2),
(20, 'quintero', 1.90, 2),
(21, 'ventanas', 1.90, 2),
(22, 'puchuncavi', 1.90, 2),
(23, 'maitencillo', 2.50, 2),
(24, 'zapallar', 2.50, 2),
(25, 'papudo', 2.50, 2),
(26, 'catapilco', 2.60, 2),
(27, 'cachagua', 2.50, 2),
(28, 'la ligua', 4.00, 2),
(29, 'cabildo', 4.00, 2),
(30, 'con con', 1.40, 2),
(31, 'laguna verde', 1.40, 2),
(32, 'casa blanca', 1.40, 2),
(33, 'olmue', 2.00, 2),
(34, 'la calera', 2.00, 2),
(35, 'placilla', 1.00, 2),
(36, 'peña blanca', 1.40, 2),
(37, 'san antonio', 1.00, 4),
(38, 'llo lleo', 1.00, 4),
(39, 'san enrique', 2.00, 4),
(40, 'cartagena', 1.00, 4),
(41, 'santo domingo', 1.00, 4),
(42, 'el tabo', 1.40, 4),
(43, 'el quisco', 1.40, 4),
(44, 'algarrobo', 1.50, 4),
(45, 'melipilla', 2.00, 4),
(46, 'alhue', 2.50, 4),
(47, 'rio rapel', 2.00, 4),
(48, 'navidad', 2.00, 4),
(49, 'san pedro', 2.00, 4),
(50, 'quilicura', 2.00, 1),
(51, 'isla de maipo', 2.00, 1),
(52, 'santiago centro', 1.00, 1),
(53, 'la florida', 1.00, 1),
(54, 'pirque', 1.40, 1),
(55, 'paine', 1.40, 1),
(56, 'las condes', 1.40, 1),
(57, 'padre hurtado', 1.40, 1),
(58, 'la dehesa', 1.40, 1),
(59, 'lo barnechea', 1.40, 1),
(60, 'puente alto', 1.40, 1),
(61, 'maipu', 1.40, 1),
(62, 'providencia', 1.40, 1),
(63, 'curacavi', 2.00, 1),
(64, 'la cisterna', 1.00, 1),
(65, 'lampa', 2.00, 1),
(66, 'buin', 1.40, 1),
(67, 'peñaflor', 1.40, 1),
(68, 'el arrayan', 1.40, 1),
(69, 'la reina', 1.40, 1),
(70, 'huelquen', 2.00, 1),
(71, 'macul', 1.40, 1),
(72, 'talagante', 2.00, 1),
(73, 'chicureo', 2.00, 1),
(74, 'batuco', 2.00, 1),
(75, 'colina', 2.00, 1),
(76, 'san jose de maipo ', 2.00, 1),
(77, 'quilin', 1.00, 1),
(78, 'pudahuel', 1.40, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EmpresaArea`
--

CREATE TABLE `TBL_EmpresaArea` (
  `id_area_empresa` int(3) NOT NULL,
  `codigo_area_empresa` varchar(10) NOT NULL,
  `nombre_area_empresa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Area empresa';

--
-- Volcado de datos para la tabla `TBL_EmpresaArea`
--

INSERT INTO `TBL_EmpresaArea` (`id_area_empresa`, `codigo_area_empresa`, `nombre_area_empresa`) VALUES
(1, 'ADM', 'ADMINISTRACION Y FINANZAS'),
(2, 'COM', 'COMERCIAL'),
(3, 'TEC', 'OFICINA TECNICA'),
(4, 'SALA', 'SALA DE LABORATORIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EmpresaCargo`
--

CREATE TABLE `TBL_EmpresaCargo` (
  `id_cargo_empresa` int(2) NOT NULL,
  `nombre_cargo_empresa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cargo de funcionarios';

--
-- Volcado de datos para la tabla `TBL_EmpresaCargo`
--

INSERT INTO `TBL_EmpresaCargo` (`id_cargo_empresa`, `nombre_cargo_empresa`) VALUES
(1, 'ASISTENTE TECNICO'),
(2, 'AYUDANTE'),
(3, 'JEFE AREA'),
(4, 'LABORATORISTA'),
(5, 'MUESTREADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EmpresaCC`
--

CREATE TABLE `TBL_EmpresaCC` (
  `id_centro_costo` int(2) NOT NULL,
  `nombre_centro_costo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='centros de costo';

--
-- Volcado de datos para la tabla `TBL_EmpresaCC`
--

INSERT INTO `TBL_EmpresaCC` (`id_centro_costo`, `nombre_centro_costo`) VALUES
(1, 'ADMINISTRACION'),
(2, 'Ayudantes PLA'),
(3, 'COMERCIAL'),
(4, 'COMERCIAL SCL'),
(5, 'INGENIERIA'),
(6, 'JEFE SALA'),
(7, 'LA'),
(8, 'Laboratorista PLA'),
(9, 'OF. TECNICA'),
(10, 'PREVENCION'),
(11, 'QUI'),
(12, 'SAI'),
(13, 'SCL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Ensayo`
--

CREATE TABLE `TBL_Ensayo` (
  `id_ensayo` int(10) NOT NULL,
  `id_tipo_ensayo` int(2) NOT NULL,
  `nombre_ensayo` text NOT NULL,
  `id_norma_ensayo` int(2) NOT NULL,
  `id_estado_acreditado` int(2) NOT NULL,
  `precio` double(10,2) NOT NULL,
  `id_estado_ensayo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de ensayos';

--
-- Volcado de datos para la tabla `TBL_Ensayo`
--

INSERT INTO `TBL_Ensayo` (`id_ensayo`, `id_tipo_ensayo`, `nombre_ensayo`, `id_norma_ensayo`, `id_estado_acreditado`, `precio`, `id_estado_ensayo`) VALUES
(1, 1, 'Dosificación de Suelo Cemento', 1, 2, 13.00, 1),
(2, 1, 'Ruptura probeta Suelo Cemento', 30, 2, 0.51, 1),
(3, 1, 'Densidad Aparente del Hormigón Fresco', 48, 1, 0.48, 1),
(4, 1, 'Extracción y Espesor de Testigos', 28, 1, 2.72, 1),
(5, 1, 'Compresión de Testigos', 29, 1, 0.54, 1),
(6, 1, 'Control de Docilidad', 1, 4, 0.20, 1),
(7, 1, 'Indice Esclerométrico', 49, 4, 0.60, 1),
(8, 1, 'Tracción por Hendimiento', 27, 1, 0.63, 1),
(9, 1, 'Lisura Hi - Lo', 16, 2, 0.02, 1),
(10, 1, 'Ruptura Probeta Mortero (RILEM)', 53, 1, 0.33, 0),
(11, 1, 'Compresión Cilindro Hormigón', 30, 1, 0.51, 0),
(12, 1, 'Compresión Cubo Hormigón ', 23, 1, 0.48, 0),
(13, 1, 'Flexo tracción Hormigón', 24, 1, 0.53, 0),
(14, 2, 'Análisis Granulométrico', 8, 1, 0.98, 1),
(15, 2, 'Límites de Atterberg', 44, 1, 0.91, 1),
(16, 2, 'Clasificación USCS y AASHTO', 3, 4, 0.00, 1),
(17, 2, 'Proctor Modificado', 46, 1, 1.21, 1),
(18, 2, 'Capacidad de Soporte CBR', 52, 1, 1.52, 1),
(19, 2, 'Desgaste de Los Ángeles', 37, 1, 2.28, 1),
(20, 2, 'Cubicidad de Partículas', 6, 1, 0.81, 1),
(21, 2, 'Densidad de Partículas Sólidas', 45, 1, 1.28, 1),
(22, 2, 'Equivalente de Arena', 33, 1, 1.52, 1),
(23, 2, 'Densidad Relativa ', 5, 1, 1.96, 1),
(24, 1, 'Dosificación de Hormigón', 1, 2, 9.00, 1),
(25, 1, 'Dosificación de Mortero', 1, 2, 5.00, 1),
(26, 3, 'Determinación de pH', 54, 1, 2.30, 1),
(27, 3, 'Sales Solubles', 39, 1, 3.60, 1),
(28, 3, 'Contenido de Cloruros', 40, 1, 3.60, 1),
(29, 3, 'Contenido de Sulfatos', 38, 1, 3.60, 1),
(30, 3, 'Sólidos Disueltos y Suspendidos', 55, 1, 2.44, 1),
(31, 3, 'Materia Orgánica', 40, 1, 3.02, 1),
(32, 4, 'Granulometría de Arena', 50, 1, 1.07, 1),
(33, 4, 'Granulometría de Grava / Gravilla', 50, 1, 1.07, 1),
(34, 4, 'Módulo de finura', 1, 3, 0.00, 0),
(35, 4, 'Determinación de las sales solubles totales', 9, 1, 0.00, 0),
(36, 4, 'Determinacion del equivalente de arena', 33, 1, 0.00, 0),
(37, 5, 'Densidad en terreno (Densímetro nuclear)', 17, 1, 0.53, 1),
(38, 5, 'Muestreo de mezclas bituminosas', 10, 1, 0.36, 1),
(39, 5, 'Granulometría y contenido de asfalto', 11, 1, 2.62, 1),
(40, 5, 'Control de temperatura (por punto)', 1, 4, 0.30, 1),
(41, 5, 'Extracción y Espesor de Testigos', 28, 1, 2.72, 1),
(42, 5, 'Densidad Real de mezcla asfaltica (testigo)', 13, 1, 0.72, 1),
(43, 5, 'Determinación contenido de asfalto (testigo)', 12, 1, 2.82, 1),
(44, 5, 'Control de Riego Asfáltico', 4, 2, 0.79, 1),
(45, 5, 'Control Marshall', 14, 3, 3.44, 1),
(46, 5, 'Lisura Hi - Lo', 16, 2, 0.02, 1),
(47, 6, 'Solera Flexión / Impacto', 20, 1, 0.90, 1),
(48, 6, 'Solera Compresión (2 testigos)', 18, 1, 4.00, 1),
(49, 6, 'Solerilla Flexión', 21, 1, 0.90, 1),
(50, 6, 'Adocreto', 19, 2, 0.51, 1),
(51, 7, 'Densidad en terreno (Densímetro nuclear)', 15, 1, 0.53, 1),
(52, 7, 'Densidad en terreno (Cono de Arena)', 43, 1, 1.06, 1),
(53, 8, 'Visita Laboratorista', 1, 4, 0.00, 1),
(54, 8, 'Extracción de Testigos', 28, 1, 2.22, 1),
(55, 8, 'Confección Calicata hasta 1,5 m', 1, 4, 4.00, 0),
(56, 2, 'Porchet - Ensayo de Infiltración', 22, 2, 5.00, 1),
(57, 2, 'Estratigrafía', 7, 2, 1.26, 1),
(58, 2, 'Contenido de Humedad', 42, 2, 0.00, 1),
(59, 2, 'Densidad natural', 15, 1, 0.53, 1),
(60, 2, 'Sales Solubles', 9, 1, 3.60, 1),
(61, 2, 'Cloruros y Sulfatos', 39, 1, 3.60, 1),
(62, 2, 'Impurezas Orgánicas', 51, 1, 1.50, 1),
(63, 2, 'Desintegración', 36, 1, 4.56, 1),
(64, 2, 'Densidad Real, Neta y Absorción', 29, 1, 1.30, 1),
(65, 2, 'Densidad Aparente', 25, 1, 1.90, 1),
(66, 2, 'Proctor Estándar', 46, 2, 1.21, 1),
(67, 2, 'Dosificación estimada', 57, 2, 3.34, 1),
(68, 4, 'Material fino menor a 0,080 mm', 31, 1, 1.03, 1),
(69, 4, 'Densidad Aparente', 25, 1, 1.90, 1),
(70, 4, 'Densidad Real y Absorción de las arenas', 32, 1, 1.30, 1),
(71, 4, 'Densidad Real y Absorción de las gravas', 26, 1, 1.30, 1),
(72, 4, 'Cubicidad de Partículas', 6, 1, 0.81, 1),
(73, 4, 'Desgaste de Los Ángeles', 37, 1, 2.28, 1),
(74, 4, 'Coeficiente Volumétrico Medio', 41, 1, 1.39, 1),
(75, 4, 'Determinación de Porcentaje de Huecos', 34, 1, 0.68, 1),
(76, 4, 'Partículas Desmenuzables', 35, 1, 1.98, 1),
(77, 4, 'Equivalente de Arena', 33, 1, 1.52, 1),
(78, 4, 'Sales Solubles', 9, 1, 3.60, 1),
(79, 4, 'Cloruros y Sulfatos', 39, 1, 3.60, 1),
(80, 4, 'Impurezas Orgánicas', 51, 1, 1.50, 1),
(81, 4, 'Carbón y Lignito', 2, 1, 2.72, 1),
(82, 4, 'Desintegración', 36, 1, 4.56, 1),
(83, 4, 'Homogeneización y reducción de muestras', 1, 2, 2.20, 1),
(84, 4, 'Límites de Atterberg', 44, 1, 0.91, 1),
(85, 4, 'Contenido de Humedad', 42, 2, 0.00, 0),
(86, 4, 'Contenido de Humedad', 25, 1, 1.90, 1),
(87, 3, 'Determinación de Temperatura en terreno', 1, 2, 0.00, 0),
(88, 3, 'Cloruros y Sulfatos', 39, 1, 0.00, 0),
(89, 4, 'Densidad Real, Neta y Absorción de Agua', 32, 1, 0.00, 0),
(90, 4, 'Desintegración Mediante Sales de Sulfato Magnesio', 36, 1, 0.00, 0),
(91, 1, 'Resultados Testigos Hormigón', 1, 1, 0.00, 0),
(92, 6, 'VERIFICACIÓN DE REQUISITOS GEOMETRICOS Y DIMENSIONALES					 					', 1, 1, 0.00, 0),
(93, 6, 'Ensayo de Resistencia a Compresión en testigos de soleras con zarpa', 23, 1, 0.00, 0),
(94, 5, 'Resultado testigos Asfalto', 1, 4, 0.00, 0),
(95, 8, 'Densidad en terreno, método Cono de Arena', 1, 4, 0.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoAcreditacion`
--

CREATE TABLE `TBL_EnsayoAcreditacion` (
  `id_estado_acreditado` int(2) NOT NULL,
  `nombre_estado_acreditado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipo de acreditacion de ensayos';

--
-- Volcado de datos para la tabla `TBL_EnsayoAcreditacion`
--

INSERT INTO `TBL_EnsayoAcreditacion` (`id_estado_acreditado`, `nombre_estado_acreditado`) VALUES
(1, 'Acreditado'),
(2, 'No Acreditado'),
(3, 'Fuera de Alcance'),
(4, 'No Acreditable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoDetalleFecha`
--

CREATE TABLE `TBL_EnsayoDetalleFecha` (
  `EnsayoDetalleFecha_Id` int(10) NOT NULL,
  `EnsayoDetalleFecha_IdEnsayoItem` int(10) NOT NULL,
  `EnsayoDetalleFecha_IdSolicitud` int(10) NOT NULL,
  `EnsayoDetalleFecha_NMuestra` int(10) NOT NULL,
  `EnsayoDetalleFecha_FechaEnsayo` datetime NOT NULL,
  `EnsayoDetalleFecha_FechaOperacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoDetalleItem`
--

CREATE TABLE `TBL_EnsayoDetalleItem` (
  `EnsayoDetalleItem_IdDetalleEnsayoItem` int(10) NOT NULL,
  `EnsayoDetalleItem_IdEnsayoItem` int(10) NOT NULL,
  `EnsayoDetalleItem_ValorEnsayoItem` varchar(300) NOT NULL,
  `EnsayoDetalleItem_IdSolicitudHM` int(10) NOT NULL,
  `EnsayoDetalleItem_IdSolicitudSS` int(10) NOT NULL,
  `EnsayoDetalleItem_NMuestra` int(11) NOT NULL,
  `EnsayoDetalleItem_FechaOperacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoDetalleObs`
--

CREATE TABLE `TBL_EnsayoDetalleObs` (
  `EnsayoDetalleObs_Id` int(10) NOT NULL,
  `EnsayoDetalleObs_IdSolicitudHM` int(10) NOT NULL,
  `EnsayoDetalleObs_IdSolicitudSS` int(10) NOT NULL,
  `EnsayoDetalleObs_Obs` longtext NOT NULL,
  `EnsayoDetalleObs_FechaOperacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoEstado`
--

CREATE TABLE `TBL_EnsayoEstado` (
  `id_estado_ensayo` int(2) NOT NULL,
  `nombre_estado_ensayo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Estado de ensayos ';

--
-- Volcado de datos para la tabla `TBL_EnsayoEstado`
--

INSERT INTO `TBL_EnsayoEstado` (`id_estado_ensayo`, `nombre_estado_ensayo`) VALUES
(1, 'Creada'),
(2, 'Enviada'),
(3, 'Aceptada'),
(4, 'Agendada'),
(5, 'Rechazada'),
(6, 'Nula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoItem`
--

CREATE TABLE `TBL_EnsayoItem` (
  `id_ensayo_item` int(10) NOT NULL,
  `id_ensayo` int(10) NOT NULL,
  `nombre_ensayo_item` varchar(100) NOT NULL,
  `unidad_medida_item` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de tipos de muestra por ensayo';

--
-- Volcado de datos para la tabla `TBL_EnsayoItem`
--

INSERT INTO `TBL_EnsayoItem` (`id_ensayo_item`, `id_ensayo`, `nombre_ensayo_item`, `unidad_medida_item`) VALUES
(1, 12, 'AREA', 'mm2'),
(2, 12, 'DENSIDAD APARENTE', 'kg/m3'),
(3, 12, 'CARGA MAXIMA', 'kN'),
(4, 12, 'RESISTENCIA A COMPRESIÓN', 'MPa'),
(5, 12, 'TIPO DE ROTURA', ''),
(6, 12, 'CONDICIÓN APARENTE DE HUMEDAD DE PROBETAS', ''),
(7, 12, 'OBSERVACIONES RELATIVAS AL HORMIGON DESPUES DE LA ROTURA', ''),
(8, 12, 'EDAD', 'dias'),
(9, 14, 'SOBRETAMAÑO', ''),
(10, 14, '3 \"\r\n', ''),
(11, 14, '2 1/2 \"', ''),
(12, 14, '2 \"', ''),
(13, 14, '1 1/2 \"', ''),
(14, 14, '1 \"', ''),
(15, 14, '3/4 \"', ''),
(16, 14, '3/8 \"', ''),
(17, 14, 'N° 4', ''),
(18, 14, 'N° 10', ''),
(19, 14, 'N° 40', ''),
(20, 14, 'N° 200', ''),
(21, 30, 'LÍMITE LÍQUIDO', ''),
(22, 15, 'LÍMITE LÍQUIDO', ''),
(23, 15, 'TIPO DE ACANALADOR', ''),
(24, 15, 'MÉTODO DE ENSAYO', ''),
(25, 15, 'LÍMITE PLÁSTICO', ''),
(26, 15, 'ÍNDICE DE PLASTICIDAD', ''),
(27, 16, 'SISTEMA USCS', ''),
(28, 16, 'SISTEMA AASHTO', ''),
(29, 20, 'CHANCADO TOTAL', '%'),
(30, 20, 'RODADO TOTAL', '%'),
(31, 20, 'LAJA TOTAL', '%'),
(32, 17, 'MÉTODO EMPLEADO (MODIFICADO)', ''),
(33, 17, 'MATERIAL RETENIDO EN 20 mm (que pasa por 2\'\')', ''),
(34, 92, 'REEMPLAZO O DESCARTE DEL MAT. RETENIDO', ''),
(35, 17, 'REEMPLAZO O DESCARTE DEL MAT. RETENIDO', ''),
(36, 17, 'D.M.C.H', 'g/cm3'),
(37, 17, 'HUMEDAD OPTIMA', '%'),
(38, 17, 'D.M.C.S.', 'g/cm3'),
(39, 18, 'MÉTODO DE COMPACTACIÓN', ''),
(40, 18, 'DENSIDAD SECA ANTES DE LA INMERSIÓN', 'g/cm3'),
(41, 18, 'ACONDICIONAMIENTO DE LA MUESTRA', ''),
(42, 18, 'DENSIDAD SECA DESPUÉS DE LA INMERSIÓN', 'g/cm3'),
(43, 18, 'ANTES DE LA COMPACTACIÓN', '%'),
(44, 18, 'DESPUÉS DE LA COMPACTACIÓN', '%'),
(45, 18, 'CAPA SUP. DE 25 mm DESPUÉS DE INMERSIÓN', '%'),
(46, 18, 'PROMEDIO DESPUÉS DE LA INMERSIÓN', '%'),
(47, 18, 'C.B.R. a 0,1” de Penetración', '%'),
(48, 18, 'C.B.R. a 0,2” de Penetración', '%'),
(49, 18, 'C.B.R. a 0,3” de Penetración', '%'),
(50, 18, 'EXPANSIÓN (% DE LA ALTURA INICIAL)', '%'),
(51, 18, 'SOBRECARGA', 'Kg'),
(52, 18, 'C.B.R al 95% de la D.M.C.S a 0,2\" de penetración ', '%'),
(53, 22, 'AGITACIÓN MECÁNICA', ''),
(54, 22, 'EQUIVALENTE DE ARENA (E.A.)', ''),
(55, 22, 'TIEMPO SEDIMENTACIÓN', 'Minutos'),
(56, 19, 'PERDIDA DE MASA', '%'),
(57, 19, 'GRADO DE ENSAYO', ''),
(58, 21, 'D.P.S. TOTAL ', 'g/cm3'),
(59, 12, 'VOLUMEN', 'mm3'),
(60, 12, 'NCh170', ''),
(61, 11, 'Carga PN', ''),
(62, 11, 'Area', '(mm2)'),
(63, 11, 'Densidad', '(kg/m3)'),
(64, 11, 'Rc', '(MPa)'),
(65, 11, 'K2', ''),
(66, 11, 'Volumen', '(mm3)'),
(67, 5, 'ALTURA INICIAL', 'mm'),
(68, 5, 'ESBELTEZ', ''),
(69, 5, 'DIÁMETRO', 'mm'),
(70, 5, 'ALTURA DE CORTE', 'mm'),
(71, 5, 'ALTURA DE ENSAYO ', 'mm'),
(72, 5, 'DENSIDAD Método volumétrico', 'kg/m3'),
(73, 5, 'SECCIÓN DE ENSAYO', 'mm2'),
(74, 5, 'CARGA DE ROTURA ', 'kN'),
(75, 5, 'RESISTENCIA DEL TESTIGO', 'MPa'),
(76, 5, 'RESISTENCIA CILÍNDRICA ', 'MPa '),
(77, 5, 'RESISTENCIA CUBICA NCh 170 of 85\r\nFuera del alcance de la acreditación', 'MPa'),
(78, 5, 'INFORME DE EXTRACCIÓN', ''),
(79, 5, 'PROCEDIMIENTO DE ASERRADO Y REFRENTADO', ''),
(80, 5, 'CONDICIONES DE CONSERVACIÓN', ''),
(81, 5, 'IDENTIFICACIÓN DEL TESTIGO', ''),
(82, 13, 'Masa', 'Kg'),
(83, 13, 'Carga', 'PKN\r\n'),
(84, 13, 'b1', 'mm'),
(85, 13, 'b2', 'mm'),
(86, 13, 'b3', 'mm'),
(87, 13, 'h1', 'mm'),
(88, 13, 'h2', 'mm'),
(89, 13, 'h3', 'mm'),
(90, 13, 'l1', 'mm'),
(91, 13, 'l2', 'mm'),
(92, 13, 'Tipo Carga', ''),
(93, 13, 'Volumen', 'mm3'),
(94, 13, 'Densidad', 'Kg/M3'),
(95, 13, 'l', 'mm'),
(96, 13, 'h', 'mm'),
(97, 13, 'b', 'mm'),
(98, 13, 'Resistencia', 'Mpa'),
(99, 13, 'Ancho Medio Rotura', 'mm'),
(100, 13, 'Altura Medio Rotura', 'mm'),
(101, 13, 'a', 'mm'),
(102, 13, 'Luz', 'mm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoNorma`
--

CREATE TABLE `TBL_EnsayoNorma` (
  `id_norma_ensayo` int(2) NOT NULL,
  `nombre_norma_ensayo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Normas para ensayos';

--
-- Volcado de datos para la tabla `TBL_EnsayoNorma`
--

INSERT INTO `TBL_EnsayoNorma` (`id_norma_ensayo`, `nombre_norma_ensayo`) VALUES
(1, 'Sin Norma'),
(2, 'ASTM C 123 / C123M-12'),
(3, 'ASTM D 2487-11 y AASHTO M-145'),
(4, 'ASTM D 2995-79'),
(5, 'ASTM D 4253-00 y ASTM D 4254-00'),
(6, 'M.C Volumen 8; 8.202.6'),
(7, 'M.C. Volumen 2; 2.503.202 (2) y ASTM  D2488  - 09a'),
(8, 'M.C. Volumen 8: 8.102.1'),
(9, 'M.C. Volumen 8; 8.202.14 '),
(10, 'M.C. Volumen 8; 8.302.27'),
(11, 'M.C. Volumen 8; 8.302.28 y 8.302.36'),
(12, 'M.C. Volumen 8; 8.302.36'),
(13, 'M.C. Volumen 8; 8.302.38'),
(14, 'M.C. Volumen 8; 8.302.40 '),
(15, 'M.C. Volumen 8; 8.502.1 '),
(16, 'M.C. Volumen 8; 8.502.4 '),
(17, 'M.C. Volumen 8; 8.502.9'),
(18, 'MINVU 332-2008 Articulo 6.7.3.2 '),
(19, 'MINVU 332-2008 Articulos 6.2.5 y 6.2.6'),
(20, 'MINVU 332-2008 Articulos 6.5.5; 6.5.4.1; 6.5.4.2 y 6.5.3.1.'),
(21, 'MINVU 332-2008 Articulos 6.6.4; 6.6.5; 6.6.3.1 y 6.6.3.2.'),
(22, 'MINVU. Técnicas alternativas para soluciones de aguas lluvias en sectores urbanos.'),
(23, 'NCh 1037 Of 09 y NCh 1017 Of 75 '),
(24, 'NCh 1038 Of 09 y NCh 1017 Of 75'),
(25, 'NCh 1116 Of 77'),
(26, 'NCh 1117 Of 10'),
(27, 'NCh 1170 Of 77'),
(28, 'NCh 1171/1 Of 01'),
(29, 'NCh 1172 Of 10  y NCh 1037 Of 09'),
(30, 'NCh 1172 Of 10, NCh 1037 Of 77 y NCh 1017 Of 75'),
(31, 'NCh 1223 Of 77'),
(32, 'NCh 1239 Of 09'),
(33, 'NCh 1325 Of 10'),
(34, 'NCh 1326 Of 77'),
(35, 'NCh 1327 Of 77'),
(36, 'NCh 1328 Of 77 o  M.C. Volumen 8; 8.202.17'),
(37, 'NCh 1369 Of 10'),
(38, 'Nch 1444 Of 10'),
(39, 'NCh 1444/1 Of 10'),
(40, 'NCh 1498 Of 82'),
(41, 'NCh 1511 Of 80'),
(42, 'NCh 1515 Of 79 '),
(43, 'NCh 1516 Of 79'),
(44, 'NCh 1517/1 Of 79 y NCh1517/2 Of 79  '),
(45, 'NCh 1532 Of 80'),
(46, 'NCh 1534/1 Of 79'),
(47, 'NCh 1534/2 Of 79'),
(48, 'NCh 1564 Of 2009'),
(49, 'NCh 1565 Of 08'),
(50, 'NCh 165 Of 09'),
(51, 'NCh 166 Of 09'),
(52, 'NCh 1852 Of 81'),
(53, 'NCh 2261 Of 09 y NCh 158 Of 67'),
(54, 'NCh 413 Of 63'),
(55, 'NCh 416 Of 63'),
(56, 'NCh1117 Of 10 o NCh 1239 09'),
(57, 'Según ensayos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoTipo`
--

CREATE TABLE `TBL_EnsayoTipo` (
  `id_tipo_ensayo` int(2) NOT NULL,
  `nombre_tipo_ensayo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nombre_informe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipo de ensayos';

--
-- Volcado de datos para la tabla `TBL_EnsayoTipo`
--

INSERT INTO `TBL_EnsayoTipo` (`id_tipo_ensayo`, `nombre_tipo_ensayo`, `nombre_informe`) VALUES
(1, 'Hormigón', 'LH'),
(2, 'Mecanica de suelos', 'LS'),
(3, 'Aguas', 'LH'),
(4, 'Áridos', 'LH'),
(5, 'Asfalto', 'LA'),
(6, 'Elementos y Componentes', 'LP'),
(7, 'Densidad', 'LD'),
(8, 'Otros', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EntidadFiscal`
--

CREATE TABLE `TBL_EntidadFiscal` (
  `id_entidad_fiscal` int(2) NOT NULL,
  `nombre_entidad` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de entidades fiscalizadoras';

--
-- Volcado de datos para la tabla `TBL_EntidadFiscal`
--

INSERT INTO `TBL_EntidadFiscal` (`id_entidad_fiscal`, `nombre_entidad`) VALUES
(1, 'SERVIU'),
(2, 'OTRO'),
(3, 'ETC'),
(4, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Equipo`
--

CREATE TABLE `TBL_Equipo` (
  `id_equipo` int(2) NOT NULL,
  `nombre_equipo` varchar(100) NOT NULL,
  `id_tipo_equipo` int(2) NOT NULL,
  `id_estado_equipo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de equipos';

--
-- Volcado de datos para la tabla `TBL_Equipo`
--

INSERT INTO `TBL_Equipo` (`id_equipo`, `nombre_equipo`, `id_tipo_equipo`, `id_estado_equipo`) VALUES
(1, 'CPN9053', 1, 1),
(2, 'CPN8168', 1, 1),
(3, 'CPN46', 1, 1),
(4, 'T30871', 1, 1),
(5, 'T30872', 1, 1),
(6, 'T30873', 1, 1),
(7, 'T30209', 1, 1),
(8, 'XP1039', 1, 1),
(9, 'CPN48', 1, 1),
(10, 'CPN45', 1, 1),
(11, 'CPN35', 1, 1),
(12, 'T29521', 1, 1),
(13, 'CA6-H', 2, 1),
(14, 'CA8-H', 2, 1),
(15, 'CA1-H', 2, 1),
(16, 'CA3-H', 2, 1),
(17, 'CA7-H', 2, 1),
(18, 'CA9-H', 2, 1),
(19, 'RM-01', 2, 1),
(20, 'CA4-H', 2, 1),
(21, 'CA2-H', 2, 1),
(22, 'CA5-H', 2, 1),
(23, '6592351', 3, 1),
(24, '93291', 3, 1),
(25, '6580716', 3, 1),
(26, '6592260', 3, 1),
(27, '4252821', 3, 1),
(28, '6933061', 3, 1),
(29, '27774', 3, 1),
(30, '16218', 3, 1),
(31, '65122362', 3, 1),
(32, '6825216', 3, 1),
(33, 'SI-2351', 4, 1),
(34, 'SI-3291', 4, 1),
(35, 'SI-0716', 4, 1),
(36, 'SI-2260', 4, 1),
(37, 'SI-2821', 4, 1),
(38, 'SI-3061', 4, 1),
(39, 'SI-7774', 4, 1),
(40, 'SI-6218', 4, 1),
(41, 'SI-2362', 4, 1),
(42, 'SI-5216', 4, 1),
(43, 'TER-21', 5, 1),
(45, 'TER-15', 5, 1),
(46, 'TA-03', 5, 1),
(47, 'TA-02', 5, 1),
(48, 'TA-03', 5, 1),
(49, 'TA-04', 5, 1),
(50, 'TER-03', 5, 1),
(51, 'TER-04', 5, 1),
(52, 'TER-23', 5, 1),
(53, 'TER-28', 5, 1),
(54, 'TER-01', 5, 1),
(55, 'TER-06', 5, 1),
(56, 'RE-05', 6, 1),
(57, 'RE-08', 6, 1),
(58, 'RE-09', 6, 1),
(59, 'RE-02', 6, 1),
(60, 'RE-03', 6, 1),
(61, 'RE-04', 6, 1),
(62, 'RE-01', 6, 1),
(63, 'RE-10', 6, 1),
(64, 'RE-11', 6, 1),
(65, 'RE-07', 6, 1),
(66, 'RE-06', 6, 1),
(67, 'RE-04', 6, 1),
(68, '2351', 7, 1),
(69, '3291', 7, 1),
(70, '0716', 7, 1),
(71, '2260', 7, 1),
(72, '2821', 7, 1),
(73, '3061', 7, 1),
(74, '7774', 7, 1),
(75, '6218', 7, 1),
(76, '2362', 7, 1),
(77, '5216', 7, 1),
(78, 'HNDZ-25', 8, 1),
(79, 'JFTR-82', 8, 1),
(80, 'JZDY-48', 8, 1),
(81, 'CLBV-68', 8, 1),
(82, 'CLBV-69', 8, 1),
(83, 'CLBV-70', 8, 1),
(84, 'FCPF-19', 8, 1),
(85, 'CTWB-69', 8, 1),
(86, 'KGXS-59', 8, 1),
(87, 'HRCW-28', 8, 1),
(88, 'FDRG-28', 8, 1),
(89, 'JCHY-32', 8, 1),
(90, 'FDRG-52', 8, 1),
(91, 'FZDD-99', 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EquipoTipo`
--

CREATE TABLE `TBL_EquipoTipo` (
  `id_tipo_equipo` int(2) NOT NULL,
  `nombre_tipo_equipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tipos de equipos';

--
-- Volcado de datos para la tabla `TBL_EquipoTipo`
--

INSERT INTO `TBL_EquipoTipo` (`id_tipo_equipo`, `nombre_tipo_equipo`) VALUES
(1, 'Densimetro'),
(2, 'Cono'),
(3, 'Equipo Motriz'),
(4, 'Sonda'),
(5, 'Termómetro'),
(6, 'Regla'),
(7, 'Carretilla'),
(8, 'Camioneta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_correlativo`
--

CREATE TABLE `tbl_estado_correlativo` (
  `id_estado_correlativo` int(2) NOT NULL,
  `nombre_estado_correlativo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado_correlativo`
--

INSERT INTO `tbl_estado_correlativo` (`id_estado_correlativo`, `nombre_estado_correlativo`) VALUES
(1, 'Creada'),
(2, 'Enviada'),
(3, 'Aceptada'),
(4, 'Agendada'),
(5, 'Rechazada'),
(6, 'Nula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_envio`
--

CREATE TABLE `tbl_estado_envio` (
  `id_estado_envio` int(2) NOT NULL,
  `nombre_estado_envio` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado_envio`
--

INSERT INTO `tbl_estado_envio` (`id_estado_envio`, `nombre_estado_envio`) VALUES
(1, 'Creada'),
(2, 'Enviada'),
(3, 'Aceptada'),
(4, 'Agendada'),
(5, 'Rechazada'),
(6, 'Nula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Factura`
--

CREATE TABLE `TBL_Factura` (
  `Factura_Id` int(10) NOT NULL,
  `Factura_ClienteId` int(10) NOT NULL,
  `Factura_ClienteRut` varchar(10) NOT NULL,
  `Factura_ClienteRazonSocial` varchar(100) NOT NULL,
  `Factura_ObraId` int(10) NOT NULL,
  `Factura_ObraNombre` varchar(100) NOT NULL,
  `Factura_Numero` int(20) NOT NULL,
  `Factura_FechaEmision` datetime NOT NULL,
  `Factura_Estado` int(1) DEFAULT 0,
  `Factura_FormACId` int(10) NOT NULL,
  `Factura_Solicitante` varchar(100) NOT NULL,
  `Factura_Encargado` varchar(100) NOT NULL,
  `Factura_Email` varchar(100) NOT NULL,
  `Factura_FormaPago` varchar(100) NOT NULL,
  `Factura_ValorUF` double(10,2) NOT NULL,
  `Factura_Ciudad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FacturaDetalle`
--

CREATE TABLE `TBL_FacturaDetalle` (
  `FacturaDetalle_Id` int(10) NOT NULL,
  `FacturaDetalle_FacturaId` int(10) NOT NULL,
  `FacturaDetalle_SolicitudN` varchar(10) NOT NULL,
  `FacturaDetalle_EnsayoId` int(10) NOT NULL,
  `FacturaDetalle_EnsayoQ` int(10) NOT NULL,
  `FacturaDetalle_ValorUnit` varchar(10) NOT NULL,
  `FacturaDetalle_ValorUF` varchar(10) NOT NULL,
  `FacturaDetalle_FechaOp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Solicitudes de Servicio Prefacturadas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormAC`
--

CREATE TABLE `TBL_FormAC` (
  `id_form_aceptacion` int(11) NOT NULL,
  `empresa_solicitante` varchar(35) NOT NULL,
  `fecha_aceptacion` date NOT NULL,
  `nombre_solicitante` varchar(30) NOT NULL,
  `email_solicitante` varchar(30) NOT NULL,
  `empresa_constructora` varchar(30) NOT NULL,
  `nombre_obra` varchar(75) NOT NULL,
  `codigo_obra` varchar(30) NOT NULL,
  `direccion_obra` text NOT NULL,
  `comuna_obra` varchar(15) NOT NULL,
  `fono_obra` varchar(15) NOT NULL,
  `encargado_terreno` varchar(30) NOT NULL,
  `email_encargado` varchar(30) NOT NULL,
  `telefono_encargado` varchar(15) NOT NULL,
  `id_entidad_fiscal` int(2) NOT NULL,
  `empresa_encargada` varchar(30) NOT NULL,
  `profesional_acargo` varchar(30) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `rut_empresa_factura` varchar(15) NOT NULL,
  `giro_empresa` varchar(15) NOT NULL,
  `direccion_factura` text NOT NULL,
  `nombre_ciudad` varchar(25) NOT NULL,
  `id_periodo_facturacion` int(2) NOT NULL,
  `id_forma_pago` int(2) NOT NULL,
  `Referencia_Id` int(1) NOT NULL,
  `telefono_facturacion` varchar(15) NOT NULL,
  `email_facturacion` varchar(30) NOT NULL,
  `nombre_aceptante` varchar(30) NOT NULL,
  `id_cotizacion` int(10) NOT NULL,
  `estado_formulario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Aceptación de Cotización';

--
-- Volcado de datos para la tabla `TBL_FormAC`
--

INSERT INTO `TBL_FormAC` (`id_form_aceptacion`, `empresa_solicitante`, `fecha_aceptacion`, `nombre_solicitante`, `email_solicitante`, `empresa_constructora`, `nombre_obra`, `codigo_obra`, `direccion_obra`, `comuna_obra`, `fono_obra`, `encargado_terreno`, `email_encargado`, `telefono_encargado`, `id_entidad_fiscal`, `empresa_encargada`, `profesional_acargo`, `razon_social`, `rut_empresa_factura`, `giro_empresa`, `direccion_factura`, `nombre_ciudad`, `id_periodo_facturacion`, `id_forma_pago`, `Referencia_Id`, `telefono_facturacion`, `email_facturacion`, `nombre_aceptante`, `id_cotizacion`, `estado_formulario`) VALUES
(1, 'TECNOTRACK', '2019-04-30', 'TECNOTRACK', 'CONTACTO@TECNOTRACK.CL', 'N/A', 'TECNOTRACK SPA', 'N/A', 'AV APOQUINDO 5583 OF 31 LAS CONDES SANTIAGO', '0', '2121121212', 'RODRIGO SAAVEDRA', 'CONTACTO@TECNOTRACK.CL', '2121121212', 4, 'TECNOTRACK', 'RODRIGO SAAVEDRA', 'TECNOTRACK', '764183347', '50', 'AV APOQUINDO 5583 OF 31 LAS CONDES SANTIAGO', '50', 4, 7, 0, '2121121212', 'CONTACTO@TECNOTRACK.CL', 'TECNOTRACK', 1, 0),
(2, 'Paloalto AG', '2019-04-30', 'ALFREDO LEAL', 'CONTACTO@EBOX.CL', 'Constructora Palo Alto AG', 'Obra Palo Alto AG', 'AGPA-01', 'Circunvalación Sur S/N', '97', '2233444444', 'Encargado Terreno Paloalto', 'obra@paloalto.ag', '4444443322', 1, 'Receptora Informes PaloAlto AG', 'Responsable Obra PaloAlto', 'Facturación PaloAlto AG', '997673374', 'Empresas de Cob', 'Moneda 333', '127', 3, 2, 1, '997673374', 'facturacion@paloalto.ag', 'Aceptante PaloAlto', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormaPago`
--

CREATE TABLE `TBL_FormaPago` (
  `id_forma_pago` int(2) NOT NULL,
  `nombre_forma_pago` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_FormaPago`
--

INSERT INTO `TBL_FormaPago` (`id_forma_pago`, `nombre_forma_pago`) VALUES
(1, 'Cheque'),
(2, 'Transferencia Electrónica'),
(3, 'Contado'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHM`
--

CREATE TABLE `TBL_FormHM` (
  `id_form_c_h_m` int(10) NOT NULL,
  `id_agendamiento_visita` int(10) NOT NULL,
  `id_tipo_ensayo` int(10) NOT NULL,
  `numero_solicitud` varchar(10) NOT NULL,
  `correlativo_obra` varchar(10) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `hora_ini` time NOT NULL,
  `hora_fin` time NOT NULL,
  `kilometraje` int(11) NOT NULL,
  `realizado_por` int(10) NOT NULL COMMENT 'nombre de laboratorista',
  `cantidad_muestras` int(2) NOT NULL,
  `construye` varchar(100) NOT NULL,
  `cod_hormigon` varchar(100) NOT NULL,
  `fecha_muestra` date NOT NULL,
  `hora_control` time NOT NULL,
  `correlativo` int(10) NOT NULL,
  `prefactura_estado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Formulario Solicitud Hormigones';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMAs`
--

CREATE TABLE `TBL_FormHMAs` (
  `FormHMAs_Id` int(2) NOT NULL,
  `FormHMAs_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Aspecto de muestras';

--
-- Volcado de datos para la tabla `TBL_FormHMAs`
--

INSERT INTO `TBL_FormHMAs` (`FormHMAs_Id`, `FormHMAs_Nombre`) VALUES
(1, 'Plástico'),
(2, 'Seco'),
(3, 'Fluido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMComp`
--

CREATE TABLE `TBL_FormHMComp` (
  `FormHMComp_Id` int(2) NOT NULL,
  `FormHMComp_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipo de compresion para FormHM';

--
-- Volcado de datos para la tabla `TBL_FormHMComp`
--

INSERT INTO `TBL_FormHMComp` (`FormHMComp_Id`, `FormHMComp_Nombre`) VALUES
(1, 'Vibrado'),
(2, 'Apisonado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMDet`
--

CREATE TABLE `TBL_FormHMDet` (
  `FormHMDet_Id` int(10) NOT NULL,
  `FormHMProb_Id` int(10) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL,
  `FormHMComp_Id` int(2) NOT NULL COMMENT 'Tipo de compresion',
  `FormHMMov_Id` int(2) NOT NULL COMMENT 'Tipo de Movimiento',
  `FormHMTipoCurado_Id` int(2) NOT NULL COMMENT 'Tipo Curado',
  `FormHMDetRE_Id` int(2) NOT NULL COMMENT 'Resistencia Especificada',
  `FormHMPro_Id` int(2) NOT NULL COMMENT 'Procedencia de muestra',
  `FormHMMarca_Id` int(2) NOT NULL COMMENT 'Marca de empresas Hormigón',
  `FormHMAs_Id` int(2) NOT NULL COMMENT 'Aspecto de muestras',
  `FormHMTex_Id` int(2) NOT NULL COMMENT 'Textura de hormigón',
  `DesigMoldeUtil` varchar(10) NOT NULL COMMENT 'Designación de Moldes utilizadas',
  `hora_carga_planta` time NOT NULL,
  `hora_salida_planta` time NOT NULL,
  `hora_llegada_planta` time NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `curado_obra` varchar(20) NOT NULL,
  `responsable_muestreo` int(2) NOT NULL COMMENT 'nombre de laboratorista',
  `lugar_extraccion` varchar(20) NOT NULL,
  `dosificacion_declarada` varchar(20) NOT NULL,
  `camion` varchar(20) NOT NULL,
  `guia` varchar(20) NOT NULL,
  `m3` double(10,2) NOT NULL,
  `cono` int(2) NOT NULL,
  `elemento_hormigonado` varchar(20) NOT NULL,
  `aditivos` varchar(20) NOT NULL,
  `observaciones` longtext NOT NULL,
  `termometro` varchar(100) NOT NULL,
  `equipo_cono` varchar(100) NOT NULL,
  `vibrador_sonda` varchar(100) NOT NULL,
  `regla_metrica` varchar(100) NOT NULL,
  `otros` varchar(100) NOT NULL,
  `edad` int(10) NOT NULL,
  `Estado` int(1) NOT NULL COMMENT '1=Ensayado 0=Ensayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMDetRE`
--

CREATE TABLE `TBL_FormHMDetRE` (
  `FormHMDetRE_Id` int(10) NOT NULL,
  `FormHMRE_Id` int(10) NOT NULL,
  `FormHMDetRE_Valor` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Detalle de Resistencia Especificada de Formulario HM';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMMarca`
--

CREATE TABLE `TBL_FormHMMarca` (
  `FormHMMarca_Id` int(10) NOT NULL,
  `FormHMMarca_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_FormHMMarca`
--

INSERT INTO `TBL_FormHMMarca` (`FormHMMarca_Id`, `FormHMMarca_Nombre`) VALUES
(1, 'BSA'),
(2, 'Cemento Bufalo'),
(3, 'Eduardo Huerta Diaz'),
(4, 'Melon Hormigones'),
(5, 'ReadyMix'),
(6, 'Sociedad Petreos'),
(7, 'Tobalango'),
(8, 'TecnoMix SA'),
(9, 'Transex Ltda'),
(10, 'Otro'),
(11, 'Obra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMMov`
--

CREATE TABLE `TBL_FormHMMov` (
  `FormHMMov_Id` int(2) NOT NULL,
  `FormHMMov_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipo de movimiento para FormHM';

--
-- Volcado de datos para la tabla `TBL_FormHMMov`
--

INSERT INTO `TBL_FormHMMov` (`FormHMMov_Id`, `FormHMMov_Nombre`) VALUES
(1, 'Enviado'),
(2, 'Retirado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMProb`
--

CREATE TABLE `TBL_FormHMProb` (
  `FormHMProb_Id` int(2) NOT NULL,
  `FormHMProb_Nombre` varchar(100) NOT NULL,
  `FormHMProb_IdEnsayo` int(10) NOT NULL COMMENT 'Ensayo ',
  `FormHMProb_Tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipos de probeta para FormHM';

--
-- Volcado de datos para la tabla `TBL_FormHMProb`
--

INSERT INTO `TBL_FormHMProb` (`FormHMProb_Id`, `FormHMProb_Nombre`, `FormHMProb_IdEnsayo`, `FormHMProb_Tipo`) VALUES
(1, '20x20x20', 12, 'Cúbica'),
(2, '15x15x15', 12, 'Cúbica'),
(3, '15x15x30', 11, 'Cilíndrica'),
(4, '15x15x53', 13, 'Prismática'),
(5, '4x4x16', 10, 'Rilem');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMProc`
--

CREATE TABLE `TBL_FormHMProc` (
  `FormHMPro_Id` int(10) NOT NULL,
  `FormHMPro_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Procedencia de muestra Form HM';

--
-- Volcado de datos para la tabla `TBL_FormHMProc`
--

INSERT INTO `TBL_FormHMProc` (`FormHMPro_Id`, `FormHMPro_Nombre`) VALUES
(1, 'Maquina'),
(2, 'Pala');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMRE`
--

CREATE TABLE `TBL_FormHMRE` (
  `FormHMRE_Id` int(10) NOT NULL,
  `FormHMRE_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipos Resistencia Especificada';

--
-- Volcado de datos para la tabla `TBL_FormHMRE`
--

INSERT INTO `TBL_FormHMRE` (`FormHMRE_Id`, `FormHMRE_Nombre`) VALUES
(1, 'MPa'),
(2, 'Kgf/cm2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMTex`
--

CREATE TABLE `TBL_FormHMTex` (
  `FormHMTex_Id` int(2) NOT NULL,
  `FormHMTex_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Textura para FormHM';

--
-- Volcado de datos para la tabla `TBL_FormHMTex`
--

INSERT INTO `TBL_FormHMTex` (`FormHMTex_Id`, `FormHMTex_Nombre`) VALUES
(1, 'Normal'),
(2, 'Ripiosa'),
(3, 'Arenosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormHMTipoCurado`
--

CREATE TABLE `TBL_FormHMTipoCurado` (
  `FormHMTipoCurado_Id` int(2) NOT NULL,
  `FormHMTipoCurado_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipo de curado para FormHM';

--
-- Volcado de datos para la tabla `TBL_FormHMTipoCurado`
--

INSERT INTO `TBL_FormHMTipoCurado` (`FormHMTipoCurado_Id`, `FormHMTipoCurado_Nombre`) VALUES
(1, 'Camara Humeda'),
(2, 'Inmersion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormSS`
--

CREATE TABLE `TBL_FormSS` (
  `id_form_solicitud_servicio` int(10) NOT NULL,
  `id_agendamiento_visita` int(10) NOT NULL,
  `numero_solicitud` varchar(20) NOT NULL,
  `id_tipo_ensayo` int(10) NOT NULL,
  `correlativo_obra` varchar(20) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `inicio_servicio` time NOT NULL,
  `fin_servicio` time NOT NULL,
  `kilometraje` int(10) NOT NULL,
  `realizado_por` varchar(100) NOT NULL,
  `cantidad_muestras` int(3) NOT NULL,
  `observaciones` longtext NOT NULL,
  `cliente_nombre_firma` varchar(100) NOT NULL,
  `cliente_rut_firma` int(10) NOT NULL,
  `material` varchar(100) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `procedencia` varchar(100) NOT NULL,
  `fecha_operacion` datetime NOT NULL,
  `prefactura_estado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Formulario Solicitud Servicio';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormSSDetalle`
--

CREATE TABLE `TBL_FormSSDetalle` (
  `FormSSDetalle_Id` int(10) NOT NULL,
  `FormSS_Id` int(10) NOT NULL,
  `Muestra` int(1) NOT NULL,
  `Ensayo_IdEnsayo` int(10) NOT NULL,
  `FechaOperacion` datetime NOT NULL,
  `Estado` int(1) NOT NULL COMMENT '1=Ensayado 0=Ensayar	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Detalle de items seleccionados en Solicitud de Servicio';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormSSItem`
--

CREATE TABLE `TBL_FormSSItem` (
  `id_item_solicitud_servicio` int(2) NOT NULL,
  `nombre_item_solicitud_servicio` varchar(50) NOT NULL,
  `id_categoria_item_solicitud_servicio` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de items para solicitud de servicio';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_IndEconomicos`
--

CREATE TABLE `TBL_IndEconomicos` (
  `IndEconomicos_Id` int(10) NOT NULL,
  `IndEconomicos_Fecha` date NOT NULL,
  `IndEconomicos_Valor` varchar(10) NOT NULL,
  `IndEconomicos_FechaOp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_IndEconomicos`
--

INSERT INTO `TBL_IndEconomicos` (`IndEconomicos_Id`, `IndEconomicos_Fecha`, `IndEconomicos_Valor`, `IndEconomicos_FechaOp`) VALUES
(1, '2019-03-06', '27562.81', '2019-03-06 01:08:59'),
(2, '2019-03-12', '27565.76', '2019-03-12 11:48:47'),
(3, '2019-03-13', '27565.76', '2019-03-13 23:56:30'),
(4, '2019-03-14', '27565.76', '2019-03-14 20:23:51'),
(5, '2019-03-15', '27565.76', '2019-03-15 14:57:28'),
(6, '2019-03-19', '27565.76', '2019-03-19 10:23:28'),
(7, '2019-03-20', '27565.76', '2019-03-20 15:45:45'),
(8, '2019-03-21', '27565.00', '2019-03-21 08:38:35'),
(9, '2019-03-22', '27565.76', '2019-03-22 15:32:24'),
(10, '2019-03-26', '27565.76', '2019-03-26 17:24:41'),
(11, '2019-03-27', '27565.76', '2019-03-27 14:37:51'),
(12, '2019-03-28', '27565.76', '2019-03-28 17:07:43'),
(13, '2019-03-29', '27565.00', '2019-03-29 08:24:43'),
(14, '2019-04-01', '27565.00', '2019-04-01 08:15:10'),
(20, '2019-04-02', '27565.76 ', '2019-04-02 02:29:54'),
(21, '2019-04-03', '', '2019-04-03 09:32:31'),
(22, '2019-04-04', '', '2019-04-04 11:30:34'),
(23, '2019-04-05', '', '2019-04-05 07:42:52'),
(24, '2019-04-06', '', '2019-04-06 07:40:05'),
(25, '2019-04-08', '', '2019-04-08 09:50:24'),
(26, '2019-04-09', '', '2019-04-09 14:34:07'),
(27, '2019-04-11', '', '2019-04-11 09:40:19'),
(28, '2019-04-12', '', '2019-04-12 08:36:19'),
(29, '2019-04-15', '', '2019-04-15 02:08:21'),
(30, '2019-04-16', '', '2019-04-16 10:34:19'),
(31, '2019-04-17', '27602.45', '2019-04-17 10:07:46'),
(32, '2019-04-18', '27607.04', '2019-04-18 14:31:23'),
(33, '2019-04-25', '27639.18', '2019-04-25 12:08:28'),
(34, '2019-04-26', '27639.18', '2019-04-26 00:48:03'),
(35, '2019-04-30', '27662.17', '2019-04-30 11:34:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Informe`
--

CREATE TABLE `TBL_Informe` (
  `Informe_Id` int(10) NOT NULL,
  `Informe_IdFormSS` int(10) NOT NULL,
  `Informe_IdFormCH` int(10) NOT NULL,
  `Informe_Tipo` int(2) NOT NULL,
  `Informe_FechaCreacion` datetime NOT NULL,
  `Informe_FechaEdicion` datetime NOT NULL,
  `Informe_FechaFirma` datetime NOT NULL,
  `Informe_Estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_InformeEstado`
--

CREATE TABLE `TBL_InformeEstado` (
  `InformeEstado_Id` int(2) NOT NULL,
  `InformeEstado_Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_InformeEstado`
--

INSERT INTO `TBL_InformeEstado` (`InformeEstado_Id`, `InformeEstado_Descripcion`) VALUES
(1, 'creado'),
(2, 'ensayado'),
(3, 'aprobado'),
(4, 'rechazado'),
(5, 'firmado'),
(6, 'anulado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Laboratorista`
--

CREATE TABLE `TBL_Laboratorista` (
  `id_laboratorista` int(3) NOT NULL,
  `nombre_laboratorista` varchar(75) NOT NULL,
  `LaboratoristaEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='listado de laboratoristas';

--
-- Volcado de datos para la tabla `TBL_Laboratorista`
--

INSERT INTO `TBL_Laboratorista` (`id_laboratorista`, `nombre_laboratorista`, `LaboratoristaEstado`) VALUES
(1, 'Carlos Silva', 1),
(2, 'Juan Hernandez', 1),
(3, 'Andres Cortes', 1),
(4, 'Felipe Soto', 0),
(5, 'Danilo Leiva', 0),
(6, 'Raul Rodriguez', 0),
(7, 'Alvaro Soto', 1),
(8, 'Esteban Gomez', 1),
(9, 'Patricio Sepulveda', 1),
(10, 'Claudio Gonzalez', 0),
(11, 'Guillermo Fuentes', 0),
(12, 'Francisco Galdamez', 0),
(13, 'Victor Hidalgo', 1),
(14, 'Luis Castro', 1),
(15, 'Sin Asignacion', 1),
(16, 'Mandante', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Notificaciones`
--

CREATE TABLE `TBL_Notificaciones` (
  `Notificaciones_Id` int(11) NOT NULL,
  `Notificaciones_Tipo` int(11) NOT NULL,
  `Notificaciones_Email` varchar(100) NOT NULL,
  `Notificaciones_Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Email para notificaciones';

--
-- Volcado de datos para la tabla `TBL_Notificaciones`
--

INSERT INTO `TBL_Notificaciones` (`Notificaciones_Id`, `Notificaciones_Tipo`, `Notificaciones_Email`, `Notificaciones_Nombre`) VALUES
(1, 1, 'edmundo.sarria@tecnotrack.cl', 'Edmundo Sarria Inzulza'),
(2, 2, 'contacto@rfix.cl', 'Contacto RFIX'),
(3, 3, 'contacto@ebox.cl', 'Marss Lab');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Obra`
--

CREATE TABLE `TBL_Obra` (
  `Obra_Id` int(10) NOT NULL,
  `Obra_Codigo` varchar(100) NOT NULL,
  `Obra_Nombre` varchar(100) NOT NULL,
  `Obra_Direccion` varchar(100) NOT NULL,
  `Obra_ComunaId` int(10) NOT NULL,
  `Obra_EncargadoNombre` varchar(100) NOT NULL,
  `Obra_EncargadoEmail` varchar(50) NOT NULL,
  `Obra_EncargadoTel` varchar(50) NOT NULL,
  `Obra_Telefono` varchar(50) NOT NULL,
  `Obra_ClienteId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_Obra`
--

INSERT INTO `TBL_Obra` (`Obra_Id`, `Obra_Codigo`, `Obra_Nombre`, `Obra_Direccion`, `Obra_ComunaId`, `Obra_EncargadoNombre`, `Obra_EncargadoEmail`, `Obra_EncargadoTel`, `Obra_Telefono`, `Obra_ClienteId`) VALUES
(1, 'AGPA-01', 'Obra Palo Alto AG', 'Circunvalación Sur S/N', 97, 'Encargado Terreno Paloalto', 'obra@paloalto.ag', '4444443322', '2233444444', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Origen`
--

CREATE TABLE `TBL_Origen` (
  `id_origen` int(2) NOT NULL,
  `nombre_origen` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='origen de servicios';

--
-- Volcado de datos para la tabla `TBL_Origen`
--

INSERT INTO `TBL_Origen` (`id_origen`, `nombre_origen`) VALUES
(1, 'Santiago'),
(2, 'Placilla'),
(3, 'Los Andes'),
(4, 'San Antonio'),
(5, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_PeriodoFacturacion`
--

CREATE TABLE `TBL_PeriodoFacturacion` (
  `id_periodo_facturacion` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_PeriodoFacturacion`
--

INSERT INTO `TBL_PeriodoFacturacion` (`id_periodo_facturacion`, `nombre`) VALUES
(1, 'Semanal'),
(2, 'Quincenal'),
(3, 'Mensual'),
(4, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_PeriodoPago`
--

CREATE TABLE `TBL_PeriodoPago` (
  `id_periodo_pago_cli` int(2) NOT NULL,
  `nombre_periodo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Periodos de pago para clientes';

--
-- Volcado de datos para la tabla `TBL_PeriodoPago`
--

INSERT INTO `TBL_PeriodoPago` (`id_periodo_pago_cli`, `nombre_periodo`) VALUES
(1, 'Semanal'),
(2, 'Quincenal'),
(3, 'Mensual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Provincia`
--

CREATE TABLE `TBL_Provincia` (
  `provincia_id` int(11) NOT NULL,
  `provincia_nombre` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_Provincia`
--

INSERT INTO `TBL_Provincia` (`provincia_id`, `provincia_nombre`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Parinacota', 1),
(3, 'Iquique', 2),
(4, 'El Tamarugal', 2),
(5, 'Antofagasta', 3),
(6, 'El Loa', 3),
(7, 'Tocopilla', 3),
(8, 'Chañaral', 4),
(9, 'Copiapó', 4),
(10, 'Huasco', 4),
(11, 'Choapa', 5),
(12, 'Elqui', 5),
(13, 'Limarí', 5),
(14, 'Isla de Pascua', 6),
(15, 'Los Andes', 6),
(16, 'Petorca', 6),
(17, 'Quillota', 6),
(18, 'San Antonio', 6),
(19, 'San Felipe de Aconcagua', 6),
(20, 'Valparaiso', 6),
(21, 'Chacabuco', 7),
(22, 'Cordillera', 7),
(23, 'Maipo', 7),
(24, 'Melipilla', 7),
(25, 'Santiago', 7),
(26, 'Talagante', 7),
(27, 'Cachapoal', 8),
(28, 'Cardenal Caro', 8),
(29, 'Colchagua', 8),
(30, 'Cauquenes', 9),
(31, 'Curicó', 9),
(32, 'Linares', 9),
(33, 'Talca', 9),
(34, 'Arauco', 10),
(35, 'Bio Bío', 10),
(36, 'Concepción', 10),
(37, 'Ñuble', 10),
(38, 'Cautín', 11),
(39, 'Malleco', 11),
(40, 'Valdivia', 12),
(41, 'Ranco', 12),
(42, 'Chiloé', 13),
(43, 'Llanquihue', 13),
(44, 'Osorno', 13),
(45, 'Palena', 13),
(46, 'Aisén', 14),
(47, 'Capitán Prat', 14),
(48, 'Coihaique', 14),
(49, 'General Carrera', 14),
(50, 'Antártica Chilena', 15),
(51, 'Magallanes', 15),
(52, 'Tierra del Fuego', 15),
(53, 'Última Esperanza', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Region`
--

CREATE TABLE `TBL_Region` (
  `region_id` int(11) NOT NULL,
  `region_nombre` varchar(64) NOT NULL,
  `region_ordinal` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_Region`
--

INSERT INTO `TBL_Region` (`region_id`, `region_nombre`, `region_ordinal`) VALUES
(1, 'Arica y Parinacota', 'XV'),
(2, 'Tarapacá', 'I'),
(3, 'Antofagasta', 'II'),
(4, 'Atacama', 'III'),
(5, 'Coquimbo', 'IV'),
(6, 'Valparaiso', 'V'),
(7, 'Metropolitana de Santiago', 'RM'),
(8, 'Libertador General Bernardo O\'Higgins', 'VI'),
(9, 'Maule', 'VII'),
(10, 'Biobío', 'VIII'),
(11, 'La Araucanía', 'IX'),
(12, 'Los Ríos', 'XIV'),
(13, 'Los Lagos', 'X'),
(14, 'Aisén del General Carlos Ibáñez del Campo', 'XI'),
(15, 'Magallanes y de la Antártica Chilena', 'XII');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Sucursal`
--

CREATE TABLE `TBL_Sucursal` (
  `id_sucursal` int(2) NOT NULL,
  `codigo_sucursal` varchar(10) NOT NULL,
  `nombre_sucursal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='listado de sucursales';

--
-- Volcado de datos para la tabla `TBL_Sucursal`
--

INSERT INTO `TBL_Sucursal` (`id_sucursal`, `codigo_sucursal`, `nombre_sucursal`) VALUES
(1, 'LA', 'Los Andes'),
(2, 'SCL', 'Santiago'),
(3, 'VAP', 'Valparaiso'),
(4, 'SAI', 'San Antonio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_descuento`
--

CREATE TABLE `tbl_tipo_descuento` (
  `id_tipo_descuento` int(2) NOT NULL,
  `nombre_tipo_descuento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_descuento`
--

INSERT INTO `tbl_tipo_descuento` (`id_tipo_descuento`, `nombre_tipo_descuento`) VALUES
(1, 'General'),
(2, 'Ensayo'),
(3, 'Sin Descuento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Usuario`
--

CREATE TABLE `TBL_Usuario` (
  `id_usuario` int(10) NOT NULL,
  `rut_usuario` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nombre_usuario` varchar(25) NOT NULL,
  `apellido_paterno` varchar(25) NOT NULL,
  `apellido_materno` varchar(25) NOT NULL,
  `telefono_fijo_usuario` int(15) NOT NULL,
  `telefono_movil_usuario` int(15) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `id_tipo_usuario` int(2) NOT NULL,
  `id_sucursal` int(2) NOT NULL,
  `id_area_empresa` int(3) NOT NULL,
  `id_cargo_empresa` int(2) NOT NULL,
  `id_centro_costo` int(2) NOT NULL,
  `sigla_usuario` varchar(10) NOT NULL,
  `UsuarioEstado` int(1) NOT NULL,
  `UsuarioAvatar` varchar(30) NOT NULL,
  `UsuarioSignature` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='listado de usuarios del sistema';

--
-- Volcado de datos para la tabla `TBL_Usuario`
--

INSERT INTO `TBL_Usuario` (`id_usuario`, `rut_usuario`, `password`, `nombre_usuario`, `apellido_paterno`, `apellido_materno`, `telefono_fijo_usuario`, `telefono_movil_usuario`, `email_usuario`, `id_tipo_usuario`, `id_sucursal`, `id_area_empresa`, `id_cargo_empresa`, `id_centro_costo`, `sigla_usuario`, `UsuarioEstado`, `UsuarioAvatar`, `UsuarioSignature`) VALUES
(1, '164568571', '164568571', 'administrador', 'tecnotrack', 'tecnotrack', 2147483647, 2147483647, 'edmundo.sarria@tecnotrack.cl', 1, 2, 1, 3, 1, 'att', 1, '9538786f4f58835_1.png', 'a7420490c5ab33b_1.png'),
(2, '173551711', '173551711', 'Alejandro', 'Vargas', 'Vargas', 92939495, 92939495, 'jefe.laboratorio@marsslab.cl', 1, 1, 1, 1, 1, 'AV', 1, '', '147b6794c6d03eb_2.png'),
(3, '170315375', '170315375', ' javier ignacio', 'arancibia', 'gutierrez', 2147483647, 2147483647, 'jefehormigones@marsslab.cl', 3, 3, 4, 3, 1, ' ag', 1, '', ''),
(4, '165716639', '165716639', ' nicolle denisse', 'arenas', 'albornoz', 2147483647, 2147483647, 'facturacion@marsslab.cl', 3, 3, 1, 3, 1, ' aa', 1, '', ''),
(5, '178090119', '178090119', ' jonathan jaime', 'aristegui', 'molina', 2147483647, 2147483647, 'programacion@marsslab.cl', 3, 3, 4, 3, 1, ' am', 1, '', ''),
(6, '115211129', '115211129', ' nelson armando', 'cautivo', 'ponce', 2147483647, 2147483647, 'contabilidad@marsslab.cl', 3, 3, 1, 3, 1, ' cp', 1, '', ''),
(7, '189150253', '189150253', ' monica', 'crespo', 'olivares', 2147483647, 2147483647, 'oficinatecnica@marsslab.cl', 3, 1, 1, 1, 3, ' co', 1, '', ''),
(8, '108446633', '108446633', ' guillermo orlando', 'fuentes', 'perez', 2147483647, 2147483647, 'laboratorio.scl@marsslab.cl', 3, 2, 1, 3, 1, ' fp', 1, '', ''),
(9, '401832661', '401832661', ' catherine', 'giraldo', 'arias', 2147483647, 2147483647, 'asistente.comercial@marsslab.cl', 3, 3, 2, 2, 3, ' ga', 1, '', ''),
(10, '144343581', '144343581', ' claudio andres', 'gonzalez', 'pajarito', 2147483647, 2147483647, 'comercial@marsslab.cl', 3, 3, 2, 3, 1, ' gp', 1, '', ''),
(11, '15931474K', '15931474K', ' alvaro patricio', 'marambio', 'valdes', 2147483647, 2147483647, 'consultoria@marsslab.cl', 3, 3, 3, 3, 1, ' mv', 1, '', ''),
(12, '131912293', '131912293', ' catherine michele', 'maynou', 'rubio', 2147483647, 2147483647, 'jefesuelos@marsslab.cl', 3, 2, 1, 3, 1, ' mr', 1, '', ''),
(13, '173551711', '173551711', ' alejandro ignacio', 'vargas', 'carrasco', 2147483647, 2147483647, 'jefe.laboratorio@marsslab.cl', 3, 3, 1, 3, 1, ' vc', 1, '', ''),
(14, '144818695', '144818695', ' cristian francisco', 'zamorano', 'zamorano', 2147483647, 2147483647, 'sala.suelos@marsslab.cl', 3, 3, 1, 3, 1, ' zz', 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_UsuarioTipo`
--

CREATE TABLE `TBL_UsuarioTipo` (
  `id_tipo_usuario` int(2) NOT NULL,
  `nombre_tipo_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tipos de usuario del sistema';

--
-- Volcado de datos para la tabla `TBL_UsuarioTipo`
--

INSERT INTO `TBL_UsuarioTipo` (`id_tipo_usuario`, `nombre_tipo_usuario`) VALUES
(1, 'Super Usuario'),
(2, 'Administrador'),
(3, 'Usuario Comercial'),
(4, 'Usuario Operciones');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `TBL_AgendaVisita`
--
ALTER TABLE `TBL_AgendaVisita`
  ADD PRIMARY KEY (`id_agendamiento_visita`),
  ADD KEY `id_destino` (`id_destino`),
  ADD KEY `id_laboratorista` (`id_laboratorista`);

--
-- Indices de la tabla `TBL_AgendaVisitaDetalle`
--
ALTER TABLE `TBL_AgendaVisitaDetalle`
  ADD PRIMARY KEY (`id_detalle_servicio_agendado`),
  ADD KEY `id_agendamiento_visita` (`id_agendamiento_visita`);

--
-- Indices de la tabla `TBL_AgendaVisitaDetalleEquipo`
--
ALTER TABLE `TBL_AgendaVisitaDetalleEquipo`
  ADD PRIMARY KEY (`id_detalle_equipo_agendado`),
  ADD KEY `id_agendamiento_visita` (`id_agendamiento_visita`);

--
-- Indices de la tabla `TBL_CatSS`
--
ALTER TABLE `TBL_CatSS`
  ADD PRIMARY KEY (`id_categoria_item_solicitud_servicio`);

--
-- Indices de la tabla `TBL_Cliente`
--
ALTER TABLE `TBL_Cliente`
  ADD PRIMARY KEY (`id_cliente`) USING BTREE,
  ADD KEY `id_periodo_pago_cli` (`id_periodo_pago_cli`),
  ADD KEY `id_forma_pago_cli` (`id_forma_pago_cli`),
  ADD KEY `id_estado_cliente` (`id_estado_cliente`);

--
-- Indices de la tabla `TBL_ClienteEstado`
--
ALTER TABLE `TBL_ClienteEstado`
  ADD PRIMARY KEY (`id_estado_cliente`);

--
-- Indices de la tabla `TBL_ClienteUsuarios`
--
ALTER TABLE `TBL_ClienteUsuarios`
  ADD PRIMARY KEY (`ClienteUsuarios_Id`);

--
-- Indices de la tabla `TBL_Comuna`
--
ALTER TABLE `TBL_Comuna`
  ADD PRIMARY KEY (`comuna_id`),
  ADD KEY `provincia_id` (`provincia_id`);

--
-- Indices de la tabla `TBL_Correlativo`
--
ALTER TABLE `TBL_Correlativo`
  ADD PRIMARY KEY (`Correlativo_Id`);

--
-- Indices de la tabla `TBL_CorrelativoEstado`
--
ALTER TABLE `TBL_CorrelativoEstado`
  ADD PRIMARY KEY (`CorrelativoEstado_Id`);

--
-- Indices de la tabla `TBL_Cotizacion`
--
ALTER TABLE `TBL_Cotizacion`
  ADD PRIMARY KEY (`id_cotizacion`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_tipo_descuento` (`id_tipo_descuento`),
  ADD KEY `id_origen` (`id_origen`),
  ADD KEY `id_estado_cotizacion` (`id_estado_cotizacion`),
  ADD KEY `id_estado_envio` (`id_estado_envio`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_lab_asignado` (`id_lab_asignado`),
  ADD KEY `id_correlativo_cotizacion` (`id_correlativo_cotizacion`);

--
-- Indices de la tabla `TBL_CotizacionCorr`
--
ALTER TABLE `TBL_CotizacionCorr`
  ADD PRIMARY KEY (`id_correlativo_cotizacion`);

--
-- Indices de la tabla `TBL_CotizacionDetalleDestino`
--
ALTER TABLE `TBL_CotizacionDetalleDestino`
  ADD PRIMARY KEY (`id_detalle_destino_cotizacion`),
  ADD KEY `id_correlativo_cotizacion` (`id_correlativo_cotizacion`),
  ADD KEY `id_destino` (`id_destino`);

--
-- Indices de la tabla `TBL_CotizacionDetalleEnsayos`
--
ALTER TABLE `TBL_CotizacionDetalleEnsayos`
  ADD PRIMARY KEY (`id_detalle_ensayo_cotizacion`),
  ADD KEY `id_correlativo_cotizacion` (`id_correlativo_cotizacion`),
  ADD KEY `id_ensayo` (`id_ensayo`),
  ADD KEY `id_estado_ensayo` (`id_estado_ensayo`);

--
-- Indices de la tabla `TBL_CotizacionEstado`
--
ALTER TABLE `TBL_CotizacionEstado`
  ADD PRIMARY KEY (`id_estado_cotizacion`);

--
-- Indices de la tabla `TBL_CotizacionGestion`
--
ALTER TABLE `TBL_CotizacionGestion`
  ADD PRIMARY KEY (`id_historial_cotizacion`),
  ADD KEY `id_cotizacion` (`id_cotizacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `TBL_CotizacionLaboratorista`
--
ALTER TABLE `TBL_CotizacionLaboratorista`
  ADD PRIMARY KEY (`id_lab_asignado`);

--
-- Indices de la tabla `TBL_Destino`
--
ALTER TABLE `TBL_Destino`
  ADD PRIMARY KEY (`id_destino`),
  ADD KEY `id_origen` (`id_origen`);

--
-- Indices de la tabla `TBL_EmpresaArea`
--
ALTER TABLE `TBL_EmpresaArea`
  ADD PRIMARY KEY (`id_area_empresa`);

--
-- Indices de la tabla `TBL_EmpresaCargo`
--
ALTER TABLE `TBL_EmpresaCargo`
  ADD PRIMARY KEY (`id_cargo_empresa`);

--
-- Indices de la tabla `TBL_EmpresaCC`
--
ALTER TABLE `TBL_EmpresaCC`
  ADD PRIMARY KEY (`id_centro_costo`);

--
-- Indices de la tabla `TBL_Ensayo`
--
ALTER TABLE `TBL_Ensayo`
  ADD PRIMARY KEY (`id_ensayo`),
  ADD KEY `id_tipo_ensayo` (`id_tipo_ensayo`),
  ADD KEY `id_norma_ensayo` (`id_norma_ensayo`),
  ADD KEY `id_estado_acreditado` (`id_estado_acreditado`);

--
-- Indices de la tabla `TBL_EnsayoAcreditacion`
--
ALTER TABLE `TBL_EnsayoAcreditacion`
  ADD PRIMARY KEY (`id_estado_acreditado`);

--
-- Indices de la tabla `TBL_EnsayoDetalleFecha`
--
ALTER TABLE `TBL_EnsayoDetalleFecha`
  ADD PRIMARY KEY (`EnsayoDetalleFecha_Id`);

--
-- Indices de la tabla `TBL_EnsayoDetalleItem`
--
ALTER TABLE `TBL_EnsayoDetalleItem`
  ADD PRIMARY KEY (`EnsayoDetalleItem_IdDetalleEnsayoItem`),
  ADD KEY `id_ensayo_item` (`EnsayoDetalleItem_IdEnsayoItem`);

--
-- Indices de la tabla `TBL_EnsayoDetalleObs`
--
ALTER TABLE `TBL_EnsayoDetalleObs`
  ADD PRIMARY KEY (`EnsayoDetalleObs_Id`);

--
-- Indices de la tabla `TBL_EnsayoEstado`
--
ALTER TABLE `TBL_EnsayoEstado`
  ADD PRIMARY KEY (`id_estado_ensayo`);

--
-- Indices de la tabla `TBL_EnsayoItem`
--
ALTER TABLE `TBL_EnsayoItem`
  ADD PRIMARY KEY (`id_ensayo_item`),
  ADD KEY `id_ensayo` (`id_ensayo`);

--
-- Indices de la tabla `TBL_EnsayoNorma`
--
ALTER TABLE `TBL_EnsayoNorma`
  ADD PRIMARY KEY (`id_norma_ensayo`);

--
-- Indices de la tabla `TBL_EnsayoTipo`
--
ALTER TABLE `TBL_EnsayoTipo`
  ADD PRIMARY KEY (`id_tipo_ensayo`);

--
-- Indices de la tabla `TBL_EntidadFiscal`
--
ALTER TABLE `TBL_EntidadFiscal`
  ADD PRIMARY KEY (`id_entidad_fiscal`);

--
-- Indices de la tabla `TBL_Equipo`
--
ALTER TABLE `TBL_Equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `id_tipo_equipo` (`id_tipo_equipo`);

--
-- Indices de la tabla `TBL_EquipoTipo`
--
ALTER TABLE `TBL_EquipoTipo`
  ADD PRIMARY KEY (`id_tipo_equipo`);

--
-- Indices de la tabla `tbl_estado_correlativo`
--
ALTER TABLE `tbl_estado_correlativo`
  ADD PRIMARY KEY (`id_estado_correlativo`);

--
-- Indices de la tabla `tbl_estado_envio`
--
ALTER TABLE `tbl_estado_envio`
  ADD PRIMARY KEY (`id_estado_envio`);

--
-- Indices de la tabla `TBL_Factura`
--
ALTER TABLE `TBL_Factura`
  ADD PRIMARY KEY (`Factura_Id`);

--
-- Indices de la tabla `TBL_FacturaDetalle`
--
ALTER TABLE `TBL_FacturaDetalle`
  ADD PRIMARY KEY (`FacturaDetalle_Id`);

--
-- Indices de la tabla `TBL_FormAC`
--
ALTER TABLE `TBL_FormAC`
  ADD PRIMARY KEY (`id_form_aceptacion`),
  ADD KEY `id_entidad_fiscal` (`id_entidad_fiscal`),
  ADD KEY `id_periodo_facturacion` (`id_periodo_facturacion`),
  ADD KEY `id_forma_pago` (`id_forma_pago`),
  ADD KEY `id_cotizacion` (`id_cotizacion`);

--
-- Indices de la tabla `TBL_FormaPago`
--
ALTER TABLE `TBL_FormaPago`
  ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `TBL_FormHM`
--
ALTER TABLE `TBL_FormHM`
  ADD PRIMARY KEY (`id_form_c_h_m`),
  ADD KEY `id_agendamiento_visita` (`id_agendamiento_visita`),
  ADD KEY `id_tipo_ensayo` (`id_tipo_ensayo`),
  ADD KEY `realizado_por` (`realizado_por`);

--
-- Indices de la tabla `TBL_FormHMAs`
--
ALTER TABLE `TBL_FormHMAs`
  ADD PRIMARY KEY (`FormHMAs_Id`);

--
-- Indices de la tabla `TBL_FormHMComp`
--
ALTER TABLE `TBL_FormHMComp`
  ADD PRIMARY KEY (`FormHMComp_Id`);

--
-- Indices de la tabla `TBL_FormHMDet`
--
ALTER TABLE `TBL_FormHMDet`
  ADD PRIMARY KEY (`FormHMDet_Id`),
  ADD KEY `FormHMMarca_Id` (`FormHMMarca_Id`),
  ADD KEY `FormHMDetalle_FormHMId` (`id_form_c_h_m`),
  ADD KEY `FormHMDetalle_ProbetaId` (`FormHMProb_Id`),
  ADD KEY `FormHMAs_Id` (`FormHMAs_Id`),
  ADD KEY `FormHMComp_Id` (`FormHMComp_Id`),
  ADD KEY `FormHMMov_Id` (`FormHMMov_Id`),
  ADD KEY `FormHMTipoCurado_Id` (`FormHMTipoCurado_Id`),
  ADD KEY `FormHMDetRE_Id` (`FormHMDetRE_Id`),
  ADD KEY `FormHMPro_Id` (`FormHMPro_Id`),
  ADD KEY `FormHMTex_Id` (`FormHMTex_Id`),
  ADD KEY `responsable_muestreo` (`responsable_muestreo`);

--
-- Indices de la tabla `TBL_FormHMDetRE`
--
ALTER TABLE `TBL_FormHMDetRE`
  ADD PRIMARY KEY (`FormHMDetRE_Id`),
  ADD KEY `FormHMRE_Id` (`FormHMRE_Id`);

--
-- Indices de la tabla `TBL_FormHMMarca`
--
ALTER TABLE `TBL_FormHMMarca`
  ADD PRIMARY KEY (`FormHMMarca_Id`);

--
-- Indices de la tabla `TBL_FormHMMov`
--
ALTER TABLE `TBL_FormHMMov`
  ADD PRIMARY KEY (`FormHMMov_Id`);

--
-- Indices de la tabla `TBL_FormHMProb`
--
ALTER TABLE `TBL_FormHMProb`
  ADD PRIMARY KEY (`FormHMProb_Id`),
  ADD KEY `TBL_FormHMProb_IdEnsayo` (`FormHMProb_IdEnsayo`);

--
-- Indices de la tabla `TBL_FormHMProc`
--
ALTER TABLE `TBL_FormHMProc`
  ADD PRIMARY KEY (`FormHMPro_Id`);

--
-- Indices de la tabla `TBL_FormHMRE`
--
ALTER TABLE `TBL_FormHMRE`
  ADD PRIMARY KEY (`FormHMRE_Id`);

--
-- Indices de la tabla `TBL_FormHMTex`
--
ALTER TABLE `TBL_FormHMTex`
  ADD PRIMARY KEY (`FormHMTex_Id`);

--
-- Indices de la tabla `TBL_FormHMTipoCurado`
--
ALTER TABLE `TBL_FormHMTipoCurado`
  ADD PRIMARY KEY (`FormHMTipoCurado_Id`);

--
-- Indices de la tabla `TBL_FormSS`
--
ALTER TABLE `TBL_FormSS`
  ADD PRIMARY KEY (`id_form_solicitud_servicio`),
  ADD KEY `id_tipo_ensayo` (`id_tipo_ensayo`);

--
-- Indices de la tabla `TBL_FormSSDetalle`
--
ALTER TABLE `TBL_FormSSDetalle`
  ADD PRIMARY KEY (`FormSSDetalle_Id`),
  ADD KEY `FormSS_Id` (`FormSS_Id`),
  ADD KEY `Ensayo_IdEnsayo` (`Ensayo_IdEnsayo`);

--
-- Indices de la tabla `TBL_FormSSItem`
--
ALTER TABLE `TBL_FormSSItem`
  ADD PRIMARY KEY (`id_item_solicitud_servicio`),
  ADD KEY `id_categoria_item_solicitud_servicio` (`id_categoria_item_solicitud_servicio`);

--
-- Indices de la tabla `TBL_IndEconomicos`
--
ALTER TABLE `TBL_IndEconomicos`
  ADD PRIMARY KEY (`IndEconomicos_Id`);

--
-- Indices de la tabla `TBL_Informe`
--
ALTER TABLE `TBL_Informe`
  ADD PRIMARY KEY (`Informe_Id`),
  ADD KEY `informe_estado` (`Informe_Estado`),
  ADD KEY `Informe_Tipo` (`Informe_Tipo`);

--
-- Indices de la tabla `TBL_InformeEstado`
--
ALTER TABLE `TBL_InformeEstado`
  ADD PRIMARY KEY (`InformeEstado_Id`);

--
-- Indices de la tabla `TBL_Laboratorista`
--
ALTER TABLE `TBL_Laboratorista`
  ADD PRIMARY KEY (`id_laboratorista`);

--
-- Indices de la tabla `TBL_Notificaciones`
--
ALTER TABLE `TBL_Notificaciones`
  ADD PRIMARY KEY (`Notificaciones_Id`),
  ADD UNIQUE KEY `Notificaciones_Id` (`Notificaciones_Id`);

--
-- Indices de la tabla `TBL_Obra`
--
ALTER TABLE `TBL_Obra`
  ADD PRIMARY KEY (`Obra_Id`);

--
-- Indices de la tabla `TBL_Origen`
--
ALTER TABLE `TBL_Origen`
  ADD PRIMARY KEY (`id_origen`);

--
-- Indices de la tabla `TBL_PeriodoFacturacion`
--
ALTER TABLE `TBL_PeriodoFacturacion`
  ADD KEY `id_periodo_facturacion` (`id_periodo_facturacion`);

--
-- Indices de la tabla `TBL_PeriodoPago`
--
ALTER TABLE `TBL_PeriodoPago`
  ADD KEY `id_periodo_pago_cli` (`id_periodo_pago_cli`);

--
-- Indices de la tabla `TBL_Provincia`
--
ALTER TABLE `TBL_Provincia`
  ADD PRIMARY KEY (`provincia_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indices de la tabla `TBL_Region`
--
ALTER TABLE `TBL_Region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indices de la tabla `TBL_Sucursal`
--
ALTER TABLE `TBL_Sucursal`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- Indices de la tabla `tbl_tipo_descuento`
--
ALTER TABLE `tbl_tipo_descuento`
  ADD PRIMARY KEY (`id_tipo_descuento`);

--
-- Indices de la tabla `TBL_Usuario`
--
ALTER TABLE `TBL_Usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_centro_costo` (`id_centro_costo`),
  ADD KEY `id_cargo_empresa` (`id_cargo_empresa`),
  ADD KEY `id_area_empresa` (`id_area_empresa`);

--
-- Indices de la tabla `TBL_UsuarioTipo`
--
ALTER TABLE `TBL_UsuarioTipo`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `TBL_AgendaVisita`
--
ALTER TABLE `TBL_AgendaVisita`
  MODIFY `id_agendamiento_visita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `TBL_AgendaVisitaDetalle`
--
ALTER TABLE `TBL_AgendaVisitaDetalle`
  MODIFY `id_detalle_servicio_agendado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `TBL_AgendaVisitaDetalleEquipo`
--
ALTER TABLE `TBL_AgendaVisitaDetalleEquipo`
  MODIFY `id_detalle_equipo_agendado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `TBL_Cliente`
--
ALTER TABLE `TBL_Cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_ClienteEstado`
--
ALTER TABLE `TBL_ClienteEstado`
  MODIFY `id_estado_cliente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_ClienteUsuarios`
--
ALTER TABLE `TBL_ClienteUsuarios`
  MODIFY `ClienteUsuarios_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `TBL_Comuna`
--
ALTER TABLE `TBL_Comuna`
  MODIFY `comuna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT de la tabla `TBL_Correlativo`
--
ALTER TABLE `TBL_Correlativo`
  MODIFY `Correlativo_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_CorrelativoEstado`
--
ALTER TABLE `TBL_CorrelativoEstado`
  MODIFY `CorrelativoEstado_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_Cotizacion`
--
ALTER TABLE `TBL_Cotizacion`
  MODIFY `id_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionCorr`
--
ALTER TABLE `TBL_CotizacionCorr`
  MODIFY `id_correlativo_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionDetalleDestino`
--
ALTER TABLE `TBL_CotizacionDetalleDestino`
  MODIFY `id_detalle_destino_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionDetalleEnsayos`
--
ALTER TABLE `TBL_CotizacionDetalleEnsayos`
  MODIFY `id_detalle_ensayo_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionEstado`
--
ALTER TABLE `TBL_CotizacionEstado`
  MODIFY `id_estado_cotizacion` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionGestion`
--
ALTER TABLE `TBL_CotizacionGestion`
  MODIFY `id_historial_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionLaboratorista`
--
ALTER TABLE `TBL_CotizacionLaboratorista`
  MODIFY `id_lab_asignado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_Destino`
--
ALTER TABLE `TBL_Destino`
  MODIFY `id_destino` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `TBL_EmpresaArea`
--
ALTER TABLE `TBL_EmpresaArea`
  MODIFY `id_area_empresa` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TBL_EmpresaCargo`
--
ALTER TABLE `TBL_EmpresaCargo`
  MODIFY `id_cargo_empresa` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `TBL_EmpresaCC`
--
ALTER TABLE `TBL_EmpresaCC`
  MODIFY `id_centro_costo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `TBL_Ensayo`
--
ALTER TABLE `TBL_Ensayo`
  MODIFY `id_ensayo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoAcreditacion`
--
ALTER TABLE `TBL_EnsayoAcreditacion`
  MODIFY `id_estado_acreditado` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoDetalleFecha`
--
ALTER TABLE `TBL_EnsayoDetalleFecha`
  MODIFY `EnsayoDetalleFecha_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoDetalleItem`
--
ALTER TABLE `TBL_EnsayoDetalleItem`
  MODIFY `EnsayoDetalleItem_IdDetalleEnsayoItem` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoDetalleObs`
--
ALTER TABLE `TBL_EnsayoDetalleObs`
  MODIFY `EnsayoDetalleObs_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoEstado`
--
ALTER TABLE `TBL_EnsayoEstado`
  MODIFY `id_estado_ensayo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoItem`
--
ALTER TABLE `TBL_EnsayoItem`
  MODIFY `id_ensayo_item` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoNorma`
--
ALTER TABLE `TBL_EnsayoNorma`
  MODIFY `id_norma_ensayo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoTipo`
--
ALTER TABLE `TBL_EnsayoTipo`
  MODIFY `id_tipo_ensayo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `TBL_EntidadFiscal`
--
ALTER TABLE `TBL_EntidadFiscal`
  MODIFY `id_entidad_fiscal` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TBL_Equipo`
--
ALTER TABLE `TBL_Equipo`
  MODIFY `id_equipo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `TBL_EquipoTipo`
--
ALTER TABLE `TBL_EquipoTipo`
  MODIFY `id_tipo_equipo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_correlativo`
--
ALTER TABLE `tbl_estado_correlativo`
  MODIFY `id_estado_correlativo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_envio`
--
ALTER TABLE `tbl_estado_envio`
  MODIFY `id_estado_envio` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `TBL_Factura`
--
ALTER TABLE `TBL_Factura`
  MODIFY `Factura_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_FacturaDetalle`
--
ALTER TABLE `TBL_FacturaDetalle`
  MODIFY `FacturaDetalle_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_FormAC`
--
ALTER TABLE `TBL_FormAC`
  MODIFY `id_form_aceptacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_FormaPago`
--
ALTER TABLE `TBL_FormaPago`
  MODIFY `id_forma_pago` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHM`
--
ALTER TABLE `TBL_FormHM`
  MODIFY `id_form_c_h_m` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMAs`
--
ALTER TABLE `TBL_FormHMAs`
  MODIFY `FormHMAs_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMComp`
--
ALTER TABLE `TBL_FormHMComp`
  MODIFY `FormHMComp_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMDet`
--
ALTER TABLE `TBL_FormHMDet`
  MODIFY `FormHMDet_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMDetRE`
--
ALTER TABLE `TBL_FormHMDetRE`
  MODIFY `FormHMDetRE_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMMarca`
--
ALTER TABLE `TBL_FormHMMarca`
  MODIFY `FormHMMarca_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMMov`
--
ALTER TABLE `TBL_FormHMMov`
  MODIFY `FormHMMov_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMProb`
--
ALTER TABLE `TBL_FormHMProb`
  MODIFY `FormHMProb_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMProc`
--
ALTER TABLE `TBL_FormHMProc`
  MODIFY `FormHMPro_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMRE`
--
ALTER TABLE `TBL_FormHMRE`
  MODIFY `FormHMRE_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMTex`
--
ALTER TABLE `TBL_FormHMTex`
  MODIFY `FormHMTex_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHMTipoCurado`
--
ALTER TABLE `TBL_FormHMTipoCurado`
  MODIFY `FormHMTipoCurado_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_FormSS`
--
ALTER TABLE `TBL_FormSS`
  MODIFY `id_form_solicitud_servicio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_FormSSDetalle`
--
ALTER TABLE `TBL_FormSSDetalle`
  MODIFY `FormSSDetalle_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_IndEconomicos`
--
ALTER TABLE `TBL_IndEconomicos`
  MODIFY `IndEconomicos_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `TBL_Informe`
--
ALTER TABLE `TBL_Informe`
  MODIFY `Informe_Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_InformeEstado`
--
ALTER TABLE `TBL_InformeEstado`
  MODIFY `InformeEstado_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `TBL_Laboratorista`
--
ALTER TABLE `TBL_Laboratorista`
  MODIFY `id_laboratorista` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `TBL_Notificaciones`
--
ALTER TABLE `TBL_Notificaciones`
  MODIFY `Notificaciones_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_Obra`
--
ALTER TABLE `TBL_Obra`
  MODIFY `Obra_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `TBL_Origen`
--
ALTER TABLE `TBL_Origen`
  MODIFY `id_origen` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `TBL_PeriodoFacturacion`
--
ALTER TABLE `TBL_PeriodoFacturacion`
  MODIFY `id_periodo_facturacion` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TBL_PeriodoPago`
--
ALTER TABLE `TBL_PeriodoPago`
  MODIFY `id_periodo_pago_cli` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_Provincia`
--
ALTER TABLE `TBL_Provincia`
  MODIFY `provincia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `TBL_Region`
--
ALTER TABLE `TBL_Region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `TBL_Sucursal`
--
ALTER TABLE `TBL_Sucursal`
  MODIFY `id_sucursal` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_descuento`
--
ALTER TABLE `tbl_tipo_descuento`
  MODIFY `id_tipo_descuento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_Usuario`
--
ALTER TABLE `TBL_Usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `TBL_UsuarioTipo`
--
ALTER TABLE `TBL_UsuarioTipo`
  MODIFY `id_tipo_usuario` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `TBL_AgendaVisitaDetalle`
--
ALTER TABLE `TBL_AgendaVisitaDetalle`
  ADD CONSTRAINT `TBL_AgendaVisitaDetalle_ibfk_1` FOREIGN KEY (`id_agendamiento_visita`) REFERENCES `TBL_AgendaVisita` (`id_agendamiento_visita`) ON DELETE CASCADE;

--
-- Filtros para la tabla `TBL_AgendaVisitaDetalleEquipo`
--
ALTER TABLE `TBL_AgendaVisitaDetalleEquipo`
  ADD CONSTRAINT `fk_tbl_detalle_equipo_agendado_1` FOREIGN KEY (`id_agendamiento_visita`) REFERENCES `TBL_AgendaVisita` (`id_agendamiento_visita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_Cliente`
--
ALTER TABLE `TBL_Cliente`
  ADD CONSTRAINT `TBL_Cliente_ibfk_1` FOREIGN KEY (`id_estado_cliente`) REFERENCES `TBL_ClienteEstado` (`id_estado_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cliente_ibfk_2` FOREIGN KEY (`id_periodo_pago_cli`) REFERENCES `TBL_PeriodoPago` (`id_periodo_pago_cli`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cliente_ibfk_3` FOREIGN KEY (`id_forma_pago_cli`) REFERENCES `TBL_FormaPago` (`id_forma_pago`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_Comuna`
--
ALTER TABLE `TBL_Comuna`
  ADD CONSTRAINT `TBL_Comuna_ibfk_1` FOREIGN KEY (`provincia_id`) REFERENCES `TBL_Provincia` (`provincia_id`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_Cotizacion`
--
ALTER TABLE `TBL_Cotizacion`
  ADD CONSTRAINT `TBL_Cotizacion_ibfk_1` FOREIGN KEY (`id_estado_cotizacion`) REFERENCES `TBL_CotizacionEstado` (`id_estado_cotizacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cotizacion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `TBL_Cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cotizacion_ibfk_3` FOREIGN KEY (`id_origen`) REFERENCES `TBL_Origen` (`id_origen`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cotizacion_ibfk_4` FOREIGN KEY (`id_tipo_descuento`) REFERENCES `tbl_tipo_descuento` (`id_tipo_descuento`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cotizacion_ibfk_5` FOREIGN KEY (`id_estado_envio`) REFERENCES `tbl_estado_envio` (`id_estado_envio`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cotizacion_ibfk_6` FOREIGN KEY (`id_usuario`) REFERENCES `TBL_Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cotizacion_ibfk_9` FOREIGN KEY (`id_correlativo_cotizacion`) REFERENCES `TBL_CotizacionCorr` (`id_correlativo_cotizacion`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_CotizacionDetalleDestino`
--
ALTER TABLE `TBL_CotizacionDetalleDestino`
  ADD CONSTRAINT `TBL_CotizacionDetalleDestino_ibfk_1` FOREIGN KEY (`id_correlativo_cotizacion`) REFERENCES `TBL_CotizacionCorr` (`id_correlativo_cotizacion`),
  ADD CONSTRAINT `TBL_CotizacionDetalleDestino_ibfk_2` FOREIGN KEY (`id_destino`) REFERENCES `TBL_Destino` (`id_destino`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_CotizacionDetalleEnsayos`
--
ALTER TABLE `TBL_CotizacionDetalleEnsayos`
  ADD CONSTRAINT `TBL_CotizacionDetalleEnsayos_ibfk_1` FOREIGN KEY (`id_correlativo_cotizacion`) REFERENCES `TBL_CotizacionCorr` (`id_correlativo_cotizacion`),
  ADD CONSTRAINT `TBL_CotizacionDetalleEnsayos_ibfk_2` FOREIGN KEY (`id_ensayo`) REFERENCES `TBL_Ensayo` (`id_ensayo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_CotizacionGestion`
--
ALTER TABLE `TBL_CotizacionGestion`
  ADD CONSTRAINT `TBL_CotizacionGestion_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `TBL_Cotizacion` (`id_cotizacion`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_Destino`
--
ALTER TABLE `TBL_Destino`
  ADD CONSTRAINT `TBL_Destino_ibfk_1` FOREIGN KEY (`id_origen`) REFERENCES `TBL_Origen` (`id_origen`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_Ensayo`
--
ALTER TABLE `TBL_Ensayo`
  ADD CONSTRAINT `TBL_Ensayo_ibfk_1` FOREIGN KEY (`id_tipo_ensayo`) REFERENCES `TBL_EnsayoTipo` (`id_tipo_ensayo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Ensayo_ibfk_2` FOREIGN KEY (`id_estado_acreditado`) REFERENCES `TBL_EnsayoAcreditacion` (`id_estado_acreditado`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Ensayo_ibfk_3` FOREIGN KEY (`id_norma_ensayo`) REFERENCES `TBL_EnsayoNorma` (`id_norma_ensayo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_EnsayoDetalleItem`
--
ALTER TABLE `TBL_EnsayoDetalleItem`
  ADD CONSTRAINT `TBL_EnsayoDetalleItem_ibfk_1` FOREIGN KEY (`EnsayoDetalleItem_IdEnsayoItem`) REFERENCES `TBL_EnsayoItem` (`id_ensayo_item`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_EnsayoItem`
--
ALTER TABLE `TBL_EnsayoItem`
  ADD CONSTRAINT `TBL_EnsayoItem_ibfk_1` FOREIGN KEY (`id_ensayo`) REFERENCES `TBL_Ensayo` (`id_ensayo`);

--
-- Filtros para la tabla `TBL_Equipo`
--
ALTER TABLE `TBL_Equipo`
  ADD CONSTRAINT `TBL_Equipo_ibfk_1` FOREIGN KEY (`id_tipo_equipo`) REFERENCES `TBL_EquipoTipo` (`id_tipo_equipo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_FormAC`
--
ALTER TABLE `TBL_FormAC`
  ADD CONSTRAINT `TBL_FormAC_ibfk_1` FOREIGN KEY (`id_entidad_fiscal`) REFERENCES `TBL_EntidadFiscal` (`id_entidad_fiscal`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_FormAC_ibfk_2` FOREIGN KEY (`id_periodo_facturacion`) REFERENCES `TBL_PeriodoFacturacion` (`id_periodo_facturacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_FormAC_ibfk_4` FOREIGN KEY (`id_cotizacion`) REFERENCES `TBL_Cotizacion` (`id_cotizacion`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_FormHM`
--
ALTER TABLE `TBL_FormHM`
  ADD CONSTRAINT `TBL_FormHM_ibfk_1` FOREIGN KEY (`id_tipo_ensayo`) REFERENCES `TBL_EnsayoTipo` (`id_tipo_ensayo`) ON DELETE NO ACTION,
  ADD CONSTRAINT `TBL_FormHM_ibfk_2` FOREIGN KEY (`id_agendamiento_visita`) REFERENCES `TBL_AgendaVisita` (`id_agendamiento_visita`),
  ADD CONSTRAINT `TBL_FormHM_ibfk_3` FOREIGN KEY (`realizado_por`) REFERENCES `TBL_Laboratorista` (`id_laboratorista`);

--
-- Filtros para la tabla `TBL_FormHMDet`
--
ALTER TABLE `TBL_FormHMDet`
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_1` FOREIGN KEY (`FormHMMov_Id`) REFERENCES `TBL_FormHMMov` (`FormHMMov_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_10` FOREIGN KEY (`FormHMProb_Id`) REFERENCES `TBL_FormHMProb` (`FormHMProb_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_11` FOREIGN KEY (`responsable_muestreo`) REFERENCES `TBL_Laboratorista` (`id_laboratorista`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_2` FOREIGN KEY (`id_form_c_h_m`) REFERENCES `TBL_FormHM` (`id_form_c_h_m`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_3` FOREIGN KEY (`FormHMComp_Id`) REFERENCES `TBL_FormHMComp` (`FormHMComp_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_4` FOREIGN KEY (`FormHMTipoCurado_Id`) REFERENCES `TBL_FormHMTipoCurado` (`FormHMTipoCurado_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_5` FOREIGN KEY (`FormHMDetRE_Id`) REFERENCES `TBL_FormHMDetRE` (`FormHMDetRE_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_6` FOREIGN KEY (`FormHMPro_Id`) REFERENCES `TBL_FormHMProc` (`FormHMPro_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_7` FOREIGN KEY (`FormHMMarca_Id`) REFERENCES `TBL_FormHMMarca` (`FormHMMarca_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_8` FOREIGN KEY (`FormHMAs_Id`) REFERENCES `TBL_FormHMAs` (`FormHMAs_Id`),
  ADD CONSTRAINT `TBL_FormHMDet_ibfk_9` FOREIGN KEY (`FormHMTex_Id`) REFERENCES `TBL_FormHMTex` (`FormHMTex_Id`);

--
-- Filtros para la tabla `TBL_FormHMDetRE`
--
ALTER TABLE `TBL_FormHMDetRE`
  ADD CONSTRAINT `TBL_FormHMDetRE_ibfk_1` FOREIGN KEY (`FormHMRE_Id`) REFERENCES `TBL_FormHMRE` (`FormHMRE_Id`);

--
-- Filtros para la tabla `TBL_FormHMProb`
--
ALTER TABLE `TBL_FormHMProb`
  ADD CONSTRAINT `TBL_FormHMProb_ibfk_1` FOREIGN KEY (`FormHMProb_IdEnsayo`) REFERENCES `TBL_Ensayo` (`id_ensayo`);

--
-- Filtros para la tabla `TBL_FormSS`
--
ALTER TABLE `TBL_FormSS`
  ADD CONSTRAINT `TBL_FormSS_ibfk_1` FOREIGN KEY (`id_tipo_ensayo`) REFERENCES `TBL_EnsayoTipo` (`id_tipo_ensayo`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_FormSSDetalle`
--
ALTER TABLE `TBL_FormSSDetalle`
  ADD CONSTRAINT `TBL_FormSSDetalle_ibfk_1` FOREIGN KEY (`FormSS_Id`) REFERENCES `TBL_FormSS` (`id_form_solicitud_servicio`) ON DELETE NO ACTION,
  ADD CONSTRAINT `TBL_FormSSDetalle_ibfk_2` FOREIGN KEY (`Ensayo_IdEnsayo`) REFERENCES `TBL_Ensayo` (`id_ensayo`);

--
-- Filtros para la tabla `TBL_Informe`
--
ALTER TABLE `TBL_Informe`
  ADD CONSTRAINT `TBL_Informe_ibfk_1` FOREIGN KEY (`Informe_Tipo`) REFERENCES `TBL_EnsayoTipo` (`id_tipo_ensayo`) ON DELETE NO ACTION,
  ADD CONSTRAINT `TBL_Informe_ibfk_2` FOREIGN KEY (`Informe_Estado`) REFERENCES `TBL_InformeEstado` (`InformeEstado_Id`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_Provincia`
--
ALTER TABLE `TBL_Provincia`
  ADD CONSTRAINT `TBL_Provincia_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `TBL_Region` (`region_id`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_Usuario`
--
ALTER TABLE `TBL_Usuario`
  ADD CONSTRAINT `TBL_Usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `TBL_UsuarioTipo` (`id_tipo_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Usuario_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `TBL_Sucursal` (`id_sucursal`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Usuario_ibfk_3` FOREIGN KEY (`id_area_empresa`) REFERENCES `TBL_EmpresaArea` (`id_area_empresa`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Usuario_ibfk_4` FOREIGN KEY (`id_cargo_empresa`) REFERENCES `TBL_EmpresaCargo` (`id_cargo_empresa`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Usuario_ibfk_5` FOREIGN KEY (`id_centro_costo`) REFERENCES `TBL_EmpresaCC` (`id_centro_costo`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
