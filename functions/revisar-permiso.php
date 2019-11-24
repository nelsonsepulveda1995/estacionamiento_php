<?php 
    if (!function_exists("consultar_permiso")) {
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
    }

    function estadisticas_dia(){
        include __DIR__ . '/../includes/connect.php';
        $sql = "SELECT LEFT(INGRESO,10) AS FECHA, COUNT(`ID_ESTADIA`) AS TOTAL FROM `estadia` GROUP BY LEFT(`INGRESO`,10);";
        $stmt = $pdo->query($sql);
        $stmt->execute();
    }

    function estadisticas_mes(){
        include __DIR__ . '/../includes/connect.php';
        $sql = "SELECT LEFT(INGRESO,7) AS FECHA, COUNT(`ID_ESTADIA`) AS TOTAL FROM `estadia` GROUP BY LEFT(`INGRESO`,7);";
        $stmt = $pdo->query($sql);
        $stmt->execute();
    }   

    function estadisticas_año(){
        include __DIR__ . '/../includes/connect.php';
        $sql = "SELECT LEFT(INGRESO,4) AS FECHA, COUNT(`ID_ESTADIA`) AS TOTAL FROM `estadia` GROUP BY LEFT(`INGRESO`,4);";
        $stmt = $pdo->query($sql);
        $stmt->execute();
    }