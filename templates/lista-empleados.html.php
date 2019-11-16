<div class="card card-signin my-5">
    <div class="card-body">
        <h1>Lista de empleados</h1><br><br>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
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
                            <?php $_SESSION['usuario-editar'] = $empleado['ID_USUARIO']; ?>
                            <a href="/gerente/empleados/agregar?ID_USUARIO=<?=$empleado['ID_USUARIO']?>">
                                <button type="button" class="btn btn-info">
                                    <i class="fas fa-user-edit"></i> Editar
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="/gerente/empleados/eliminar" method="post">
                                <input type="hidden" name="empleado[ID_USUARIO]" value="<?=$empleado['ID_USUARIO']?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
