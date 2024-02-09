<!DOCTYPE html>
<html>

<?php
include "../../componentes/head.php";
include "../../modelo/cliente.php";
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
        <?php 
        include "../../componentes/header.php";
        ?>
            <h2>Clientes: </h2>
            <br>

            <table class='table'>
                <thead class='table-dark'>
                    <tr>
                        <th>ID Cliente</th>
                        <th>DNI Cliente</th>
                        <th>Nombre</th>
                        <th>Primer apellido</th>
                        <th>Segundo apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Registrado por *</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                include "../../controlador/cliente/listar.php";
                ?>
                </tbody>
                
            </table>
            <h6>*Si este campo aparece vacio es que se ha eliminado el personal que le registro</h6>
            <br>
            <div align="center"><br>
            
            
            </div>
            <br>
            <div align="center">
            <a href="insertarcliente.php"><button class="btn btn-primary">Insertar Cliente</button></a>
            <a href="listarhistorico.php"><button class="btn btn-primary">Historico clientes</button></a>
            </div>
        </div>
    </div>
    <?php
    include "../../componentes/footer.php";
    ?>
</body>

</html>