-- procedimiento para el personal que da de alta
DELIMITER //
CREATE PROCEDURE `sp_obtenerPersonalAlta`()
BEGIN
 SELECT * FROM tpersonal WHERE cargo ='Administrativo' OR cargo='Auxiliar';
END //
DELIMITER ;