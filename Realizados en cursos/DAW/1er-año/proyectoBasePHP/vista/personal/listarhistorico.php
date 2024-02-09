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
            <h2>Personal eliminado: </h2>
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
                include "../../controlador/personal/listarhistorico.php";
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