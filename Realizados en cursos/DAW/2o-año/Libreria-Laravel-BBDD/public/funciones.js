//LOGIN - LOGOUT - VERIFICAR SESION - SHOWPASS
function login() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta["respuesta"] === false) {
                    Swal.fire("Revise usuario y contraseña");
                    // alert("Revise usuario y contraseña");
                } else {
                    var usuario = respuesta["usuario"];
                    document.getElementById("login").style.display = "none";
                    document.getElementById("cabecera").style.display = "block";
                    document.getElementById("usuario_nombre").innerHTML = "Usuario: " + usuario;
                }
            } else {
                // Manejar errores de la solicitud
                console.error("Error en la solicitud");
            }
        }
    };

    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var usuario = document.getElementById("usuario").value;
    var clave = document.getElementById("clave").value;
    var params = "usuario=" + usuario + "&clave=" + clave;

    xhttp.open("POST", "/login", true);
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);

    // Prevenir el envío del formulario por defecto
    return false;
}

function logout() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            /*cambiar visibilidades de las secciones*/
            if (respuesta == true) {
                Swal.fire("Sesion cerrada con éxito");
                // alert("Sesion cerrada con éxito");
                document.getElementById("login").style.display = "block";
                document.getElementById("cabecera").style.display = "none";
                guardarBloques()
            }else{
                Swal.fire("Hubo un error a la hora de cerrar sesión");
                // alert("Hubo un error a la hora de cerrar sesión");
            }
        }
    };
    xhttp.open("GET", "logout", false);
    xhttp.send();
}

function checkSession() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            if (respuesta["sesion_iniciada"] === true) {
                // Si la sesión está iniciada, mostrar secciones correspondientes
                document.getElementById("login").style.display = "none";
                document.getElementById("cabecera").style.display = "block";
                document.getElementById("usuario_nombre").innerHTML =
                    "Usuario: " + respuesta["usuario"];
            } else {
                // Si la sesión no está iniciada, mostrar el formulario de inicio de sesión
                document.getElementById("login").style.display = "block";
                document.getElementById("cabecera").style.display = "none";
                document.getElementById("categoria").style.display = "none";
                document.getElementById("producto").style.display = "none";
                document.getElementById("carrito").style.display = "none";
                document.getElementById('formulario').style.display="none";
            }
        }
    };

    xhttp.open("GET", "/check-session", true);
    xhttp.send();
}

function showPass(){
    var pass = document.getElementById('clave');
    if(pass.type === "password"){
        pass.type = "text";
    }else{
        pass.type= "password";
    }
}

//CREAR FILAS Y CONTROLAR DIVS
function guardarBloques(){
    document.getElementById("categoria").style.display="none";
    document.getElementById("producto").style.display="none";
    document.getElementById("carrito").style.display="none";
    document.getElementById('formulario').style.display="none";
    document.getElementById("categoria").innerHTML="";
    document.getElementById("producto").innerHTML="";
    document.getElementById("carrito").innerHTML="";
    document.getElementById('formulario').innerHTML="";
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

//MODIFICACION DE CATEGORIA
function crearTablaCategoria(categoria) {
    var tabla = document.createElement("table");
    tabla.classList.add("table");
    var cabecera = crearFila([" ID ", " Nombre ", " Descripcion ", " Acciones "], "th");
    tabla.appendChild(cabecera);
    for (var i = 0; i < categoria.length; i++) {
        fila = crearFila([
        categoria[i]['id'],
        categoria[i]['nombre'],
        categoria[i]['descripcion'],
        '<a><button class="btn btn-primary" onclick="mostrarProducto(\'' + categoria[i]['id'] + '\')">Ver Productos</button></a>'
        + '<a><button class="btn btn-warning" onclick="modCategoria(\'' + categoria[i]['id'] + '\')">Editar</button></a>'
        +'<a><button class="btn btn-danger" onclick="delCat(\'' + categoria[i]['id'] + '\')">Eliminar</button></a>',
        ], "td");
        tabla.appendChild(fila);
    }
    return tabla;
}

function mostrarCategorias() {
    guardarBloques();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                document.getElementById("categoria").style.display = "block";
                var cat = document.getElementById("categoria");
                cat.innerHTML = "<h2>Listado de Categorías</h2>";
                try {
                    var categoria = JSON.parse(this.responseText);
                    var tabla = crearTablaCategoria(categoria);
                    cat.appendChild(tabla);
                } catch (e) {
                    console.error(e);
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "Error al procesar las categorías.";
                    cat.innerHTML = "";
                    cat.appendChild(mensaje);
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
            }
        }
    };
    xhttp.open("GET", "categoria", true);
    xhttp.send();
    return false;
}

