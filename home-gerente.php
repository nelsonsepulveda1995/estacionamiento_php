<?php
    if(!isset($_SESSION)){
        header("location:./login.php");
    }
    else{
        if($_SESSION['tipo_usuario'] == 2){
            header("location:./home-empleado.php");
        }
    }