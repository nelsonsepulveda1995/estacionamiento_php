<?php
    include __DIR__ . '/../includes/connect.php';
    if (isset($_POST['eliminarEmpleado'])) {
        $id = $_POST['eliminarEmpleado'];

        $sql = 'UPDATE usuarios SET ESTADO = 0 WHERE ID_USUARIO = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    
        header('location: ./todos-usuarios.php');
    }