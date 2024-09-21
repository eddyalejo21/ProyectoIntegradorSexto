-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3386
-- Tiempo de generación: 23-08-2024 a las 08:42:12
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
-- Base de datos: `touristtrekbd`
--
CREATE DATABASE IF NOT EXISTS `touristtrekbd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `touristtrekbd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadcomercio`
--

CREATE TABLE `actividadcomercio` (
  `id_actividadcomercio` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_comercio` int(11) NOT NULL,
  `costo` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `id_tipo_actividad` int(11) NOT NULL COMMENT 'desde catalogo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadeslugar`
--

CREATE TABLE `actividadeslugar` (
  `id_actividadcomerciolugar` int(11) NOT NULL,
  `id_actividadcomercio` int(11) NOT NULL,
  `id_lugar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogos`
--

CREATE TABLE `catalogos` (
  `id_catalogo` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `detalle` varchar(200) NOT NULL,
  `valor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `catalogos`
--

INSERT INTO `catalogos` (`id_catalogo`, `id_tipo`, `detalle`, `valor`) VALUES
(1, 1, 'Activo', '1'),
(2, 1, 'Inactivo', '0'),
(3, 2, 'Ecuatoriano', 'Ecuador'),
(5, 1, 'Reservado', '2'),
(6, 1, 'Confirmado', '3'),
(7, 1, 'Cancelado', '4'),
(9, 1, 'Confirmadodddd', '3dd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claves`
--

CREATE TABLE `claves` (
  `id_clave` int(11) NOT NULL,
  `valor` varchar(32) NOT NULL,
  `id_estado` int(11) NOT NULL COMMENT 'desde catalogo',
  `id_usuario` int(11) NOT NULL,
  `fecha_vigente` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercios`
--

CREATE TABLE `comercios` (
  `id_comercio` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `direccion` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL COMMENT 'desde catalogo',
  `longitud` int(11) NOT NULL,
  `latitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosreserva`
--

CREATE TABLE `datosreserva` (
  `id_datoreserva` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `id_tipodato` int(11) NOT NULL COMMENT 'desde catalogo',
  `valor` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesactividad`
--

CREATE TABLE `detallesactividad` (
  `id_detalleactividad` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `detalle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logsacceso`
--

CREATE TABLE `logsacceso` (
  `id_logacceso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_acceso` date NOT NULL,
  `hora_accceso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `id_lugar` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `longitud` int(11) NOT NULL,
  `latitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE `opiniones` (
  `id_opinion` int(11) NOT NULL,
  `id_reservaactividad` int(11) NOT NULL,
  `detalle` varchar(500) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `id_nacionalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `id_preferencia` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_tipo_actividad` int(11) NOT NULL COMMENT 'Desde catalogo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferenciaspersona`
--

CREATE TABLE `preferenciaspersona` (
  `id_preferenciapersona` int(11) NOT NULL,
  `id_preferencia` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_estado` int(11) NOT NULL COMMENT 'desde catalogo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservasactividades`
--

CREATE TABLE `reservasactividades` (
  `id_reservaactividad` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `id_actividadeslugar` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL COMMENT 'desde catalogo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nivel_acceso` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposcatalogo`
--

CREATE TABLE `tiposcatalogo` (
  `id_tipocatalogo` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiposcatalogo`
--

INSERT INTO `tiposcatalogo` (`id_tipocatalogo`, `tipo`) VALUES
(1, 'Estados'),
(2, 'Nacionalidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL COMMENT 'Todo usuario debe estar vinvulado a una persona',
  `nick` varchar(20) NOT NULL,
  `id_estado` int(11) NOT NULL COMMENT 'toma los ID desde catalogo de Estados',
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividadcomercio`
--
ALTER TABLE `actividadcomercio`
  ADD PRIMARY KEY (`id_actividadcomercio`),
  ADD KEY `idActividadIndexAC` (`id_actividad`),
  ADD KEY `idComercioIndexAC` (`id_comercio`);

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `actividadeslugar`
--
ALTER TABLE `actividadeslugar`
  ADD PRIMARY KEY (`id_actividadcomerciolugar`),
  ADD KEY `idActividadIndexAL` (`id_actividadcomercio`),
  ADD KEY `idLugarIndexAL` (`id_lugar`);

--
-- Indices de la tabla `catalogos`
--
ALTER TABLE `catalogos`
  ADD PRIMARY KEY (`id_catalogo`),
  ADD KEY `idTiposIndex` (`id_tipo`);

--
-- Indices de la tabla `claves`
--
ALTER TABLE `claves`
  ADD PRIMARY KEY (`id_clave`),
  ADD KEY `idUsuarioIndex` (`id_usuario`);

--
-- Indices de la tabla `comercios`
--
ALTER TABLE `comercios`
  ADD PRIMARY KEY (`id_comercio`);

--
-- Indices de la tabla `datosreserva`
--
ALTER TABLE `datosreserva`
  ADD PRIMARY KEY (`id_datoreserva`),
  ADD KEY `idReservaIndexDR` (`id_reserva`);

--
-- Indices de la tabla `detallesactividad`
--
ALTER TABLE `detallesactividad`
  ADD PRIMARY KEY (`id_detalleactividad`),
  ADD KEY `idActividadIndexDA` (`id_actividad`);

--
-- Indices de la tabla `logsacceso`
--
ALTER TABLE `logsacceso`
  ADD PRIMARY KEY (`id_logacceso`),
  ADD KEY `idUsuariosIndex` (`id_usuario`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id_lugar`);

--
-- Indices de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD PRIMARY KEY (`id_opinion`),
  ADD UNIQUE KEY `idRreservaActividadIndexUniqueO` (`id_reservaactividad`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD PRIMARY KEY (`id_preferencia`);

--
-- Indices de la tabla `preferenciaspersona`
--
ALTER TABLE `preferenciaspersona`
  ADD PRIMARY KEY (`id_preferenciapersona`),
  ADD KEY `idPreferenciaIndexPreferencia` (`id_preferencia`),
  ADD KEY `idPersonaIndexPreferencia` (`id_persona`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `idPersonaIndexR` (`id_persona`);

--
-- Indices de la tabla `reservasactividades`
--
ALTER TABLE `reservasactividades`
  ADD PRIMARY KEY (`id_reservaactividad`),
  ADD KEY `idReservaIndexRA` (`id_reserva`),
  ADD KEY `idActividadesLugarIndexRA` (`id_actividadeslugar`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tiposcatalogo`
--
ALTER TABLE `tiposcatalogo`
  ADD PRIMARY KEY (`id_tipocatalogo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `idPersonaIndex` (`id_persona`) USING BTREE,
  ADD KEY `idRolIndexU` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividadcomercio`
--
ALTER TABLE `actividadcomercio`
  MODIFY `id_actividadcomercio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actividadeslugar`
--
ALTER TABLE `actividadeslugar`
  MODIFY `id_actividadcomerciolugar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogos`
--
ALTER TABLE `catalogos`
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `claves`
--
ALTER TABLE `claves`
  MODIFY `id_clave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comercios`
--
ALTER TABLE `comercios`
  MODIFY `id_comercio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datosreserva`
--
ALTER TABLE `datosreserva`
  MODIFY `id_datoreserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallesactividad`
--
ALTER TABLE `detallesactividad`
  MODIFY `id_detalleactividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logsacceso`
--
ALTER TABLE `logsacceso`
  MODIFY `id_logacceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  MODIFY `id_opinion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `id_preferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preferenciaspersona`
--
ALTER TABLE `preferenciaspersona`
  MODIFY `id_preferenciapersona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservasactividades`
--
ALTER TABLE `reservasactividades`
  MODIFY `id_reservaactividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposcatalogo`
--
ALTER TABLE `tiposcatalogo`
  MODIFY `id_tipocatalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividadcomercio`
--
ALTER TABLE `actividadcomercio`
  ADD CONSTRAINT `actividadcomercio_ibfk_1` FOREIGN KEY (`id_comercio`) REFERENCES `comercios` (`id_comercio`),
  ADD CONSTRAINT `actividadcomercio_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`);

--
-- Filtros para la tabla `actividadeslugar`
--
ALTER TABLE `actividadeslugar`
  ADD CONSTRAINT `actividadeslugar_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`),
  ADD CONSTRAINT `actividadeslugar_ibfk_2` FOREIGN KEY (`id_actividadcomercio`) REFERENCES `actividadcomercio` (`id_actividadcomercio`);

--
-- Filtros para la tabla `catalogos`
--
ALTER TABLE `catalogos`
  ADD CONSTRAINT `catalogos_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tiposcatalogo` (`id_tipocatalogo`);

--
-- Filtros para la tabla `claves`
--
ALTER TABLE `claves`
  ADD CONSTRAINT `claves_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `datosreserva`
--
ALTER TABLE `datosreserva`
  ADD CONSTRAINT `datosreserva_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`);

--
-- Filtros para la tabla `detallesactividad`
--
ALTER TABLE `detallesactividad`
  ADD CONSTRAINT `detallesactividad_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividadeslugar` (`id_actividadcomerciolugar`);

--
-- Filtros para la tabla `logsacceso`
--
ALTER TABLE `logsacceso`
  ADD CONSTRAINT `logsacceso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD CONSTRAINT `opiniones_ibfk_1` FOREIGN KEY (`id_reservaactividad`) REFERENCES `reservasactividades` (`id_reservaactividad`);

--
-- Filtros para la tabla `preferenciaspersona`
--
ALTER TABLE `preferenciaspersona`
  ADD CONSTRAINT `preferenciaspersona_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  ADD CONSTRAINT `preferenciaspersona_ibfk_2` FOREIGN KEY (`id_preferencia`) REFERENCES `preferencias` (`id_preferencia`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);

--
-- Filtros para la tabla `reservasactividades`
--
ALTER TABLE `reservasactividades`
  ADD CONSTRAINT `reservasactividades_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`),
  ADD CONSTRAINT `reservasactividades_ibfk_2` FOREIGN KEY (`id_actividadeslugar`) REFERENCES `actividadeslugar` (`id_actividadcomerciolugar`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
