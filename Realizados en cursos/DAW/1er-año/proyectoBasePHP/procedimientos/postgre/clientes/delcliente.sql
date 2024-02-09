--procedimiento para eliminar cliente
create procedure sp_delcliente(
    _id_usuario integer
)
LANGUAGE plpgsql
AS $BODY$
BEGIN
	update tcliente set dni_personal=null where id_usuario=_id_usuario;
    DELETE FROM tcliente WHERE id_usuario = _id_usuario;
end
$BODY$