<?php
if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Validaciones
    if(empty($nombre) || empty($apellidos) || empty($usuario) || empty($contrasena) || empty($confirmar_contrasena) || empty($telefono) || empty($email) || empty($tipo_usuario)){
        echo "Todos los campos son obligatorios. Por favor, complete el formulario correctamente.";
    } elseif($contrasena != $confirmar_contrasena) {
        echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
    } else {
        // Procesar la foto
        $foto_nombre = $_FILES['foto']['name'];
        $foto_temp = $_FILES['foto']['tmp_name'];
        $foto_destino = $_SERVER['DOCUMENT_ROOT'] . "/fotos/";

        // Crear el directorio si no existe
        if (!file_exists($foto_destino)) {
            mkdir($foto_destino, 0755, true);
        }

        // Mover la foto al directorio destino
        $foto_ruta_destino = $foto_destino . $foto_nombre;
        if(move_uploaded_file($foto_temp, $foto_ruta_destino)){
            // Mostrar el resumen de los datos
            echo "Registro exitoso.<br>";
            echo "Nombre: " . $nombre . "<br>";
            echo "Apellidos: " . $apellidos . "<br>";
            echo "Usuario: " . $usuario . "<br>";
            echo "Teléfono: " . $telefono . "<br>";
            echo "Email: " . $email . "<br>";
            echo "Tipo de Usuario: " . $tipo_usuario . "<br>";
            echo "Foto: " . $foto_nombre;
        } else {
            echo "Error al subir la foto. Por favor, inténtelo de nuevo.";
        }
    }
}
?>



