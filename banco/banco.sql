-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema banco
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema banco
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `banco` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `banco` ;

-- -----------------------------------------------------
-- Table `banco`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`pessoa` (
  `pessoa_id` INT NOT NULL AUTO_INCREMENT,
  `pessoa_nome` VARCHAR(255) NOT NULL,
  `pessoa_email` VARCHAR(255) NOT NULL,
  `pessoa_senha` VARCHAR(45) NOT NULL,
  `pessoa_tipo` VARCHAR(255) NOT NULL,
  `pessoa_data_nascimento` DATE NOT NULL,
  `pessoa_peso` FLOAT NOT NULL,
  `pessoa_altura` FLOAT NOT NULL,
  PRIMARY KEY (`pessoa_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `banco`.`cuidado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`cuidado` (
  `cuidado_id` INT NOT NULL AUTO_INCREMENT,
  `cuidado_nome` VARCHAR(255) NOT NULL,
  `cuidado_data_nas` VARCHAR(255) NOT NULL,
  `cuidado_foto` VARCHAR(200) NOT NULL,
  `fk_pessoa_cuidador` INT NOT NULL,
  `fk_pessoa_paciente` INT NOT NULL,
  PRIMARY KEY (`cuidado_id`),
  UNIQUE INDEX `uq_cuidado_prescricao` (`cuidado_id` ASC, `fk_pessoa_paciente` ASC, `fk_pessoa_cuidador` ASC) VISIBLE,
  INDEX `fk_pessoa_cuidador_idx` (`fk_pessoa_cuidador` ASC) VISIBLE,
  INDEX `fk_pessoa_paciente_idx` (`fk_pessoa_paciente` ASC) VISIBLE,
  CONSTRAINT `fk_pessoa_cuidador`
    FOREIGN KEY (`fk_pessoa_cuidador`)
    REFERENCES `banco`.`pessoa` (`pessoa_id`),
  CONSTRAINT `fk_pessoa_paciente`
    FOREIGN KEY (`fk_pessoa_paciente`)
    REFERENCES `banco`.`pessoa` (`pessoa_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `banco`.`medicamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`medicamento` (
  `medicamento_id` INT NOT NULL AUTO_INCREMENT,
  `medicamento_nome` VARCHAR(255) NOT NULL,
  `medicamento_foto` VARCHAR(200) NOT NULL,
  `medicamento_laboratorio` VARCHAR(255) NOT NULL,
  `medicamento_categoria` VARCHAR(255) NOT NULL,
  `medicamento_obervacao` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`medicamento_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `banco`.`prescricao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco`.`prescricao` (
  `medicamento_medicamento_id` INT NOT NULL,
  `cuidado_cuidado_id` INT NOT NULL,
  `cuidado_fk_pessoa_paciente` INT NOT NULL,
  `cuidado_fk_pessoa_cuidador` INT NOT NULL,
  `prescricao_frequencia` INT NOT NULL,
  `prescricao_dosagem` FLOAT NOT NULL,
  `prescricao_horario_primeira_dose` DATETIME NOT NULL,
  `prescricao_data_inicio` DATE NOT NULL,
  `prescricao_observacao` VARCHAR(255) NOT NULL,
  `prescricao_tomada` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`medicamento_medicamento_id`, `cuidado_cuidado_id`, `cuidado_fk_pessoa_paciente`, `cuidado_fk_pessoa_cuidador`),
  INDEX `idx_prescricao_cuidado` (`cuidado_cuidado_id` ASC, `cuidado_fk_pessoa_paciente` ASC, `cuidado_fk_pessoa_cuidador` ASC) VISIBLE,
  INDEX `idx_prescricao_medicamento` (`medicamento_medicamento_id` ASC) VISIBLE,
  CONSTRAINT `fk_prescricao_cuidado`
    FOREIGN KEY (`cuidado_cuidado_id` , `cuidado_fk_pessoa_paciente` , `cuidado_fk_pessoa_cuidador`)
    REFERENCES `banco`.`cuidado` (`cuidado_id` , `fk_pessoa_paciente` , `fk_pessoa_cuidador`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_prescricao_medicamento`
    FOREIGN KEY (`medicamento_medicamento_id`)
    REFERENCES `banco`.`medicamento` (`medicamento_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
