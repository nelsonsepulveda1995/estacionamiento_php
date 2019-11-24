$(document).ready(function () {
    //llamada a menu por ajax
    menuAjax();
});


function validarlogin() {
    var user = $('#email').val();
    var pass = $('#password').val();
    if (pass == "" || user == "") {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false;
    } else {
        $('#res').empty();
        return true;
    } 
}

function validarempleado() {
    var nombre = $('#nombre').val();
    var id = $('#ID option:selected').val();
    var usuario = $('#usuario').val();
    var pass = $('#password').val();
    var regex_nombre=/([a-záéíóúñ]{2,})(\s)(([a-záéíóúñ]{2,})(\s?)){1,}/ig
    var regex_usuario=/^(?=.*[a-z])(?=.*\d?)(?=.*[$@$!_\-%*#?&]?)[a-z\d$@$_\-!%*#?&]{5,}$/ig
    var regex_pass = /^(?=.*[a-z]?)(?=.*\d?)(?=.*[$@$!_\-%*#?&]?)[a-z\d$@$_\-!%*#?&]{8,}$/ig
    console.log("id: " + id)
    if (pass == "" || usuario == "" || nombre == "") {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos.. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    }else{
        if (!nombre.match(regex_nombre)) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Formato de nombre incorrecto. Deben ser 2 (dos) palabras como minimo<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false
        }
        if (!usuario.match(regex_usuario)) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Formato de nombre de usuario incorrecto. Debe tener 5 caracteres como minimo<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false
        }
        if (!pass.match(regex_pass)) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Formato de contraseña incorrecto. Debe tener 8 caracteres como minimo, sin espacios<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false
        }
        if (id <= 0 || id > 2) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> La opción seleccionada en 'Cargo' no es correcta. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false
        } else {
            $('#res').empty();
            return true;
        }
    }
}

function registro_cliente() {
    console.log("llamo a la funcion")
    var tipo = $('#tipo option:selected').val();
    var patente = $('#patente').val();
    var dni = $('#dni').val();
    var nombre_cliente = $('#nombre_cliente').val();
    var email = $('#email').val();
    var regex_patenteN = /([a-z]{2})(\d{3})([a-z]{2})/ig;
    var regex_patenteV = /([a-z]{3})(\d{3})/ig;
    var regex_nombre_cliente = /([a-záéíóúñ]{2,})(\s)(([a-záéíóúñ]{2,})(\s?)){1,}/ig;
    var regex_email = /[-0-9a-z.+_]+@[-0-9a-z.+_]+.[a-z]{2,4}/ig;
    var regex_dni = /(\d{8,10})/ig;
    if (patente == "" || dni == "" || nombre_cliente == "" || email == "") {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    }else{
        if (!patente.match(regex_patenteN) && !patente.match(regex_patenteV)) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'>El formato de patente es incorrecto. Las patentes admitidas deben ser 'AA000AA' o 'AAA000'<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false;
        }
        if (!nombre_cliente.match(regex_nombre_cliente)) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'>El formato del nombre es incorrecto. Debe contener al menos 2 (dos) palabras.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false;
        }
        if (!email.match(regex_email)) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'>El formato de email es incorrecto. El formato aceptado es 'nombre@dominio'<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false;
        }
        if (dni.length > 10) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> DNI Demasiado largo<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false
        }
        if (!dni.match(regex_dni)){
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'>El formato de DNI es incorrecto. Los DNI admitidos deben ser entre 8 y 10 caracteres numéricos.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false;
        }
        if (tipo == 0 || tipo > 2) {
            $('#res').empty();
            $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Error en el tipo de cliente <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            return false
        } else {
            $('#res').empty();
            return true;
        }
    }
}

function registrar_estadia() {
    var precio = $('#PRECIO option:selected').val();
    var patente = $('#patente').val();
    var id_usuario = $('#ID_USUARIO').val();
    var regex_patenteN = /([a-z]{2})(\d{3})([a-z]{2})/ig;
    var regex_patenteV = /([a-z]{3})(\d{3})/ig;
    if (patente == "" || patente=="0" || id_usuario == "" ) {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    }else if (!patente.match(regex_patenteV) && !patente.match(regex_patenteN)) {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'>El formato de patente es incorrecto. Las patentes admitidas deben ser AA000AA o AAA000<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false;
    }
    if (precio <= 0 || precio > 3 || precio=='') {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> La opción seleccionada en el campo 'precio' es incorrecta. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    } else {
        $('#res').empty();
        return true;
    }
}

function egreso_estadia() {
    var patente = $('#patente').val();
    var id_usuario = $('#ID_USUARIO').val();
    var regex_patenteN = /([a-z]{2})(\d{3})([a-z]{2})/ig;
    var regex_patenteV = /([a-z]{3})(\d{3})/ig;
    if (patente == "" || patente=="0" || id_usuario == "" ) {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    }else if (!patente.match(regex_patenteV) && !patente.match(regex_patenteN)) {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'>El formato de patente es incorrecto. Las patentes admitidas deben ser AA000AA o AAA000<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false;
    } else {
        $('#res').empty();
        return true;
    }
}


//------------------------------------------NAVBAR POR AJAX----------------------------------------
function menuAjax() {
    $('.navMenu').click(function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var padre = $(this).parent();
        var dataString = 'key='+url;
        console.log(dataString)
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            success: function (response) {
                $('#body').html(response);
                $('#navbarText').removeClass('show');
                $('#buttonNavbar').attr('aria-expanded', 'false');
                $('#buttonNavbar').addClass('collapsed');
                $('.lighted').removeClass('lighted');
                padre.addClass('lighted')
                activateTablesorter()
            }
        });
    });
}

function activateTablesorter() {
    $("table").tablesorter({
        theme : "bootstrap",
        widthFixed: true,
        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        // the uitheme widget is NOT REQUIRED!
        widgets : [ "filter", "columns", "zebra" ],
    
        widgetOptions : {
          // using the default zebra striping class name, so it actually isn't included in the theme variable above
          // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
          zebra : ["even", "odd"],
          // class names added to columns when sorted
          columns: [ "primary", "secondary", "tertiary" ],
          // reset filters button
          filter_reset : ".reset",
          // extra css class name (string or array) added to the filter element (input or select)
          filter_cssFilter: [
            'form-control',
            'form-control',
            'form-control', // select needs custom class names :(
            'form-control',
            'form-control',
            'form-control'
          ]
        }
      })
      .tablesorterPager({
    
        // target the pager markup - see the HTML block below
        container: $(".ts-pager"),
    
        // target the pager page select dropdown - choose a page
        cssGoto  : ".pagenum",
    
        // remove rows from the table to speed up the sort of large tables.
        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
        removeRows: false,
    
        // output string - default is '{page}/{totalPages}';
        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
    
      });
}