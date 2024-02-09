--procedimiento para eliminar persona
create procedure sp_delPersona(
 _dni_personal character varying
)
LANGUAGE plpgsql
AS $BODY$
BEGIN
	DELETE FROM tadministrativo WHERE dni_personal = _dni_personal;
    DELETE FROM tgerente WHERE dni_personal = _dni_personal;
    DELETE FROM tauxiliar WHERE dni_personal = _dni_personal;
    DELETE FROM tmantenimiento WHERE dni_personal = _dni_personal;
    DELETE FROM ttecnico WHERE dni_personal = _dni_personal;
    DELETE FROM tpersonal WHERE dni_personal = _dni_personal;
end
$BODY$