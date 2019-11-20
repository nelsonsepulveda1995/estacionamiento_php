<?php
    session_start();
    //si hay algún dato en POST significa que se completó el formulario
    if (isset($_POST['PATENTE'])) {
        include __DIR__ . '/../includes/connect.php';

        $patente = $_POST['PATENTE'];
        $fecha=date('Y-m-d H:i:s');
        $sql = 'INSERT INTO `historialpagos`(`PATENTE`, `ID_PRECIO`, `FECHA_PAGO`) VALUES (:PATENTE,2,:FECHA)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':PATENTE', $patente);
        $stmt->bindValue(':FECHA', $fecha);
        $stmt->execute();
        
        header('location: home-empleado.php');
    }
    else {
        //mostrar formulario
        $titulo = 'Crear abonado';
        ob_start();
        include __DIR__ . '/../templates/pago-abonado.html.php';
        $contenido = ob_get_clean();
        include __DIR__ . '/../templates/layout.html.php';
    }