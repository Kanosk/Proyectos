-- procedimiento para editar la persona
DELIMITER //
CREATE PROCEDURE `sp_editarPersona` (
    IN _DNI_personal VARCHAR(10), 
    IN _nombre_per VARCHAR(50), 
    IN _apellido1_per VARCHAR(50), 
    IN _apellido2_per VARCHAR(50), 
    IN _email_per VARCHAR(100), 
    IN _telefono_per VARCHAR(20), 
    IN _cargo VARCHAR(50))
BEGIN
    DELETE FROM Tadministrativo WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tgerente WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tauxiliar WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tmantenimiento WHERE DNI_personal = _DNI_personal;
    DELETE FROM Ttecnico WHERE DNI_personal = _DNI_personal;

    UPDATE Tpersonal SET nombre_per = _nombre_per, apellido1_per = _apellido1_per, apellido2_per = _apellido2_per, email_per = _email_per, telefono_per = _telefono_per, cargo = _cargo 
    WHERE DNI_personal = _DNI_personal;

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

    END IF;
END //
DELIMITER;