-- procedimiento para eliminar persona
DELIMITER //
CREATE PROCEDURE `sp_delPersona` (IN 
_DNI_personal VARCHAR(10))
BEGIN
    DELETE FROM Tadministrativo WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tgerente WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tauxiliar WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tmantenimiento WHERE DNI_personal = _DNI_personal;
    DELETE FROM Ttecnico WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tpersonal WHERE DNI_personal = _DNI_personal;
END //
DELIMITER ;