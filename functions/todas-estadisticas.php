<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 7)){
            include __DIR__ . '/../includes/connect.php';
            
            if(!isset($_POST['fechaSort'])){
                
                //GANACIA POR DIA
                $diario=date("Y-m-d");
                
                $sql = 'SELECT SUM(TOTAL) as `TOTAL POR DIA` FROM estadia WHERE  LEFT(INGRESO,10) = :DIA';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':DIA', $diario);
                $stmt->execute();
                $pordia = $stmt->fetchAll();
                
                //GANANCIA POR MES
                $mes=date("Y-m");
                $sql = 'SELECT SUM(TOTAL) as `TOTAL POR MES` FROM estadia WHERE  LEFT(INGRESO,7) = :MES';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':MES', $mes);
                $stmt->execute();
                $pormes = $stmt->fetchAll();
                
                //GANANCIA POR AÑO
                $year=date("Y");
                $sql = 'SELECT SUM(TOTAL) as `TOTAL POR AÑO` FROM estadia WHERE  LEFT(INGRESO,4) = :YEAR';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':YEAR', $year);
                $stmt->execute();
                $foryear = $stmt->fetchAll();
                
                //LUGARES DISPONIBLES
                $sql = 'SELECT `CANTIDAD` FROM `lugares` ';
                $stmt = $pdo->query($sql);
                $stmt->execute();
                $lugares_disponibles = $stmt->fetchAll();
                // --------------- CARGA DE PANTALLA ------------------------
                
                $titulo = 'Estadisticas';
                ob_start();
                include __DIR__ . '/../templates/lista-estadisticas.html.php';
                $contenido = ob_get_clean();
                print_r($contenido);
            }else{ //pasarle la fecha desde el front en un post
                if(isset($_POST['fecha'])){
                    //GANACIA POR DIA
                    $diario=($_POST['fecha']);  //deberia tomar el año ,mes y dia
                    
                    $sql = 'SELECT SUM(TOTAL) as `TOTAL POR DIA` FROM estadia WHERE  LEFT(INGRESO,10) = :DIA';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':DIA', $diario);
                    $stmt->execute();
                    $pordia = $stmt->fetchAll();
                    
                    //GANANCIA POR MES
                    $mes=substr($_POST['fecha'],0,6); //deberia tomar el año y mes 
                    $sql = 'SELECT SUM(TOTAL) as `TOTAL POR MES` FROM estadia WHERE  LEFT(INGRESO,7) = :MES';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':MES', $mes);
                    $stmt->execute();
                    $pormes = $stmt->fetchAll();
                    
                    //GANANCIA POR AÑO
                    $year=substr($_POST['fecha'],0,3);
                    $sql = 'SELECT SUM(TOTAL) as `TOTAL POR AÑO` FROM estadia WHERE  LEFT(INGRESO,4) = :YEAR';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':YEAR', $year);
                    $stmt->execute();
                    $foryear = $stmt->fetchAll();
                    
                    //LUGARES DISPONIBLES
                    $sql = 'SELECT `CANTIDAD` FROM `lugares` ';
                    $stmt = $pdo->query($sql);
                    $stmt->execute();
                    $lugares_disponibles = $stmt->fetchAll();
                    // --------------- CARGA DE PANTALLA ------------------------
                    
                    $titulo = 'Estadisticas';
                    ob_start();
                    include __DIR__ . '/../templates/lista-estadisticas.html.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }
            }
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