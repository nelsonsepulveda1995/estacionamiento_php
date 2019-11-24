<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 4)){
            if (isset($_POST['PATENTE']) && isset($_POST['ID_USUARIO']) && isset($_POST['PRECIO']) ){
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                try {
                    include __DIR__ . '/../includes/connect.php';
                    $id_lugares=1;
                    $sql = "SELECT `CANTIDAD` FROM `lugares` WHERE `ID` =:ID"; 
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':ID', $id_lugares);            
                    $stmt->execute();
                    $resultado_lugares = $stmt->fetch(); //el resultado de la consulta se guarda dentro de la variable
                    if($resultado_lugares['CANTIDAD'] > 0){ //revisa que haya lugar en el estacionamiento
                        
                        $patente=$_POST['PATENTE'];
                        $id=$_POST['ID_USUARIO'];
                        $precio=$_POST['PRECIO'];
                        
                        $sql = "SELECT * FROM `estadia` WHERE patente=:PATENTE AND EGRESO IS NULL"; //revisa que no haya una estadia sin cerrar
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':PATENTE', $patente);
                        $stmt->execute();
                        $resultado = $stmt->fetch(); //el resultado de la consulta se guarda dentro de la variable
                        $cantidadFilas = $stmt->rowCount(); //cuenta la cantidad de filas que se obtuvo
                        if($cantidadFilas <= 0){
                            $ingreso = "SELECT FECHA_PAGO FROM `historialpagos` WHERE patente=:PATENTE"; //revisa que no haya una estadia sin cerrar
                            $func = $pdo->prepare($ingreso);
                            $func->bindValue(':PATENTE', $patente);
                            $func->execute();
                            $resultadoIngreso = $func->fetch();
                            if ($resultadoIngreso != '' && $precio==1) {
                                foreach ($resultadoIngreso as $key => $value) {
                                    $resIngreso = new DateTime($value);
                                }
                                //convierto las fechas de ingreso y egreso a DateTime para poder compararlas y obtener el tiempo que estuvo
                                $fechaEgr=date('Y-m-d H:i:s'); //obtiene año con 4 digitos y los demas valores con ceros iniciales
                                $fEgr = new DateTime($fechaEgr);
                                $intervalo = $resIngreso->diff($fEgr);
                                if (isset($intervalo) && $intervalo->m >0) {
                                    $_SESSION['estadia_error']="La patente nº " . $patente. " ya ha superado el més de abono. Debe registrar un nuevo pago de abonado.";
                                    ob_start();
                                    include __DIR__ . '/../templates/registro-estadia.html.php';
                                    $contenido = ob_get_clean();
                                    print_r($contenido);
                                }else{
                                    $fecha=date('Y-m-d H:i:s'); //obtiene año con 4 digitos y los demas valores con ceros iniciales
                                    $sql = "INSERT INTO `estadia`(`PATENTE`, `ID_USUARIO`, `ID_PRECIO`, `INGRESO`) VALUES (:PATENTE,:ID_USUARIO,:PRECIO,:INGRESO)";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindValue(':ID_USUARIO', $id);
                                    $stmt->bindValue(':PRECIO', $precio);
                                    $stmt->bindValue(':PATENTE', $patente);
                                    $stmt->bindValue(':INGRESO', $fecha);
                                    
                                    $stmt->execute();
                                    
                                    //reduce en uno el contador de lugares
                                    $contador=(($resultado_lugares['CANTIDAD'])-1);
                                    $sql = "UPDATE `lugares` SET `CANTIDAD`=:CANTIDAD WHERE `ID`=:ID";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindValue(':ID', $id_lugares);
                                    $stmt->bindValue(':CANTIDAD', $contador);
                                    $stmt->execute();
                                    
                                    //MOSTRAR POR AJAX O REDIRECCINAR?
                                    $_SESSION['estadia_success']="Se ha registrado correctamente la patente nº " . $patente;
                                    ob_start();
                                    include __DIR__ . '/../templates/registro-estadia.html.php';
                                    $contenido = ob_get_clean();
                                    print_r($contenido);
                                }
                            }else if ($precio==1) {
                                $_SESSION['estadia_error']="La patente nº " . $patente. " no ha pagado el mes de abono.";
                                ob_start();
                                include __DIR__ . '/../templates/registro-estadia.html.php';
                                $contenido = ob_get_clean();
                                print_r($contenido);
                            }else{
                                $fecha=date('Y-m-d H:i:s'); //obtiene año con 4 digitos y los demas valores con ceros iniciales
                                $sql = "INSERT INTO `estadia`(`PATENTE`, `ID_USUARIO`, `ID_PRECIO`, `INGRESO`) VALUES (:PATENTE,:ID_USUARIO,:PRECIO,:INGRESO)";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindValue(':ID_USUARIO', $id);
                                $stmt->bindValue(':PRECIO', $precio);
                                $stmt->bindValue(':PATENTE', $patente);
                                $stmt->bindValue(':INGRESO', $fecha);
                                
                                $stmt->execute();
                                
                                //reduce en uno el contador de lugares
                                $contador=(($resultado_lugares['CANTIDAD'])-1);
                                $sql = "UPDATE `lugares` SET `CANTIDAD`=:CANTIDAD WHERE `ID`=:ID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindValue(':ID', $id_lugares);
                                $stmt->bindValue(':CANTIDAD', $contador);
                                $stmt->execute();
                                
                                //MOSTRAR POR AJAX O REDIRECCINAR?
                                $_SESSION['estadia_success']="Se ha registrado correctamente la patente nº " . $patente;
                                ob_start();
                                include __DIR__ . '/../templates/registro-estadia.html.php';
                                $contenido = ob_get_clean();
                                print_r($contenido);
                            }
                        }
                        else{
                            //cargar un dato en la sesion para el error
                            $_SESSION['estadia_error']="Ya existe una estadia sin cerrar para este cliente: " . $patente;
                            ob_start();
                            include __DIR__ . '/../templates/registro-estadia.html.php';
                            $contenido = ob_get_clean();
                            print_r($contenido);
                        }
                    }
                    else{
                        //cargar un dato en la sesion para el error
                        $_SESSION['estadia_error']="No hay mas lugar en el estacionamiento";
                        ob_start();
                        include __DIR__ . '/../templates/registro-estadia.html.php';
                        $contenido = ob_get_clean();
                        print_r($contenido);
                    }
                } catch (PDOEXCEPTION $e) {
                    //no se pudo realizar la estadia al no estar registrada la patente
                    $_SESSION['estadia_error'] = 'La patente ' . $patente . ' no existe ';
                    ob_start();
                    include __DIR__ . '/../templates/registro-estadia.html.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }
                
                
            }
            else {
                //mostrar formulario
                $titulo = 'Alta de Estadia';
                ob_start();
                include __DIR__ . '/../templates/registro-estadia.html.php';
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
            
            
            
            