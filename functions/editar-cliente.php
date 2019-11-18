<?php 
    session_start();
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
        include __DIR__ . '/../templates/layout.html.php';

        
    } else {
        include __DIR__ . '/../includes/connect.php';
        $id = $_POST['DNI'];
        $sql = 'UPDATE cliente SET
                    DNI = :id,
                    PATENTE = :patente,
                    ID = :tipo,
                WHERE DNI = :dni
                ';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['DNI']);
        $stmt->bindValue(':patente', $_POST['PATENTE']);
        $stmt->bindValue(':tipo', $_POST['ID']);
        $stmt->bindValue(':dni', $id);

        $stmt->execute();

        header('location: ./todos-clientes.php');
    }