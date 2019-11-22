<?php
    include __DIR__ . '/../includes/connect.php';
    if (isset($_POST['eliminarEmpleado'])) {
        $id = $_POST['eliminarEmpleado'];

        $sql = 'SELECT * FROM usuarios WHERE ID = 1 AND ESTADO = 1';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $length = $stmt->countRow()

        if ($length>1) {
            $sql = 'UPDATE usuarios SET ESTADO = 0 WHERE ID_USUARIO = :id';

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            ob_start();
            include __DIR__ . '/../function/todos-empleados.php';
            $contenido = ob_get_clean();
            print_r($contenido);
        }
    }