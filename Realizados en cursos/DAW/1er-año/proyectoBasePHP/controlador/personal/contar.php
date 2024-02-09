<?php
require_once "../../modelo/personal.php"; 
    $personal = new personal();
    $cuantosPer = $personal->contarPersonal();
    echo $cuantosPer;

?>


