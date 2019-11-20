<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=phpweb; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$contenido = 'Conexión correcta';
} catch (PDOException $e) {
    $contenido = 'No se pudo conectar a la base de datos';
}