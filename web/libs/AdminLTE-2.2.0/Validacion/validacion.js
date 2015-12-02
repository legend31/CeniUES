$(document).on("ready", inicio);

function inicio() {
    $("#form_nombredocente").keyup(validarNombre);
    $("#form_apellidodocente").keyup(validarApellidos);
    $("#form_dui").keyup(validarDui);
    $("#form_direcciondocente").keyup(validarDireccion);
    $("#form_telefonodocente").keyup(validarTelefono);
    $("#form_carnetdocente").keyup(validarCarnet);
    $("#form_email").keyup(validarEmail);
    $("#inputRecibo").keyup(validarRecibo);
    $("#form_Carnet").keyup(validarCarnetD);
}

function validarRecibo() {
    var valor= document.getElementById("inputRecibo").value;
    var numeros;
    if(valor.length<=7) {
        numeros = valor.substring(2,5);
    }
    if(valor[1] == '-' && valor[0] == 'R' && !isNaN(numeros) && valor.length==6) {
        $("#inputRecibo").parent().attr("class","col-sm-4 has-success has-feedback");
        $("#inputRecibo").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#inputRecibo").parent().attr("class","col-sm-4 has-error has-feedback");
        $("#inputRecibo").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarCarnetD() {
    var valor= document.getElementById("form_Carnet").value;
    var caracteres;
    var numeros;
    if(valor.length<=7) {
        caracteres = valor.substring(0,1);
        numeros = valor.substring(2,7);
    }
    if(!isNaN(numeros) && isNaN(caracteres) && valor.length==7) {
        $("#form_Carnet").parent().attr("class","col-sm-4 has-success has-feedback");
        $("#form_Carnet").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#form_Carnet").parent().attr("class","col-sm-4 has-error has-feedback");
        $("#form_Carnet").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarCarnet() {
    var valor= document.getElementById("form_carnetdocente").value;
    var caracteres;
    var numeros;
    if(valor.length<=7) {
        caracteres = valor.substring(0,1);
        numeros = valor.substring(2,7);
    }
    if(!isNaN(numeros) && isNaN(caracteres) && valor.length==7) {
        $("#form_carnetdocente").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_carnetdocente").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#form_carnetdocente").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_carnetdocente").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarNombre() {
    var valor= document.getElementById("form_nombredocente").value;
    if(valor.length < 3) {
        $("#form_nombredocente").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_nombredocente").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
    else {
        $("#form_nombredocente").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_nombredocente").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
}

function validarApellidos() {
    var valor= document.getElementById("form_apellidodocente").value;
    if(valor.length < 3) {
        $("#form_apellidodocente").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_apellidodocente").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
    else {
        $("#form_apellidodocente").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_apellidodocente").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
}

function validarDireccion() {
    var valor= document.getElementById("form_direcciondocente").value;
    if(valor.length == 0) {
        $("#form_direcciondocente").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_direcciondocente").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
    else {
        $("#form_direcciondocente").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_direcciondocente").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
}

function validarDui() {
    var valor= document.getElementById("form_dui").value;
    if(valor[8]=='-' && valor.length==10 ) {
        $("#form_dui").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_dui").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#form_dui").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_dui").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarTelefono() {
    var valor= document.getElementById("form_telefonodocente").value;
    if(valor[4]=='-' && valor.length==9 ) {
        $("#form_telefonodocente").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_telefonodocente").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#form_telefonodocente").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_telefonodocente").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}

function validarEmail() {
    var valor= document.getElementById("form_email").value;
    if(valor.indexOf('@')>0 && valor.indexOf('.') > 0 && (valor.length-valor.indexOf('.') > 2)) {
        $("#form_email").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_email").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
    else {
        $("#form_email").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_email").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
}