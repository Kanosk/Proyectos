<?php
require_once "../../modelo/cliente.php";
$personalModelo = new cliente();
$personal = $personalModelo->verHistorico();

foreach ($personal as $p) {
    echo "<tr>
        <th>".$p->getId()."</th>
        <th>".$p->getDNI_cl()."</th>
        <th>".$p->getEstado()."</th>
    </tr>   
    ";
}

?>