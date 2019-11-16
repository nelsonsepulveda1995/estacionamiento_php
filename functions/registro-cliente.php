<?php
    session_start();
    //si hay algún dato en POST significa que se completó el formulario
    if (isset($_POST['PATENTE'])) {
        include __DIR__ . '/../includes/connect.php';

        $id = $_POST['TIPO'];
        $dni = $_POST['DNI'];
        $patente = $_POST['PATENTE'];

        $sql = "INSERT INTO `cliente`(`DNI`, `ID`, `PATENTE`) VALUES (:DNI,:ID,:PATENTE)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':DNI', $nombre);
        $stmt->bindValue(':ID', $id);
        $stmt->bindValue(':PATENTE', $patente);

        $stmt->execute();

        header('location: home-empleado.php');
    }
    else {
        //mostrar formulario
        $titulo = 'Alta de cliente';
        ob_start();
        include __DIR__ . '/../templates/registro-cliente.html.php';
        $contenido = ob_get_clean();
        include __DIR__ . '/../templates/layout.html.php';
    }
    