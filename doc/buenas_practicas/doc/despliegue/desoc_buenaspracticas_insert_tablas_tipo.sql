-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Servidor: srvtmysql3e.santafe.gov.ar
-- Tiempo de generación: 07-10-2021 a las 08:47:26
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

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`idArea`, `area`) VALUES
(1, 'Privada'),
(2, 'Unidad Evaluadora'),
(3, 'Unidad de Gestion de Convenio'),
(4, 'Secretario'),
(5, 'D.P.C.y R.I'),
(6, 'Area Externa');

--
-- Volcado de datos para la tabla `checkRequisitos`
--

INSERT INTO `checkRequisitos` (`idcheckRequisitos`, `detalleRequisito`, `validoPara`, `fechaBaja`) VALUES
(1, 'Nota de solicitud', 'Tramite General', NULL),
(2, 'Fotocopia de la ultima acta de designación de autoridades (autenticada por autoridad competente)', 'Tramite General', NULL),
(3, 'Fotocopia del acta de solicitud de subsidio al programa (autenticada por autoridad competente)', 'Tramite General', NULL),
(4, 'Fotocopia de la 1ª y 2ª hoja de DNI de Presidente, Secretario y Tesorero (autenticadas por autoridad competente)', 'Tramite General', NULL),
(5, 'Constancia de CBU ', 'Tramite General', NULL),
(6, 'Constancia de Subsistencia de Personería Jurídica (otorgada por autoridad competente)', 'Tramite General', NULL),
(7, 'Esc/ Com', 'C1', NULL),
(8, '3 Presupuestos', 'C1', NULL),
(9, 'CV', 'C2', NULL),
(10, 'DNI', 'C2', NULL),
(11, 'Titulo', 'C2', NULL),
(12, '3 Presupuestos', 'C3', NULL),
(13, 'Fortalecimiento', 'C4', NULL),
(14, 'ONG', 'Registro', NULL),
(15, 'SIPAF', 'Registro', NULL);

--
-- Volcado de datos para la tabla `componente`
--

INSERT INTO `componente` (`idComponente`, `componente`) VALUES
(1, 'AYUDA ECONOMICAS Y APORTE PARA MATERIALES'),
(2, 'CAPACITACION O ASESORAMIENTO TECNICO'),
(3, 'EQUIPAMIENTO'),
(4, 'LINEAS ESPECIALES');

--
-- Volcado de datos para la tabla `detalleComponente`
--

INSERT INTO `detalleComponente` (`iddetalleComponente`, `detalleComponente`, `componente_idComponente`) VALUES
(1, 'Construcción o mantenimiento de infraestructura social', 2),
(2, 'Promover o apoyar el desarrollo deportivo y/o cultural', 1),
(3, 'Desarrollar o dar sustentabilidad a proyectos o emprendimientos sociales', 2),
(4, 'Promocionar el trabajo en red y/o la recuperación del capital social local', 2),
(5, 'Mejorar la organización de la institución o la implementación de un programa del MDS', 2),
(6, 'Desarrollar el proyecto de infraestructura social (herramientas, maquinarias, etc.). ', 3),
(7, 'Desarrollar Capacitación', 3),
(8, 'Realizar actividades deportivas', 3),
(9, 'Equipar un comedor comunitario, un centro de día, etc.', 3),
(10, 'Desarrollar Observatorio Social Regional', 4),
(11, 'Monitorear Programas Sociales', 4),
(12, 'Organizar una red o Asociación de OSC ', 4),
(13, 'Regularizar la OSC, desarrollar las capacidades organizativas o gastos de funcionamiento ', 4),
(14, 'Monto estimado del subsidio solicitado para llevar adelante total o parcialmente la iniciativa', 4),
(15, 'Cantidad de beneficiarios directos y/o indirectos', 4);

--
-- Volcado de datos para la tabla `estadoActoAdministrativo`
--

INSERT INTO `estadoActoAdministrativo` (`idestado`, `estadoDescripcion`) VALUES
(1, 'INICIADO'),
(2, 'APROBADO - En curso'),
(3, 'APROBADO - A la espera'),
(4, 'NO APROBADO'),
(5, 'A EVALUAR'),
(6, 'PARA DICTAMINAR'),
(7, 'PARA FIRMA DE CONVENIO'),
(8, 'PARA GESTION DE PAGO'),
(9, 'PAGADO'),
(10, 'RENDIDO'),
(11, 'CONTINUAR TRAMITE'),
(12, 'TRAMITADO A TRAVES DE  OTRO PROGRAMA');

--
-- Volcado de datos para la tabla `tipoDocumento`
--

INSERT INTO `tipoDocumento` (`idtipo_documento`, `descripciondocumento`, `fechabaja`, `area`) VALUES
(1, 'Nota de Ingreso', NULL, 1),
(2, 'Informe Social UE', NULL, 2),
(3, 'Dictamen', NULL, 1),
(4, 'Convenio', NULL, 3),
(5, 'Resolución de Pago', NULL, 5);

--
-- Volcado de datos para la tabla `tipoSolicitante`
--

INSERT INTO `tipoSolicitante` (`idtipoSolicitante`, `descripcion`) VALUES
(1, 'CLUB'),
(2, 'ORGANIZACION DE LA SOCIEDAD CIVIL'),
(3, 'GOBIERNOS LOCALES');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
