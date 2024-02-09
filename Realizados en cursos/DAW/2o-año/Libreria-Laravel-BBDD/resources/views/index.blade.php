<!DOCTYPE html>
<html>

<head>
    <title>Act 4 DSW</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script type="text/javascript" src="{{ asset('bootstrap/js/jquery-3.6.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('funciones.js') }}"></script>
</head>

<body>
    <div class="container-fluid">
        <div id="login" class="col-md-3 order-md-1" style="display:block">
            <p style="color:red"></p>
            <h4 class="mb-3">Librería</h4>
            <form id="loginForm">
                <fieldset>
                    <div><span class='mensaje'></span></div>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input id="usuario" name="usuario" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="clave">Contraseña</label>
                        <input id="clave" name="clave" class="form-control" type="password">
                        <input type="checkbox" onclick="showPass()"> Mostrar Contraseña
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary"  onclick="login()">Iniciar Sesión</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div id="cabecera" style="display:none">
            <span id="usuario_nombre"></span>
            <a href="#" onclick="addCategoria()">Añadir Categorias</a>
            <a href="#" onclick="mostrarCategorias()">Listar Categorias</a>
            <a href="#" onclick="mostrarCategoriasProducto()">Añadir Productos</a>
            <a href="#" onclick="mostrarCarrito()">Carrito</a>
            <a href="#" onclick="logout()">Cerrar sesion</a>
        </div>
        <hr>
        <div class="container" >
            <div id="categoria" style="display: none"></div>
            <div id="producto" style="display: none"></div>
            <div id="carrito" style="display: none"></div>
            <div id="formulario" style="display: none"></div>
        </div>
    </div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        checkSession();
    });

    //verificamos el contenido de la sesion con cada refresh de la pagina
    var carrito = @json(session('carrito'));
    console.log('Contenido del carrito:', carrito);
</script>
</body>
</html>
