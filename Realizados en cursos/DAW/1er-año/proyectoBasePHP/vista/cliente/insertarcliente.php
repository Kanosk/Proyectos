<!DOCTYPE html>
<html>

<?php
include "../../componentes/head.php";
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h2>Insertar Cliente: </h2>
            <br>
            <?php
                include "../../controlador/cliente/insertar.php";
            ?>

            <form id="insertarPersonal" method="post">
                <div class="form-group">
                    <label>DNI</label>
                    <input type="text" class="form-control" name="DNI_cl">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre_cl">
                </div>
                <div class="form-group">
                    <label>Apellido 1</label>
                    <input type="text" class="form-control" name="apellido1_cl">
                </div>
                <div class="form-group">
                    <label>Apellido 2</label>
                    <input type="text" class="form-control" name="apellido2_cl">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email_cl">
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="number" class="form-control" name="telefono_cl">
                </div>
                
                <?php
                include "../../componentes/seleccionpersonal.php";
            ?>
                <br>
                <button type="submit" class="btn btn-success">Añadir Cliente</button>
            </form>
            <br>
            <a href="listarcliente.php"><button class="btn btn-primary">Volver al listado</button></a>


        </div>
    </div>
    <?php
    include "../../componentes/footer.php";
    ?>
</body>

</html>