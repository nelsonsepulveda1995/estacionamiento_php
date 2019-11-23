<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 14)){
            include __DIR__ . '/../includes/connect.php';

            $sql = 'SELECT PATENTE, DNI, DESCRIPCION FROM cliente INNER JOIN tipo WHERE cliente.ID = tipo.ID';
        
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        
            $clientes = $stmt->fetchAll();
        
            $titulo = 'Lista de clientes';
            ob_start();
            include __DIR__ . '/../templates/lista-clientes.html.php';
            $contenido = ob_get_clean();
            print_r($contenido);
        } 
        else {
            $_SESSION['error'] = 'No posee permisos para realizar esa acción';
            header('location: ../index.php');
        }
    }
 	else {
        $_SESSION['mensaje'] = 'No se encontró una sesión para ingresar a la URL';
        header('location: ../index.php');
    }
    