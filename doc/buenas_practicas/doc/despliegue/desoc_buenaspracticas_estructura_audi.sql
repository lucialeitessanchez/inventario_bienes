/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  usuario
 * Created: 28 sep. 2021
 */

USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`actoAdministrativo_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`actoAdministrativo_has_checkRequisitos_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`actoAdministrativo_has_componente_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`archivo_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`area_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`checkRequisitos_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`componente_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`detalleComponente_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`estadoActoAdministrativo_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`estadoActoAdministrativo_has_actoAdministrativo_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`movimiento_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`observaciones_bp_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`tipoDocumento_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;USE `desoc_buenaspracticas`;
CREATE TABLE IF NOT EXISTS `desoc_buenaspracticas`.`tipoSolicitante_audi` (
  `auditoria_id` int(11) UNSIGNED NOT NULL auto_increment,
  `accion` varchar(50) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `registro_id` int(13) UNSIGNED NOT NULL,
  `val_old` varchar(255) ,
  `val_nvo` varchar(255) ,
  `usuario` varchar(255) ,
  `dir_ip` varchar(100) ,
  `marca` datetime NOT NULL,
  PRIMARY KEY  (`auditoria_id`),
  KEY `filtro` (`registro_id`, `marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;