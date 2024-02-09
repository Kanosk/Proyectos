CREATE OR REPLACE FUNCTION sp_obtenercliente(
	)
    RETURNS SETOF tcliente
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tcliente;
    END;
$BODY$;