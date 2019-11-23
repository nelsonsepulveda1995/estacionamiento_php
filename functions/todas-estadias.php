<?php
    session_start();

    include __DIR__ . '/../includes/connect.php';

    $sql = 'SELECT `estadia`.`PATENTE`, `precio`.`PRECIO`, `usuarios`.`USUARIO`, `estadia`.`INGRESO`, `estadia`.`EGRESO`, `estadia`.`TOTAL`
        FROM `estadia` 
        LEFT JOIN `precio` ON `estadia`.`ID_PRECIO` = `precio`.`ID_PRECIO` 
        LEFT JOIN `usuarios` ON `estadia`.`ID_USUARIO` = `usuarios`.`ID_USUARIO`;';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $estadias = $stmt->fetchAll();

    $titulo = 'Lista de clientes';
    ob_start();
    include __DIR__ . '/../templates/lista-estadias.html.php';
    $contenido = ob_get_clean();
    print_r($contenido);