-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2021 a las 09:03:59
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
(1, 'Diego Martin', 'Trinidad', 24556789, '1975-01-25', 1144785268, 'diegotrinidad@gmail.com', 'Masculino', 'null', NULL, 'A'),
(2, 'Pedro', 'Galindez', 24876445, '0000-00-00', 1144189384, 'galindezpedro@gmail.com', 'Masculino', 'ya no nuevo. jaja', 'avatar.png', 'A'),
(3, 'Walter Fernando', 'Trinidad', 22187456, '0000-00-00', 1134881243, 'trinidadwalter@gmail.com', 'Masculino', 'nuevo usuario', 'avatar.png', 'A'),
(4, 'Natalia Elvira', 'Oduber Andara', 94654750, '0000-00-00', 1138661609, 'nataliaoduber@gmail.com', 'Femenino', 'usuario nuevo', 'avatar.png', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `total` float NOT NULL,
  `id_estado_pago` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `codigo`, `fecha_compra`, `fecha_entrega`, `total`, `id_estado_pago`, `id_proveedor`) VALUES
(1, '10001', '2021-03-26', '2021-03-27', 3000, 1, 1),
(2, '10005', '2021-04-02', '2021-04-03', 10000, 1, 3),
(3, '10005', '2021-04-05', '2021-04-06', 34842, 1, 2),
(4, '10006', '2021-04-05', '2021-04-06', 9450, 1, 7),
(5, '10006', '2021-04-06', '2021-04-07', 8442, 1, 1),
(6, '10007', '2021-04-06', '2021-04-07', 8442, 1, 3),
(7, '10007', '2021-04-18', '2021-04-19', 5000, 1, 3),
(8, '10008', '2021-04-28', '2021-04-28', 3000, 1, 7),
(9, '10009', '2021-04-28', '2021-04-29', 1000, 1, 1),
(10, '1009', '2021-06-27', '2021-06-28', 30000, 1, 7);

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
(1, 10, '2021-03-27', 3, 5, 1, 1),
(2, 1, '2021-04-13', 2, 5, 1, 1),
(3, 10, '2021-10-02', 4, 7, 3, 2),
(4, 10, '2021-10-05', 5, 6, 2, 3),
(5, 10, '2021-10-05', 6, 8, 7, 3),
(6, 5, '2021-10-05', 5, 6, 2, 4),
(7, 5, '2021-10-02', 4, 7, 3, 4),
(8, 5, '2021-10-05', 6, 8, 7, 4),
(9, 5, '2021-10-05', 5, 6, 2, 5),
(10, 4, '2021-10-02', 4, 7, 3, 6),
(11, 3, '2021-10-05', 6, 8, 7, 6),
(12, 20, '2021-11-06', 7, 9, 1, 7),
(13, 10, '2022-04-30', 8, 4, 3, 8),
(14, 5, '2021-10-05', 5, 6, 2, 9),
(15, 5, '2021-04-13', 2, 5, 1, 9),
(16, 5, '2021-10-02', 4, 7, 3, 9),
(17, 5, '2021-11-06', 7, 9, 1, 9),
(18, 5, '2022-04-30', 8, 4, 3, 9),
(19, 5, '2021-10-05', 6, 8, 7, 9),
(20, 5, '2022-04-30', 8, 4, 3, 10),
(23, 10, '2021-04-28', 10, 6, 7, 13),
(24, 10, '2021-04-29', 11, 7, 1, 14),
(25, 76, '2021-10-02', 4, 7, 3, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pago`
--

CREATE TABLE `estado_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_pago`
--

INSERT INTO `estado_pago` (`id`, `nombre`) VALUES
(1, 'Cancelado'),
(2, 'No cancelado');

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
(29, 'Sanofi-aventis', '607c729e8d6b5-Sanofi.png', 'A'),
(30, 'Isa', '607c705746bc8-ISA.png', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_lote` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `precio_compra` float NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id`, `codigo`, `cantidad`, `cantidad_lote`, `vencimiento`, `precio_compra`, `estado`, `id_compra`, `id_producto`) VALUES
(1, '9999', 20, 0, '2021-04-28', 100, 'I', 1, 5),
(2, '9998', 14, 0, '2021-04-13', 100, 'I', 1, 5),
(3, '9997', 10, 0, '2021-03-27', 100, 'I', 1, 5),
(4, '9995', 100, 0, '2021-10-02', 100, 'I', 2, 7),
(5, '9997', 100, 75, '2021-10-05', 348.42, 'A', 3, 6),
(6, '9996', 100, 77, '2021-10-05', 94.5, 'A', 4, 8),
(7, '9994', 100, 75, '2021-11-06', 84.42, 'A', 5, 9),
(8, '9993', 103, 77, '2022-04-30', 84.42, 'A', 6, 4),
(9, '9990', 105, 95, '2022-04-18', 50, 'A', 7, 26),
(10, '9990', 10, 0, '2021-04-28', 300, 'I', 8, 6),
(11, '9989', 10, 0, '2021-04-29', 100, 'I', 9, 7),
(12, '9100', 50, 50, '2022-06-27', 600, 'A', 10, 5);

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
(7, 'AMOXIDAL 250 - AMOXICILINA', '250 mg.', 'Vía oral  ped. x 90', 170, '5f838faa0096c-Amoxidal250x60.jpg', 'A', 4, 3, 12),
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
(25, 'CAFISPIRINA PLUS - Acetilsalicílico ácido', '500 mg. / 40 mg.', 'Via Oral - x 20', 161, '5f9cbd3f489f5-Cafiaspirina-plus.jpg', 'A', 5, 3, 4),
(26, 'ISASPIRINA  PREVNTIVA  - ASPININA', '100 mg.', 'Antiagregante Plaquetario X 60 comp.', 84.5, '607c7169dcaed-Isaspirina.png', 'A', 30, 2, 10);

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
(9, 'Droguería Nueva Era', 2147483647, 'comercial2@droguerianuevaera.com.ar', 'Corvalan 554, Rosario, Santa Fe ', 'prov_default.png', 'A');

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
(3, 'Natalia Elvira', 'Oduber Andara', '1983-12-03', '94654750', '$2y$10$Z7qdIVlBZ02fGYMllLE8/uJ/cSeOaad4QGhIjfF4HDFFemESdQKFa', 1138661609, 'El Arreo 220 - La Reja - Bs. As.', 'morronepablo@gmail.com', 'Femenino', 'Esto es una prueba', '5f9dfa5dc98e8-Naty.jpg', 1),
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
  `vendedor` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha`, `cliente`, `dni`, `total`, `vendedor`, `id_cliente`) VALUES
