-- procedimiento para agregar personal a la base de datos
DELIMITER //
CREATE PROCEDURE `sp_addPersona` (
    IN _DNI_personal VARCHAR(10), 
    IN _nombre_per VARCHAR(50), 
    IN _apellido1_per VARCHAR(50), 
    IN _apellido2_per VARCHAR(50), 
    IN _email_per VARCHAR(100), 
    IN _telefono_per VARCHAR(20), 
    IN _cargo VARCHAR(50))
BEGIN

    DECLARE EXIT HANDLER FOR SQLSTATE '23000'
    BEGIN
		SELECT 'Datos duplicados' AS ERROR;
	END;
    IF _DNI_personal = null OR _DNI_personal = '' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'EL DNI NO PUEDE IR VACIO';
    end if;
  

    INSERT INTO Tpersonal (DNI_personal, nombre_per, apellido1_per, apellido2_per, email_per, telefono_per, cargo) 
    VALUES (_DNI_personal, _nombre_per, _apellido1_per, _apellido2_per, _email_per, _telefono_per, _cargo);

    IF (_cargo = 'Administrativo') THEN
        INSERT INTO Tadministrativo (Nombre_adm, DNI_personal) 
        VALUES (_nombre_per, _DNI_personal);

    ELSEIF (_cargo = 'Gerente') THEN
        INSERT INTO Tgerente (Nombre_ger, DNI_personal) 
        VALUES (_nombre_per, _DNI_personal);

    ELSEIF (_cargo = 'Auxiliar') THEN
        INSERT INTO Tauxiliar (DNI_personal, Nombre_aux) 
        VALUES (_DNI_personal, _nombre_per);

    ELSEIF (_cargo = 'Mantenimiento') THEN
        INSERT INTO Tmantenimiento (DNI_personal, Nombre_man) 
        VALUES (_DNI_personal, _nombre_per);

    ELSEIF (_cargo = 'Tecnico') THEN
        INSERT INTO Ttecnico (DNI_personal, Nombre_tec) 
        VALUES (_DNI_personal, _nombre_per);

    ELSEIF (_cargo = 'Limpiador') THEN
        INSERT INTO tlimpiador (DNI_personal, Nombre_lim) 
        VALUES (_DNI_personal, _nombre_per);

    END IF;
END //
DELIMITER ;