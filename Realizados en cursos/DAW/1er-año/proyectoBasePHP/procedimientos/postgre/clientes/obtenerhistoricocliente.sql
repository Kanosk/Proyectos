--procedimiento para obtener el historico de cliente
CREATE OR REPLACE FUNCTION sp_obtenerclienteHistorico(
	)
    RETURNS SETOF historicocliente 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM historicocliente;
    END;
$BODY$;