<?php
require_once "../../modelo/personal.php";
$personalModelo = new personal();
$personal = $personalModelo->verHistorico();

foreach ($personal as $p) {
    echo "<tr>
        <th>".$p->getId()."</th>
        <th>".$p->getDNI_personal()."</th>
        <th>".$p->getEstado()."</th>
    </tr>   
    ";
}

?>