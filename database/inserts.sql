SELECT * FROM areas;

DELETE FROM profissional_solicitacaos;
DELETE FROM profissional_areas;
DELETE FROM profissionals;
TRUNCATE TABLE areas;

TRUNCATE TABLE faixa_etarias;
TRUNCATE TABLE faixa_salarials;

INSERT INTO areas
(area,ativo,created_at,updated_at) VALUES
('Administrativa',1,NOW(),NOW()),
('Comercial/Vendas',1,NOW(),NOW()),
('Comércio Exterior',1,NOW(),NOW()),
('Contabilidade',1,NOW(),NOW()),
('Educação',1,NOW(),NOW()),
('Energia/Gás/Petróleo',1,NOW(),NOW()),
('Engenharia Civil',1,NOW(),NOW()),
('Engenharia Elétrica',1,NOW(),NOW()),
('Engenharia Mecânica',1,NOW(),NOW()),
('Financeira',1,NOW(),NOW()),
('Industrial/PCP/Qualidade/Manutenção/Outras',1,NOW(),NOW()),
('Jurídica',1,NOW(),NOW()),
('Logística/Suprimentos',1,NOW(),NOW()),
('Publicidade e Propaganda/Marketing',1,NOW(),NOW()),
('Recursos Humanos',1,NOW(),NOW()),
('Saúde/Hospitalar',1,NOW(),NOW()),
('Tecnologia da Informação/E-Commerce',1,NOW(),NOW()),
('Outras',1,NOW(),NOW());

SELECT * FROM faixa_salarials;
INSERT INTO faixa_salarials
(faixa_salarial,min_salario,max_salario,ativo,created_at,updated_at) VALUES
('Até R$5.000,00',0,5000,1,NOW(),NOW()),
('R$5.000,00 a R$10.000,00',5000.01,10000,1,NOW(),NOW()),
('R$10.000,00 a R$15.000,00',10000.01,15000,1,NOW(),NOW()),
('Acima de R$15.000,00',15000.01,99999999.99,1,NOW(),NOW());

SELECT * FROM faixa_etarias;
INSERT INTO faixa_etarias
(faixa_etaria,min_idade,max_idade,ativo,created_at,updated_at) VALUES
('Até 29 anos',0,29,1,NOW(),NOW()),
('30 a 45 anos',30,45,1,NOW(),NOW()),
('Acima de 45 anos',46,120,1,NOW(),NOW())