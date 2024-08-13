CREATE TABLE membros
(
    id        INT             NOT NULL    AUTO_INCREMENT,
    nome      VARCHAR(350)    NOT NULL,
    email     VARCHAR(150)    NOT NULL,  
    telefone     VARCHAR(150)    NOT NULL,
    cpf     VARCHAR(150)    NOT NULL,          
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;