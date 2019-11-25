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
        <h5 class="card-title text-center">Bienvenido al sistema, Empleado</h5>
        <hr class="my-4">
        <div class="my-2">
            <div>
                <br>
                <h1>Patentes pendientes de egreso</h1><br>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Patente</th>
                                        <th>Nombre de Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($row)): ?>
                                    <?php foreach ($row as $rows): ?>
                                        <tr>
                                            <td>
                                                <?=htmlspecialchars($rows['PATENTE'], ENT_QUOTES, 'UTF-8')?>
                                            </td>
                                            <td>
                                                <?=htmlspecialchars($rows['NOMBRE_CLIENTE'], ENT_QUOTES, 'UTF-8')?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else:?>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            No se encontraron patentes pendientes de egreso
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