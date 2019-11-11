<div class="container">
    <div class="row">
        <div class="md-col-8">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Crear Estadia</h5>
                    <form class="form-signin" action="" method="POST">
                        <div class="form-label-group">
                            <input type="text" id="patente" name="patente" class="form-control" placeholder="Ingrese Patente del cliente" value="<?=$estadia['PATENTE'] ?? ''?>" required autofocus>
                            <label for="nombre">Ingrese Patente del cliente</label>
                        </div>
                        <input class="btn btn-lg btn-primary btn-block text-uppercase" id="boton_crear_estadia" type="submit" value="Crear Estadia">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>