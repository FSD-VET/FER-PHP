-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetophp4
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projetophp4
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetophp4` DEFAULT CHARACTER SET utf8 ;
USE `projetophp4` ;

-- -----------------------------------------------------
-- Table `projetophp4`.`veiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp4`.`veiculos` (
  `idveiculos` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(7) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `ano_fabricacao` YEAR(4) NOT NULL,
  `tipo_combustivel` VARCHAR(45) NOT NULL,
  `capacidade` INT NOT NULL,
  `ano_incorporacao` YEAR(4) NOT NULL,
  `ano_baixa` YEAR(4) NULL,
  PRIMARY KEY (`idveiculos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetophp4`.`motorista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp4`.`motorista` (
  `idmotorista` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `numero_cnh` VARCHAR(20) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `multas` INT NOT NULL,
  PRIMARY KEY (`idmotorista`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetophp4`.`viagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp4`.`viagem` (
  `idviagem` INT NOT NULL AUTO_INCREMENT,
  `origem` VARCHAR(150) NOT NULL,
  `destino` VARCHAR(150) NOT NULL,
  `distancia` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`idviagem`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetophp4`.`corrida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp4`.`corrida` (
  `idcorrida` INT NOT NULL AUTO_INCREMENT,
  `valor_corrida` DECIMAL(10,2) NOT NULL,
  `viagem_idviagem` INT NOT NULL,
  `motorista_idmotorista` INT NOT NULL,
  `data_corrida` INT NOT NULL,
  `veiculos_idveiculos` INT NOT NULL,
  PRIMARY KEY (`idcorrida`),
  INDEX `fk_corrida_viagem_idx` (`viagem_idviagem` ASC),
  INDEX `fk_corrida_motorista1_idx` (`motorista_idmotorista` ASC),
  INDEX `fk_corrida_veiculos1_idx` (`veiculos_idveiculos` ASC),
  CONSTRAINT `fk_corrida_viagem`
    FOREIGN KEY (`viagem_idviagem`)
    REFERENCES `projetophp4`.`viagem` (`idviagem`) -- CORRIGIDO
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_corrida_motorista1`
    FOREIGN KEY (`motorista_idmotorista`)
    REFERENCES `projetophp4`.`motorista` (`idmotorista`) -- CORRIGIDO
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_corrida_veiculos1`
    FOREIGN KEY (`veiculos_idveiculos`)
    REFERENCES `projetophp4`.`veiculos` (`idveiculos`) -- CORRIGIDO
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetophp4`.`usuarios`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `projetophp4`.`usuarios` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table `projetophp4`.`passageiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp4`.`passageiro` (
  `idpassageiro` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `endereco` VARCHAR(200) NULL, -- Endereço pode ser opcional
  PRIMARY KEY (`idpassageiro`))
ENGINE = InnoDB;


-- Adicionar a coluna `passageiro_idpassageiro` e a chave estrangeira na tabela `corrida`
ALTER TABLE `projetophp4`.`corrida`
ADD COLUMN `passageiro_idpassageiro` INT NOT NULL AFTER `veiculos_idveiculos`,
ADD INDEX `fk_corrida_passageiro1_idx` (`passageiro_idpassageiro` ASC);

ALTER TABLE `projetophp4`.`corrida`
ADD CONSTRAINT `fk_corrida_passageiro1`
  FOREIGN KEY (`passageiro_idpassageiro`)
  REFERENCES `projetophp4`.`passageiro` (`idpassageiro`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `projetophp4`.`viagem`
ADD COLUMN `data_viagem` DATE NOT NULL AFTER `distancia`;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
 
-- drop schema projetophp4;