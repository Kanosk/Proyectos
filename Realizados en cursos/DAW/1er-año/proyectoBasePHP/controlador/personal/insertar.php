
            <?php
            require_once "../../modelo/personal.php";
            if (
                isset($_POST['dni_personal'])
                && isset($_POST['nombre_per'])
                && isset($_POST['apellido1_per'])
                && isset($_POST['apellido2_per']) 
                && isset($_POST['email_per']) 
                && isset($_POST['telefono_per']) 
                && isset($_POST['cargo'])  
                && isset($_POST['estado'])  
                      
            ) {
                $dni_personal =$_POST['dni_personal'];
                $nombre_per = $_POST['nombre_per'];
                $apellido1_per = $_POST['apellido1_per'];
                $apellido2_per = $_POST['apellido2_per'];   
                $email_per = $_POST['email_per'];  
                $telefono_per = $_POST['telefono_per'];
                $cargo =$_POST['cargo'];
                $estado =$_POST['estado'];       
                
                $persona = new personal();
                $persona->setDni_personal($dni_personal);
                $persona->setNombre_per($nombre_per);
                $persona->setApellido1_per($apellido1_per);
                $persona->setApellido2_per($apellido2_per);
                $persona->setEmail_per($email_per);
                $persona->setTelefono_per($telefono_per);
                $persona->setCargo($cargo);
                $persona->setEstado($estado);
                echo $persona->addPersona();
            }

            ?>
           
           