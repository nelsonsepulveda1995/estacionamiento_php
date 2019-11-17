<?php session_start() ?>

<?php
    if(isset($_SESSION)){
        if(isset($_SESSION['cargo'])){
            if($_SESSION['cargo']==1){
                header("location:  ./functions/home-gerente.php");
            }
            if($_SESSION['cargo']==2){
                header("location: ./functions/home-empleado.php");
            }
        }
    }

    if (isset($_SESSION['mensaje'])):
        echo    '<div class="alert alert-danger alert-dismissible fade show mt-5 text-center" role="alert">'
                    . $_SESSION['mensaje'] .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        unset($_SESSION['mensaje']);
    endif;
?>
<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Iniciar Sesión</h5>
        <form id="loginForm" class="form-signin" action="./functions/login.php" method="POST">
            <div class="form-label-group">
                <input type="text" id="email" name="usuario" class="form-control" placeholder="Ingrese nombre de usuario" max=50 min=1 required autofocus>
                <label for="email">Ingrese nombre de usuario</label>
            </div>
            <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" max=50 min=1 placeholder="Ingrese la contraseña" required>
                <label for="password">Ingrese contraseña</label>
            </div>
            <button id="ingresar" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Ingresar</button>
            <pre id="res"></pre>
        </form>
    </div>
</div>
