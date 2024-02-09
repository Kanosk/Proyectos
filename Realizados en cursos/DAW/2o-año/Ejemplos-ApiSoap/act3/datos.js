let api_key = "eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJjYW5kaWRvbnB2QGdtYWlsLmNvbSIsImp0aSI6IjM1ZmFiMTk2LWU5ZTItNDIwOS05MzJjLTQxN2YwOTE0YTRlMCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNzA2MjkyNTQ3LCJ1c2VySWQiOiIzNWZhYjE5Ni1lOWUyLTQyMDktOTMyYy00MTdmMDkxNGE0ZTAiLCJyb2xlIjoiIn0.Ug4dzYZyO8Ya50zoZt5OUxbEb0WJ-TQOY4mQuM_LSdA";

function obtenerFicheroMapas(){
    let urlDatos="";
    let data = null;
    let urlMapa ="https://opendata.aemet.es/opendata/api/mapasygraficos/analisis/?api_key=" + api_key;

    let xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            let response = JSON.parse(this.responseText);
            urlDatos = response["datos"];
        }
    })

    xhr.open("GET", urlMapa, false);
    xhr.getResponseHeader("cache-control", "no-cache");
    xhr.send(data);
    
    return urlDatos;
}

function mostrarFicheroMapas(){
    let urlDatos = obtenerFicheroMapas();
    let content = document.getElementById("contenido");
    content.innerHTML = "";
    content.innerHTML = "<img src='" + urlDatos + "'>";
}

// Prediccion diara de Canarias
function obtenerFicheroCanarias(){
    let urlDatos="";
    let data = null;
    let urlMapa ="https://opendata.aemet.es/opendata/api/prediccion/ccaa/hoy/coo/?api_key=" + api_key;

    let xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            let response = JSON.parse(this.responseText);
            urlDatos = response["datos"];
        }
    })

    xhr.open("GET", urlMapa, false);
    xhr.getResponseHeader("cache-control", "no-cache");
    xhr.send(data);

    return urlDatos;
}

function mostrarFicheroCanarias() {
    let datosCanarias = obtenerFicheroCanarias();
    let data = null;

    let xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            let content = document.getElementById("contenido");
            content.innerHTML="";
            content.innerHTML = this.responseText.replace(/\n/g, '<br>');
        }
    });

    xhr.open("GET", datosCanarias, false);
    xhr.setRequestHeader("cache-control", "no-cache");
    xhr.send(data);
}


// Preduccion diara de Gran Canaria
function obtenerFicheroGranCanaria(){
    let urlDatos="";
    let data = null;
    let urlMapa ="https://opendata.aemet.es/opendata/api/prediccion/provincia/manana/353?api_key=" + api_key;

    let xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            let response = JSON.parse(this.responseText);
            urlDatos = response["datos"];
        }
    })

    xhr.open("GET", urlMapa, false);
    xhr.getResponseHeader("cache-control", "no-cache");
    xhr.send(data);
    
    return urlDatos;
}


function mostrarFicheroGranCanaria(){
    let urlDat = obtenerFicheroGranCanaria();
    let data = null;

    let xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            let content = document.getElementById("contenido");
            content.innerHTML="";
            content.innerHTML = this.responseText.replace(/\n/g, '<br>');
        }
    });

    xhr.open("GET", urlDat, false);
    xhr.setRequestHeader("cache-control", "no-cache");
    xhr.send(data);
}    