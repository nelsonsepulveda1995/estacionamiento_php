




<div class="card card-signin my-5">
    <br>
    <div class="row" style="margin:3px">
        <div class ="col">
            <a href="../functions/home-empleado.php" class="float-left btn btn-primary btn-lg active" role="button" aria-pressed="true"><i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
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
                <tfoot>
                    <tr>
                        <th colspan="7" class="ts-pager">
                            <div class="form-inline">
                            <div class="btn-group btn-group-sm mx-1" role="group">
                                <button type="button" class="btn btn-secondary first" title="first">⇤</button>
                                <button type="button" class="btn btn-secondary prev" title="previous">←</button>
                            </div>
                            <span class="pagedisplay"></span>
                            <div class="btn-group btn-group-sm mx-1" role="group">
                                <button type="button" class="btn btn-secondary next" title="next">→</button>
                                <button type="button" class="btn btn-secondary last" title="last">⇥</button>
                            </div>
                            <select class="form-control-sm custom-select px-1 pagesize" title="Select page size">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="all">All Rows</option>
                            </select>
                            <select class="form-control-sm custom-select px-4 mx-1 pagenum" title="Select page number"></select>
                            </div>
                        </th>   
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>