function structAddcategory(){
    var campos=document.getElementById("formulario");
    campos.innerHTML=`
    <h2>Añadir Nueva Categoria</h2>
    <form id="addFormCat">
        <fieldset>
            <div class="form-group">
                <label for="addFormCat">Nombre categoria</label>
                <input type="text" class="form-control" id="catNombre" placeholder="añade el nombre de la nueva categoria" required>
            </div>
            <div class="form-group">
                <label for="addFormCat">Descripción categoria</label>
                <textarea type="text" class="form-control" id="catDesc" placeholder="añade la descripción de la nueva categoria" required></textarea>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-success"  onclick="addCat()">Añadir Categoria</button>
            </div>
        </fieldset>
    </form>`;
}

function addCategoria(){
    guardarBloques();
    structAddcategory();
    document.getElementById('formulario').style.display="block";
}

function addCat(){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var nombre = document.getElementById("catNombre").value;
    var desc = document.getElementById("catDesc").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if (this.status == 200) {
                try {
                    var respuesta = JSON.parse(this.responseText);
                    if (respuesta.success) {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                        mostrarCategorias();
                    } else {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                    }
                } catch (e) {
                    console.error("Error al analizar la respuesta como JSON:", e);
                    Swal.fire('Hubo un error al cargar la categoría');
                    // alert('Hubo un error al cargar la categoría');
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                Swal.fire('Hubo un error al crear la categoria, vuelva a intentarlo');
                // alert('Hubo un error en la solicitud. Estado: ' + this.status);
            }
        }
    };

    xhttp.open("POST", "categoria/store", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send("nombre=" + nombre+"&descripcion="+desc);
    return false;
}

function structModcategory(){
    var campos=document.getElementById("formulario");
    campos.innerHTML=`
    <h2>Editar Categoria</h2>
    <form id="modFormCat">
        <fieldset>
            <div class="form-group">
                <label for="modFormCat">ID categoria</label>
                <input type="number" class="form-control" id="catModId" readonly>
            </div>
            <div class="form-group">
                <label for="modFormCat">Nombre categoria</label>
                <input type="text" class="form-control" id="catModNombre">
            </div>
            <div class="form-group">
                <label for="modFormCat">Descripción categoria</label>
                <textarea type="text" class="form-control" id="catModDesc"></textarea>
            </div>
            <div class="form-group">
                <button type="button" id="btn-mod" class="btn btn-success" >Modificar Categoria</button>
            </div>
        </fieldset>
    </form>`;
}

function modCategoria(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                try {
                    var categoria = JSON.parse(this.responseText);
                    fillModCategoria(categoria);
                } catch (e) {
                    console.error("Error al analizar la respuesta como JSON:", e);
                    Swal.fire('Hubo un error al cargar la categoría para editar');
                    // alert('Hubo un error al cargar la categoría para editar');
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                alert('Hubo un error en la solicitud. Estado: ' + this.status);
            }
        }
    };
    xhttp.open("GET", "categoria/show/" + id, true);
    xhttp.send();
}

function fillModCategoria(categoria){
    guardarBloques();
    structModcategory();
    document.getElementById('formulario').style.display="block";
    document.getElementById("catModId").value = categoria.id;
    document.getElementById("catModNombre").value = categoria.nombre;
    document.getElementById("catModDesc").value = categoria.descripcion;
    var btnMod = document.getElementById("btn-mod");
    btnMod.addEventListener("click", function () {
        var catId = document.getElementById("catModId").value;
        modCat(catId);
    });

}

