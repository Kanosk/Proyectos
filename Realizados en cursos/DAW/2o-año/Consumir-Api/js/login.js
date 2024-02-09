// verifica los datos introducidos y los compara con los que estan en el JSON
function login() {
    const user = document.getElementById("usuario").value;
    const pass = document.getElementById("contraseña").value;
    let userOK = false;

    fetch('user.json')
    .then(response => response.json())
    .then(data => {
        data.usuarios.forEach(usuario => {
            if (usuario.usuario === user && usuario.contraseña === pass) {
                Swal.fire({
                    text: `Bienvenid@ ${user}`,
                    didClose: () =>{
                        window.location.href='principal.html';
                    }
                })
                userOK = true;
            }
        });
        
        if(!userOK){
            Swal.fire("Error al iniciar sesión");
            console.log('Error al iniciar sesión. Estado:', xhttp.status);
            document.getElementById("usuario").value = "";
            document.getElementById("contraseña").value = "";
        }
        
    }
    ).catch(error => console.error('Ha habido un error a la hora de cargar el JSON', error));
    return false;
}

// te permite verificar la contraseña introducida usando un checkbox
function showPass(){
    var pass = document.getElementById('contraseña');
    if(pass.type === "password"){
        pass.type = "text";
    }else{
        pass.type= "password";
    }
}