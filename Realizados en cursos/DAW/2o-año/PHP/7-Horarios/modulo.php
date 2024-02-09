<?php
class Modulo{
    private $curso;
    private $materia;
    private $clase;

    public function __construct($datos){
        if (is_null($datos) || count($datos) == 0) {
            throw new Exception("Error: Los datos no pueden estar vacíos o nulos");
        }
        $this->curso = $datos["curso"];
        $this->materia = $datos["materia"];
        $this->clase = $datos["clase"];
    }

    /**
     * Get the value of materia
     */ 
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Set the value of materia
     *
     * @return  self
     */ 
    public function setMateria($materia)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get the value of curso
     */ 
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set the value of curso
     *
     * @return  self
     */ 
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get the value of clase
     */ 
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set the value of clase
     *
     * @return  self
     */ 
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }
}