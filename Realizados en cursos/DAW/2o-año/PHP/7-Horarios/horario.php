<?php

require_once 'gestorhorario.php';
require_once 'validaciones.php';

try {
    if (isset($_POST['insertar'])) {
        $campos = ['dia', 'hora', 'curso', 'materia', 'clase', 'color'];
        validarCamposFormulario($campos);

        $datosHora["dia"] = $_POST['dia'];
        $datosHora["hora"] = $_POST['hora'];
        $datosHora["curso"] = $_POST['curso'];
        $datosHora["materia"] = $_POST['materia'];
        $datosHora["clase"] = $_POST['clase'];
        $datosHora["color"] = $_POST['color'];

        $gestorhorario = new GestorHorario();
        $franjaHora = new FranjaHorario($datosHora);
        $gestorhorario->insertarHora($franjaHora);
    }

    if (isset($_POST['eliminar'])) {
        $campos = ['dia', 'hora'];
        validarCamposFormulario($campos);

        $datosHora["dia"] = $_POST['dia'];
        $datosHora["hora"] = $_POST['hora'];
        $datosHora["curso"] = '';
        $datosHora["materia"] = '';
        $datosHora["clase"] = '';
        $datosHora["color"] = '';

        $gestorhorario = new GestorHorario();
        $franjaHora = new FranjaHorario($datosHora);
        $gestorhorario->eliminarHora($franjaHora);
    }

    if (isset($_POST['cargar'])) {
        $rutaFicheroGuardado = validacionesFichero();
        if ($rutaFicheroGuardado != null) {
            $gestorHorario = new GestorHorario();
            $gestorHorario->subirFichero($rutaFicheroGuardado);
        }else {
            throw new Exception("Error Fichero: Ocurrio un error al cargar el fichero");
        }
    }
} catch (Exception $e) {
    echo '<p style="color:red">Excepción: ', $e->getMessage(), "</p><br>";
}