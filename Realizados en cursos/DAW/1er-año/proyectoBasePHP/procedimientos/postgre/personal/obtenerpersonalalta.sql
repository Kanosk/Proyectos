--procedimiento para listar el personal
CREATE OR REPLACE FUNCTION sp_obtenerpersonalalta(
	)
    RETURNS SETOF tpersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal where cargo='Administrativo' OR cargo='Auxiliar' AND estado='Activo';
    END;
$BODY$;