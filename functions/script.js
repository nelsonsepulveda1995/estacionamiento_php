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
    var nombre = $('#NOMBRE').val();
    var id = $('#ID option:selected').val();
    var usuario = $('#usuario').val();
    var pass = $('#password').val();
    console.log("id: " + id)
    if (pass == "" || usuario == "" || nombre == "") {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos.. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    }
    if (id == 0 || id > 2) {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> La opción seleccionada en 'Cargo' no es correcta. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    } else {
        $('#res').empty();
        return true;
    }
}

function registro_cliente() {
    console.log("llamo a la funcion")
    var tipo = $('#tipo option:selected').val();
    var patente = $('#patente').val();
    var dni = $('#dni').val();
    if (patente == "" || dni == "") {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    }
    if (dni.length > 10) {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> DNI Demasiado largo<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
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

function registrar_estadia() {
    var precio = $('#PRECIO option:selected').val();
    var patente = $('#PATENTE').val();
    var id_usuario = $('#ID_USUARIO').val();
    if (patente == "" || id_usuario == "") {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> Debe completar todos los campos. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
    }
    if (precio <= 0 || precio > 3) {
        $('#res').empty();
        $('#res').append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> La opción seleccionada en el campo 'precio' es incorrecta. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        return false
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