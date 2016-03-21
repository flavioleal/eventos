USE talentos;

ALTER VIEW v_empresa_solicitacaos AS
SELECT
		E.id,
        E.user_id,
        U.name,
        U.email,
        E.empresa,
        E.telefone,
        E.created_at data_cadastro,
        E.ativo,
        (SELECT COUNT(0) FROM profissional_solicitacaos PS WHERE PS.user_id = U.id) enviada,
        (SELECT COUNT(0) FROM profissional_solicitacaos PS WHERE PS.user_id = U.id AND status = 0) pendente 
	FROM empresas E
	INNER JOIN users U
		ON U.id = E.user_id;
        
SELECT * FROM v_empresa_solicitacaos;

select curdate()