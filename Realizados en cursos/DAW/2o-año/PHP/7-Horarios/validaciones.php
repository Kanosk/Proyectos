<?php

function validarCamposFormulario($campos)
{
    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            throw new Exception("Error Campo: El campo $campo esta vacío.");
        }
    }
}

function validacionesFichero()
{
    if (!isset($_FILES["fhorario"]) || empty($_FILES["fhorario"]["name"])) {
        throw new Exception("Error Campo Fichero: El campo fhorario esta vacío");
    }

    $directorio = $_SERVER['DOCUMENT_ROOT'] . "/datos_temporales/";

    if (!file_exists($directorio)) {
        if (!mkdir($directorio, 0777)) {
            throw new Exception("Error Directorios: No se puede crear el directorio 'datos_temporales' o ya esta creado");
        }
    } else {
        echo "<br>El directorio 'datos_temporales', ya se encuentra creado";
    }

    $rutaFicheroGuardado = $directorio . "datos_temp.dat";

    if (!move_uploaded_file($_FILES["fhorario"]["tmp_name"], $rutaFicheroGuardado)) {
        throw new Exception("Error ficheros: No se puede mover el fhorario a la nueva ruta");
    }
    
    return $rutaFicheroGuardado;
}