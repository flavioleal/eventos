USE talentos;

ALTER VIEW v_profissionals AS
SELECT
		P.id,
        P.cod_job,
        P.data_inclusao,
        P.data_expiracao,
        P.faixa_salarials_id,
        P.faixa_etarias_id,
        P.sinopse,
        P.created_at data_cadastro,
        (SELECT GROUP_CONCAT(area SEPARATOR ', ')
		FROM profissional_areas PA
		INNER JOIN areas A ON A.id = PA.area_id
        WHERE PA.profissional_id = P.id
		GROUP BY profissional_id) areas,
        CASE WHEN (NOW() >= DATE_SUB(data_expiracao, INTERVAL 15 DAY)) THEN 1 ELSE 0 END expirando,
        (SELECT COUNT(0) FROM profissional_solicitacaos PS WHERE PS.profissional_id = P.id) recebida,
        (SELECT COUNT(0) FROM profissional_solicitacaos PS WHERE PS.profissional_id = P.id AND status = 0) pendente 
	FROM profissionals P
    ORDER BY
		CASE WHEN (NOW() >= DATE_SUB(data_expiracao, INTERVAL 15 DAY)) THEN 1 ELSE 0 END,
        data_expiracao DESC; 
    
SELECT * FROM v_empresa_solicitacaos;