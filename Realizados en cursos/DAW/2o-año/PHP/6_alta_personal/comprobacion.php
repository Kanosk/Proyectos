<html>
    <head>
        <title>Comprobación de datos</title> 
    </head>
    <body>
        <h1>Comprobando el alta de Empleado </h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['codigo'])) {
            echo "el campo 'Codigo' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        } if( empty($_POST['nombre'])){
            echo "el campo 'Nombre' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        }if(empty($_POST['apellidos'])){
            echo "el campo 'Apellidos' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        }if(empty($_POST['direccion'])){
            echo "el campo 'Dirección' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        }if(empty($_POST['email'])){
            echo "el campo 'Email' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        }if(empty($_POST['contras'])){
            echo "el campo 'Contraseña' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        }if(empty($_POST['sexo'])){
            echo "el campo 'Sexo' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        }if(empty($_POST['estudios'])){
            echo "el campo 'Estudios' no puede estar vacío, para el alta del empleado <br>";
            echo"Ocurrio un error no se pudo dar de alta al Empleado <br>";
        }else {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $sexo = $_POST['sexo'];
            $estudios = $_POST['estudios'];
            $tipocontrato = $_POST['tipocontrato'];

            if (isset($_POST['administracion'])) {
                echo "<p style='color:green'> El empleado tiene acceso al departamento Administración</p>";
            } else {
                echo " <p style='color:red'>El empleado no tiene acceso al departamento Administración</p>";
            }
            if (isset($_POST['programacion'])) {
                echo "<p style='color:green'> El empleado tiene acceso al departamento Programación</p>";
            } else {
                echo " <p style='color:red'> El empleado no tiene acceso al departamento Programación</p>";
            }
            if (isset($_POST['sistemas'])) {
                echo "<p style='color:green'> El empleado tiene acceso al departamento Sistemas</p>";
            } else {
                echo " <p style='color:red'> El empleado no tiene acceso al departamento Sistemas</p>";
            }
            if (isset($_POST['rrhh'])) {
                echo "<p style='color:green'> El empleado tiene acceso al departamento Recursos Humanos</p>";
            } else {
                echo " <p style='color:red'> El empleado no tiene acceso al departamento Recursos Humanos</p>";
            }
            if (isset($_POST['marketing'])) {
                echo "<p style='color:green'> El empleado tiene acceso al departamento Marketing</p>";
            } else {
                echo " <p style='color:red'> El empleado no tiene acceso al departamento Marketing</p>";
            }
            echo "<br>Empleado dado de alta correctamente.<br>";
        }
    }
        ?>

        <a href="alta.php">Volver</a>

    </body>
</html>