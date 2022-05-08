-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2021 a las 05:16:05
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `farmaciasistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` int(50) DEFAULT NULL,
  `edad` date NOT NULL,
  `telefono` int(45) DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `adicional` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellidos`, `dni`, `edad`, `telefono`, `correo`, `sexo`, `adicional`, `avatar`, `estado`) VALUES
(1, 'Diego Martin', 'Trinidad', 24556789, '1975-01-25', 1144785268, 'diegotrinidad@gmail.com', 'Masculino', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `det_cantidad` int(11) NOT NULL,
  `det_vencimiento` date NOT NULL,
  `id__det_lote` int(11) NOT NULL,
  `id__det_prod` int(11) NOT NULL,
  `lote_id_prov` int(255) NOT NULL,
  `id_det_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `det_cantidad`, `det_vencimiento`, `id__det_lote`, `id__det_prod`, `lote_id_prov`, `id_det_venta`) VALUES
(1, 35, '2020-10-26', 11, 1, 7, 7),
(2, 5, '2020-10-26', 11, 1, 7, 8),
(3, 0, '2020-10-26', 10, 4, 1, 9),
(4, 0, '2020-10-27', 9, 4, 1, 9),
(5, 3, '2020-10-30', 7, 4, 2, 9),
(6, 0, '2020-10-26', 14, 12, 1, 10),
(7, 0, '2020-10-29', 13, 12, 1, 10),
(8, 3, '2020-11-02', 15, 12, 1, 10),
(9, 10, '2020-10-26', 16, 5, 2, 11),
(10, 15, '2020-10-29', 17, 5, 1, 11),
(11, 3, '2020-11-02', 18, 5, 1, 11),
(12, 5, '2020-12-26', 19, 2, 3, 12),
(26, 2, '2020-12-26', 19, 2, 3, 20),
(27, 2, '2020-11-02', 18, 5, 1, 20),
(28, 3, '2020-12-27', 20, 5, 7, 20),
(29, 3, '2021-05-27', 23, 9, 2, 22),
(30, 2, '2021-04-27', 24, 10, 1, 22),
(31, 10, '2021-04-27', 25, 11, 3, 23),
(32, 5, '2021-05-27', 21, 7, 7, 24),
(33, 6, '2020-12-27', 20, 5, 7, 25),
(34, 2, '2021-05-27', 23, 9, 2, 25),
(35, 4, '2021-07-27', 26, 13, 1, 25),
(36, 3, '2021-05-27', 23, 9, 2, 26),
(37, 5, '2021-04-27', 24, 10, 1, 26),
(38, 1, '2020-12-27', 20, 5, 7, 26),
(39, 5, '2020-12-26', 19, 2, 3, 27),
(40, 1, '2020-12-27', 20, 5, 7, 27),
(41, 3, '2021-05-27', 21, 7, 7, 27),
(42, 1, '2021-04-27', 25, 11, 3, 28),
(43, 1, '2021-07-27', 26, 13, 1, 28),
(44, 2, '2021-05-27', 23, 9, 2, 29),
(45, 3, '2021-05-27', 21, 7, 7, 30),
(46, 3, '2020-12-27', 20, 5, 7, 31),
(47, 3, '2021-05-27', 21, 7, 7, 31),
(48, 5, '2021-04-27', 22, 4, 1, 31),
(49, 5, '2021-07-27', 26, 13, 1, 32),
(50, 10, '2020-12-26', 19, 2, 3, 33),
(51, 10, '2020-12-27', 20, 5, 7, 33),
(52, 1, '2021-05-27', 23, 9, 2, 34),
(53, 2, '2020-12-26', 19, 2, 3, 35),
(54, 5, '2020-12-27', 20, 5, 7, 35),
(55, 2, '2021-05-27', 23, 9, 2, 35),
(56, 2, '2021-04-27', 25, 11, 3, 35),
(57, 5, '2021-07-27', 26, 13, 1, 35),
(58, 1, '2021-05-27', 23, 9, 2, 36),
(59, 1, '2021-04-27', 24, 10, 1, 36),
(60, 1, '2021-07-27', 26, 13, 1, 37),
(61, 1, '2021-04-27', 25, 11, 3, 37),
(62, 4, '2021-05-27', 21, 7, 7, 38),
(63, 4, '2021-04-27', 24, 10, 1, 38),
(64, 3, '2021-04-27', 25, 11, 3, 38),
(65, 5, '2021-07-27', 26, 13, 1, 39),
(66, 5, '2021-07-27', 26, 13, 1, 40),
(67, 10, '2021-04-27', 24, 10, 1, 41),
(68, 5, '2021-05-27', 21, 7, 7, 42),
(70, 5, '2021-05-27', 21, 7, 7, 44),
(71, 1, '2021-05-27', 21, 7, 7, 45),
(72, 5, '2021-04-27', 22, 4, 1, 46),
(73, 1, '2021-04-27', 25, 11, 3, 47),
(74, 1, '2021-07-27', 26, 13, 1, 48),
(75, 1, '2021-05-27', 21, 7, 7, 49),
(76, 1, '2021-04-27', 22, 4, 1, 50),
(77, 1, '2020-12-27', 20, 5, 7, 51),
(78, 1, '2021-05-27', 23, 9, 2, 51),
(79, 1, '2021-04-27', 25, 11, 3, 52),
(80, 2, '2021-07-27', 26, 13, 1, 52),
(81, 1, '2021-04-27', 22, 4, 1, 53),
(82, 1, '2021-05-27', 23, 9, 2, 53),
(83, 1, '2021-09-28', 28, 18, 1, 54),
(84, 1, '2021-10-28', 27, 19, 7, 54),
(85, 1, '2021-10-28', 29, 20, 1, 54),
(86, 1, '2021-10-28', 30, 21, 1, 54),
(87, 1, '2021-10-28', 31, 22, 2, 54),
(88, 1, '2021-10-28', 32, 23, 1, 54),
(89, 1, '2021-10-28', 34, 24, 1, 54),
(90, 1, '2021-10-28', 35, 25, 1, 54),
(91, 10, '2020-11-06', 33, 3, 1, 55),
(92, 1, '2021-04-27', 22, 4, 1, 56),
(93, 1, '2021-05-27', 21, 7, 7, 57),
(94, 1, '2021-04-27', 25, 11, 3, 58),
(95, 10, '2021-07-27', 26, 13, 1, 59),
(96, 9, '2021-05-27', 21, 7, 7, 60),
(97, 9, '2021-10-28', 30, 21, 1, 61),
(98, 1, '2020-12-27', 20, 5, 7, 62),
(99, 1, '2021-04-27', 22, 4, 1, 62),
(100, 1, '2021-10-28', 35, 25, 1, 63),
(101, 1, '2021-05-27', 21, 7, 7, 64),
(102, 5, '2021-10-28', 31, 22, 2, 65),
(103, 5, '2021-10-28', 32, 23, 1, 65),
(104, 5, '2021-10-28', 34, 24, 1, 65),
(105, 5, '2021-10-28', 35, 25, 1, 65),
(106, 1, '2021-10-28', 31, 22, 2, 66),
(107, 1, '2021-10-28', 32, 23, 1, 66),
(108, 1, '2021-10-28', 34, 24, 1, 66),
(109, 1, '2021-10-28', 35, 25, 1, 66),
(110, 1, '2021-10-28', 31, 22, 2, 67),
(111, 1, '2021-10-28', 32, 23, 1, 67),
(112, 1, '2021-10-28', 34, 24, 1, 67),
(113, 1, '2021-10-28', 35, 25, 1, 67),
(114, 6, '2020-12-26', 19, 2, 3, 68);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `nombre`, `avatar`, `estado`) VALUES
(1, 'Portugal', 'lab_default.png', 'A'),
(2, 'Novartis', 'lab_default.png', 'A'),
(3, 'Bayer S.A.', '5f80db167b6e2-Bayer.png', 'A'),
(4, 'Roemmers', '5f80df56336b1-laboratorio-roemmers.jpg', 'A'),
(5, 'Abbott', '5f80e19b6801a-Abbott.png', 'A'),
(6, 'Biotenk', 'lab_default.png', 'A'),
(7, 'DroFAr', 'lab_default.png', 'A'),
(8, 'Eli Lilly Interamérica Inc. ', 'lab_default.png', 'A'),
(9, 'Elisium S.A.', 'lab_default.png', 'A'),
(10, 'Omega', '5f80e1e8e3938-Omega.png', 'A'),
(11, 'Eurolab', 'lab_default.png', 'A'),
(12, 'Gador S.A.', 'lab_default.png', 'A'),
(13, 'GlaxoSmithKline', 'lab_default.png', 'A'),
(14, 'Laboratorios Andrómaco S.A.I.C.I.', 'lab_default.png', 'A'),
(15, 'Laboratorios Bagó S.A.', 'lab_default.png', 'A'),
(16, 'Laboratorios Bernabó S.A.', 'lab_default.png', 'A'),
(17, 'Laboratorios CRAVERI', 'lab_default.png', 'A'),
(18, 'Laboratorio Elea', 'lab_default.png', 'A'),
(19, 'Laboratorios Felipe Bajer', 'lab_default.png', 'A'),
(20, 'Laboratorios Lafedar', 'lab_default.png', 'A'),
(21, 'Laboratorio Nutrilab', 'lab_default.png', 'A'),
(22, 'Laboratorios Oriental Farmacéutica', 'lab_default.png', 'A'),
(23, 'LABORATORIO VARIFARMA S.A.', 'lab_default.png', 'A'),
(24, 'Merck Química Argentina S.A.I.C.', 'lab_default.png', 'A'),
(25, 'Novartis Argentina S.A.', 'lab_default.png', 'A'),
(26, 'Pfizer', '60032e518c968-Pfizer.jpg', 'A'),
(27, 'Productos Roche S.A.Q.e I.', '60032ef90c3b9-Roche.jpg', 'A'),
(28, 'Rigecin', 'lab_dafault.png', 'A'),
(29, 'Sanofi-aventis', 'lab_dafault.png', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `lote_id_prod` int(11) NOT NULL,
  `lote_id_prov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `stock`, `vencimiento`, `lote_id_prod`, `lote_id_prov`) VALUES
(20, 9, '2020-12-27', 5, 7),
(21, 9, '2021-05-27', 7, 7),
(22, 36, '2021-04-27', 4, 1),
(23, 34, '2021-05-27', 9, 2),
(24, 28, '2021-04-27', 10, 1),
(25, 30, '2021-04-27', 11, 3),
(26, 11, '2021-07-27', 13, 1),
(27, 99, '2021-10-28', 19, 7),
(28, 99, '2021-09-28', 18, 1),
(29, 99, '2021-10-28', 20, 1),
(30, 90, '2021-10-28', 21, 1),
(31, 92, '2021-10-28', 22, 2),
(32, 92, '2021-10-28', 23, 1),
(34, 92, '2021-10-28', 24, 1),
(35, 91, '2021-10-28', 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre`, `estado`) VALUES
(1, 'Ampolla', 'A'),
(3, 'Crema', 'A'),
(4, 'Aerosol', 'A'),
(5, 'Anillo', 'A'),
(6, 'Champu', 'A'),
(7, 'Emulsion', 'A'),
(8, 'Enema', 'A'),
(9, 'Capsula', 'A'),
(10, 'Comprimidos', 'A'),
(11, 'Inyectable', 'A'),
(12, 'Suspensión', 'A'),
(13, 'Sobres Efervescentes ', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `concentracion` varchar(255) DEFAULT NULL,
  `adicional` varchar(255) DEFAULT NULL,
  `precio` float NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  `prod_lab` int(11) NOT NULL,
  `prod_tip_prod` int(11) NOT NULL,
  `prod_present` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `concentracion`, `adicional`, `precio`, `avatar`, `estado`, `prod_lab`, `prod_tip_prod`, `prod_present`) VALUES
