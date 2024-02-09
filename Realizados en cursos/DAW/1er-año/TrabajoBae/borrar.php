<!DOCTYPE html>
<html>
<?php
    include "componentes/head.php";
    require "modelo/libro.php";
?>

<body>
    <h1>Borrar Libro: </h1>
    <br>

    <?php

    if (isset($_GET['isbn']) && !empty($_GET['isbn'])) {
        $isbnLibro = $_GET['isbn'];
        $libro = new Libro();
        $libro->setIsbn($isbnLibro);
        echo $libro->eliminarLibro();
    }

    ?>
    <br>
    <a href="index.php"><button button class="btn btn-primary">Volver al Listado</button></a>

</body>

</html>