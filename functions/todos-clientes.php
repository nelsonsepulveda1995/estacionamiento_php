<?php
    session_start();

    include __DIR__ . '/../includes/connect.php';

    $sql = 'SELECT PATENTE, DNI, DESCRIPCION FROM cliente INNER JOIN tipo WHERE cliente.ID = tipo.ID';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $clientes = $stmt->fetchAll();

    $titulo = 'Lista de clientes';
    ob_start();
    include __DIR__ . '/../templates/lista-clientes.html.php';
    $contenido = ob_get_clean();
    include __DIR__ . '/../templates/layout.html.php';