function modCat(id){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var id= document.getElementById('catModId').value;
    var nombre =document.getElementById('catModNombre').value;
    var descripcion =document.getElementById('catModDesc').value;
    var params = "id="+id+"&nombre="+nombre+"&descripcion="+descripcion;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if (this.status == 200) {
                try {
                    var respuesta = JSON.parse(this.responseText);
                    if (respuesta.success) {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                        mostrarCategorias();
                    } else {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                    }
                } catch (e) {
                    console.error("Error al analizar la respuesta como JSON:", e);
                    Swal.fire('Hubo un error al cargar la categoría');
                    // alert('Hubo un error al cargar la categoría');
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                Swal.fire('Hubo un error en la solicitud. Estado: ' + this.status);
                // alert('Hubo un error en la solicitud. Estado: ' + this.status);
                console.error("Mensaje de error del servidor:", this.responseText);
            }
        }
    };
    xhttp.open("PUT", `categoria/update/${id}`, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send(params);
    return false;
}

function delCat(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });
    swalWithBootstrapButtons.fire({
      title: "¿Estás seguro?",
      text: "Esto eliminará los productos de la categoria y los que esten en el carrito",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminarlo",
      cancelButtonText: "No, cancelar",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarCategoria(id);
      }
    });
}

function eliminarCategoria(id) {
  var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        try {
          var respuesta = JSON.parse(this.responseText);
          if (respuesta.success) {
            Swal.fire({
              title: "Eliminado",
              text: respuesta.message,
              icon: "success"
            }).then(() => {
              mostrarCategorias();
            });
          } else {
            Swal.fire({
              title: "Error",
              text: respuesta.message,
              icon: "error"
            });
          }
        } catch (e) {
          console.error("Error al analizar la respuesta como JSON:", e);
          Swal.fire('Hubo un error al cargar la categoría');
        }
      } else {
        console.error("Error en la solicitud. Estado: " + this.status);
        Swal.fire('La categoría tiene productos, debe eliminarlos primero');
      }
    }
  };
  xhttp.open("DELETE", "categoria/delete/" + id, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.setRequestHeader('X-CSRF-TOKEN', token);
  xhttp.send("id=" + id);
  return false;
}

function crearTablaProducto(producto) {
    var tabla = document.createElement("table");
    tabla.classList.add("table");
    var cabecera = crearFila([" Código ", " Nombre ", " Descripcion ", "Stock", " Acciones ","Carrito"], "th");
    tabla.appendChild(cabecera);
    for (var i = 0; i < producto.length; i++) {
        fila = crearFila([
        producto[i]['id'],
        producto[i]['nombre'],
        producto[i]['descripcion'],
        producto[i]['stock'],
        '<a><button class="btn btn-danger" onclick="delProducto(\'' + producto[i]['id'] + '\')">Eliminar Producto</button></a>',
        '<input id="cantidadCarrito" data-id="'+producto[i]['id']+'" class="form-control" type="number">',
        '<a><button class="btn btn-primary" onclick="addACarrito(\'' + producto[i]['id'] + '\')">Añadir</button></a>',
        ], "td");
        tabla.appendChild(fila);
    }
    return tabla;
}

function mostrarProducto(id) {
    guardarBloques();
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                document.getElementById("categoria").style.display = "block";
                var cat = document.getElementById("categoria");
                cat.innerHTML = "<h2>Productos</h2>";
                try {
                    var producto = JSON.parse(this.responseText);
                    if(producto.length >0){
                        var tabla = crearTablaProducto(producto);
                        cat.appendChild(tabla);
                    }else{
                        cat.innerHTML="<h2>Productos</h2> <br> Categoria sin productos";
                    }
                } catch (e) {
                    console.error(e);
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "Error al procesar los productos.";
                    cat.innerHTML = "";
                    cat.appendChild(mensaje);
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
            }
        }
    };
    xhttp.open("GET", "producto/"+id, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send("id_cat="+id);
    return false;
}

function delProducto(id){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });
    swalWithBootstrapButtons.fire({
      title: "¿Estás seguro?",
      text: "Esto eliminará el producto de la categoria y los que esten en el carrito",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminarlo",
      cancelButtonText: "No, cancelar",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarProducto(id);
      }
    });
}

