<?php
require_once "../../modelo/personal.php";

if (isset($_GET['dni_personal']) && !empty($_GET['dni_personal'])) {
    $dni_personal = $_GET['dni_personal'];
    $p = new personal();
    $p->setdni_personal($dni_personal);
    echo $p->delPersona($dni_personal);
    header("Location:../../vista/personal/listarpersonal.php");
} else {
    echo "Error: DNI de personal no encontrado.";
}
?>