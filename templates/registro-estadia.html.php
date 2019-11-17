<?php session_start(); ?>
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

<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Alta de estadia</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="" method="POST">
            <input type="hidden" name="" value=<?php echo $_SESSION['id_usuario'] ?>>  <!-- toma el usuario activo -->
            <div class="form-group">
                <input type="text" name="PATENTE" id="PATENTE" class="form-control">
                <label for="PATENTE">Ingrese la patente del cliente</label>
            </div>
            <div class="form-group">
                <select name="TIPO" id="tipo" class="form-control">
                    <option value="0">Seleccione el precio</option>
                    <?php include "precios-option.php"?>
                </select>
            </div>
            <button id="registro_estadia" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Registrar Estadia">Registrar Estadia</button>
            <pre id="res"></pre>
        </form>
    </div>
</div>