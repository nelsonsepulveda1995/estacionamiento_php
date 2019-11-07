<div class="container">
    <div class="row">
        <div class="md-col-8">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Cerrar Estadia</h5>
                    <form class="form-signin" action="" method="POST">
                        <div class="form-label-group">
                            <input type="text" id="nombre" name="estadia[PATENTE]" class="form-control" placeholder="Ingrese Patente del cliente" value="<?=$estadia['PATENTE'] ?? ''?>" required autofocus>
                            <label for="nombre">Ingrese Patente del cliente a cerrar estadia</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" id="boton_cerrar" type="submit" name="login">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>