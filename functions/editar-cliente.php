<?php 
    session_start();
    if (isset($_POST['key'])) {
        $url = $_POST['key'];
    }

    include __DIR__ . '/revisar-permiso.php';
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 8)){
            //si editarCliente existe significa que se quiere editar al empleado
            if(isset($_POST['editarCliente'])) {
                include __DIR__ . '/../includes/connect.php';
                $id = $_POST['editarCliente'];

                $sql = 'SELECT DNI, ID, PATENTE FROM cliente WHERE DNI = :id';
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
                include __DIR__ . '/../includes/connect.php';
                $id = $_POST['DNI'];
                $sql = 'UPDATE cliente SET
                            DNI = :id,
                            PATENTE = :patente,
                            ID = :tipo
                        WHERE PATENTE = :patente
                        ';
                
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $_POST['DNI']);
                $stmt->bindValue(':patente', $_POST['PATENTE']);
                $stmt->bindValue(':tipo', $_POST['TIPO']);

                $stmt->execute();
                ob_start();
                include __DIR__ . '/../functions/todos-clientes.php';
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