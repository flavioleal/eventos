DROP DATABASE IF EXISTS sisloc;
CREATE DATABASE sisloc;
USE sisloc;

/**
* char(5)
* vachar(5)
*/

CREATE TABLE cliente
(
	id INT NOT NULL AUTO_INCREMENT, # PRIMARY KEY,
    nome VARCHAR(250) NOT NULL UNIQUE,
    email VARCHAR(100) NULL,
    ativo boolean NOT NULL DEFAULT 1 CHECK (ativo IN(0,1)),
    CONSTRAINT uq_email UNIQUE (email),
    CONSTRAINT pk_cliente PRIMARY KEY (id),
    INDEX ix_email (email)
);

#ALTER TABLE cliente DROP CONSTRAINT uq_email;

CREATE TABLE equipamento
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(250) NOT NULL#,
    #CONSTRAINT pk_equipamento PRIMARY KEY (id)
);

CREATE TABLE aluguel
(
	cliente_id INT NOT NULL,
    equipamento_id INT NOT NULL,

    data_aluguel datetime NOT NULL,
    preco_aluguel decimal(10,2),

    CONSTRAINT pk_aluguel PRIMARY KEY(equipamento_id, data_aluguel),

    CONSTRAINT fk_cliente FOREIGN KEY(cliente_id) REFERENCES cliente(id),
    CONSTRAINT fk_equipamento FOREIGN KEY(equipamento_id) REFERENCES equipamento(id)
);

INSERT INTO cliente (nome) VALUES
('Jorge Neves'),
('Isabel Pedrosa');

INSERT INTO cliente (nome, ativo) VALUES
('Lúcio Caetano', 0),
('Cristina Torres', 0);

INSERT INTO equipamento (nome) VALUES
('Trator'),
('Retroescavadeira'),
('Guindaste');

SELECT * FROM cliente;
SELECT id, nome FROM equipamento;

INSERT INTO aluguel VALUES
(1, 1, '2016-01-01', 1000.00),
(1, 2, '2016-01-15', 5000.00),
(2, 1, '2016-01-31', 1000.00),
(2, 2, '2016-02-01', 5000.00),
(3, 1, '2016-02-29', 1000.00),
(3, 2, '2016-03-08', 2500.00),
(4, 1, NOW(), 1500.00);


SELECT * FROM cliente;
SELECT * FROM equipamento;
SELECT * FROM aluguel;

#listar o cliente ativo, o equipamento alugado, data e preço de locação ordenado por data
SELECT
	C.nome AS cliento_nome,
    E.nome AS equpamento_nome,
    R.data_aluguel,
    R.preco_aluguel
FROM aluguel AS R
INNER JOIN equipamento E ON E.id = R.equipamento_id
INNER JOIN cliente C ON C.id = R.cliente_id
WHERE ativo = 1
ORDER BY R.data_aluguel;

#listar total de alugueis por equipamento em ordem decrescente
SELECT
	E.nome,
	COUNT(R.equipamento_id) AS total
FROM equipamento AS E
LEFT JOIN aluguel AS R ON R.equipamento_id = E.id
GROUP BY E.nome
ORDER BY COUNT(R.equipamento_id) DESC;

#listar soma dos alugueis
SELECT
	SUM(preco_aluguel) total
FROM aluguel;

#listar media de alugueis por mes
SELECT
    MONTH(data_aluguel) month,
    COUNT(equipamento_id) total_equipamento,
	AVG(preco_aluguel) avg_price
FROM aluguel AS R
GROUP BY MONTH(data_aluguel);

#listar equipamentos que nunca foram alugados
SELECT
	E.nome
FROM equipamento AS E
WHERE
NOT EXISTS (SELECT 1 FROM aluguel AS R WHERE R.equipamento_id = E.id);
#id NOT IN (SELECT equipamento_id FROM aluguel)

#listar quantidade de alugueis de equipamentos que foram alugados mais de uma vez
SELECT
	E.nome,
    COUNT(R.equipamento_id) AS total
FROM aluguel AS R
INNER JOIN equipamento AS E ON E.id = R.equipamento_id
GROUP BY E.nome
HAVING COUNT(equipamento_id) > 1;


#Atualizar cliente Isabel Pedrosa para Isabel Neves
#Atualizar cliente inativo e nome igual jorge ou lucio para ativo
#Atualizar clientes que comecam com Isa para Isabel Torres
#Excluir algueis entre primeiro a 31 de janeiro
#Excluir alugueis
#Zerar tabela de clientes

UPDATE cliente
	SET nome = 'Isabel Neves'
WHERE nome = 'Isabel Pedrosa';

UPDATE cliente
	SET ativo = 1
WHERE ativo  = 0 AND nome IN('Jorge', 'Lucio');

DELETE FROM aluguel
WHERE data_aluguel BETWEEN '2016-01-01' AND '2016-01-31';

UPDATE cliente SET nome = 'Isabel Neves'
WHERE nome LIKE 'Isa%';

UPDATE cliente SET ativo = 2
WHERE ativo = 1;

SELECT * FROM cliente;
/*
DELETE FROM client;

DELETE FROM aluguel;
DELETE FROM client;

TRUNCATE TABLE equipamento;*/