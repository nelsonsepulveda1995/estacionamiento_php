<?php session_start() ?>

<?php
    if(isset($_SESSION)){  
        if(!isset($_SESSION['id_usuario'])){
            header('location: ../index.php');
        }  
        if(!isset($_SESSION['cargo'])){
            header('location: ../index.php');
        }
        if($_SESSION['cargo']==1){
            header('location: home-gerente.php');
        }            
  
    }
    else{
        header('location: ./index.php');
    }
?>

<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Bienvenido al sistema, Empleado</h5>
    </div>
</div>