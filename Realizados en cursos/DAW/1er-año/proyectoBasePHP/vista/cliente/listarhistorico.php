<!DOCTYPE html>
<html>

<?php
include "../../componentes/head.php";
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
        <?php 
        include "../../componentes/header.php";
        ?>
            <h2>Clientes eliminados: </h2>
            <br>
           
            <table class='table'>
                <thead class='table-dark'>
                    <tr>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                include "../../controlador/cliente/listarhistorico.php";
                ?>
                </tbody>
            </table>

            <br>
            
        </div>
    </div>
    <?php
    include "../../componentes/footer.php";
    ?>
</body>

</html>