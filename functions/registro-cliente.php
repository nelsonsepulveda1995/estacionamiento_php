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
                    $_SESSION["success"]="Creado perfectamente";
                    ob_start();
                    include __DIR__ . '/../templates/registro-cliente.html.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }
                else{
                    $_SESSION["faltan_datos"]="ya existe un cliente con esta patente";
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
            header('location: ../index.php');
        }
    } 
    else {
        $_SESSION['mensaje'] = 'No se encontró una sesión para ingresar a la URL';
        header('location: ../index.php');
    }