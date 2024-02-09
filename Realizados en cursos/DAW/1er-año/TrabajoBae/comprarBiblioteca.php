<?php
require_once "modelo/biblioteca.php";
require_once "modelo/bd.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $biblioteca = new Biblioteca();
    $biblioteca->setId($id);
    $biblioteca->comprarBiblioteca($id);
    header("Location: listadobibliotecas.php");
} else {
    echo "Error: ID de biblioteca no especificado.";
}
?>
