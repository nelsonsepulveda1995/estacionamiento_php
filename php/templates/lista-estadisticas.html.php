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
        <h1>Estadisticas</h1><br><br>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Total Diario</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pordia as $pordias): ?>
                    <tr>
                        <td>
                            <?=htmlspecialchars($pordias['TOTAL'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
