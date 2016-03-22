
CREATE TABLE IF NOT EXISTS `eventos`.`participante_status` (
  `id` TINYINT NOT NULL AUTO_INCREMENT ,
  `status` VARCHAR(250) NULL ,
  PRIMARY KEY (`id`)  )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eventos`.`participante`
-- -----------------------------------------------------
use eventos;

CREATE TABLE IF NOT EXISTS `eventos`.`participantes` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`contato_id` INT NULL ,
	`evento_perfil_id` INT NULL ,
	`participante_status_id` TINYINT NULL ,
	`data_inicio` TIMESTAMP NULL,
	`data_conclusao` TIMESTAMP NULL ,
	`data_checkin` TIMESTAMP NULL ,
	`chave` VARCHAR(36) NOT NULL DEFAULT 'UUID()' ,
	`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp NULL,
  PRIMARY KEY (`id`, `chave`)  ,
  INDEX `fk_participante_formulario_idx` (`evento_perfil_id` ASC)  ,
  INDEX `fk_participante_participante_status_idx` (`participante_status_id` ASC)  ,
  INDEX `fk_participante_contato_idx` (`contato_id` ASC)  ,
  CONSTRAINT `fk_participante_evento_perfil`
    FOREIGN KEY (`evento_perfil_id`)
    REFERENCES `eventos`.`evento_perfis` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participante_participante_status`
    FOREIGN KEY (`participante_status_id`)
    REFERENCES `eventos`.`participante_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participante_contato`
    FOREIGN KEY (`contato_id`)
    REFERENCES `eventos`.`contatos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `eventos`.`participante_campo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`participante_campos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `campo_id` INT NOT NULL ,
  `participante_id` INT NOT NULL ,
  `valor` VARCHAR(1000) NULL ,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp NULL,
  PRIMARY KEY (`id`)  ,
  INDEX `fk_participante_campo_formulario_campo_idx` (`campo_id` ASC)  ,
  INDEX `fk_participante_campo_participante_formulario_idx` (`participante_id` ASC)  ,
  CONSTRAINT `fk_participante_campo_formulario_campo`
    FOREIGN KEY (`campo_id`)
    REFERENCES `eventos`.`campos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participante_campo_participante_formulario`
    FOREIGN KEY (`participante_id`)
    REFERENCES `eventos`.`participantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eventos`.`participante_campo_alternativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`participante_campo_alternativas` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`participante_campo_id` INT NOT NULL,
	`campo_alternativa_id` INT NOT NULL,
	`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_participante_campo_alternativa_campo_alternat_idx` (`campo_alternativa_id` ASC)  ,
  INDEX `fk_participante_campo_alternativa_participante_campo_idx` (`participante_campo_id` ASC)  ,
  CONSTRAINT `fk_participante_campo_alternativa_formulario_campo_alternativa`
    FOREIGN KEY (`campo_alternativa_id`)
    REFERENCES `eventos`.`campo_alternativas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participante_campo_alternativa_participante_campo`
    FOREIGN KEY (`participante_campo_id`)
    REFERENCES `eventos`.`participante_campos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eventos`.`tipo_pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`tipo_pagamentos` (
  `id` INT NOT NULL ,
  `titulo` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`id`)  )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eventos`.`status_pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`status_pagamentos` (
  `id` TINYINT NOT NULL ,
  `titulo` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`id`)  )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eventos`.`venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`vendas` (
	`id` INT NOT NULL ,
	`participante_id` INT NOT NULL ,
	`tipo_pagamento_id` INT NULL ,
	`status_pagamento_id` TINYINT NULL ,
	`valor` DECIMAL(15,2) NOT NULL ,
	`desconto` DECIMAL(15,2) NULL ,
	`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp NULL,
  PRIMARY KEY (`id`)  ,
  INDEX `fk_venda_participante_idx` (`participante_id` ASC)  ,
  INDEX `fk_venda_tipo_pagamento_idx` (`tipo_pagamento_id` ASC)  ,
  INDEX `fk_venda_status_pagamento_idx` (`status_pagamento_id` ASC)  ,
  CONSTRAINT `fk_venda_participante`
    FOREIGN KEY (`participante_id`)
    REFERENCES `eventos`.`participantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venda_tipo_pagamento`
    FOREIGN KEY (`tipo_pagamento_id`)
    REFERENCES `eventos`.`tipo_pagamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venda_status_pagamento`
    FOREIGN KEY (`status_pagamento_id`)
    REFERENCES `eventos`.`status_pagamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `eventos`.`venda_cupom_desconto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`venda_cupom_descontos` (
  `id` INT NOT NULL ,
  venda_id INT NOT NULL,
  `cupom_desconto_id` INT NOT NULL ,
  PRIMARY KEY (`venda_id`)  ,
  INDEX `fk_venda_cupom_desconto_cupom_desconto_idx` (`cupom_desconto_id` ASC)  ,
  INDEX `fk_venda_cupom_desconto_venda_idx` (`venda_id` ASC)  ,
  CONSTRAINT `fk_venda_cupom_desconto_venda`
    FOREIGN KEY (`venda_id`)
    REFERENCES `eventos`.`vendas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venda_cupom_desconto_cupom_desconto`
    FOREIGN KEY (`cupom_desconto_id`)
    REFERENCES `eventos`.`cupom_descontos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;