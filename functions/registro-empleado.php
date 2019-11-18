<?php
    //session_start();
    //si hay algún dato en POST significa que se completó el formulario
    if (isset($_POST['NOMBRE'])) {
        include __DIR__ . '/../includes/connect.php';

        $id = $_POST['ID'];
        $nombre = $_POST['NOMBRE'];
        $estado = 1;
        $usuario = $_POST['USUARIO'];
        $password = $_POST['PASSWORD'];

        $sql = 'INSERT INTO usuarios SET 
                    ID = :id,
                    NOMBRE = :nombre,
                    ESTADO = :estado,
                    USUARIO = :usuario,
                    PASSWORD = :password'
                ;
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':password', $password);
        $stmt->execute();

        header('location: ./todos-usuarios.php');
    }
    else {
        //mostrar formulario
        $titulo = 'Alta de empleado';
        ob_start();
        include __DIR__ . '/../templates/registro-empleados.html.php';
        $contenido = ob_get_clean();
        include __DIR__ . '/../templates/layout.html.php';
    }
    