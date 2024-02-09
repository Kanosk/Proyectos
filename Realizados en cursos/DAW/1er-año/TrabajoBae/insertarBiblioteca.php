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
    <title>Insertar Biblioteca</title>

</head>

<body>

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Crear nueva Biblioteca: </h1>
            <br>

            <?php

            if (
                isset($_POST['nombre'])
                && isset($_POST['descripcion'])
                && isset($_POST['estado'])        
            ) {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];              
                
                $biblioteca = new biblioteca();
                $biblioteca->setNombre($nombre);
                $biblioteca->setDescripcion($descripcion);
                $biblioteca->setEstado($estado);
                echo $biblioteca->insertarBiblioteca();
            }

            ?>
            <form id="insertarLibreriaForm" action="insertarBiblioteca.php" method="post">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" required>
                </div>



                <!-- <?php
                include "componentes/seleccionestado.php";
                ?> -->
                <div>
                    <label>Estado</label>
                    <br>
                    <select id="estado" name="estado">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="Comprado">Comprado</option>
                    </select>
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Crear Biblioteca</button>
            </form>
            <br>
            <a href="listadobibliotecas.php"><button>Volver al listado</button></a>
        </div>
    </div>

</body>

</html>