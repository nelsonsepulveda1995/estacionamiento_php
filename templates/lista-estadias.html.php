<div class="card card-signin my-5">
    <div class="card-body">
        <h1>Lista de Estadias</h1><br><br>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>PATENTE</th>
                        <th>PRECIO</th>
                        <th>USUARIO QUE GENERO INGRESO</th>
                        <th>FECHA INGRESO</th>
                        <th>FECHA EGRESO</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($estadias as $estadia): ?>
                    <tr>
                        <td>
                            <?=htmlspecialchars($estadia['PATENTE'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($estadia['PRECIO'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($estadia['USUARIO'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($estadia['INGRESO'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($estadia['EGRESO'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($estadia['TOTAL'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>