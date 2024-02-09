<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>UT02 - Supuesto Práctico - Ejercicio 2</title>
</head>

<body>
    <div id="encabezado">
        <h1>UT02 - Insertar un producto</h1>
    </div>
    <div id="contenido" style="height:710px">
        <h2>Insertar nuevo Producto:</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            if (empty($_POST['codigoproducto'])) {
                echo "Es necesario rellenar el campo: codigoproducto <br>";
                echo "Error: El producto no se guardó<br>";
            }if (empty($_FILES['imagen']['name'])){
                echo "Es necesario rellenar el campo: imagen <br>";
                echo "Error: El producto no se guardó<br>";
            }elseif (empty($_POST['codigocategoria'])) {
                echo "Es necesario rellenar el campo: codigocategoria <br>";
                echo "Error: El producto no se guardó<br>";
            }elseif (empty($_POST['nombrecorto'])) {
                echo "Es necesario rellenar el campo: nombrecorto <br>";
                echo "Error: El producto no se guardó<br>";
            }elseif (empty($_POST['nombre'])) {
                echo "Es necesario rellenar el campo: nombre <br>";
                echo "Error: El producto no se guardó<br>";
            }elseif (empty($_POST['descripcion'])) {
                echo "Es necesario rellenar el campo: descripcion <br>";
                echo "Error: El producto no se guardó<br>";
            }elseif (empty($_POST['precio'])) {
                echo "Es necesario rellenar el campo: precio <br>";
                echo "Error: El producto no se guardó<br>";
            }else{
                $codigo = $_POST['codigoproducto'];
                $categoria = $_POST['codigocategoria'];
                $nombrecorto = $_POST['nombrecorto'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                if (!empty($_FILES['imagen']['name'])) {
                    $imagen_tmp = $_FILES['imagen']['tmp_name'];
                    $nombre_imagen = $_FILES['imagen']['name'];
                    $ruta_carpeta = $_SERVER['DOCUMENT_ROOT'] . "/productos/";
                    $ruta_destino = $ruta_carpeta . $nombre_imagen;
                    if (!file_exists($ruta_carpeta)) {
                        mkdir($ruta_carpeta, 0755, true);
                    }
                    if (move_uploaded_file($imagen_tmp, $ruta_destino)) {
                        echo "Imagen guardada correctamente <br>";
                    } else {
                        echo "Error al guardar la imagen<br>";
                    }
                }        
                $linea = "$codigo;$nombrecorto;$nombre;$descripcion;$precio";

                $_ruta_carpeta = $_SERVER['DOCUMENT_ROOT'] . "/productos/";
                $archivo = $_ruta_carpeta . $categoria.".txt";
                if (!file_exists($archivo)) {
                    touch($archivo);
                }
                file_put_contents($archivo, $linea . PHP_EOL, FILE_APPEND);
                echo "Producto guardado correctamente <br>";
            }

            } 
        ?>
        <form id='form_edit' action='insertar.php' method='post' enctype="multipart/form-data">
            <fieldset>
                <legend>Código:</legend> <input type='text' style='color: #F00;background-color: #ccc;'
                    name='codigoproducto' value='' />
            </fieldset>
            <fieldset>
                <legend>Subir foto de producto</legend>
                <input type="file" name="imagen">
            </fieldset>
            <fieldset>
                <legend>Categoría de productos: </legend>
                <select name="codigocategoria">
                    <option value="Lacteos">Lacteos</option>
                    <option value="Congelados">Congelados</option>
                    <option value="Bebidas">Bebidas</option>
                </select>
            </fieldset>
            <fieldset>
                <legend>Nombre corto: </legend><input type='text' name='nombrecorto' value='' size='50' />
            </fieldset>
            <fieldset>
                <legend>Nombre: </legend><textarea name='nombre' rows='3' cols='50'></textarea>
            </fieldset>
            <fieldset>
                <legend>Descripción: </legend><textarea name='descripcion' rows='7' cols='50'></textarea>
            </fieldset>
            <fieldset>
                <legend>PVP: </legend><input type='number' step="0.01" name='precio' value='' />
            </fieldset>
            <input type='submit' value='Insertar' name='Insertar' />

        </form>
    </div>
</body>

</html>