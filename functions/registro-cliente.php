<?php
    session_start();
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 3)){
            //si hay algún dato en POST significa que se completó el formulario
            if (isset($_POST['PATENTE'])) {
                include __DIR__ . '/../includes/connect.php';
                $regex_patenteN = '/([a-z]{2})(\d{3})([a-z]{2})/i';
                $regex_patenteV = '/([a-z]{3})(\d{3})/i';
                $regex_nombre_cliente = '/([a-záéíóúñ]{2,})(\s)(([a-záéíóúñ]{2,})(\s?)){1,}/i';
                $regex_email = '/[-0-9a-z.+_]+@[-0-9a-z.+_]+.[a-z]{2,4}/i';
                $regex_dni = '/(\d{8,10})/i';
                if (isset($_POST['DNI']) && isset($_POST['TIPO']) && isset($_POST['NOMBRE_CLIENTE']) && isset($_POST['EMAIL']) && preg_match_all($regex_nombre_cliente,$_POST['NOMBRE_CLIENTE']) && preg_match_all($regex_email,$_POST['EMAIL']) && preg_match_all($regex_dni,$_POST['DNI']) && (preg_match_all($regex_patenteN,$_POST['PATENTE']) xor preg_match_all($regex_patenteV,$_POST['PATENTE']))) {
                    $nombre = $_POST['NOMBRE_CLIENTE'];
                    $email = $_POST['EMAIL'];
                    $id = $_POST['TIPO'];
                    $dni = $_POST['DNI'];
                    $patente = $_POST['PATENTE'];
                    $patente = strtoupper($patente);
                    
                    $sql='SELECT `PATENTE` FROM `cliente` WHERE  `PATENTE`=:PATENTE ';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':PATENTE', $patente);
                    $stmt->execute();
                    $resultado = $stmt->fetch(); //el resultado de la consulta se guarda dentro de la variable
                    $cantidadFilas = $stmt->rowCount(); //cuenta la cantidad de filas que se obtuvo
                    
                    //si el usuario no existe
                    if ($cantidadFilas <= 0) {            
                        $sql = "INSERT INTO `cliente`(`NOMBRE_CLIENTE`,`EMAIL`,`DNI`, `ID`, `PATENTE`) VALUES (:NOMBRE,:EMAIL,:DNI,:ID,:PATENTE)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':NOMBRE', $nombre);
                        $stmt->bindValue(':EMAIL', $email);
                        $stmt->bindValue(':DNI', $dni);
                        $stmt->bindValue(':ID', $id);
                        $stmt->bindValue(':PATENTE', $patente);
                        
                        $stmt->execute();
                        $_SESSION["success"]="La patente ".$patente." se ha registrado correctamente.";
                        ob_start();
                        include __DIR__ . '/../templates/registro-cliente.html.php';
                        $contenido = ob_get_clean();
                        print_r($contenido);
                    }
                    else{
                        $_SESSION["faltan_datos"]="Ya existe un cliente con esta patente";
                        ob_start();
                        include __DIR__ . '/../templates/registro-cliente.html.php';
                        $contenido = ob_get_clean();
                        print_r($contenido);
                    }
                } else {
                    $_SESSION["faltan_datos"]="El formato de uno o varios campos es incorrecto.";
                    ob_start();
                    include __DIR__ . '/../templates/registro-cliente.html.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }
            }
            else {
                //mostrar formulario
                $titulo = 'Alta de cliente';
                ob_start();
                include __DIR__ . '/../templates/registro-cliente.html.php';
                $contenido = ob_get_clean();
                print_r($contenido);
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
            