{{--  --}}
<!DOCTYPE html>
<html>

<head>
    <title>Formulario de login</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="{{ asset('bootstrap/js/jquery-3.6.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/cargarDatos.js') }}"></script>
</head>

<body>
    <div class="container-fluid">
            <div class="col-md-3 order-md-1">
                <p style="color:red"></p>
                <h4 class="mb-3">Librería</h4>
                {{-- <form id="loginForm" action="principal" method="post"> --}}
                <form id="loginForm" onsubmit="login()" method="post">
                    @csrf
                    <fieldset>
                        <div><span class='mensaje'><?php echo $mensaje; ?></span></div>
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input id="usuario" name="usuario" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" name="password" class="form-control" type="password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" id="iniciarSesion" value="Iniciar Sesión">
                        </div>
                        <p>*se inicia sesion sin poner el correo completo, solo con el nombre</p>
                    </fieldset>
                </form>
</div>
    </div>
</body>
</html>


