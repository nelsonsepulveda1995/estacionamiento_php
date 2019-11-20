$(document).ready(function(){
    $('#ingresar').click(validarlogin);
    $('#registro_empleado').click(validarempleado);
    $('#registro_cliente').click(registro_cliente);
    $('#registrar_abonado').click(registrar_abonado);
})

function validarlogin(){
    var user=$('#email').val();
    var pass=$('#password').val();
    if(pass == "" || user == ""){
        $('#res').text("error al ingresar datos");
        return false;
    }
    else{
        $('#res').empty();
    }
}

function validarempleado(){
    var nombre=$('#NOMBRE').val();
    var id=$('#ID option:selected').val();
    var usuario=$('#usuario').val();
    var pass=$('#password').val();
    if(pass == "" || usuario == "" || nombre=="" ){
        $('#res').text("error al ingresar datos");
        return false
    }
    if(id == 0 || id >2){
        $('#res').text("error al ingresar datos");
        return false
    }
    else{
        $('#res').empty();
    }
}
function registro_cliente(){
    var tipo=$('#tipo option:selected').val();
    var patente=$('#patente').val();
    var dni=$('#dni').val();
    if(patente == "" || dni == ""){
        $('#res').text("error al ingresar datos");
        return false
    }
    if(dni.length>10){
        $('#res').text("dni demasiado largo");
        return false
    }
    if(tipo == 0 || tipo >2){
        $('#res').text("error al ingresar datos");
        return false
    }
    else{
        $('#res').empty();
    }
}
function registrar_abonado(){
    var tipo=$('#patente option:selected').val();
    if(tipo == 0){
        $('#res').text("error al ingresar datos");
        return false
    }
}