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
$BODY$