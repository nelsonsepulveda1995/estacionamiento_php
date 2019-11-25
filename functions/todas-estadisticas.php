<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 7)){
            include __DIR__ . '/../includes/connect.php';

            //GANACIA POR DIA
            $sql = "SELECT LEFT(`FECHA`,10) AS FECHA , SUM(`TOTAL POR DIA`) AS `TOTAL POR DIA` FROM ( SELECT LEFT(`INGRESO`,10) AS FECHA , SUM(`TOTAL`) AS 'TOTAL POR DIA' FROM `estadia` GROUP BY LEFT(`INGRESO`,10) UNION ALL SELECT LEFT(`FECHA_PAGO`,10), precio.PRECIO FROM historialpagos INNER JOIN precio ON historialpagos.ID_PRECIO = precio.ID_PRECIO ) T GROUP BY LEFT(`FECHA`,10)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pordia = $stmt->fetchAll();
                
            //GANANCIA POR MES
            $sql = "SELECT LEFT(`FECHA`,7) AS FECHA , SUM(`TOTAL POR MES`) AS `TOTAL POR MES` FROM ( SELECT LEFT(`INGRESO`,7) AS FECHA , SUM(`TOTAL`) AS 'TOTAL POR MES' FROM `estadia` GROUP BY LEFT(`INGRESO`,7) UNION ALL SELECT LEFT(`FECHA_PAGO`,7), precio.PRECIO FROM historialpagos INNER JOIN precio ON historialpagos.ID_PRECIO = precio.ID_PRECIO ) T GROUP BY LEFT(`FECHA`,7)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pormes = $stmt->fetchAll();
                
            //GANANCIA POR AÑO
            $sql = "SELECT LEFT(`FECHA`,4) AS FECHA , SUM(`TOTAL POR AÑO`) AS `TOTAL POR AÑO` FROM ( SELECT LEFT(`INGRESO`,4) AS FECHA , SUM(`TOTAL`) AS 'TOTAL POR AÑO' FROM `estadia` GROUP BY LEFT(`INGRESO`,4) UNION ALL SELECT LEFT(`FECHA_PAGO`,4), precio.PRECIO FROM historialpagos INNER JOIN precio ON historialpagos.ID_PRECIO = precio.ID_PRECIO ) T GROUP BY LEFT(`FECHA`,4)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $foryear = $stmt->fetchAll();

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
            $sql = "SELECT `tipo`.`DESCRIPCION`,SUM( cliente.`ID`) AS CANTIDAD FROM `cliente` LEFT JOIN `tipo` ON `cliente`.`ID` = `tipo`.`ID`GROUP BY cliente.ID;";
            $stmt = $pdo->query($sql);
            $stmt->execute();
            $cliente = $stmt->fetchAll();
            
            //CANTIDAD DE CLIENTES POR DIA
            estadisticas_dia();
            $length = $stmt->rowCount();
            $clientes_por_dia = $stmt->fetchAll();

            //PROMEDIO DE CLIENTES POR DIA
            estadisticas_dia();
            $length = $stmt->rowCount();
            $totalDia = 0;
            while ($promedio = $stmt->fetch()) {
                $totalDia += $promedio['TOTAL'];
            }
            $totalDia = floor($totalDia/$length);

            //CANTIDAD DE CLIENTES POR MES
            estadisticas_mes();
            $clientes_por_mes = $stmt->fetchAll();

            //PROMEDIO DE CLIENTES POR MES
            estadisticas_mes();
            $length = $stmt->rowCount();
            $totalMes = 0;
            while ($promedio = $stmt->fetch()) {
                $totalMes += $promedio['TOTAL'];
            }
            $totalMes = floor($totalMes/$length);

            //CANTIDAD DE CLIENTES POR AÑO
            estadisticas_año();
            $clientes_por_year = $stmt->fetchAll();

            //PROMEDIO DE CLIENTES POR AÑO
            estadisticas_año();
            $length = $stmt->rowCount();
            $totalYear = 0;
            while ($promedio = $stmt->fetch()) {
                $totalYear += $promedio['TOTAL'];
            }
            $totalYear = floor($totalYear/$length);

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