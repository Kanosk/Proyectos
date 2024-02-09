--procedimiento para modificar solo un cliente
CREATE OR REPLACE FUNCTION sp_obtenerclienteindividual(
    in _id_usuario integer
	)
    RETURNS SETOF tcliente
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tcliente where id_usuario=_id_usuario;
    END;
$BODY$;

