<?php
    session_start();

    //CREAR ESTADIA RECIBE 3 DATOS EL CLIENTE, EL USUARIUO QUE CREA LA ESTADIA Y EL PRECIO QUE USUARA

    if (isset($_POST['PATENTE'] && isset($_POST['ID_USUARIO']) && isset($_POST['PRECIO']) ){
        include __DIR__ . '/../includes/connect.php';
        $patente=$_POST['PATENTE'];
        $id=$_POST['ID_USUARIO'];
        $precio=$_POST['PRECIO'];
        
        $sql = "SELECT ID FROM `estadia` WHERE patente=:PATENTE"; //revisa que no haya una estadia sin cerrar
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':PATENTE', $patente);
        $stmt->execute();
        $resultado = $stmt->fetch(); //el resultado de la consulta se guarda dentro de la variable
        $cantidadFilas = $stmt->rowCount(); //cuenta la cantidad de filas que se obtuvo

        if($cantidadFilas==0){
            $fecha=date('Y-m-d H:i:s') //obtiene año con 4 digitos y los demas valores con ceros iniciales
            $sql = "INSERT INTO `estadia`(`Patente`, `ID_USUARIO`, `ID_PRECIO`, `INGRESO`) VALUES (:PATENTE,:ID_USUARIO,:PRECIO,:INGRESO)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':ID_USUARIO', $id);
            $stmt->bindValue(':PRECIO', $precio);
            $stmt->bindValue(':PATENTE', $patente);
            $stmt->bindValue(':INGRESO', $fecha);

            $stmt->execute();
            
            //MOSTRAR POR AJAX O REDIRECCINAR?
            //header('location: home-empleado.php');
        }
        else{
            //cargar un dato en la sesion para el error
            $_SESSION['estadia_error']="Ya existe una estadia sin cerrar para este cliente: " . $patente;

        }
        
    }
    else {
        //mostrar formulario
        $titulo = 'Alta de Estadia';
        ob_start();
        include __DIR__ . '/../templates/registro-estadia.html.php';
        $contenido = ob_get_clean();
        include __DIR__ . '/../templates/layout.html.php';
    }
    