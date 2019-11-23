<?php 
    function consultar_permiso($cargo,$permiso){
        include __DIR__ . '/../includes/connect.php';

        $query = $pdo->prepare('SELECT ID_PUESTO_PERMISO FROM puesto_permiso WHERE ID_PUESTO=:CARGO AND ID_PERMISO=:PERMISO');
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