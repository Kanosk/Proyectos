-- --procedimiento para añadir personas

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
