<?php
require 'contacto.php';

class Agenda
{
    private $ListaContactos;
    private $NumeroContactos;

    function __construct($datosAgenda)
    {
        if ($datosAgenda == null) {
            $this->ListaContactos = array();
            $this->NumeroContactos = 0;
        } else {
            $this->reconstruirAgenda($datosAgenda);
        }
    }

    function reconstruirAgenda($datosAgenda)
    {
        foreach ($datosAgenda as $nombre => $infoContacto) {
            $telefono = $infoContacto['telefono'];
            $mail = $infoContacto['mail']; 

            $contacto = new Contacto($nombre, $telefono, $mail);
            $this->ListaContactos[] = $contacto;
            $this->NumeroContactos++;
        }
    }

    function getListaContactos()
    {
        return $this->ListaContactos;
    }

    function setListaContactos($contactos)
    {
        $this->ListaContactos = $contactos;
    }

    function insertarContacto($nombre, $telefono, $mail)
    {
        if (!empty($nombre) && !empty($telefono)) {
            $posicionContacto = $this->buscarNombreContacto($nombre);
            if ($posicionContacto >= 0) {
                $this->ListaContactos[$posicionContacto]->setNombre($nombre);
                $this->ListaContactos[$posicionContacto]->setTelefono($telefono);
                $this->ListaContactos[$posicionContacto]->setMail($mail); 
            } else {
                $this->ListaContactos[] = new Contacto($nombre, $telefono, $mail);
                $this->NumeroContactos++;
            }
        }
    }

    function buscarNombreContacto($nombre)
    {
        $i = 0;
        while ($i < $this->getNumeroContactos() && $this->ListaContactos[$i]->getNombre() != $nombre) {
            $i++;
        }
        if ($i == $this->getNumeroContactos()) {
            return -1;
        }

        return $i;
    }

    function getNumeroContactos()
    {
        return $this->NumeroContactos;
    }

    function obtenerListadoAgenda()
    {
        if ($this->getNumeroContactos() == 0) {
            echo "<p>No hay contactos en la agenda.</p>";
        } else {
            echo "<ul>";
            foreach ($this->getListaContactos() as $contacto) {
                echo "<li>" . $contacto->__toString() ."</li>";
            }
            echo "</ul>";
        }
    }

    function eliminarContacto($nombre)
    {
        $posicionContacto = $this->buscarNombreContacto($nombre);

        if ($posicionContacto >= 0) {
            unset($this->ListaContactos[$posicionContacto]);
        }
    }

    function guardarListadoAgenda()
    {
        foreach ($this->getListaContactos() as $contacto) {
            echo '<input type="hidden" name="agenda[' . $contacto->getNombre() . '][telefono]" ';
            echo 'value="' . $contacto->getTelefono() . '"/>';
            echo '<input type="hidden" name="agenda[' . $contacto->getNombre() . '][mail]" ';
            echo 'value="' . $contacto->getMail() . '"/>';
        }
    }

    function gestionarContacto($nuevoNombre, $nuevoTelefono, $nuevoMail)
    {
        if (empty($nuevoNombre)) {
            echo "<p style='color:red'>Debe introducir un nombre!!</p><br />";
        }
        if (empty($nuevoTelefono) && empty($nuevoMail)) {
            $this->eliminarContacto($nuevoNombre);
        } else {
            $this->insertarContacto($nuevoNombre, $nuevoTelefono, $nuevoMail);
        }
    }

    function guardarFichero($nombreArchivo)
    {
        $rutaCompleta = $_SERVER['DOCUMENT_ROOT'] . "/guardados/$nombreArchivo";
        $contenido = '';

        foreach ($this->getListaContactos() as $contacto) {
            $nombre = $contacto->getNombre();
            $telefono = $contacto->getTelefono();
            $mail = $contacto->getMail();
            $contenido .= "$nombre,$telefono,$mail\n";
        }

        file_put_contents($rutaCompleta, $contenido);
    }

    function cargarFichero($nombreArchivo)
    {
        $rutaDirectorio = $_SERVER['DOCUMENT_ROOT'] . "/guardados";
        $rutaCompleta = $rutaDirectorio . "/$nombreArchivo";
        $datosAgenda = array();
    
        if (!file_exists($rutaDirectorio)) {
            mkdir($rutaDirectorio, 0777, true);
        }
    
        if (!file_exists($rutaCompleta)) {
            file_put_contents($rutaCompleta, "");
        }
    
        $lineas = file($rutaCompleta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        foreach ($lineas as $linea) {
            list($nombre, $telefono, $mail) = explode(',', $linea);
            $contacto = new Contacto($nombre, $telefono, $mail);
            $this->ListaContactos[] = $contacto;
            $this->NumeroContactos++;
        }
    }

}
