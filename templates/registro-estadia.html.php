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
?>

<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Alta de estadia</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="" method="POST">
            <input type="hidden" name="ID_USUARIO" value="<?=$_SESSION['id_usuario']?>">  <!-- toma el usuario activo -->
            <div class="form-label-group">
                <input type="text" name="PATENTE" placeholder="Ingrese la patente del cliente" id="PATENTE" class="form-control">
                <label for="PATENTE">Ingrese la patente del cliente</label>
            </div>
            <div class="form-label-group">
                <select name="PRECIO" id="tipo" class="form-control">
                    <option value="0">Seleccione el precio</option>
                    <!--Cargar por AJAX las opciones, por ahora están hardcodeadas-->
                    <option value="1">Hora</option>
                    <option value="2">Día</option>
                    <option value="3">Abonado</option>
                </select>
            </div>
            <button id="registro_estadia" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Registrar Estadia">Registrar Estadia</button>
            <pre id="res"></pre>
        </form>
    </div>
</div>