<?php
    session_start();
    //EGRESO DE ESTADÍA RECIBE LA PATENTE DEL AUTO QUE SE INGRESA AL CREAR UNA ESTADÍA. SI ESTA EXISTE Y NO TIENE UNA FECHA DE EGRESO
    //SE CREA DICHO EGRESO CON LA FECHA ACTUAL. EN CASO CONTRARIO, SE NOTIFICA LA NO EXISTENCIA/NO EGRESO DE LA PATENTE

    if(isset($_SESSION)){

        if (isset($_POST['PATENTE'])){

            try {
                include __DIR__ . '/../includes/connect.php';
                $patente=$_POST['PATENTE'];
                $id=$_POST['ID_USUARIO'];
                
                $sql = "SELECT * FROM `estadia` WHERE patente=:PATENTE AND EGRESO IS NULL"; //revisa que no haya una estadia sin cerrar
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':PATENTE', $patente);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC); //el resultado de la consulta se guarda dentro de la variable
                
                $cantidadFilas = $stmt->rowCount(); //cuenta la cantidad de filas que se obtuvo
                if($cantidadFilas > 0){
                    //obtengo la fecha de ingreso de la patente que estoy realizando el egreso
                    $ingreso = "SELECT ingreso FROM `estadia` WHERE patente=:PATENTE AND EGRESO IS NULL"; //revisa que no haya una estadia sin cerrar
                    $func = $pdo->prepare($ingreso);
                    $func->bindValue(':PATENTE', $patente);
                    $func->execute();
                    $resultadoIngreso = $func->fetch();
                    foreach ($resultadoIngreso as $key => $value) {
                        $resIngreso = new DateTime($value);
                    }
                    //convierto las fechas de ingreso y egreso a DateTime para poder compararlas y obtener el tiempo que estuvo
                    $fechaEgr=date('Y-m-d H:i:s'); //obtiene año con 4 digitos y los demas valores con ceros iniciales
                    $fEgr = new DateTime($fechaEgr);
                    $intervalo = $resIngreso->diff($fEgr);

                    //obtengo el precio que le corresponde a la estadía
                    $Precio = "SELECT precio FROM `precio` WHERE id_precio=:PRECIO"; //revisa que no haya una estadia sin cerrar
                    $func = $pdo->prepare($Precio);
                    $func->bindValue(':PRECIO', $resultado['ID_PRECIO']);
                    $func->execute();
                    $resultadoPrecio = $func->fetch();
                    foreach ($resultadoPrecio as $key => $value) {
                        $resPrecio = $value;
                    }
                    $total = (($intervalo->h+1)*$resPrecio);
                    
                    $sql = "UPDATE `estadia` SET `EGRESO` = :FECHA , `TOTAL` = :TOTAL WHERE `PATENTE` = :PATENTE AND EGRESO IS NULL";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':PATENTE', $patente);
                    $stmt->bindValue(':FECHA', $fechaEgr);
                    $stmt->bindValue(':TOTAL', $total);
        
                    $stmt->execute();
                    
                    $_SESSION['estadia_success'] = 'La patente ' . $patente . ' ha egresado exitósamente'.'. Total: $'.$total;
                    header('location: egreso-estadia.php');
                }
                else{
                    //cargar un dato en la sesion para el error
                    
                    $_SESSION['estadia_error']="No existe una estadia sin cerrar para este cliente: " . $resultado['ID_PRECIO'];
                    header('location: egreso-estadia.php');
                }
            } catch (PDOEXCEPTION $e) {
                //no se pudo realizar la estadia al no estar registrada la patente
                $_SESSION['estadia_error'] = 'La patente ' . $e . ' no existe ';
                header('location: egreso-estadia.php');
            }
            
            
        }
        else {
            //mostrar formulario
            $titulo = 'Egreso de Estadia';
            ob_start();
            include __DIR__ . '/../templates/egreso-estadia.html.php';
            $contenido = ob_get_clean();
            include __DIR__ . '/../templates/layout.html.php';
        }
    }
    else{
        header('location: ../index.php');
    }