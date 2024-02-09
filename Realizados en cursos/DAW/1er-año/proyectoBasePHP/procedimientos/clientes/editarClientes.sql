-- procedimiento para modificar los clientes de la BBDD
DELIMITER //
CREATE PROCEDURE sp_editar_cliente(
    IN id_usuario INT,
    IN DNI_cl VARCHAR(20), 
    IN nombre_cl VARCHAR(50), 
    IN apellido1_cl VARCHAR(50), 
    IN apellido2_cl VARCHAR(50), 
    IN email_cl VARCHAR(50), 
    IN telefono_cl VARCHAR(20),
    OUT mensaje VARCHAR(100)
)
BEGIN
    DECLARE Fallido VARCHAR(100);
    DECLARE exito VARCHAR(100);

    SET Fallido = 'No se ha podido editar el cliente.';
    SET exito = 'Se ha editado el cliente correctamente.';

    UPDATE tcliente 
    SET DNI_cl = DNI_cl, 
        nombre_cl = nombre_cl, 
        apellido1_cl = apellido1_cl,
        apellido2_cl = apellido2_cl,
        email_cl = email_cl,
        telefono_cl = telefono_cl
    WHERE id_usuario = id_usuario;

    IF (SELECT ROW_COUNT()) THEN
        SET mensaje = exito;
    ELSE
        SET mensaje = Fallido;
    END IF;
END //
DELIMITER ;