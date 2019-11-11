<?php
    $titulo = 'Ingresar al sistema';
    ob_start();
    include __DIR__ . '/templates/inicio.html.php';
    $contenido = ob_get_clean();
    include __DIR__ . '/templates/layout.html.php';