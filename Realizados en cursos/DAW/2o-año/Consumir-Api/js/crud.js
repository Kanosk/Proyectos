// Crea y devuelve un objeto XMLHttpRequest compatible con varios navegadores para realizar solicitudes HTTP.
function crearXMLHttpRequest(method,url) {
    var xhttp = null;
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) { //IE 
            try {
                xhttp = new ActiveXObject("Msxml2.XMLHTTP");
                xhttp.open(method, url, true);
            } catch (exception) {
                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
                xhttp.open(method, url, true);
            }
        } else { //FIRE and others
            xhttp = new XMLHttpRequest();
            xhttp.open(method, url, true);
        }
    } else {
        alert("Your browser does not support XMLHTTP Request...!");
    }
    return xhttp;
}

// Carga la lista de productos desde una API y actualiza el contenido de la página.
function loadProducts() {
    var xhttp = crearXMLHttpRequest("GET","https://dummyjson.com/products");
    borrar();
    xhttp.onload = function () {
        if (xhttp.status == 200 && xhttp.readyState == 4) {
            var data = JSON.parse(xhttp.responseText);
            var productsContainer = document.getElementById('products');
            productsContainer.style.display = "block";
            productsContainer.innerHTML = '';

            data.products.forEach(function (product) {
                var productHTML = `
                <div class="card h-100 m-2" style="width: 18rem; display: inline-block;" >
                <img src="${product.thumbnail}" alt="${product.title}" class="card-img-top">
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center">
                        <h6 class="card-title me-2">${product.title}</h6>
                        <p class="bg-secondary text-white w-auto price">${product.price}$</p>
                    </div>
                    <p class="card-text">${product.description}</p>
                    <a href="#" class="btn btn-primary" onclick="editProduct(${product.id})">Modificar</a>
                    <a href="#" class="btn btn-danger" onclick="delProd(${product.id})">Eliminar</a>
                </div>
            </div>
                `;

                productsContainer.innerHTML += productHTML;
            });
            
        } else {
            console.log('Error al cargar los productos. Estado:', xhttp.status);
        }
    };

    xhttp.onerror = function () {
        console.log('Error de red al cargar los productos.');
    };

    xhttp.send();
}

// Carga la información de un producto por su ID utilizando una Promise para manejar la asincronía.
function loadById(id) {
    return new Promise(function(resolve, reject) {
        var url = "https://dummyjson.com/products/" + id;
        var xhttp = crearXMLHttpRequest("GET", url);

        xhttp.onload = function () {
            if (xhttp.status == 200 && xhttp.readyState == 4) {
                var data = JSON.parse(xhttp.responseText);
                resolve(data);
            } else {
                reject('Error al cargar los productos.');
            }
        };

        xhttp.onerror = function () {
            reject('Error de red al cargar los productos.');
        };

        xhttp.send();
    });
}

// Agrega un nuevo producto a la API mediante una solicitud POST y lista los productos nuevamente.
function addProduct(){
    var xhttp =crearXMLHttpRequest("POST","https://dummyjson.com/products/add");
    var nombre=document.getElementById('nombre').value;
    var descripcion=document.getElementById('descripcion').value;
    var precio=document.getElementById('precio').value;
    var stock=document.getElementById('stock').value;
    const nuevoProducto={
        title:isValidSTR(nombre),
        description:descripcion,
        price: isValidInt(precio),
        stock: isValidInt(stock)
    };
    const jsonProducto = JSON.stringify(nuevoProducto);

    xhttp.onload = function () {
        if (xhttp.status == 200 && xhttp.readyState == 4) {
            Swal.fire("Se ha añadido el producto correctamente");
            loadProducts();
            
        } else {
            Swal.fire("Error al añadir el producto");
            console.log('Error al añadir el producto. Estado:', xhttp.status);
        }
    };

    xhttp.onerror = function () {
        console.log('Error de red al añadir el producto.');
    };

    xhttp.send(jsonProducto);
}

// Redirige a la función formularioEdit para editar un producto específico.
function editProduct(id){
    formularioEdit(id);
}

// Edita un producto específico mediante una solicitud PATCH y lista los productos nuevamente.
function editarProduct(id){
    url ="https://dummyjson.com/products/" +id;
    var xhttp =crearXMLHttpRequest("PATCH",url);
    var nombre=document.getElementById('nombre').value;
    var descripcion=document.getElementById('descripcion').value;
    var precio=document.getElementById('precio').value;
    var stock=document.getElementById('stock').value;
    const productoEditado={
        title:isValidSTR(nombre),
        description:descripcion,
        price: isValidInt(precio),
        stock: isValidInt(stock)
    };
    const jsonProducto = JSON.stringify(productoEditado);
    xhttp.onload =function(){
        if (xhttp.status == 200 && xhttp.readyState == 4) {
            Swal.fire(`Se ha modificado el producto con ID  ${id} correctamente`)
            loadProducts();
        }else{
            Swal.fire(`Error al modificar el producto con ID ${id}`)
        }
    }
    xhttp.send(jsonProducto);

}

// Elimina un producto específico mediante una solicitud DELETE y lista los productos nuevamente.
function deleteProduct(id){
    url ="https://dummyjson.com/products/" +id;
    var xhttp = crearXMLHttpRequest("DELETE",url);
    
    xhttp.onload =function(){
        if (xhttp.status == 200 && xhttp.readyState == 4) {
            Swal.fire(`Se ha eliminado el producto con ID  ${id} correctamente`)
        }else{
            Swal.fire(`Error al eliminar el producto con ID ${id}`)
        }
    }
    xhttp.send();

}

// Muestra un mensaje de confirmación antes de eliminar un producto, utilizando la función deleteProduct para realizar la acción.
function delProd(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });
    swalWithBootstrapButtons.fire({
      title: "¿Estás seguro?",
      text: "Esto eliminará el producto seleccionado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminarlo",
      cancelButtonText: "No, cancelar",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        deleteProduct(id);
      }
    });
}



