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