<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model implements \JsonSerializable{
    private $cod;
    private $nombre;
    public function __construct(){}
    public static function cargarGeneros(){
        $generos = [
            ["cod"=>'1',"nombre"=>"Ciencia Ficción"],
            ["cod"=>'2',"nombre"=>"Comedia"],
            ["cod"=>'3',"nombre"=>"Distopía"],
            ["cod"=>'4',"nombre"=>"Drama"],
            ["cod"=>'5',"nombre"=>"Histórica"],
            ["cod"=>'6',"nombre"=>"Terror"],
        ];
        return $generos;
    }
    public function jsonSerialize():mixed{
        return[
            'cod'=>$this->getCod(),
            'nombre'=>$this->getNombre(),
        ];
    }

    /**
     * Get the value of cod
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * Set the value of cod
     *
     * @return  self
     */
    public function setCod($cod)
    {
        $this->cod = $cod;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
