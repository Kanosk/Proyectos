// verifica el error que le pasa la validacion correspondiente
function errores(error) {
    let message = "";
    switch (error) {
        case 'e1':
            message = "Error, no es un texto valido";
            break;
        case 'e2':
            message = "Error, no es un número";
            break;
        default:
            message = "Error desconocido";
            break;
    }
    return message;
};

//verifica que lo introducido solo tenga letras y guiones, para evitar resto de simbolos
function isValidSTR(texto) {
    if (/^[a-zA-Z\-]+$/.test(texto)) {
        return texto;
    } else {
        return this.errores("e1");
    }
}

//verifica que lo introducido es un numero integro
function isValidInt(num) {
    if (/^\d+$/.test(num)) {
        return parseInt(num, 10);
    } else {
        return this.errores("e2");
    }
}
