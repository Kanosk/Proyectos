<?php
       require_once "../../modelo/cliente.php";
       
       
       if(isset ($_GET['id_usuario'])&& !empty($_GET['id_usuario'])){
           $id_usuario =$_GET['id_usuario'];   
           $c = new Cliente();
           $c->setId_usuario($_GET['id_usuario']);
           $cs = $c->obtenerClienteEdit($id_usuario); 
       }
       
       if (isset($_POST['id_usuario'])
           && isset($_POST['nombre_cl'])
           && isset($_POST['apellido1_cl'])
           && isset($_POST['apellido2_cl']) 
           && isset($_POST['email_cl']) 
           && isset($_POST['telefono_cl'])) {
       
           $id_usuario = $_POST['id_usuario'];
           $nombre_cl = $_POST['nombre_cl'];
           $apellido1_cl = $_POST['apellido1_cl'];
           $apellido2_cl = $_POST['apellido2_cl'];   
           $email_cl = $_POST['email_cl'];  
           $telefono_cl = $_POST['telefono_cl'];
       
           $cs = new Cliente();
           $cs->setId_usuario($id_usuario);
           $cs->setNombre_cl($nombre_cl);
           $cs->setApellido1_cl($apellido1_cl);
           $cs->setApellido2_cl($apellido2_cl);
           $cs->setEmail_cl($email_cl);
           $cs->setTelefono_cl($telefono_cl);
           echo $cs->editCliente($id_usuario, $nombre_cl, $apellido1_cl, $apellido2_cl, $email_cl, $telefono_cl);
       }
    