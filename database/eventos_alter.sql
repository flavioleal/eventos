use eventos;
select * from evento_perfis;
select * from cupom_descontos;
SELECT * FROM campo_tipos;
SELECT * FROM campos ORDER BY ordem;

SELECT * FROM campo_alternativas;
SELECT * FROM campo_condicoes;

ALTER TABLE campos ADD classe VARCHAR(250) NULL;
ALTER TABLE campos ADD autocomplete TINYINT NULL;

ALTER TABLE campo_condicoes ADD dependente_campo_id INT NOT NULL;

#ALTER TABLE evento_perfis ADD ativo TINYINT(1) NOT NULL DEFAULT 1;
#ALTER TABLE evento_perfis DROP COLUMN ativo

ALTER TABLE campos ADD ordem TINYINT;
ALTER TABLE campo_alternativas ADD ordem TINYINT;

ALTER TABLE evento_perfis DROP COLUMN desconto_grupo_tipo;
ALTER TABLE evento_perfis ADD desconto_grupo_tipo VARCHAR(3);

ALTER TABLE cupom_descontos DROP COLUMN codigo;
ALTER TABLE cupom_descontos ADD codigo VARCHAR(36) NULL; #DEFAULT UPPER(UUID())

ALTER TABLE cupom_descontos DROP COLUMN valor_tipo;
ALTER TABLE cupom_descontos ADD valor_tipo VARCHAR(3) NOT NULL DEFAULT 'R$'; #DEFAULT UPPER(UUID())

SELECT UPPER(UUID());

INSERT INTO campo_tipos
(tipo) VALUES
('Campo aberto - texto'),
('Campo aberto - número'),
('Data'),
('Monetário'),
('Texto'),
('Alternativa'),
('Opções'),
('Caixa de seleção'),
('Arquivo'),
('Parágrafo');