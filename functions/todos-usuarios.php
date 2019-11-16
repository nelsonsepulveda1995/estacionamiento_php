<?php
    session_start();

    include __DIR__ . '/../includes/connect.php';

    $sql = 'SELECT ID_USUARIO, ID, NOMBRE, USUARIO, PASSWORD FROM usuarios WHERE ESTADO = 1';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $empleados = $stmt->fetchAll();

    $titulo = 'Lista de empleados';
    ob_start();
    include __DIR__ . '/../templates/lista-empleados.html.php';
    $contenido = ob_get_clean();
    include __DIR__ . '/../templates/layout.html.php';