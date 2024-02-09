-- procedimiento para el personal que da de alta
DELIMITER //
CREATE PROCEDURE `sp_obtenerPersonal`()
BEGIN
 SELECT * FROM tpersonal ORDER BY cargo ;
END //
DELIMITER ;
