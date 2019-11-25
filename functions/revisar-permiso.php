<?php 
    if (!function_exists("consultar_permiso") && !function_exists("prom_clientes") && !function_exists("prom_ganancias")) {
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
        function prom_clientes(){
            include __DIR__ . '/../includes/connect.php';
            $sql = "SELECT LEFT(`FECHA`,:lim) AS FECHA, COUNT(`CANTIDAD DE CLIENTES`) AS `TOTAL` FROM (SELECT LEFT(`INGRESO`,:lim) AS FECHA , COUNT(`ID_ESTADIA`) AS 'CANTIDAD DE CLIENTES' FROM `estadia` GROUP BY LEFT(`INGRESO`,:lim) UNION ALL SELECT LEFT(`FECHA_PAGO`,:lim), COUNT(`ID_PAGOMENSUAL`) FROM `historialpagos` GROUP BY LEFT(`FECHA_PAGO`,:lim)) T GROUP BY LEFT(`FECHA`,:lim) ORDER BY FECHA DESC";
            $stmt = $pdo->prepare($sql);
            return $stmt;
        }   
        function prom_ganancia(){
            include __DIR__ . '/../includes/connect.php';
            $sql = "SELECT LEFT(`FECHA`,:lim) AS FECHA , SUM(`CANTIDAD TOTAL`) AS `TOTAL` FROM ( SELECT LEFT(`INGRESO`,:lim) AS FECHA , SUM(`TOTAL`) AS 'CANTIDAD TOTAL' FROM `estadia` GROUP BY LEFT(`INGRESO`,:lim) UNION ALL SELECT LEFT(`FECHA_PAGO`,:lim), precio.PRECIO FROM historialpagos INNER JOIN precio ON historialpagos.ID_PRECIO = precio.ID_PRECIO ) T GROUP BY LEFT(`FECHA`,:lim) ORDER BY FECHA DESC";
            $stmt = $pdo->prepare($sql);
            return $stmt;
        }
    }
