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
            cargo = persona.cargo 
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
