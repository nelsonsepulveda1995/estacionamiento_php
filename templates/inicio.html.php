<?php
    if (isset($error)):
        echo    '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">'
                    . $error .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    endif;
?>
<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Iniciar Sesión</h5>
        <form class="form-signin" action="functions/login.php" method="post">
            <div class="form-label-group">
                <input type="text" id="email" name="usuario" class="form-control" placeholder="Ingrese nombre de usuario" required autofocus>
                <label for="email">Ingrese nombre de usuario</label>
            </div>
            <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese la contraseña" required>
                <label for="password">Ingrese contraseña</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Ingresar</button>
        </form>
    </div>
</div>