function eliminarProducto(id){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if (this.status == 200) {
                try {
                    var respuesta = JSON.parse(this.responseText);
                    if (respuesta.success) {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                        mostrarCategorias();
                    } else {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                    }
                } catch (e) {
                    console.error("Error al analizar la respuesta como JSON:", e);
                    Swal.fire('Hubo un error al cargar la categoría');
                    // alert('Hubo un error al cargar la categoría');
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                Swal.fire('Hubo un error en la solicitud. Estado: ' + this.status);
                // alert('Hubo un error en la solicitud. Estado: ' + this.status);
            }
        }
    };
    xhttp.open("DELETE", "producto/delete/"+id, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send("id=" + id);
    return false;
}

function mostrarCategoriasProducto() {
    guardarBloques();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var cat = document.getElementById("producto");
                cat.innerHTML = "<h2>Añadir Nuevos Productos</h2>";
                try {
                    var categoria = JSON.parse(this.responseText);
                    var tabla = structAddProduct(categoria);
                } catch (e) {
                    console.error(e);
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "Error al procesar las categorías.";
                    cat.innerHTML = "";
                    cat.appendChild(mensaje);
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
            }
        }
    };
    xhttp.open("GET", "categoria", true);
    xhttp.send();
    return false;
}

function structAddProduct(categorias) {
    document.getElementById('producto').style.display = "block";
    var prod = document.getElementById("producto");
    prod.innerHTML = `
    <h2>Añadir Nuevos Productos</h2>
    <form id="addFormProduct">
        <fieldset>
            <div class="form-group">
                <label for="addFormProduct">Nombre Producto</label>
                <input type="text" class="form-control" id="prodNombre" placeholder="añade el nombre del nuevo producto" required>
            </div>
            <div class="form-group">
                <label for="addFormProduct">Descripción Producto</label>
                <textarea type="text" class="form-control" id="prodDesc" placeholder="añade la descripción del nuevo producto" required></textarea>
            </div>
            <div class="form-group">
                <label for="addFormProduct">Stock</label>
                <input type="number" class="form-control" id="prodStock" required>
            </div>
            <div class="form-group">
                <label for="addFormProduct">Categoría</label>
                <select name="addFormProduct" id="prodCat">
                `;

    categorias.forEach(categoria => {
        var option = document.createElement("option");
        option.value = categoria.id;
        option.text = categoria.nombre;
        document.getElementById("prodCat").appendChild(option);
    });

    prod.innerHTML += `
            </select>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-success"  onclick="addProducto()">Añadir Producto</button>
        </div>
    </fieldset>
    </form>
    `;
}

function addProducto(){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var nombre = document.getElementById("prodNombre").value;
    var descripcion = document.getElementById("prodDesc").value;
    var stock = document.getElementById("prodStock").value;
    var id_cat = document.getElementById("prodCat").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if (this.status == 200) {
                try {
                    var respuesta = JSON.parse(this.responseText);
                    if (respuesta.success) {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                        mostrarCategorias();
                    } else {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                    }
                } catch (e) {
                    console.error("Error al analizar la respuesta como JSON:", e);
                    Swal.fire('Hubo un error al cargar la categoría');
                    // alert('Hubo un error al cargar la categoría');
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                Swal.fire('Hubo un error al crear el producto, vuelva a intentarlo');
                // alert('Hubo un error en la solicitud. Estado: ' + this.status);
            }
        }
    };

    xhttp.open("POST", "producto/store", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send("nombre=" + nombre+"&descripcion="+descripcion+"&stock="+stock+"&id_cat="+id_cat);
    return false;
}

function addACarrito(id){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var cantidad = document.querySelector('input[type="number"][data-id="' + id + '"]').value;
    var params = "cod_producto=" + id +"&stock="+cantidad;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if (this.status == 200) {
                try {
                    var respuesta = JSON.parse(this.responseText);
                    if (respuesta.success) {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                        mostrarCarrito();
                    } else {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                    }
                } catch (e) {
                    console.error("Error al analizar la respuesta como JSON:", e);
                    Swal.fire('Hubo un error al cargar la categoría');
                    // alert('Hubo un error al cargar la categoría');
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                Swal.fire('Hubo un error en la solicitud. Estado: ' + this.status);
                // alert('Hubo un error en la solicitud. Estado: ' + this.status);
                console.error(this.responseText);
            }
        }
    };
    xhttp.open("POST", "carrito/store/"+id+"/"+cantidad, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send(params);
    return false;

}

