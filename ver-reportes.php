<?php
    if(!isset($_SESSION)){
        header("Location:./login.php");
    }
    else{
        if($_SESSION['tipo_usuario'] == 2){
            header("Location:./home-empleado.php");
        }
    }
    include "included/head.php";
?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">      <!-- colocar los reportes -->
            <section>
                
            </section>
        </div>
        <div class="col-md-4">
            <section>
                
            </section>
        </div>
        <div class="col-md-4">
            <section>
                
            </section>
        </div>
    </div>
</div>

<?php
    include "included/fooder.php";
?>
