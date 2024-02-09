CREATE TYPE cargo as ENUM(
    'Administrativo','Gerente','Tecnico','Auxiliar','Mantenimiento','Limpiador'
);

CREATE TYPE estado AS ENUM(
    'Activo','Inactivo'
);

CREATE TYPE tipo_personal AS
(
	id integer,
    DNI_personal character varying(50),
    cargo cargo,
    nombre_per character varying(45),
    apellido1_per character varying(45),
    apellido2_per character varying(45),
    email_per character varying(45),
    telefono_per INTEGER,
    estado estado
);

CREATE SEQUENCE id_personal_seq;
CREATE TABLE tpersonal OF tipo_personal(
    id DEFAULT nextval('id_personal_seq')
);

ALTER TABLE tpersonal ADD CONSTRAINT DNI_personal_unique UNIQUE (DNI_personal);

CREATE TABLE Tgerente (
  ID_ger SERIAL PRIMARY KEY,
  Nombre_ger character varying(45),
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tauxiliar (
  ID_aux SERIAL PRIMARY KEY,
  Nombre_aux character varying(45),
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tadministrativo (
  ID_adm SERIAL PRIMARY KEY,
  Nombre_adm character varying(45),
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tmantenimiento (
  ID_man SERIAL PRIMARY KEY,
  Nombre_man character varying(45),
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Ttecnico (
  ID_tec SERIAL PRIMARY KEY,
  Nombre_tec character varying(45),
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tlimpiador (
  ID_lim SERIAL PRIMARY KEY,
  nombre_lim character varying(45),
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tcliente (
  id_usuario SERIAL PRIMARY KEY,
  DNI_cl character varying(45),
  nombre_cl character varying(45),
  apellido1_cl character varying(45),
  apellido2_cl character varying(45),
  email_cl character varying(45),
  telefono_cl INTEGER,
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tincidencias (
  id_parte SERIAL PRIMARY KEY,
  observaciones character varying(255),
  ID_man INTEGER REFERENCES Tmantenimiento (ID_man) ON DELETE SET NULL ON UPDATE SET NULL,
  ID_adm INTEGER REFERENCES Tadministrativo (ID_adm) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Ttorneos (
  id_torneo SERIAL PRIMARY KEY,
  fecha_torneo DATE,
  premio character varying(45)
);

CREATE TABLE Tlocal (
  id_local SERIAL PRIMARY KEY,
  CIF INTEGER NOT NULL UNIQUE,
  Direccion character varying(255),
  Telefono INTEGER,
  web character varying(45),
  horario character varying(45),
  id_usuario INTEGER REFERENCES Tcliente (id_usuario) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tequipos (
  ID_equipo SERIAL PRIMARY KEY,
  Num_serie character varying(45),
  tipo_equipo character varying(45),
  unidades INTEGER
);

CREATE TABLE Tordenadores (
  ID_ordenador SERIAL PRIMARY KEY,
  Id_equipo INTEGER REFERENCES Tequipos (ID_equipo) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tconsolas (
  ID_consolas SERIAL PRIMARY KEY,
  Id_equipo INTEGER REFERENCES Tequipos (ID_equipo) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Ttaller (
  ID_taller SERIAL PRIMARY KEY,
  horario character varying(45),
  ID_tec INTEGER REFERENCES Ttecnico (ID_tec) ON DELETE SET NULL ON UPDATE SET NULL,
  id_usuario INTEGER REFERENCES Tcliente (id_usuario) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Ttienda (
  ID_tienda SERIAL PRIMARY KEY,
  horario character varying(45),
  id_usuario INTEGER REFERENCES Tcliente (id_usuario) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tsalajuegos (
  ID_salajuegos SERIAL PRIMARY KEY,
  cod_local INTEGER,
  horario character varying(45),
  ID_consolas INTEGER REFERENCES Tconsolas (ID_consolas) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tcibercafe (
  ID_cibercafe SERIAL PRIMARY KEY,
  cod_local INTEGER,
  horario character varying(45),
  id_equipo INTEGER REFERENCES Tequipos (ID_equipo) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Tsaladescanso (
  id_saladescanso SERIAL PRIMARY KEY,
  cod_local INTEGER,
  horario character varying(45)
);

CREATE TABLE TClienteSalajuegos (
  ID_CLSJ SERIAL PRIMARY KEY,
  ID_salajuegos INTEGER REFERENCES Tsalajuegos (ID_salajuegos) ON DELETE SET NULL ON UPDATE SET NULL,
  ID_usuario INTEGER REFERENCES Tcliente (id_usuario) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE TClienteTorneo (
  ID_CLT SERIAL PRIMARY KEY,
  ID_torneo INTEGER REFERENCES Ttorneos (id_torneo) ON DELETE SET NULL ON UPDATE SET NULL,
  ID_usuario INTEGER REFERENCES Tcliente (id_usuario) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE TPersonalTorneo (
  ID_PT SERIAL PRIMARY KEY,
  ID_torneo INTEGER REFERENCES Ttorneos (id_torneo) ON DELETE SET NULL ON UPDATE SET NULL,
  DNI_personal character varying(9) REFERENCES tpersonal (DNI_personal) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE TConsolaSalasJuegos (
  ID_CSJ SERIAL PRIMARY KEY,
  ID_salajuegos INTEGER REFERENCES Tsalajuegos (ID_salajuegos) ON DELETE SET NULL ON UPDATE SET NULL,
  ID_consola INTEGER REFERENCES Tconsolas (ID_consolas) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE historicoPersonal (
  id SERIAL PRIMARY KEY,
  DNI_personal character varying(45),
  estado estado
);

CREATE TABLE historicoCliente (
  id SERIAL PRIMARY KEY,
  DNI_cl character varying(45),
  estado estado
);

--trigger para llenar la tabla historico cliente cuando se elimine algo de tcliente
CREATE OR REPLACE FUNCTION trigger_delcliente()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $BODY$
BEGIN
   INSERT INTO historicocliente(dni_cl, estado)
   VALUES (OLD.dni_cl, 'Inactivo');

   RETURN OLD;
END;
$BODY$;

CREATE TRIGGER cliente_eliminado
AFTER DELETE ON tcliente
FOR EACH ROW
EXECUTE FUNCTION trigger_delcliente();

--procedimiento para modificar solo un cliente
CREATE OR REPLACE FUNCTION sp_obtenerclienteindividual(
    in _id_usuario integer
	)
    RETURNS SETOF tcliente
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tcliente where id_usuario=_id_usuario;
    END;
$BODY$;

--procedimiento para obtener el historico de cliente
CREATE OR REPLACE FUNCTION sp_obtenerclienteHistorico(
	)
    RETURNS SETOF historicocliente 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM historicocliente;
    END;
$BODY$;

CREATE OR REPLACE FUNCTION sp_obtenercliente(
	)
    RETURNS SETOF tcliente
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tcliente;
    END;
$BODY$;

--procedimiento para editar cliente
CREATE OR REPLACE PROCEDURE sp_editarcliente(
    _id_usuario integer,
    _nombre_cl character varying(50), 
    _apellido1_cl character varying(50), 
    _apellido2_cl character varying(50), 
    _email_cl character varying(50), 
    _telefono_cl INTEGER
)
LANGUAGE plpgsql
AS $BODY$
BEGIN
    UPDATE tcliente set nombre_cl=_nombre_cl,apellido1_cl=_apellido1_cl,apellido2_cl=_apellido2_cl,email_cl=_email_cl,telefono_cl=_telefono_cl
    WHERE id_usuario =_id_usuario;
END
$BODY$;

--procedimiento para eliminar cliente
create procedure sp_delcliente(
    _id_usuario integer
)
LANGUAGE plpgsql
AS $BODY$
BEGIN
	update tcliente set dni_personal=null where id_usuario=_id_usuario;
    DELETE FROM tcliente WHERE id_usuario = _id_usuario;
end
$BODY$;

CREATE OR REPLACE PROCEDURE public.sp_agregar_clientes(
    _DNI_cl character varying(20), 
    _nombre_cl character varying(50), 
    _apellido1_cl character varying(50), 
    _apellido2_cl character varying(50), 
    _email_cl character varying(50), 
    _telefono_cl INTEGER,
    _DNI_personal character varying(20)
)
LANGUAGE plpgsql
AS $BODY$
BEGIN   
    INSERT INTO TCLIENTE (dni_cl,nombre_cl,apellido1_cl,apellido2_cl,email_cl,telefono_cl,dni_personal)
    values(_DNI_cl,_nombre_cl,_apellido1_cl,_apellido2_cl,_email_cl,_telefono_cl,_DNI_personal);
END
$BODY$;

--trigger para llenar la tabla historico personal cuando se elimine algo de tpersonal
CREATE OR REPLACE FUNCTION trigger_delPersonal()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $BODY$
BEGIN
   INSERT INTO historicoPersonal(DNI_personal, estado)
   VALUES (OLD.DNI_personal, 'Inactivo');

   RETURN OLD;
END;
$BODY$;

CREATE TRIGGER personal_eliminado
AFTER DELETE ON tpersonal
FOR EACH ROW
EXECUTE FUNCTION trigger_delPersonal();

--procedimiento para modificar solo una persona
CREATE OR REPLACE FUNCTION sp_obtenerpersonalindividual(
    in _dni character varying
	)
    RETURNS SETOF tpersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal where dni_personal=_dni;
    END;
$BODY$;

--procedimiento para listar el personal
CREATE OR REPLACE FUNCTION sp_obtenerpersonalalta(
	)
    RETURNS SETOF tpersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal where cargo='Administrativo' OR cargo='Auxiliar' AND estado='Activo';
    END;
$BODY$;

--procedimiento para listar el personal
CREATE OR REPLACE FUNCTION sp_obtenerPersonal(
	)
    RETURNS SETOF tpersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal;
    END;
$BODY$;

CREATE OR REPLACE FUNCTION sp_obtenerPersonalHistorico(
	)
    RETURNS SETOF historicopersonal 
    LANGUAGE 'plpgsql'
AS $BODY$
    BEGIN
        RETURN QUERY SELECT * FROM historicopersonal;
    END;
$BODY$;

--procedimiento para editar persona
CREATE PROCEDURE sp_editarpersona (
    in persona tipo_personal
    )
LANGUAGE plpgsql
AS $BODY$
BEGIN
    DELETE FROM tadministrativo WHERE dni_personal = persona.dni_personal;
    DELETE FROM tgerente WHERE dni_personal = persona.dni_personal;
    DELETE FROM tauxiliar WHERE dni_personal = persona.dni_personal;
    DELETE FROM tmantenimiento WHERE dni_personal = persona.dni_personal;
    DELETE FROM ttecnico WHERE dni_personal = persona.dni_personal;

    UPDATE tpersonal SET nombre_per = persona.nombre_per, 
            apellido1_per = persona.apellido1_per, 
            apellido2_per = persona.apellido2_per, 
            email_per = persona.email_per, 
            telefono_per = persona.telefono_per, 
            cargo = persona.cargo,
            estado=persona.estado
    WHERE dni_personal = persona.dni_personal;

    IF (persona.cargo  = 'Administrativo') THEN
        INSERT INTO tadministrativo (Nombre_adm, dni_personal) 
        VALUES (persona.nombre_per, persona.dni_personal);

    ELSEIF (persona.cargo  = 'Gerente') THEN
        INSERT INTO tgerente (Nombre_ger, dni_personal) 
        VALUES (persona.nombre_per, persona.dni_personal);

    ELSEIF (persona.cargo  = 'Auxiliar') THEN
        INSERT INTO tauxiliar (dni_personal, Nombre_aux) 
        VALUES (persona.dni_personal, persona.nombre_per);

    ELSEIF (persona.cargo  = 'Mantenimiento') THEN
        INSERT INTO tmantenimiento (dni_personal, Nombre_man) 
        VALUES (persona.dni_personal, persona.nombre_per);

    ELSEIF (persona.cargo  = 'Tecnico') THEN
        INSERT INTO ttecnico (dni_personal, Nombre_tec) 
        VALUES (persona.dni_personal, persona.nombre_per);

    END IF;
END
$BODY$;

--procedimiento para eliminar persona
create procedure sp_delPersona(
 _dni_personal character varying
)
LANGUAGE plpgsql
AS $BODY$
BEGIN
	DELETE FROM tadministrativo WHERE dni_personal = _dni_personal;
    DELETE FROM tgerente WHERE dni_personal = _dni_personal;
    DELETE FROM tauxiliar WHERE dni_personal = _dni_personal;
    DELETE FROM tmantenimiento WHERE dni_personal = _dni_personal;
    DELETE FROM ttecnico WHERE dni_personal = _dni_personal;
    DELETE FROM tpersonal WHERE dni_personal = _dni_personal;
end
$BODY$;

--procedimiento para añadir personas
CREATE OR REPLACE PROCEDURE public.sp_addPersona(
  in persona tipo_personal
)
LANGUAGE plpgsql
AS $BODY$
BEGIN
  INSERT INTO tpersonal (dni_personal,cargo, nombre_per, apellido1_per, apellido2_per, email_per, telefono_per, estado)
  VALUES (persona.dni_personal,persona.cargo, persona.nombre_per, persona.apellido1_per, persona.apellido2_per, persona.email_per, persona.telefono_per, persona.estado);
  IF (persona.cargo = 'Administrativo') THEN
    INSERT INTO tadministrativo (dni_personal, nombre_adm) 
    VALUES (persona.dni_personal, persona.nombre_per);
  ELSIF (persona.cargo = 'Gerente') THEN
    INSERT INTO tgerente (dni_personal, nombre_ger) 
    VALUES (persona.dni_personal, persona.nombre_per);
  ELSIF (persona.cargo = 'Auxiliar') THEN
    INSERT INTO tauxiliar (dni_personal, nombre_aux) 
    VALUES (persona.dni_personal, persona.nombre_per);
  ELSIF (persona.cargo = 'Mantenimiento') THEN
    INSERT INTO tmantenimiento (dni_personal, nombre_man) 
    VALUES (persona.dni_personal, persona.nombre_per);
  ELSIF (persona.cargo = 'Tecnico') THEN
    INSERT INTO ttecnico (dni_personal, nombre_tec) 
    VALUES (persona.dni_personal, persona.nombre_per);
  ELSIF (persona.cargo = 'Limpiador') THEN
    INSERT INTO tlimpiador (dni_personal, nombre_lim) 
    VALUES (persona.dni_personal, persona.nombre_per);
  END IF;
END
$BODY$;

