<?php session_start() ?>

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

<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Alta de abonado</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="" method="POST">
            <div class="form-group">
                <select name="PATENTE" id="patente" class="form-control" require>
                    <option value="0">Seleccione el Clinte</option>
                    <?php include "./functions/todos-cliente-option-no-abonado.php" ?>
                </select>
            </div>
            
            <button id="registrar_abonado" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Crear abonado">Crear abonado</button>
            <pre id="res"></pre>
        </form>
    </div>
</div>