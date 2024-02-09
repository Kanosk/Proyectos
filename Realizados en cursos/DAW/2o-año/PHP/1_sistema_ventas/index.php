<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h2>Registro de Usuario</h2>
            <br>
            <form action="insertar_usuario.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required><br>
                </div>
            
                <div class="form-group">
                    <label>Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" required><br>
                </div>
            
                <div class="form-group">
                    <label>Usuario:</label>
                    <input type="text" class="form-control" name="usuario" required><br>
                </div>
                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" class="form-control" name="contrasena" required><br>
                </div>

                <div class="form-group">
                    <label>Repita Contraseña:</label>
                    <input type="password" class="form-control" name="confirmar_contrasena" required><br>
                </div>

                <div class="form-group">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" required><br>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="email" required><br>
                </div>

                <div class="form-group">
                    <label>Tipo de Usuario:</label>
                    <select name="tipo_usuario" class="form-control">
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>
                        <option value="Cliente">Cliente</option>
                    </select><br>
                </div>
                <div class="form-group">
                    <label>Foto:</label>
                    <input type="file" class="form-control" name="foto" required><br>
                </div>
                <div class="form-group" align="center">
                    <input type="submit" class="btn btn-success" value="Registrar Usuario" name="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
