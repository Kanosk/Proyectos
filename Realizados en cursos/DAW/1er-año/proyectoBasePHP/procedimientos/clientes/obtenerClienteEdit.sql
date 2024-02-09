-- Procedimiento para obtener un cliente y editarlo en la BBDD
DELIMITER //
CREATE PROCEDURE sp_obtenerClienteEdit(
    IN clienteId INT
    )
BEGIN
    SELECT * FROM tcliente WHERE id_usuario = clienteId;
END //
DELIMITER ;