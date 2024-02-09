-- procedimiento para el cliente eliminado
DELIMITER //
CREATE PROCEDURE `sp_obtenerHistoricoCliente`()
BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT 'Error: no se pudo obtener el historial del personal';
  END;
 SELECT * FROM historicoCliente;
END //
DELIMITER ;