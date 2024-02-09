--trigger para llenar la tabla historico cliente cuando se elimine algo de tcliente
CREATE OR REPLACE FUNCTION trigger_delcliente()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $BODY$
BEGIN
   INSERT INTO historicocliente(dni_cl, estado)
   VALUES (OLD.dni_cl, 'Inactivo');

   RETURN OLD;
END;
$BODY$;

CREATE TRIGGER cliente_eliminado
AFTER DELETE ON tcliente
FOR EACH ROW
EXECUTE FUNCTION trigger_delcliente();