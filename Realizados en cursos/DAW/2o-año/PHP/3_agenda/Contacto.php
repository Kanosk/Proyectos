<?php

class Contacto{
    private $nombre;
    private $telefono;
    private $mail;

    function __construct($nombre, $telefono,$mail) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->mail=$mail;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getMail(){
        return $this->mail;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    function setMail($mail){
        $this->mail= $mail;
    }
    
    public function __toString(){
        return $this->nombre.", ".$this->telefono.", ".$this->mail;
    }

}




