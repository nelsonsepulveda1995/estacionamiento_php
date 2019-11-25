<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/../functions/revisar-permiso.php';
    include __DIR__ . '/../includes/connect.php';
        //si editarCliente existe significa que se quiere editar al empleado
        if(isset($_SESSION['cargo'])){
            if(consultar_permiso($_SESSION['cargo'], 16)){
                
                $patente=$pdo->prepare('SELECT `cliente`.`PATENTE`, `cliente`.`NOMBRE_CLIENTE` FROM `cliente` LEFT JOIN `estadia` ON `estadia`.`PATENTE` = `cliente`.`PATENTE` WHERE estadia.INGRESO IS NOT NULL AND estadia.EGRESO IS NULL');
                $patente->execute();
                $row= $patente->fetchAll();
                $titulo = 'Empleado';
                ob_start();     //se utiliza para poder guardar en la variable todo el contenido del template
                include __DIR__ . '/../templates/home-empleado.html.php';
                $contenido = ob_get_clean();
                include __DIR__ . '/../templates/layout.html.php';
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
    
        