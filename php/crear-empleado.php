<?php session_start() ?>

<?php
    if(!isset($_SESSION)){
        header("Location:./login.php");
    }
    else{
        if($_SESSION['tipo_usuario'] == 2){
            header("Location:./home-empleado.php");
        }
    }
    include "included/head.php";
?>


<div class="row">
    <div class="col-md-8 mx-auto text-center">
        <form class="form-signin" action="" method="POST">
            <div class="form-label-group">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Nombre del nuevo usuario" required autofocus>
            </div>
            <div class="form-group">
                <select name="id" class="form-control" require> <!--Agregar los tipos de usuarios-->
                    <option value="0">Seleccione el tipo de Usuario</option> 
                </select>
            </div>
            <div class="form-label-group">
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese patente del cliente" required >
                <label for="patente">Ingrese patente del cliente</label>
            </div>
            <div class="form-label-group">
                <input type="text" id="password" name="password" class="form-control" placeholder="Ingrese patente del cliente" required >
                <label for="patente">Ingrese patente del cliente</label>
            </div>
            <input id="boton_crear_usuario" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Crear usuario">
        </form>
    </div>
</div>

<?php
    include "included/fooder.php";
?>