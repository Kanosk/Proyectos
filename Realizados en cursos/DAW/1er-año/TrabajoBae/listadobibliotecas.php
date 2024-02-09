<!DOCTYPE html>
<html>

<?php
include "componentes/head.php";
require_once  "modelo/biblioteca.php";
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Listado de bibliotecas: </h1>
            <br>
            <div align="center">
                <table align="center" class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Numero de Libros</th>
                            <th>Estado</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

            $biblioteca = new Biblioteca();
            $listadoBibliotecas = $biblioteca->obtenerListadoBibliotecas();

            foreach ($listadoBibliotecas as $biblioteca) {
                echo "<tr>
                        <td>" . $biblioteca->getId() . "</td>
                        <td>" . $biblioteca->getNombre() . "</td>
                        <td>" . $biblioteca->getDescripcion() . "</td>
                        <td>" . $biblioteca->getNumerolibros() . "</td>
                        <td>" . $biblioteca->getEstado() . "</td>
                        <td>";
                switch ($biblioteca->getEstado()) {
                    case 'Activo':
                        echo "<a href='insertarLibroBiblioteca.php?id=" . $biblioteca->getId() . "'><button>Añadir Libros</button></a>";
                        echo "<a href='verLibros.php?id=" . $biblioteca->getId() . "'><button>Ver Libros</button></a>";
                        echo "<a href='editarBiblioteca.php?id=" . $biblioteca->getId() . "'><button>Editar Biblioteca</button></a>";
                        echo "<a href='borrarBiblioteca.php?id=" . $biblioteca->getId() . "'><button>Borrar Biblioteca</button></a>";
                        echo "<a href='comprarBiblioteca.php?id=" . $biblioteca->getId() . "'><button>Comprar Biblioteca</button></a>";
                        break;

                    case 'Inactivo':
                        echo "<a href='verLibros.php?id=" . $biblioteca->getId() . "'><button>Ver Libros</button></a>";
                        echo "<a href='editarBiblioteca.php?id=" . $biblioteca->getId() . "'><button>Editar Biblioteca</button></a>";
                        echo "<a href='borrarBiblioteca.php?id=" . $biblioteca->getId() . "'><button>Borrar Biblioteca</button></a>";
                        break;

                    case 'Comprado':
                        echo "<span style='color:red'>Ya has adquirido esta Biblioteca </span>";
                        echo "<a href='verLibros.php?id=" . $biblioteca->getId() . "'><button>Ver Libros Comprados</button></a>";
                        break;

                    default:
                        break;
                }
                echo "</td>
                    </tr>";
            }
            ?>
                    </tbody>
            </div>
            </table>

            <br>
            <a href="insertarBiblioteca.php"><button button class="btn btn-primary">Nueva Biblioteca</button></a>
            <a href="index.php"><button button class="btn btn-primary">Volver al Listado</button></a>

        </div>
    </div>
</body>

</html>