USE talentos;

CREATE TABLE profissional
(
	idProfissional INT NOT NULL AUTO_INCREMENT,
    codJob VARCHAR(100),
    dataInclusao TIMESTAMP,
    dataExpiracao TIMESTAMP,
    profissao VARCHAR(250),
    cargo VARCHAR(250),
    localidade VARCHAR(250),profissional
	salario NUMERIC(10,2),
    sinopse VARCHAR(8000),
    CONSTRAINT PK_profissional PRIMARY KEY (idProfissional)
);

DROP TABLE profissional