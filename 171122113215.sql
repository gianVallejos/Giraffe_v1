-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2017 a las 17:32:10
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `giraffe`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarVentaDetalle` (IN `ID_PRODUCTO` INT, IN `ID_VENTA` INT)  BEGIN
		INSERT INTO detalleVenta(idProducto, idVenta) VALUES (ID_PRODUCTO, ID_VENTA);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarVentaGeneral` (IN `ID_TIPO` INT, IN `ID_VENDEDOR` INT)  BEGIN		
	INSERT INTO venta(fechahora, tipo, idVendedor) VALUES (NOW(), ID_TIPO, ID_VENDEDOR);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLastVenta` ()  BEGIN
	SELECT id AS NRO_PRESUPUESTO FROM venta ORDER BY id DESC LIMIT 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombres` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `genero` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `dni`, `email`, `direccion`, `fechanacimiento`, `genero`, `telefono`, `celular`, `updated_at`, `created_at`) VALUES
(1, 'Martín', 'Suárez Barrueto', '87654321', 'admin@suarez.com', 'Av. Independencia N° 900', '1990-11-20', 'Masculino', '076 654321', '987654321', '2017-11-22 20:49:36', '2017-11-15 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `id` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idVenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`id`, `idProducto`, `idVenta`) VALUES
(1, 5, 1),
(2, 4, 1),
(3, 4, 1),
(4, 2, 1),
(5, 4, 2),
(6, 6, 2),
(7, 6, 2),
(8, 3, 3),
(9, 4, 3),
(10, 4, 3),
(11, 3, 3),
(12, 6, 4),
(13, 6, 4),
(14, 1, 4),
(15, 1, 4),
(16, 2, 4),
(17, 6, 5),
(18, 6, 5),
(19, 5, 6),
(20, 5, 6),
(21, 4, 6),
(22, 6, 7),
(23, 6, 7),
(24, 6, 7),
(25, 3, 8),
(26, 4, 8),
(27, 2, 9),
(28, 2, 9),
(29, 4, 9),
(30, 7, 10),
(31, 7, 10),
(32, 7, 10),
(33, 8, 10),
(34, 5, 11),
(35, 5, 11),
(36, 4, 11),
(37, 4, 11),
(38, 4, 12),
(39, 4, 12),
(40, 5, 12),
(41, 8, 12),
(42, 8, 12),
(43, 6, 12),
(44, 6, 12),
(45, 6, 12),
(46, 4, 13),
(47, 4, 13),
(48, 3, 13),
(49, 3, 13),
(50, 7, 13),
(51, 7, 13),
(52, 8, 13),
(53, 4, 14),
(54, 4, 14),
(55, 4, 14),
(56, 4, 14),
(57, 4, 14),
(58, 4, 14),
(59, 4, 14),
(60, 4, 14),
(61, 4, 14),
(62, 4, 14),
(63, 4, 14),
(64, 4, 14),
(65, 3, 14),
(66, 2, 14),
(67, 1, 14),
(68, 1, 14),
(69, 1, 14),
(70, 4, 15),
(71, 5, 15),
(72, 5, 15),
(73, 4, 16),
(74, 4, 16),
(75, 4, 16),
(76, 4, 16),
(77, 4, 16),
(78, 4, 16),
(79, 4, 16),
(80, 4, 16),
(81, 4, 16),
(82, 4, 16),
(83, 4, 16),
(84, 4, 16),
(85, 4, 16),
(86, 4, 16),
(87, 4, 16),
(88, 4, 16),
(89, 4, 16),
(90, 4, 16),
(91, 4, 16),
(92, 4, 16),
(93, 4, 16),
(94, 4, 16),
(95, 4, 16),
(96, 4, 16),
(97, 4, 16),
(98, 4, 17),
(99, 5, 17),
(100, 5, 17),
(101, 2, 17),
(102, 3, 18),
(103, 2, 18),
(104, 2, 18),
(105, 2, 19),
(106, 2, 19),
(107, 3, 19),
(108, 3, 19),
(109, 3, 20),
(110, 3, 20),
(111, 3, 20),
(112, 4, 20),
(113, 5, 21),
(114, 3, 21),
(115, 3, 21),
(116, 3, 21),
(117, 4, 21),
(118, 5, 22),
(119, 3, 23),
(120, 4, 24),
(121, 3, 25),
(122, 3, 26),
(123, 4, 27),
(124, 3, 28),
(125, 4, 29),
(126, 3, 30),
(127, 3, 30),
(128, 3, 31),
(129, 3, 31),
(130, 3, 32),
(131, 4, 33),
(132, 4, 33),
(133, 3, 33),
(134, 3, 33),
(135, 2, 33),
(136, 2, 33),
(137, 3, 33),
(138, 3, 33),
(139, 3, 33),
(140, 3, 33),
(141, 3, 33),
(142, 4, 33),
(143, 5, 34),
(144, 7, 35),
(145, 4, 36),
(146, 3, 36),
(147, 3, 37),
(148, 1, 37),
(149, 2, 37),
(150, 3, 38),
(151, 4, 38),
(152, 7, 38),
(153, 4, 39),
(154, 2, 39),
(155, 3, 39),
(156, 1, 39),
(157, 4, 40),
(158, 2, 40),
(159, 1, 40),
(160, 4, 41),
(161, 2, 41),
(162, 3, 41),
(163, 1, 41),
(164, 2, 42),
(165, 3, 42),
(166, 4, 42),
(167, 1, 42),
(168, 7, 42),
(169, 8, 42),
(170, 4, 43),
(171, 7, 43),
(172, 1, 43),
(173, 2, 43),
(174, 5, 44),
(175, 4, 44),
(176, 1, 44),
(177, 2, 44),
(178, 2, 45),
(179, 1, 45),
(180, 4, 45),
(181, 4, 46),
(182, 3, 46),
(183, 4, 47),
(184, 5, 47),
(185, 8, 47),
(186, 4, 48),
(187, 3, 48),
(188, 2, 48),
(189, 1, 48),
(190, 7, 48),
(191, 2, 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(6,2) NOT NULL,
  `stock` int(11) DEFAULT '0',
  `medida` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `medida`, `updated_at`, `created_at`) VALUES
(1, 'Vasos', 'Vasos de 1/4', '20.00', 101, NULL, '2017-11-22 16:15:41', '2017-11-21 01:23:45'),
(2, 'Café', 'El café es la bebida que se obtiene a partir de los granos tostados y molidos de los frutos de la planta del café.', '5.20', 0, 'Kilogramos (Kg)', '2017-11-22 07:10:42', '2017-11-22 07:10:42'),
(3, 'Helado', NULL, '30.00', 10, 'Litros (l)', '2017-11-22 16:27:22', '2017-11-22 19:15:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardexes`
--

CREATE TABLE `kardexes` (
  `id` int(11) NOT NULL,
  `idInsumo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `concepto` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `factura` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` decimal(6,2) NOT NULL,
  `cantidadexistencia` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `kardexes`
--

INSERT INTO `kardexes` (`id`, `idInsumo`, `fecha`, `concepto`, `factura`, `cantidad`, `preciounitario`, `cantidadexistencia`, `updated_at`, `created_at`) VALUES
(1, 1, '2017-11-20 00:00:00', 'Entrada', '001', 20, '20.00', 20, '2017-11-21 22:16:11', '2017-11-21 02:27:01'),
(2, 1, '2017-11-21 00:00:00', 'Entrada', '002', 157, '2.00', 177, '2017-11-22 03:11:10', '2017-11-22 03:11:10'),
(3, 1, '2017-11-21 00:00:00', 'Salida', '003', 77, '2.50', 100, '2017-11-21 22:27:40', '2017-11-22 03:26:09'),
(4, 1, '2017-11-21 00:00:00', 'Entrada', '004', 28, '2.30', 128, '2017-11-22 03:34:33', '2017-11-22 03:34:33'),
(5, 1, '2017-11-21 20:09:45', 'Salida', '005', 27, '1.70', 101, '2017-11-22 01:09:45', '2017-11-22 01:09:45'),
(6, 3, '2017-11-22 11:23:11', 'Entrada', '006', 20, '30.00', 20, '2017-11-22 16:23:12', '2017-11-22 14:22:03'),
(7, 3, '2017-11-22 11:27:22', 'Salida', NULL, 10, '30.00', 10, '2017-11-22 16:27:22', '2017-11-22 16:23:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personals`
--

CREATE TABLE `personals` (
  `id` int(11) NOT NULL,
  `nombres` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genero` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `personals`
--

INSERT INTO `personals` (`id`, `nombres`, `apellidos`, `dni`, `fechanacimiento`, `telefono`, `genero`, `direccion`, `updated_at`, `created_at`) VALUES
(1, 'Gian Piere', 'Vallejos Bardales', '87654321', '1990-11-20', '076654321', 'Masculino', 'Av. Independencia N° 971', '2017-11-15 16:28:07', '0000-00-00 00:00:00'),
(2, 'Martín', 'Suárez Barrueto', '87654321', '1990-11-20', '987654321', 'Masculino', 'Av. Independencia N° 971', '2017-11-11 10:22:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(180) NOT NULL,
  `descripcion` varchar(180) DEFAULT NULL,
  `precio` decimal(6,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `updated_at`, `created_at`) VALUES
(1, 'Helado', '1 bola', '4.50', '2017-11-01 05:11:47', '2017-11-01 04:03:01'),
(2, 'Helado', '2 bolas', '6.00', '2017-11-01 04:03:14', '2017-11-01 04:03:14'),
(3, 'Helado', '3 bolas', '9.00', '2017-11-01 04:03:26', '2017-11-01 04:03:26'),
(4, 'Helado', '1 litro', '18.50', '2017-11-01 04:03:37', '2017-11-01 04:03:37'),
(5, 'Empanada', 'Jamón y Queso', '4.50', '2017-11-01 05:13:11', '2017-11-01 04:04:03'),
(7, 'Tamal', NULL, '3.00', '2017-11-01 04:07:18', '2017-11-01 04:07:18'),
(8, 'Humita', NULL, '3.00', '2017-11-01 04:07:24', '2017-11-01 04:07:24'),
(9, 'Torta de Chocolate', NULL, '7.00', '2017-11-01 04:07:35', '2017-11-01 04:07:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gian Piere Vallejos Bardales', 'rgd.gp.vallejos@gmail.com', '$2y$10$coYVaK.eIv6FDdNl62/zYuvEbXuzEMb14/R4VAhHMQxfIGgANM5TG', 'swMpYNv8esPTGlSAyk8dAkuKjojGByEK0RKMr2uW82jxE16Q1ju8dQ2HuOjI', '2017-10-29 05:44:22', '2017-10-29 05:44:22'),
(2, 'Martín Suárez Barrueto', 'ssuarezb13@outlook.com', '$2y$10$TCxjvz84e2ddac0Md6bJNuM2dNjHv33xmd7UAlwOYzivPvE4AC1tC', 'nlOVn1gy1hPqhEEA5KPGPzqwxoW84Bd5bds4JlnuIZvXx9rdqL1LCGnWKatl', '2017-11-09 01:23:03', '2017-11-09 01:23:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `fechahora` datetime NOT NULL,
  `tipo` int(11) DEFAULT '1',
  `idVendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `fechahora`, `tipo`, `idVendedor`) VALUES
(1, '2017-10-31 18:10:02', 1, 1),
(2, '2017-10-31 18:10:29', 1, 1),
(3, '2017-10-31 18:10:44', 1, 1),
(4, '2017-10-31 18:12:34', 1, 1),
(5, '2017-10-31 18:14:10', 1, 1),
(6, '2017-10-31 18:15:02', 1, 1),
(7, '2017-10-31 18:15:25', 1, 1),
(8, '2017-10-31 18:19:23', 1, 1),
(9, '2017-10-31 18:20:57', 1, 1),
(10, '2017-10-31 18:36:54', 1, 1),
(11, '2017-10-31 18:37:37', 1, 1),
(12, '2017-10-31 18:44:49', 1, 1),
(13, '2017-10-31 18:45:27', 1, 1),
(14, '2017-10-31 19:06:28', 1, 1),
(15, '2017-10-31 19:07:45', 1, 1),
(16, '2017-10-31 19:08:05', 1, 1),
(17, '2017-10-31 19:13:29', 1, 1),
(18, '2017-10-31 19:14:09', 1, 1),
(19, '2017-10-31 19:20:47', 1, 1),
(20, '2017-11-01 18:46:29', 1, 1),
(21, '2017-11-02 15:47:06', 1, 1),
(22, '2017-11-02 18:08:43', 1, 1),
(23, '2017-11-02 18:09:20', 1, 1),
(24, '2017-11-02 18:10:16', 1, 1),
(25, '2017-11-02 18:10:28', 1, 1),
(26, '2017-11-02 18:10:50', 1, 1),
(27, '2017-11-02 18:11:23', 1, 1),
(28, '2017-11-02 18:11:34', 1, 1),
(29, '2017-11-02 18:11:44', 1, 1),
(30, '2017-11-02 18:14:39', 1, 1),
(31, '2017-11-02 18:15:10', 1, 1),
(32, '2017-11-02 18:17:10', 1, 1),
(33, '2017-11-03 12:01:18', 1, 1),
(34, '2017-11-06 16:49:55', 1, 1),
(35, '2017-11-07 17:13:32', 1, 1),
(36, '2017-11-07 20:46:48', 1, 1),
(37, '2017-11-07 21:08:10', 1, 1),
(38, '2017-11-07 21:10:38', 1, 1),
(39, '2017-11-07 21:12:57', 1, 1),
(40, '2017-11-07 21:13:23', 1, 1),
(41, '2017-11-07 21:14:01', 1, 1),
(42, '2017-11-07 21:43:09', 1, 1),
(43, '2017-11-07 23:00:53', 1, 1),
(44, '2017-11-07 23:01:51', 1, 1),
(45, '2017-11-07 23:03:07', 1, 1),
(46, '2017-11-07 23:03:50', 1, 1),
(47, '2017-11-07 23:35:56', 1, 1),
(48, '2017-11-07 23:45:04', 1, 1),
(49, '2017-11-08 09:26:52', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kardexes`
--
ALTER TABLE `kardexes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `kardexes`
--
ALTER TABLE `kardexes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personals`
--
ALTER TABLE `personals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
