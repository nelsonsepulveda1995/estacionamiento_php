<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 7)){
            include __DIR__ . '/../includes/connect.php';
            //GANACIA POR DIA
                
            $sql = "SELECT LEFT(`INGRESO`,10) AS FECHA , SUM(`TOTAL`) AS 'TOTAL POR DIA' FROM `estadia` GROUP BY LEFT(`INGRESO`,10)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pordia = $stmt->fetchAll();
                
            //GANANCIA POR MES
            $sql = "SELECT LEFT(`INGRESO`,7) AS FECHA , SUM(`TOTAL`) AS 'TOTAL POR MES' FROM `estadia` GROUP BY LEFT(`INGRESO`,7)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pormes = $stmt->fetchAll();
                
            //GANANCIA POR AÑO
            $sql = "SELECT LEFT(`INGRESO`,4) AS FECHA , SUM(`TOTAL`) AS 'TOTAL POR AÑO' FROM `estadia` GROUP BY LEFT(`INGRESO`,4)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $foryear = $stmt->fetchAll();
                
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
            
            //PROMEDIO DE CLIENTES  
            
            $sql = "SELECT LEFT(INGRESO,10) AS FECHA, COUNT(`ID_ESTADIA`) AS TOTAL FROM `estadia` GROUP BY LEFT(`INGRESO`,10);";
            $stmt = $pdo->query($sql);
            $stmt->execute();
            $clientes_por_dia = $stmt->fetchAll();

            $sql = "SELECT LEFT(INGRESO,7) AS FECHA, COUNT(`ID_ESTADIA`) AS TOTAL FROM `estadia` GROUP BY LEFT(`INGRESO`,7);";
            $stmt = $pdo->query($sql);
            $stmt->execute();
            $clientes_por_mes = $stmt->fetchAll();
            // --------------- CARGA DE PANTALLA ------------------------
                
            $titulo = 'Estadisticas';
            ob_start();
            include __DIR__ . '/../templates/lista-estadisticas.html.php';
            $contenido = ob_get_clean();
            print_r($contenido);
        }
        else {
            $_SESSION['error'] = 'No posee permisos para realizar esa acción';
            ob_start();
            include __DIR__ . '/../templates/home-empleado.html.php';
            $contenido = ob_get_clean();
            print_r($contenido);
        }
    }
    else {
        $_SESSION['error'] = 'No se encontró una sesión para ingresar a la URL';
        ob_start();
        include __DIR__ . '/../index.php';
        $contenido = ob_get_clean();
        print_r($contenido);
    }   