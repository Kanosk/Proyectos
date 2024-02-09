<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Esto es para poder usar AJAX, ya que se necesita el csrf_token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="{{ asset('bootstrap/js/jquery-3.6.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <title>Principal</title>
</head>
<body>
<div class="container-fluid">
    @csrf

        <section id="cabecera" style="display: block">
            <div class="form-group">
                <h2>Librería</h2>
            </div>
            <br>
            <p>Usuario:  <?php echo session('usuario')?> </p>
            <br>
            <div class="form-group">
                <p>Menú:
                    <a href="#" onclick="cargarGeneros()">Listado de Generos</a> /
                    <a href="#" onclick="cargarLibros()">Listado de Libros</a> /
                    <a href="#" onclick="cargarCarrito()">Ver carrito</a> /
                    <a href="#" onclick="logout()">Cerrar sessión</a>
                </p>
            </div>
            <hr>
        </section>
        <div class="container-fluid">
            <div id="generos" style="display: none">
                <h2 id="titulo"> </h2>

            </div>
            <div id="libros" style="display: none">
                <h2 id="titulo"> </h2>
            </div>
            <div id="carrito" style="display: none">
                <h2 id="titulo"> </h2>
            </div>
        </div>
</div>
<script type="text/javascript" src="{{ asset('/js/cargarDatos.js') }}"></script>
</body>
</html>

