-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-11-2018 a las 18:49:55
-- Versión del servidor: 5.6.41
-- Versión de PHP: 7.2.7

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
CREATE DATABASE IF NOT EXISTS `eboxcl_labmarss` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eboxcl_labmarss`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bak.tbl_formapago`
--

CREATE TABLE `bak.tbl_formapago` (
  `id_forma_pago_cli` int(2) NOT NULL,
  `nombre_forma_pago_cli` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='forma de pago de clientes';

--
-- Volcado de datos para la tabla `bak.tbl_formapago`
--

INSERT INTO `bak.tbl_formapago` (`id_forma_pago_cli`, `nombre_forma_pago_cli`) VALUES
(1, 'Cheque'),
(2, 'Tranferencia El'),
(3, 'OC'),
(4, 'HES'),
(5, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_AendaVisitaDetalle`
--

CREATE TABLE `TBL_AendaVisitaDetalle` (
  `id_detalle_servicio_agendado` int(10) NOT NULL,
  `id_agendamiento_visita` int(10) NOT NULL,
  `id_tipo_ensayo` int(10) NOT NULL,
  `cantidad` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Detalle de servicios agendados';

--
-- Volcado de datos para la tabla `TBL_AendaVisitaDetalle`
--

INSERT INTO `TBL_AendaVisitaDetalle` (`id_detalle_servicio_agendado`, `id_agendamiento_visita`, `id_tipo_ensayo`, `cantidad`) VALUES
(1, 1, 2, 1),
(2, 2, 6, 2),
(3, 3, 1, 1),
(4, 3, 2, 1),
(5, 3, 3, 1),
(6, 4, 2, 1),
(7, 5, 1, 1);

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
(1, '7676767672', 'Empresa Factura S.A.', 'Obra Sheraton', 'AUGUSTO LEGUIA SUR 160', 'Hernan Saavedra', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 2147483647, 56, 10, '2018-10-04', '12:00:00', '14:00:00', 'registro de agenda', '2018-10-04', 1, 1),
(2, '7676767672', 'Empresa Factura S.A.', 'Obra Sheraton', 'AUGUSTO LEGUIA SUR 160', 'Hernan Saavedra', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 2147483647, 56, 12, '2018-10-05', '09:30:00', '12:00:00', 'Registro nuevo', '2018-10-05', 1, 1),
(3, '7676767672', 'Empresa Factura S.A.', 'Obra Sheraton', 'AUGUSTO LEGUIA SUR 160', 'Hernan Saavedra', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 2147483647, 56, 11, '2018-10-05', '13:00:00', '16:30:00', 'Observaciones', '2018-10-05', 1, 1),
(4, '7676767672', 'Empresa Factura S.A.', 'Obra Sheraton', 'Calle décima S/N', 'Rodrigo Saavedra', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 2122232425, 71, 10, '2018-10-06', '11:00:00', '14:30:00', 'Registro de prueba', '2018-10-05', 2, 2),
(5, '76765622K', 'CLIENTE', 'PROYECTO', 'DIRECCION', 'CONTACTO', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 2122232425, 46, 8, '2018-10-05', '09:30:00', '10:00:00', 'Prueba sin aceptación', '2018-10-05', 3, 0);

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
(1, 1, 2),
(2, 1, 13),
(3, 1, 23),
(4, 1, 33),
(5, 1, 43),
(6, 1, 56),
(7, 1, 68),
(8, 1, 78),
(9, 2, 1),
(10, 2, 2),
(11, 2, 3),
(12, 2, 4),
(13, 2, 5),
(14, 2, 6),
(15, 2, 7),
(16, 2, 8),
(17, 2, 9),
(18, 2, 10),
(19, 2, 11),
(20, 2, 12),
(21, 2, 13),
(22, 2, 14),
(23, 2, 15),
(24, 2, 16),
(25, 2, 17),
(26, 2, 18),
(27, 2, 19),
(28, 2, 20),
(29, 2, 21),
(30, 2, 22),
(31, 2, 23),
(32, 2, 24),
(33, 2, 25),
(34, 2, 26),
(35, 2, 27),
(36, 2, 28),
(37, 2, 29),
(38, 2, 30),
(39, 2, 31),
(40, 2, 32),
(41, 2, 33),
(42, 2, 34),
(43, 2, 35),
(44, 2, 36),
(45, 2, 37),
(46, 2, 38),
(47, 2, 39),
(48, 2, 40),
(49, 2, 41),
(50, 2, 42),
(51, 2, 43),
(52, 2, 45),
(53, 2, 46),
(54, 2, 47),
(55, 2, 48),
(56, 2, 49),
(57, 2, 50),
(58, 2, 51),
(59, 2, 52),
(60, 2, 53),
(61, 2, 54),
(62, 2, 55),
(63, 2, 56),
(64, 2, 57),
(65, 2, 58),
(66, 2, 59),
(67, 2, 60),
(68, 2, 61),
(69, 2, 62),
(70, 2, 63),
(71, 2, 64),
(72, 2, 65),
(73, 2, 66),
(74, 2, 67),
(75, 2, 68),
(76, 2, 69),
(77, 2, 70),
(78, 2, 71),
(79, 2, 72),
(80, 2, 73),
(81, 2, 74),
(82, 2, 75),
(83, 2, 76),
(84, 2, 77),
(85, 2, 78),
(86, 2, 79),
(87, 2, 80),
(88, 2, 81),
(89, 2, 82),
(90, 2, 83),
(91, 2, 84),
(92, 2, 85),
(93, 2, 86),
(94, 2, 87),
(95, 2, 88),
(96, 2, 89),
(97, 2, 90),
(98, 2, 91),
(99, 3, 1),
(100, 3, 2),
(101, 3, 3),
(102, 3, 4),
(103, 3, 5),
(104, 3, 6),
(105, 3, 7),
(106, 3, 8),
(107, 3, 9),
(108, 3, 10),
(109, 3, 11),
(110, 3, 12),
(111, 3, 13),
(112, 3, 14),
(113, 3, 15),
(114, 3, 16),
(115, 3, 17),
(116, 3, 18),
(117, 3, 19),
(118, 3, 20),
(119, 3, 21),
(120, 3, 22),
(121, 3, 23),
(122, 3, 24),
(123, 3, 25),
(124, 3, 26),
(125, 3, 27),
(126, 3, 28),
(127, 3, 29),
(128, 3, 30),
(129, 3, 31),
(130, 3, 32),
(131, 3, 33),
(132, 3, 34),
(133, 3, 35),
(134, 3, 36),
(135, 3, 37),
(136, 3, 38),
(137, 3, 39),
(138, 3, 40),
(139, 3, 41),
(140, 3, 42),
(141, 3, 43),
(142, 3, 45),
(143, 3, 46),
(144, 3, 47),
(145, 3, 48),
(146, 3, 49),
(147, 3, 50),
(148, 3, 51),
(149, 3, 52),
(150, 3, 53),
(151, 3, 54),
(152, 3, 55),
(153, 3, 56),
(154, 3, 57),
(155, 3, 58),
(156, 3, 59),
(157, 3, 60),
(158, 3, 61),
(159, 3, 62),
(160, 3, 63),
(161, 3, 64),
(162, 3, 65),
(163, 3, 66),
(164, 3, 67),
(165, 3, 68),
(166, 3, 69),
(167, 3, 70),
(168, 3, 71),
(169, 3, 72),
(170, 3, 73),
(171, 3, 74),
(172, 3, 75),
(173, 3, 76),
(174, 3, 77),
(175, 3, 78),
(176, 3, 79),
(177, 3, 80),
(178, 3, 81),
(179, 3, 82),
(180, 3, 83),
(181, 3, 84),
(182, 3, 85),
(183, 3, 86),
(184, 3, 87),
(185, 3, 88),
(186, 3, 89),
(187, 3, 90),
(188, 3, 91),
(189, 4, 1),
(190, 4, 2),
(191, 4, 3),
(192, 4, 4),
(193, 4, 5),
(194, 4, 6),
(195, 4, 7),
(196, 4, 8),
(197, 4, 9),
(198, 4, 10),
(199, 4, 11),
(200, 4, 12),
(201, 4, 13),
(202, 4, 14),
(203, 4, 15),
(204, 4, 16),
(205, 4, 17),
(206, 4, 18),
(207, 4, 19),
(208, 4, 20),
(209, 4, 21),
(210, 4, 22),
(211, 4, 23),
(212, 4, 24),
(213, 4, 25),
(214, 4, 26),
(215, 4, 27),
(216, 4, 28),
(217, 4, 29),
(218, 4, 30),
(219, 4, 31),
(220, 4, 32),
(221, 4, 33),
(222, 4, 34),
(223, 4, 35),
(224, 4, 36),
(225, 4, 37),
(226, 4, 38),
(227, 4, 39),
(228, 4, 40),
(229, 4, 41),
(230, 4, 42),
(231, 4, 43),
(232, 4, 45),
(233, 4, 46),
(234, 4, 47),
(235, 4, 48),
(236, 4, 49),
(237, 4, 50),
(238, 4, 51),
(239, 4, 52),
(240, 4, 53),
(241, 4, 54),
(242, 4, 55),
(243, 4, 56),
(244, 4, 57),
(245, 4, 58),
(246, 4, 59),
(247, 4, 60),
(248, 4, 61),
(249, 4, 62),
(250, 4, 63),
(251, 4, 64),
(252, 4, 65),
(253, 4, 66),
(254, 4, 67),
(255, 4, 68),
(256, 4, 69),
(257, 4, 70),
(258, 4, 71),
(259, 4, 72),
(260, 4, 73),
(261, 4, 74),
(262, 4, 75),
(263, 4, 76),
(264, 4, 77),
(265, 4, 78),
(266, 4, 79),
(267, 4, 80),
(268, 4, 81),
(269, 4, 82),
(270, 4, 83),
(271, 4, 84),
(272, 4, 85),
(273, 4, 86),
(274, 4, 87),
(275, 4, 88),
(276, 4, 89),
(277, 4, 90),
(278, 4, 91),
(279, 5, 1),
(280, 5, 2),
(281, 5, 3),
(282, 5, 4),
(283, 5, 5),
(284, 5, 6),
(285, 5, 7),
(286, 5, 8),
(287, 5, 9),
(288, 5, 10),
(289, 5, 11),
(290, 5, 12),
(291, 5, 13),
(292, 5, 14),
(293, 5, 15),
(294, 5, 16),
(295, 5, 17),
(296, 5, 18),
(297, 5, 19),
(298, 5, 20),
(299, 5, 21),
(300, 5, 22),
(301, 5, 23),
(302, 5, 24),
(303, 5, 25),
(304, 5, 26),
(305, 5, 27),
(306, 5, 28),
(307, 5, 29),
(308, 5, 30),
(309, 5, 31),
(310, 5, 32),
(311, 5, 33),
(312, 5, 34),
(313, 5, 35),
(314, 5, 36),
(315, 5, 37),
(316, 5, 38),
(317, 5, 39),
(318, 5, 40),
(319, 5, 41),
(320, 5, 42),
(321, 5, 43),
(322, 5, 45),
(323, 5, 46),
(324, 5, 47),
(325, 5, 48),
(326, 5, 49),
(327, 5, 50),
(328, 5, 51),
(329, 5, 52),
(330, 5, 53),
(331, 5, 54),
(332, 5, 55),
(333, 5, 56),
(334, 5, 57),
(335, 5, 58),
(336, 5, 59),
(337, 5, 60),
(338, 5, 61),
(339, 5, 62),
(340, 5, 63),
(341, 5, 64),
(342, 5, 65),
(343, 5, 66),
(344, 5, 67),
(345, 5, 68),
(346, 5, 69),
(347, 5, 70),
(348, 5, 71),
(349, 5, 72),
(350, 5, 73),
(351, 5, 74),
(352, 5, 75),
(353, 5, 76),
(354, 5, 77),
(355, 5, 78),
(356, 5, 79),
(357, 5, 80),
(358, 5, 81),
(359, 5, 82),
(360, 5, 83),
(361, 5, 84),
(362, 5, 85),
(363, 5, 86),
(364, 5, 87),
(365, 5, 88),
(366, 5, 89),
(367, 5, 90),
(368, 5, 91);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_Aspecto`
--

CREATE TABLE `TBL_Aspecto` (
  `tbl_aspecto` int(2) NOT NULL,
  `descripcion_aspecto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Aspecto de muestras';

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
  `rut_cliente` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nombre_cliente` varchar(30) NOT NULL,
  `razon_social` varchar(75) CHARACTER SET latin1 DEFAULT NULL,
  `direccion_cliente` text CHARACTER SET latin1 NOT NULL,
  `contacto_cliente` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telefono_cliente` varchar(15) NOT NULL,
  `email_cliente` varchar(50) CHARACTER SET latin1 NOT NULL,
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
(1, '76765622K', '', 'CONSTRUCTORA  LARRAIN DOMINGUEZ LTDA', 'AUGUSTO LEGUIA SUR 160', 'FRANCISCO DOMINGUEZ', '569212223242', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 0, 1, 1, 0, 1),
(2, '76765622K', '', 'CONSTRUCTORA  LARRAIN DOMINGUEZ LTDA', 'AUGUSTO LEGUIA SUR 160', 'FRANCISCO DOMINGUEZ', '2122232425', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 0, 1, 1, 0, 1),
(3, '76765622K', '', 'CLIENTE', 'DIRECCION', 'CONTACTO', '2122232425', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 0, 1, 1, 0, 1);

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
(1, 1, 3, 1, 4, 'SCL-1-2018', 1, 'PROYECTO SHERATON', '2018-10-04 10:53:34', 1, 'FRANCISCO DOMINGUEZ', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 1, 15, 1),
(2, 2, 3, 1, 4, 'SCL-2-2018', 1, 'PROYECTO SHERATON', '2018-10-05 13:30:55', 1, 'FRANCISCO DOMINGUEZ', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 1, 15, 2),
(3, 3, 3, 2, 2, 'SCL-3-2018', 1, 'PROYECTO', '2018-10-05 13:56:25', 1, 'CONTACTO', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 1, 15, 3);

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
(1, 'SCL', 2018, 1),
(2, 'SCL', 2018, 1),
(3, 'SCL', 2018, 1);

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
(1, 1, 'SCL-1-2018', 1, 56, 1.40),
(2, 2, 'SCL-2-2018', 1, 56, 1.40),
(3, 3, 'SCL-3-2018', 1, 57, 1.40);

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
(1, 1, 'SCL-1-2018', 1, 14, 0.98, 1),
(2, 1, 'SCL-1-2018', 1, 15, 0.91, 1),
(3, 2, 'SCL-2-2018', 1, 1, 13.00, 1),
(4, 2, 'SCL-2-2018', 1, 2, 0.51, 1),
(5, 2, 'SCL-2-2018', 1, 3, 0.48, 1),
(6, 2, 'SCL-2-2018', 1, 26, 2.30, 1),
(7, 2, 'SCL-2-2018', 1, 27, 3.60, 1),
(8, 3, 'SCL-3-2018', 1, 1, 13.00, 1);

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
(1, 1, 'Cotizacion enviada a cliente', '2018-10-04 10:58:21', 1),
(2, 1, 'Cotizacion aceptada por el cliente', '2018-10-04 11:05:07', 1),
(3, 1, 'Se agenda visita para el 2018-10-04 de 12:00 a 14:00 horas.', '2018-10-04 11:46:31', 1),
(4, 1, 'Se agenda visita para el 2018-10-05 de 09:30 a 12:00 horas.', '2018-10-05 05:25:54', 1),
(5, 1, 'Cliente reclamó precio', '2018-10-05 11:55:00', 1),
(6, 1, 'Cliente reclamó precio', '2018-10-05 11:55:01', 1),
(7, 1, 'Se agenda visita para el 2018-10-05 de 13:00 a 16:30 horas.', '2018-10-05 11:58:41', 1),
(8, 2, 'Llamé a cliente y no contestó', '2018-10-05 13:34:03', 1),
(9, 2, 'Cotizacion enviada a cliente', '2018-10-05 13:34:42', 1),
(10, 2, 'Cotizacion aceptada por el cliente', '2018-10-05 13:40:24', 1),
(11, 2, 'Se agenda visita para el 2018-10-06 de 11:00 a 14:30 horas.', '2018-10-05 13:53:28', 1),
(12, 3, 'Cotizacion enviada a cliente', '2018-10-05 13:57:05', 1);

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
-- Estructura de tabla para la tabla `tbl_curado_obra`
--

CREATE TABLE `tbl_curado_obra` (
  `id_curado_obra` int(2) NOT NULL,
  `muestreo_efectuado_por` varchar(100) NOT NULL,
  `lugar_extraccion` varchar(100) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_designacion_moldes`
--

CREATE TABLE `tbl_designacion_moldes` (
  `id_designacion_molde` int(2) NOT NULL,
  `descripcion_designacion_moldes` varchar(100) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `tbl_detalle_equipo_f_c_h_m`
--

CREATE TABLE `tbl_detalle_equipo_f_c_h_m` (
  `id_detalle_equipo_f_c_h_m` int(10) NOT NULL,
  `id_equipo` int(2) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_fecha_ensayo`
--

CREATE TABLE `tbl_detalle_fecha_ensayo` (
  `id_detalle_fecha_ensayo` int(10) NOT NULL,
  `id_ensayo_item` int(10) NOT NULL,
  `fecha_ensayo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_form_solicitud_servicio`
--

CREATE TABLE `tbl_detalle_form_solicitud_servicio` (
  `id_detalle_form_solicitud_s` int(10) NOT NULL,
  `id_form_solicitud_servicio` int(10) NOT NULL,
  `id_ensayo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_muestra`
--

CREATE TABLE `tbl_detalle_muestra` (
  `id_detalle_muestra` int(10) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL,
  `cantidad_muestra` int(10) NOT NULL,
  `codigo_hormigon` varchar(100) NOT NULL,
  `fecha_muestra` datetime NOT NULL,
  `numero_muestra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_probeta`
--

CREATE TABLE `tbl_detalle_probeta` (
  `id_detalle_probeta` int(10) NOT NULL,
  `id_tipo_probeta` int(2) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL,
  `id_estado_probeta` int(2) NOT NULL,
  `id_ubicacion_probeta` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_tipo_curado`
--

CREATE TABLE `tbl_detalle_tipo_curado` (
  `id_detalle_tipo_curado` int(10) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL,
  `fecha_salida_planta` datetime NOT NULL,
  `fecha_llegada_planta` datetime NOT NULL,
  `fecha_inicio_descarga` datetime NOT NULL,
  `fecha_fin_descarga` datetime NOT NULL,
  `id_tipo_curado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 1, 'Tracción por Hendimiento', 27, 1, 0.63, 0),
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
(34, 4, 'Módulo de finura', 1, 3, 0.00, 1),
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
(61, 2, 'Cloruros y Sulfatos', 39, 1, 3.60, 0),
(62, 2, 'Impurezas Orgánicas', 51, 1, 1.50, 0),
(63, 2, 'Desintegración', 36, 1, 4.56, 0),
(64, 2, 'Densidad Real y Absorción', 29, 1, 1.30, 1),
(65, 2, 'Densidad Aparente Suelta', 25, 1, 1.90, 1),
(66, 2, 'Proctor Estándar', 46, 2, 1.21, 1),
(67, 2, 'Dosificación estimada', 57, 2, 3.34, 1),
(68, 4, 'Material fino menor a 0,080 mm', 31, 1, 1.03, 1),
(69, 4, 'Densidad Aparente Suelta', 25, 1, 1.90, 1),
(70, 4, 'Densidad Real y Absorción de las arenas', 32, 1, 1.30, 1),
(71, 4, 'Densidad Real y Absorción de las gravas', 26, 1, 1.30, 1),
(72, 4, 'Cubicidad de Partículas', 6, 1, 0.81, 0),
(73, 4, 'Desgaste de Los Ángeles', 37, 1, 2.28, 1),
(74, 4, 'Coeficiente Volumétrico Medio', 41, 1, 1.39, 1),
(75, 4, 'Determinación de Porcentaje de Huecos', 34, 1, 0.68, 1),
(76, 4, 'Partículas Desmenuzables', 35, 1, 1.98, 1),
(77, 4, 'Equivalente de Arena', 33, 1, 1.52, 1),
(78, 4, 'Sales Solubles', 9, 1, 3.60, 1),
(79, 4, 'Cloruros y Sulfatos', 39, 1, 3.60, 0),
(80, 4, 'Impurezas Orgánicas', 51, 1, 1.50, 1),
(81, 4, 'Carbón y Lignito', 2, 1, 2.72, 1),
(82, 4, 'Desintegración', 36, 1, 4.56, 1),
(83, 4, 'Homogeneización y reducción de muestras', 1, 2, 2.20, 1),
(84, 4, 'Límites de Atterberg', 44, 1, 0.91, 1),
(85, 4, 'Contenido de Humedad', 42, 2, 0.00, 0),
(86, 4, 'Densidad Aparente Compactada', 25, 1, 1.90, 1),
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
  `EnsayoDetalleFecha_FechaEnsayo` datetime NOT NULL,
  `EnsayoDetalleFecha_FechaOperacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_EnsayoDetalleFecha`
--

INSERT INTO `TBL_EnsayoDetalleFecha` (`EnsayoDetalleFecha_Id`, `EnsayoDetalleFecha_IdEnsayoItem`, `EnsayoDetalleFecha_IdSolicitud`, `EnsayoDetalleFecha_FechaEnsayo`, `EnsayoDetalleFecha_FechaOperacion`) VALUES
(1, 14, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(2, 15, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(3, 16, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(4, 17, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(5, 18, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(6, 19, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(7, 20, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(8, 21, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14'),
(9, 22, 1, '2002-02-20 00:00:00', '2018-10-04 12:59:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoDetalleItem`
--

CREATE TABLE `TBL_EnsayoDetalleItem` (
  `EnsayoDetalleItem_IdDetalleEnsayoItem` int(10) NOT NULL,
  `EnsayoDetalleItem_IdEnsayoItem` int(10) NOT NULL,
  `EnsayoDetalleItem_ValorEnsayoItem` varchar(100) NOT NULL,
  `EnsayoDetalleItem_IdSolicitud` int(10) NOT NULL,
  `EnsayoDetalleItem_FechaOperacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_EnsayoDetalleItem`
--

INSERT INTO `TBL_EnsayoDetalleItem` (`EnsayoDetalleItem_IdDetalleEnsayoItem`, `EnsayoDetalleItem_IdEnsayoItem`, `EnsayoDetalleItem_ValorEnsayoItem`, `EnsayoDetalleItem_IdSolicitud`, `EnsayoDetalleItem_FechaOperacion`) VALUES
(1, 1, '1', 1, '2018-10-04 22:28:06'),
(2, 2, '1', 1, '2018-10-04 22:28:06'),
(3, 3, '1', 1, '2018-10-04 22:28:06'),
(4, 4, '1', 1, '2018-10-04 22:28:06'),
(5, 5, '1', 1, '2018-10-04 22:28:06'),
(6, 6, '1', 1, '2018-10-04 22:28:06'),
(7, 7, '1', 1, '2018-10-04 22:28:07'),
(8, 8, '1', 1, '2018-10-04 22:28:07'),
(9, 9, '1', 1, '2018-10-04 22:28:07'),
(10, 10, '1', 1, '2018-10-04 22:28:07'),
(11, 11, '1', 1, '2018-10-04 22:28:07'),
(12, 12, '1', 1, '2018-10-04 22:28:07'),
(13, 13, '1', 1, '2018-10-04 22:28:07'),
(14, 14, '1', 1, '2018-10-04 22:28:07'),
(15, 15, '1', 1, '2018-10-04 22:28:07'),
(16, 16, '1', 1, '2018-10-04 22:28:07'),
(17, 17, '1', 1, '2018-10-04 22:28:07'),
(18, 18, '1', 1, '2018-10-04 22:28:07'),
(19, 19, '1', 1, '2018-10-04 22:28:07'),
(20, 22, '7', 1, '2018-10-04 22:28:07'),
(21, 23, '7', 1, '2018-10-04 22:28:07'),
(22, 24, '7', 1, '2018-10-04 22:28:07'),
(23, 25, '8', 1, '2018-10-04 22:28:07'),
(24, 26, '8', 1, '2018-10-04 22:28:07'),
(25, 47, '2', 1, '2018-10-04 22:28:07'),
(26, 48, '2', 1, '2018-10-04 22:28:08'),
(27, 49, '2', 1, '2018-10-04 22:28:08'),
(28, 50, '2', 1, '2018-10-04 22:28:08'),
(29, 51, '2', 1, '2018-10-04 22:28:08'),
(30, 52, '3', 1, '2018-10-04 22:28:08'),
(31, 53, '3', 1, '2018-10-04 22:28:08'),
(32, 54, '4', 1, '2018-10-04 22:28:08'),
(33, 55, '4', 1, '2018-10-04 22:28:08'),
(34, 56, '4', 1, '2018-10-04 22:28:08'),
(35, 57, '9', 1, '2018-10-04 22:28:08'),
(36, 58, '5', 1, '2018-10-04 22:28:08'),
(37, 59, '5', 1, '2018-10-04 22:28:08'),
(38, 60, '5', 1, '2018-10-04 22:28:08'),
(39, 61, '5', 1, '2018-10-04 22:28:08'),
(40, 62, '5', 1, '2018-10-04 22:28:08'),
(41, 63, '5', 1, '2018-10-04 22:28:08'),
(42, 64, '6', 1, '2018-10-04 22:28:08'),
(43, 65, '6', 1, '2018-10-04 22:28:09'),
(44, 66, '6', 1, '2018-10-04 22:28:09'),
(45, 67, '6', 1, '2018-10-04 22:28:09'),
(46, 68, '6', 1, '2018-10-04 22:28:09'),
(47, 69, '6', 1, '2018-10-04 22:28:09'),
(48, 70, '6', 1, '2018-10-04 22:28:09'),
(49, 71, '6', 1, '2018-10-04 22:28:09'),
(50, 72, '6', 1, '2018-10-04 22:28:09'),
(51, 73, '6', 1, '2018-10-04 22:28:09'),
(52, 74, '6', 1, '2018-10-04 22:28:09'),
(53, 75, '6', 1, '2018-10-04 22:28:09'),
(54, 76, '6', 1, '2018-10-04 22:28:09'),
(55, 77, '6', 1, '2018-10-04 22:28:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_EnsayoDetalleObs`
--

CREATE TABLE `TBL_EnsayoDetalleObs` (
  `EnsayoDetalleObs_Id` int(10) NOT NULL,
  `EnsayoDetalleObs_IdSolicitud` int(10) NOT NULL,
  `EnsayoDetalleObs_Obs` longtext NOT NULL,
  `EnsayoDetalleObs_FechaOperacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TBL_EnsayoDetalleObs`
--

INSERT INTO `TBL_EnsayoDetalleObs` (`EnsayoDetalleObs_Id`, `EnsayoDetalleObs_IdSolicitud`, `EnsayoDetalleObs_Obs`, `EnsayoDetalleObs_FechaOperacion`) VALUES
(1, 1, 'OBS', '2018-10-04 12:59:14'),
(2, 1, 'observaciones', '2018-10-04 22:27:41'),
(3, 1, 'observaciones', '2018-10-04 22:28:10');

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
(1, 14, 'SOBRETAMAÑO', ''),
(2, 14, '3”', ''),
(3, 14, '2 ½”', ''),
(4, 14, '2”', ''),
(5, 14, '1 1/2\"', ''),
(6, 14, '1”', ''),
(7, 14, '3/4\"', ''),
(8, 14, '1/2\"', ''),
(9, 14, '3/8”', ''),
(10, 14, 'N° 4', ''),
(11, 14, 'N° 8', ''),
(12, 14, 'Nº 16', ''),
(13, 14, 'Nº 30', ''),
(14, 14, 'Nº 50', ''),
(15, 14, 'Nº 100', ''),
(16, 14, 'Nº 200', ''),
(17, 14, 'MODULO DE FINURA	', ''),
(18, 14, 'T.M.A.', ''),
(19, 14, 'PORCENTAJE DE HUECOS (%)', ''),
(20, 34, 'Contenido de Finos', '%'),
(21, 35, 'Sales Solubles', '%'),
(22, 22, 'Agitacion mecánica', 'ASTM D2419'),
(23, 22, 'EQUIVALENTE DE ARENA (E.A.)', '%'),
(24, 22, 'TIEMPO SEDIMENTACIÓN', 'Minutos'),
(25, 19, 'PERDIDA DE MASA\r\n', '%'),
(26, 19, 'GRADO DE ENSAYO', '%'),
(27, 87, 'Temperatura de Muestreo', '°C'),
(28, 31, 'Oxigeno Consumido', 'mg O/lt Ag'),
(29, 26, 'VALOR DE PH', ''),
(30, 26, 'Metodo Utilizado', 'PotencioMe'),
(31, 88, 'CONTENIDO DE CLORUROS', 'kg Cl/kg de árido'),
(32, 88, 'CONTENIDO DE SULFATOS', 'kg SO 4 -2/kg de árido\r\n'),
(33, 30, 'SOLIDOS SUSPENDIDOS', 'mg/lt'),
(34, 30, 'SOLIDOS DISUELTOS', 'mg/lt'),
(35, 68, 'CONTENIDO DE FINOS', '%'),
(36, 89, 'DENSIDAD REAL SSS', 'kg/cm3'),
(37, 89, 'DENSIDAD REAL SECA', 'kg/cm3'),
(38, 89, 'DENSIDAD REAL NETA', 'kg/cm3'),
(39, 89, 'ABSORCIÓN DE AGUA', '%'),
(40, 81, 'MASA DE LA MUESTRA', 'gr'),
(41, 81, 'TIPO Y GRAVEDAD ESPECIFICA DEL LIQUIDO', 'gr'),
(42, 81, 'CARBON Y LIGNITO', '%'),
(43, 79, 'CONTENIDO DE CLORUROS', 'kg Cl -/ kg de arido'),
(44, 79, 'CONTENIDO DE SULFATOS', 'kg SO 4 -2/kg de arido'),
(45, 90, 'PERDIDA DE MASA', '%'),
(46, 76, 'PERDIDA DE MASA', '%'),
(47, 15, 'LÍMITE LÍQUIDO', ''),
(48, 15, 'TIPO DE ACANALADOR', ''),
(49, 15, 'MÉTODO DE ENSAYO', ''),
(50, 15, 'LÍMITE PLÁSTICO', ''),
(51, 15, 'ÍNDICE DE PLASTICIDAD', ''),
(52, 16, 'SISTEMA USCS', ''),
(53, 16, 'SISTEMA AASHTO', ''),
(54, 20, 'CHANCADO TOTAL', '%'),
(55, 20, 'RODADURA TOTAL', '%'),
(56, 20, 'LAJA TOTAL', '%'),
(57, 21, 'D.P.S. TOTAL ', 'g/cm3'),
(58, 17, 'MÉTODO EMPLEADO (MODIFICADO)', ''),
(59, 17, 'MATERIAL RETENIDO EN 20 mm (que pasa por 2\'\')', '%'),
(60, 17, 'REEMPLAZO O DESCARTE DEL MAT. RETENIDO', ''),
(61, 17, 'D.M.C.H', 'g/cm3'),
(62, 17, 'HUMEDAD OPTIMA', '%'),
(63, 17, 'D.M.C.S.', 'g/cm3'),
(64, 18, 'MÉTODO DE COMPACTACIÓN', ''),
(65, 18, 'DENSIDAD SECA ANTES DE LA INMERSIÓN', 'g/cm3'),
(66, 18, 'ACONDICIONAMIENTO DE LA MUESTRA', ''),
(67, 18, 'DENSIDAD SECA DESPUÉS DE LA INMERSIÓN', 'g/cm3'),
(68, 18, 'ANTES DE LA COMPACTACIÓN', '%'),
(69, 18, 'DESPUÉS DE LA COMPACTACIÓN', '%'),
(70, 18, 'CAPA SUP. DE 25 mm DESPUÉS DE INMERSIÓN', '%'),
(71, 18, 'PROMEDIO DESPUÉS DE LA INMERSIÓN', '%'),
(72, 18, 'C.B.R. a 0,1” de Penetración', '%'),
(73, 18, 'C.B.R. a 0,2” de Penetración', '%'),
(74, 18, 'C.B.R. a 0,3” de Penetración', '%'),
(75, 18, 'EXPANSIÓN (% DE LA ALTURA INICIAL)', '%'),
(76, 18, 'SOBRECARGA', 'kg'),
(77, 18, 'C.B.R al 95% de la D.M.C.S a 0,2\" de penetración (Fuera del alcance de la acreditación)', '%'),
(78, 4, 'ALTURA INICIAL ', 'cm'),
(79, 5, 'ESBELTEZ', ''),
(80, 5, 'DIÁMETRO', 'cm'),
(81, 5, 'ALTURA DE CORTE', 'cm'),
(82, 5, 'DENSIDAD (Método volumétrico)', 'kg/m3'),
(83, 5, 'ALTURA DE ENSAYO ', 'cm'),
(84, 5, 'CARGA DE ROTURA ', 'kN '),
(85, 5, 'RESISTENCIA DEL TESTIGO', 'MPa '),
(86, 5, 'RESISTENCIA CILÍNDRICA ', 'MPa '),
(87, 5, 'RESISTENCIA CUBICA NCh 170 of 85', 'MPa '),
(88, 91, 'Informe de Extracción', ''),
(89, 91, 'Procedimiento de aserrado y Refrenado', ''),
(90, 91, 'Condiciones de Conservación', ''),
(91, 91, 'Identificación de los Testigos', ''),
(93, 28, 'CONTENIDO DE CLORUROS', 'kg Cl-/kg de arido\r\n'),
(94, 29, 'CONTENIDO DE SULFATOS\r\n', 'kg SO4-2 / kg de arido\r\n'),
(95, 92, 'LONGITUD', 'mm'),
(96, 92, 'ANCHO', 'mm'),
(97, 92, 'ALTO', 'mm'),
(98, 92, 'ALTURA', 'mm'),
(99, 93, 'DIÁMETRO', 'cm'),
(100, 93, 'ALTURA DE CORTE', 'cm'),
(101, 93, 'DENSIDAD \r\nMétodo volumétrico', 'kg/m3'),
(102, 93, 'ALTURA DE ENSAYO ', 'cm'),
(103, 93, 'CARGA DE ROTURA ', 'kN '),
(104, 93, 'RESISTENCIA DEL TESTIGO', 'MPa '),
(105, 93, 'RESISTENCIA CILÍNDRICA ', 'MPa \r\n'),
(106, 93, 'RESISTENCIA CUBICA NCh 170 of 85', 'MPa '),
(107, 93, 'RESISTENCIA PROMEDIO ', 'MPa '),
(108, 93, 'RESISTENCIA PROMEDIO TOTAL', 'MPa '),
(109, 41, 'ESPESOR\r\nPie de Metro', 'cm'),
(110, 42, 'DIÁMETRO', 'cm'),
(111, 42, 'DENSIDAD ', 'kg/m3'),
(112, 42, 'ABSORCIÓN', '%'),
(113, 42, 'MARSHALL DE REFERENCIA', 'kg/m3'),
(114, 42, 'COMPACTACIÓN', '%'),
(115, 42, 'MÉTODO	', ''),
(116, 94, 'IDENTIFICACIÓN DE LOS TESTIGOS', ''),
(117, 38, 'CONTENIDO DE ASFALTO\r\nReferencia a agregado', ''),
(118, 38, 'CONTENIDO DE ASFALTO OPTIMO SEGÚN DISEÑO', ''),
(119, 38, 'SOLVENTE UTILIZADO', ''),
(120, 38, 'DISEÑO MARSHALL DE REFERENCIA', ''),
(121, 32, 'SOBRETAMAÑO', ''),
(122, 32, '3”', ''),
(123, 32, '2 ½”', '\r\n'),
(124, 32, '2”', ''),
(125, 32, '1 1/2\"', ''),
(126, 32, '1”', ''),
(127, 32, '3/4\"', ''),
(128, 32, '1/2\"', ''),
(129, 32, '3/8”', ''),
(130, 32, 'N° 4', ''),
(131, 32, 'N° 8', '\r\n'),
(132, 32, 'Nº 16', ''),
(133, 32, 'Nº 30', ''),
(134, 32, 'N° 50', ''),
(135, 32, 'N° 100', ''),
(136, 32, 'N° 200', ''),
(137, 32, 'MODULO DE FINURA', ''),
(138, 32, 'T.M.A.', ''),
(139, 77, 'AGITACIÓN MECÁNICA', 'ASTM D 2419'),
(140, 77, 'EQUIVALENTE DE ARENA (E.A.)', ''),
(141, 77, 'TIEMPO SEDIMENTACIÓN', 'Minutos'),
(142, 73, 'PERDIDA DE MASA', '%'),
(143, 73, 'GRADO DE ENSAYO', ''),
(144, 80, 'COLORACIÓN MUESTRA', ''),
(145, 86, 'METODO DE ENSAYO (D.A.C.)', ''),
(146, 86, 'PROMEDIO DENSIDAD APARENTE COMPACTADA', 'Kg/m3'),
(147, 69, 'METODO DE ENSAYO (D.A.S.)', ''),
(148, 69, 'PROMEDIO DENSIDAD APARENTE SUELTA', 'Kg/m3'),
(151, 51, 'PROFUNDIDAD CONTROL', '(cm)'),
(152, 51, 'D.C.H.', '(kg/m3)'),
(153, 51, 'D.C.S.', '(kg/m3)'),
(154, 51, 'D. MAX', '(kg/m3)'),
(155, 51, 'D. MIN', '(kg/m3)'),
(156, 51, 'HUMEDAD', '(%)'),
(157, 51, 'COMPACTACIÓN', '(%)'),
(158, 56, 'POZO N°	', ''),
(159, 56, 'COTAS', 'm'),
(160, 56, 'INFILTRACIÓN', 'mm/hr'),
(161, 95, 'PROFUNDIDAD CONTROL', '(cm)'),
(162, 95, 'D.C.H.', '(kg/m3)'),
(163, 95, 'D.C.S.', '(kg/m3)'),
(164, 95, 'D.M.C.S.', '(kg/m3)'),
(165, 95, 'HUMEDAD', '(%)'),
(166, 95, 'COMPACTACIÓN', '(%)');

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
-- Estructura de tabla para la tabla `tbl_estado_probeta`
--

CREATE TABLE `tbl_estado_probeta` (
  `id_estado_probeta` int(2) NOT NULL,
  `descripcion_estado_probeta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `telefono_facturacion` varchar(15) NOT NULL,
  `email_facturacion` varchar(30) NOT NULL,
  `nombre_aceptante` varchar(30) NOT NULL,
  `id_cotizacion` int(10) NOT NULL,
  `estado_formulario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Aceptación de Cotización';

--
-- Volcado de datos para la tabla `TBL_FormAC`
--

INSERT INTO `TBL_FormAC` (`id_form_aceptacion`, `empresa_solicitante`, `fecha_aceptacion`, `nombre_solicitante`, `email_solicitante`, `empresa_constructora`, `nombre_obra`, `codigo_obra`, `direccion_obra`, `comuna_obra`, `fono_obra`, `encargado_terreno`, `email_encargado`, `telefono_encargado`, `id_entidad_fiscal`, `empresa_encargada`, `profesional_acargo`, `razon_social`, `rut_empresa_factura`, `giro_empresa`, `direccion_factura`, `nombre_ciudad`, `id_periodo_facturacion`, `id_forma_pago`, `telefono_facturacion`, `email_facturacion`, `nombre_aceptante`, `id_cotizacion`, `estado_formulario`) VALUES
(1, 'CONSTRUCTORA  LARRAIN DOMINGUEZ LTD', '2018-10-04', 'FRANCISCO DOMINGUEZ', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 'Empresa Constructora SPA', 'Obra Sheraton', '5434', 'AUGUSTO LEGUIA SUR 160', '109', '56921222324', 'ALBERTO ESPINOZA', 'profesional@sheraton.cl', '56921222324', 2, 'Empresa Receptora S.A.', 'Alfredo Leal', 'Empresa Factura S.A.', '7676767672', 'Giro de empresa', 'Nueva Tajamar S/N', '109', 3, 2, '56921222324', 'facturacion@afacturar.cl', 'Hernan Saavedra', 1, 1),
(2, 'CONSTRUCTORA  LARRAIN DOMINGUEZ LTD', '2018-10-05', 'FRANCISCO DOMINGUEZ', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 'Empresa Constructora SPA', 'Obra Sheraton', '123123', 'Calle décima S/N', '61', '2122232425', 'Alejandro Vargas', 'jefe.laboratorio@marsslab.cl', '212232324', 1, 'Laboratorios Marss', 'Hernan Saavedra', 'Empresa Factura S.A.', '7676767672', 'Giro de empresa', 'Calle décima S/N', '79', 3, 7, '212232324', 'jefe.laboratorio@marsslab.cl', 'Aceptante', 2, 1),
(3, 'CLIENTE', '2018-10-05', 'CLIENTE', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 'N/A', 'PROYECTO', 'N/A', 'DIRECCION', '0', '2122232425', 'CONTACTO', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', '2122232425', 4, 'CLIENTE', 'CONTACTO', 'CLIENTE', '76765622K', '50', 'DIRECCION', '50', 4, 7, '2122232425', 'EDMUNDOSARRIAINZULZA@GMAIL.COM', 'CLIENTE', 3, 0);

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
(3, 'OC'),
(4, 'HES'),
(5, 'Otros'),
(6, 'Automedición'),
(7, 'Otro');

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
  `hora_ini` datetime NOT NULL,
  `hora_fin` datetime NOT NULL,
  `kilometraje` int(11) NOT NULL,
  `realizado_por` varchar(20) NOT NULL,
  `cantidad_muestras` int(2) NOT NULL,
  `m_cantidad` int(2) NOT NULL,
  `cod_hormigon` varchar(10) NOT NULL,
  `fecha_muestra` datetime NOT NULL,
  `hora_control` time NOT NULL,
  `correlativo` varchar(10) NOT NULL,
  `probeta` varchar(10) NOT NULL,
  `dmu` varchar(10) NOT NULL,
  `compresion` varchar(20) NOT NULL,
  `movimiento` int(2) NOT NULL,
  `curado` int(2) NOT NULL,
  `hora_carga_planta` time NOT NULL,
  `hora_salida_planta` time NOT NULL,
  `hora_llegada_planta` time NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `curado_obra` varchar(20) NOT NULL,
  `responsable_muestreo` varchar(20) NOT NULL,
  `lugar_extraccion` varchar(20) NOT NULL,
  `dosificacion_declarada` varchar(20) NOT NULL,
  `resistencia_especifica` double(5,2) NOT NULL,
  `resistencia` int(2) NOT NULL,
  `procedencia` int(2) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `camion` varchar(20) NOT NULL,
  `guia` varchar(20) NOT NULL,
  `m3` int(10) NOT NULL,
  `cono` int(2) NOT NULL,
  `aspecto` int(2) NOT NULL,
  `textura` int(2) NOT NULL,
  `elemento_hormigonado` varchar(20) NOT NULL,
  `aditivos` varchar(20) NOT NULL,
  `observaciones` longtext NOT NULL,
  `termometro` varchar(100) NOT NULL,
  `equipo_cono` varchar(100) NOT NULL,
  `vibrador_sonda` varchar(100) NOT NULL,
  `regla_metrica` varchar(100) NOT NULL,
  `otros` varchar(100) NOT NULL,
  `edad` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Formulario Solicitud Hormigones';

--
-- Volcado de datos para la tabla `TBL_FormHM`
--

INSERT INTO `TBL_FormHM` (`id_form_c_h_m`, `id_agendamiento_visita`, `id_tipo_ensayo`, `numero_solicitud`, `correlativo_obra`, `fecha_solicitud`, `hora_ini`, `hora_fin`, `kilometraje`, `realizado_por`, `cantidad_muestras`, `m_cantidad`, `cod_hormigon`, `fecha_muestra`, `hora_control`, `correlativo`, `probeta`, `dmu`, `compresion`, `movimiento`, `curado`, `hora_carga_planta`, `hora_salida_planta`, `hora_llegada_planta`, `hora_inicio`, `hora_termino`, `curado_obra`, `responsable_muestreo`, `lugar_extraccion`, `dosificacion_declarada`, `resistencia_especifica`, `resistencia`, `procedencia`, `marca`, `camion`, `guia`, `m3`, `cono`, `aspecto`, `textura`, `elemento_hormigonado`, `aditivos`, `observaciones`, `termometro`, `equipo_cono`, `vibrador_sonda`, `regla_metrica`, `otros`, `edad`) VALUES
(1, 5, 1, '6789-1', '54321', '2018-10-05 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12423, '8', 3, 0, '56456', '2018-10-05 00:00:00', '14:04:00', '5445', '2', '65', 'vibrado', 2, 1, '23:06:00', '14:03:00', '14:03:00', '14:03:00', '14:03:00', 'Curado de obra', '8', 'Camion', '', 8.00, 1, 1, 'Melon Hormigones', 'XVSS-12', '4566', 2, 2, 1, 2, 'elemento', 'aditivo', 'observaciones', 'cvd3', 'E4G5', 'hdf5', 'hfg2', 'Otros', '22'),
(2, 5, 1, '6789-2', '54321', '2018-10-05 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12423, '8', 3, 0, '56456', '2018-10-05 00:00:00', '14:04:00', '5445', '2', '65', 'vibrado', 2, 1, '23:06:00', '14:03:00', '14:03:00', '14:03:00', '14:03:00', 'Curado de obra', '8', 'Camion', '', 8.00, 1, 1, 'Melon Hormigones', 'XVSS-12', '4566', 2, 2, 1, 2, 'elemento', 'aditivo', 'observaciones', 'cvd3', 'E4G5', 'hdf5', 'hfg2', 'Otros', '15'),
(3, 5, 1, '6789-3', '54321', '2018-10-05 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12423, '8', 3, 0, '56456', '2018-10-05 00:00:00', '14:04:00', '5445', '2', '65', 'vibrado', 2, 1, '23:06:00', '14:03:00', '14:03:00', '14:03:00', '14:03:00', 'Curado de obra', '8', 'Camion', '', 8.00, 1, 1, 'Melon Hormigones', 'XVSS-12', '4566', 2, 2, 1, 2, 'elemento', 'aditivo', 'observaciones', 'cvd3', 'E4G5', 'hdf5', 'hfg2', 'Otros', '20');

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
  `fecha_operacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Formulario Solicitud Servicio';

--
-- Volcado de datos para la tabla `TBL_FormSS`
--

INSERT INTO `TBL_FormSS` (`id_form_solicitud_servicio`, `id_agendamiento_visita`, `numero_solicitud`, `id_tipo_ensayo`, `correlativo_obra`, `fecha_solicitud`, `inicio_servicio`, `fin_servicio`, `kilometraje`, `realizado_por`, `cantidad_muestras`, `observaciones`, `cliente_nombre_firma`, `cliente_rut_firma`, `material`, `ubicacion`, `procedencia`, `fecha_operacion`) VALUES
(1, 1, '7643-1', 2, '', '2018-10-04 00:00:00', '11:50:00', '11:52:00', 123423423, '10', 2, 'Observaciones de SS Suelo', 'Hernan', 164568571, 'Material 1', 'Ubicacion1', 'Procedencia1', '2018-10-04 11:49:09'),
(2, 1, '76543-1', 1, '', '2018-10-04 00:00:00', '22:38:00', '22:40:00', 3123123, '10', 2, 'Registrado', 'Alejandro', 164568571, 'Concreto', 'Arriba', 'N/A', '2018-10-04 22:39:00'),
(3, 1, '9999-1', 6, '', '2018-10-04 00:00:00', '23:34:00', '23:35:00', 44534534, '10', 1, 'Observaciones Elementos', 'Test', 164568571, 'Material1', 'Ubicacion1', 'Procedencia1', '2018-10-04 23:33:41'),
(4, 1, '2345-1', 5, '', '2018-10-04 00:00:00', '01:00:00', '01:01:00', 6543223, '10', 1, 'Observaciones Asfalto', 'Edmundo ', 164568571, 'Mat1', 'Ubic1', 'Pro1', '2018-10-05 01:00:16'),
(5, 1, '4554-1', 4, '', '2018-10-04 00:00:00', '02:05:00', '02:06:00', 5345345, '10', 1, 'Observaciones Aridos', 'John', 164568571, 'Material', 'Ubicacion', 'Procedencia', '2018-10-05 02:05:03'),
(6, 1, '654321-1', 3, '', '2018-10-04 00:00:00', '03:13:00', '03:14:00', 5, '10', 1, 'Observaciones Aguas', 'Test', 164558571, 'Material', 'Ubicacion', 'Procedencia', '2018-10-05 03:11:45'),
(7, 3, '686970-1', 2, '', '2018-10-05 00:00:00', '12:13:00', '12:13:00', 431234, '11', 1, 'Observaciones', 'Edmundo', 1234567890, 'Prueba1', 'Prueba3', 'Prueba2', '2018-10-05 12:09:00'),
(8, 5, '767676-1', 1, '', '2018-10-05 00:00:00', '14:01:00', '14:04:00', 65434, '8', 1, 'Observaciones de prueba', 'Edmundo', 123456789, 'Polietileno', 'Tramo 2', 'Fabricación', '2018-10-05 14:03:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormSSDetalle`
--

CREATE TABLE `TBL_FormSSDetalle` (
  `FormSSDetalle_Id` int(10) NOT NULL,
  `FormSS_Id` int(10) NOT NULL,
  `Muestra` int(1) NOT NULL,
  `Ensayo_IdEnsayo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Detalle de items seleccionados en Solicitud de Servicio';

--
-- Volcado de datos para la tabla `TBL_FormSSDetalle`
--

INSERT INTO `TBL_FormSSDetalle` (`FormSSDetalle_Id`, `FormSS_Id`, `Muestra`, `Ensayo_IdEnsayo`) VALUES
(1, 1, 1, 14),
(2, 1, 1, 15),
(3, 1, 1, 16),
(4, 1, 1, 53),
(5, 2, 1, 14),
(6, 2, 1, 21),
(7, 2, 1, 56),
(8, 2, 1, 53),
(9, 4, 1, 14),
(10, 4, 1, 18),
(11, 4, 1, 21),
(12, 4, 1, 0),
(13, 5, 1, 14),
(14, 5, 1, 53),
(15, 6, 1, 14),
(16, 6, 1, 53),
(17, 6, 1, 0),
(18, 6, 1, 0),
(19, 7, 1, 18),
(20, 7, 1, 19),
(21, 8, 1, 0),
(22, 8, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TBL_FormSSItem`
--

CREATE TABLE `TBL_FormSSItem` (
  `id_item_solicitud_servicio` int(2) NOT NULL,
  `nombre_item_solicitud_servicio` varchar(50) NOT NULL,
  `id_categoria_item_solicitud_servicio` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de items para solicitud de servicio';

--
-- Volcado de datos para la tabla `TBL_FormSSItem`
--

INSERT INTO `TBL_FormSSItem` (`id_item_solicitud_servicio`, `nombre_item_solicitud_servicio`, `id_categoria_item_solicitud_servicio`) VALUES
(1, 'Análisis Granulométrico', 9),
(2, 'Límites de Atterberg', 9),
(3, 'Clasificación USCS y AASHTO', 9),
(4, 'Proctor Modificado', 9),
(5, 'Capacidad de Soporte CBR', 9),
(6, 'Desgaste de Los Ángeles', 9),
(7, 'Cubicidad de Partículas', 9),
(8, 'Proctor Estandar', 9),
(9, 'Densidad de particulas sólidas', 9),
(10, 'Contenido de humedad', 9),
(11, 'Densidad Relativa', 9),
(12, 'Porchet (Ensayo de Infiltración)', 9),
(13, 'Estratigrafía', 9),
(14, 'Densidad Natural', 9),
(15, 'Dosificación Estimada', 9),
(16, 'Esquivalente de Arenas', 9),
(17, 'Sales Solubles', 9),
(18, 'Contenido de materia orgánica', 9),
(19, 'Desintegración', 9),
(20, 'Densidad Real y Absorción', 9),
(21, 'Densidad Aparente Suelta', 9),
(22, 'Densidad Aparente Compactada', 9),
(23, 'Humedad de Muestras no Perturbadas', 9),
(24, 'Densidad de Muestras no Perturbadas', 9),
(25, 'Densidad en Terreno (Densimetro Nuclear)', 2),
(26, 'Densidad en Terreno (Cono de Arena)', 2),
(27, 'Granulometría de Arena', 0),
(28, 'Granulometría de Grava / Gravilla', 0),
(29, 'Material fino menor a 0,080 mm', 0),
(30, 'Módulo de Finura', 0),
(31, 'Densidad Aparente Suelta', 0),
(32, 'Densidad Aparente Compactada', 0),
(33, 'Densidad Real y Absorción de las Arenas', 0),
(34, 'Densidad Real y Absorción de las gravas', 0),
(35, 'Cubicidad de Partículas', 0),
(36, 'Desgaste de Los Ángeles', 0),
(37, 'Coeficiente Volumétrico Medio', 0),
(38, 'Determinación de porcentaje de huecos', 0),
(39, 'Partículas Desmenuzables', 0),
(40, 'Equivalente de Arena', 0),
(41, 'Sales Solubles', 0),
(42, 'Impurezas Orgánicas', 0),
(43, 'Carbón y Lignito', 0),
(44, 'Desintegración', 0),
(45, 'Homogeneización y Reducción de Muestras', 0),
(46, 'Límites de Atterberg', 0),
(47, 'Contenido de humedad', 0),
(48, 'Determinación de Ph', 11),
(49, 'Sales Solubles', 11),
(50, 'Contenido de Cloruros', 11),
(51, 'Contenido de Sulfatos', 11),
(52, 'Solidos Disueltos y Suspendidos', 11),
(53, 'Materia Orgánica', 11),
(54, 'Dosificación de Hormigón', 5),
(55, 'Dosificación de Mortero', 5),
(56, 'Dosificación de Suelo Cemento', 5),
(57, 'Ruptura Probeta Suelo Cemento', 5),
(58, 'Contenido de Aire Teórico', 5),
(59, 'Densidad Aparente del Hormigón Fresco', 5),
(60, 'Extracción y Espesor de Testigos', 5),
(61, 'Control de Docilidad', 5),
(62, 'Indice Esclerométrico', 5),
(63, 'Uniformidad del Hormigón', 5),
(64, 'Comprensión Hormigón Mandanten', 5),
(65, 'Flexotracción Hormigón Mandante', 5),
(66, 'Lisura Hi - Lo', 5),
(67, 'Solera Flexión / Impacto', 6),
(68, 'Solera Compresión (2 testigos)', 6),
(69, 'Solerilla Flexión', 6),
(70, 'Adocreto', 6),
(71, 'Densidad en Terreno (Densimetro Nuclear)', 7),
(72, 'Muestreo de mezclas bituminosas', 7),
(73, 'Granulometría y contenido de Asfalto', 7),
(74, 'Control de temperatura', 7),
(75, 'Extracción y Espesor de Testigos', 7),
(76, 'Densidad Real de Mezcla Asfáltica', 7),
(77, 'Determinación contenido de Asfalto (testigo)', 7),
(78, 'Control de Riego Asfáltico', 7),
(79, 'Control Marshall', 7),
(80, 'Lisura Hi - Lo', 7),
(81, 'Visita Laboratorista', 3),
(82, 'Extracción de Testigos', 3),
(83, 'Confección Calicata hasta 1,5m', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_hormigon`
--

CREATE TABLE `tbl_hormigon` (
  `id_hormigon` int(10) NOT NULL,
  `id_form_c_h_m` int(10) NOT NULL,
  `dosificacion_decl` varchar(100) NOT NULL,
  `resistencia_esp` varchar(100) NOT NULL,
  `id_unidad_medida_r` int(2) NOT NULL,
  `id_unidad_medida_c` int(2) NOT NULL,
  `id_procedencia_obra` int(2) NOT NULL,
  `premezclado_marca` varchar(100) NOT NULL,
  `premezclado_camion` varchar(100) NOT NULL,
  `premezclado_guia` varchar(100) NOT NULL,
  `premezclado_m3` varchar(100) NOT NULL,
  `cono` varchar(100) NOT NULL,
  `id_aspecto` int(2) NOT NULL,
  `id_textura` int(2) NOT NULL,
  `elemento_hormigonado` varchar(100) NOT NULL,
  `aditivo` varchar(100) NOT NULL,
  `observaciones` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Volcado de datos para la tabla `TBL_Informe`
--

INSERT INTO `TBL_Informe` (`Informe_Id`, `Informe_IdFormSS`, `Informe_IdFormCH`, `Informe_Tipo`, `Informe_FechaCreacion`, `Informe_FechaEdicion`, `Informe_FechaFirma`, `Informe_Estado`) VALUES
(1, 1, 0, 2, '2018-10-04 11:49:09', '2018-10-04 22:28:10', '0000-00-00 00:00:00', 2),
(2, 2, 0, 1, '2018-10-04 22:39:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 3, 0, 6, '2018-10-04 23:37:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 4, 0, 5, '2018-10-05 01:00:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 5, 0, 4, '2018-10-05 02:05:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 6, 0, 3, '2018-10-05 03:11:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 7, 0, 2, '2018-10-05 12:09:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 8, 0, 1, '2018-10-05 14:03:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 0, 1, 1, '2018-10-05 14:06:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 0, 2, 1, '2018-10-05 14:06:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(11, 0, 3, 1, '2018-10-05 14:06:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

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
-- Estructura de tabla para la tabla `tbl_informe_detalle`
--

CREATE TABLE `tbl_informe_detalle` (
  `informe_detalle_id` int(10) NOT NULL,
  `informe_id` int(10) NOT NULL,
  `ensayo_item_id` int(10) NOT NULL,
  `ensayo_item_valor` int(11) NOT NULL,
  `ensayo_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(15, 'Sin Asignacion', 1);

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
-- Estructura de tabla para la tabla `tbl_procedencia_obra`
--

CREATE TABLE `tbl_procedencia_obra` (
  `id_procedencia_obra` int(2) NOT NULL,
  `nombre_procedencia_obra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `TBL_Textura`
--

CREATE TABLE `TBL_Textura` (
  `id_textura` int(2) NOT NULL,
  `descripcion_textura` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_curado`
--

CREATE TABLE `tbl_tipo_curado` (
  `id_tipo_curado` int(2) NOT NULL,
  `descripcion_tipo_curado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `tbl_tipo_probeta`
--

CREATE TABLE `tbl_tipo_probeta` (
  `id_tipo_probeta` int(2) NOT NULL,
  `descrpcion_tipo_probeta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ubicacion_probeta`
--

CREATE TABLE `tbl_ubicacion_probeta` (
  `id_ubicacion_probeta` int(2) NOT NULL,
  `descripcion_ubicacion_probeta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad_medida_c`
--

CREATE TABLE `tbl_unidad_medida_c` (
  `id_unidad_medida_c` int(2) NOT NULL,
  `valor_unidad_medida_c` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad_medida_r`
--

CREATE TABLE `tbl_unidad_medida_r` (
  `id_unidad_medida_r` int(2) NOT NULL,
  `valor_r` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `UsuarioEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='listado de usuarios del sistema';

--
-- Volcado de datos para la tabla `TBL_Usuario`
--

INSERT INTO `TBL_Usuario` (`id_usuario`, `rut_usuario`, `password`, `nombre_usuario`, `apellido_paterno`, `apellido_materno`, `telefono_fijo_usuario`, `telefono_movil_usuario`, `email_usuario`, `id_tipo_usuario`, `id_sucursal`, `id_area_empresa`, `id_cargo_empresa`, `id_centro_costo`, `sigla_usuario`, `UsuarioEstado`) VALUES
(1, '164568571', '164568571', 'administrador', 'tecnotrack', 'tecnotrack', 2147483647, 2147483647, 'edmundo.sarria@tecnotrack.cl', 1, 2, 1, 3, 1, 'att', 1),
(2, '173551711', '173551711', 'Alejandro', 'Vargas', 'Vargas', 92939495, 92939495, 'jefe.laboratorio@marsslab.cl', 1, 1, 1, 1, 1, 'AV', 1),
(3, '170315375', '170315375', ' javier ignacio', 'arancibia', 'gutierrez', 2147483647, 2147483647, 'jefehormigones@marsslab.cl', 3, 3, 4, 3, 1, ' ag', 1),
(4, '165716639', '165716639', ' nicolle denisse', 'arenas', 'albornoz', 2147483647, 2147483647, 'facturacion@marsslab.cl', 3, 3, 1, 3, 1, ' aa', 1),
(5, '178090119', '178090119', ' jonathan jaime', 'aristegui', 'molina', 2147483647, 2147483647, 'programacion@marsslab.cl', 3, 3, 4, 3, 1, ' am', 1),
(6, '115211129', '115211129', ' nelson armando', 'cautivo', 'ponce', 2147483647, 2147483647, 'contabilidad@marsslab.cl', 3, 3, 1, 3, 1, ' cp', 1),
(7, '189150253', '189150253', ' monica', 'crespo', 'olivares', 2147483647, 2147483647, 'oficinatecnica@marsslab.cl', 3, 1, 1, 1, 3, ' co', 1),
(8, '108446633', '108446633', ' guillermo orlando', 'fuentes', 'perez', 2147483647, 2147483647, 'laboratorio.scl@marsslab.cl', 3, 2, 1, 3, 1, ' fp', 1),
(9, '401832661', '401832661', ' catherine', 'giraldo', 'arias', 2147483647, 2147483647, 'asistente.comercial@marsslab.cl', 3, 3, 2, 2, 3, ' ga', 1),
(10, '144343581', '144343581', ' claudio andres', 'gonzalez', 'pajarito', 2147483647, 2147483647, 'comercial@marsslab.cl', 3, 3, 2, 3, 1, ' gp', 1),
(11, '15931474K', '15931474K', ' alvaro patricio', 'marambio', 'valdes', 2147483647, 2147483647, 'consultoria@marsslab.cl', 3, 3, 3, 3, 1, ' mv', 1),
(12, '131912293', '131912293', ' catherine michele', 'maynou', 'rubio', 2147483647, 2147483647, 'jefesuelos@marsslab.cl', 3, 2, 1, 3, 1, ' mr', 1),
(13, '173551711', '173551711', ' alejandro ignacio', 'vargas', 'carrasco', 2147483647, 2147483647, 'jefe.laboratorio@marsslab.cl', 3, 3, 1, 3, 1, ' vc', 1),
(14, '144818695', '144818695', ' cristian francisco', 'zamorano', 'zamorano', 2147483647, 2147483647, 'sala.suelos@marsslab.cl', 3, 3, 1, 3, 1, ' zz', 1);

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
-- Indices de la tabla `bak.tbl_formapago`
--
ALTER TABLE `bak.tbl_formapago`
  ADD PRIMARY KEY (`id_forma_pago_cli`);

--
-- Indices de la tabla `TBL_AendaVisitaDetalle`
--
ALTER TABLE `TBL_AendaVisitaDetalle`
  ADD PRIMARY KEY (`id_detalle_servicio_agendado`),
  ADD KEY `id_agendamiento_visita` (`id_agendamiento_visita`);

--
-- Indices de la tabla `TBL_AgendaVisita`
--
ALTER TABLE `TBL_AgendaVisita`
  ADD PRIMARY KEY (`id_agendamiento_visita`),
  ADD KEY `id_destino` (`id_destino`),
  ADD KEY `id_laboratorista` (`id_laboratorista`);

--
-- Indices de la tabla `TBL_AgendaVisitaDetalleEquipo`
--
ALTER TABLE `TBL_AgendaVisitaDetalleEquipo`
  ADD PRIMARY KEY (`id_detalle_equipo_agendado`),
  ADD KEY `id_agendamiento_visita` (`id_agendamiento_visita`);

--
-- Indices de la tabla `TBL_Aspecto`
--
ALTER TABLE `TBL_Aspecto`
  ADD PRIMARY KEY (`tbl_aspecto`);

--
-- Indices de la tabla `TBL_CatSS`
--
ALTER TABLE `TBL_CatSS`
  ADD PRIMARY KEY (`id_categoria_item_solicitud_servicio`);

--
-- Indices de la tabla `TBL_Cliente`
--
ALTER TABLE `TBL_Cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_periodo_pago_cli` (`id_periodo_pago_cli`),
  ADD KEY `id_forma_pago_cli` (`id_forma_pago_cli`),
  ADD KEY `id_estado_cliente` (`id_estado_cliente`);

--
-- Indices de la tabla `TBL_ClienteEstado`
--
ALTER TABLE `TBL_ClienteEstado`
  ADD PRIMARY KEY (`id_estado_cliente`);

--
-- Indices de la tabla `TBL_Comuna`
--
ALTER TABLE `TBL_Comuna`
  ADD PRIMARY KEY (`comuna_id`),
  ADD KEY `provincia_id` (`provincia_id`);

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
-- Indices de la tabla `tbl_curado_obra`
--
ALTER TABLE `tbl_curado_obra`
  ADD PRIMARY KEY (`id_curado_obra`);

--
-- Indices de la tabla `tbl_designacion_moldes`
--
ALTER TABLE `tbl_designacion_moldes`
  ADD PRIMARY KEY (`id_designacion_molde`);

--
-- Indices de la tabla `TBL_Destino`
--
ALTER TABLE `TBL_Destino`
  ADD PRIMARY KEY (`id_destino`),
  ADD KEY `id_origen` (`id_origen`);

--
-- Indices de la tabla `tbl_detalle_equipo_f_c_h_m`
--
ALTER TABLE `tbl_detalle_equipo_f_c_h_m`
  ADD PRIMARY KEY (`id_detalle_equipo_f_c_h_m`),
  ADD KEY `id_equipo` (`id_equipo`),
  ADD KEY `id_form_c_h_m` (`id_form_c_h_m`);

--
-- Indices de la tabla `tbl_detalle_fecha_ensayo`
--
ALTER TABLE `tbl_detalle_fecha_ensayo`
  ADD PRIMARY KEY (`id_detalle_fecha_ensayo`),
  ADD KEY `id_ensayo_item` (`id_ensayo_item`);

--
-- Indices de la tabla `tbl_detalle_form_solicitud_servicio`
--
ALTER TABLE `tbl_detalle_form_solicitud_servicio`
  ADD PRIMARY KEY (`id_detalle_form_solicitud_s`),
  ADD KEY `id_form_solicitud_servicio` (`id_form_solicitud_servicio`),
  ADD KEY `id_ensayo` (`id_ensayo`);

--
-- Indices de la tabla `tbl_detalle_muestra`
--
ALTER TABLE `tbl_detalle_muestra`
  ADD PRIMARY KEY (`id_detalle_muestra`),
  ADD KEY `id_form_c_h_m` (`id_form_c_h_m`);

--
-- Indices de la tabla `tbl_detalle_probeta`
--
ALTER TABLE `tbl_detalle_probeta`
  ADD PRIMARY KEY (`id_detalle_probeta`),
  ADD KEY `id_tipo_probeta` (`id_tipo_probeta`),
  ADD KEY `id_form_c_h_m` (`id_form_c_h_m`),
  ADD KEY `id_estado_probeta` (`id_estado_probeta`),
  ADD KEY `id_ubicacion_probeta` (`id_ubicacion_probeta`);

--
-- Indices de la tabla `tbl_detalle_tipo_curado`
--
ALTER TABLE `tbl_detalle_tipo_curado`
  ADD PRIMARY KEY (`id_detalle_tipo_curado`),
  ADD KEY `id_form_c_h_m` (`id_form_c_h_m`),
  ADD KEY `id_tipo_curado` (`id_tipo_curado`);

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
-- Indices de la tabla `tbl_estado_probeta`
--
ALTER TABLE `tbl_estado_probeta`
  ADD PRIMARY KEY (`id_estado_probeta`);

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
  ADD KEY `id_tipo_ensayo` (`id_tipo_ensayo`);

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
  ADD KEY `FormSS_Id` (`FormSS_Id`);

--
-- Indices de la tabla `TBL_FormSSItem`
--
ALTER TABLE `TBL_FormSSItem`
  ADD PRIMARY KEY (`id_item_solicitud_servicio`),
  ADD KEY `id_categoria_item_solicitud_servicio` (`id_categoria_item_solicitud_servicio`);

--
-- Indices de la tabla `tbl_hormigon`
--
ALTER TABLE `tbl_hormigon`
  ADD PRIMARY KEY (`id_hormigon`),
  ADD KEY `id_form_c_h_m` (`id_form_c_h_m`),
  ADD KEY `id_unidad_medida_r` (`id_unidad_medida_r`),
  ADD KEY `id_unidad_medida_c` (`id_unidad_medida_c`),
  ADD KEY `id_procedencia_obra` (`id_procedencia_obra`),
  ADD KEY `id_aspecto` (`id_aspecto`),
  ADD KEY `id_textura` (`id_textura`);

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
-- Indices de la tabla `tbl_informe_detalle`
--
ALTER TABLE `tbl_informe_detalle`
  ADD PRIMARY KEY (`informe_detalle_id`);

--
-- Indices de la tabla `TBL_Laboratorista`
--
ALTER TABLE `TBL_Laboratorista`
  ADD PRIMARY KEY (`id_laboratorista`);

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
-- Indices de la tabla `tbl_procedencia_obra`
--
ALTER TABLE `tbl_procedencia_obra`
  ADD PRIMARY KEY (`id_procedencia_obra`);

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
-- Indices de la tabla `TBL_Textura`
--
ALTER TABLE `TBL_Textura`
  ADD PRIMARY KEY (`id_textura`);

--
-- Indices de la tabla `tbl_tipo_curado`
--
ALTER TABLE `tbl_tipo_curado`
  ADD PRIMARY KEY (`id_tipo_curado`);

--
-- Indices de la tabla `tbl_tipo_descuento`
--
ALTER TABLE `tbl_tipo_descuento`
  ADD PRIMARY KEY (`id_tipo_descuento`);

--
-- Indices de la tabla `tbl_tipo_probeta`
--
ALTER TABLE `tbl_tipo_probeta`
  ADD PRIMARY KEY (`id_tipo_probeta`);

--
-- Indices de la tabla `tbl_ubicacion_probeta`
--
ALTER TABLE `tbl_ubicacion_probeta`
  ADD PRIMARY KEY (`id_ubicacion_probeta`);

--
-- Indices de la tabla `tbl_unidad_medida_c`
--
ALTER TABLE `tbl_unidad_medida_c`
  ADD PRIMARY KEY (`id_unidad_medida_c`);

--
-- Indices de la tabla `tbl_unidad_medida_r`
--
ALTER TABLE `tbl_unidad_medida_r`
  ADD PRIMARY KEY (`id_unidad_medida_r`);

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
-- AUTO_INCREMENT de la tabla `bak.tbl_formapago`
--
ALTER TABLE `bak.tbl_formapago`
  MODIFY `id_forma_pago_cli` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `TBL_AendaVisitaDetalle`
--
ALTER TABLE `TBL_AendaVisitaDetalle`
  MODIFY `id_detalle_servicio_agendado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `TBL_AgendaVisita`
--
ALTER TABLE `TBL_AgendaVisita`
  MODIFY `id_agendamiento_visita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `TBL_AgendaVisitaDetalleEquipo`
--
ALTER TABLE `TBL_AgendaVisitaDetalleEquipo`
  MODIFY `id_detalle_equipo_agendado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT de la tabla `TBL_Cliente`
--
ALTER TABLE `TBL_Cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_ClienteEstado`
--
ALTER TABLE `TBL_ClienteEstado`
  MODIFY `id_estado_cliente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TBL_Comuna`
--
ALTER TABLE `TBL_Comuna`
  MODIFY `comuna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT de la tabla `TBL_Cotizacion`
--
ALTER TABLE `TBL_Cotizacion`
  MODIFY `id_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionCorr`
--
ALTER TABLE `TBL_CotizacionCorr`
  MODIFY `id_correlativo_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionDetalleDestino`
--
ALTER TABLE `TBL_CotizacionDetalleDestino`
  MODIFY `id_detalle_destino_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionDetalleEnsayos`
--
ALTER TABLE `TBL_CotizacionDetalleEnsayos`
  MODIFY `id_detalle_ensayo_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionEstado`
--
ALTER TABLE `TBL_CotizacionEstado`
  MODIFY `id_estado_cotizacion` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `TBL_CotizacionGestion`
--
ALTER TABLE `TBL_CotizacionGestion`
  MODIFY `id_historial_cotizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT de la tabla `tbl_detalle_fecha_ensayo`
--
ALTER TABLE `tbl_detalle_fecha_ensayo`
  MODIFY `id_detalle_fecha_ensayo` int(10) NOT NULL AUTO_INCREMENT;

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
  MODIFY `EnsayoDetalleFecha_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoDetalleItem`
--
ALTER TABLE `TBL_EnsayoDetalleItem`
  MODIFY `EnsayoDetalleItem_IdDetalleEnsayoItem` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoDetalleObs`
--
ALTER TABLE `TBL_EnsayoDetalleObs`
  MODIFY `EnsayoDetalleObs_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoEstado`
--
ALTER TABLE `TBL_EnsayoEstado`
  MODIFY `id_estado_ensayo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `TBL_EnsayoItem`
--
ALTER TABLE `TBL_EnsayoItem`
  MODIFY `id_ensayo_item` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

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
-- AUTO_INCREMENT de la tabla `TBL_FormAC`
--
ALTER TABLE `TBL_FormAC`
  MODIFY `id_form_aceptacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_FormaPago`
--
ALTER TABLE `TBL_FormaPago`
  MODIFY `id_forma_pago` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `TBL_FormHM`
--
ALTER TABLE `TBL_FormHM`
  MODIFY `id_form_c_h_m` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TBL_FormSS`
--
ALTER TABLE `TBL_FormSS`
  MODIFY `id_form_solicitud_servicio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `TBL_FormSSDetalle`
--
ALTER TABLE `TBL_FormSSDetalle`
  MODIFY `FormSSDetalle_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `TBL_Informe`
--
ALTER TABLE `TBL_Informe`
  MODIFY `Informe_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `TBL_InformeEstado`
--
ALTER TABLE `TBL_InformeEstado`
  MODIFY `InformeEstado_Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_informe_detalle`
--
ALTER TABLE `tbl_informe_detalle`
  MODIFY `informe_detalle_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TBL_Laboratorista`
--
ALTER TABLE `TBL_Laboratorista`
  MODIFY `id_laboratorista` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Filtros para la tabla `TBL_AendaVisitaDetalle`
--
ALTER TABLE `TBL_AendaVisitaDetalle`
  ADD CONSTRAINT `TBL_AgendaVisitaDetalle_ibfk_1` FOREIGN KEY (`id_agendamiento_visita`) REFERENCES `TBL_AgendaVisita` (`id_agendamiento_visita`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_AgendaVisita`
--
ALTER TABLE `TBL_AgendaVisita`
  ADD CONSTRAINT `fk_tbl_agendamiento_visita_1` FOREIGN KEY (`id_destino`) REFERENCES `TBL_Destino` (`id_destino`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_AgendaVisitaDetalleEquipo`
--
ALTER TABLE `TBL_AgendaVisitaDetalleEquipo`
  ADD CONSTRAINT `fk_tbl_detalle_equipo_agendado_1` FOREIGN KEY (`id_agendamiento_visita`) REFERENCES `TBL_AgendaVisita` (`id_agendamiento_visita`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_Cliente`
--
ALTER TABLE `TBL_Cliente`
  ADD CONSTRAINT `TBL_Cliente_ibfk_1` FOREIGN KEY (`id_estado_cliente`) REFERENCES `TBL_ClienteEstado` (`id_estado_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cliente_ibfk_2` FOREIGN KEY (`id_periodo_pago_cli`) REFERENCES `TBL_PeriodoPago` (`id_periodo_pago_cli`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_Cliente_ibfk_3` FOREIGN KEY (`id_forma_pago_cli`) REFERENCES `bak.tbl_formapago` (`id_forma_pago_cli`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
-- Filtros para la tabla `tbl_detalle_fecha_ensayo`
--
ALTER TABLE `tbl_detalle_fecha_ensayo`
  ADD CONSTRAINT `tbl_detalle_fecha_ensayo_ibfk_1` FOREIGN KEY (`id_ensayo_item`) REFERENCES `TBL_EnsayoItem` (`id_ensayo_item`);

--
-- Filtros para la tabla `tbl_detalle_form_solicitud_servicio`
--
ALTER TABLE `tbl_detalle_form_solicitud_servicio`
  ADD CONSTRAINT `tbl_detalle_form_solicitud_servicio_ibfk_2` FOREIGN KEY (`id_ensayo`) REFERENCES `TBL_Ensayo` (`id_ensayo`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_probeta`
--
ALTER TABLE `tbl_detalle_probeta`
  ADD CONSTRAINT `tbl_detalle_probeta_ibfk_2` FOREIGN KEY (`id_ubicacion_probeta`) REFERENCES `tbl_ubicacion_probeta` (`id_ubicacion_probeta`) ON DELETE NO ACTION,
  ADD CONSTRAINT `tbl_detalle_probeta_ibfk_3` FOREIGN KEY (`id_tipo_probeta`) REFERENCES `tbl_tipo_probeta` (`id_tipo_probeta`) ON DELETE NO ACTION,
  ADD CONSTRAINT `tbl_detalle_probeta_ibfk_4` FOREIGN KEY (`id_estado_probeta`) REFERENCES `tbl_estado_probeta` (`id_estado_probeta`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_tipo_curado`
--
ALTER TABLE `tbl_detalle_tipo_curado`
  ADD CONSTRAINT `tbl_detalle_tipo_curado_ibfk_2` FOREIGN KEY (`id_tipo_curado`) REFERENCES `tbl_tipo_curado` (`id_tipo_curado`) ON DELETE NO ACTION;

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
  ADD CONSTRAINT `TBL_FormAC_ibfk_3` FOREIGN KEY (`id_forma_pago`) REFERENCES `TBL_FormaPago` (`id_forma_pago`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TBL_FormAC_ibfk_4` FOREIGN KEY (`id_cotizacion`) REFERENCES `TBL_Cotizacion` (`id_cotizacion`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `TBL_FormHM`
--
ALTER TABLE `TBL_FormHM`
  ADD CONSTRAINT `TBL_FormHM_ibfk_1` FOREIGN KEY (`id_tipo_ensayo`) REFERENCES `TBL_EnsayoTipo` (`id_tipo_ensayo`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_FormSS`
--
ALTER TABLE `TBL_FormSS`
  ADD CONSTRAINT `TBL_FormSS_ibfk_1` FOREIGN KEY (`id_tipo_ensayo`) REFERENCES `TBL_EnsayoTipo` (`id_tipo_ensayo`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `TBL_FormSSDetalle`
--
ALTER TABLE `TBL_FormSSDetalle`
  ADD CONSTRAINT `TBL_FormSSDetalle_ibfk_1` FOREIGN KEY (`FormSS_Id`) REFERENCES `TBL_FormSS` (`id_form_solicitud_servicio`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `tbl_hormigon`
--
ALTER TABLE `tbl_hormigon`
  ADD CONSTRAINT `tbl_hormigon_ibfk_2` FOREIGN KEY (`id_unidad_medida_c`) REFERENCES `tbl_unidad_medida_c` (`id_unidad_medida_c`) ON DELETE NO ACTION,
  ADD CONSTRAINT `tbl_hormigon_ibfk_3` FOREIGN KEY (`id_unidad_medida_r`) REFERENCES `tbl_unidad_medida_r` (`id_unidad_medida_r`) ON DELETE NO ACTION,
  ADD CONSTRAINT `tbl_hormigon_ibfk_4` FOREIGN KEY (`id_procedencia_obra`) REFERENCES `tbl_procedencia_obra` (`id_procedencia_obra`) ON DELETE NO ACTION,
  ADD CONSTRAINT `tbl_hormigon_ibfk_5` FOREIGN KEY (`id_textura`) REFERENCES `TBL_Textura` (`id_textura`) ON DELETE NO ACTION,
  ADD CONSTRAINT `tbl_hormigon_ibfk_6` FOREIGN KEY (`id_aspecto`) REFERENCES `TBL_Aspecto` (`tbl_aspecto`) ON DELETE NO ACTION;

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
