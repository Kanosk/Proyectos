<?php
require_once 'modulo.php';

class FranjaHorario extends Modulo
{
    private $dia;
    private $hora;
    private $color;

    public function __construct($datos)
    {
        if (is_null($datos) || count($datos) == 0) {
            throw new Exception("Error: Los datos no pueden estar vacíos o nulos");
        }
        parent::__construct($datos);
        $this->dia = $datos["dia"];
        $this->hora = $datos["hora"];
        $this->color = $datos["color"];
        $this->curso = $datos["curso"];
        $this->materia = $datos["materia"];
        $this->clase = $datos["clase"];
    }

    /**
     * Get the value of dia
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set the value of dia
     *
     * @return  self
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }
}
