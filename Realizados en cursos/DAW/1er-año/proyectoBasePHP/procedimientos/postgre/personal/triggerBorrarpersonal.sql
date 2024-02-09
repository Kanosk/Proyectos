--trigger para llenar la tabla historico personal cuando se elimine algo de tpersonal
CREATE OR REPLACE FUNCTION trigger_delPersonal()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $BODY$
BEGIN
   INSERT INTO historicoPersonal(DNI_personal, estado)
   VALUES (OLD.DNI_personal, 'Inactivo');

   RETURN OLD;
END;
$BODY$;

CREATE TRIGGER personal_eliminado
AFTER DELETE ON tpersonal
FOR EACH ROW
EXECUTE FUNCTION trigger_delPersonal();