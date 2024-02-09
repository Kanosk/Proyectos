DELIMITER //

CREATE PROCEDURE cur_contar_clientes()
BEGIN
    DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE total INT DEFAULT 0;
    DECLARE dni VARCHAR(9);

    -- Creamos el cursor que nos permitirá recorrer los registros de la tabla tcliente
    DECLARE cur CURSOR FOR SELECT id_usuario FROM Tcliente;

    -- Definimos el manejador de errores
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Abrimos el cursor y leemos los registros
    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO dni;

        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Incrementamos el contador de personas
        SET total = total + 1;
    END LOOP;

    -- Cerramos el cursor
    CLOSE cur;

    -- Mostramos el resultado
    SELECT CONCAT('Total de clientes creados: ', total) AS total_personas;
END //

DELIMITER ;