<?php
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }
    if (!isset($_SESSION)) {
        session_start();
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])) {
        if (consultar_permiso($_SESSION['cargo'], 1)) {
            //si hay algún dato en POST significa que se completó el formulario
            if (isset($_POST['ID'])) {
                if( $_POST['ID']>0 || $_POST['ID']<3 ){
                    if($_POST['NOMBRE'] !="" && $_POST['USUARIO'] !="" && $_POST['PASSWORD'] != ""){
                        
                        include __DIR__ . '/../includes/connect.php';
                        
                        $id = $_POST['ID'];
                        $nombre = $_POST['NOMBRE'];
                        $estado = 1;
                        $usuario = $_POST['USUARIO'];
                        $password = $_POST['PASSWORD'];
                        $sql='SELECT `ID_USUARIO` FROM `usuarios` WHERE `USUARIO`=:usuario ';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':usuario', $usuario);
                        $stmt->execute();
                        $resultado = $stmt->fetch(); //el resultado de la consulta se guarda dentro de la variable
                        $cantidadFilas = $stmt->rowCount(); //cuenta la cantidad de filas que se obtuvo
                        
                        //si el usuario no existe
                        if ($cantidadFilas <= 0) {
                            $sql = 'INSERT INTO usuarios SET 
                                    ID = :id, 
                                    NOMBRE = :nombre, 
                                    ESTADO = :estado, 
                                    USUARIO = :usuario, 
                                    PASSWORD = :password'
                                    ;
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindValue(':id', $id);
                                    $stmt->bindValue(':nombre', $nombre);
                                    $stmt->bindValue(':estado', $estado);
                                    $stmt->bindValue(':usuario', $usuario);
                                    $stmt->bindValue(':password', $password);
                                    $stmt->execute();
                                    $_SESSION['success']="Usuario creado correctamente.";
                                    ob_start();
                                    include __DIR__ . '/../templates/registro-empleados.html.php';
                                    $contenido = ob_get_clean();
                                    print_r($contenido);
                                }
                                else{
                                    $_SESSION['faltan_datos']="ya existe un empleado con este nombre de usuario";
                                    ob_start();
                                    include __DIR__ . '/../templates/registro-empleados.html.php';
                                    $contenido = ob_get_clean();
                                    print_r($contenido);
                                }
                            }
                            else {
                                $_SESSION['faltan_datos']="Error al querer tomar los datos";
                                ob_start();
                                include __DIR__ . '/../templates/registro-empleados.html.php';
                                $contenido = ob_get_clean();
                                print_r($contenido);
                            }
                            
                        }
                        else {
                            $_SESSION['faltan_datos']="Error al querer tomar los datos";
                            ob_start();
                            include __DIR__ . '/../templates/registro-empleados.html.php';
                            $contenido = ob_get_clean();
                            print_r($contenido);
                        }
                        
                    }
                    else {
                        //mostrar formulario
                        $titulo = 'Alta de empleado';
                        ob_start();
                        include __DIR__ . '/../templates/registro-empleados.html.php';
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