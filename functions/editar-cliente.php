<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }
    include __DIR__ . '/../functions/revisar-permiso.php';
    //si editarCliente existe significa que se quiere editar al empleado
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 8)){
            //si editarCliente existe significa que se quiere editar al empleado
            if(isset($_POST['editarCliente'])) {
                include __DIR__ . '/../includes/connect.php';
                $id = $_POST['editarCliente'];
            
                $sql = 'SELECT DNI, ID, PATENTE, NOMBRE_CLIENTE, EMAIL FROM cliente WHERE PATENTE = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
            
                $cliente = $stmt->fetch();
                //mostrar formulario
                $titulo = 'Editar cliente';
                ob_start();
                include __DIR__ . '/../templates/registro-cliente.html.php';
                $contenido = ob_get_clean();
                print_r($contenido);
            
                
            } else {
                $regex_patenteN = '/([a-z]{2})(\d{3})([a-z]{2})/i';
                $regex_patenteV = '/([a-z]{3})(\d{3})/i';
                $regex_nombre_cliente = '/([a-záéíóúñ]{2,})(\s)(([a-záéíóúñ]{2,})(\s?)){1,}/i';
                $regex_email = '/[-0-9a-z.+_]+@[-0-9a-z.+_]+.[a-z]{2,4}/i';
                $regex_dni = '/(\d{8,10})/i';
                $id = $_POST['ID'];
                include __DIR__ . '/../includes/connect.php';
                if (isset($_POST['DNI']) && isset($_POST['TIPO']) && isset($_POST['NOMBRE_CLIENTE']) && isset($_POST['EMAIL']) && preg_match_all($regex_nombre_cliente,$_POST['NOMBRE_CLIENTE']) && preg_match_all($regex_email,$_POST['EMAIL']) && preg_match_all($regex_dni,$_POST['DNI']) && (preg_match_all($regex_patenteN,$_POST['PATENTE']) xor preg_match_all($regex_patenteV,$_POST['PATENTE']))) {
                    $sql = 'SELECT * FROM `estadia` WHERE PATENTE = :id';
                    
                    $upEst = $pdo->prepare($sql);
                    $upEst->bindValue(':id', $id);
                    $upEst->execute();
                
                    $sql = 'SELECT * FROM `historialpagos` WHERE PATENTE = :id';
                    
                    $upHist = $pdo->prepare($sql);
                    $upHist->bindValue(':id', $id);
                    $upHist->execute();
                    $sql = 'DELETE FROM `estadia` WHERE PATENTE = :id';
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':id', $id);
                    $stmt->execute();
                    $sql = 'DELETE FROM `historialpagos` WHERE PATENTE = :id';
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':id', $id);
                    $stmt->execute();
                
                    $sql = 'UPDATE cliente SET
                                NOMBRE_CLIENTE = :nombre,
                                EMAIL = :email,
                                DNI = :dni,
                                PATENTE = :patente,
                                ID = :tipo
                            WHERE PATENTE = :id
                            ';
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':nombre', $_POST['NOMBRE_CLIENTE']);
                    $stmt->bindValue(':email', $_POST['EMAIL']);
                    $stmt->bindValue(':dni', $_POST['DNI']);
                    $stmt->bindValue(':patente', strtoupper($_POST['PATENTE']));
                    $stmt->bindValue(':tipo', $_POST['TIPO']);
                    $stmt->bindValue(':id', $id);
                
                    $stmt->execute();
                    if ($_POST['TIPO'] == $_POST['clientePrev']) {
                        while ($EdEst = $upEst->fetch()) {
                            $sql = 'INSERT INTO estadia (
                                    PATENTE, 
                                    ID_USUARIO,
                                    ID_PRECIO,
                                    INGRESO,
                                    EGRESO,
                                    TOTAL
                                    ) VALUES (
                                    :patente,
                                    :id_usuario,
                                    :id_precio,
                                    :ingreso,
                                    :egreso,
                                    :total
                                    )
                                ';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindValue(':patente', strtoupper($_POST['PATENTE']));
                            $stmt->bindValue(':id_usuario', $EdEst['ID_USUARIO']);
                            $stmt->bindValue(':id_precio', $EdEst['ID_PRECIO']);
                            $stmt->bindValue(':ingreso', $EdEst['INGRESO']);
                            $stmt->bindValue(':egreso', $EdEst['EGRESO']);
                            $stmt->bindValue(':total', $EdEst['TOTAL']);
                    
                            $stmt->execute();
                        }
                        while ($EdHist = $upHist->fetch()) {
                            $sql = 'INSERT INTO historialpagos(
                                    PATENTE, 
                                    ID_PRECIO,
                                    FECHA_PAGO
                                    ) VALUES (
                                    :patente,
                                    :id_precio,
                                    :fecha_pago
                                    )
                                ';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindValue(':patente', strtoupper($_POST['PATENTE']));
                            $stmt->bindValue(':id_precio', $EdHist['ID_PRECIO']);
                            $stmt->bindValue(':fecha_pago', $EdHist['FECHA_PAGO']);
                    
                            $stmt->execute();
                        }
                    }
                
                    ob_start();
                    include __DIR__ . '/../functions/todos-clientes.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }else{
                    $_SESSION['error'] = 'Hay campos vacios, o bien no cumplen con el formato solicitado. Por favor, revise la integridad de los mismos.';
                    ob_start();
                    include __DIR__ . '/../templates/home-empleado.html.php';
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