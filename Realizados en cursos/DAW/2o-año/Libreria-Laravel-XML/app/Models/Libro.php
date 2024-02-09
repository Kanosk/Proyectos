<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model implements \JsonSerializable
{
    use HasFactory;
    private $isbn;
    private $titulo;
    private $escritores;
    private $genero;
    private $numpaginas;
    private $imagen;

    function __construct(){
    }
    public function jsonSerialize():mixed{
        return[
            'isbn'=>$this->getIsbn(),
            'titulo'=>$this->getTitulo(),
            'escritores'=>$this->getEscritores(),
            'genero'=>$this->getGenero(),
            'numpaginas'=>$this->getNumpaginas(),
            'imagen'=>$this->getImagen(),
        ];
    }
    public function cargarLibros() {
        $datosLibros = simplexml_load_file(storage_path("app/public/libros.xml"));
        $libros = $datosLibros->xpath("//libro");
        $listaLibros=[];

        foreach ($libros as $libro) {
            $nuevoLibro = new Libro();

            $nuevoLibro->setIsbn((string)$libro->isbn);
            $nuevoLibro->setTitulo((string)$libro->titulo);
            $nuevoLibro->setEscritores((string)$libro->escritores);
            $nuevoLibro->setGenero((string)$libro->genero);
            $nuevoLibro->setNumpaginas((string)$libro->numpaginas);
            $nuevoLibro->setImagen((string)$libro->imagen);

            $listaLibros[] = $nuevoLibro;
        }

        return $listaLibros;
    }
    public function cargarLibrosPorGenero($genero) {
        $datosLibros = simplexml_load_file(storage_path("app/public/libros.xml"));
        $libros = $datosLibros->xpath("//libro[genero='$genero']");
        $listaLibros = [];

        foreach ($libros as $libro) {
            $nuevoLibro = new Libro();

            $nuevoLibro->setIsbn((string)$libro->isbn);
            $nuevoLibro->setTitulo((string)$libro->titulo);
            $nuevoLibro->setEscritores((string)$libro->escritores);
            $nuevoLibro->setGenero((string)$libro->genero);
            $nuevoLibro->setNumpaginas((string)$libro->numpaginas);
            $nuevoLibro->setImagen((string)$libro->imagen);

            $listaLibros[] = $nuevoLibro;
        }

        return $listaLibros;
    }
    public function cargarLibroPorISBN($isbn)
    {
        $datosLibros = simplexml_load_file(storage_path("app/public/libros.xml"));
        $libro = $datosLibros->xpath("//libro[isbn='$isbn']");

        if (empty($libro)) {
            return null;
        }

        $nuevoLibro = new Libro();

        $nuevoLibro->setIsbn((string) $libro[0]->isbn);
        $nuevoLibro->setTitulo((string) $libro[0]->titulo);
        $nuevoLibro->setEscritores((string) $libro[0]->escritores);
        $nuevoLibro->setGenero((string) $libro[0]->genero);
        $nuevoLibro->setNumpaginas((string) $libro[0]->numpaginas);
        $nuevoLibro->setImagen((string) $libro[0]->imagen);

        return $nuevoLibro;
    }


    /**
     * Get the value of isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set the value of isbn
     *
     * @return  self
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of escritores
     */
    public function getEscritores()
    {
        return $this->escritores;
    }

    /**
     * Set the value of escritores
     *
     * @return  self
     */
    public function setEscritores($escritores)
    {
        $this->escritores = $escritores;

        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     *
     * @return  self
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of numpaginas
     */
    public function getNumpaginas()
    {
        return $this->numpaginas;
    }

    /**
     * Set the value of numpaginas
     *
     * @return  self
     */
    public function setNumpaginas($numpaginas)
    {
        $this->numpaginas = $numpaginas;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
}
