<!DOCTYPE html>
<html>

<?php
include "../../componentes/head.php";
include "../../modelo/personal.php"
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
        <?php 
        include "../../componentes/header.php";
        ?>
            <h2>Personal: </h2>
            <br>
           
            <table class='table'>
                <thead class='table-dark'>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Primer apellido</th>
                        <th>Segundo apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Cargo</th>
                        <th>estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                include "../../controlador/personal/listar.php";
                ?>
                </tbody>
            </table>
            <div align="center"><br>
            </div>
            <br>
            <div align="center">
            <a href="insertarPersonal.php"><button class="btn btn-primary">Añadir Personal</button></a>
            <a href="listarhistorico.php"><button class="btn btn-primary">Historico personal</button></a>
            </div>
        </div>
    </div>
    <?php
    include "../../componentes/footer.php";
    ?>
</body>

</html>