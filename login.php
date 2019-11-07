<?php require 'included/head.php'?>

<div class="row">
    <div class="col-md-6 mx-auto">
    <?php
        if (isset($error)):
            echo    '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">'
                        . $error .
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        endif;

        //si ya existe una sesion activa redirige automaticamente (o deberia :P )
        if (isset($_SESSION)):
            if(!isset($_SESSION['tipo_usuario'])):
                if($_SESSION['tipo_usuario']==1){
                    header("Location:./home-gerente.php");
                }
                if($_SESSION['tipo_usuario']==1){
                    header("Location:./home-empleado.php");
                }
            endif;
        endif;
    ?>
        <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Iniciar Sesión</h5>
                <form class="form-signin" action="estacionamiento_php/funciones/login.php" method="POST">
                    <div class="form-label-group">
                        <input type="text" id="email" name="usuario" class="form-control" placeholder="Ingrese nombre de usuario" required autofocus>
                    </div>
                    <br>
                    <div class="form-label-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese la contraseña" required>
                    </div>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login">Ingresar</button>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>

<?php include 'included/fooder.php'?>