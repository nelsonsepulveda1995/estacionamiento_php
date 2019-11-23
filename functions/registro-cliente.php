<?php
    session_start();
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }
    //si hay algún dato en POST significa que se completó el formulario
    if (isset($_POST['PATENTE'])) {
        include __DIR__ . '/../includes/connect.php';
        $regex_patenteN = '/([a-z]{2})(\d{3})([a-z]{2})/i';
        $regex_patenteV = '/([a-z]{3})(\d{3})/i';
        $regex_dni = '/(\d{8,10})/i';
        if (isset($_POST['DNI']) && isset($_POST['TIPO']) && preg_match_all($regex_dni,$_POST['DNI']) && (preg_match_all($regex_patenteN,$_POST['PATENTE']) xor preg_match_all($regex_patenteV,$_POST['PATENTE']))) {
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
                $sql = "INSERT INTO `cliente`(`DNI`, `ID`, `PATENTE`) VALUES (:DNI,:ID,:PATENTE)";
                $stmt = $pdo->prepare($sql);
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
    