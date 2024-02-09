PGDMP         '                {            proyectoBae    15.3    15.3 �                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            !           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            "           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            #           1262    20631    proyectoBae    DATABASE     �   CREATE DATABASE "proyectoBae" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE "proyectoBae";
                postgres    false            �           1247    20972    cargo    TYPE     �   CREATE TYPE public.cargo AS ENUM (
    'Administrativo',
    'Gerente',
    'Tecnico',
    'Auxiliar',
    'Mantenimiento',
    'Limpiador'
);
    DROP TYPE public.cargo;
       public          postgres    false            �           1247    20986    estado    TYPE     D   CREATE TYPE public.estado AS ENUM (
    'Activo',
    'Inactivo'
);
    DROP TYPE public.estado;
       public          postgres    false            �           1247    20993    tipo_personal    TYPE     .  CREATE TYPE public.tipo_personal AS (
	id integer,
	dni_personal character varying(50),
	cargo public.cargo,
	nombre_per character varying(45),
	apellido1_per character varying(45),
	apellido2_per character varying(45),
	email_per character varying(45),
	telefono_per integer,
	estado public.estado
);
     DROP TYPE public.tipo_personal;
       public          postgres    false    902    905            "           1255    21312 #   sp_addpersona(public.tipo_personal) 	   PROCEDURE     ;  CREATE PROCEDURE public.sp_addpersona(IN persona public.tipo_personal)
    LANGUAGE plpgsql
    AS $$
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
$$;
 F   DROP PROCEDURE public.sp_addpersona(IN persona public.tipo_personal);
       public          postgres    false    908                       1255    21303 �   sp_agregar_clientes(character varying, character varying, character varying, character varying, character varying, integer, character varying) 	   PROCEDURE     	  CREATE PROCEDURE public.sp_agregar_clientes(IN _dni_cl character varying, IN _nombre_cl character varying, IN _apellido1_cl character varying, IN _apellido2_cl character varying, IN _email_cl character varying, IN _telefono_cl integer, IN _dni_personal character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN   
    INSERT INTO TCLIENTE (dni_cl,nombre_cl,apellido1_cl,apellido2_cl,email_cl,telefono_cl,dni_personal)
    values(_DNI_cl,_nombre_cl,_apellido1_cl,_apellido2_cl,_email_cl,_telefono_cl,_DNI_personal);
END
$$;
   DROP PROCEDURE public.sp_agregar_clientes(IN _dni_cl character varying, IN _nombre_cl character varying, IN _apellido1_cl character varying, IN _apellido2_cl character varying, IN _email_cl character varying, IN _telefono_cl integer, IN _dni_personal character varying);
       public          postgres    false                       1255    21302    sp_delcliente(integer) 	   PROCEDURE     �   CREATE PROCEDURE public.sp_delcliente(IN _id_usuario integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
	update tcliente set dni_personal=null where id_usuario=_id_usuario;
    DELETE FROM tcliente WHERE id_usuario = _id_usuario;
end
$$;
 =   DROP PROCEDURE public.sp_delcliente(IN _id_usuario integer);
       public          postgres    false            !           1255    21311     sp_delpersona(character varying) 	   PROCEDURE     �  CREATE PROCEDURE public.sp_delpersona(IN _dni_personal character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
	DELETE FROM tadministrativo WHERE dni_personal = _dni_personal;
    DELETE FROM tgerente WHERE dni_personal = _dni_personal;
    DELETE FROM tauxiliar WHERE dni_personal = _dni_personal;
    DELETE FROM tmantenimiento WHERE dni_personal = _dni_personal;
    DELETE FROM ttecnico WHERE dni_personal = _dni_personal;
    DELETE FROM tpersonal WHERE dni_personal = _dni_personal;
end
$$;
 I   DROP PROCEDURE public.sp_delpersona(IN _dni_personal character varying);
       public          postgres    false                       1255    21301 n   sp_editarcliente(integer, character varying, character varying, character varying, character varying, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.sp_editarcliente(IN _id_usuario integer, IN _nombre_cl character varying, IN _apellido1_cl character varying, IN _apellido2_cl character varying, IN _email_cl character varying, IN _telefono_cl integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    UPDATE tcliente set nombre_cl=_nombre_cl,apellido1_cl=_apellido1_cl,apellido2_cl=_apellido2_cl,email_cl=_email_cl,telefono_cl=_telefono_cl
    WHERE id_usuario =_id_usuario;
END
$$;
 �   DROP PROCEDURE public.sp_editarcliente(IN _id_usuario integer, IN _nombre_cl character varying, IN _apellido1_cl character varying, IN _apellido2_cl character varying, IN _email_cl character varying, IN _telefono_cl integer);
       public          postgres    false                        1255    21310 &   sp_editarpersona(public.tipo_personal) 	   PROCEDURE     �  CREATE PROCEDURE public.sp_editarpersona(IN persona public.tipo_personal)
    LANGUAGE plpgsql
    AS $$
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
$$;
 I   DROP PROCEDURE public.sp_editarpersona(IN persona public.tipo_personal);
       public          postgres    false    908            �            1259    21074    tcliente    TABLE     =  CREATE TABLE public.tcliente (
    id_usuario integer NOT NULL,
    dni_cl character varying(45),
    nombre_cl character varying(45),
    apellido1_cl character varying(45),
    apellido2_cl character varying(45),
    email_cl character varying(45),
    telefono_cl integer,
    dni_personal character varying(9)
);
    DROP TABLE public.tcliente;
       public         heap    postgres    false                       1255    21300    sp_obtenercliente()    FUNCTION     �   CREATE FUNCTION public.sp_obtenercliente() RETURNS SETOF public.tcliente
    LANGUAGE plpgsql
    AS $$
    BEGIN
        RETURN QUERY SELECT * FROM tcliente;
    END;
$$;
 *   DROP FUNCTION public.sp_obtenercliente();
       public          postgres    false    230                       1259    21290    historicocliente    TABLE     ~   CREATE TABLE public.historicocliente (
    id integer NOT NULL,
    dni_cl character varying(45),
    estado public.estado
);
 $   DROP TABLE public.historicocliente;
       public         heap    postgres    false    905                       1255    21299    sp_obtenerclientehistorico()    FUNCTION     �   CREATE FUNCTION public.sp_obtenerclientehistorico() RETURNS SETOF public.historicocliente
    LANGUAGE plpgsql
    AS $$
    BEGIN
        RETURN QUERY SELECT * FROM historicocliente;
    END;
$$;
 3   DROP FUNCTION public.sp_obtenerclientehistorico();
       public          postgres    false    264                       1255    21298 $   sp_obtenerclienteindividual(integer)    FUNCTION     �   CREATE FUNCTION public.sp_obtenerclienteindividual(_id_usuario integer) RETURNS SETOF public.tcliente
    LANGUAGE plpgsql
    AS $$
    BEGIN
        RETURN QUERY SELECT * FROM tcliente where id_usuario=_id_usuario;
    END;
$$;
 G   DROP FUNCTION public.sp_obtenerclienteindividual(_id_usuario integer);
       public          postgres    false    230            �            1259    20994    id_personal_seq    SEQUENCE     x   CREATE SEQUENCE public.id_personal_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.id_personal_seq;
       public          postgres    false            �            1259    20995 	   tpersonal    TABLE     v   CREATE TABLE public.tpersonal OF public.tipo_personal (
    id DEFAULT nextval('public.id_personal_seq'::regclass)
);
    DROP TABLE public.tpersonal;
       public         heap    postgres    false    215    908    902    905                       1255    21308    sp_obtenerpersonal()    FUNCTION     �   CREATE FUNCTION public.sp_obtenerpersonal() RETURNS SETOF public.tpersonal
    LANGUAGE plpgsql
    AS $$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal;
    END;
$$;
 +   DROP FUNCTION public.sp_obtenerpersonal();
       public          postgres    false    216                       1255    21307    sp_obtenerpersonalalta()    FUNCTION     �   CREATE FUNCTION public.sp_obtenerpersonalalta() RETURNS SETOF public.tpersonal
    LANGUAGE plpgsql
    AS $$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal where cargo='Administrativo' OR cargo='Auxiliar' AND estado='Activo';
    END;
$$;
 /   DROP FUNCTION public.sp_obtenerpersonalalta();
       public          postgres    false    216                       1259    21283    historicopersonal    TABLE     �   CREATE TABLE public.historicopersonal (
    id integer NOT NULL,
    dni_personal character varying(45),
    estado public.estado
);
 %   DROP TABLE public.historicopersonal;
       public         heap    postgres    false    905                       1255    21309    sp_obtenerpersonalhistorico()    FUNCTION     �   CREATE FUNCTION public.sp_obtenerpersonalhistorico() RETURNS SETOF public.historicopersonal
    LANGUAGE plpgsql
    AS $$
    BEGIN
        RETURN QUERY SELECT * FROM historicopersonal;
    END;
$$;
 4   DROP FUNCTION public.sp_obtenerpersonalhistorico();
       public          postgres    false    262                       1255    21306 /   sp_obtenerpersonalindividual(character varying)    FUNCTION     �   CREATE FUNCTION public.sp_obtenerpersonalindividual(_dni character varying) RETURNS SETOF public.tpersonal
    LANGUAGE plpgsql
    AS $$
    BEGIN
        RETURN QUERY SELECT * FROM tpersonal where dni_personal=_dni;
    END;
$$;
 K   DROP FUNCTION public.sp_obtenerpersonalindividual(_dni character varying);
       public          postgres    false    216                       1255    21296    trigger_delcliente()    FUNCTION     �   CREATE FUNCTION public.trigger_delcliente() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
   INSERT INTO historicocliente(dni_cl, estado)
   VALUES (OLD.dni_cl, 'Inactivo');

   RETURN OLD;
END;
$$;
 +   DROP FUNCTION public.trigger_delcliente();
       public          postgres    false                       1255    21304    trigger_delpersonal()    FUNCTION     �   CREATE FUNCTION public.trigger_delpersonal() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
   INSERT INTO historicoPersonal(DNI_personal, estado)
   VALUES (OLD.DNI_personal, 'Inactivo');

   RETURN OLD;
END;
$$;
 ,   DROP FUNCTION public.trigger_delpersonal();
       public          postgres    false                       1259    21289    historicocliente_id_seq    SEQUENCE     �   CREATE SEQUENCE public.historicocliente_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.historicocliente_id_seq;
       public          postgres    false    264            $           0    0    historicocliente_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.historicocliente_id_seq OWNED BY public.historicocliente.id;
          public          postgres    false    263                       1259    21282    historicopersonal_id_seq    SEQUENCE     �   CREATE SEQUENCE public.historicopersonal_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.historicopersonal_id_seq;
       public          postgres    false    262            %           0    0    historicopersonal_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.historicopersonal_id_seq OWNED BY public.historicopersonal.id;
          public          postgres    false    261            �            1259    21026    tadministrativo    TABLE     �   CREATE TABLE public.tadministrativo (
    id_adm integer NOT NULL,
    nombre_adm character varying(45),
    dni_personal character varying(9)
);
 #   DROP TABLE public.tadministrativo;
       public         heap    postgres    false            �            1259    21025    tadministrativo_id_adm_seq    SEQUENCE     �   CREATE SEQUENCE public.tadministrativo_id_adm_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tadministrativo_id_adm_seq;
       public          postgres    false    222            &           0    0    tadministrativo_id_adm_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tadministrativo_id_adm_seq OWNED BY public.tadministrativo.id_adm;
          public          postgres    false    221            �            1259    21014 	   tauxiliar    TABLE     �   CREATE TABLE public.tauxiliar (
    id_aux integer NOT NULL,
    nombre_aux character varying(45),
    dni_personal character varying(9)
);
    DROP TABLE public.tauxiliar;
       public         heap    postgres    false            �            1259    21013    tauxiliar_id_aux_seq    SEQUENCE     �   CREATE SEQUENCE public.tauxiliar_id_aux_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.tauxiliar_id_aux_seq;
       public          postgres    false    220            '           0    0    tauxiliar_id_aux_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.tauxiliar_id_aux_seq OWNED BY public.tauxiliar.id_aux;
          public          postgres    false    219            �            1259    21196 
   tcibercafe    TABLE     �   CREATE TABLE public.tcibercafe (
    id_cibercafe integer NOT NULL,
    cod_local integer,
    horario character varying(45),
    id_equipo integer
);
    DROP TABLE public.tcibercafe;
       public         heap    postgres    false            �            1259    21195    tcibercafe_id_cibercafe_seq    SEQUENCE     �   CREATE SEQUENCE public.tcibercafe_id_cibercafe_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tcibercafe_id_cibercafe_seq;
       public          postgres    false    250            (           0    0    tcibercafe_id_cibercafe_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tcibercafe_id_cibercafe_seq OWNED BY public.tcibercafe.id_cibercafe;
          public          postgres    false    249            �            1259    21073    tcliente_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE public.tcliente_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tcliente_id_usuario_seq;
       public          postgres    false    230            )           0    0    tcliente_id_usuario_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tcliente_id_usuario_seq OWNED BY public.tcliente.id_usuario;
          public          postgres    false    229            �            1259    21215    tclientesalajuegos    TABLE     |   CREATE TABLE public.tclientesalajuegos (
    id_clsj integer NOT NULL,
    id_salajuegos integer,
    id_usuario integer
);
 &   DROP TABLE public.tclientesalajuegos;
       public         heap    postgres    false            �            1259    21214    tclientesalajuegos_id_clsj_seq    SEQUENCE     �   CREATE SEQUENCE public.tclientesalajuegos_id_clsj_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tclientesalajuegos_id_clsj_seq;
       public          postgres    false    254            *           0    0    tclientesalajuegos_id_clsj_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tclientesalajuegos_id_clsj_seq OWNED BY public.tclientesalajuegos.id_clsj;
          public          postgres    false    253                        1259    21232    tclientetorneo    TABLE     s   CREATE TABLE public.tclientetorneo (
    id_clt integer NOT NULL,
    id_torneo integer,
    id_usuario integer
);
 "   DROP TABLE public.tclientetorneo;
       public         heap    postgres    false            �            1259    21231    tclientetorneo_id_clt_seq    SEQUENCE     �   CREATE SEQUENCE public.tclientetorneo_id_clt_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tclientetorneo_id_clt_seq;
       public          postgres    false    256            +           0    0    tclientetorneo_id_clt_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tclientetorneo_id_clt_seq OWNED BY public.tclientetorneo.id_clt;
          public          postgres    false    255            �            1259    21143 	   tconsolas    TABLE     [   CREATE TABLE public.tconsolas (
    id_consolas integer NOT NULL,
    id_equipo integer
);
    DROP TABLE public.tconsolas;
       public         heap    postgres    false            �            1259    21142    tconsolas_id_consolas_seq    SEQUENCE     �   CREATE SEQUENCE public.tconsolas_id_consolas_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tconsolas_id_consolas_seq;
       public          postgres    false    242            ,           0    0    tconsolas_id_consolas_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tconsolas_id_consolas_seq OWNED BY public.tconsolas.id_consolas;
          public          postgres    false    241                       1259    21266    tconsolasalasjuegos    TABLE     |   CREATE TABLE public.tconsolasalasjuegos (
    id_csj integer NOT NULL,
    id_salajuegos integer,
    id_consola integer
);
 '   DROP TABLE public.tconsolasalasjuegos;
       public         heap    postgres    false                       1259    21265    tconsolasalasjuegos_id_csj_seq    SEQUENCE     �   CREATE SEQUENCE public.tconsolasalasjuegos_id_csj_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tconsolasalasjuegos_id_csj_seq;
       public          postgres    false    260            -           0    0    tconsolasalasjuegos_id_csj_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tconsolasalasjuegos_id_csj_seq OWNED BY public.tconsolasalasjuegos.id_csj;
          public          postgres    false    259            �            1259    21124    tequipos    TABLE     �   CREATE TABLE public.tequipos (
    id_equipo integer NOT NULL,
    num_serie character varying(45),
    tipo_equipo character varying(45),
    unidades integer
);
    DROP TABLE public.tequipos;
       public         heap    postgres    false            �            1259    21123    tequipos_id_equipo_seq    SEQUENCE     �   CREATE SEQUENCE public.tequipos_id_equipo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.tequipos_id_equipo_seq;
       public          postgres    false    238            .           0    0    tequipos_id_equipo_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.tequipos_id_equipo_seq OWNED BY public.tequipos.id_equipo;
          public          postgres    false    237            �            1259    21002    tgerente    TABLE     �   CREATE TABLE public.tgerente (
    id_ger integer NOT NULL,
    nombre_ger character varying(45),
    dni_personal character varying(9)
);
    DROP TABLE public.tgerente;
       public         heap    postgres    false            �            1259    21001    tgerente_id_ger_seq    SEQUENCE     �   CREATE SEQUENCE public.tgerente_id_ger_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.tgerente_id_ger_seq;
       public          postgres    false    218            /           0    0    tgerente_id_ger_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.tgerente_id_ger_seq OWNED BY public.tgerente.id_ger;
          public          postgres    false    217            �            1259    21086    tincidencias    TABLE     �   CREATE TABLE public.tincidencias (
    id_parte integer NOT NULL,
    observaciones character varying(255),
    id_man integer,
    id_adm integer
);
     DROP TABLE public.tincidencias;
       public         heap    postgres    false            �            1259    21085    tincidencias_id_parte_seq    SEQUENCE     �   CREATE SEQUENCE public.tincidencias_id_parte_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tincidencias_id_parte_seq;
       public          postgres    false    232            0           0    0    tincidencias_id_parte_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tincidencias_id_parte_seq OWNED BY public.tincidencias.id_parte;
          public          postgres    false    231            �            1259    21062 
   tlimpiador    TABLE     �   CREATE TABLE public.tlimpiador (
    id_lim integer NOT NULL,
    nombre_lim character varying(45),
    dni_personal character varying(9)
);
    DROP TABLE public.tlimpiador;
       public         heap    postgres    false            �            1259    21061    tlimpiador_id_lim_seq    SEQUENCE     �   CREATE SEQUENCE public.tlimpiador_id_lim_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tlimpiador_id_lim_seq;
       public          postgres    false    228            1           0    0    tlimpiador_id_lim_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tlimpiador_id_lim_seq OWNED BY public.tlimpiador.id_lim;
          public          postgres    false    227            �            1259    21110    tlocal    TABLE     �   CREATE TABLE public.tlocal (
    id_local integer NOT NULL,
    cif integer NOT NULL,
    direccion character varying(255),
    telefono integer,
    web character varying(45),
    horario character varying(45),
    id_usuario integer
);
    DROP TABLE public.tlocal;
       public         heap    postgres    false            �            1259    21109    tlocal_id_local_seq    SEQUENCE     �   CREATE SEQUENCE public.tlocal_id_local_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.tlocal_id_local_seq;
       public          postgres    false    236            2           0    0    tlocal_id_local_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.tlocal_id_local_seq OWNED BY public.tlocal.id_local;
          public          postgres    false    235            �            1259    21038    tmantenimiento    TABLE     �   CREATE TABLE public.tmantenimiento (
    id_man integer NOT NULL,
    nombre_man character varying(45),
    dni_personal character varying(9)
);
 "   DROP TABLE public.tmantenimiento;
       public         heap    postgres    false            �            1259    21037    tmantenimiento_id_man_seq    SEQUENCE     �   CREATE SEQUENCE public.tmantenimiento_id_man_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tmantenimiento_id_man_seq;
       public          postgres    false    224            3           0    0    tmantenimiento_id_man_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tmantenimiento_id_man_seq OWNED BY public.tmantenimiento.id_man;
          public          postgres    false    223            �            1259    21131    tordenadores    TABLE     _   CREATE TABLE public.tordenadores (
    id_ordenador integer NOT NULL,
    id_equipo integer
);
     DROP TABLE public.tordenadores;
       public         heap    postgres    false            �            1259    21130    tordenadores_id_ordenador_seq    SEQUENCE     �   CREATE SEQUENCE public.tordenadores_id_ordenador_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.tordenadores_id_ordenador_seq;
       public          postgres    false    240            4           0    0    tordenadores_id_ordenador_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.tordenadores_id_ordenador_seq OWNED BY public.tordenadores.id_ordenador;
          public          postgres    false    239                       1259    21249    tpersonaltorneo    TABLE     �   CREATE TABLE public.tpersonaltorneo (
    id_pt integer NOT NULL,
    id_torneo integer,
    dni_personal character varying(9)
);
 #   DROP TABLE public.tpersonaltorneo;
       public         heap    postgres    false                       1259    21248    tpersonaltorneo_id_pt_seq    SEQUENCE     �   CREATE SEQUENCE public.tpersonaltorneo_id_pt_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tpersonaltorneo_id_pt_seq;
       public          postgres    false    258            5           0    0    tpersonaltorneo_id_pt_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tpersonaltorneo_id_pt_seq OWNED BY public.tpersonaltorneo.id_pt;
          public          postgres    false    257            �            1259    21208    tsaladescanso    TABLE     �   CREATE TABLE public.tsaladescanso (
    id_saladescanso integer NOT NULL,
    cod_local integer,
    horario character varying(45)
);
 !   DROP TABLE public.tsaladescanso;
       public         heap    postgres    false            �            1259    21207 !   tsaladescanso_id_saladescanso_seq    SEQUENCE     �   CREATE SEQUENCE public.tsaladescanso_id_saladescanso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.tsaladescanso_id_saladescanso_seq;
       public          postgres    false    252            6           0    0 !   tsaladescanso_id_saladescanso_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.tsaladescanso_id_saladescanso_seq OWNED BY public.tsaladescanso.id_saladescanso;
          public          postgres    false    251            �            1259    21184    tsalajuegos    TABLE     �   CREATE TABLE public.tsalajuegos (
    id_salajuegos integer NOT NULL,
    cod_local integer,
    horario character varying(45),
    id_consolas integer
);
    DROP TABLE public.tsalajuegos;
       public         heap    postgres    false            �            1259    21183    tsalajuegos_id_salajuegos_seq    SEQUENCE     �   CREATE SEQUENCE public.tsalajuegos_id_salajuegos_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.tsalajuegos_id_salajuegos_seq;
       public          postgres    false    248            7           0    0    tsalajuegos_id_salajuegos_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.tsalajuegos_id_salajuegos_seq OWNED BY public.tsalajuegos.id_salajuegos;
          public          postgres    false    247            �            1259    21155    ttaller    TABLE     �   CREATE TABLE public.ttaller (
    id_taller integer NOT NULL,
    horario character varying(45),
    id_tec integer,
    id_usuario integer
);
    DROP TABLE public.ttaller;
       public         heap    postgres    false            �            1259    21154    ttaller_id_taller_seq    SEQUENCE     �   CREATE SEQUENCE public.ttaller_id_taller_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.ttaller_id_taller_seq;
       public          postgres    false    244            8           0    0    ttaller_id_taller_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.ttaller_id_taller_seq OWNED BY public.ttaller.id_taller;
          public          postgres    false    243            �            1259    21050    ttecnico    TABLE     �   CREATE TABLE public.ttecnico (
    id_tec integer NOT NULL,
    nombre_tec character varying(45),
    dni_personal character varying(9)
);
    DROP TABLE public.ttecnico;
       public         heap    postgres    false            �            1259    21049    ttecnico_id_tec_seq    SEQUENCE     �   CREATE SEQUENCE public.ttecnico_id_tec_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.ttecnico_id_tec_seq;
       public          postgres    false    226            9           0    0    ttecnico_id_tec_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.ttecnico_id_tec_seq OWNED BY public.ttecnico.id_tec;
          public          postgres    false    225            �            1259    21172    ttienda    TABLE     {   CREATE TABLE public.ttienda (
    id_tienda integer NOT NULL,
    horario character varying(45),
    id_usuario integer
);
    DROP TABLE public.ttienda;
       public         heap    postgres    false            �            1259    21171    ttienda_id_tienda_seq    SEQUENCE     �   CREATE SEQUENCE public.ttienda_id_tienda_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.ttienda_id_tienda_seq;
       public          postgres    false    246            :           0    0    ttienda_id_tienda_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.ttienda_id_tienda_seq OWNED BY public.ttienda.id_tienda;
          public          postgres    false    245            �            1259    21103    ttorneos    TABLE     z   CREATE TABLE public.ttorneos (
    id_torneo integer NOT NULL,
    fecha_torneo date,
    premio character varying(45)
);
    DROP TABLE public.ttorneos;
       public         heap    postgres    false            �            1259    21102    ttorneos_id_torneo_seq    SEQUENCE     �   CREATE SEQUENCE public.ttorneos_id_torneo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.ttorneos_id_torneo_seq;
       public          postgres    false    234            ;           0    0    ttorneos_id_torneo_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.ttorneos_id_torneo_seq OWNED BY public.ttorneos.id_torneo;
          public          postgres    false    233                       2604    21293    historicocliente id    DEFAULT     z   ALTER TABLE ONLY public.historicocliente ALTER COLUMN id SET DEFAULT nextval('public.historicocliente_id_seq'::regclass);
 B   ALTER TABLE public.historicocliente ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    263    264    264                       2604    21286    historicopersonal id    DEFAULT     |   ALTER TABLE ONLY public.historicopersonal ALTER COLUMN id SET DEFAULT nextval('public.historicopersonal_id_seq'::regclass);
 C   ALTER TABLE public.historicopersonal ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    261    262    262            �           2604    21029    tadministrativo id_adm    DEFAULT     �   ALTER TABLE ONLY public.tadministrativo ALTER COLUMN id_adm SET DEFAULT nextval('public.tadministrativo_id_adm_seq'::regclass);
 E   ALTER TABLE public.tadministrativo ALTER COLUMN id_adm DROP DEFAULT;
       public          postgres    false    222    221    222            �           2604    21017    tauxiliar id_aux    DEFAULT     t   ALTER TABLE ONLY public.tauxiliar ALTER COLUMN id_aux SET DEFAULT nextval('public.tauxiliar_id_aux_seq'::regclass);
 ?   ALTER TABLE public.tauxiliar ALTER COLUMN id_aux DROP DEFAULT;
       public          postgres    false    220    219    220                       2604    21199    tcibercafe id_cibercafe    DEFAULT     �   ALTER TABLE ONLY public.tcibercafe ALTER COLUMN id_cibercafe SET DEFAULT nextval('public.tcibercafe_id_cibercafe_seq'::regclass);
 F   ALTER TABLE public.tcibercafe ALTER COLUMN id_cibercafe DROP DEFAULT;
       public          postgres    false    250    249    250            �           2604    21077    tcliente id_usuario    DEFAULT     z   ALTER TABLE ONLY public.tcliente ALTER COLUMN id_usuario SET DEFAULT nextval('public.tcliente_id_usuario_seq'::regclass);
 B   ALTER TABLE public.tcliente ALTER COLUMN id_usuario DROP DEFAULT;
       public          postgres    false    230    229    230            	           2604    21218    tclientesalajuegos id_clsj    DEFAULT     �   ALTER TABLE ONLY public.tclientesalajuegos ALTER COLUMN id_clsj SET DEFAULT nextval('public.tclientesalajuegos_id_clsj_seq'::regclass);
 I   ALTER TABLE public.tclientesalajuegos ALTER COLUMN id_clsj DROP DEFAULT;
       public          postgres    false    254    253    254            
           2604    21235    tclientetorneo id_clt    DEFAULT     ~   ALTER TABLE ONLY public.tclientetorneo ALTER COLUMN id_clt SET DEFAULT nextval('public.tclientetorneo_id_clt_seq'::regclass);
 D   ALTER TABLE public.tclientetorneo ALTER COLUMN id_clt DROP DEFAULT;
       public          postgres    false    256    255    256                       2604    21146    tconsolas id_consolas    DEFAULT     ~   ALTER TABLE ONLY public.tconsolas ALTER COLUMN id_consolas SET DEFAULT nextval('public.tconsolas_id_consolas_seq'::regclass);
 D   ALTER TABLE public.tconsolas ALTER COLUMN id_consolas DROP DEFAULT;
       public          postgres    false    241    242    242                       2604    21269    tconsolasalasjuegos id_csj    DEFAULT     �   ALTER TABLE ONLY public.tconsolasalasjuegos ALTER COLUMN id_csj SET DEFAULT nextval('public.tconsolasalasjuegos_id_csj_seq'::regclass);
 I   ALTER TABLE public.tconsolasalasjuegos ALTER COLUMN id_csj DROP DEFAULT;
       public          postgres    false    259    260    260                       2604    21127    tequipos id_equipo    DEFAULT     x   ALTER TABLE ONLY public.tequipos ALTER COLUMN id_equipo SET DEFAULT nextval('public.tequipos_id_equipo_seq'::regclass);
 A   ALTER TABLE public.tequipos ALTER COLUMN id_equipo DROP DEFAULT;
       public          postgres    false    238    237    238            �           2604    21005    tgerente id_ger    DEFAULT     r   ALTER TABLE ONLY public.tgerente ALTER COLUMN id_ger SET DEFAULT nextval('public.tgerente_id_ger_seq'::regclass);
 >   ALTER TABLE public.tgerente ALTER COLUMN id_ger DROP DEFAULT;
       public          postgres    false    218    217    218            �           2604    21089    tincidencias id_parte    DEFAULT     ~   ALTER TABLE ONLY public.tincidencias ALTER COLUMN id_parte SET DEFAULT nextval('public.tincidencias_id_parte_seq'::regclass);
 D   ALTER TABLE public.tincidencias ALTER COLUMN id_parte DROP DEFAULT;
       public          postgres    false    232    231    232            �           2604    21065    tlimpiador id_lim    DEFAULT     v   ALTER TABLE ONLY public.tlimpiador ALTER COLUMN id_lim SET DEFAULT nextval('public.tlimpiador_id_lim_seq'::regclass);
 @   ALTER TABLE public.tlimpiador ALTER COLUMN id_lim DROP DEFAULT;
       public          postgres    false    227    228    228                        2604    21113    tlocal id_local    DEFAULT     r   ALTER TABLE ONLY public.tlocal ALTER COLUMN id_local SET DEFAULT nextval('public.tlocal_id_local_seq'::regclass);
 >   ALTER TABLE public.tlocal ALTER COLUMN id_local DROP DEFAULT;
       public          postgres    false    235    236    236            �           2604    21041    tmantenimiento id_man    DEFAULT     ~   ALTER TABLE ONLY public.tmantenimiento ALTER COLUMN id_man SET DEFAULT nextval('public.tmantenimiento_id_man_seq'::regclass);
 D   ALTER TABLE public.tmantenimiento ALTER COLUMN id_man DROP DEFAULT;
       public          postgres    false    223    224    224                       2604    21134    tordenadores id_ordenador    DEFAULT     �   ALTER TABLE ONLY public.tordenadores ALTER COLUMN id_ordenador SET DEFAULT nextval('public.tordenadores_id_ordenador_seq'::regclass);
 H   ALTER TABLE public.tordenadores ALTER COLUMN id_ordenador DROP DEFAULT;
       public          postgres    false    239    240    240                       2604    21252    tpersonaltorneo id_pt    DEFAULT     ~   ALTER TABLE ONLY public.tpersonaltorneo ALTER COLUMN id_pt SET DEFAULT nextval('public.tpersonaltorneo_id_pt_seq'::regclass);
 D   ALTER TABLE public.tpersonaltorneo ALTER COLUMN id_pt DROP DEFAULT;
       public          postgres    false    258    257    258                       2604    21211    tsaladescanso id_saladescanso    DEFAULT     �   ALTER TABLE ONLY public.tsaladescanso ALTER COLUMN id_saladescanso SET DEFAULT nextval('public.tsaladescanso_id_saladescanso_seq'::regclass);
 L   ALTER TABLE public.tsaladescanso ALTER COLUMN id_saladescanso DROP DEFAULT;
       public          postgres    false    251    252    252                       2604    21187    tsalajuegos id_salajuegos    DEFAULT     �   ALTER TABLE ONLY public.tsalajuegos ALTER COLUMN id_salajuegos SET DEFAULT nextval('public.tsalajuegos_id_salajuegos_seq'::regclass);
 H   ALTER TABLE public.tsalajuegos ALTER COLUMN id_salajuegos DROP DEFAULT;
       public          postgres    false    247    248    248                       2604    21158    ttaller id_taller    DEFAULT     v   ALTER TABLE ONLY public.ttaller ALTER COLUMN id_taller SET DEFAULT nextval('public.ttaller_id_taller_seq'::regclass);
 @   ALTER TABLE public.ttaller ALTER COLUMN id_taller DROP DEFAULT;
       public          postgres    false    244    243    244            �           2604    21053    ttecnico id_tec    DEFAULT     r   ALTER TABLE ONLY public.ttecnico ALTER COLUMN id_tec SET DEFAULT nextval('public.ttecnico_id_tec_seq'::regclass);
 >   ALTER TABLE public.ttecnico ALTER COLUMN id_tec DROP DEFAULT;
       public          postgres    false    225    226    226                       2604    21175    ttienda id_tienda    DEFAULT     v   ALTER TABLE ONLY public.ttienda ALTER COLUMN id_tienda SET DEFAULT nextval('public.ttienda_id_tienda_seq'::regclass);
 @   ALTER TABLE public.ttienda ALTER COLUMN id_tienda DROP DEFAULT;
       public          postgres    false    246    245    246            �           2604    21106    ttorneos id_torneo    DEFAULT     x   ALTER TABLE ONLY public.ttorneos ALTER COLUMN id_torneo SET DEFAULT nextval('public.ttorneos_id_torneo_seq'::regclass);
 A   ALTER TABLE public.ttorneos ALTER COLUMN id_torneo DROP DEFAULT;
       public          postgres    false    233    234    234                      0    21290    historicocliente 
   TABLE DATA           >   COPY public.historicocliente (id, dni_cl, estado) FROM stdin;
    public          postgres    false    264   �&                0    21283    historicopersonal 
   TABLE DATA           E   COPY public.historicopersonal (id, dni_personal, estado) FROM stdin;
    public          postgres    false    262   �&      �          0    21026    tadministrativo 
   TABLE DATA           K   COPY public.tadministrativo (id_adm, nombre_adm, dni_personal) FROM stdin;
    public          postgres    false    222   ,'      �          0    21014 	   tauxiliar 
   TABLE DATA           E   COPY public.tauxiliar (id_aux, nombre_aux, dni_personal) FROM stdin;
    public          postgres    false    220   Y'                0    21196 
   tcibercafe 
   TABLE DATA           Q   COPY public.tcibercafe (id_cibercafe, cod_local, horario, id_equipo) FROM stdin;
    public          postgres    false    250   v'      �          0    21074    tcliente 
   TABLE DATA           �   COPY public.tcliente (id_usuario, dni_cl, nombre_cl, apellido1_cl, apellido2_cl, email_cl, telefono_cl, dni_personal) FROM stdin;
    public          postgres    false    230   �'                0    21215    tclientesalajuegos 
   TABLE DATA           P   COPY public.tclientesalajuegos (id_clsj, id_salajuegos, id_usuario) FROM stdin;
    public          postgres    false    254   �'                0    21232    tclientetorneo 
   TABLE DATA           G   COPY public.tclientetorneo (id_clt, id_torneo, id_usuario) FROM stdin;
    public          postgres    false    256   (                0    21143 	   tconsolas 
   TABLE DATA           ;   COPY public.tconsolas (id_consolas, id_equipo) FROM stdin;
    public          postgres    false    242   "(                0    21266    tconsolasalasjuegos 
   TABLE DATA           P   COPY public.tconsolasalasjuegos (id_csj, id_salajuegos, id_consola) FROM stdin;
    public          postgres    false    260   ?(                0    21124    tequipos 
   TABLE DATA           O   COPY public.tequipos (id_equipo, num_serie, tipo_equipo, unidades) FROM stdin;
    public          postgres    false    238   \(      �          0    21002    tgerente 
   TABLE DATA           D   COPY public.tgerente (id_ger, nombre_ger, dni_personal) FROM stdin;
    public          postgres    false    218   y(      �          0    21086    tincidencias 
   TABLE DATA           O   COPY public.tincidencias (id_parte, observaciones, id_man, id_adm) FROM stdin;
    public          postgres    false    232   �(      �          0    21062 
   tlimpiador 
   TABLE DATA           F   COPY public.tlimpiador (id_lim, nombre_lim, dni_personal) FROM stdin;
    public          postgres    false    228   �(                0    21110    tlocal 
   TABLE DATA           ^   COPY public.tlocal (id_local, cif, direccion, telefono, web, horario, id_usuario) FROM stdin;
    public          postgres    false    236   �(      �          0    21038    tmantenimiento 
   TABLE DATA           J   COPY public.tmantenimiento (id_man, nombre_man, dni_personal) FROM stdin;
    public          postgres    false    224   )                0    21131    tordenadores 
   TABLE DATA           ?   COPY public.tordenadores (id_ordenador, id_equipo) FROM stdin;
    public          postgres    false    240   )      �          0    20995 	   tpersonal 
   TABLE DATA           �   COPY public.tpersonal (id, dni_personal, cargo, nombre_per, apellido1_per, apellido2_per, email_per, telefono_per, estado) FROM stdin;
    public          postgres    false    216   ;)                0    21249    tpersonaltorneo 
   TABLE DATA           I   COPY public.tpersonaltorneo (id_pt, id_torneo, dni_personal) FROM stdin;
    public          postgres    false    258   �)                0    21208    tsaladescanso 
   TABLE DATA           L   COPY public.tsaladescanso (id_saladescanso, cod_local, horario) FROM stdin;
    public          postgres    false    252   �)                0    21184    tsalajuegos 
   TABLE DATA           U   COPY public.tsalajuegos (id_salajuegos, cod_local, horario, id_consolas) FROM stdin;
    public          postgres    false    248   *      	          0    21155    ttaller 
   TABLE DATA           I   COPY public.ttaller (id_taller, horario, id_tec, id_usuario) FROM stdin;
    public          postgres    false    244   #*      �          0    21050    ttecnico 
   TABLE DATA           D   COPY public.ttecnico (id_tec, nombre_tec, dni_personal) FROM stdin;
    public          postgres    false    226   @*                0    21172    ttienda 
   TABLE DATA           A   COPY public.ttienda (id_tienda, horario, id_usuario) FROM stdin;
    public          postgres    false    246   ]*      �          0    21103    ttorneos 
   TABLE DATA           C   COPY public.ttorneos (id_torneo, fecha_torneo, premio) FROM stdin;
    public          postgres    false    234   z*      <           0    0    historicocliente_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.historicocliente_id_seq', 1, true);
          public          postgres    false    263            =           0    0    historicopersonal_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.historicopersonal_id_seq', 1, true);
          public          postgres    false    261            >           0    0    id_personal_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.id_personal_seq', 5, true);
          public          postgres    false    215            ?           0    0    tadministrativo_id_adm_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tadministrativo_id_adm_seq', 2, true);
          public          postgres    false    221            @           0    0    tauxiliar_id_aux_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tauxiliar_id_aux_seq', 1, false);
          public          postgres    false    219            A           0    0    tcibercafe_id_cibercafe_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.tcibercafe_id_cibercafe_seq', 1, false);
          public          postgres    false    249            B           0    0    tcliente_id_usuario_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.tcliente_id_usuario_seq', 2, true);
          public          postgres    false    229            C           0    0    tclientesalajuegos_id_clsj_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tclientesalajuegos_id_clsj_seq', 1, false);
          public          postgres    false    253            D           0    0    tclientetorneo_id_clt_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tclientetorneo_id_clt_seq', 1, false);
          public          postgres    false    255            E           0    0    tconsolas_id_consolas_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tconsolas_id_consolas_seq', 1, false);
          public          postgres    false    241            F           0    0    tconsolasalasjuegos_id_csj_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tconsolasalasjuegos_id_csj_seq', 1, false);
          public          postgres    false    259            G           0    0    tequipos_id_equipo_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.tequipos_id_equipo_seq', 1, false);
          public          postgres    false    237            H           0    0    tgerente_id_ger_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tgerente_id_ger_seq', 1, true);
          public          postgres    false    217            I           0    0    tincidencias_id_parte_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tincidencias_id_parte_seq', 1, false);
          public          postgres    false    231            J           0    0    tlimpiador_id_lim_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.tlimpiador_id_lim_seq', 1, false);
          public          postgres    false    227            K           0    0    tlocal_id_local_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.tlocal_id_local_seq', 1, false);
          public          postgres    false    235            L           0    0    tmantenimiento_id_man_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tmantenimiento_id_man_seq', 1, false);
          public          postgres    false    223            M           0    0    tordenadores_id_ordenador_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tordenadores_id_ordenador_seq', 1, false);
          public          postgres    false    239            N           0    0    tpersonaltorneo_id_pt_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tpersonaltorneo_id_pt_seq', 1, false);
          public          postgres    false    257            O           0    0 !   tsaladescanso_id_saladescanso_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.tsaladescanso_id_saladescanso_seq', 1, false);
          public          postgres    false    251            P           0    0    tsalajuegos_id_salajuegos_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tsalajuegos_id_salajuegos_seq', 1, false);
          public          postgres    false    247            Q           0    0    ttaller_id_taller_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.ttaller_id_taller_seq', 1, false);
          public          postgres    false    243            R           0    0    ttecnico_id_tec_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.ttecnico_id_tec_seq', 1, false);
          public          postgres    false    225            S           0    0    ttienda_id_tienda_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.ttienda_id_tienda_seq', 1, false);
          public          postgres    false    245            T           0    0    ttorneos_id_torneo_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.ttorneos_id_torneo_seq', 1, false);
          public          postgres    false    233                       2606    21000    tpersonal dni_personal_unique 
   CONSTRAINT     `   ALTER TABLE ONLY public.tpersonal
    ADD CONSTRAINT dni_personal_unique UNIQUE (dni_personal);
 G   ALTER TABLE ONLY public.tpersonal DROP CONSTRAINT dni_personal_unique;
       public            postgres    false    216            B           2606    21295 &   historicocliente historicocliente_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.historicocliente
    ADD CONSTRAINT historicocliente_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.historicocliente DROP CONSTRAINT historicocliente_pkey;
       public            postgres    false    264            @           2606    21288 (   historicopersonal historicopersonal_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.historicopersonal
    ADD CONSTRAINT historicopersonal_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.historicopersonal DROP CONSTRAINT historicopersonal_pkey;
       public            postgres    false    262                       2606    21031 $   tadministrativo tadministrativo_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tadministrativo
    ADD CONSTRAINT tadministrativo_pkey PRIMARY KEY (id_adm);
 N   ALTER TABLE ONLY public.tadministrativo DROP CONSTRAINT tadministrativo_pkey;
       public            postgres    false    222                       2606    21019    tauxiliar tauxiliar_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tauxiliar
    ADD CONSTRAINT tauxiliar_pkey PRIMARY KEY (id_aux);
 B   ALTER TABLE ONLY public.tauxiliar DROP CONSTRAINT tauxiliar_pkey;
       public            postgres    false    220            4           2606    21201    tcibercafe tcibercafe_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tcibercafe
    ADD CONSTRAINT tcibercafe_pkey PRIMARY KEY (id_cibercafe);
 D   ALTER TABLE ONLY public.tcibercafe DROP CONSTRAINT tcibercafe_pkey;
       public            postgres    false    250                       2606    21079    tcliente tcliente_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tcliente
    ADD CONSTRAINT tcliente_pkey PRIMARY KEY (id_usuario);
 @   ALTER TABLE ONLY public.tcliente DROP CONSTRAINT tcliente_pkey;
       public            postgres    false    230            8           2606    21220 *   tclientesalajuegos tclientesalajuegos_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.tclientesalajuegos
    ADD CONSTRAINT tclientesalajuegos_pkey PRIMARY KEY (id_clsj);
 T   ALTER TABLE ONLY public.tclientesalajuegos DROP CONSTRAINT tclientesalajuegos_pkey;
       public            postgres    false    254            :           2606    21237 "   tclientetorneo tclientetorneo_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.tclientetorneo
    ADD CONSTRAINT tclientetorneo_pkey PRIMARY KEY (id_clt);
 L   ALTER TABLE ONLY public.tclientetorneo DROP CONSTRAINT tclientetorneo_pkey;
       public            postgres    false    256            ,           2606    21148    tconsolas tconsolas_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.tconsolas
    ADD CONSTRAINT tconsolas_pkey PRIMARY KEY (id_consolas);
 B   ALTER TABLE ONLY public.tconsolas DROP CONSTRAINT tconsolas_pkey;
       public            postgres    false    242            >           2606    21271 ,   tconsolasalasjuegos tconsolasalasjuegos_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tconsolasalasjuegos
    ADD CONSTRAINT tconsolasalasjuegos_pkey PRIMARY KEY (id_csj);
 V   ALTER TABLE ONLY public.tconsolasalasjuegos DROP CONSTRAINT tconsolasalasjuegos_pkey;
       public            postgres    false    260            (           2606    21129    tequipos tequipos_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.tequipos
    ADD CONSTRAINT tequipos_pkey PRIMARY KEY (id_equipo);
 @   ALTER TABLE ONLY public.tequipos DROP CONSTRAINT tequipos_pkey;
       public            postgres    false    238                       2606    21007    tgerente tgerente_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.tgerente
    ADD CONSTRAINT tgerente_pkey PRIMARY KEY (id_ger);
 @   ALTER TABLE ONLY public.tgerente DROP CONSTRAINT tgerente_pkey;
       public            postgres    false    218                        2606    21091    tincidencias tincidencias_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tincidencias
    ADD CONSTRAINT tincidencias_pkey PRIMARY KEY (id_parte);
 H   ALTER TABLE ONLY public.tincidencias DROP CONSTRAINT tincidencias_pkey;
       public            postgres    false    232                       2606    21067    tlimpiador tlimpiador_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tlimpiador
    ADD CONSTRAINT tlimpiador_pkey PRIMARY KEY (id_lim);
 D   ALTER TABLE ONLY public.tlimpiador DROP CONSTRAINT tlimpiador_pkey;
       public            postgres    false    228            $           2606    21117    tlocal tlocal_cif_key 
   CONSTRAINT     O   ALTER TABLE ONLY public.tlocal
    ADD CONSTRAINT tlocal_cif_key UNIQUE (cif);
 ?   ALTER TABLE ONLY public.tlocal DROP CONSTRAINT tlocal_cif_key;
       public            postgres    false    236            &           2606    21115    tlocal tlocal_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.tlocal
    ADD CONSTRAINT tlocal_pkey PRIMARY KEY (id_local);
 <   ALTER TABLE ONLY public.tlocal DROP CONSTRAINT tlocal_pkey;
       public            postgres    false    236                       2606    21043 "   tmantenimiento tmantenimiento_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.tmantenimiento
    ADD CONSTRAINT tmantenimiento_pkey PRIMARY KEY (id_man);
 L   ALTER TABLE ONLY public.tmantenimiento DROP CONSTRAINT tmantenimiento_pkey;
       public            postgres    false    224            *           2606    21136    tordenadores tordenadores_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tordenadores
    ADD CONSTRAINT tordenadores_pkey PRIMARY KEY (id_ordenador);
 H   ALTER TABLE ONLY public.tordenadores DROP CONSTRAINT tordenadores_pkey;
       public            postgres    false    240            <           2606    21254 $   tpersonaltorneo tpersonaltorneo_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tpersonaltorneo
    ADD CONSTRAINT tpersonaltorneo_pkey PRIMARY KEY (id_pt);
 N   ALTER TABLE ONLY public.tpersonaltorneo DROP CONSTRAINT tpersonaltorneo_pkey;
       public            postgres    false    258            6           2606    21213     tsaladescanso tsaladescanso_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.tsaladescanso
    ADD CONSTRAINT tsaladescanso_pkey PRIMARY KEY (id_saladescanso);
 J   ALTER TABLE ONLY public.tsaladescanso DROP CONSTRAINT tsaladescanso_pkey;
       public            postgres    false    252            2           2606    21189    tsalajuegos tsalajuegos_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tsalajuegos
    ADD CONSTRAINT tsalajuegos_pkey PRIMARY KEY (id_salajuegos);
 F   ALTER TABLE ONLY public.tsalajuegos DROP CONSTRAINT tsalajuegos_pkey;
       public            postgres    false    248            .           2606    21160    ttaller ttaller_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.ttaller
    ADD CONSTRAINT ttaller_pkey PRIMARY KEY (id_taller);
 >   ALTER TABLE ONLY public.ttaller DROP CONSTRAINT ttaller_pkey;
       public            postgres    false    244                       2606    21055    ttecnico ttecnico_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.ttecnico
    ADD CONSTRAINT ttecnico_pkey PRIMARY KEY (id_tec);
 @   ALTER TABLE ONLY public.ttecnico DROP CONSTRAINT ttecnico_pkey;
       public            postgres    false    226            0           2606    21177    ttienda ttienda_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.ttienda
    ADD CONSTRAINT ttienda_pkey PRIMARY KEY (id_tienda);
 >   ALTER TABLE ONLY public.ttienda DROP CONSTRAINT ttienda_pkey;
       public            postgres    false    246            "           2606    21108    ttorneos ttorneos_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.ttorneos
    ADD CONSTRAINT ttorneos_pkey PRIMARY KEY (id_torneo);
 @   ALTER TABLE ONLY public.ttorneos DROP CONSTRAINT ttorneos_pkey;
       public            postgres    false    234            ]           2620    21297    tcliente cliente_eliminado    TRIGGER     |   CREATE TRIGGER cliente_eliminado AFTER DELETE ON public.tcliente FOR EACH ROW EXECUTE FUNCTION public.trigger_delcliente();
 3   DROP TRIGGER cliente_eliminado ON public.tcliente;
       public          postgres    false    276    230            \           2620    21305    tpersonal personal_eliminado    TRIGGER        CREATE TRIGGER personal_eliminado AFTER DELETE ON public.tpersonal FOR EACH ROW EXECUTE FUNCTION public.trigger_delpersonal();
 5   DROP TRIGGER personal_eliminado ON public.tpersonal;
       public          postgres    false    216    283            E           2606    21032 1   tadministrativo tadministrativo_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tadministrativo
    ADD CONSTRAINT tadministrativo_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 [   ALTER TABLE ONLY public.tadministrativo DROP CONSTRAINT tadministrativo_dni_personal_fkey;
       public          postgres    false    222    3344    216            D           2606    21020 %   tauxiliar tauxiliar_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tauxiliar
    ADD CONSTRAINT tauxiliar_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 O   ALTER TABLE ONLY public.tauxiliar DROP CONSTRAINT tauxiliar_dni_personal_fkey;
       public          postgres    false    220    216    3344            S           2606    21202 $   tcibercafe tcibercafe_id_equipo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tcibercafe
    ADD CONSTRAINT tcibercafe_id_equipo_fkey FOREIGN KEY (id_equipo) REFERENCES public.tequipos(id_equipo) ON UPDATE SET NULL ON DELETE SET NULL;
 N   ALTER TABLE ONLY public.tcibercafe DROP CONSTRAINT tcibercafe_id_equipo_fkey;
       public          postgres    false    250    3368    238            I           2606    21080 #   tcliente tcliente_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tcliente
    ADD CONSTRAINT tcliente_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 M   ALTER TABLE ONLY public.tcliente DROP CONSTRAINT tcliente_dni_personal_fkey;
       public          postgres    false    216    3344    230            T           2606    21221 8   tclientesalajuegos tclientesalajuegos_id_salajuegos_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tclientesalajuegos
    ADD CONSTRAINT tclientesalajuegos_id_salajuegos_fkey FOREIGN KEY (id_salajuegos) REFERENCES public.tsalajuegos(id_salajuegos) ON UPDATE SET NULL ON DELETE SET NULL;
 b   ALTER TABLE ONLY public.tclientesalajuegos DROP CONSTRAINT tclientesalajuegos_id_salajuegos_fkey;
       public          postgres    false    248    254    3378            U           2606    21226 5   tclientesalajuegos tclientesalajuegos_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tclientesalajuegos
    ADD CONSTRAINT tclientesalajuegos_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tcliente(id_usuario) ON UPDATE SET NULL ON DELETE SET NULL;
 _   ALTER TABLE ONLY public.tclientesalajuegos DROP CONSTRAINT tclientesalajuegos_id_usuario_fkey;
       public          postgres    false    230    254    3358            V           2606    21238 ,   tclientetorneo tclientetorneo_id_torneo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tclientetorneo
    ADD CONSTRAINT tclientetorneo_id_torneo_fkey FOREIGN KEY (id_torneo) REFERENCES public.ttorneos(id_torneo) ON UPDATE SET NULL ON DELETE SET NULL;
 V   ALTER TABLE ONLY public.tclientetorneo DROP CONSTRAINT tclientetorneo_id_torneo_fkey;
       public          postgres    false    3362    256    234            W           2606    21243 -   tclientetorneo tclientetorneo_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tclientetorneo
    ADD CONSTRAINT tclientetorneo_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tcliente(id_usuario) ON UPDATE SET NULL ON DELETE SET NULL;
 W   ALTER TABLE ONLY public.tclientetorneo DROP CONSTRAINT tclientetorneo_id_usuario_fkey;
       public          postgres    false    230    256    3358            N           2606    21149 "   tconsolas tconsolas_id_equipo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tconsolas
    ADD CONSTRAINT tconsolas_id_equipo_fkey FOREIGN KEY (id_equipo) REFERENCES public.tequipos(id_equipo) ON UPDATE SET NULL ON DELETE SET NULL;
 L   ALTER TABLE ONLY public.tconsolas DROP CONSTRAINT tconsolas_id_equipo_fkey;
       public          postgres    false    242    3368    238            Z           2606    21277 7   tconsolasalasjuegos tconsolasalasjuegos_id_consola_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tconsolasalasjuegos
    ADD CONSTRAINT tconsolasalasjuegos_id_consola_fkey FOREIGN KEY (id_consola) REFERENCES public.tconsolas(id_consolas) ON UPDATE SET NULL ON DELETE SET NULL;
 a   ALTER TABLE ONLY public.tconsolasalasjuegos DROP CONSTRAINT tconsolasalasjuegos_id_consola_fkey;
       public          postgres    false    242    260    3372            [           2606    21272 :   tconsolasalasjuegos tconsolasalasjuegos_id_salajuegos_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tconsolasalasjuegos
    ADD CONSTRAINT tconsolasalasjuegos_id_salajuegos_fkey FOREIGN KEY (id_salajuegos) REFERENCES public.tsalajuegos(id_salajuegos) ON UPDATE SET NULL ON DELETE SET NULL;
 d   ALTER TABLE ONLY public.tconsolasalasjuegos DROP CONSTRAINT tconsolasalasjuegos_id_salajuegos_fkey;
       public          postgres    false    3378    260    248            C           2606    21008 #   tgerente tgerente_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tgerente
    ADD CONSTRAINT tgerente_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 M   ALTER TABLE ONLY public.tgerente DROP CONSTRAINT tgerente_dni_personal_fkey;
       public          postgres    false    216    3344    218            J           2606    21097 %   tincidencias tincidencias_id_adm_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tincidencias
    ADD CONSTRAINT tincidencias_id_adm_fkey FOREIGN KEY (id_adm) REFERENCES public.tadministrativo(id_adm) ON UPDATE SET NULL ON DELETE SET NULL;
 O   ALTER TABLE ONLY public.tincidencias DROP CONSTRAINT tincidencias_id_adm_fkey;
       public          postgres    false    3350    232    222            K           2606    21092 %   tincidencias tincidencias_id_man_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tincidencias
    ADD CONSTRAINT tincidencias_id_man_fkey FOREIGN KEY (id_man) REFERENCES public.tmantenimiento(id_man) ON UPDATE SET NULL ON DELETE SET NULL;
 O   ALTER TABLE ONLY public.tincidencias DROP CONSTRAINT tincidencias_id_man_fkey;
       public          postgres    false    224    3352    232            H           2606    21068 '   tlimpiador tlimpiador_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tlimpiador
    ADD CONSTRAINT tlimpiador_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 Q   ALTER TABLE ONLY public.tlimpiador DROP CONSTRAINT tlimpiador_dni_personal_fkey;
       public          postgres    false    216    3344    228            L           2606    21118    tlocal tlocal_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tlocal
    ADD CONSTRAINT tlocal_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tcliente(id_usuario) ON UPDATE SET NULL ON DELETE SET NULL;
 G   ALTER TABLE ONLY public.tlocal DROP CONSTRAINT tlocal_id_usuario_fkey;
       public          postgres    false    230    3358    236            F           2606    21044 /   tmantenimiento tmantenimiento_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tmantenimiento
    ADD CONSTRAINT tmantenimiento_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 Y   ALTER TABLE ONLY public.tmantenimiento DROP CONSTRAINT tmantenimiento_dni_personal_fkey;
       public          postgres    false    224    216    3344            M           2606    21137 (   tordenadores tordenadores_id_equipo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tordenadores
    ADD CONSTRAINT tordenadores_id_equipo_fkey FOREIGN KEY (id_equipo) REFERENCES public.tequipos(id_equipo) ON UPDATE SET NULL ON DELETE SET NULL;
 R   ALTER TABLE ONLY public.tordenadores DROP CONSTRAINT tordenadores_id_equipo_fkey;
       public          postgres    false    3368    238    240            X           2606    21260 1   tpersonaltorneo tpersonaltorneo_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tpersonaltorneo
    ADD CONSTRAINT tpersonaltorneo_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 [   ALTER TABLE ONLY public.tpersonaltorneo DROP CONSTRAINT tpersonaltorneo_dni_personal_fkey;
       public          postgres    false    258    3344    216            Y           2606    21255 .   tpersonaltorneo tpersonaltorneo_id_torneo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tpersonaltorneo
    ADD CONSTRAINT tpersonaltorneo_id_torneo_fkey FOREIGN KEY (id_torneo) REFERENCES public.ttorneos(id_torneo) ON UPDATE SET NULL ON DELETE SET NULL;
 X   ALTER TABLE ONLY public.tpersonaltorneo DROP CONSTRAINT tpersonaltorneo_id_torneo_fkey;
       public          postgres    false    3362    234    258            R           2606    21190 (   tsalajuegos tsalajuegos_id_consolas_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tsalajuegos
    ADD CONSTRAINT tsalajuegos_id_consolas_fkey FOREIGN KEY (id_consolas) REFERENCES public.tconsolas(id_consolas) ON UPDATE SET NULL ON DELETE SET NULL;
 R   ALTER TABLE ONLY public.tsalajuegos DROP CONSTRAINT tsalajuegos_id_consolas_fkey;
       public          postgres    false    3372    248    242            O           2606    21161    ttaller ttaller_id_tec_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.ttaller
    ADD CONSTRAINT ttaller_id_tec_fkey FOREIGN KEY (id_tec) REFERENCES public.ttecnico(id_tec) ON UPDATE SET NULL ON DELETE SET NULL;
 E   ALTER TABLE ONLY public.ttaller DROP CONSTRAINT ttaller_id_tec_fkey;
       public          postgres    false    3354    226    244            P           2606    21166    ttaller ttaller_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.ttaller
    ADD CONSTRAINT ttaller_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tcliente(id_usuario) ON UPDATE SET NULL ON DELETE SET NULL;
 I   ALTER TABLE ONLY public.ttaller DROP CONSTRAINT ttaller_id_usuario_fkey;
       public          postgres    false    230    244    3358            G           2606    21056 #   ttecnico ttecnico_dni_personal_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.ttecnico
    ADD CONSTRAINT ttecnico_dni_personal_fkey FOREIGN KEY (dni_personal) REFERENCES public.tpersonal(dni_personal) ON UPDATE SET NULL ON DELETE SET NULL;
 M   ALTER TABLE ONLY public.ttecnico DROP CONSTRAINT ttecnico_dni_personal_fkey;
       public          postgres    false    3344    216    226            Q           2606    21178    ttienda ttienda_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.ttienda
    ADD CONSTRAINT ttienda_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tcliente(id_usuario) ON UPDATE SET NULL ON DELETE SET NULL;
 I   ALTER TABLE ONLY public.ttienda DROP CONSTRAINT ttienda_id_usuario_fkey;
       public          postgres    false    246    230    3358               %   x�3�,(*MMJL�/*J,���KL.�,������ ��	:            x�3�L�/*J,���KL.�,������ X��      �      x�3���O��462��07������� 8${      �      x������ � �            x������ � �      �   E   x�3�4�035162��M,�L��I�t+J�K΀R��E���EE��z����@�@� ����4�+F��� �lF            x������ � �            x������ � �            x������ � �            x������ � �            x������ � �      �   !   x�3�LN�K�L��4122270������� W �      �      x������ � �      �      x������ � �            x������ � �      �      x������ � �            x������ � �      �   �   x�M�A� E��a�B);��nL"�͈���V�&.���O�ADw<Å����)���+4�7�!yi�XD�t��0Xӣ���)�܊B���`Js�����= l����Ğ�/���;���SJ} ��4�            x������ � �            x������ � �            x������ � �      	      x������ � �      �      x������ � �            x������ � �      �      x������ � �     