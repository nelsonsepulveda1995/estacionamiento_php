<?php
    session_start();

    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 11)){
            //si hay algún dato en POST significa que se completó el formulario
            if (isset($_POST['PATENTE'])) {
                include __DIR__ . '/../includes/connect.php';

                $patente = $_POST['PATENTE'];

                $sql = 'UPDATE `cliente` SET `ID`= 1 WHERE `PATENTE`=:PATENTE';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':PATENTE', $patente);
                $stmt->execute();
                
                header('location: home-empleado.php');
            }
            else {
                //mostrar formulario
                $titulo = 'Crear abonado';
                ob_start();
                include __DIR__ . '/../templates/registro-abonado.html.php';
                $contenido = ob_get_clean();
                include __DIR__ . '/../templates/layout.html.php';
            }
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