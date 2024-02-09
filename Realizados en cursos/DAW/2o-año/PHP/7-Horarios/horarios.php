<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
                rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
                crossorigin="anonymous">
    <title>Horario Docente</title>
</head>

<?php
require_once 'horario.php';
require_once 'campos.php';
?>

<body>
    <div class="container">
        <h1 class="text-center">Horario de Clases</h1>

        <div class="container col-md-8">
            <?php
            $gestorHorario = new GestorHorario();
            echo $gestorHorario->mostrarHorario();
            ?>
        </div>
        <br>
        <br>

        <h2>Operaciones Horario:</h2>

        <form action="horario.php" method="POST" enctype="multipart/form-data">
            <div class="col-md-12 row g-3">
                <div class="col-4">
                    <label>Curso:</label>
                    <select class="form-select" id="curso" name="curso">
                        <option value=''></option>
                        <?php
                        foreach (Curso::cases() as $enumerado) {
                            echo "<option value='$enumerado->value'>$enumerado->name</option>";
                        }

                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <label>Día:</label>
                    <select class="form-select" id="dia" name="dia">
                        <option value=''></option>
                        <?php
                        foreach (Semana::cases() as $enumerado) {
                            echo "<option value='$enumerado->value'>$enumerado->name</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <label>Hora:</label>
                    <select class="form-select" id="hora" name="hora">
                        <option value=''></option>
                        <?php
                        foreach (Hora::cases() as $hora) {
                            echo "<option value='" . $hora->codigoHora() . "'>$hora->name</option>";
                        }

                        ?>

                    </select>
                </div>
            </div>
            <div class="col-md-12 row g-3">

                <div class="col-4">
                    <label>Materia:</label>
                    <select class="form-select" id="materia" name="materia">
                        <option value=''></option>
                        <?php
                        foreach (Materia::cases() as $enumerado) {
                            echo "<option value='$enumerado->value'>$enumerado->name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <label>Clase:</label>
                    <select class="form-select" id="clase" name="clase">
                        <option value=''></option>
                        <?php
                        foreach (Clase::cases() as $enumerado) {
                            echo "<option value='$enumerado->value'>$enumerado->name</option>";
                        }
                        ?>
                    </select><br>
                </div>
                <div class="col-4">
                    <label>Color:</label>
                    <select class="form-select" id="color" name="color">
                        <option value=''></option>
                        <?php
                        foreach (Color::cases() as $enumerado) {
                            echo "<option style='background-color:$enumerado->value' 
                                            value='$enumerado->value'>$enumerado->name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-12 row g-3">
                <div class="col-4">
                    <input type="submit" class="btn btn-primary" name="insertar" value="Insertar Hora">
                    <input type="submit" class="btn btn-danger" name="eliminar" value="Eliminar Hora">
                </div>

                <div class="col-6">
                    <input type="file" name="fhorario" id="fhorario">
                    <input type="submit" class="btn btn-info" name="cargar" value="Cargar Horario">
                </div>
            </div>

        </form>
    </div>
</body>

</html>