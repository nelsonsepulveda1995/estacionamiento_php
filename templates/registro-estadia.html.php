<?php
    if(isset($_SESSION)){    
        if(!isset($_SESSION['cargo'])){
            header('location: ../index.php');
        }
        if($_SESSION['cargo']==1){
            header('location: home-gerente.php');
        }  
    }
    else{
        header('location: /../index.php');
    }
?>

<?php
if (isset($_SESSION['estadia_error'])):
    echo    '<div class="alert alert-danger alert-dismissible fade show mt-5 text-center" role="alert">'
                . $_SESSION['estadia_error'] .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    unset($_SESSION['estadia_error']);
endif;
if (isset($_SESSION['estadia_success'])):
    echo    '<div class="alert alert-success alert-dismissible fade show mt-5 text-center" role="alert">'
                . $_SESSION['estadia_success'] .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    unset($_SESSION['estadia_success']);
endif;
?>


<div id="res"></div>
<div class="card card-signin my-5">
    <br>
    <div class="row" style="margin:3px">
        <div class ="col">
            <a href="../functions/home-empleado.php" class="float-left btn btn-primary btn-lg active" role="button" aria-pressed="true">Regresar</a>
        </div>
    </div>

    <div class="card-body">
        <h5 class="card-title text-center">Alta de estadia</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="<?= $url ?? '' ?>" method="POST">
        <input type="hidden" name="key" pattern="(\d){1,}" value="<?= $url ?? ''?>">
            <input type="hidden" id="ID_USUARIO" name="ID_USUARIO" value="<?=$_SESSION['id_usuario'] ?? ''?>">  <!-- toma el usuario activo -->
            <div class="form-label-group">
                <select name="PATENTE" id="patente" class="form-control select2" required>
                    <option value="0">Seleccione una patente</option>
                    <?php include '../functions/todos-cliente-option-no-abonado.php'; ?>
                </select>
            </div>
            <div class="form-label-group">
            <p>Precio de la estadía: </p>
                <select name="PRECIO" id="PRECIO" class="form-control" required>
                </select>
            </div>
            <button id="registro_estadia" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Registrar Estadia">Registrar Estadia</button>
        </form>
    </div>
</div>
<script>
    $('.select2').select2({
        width: '100%'
    });
    $('#patente').change(function(){
        var datos = 'key='+$(this).val();
        console.log(datos)
        $.ajax({
                type: "POST", 
                url: '../functions/precios-option.php',
                data: datos,
                success: function (response) {
                    $('#PRECIO').html(response);
                }
            });
    })
    $('form').submit(function (e) { 
        $('.alert').remove();
        e.preventDefault();
        var dataForm = $(this).serialize();
        var url = $(this).attr('action');
        if (registrar_estadia()){
            $.ajax({
                type: "POST", 
                url: url,
                data: dataForm,
                success: function (response) {
                    $('#body').html(response);
                    activateTablesorter();
                }
            });
        }
    });
</script>