//MODIFICACION DE CARRITO

function crearTablaCarrito(carrito) {
    var tabla = document.createElement("table");
    tabla.classList.add("table");
    var cabecera = crearFila([" Código ", " Nombre ", " Descripcion ", "Unidades","Eliminar " , "  "], "th");
    tabla.appendChild(cabecera);
    for (var i = 0; i < carrito.length; i++) {
        fila = crearFila([
        carrito[i]['id'],
        carrito[i]['nombre'],
        carrito[i]['descripcion'],
        carrito[i]['stock'],
        '<input id="cantidadCarrito" data-id="'+carrito[i]['id']+'" class="form-control" type="number">',
        '<a><button class="btn btn-danger" onclick="delCarrito(\'' + carrito[i]['id'] + '\')">Eliminar Carrito</button></a>',
        ], "td");
        tabla.appendChild(fila);
    }
    return tabla;
}

function mostrarCarrito() {
    guardarBloques();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                document.getElementById("carrito").style.display = "block";
                var cat = document.getElementById("carrito");
                cat.innerHTML = "<h2>Carrito de la compra</h2>";
                try {
                    var carrito = JSON.parse(this.responseText);
                    if(carrito.isEmpty){
                        var mensaje = document.createElement("p");
                        mensaje.innerHTML = "Todavia no tiene productos";
                        cat.appendChild(mensaje);
                    }else{
                        var tabla = crearTablaCarrito(carrito);
                        cat.appendChild(tabla);
                        var procesar=document.createElement("a");
                        procesar.innerHTML='<button class="btn btn-success" onclick="procesarCarrito()">Procesar Carrito</button>';
                        cat.appendChild(procesar);
                    }
                } catch (e) {
                    console.error(e);
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "Hubo un error.";
                    cat.innerHTML = "";
                    cat.appendChild(mensaje);
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
            }
        }
    };
    xhttp.open("GET", "carrito", true);
    xhttp.send();
    return false;
}

function delCarrito(id){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var cantidad = document.querySelector('input[type="number"][data-id="' + id + '"]').value;
    var params = "id=" + id +"&cantidad="+cantidad;
    console.log(params);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if (this.status == 200) {
                try {
                    var respuesta = JSON.parse(this.responseText);
                    if (respuesta.success) {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                        mostrarCarrito();
                    } else {
                        Swal.fire(respuesta.message);
                        // alert(respuesta.message);
                    }
                } catch (e) {
                    console.error("Error al analizar la respuesta como JSON:", e);
                    Swal.fire('Hubo un error al cargar la categoría');
                    // alert('Hubo un error al cargar la categoría');
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                Swal.fire('Hubo un error en la solicitud. Estado: ' + this.status);
                // alert('Hubo un error en la solicitud. Estado: ' + this.status);
                console.error(this.responseText);
            }
        }
    };
    xhttp.open("PUT", "carrito/delete/"+id+"/"+cantidad, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.send(params);
    return false;
}

function procesarCarrito(){
    guardarBloques();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                document.getElementById("carrito").style.display = "block";
                var cat = document.getElementById("carrito");
                cat.innerHTML = "<h2>Estado del pedido</h2>";
                try {
                    var carrito = JSON.parse(this.responseText);
                    console.log(carrito)
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "se ha completado el pedido";
                    Swal.fire("Se ha completado el pedido");
                    cat.appendChild(mensaje);

                } catch (e) {
                    console.error(e);
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "Hubo un error.";
                    cat.innerHTML = "";
                    cat.appendChild(mensaje);
                }
            } else {
                console.error("Error en la solicitud. Estado: " + this.status);
                console.error(this.responseText);
            }
        }
    };
    xhttp.open("GET", "procesar", true);
    xhttp.send();
    return false;
}
