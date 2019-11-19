<?php
    if(isset($_SESSION)){    
        if(!isset($_SESSION['id_usuario'])){
            header('location: ../index.php');
        }  
        if(!isset($_SESSION['cargo'])){
            header('location: ../index.php');
        }
        if($_SESSION['cargo']==2){
            header('location: home-empleado.php');
        }  
    }
    else{
        header('location: /../index.php');
    }
    
?>


<div class="card card-signin my-5">
    <div class="card-body">
        <h1>Lista de empleados</h1><br><br>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Editar</th>
                        <th>Deshabilitar</th>
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
                            <?=htmlspecialchars($empleado['CARGO'], ENT_QUOTES, 'UTF-8')?>
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
