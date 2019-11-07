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
                <form class="form-signin" action="" method="POST">
                    <!--<input type="hidden" name="cliente[DNI]" value="<?=$cliente['DNI'] ?? '' ?>">-->
                    <div class="form-label-group">
                        <input type="text" id="dni" name="cliente[DNI]" class="form-control" placeholder="Ingrese DNI del cliente" value="<?=$cliente['DNI'] ?? ''?>" required autofocus>
                        <label for="dni">Ingrese DNI del cliente</label>
                    </div>
                    <div class="form-group">
                        <select name="cliente[ID]" class="form-control">
                            <option value="0">Seleccione el tipo de cliente</option>
                            <option value="1">Abonado</option>
                            <option value="2">No abonado</option>
                        </select>
                    </div>
                    <div class="form-label-group">
                        <input type="text" id="patente" name="cliente[PATENTE]" class="form-control" placeholder="Ingrese patente del cliente" value="<?=$cliente['PATENTE'] ?? ''?>" required autofocus>
                        <label for="patente">Ingrese patente del cliente</label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Register account">Agregar cliente</button>
                </form>
            </div>
        </div>
    </div>
</form>