(1, 'AMOXIDAL DÚO - AMOXICILINA', '750 mg. / 5 ml.', 'Vía oral  x 120', 769.5, '5f87b505b20a8-amoxidal duo 750 suspx120.jpg', 'A', 4, 3, 12),
(2, 'AMOXICILINA', '500 mg.', 'Caja Env. Blister  Caps.', 10, '5f8386582298e-amoxicilina2.jpg', 'A', 28, 2, 9),
(3, 'AMOXICILINA', '500 mg.', 'Caja Envase ', 250, 'prod_default.png', 'A', 26, 3, 4),
(4, 'AMOXIDAL 500 - AMOXICILINA', '500 mg.', 'Via Oral - 16 comp.', 120.6, '5f838dfe57289-amixicilina.jpg', 'A', 4, 3, 10),
(5, 'AMOXIDAL 1g. - AMOXICILINA', '1000 mg.', 'Via Oral - x16', 524.7, '5f838ac5c87b4-Amoxidal1g..jpg', 'A', 4, 3, 10),
(6, 'AMOXIDAL 1000 - AMOXICILINA', '1000 mg.', 'Vía intramuscular', 540.6, 'prod_default.png', 'A', 4, 3, 11),
(7, 'AMOXIDAL 250 - AMOXICILINA', '250 mg.', 'Vía oral  ped. x 90', 160.5, '5f838faa0096c-Amoxidal250x60.jpg', 'A', 4, 3, 12),
(8, 'AMOXIDAL 500 - AMOXICILINA', '500 mg.', 'Via Oral - x 21', 135, 'prod_default.png', 'A', 4, 3, 10),
(9, 'AMOXIDAL 500 - AMOXICILINA', '500 mg.', 'Vía oral ped. x 90', 230.8, '5f8393250d1b7-Amoxicilina 500 suspension 90.jpg', 'A', 4, 3, 12),
(10, 'AMOXIDAL 500 - AMOXICILINA', '500 mg.', 'Vía oral ped. x 120', 675.8, '5f8394507e4ba-Amoxidal 500 suspension x120.jpg', 'A', 5, 3, 12),
(11, 'AMOXIDAL DÚO - AMOXICILINA', '875 mg.', 'Vía oral - 875 mg x 14', 167.2, '5f83ac644f87d-Amxidal Duo_875mg_x_14.png', 'A', 4, 3, 10),
(12, 'AMOXIDAL RESP. DÚO - AMOXICILINA', '750 mg. / 15 mg.', 'Vía oral x70', 360, '5f87b8dd9ca1c-amoxidal respiratorio duo suspx70.jpg', 'A', 4, 3, 12),
(13, 'AMOXIDAL RESP. DÚO - AMOXICILINA', '875 mg. / 60 mg.', 'Vía oral Comp. x 14', 150, '5f87b779ed242-amoxidal Respiratorio Dúox14.png', 'A', 4, 3, 10),
(17, 'AMOXIDAL DÚO - AMOXICILINA', '750 mg. / 5 ml.', 'Vía oral x70', 534.3, '5f87b39356a9b-amoxidal duo 750 susp.jpg', 'A', 4, 3, 12),
(18, 'BAYASPIRINA - Acetilsalicílico ácido', '500mg Comp. X 30', 'Via Oral', 161, '5f9ca4046a11f-Bayaspirina.jpg', 'A', 3, 3, 10),
(19, 'BAYASPIRINA - Acetilsalicílico ácido', '500mg Comp. X 40 -Promo', 'Via Oral', 187.83, '5f9ca6a0d196c-Bayaspirina.jpg', 'A', 3, 3, 10),
(20, 'BAYASPIRINA C CALIENTE- Acetilsalicílico ácid', 'Asp. 500 mg; Ascó.200 mg.', 'Via Oral', 760, '5f9cb451a56af-BayaspirinaC-Caliente.jpg', 'A', 3, 3, 13),
(21, 'BAYASPIRINA C LIMON- Acetilsalicílico ácido', '240 ml.', 'Via Oral x 12', 270, '5f9cb5602478d-BayaspirinaC-Limon.jpg', 'A', 5, 3, 4),
(22, 'BAYASPIRINA C LIMON- Acetilsalicílico ácido', '240 mg.', 'Via Oral x 24', 530, '5f9cb5de1a45e-BayaspirinaC-Limon.jpg', 'A', 5, 3, 4),
(23, 'BAYASPIRINA FORTE - Acetilsalicílico ácido', '650 mg .', 'Via Oral x 20', 144, '5f9cb698e1749-Bayaspirina-Forte.jpg', 'A', 5, 3, 10),
(24, 'CAFISPIRINA - Acetilsalicílico ácido', '500 mg. / 40 mg.', 'Via Oral x30', 190, '5f9cbc803a01d-Cafiaspirina.jpg', 'A', 3, 3, 10),
(25, 'CAFISPIRINA PLUS - Acetilsalicílico ácido', '500 mg. / 40 mg.', 'Via Oral - x 20', 161, '5f9cbd3f489f5-Cafiaspirina-plus.jpg', 'A', 5, 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `telefono`, `correo`, `direccion`, `avatar`, `estado`) VALUES
(1, 'Beta Medical S.R.L.', 43530054, 'ventas@betamedical.com.ar', 'Suipacha 544 - Avellaneda - Buenos Aires', '5f852544cd0d0-logo-beta-medical.png', 'A'),
(2, 'SCIENZA Argentina', 55547890, '213@gmail.com', 'Av. Juan de Garay 437 - CABA', '5f8524305cf01-SCIENZA.jpg', 'A'),
(3, 'Generia Drogueria', 44887778, '1@gmail.com', 'Pueyrredon 3881 - Ciudadela - Bs. As.', '5f85220456aa5-logo dorgueria.jpg', 'A'),
(7, 'Disprofarma', 1111, 'info@disprofarma.com.ar', 'Av. Castañares 3222 - Haedo - Buenos Aires', '5f852270860aa-disprofarma.jpg', 'A'),
(9, 'Prueva', 3333, 'pepe@gmail.com', 'ala', 'prov_default.png', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tip_prod` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tip_prod`, `nombre`, `estado`) VALUES
(2, 'Genericos', 'A'),
(3, 'Comerciales', 'A'),
(4, 'Regalos', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_us`
--

CREATE TABLE `tipo_us` (
  `id_tipo_us` int(11) NOT NULL,
  `nombre_tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_us`
--

INSERT INTO `tipo_us` (`id_tipo_us`, `nombre_tipo`) VALUES
(1, 'Administrador'),
(2, 'Tecnico'),
(3, 'Root');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_us` varchar(45) NOT NULL,
  `apellidos_us` varchar(45) NOT NULL,
  `edad` date NOT NULL,
  `dni_us` varchar(45) NOT NULL,
  `contrasena_us` varchar(255) NOT NULL,
  `telefono_us` bigint(20) DEFAULT NULL,
  `residencia_us` varchar(200) DEFAULT NULL,
  `correo_us` varchar(30) DEFAULT NULL,
  `sexo_us` varchar(25) DEFAULT NULL,
  `adicional_us` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `us_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_us`, `apellidos_us`, `edad`, `dni_us`, `contrasena_us`, `telefono_us`, `residencia_us`, `correo_us`, `sexo_us`, `adicional_us`, `avatar`, `us_tipo`) VALUES
