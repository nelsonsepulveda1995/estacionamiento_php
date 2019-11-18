<div class="card card-signin my-5">
    <div class="card-body">
        <h1>Lista de empleados</h1><br><br>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Editar</th>
                        <th>Desabilitar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <td>
                            <?=htmlspecialchars($empleado['ID_USUARIO'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($empleado['NOMBRE'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <form action="./../functions/editar-empleado.php" method="post">
                                <input type="hidden" name="editarEmpleado" value="<?=$empleado['ID_USUARIO']?>">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-user-edit"></i> Editar
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="./../functions/eliminar-empleado.php" method="post">
                                <input type="hidden" name="eliminarEmpleado" value="<?=$empleado['ID_USUARIO']?>">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-user-times"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
