<!DOCTYPE html>
<html lang="en">

<?php
include "componentes/head.php";
require "modelo/biblioteca.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Biblioteca</title>

</head>

<body>

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Editar la bibilioteca: </h1>
            <br>

            <?php
            if (isset($_GET['id']) && !empty($_GET['id']))
            {
                $idBiblioteca=$_GET['id'];
                $biblioteca =new Biblioteca();
                $biblioteca->setId($idBiblioteca);
                $biblioteca= $biblioteca->obtenerBiblioteca();
            }

            if (
                isset($_POST['id'])
                && isset($_POST['nombre'])
                && isset($_POST['descripcion'])
                && isset($_POST['estado'])        
            ) {
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];              
                
                $biblioteca = new Biblioteca();
                $biblioteca->setId($id);
                $biblioteca->setNombre($nombre);
                $biblioteca->setDescripcion($descripcion);
                $biblioteca->setEstado($estado);
                echo $biblioteca->actualizarBiblioteca();
            }

            ?>
            <div class="container-fluid">
                <form id="editarLibreriaForm" action="editarBiblioteca.php" method="post">

                    <div class="form-group">
                        <label>ID</label>
                        <input type="number" class="form-control" name="id" value="<?php echo $biblioteca->getId(); ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre"
                            value="<?php echo $biblioteca->getNombre(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" name="descripcion"
                            value="<?php echo $biblioteca->getDescripcion(); ?>" required>
                    </div>

                    <div>
                        <label>Estado</label>
                        <br>
                        <select id="estado" name="estado">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Editar biblioteca</button>
                </form>
                <br>
                <a href="listadobibliotecas.php"><button>Volver a bibliotecas</button></a>
                <br><br>
                <a href="index.php"><button>Volver al inicio</button></a>
            </div>
        </div>
</body>

</html>