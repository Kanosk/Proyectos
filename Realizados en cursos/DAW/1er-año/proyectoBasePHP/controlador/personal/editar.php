<?php

require_once "../../modelo/personal.php";



if(isset ($_GET['dni_personal']) && !empty($_GET['dni_personal'])) {
    $dni =$_GET['dni_personal'];
    $p = new personal();
    $p->setdni_personal($_GET['dni_personal']);
    $pers = $p->obtenerPersonaindividual($dni);
}

if (isset($_POST['dni_personal'])
    && isset($_POST['nombre_per'])
    && isset($_POST['apellido1_per'])
    && isset($_POST['apellido2_per']) 
    && isset($_POST['email_per']) 
    && isset($_POST['telefono_per']) 
    && isset($_POST['cargo']) 
    && isset($_POST['estado'])         
) {
    $dni_personal = $_POST['dni_personal'];
    $nombre_per = $_POST['nombre_per'];
    $apellido1_per = $_POST['apellido1_per'];
    $apellido2_per = $_POST['apellido2_per'];   
    $email_per = $_POST['email_per'];  
    $telefono_per = $_POST['telefono_per'];
    $cargo = $_POST['cargo']; 
    $estado = $_POST['estado'];      

    $p = new personal();
    $p->setdni_personal($dni_personal);
    $p->setNombre_per($nombre_per);
    $p->setApellido1_per($apellido1_per);
    $p->setApellido2_per($apellido2_per);
    $p->setEmail_per($email_per);
    $p->setTelefono_per($telefono_per);
    $p->setCargo($cargo);
    $p->setEstado($estado);
    //echo $p->editarPersona($dni_personal,$nombre_per,$apellido1_per,$apellido2_per,$telefono_per,$cargo,$email_per);
    echo $p->editarPersona();
}   