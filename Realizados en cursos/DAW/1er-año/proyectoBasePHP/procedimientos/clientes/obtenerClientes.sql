-- Procedimiento para listar los clientes de la BBDD
DELIMITER //
CREATE PROCEDURE sp_obtenerClientes()
BEGIN
    SELECT * FROM tcliente;
END//
DELIMITER ;