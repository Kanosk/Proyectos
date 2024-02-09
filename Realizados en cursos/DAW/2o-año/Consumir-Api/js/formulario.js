// hace inyeccion de codigo html via JS para mostrar un formulario
function formularioAdd(){
    borrar();
    var form = document.getElementById('form');
    form.innerHTML="";
    form.style.display="block";
    form.innerHTML=`
    <div class="addProducto container" id="addProducto" >
                <div class="caja container">
                    <form class="w-auto">
                        <h3 class="mb-3 text-center">Añadir Producto</h3>
                        <div class="mb-3">
                            <input type="text" placeholder="Nombre" id="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <textarea type="text-area" id="descripcion" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="number" placeholder="Precio" id="precio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="number" placeholder="Stock" id="stock" class="form-control">
                        </div>
                        <div class="container-fluid">
                            <button class="btn btn-primary" onclick="addProduct()">Añadir Producto</button>
                        </div>
                    </form>
                </div>
            </div>
    
    `;
}
// hace inyeccion de codigo html via JS para mostrar un formulario, cargando el producto correspondiente
async function formularioEdit(id){
    borrar();
    try{
    var producto = await loadById(id);
    var form = document.getElementById('form');
    form.innerHTML="";
    form.style.display="block";
    form.innerHTML=`
    <div class="addProducto container" id="addProducto" >
                <div class="caja container">
                    <form class="w-auto">
                        <h3 class="mb-3 text-center">Editar Producto</h3>
                        <div class="mb-3">
                            <input type="text" id="nombre" class="form-control" value="${producto.title}">
                        </div>
                        <div class="mb-3">
                            <textarea type="text-area" id="descripcion" class="form-control">${producto.description}</textarea>
                        </div>
                        <div class="mb-3">
                            <input type="number" id="precio" class="form-control" value="${producto.price}">
                        </div>
                        <div class="mb-3">
                            <input type="number" id="stock" class="form-control" value="${producto.stock}">
                        </div>
                        <div class="container-fluid">
                            <button class="btn btn-primary" onclick="editarProduct(${producto.id})">Editar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
    
    `;
}catch(error){
    Swal.fire(`Hubo un error al cargar los datos`)
    console.log(error);
}
}