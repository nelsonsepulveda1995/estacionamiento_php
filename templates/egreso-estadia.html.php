<?php
if(isset($_SESSION)){  
    if(!isset($_SESSION['id_usuario']) || !isset($_SESSION['cargo'])){
        header('location: ../index.php');
    }else if($_SESSION['cargo']==1){
        header('location: home-gerente.php');
    }            
}
else{
    header('location: ./index.php');
}


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

<br>
<pre id="res"></pre>

<div class="card card-signin my-5">
    <div class="row" style="margin:3px">
        <div class ="col">
            <a href="../functions/home-empleado.php" class="float-left btn btn-primary btn-lg active" role="button" aria-pressed="true">Regresar</a>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title text-center">Egreso de estadia</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="" method="POST">
        <input type="hidden" name="key" value="<?= $url ?? ''?>">
            <div class="form-label-group">
            <p>Seleccione una patente: </p>
            <select name="PATENTE" id="patente" class="form-control select2" required>
                <?php include '../functions/todos-cliente-option-general.php'; ?>
                </select>
            </div>
            <button id="registro_estadia" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Marcar salida">Marcar salida</button>
        </form>
    </div>
</div>
<script>
    $('.select2').select2();
    $('form').submit(function (e) { 
        e.preventDefault();
        var dataForm = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo $url ?>",
            data: dataForm,
            success: function (response) {
                $('#body').html(response);
                activateTablesorter();
            }
        });
    });
</script>