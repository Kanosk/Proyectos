<?php
require_once "../../modelo/cliente.php"; 
    $cliente = new Cliente();
    $cuantoscli = $cliente->contarCliente();
    echo $cuantoscli;

?>