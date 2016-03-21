
SELECT	NOW() >= DATE_SUB(data_expiracao, INTERVAL 15 DAY) expirando,
		NOW(),data_expiracao,DATE_SUB(data_expiracao, INTERVAL 15 DAY)
FROM profissionals;


SELECT	NOW() >= DATE_SUB(data_expiracao, INTERVAL 15 DAY) expirando,
		NOW(),data_expiracao,DATE_SUB(data_expiracao, INTERVAL 15 DAY)
FROM profissionals
WHERE NOW() >= DATE_SUB(data_expiracao, INTERVAL 15 DAY);


SELECT	COUNT(0)
FROM profissionals
WHERE data_expiracao > NOW();

SELECT * FROM v_profissional_area_solicitacao