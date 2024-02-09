drop database if exists trabajobae;
create database trabajobae;
use trabajobae;
    
CREATE TABLE Tpersonal (
  DNI_personal VARCHAR(9) NOT NULL,
  cargo VARCHAR(45) NULL,
  nombre_per VARCHAR(45) NULL,
  apellido1_per VARCHAR(45) NULL,
  apellido2_per VARCHAR(45) NULL,
  email_per VARCHAR(45) NULL,
  telefono_per INT NULL,
  PRIMARY KEY (DNI_personal));

CREATE TABLE Tgerente (
  ID_ger INT NOT NULL auto_increment,
  Nombre_ger VARCHAR(45) NULL,
  DNI_personal VARCHAR(9) NULL,
  PRIMARY KEY (ID_ger),
  INDEX DNI_personal_idx (DNI_personal ASC) ,
  CONSTRAINT DNI_personal
    FOREIGN KEY (DNI_personal)
    REFERENCES Tpersonal (DNI_personal)
    ON DELETE cascade ON UPDATE cascade);
    
    
CREATE TABLE Tauxiliar (
  ID_aux INT NOT NULL auto_increment,
  Nombre_aux VARCHAR(45) NULL,
  DNI_personal VARCHAR(9) NULL,
  PRIMARY KEY (ID_aux),
  INDEX DNI_personal_idx (DNI_personal ASC) ,
  CONSTRAINT DNI_personal1
    FOREIGN KEY (DNI_personal) REFERENCES Tpersonal (DNI_personal)
    ON DELETE cascade ON UPDATE cascade);

CREATE TABLE Tadministrativo (
  ID_adm INT NOT NULL auto_increment,
  Nombre_adm VARCHAR(45) NULL,
  DNI_personal VARCHAR(9) NULL,
  PRIMARY KEY (ID_adm),
  INDEX DNI_personal_idx (DNI_personal ASC) ,
  CONSTRAINT DNI_personal2
    FOREIGN KEY (DNI_personal)
    REFERENCES Tpersonal (DNI_personal)
    ON DELETE cascade
    ON UPDATE cascade);

CREATE TABLE Tmantenimiento (
  ID_man INT NOT NULL auto_increment,
  Nombre_man VARCHAR(45) NULL,
  DNI_personal VARCHAR(9) NULL,
  PRIMARY KEY (ID_man),
  INDEX DNI_personal_idx (DNI_personal ASC) ,
  CONSTRAINT DNI_personal3
    FOREIGN KEY (DNI_personal)
    REFERENCES Tpersonal (DNI_personal)
    ON DELETE cascade
    ON UPDATE cascade);

CREATE TABLE Ttecnico (
  ID_tec INT NOT NULL auto_increment,
  Nombre_tec VARCHAR(45) NULL,
  DNI_personal VARCHAR(9) NULL,
  PRIMARY KEY (ID_tec),
  INDEX DNI_personal_idx (DNI_personal ASC) ,
  CONSTRAINT DNI_personal4
    FOREIGN KEY (DNI_personal)
    REFERENCES Tpersonal (DNI_personal)
    ON DELETE cascade
    ON UPDATE cascade);
  

