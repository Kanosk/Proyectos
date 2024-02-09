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
            <h1>Editar Libro: </h1>
            <br>

            <?php

            if (isset($_GET['isbn']) && !empty($_GET['isbn'])) {
                $isbnLibro = $_GET['isbn'];
                $libros = new Libro();
                $libros->setIsbn($isbnLibro);
                $libro = $libros->obtenerLibro();             
            }

            if (
                isset($_POST['isbn'])
                && isset($_POST['titulo'])
                && isset($_POST['escritores'])
                && isset($_POST['genero'])
                && isset($_POST['numpaginas'])
                && isset($_POST['imagen'])
                && isset($_POST['precio'])
            ) {
                $isbn = $_POST['isbn'];
                $titulo = $_POST['titulo'];
                $escritores = $_POST['escritores'];
                $genero = $_POST['genero'];
                $numPaginas = $_POST['numpaginas'];
                $rutaImagen = $_POST['imagen'];
                $precio = $_POST['precio'];

                $libro = new Libro();
                
                $libro->setIsbn($isbn);
                $libro->setTitulo($titulo);
                $libro->setEscritores($escritores);
                $libro->setGenero($genero);
                $libro->setNumPaginas($numPaginas);
                $libro->setImagen($rutaImagen);
                $libro->setPrecio($precio);

                echo $libro->actualizarLibro();
            }

            ?>
            <div class="container-fluid">
                <form id="editarLibreriaForm" action="editar.php" method="post">

                    <div class="form-group">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="isbn" value="<?php echo $libro->getIsbn(); ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="titulo" value="<?php echo $libro->getTitulo(); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Escritores</label>
                        <input type="text" class="form-control" name="escritores"
                            value="<?php echo $libro->getEscritores(); ?>" required>
                    </div>

                    <?php
                    include "componentes/seleccionGenero.php";
                    ?>

                    <div class="form-group">
                        <label>Número de Páginas</label>
                        <input type="number" class="form-control" name="numpaginas" required
                            value="<?php echo $libro->getNumPaginas(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Portada</label>
                        <input type="text" class="form-control" name="imagen" required
                            value="<?php echo $libro->getImagen(); ?>" required>
                        <br>
                        <img src="<?php echo $libro->getImagen(); ?>" width='70' height='100'>
                    </div>

                    <div class="form-group">
                        <label>Precio</label>
                        <input type="text" class="form-control" name="precio" required
                            value="<?php echo $libro->getPrecio(); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Editar Libro</button>
                </form>
                <br>
                <a href="index.php"><button>Volver al listado</button></a>
            </div>
        </div>
</body>

</html>