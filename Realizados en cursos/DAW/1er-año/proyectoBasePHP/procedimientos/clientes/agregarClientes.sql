-- Procedimiento para agregar clientes a la BBDD
DELIMITER //
CREATE PROCEDURE sp_agregar_cliente(
    IN DNI_cl VARCHAR(20), 
    IN nombre_cl VARCHAR(50), 
    IN apellido1_cl VARCHAR(50), 
    IN apellido2_cl VARCHAR(50), 
    IN email_cl VARCHAR(50), 
    IN telefono_cl integer,
    IN DNI_personal VARCHAR(20),
    OUT mensaje VARCHAR(100)
)
BEGIN
    DECLARE Fallido VARCHAR(100);
    DECLARE exito VARCHAR(100);

    DECLARE EXIT HANDLER FOR SQLSTATE '23000'
    BEGIN
		SELECT 'Datos duplicados' AS ERROR;
	END;
    
    IF DNI_cl = null OR DNI_cl = '' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'EL DNI NO PUEDE IR VACIO';
    end if;

    SET Fallido = 'No se ha podido insertar el cliente.';
    SET exito = CONCAT('se ha insertado un cliente correctamente con nombre ', nombre_cl);

    INSERT INTO tcliente (DNI_cl, nombre_cl, apellido1_cl, apellido2_cl, email_cl, telefono_cl, DNI_personal)
        VALUES(DNI_cl, nombre_cl, apellido1_cl, apellido2_cl, email_cl, telefono_cl, DNI_personal);

    IF (SELECT ROW_COUNT()) THEN
        SET mensaje = exito;
    ELSE
        SET mensaje = Fallido;
    END IF;
END //
DELIMITER ;