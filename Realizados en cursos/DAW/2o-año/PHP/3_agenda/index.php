<?php
require 'Agenda.php';
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Agenda de contactos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <?php
                    $accionBotonInsertarContacto = (isset($_POST['action']) ? $_POST['action'] : null);
                    if (isset($_POST['agenda'])) {
                        $agenda = new Agenda($_POST['agenda']);
                    } else {
                        // Creamos agenda como un array vacío
                        $agenda = new Agenda(null);
                    }
                    if ($accionBotonInsertarContacto == "nuevo") {
                        $agenda->gestionarContacto($_POST['nombre'], $_POST['telefono'],$_POST['mail']);
                    }
                ?>
                <!-- Mostramos los contactos de la agenda -->
                <h2>Agenda</h2>
                <?php
                        $nombreArchivo = 'datos.txt';
                        $rutaEspecifica = "/guardados/$nombreArchivo";
                
                        // Cargar agenda desde el fichero
                        $agenda = new Agenda(null);
                        $agenda->cargarFichero($nombreArchivo);
                
                        // Procesar el formulario
                        if ($accionBotonInsertarContacto == "nuevo") {
                            $agenda->gestionarContacto($_POST['nombre'], $_POST['telefono'], $_POST['mail']);
                
                            $agenda->guardarFichero($nombreArchivo);
                        }
                
                        // Mostrar los contactos de la agenda
                        $agenda->obtenerListadoAgenda();
                    ?>
                <br />
                <!-- Creamos el formulario de introducción de un nuevo contacto -->
                <h2>Nuevo contacto</h2>
                <!-- Podemos poner también # -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
                    <!-- Metemos los contactos ya existentes ocultos en el formulario -->
                    <?php
                        $agenda->guardarListadoAgenda();
                    ?>
                    <input type="hidden" name="action" value="nuevo"/>
                    <div class="form-group">
                        <label>Nombre:</label><input type="text" class="form-control" name="nombre" />
                    </div>
                    <div class="form-group">
                        <label>Teléfono:</label><input type="tel" class="form-control" name="telefono" />
                    </div>
                    <div class="form-group">
                        <label>Mail:</label><input type="email" class="form-control" name="mail" />
                    </div>
                    <div class="form-group" align="center">
                        <input type="submit" class="btn btn-success" value="Añadir Contacto"/>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>