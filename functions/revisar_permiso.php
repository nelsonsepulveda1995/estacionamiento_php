<?php 
    require("included/connect.php");

    function crear_usuario($cargo,$permiso){

        $query = $pdo->prepare('SELECT `ID_PERMISO`FROM `puesto_permiso`WHERE puesto_permiso.ID_PERMISO=:PERMISO AND ID_PUESTO=:CARGO');
        $query->bindValue(':CARGO', $cargo);
        $query->bindValue(':PERMISO', $permiso);
        $query->execute();
        $resultado = $query->fetch(); //el resultado de la consulta se guarda dentro de la variable
        $cantidadFilas = $query->rowCount(); //cuenta la cantidad de filas que se obtuvo
        if($cantidadFilas>0){
            return true;
        }
        else{
            return false;
        }

    }