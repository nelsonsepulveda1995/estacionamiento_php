<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 13)){
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
        }
        else {
            $_SESSION['error'] = 'No posee permisos para realizar esa acción';
            ob_start();
            include __DIR__ . '/../templates/home-empleado.html.php';
            $contenido = ob_get_clean();
            print_r($contenido);
        }
    }
    else {
        $_SESSION['error'] = 'No se encontró una sesión para ingresar a la URL';
        ob_start();
        include __DIR__ . '/../index.php';
        $contenido = ob_get_clean();
        print_r($contenido);
    }   