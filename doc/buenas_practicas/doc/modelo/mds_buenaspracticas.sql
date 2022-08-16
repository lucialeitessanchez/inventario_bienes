SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mds_buenaspracticas` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci ;
USE `mds_buenaspracticas` ;

-- -----------------------------------------------------
-- Table `mds_buenaspracticas`.`expte_bp`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mds_buenaspracticas`.`expte_bp` (
  `idbuenas_practicas` INT NOT NULL AUTO_INCREMENT ,
  `nro_expte` DECIMAL(10,0)  NOT NULL ,
  `observacion` MEDIUMBLOB NULL ,
  `fecha_carga` DATE NOT NULL ,
  `proy_desc` TEXT NOT NULL ,
  `Institucion_inst_id` INT NOT NULL ,
  PRIMARY KEY (`idbuenas_practicas`) ,
  INDEX `fk_buenas_practicas_Institucion1` (`Institucion_inst_id` ASC) ,
  UNIQUE INDEX `nro_expte_UNIQUE` (`nro_expte` ASC) ,
  CONSTRAINT `fk_buenas_practicas_Institucion1`
    FOREIGN KEY (`Institucion_inst_id` )
    REFERENCES `mds_buenaspracticas`.`Institucion` (`inst_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `mds_buenaspracticas`.`estado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mds_buenaspracticas`.`estado` (
  `idestado` INT NOT NULL AUTO_INCREMENT ,
  `estado_desc` VARCHAR(45) NULL ,
  PRIMARY KEY (`idestado`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `mds_buenaspracticas`.`solicitud`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mds_buenaspracticas`.`solicitud` (
  `idexpte_detalle` INT NOT NULL AUTO_INCREMENT ,
  `fecha_solicitud` VARCHAR(45) NULL ,
  `monto_solicitado` DOUBLE NOT NULL ,
  `monto_aprobado` DOUBLE NULL ,
  `cant_etapa` INT NULL ,
  `observacion` VARCHAR(45) NULL ,
  `expte_bp_idbuenas_practicas` INT NOT NULL ,
  PRIMARY KEY (`idexpte_detalle`) ,
  INDEX `fk_solicitud_expte_bp1` (`expte_bp_idbuenas_practicas` ASC) ,
  CONSTRAINT `fk_solicitud_expte_bp1`
    FOREIGN KEY (`expte_bp_idbuenas_practicas` )
    REFERENCES `mds_buenaspracticas`.`expte_bp` (`idbuenas_practicas` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `mds_buenaspracticas`.`solicitud_estado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mds_buenaspracticas`.`solicitud_estado` (
  `idexpte_estado` INT NOT NULL AUTO_INCREMENT ,
  `fecha_estado` DATETIME NOT NULL ,
  `obs_estado` LONGTEXT NULL ,
  `estado_idestado` INT NOT NULL ,
  `solicitud_idexpte_detalle` INT NOT NULL ,
  PRIMARY KEY (`idexpte_estado`) ,
  INDEX `fk_expte_estado_estado1` (`estado_idestado` ASC) ,
  INDEX `fk_solicitud_estado_solicitud1` (`solicitud_idexpte_detalle` ASC) ,
  CONSTRAINT `fk_expte_estado_estado1`
    FOREIGN KEY (`estado_idestado` )
    REFERENCES `mds_buenaspracticas`.`estado` (`idestado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitud_estado_solicitud1`
    FOREIGN KEY (`solicitud_idexpte_detalle` )
    REFERENCES `mds_buenaspracticas`.`solicitud` (`idexpte_detalle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `mds_buenaspracticas`.`observaciones_bp`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mds_buenaspracticas`.`observaciones_bp` (
  `idobservaciones_bp` INT NOT NULL AUTO_INCREMENT ,
  `observaciones` VARCHAR(45) NULL ,
  `fecha_obs` VARCHAR(45) NULL ,
  `Institucion_inst_id` INT NOT NULL ,
  PRIMARY KEY (`idobservaciones_bp`) ,
  INDEX `fk_observaciones_bp_Institucion1` (`Institucion_inst_id` ASC) ,
  CONSTRAINT `fk_observaciones_bp_Institucion1`
    FOREIGN KEY (`Institucion_inst_id` )
    REFERENCES `mds_buenaspracticas`.`Institucion` (`inst_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
