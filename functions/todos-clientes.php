<?php
    session_start();

    include __DIR__ . '/../includes/connect.php';

    $sql = 'SELECT DNI, ID, PATENTE FROM cliente';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $clientes = $stmt->fetchAll();

    $titulo = 'Lista de clientes';
    ob_start();
    include __DIR__ . '/../templates/lista-clientes.html.php';
    $contenido = ob_get_clean();
    include __DIR__ . '/../templates/layout.html.php';