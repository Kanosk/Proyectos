<?php
            require_once "../../modelo/cliente.php";
            if (
                isset($_POST['DNI_cl'] )
                && isset($_POST['nombre_cl'])
                && isset($_POST['apellido1_cl'])
                && isset($_POST['apellido2_cl']) 
                && isset($_POST['email_cl']) 
                && isset($_POST['telefono_cl']) 
                && isset($_POST['DNI_personal'])   
            ) {
                $dni_cl=$_POST['DNI_cl'];
                $nombre_cl = $_POST['nombre_cl'];
                $apellido1_cl = $_POST['apellido1_cl'];
                $apellido2_cl = $_POST['apellido2_cl'];   
                $email_cl = $_POST['email_cl'];  
                $telefono_cl = $_POST['telefono_cl']; 
                $DNI_personal = $_POST['DNI_personal'];    
            
                $c = new Cliente();
                $c->setDni_cl($dni_cl);
                $c->setNombre_cl($nombre_cl);
                $c->setApellido1_cl($apellido1_cl);
                $c->setApellido2_cl($apellido2_cl);
                $c->setEmail_cl($email_cl);
                $c->setTelefono_cl($telefono_cl);
                $c->setDni_personal($DNI_personal);
                echo $c->addCliente();
            }