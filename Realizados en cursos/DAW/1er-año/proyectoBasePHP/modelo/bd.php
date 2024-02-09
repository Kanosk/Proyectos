<?php
class bd
{
    // private $cadenaConexion = "mysql:dbname=trabajobae;host=localhost;port=3306";
    private $cadenaConexion = "pgsql:dbname=proyectoBae;host=localhost;port=5432";
    // private $usuario = "root";
    private $usuario = "postgres";
    private $clave = "1234";

    function conectarBD()
    {
        try {
            return new PDO($this->cadenaConexion, $this->usuario, $this->clave);
        } catch (PDOException $e) {
            echo "Error ocurrio un problema en Base de datos: " . $e->getMessage();
            return null;
        }
    }
}