(1, 'Pablo Martin', 'Morrone', '1971-08-14', '22362590', '$2y$10$4oPcZDr4cDRk6NZ11DNfNugGeMK2Vc8mZTJunZbECPzqLdx3V1VJq', 1138669097, 'El arreo 220 - La Reja - Bs. As.', 'morronepablo@gmail.com', 'Masculino', 'Hola que tal estamos programando', '5f7e99bb74761-5f7e971947db0-MorronePablo.jpg', 3),
(2, 'Gustavo Alfredo', 'Vessani', '1971-04-10', '22333444', '12345', 1134679098, 'Cabildo 1678 - Belgrano', 'gustavovessani@gmail.com', 'Masculino', 'Como Hermano', '5f9cc4be9fda3-GustavoVessani.jpg', 2),
(3, 'Natalia Elvira', 'Oduber Andara', '1983-12-03', '94654750', '$2y$10$ENgOFH8WxPdQmovwZJUcoeFPAuvnU3p3KXdsLgn1XO3i4iJ8nQ.qS', 1138661609, 'El Arreo 220 - La Reja - Bs. As.', 'morronepablo@gmail.com', 'Femenino', 'Esto es una prueba', '5f9dfa5dc98e8-Naty.jpg', 1),
(4, 'Octavio Juan Eduardo', 'Barva ', '1965-03-01', '11111111', '$2y$10$8mg1OZ9073USZH3p8b2GQOhBnNnM0skiUPLyCzo1w7XiLVeNrnepG', NULL, NULL, NULL, NULL, NULL, '5f98ca6d514f4-user2-160x160.jpg', 2),
(5, 'Diego Martin', 'Trinidad', '1975-05-23', '22222222', '12345', NULL, NULL, NULL, NULL, NULL, '5f98fb290e51a-user1-128x128.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `cliente` varchar(45) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `vendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha`, `cliente`, `dni`, `total`, `vendedor`) VALUES
(4, '2019-01-25 01:07:23', 'rulo', 0, 20, 3),
(7, '2019-02-25 19:41:38', 'alverto', 0, 350, 3),
(8, '2019-03-25 19:49:14', 'fernando', 0, 50, 5),
(9, '2019-04-01 20:03:56', 'eder', 0, 112, 1),
(10, '2019-05-25 20:13:00', 'terito', 0, 280, 1),
(11, '2019-06-25 20:26:09', 'churry', 0, 280, 2),
(12, '2019-07-26 00:07:52', 'Ernesto', 30445789, 250, 4),
(20, '2019-08-27 16:33:04', 'Juan Pablo', 20334567, 150, 1),
(21, '2019-09-25 19:41:38', 'alverto', 0, 350, 2),
(22, '2019-10-27 23:18:52', 'Ernesto', 0, 50, 1),
(23, '2019-11-27 23:20:02', 'juan', 0, 100, 1),
(24, '2019-12-27 23:20:30', 'norma', 0, 50, 1),
(25, '2020-01-27 23:21:40', 'lucia', 0, 120, 1),
(26, '2020-02-27 23:23:14', 'Pedro', 0, 90, 3),
(27, '2020-03-27 23:24:39', 'diego', 0, 290, 3),
(28, '2020-04-27 23:26:09', 'teresa', 0, 20, 3),
(29, '2020-05-27 23:26:57', 'beatriz', 0, 20, 3),
(30, '2020-06-27 23:27:26', 'beto', 0, 30, 3),
(31, '2020-07-27 23:28:21', 'Andrea', 0, 260, 4),
(32, '2020-08-27 23:29:24', 'Pablo', 0, 50, 4),
(33, '2020-09-27 23:33:12', 'Martin', 0, 60, 1),
(34, '2020-10-27 23:33:53', 'pepe', 0, 10, 1),
(35, '2020-10-27 23:37:19', 'sandra', 0, 10, 2),
(36, '2020-10-27 23:37:39', 'alicia', 0, 2, 2),
(37, '2020-10-27 23:38:40', 'ricardo', 0, 2, 2),
(38, '2020-10-27 23:40:02', 'Angelina', 0, 9, 1),
(39, '2020-10-27 23:42:28', 'Alfredo', 0, 5, 1),
(40, '2020-10-27 23:46:10', 'Maxi', 0, 20, 1),
(41, '2020-10-27 23:52:21', 'dario', 0, 5, 1),
(42, '2020-10-27 23:53:19', 'teresa', 0, 5, 1),
(44, '2020-10-27 23:57:16', 'churry', 0, 34, 1),
(45, '2020-10-28 00:00:45', 'Tito', 0, 12, 3),
(46, '2020-10-28 00:03:27', 'Alicia', 0, 8, 1),
(47, '2020-10-29 00:10:26', 'piter', 0, 1, 1),
(48, '2020-10-29 00:11:32', 'lalo', 0, 150, 1),
(49, '2020-10-29 00:12:40', 'piter', 0, 160.5, 1),
(50, '2020-10-30 16:21:30', 'Luis', 0, 120.6, 3),
(51, '2020-10-30 16:46:07', 'ernesto', 0, 755.5, 3),
(52, '2020-10-30 16:48:29', 'pedro', 0, 467.2, 1),
(53, '2020-10-30 20:13:23', 'Ricardo', 0, 351.4, 2),
(54, '2020-10-31 19:54:41', 'Leandro', 0, 2403.83, 1),
(55, '2020-11-10 16:18:29', 'Ernesto', 0, 2500, 1),
(56, '2020-11-10 16:20:22', 'Alicia', 0, 120.6, 3),
(57, '2020-11-10 16:22:52', 'Ricardo', 0, 160.5, 4),
(58, '2020-11-10 16:24:31', 'Pedro', 0, 167.2, 2),
(59, '2020-11-10 16:26:47', 'Pepe', 0, 1500, 3),
(60, '2020-11-10 16:27:36', 'David', 0, 1444.5, 4),
(61, '2020-11-10 16:28:20', 'Zulma', 0, 2430, 2),
(62, '2020-11-10 16:30:09', 'Zulma', 0, 645.3, 3),
(63, '2020-11-10 16:30:43', 'Alfredo', 0, 161, 1),
(64, '2020-11-10 16:32:32', 'Sandra', 0, 160.5, 3),
(65, '2020-11-20 19:26:31', 'BETO', 0, 5125, 1),
(66, '2020-11-20 19:28:09', 'alicia', 0, 1025, 3),
(67, '2020-11-20 19:29:27', 'Silvio', 0, 1025, 2),
(68, '2021-01-11 17:28:01', 'Fernando', 0, 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_ventaproducto` int(11) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `venta_id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id_ventaproducto`, `precio`, `cantidad`, `subtotal`, `producto_id_producto`, `venta_id_venta`) VALUES
(2, 1, 2, 2, 7, 4),
(3, 1, 35, 35, 1, 7),
(4, 1, 5, 5, 1, 8),
(5, 4, 28, 112, 4, 9),
(6, 1, 28, 28, 12, 10),
(7, 1, 28, 28, 5, 11),
(8, 5, 5, 25, 2, 12),
(22, 5, 2, 10, 2, 20),
(23, 1, 5, 5, 5, 20),
(24, 1, 3, 3, 9, 22),
(25, 1, 2, 2, 10, 22),
(26, 1, 10, 10, 11, 23),
(27, 1, 5, 5, 7, 24),
(28, 1, 6, 6, 5, 25),
(29, 1, 2, 2, 9, 25),
(30, 1, 4, 4, 13, 25),
(31, 1, 3, 3, 9, 26),
(32, 1, 5, 5, 10, 26),
(33, 1, 1, 1, 5, 26),
(34, 1, 5, 25, 2, 27),
(35, 1, 1, 1, 5, 27),
(36, 1, 3, 3, 7, 27),
(37, 1, 1, 1, 11, 28),
(38, 1, 1, 1, 13, 28),
(39, 1, 2, 2, 9, 29),
(40, 1, 3, 3, 7, 30),
(41, 1, 3, 3, 5, 31),
(42, 1, 3, 3, 7, 31),
(43, 4, 5, 20, 4, 31),
(44, 1, 5, 5, 13, 32),
(45, 5, 10, 50, 2, 33),
(46, 1, 10, 10, 5, 33),
(47, 1, 1, 1, 9, 34),
(48, 5, 2, 10, 2, 35),
(49, 1, 5, 5, 5, 35),
(50, 1, 2, 2, 9, 35),
(51, 1, 2, 2, 11, 35),
(52, 1, 5, 5, 13, 35),
(53, 1, 1, 1, 9, 36),
(54, 1, 1, 1, 10, 36),
(55, 1, 1, 1, 13, 37),
(56, 1, 1, 1, 11, 37),
(57, 1, 4, 4, 7, 38),
(58, 1, 4, 4, 10, 38),
(59, 1, 3, 3, 11, 38),
(60, 1, 5, 5, 13, 39),
(61, 150, 5, 750, 13, 40),
(62, 1, 10, 10, 10, 41),
(63, 1, 5, 5, 7, 42),
(65, 160.5, 5, 802.5, 7, 44),
(66, 160.5, 1, 160.5, 7, 45),
(67, 4, 5, 20, 4, 46),
(68, 1, 1, 1, 11, 47),
(69, 150, 1, 150, 13, 48),
(70, 160.5, 1, 160.5, 7, 49),
(71, 120.5, 1, 120.6, 4, 50),
(72, 524.7, 1, 524.7, 5, 51),
(73, 230.8, 1, 230.8, 9, 51),
(74, 167.2, 1, 167.2, 11, 52),
(75, 150, 2, 300, 13, 52),
(76, 120.6, 1, 120.6, 4, 53),
(77, 230.8, 1, 230.8, 9, 53),
(78, 161, 1, 161, 18, 54),
(79, 187.83, 1, 187.83, 19, 54),
(80, 760, 1, 760, 20, 54),
(81, 270, 1, 270, 21, 54),
(82, 530, 1, 530, 22, 54),
(83, 144, 1, 144, 23, 54),
(84, 190, 1, 190, 24, 54),
(85, 161, 1, 161, 25, 54),
(86, 250, 10, 2500, 3, 55),
(87, 120.6, 1, 120.6, 4, 56),
(88, 160.5, 1, 160.5, 7, 57),
(89, 167.2, 1, 167.2, 11, 58),
(90, 150, 10, 1500, 13, 59),
(91, 160.5, 9, 1444.5, 7, 60),
(92, 405, 9, 2430, 21, 61),
(93, 524.7, 1, 524.7, 5, 62),
(94, 120.6, 1, 120.6, 4, 62),
(95, 161, 1, 161, 25, 63),
(96, 160.5, 1, 160.5, 7, 64),
(97, 530, 5, 2650, 22, 65),
(98, 144, 5, 720, 23, 65),
(99, 190, 5, 950, 24, 65),
(100, 161, 5, 805, 25, 65),
(101, 530, 1, 530, 22, 66),
(102, 144, 1, 144, 23, 66),
(103, 190, 1, 190, 24, 66),
(104, 161, 1, 161, 25, 66),
(105, 530, 1, 530, 22, 67),
(106, 144, 1, 144, 23, 67),
(107, 190, 1, 190, 24, 67),
(108, 161, 1, 161, 25, 67),
(109, 5, 6, 30, 2, 68);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_det_venta_idx` (`id_det_venta`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `lote_id_prod_idx` (`lote_id_prod`),
  ADD KEY `lote_id_prov_idx` (`lote_id_prov`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id_presentacion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `prod_lab_idx` (`prod_lab`),
  ADD KEY `prod_tip_prod_idx` (`prod_tip_prod`),
  ADD KEY `prod_present_idx` (`prod_present`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tip_prod`);

--
-- Indices de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  ADD PRIMARY KEY (`id_tipo_us`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `us_tipo_idx` (`us_tipo`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `vendedor` (`vendedor`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id_ventaproducto`),
  ADD KEY `fk_venta_has_producto_producto1_idx` (`producto_id_producto`),
  ADD KEY `fk_venta_has_producto_venta1_idx` (`venta_id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tip_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  MODIFY `id_tipo_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id_ventaproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `id_det_venta` FOREIGN KEY (`id_det_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_id_prod` FOREIGN KEY (`lote_id_prod`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `lote_id_prov` FOREIGN KEY (`lote_id_prov`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `prod_lab` FOREIGN KEY (`prod_lab`) REFERENCES `laboratorio` (`id_laboratorio`),
  ADD CONSTRAINT `prod_present` FOREIGN KEY (`prod_present`) REFERENCES `presentacion` (`id_presentacion`),
  ADD CONSTRAINT `prod_tip_prod` FOREIGN KEY (`prod_tip_prod`) REFERENCES `tipo_producto` (`id_tip_prod`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `us_tipo` FOREIGN KEY (`us_tipo`) REFERENCES `tipo_us` (`id_tipo_us`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `fk_venta_has_producto_producto1` FOREIGN KEY (`producto_id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `fk_venta_has_producto_venta1` FOREIGN KEY (`venta_id_venta`) REFERENCES `venta` (`id_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
