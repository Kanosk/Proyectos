<!DOCTYPE html>
<html>

<?php
include "../../componentes/head.php";
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h2>Editar Cliente: </h2>
            <?php
            include "../../controlador/cliente/editar.php";
            ?>
            <form id="editarCliente" method="post">
                <div class="form-group">
                    <label>ID Usuario</label>
                    <input type="text" class="form-control" name="id_usuario" value="<?php echo $c->getId_usuario() ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre_cl" value="<?php echo $cs->getNombre_cl()?>">
                </div>

                <div class="form-group">
                    <label>Apellido 1</label>
                    <input type="text" class="form-control" name="apellido1_cl" value="<?php echo $cs->getApellido1_cl() ?>">
                </div>
                <div class="form-group">
                    <label>Apellido 2</label>
                    <input type="text" class="form-control" name="apellido2_cl" value="<?php echo $cs->getApellido2_cl() ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email_cl" value="<?php echo $cs->getEmail_cl() ?>">
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="number" class="form-control" name="telefono_cl" value="<?php echo $cs->getTelefono_cl() ?>">
                </div>
                <br>

                <button type="submit" target="listarcliente.php" class="btn btn-primary">Editar Personal</button>
            </form>
            <br>
            <a href="listarcliente.php"><button>Volver al listado</button></a>
        </div>
    </div>
    <?php
    include "../../componentes/footer.php";
    ?>
</body>

</html>