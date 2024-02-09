<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>UT02 - Supuesto Práctico - Ejercicio 1</title>
    </head>
    <body>
        <?php
        error_reporting(0);  
        ?>
        <div id="encabezado">
            <h1>Listado Categorías de Libros</h1>
            <br>
            <form id="form_listado" action="listado.php" method="post">
                <span>Categorías de Libros: </span>
                <select name="codigoCategoriaLibro">
                    <option value="Comedia">Comedia</option>
                    <option value="Ciencia">Ciencia Ficción</option>
                    <option value="Terror">Terror</option>
                </select>
                <input type="submit" value="Mostrar" name="enviar"/>
            </form>
        </div>
        <div id="contenido">
            <h2>Listado de libros de la categoria:<?php 
            $categoria = $_POST['codigoCategoriaLibro']; 
            if ($categoria=="Ciencia"){
                echo  $categoria." Ficción";
            }else{
                echo" $categoria";
            }
            ?>
            </h2>
            <?php
                if (isset($_POST['enviar'])) {
                    $generos = 'generos/' . strtolower($categoria) . '.txt';
                    if (file_exists($generos)) {
                        $libros = file($generos);
                        echo "<table border='0'>
                            <tr>
                                <th>ISBN</th>
                                <th>Título</th>
                                <th>Autor/es</th>
                                <th>Género</th>
                                <th>Nº Páginas</th>
                                <th>Imagen Portada</th>
                                <th>Precio</th>
                            </tr>";
                            foreach ($libros as $libro) {
                                $linea = explode(";", $libro);
                                echo "<tr>";
                                echo "<td>{$linea[0]}</td>";
                                echo "<td>{$linea[1]}</td>";
                                echo "<td>{$linea[2]}</td>";
                                echo "<td>{$linea[3]}</td>";
                                echo "<td>{$linea[4]}</td>";
                                echo "<td><img src='{$linea[5]}' alt='Portada del libro' width='100'></td>";
                                echo "<td>{$linea[6]}€</td>";
                                echo "</tr>";
                            }
                        echo "</table>";
                    }
                }
            ?>
        </div>
    </body>
</html>