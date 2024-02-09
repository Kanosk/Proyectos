<?php

require_once "bd.php";

class Cliente {

    private $db;
    private $id_usuario;
    private $dni_cl;
    private $nombre_cl;
    private $apellido1_cl;
    private $apellido2_cl;
    private $email_cl;
    private $telefono_cl;
    private $dni_personal;
    private $estado;
    private $id;

    function __construct(){
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function verHistorico(){
        try {
            $querySelect = "SELECT * FROM  sp_obtenerclienteHistorico()";
            $listapersonal=$this->db->prepare($querySelect);
            $listapersonal->execute();
    
        } catch (Exception $ex) {
            echo "Te equivocaste en: ".$ex->getMessage();
        }
        return $listapersonal->fetchALL(PDO::FETCH_CLASS,"Cliente");
    }

    function obtenerCliente() {
       
        try {
            $querySelect = "SELECT * FROM public.sp_obtenercliente()";
            $listacliente=$this->db->prepare($querySelect);
            $listacliente->execute();

			if($listacliente){
				return $listacliente->fetchAll(PDO::FETCH_CLASS,'Cliente');
			}else{
				echo "no se pudo obtener listado";
			}
    
        } catch (Exception $e) {
            throw new Exception("Hubo un error: " . $e->getMessage());
        }
    }
    
    function obtenerClienteEdit($id_usuario){
        try{
        $query = "SELECT * FROM sp_obtenerclienteindividual(:id_usuario)";
        $instancia = $this->db->prepare($query);
        $instancia->bindParam(":id_usuario",$id_usuario);
        $instancia->execute();

        if ($instancia) {
            return $instancia->fetchALL(PDO::FETCH_CLASS,"Cliente")[0];
        } else {
            echo "Hubo un error";
        }

    }
    catch (Exception $e) {
         echo "Hubo el siguiente fallo";
            echo var_dump($e);
            return null;
    }
    }
    

    function addCliente(){
        try {
           $queryCliente = $this->db->prepare("CALL sp_agregar_clientes(?, ?, ?, ?, ?, ?, ?)");
            $queryCliente->bindParam(1, $this->dni_cl);
            $queryCliente->bindParam(2, $this->nombre_cl);
            $queryCliente->bindParam(3, $this->apellido1_cl);
            $queryCliente->bindParam(4, $this->apellido2_cl);
            $queryCliente->bindParam(5, $this->email_cl);
            $queryCliente->bindParam(6, $this->telefono_cl);
            $queryCliente->bindParam(7, $this->dni_personal);
        
            $queryCliente->execute();
        
            $mensaje = "Se ha introducido correctamente al cliente ".$this->dni_cl;
        
            return $mensaje;
        } catch (Exception $ex) {
            echo "Hay un error en ".$ex->getMessage();
            $Fallido = "No se ha podido insertar el cliente.";
            return $Fallido;
        }
    }
    public function editCliente($id_usuario, $nombre_cl, $apellido1_cl, $apellido2_cl, $email_cl, $telefono_cl) {
       try{
        $query = "CALL sp_editarcliente(:id_usuario, :nombre_cl, :apellido1_cl, :apellido2_cl, :email_cl, :telefono_cl)";
        $queryCliente = $this->db->prepare($query);
        $queryCliente->bindParam(":id_usuario", $id_usuario);
        $queryCliente->bindParam(":nombre_cl", $nombre_cl);
        $queryCliente->bindParam(":apellido1_cl", $apellido1_cl);
        $queryCliente->bindParam(":apellido2_cl", $apellido2_cl);
        $queryCliente->bindParam(":email_cl", $email_cl);
        $queryCliente->bindParam(":telefono_cl", $telefono_cl);
        $queryCliente->execute();
        $mensaje="se ha editado el cliente";
        return $mensaje;
       }catch (Exception $e) {
        throw new Exception("Hubo un error al modificar el cliente: ".$e->getMessage());
    }
    }
 

    function delCliente($id_usuario){
       try{ 
        $query = "CALL sp_delcliente(:id_usuario)";
        $queryCliente = $this->db->prepare($query);
        $queryCliente->bindParam(":id_usuario", $id_usuario);
        $queryCliente->execute();
        $mensaje="Se ha eliminado la persona con id ".$id_usuario." correctamente";
        return $mensaje;

    } catch (Exception $e) {
        $Fallido ="No se ha podido eliminar la persona".$e;
        return $Fallido;
    }
    }

    public function __toString(){
		if($this->id_usuario){
			return"('$this->id_usuario', '$this->nombre_cl', '$this->apellido1_cl', '$this->apellido2_cl', '$this->email_cl', '$this->telefono_cl', '$this->dni_personal')";
        } else {
            return "(null, '$this->nombre_cl', '$this->apellido1_cl', '$this->apellido2_cl', '$this->email_cl', '$this->telefono_cl', '$this->dni_personal')";
        }
	}
    /**
     * @return mixed
     */
    public function getId_usuario() {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario 
     * @return self
     */
    public function setId_usuario($id_usuario): self {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getdni_cl() {
        return $this->dni_cl;
    }

    /**
     * @param mixed $dni_cl 
     * @return self
     */
    public function setdni_cl($dni_cl): self {
        $this->dni_cl = $dni_cl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombre_cl() {
        return $this->nombre_cl;
    }

    /**
     * @param mixed $nombre_cl 
     * @return self
     */
    public function setNombre_cl($nombre_cl): self {
        $this->nombre_cl = $nombre_cl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApellido1_cl() {
        return $this->apellido1_cl;
    }

    /**
     * @param mixed $apellido1_cl 
     * @return self
     */
    public function setApellido1_cl($apellido1_cl): self {
        $this->apellido1_cl = $apellido1_cl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApellido2_cl() {
        return $this->apellido2_cl;
    }

    /**
     * @param mixed $apellido2_cl 
     * @return self
     */
    public function setApellido2_cl($apellido2_cl): self {
        $this->apellido2_cl = $apellido2_cl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail_cl() {
        return $this->email_cl;
    }

    /**
     * @param mixed $email_cl 
     * @return self
     */
    public function setEmail_cl($email_cl): self {
        $this->email_cl = $email_cl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefono_cl() {
        return $this->telefono_cl;
    }

    /**
     * @param mixed $telefono_cl 
     * @return self
     */
    public function setTelefono_cl($telefono_cl): self {
        $this->telefono_cl = $telefono_cl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getdni_personal() {
        return $this->dni_personal;
    }

    /**
     * @param mixed $dni_personal 
     * @return self
     */
    public function setdni_personal($dni_personal): self {
        $this->dni_personal = $dni_personal;
        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getEstado() {
		return $this->estado;
	}
	
	/**
	 * @param mixed $estado 
	 * @return self
	 */
	public function setEstado($estado): self {
		$this->estado = $estado;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
}