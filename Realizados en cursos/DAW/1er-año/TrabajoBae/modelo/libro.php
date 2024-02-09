<?php

require_once "bd.php";

class Libro
{
    private $db;
    private $isbn;
    private $titulo;
    private $escritores;
    private $nombre;
    private $genero;
    private $numpaginas;
    private $imagen;
    private $precio;

    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function obtenerListadoLibros()
    {
        try {

            $querySelect = "SELECT DISTINCT isbn,titulo,escritores,nombre as genero, numpaginas, imagen, precio
                        FROM libros INNER JOIN generos 
                        where libros.genero=generos.cod";
            $listaLibros = $this->db->prepare($querySelect);

            $listaLibros->execute();

            if ($listaLibros) {
                return $listaLibros->fetchAll(PDO::FETCH_CLASS, "Libro");
            } else {
                echo "Ocurrió un error inesperado al obtener el Listado de Libros";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function insertarLibro()
    {
        try {
            $queryInsertar = "INSERT INTO libros (titulo, escritores, genero, numpaginas, imagen, precio)
                                 VALUES (:titulo, :escritores, :genero, :numPaginas, :rutaImagen, :precio)";
            $instanciaDB = $this->db->prepare($queryInsertar);

            $instanciaDB->bindParam(":titulo", $this->titulo);
            $instanciaDB->bindParam(":escritores", $this->escritores);

            $instanciaDB->bindParam(":genero", $this->genero);
            $instanciaDB->bindParam(":numPaginas", $this->numpaginas);

            $instanciaDB->bindParam(":rutaImagen", $this->imagen);
            $instanciaDB->bindParam(":precio", $this->precio);

            $respuestaInsertar = $instanciaDB->execute();

            if ($respuestaInsertar) {
                echo "Libro creado correctamente";
                header("Location:index.php");
            } else {
                echo "Ocurrió un error inesperado al crear el Libro";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function eliminarLibro()
    {
        try {
            $queryBorrar = "DELETE FROM libros WHERE isbn= :isbn";
            $instanciaDB = $this->db->prepare($queryBorrar);

            $instanciaDB->bindParam(":isbn", $this->isbn);

            $respuestaBorrar = $instanciaDB->execute();

            if ($respuestaBorrar) {
                echo "Libro eliminado correctamente";
                //header("Location:index.php");
            } else {
                echo "Ocurrió un error inesperado al eliminar el Libro";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerLibro()
    {
        try {
            $querySelect = "SELECT DISTINCT * FROM Libros WHERE isbn= :isbn";
            
            $instanciaDB = $this->db->prepare($querySelect);

            $instanciaDB->bindParam(":isbn", $this->isbn);

            $instanciaDB->execute();

            if ($instanciaDB) {
                return $instanciaDB->fetchAll(PDO::FETCH_CLASS, "Libro")[0];
            } else {
                echo "Ocurrió un error inesperado al recuperar el Libro seleccionado";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function actualizarLibro()
    {
        try {
            $queryUpdate = "UPDATE Libros SET titulo = :titulo, 
                                    escritores = :escritores,
                                    genero = :genero,
                                    numpaginas = :numpaginas,
                                    precio = :precio,
                                    imagen = :rutaimagen WHERE isbn = :isbn";

            $instanciaDB = $this->db->prepare($queryUpdate);

            $instanciaDB->bindParam(":isbn", $this->isbn);
            $instanciaDB->bindParam(":titulo", $this->titulo);
            $instanciaDB->bindParam(":escritores", $this->escritores);
            $instanciaDB->bindParam(":genero", $this->genero);
            $instanciaDB->bindParam(":numpaginas", $this->numpaginas);
            $instanciaDB->bindParam(":rutaimagen", $this->imagen);
            $instanciaDB->bindParam(":precio", $this->precio);

            $instanciaDB->execute();

            if ($instanciaDB) {
                echo "Se actualizó correctamente el libro seleccionado";
                header("Location:index.php");
            } else {
                echo "Ocurrió un error inesperado al recuperar el Libro seleccionado";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return mixed
     */
    public function getEscritores()
    {
        return $this->escritores;
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
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @return mixed
     */
    public function getNumPaginas()
    {
        return $this->numpaginas;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }    

    /**
     * @param mixed $isbn 
     * @return self
     */
    public function setIsbn($isbn): self
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @param mixed $titulo 
     * @return self
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * @param mixed $escritores 
     * @return self
     */
    public function setEscritores($escritores): self
    {
        $this->escritores = $escritores;
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
     * @param mixed $genero 
     * @return self
     */
    public function setGenero($genero): self
    {
        $this->genero = $genero;
        return $this;
    }

    /**
     * @param mixed $numPaginas 
     * @return self
     */
    public function setNumPaginas($numPaginas): self
    {
        $this->numpaginas = $numPaginas;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen 
     * @return self
     */
    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;
        return $this;
    }

    /**
     * @param mixed $precio 
     * @return self
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;
        return $this;
    }    
}
