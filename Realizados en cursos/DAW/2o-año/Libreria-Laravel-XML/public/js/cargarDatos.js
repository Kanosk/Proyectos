function login() {
    var usuario = document.getElementById('usuario').value;
    var password = document.getElementById('password').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                window.location.href = 'principal';
                document.getElementById("user").innerHTML = "Usuario: " + usuario;
            } else {
                console.error('Error al iniciar sesión:', this.responseText);
                document.querySelector('.mensaje').innerHTML = 'Error en usuario o contraseña';
            }
        }
    };

    xhttp.open("POST", 'principal', true);
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('usuario=' + encodeURIComponent(usuario) + '&password=' + encodeURIComponent(password));

    return false;
}

function logout(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                window.location.href = '/';
            } else {
                console.error('Error al cerrar sesión:', this.responseText);
            }
        }
    };

    xhttp.open("POST", '/logout', true);
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

    return false;
}

function guardarBloques(){
    document.getElementById("generos").style.display="none";
    document.getElementById("libros").style.display="none";
    document.getElementById("carrito").style.display="none";
    var spans=document.getElementById("generos").getElementsByTagName("span");
    var parraf=document.getElementById("generos").getElementsByTagName("p");
    var a=document.getElementById("generos").getElementsByTagName("a");
    for (var i = spans.length - 1; i >= 0; i--) {
        spans[i].parentNode.removeChild(spans[i]);
    }
    for (var i = a.length - 1; i >= 0; i--) {
        a[i].parentNode.removeChild(a[i]);
    }
    for (var i = parraf.length - 1; i >= 0; i--) {
        parraf[i].parentNode.removeChild(parraf[i]);
    }
}

function cargarGeneros() {
    guardarBloques();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("generos").style.display = "block";
            var prod = document.getElementById("generos");
            var titulo = document.getElementById("titulo");
            titulo.innerHTML = "Generos de Libros";
            titulo.className = "titulo";
            prod.appendChild(titulo);
            try {
                var generos = JSON.parse(this.responseText);
                generos.forEach(function (genero) {
                    var generoElement = document.createElement("p");
                    var circulo = document.createElement("span");
                    circulo.className = "circulo";
                    circulo.innerHTML="· "
                    generoElement.appendChild(circulo);

                    var enlace = document.createElement("a");
                    enlace.id=genero.nombre;
                    enlace.className="enlace";
                    enlace.href = "#";
                    enlace.onclick = function(){cargarGeneroLibros(enlace.id);};
                    enlace.innerHTML = genero.nombre;
                    generoElement.appendChild(enlace);
                    prod.appendChild(generoElement);
                });
            } catch (e) {
                var mensaje = document.createElement("p");
                mensaje.innerHTML = "Error en generos";
                prod.innerHTML = "";
                prod.appendChild(mensaje);
            }
        }
    };

    xhttp.open("GET", "listarGeneros", true);
    xhttp.send();
    return false;
}

function cargarLibros(){
    guardarBloques();
    var xhttp =new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("libros").style.display="block";
            var lib = document.getElementById("libros");
            var titulo = document.getElementById("titulo");
            titulo.innerHTML = "Listado de Productos";
            try{
                var libros=JSON.parse(this.responseText);
                var tabla=crearTablaLibros(libros);
                lib.innerHTML="";
                lib.appendChild(tabla);
            }catch (e){
                console.log(this.responseText);
                var mensaje=document.createElement("p");
                mensaje.innerHTML="Error en libros";
                lib.innerHTML = "";
                lib.appendChild(mensaje);
            }
        }
    };
    xhttp.open("GET", "libros", true);
    xhttp.send();
    return false;
}

function cargarGeneroLibros(genero) {
    guardarBloques();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("libros").style.display = "block";
            var lib = document.getElementById("libros");
            var titulo = document.getElementById("titulo");
            titulo.innerHTML = "Listado de Libros - Género: " + genero;

            try {
                var libros = JSON.parse(this.responseText);
                if(libros.length === 0){
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "Genero sin libros";
                    lib.innerHTML = "";
                    lib.appendChild(mensaje);
                }else{
                    var tabla = crearTablaLibros(libros);
                    lib.innerHTML = "";
                    lib.appendChild(tabla);
                }

            } catch (e) {
                var mensaje = document.createElement("p");
                mensaje.innerHTML = "Genero sin libros";
                lib.innerHTML = "";
                lib.appendChild(mensaje);
            }
        }
    };

    xhttp.open("GET", ["librosporgenero/" + genero], true);
    xhttp.send();
    return false;
}

