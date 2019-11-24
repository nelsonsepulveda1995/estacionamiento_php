<?php
    if(isset($_SESSION)){    
        if(!isset($_SESSION['id_usuario']) || !isset($_SESSION['cargo'])){
            header('location: ../index.php');
        }else if($_SESSION['cargo']==2){
            header('location: home-empleado.php');
        }  
    }
    else{
        header('location: /../index.php');
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
    <br>
    <div class="row" style="margin:3px">
        <div class ="col">
            <a href="../functions/home-gerente.php" class="float-left btn btn-primary btn-lg active" role="button" aria-pressed="true">Regresar</a>
        </div>
    </div>
    <div class="card-body">
        <h1>Lista de empleados</h1><br><br>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
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
                            <input type="hidden" name="key" value="./../functions/editar-empleado.php">
                                <input type="hidden" name="editarEmpleado" value="<?=$empleado['ID_USUARIO']?>">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-user-edit"></i> Editar
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="./../functions/eliminar-empleado.php" method="post">
                            <input type="hidden" name="key" value="./../functions/eliminar-empleado.php">
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
<script>
    $('form').submit(function (e) { 
        e.preventDefault();
        var dataForm = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: dataForm,
            success: function (response) {
                $('#body').html(response);
                activateTablesorter();
            }
        });
    });
</script>