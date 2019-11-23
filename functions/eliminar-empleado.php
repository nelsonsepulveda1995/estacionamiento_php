<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 2)){
            include __DIR__ . '/../includes/connect.php';
            if (isset($_POST['eliminarEmpleado'])) {
                $id = $_POST['eliminarEmpleado'];

                $sql = 'SELECT * FROM usuarios WHERE ID = 1 AND ESTADO = 1';

                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $length = $stmt->rowCount();
                $sql = 'SELECT ID FROM usuarios WHERE ID_USUARIO=:id';

                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
                $cargo = $stmt->fetch();
                if ($cargo['ID']==1 && $length>1) {
                    $sql = 'UPDATE usuarios SET ESTADO = 0 WHERE ID_USUARIO = :id';

                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':id', $id);
                    $stmt->execute();
                    ob_start();
                    include __DIR__ . '/../functions/todos-usuarios.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }else if($length==1){
                    $_SESSION['error']="No puede eliminar al único perfil de Gerente. Cree uno nuevo para poder eliminarlo.";
                    ob_start();
                    include __DIR__ . '/../functions/todos-usuarios.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }else{
                    $sql = 'UPDATE usuarios SET ESTADO = 0 WHERE ID_USUARIO = :id';

                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':id', $id);
                    $stmt->execute();
                    ob_start();
                    include __DIR__ . '/../functions/todos-usuarios.php';
                    $contenido = ob_get_clean();
                    print_r($contenido);
                }
            }
        } else {
            $_SESSION['error'] = 'No posee permisos para realizar esa acción';
            header('location: ../index.php');
        }
    } else {
        $_SESSION['mensaje'] = 'No se encontró una sesión para ingresar a la URL';
        header('location: ../index.php');
    }

    
        