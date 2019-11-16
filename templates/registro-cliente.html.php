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
        <h5 class="card-title text-center">Alta de Cliente</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="" method="POST">
            <div class="form-group">
                <input type="text" name="PATENTE" id="PATENTE" class="form-control">
                <label for="PATENTE">Ingrese la patente del cliente</label>
            </div>
            <div class="form-group">
                <input type="text" name="DNI" id="DNI" class="form-control">
                <label for="DNI">Ingrese</label>
            </div>
            <div class="form-control">
                <select name="TIPO" id="" class="form-control">
                    <option value="0">Seleccione un tipo de cliente</option>
                    <option value="1">Abonado</option>
                    <option value="2">No abonado</option>
                </select>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Crear abonado">Crear cliente</button>
        </form>
    </div>
</div>