SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `User` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `last_name` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(40) NOT NULL ,
  `user` VARCHAR(40) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `type` VARCHAR(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Area`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Area` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `area` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `idArea_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `area_UNIQUE` (`area` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Activity`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Activity` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `activity` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `activity_UNIQUE` (`activity` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Section`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Section` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `section` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `section_UNIQUE` (`section` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Document_Type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Document_Type` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `type_UNIQUE` (`type` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Document_Area`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Document_Area` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `documentType_id` INT UNSIGNED NOT NULL ,
  `area_id` INT UNSIGNED NOT NULL ,
  INDEX `FK_DocumentArea_to_DocumentType_idx` (`documentType_id` ASC) ,
  INDEX `FK_DocumentArea_to_Area_idx` (`area_id` ASC) ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `FK_DocumentArea_to_DocumentType`
    FOREIGN KEY (`documentType_id` )
    REFERENCES `Document_Type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_DocumentArea_to_Area`
    FOREIGN KEY (`area_id` )
    REFERENCES `Area` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Document_Activity`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Document_Activity` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `documentArea_id` INT UNSIGNED NOT NULL ,
  `activity_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_DocumentActivity_to_Activity_idx` (`activity_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `FK_DocumentActivity_to_DocumentArea_id_idx` (`documentArea_id` ASC) ,
  CONSTRAINT `FK_DocumentActivity_to_Activity`
    FOREIGN KEY (`activity_id` )
    REFERENCES `Activity` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_DocumentActivity_to_DocumentArea_id`
    FOREIGN KEY (`documentArea_id` )
    REFERENCES `Document_Area` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Document_section`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Document_section` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `documentActivity_id` INT UNSIGNED NOT NULL ,
  `section_id` INT UNSIGNED NOT NULL ,
  INDEX `FK_DocumentSection_to_DocumentActivity_activity_idx` (`documentActivity_id` ASC) ,
  INDEX `FK_DocumentSetion_to_Section_idx` (`section_id` ASC) ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `FK_DocumentSection_to_DocumentActivity_id`
    FOREIGN KEY (`documentActivity_id` )
    REFERENCES `Document_Activity` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_DocumentSetion_to_Section`
    FOREIGN KEY (`section_id` )
    REFERENCES `Section` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Document`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Document` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `type_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `creation_date` DATETIME NOT NULL ,
  `semester` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `FK_Document_to_User_idx` (`user_id` ASC) ,
  INDEX `FK_Document_to_DocumentType_idx` (`type_id` ASC) ,
  CONSTRAINT `FK_Document_to_User`
    FOREIGN KEY (`user_id` )
    REFERENCES `User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Document_to_DocumentType`
    FOREIGN KEY (`type_id` )
    REFERENCES `Document_Type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Area_List`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Area_List` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `area_id` INT UNSIGNED NOT NULL ,
  `document_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `FK_AreaList_to_DocumentArea_area_idx` (`area_id` ASC) ,
  INDEX `FK_AreaList_to_Document_id_idx` (`document_id` ASC) ,
  CONSTRAINT `FK_AreaList_to_DocumentArea_area`
    FOREIGN KEY (`area_id` )
    REFERENCES `Document_Area` (`area_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_AreaList_to_Document_id`
    FOREIGN KEY (`document_id` )
    REFERENCES `Document` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Activity_List`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Activity_List` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `activity_id` INT UNSIGNED NOT NULL ,
  `areaList_id` INT UNSIGNED NOT NULL ,
  `weekly_hours` INT UNSIGNED NULL ,
  INDEX `FK_horasActividad_to_actividad_idx` (`activity_id` ASC) ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `FK_ActivityList_to_Document_idx` (`areaList_id` ASC) ,
  CONSTRAINT `FK_ActivityList_to_DocumentActivity_activityId`
    FOREIGN KEY (`activity_id` )
    REFERENCES `Document_Activity` (`activity_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ActivityList_to_AreaList_id`
    FOREIGN KEY (`areaList_id` )
    REFERENCES `Area_List` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Section_List`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Section_List` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `activityList_id` INT UNSIGNED NOT NULL ,
  `section_id` INT UNSIGNED NOT NULL ,
  INDEX `FK_listaSeccion_to_listaActividad_idx` (`section_id` ASC) ,
  INDEX `FK_SectionList_to_ActivityList_activity_idx` (`activityList_id` ASC) ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `FK_SectionList_to_DocumentSection_section`
    FOREIGN KEY (`section_id` )
    REFERENCES `Document_section` (`section_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_SectionList_to_ActivityList_activity`
    FOREIGN KEY (`activityList_id` )
    REFERENCES `Activity_List` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Section_Content`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Section_Content` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `sectionList_id` INT UNSIGNED NOT NULL ,
  `contenido` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `FK_contenidoSeccion_to_seccion_idx` (`sectionList_id` ASC) ,
  CONSTRAINT `FK_SectionContent_to_SectionList_id`
    FOREIGN KEY (`sectionList_id` )
    REFERENCES `Section_List` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Appointment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Appointment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `appointment` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `appointment_UNIQUE` (`appointment` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `General_Data`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `General_Data` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `document_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `weekly_hours` INT UNSIGNED NOT NULL ,
  `category_level` VARCHAR(100) NULL ,
  `appointment_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `FK_GeneralData_ti_idx` (`document_id` ASC) ,
  INDEX `FK_GeneralData_toAppointment_id_idx` (`appointment_id` ASC) ,
  CONSTRAINT `FK_GeneralData_to_Document_id`
    FOREIGN KEY (`document_id` )
    REFERENCES `Document` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_GeneralData_toAppointment_id`
    FOREIGN KEY (`appointment_id` )
    REFERENCES `Appointment` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Perfil` (
  `user_id` INT UNSIGNED NOT NULL ,
  `weekly_hours` INT UNSIGNED NOT NULL ,
  `category_level` VARCHAR(100) NULL ,
  `photo` BLOB NULL ,
  `appointment_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `FK_Perfil_to_Usuario_idx` (`user_id` ASC) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
  INDEX `FK_Perfil_to_Appointment_id_idx` (`appointment_id` ASC) ,
  CONSTRAINT `FK_Perfil_to_User_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Perfil_to_Appointment_id`
    FOREIGN KEY (`appointment_id` )
    REFERENCES `Appointment` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Recognition`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Recognition` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `recognition` VARCHAR(45) NOT NULL ,
  `level` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `recognition_UNIQUE` (`recognition` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Level`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Level` (
  `level` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`level`) ,
  UNIQUE INDEX `id_UNIQUE` (`level` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Recognition_Perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Recognition_Perfil` (
  `recognition_id` INT UNSIGNED NOT NULL ,
  `perfil_id` INT UNSIGNED NOT NULL ,
  `level_id` INT UNSIGNED NULL ,
  PRIMARY KEY (`recognition_id`, `perfil_id`) ,
  INDEX `FK_RecognitionPerfil_to_Recognition_id_idx` (`recognition_id` ASC) ,
  INDEX `FK_RecognitionPerfil_to_Perfil_id_idx` (`perfil_id` ASC) ,
  INDEX `FK_RecognitionPerfil_to_Level_id_idx` (`level_id` ASC) ,
  CONSTRAINT `FK_RecognitionPerfil_to_Recognition_id`
    FOREIGN KEY (`recognition_id` )
    REFERENCES `Recognition` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_RecognitionPerfil_to_Perfil_id`
    FOREIGN KEY (`perfil_id` )
    REFERENCES `Perfil` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_RecognitionPerfil_to_Level_id`
    FOREIGN KEY (`level_id` )
    REFERENCES `Level` (`level` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Recognition_GeneralData`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Recognition_GeneralData` (
  `recognition_id` INT UNSIGNED NOT NULL ,
  `generalData_id` INT UNSIGNED NOT NULL ,
  `level_id` INT UNSIGNED NULL ,
  PRIMARY KEY (`recognition_id`, `generalData_id`) ,
  INDEX `FK_RecognitionGeneralData_to_GeneralData_id_idx` (`generalData_id` ASC) ,
  INDEX `FK_RecognitionGeneralData_to_Recognition_id_idx` (`recognition_id` ASC) ,
  INDEX `FK_RecognitionGeneralData_to_Level_idx` (`level_id` ASC) ,
  CONSTRAINT `FK_RecognitionGeneralData_to_GeneralData_id`
    FOREIGN KEY (`generalData_id` )
    REFERENCES `General_Data` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_RecognitionGeneralData_to_Recognition_id`
    FOREIGN KEY (`recognition_id` )
    REFERENCES `Recognition` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_RecognitionGeneralData_to_Level_level`
    FOREIGN KEY (`level_id` )
    REFERENCES `Level` (`level` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
