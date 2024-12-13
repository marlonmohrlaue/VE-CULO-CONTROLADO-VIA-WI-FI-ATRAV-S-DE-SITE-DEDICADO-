
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `ppo` DEFAULT CHARACTER SET utf8 ;
USE `ppo` ;

-- -----------------------------------------------------
-- Table `ppo`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ppo`.`usuario` (
  `idlogin` INT NOT NULL AUTO_INCREMENT,
  `numvei` VARCHAR(45) NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idlogin`),
  UNIQUE INDEX `numvei_UNIQUE` (`numvei` ASC))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `ppo`.`doca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ppo`.`doca` (
  `iddoca` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpres` VARCHAR(45) NOT NULL,
  `cmax` VARCHAR(45) NOT NULL,
  `local` VARCHAR(45) NOT NULL,
  `usuario_idlogin` INT NOT NULL,
  PRIMARY KEY (`iddoca`),
  INDEX `fk_doca_usuario1_idx` (`usuario_idlogin` ASC),
  CONSTRAINT `fk_doca_usuario1`
    FOREIGN KEY (`usuario_idlogin`)
    REFERENCES `ppo`.`usuario` (`idlogin`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `ppo`.`carga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ppo`.`carga` (
  `idcarga` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `conteudo` VARCHAR(45) NOT NULL,
  `peso` VARCHAR(45) NOT NULL,
  `iddoca` INT NOT NULL,
  PRIMARY KEY (`idcarga`),
  INDEX `iddoca_idx` (`iddoca` ASC),
  CONSTRAINT `iddoca`
    FOREIGN KEY (`iddoca`)
    REFERENCES `ppo`.`doca` (`iddoca`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    acao VARCHAR(255) NOT NULL,
    entidade VARCHAR(100) NOT NULL,
    dados VARCHAR(255) NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(100)
);

-- Restaura os modos de verificação antigos
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
