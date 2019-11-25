<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 7)){
            include __DIR__ . '/../includes/connect.php';

            //GANACIA POR DIA
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $pordia = $stmt->fetchAll();

            //PROMEDIO DE GANANCIA POR DIA
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $lengthDia = $stmt->rowCount();
            $totalGanDia = 0;
            while ($promedioDia = $stmt->fetch()) {
                $totalGanDia += $promedioDia['TOTAL'];
            }
            if ($lengthDia  > 0) {
                $totalGanDia = round($totalGanDia/$lengthDia);
            }
                
            //GANANCIA POR MES
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 7);
            $stmt->execute();
            $pormes = $stmt->fetchAll();

            //PROMEDIO DE GANANCIA POR MES
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 7);
            $stmt->execute();
            $lengthMes = $stmt->rowCount();
            $totalGanMes = 0;
            while ($promedioMes = $stmt->fetch()) {
                $totalGanMes += $promedioMes['TOTAL'];
            }
            if ($lengthMes  > 0) {
                $totalGanMes = round($totalGanMes/$lengthMes);
            }
                
            //GANANCIA POR AÑO
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 4);
            $stmt->execute();
            $foryear = $stmt->fetchAll();

            //PROMEDIO DE GANANCIA POR AÑO
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 4);
            $stmt->execute();
            $lengthYear = $stmt->rowCount();
            $totalGanYear = 0;
            while ($promedioYear = $stmt->fetch()) {
                $totalGanYear += $promedioYear['TOTAL'];
            }
            if ($lengthYear > 0) {
                $totalGanYear= round($totalGanYear/$lengthYear);
            }

            //GANANCIAS TOTALES
            $sql = "SELECT LEFT(`FECHA`,4) AS FECHA , SUM(`TOTAL POR AÑO`) AS `TOTAL` FROM ( SELECT LEFT(`INGRESO`,4) AS FECHA , SUM(`TOTAL`) AS 'TOTAL POR AÑO' FROM `estadia` GROUP BY LEFT(`INGRESO`,4) UNION ALL SELECT LEFT(`FECHA_PAGO`,4), precio.PRECIO FROM historialpagos INNER JOIN precio ON historialpagos.ID_PRECIO = precio.ID_PRECIO ) T GROUP BY LEFT(`FECHA`,4)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $gananciasTotales = 0;
            while ($everyY = $stmt->fetch()) {
                $gananciasTotales += $everyY['TOTAL'];
            }
                
            //LUGARES DISPONIBLES
            $sql = "SELECT `CANTIDAD` FROM `lugares` ";
            $stmt = $pdo->query($sql);
            $stmt->execute();
            $lugares_disponibles = $stmt->fetchAll();

            //TIPOS DE CLIENTES
            $sql = "SELECT `tipo`.`DESCRIPCION`,COUNT( cliente.`ID`) AS CANTIDAD FROM `cliente` LEFT JOIN `tipo` ON `cliente`.`ID` = `tipo`.`ID`GROUP BY cliente.ID";
            $stmt = $pdo->query($sql);
            $stmt->execute();
            $cliente = $stmt->fetchAll();

            //TOTAL CLIENTES
            $sql = "SELECT COUNT(*) AS TOTAL FROM `cliente`";
            $stmt = $pdo->query($sql);
            $stmt->execute();
            $cantCliente = $stmt->fetch();
            
            //CANTIDAD DE CLIENTES POR DIA
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $length = $stmt->rowCount();
            $clientes_por_dia = $stmt->fetchAll();

            //PROMEDIO DE CLIENTES POR DIA
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $length = $stmt->rowCount();
            $totalDia = 0;
            while ($promedio = $stmt->fetch()) {
                $totalDia += $promedio['TOTAL'];
            }
            if ($length>0) {
                $totalDia = floor($totalDia/$length);
            }
            
            //CANTIDAD DE CLIENTES POR MES
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 7);
            $stmt->execute();
            $clientes_por_mes = $stmt->fetchAll();

            //PROMEDIO DE CLIENTES POR MES
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 7);
            $stmt->execute();
            $length = $stmt->rowCount();
            $totalMes = 0;
            while ($promedio = $stmt->fetch()) {
                $totalMes += $promedio['TOTAL'];
            }
            if ($length>0) {
                $totalMes = floor($totalMes/$length);
            }

            //CANTIDAD DE CLIENTES POR AÑO
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 4);
            $stmt->execute();
            $clientes_por_year = $stmt->fetchAll();

            //PROMEDIO DE CLIENTES POR AÑO
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 4);
            $stmt->execute();
            $length = $stmt->rowCount();
            $totalYear = 0;
            while ($promedio = $stmt->fetch()) {
                $totalYear += $promedio['TOTAL'];
            }
            if ($length>0) {
                $totalYear = floor($totalYear/$length);
            }

            // --------------- CARGA DE PANTALLA ------------------------
                
            $titulo = 'Estadisticas';
            ob_start();
            include __DIR__ . '/../templates/lista-estadisticas.html.php';
            $contenido = ob_get_clean();
            print_r($contenido);
        }
        else {
            $_SESSION['error'] = 'No posee permisos para realizar esa acción';
            header('location: ../index.php');
        }
    }
 	else {
        $_SESSION['mensaje'] = 'No se encontró una sesión para ingresar a la URL';
        header('location: ../index.php');
    }