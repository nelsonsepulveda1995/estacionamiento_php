

<?php
    if(isset($_SESSION)){  
        if(!isset($_SESSION['id_usuario'])){
            header('location: ../index.php');
        }  
        if(!isset($_SESSION['cargo'])){
            header('location: ../index.php');
        }
        if($_SESSION['cargo']==1){
            header('location: home-gerente.php');
        }            
  
    }
    else{
        header('location: ./index.php');
    }
?>

<?php
if (isset($_SESSION['faltan_datos'])):
    echo    '<div class="alert alert-danger alert-dismissible fade show mt-5 text-center" role="alert">'
                . $_SESSION['faltan_datos'] .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    unset($_SESSION['faltan_datos']);
endif;
if (isset($_SESSION['success'])):
    echo    '<div class="alert alert-success alert-dismissible fade show mt-5 text-center" role="alert">'
                . $_SESSION['success'] .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    unset($_SESSION['success']);
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
        <h5 class="card-title text-center">Alta de Cliente</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="<?= $url ?? ''?>" method="POST">
        <input type="hidden" name="key" value="<?= $url ?? ''?>">
        <input type="hidden" name="ID" value="<?=$id ?? ''?>">
            <div class="form-label-group">
                <input type="text" name="PATENTE" id="patente" class="form-control" pattern="([a-zA-Z]{2})(\d{3})([a-zA-Z]{2})|([a-zA-Z]{3})(\d{3})" title="Los formatos admitidos son AA000AA y AAA000" value="<?=$cliente['PATENTE'] ?? ''?>" required placeholder="Ingrese la patente del cliente">
                <label for="patente">Ingrese la patente del cliente</label>
            </div>
            <div class="form-label-group">
                <input type="number" id="dni" name="DNI" placeholder="Ingrese número de documento" value="<?=$cliente['DNI'] ?? ''?>" required min=10000000 max=9999999999 class="form-control">
                <label for="dni">Ingrese número de documento</label>
            </div>
            <div class="form-label-group">
                <select name="TIPO" id="tipo" class="form-control" required>
                    <option value="0" <?= isset($cliente) ? $cliente['ID'] == 0 ? "selected" : '' : ''?>>Seleccione un tipo de cliente</option>
                    <option value="1" <?= isset($cliente) ? $cliente['ID'] == 1 ? "selected" : '' : ''?>>Abonado</option>
                    <option value="2" <?= isset($cliente) ? $cliente['ID'] == 2 ? "selected" : '' : ''?>>No Abonado</option>
                </select>
            </div>
            <?php if(!isset($cliente)):?>
                <button id="registro_cliente" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Crear abonado">Crear cliente</button>
            <?php else : ?>
                <button id="registro_cliente" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Crear abonado">Editar Cliente</button>
            <?php endif ;?>
        </form>
    </div>
</div>

<script>
    $('form').submit(function (e) { 
        $('.alert').remove();
        e.preventDefault();
        var dataForm = $(this).serialize();
        var url = $(this).attr('action');
        if (registro_cliente()){
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