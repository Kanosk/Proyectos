<?php
require_once "../../modelo/cliente.php";
$ClienteModelo = new Cliente();
$Cliente = $ClienteModelo->obtenerCliente();
try {
    $Cliente = $ClienteModelo->obtenerCliente();
} catch (Exception $e) {
    echo "Hubo un error al obtener los clientes: " . $e->getMessage();
    exit;
}
foreach ($Cliente as $c) {
    echo "<tr>
        <th>".$c->getId_usuario()."</th>
        <th>".$c->getdni_cl()."</th>
        <th>".$c->getNombre_cl()."</th>
        <th>".$c->getApellido1_cl()."</th>
        <th>".$c->getApellido2_cl()."</th>
        <th>".$c->getEmail_cl()."</th>
        <th>".$c->getTelefono_cl()."</th>
        <th>".$c->getDNI_personal()."</th>
        
        <th>
            <a href=editarcliente.php?id_usuario=".$c->getId_usuario()."><button class='btn btn-warning'>Editar</button></a>
            <a href=../../controlador/cliente/borrar.php?id_usuario=".$c->getId_usuario()."><button class='btn btn-danger'>Borrar</button></a>
        </th>
    </tr>   
    ";
}

?>