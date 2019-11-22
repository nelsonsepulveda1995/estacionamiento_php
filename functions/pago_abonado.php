<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }
    //si hay algún dato en POST significa que se completó el formulario
    if (isset($_POST['PATENTE'])) {
        try {
            include __DIR__ . '/../includes/connect.php';

            $patente = $_POST['PATENTE'];
            $sql = 'SELECT FECHA_PAGO FROM historialpagos WHERE PATENTE = :PATENTE ORDER BY FECHA_PAGO DESC';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':PATENTE', $patente);
            $stmt->execute();
            $fechaPago = $stmt->fetch();
            $fecha=date('Y-m-d H:i:s');
            if ($fechaPago != '') {
                $fechaPago = new DateTime($fechaPago['FECHA_PAGO']);
                $fechaActual = new DateTime($fecha);
                $intervalo = $fechaPago->diff($fechaActual);
                if (isset($intervalo) && $intervalo->m > 0) {
                    $sql = 'INSERT INTO `historialpagos`(`PATENTE`, `ID_PRECIO`, `FECHA_PAGO`) VALUES (:PATENTE,2,:FECHA)';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':PATENTE', $patente);
                    $stmt->bindValue(':FECHA', $fecha);
                    $stmt->execute();
                    $_SESSION['success'] = 'Pago registrado exitosamente.';
                    ob_start();
                    include __DIR__ . '/../templates/pago-abonado.html.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }else{
                    $_SESSION['error'] = 'La patente '.$patente.' registra un último pago hace menos de 1 (un) mes.';
                    ob_start();
                    include __DIR__ . '/../templates/pago-abonado.html.php';
                    $contenido = ob_get_clean();
                    print_r($intervalo->m);
                }
            }else{
                $sql = 'INSERT INTO `historialpagos`(`PATENTE`, `ID_PRECIO`, `FECHA_PAGO`) VALUES (:PATENTE,2,:FECHA)';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':PATENTE', $patente);
                $stmt->bindValue(':FECHA', $fecha);
                $stmt->execute();
                $_SESSION['success'] = 'Pago registrado exitosamente.';
                ob_start();
                include __DIR__ . '/../templates/pago-abonado.html.php';
                $contenido = ob_get_clean();
                print_r($contenido);
            }
            
        } catch (PDOEXCEPTION $e) {
            $_SESSION['error'] = 'Ha ocurrido un error en el registro. Intentelo denuevo más tarde.';
            ob_start();
            include __DIR__ . '/../templates/pago-abonado.html.php';
            $contenido = ob_get_clean();
            print_r($contenido);
        }
    }
    else {
        //mostrar formulario
        $titulo = 'Crear abonado';
        ob_start();
        include __DIR__ . '/../templates/pago-abonado.html.php';
        $contenido = ob_get_clean();
        print_r($contenido);
    }