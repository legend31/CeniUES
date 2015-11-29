$(document).on("ready", inicio);

function inicio() {
    $("#form_nombredocente").keyup(validarNombre);
    $("#form_apellidodocente").keyup(validarApellidos);
    $("#form_dui").keyup(validarDui);
    $("#form_direcciondocente").keyup(validarDireccion);
}

function validarNombre() {
    var valor= document.getElementById("form_nombredocente").value;
    if(valor.length == 0) {
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
    if(valor.length == 0) {
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
    if(valor.length < 10) {
        $("#form_dui").parent().attr("class","col-sm-6 has-error has-feedback");
        $("#form_dui").parent().children("span").attr("class","glyphicon glyphicon-remove form-control-feedback");
        return false;
    }
    else {
        $("#form_dui").parent().attr("class","col-sm-6 has-success has-feedback");
        $("#form_dui").parent().children("span").attr("class","glyphicon glyphicon-ok form-control-feedback");
    }
}

