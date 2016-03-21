USE talentos;

SELECT * FROM users;
SELECT * FROM empresas;

UPDATE users SET created_at = '2015-08-19 13:30:25' WHERE id = 1;

SELECT * FROM profissional_areas;
SELECT * FROM areas;
SELECT * FROM profissional_solicitacaos;

UPDATE 
profissional_solicitacaos
SET status = 0;

ALTER VIEW v_profissional_area_user AS
	SELECT	A.id area_id,
			P.id profissional_id,
			U.id user_id,
			U.email,
			U.name
	FROM 	areas A
	CROSS JOIN profissionals P
	CROSS JOIN profissional_areas PA
	CROSS JOIN users U
	WHERE 	PA.area_id = A.id
			AND PA.profissional_id = P.id;

ALTER VIEW v_profissional_area_solicitacaos AS
SELECT 	PS.id solicitacao_id,
		V.area_id,
		V.profissional_id,
        V.user_id,
        V.email,
        V.name usuario,
        P.cod_job,
        P.sinopse,
        PS.status,
        PS.created_at data_solicitacao,
        PS.updated_at data_baixa,
        PS.operator_id,
        U.name operator_name
FROM v_profissional_area_user V
	INNER JOIN profissionals P
		ON P.id = V.profissional_id
	LEFT JOIN profissional_solicitacaos PS
		ON PS.profissional_id = V.profissional_id AND PS.user_id = V.user_id
	LEFT JOIN users U
		ON U.id = PS.operator_id