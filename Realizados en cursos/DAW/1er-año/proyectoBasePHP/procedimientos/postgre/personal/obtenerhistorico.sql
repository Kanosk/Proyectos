CREATE OR REPLACE FUNCTION sp_obtenerPersonalHistorico(
	)
    RETURNS SETOF historicopersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM historicopersonal;
    END;
$BODY$;