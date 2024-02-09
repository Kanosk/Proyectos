<?php
session_start();
try{
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si al menos un documento fue subido
    if (empty($_FILES['documentos']['name'][0])) {
        throw new Exception( "Debe al menos subir un documento para poder registrar");
    } else {
        // Procesar otros campos del formulario
        $autores = $_POST['autores'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $extensiones = $_POST['extension'];
        $palabrasclave = $_POST['palabrasclave'];
        $idioma = $_POST['idioma'];
        $visibilidad = $_POST['visibilidad'];
        $tematica = implode(", ", $_POST['tematica']); 

        
        foreach ($_FILES['documentos']['tmp_name'] as $key => $tmp_name) {
            $archivo = $_FILES['documentos']['name'][$key];
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $directorio_destino = $_SERVER['DOCUMENT_ROOT'] . "/" . $extension . "/";
            if (!file_exists($directorio_destino)) {
                mkdir($directorio_destino, 0755, true);
            }
            move_uploaded_file($_FILES['documentos']['tmp_name'][$key], $directorio_destino . $archivo);
            }
        }
    }
}
catch(Exception $e){
    echo 'Error '.$e->getMessage();
}
function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Documentos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Autor/es</th>
                        <th>Nombre Documento</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Palabras Clave</th>
                        <th>Temática</th>
                        <th>Idioma</th>
                        <th>Visibilidad</th>
                        <th>Nombre y tamaño del Fichero</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    echo "<tr>
                    <td>$autores</td>
                    <td>$nombre</td>
                    <td>$descripcion</td>
                    <td>$tipo</td>
                    <td>$palabrasclave</td>
                    <td>$tematica</td>
                    <td>$idioma</td>
                    <td>$visibilidad</td>";

                    echo "</td>
              <td>";
                // Mostrar el tamaño de cada archivo
                foreach ($_FILES['documentos']['name'] as $key => $nombreArchivo) {
                    $tamañoArchivo = $_FILES['documentos']['size'][$key]; // Tamaño en bytes
                    $tamañoFormateado = formatBytes($tamañoArchivo); // Función para convertir bytes a KB, MB, etc.
                    echo "$nombreArchivo ($tamañoFormateado)<br>";
                }
            
                echo "</td>
                      </tr>
                      </table>";
                    ?>
                </tbody>
            </table>
            <div align="center"><a href="index.php"><input type="button" class="btn btn-success" value="Volver a introducir datos"></a></div>
        </div>
    </div>
</body>
</html>
