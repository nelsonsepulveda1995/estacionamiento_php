﻿<?php session_start() ?>

<?php
    if(isset($_SESSION)){    
        if(!isset($_SESSION['id_usuario'])){
            header('location: ../index.php');
        }  
        if(!isset($_SESSION['cargo'])){
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
?>
<pre></pre>
<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Alta de empleado</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="" method="POST">
            <input type="hidden" name="ID_USUARIO" value="<?=$empleado['ID_USUARIO'] ?? ''?>">
            <div class="form-label-group">
                <input type="text" id="nombre" name="NOMBRE" class="form-control" placeholder="Ingrese nombre de empleado" value="<?=$empleado['NOMBRE'] ?? ''?>" required autofocus>
                <label for="nombre">Ingrese nombre de empleado</label>
            </div>
            <div class="form-group">
                <select name="ID" id="ID" class="form-control" require>
                    <option value="0">Seleccione el cargo correspondiente</option>
                    <option value="1">Gerente</option>
                    <option value="2">Cajero</option>
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
            <pre id="res"></pre>
        </form>
    </div>
</div>