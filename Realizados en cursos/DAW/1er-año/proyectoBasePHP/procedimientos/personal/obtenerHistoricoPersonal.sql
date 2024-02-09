-- procedimiento para el personal eliminado
DELIMITER //
CREATE PROCEDURE `sp_obtenerHistoricoPersonal`()
BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT 'Error: no se pudo obtener el historial del personal';
  END;
  SELECT * FROM historicoPersonal;
END //
DELIMITER ;