CREATE TABLE Tlimpiador (
  ID_lim INT NOT NULL auto_increment,
  nombre_lim VARCHAR(45) NULL,
  DNI_personal VARCHAR(45) NULL,
  PRIMARY KEY (ID_lim),
  INDEX DNI_personal_idx (DNI_personal ASC) ,
  CONSTRAINT DNI_personal5
    FOREIGN KEY (DNI_personal)
    REFERENCES Tpersonal (DNI_personal)
    ON DELETE cascade
    ON UPDATE cascade);
   
   CREATE TABLE Tcliente (
  id_usuario INT NOT NULL AUTO_INCREMENT,
  DNI_cl VARCHAR(45) NULL,
  nombre_cl VARCHAR(45) NULL,
  apellido1_cl VARCHAR(45) NULL,
  apellido2_cl VARCHAR(45) NULL,
  email_cl VARCHAR(45) NULL,
  telefono_cl INT NULL,
  DNI_personal VARCHAR(9) NULL,
  PRIMARY KEY (id_usuario),
  CONSTRAINT DNI_per foreign key (DNI_personal) references tpersonal (DNI_personal)
  on delete cascade on update cascade
  ) ;
  
  CREATE TABLE Tincidencias (
  id_parte INT NOT NULL auto_increment,
  observaciones VARCHAR(255) NULL,
  ID_man INT NULL,
  ID_adm INT NULL,
  PRIMARY KEY (id_parte),
  CONSTRAINT ID_man
    FOREIGN KEY (ID_man)
    REFERENCES Tmantenimiento (ID_man)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT ID_adm
    FOREIGN KEY (ID_adm)
    REFERENCES Tadministrativo (ID_adm)
    ON DELETE cascade
    ON UPDATE cascade);
  
  CREATE TABLE Ttorneos (
  id_torneo INT NOT NULL auto_increment,
  fecha_torneo DATE NULL,
  premio VARCHAR(45) NULL,
  PRIMARY KEY (id_torneo));

  
  CREATE TABLE Tlocal (
  CIF INT NOT NULL,
  Direccion VARCHAR(255) NULL,
  Telefono INT NULL,
  web VARCHAR(45) NULL,
  horario VARCHAR(45) NULL,
  cod_local INT NULL AUTO_INCREMENT,
  id_usuario INT NULL,
  PRIMARY KEY (CIF),
  INDEX cod_local (cod_local ASC),
  INDEX id_usuario_idx (id_usuario ASC),
  CONSTRAINT id_usuario FOREIGN KEY (id_usuario) REFERENCES Tcliente (id_usuario)
    ON DELETE cascade
    ON UPDATE cascade);
    
 
