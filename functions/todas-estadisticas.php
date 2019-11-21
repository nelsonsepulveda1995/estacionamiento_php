<?php
    session_start();

    include __DIR__ . '/../includes/connect.php';
    $diario=date("Y-m-d");

    $sql = 'SELECT SUM(TOTAL) as TOTAL FROM estadia WHERE  LEFT(INGRESO,10) = :DIA';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':DIA', $diario);
    $stmt->execute();

    $pordia = $stmt->fetchAll();

    $titulo = 'Estadisticas';
    ob_start();
    include __DIR__ . '/../templates/lista-estadisticas.html.php';
    $contenido = ob_get_clean();
    include __DIR__ . '/../templates/layout.html.php';