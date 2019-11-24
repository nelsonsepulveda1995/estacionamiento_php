<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 6)){
            include __DIR__ . '/../includes/connect.php';
            $id = $_SESSION['id_usuario'];
            
            $sql = 'SELECT ID_USUARIO, DESCRIPCION AS CARGO, NOMBRE, USUARIO, PASSWORD FROM usuarios INNER JOIN puesto WHERE ESTADO = 1 AND usuarios.ID = puesto.ID';
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':ID',$id);
            $stmt->execute();
            
            $empleados = $stmt->fetchAll();
            
            $titulo = 'Lista de empleados';
            ob_start();
            include __DIR__ . '/../templates/lista-empleados.html.php';
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