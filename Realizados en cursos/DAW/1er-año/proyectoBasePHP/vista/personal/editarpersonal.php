<!DOCTYPE html>
<html>

<?php
include "../../componentes/head.php";
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h2>Editar Personal: </h2>
            <br>
             <?php
                include "../../controlador/personal/editar.php";
            ?>

            <form id="editarPersonal" method="post">
                <div class="form-group">
                    <label>DNI</label>
                    <input type="text" class="form-control" name="dni_personal" value="<?php echo $p->getdni_personal()?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre_per" value="<?php echo $pers->getNombre_per()?>" required >
                </div>

                <div class="form-group">
                    <label>Apellido 1</label>
                    <input type="text" class="form-control" name="apellido1_per" value="<?php echo $pers->getApellido1_per()?>" required >
                </div>
                <div class="form-group">
                    <label>Apellido 2</label>
                    <input type="text" class="form-control" name="apellido2_per" value="<?php echo $pers->getApellido2_per()?>" required >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email_per" value="<?php echo $pers->getEmail_per()?>" required >
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="number" class="form-control" name="telefono_per" value="<?php echo $pers->getTelefono_per()?>" required >
                </div>
                <div>
                    <label>Cargo</label>
                    <br>
                    <select id="Cargo" name="cargo" value="<?php echo $pers->getCargo()?>" required >
                        <option value="Administrativo">Administrativo</option>
                        <option value="Tecnico">Tecnico</option>
                        <option value="Auxiliar">Auxiliar</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Limpiador">Limpiador</option>
                    </select>
                </div>
                <div>
                    <label>Estado</label>
                    <br>
                    <select id="estado" name="estado" value="<?php echo $pers->getEstado()?>" required >
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <br>

                <button type="submit" target="listarpersonal.php" class="btn btn-primary">Editar Personal</button>
            </form>
            <br>
            <a href="listarpersonal.php"><button>Volver al listado</button></a>
        </div>
    </div>
    <?php
    include "../../componentes/footer.php";
    ?>
</body>

</html>