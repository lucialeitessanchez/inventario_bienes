-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Servidor: srvtmysql3e.santafe.gov.ar
-- Tiempo de generación: 07-10-2021 a las 08:25:30
-- Versión del servidor: 5.5.53-0+deb8u1-log
-- Versión de PHP: 5.6.40-0+deb8u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `desoc_buenaspracticas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actoAdministrativo`
--

CREATE TABLE IF NOT EXISTS `actoAdministrativo` (
`idActoAdministrativo` int(11) NOT NULL,
  `nroNota` int(11) DEFAULT NULL,
  `fechaNota` date DEFAULT NULL,
  `descripcionProyecto` text,
  `montoSolicitado` double NOT NULL,
  `montoAprobado` double DEFAULT NULL,
  `fechaMontoAprobado` date DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `referente` text COMMENT 'emisor de la nota / pedido',
  `referente2codigoarea` varchar(5) DEFAULT NULL,
  `referente2` varchar(50) DEFAULT NULL,
  `referente2Te` varchar(45) DEFAULT NULL,
  `referente2Mail` varchar(45) DEFAULT NULL,
  `contactoApenom` varchar(45) DEFAULT NULL,
  `contactocodigoarea` varchar(5) DEFAULT NULL,
  `contactoTe` varchar(45) DEFAULT NULL,
  `contactoMail` varchar(45) DEFAULT NULL,
  `tramiteUrgente` tinyint(1) NOT NULL DEFAULT '0',
  `tipoSolicitante_idtipoSolicitante` int(11) NOT NULL,
  `Institucion_inst_id` int(11) NOT NULL,
  `nombreInstitucion` varchar(255) DEFAULT NULL,
  `idLocalidadInst` int(11) NOT NULL,
  `localidadInst` varchar(45) NOT NULL,
  `departamentoInst` varchar(45) NOT NULL,
  `cbuInstitucion` varchar(22) DEFAULT NULL,
  `nroExpediente` varchar(45) DEFAULT NULL,
  `fechaExpediente` date DEFAULT NULL,
  `caratula` text,
  `fechaCaratula` date DEFAULT NULL,
  `fechaDictamen` date DEFAULT NULL,
  `observacionDictamen` text,
  `fechapago` date DEFAULT NULL,
  `nroresolucion` int(11) DEFAULT NULL,
  `fecharesolucion` date DEFAULT NULL,
  `etapas` varchar(45) DEFAULT '1',
  `nrosipaf` varchar(50) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `area_carga` int(11) NOT NULL,
  `fechaCarga` datetime DEFAULT NULL,
  `fechaBaja` datetime DEFAULT NULL,
  `motivoBaja` varchar(255) DEFAULT NULL,
  `cantidadBenefDirectos` int(11) DEFAULT NULL,
  `cantidadBenefIndirectos` int(11) DEFAULT NULL,
  `t_loc_id_loc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actoAdministrativo_has_checkRequisitos`
--

CREATE TABLE IF NOT EXISTS `actoAdministrativo_has_checkRequisitos` (
`id` int(11) NOT NULL,
  `actoAdministrativo_idActoAdministrativo` int(11) NOT NULL,
  `checkRequisitos_idcheckRequisitos` int(11) NOT NULL,
  `fechaControl` datetime DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `fechaCarga` datetime DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actoAdministrativo_has_componente`
--

CREATE TABLE IF NOT EXISTS `actoAdministrativo_has_componente` (
`idActoAdministrativo_has_componente` int(11) NOT NULL,
  `actoAdministrativo_idActoAdministrativo` int(11) NOT NULL,
  `componente_idComponenteSolicitado` int(11) NOT NULL,
  `detalleComponente_idDetalleComponenteSolicitado` int(11) NOT NULL,
  `fechaSolicitado` datetime DEFAULT NULL,
  `componente_idComponenteAprobado` int(11) DEFAULT NULL,
  `detalleComponente_idDetalleComponenteAprobado` int(11) DEFAULT NULL,
  `fechaAprobado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE IF NOT EXISTS `archivo` (
`idarchivo` int(11) NOT NULL,
  `nombreArchivo` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `fecha` date DEFAULT NULL,
  `fechaUpload` datetime DEFAULT NULL,
  `usuarioAlta` varchar(255) DEFAULT NULL,
  `actoAdministrativo_idActoAdministrativo` int(11) NOT NULL,
  `tipoDocumento_idTipo_documento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
`idArea` int(11) NOT NULL,
  `area` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checkRequisitos`
--

CREATE TABLE IF NOT EXISTS `checkRequisitos` (
`idcheckRequisitos` int(11) NOT NULL,
  `detalleRequisito` varchar(255) DEFAULT NULL,
  `validoPara` varchar(45) DEFAULT NULL,
  `fechaBaja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componente`
--

CREATE TABLE IF NOT EXISTS `componente` (
`idComponente` int(11) NOT NULL,
  `componente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleComponente`
--

CREATE TABLE IF NOT EXISTS `detalleComponente` (
`iddetalleComponente` int(11) NOT NULL,
  `detalleComponente` varchar(100) DEFAULT NULL,
  `componente_idComponente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoActoAdministrativo`
--

CREATE TABLE IF NOT EXISTS `estadoActoAdministrativo` (
`idestado` int(11) NOT NULL,
  `estadoDescripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoActoAdministrativo_has_actoAdministrativo`
--

CREATE TABLE IF NOT EXISTS `estadoActoAdministrativo_has_actoAdministrativo` (
`idestadoActo_has_actoAdministrativo` int(11) NOT NULL,
  `estadoActoAdministrativo_idestado` int(11) NOT NULL,
  `actoAdministrativo_idActoAdministrativo` int(11) NOT NULL,
  `fechaEstado` date NOT NULL,
  `observacionEstado` text,
  `fechaCarga` datetime NOT NULL,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE IF NOT EXISTS `movimiento` (
`idMovimiento` int(11) NOT NULL,
  `area_idAreaOrigen` int(11) NOT NULL,
  `area_idAreaDestino` int(11) NOT NULL,
  `fechaMovimiento` datetime DEFAULT NULL,
  `motivoMovimiento` enum('Continuar trámite','Solicitar revision','A evaluar','A dictaminar','A pagar') DEFAULT NULL,
  `observacion` text,
  `folios` int(11) DEFAULT NULL,
  `fechaCarga` datetime DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `actoAdministrativo_idActoAdministrativo` int(11) NOT NULL,
  `tipoMovimiento` enum('INTERNO','EXTERNO') NOT NULL DEFAULT 'INTERNO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_bp`
--

CREATE TABLE IF NOT EXISTS `observaciones_bp` (
`idObservacionActoAdministrativo` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `fechaObs` date DEFAULT NULL,
  `usuario` varchar(45) NOT NULL,
  `fechaCarga` datetime NOT NULL,
  `actoAdministrativo_idActoAdministrativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoDocumento`
--

CREATE TABLE IF NOT EXISTS `tipoDocumento` (
`idtipo_documento` int(11) NOT NULL,
  `descripciondocumento` varchar(50) NOT NULL,
  `fechabaja` datetime DEFAULT NULL,
  `area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoSolicitante`
--

CREATE TABLE IF NOT EXISTS `tipoSolicitante` (
`idtipoSolicitante` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actoAdministrativo`
--
ALTER TABLE `actoAdministrativo`
 ADD PRIMARY KEY (`idActoAdministrativo`), ADD KEY `fecha_solicitud` (`fechaNota`), ADD KEY `fk_actoAdministrativo_tipoInstitucionBP1_idx` (`tipoSolicitante_idtipoSolicitante`), ADD KEY `fk_actoAdministrativo_Institucion1_idx` (`Institucion_inst_id`), ADD KEY `t_loc_id_loc` (`t_loc_id_loc`), ADD KEY `area_carga` (`area_carga`), ADD KEY `nombreInstitucion` (`nombreInstitucion`);

--
-- Indices de la tabla `actoAdministrativo_has_checkRequisitos`
--
ALTER TABLE `actoAdministrativo_has_checkRequisitos`
 ADD PRIMARY KEY (`id`) USING BTREE, ADD KEY `fk_actoAdministrativo_has_checkRequisitos_actoAdministrativ_idx` (`actoAdministrativo_idActoAdministrativo`) USING BTREE, ADD KEY `fk_actoAdministrativo_has_checkRequisitos_checkRequisitos1_idx` (`checkRequisitos_idcheckRequisitos`) USING BTREE;

--
-- Indices de la tabla `actoAdministrativo_has_componente`
--
ALTER TABLE `actoAdministrativo_has_componente`
 ADD PRIMARY KEY (`idActoAdministrativo_has_componente`), ADD KEY `fk_actoAdministrativo_has_componente_componente1_idx` (`componente_idComponenteSolicitado`), ADD KEY `fk_actoAdministrativo_has_componente_actoAdministrativo1_idx` (`actoAdministrativo_idActoAdministrativo`);

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
 ADD PRIMARY KEY (`idarchivo`), ADD KEY `fk_archivo_tipoDocumento1_idx` (`tipoDocumento_idTipo_documento`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
 ADD PRIMARY KEY (`idArea`);

--
-- Indices de la tabla `checkRequisitos`
--
ALTER TABLE `checkRequisitos`
 ADD PRIMARY KEY (`idcheckRequisitos`);

--
-- Indices de la tabla `componente`
--
ALTER TABLE `componente`
 ADD PRIMARY KEY (`idComponente`);

--
-- Indices de la tabla `detalleComponente`
--
ALTER TABLE `detalleComponente`
 ADD PRIMARY KEY (`iddetalleComponente`) USING BTREE, ADD KEY `componente_idComponente` (`componente_idComponente`), ADD KEY `fk_detalleComponente_componente1_idx` (`componente_idComponente`) USING BTREE;

--
-- Indices de la tabla `estadoActoAdministrativo`
--
ALTER TABLE `estadoActoAdministrativo`
 ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `estadoActoAdministrativo_has_actoAdministrativo`
--
ALTER TABLE `estadoActoAdministrativo_has_actoAdministrativo`
 ADD PRIMARY KEY (`idestadoActo_has_actoAdministrativo`), ADD KEY `fk_estadoActoAdministrativo_has_actoAdministrativo_estadoAc_idx` (`estadoActoAdministrativo_idestado`), ADD KEY `fk_estadoActoAdministrativo_has_actoAdministrativo_actoAdmi_idx` (`actoAdministrativo_idActoAdministrativo`) USING BTREE;

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
 ADD PRIMARY KEY (`idMovimiento`), ADD KEY `fk_Movimiento_area1_idx` (`area_idAreaOrigen`), ADD KEY `fk_Movimiento_actoAdministrativo1_idx` (`actoAdministrativo_idActoAdministrativo`);

--
-- Indices de la tabla `observaciones_bp`
--
ALTER TABLE `observaciones_bp`
 ADD PRIMARY KEY (`idObservacionActoAdministrativo`), ADD KEY `fecha_obs` (`fechaObs`), ADD KEY `fk_observaciones_bp_actoAdministrativo1_idx` (`actoAdministrativo_idActoAdministrativo`);

--
-- Indices de la tabla `tipoDocumento`
--
ALTER TABLE `tipoDocumento`
 ADD PRIMARY KEY (`idtipo_documento`);

--
-- Indices de la tabla `tipoSolicitante`
--
ALTER TABLE `tipoSolicitante`
 ADD PRIMARY KEY (`idtipoSolicitante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actoAdministrativo`
--
ALTER TABLE `actoAdministrativo`
MODIFY `idActoAdministrativo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `actoAdministrativo_has_checkRequisitos`
--
ALTER TABLE `actoAdministrativo_has_checkRequisitos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `actoAdministrativo_has_componente`
--
ALTER TABLE `actoAdministrativo_has_componente`
MODIFY `idActoAdministrativo_has_componente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
MODIFY `idarchivo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `checkRequisitos`
--
ALTER TABLE `checkRequisitos`
MODIFY `idcheckRequisitos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `componente`
--
ALTER TABLE `componente`
MODIFY `idComponente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalleComponente`
--
ALTER TABLE `detalleComponente`
MODIFY `iddetalleComponente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadoActoAdministrativo`
--
ALTER TABLE `estadoActoAdministrativo`
MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadoActoAdministrativo_has_actoAdministrativo`
--
ALTER TABLE `estadoActoAdministrativo_has_actoAdministrativo`
MODIFY `idestadoActo_has_actoAdministrativo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
MODIFY `idMovimiento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `observaciones_bp`
--
ALTER TABLE `observaciones_bp`
MODIFY `idObservacionActoAdministrativo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipoDocumento`
--
ALTER TABLE `tipoDocumento`
MODIFY `idtipo_documento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipoSolicitante`
--
ALTER TABLE `tipoSolicitante`
MODIFY `idtipoSolicitante` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
