<?php
    if(isset($_SESSION)){    
        if(!isset($_SESSION['id_usuario']) || !isset($_SESSION['cargo'])){
            header('location: ../index.php');
        }
        if($_SESSION['cargo']==2){
            header('location: home-empleado.php');
        }  
    }
    else{
        header('location: /../index.php');
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
            <a href="../functions/home-gerente.php" class="float-left btn btn-primary btn-lg active" role="button" aria-pressed="true">Regresar</a>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title text-center">Alta de empleado</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="<?= $url ?? ''?>" method="POST">
            <input type="hidden" name="key" value="<?= $url ?? ''?>">
            <input type="hidden" name="ID_USUARIO" value="<?=$empleado['ID_USUARIO'] ?? ''?>">
            <div class="form-label-group">
                <input type="text" id="nombre" name="NOMBRE" class="form-control" placeholder="Ingrese nombre de empleado" value="<?=$empleado['NOMBRE'] ?? ''?>" required autofocus>
                <label for="nombre">Ingrese nombre de empleado</label>
            </div>
            <div class="form-group">
                <select name="ID" id="ID" class="form-control" require>
                    <option value="0" <?= isset($empleado) ? $empleado['ID'] == 0 ? "selected" : '' : ''?>>Seleccione el cargo correspondiente</option>
                    <option value="1" <?= isset($empleado) ? $empleado['ID'] == 1 ? "selected" : '' : ''?>>Gerente</option>
                    <option value="2" <?= isset($empleado) ? $empleado['ID'] == 2 ? "selected" : '' : ''?>>Cajero</option>
                </select>
            </div>
            <div class="form-label-group">
                <input type="text" id="usuario" name="USUARIO" class="form-control" placeholder="Ingrese nombre de usuario" value="<?=$empleado['USUARIO'] ?? ''?>" required autofocus>
                <label for="usuario">Ingrese nombre de usuario</label>
            </div>
            <div class="form-label-group">
                <input type="password" id="password" name="PASSWORD" class="form-control" placeholder="Ingrese contraseña" value="<?=$empleado['PASSWORD'] ?? ''?>" required>
                <label for="password">Ingrese contraseña</label>
            </div>
            <button id="registro_empleado" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Register account">Ingresar</button>
            
        </form>
    </div>
</div>
<script>
    $('form').submit(function (e) { 
        $('.alert').remove();
        e.preventDefault();
        var dataForm = $(this).serialize();
        var url = $(this).attr('action');
        if (validarempleado()){
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