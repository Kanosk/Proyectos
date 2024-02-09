<?php
require_once 'franjahorario.php';
require_once 'campos.php';

class GestorHorario
{
    private $ruta;
    private $rutaHorarios;
    private $franjashorarias;

    public function __construct()
    {
        $this->franjashorarias = [];
        $this->rutaHorarios = "Location:horarios.php";
        $this->ruta = $_SERVER['DOCUMENT_ROOT'] . "/horarios/horarios.dat";
    }

    private function abrirFichero($ruta, $modo)
    {
        // Si no existe el directorio lo crea.
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/horarios/";

        if (!file_exists($directorio)) {
            mkdir($directorio, 0777);
        }
        if (!file_exists($this->ruta)) {
            $fichero = fopen($ruta, "w");
        }

        $fichero = fopen($ruta, $modo);

        return $fichero;
    }

    private function obtenerFicheroContenido($ruta)
    {
        $contenidoFicheroTexto = '';

        $fichero = $this->abrirFichero($ruta, 'r');
        if ($fichero === false) {
            throw new Exception("No se encuentra el fichero '" . $ruta . "'<br>");
        } else {
            $contenidoFicheroTexto = file_get_contents($ruta);
        }
        fclose($fichero);

        return $contenidoFicheroTexto;
    }

    private function buscarFranjasHoraDia($dia, $hora)
    {
        $this->cargarHorario($this->ruta);

        foreach ($this->franjashorarias as $franjaHora) {
            if ($franjaHora->getDia() === $dia && $franjaHora->getHora() === $hora) {
                return $franjaHora;
            }
        }
        return null;
    }

    private function cargarHorario($rutaFichero)
    {
        $datos = $this->obtenerFicheroContenido($rutaFichero);
        $franjashorarias = explode('@', $datos);
        foreach ($franjashorarias as $franjaDatos) {
            $franja = explode(';', $franjaDatos);
            if (!empty($franja[0])) {
                $datosHora["curso"] = $franja[0];
                $datosHora["dia"] = $franja[1];
                $datosHora["hora"] = $franja[2];
                $datosHora["materia"] = $franja[3];
                $datosHora["clase"] = $franja[4];
                $datosHora["color"] = $franja[5];

                $this->franjashorarias[] = new FranjaHorario($datosHora);
            }
        }
    }

    public function insertarHora(FranjaHorario $franja)
    {
        if ($this->buscarFranjasHoraDia($franja->getDia(), $franja->getHora())) {
            throw new Exception("Error: La franja horaria, ya existe, elige otra, o elimina la franja horaria");
        } else {
            // Obtenemos el contenido guardado
            $contenidoFichero = $this->obtenerFicheroContenido($this->ruta);
            
            // Borramos el fichero y lo volvemos a generar.
            $fichero = $this->abrirFichero($this->ruta, 'w');

            $franjaHorarioNueva =
                $franja->getCurso() . ';' .
                $franja->getDia() . ';' .
                $franja->getHora() . ';' .
                $franja->getMateria() . ';' .
                $franja->getClase() . ';' .
                $franja->getColor() . '@';

            $datosFichero = $contenidoFichero  . $franjaHorarioNueva;

            fwrite($fichero, $datosFichero);

            fclose($fichero);

            header($this->rutaHorarios);
        }
    }

    public function eliminarHora(FranjaHorario $franja)
    {
        $franjaEliminar = $this->buscarFranjasHoraDia($franja->getDia(), $franja->getHora());

        if ($franjaEliminar == null) {
            throw new Exception("Error Eliminar Hora: La hora y el día seleccionado no existe.");
        } else {
            // Borramos el fichero y lo volvemos a generar.
            $fichero = $this->abrirFichero($this->ruta, 'w');

            // reconstruir fichero eliminando el registro
            foreach ($this->franjashorarias as $franja) {
                if ($franja->getDia() != $franjaEliminar->getDia() 
                        || $franja->getHora() != $franjaEliminar->getHora()) {
                    $franjaHorarioNueva =
                        $franja->getCurso() . ';' .
                        $franja->getDia() . ';' .
                        $franja->getHora() . ';' .
                        $franja->getMateria() . ';' .
                        $franja->getClase() . ';' .
                        $franja->getColor() . '@';

                    fwrite($fichero, $franjaHorarioNueva);
                }
            }
            fclose($fichero);
            header($this->rutaHorarios);
        }
    }

    public function mostrarHorario()
    {
        $this->cargarHorario($this->ruta);

        $respuesta = "<table class='table'>
            <thead class='table-dark'>
                <th>HORA:</th>
                <th>LUNES</th>
                <th>MARTES</th>
                <th>MIÉRCOLES</th>
                <th>JUEVES</th>
                <th>VIERNES</th>
            </thead>";

        foreach (Hora::cases() as $hora) {
            $respuesta .= "<tbody>
                    <td>" . $hora->value . "</td>";
            foreach (Semana::cases() as $semana) {
                $franjaHorariaDia = $this->buscarFranjasHoraDia($semana->value, $hora->codigoHora());

                if ($franjaHorariaDia == null) {
                    $respuesta .= "<td></td>";
                } else {
                    $respuesta .= "<td class='text-center' style='background-color:" .  $franjaHorariaDia->getColor() . "'>" .
                        $franjaHorariaDia->getCurso() . "<br>" .
                        $franjaHorariaDia->getMateria() . "<br>" .
                        $franjaHorariaDia->getClase() . "<br>"
                        . "</td>";
                }
            }
            $respuesta .= "</tbody>";
        }
        $respuesta .= "</table>";
        
        return $respuesta;
    }

    public function subirFichero($rutaFicheroSubido)
    {
        $fichero = $this->abrirFichero($this->ruta, 'w');
        fwrite($fichero, file_get_contents($rutaFicheroSubido));
        fclose($fichero);

        header($this->rutaHorarios);
    }

    /**
     * Get the value of franjashorarias
     */
    public function getFranjashorarias()
    {
        return $this->franjashorarias;
    }

    /**
     * Set the value of franjashorarias
     *
     * @return  self
     */
    public function setFranjashorarias($franjashorarias)
    {
        $this->franjashorarias = $franjashorarias;

        return $this;
    }

    /**
     * Get the value of horas
     */
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * Set the value of horas
     *
     * @return  self
     */
    public function setHoras($horas)
    {
        $this->horas = $horas;

        return $this;
    }

    /**
     * Get the value of ruta
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set the value of ruta
     *
     * @return  self
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }
}