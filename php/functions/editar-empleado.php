<?php 
    //si editarEmpleado existe significa que se quiere editar al empleado
    if(isset($_POST['editarEmpleado'])) {
        include __DIR__ . '/../includes/connect.php';
        $id = $_POST['editarEmpleado'];

        $sql = 'SELECT ID_USUARIO, NOMBRE, USUARIO, PASSWORD FROM usuarios WHERE ID_USUARIO = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $empleado = $stmt->fetch();

        //mostrar formulario
        $titulo = 'Alta de empleado';
        ob_start();
        include __DIR__ . '/../templates/registro-empleados.html.php';
        $contenido = ob_get_clean();
        include __DIR__ . '/../templates/layout.html.php';

        
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

        header('location: ./todos-usuarios.php');
    }