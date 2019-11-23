<?php
    session_start();
    //si hay algún dato en POST significa que se completó el formulario
    if (isset($_POST['PATENTE'])) {
        include __DIR__ . '/../includes/connect.php';

        $patente = $_POST['PATENTE'];

        $sql = 'UPDATE `cliente` SET `ID`= 1 WHERE `PATENTE`=:PATENTE';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':PATENTE', $patente);
        $stmt->execute();
        
        header('location: home-empleado.php');
    }
    else {
        //mostrar formulario
        $titulo = 'Crear abonado';
        ob_start();
        include __DIR__ . '/../templates/registro-abonado.html.php';
        $contenido = ob_get_clean();
        include __DIR__ . '/../templates/layout.html.php';
    }