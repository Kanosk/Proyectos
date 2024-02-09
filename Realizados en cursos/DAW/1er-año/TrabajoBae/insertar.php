<!DOCTYPE html>
<html>

<?php
include "componentes/head.php";
require "modelo/libro.php";
require "modelo/genero.php";
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Crear nuevo Libro: </h1>
            <br>

            <?php

            if (
                isset($_POST['titulo'])
                && isset($_POST['escritores'])
                && isset($_POST['genero'])
                && isset($_POST['numpaginas'])
                && isset($_POST['imagen'])
                && isset($_POST['precio'])          
            ) {
                $titulo = $_POST['titulo'];
                $escritores = $_POST['escritores'];
                $genero = $_POST['genero'];
                $numPaginas = $_POST['numpaginas'];
                $rutaImagen = $_POST['imagen'];
                $precio = $_POST['precio'];                
                
                $libro = new Libro();
                $libro->setTitulo($titulo);
                $libro->setEscritores($escritores);
                $libro->setGenero($genero);
                $libro->setNumPaginas($numPaginas);
                $libro->setImagen($rutaImagen);
                $libro->setPrecio($precio);
                echo $libro->insertarLibro();
            }

            ?>
            <form id="insertarLibreriaForm" action="insertar.php" method="post">
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>

                <div class="form-group">
                    <label>Escritores</label>
                    <input type="text" class="form-control" name="escritores" required>
                </div>

                <?php
                include "componentes/selecciongenero.php";
                ?>

                <div class="form-group">
                    <label>Número de Páginas</label>
                    <input type="number" class="form-control" name="numpaginas" required>
                </div>

                <div class="form-group">
                    <label>Portada</label>
                    <input type="text" class="form-control" name="imagen" required>
                </div>
                
                <div class="form-group">
                    <label>Precio</label>
                    <input type="text" class="form-control" name="precio" required>
                </div>

                <button type="submit" class="btn btn-primary">Crear Libro</button>
            </form>
            <br>
            <a href="index.php"><button>Volver al listado</button></a>
        </div>
    </div>
</body>

</html>