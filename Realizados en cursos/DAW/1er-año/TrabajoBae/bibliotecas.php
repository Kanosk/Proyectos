<!DOCTYPE html>
<html>
<?php
include "componentes/head.php";
require "modelo/biblioteca.php";
?>

<body>
    <h1>Bibliotecas disponibles:</h1>
    <br>

    <?php

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $isbnLibro = $_GET['id'];
        $libro = new Biblioteca();
        $libro->setId($id);
        echo $libro->eliminarBiblioteca();
    }

    ?>
    <br>
    <a href="listadobibliotecas.php"><button button class="btn btn-primary">Volver al Listado</button></a>
    <a href="index.php"><button button class="btn btn-primary">Volver al Inicio</button></a>

</body>

</html>