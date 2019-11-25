<?php 
    if (!isset($_SESSION)) {
        session_start();
    }  
?>


<?php
    if (isset($_SESSION['error'])):
        echo    '<div class="alert alert-danger alert-dismissible fade show mt-5 text-center" role="alert">'
                    . $_SESSION['error'] .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        unset($_SESSION['error']);
    endif;
?>


<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Bienvenido al sistema, <?=$_SESSION['nombre']?></h5>
        <hr class="my-4">
        <div class="my-2">
            <div>
                <br>
                <h1>Ganancias del día</h1><br>

                <div class="row">
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Ganancias de hoy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($pordia['TOTAL'])): ?>
                                    <tr>
                                        <td>
                                            <?=htmlspecialchars($pordia['FECHA'] ?? '', ENT_QUOTES, 'UTF-8')?>
                                        </td>
                                
                                        <td>
                                            <?=htmlspecialchars(("$" .$pordia['TOTAL'] ?? 'No se encontraron ingresos monetarios'), ENT_QUOTES, 'UTF-8')?>
                                        </td>
                                    </tr>
                                <?php else:?>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            No se encontraron ingresos monetarios
                                        </td>
                                    </tr>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Cantidad de clientes de hoy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($clientes_por_dia['FECHA'])): ?>
                                    <tr>
                                        <td>
                                            <?=htmlspecialchars($clientes_por_dia['FECHA'] , ENT_QUOTES, 'UTF-8')?>
                                        </td>
                                        <td>
                                            <?=htmlspecialchars($clientes_por_dia['TOTAL'] , ENT_QUOTES, 'UTF-8')?>
                                        </td>
                                    </tr>
                                <?php else:?>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            No se registraron clientes
                                        </td>
                                    </tr>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>