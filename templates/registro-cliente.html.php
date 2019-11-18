<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Alta de Cliente</h5>
        <!--La respuesta del formulario se envia al mismo script-->
        <form class="form-signin" action="" method="POST">
            <div class="form-label-group">
                <input type="text" name="PATENTE" id="PATENTE" class="form-control" value="<?=$cliente['PATENTE'] ?? ''?>" placeholder="Ingrese la patente del cliente">
                <label for="PATENTE">Ingrese la patente del cliente</label>
            </div>
            <div class="form-label-group">
                <input type="text" name="DNI" placeholder="Ingrese número de documento" value="<?=$cliente['DNI'] ?? ''?>" id="DNI" minlength=8 maxlength=10 class="form-control">
                <label for="DNI">Ingrese número de documento</label>
            </div>
            <div class="form-label-group">
                <select name="TIPO" id="tipo" class="form-control">
                    <option value="0">Seleccione un tipo de cliente</option>
                    <option value="1">Abonado</option>
                    <option value="2">No abonado</option>
                </select>
            </div>
            <button id="registro_cliente" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Crear abonado">Crear cliente</button>
            <pre id="res"></pre>
        </form>
    </div>
</div>