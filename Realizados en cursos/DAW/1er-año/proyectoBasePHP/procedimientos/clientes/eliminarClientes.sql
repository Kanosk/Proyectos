-- Procedimiento para eliminar cliente de la BBDD
DELIMITER //
CREATE PROCEDURE sp_eliminar_cliente(
    IN id_usuario INT,
    OUT mensaje VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT "No se ha podido eliminar el usuario " AS Errors;
    END;
    START TRANSACTION;
    UPDATE tcliente SET DNI_personal = NULL WHERE id_usuario = id_usuario;
    DELETE FROM tcliente WHERE id_usuario = id_usuario;
    COMMIT;
    SET mensaje = 'Se ha eliminado el cliente correctamente.';
END //
DELIMITER ;