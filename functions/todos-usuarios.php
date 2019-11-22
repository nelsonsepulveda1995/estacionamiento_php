<?php
    session_start();

    include __DIR__ . '/../includes/connect.php';

    $sql = 'SELECT ID_USUARIO, DESCRIPCION AS CARGO, NOMBRE, USUARIO, PASSWORD FROM usuarios INNER JOIN puesto WHERE ESTADO = 1 AND usuarios.ID = puesto.ID';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $empleados = $stmt->fetchAll();

    $titulo = 'Lista de empleados';
    ob_start();
    include __DIR__ . '/../templates/lista-empleados.html.php';
    $contenido = ob_get_clean();
    print_r($contenido);