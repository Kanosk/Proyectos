    -- trigger para el guardado en historico tras su eliminacion
DELIMITER //
CREATE TRIGGER trigger_delCliente 
   AFTER DELETE ON tcliente
   FOR EACH ROW
   BEGIN 
      INSERT INTO historicocliente(DNI_cl,estado)
               VALUES (OLD.DNI_cl, 'Eliminado');
   END; //
DELIMITER ;