function crearTablaLibros(libros) {
    var tabla = document.createElement("table");
    var cabecera = crearFila([" ISBN ", " Titulo ", " Escritores ", " Genero ", " Numero de páginas ", " Imagen "," Cantidad",""], "th");
    tabla.appendChild(cabecera);
    for (var i = 0; i < libros.length; i++) {
        var imagen = "<img src='" + libros[i]['imagen'] + "'  width='60' height='90' />";
        fila = crearFila([
        libros[i]['isbn'],
        libros[i]['titulo'],
        libros[i]['escritores'],
        libros[i]['genero'],
        libros[i]['numpaginas'],
        imagen,
        '<input type="number" value="1" class="cantidad" data-isbn="'+libros[i]['isbn'] +'">',
        '<a href="#" class="comprar" onclick="anadirLibros(\'' + libros[i]['isbn'] + '\')">Comprar</a>',

        ], "td");

        tabla.appendChild(fila);
    }

    return tabla;
}

function crearFila(campos, tipo) {
    var fila = document.createElement("tr");
    for (var i = 0; i < campos.length; i++) {
        var celda = document.createElement(tipo);
        celda.innerHTML = campos[i];
        fila.appendChild(celda);
    }
    return fila;
}

function cargarCarrito() {
    guardarBloques();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var car=document.getElementById("carrito");
                car.style.display="block";

                var carrito = JSON.parse(this.responseText);
                if(carrito.length === 0){
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "El carrito esta vacio";
                    car.innerHTML = "";
                    var compra=document.createElement("a");
                    compra.href="#";
                    compra.className="compra";
                    compra.setAttribute("href","/procesarPedido")
                    compra.innerHTML="Realizar Pedido";
                    car.appendChild(compra);
                    car.appendChild(mensaje);
                }else{
                    mostrarCarrito(carrito);
                }
            } else {
                console.error('Error en la solicitud AJAX:', this.responseText);
                alert('Error en la solicitud AJAX. Consulta la consola para más detalles.');
                innerHTML="hubo un error, no se pudo cargar";
            }
        }
    };
    xhttp.open("GET", "/cargarCarrito", true);
    xhttp.send();
    return false;
}

function anadirLibros(isbn) {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var cantidadInput = document.querySelector('input[type="number"][data-isbn="' + isbn + '"]');
    var cantidad = cantidadInput ? cantidadInput.value : 1;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            alert(respuesta.mensaje);
            cargarCarrito();
        }
    };

    xhttp.open("POST", "/anadirLibros", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send("isbn=" + isbn + "&cantidad=" + cantidad);
    return false;
}

function eliminarLibros(isbn) {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var cantidadInput = document.querySelector('input[type="number"][data-isbn="' + isbn + '"]');
    var cantidad = cantidadInput ? cantidadInput.value : 1;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                alert(respuesta.mensaje);
                cargarCarrito();
            } else {
                console.error('Error en la solicitud AJAX:', this.responseText);
                alert('Error en la solicitud AJAX. Consulta la consola para más detalles.');
            }
        }
    };

    xhttp.open("POST", "/eliminarLibros", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send("isbn=" + isbn +"&cantidad="+cantidad);
    return false;
}

function mostrarCarrito(carrito) {
    guardarBloques();
    document.getElementById("carrito").style.display = "block";

    var carritoDiv = document.getElementById("carrito");
    var titulo = document.getElementById("titulo");
    titulo.innerHTML = "Carrito de Compras";

    var tabla = document.createElement("table");
    var cabecera = crearFila(["ISBN", "Título", "Escritores","Género","Páginas","Imagen" ,"Cantidad"], "th");
    tabla.appendChild(cabecera);

    var carritoArray = Object.values(carrito);

    for (var i = 0; i < carritoArray.length; i++) {
        var imagen = "<img src='" + carritoArray[i]['imagen'] + "'  width='60' height='90' />";
        var fila = crearFila([
            carritoArray[i]['isbn'],
            carritoArray[i]['titulo'] || 'Sin título',
            carritoArray[i]['escritores'],
            carritoArray[i]['genero'],
            carritoArray[i]['paginas'],
            imagen,
            carritoArray[i]['cantidad'],
            //pendiente de poder eliminar por cantidades
            '<input type="number" class="cantidad" value="' + carritoArray[i]['cantidad'] + '" data-isbn="' + carritoArray[i]['isbn'] + '">',
            '<a href="#" onclick="eliminarLibros(\'' + carritoArray[i]['isbn'] + '\')">Eliminar</a>',
        ], "td");
        tabla.appendChild(fila);
    }

    carritoDiv.innerHTML = "";
    carritoDiv.appendChild(titulo);
    carritoDiv.appendChild(tabla);

    var compra=document.createElement("a");
    compra.href="#";
    compra.className="compra";
    compra.setAttribute("href","/procesarPedido")
    compra.innerHTML="Realizar Pedido";
    carritoDiv.appendChild(compra);

}

function procesarPedido(){
    guardarBloques();

}





