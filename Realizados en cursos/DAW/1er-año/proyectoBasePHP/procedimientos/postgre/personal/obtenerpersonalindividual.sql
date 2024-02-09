--procedimiento para modificar solo una persona
CREATE OR REPLACE FUNCTION sp_obtenerpersonalindividual(
    in _dni character varying
	)
    RETURNS SETOF tpersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal where dni_personal=_dni;
    END;
$BODY$;