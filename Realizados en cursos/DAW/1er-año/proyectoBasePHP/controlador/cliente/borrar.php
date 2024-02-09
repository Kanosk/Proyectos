<?php
require_once "../../modelo/cliente.php";

if (isset($_GET['id_usuario']) && !empty($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    $p = new cliente();
    $p->setId_usuario($id_usuario);
    echo $p->delCliente($id_usuario);
    header("Location:../../vista/cliente/listarcliente.php");
} else {
    echo "Error: id de usuario no encontrado.";
}
?>