-- procedimiento para obtener el listado de personal
DELIMITER //
CREATE PROCEDURE `sp_obtenerPersonalIndividual`(
 IN dniParam VARCHAR(10)
)
BEGIN
 SELECT * FROM tpersonal WHERE DNI_personal = dniParam;
END //
DELIMITER ;