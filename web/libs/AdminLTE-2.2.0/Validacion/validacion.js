$(document).on("ready", inicio);

/**
 * Para validar campo debes crear la llama en la funcion inicio, entre las comillas meter despues del # el id del input que quieres
 * validar si el campo tiene un formato existente solo llamar a la funcion correspondiente dentro del metodo keyup()
 * para formar la funcion solo concatenar a la palabra 'validar' el campo que nos interes con la primera letra mayuscula, asi para
 * validar un nombre validarNombre, un correo validarEmail, un carnet validarCarnet; el apellido tambien puede ser validado con
 * el metodo de validarNombre su el metodo que quieres validar no existe crearlo :v att. Fredy
 */

function inicio() {
    /*Nombres Generales Para validar*/
    $("#nombre").keyup(validarNombre);
    $("#apellido").keyup(validarNombre);
    $("#dui").keyup(validarDui);
    $("#carnet").keyup(validarCarnet);
    $("#direccion").keyup(validarDireccion);
    $("#telefono").keyup(validarTelefono);
    $("#email").keyup(validarEmail);

    /*Funciones Fredy*/
    $("#form_nombredocente").keyup(validarNombre);
    $("#form_apellidodocente").keyup(validarNombre);
    $("#form_dui").keyup(validarDui);
    $("#form_carnetdocente").keyup(validarCarnet);
    $("#form_direcciondocente").keyup(validarDireccion);
    $("#form_telefonodocente").keyup(validarTelefono);
    $("#form_email").keyup(validarEmail);
    $("#carnetB").keyup(validarCarnetBusqueda);
    $("#carnetH").keyup(validarCarnetH);

    /*Funciones Fer*/
    $("#inputPadre").keyup(validarNombre);
    $("#inputMadre").keyup(validarNombre);
    $("#inputNombre").keyup(validarNombre);
    $("#momjob").keyup(validarDireccion);
    $("#inputTrabajoP").keyup(validarDireccion);
    $("#inTelPadre").keyup(validarTelefono);
    $("#momtel").keyup(validarTelefono);
    $("#inputRecibo").keyup(validarRecibo);
    $("#form_Carnet").keyup(validarCarnetFer);
    $("#inputP").keyup(validarNombre);
    $("#inputtel").keyup(validarTelefono);
    $("#inputCarnet").keyup(validarCarnet);
    $("#inputPrimer").keyup(validarNombre);
    $("#inputSegundo").keyup(validarNombre);
    $("#inputPrimerApe").keyup(validarNombre);
    $("#inputSegApe").keyup(validarNombre);
    $("#inputRespon").keyup(validarNombre);
    $("#inputPa").keyup(validarNombre);
    $("#inputNota").keyup(validarNota);

    /*Funciones William*/
}

function validarNombre() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;

    if(valor.length < 3) {
        $("#"+id).parent().attr("class","col-sm-6 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
    else {
        $("#"+id).parent().attr("class","col-sm-6 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
}

function validarCarnet() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    var caracteres;
    var numeros;
    if(valor.length<=7) {
        caracteres = valor.substring(0,1);
        numeros = valor.substring(2,7);
    }
    if(!isNaN(numeros) && isNaN(caracteres) && valor.length==7) {
        $("#"+id).parent().attr("class","col-sm-6 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#"+id).parent().attr("class","col-sm-6 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}
function validarCarnetFer() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    var caracteres;
    var numeros;
    if(valor.length<=7) {
        caracteres = valor.substring(0,1);
        numeros = valor.substring(2,7);
    }
    if(!isNaN(numeros) && isNaN(caracteres) && valor.length==7) {
        $("#"+id).parent().attr("class","col-sm-4 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#"+id).parent().attr("class","col-sm-4 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarCarnetBusqueda() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    var caracteres;
    var numeros;
    if(valor.length<=7) {
        caracteres = valor.substring(0,1);
        numeros = valor.substring(2,7);
    }
    if(!isNaN(numeros) && isNaN(caracteres) && valor.length==7) {
        $("#"+id).parent().attr("class","input-group has-success");
    }
    else {
        $("#"+id).parent().attr("class","input-group has-error");
        return false;
    }
}

function validarCarnetH() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    var caracteres;
    var numeros;
    if(valor.length<=7) {
        caracteres = valor.substring(0,1);
        numeros = valor.substring(2,7);
    }
    if(!isNaN(numeros) && isNaN(caracteres) && valor.length==7) {
        $("#"+id).parent().attr("class","col-md-3 input-group has-success");
    }
    else {
        $("#"+id).parent().attr("class","col-md-3 input-group has-error");
        return false;
    }
}

function validarDui() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    if(valor[8]=='-' && valor.length==10 ) {
        $("#"+id).parent().attr("class","col-sm-6 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#"+id).parent().attr("class","col-sm-6 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarDireccion() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    if(valor.length == 0) {
        $("#"+id).parent().attr("class","col-sm-6 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
    else {
        $("#"+id).parent().attr("class","col-sm-6 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
}

function validarTelefono() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    if(valor[4]=='-' && valor.length==9 ) {
        $("#"+id).parent().attr("class","col-sm-6 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#"+id).parent().attr("class","col-sm-6 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarEmail() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    if(valor.indexOf('@')>0 && valor.indexOf('.') > 0 && (valor.length-valor.indexOf('.') > 2)) {
        $("#"+id).parent().attr("class","col-sm-6 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#"+id).parent().attr("class","col-sm-6 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarRecibo() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;
    if(valor[0]=='R' && valor[1]=='-' && valor.length==6) {
        $("#"+id).parent().attr("class","col-sm-4 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#"+id).parent().attr("class","col-sm-4 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarNota() {
    var id = $(this).attr('id').toString();
    var valor= document.getElementById(id).value;

    if(valor >= 0.00 && valor <= 10.00) {
        $("#"+id).parent().attr("class","col-sm-6 has-success has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
        return false;
    }
    else {
        $("#"+id).parent().attr("class","col-sm-6 has-error has-feedback");
        $("#"+id).parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
    }
}