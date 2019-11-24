<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }
    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 9)){
            if(isset($_POST['editarEmpleado'])) {
                include __DIR__ . '/../includes/connect.php';
                $id = $_POST['editarEmpleado'];

                $sql = 'SELECT ID_USUARIO, ID, NOMBRE, USUARIO, PASSWORD FROM usuarios WHERE ID_USUARIO = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                $empleado = $stmt->fetch();

                //mostrar formulario
                $titulo = 'Alta de empleado';
                ob_start();
                include __DIR__ . '/../templates/registro-empleados.html.php';
                $contenido = ob_get_clean();
                print_r($contenido);

                
            } else {
                include __DIR__ . '/../includes/connect.php';
                $id = $_POST['ID_USUARIO'];
                $sql = 'UPDATE usuarios SET
                            ID = :id,
                            NOMBRE = :nombre,
                            USUARIO = :usuario,
                            PASSWORD = :password
                        WHERE ID_USUARIO = :id_usuario
                        ';
                
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $_POST['ID']);
                $stmt->bindValue(':nombre', $_POST['NOMBRE']);
                $stmt->bindValue(':usuario', $_POST['USUARIO']);
                $stmt->bindValue(':password', $_POST['PASSWORD']);
                $stmt->bindValue(':id_usuario', $id);

                $stmt->execute();

                ob_start();
                include __DIR__ . '/../functions/todos-usuarios.php';
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