(1, '2021-03-27 15:13:38', NULL, NULL, 5771.7, 1, 4),
(2, '2021-04-02 18:18:04', NULL, NULL, 1700, 1, 3),
(3, '2021-04-05 22:26:02', NULL, NULL, 6756, 1, 3),
(4, '2021-04-05 22:28:22', NULL, NULL, 4228, 3, 2),
(5, '2021-04-05 23:31:44', NULL, NULL, 2703, 2, 3),
(6, '2021-04-05 23:36:36', NULL, NULL, 1085, 1, 4),
(7, '2021-04-06 12:33:03', NULL, NULL, 4616, 2, 4),
(8, '2021-04-06 12:41:37', NULL, NULL, 1206, 3, 2),
(9, '2021-04-09 16:25:09', NULL, NULL, 8608.5, 1, 1),
(10, '2021-04-09 16:27:57', NULL, NULL, 603, 2, 4),
(13, '2021-04-28 17:05:55', NULL, NULL, 5406, 1, 4),
(14, '2021-04-28 17:06:20', NULL, NULL, 1700, 1, 2),
(15, '2021-06-27 16:08:29', NULL, NULL, 12920, 1, 2);

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
(1, 524.7, 11, 5771.7, 5, 1),
(2, 170, 10, 1700, 7, 2),
(3, 540.6, 10, 5406, 6, 3),
(4, 135, 10, 1350, 8, 3),
(5, 540.6, 5, 2703, 6, 4),
(6, 170, 5, 850, 7, 4),
(7, 135, 5, 675, 8, 4),
(8, 540.6, 5, 2703, 6, 5),
(9, 170, 4, 680, 7, 6),
(10, 135, 3, 405, 8, 6),
(11, 230.8, 20, 4616, 9, 7),
(12, 120.6, 10, 1206, 4, 8),
(13, 540.6, 5, 2703, 6, 9),
(14, 524.7, 5, 2623.5, 5, 9),
(15, 170, 5, 850, 7, 9),
(16, 230.8, 5, 1154, 9, 9),
(17, 120.6, 5, 603, 4, 9),
(18, 135, 5, 675, 8, 9),
(19, 120.6, 5, 603, 4, 10),
(22, 540.6, 10, 5406, 6, 13),
(23, 170, 10, 1700, 7, 14),
(24, 170, 76, 12920, 7, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado_pago` (`id_estado_pago`,`id_proveedor`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_det_venta_idx` (`id_det_venta`);

--
-- Indices de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

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
  ADD KEY `vendedor` (`vendedor`),
  ADD KEY `id_cliente` (`id_cliente`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id_ventaproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_estado_pago`) REFERENCES `estado_pago` (`id`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `id_det_venta` FOREIGN KEY (`id_det_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`),
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

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
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

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
