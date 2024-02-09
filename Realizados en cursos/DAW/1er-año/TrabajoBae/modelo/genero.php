<?php

require_once "bd.php";
class Genero
{
    private $db;
    private $cod;
    private $nombre;

    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function obtenerListadoGeneros()
    {
        try {
            $querySelect = "SELECT * FROM generos";

            $listaGeneros = $this->db->prepare($querySelect);

            $listaGeneros->execute();

            if ($listaGeneros) {
                return $listaGeneros->fetchAll(PDO::FETCH_CLASS, "Genero");
            } else {
                echo "Ocurrió un error inesperado al obtener el Listado de Generos";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

	/**
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @param mixed $nombre 
	 * @return self
	 */
	public function setNombre($nombre): self {
		$this->nombre = $nombre;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCod() {
		return $this->cod;
	}
	
	/**
	 * @param mixed $cod 
	 * @return self
	 */
	public function setCod($cod): self {
		$this->cod = $cod;
		return $this;
	}
}
