<?php session_start() ?>

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
    <div class="col-md-8 mx-auto text-center">
        <table class="table">   <!-- cargar lista de empleados-->
            <thead id="thead"></thead>
            <tbody id="tbody"></tbody>
        </table>
    </div>
</div>

<?php
    include "included/fooder.php";
?>