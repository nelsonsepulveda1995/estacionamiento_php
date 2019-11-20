<?php
    $titulo = 'Gerente';
    ob_start();     //se utiliza para poder guardar en la variable todo el contenido del template
    include __DIR__ . '/../templates/home-gerente.html.php';
    $contenido = ob_get_clean();
    include __DIR__ . '/../templates/layout.html.php';