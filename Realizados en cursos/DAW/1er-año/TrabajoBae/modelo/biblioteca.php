<?php

require_once "bd.php";

class Biblioteca
{
    private $db;
    private $id;
    private $nombre;
    private $descripcion;
    private $numerolibros;
    private $estado;

    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function obtenerListadoBibliotecas()
    {
        try {

            $querySelect = "SELECT DISTINCT *
                        FROM bibliotecas";
            $listaBibliotecas = $this->db->prepare($querySelect);

            $listaBibliotecas->execute();

            if ($listaBibliotecas) {
                return $listaBibliotecas->fetchAll(PDO::FETCH_CLASS, "Biblioteca");
            } else {
                echo "Ocurrió un error inesperado al obtener el Listado de Bibliotecas";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function insertarBiblioteca()
    {
        try {
            $queryInsertar = "INSERT INTO bibliotecas (id, nombre, descripcion, numerolibros, estado)
                                 VALUES (:id, :nombre, :descripcion, :numerolibros, :estado)";
            $instanciaDB = $this->db->prepare($queryInsertar);

            $instanciaDB->bindParam(":id", $this->id);
            $instanciaDB->bindParam(":nombre", $this->nombre);

            $instanciaDB->bindParam(":descripcion", $this->descripcion);
            $instanciaDB->bindParam(":numerolibros", $this->numerolibros);

            $instanciaDB->bindParam(":estado", $this->estado);

            $respuestaInsertar = $instanciaDB->execute();

            if ($respuestaInsertar) {
                echo "Libreria creada correctamente";
                header("Location:index.php");
            } else {
                echo "Ocurrió un error inesperado al crear la Biblioteca";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function eliminarBiblioteca($id)
    {
        try {
            $queryBorrar = "DELETE FROM bibliotecas WHERE id= :id";
            $instanciaDB = $this->db->prepare($queryBorrar);
            $instanciaDB->bindParam(":id", $this->id);
            $respuestaBorrar = $instanciaDB->execute();
            $queryBorrarRelaciones = "DELETE FROM biblioteca_libros WHERE idbiblioteca= :id";
            $instanciaDBRelaciones = $this->db->prepare($queryBorrarRelaciones);
            $instanciaDBRelaciones->bindParam(":id", $this->id);
            $respuestaBorrarRelaciones = $instanciaDBRelaciones->execute();

            if ($respuestaBorrar && $respuestaBorrarRelaciones) {
                echo "Biblioteca eliminada correctamente";
                //header("Location:index.php");
            } else {
                echo "Ocurrió un error inesperado al eliminar la Biblioteca";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerBiblioteca()
    {
        try {
            $querySelect = "SELECT DISTINCT * FROM Bibliotecas WHERE id= :id";
            
            $instanciaDB = $this->db->prepare($querySelect);

            $instanciaDB->bindParam(":id", $this->id);

            $instanciaDB->execute();

            if ($instanciaDB) {
                return $instanciaDB->fetchAll(PDO::FETCH_CLASS, "Biblioteca")[0];
            } else {
                echo "Ocurrió un error inesperado al recuperar la Biblioteca seleccionada";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function actualizarBiblioteca()
    {
        try {
            $queryUpdate = "UPDATE bibliotecas SET id = :id, nombre = :nombre, 
                                    descripcion = :descripcion,
                                    estado = :estado  WHERE id = :id";

            $instanciaDB = $this->db->prepare($queryUpdate);
            $instanciaDB->bindParam(":id", $this->id);
            $instanciaDB->bindParam(":nombre", $this->nombre);
            $instanciaDB->bindParam(":descripcion", $this->descripcion);
            $instanciaDB->bindParam(":estado", $this->estado);

            $instanciaDB->execute();

            if ($instanciaDB ->rowCount() >0) {
                echo "Se actualizó correctamente la biblioteca seleccionada";
                header("Location:listadobibliotecas.php");
            } else {
                echo "Ocurrió un error inesperado al recuperar la Biblioteca seleccionada";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
        catch (PDOException $ex) {
            echo "Error de PDO: " . $ex->getMessage();
            return null;
        }
    }
    public function comprarBiblioteca($id) 
    {
    $queryActualizacion = "UPDATE bibliotecas SET estado='Comprado' WHERE id=:id ;";
    $actualizarEstado = $this->db->prepare($queryActualizacion);
    $actualizarEstado->bindParam(":id", $id);
    $actualizarEstado->execute();

    $queryInsertar = "INSERT INTO compra_libros (idbiblioteca, idlibro)
                      SELECT idbiblioteca, idlibro
                      FROM biblioteca_libros
                      WHERE idbiblioteca = :id;";
    $insertarLibros = $this->db->prepare($queryInsertar);
    $insertarLibros->bindParam(":id", $id);
    $insertarLibros->execute();

    $queryEliminar = "DELETE FROM biblioteca_libros WHERE idbiblioteca = :id;";
    $eliminarLibros = $this->db->prepare($queryEliminar);
    $eliminarLibros->bindParam(":id", $id);
    $eliminarLibros->execute();

    if ($actualizarEstado && $insertarLibros && $eliminarLibros) {
        echo "Biblioteca comprada";
    } else {
        echo "Error al comprar biblioteca";
    }
    }
    public function obtenerNumeroLibros($idBiblioteca) {
        $querySelect = "SELECT numerolibros FROM bibliotecas WHERE id = :idBiblioteca";
        $stmt = $this->db->prepare($querySelect);
        $stmt->bindParam(":idBiblioteca", $idBiblioteca);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['numerolibros'];
    }
    

    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return mixed
     */
    public function getNumerolibros()
    {
        return $this->numerolibros;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }   

    /**
     * @param mixed $id 
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $nombre 
     * @return self
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @param mixed $descripcion 
     * @return self
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @param mixed $numerolibros 
     * @return self
     */
    public function setNumerolibros($numerolibros): self
    {
        $this->numerolibros = $numerolibros;
        return $this;
    }

    /**
     * @param mixed $estado 
     * @return self
     */
    public function setEstado($estado): self
    {
        $this->estado = $estado;
        return $this;
    }
}