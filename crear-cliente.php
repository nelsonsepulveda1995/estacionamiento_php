<?php session_start() ?>

<div class="row">
    <div class="col-md-6 mx-auto">
    <?php
if (!empty($errors)) :
    ?>
    <div class="errors">
        <p>El cliente no pudo ser creado debido a:</p>
        <ul>
        <?php
            foreach ($errors as $error) :
                ?>
                <li><?= $error ?></li>
                <?php
            endforeach; ?>
        </ul>
    </div>
<?php endif;?>
        <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Alta de cliente</h5>
                <form class="form-signin" action="">
                    <div class="form-label-group">
                        <input type="text" id="patente" name="patente" class="form-control" placeholder="Ingrese patente del cliente" required autofocus>
                        <label for="dni">Ingrese DNI del cliente</label>
                    </div>
                    <div class="form-label-group">
                        <input type="text" id="dni" name="dni" class="form-control" placeholder="Ingrese DNI del cliente" required >
                        <label for="dni">Ingrese DNI del cliente</label>
                    </div>
                    <input id="boton_crear_cliente" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Crear usuario">
                </form>
            </div>
        </div>
    </div>
</form>


