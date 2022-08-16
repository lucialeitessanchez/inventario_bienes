/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  usuario
 * Created: 28 sep. 2021
 */

DELIMITER |
CREATE TRIGGER `actoAdministrativo_insert` AFTER INSERT ON `desoc_buenaspracticas`.`actoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idActoAdministrativo',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroNota',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.nroNota,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaNota',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaNota,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'descripcionProyecto',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.descripcionProyecto,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'montoSolicitado',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.montoSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'montoAprobado',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.montoAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaMontoAprobado',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaMontoAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.referente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2codigoarea',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.referente2codigoarea,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.referente2,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2Te',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.referente2Te,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2Mail',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.referente2Mail,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoApenom',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.contactoApenom,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactocodigoarea',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.contactocodigoarea,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoTe',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.contactoTe,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoMail',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.contactoMail,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'tramiteUrgente',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.tramiteUrgente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'tipoSolicitante_idtipoSolicitante',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.tipoSolicitante_idtipoSolicitante,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'Institucion_inst_id',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.Institucion_inst_id,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nombreInstitucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.nombreInstitucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idLocalidadInst',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.idLocalidadInst,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'localidadInst',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.localidadInst,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'departamentoInst',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.departamentoInst,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cbuInstitucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.cbuInstitucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroExpediente',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.nroExpediente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaExpediente',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaExpediente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'caratula',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.caratula,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCaratula',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaCaratula,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaDictamen',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaDictamen,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacionDictamen',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.observacionDictamen,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechapago',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechapago,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroresolucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.nroresolucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fecharesolucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fecharesolucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'etapas',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.etapas,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nrosipaf',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.nrosipaf,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'area_carga',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.area_carga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaBaja',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaBaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'motivoBaja',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.motivoBaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cantidadBenefDirectos',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.cantidadBenefDirectos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cantidadBenefIndirectos',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.cantidadBenefIndirectos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 't_loc_id_loc',
				registro_id = NEW.idActoAdministrativo,
				val_old = '',
				val_nvo = NEW.t_loc_id_loc,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`actoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idActoAdministrativo <=> NEW.idActoAdministrativo) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idActoAdministrativo',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.idActoAdministrativo,
				val_nvo = NEW.idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.nroNota <=> NEW.nroNota) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroNota',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.nroNota,
				val_nvo = NEW.nroNota,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaNota <=> NEW.fechaNota) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaNota',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechaNota,
				val_nvo = NEW.fechaNota,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.descripcionProyecto <=> NEW.descripcionProyecto) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'descripcionProyecto',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.descripcionProyecto,
				val_nvo = NEW.descripcionProyecto,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.montoSolicitado <=> NEW.montoSolicitado) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'montoSolicitado',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.montoSolicitado,
				val_nvo = NEW.montoSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.montoAprobado <=> NEW.montoAprobado) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'montoAprobado',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.montoAprobado,
				val_nvo = NEW.montoAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaMontoAprobado <=> NEW.fechaMontoAprobado) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaMontoAprobado',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechaMontoAprobado,
				val_nvo = NEW.fechaMontoAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.observacion <=> NEW.observacion) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.observacion,
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.referente <=> NEW.referente) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.referente,
				val_nvo = NEW.referente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.referente2codigoarea <=> NEW.referente2codigoarea) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2codigoarea',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.referente2codigoarea,
				val_nvo = NEW.referente2codigoarea,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.referente2 <=> NEW.referente2) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.referente2,
				val_nvo = NEW.referente2,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.referente2Te <=> NEW.referente2Te) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2Te',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.referente2Te,
				val_nvo = NEW.referente2Te,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.referente2Mail <=> NEW.referente2Mail) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2Mail',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.referente2Mail,
				val_nvo = NEW.referente2Mail,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.contactoApenom <=> NEW.contactoApenom) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoApenom',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.contactoApenom,
				val_nvo = NEW.contactoApenom,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.contactocodigoarea <=> NEW.contactocodigoarea) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactocodigoarea',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.contactocodigoarea,
				val_nvo = NEW.contactocodigoarea,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.contactoTe <=> NEW.contactoTe) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoTe',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.contactoTe,
				val_nvo = NEW.contactoTe,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.contactoMail <=> NEW.contactoMail) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoMail',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.contactoMail,
				val_nvo = NEW.contactoMail,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.tramiteUrgente <=> NEW.tramiteUrgente) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'tramiteUrgente',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.tramiteUrgente,
				val_nvo = NEW.tramiteUrgente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.tipoSolicitante_idtipoSolicitante <=> NEW.tipoSolicitante_idtipoSolicitante) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'tipoSolicitante_idtipoSolicitante',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.tipoSolicitante_idtipoSolicitante,
				val_nvo = NEW.tipoSolicitante_idtipoSolicitante,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.Institucion_inst_id <=> NEW.Institucion_inst_id) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'Institucion_inst_id',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.Institucion_inst_id,
				val_nvo = NEW.Institucion_inst_id,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.nombreInstitucion <=> NEW.nombreInstitucion) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nombreInstitucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.nombreInstitucion,
				val_nvo = NEW.nombreInstitucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.idLocalidadInst <=> NEW.idLocalidadInst) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idLocalidadInst',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.idLocalidadInst,
				val_nvo = NEW.idLocalidadInst,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.localidadInst <=> NEW.localidadInst) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'localidadInst',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.localidadInst,
				val_nvo = NEW.localidadInst,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.departamentoInst <=> NEW.departamentoInst) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'departamentoInst',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.departamentoInst,
				val_nvo = NEW.departamentoInst,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.cbuInstitucion <=> NEW.cbuInstitucion) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cbuInstitucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.cbuInstitucion,
				val_nvo = NEW.cbuInstitucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.nroExpediente <=> NEW.nroExpediente) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroExpediente',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.nroExpediente,
				val_nvo = NEW.nroExpediente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaExpediente <=> NEW.fechaExpediente) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaExpediente',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechaExpediente,
				val_nvo = NEW.fechaExpediente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.caratula <=> NEW.caratula) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'caratula',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.caratula,
				val_nvo = NEW.caratula,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaCaratula <=> NEW.fechaCaratula) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCaratula',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechaCaratula,
				val_nvo = NEW.fechaCaratula,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaDictamen <=> NEW.fechaDictamen) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaDictamen',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechaDictamen,
				val_nvo = NEW.fechaDictamen,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.observacionDictamen <=> NEW.observacionDictamen) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacionDictamen',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.observacionDictamen,
				val_nvo = NEW.observacionDictamen,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechapago <=> NEW.fechapago) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechapago',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechapago,
				val_nvo = NEW.fechapago,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.nroresolucion <=> NEW.nroresolucion) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroresolucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.nroresolucion,
				val_nvo = NEW.nroresolucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fecharesolucion <=> NEW.fecharesolucion) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fecharesolucion',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fecharesolucion,
				val_nvo = NEW.fecharesolucion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.etapas <=> NEW.etapas) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'etapas',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.etapas,
				val_nvo = NEW.etapas,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.nrosipaf <=> NEW.nrosipaf) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nrosipaf',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.nrosipaf,
				val_nvo = NEW.nrosipaf,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.usuario <=> NEW.usuario) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.usuario,
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.area_carga <=> NEW.area_carga) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'area_carga',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.area_carga,
				val_nvo = NEW.area_carga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaCarga <=> NEW.fechaCarga) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechaCarga,
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaBaja <=> NEW.fechaBaja) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaBaja',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.fechaBaja,
				val_nvo = NEW.fechaBaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.motivoBaja <=> NEW.motivoBaja) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'motivoBaja',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.motivoBaja,
				val_nvo = NEW.motivoBaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.cantidadBenefDirectos <=> NEW.cantidadBenefDirectos) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cantidadBenefDirectos',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.cantidadBenefDirectos,
				val_nvo = NEW.cantidadBenefDirectos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.cantidadBenefIndirectos <=> NEW.cantidadBenefIndirectos) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cantidadBenefIndirectos',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.cantidadBenefIndirectos,
				val_nvo = NEW.cantidadBenefIndirectos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.t_loc_id_loc <=> NEW.t_loc_id_loc) THEN
		INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 't_loc_id_loc',
				registro_id = NEW.idActoAdministrativo,
				val_old = OLD.t_loc_id_loc,
				val_nvo = NEW.t_loc_id_loc,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`actoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idActoAdministrativo',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.idActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroNota',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.nroNota,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaNota',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechaNota,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'descripcionProyecto',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.descripcionProyecto,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'montoSolicitado',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.montoSolicitado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'montoAprobado',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.montoAprobado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaMontoAprobado',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechaMontoAprobado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.observacion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.referente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2codigoarea',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.referente2codigoarea,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.referente2,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2Te',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.referente2Te,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'referente2Mail',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.referente2Mail,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoApenom',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.contactoApenom,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactocodigoarea',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.contactocodigoarea,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoTe',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.contactoTe,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'contactoMail',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.contactoMail,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'tramiteUrgente',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.tramiteUrgente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'tipoSolicitante_idtipoSolicitante',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.tipoSolicitante_idtipoSolicitante,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'Institucion_inst_id',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.Institucion_inst_id,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nombreInstitucion',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.nombreInstitucion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idLocalidadInst',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.idLocalidadInst,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'localidadInst',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.localidadInst,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'departamentoInst',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.departamentoInst,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cbuInstitucion',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.cbuInstitucion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroExpediente',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.nroExpediente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaExpediente',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechaExpediente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'caratula',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.caratula,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCaratula',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechaCaratula,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaDictamen',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechaDictamen,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacionDictamen',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.observacionDictamen,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechapago',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechapago,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nroresolucion',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.nroresolucion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fecharesolucion',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fecharesolucion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'etapas',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.etapas,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'nrosipaf',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.nrosipaf,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.usuario,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'area_carga',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.area_carga,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechaCarga,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaBaja',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.fechaBaja,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'motivoBaja',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.motivoBaja,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cantidadBenefDirectos',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.cantidadBenefDirectos,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'cantidadBenefIndirectos',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.cantidadBenefIndirectos,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_audi` SET
				accion = @accion,
				campo = 't_loc_id_loc',
				registro_id = OLD.idActoAdministrativo,
				val_old = OLD.t_loc_id_loc,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_has_checkRequisitos_insert` AFTER INSERT ON `desoc_buenaspracticas`.`actoAdministrativo_has_checkRequisitos`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'id',
				registro_id = NEW.id,
				val_old = '',
				val_nvo = NEW.id,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.id,
				val_old = '',
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'checkRequisitos_idcheckRequisitos',
				registro_id = NEW.id,
				val_old = '',
				val_nvo = NEW.checkRequisitos_idcheckRequisitos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaControl',
				registro_id = NEW.id,
				val_old = '',
				val_nvo = NEW.fechaControl,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.id,
				val_old = '',
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.id,
				val_old = '',
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.id,
				val_old = '',
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_has_checkRequisitos_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`actoAdministrativo_has_checkRequisitos`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.id <=> NEW.id) THEN
		INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'id',
				registro_id = NEW.id,
				val_old = OLD.id,
				val_nvo = NEW.id,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.actoAdministrativo_idActoAdministrativo <=> NEW.actoAdministrativo_idActoAdministrativo) THEN
		INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.id,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.checkRequisitos_idcheckRequisitos <=> NEW.checkRequisitos_idcheckRequisitos) THEN
		INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'checkRequisitos_idcheckRequisitos',
				registro_id = NEW.id,
				val_old = OLD.checkRequisitos_idcheckRequisitos,
				val_nvo = NEW.checkRequisitos_idcheckRequisitos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaControl <=> NEW.fechaControl) THEN
		INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaControl',
				registro_id = NEW.id,
				val_old = OLD.fechaControl,
				val_nvo = NEW.fechaControl,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.observacion <=> NEW.observacion) THEN
		INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.id,
				val_old = OLD.observacion,
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaCarga <=> NEW.fechaCarga) THEN
		INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.id,
				val_old = OLD.fechaCarga,
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.usuario <=> NEW.usuario) THEN
		INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.id,
				val_old = OLD.usuario,
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_has_checkRequisitos_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`actoAdministrativo_has_checkRequisitos`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'id',
				registro_id = OLD.id,
				val_old = OLD.id,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = OLD.id,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'checkRequisitos_idcheckRequisitos',
				registro_id = OLD.id,
				val_old = OLD.checkRequisitos_idcheckRequisitos,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaControl',
				registro_id = OLD.id,
				val_old = OLD.fechaControl,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = OLD.id,
				val_old = OLD.observacion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = OLD.id,
				val_old = OLD.fechaCarga,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_checkRequisitos_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = OLD.id,
				val_old = OLD.usuario,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_has_componente_insert` AFTER INSERT ON `desoc_buenaspracticas`.`actoAdministrativo_has_componente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'idActoAdministrativo_has_componente',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.idActoAdministrativo_has_componente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'componente_idComponenteSolicitado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.componente_idComponenteSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'detalleComponente_idDetalleComponenteSolicitado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.detalleComponente_idDetalleComponenteSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'fechaSolicitado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.fechaSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'componente_idComponenteAprobado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.componente_idComponenteAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'detalleComponente_idDetalleComponenteAprobado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.detalleComponente_idDetalleComponenteAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'fechaAprobado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = '',
				val_nvo = NEW.fechaAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_has_componente_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`actoAdministrativo_has_componente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idActoAdministrativo_has_componente <=> NEW.idActoAdministrativo_has_componente) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'idActoAdministrativo_has_componente',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.idActoAdministrativo_has_componente,
				val_nvo = NEW.idActoAdministrativo_has_componente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.actoAdministrativo_idActoAdministrativo <=> NEW.actoAdministrativo_idActoAdministrativo) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.componente_idComponenteSolicitado <=> NEW.componente_idComponenteSolicitado) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'componente_idComponenteSolicitado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.componente_idComponenteSolicitado,
				val_nvo = NEW.componente_idComponenteSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.detalleComponente_idDetalleComponenteSolicitado <=> NEW.detalleComponente_idDetalleComponenteSolicitado) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'detalleComponente_idDetalleComponenteSolicitado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.detalleComponente_idDetalleComponenteSolicitado,
				val_nvo = NEW.detalleComponente_idDetalleComponenteSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaSolicitado <=> NEW.fechaSolicitado) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'fechaSolicitado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.fechaSolicitado,
				val_nvo = NEW.fechaSolicitado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.componente_idComponenteAprobado <=> NEW.componente_idComponenteAprobado) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'componente_idComponenteAprobado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.componente_idComponenteAprobado,
				val_nvo = NEW.componente_idComponenteAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.detalleComponente_idDetalleComponenteAprobado <=> NEW.detalleComponente_idDetalleComponenteAprobado) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'detalleComponente_idDetalleComponenteAprobado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.detalleComponente_idDetalleComponenteAprobado,
				val_nvo = NEW.detalleComponente_idDetalleComponenteAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaAprobado <=> NEW.fechaAprobado) THEN
		INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'fechaAprobado',
				registro_id = NEW.idActoAdministrativo_has_componente,
				val_old = OLD.fechaAprobado,
				val_nvo = NEW.fechaAprobado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `actoAdministrativo_has_componente_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`actoAdministrativo_has_componente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'idActoAdministrativo_has_componente',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.idActoAdministrativo_has_componente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'componente_idComponenteSolicitado',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.componente_idComponenteSolicitado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'detalleComponente_idDetalleComponenteSolicitado',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.detalleComponente_idDetalleComponenteSolicitado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'fechaSolicitado',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.fechaSolicitado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'componente_idComponenteAprobado',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.componente_idComponenteAprobado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'detalleComponente_idDetalleComponenteAprobado',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.detalleComponente_idDetalleComponenteAprobado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `actoAdministrativo_has_componente_audi` SET
				accion = @accion,
				campo = 'fechaAprobado',
				registro_id = OLD.idActoAdministrativo_has_componente,
				val_old = OLD.fechaAprobado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `archivo_insert` AFTER INSERT ON `desoc_buenaspracticas`.`archivo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'idarchivo',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.idarchivo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'nombreArchivo',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.nombreArchivo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'extension',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.extension,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'path',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.path,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'descripcion',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.descripcion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'fecha',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.fecha,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'fechaUpload',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.fechaUpload,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'usuarioAlta',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.usuarioAlta,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'tipoDocumento_idTipo_documento',
				registro_id = NEW.idarchivo,
				val_old = '',
				val_nvo = NEW.tipoDocumento_idTipo_documento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `archivo_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`archivo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idarchivo <=> NEW.idarchivo) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'idarchivo',
				registro_id = NEW.idarchivo,
				val_old = OLD.idarchivo,
				val_nvo = NEW.idarchivo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.nombreArchivo <=> NEW.nombreArchivo) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'nombreArchivo',
				registro_id = NEW.idarchivo,
				val_old = OLD.nombreArchivo,
				val_nvo = NEW.nombreArchivo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.extension <=> NEW.extension) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'extension',
				registro_id = NEW.idarchivo,
				val_old = OLD.extension,
				val_nvo = NEW.extension,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.path <=> NEW.path) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'path',
				registro_id = NEW.idarchivo,
				val_old = OLD.path,
				val_nvo = NEW.path,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.descripcion <=> NEW.descripcion) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'descripcion',
				registro_id = NEW.idarchivo,
				val_old = OLD.descripcion,
				val_nvo = NEW.descripcion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fecha <=> NEW.fecha) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'fecha',
				registro_id = NEW.idarchivo,
				val_old = OLD.fecha,
				val_nvo = NEW.fecha,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaUpload <=> NEW.fechaUpload) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'fechaUpload',
				registro_id = NEW.idarchivo,
				val_old = OLD.fechaUpload,
				val_nvo = NEW.fechaUpload,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.usuarioAlta <=> NEW.usuarioAlta) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'usuarioAlta',
				registro_id = NEW.idarchivo,
				val_old = OLD.usuarioAlta,
				val_nvo = NEW.usuarioAlta,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.actoAdministrativo_idActoAdministrativo <=> NEW.actoAdministrativo_idActoAdministrativo) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idarchivo,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.tipoDocumento_idTipo_documento <=> NEW.tipoDocumento_idTipo_documento) THEN
		INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'tipoDocumento_idTipo_documento',
				registro_id = NEW.idarchivo,
				val_old = OLD.tipoDocumento_idTipo_documento,
				val_nvo = NEW.tipoDocumento_idTipo_documento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `archivo_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`archivo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'idarchivo',
				registro_id = OLD.idarchivo,
				val_old = OLD.idarchivo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'nombreArchivo',
				registro_id = OLD.idarchivo,
				val_old = OLD.nombreArchivo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'extension',
				registro_id = OLD.idarchivo,
				val_old = OLD.extension,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'path',
				registro_id = OLD.idarchivo,
				val_old = OLD.path,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'descripcion',
				registro_id = OLD.idarchivo,
				val_old = OLD.descripcion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'fecha',
				registro_id = OLD.idarchivo,
				val_old = OLD.fecha,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'fechaUpload',
				registro_id = OLD.idarchivo,
				val_old = OLD.fechaUpload,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'usuarioAlta',
				registro_id = OLD.idarchivo,
				val_old = OLD.usuarioAlta,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = OLD.idarchivo,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `archivo_audi` SET
				accion = @accion,
				campo = 'tipoDocumento_idTipo_documento',
				registro_id = OLD.idarchivo,
				val_old = OLD.tipoDocumento_idTipo_documento,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `area_insert` AFTER INSERT ON `desoc_buenaspracticas`.`area`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `area_audi` SET
				accion = @accion,
				campo = 'idArea',
				registro_id = NEW.idArea,
				val_old = '',
				val_nvo = NEW.idArea,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `area_audi` SET
				accion = @accion,
				campo = 'area',
				registro_id = NEW.idArea,
				val_old = '',
				val_nvo = NEW.area,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `area_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`area`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idArea <=> NEW.idArea) THEN
		INSERT INTO `area_audi` SET
				accion = @accion,
				campo = 'idArea',
				registro_id = NEW.idArea,
				val_old = OLD.idArea,
				val_nvo = NEW.idArea,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.area <=> NEW.area) THEN
		INSERT INTO `area_audi` SET
				accion = @accion,
				campo = 'area',
				registro_id = NEW.idArea,
				val_old = OLD.area,
				val_nvo = NEW.area,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `area_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`area`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `area_audi` SET
				accion = @accion,
				campo = 'idArea',
				registro_id = OLD.idArea,
				val_old = OLD.idArea,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `area_audi` SET
				accion = @accion,
				campo = 'area',
				registro_id = OLD.idArea,
				val_old = OLD.area,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `checkRequisitos_insert` AFTER INSERT ON `desoc_buenaspracticas`.`checkRequisitos`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'idcheckRequisitos',
				registro_id = NEW.idcheckRequisitos,
				val_old = '',
				val_nvo = NEW.idcheckRequisitos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'detalleRequisito',
				registro_id = NEW.idcheckRequisitos,
				val_old = '',
				val_nvo = NEW.detalleRequisito,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'validoPara',
				registro_id = NEW.idcheckRequisitos,
				val_old = '',
				val_nvo = NEW.validoPara,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaBaja',
				registro_id = NEW.idcheckRequisitos,
				val_old = '',
				val_nvo = NEW.fechaBaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `checkRequisitos_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`checkRequisitos`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idcheckRequisitos <=> NEW.idcheckRequisitos) THEN
		INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'idcheckRequisitos',
				registro_id = NEW.idcheckRequisitos,
				val_old = OLD.idcheckRequisitos,
				val_nvo = NEW.idcheckRequisitos,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.detalleRequisito <=> NEW.detalleRequisito) THEN
		INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'detalleRequisito',
				registro_id = NEW.idcheckRequisitos,
				val_old = OLD.detalleRequisito,
				val_nvo = NEW.detalleRequisito,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.validoPara <=> NEW.validoPara) THEN
		INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'validoPara',
				registro_id = NEW.idcheckRequisitos,
				val_old = OLD.validoPara,
				val_nvo = NEW.validoPara,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaBaja <=> NEW.fechaBaja) THEN
		INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaBaja',
				registro_id = NEW.idcheckRequisitos,
				val_old = OLD.fechaBaja,
				val_nvo = NEW.fechaBaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `checkRequisitos_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`checkRequisitos`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'idcheckRequisitos',
				registro_id = OLD.idcheckRequisitos,
				val_old = OLD.idcheckRequisitos,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'detalleRequisito',
				registro_id = OLD.idcheckRequisitos,
				val_old = OLD.detalleRequisito,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'validoPara',
				registro_id = OLD.idcheckRequisitos,
				val_old = OLD.validoPara,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `checkRequisitos_audi` SET
				accion = @accion,
				campo = 'fechaBaja',
				registro_id = OLD.idcheckRequisitos,
				val_old = OLD.fechaBaja,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `componente_insert` AFTER INSERT ON `desoc_buenaspracticas`.`componente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `componente_audi` SET
				accion = @accion,
				campo = 'idComponente',
				registro_id = NEW.idComponente,
				val_old = '',
				val_nvo = NEW.idComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `componente_audi` SET
				accion = @accion,
				campo = 'componente',
				registro_id = NEW.idComponente,
				val_old = '',
				val_nvo = NEW.componente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `componente_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`componente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idComponente <=> NEW.idComponente) THEN
		INSERT INTO `componente_audi` SET
				accion = @accion,
				campo = 'idComponente',
				registro_id = NEW.idComponente,
				val_old = OLD.idComponente,
				val_nvo = NEW.idComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.componente <=> NEW.componente) THEN
		INSERT INTO `componente_audi` SET
				accion = @accion,
				campo = 'componente',
				registro_id = NEW.idComponente,
				val_old = OLD.componente,
				val_nvo = NEW.componente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `componente_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`componente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `componente_audi` SET
				accion = @accion,
				campo = 'idComponente',
				registro_id = OLD.idComponente,
				val_old = OLD.idComponente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `componente_audi` SET
				accion = @accion,
				campo = 'componente',
				registro_id = OLD.idComponente,
				val_old = OLD.componente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `detalleComponente_insert` AFTER INSERT ON `desoc_buenaspracticas`.`detalleComponente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'iddetalleComponente',
				registro_id = NEW.iddetalleComponente,
				val_old = '',
				val_nvo = NEW.iddetalleComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'detalleComponente',
				registro_id = NEW.iddetalleComponente,
				val_old = '',
				val_nvo = NEW.detalleComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'componente_idComponente',
				registro_id = NEW.iddetalleComponente,
				val_old = '',
				val_nvo = NEW.componente_idComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `detalleComponente_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`detalleComponente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.iddetalleComponente <=> NEW.iddetalleComponente) THEN
		INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'iddetalleComponente',
				registro_id = NEW.iddetalleComponente,
				val_old = OLD.iddetalleComponente,
				val_nvo = NEW.iddetalleComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.detalleComponente <=> NEW.detalleComponente) THEN
		INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'detalleComponente',
				registro_id = NEW.iddetalleComponente,
				val_old = OLD.detalleComponente,
				val_nvo = NEW.detalleComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.componente_idComponente <=> NEW.componente_idComponente) THEN
		INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'componente_idComponente',
				registro_id = NEW.iddetalleComponente,
				val_old = OLD.componente_idComponente,
				val_nvo = NEW.componente_idComponente,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `detalleComponente_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`detalleComponente`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'iddetalleComponente',
				registro_id = OLD.iddetalleComponente,
				val_old = OLD.iddetalleComponente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'detalleComponente',
				registro_id = OLD.iddetalleComponente,
				val_old = OLD.detalleComponente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `detalleComponente_audi` SET
				accion = @accion,
				campo = 'componente_idComponente',
				registro_id = OLD.iddetalleComponente,
				val_old = OLD.componente_idComponente,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `estadoActoAdministrativo_insert` AFTER INSERT ON `desoc_buenaspracticas`.`estadoActoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `estadoActoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idestado',
				registro_id = NEW.idestado,
				val_old = '',
				val_nvo = NEW.idestado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_audi` SET
				accion = @accion,
				campo = 'estadoDescripcion',
				registro_id = NEW.idestado,
				val_old = '',
				val_nvo = NEW.estadoDescripcion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `estadoActoAdministrativo_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`estadoActoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idestado <=> NEW.idestado) THEN
		INSERT INTO `estadoActoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idestado',
				registro_id = NEW.idestado,
				val_old = OLD.idestado,
				val_nvo = NEW.idestado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.estadoDescripcion <=> NEW.estadoDescripcion) THEN
		INSERT INTO `estadoActoAdministrativo_audi` SET
				accion = @accion,
				campo = 'estadoDescripcion',
				registro_id = NEW.idestado,
				val_old = OLD.estadoDescripcion,
				val_nvo = NEW.estadoDescripcion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `estadoActoAdministrativo_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`estadoActoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `estadoActoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idestado',
				registro_id = OLD.idestado,
				val_old = OLD.idestado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_audi` SET
				accion = @accion,
				campo = 'estadoDescripcion',
				registro_id = OLD.idestado,
				val_old = OLD.estadoDescripcion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `estadoActoAdministrativo_has_actoAdministrativo_insert` AFTER INSERT ON `desoc_buenaspracticas`.`estadoActoAdministrativo_has_actoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idestadoActo_has_actoAdministrativo',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = '',
				val_nvo = NEW.idestadoActo_has_actoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'estadoActoAdministrativo_idestado',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = '',
				val_nvo = NEW.estadoActoAdministrativo_idestado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = '',
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaEstado',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaEstado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacionEstado',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = '',
				val_nvo = NEW.observacionEstado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = '',
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `estadoActoAdministrativo_has_actoAdministrativo_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`estadoActoAdministrativo_has_actoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idestadoActo_has_actoAdministrativo <=> NEW.idestadoActo_has_actoAdministrativo) THEN
		INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idestadoActo_has_actoAdministrativo',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = OLD.idestadoActo_has_actoAdministrativo,
				val_nvo = NEW.idestadoActo_has_actoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.estadoActoAdministrativo_idestado <=> NEW.estadoActoAdministrativo_idestado) THEN
		INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'estadoActoAdministrativo_idestado',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = OLD.estadoActoAdministrativo_idestado,
				val_nvo = NEW.estadoActoAdministrativo_idestado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.actoAdministrativo_idActoAdministrativo <=> NEW.actoAdministrativo_idActoAdministrativo) THEN
		INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaEstado <=> NEW.fechaEstado) THEN
		INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaEstado',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = OLD.fechaEstado,
				val_nvo = NEW.fechaEstado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.observacionEstado <=> NEW.observacionEstado) THEN
		INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacionEstado',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = OLD.observacionEstado,
				val_nvo = NEW.observacionEstado,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaCarga <=> NEW.fechaCarga) THEN
		INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = OLD.fechaCarga,
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.usuario <=> NEW.usuario) THEN
		INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idestadoActo_has_actoAdministrativo,
				val_old = OLD.usuario,
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `estadoActoAdministrativo_has_actoAdministrativo_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`estadoActoAdministrativo_has_actoAdministrativo`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'idestadoActo_has_actoAdministrativo',
				registro_id = OLD.idestadoActo_has_actoAdministrativo,
				val_old = OLD.idestadoActo_has_actoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'estadoActoAdministrativo_idestado',
				registro_id = OLD.idestadoActo_has_actoAdministrativo,
				val_old = OLD.estadoActoAdministrativo_idestado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = OLD.idestadoActo_has_actoAdministrativo,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaEstado',
				registro_id = OLD.idestadoActo_has_actoAdministrativo,
				val_old = OLD.fechaEstado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'observacionEstado',
				registro_id = OLD.idestadoActo_has_actoAdministrativo,
				val_old = OLD.observacionEstado,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = OLD.idestadoActo_has_actoAdministrativo,
				val_old = OLD.fechaCarga,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `estadoActoAdministrativo_has_actoAdministrativo_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = OLD.idestadoActo_has_actoAdministrativo,
				val_old = OLD.usuario,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `movimiento_insert` AFTER INSERT ON `desoc_buenaspracticas`.`movimiento`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'idMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.idMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'area_idAreaOrigen',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.area_idAreaOrigen,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'area_idAreaDestino',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.area_idAreaDestino,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'fechaMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.fechaMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'motivoMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.motivoMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'folios',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.folios,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'tipoMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = '',
				val_nvo = NEW.tipoMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `movimiento_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`movimiento`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idMovimiento <=> NEW.idMovimiento) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'idMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = OLD.idMovimiento,
				val_nvo = NEW.idMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.area_idAreaOrigen <=> NEW.area_idAreaOrigen) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'area_idAreaOrigen',
				registro_id = NEW.idMovimiento,
				val_old = OLD.area_idAreaOrigen,
				val_nvo = NEW.area_idAreaOrigen,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.area_idAreaDestino <=> NEW.area_idAreaDestino) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'area_idAreaDestino',
				registro_id = NEW.idMovimiento,
				val_old = OLD.area_idAreaDestino,
				val_nvo = NEW.area_idAreaDestino,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaMovimiento <=> NEW.fechaMovimiento) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'fechaMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = OLD.fechaMovimiento,
				val_nvo = NEW.fechaMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.motivoMovimiento <=> NEW.motivoMovimiento) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'motivoMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = OLD.motivoMovimiento,
				val_nvo = NEW.motivoMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.observacion <=> NEW.observacion) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.idMovimiento,
				val_old = OLD.observacion,
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.folios <=> NEW.folios) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'folios',
				registro_id = NEW.idMovimiento,
				val_old = OLD.folios,
				val_nvo = NEW.folios,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaCarga <=> NEW.fechaCarga) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idMovimiento,
				val_old = OLD.fechaCarga,
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.usuario <=> NEW.usuario) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idMovimiento,
				val_old = OLD.usuario,
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.actoAdministrativo_idActoAdministrativo <=> NEW.actoAdministrativo_idActoAdministrativo) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idMovimiento,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.tipoMovimiento <=> NEW.tipoMovimiento) THEN
		INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'tipoMovimiento',
				registro_id = NEW.idMovimiento,
				val_old = OLD.tipoMovimiento,
				val_nvo = NEW.tipoMovimiento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `movimiento_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`movimiento`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'idMovimiento',
				registro_id = OLD.idMovimiento,
				val_old = OLD.idMovimiento,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'area_idAreaOrigen',
				registro_id = OLD.idMovimiento,
				val_old = OLD.area_idAreaOrigen,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'area_idAreaDestino',
				registro_id = OLD.idMovimiento,
				val_old = OLD.area_idAreaDestino,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'fechaMovimiento',
				registro_id = OLD.idMovimiento,
				val_old = OLD.fechaMovimiento,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'motivoMovimiento',
				registro_id = OLD.idMovimiento,
				val_old = OLD.motivoMovimiento,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = OLD.idMovimiento,
				val_old = OLD.observacion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'folios',
				registro_id = OLD.idMovimiento,
				val_old = OLD.folios,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = OLD.idMovimiento,
				val_old = OLD.fechaCarga,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = OLD.idMovimiento,
				val_old = OLD.usuario,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = OLD.idMovimiento,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `movimiento_audi` SET
				accion = @accion,
				campo = 'tipoMovimiento',
				registro_id = OLD.idMovimiento,
				val_old = OLD.tipoMovimiento,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `observaciones_bp_insert` AFTER INSERT ON `desoc_buenaspracticas`.`observaciones_bp`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'idObservacionActoAdministrativo',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = '',
				val_nvo = NEW.idObservacionActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = '',
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'fechaObs',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaObs,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = '',
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = '',
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = '',
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `observaciones_bp_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`observaciones_bp`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idObservacionActoAdministrativo <=> NEW.idObservacionActoAdministrativo) THEN
		INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'idObservacionActoAdministrativo',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = OLD.idObservacionActoAdministrativo,
				val_nvo = NEW.idObservacionActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.observacion <=> NEW.observacion) THEN
		INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = OLD.observacion,
				val_nvo = NEW.observacion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaObs <=> NEW.fechaObs) THEN
		INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'fechaObs',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = OLD.fechaObs,
				val_nvo = NEW.fechaObs,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.usuario <=> NEW.usuario) THEN
		INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = OLD.usuario,
				val_nvo = NEW.usuario,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechaCarga <=> NEW.fechaCarga) THEN
		INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = OLD.fechaCarga,
				val_nvo = NEW.fechaCarga,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.actoAdministrativo_idActoAdministrativo <=> NEW.actoAdministrativo_idActoAdministrativo) THEN
		INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = NEW.idObservacionActoAdministrativo,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = NEW.actoAdministrativo_idActoAdministrativo,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `observaciones_bp_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`observaciones_bp`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'idObservacionActoAdministrativo',
				registro_id = OLD.idObservacionActoAdministrativo,
				val_old = OLD.idObservacionActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'observacion',
				registro_id = OLD.idObservacionActoAdministrativo,
				val_old = OLD.observacion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'fechaObs',
				registro_id = OLD.idObservacionActoAdministrativo,
				val_old = OLD.fechaObs,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'usuario',
				registro_id = OLD.idObservacionActoAdministrativo,
				val_old = OLD.usuario,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'fechaCarga',
				registro_id = OLD.idObservacionActoAdministrativo,
				val_old = OLD.fechaCarga,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `observaciones_bp_audi` SET
				accion = @accion,
				campo = 'actoAdministrativo_idActoAdministrativo',
				registro_id = OLD.idObservacionActoAdministrativo,
				val_old = OLD.actoAdministrativo_idActoAdministrativo,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `tipoDocumento_insert` AFTER INSERT ON `desoc_buenaspracticas`.`tipoDocumento`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'idtipo_documento',
				registro_id = NEW.idtipo_documento,
				val_old = '',
				val_nvo = NEW.idtipo_documento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'descripciondocumento',
				registro_id = NEW.idtipo_documento,
				val_old = '',
				val_nvo = NEW.descripciondocumento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'fechabaja',
				registro_id = NEW.idtipo_documento,
				val_old = '',
				val_nvo = NEW.fechabaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'area',
				registro_id = NEW.idtipo_documento,
				val_old = '',
				val_nvo = NEW.area,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `tipoDocumento_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`tipoDocumento`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idtipo_documento <=> NEW.idtipo_documento) THEN
		INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'idtipo_documento',
				registro_id = NEW.idtipo_documento,
				val_old = OLD.idtipo_documento,
				val_nvo = NEW.idtipo_documento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.descripciondocumento <=> NEW.descripciondocumento) THEN
		INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'descripciondocumento',
				registro_id = NEW.idtipo_documento,
				val_old = OLD.descripciondocumento,
				val_nvo = NEW.descripciondocumento,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.fechabaja <=> NEW.fechabaja) THEN
		INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'fechabaja',
				registro_id = NEW.idtipo_documento,
				val_old = OLD.fechabaja,
				val_nvo = NEW.fechabaja,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.area <=> NEW.area) THEN
		INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'area',
				registro_id = NEW.idtipo_documento,
				val_old = OLD.area,
				val_nvo = NEW.area,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `tipoDocumento_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`tipoDocumento`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'idtipo_documento',
				registro_id = OLD.idtipo_documento,
				val_old = OLD.idtipo_documento,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'descripciondocumento',
				registro_id = OLD.idtipo_documento,
				val_old = OLD.descripciondocumento,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'fechabaja',
				registro_id = OLD.idtipo_documento,
				val_old = OLD.fechabaja,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoDocumento_audi` SET
				accion = @accion,
				campo = 'area',
				registro_id = OLD.idtipo_documento,
				val_old = OLD.area,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `tipoSolicitante_insert` AFTER INSERT ON `desoc_buenaspracticas`.`tipoSolicitante`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'INSERT';

	INSERT INTO `tipoSolicitante_audi` SET
				accion = @accion,
				campo = 'idtipoSolicitante',
				registro_id = NEW.idtipoSolicitante,
				val_old = '',
				val_nvo = NEW.idtipoSolicitante,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoSolicitante_audi` SET
				accion = @accion,
				campo = 'descripcion',
				registro_id = NEW.idtipoSolicitante,
				val_old = '',
				val_nvo = NEW.descripcion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `tipoSolicitante_update` BEFORE UPDATE ON `desoc_buenaspracticas`.`tipoSolicitante`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'UPDATE';

	IF NOT (OLD.idtipoSolicitante <=> NEW.idtipoSolicitante) THEN
		INSERT INTO `tipoSolicitante_audi` SET
				accion = @accion,
				campo = 'idtipoSolicitante',
				registro_id = NEW.idtipoSolicitante,
				val_old = OLD.idtipoSolicitante,
				val_nvo = NEW.idtipoSolicitante,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
	IF NOT (OLD.descripcion <=> NEW.descripcion) THEN
		INSERT INTO `tipoSolicitante_audi` SET
				accion = @accion,
				campo = 'descripcion',
				registro_id = NEW.idtipoSolicitante,
				val_old = OLD.descripcion,
				val_nvo = NEW.descripcion,
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	END IF;
END;
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER `tipoSolicitante_delete` BEFORE DELETE ON `desoc_buenaspracticas`.`tipoSolicitante`
FOR EACH ROW
BEGIN
	SET @marca = NOW();
	SET @accion = 'DELETE';

	INSERT INTO `tipoSolicitante_audi` SET
				accion = @accion,
				campo = 'idtipoSolicitante',
				registro_id = OLD.idtipoSolicitante,
				val_old = OLD.idtipoSolicitante,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
	INSERT INTO `tipoSolicitante_audi` SET
				accion = @accion,
				campo = 'descripcion',
				registro_id = OLD.idtipoSolicitante,
				val_old = OLD.descripcion,
				val_nvo = '',
				usuario = @user_name,
				dir_ip = @dir_ip_cliente,
				marca =  @marca;
END;
|
DELIMITER ;