CREATE TABLE Tequipos (
  ID_equipo INT NOT NULL AUTO_INCREMENT,
  Num_serie VARCHAR(45) NULL,
  tipo_equipo VARCHAR(45) NULL,
  unidades INT NULL,
  cod_local INT NULL,
  PRIMARY KEY (ID_equipo),
  INDEX cod_local_idx (cod_local ASC),
  CONSTRAINT cod_local2
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

CREATE TABLE Tordenadores (
  ID_ordenador INT NOT NULL AUTO_INCREMENT,
  Id_equipo INT NULL,
  cod_local INT NULL,
  PRIMARY KEY (ID_ordenador),
  INDEX ID_equipos_idx (Id_equipo ASC),
  INDEX Cod_local_idx (cod_local ASC),
  CONSTRAINT ID_equipos
    FOREIGN KEY (Id_equipo)
    REFERENCES Tequipos (ID_equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT Cod_local3
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

CREATE TABLE Tconsolas (
  ID_consolas INT NOT NULL AUTO_INCREMENT,
  Id_equipo INT NULL,
  cod_local INT NULL,
  PRIMARY KEY (ID_consolas),
  INDEX ID_equipos_idx (Id_equipo ASC),
  INDEX cod_local_idx (cod_local ASC),
  CONSTRAINT ID_equipos1
    FOREIGN KEY (Id_equipo)
    REFERENCES Tequipos (ID_equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT cod_local4
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

    
CREATE TABLE Ttaller (
  ID_taller INT NOT NULL AUTO_INCREMENT,
  cod_local INT NULL,
  horario VARCHAR(45) NULL,
  ID_tec INT NULL,
  id_usuario INT NULL,
  PRIMARY KEY (ID_taller),
  INDEX ID_tec_idx (ID_tec ASC),
  INDEX cod_local_idx (cod_local ASC),
  INDEX id_usuario_idx (id_usuario ASC),
  CONSTRAINT ID_tec
    FOREIGN KEY (ID_tec)
    REFERENCES Ttecnico (ID_tec)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT cod_local5
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT id_usuario3
    FOREIGN KEY (id_usuario)
    REFERENCES Tcliente (id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
;

CREATE TABLE Ttienda (
  ID_tienda INT NOT NULL AUTO_INCREMENT,
  cod_local INT NULL,
  horario VARCHAR(45) NULL,
  id_usuario INT NULL,
  PRIMARY KEY (ID_tienda),
  INDEX cod_local_idx (cod_local ASC),
  INDEX id_usuario_idx (id_usuario ASC),
  CONSTRAINT cod_local6
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT id_usuario4
    FOREIGN KEY (id_usuario)
    REFERENCES Tcliente (id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE TABLE Tsalajuegos (
  ID_salajuegos INT NOT NULL AUTO_INCREMENT,
  cod_local INT NULL,
  horario VARCHAR(45) NULL,
  ID_consolas INT NULL,
  PRIMARY KEY (ID_salajuegos),
  INDEX cod_local_idx (cod_local ASC),
  INDEX id_consolas_idx (ID_consolas ASC),
  CONSTRAINT cod_local7
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT id_consolas
    FOREIGN KEY (ID_consolas)
    REFERENCES Tconsolas (ID_consolas)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE TABLE Tcibercafe (
  ID_cibercafe INT NOT NULL AUTO_INCREMENT,
  cod_local INT NULL,
  horario VARCHAR(45) NULL,
  id_equipo INT NULL,
  PRIMARY KEY (ID_cibercafe),
  INDEX cod_local_idx (cod_local ASC),
  INDEX id_equipo_idx (id_equipo ASC),
  CONSTRAINT cod_local8
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT id_equipo
    FOREIGN KEY (id_equipo)
    REFERENCES Tequipos (ID_equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE TABLE Tsaladescanso (
  id_saladescanso INT NOT NULL AUTO_INCREMENT,
  cod_local INT NULL,
  horario VARCHAR(45) NULL,
  PRIMARY KEY (id_saladescanso),
  INDEX cod_local_idx (cod_local ASC),
  CONSTRAINT cod_local9
    FOREIGN KEY (cod_local)
    REFERENCES Tlocal (cod_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

CREATE TABLE TClienteSalajuegos (
  ID_CLSJ INT NOT NULL AUTO_INCREMENT,
  ID_salajuegos INT NULL,
  ID_usuario INT NULL,
  PRIMARY KEY (ID_CLSJ),
  INDEX ID_salajuegos_idx (ID_salajuegos ASC),
  INDEX ID_usuario_idx (ID_usuario ASC),
  CONSTRAINT ID_salajuegos
    FOREIGN KEY (ID_salajuegos)
    REFERENCES Tsalajuegos (ID_salajuegos)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT ID_usuario6
    FOREIGN KEY (ID_usuario)
    REFERENCES Tcliente (id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE TABLE TClienteTorneo (
  ID_CLT INT NOT NULL AUTO_INCREMENT,
  ID_torneo INT NULL,
  ID_usuario INT NULL,
  PRIMARY KEY (ID_CLT),
  INDEX ID_torneo_idx (ID_torneo ASC),
  INDEX ID_usuario_idx (ID_usuario ASC),
  CONSTRAINT ID_torneo
    FOREIGN KEY (ID_torneo)
    REFERENCES Ttorneos (id_torneo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT ID_usuario8
    FOREIGN KEY (ID_usuario)
    REFERENCES Tcliente (id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
    
CREATE TABLE TPersonalTorneo (
  ID_PT INT NOT NULL AUTO_INCREMENT,
  ID_torneo INT NULL,
  DNI_personal VARCHAR(9) NULL,
  PRIMARY KEY (ID_PT),
  INDEX Id_torneo_idx (ID_torneo ASC),
  INDEX DNI_personal_idx (DNI_personal ASC),
  CONSTRAINT Id_torneo2
    FOREIGN KEY (ID_torneo)
    REFERENCES Ttorneos (id_torneo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT DNI_personal10
    FOREIGN KEY (DNI_personal)
    REFERENCES Tpersonal (DNI_personal)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE TABLE TConsolaSalasJuegos (
  ID_CSJ INT NOT NULL AUTO_INCREMENT,
  ID_salajuegos INT NULL,
  ID_consola INT NULL,
  PRIMARY KEY (ID_CSJ),
  INDEX ID_salajuegos_idx (ID_salajuegos ASC),
  INDEX ID_consolas_idx (ID_consola ASC),
  CONSTRAINT ID_salajuegos1
    FOREIGN KEY (ID_salajuegos)
    REFERENCES Tsalajuegos (ID_salajuegos)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT ID_consolas1
    FOREIGN KEY (ID_consola)
    REFERENCES Tconsolas (ID_consolas)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
    
    CREATE TABLE historicoPersonal(
    id int primary key auto_increment,
    DNI_personal VARCHAR(45) NULL,
    estado VARCHAR(45) null);
    
    create table historicoCliente(
    id int primary key auto_increment,
    DNI_cl VARCHAR(45) NULL,
    estado VARCHAR(45) null);
    
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
DELIMITER ;

-- trigger para el guardado del eliminado
DELIMITER //
CREATE TRIGGER trigger_delPersonal 
   AFTER DELETE ON tpersonal
   FOR EACH ROW
   BEGIN 
      INSERT INTO historicoPersonal(DNI_personal,estado)
               VALUES (OLD.DNI_personal, 'Eliminado');
   END; //
DELIMITER ;

-- procedimiento para obtener el listado de personal
DELIMITER //
CREATE PROCEDURE `sp_obtenerPersonalIndividual`(
 IN dniParam VARCHAR(10)
)
BEGIN
 SELECT * FROM tpersonal WHERE DNI_personal = dniParam;
END //
DELIMITER ;

-- procedimiento para el personal que da de alta
DELIMITER //
CREATE PROCEDURE `sp_obtenerPersonalAlta`()
BEGIN
 SELECT * FROM tpersonal WHERE cargo ='Administrativo' OR cargo='Auxiliar';
END //
DELIMITER ;

-- procedimiento para el personal que da de alta
DELIMITER //
CREATE PROCEDURE `sp_obtenerPersonal`()
BEGIN
 SELECT * FROM tpersonal ORDER BY cargo ;
END //
DELIMITER ;

-- procedimiento para el personal eliminado
DELIMITER //
CREATE PROCEDURE `sp_obtenerHistoricoPersonal`()
BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT 'Error: no se pudo obtener el historial del personal';
  END;
 SELECT * FROM historicoPersonal;
END //
DELIMITER ;

-- procedimiento para eliminar persona
DELIMITER //
CREATE PROCEDURE `sp_delPersona` (IN 
_DNI_personal VARCHAR(10))
BEGIN
	UPDATE tcliente SET DNI_personal = null WHERE DNI_personal = DNI_personal;
    DELETE FROM Tadministrativo WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tgerente WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tauxiliar WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tmantenimiento WHERE DNI_personal = _DNI_personal;
    DELETE FROM Ttecnico WHERE DNI_personal = _DNI_personal;
    DELETE FROM Tpersonal WHERE DNI_personal = _DNI_personal;
END //
DELIMITER ;

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

    -- trigger para el guardado en historico tras su eliminacion
DELIMITER //
CREATE TRIGGER trigger_delCliente 
   AFTER DELETE ON tcliente
   FOR EACH ROW
   BEGIN 
      INSERT INTO historicocliente(DNI_cl,estado)
               VALUES (OLD.DNI_cl, 'Eliminado');
   END; //
DELIMITER ;

-- Procedimiento para listar los clientes de la BBDD
DELIMITER //
CREATE PROCEDURE sp_obtenerClientes()
BEGIN
    SELECT * FROM tcliente;
END//
DELIMITER ;

-- Procedimiento para obtener un cliente y editarlo en la BBDD
DELIMITER //
CREATE PROCEDURE sp_obtenerClienteEdit(
    IN clienteId INT
    )
BEGIN
    SELECT * FROM tcliente WHERE id_usuario = clienteId;
END //
DELIMITER ;

-- Procedimiento para eliminar cliente de la BBDD
DELIMITER //
CREATE PROCEDURE sp_eliminar_cliente(
    IN id_usuario INT,
    OUT mensaje VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT "No se ha podido eliminar el usuario " AS Errors;
    END;
    START TRANSACTION;
    UPDATE tcliente SET DNI_personal = NULL WHERE id_usuario = id_usuario;
    DELETE FROM tcliente WHERE id_usuario = id_usuario;
    COMMIT;
    SET mensaje = 'Se ha eliminado el cliente correctamente.';
END //
DELIMITER ;

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

-- Procedimiento para agregar clientes a la BBDD
DELIMITER //
CREATE PROCEDURE sp_agregar_cliente(
    IN DNI_cl VARCHAR(20), 
    IN nombre_cl VARCHAR(50), 
    IN apellido1_cl VARCHAR(50), 
    IN apellido2_cl VARCHAR(50), 
    IN email_cl VARCHAR(50), 
    IN telefono_cl VARCHAR(20),
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

-- procedimiento para el cliente eliminado
DELIMITER //
CREATE PROCEDURE `sp_obtenerHistoricoCliente`()
BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT 'Error: no se pudo obtener el historial del personal';
  END;
 SELECT * FROM historicoCliente;
END //
DELIMITER ;

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




