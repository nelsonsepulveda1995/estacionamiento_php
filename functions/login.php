<?php

    include __DIR__ . '/../includes/connect.php';
    //siempre inicializar las variables;
    $usuario = '';
    $password = '';

    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario  = $_POST['usuario'];
        $password = $_POST['password'];

        $query = $pdo->prepare('SELECT `NOMBRE` , `ID`, `ID_USUARIO` FROM `usuarios` WHERE `USUARIO` = :USUARIO AND `PASSWORD` = :PASSWORD AND `ESTADO` = 1');
        $query->bindValue(':USUARIO', $usuario);
        $query->bindValue(':PASSWORD', $password);
        $query->execute();
        $resultado = $query->fetch(); //el resultado de la consulta se guarda dentro de la variable
        $cantidadFilas = $query->rowCount(); //cuenta la cantidad de filas que se obtuvo

        //si el usuario existe
        if ($cantidadFilas > 0) {
            //si no hay sesion activa
            if(!isset($_SESSION)){
                //se crea una sesion vacia para el usuario
                session_start();

                //se carga en la sesion los datos
                $_SESSION['id_usuario'] = $resultado['ID_USUARIO'];
                $_SESSION['nombre'] = $resultado['NOMBRE'];
                $_SESSION['cargo'] = $resultado['ID'];
                $_SESSION['password'] = $password;
                $_SESSION['usuario'] = $usuario;

                //se comprueba si es gerente
                if ($resultado['ID'] == 1) { 
                    header('location: home-gerente.php');
                    } 
                //sino si es empleado
                else if ($resultado['ID'] == 2) {
                    header("location: home-empleado.php");
                } 
            } 
        } else {          
            session_start();            
            $_SESSION['mensaje'] = 'Usuario/contraseña inválido';
            header('location: ./../index.php');
        }
    };