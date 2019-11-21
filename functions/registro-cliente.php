<?php
    session_start();
    //si hay algún dato en POST significa que se completó el formulario
    if (isset($_POST['PATENTE'])) {
        include __DIR__ . '/../includes/connect.php';

        $id = $_POST['TIPO'];
        $dni = $_POST['DNI'];
        $patente = $_POST['PATENTE'];

        $sql='SELECT `PATENTE` FROM `cliente` WHERE  `PATENTE`=:PATENTE ';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':PATENTE', $patente);
        $stmt->execute();
        $resultado = $query->fetch(); //el resultado de la consulta se guarda dentro de la variable
        $cantidadFilas = $query->rowCount(); //cuenta la cantidad de filas que se obtuvo
                
        //si el usuario no existe
        if ($cantidadFilas <= 0) {

            $sql = "INSERT INTO `cliente`(`DNI`, `ID`, `PATENTE`) VALUES (:DNI,:ID,:PATENTE)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':DNI', $dni);
            $stmt->bindValue(':ID', $id);
            $stmt->bindValue(':PATENTE', $patente);

            $stmt->execute();

            header('location: ./todos-clientes.php');
        }
        else{
            else{
                $_SESSION["faltan_datos"]="ya existe un cliente con esta patente";
                header('location: registro-cliente.php');
        }
    }
    else {
        //mostrar formulario
        $titulo = 'Alta de cliente';
        ob_start();
        include __DIR__ . '/../templates/registro-cliente.html.php';
        $contenido = ob_get_clean();
        include __DIR__ . '/../templates/layout.html.php';
    }
    