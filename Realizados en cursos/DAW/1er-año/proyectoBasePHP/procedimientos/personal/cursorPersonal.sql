DELIMITER //

CREATE PROCEDURE cur_contar_personal()
BEGIN
    DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE total INT DEFAULT 0;
    DECLARE dni VARCHAR(9);

    -- Creamos el cursor que nos permitirá recorrer los registros de la tabla Tpersonal
    DECLARE cur CURSOR FOR SELECT DNI_personal FROM Tpersonal;

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
    SELECT CONCAT('Total de personal creado: ', total) AS total_personas;
END //

DELIMITER ;