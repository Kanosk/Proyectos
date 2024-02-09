--procedimiento para listar el personal
CREATE OR REPLACE FUNCTION sp_obtenerPersonal(
	)
    RETURNS SETOF tpersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal;
    END;
$BODY$;