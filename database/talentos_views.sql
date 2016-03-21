USE talentos;
SELECT * FROM users;
SELECT * FROM areas;
SELECT * FROM migrations
SELECT * FROM profissionals;
SELECT * FROM faixa_salarials;

#DROP VIEW v_faixa_salarial_profisssionals;

CREATE VIEW v_faixa_salarial_profissionals AS
	SELECT P.faixa_salarials_id,FS.faixa_salarial,COUNT(0) total
	FROM profissionals P
	INNER JOIN faixa_salarials FS
		ON FS.id = P.faixa_salarials_id
	GROUP BY P.faixa_salarials_id,FS.faixa_salarial;
    
CREATE VIEW v_faixa_etaria_profissionals AS
	SELECT P.faixa_etarias_id,FE.faixa_etaria,COUNT(0) total
	FROM profissionals P
	INNER JOIN faixa_etarias FE
		ON FE.id = P.faixa_etarias_id
	GROUP BY P.faixa_etarias_id,FE.faixa_etaria;
    