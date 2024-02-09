-- trigger para el guardado del eliminado
DELIMITER //
CREATE TRIGGER trigger_delPersonal 
   AFTER DELETE ON tpersonal
   FOR EACH ROW
   BEGIN 
      INSERT INTO historicoPersonal(DNI_personal,estado)
               VALUES (OLD.DNI_personal, 'Eliminado');
   END; //
DELIMITER ;