<?php

require_once "bd.php";

class personal{

    private $db;
    private $dni_personal;
    private $cargo;
    private $nombre_per;
    private $apellido1_per;
    private $apellido2_per;
    private $email_per;
    private $telefono_per;
    private $id;
    private $estado;


    function __construct(){
        $bd=new bd();
        $this->db=$bd->conectarBD();
    }
    function verHistorico(){
        try {
            $querySelect = "select * from sp_obtenerpersonalhistorico()";
            $listapersonal=$this->db->prepare($querySelect);
            $listapersonal->execute();
    
        } catch (Exception $ex) {
            echo "Te equivocaste en: ".$ex->getMessage();
        }
        return $listapersonal->fetchALL(PDO::FETCH_CLASS,"personal");
    }



	function obtenerPersonaindividual($dni_personal){
		try {
            $query = "SELECT * from sp_obtenerpersonalindividual(:dni_personal)";
            $instancia =$this->db->prepare($query);
            $instancia->bindParam(":dni_personal", $dni_personal);
            $instancia->execute();

            if ($instancia) {
                return $instancia->fetchALL(PDO::FETCH_CLASS,"personal")[0];
            } else {
                echo "Hubo un error";
            }
    
        } catch (Exception $ex) {
            echo "Hubo el siguiente fallo";
            echo var_dump($ex);
            return null;
        }
	} 
    function obtenerPersonalAlta(){
        try {
            $query = "Select * from sp_obtenerpersonalalta()";
            $listapersonal = $this->db->prepare($query);
            $listapersonal->execute();
        } catch (Exception $ex) {
            echo "Te equivocaste en: ".$ex->getMessage();
        }
        return $listapersonal->fetchALL(PDO::FETCH_CLASS,"personal");
    }

    function obtenerPersonal(){
        try {
            $querySelect = "SELECT * FROM public.sp_obtenerpersonal()";
            $listapersonal=$this->db->prepare($querySelect);
            $listapersonal->execute();

			if($listapersonal){
				return $listapersonal->fetchAll(PDO::FETCH_CLASS,'personal');
			}else{
				echo "no se pudo obtener listado";
			}
    
        } catch (Exception $ex) {
            echo "Te equivocaste en: ".$ex->getMessage();
        }
        return $listapersonal->fetchALL(PDO::FETCH_CLASS,"personal");
    }


	function addPersona() {
		try {
			$insertarPersona = "CALL public.sp_addpersona($this)";
			$queryPersona = $this->db->query($insertarPersona);
				
			if ($queryPersona) {
				echo "Personal creado correctamente ";
				header("Location:/proyectoBasePHP/vista/personal/listarpersonal.php");
			} else {
				echo "Ocurrió un error inesperado al insertar el personal";
			}
		} catch (Exception $e) {
			echo "no se ha podido insertar ".var_dump($e);
			return null;
		}
	}
   
    
    function delPersona($dni_personal) {
        try {
            $eliminarPersona = "CALL sp_delPersona(:dni_personal)";
            $queryPersona = $this->db->prepare($eliminarPersona);
            $queryPersona->bindParam(":dni_personal", $dni_personal);
            $queryPersona->execute();
    
            $mensaje="Se ha eliminado la persona con dni ".$dni_personal." correctamente";
            return $mensaje;
    
        } catch (Exception $e) {
            $Fallido ="No se ha podido eliminar la persona".$e;
            return $Fallido;
        }
    }
	
	function editarPersona() {
		try {
           
			$modificarPersona = "CALL sp_editarpersona($this)";
            $querymodificar = $this->db->query($modificarPersona);
			header("Location:/proyectoBasePHP/vista/personal/listarpersonal.php");
		
		} catch (Exception $e) {
			throw new Exception("Hubo un error al modificar la persona: ".$e->getMessage());
		}
	}

	public function __toString(){
		if($this->id){
			return "('$this->id','$this->dni_personal','$this->cargo','$this->nombre_per','$this->apellido1_per', '$this->apellido2_per', '$this->email_per', '$this->telefono_per','$this->estado')";
		}else{
			return "(null,'$this->dni_personal','$this->cargo','$this->nombre_per','$this->apellido1_per', '$this->apellido2_per', '$this->email_per', '$this->telefono_per','$this->estado')";
		}
	}

    
	/**
	 * @return mixed
	 */
	public function getCargo() {
		return $this->cargo;
	}
	
	/**
	 * @param mixed $cargo 
	 * @return self
	 */
	public function setCargo($cargo): self {
		$this->cargo = $cargo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNombre_per() {
		return $this->nombre_per;
	}
	
	/**
	 * @param mixed $nombre_per 
	 * @return self
	 */
	public function setNombre_per($nombre_per): self {
		$this->nombre_per = $nombre_per;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getApellido1_per() {
		return $this->apellido1_per;
	}
	
	/**
	 * @param mixed $apellido1_per 
	 * @return self
	 */
	public function setApellido1_per($apellido1_per): self {
		$this->apellido1_per = $apellido1_per;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getApellido2_per() {
		return $this->apellido2_per;
	}
	
	/**
	 * @param mixed $apellido2_per 
	 * @return self
	 */
	public function setApellido2_per($apellido2_per): self {
		$this->apellido2_per = $apellido2_per;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail_per() {
		return $this->email_per;
	}
	
	/**
	 * @param mixed $email_per 
	 * @return self
	 */
	public function setEmail_per($email_per): self {
		$this->email_per = $email_per;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTelefono_per() {
		return $this->telefono_per;
	}
	
	/**
	 * @param mixed $telefono_per 
	 * @return self
	 */
	public function setTelefono_per($telefono_per): self {
		$this->telefono_per = $telefono_per;
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
}