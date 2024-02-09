<?php
require_once "../../modelo/personal.php";
$personalModelo = new personal();
$personal = $personalModelo->obtenerPersonal();

foreach ($personal as $p) {
    echo "<tr>
        <th>".$p->getdni_personal()."</th>
        <th>".$p->getNombre_per()."</th>
        <th>".$p->getApellido1_per()."</th>
        <th>".$p->getApellido2_per()."</th>
        <th>".$p->getEmail_per()."</th>
        <th>".$p->getTelefono_per()."</th>
        <th>".$p->getCargo()."</th>
        <th>".$p->getEstado()."</th>
        <th>
            <a href=editarpersonal.php?dni_personal=".$p->getdni_personal()."><button class='btn btn-warning'>Editar</button></a>
            <a href=../../controlador/personal/borrar.php?dni_personal=".$p->getdni_personal()."><button class='btn btn-danger'>Borrar</button></a>
        </th>
    </tr>   
    ";
}

?>