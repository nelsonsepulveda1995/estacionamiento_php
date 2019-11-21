$(document).ready(function(){
    $('#ingresar').click(validarlogin);
    $('#registro_empleado').click(validarempleado);
    $('#registro_cliente').click(registro_cliente);
    $('#registrar_abonado').click(registrar_abonado);
    $('#registro_estadia').click(registrar_estadia);
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
      });


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
    console.log("id: "+id)
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
        $('#res').text("dni maximo de 10 digitos");
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
function registrar_estadia(){
    var precio=$('#PRECIO option:selected').val();
    var patente=$('#PATENTE').val();
    var id_usuario=$('#ID_USUARIO').val();
    if(patente == "" || id_usuario == ""){
        $('#res').text("error al ingresar datos");
        return false
    }
    if(precio <= 0 || precio >3){
        $('#res').text("error al ingresar el precio (recarge la pagina)");
        return false
    }
    else{
        $('#res').empty();
    }
}
