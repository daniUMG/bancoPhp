-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2021 a las 23:29:08
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajero`
--

CREATE TABLE `cajero` (
  `idcajero` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cajero`
--

INSERT INTO `cajero` (`idcajero`, `nombre`, `usuario`, `clave`, `estado`) VALUES
(1, 'Prueba', 'josesagas2@gmail.com', 'manager1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_usuario`
--

CREATE TABLE `cuenta_usuario` (
  `NoCuenta` int(11) NOT NULL,
  `NombreCuenta` varchar(45) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `monto` decimal(9,4) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta_usuario`
--

INSERT INTO `cuenta_usuario` (`NoCuenta`, `NombreCuenta`, `idUsuario`, `monto`, `fechaCreacion`) VALUES
(1, 'monetaria', 1, '1000.0000', '2021-10-07 13:08:58'),
(2, 'monetaria', 6, '3000.0000', '2021-10-07 13:09:23'),
(3, 'ahorro', 1, '2103.0000', '2021-10-07 13:09:23'),
(4, 'monetaria', 5, '10000.0000', '2021-10-07 13:09:23'),
(5, 'ahorro', NULL, '4000.0000', '2021-10-07 13:09:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion`
--

CREATE TABLE `operacion` (
  `idOperacion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `NoCuenta` int(11) NOT NULL,
  `monto` decimal(5,2) DEFAULT NULL,
  `tipo_transaccion` int(11) DEFAULT NULL,
  `tipo_operacion` int(11) DEFAULT NULL,
  `id_cajero` int(11) DEFAULT NULL,
  `id_tercero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operacion`
--

INSERT INTO `operacion` (`idOperacion`, `fecha`, `NoCuenta`, `monto`, `tipo_transaccion`, `tipo_operacion`, `id_cajero`, `id_tercero`) VALUES
(1, '2021-10-08', 1, '1.00', 1, 2, NULL, 3),
(2, '2021-10-08', 1, '1.00', 1, 2, NULL, 3),
(3, '2021-10-08', 1, '1.00', 1, 2, NULL, 3),
(4, '2021-10-08', 1, '100.00', 1, 2, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_operacion`
--

CREATE TABLE `tipo_operacion` (
  `idtipo` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_operacion`
--

INSERT INTO `tipo_operacion` (`idtipo`, `tipo`) VALUES
(1, 'cajero'),
(2, 'tercero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transaccion`
--

CREATE TABLE `tipo_transaccion` (
  `idTipoTrans` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_transaccion`
--

INSERT INTO `tipo_transaccion` (`idTipoTrans`, `nombre`) VALUES
(1, 'depósito'),
(2, 'retiro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpi` varchar(45) DEFAULT NULL,
  `isadmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellido`, `email`, `telefono`, `password`, `estado`, `hash`, `dpi`, `isadmin`) VALUES
(1, 'José', 'Sagastume', 'jsagastumej@miumg.edu.gt', '', '243e61e9410a9f577d2d662c67025ee9', 1, NULL, NULL, 1),
(5, 'Daniel', 'Ramírez', 'daniel@gmail.com', '', '243e61e9410a9f577d2d662c67025ee9', 1, NULL, NULL, 0),
(6, 'Elmer', 'López', 'elmer@gmail.com', '', '243e61e9410a9f577d2d662c67025ee9', 1, NULL, NULL, 1),
(7, 'Leonel', 'Arrecis', 'leonel@banco.umg.gt', NULL, '243e61e9410a9f577d2d662c67025ee9', 1, NULL, NULL, 1),
(8, 'Victor', 'Manuel', 'vic@pruebas123.com', '23423', 'manager1', 1, NULL, '', 0),
(9, 'Victor', 'Vicente', 'asdio@sdjifhsduio.co', '43435', '123', 1, NULL, '435345', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tercero`
--

CREATE TABLE `usuario_tercero` (
  `idorigen` int(11) NOT NULL,
  `iddestino` int(11) NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `monto_max` decimal(9,2) DEFAULT NULL,
  `cantidad_max` decimal(9,2) DEFAULT NULL,
  `transferencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_tercero`
--

INSERT INTO `usuario_tercero` (`idorigen`, `iddestino`, `alias`, `monto_max`, `cantidad_max`, `transferencias`) VALUES
(1, 2, 'Elmer', '10000.00', '34.00', 0),
(1, 3, 'Daniel', '5000.00', '34.00', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cajero`
--
ALTER TABLE `cajero`
  ADD PRIMARY KEY (`idcajero`);

--
-- Indices de la tabla `cuenta_usuario`
--
ALTER TABLE `cuenta_usuario`
  ADD PRIMARY KEY (`NoCuenta`),
  ADD KEY `fk_usuario` (`idUsuario`);

--
-- Indices de la tabla `operacion`
--
ALTER TABLE `operacion`
  ADD PRIMARY KEY (`idOperacion`),
  ADD KEY `fk_Operacion_Cuenta_Usuario1` (`NoCuenta`),
  ADD KEY `fk_tipo` (`tipo_transaccion`),
  ADD KEY `fk_tipo_op` (`tipo_operacion`),
  ADD KEY `id_cajero` (`id_cajero`);

--
-- Indices de la tabla `tipo_operacion`
--
ALTER TABLE `tipo_operacion`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `tipo_transaccion`
--
ALTER TABLE `tipo_transaccion`
  ADD PRIMARY KEY (`idTipoTrans`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuario_tercero`
--
ALTER TABLE `usuario_tercero`
  ADD PRIMARY KEY (`idorigen`,`iddestino`),
  ADD KEY `FK_usuario_tercero` (`iddestino`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cajero`
--
ALTER TABLE `cajero`
  MODIFY `idcajero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `operacion`
--
ALTER TABLE `operacion`
  MODIFY `idOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta_usuario`
--
ALTER TABLE `cuenta_usuario`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `operacion`
--
ALTER TABLE `operacion`
  ADD CONSTRAINT `fk_Operacion_Cuenta_Usuario1` FOREIGN KEY (`NoCuenta`) REFERENCES `cuenta_usuario` (`NoCuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`tipo_transaccion`) REFERENCES `tipo_transaccion` (`idTipoTrans`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_op` FOREIGN KEY (`tipo_operacion`) REFERENCES `tipo_operacion` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_cajero` FOREIGN KEY (`id_cajero`) REFERENCES `cajero` (`idcajero`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_tercero`
--
ALTER TABLE `usuario_tercero`
  ADD CONSTRAINT `FK_usuario_tercero` FOREIGN KEY (`iddestino`) REFERENCES `cuenta_usuario` (`NoCuenta`),
  ADD CONSTRAINT `fk_tercero_list_has_usuario_usuario1` FOREIGN KEY (`idorigen`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
