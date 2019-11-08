<?php
    //requiere probar si funciona
    require("../included/connect.php");

    $usuario  = $_POST["usuario"];
    $password = $_POST["password"];
    echo $usuario ." ". $password;

    $query = $conn->prepare('SELECT NOMBRE , ID FROM USUARIOS WHERE USUARIO =":USUARIO" AND PASSWORD = ":PASSWORD" AND ESTADO = 1');
    $query->bindParam(':USUARIO',$usuario);
    $query->bindParam(':PASSWORD',$password);
    $resultado = $query->execute(); //el resultado de la consulta se guarda dentro de la variable
    $cantidad = $resultado; //cuenta la cantidad de filas que se obtuvo

    if(!isset($_SESSION)){
        session_start(); //se crea una sesion vacia para el usuario

        if($cantidad > 0){ //si existe el usuario deberiamos cargar la sesion con los 4 datos que tenemos
            $row=$query->fetch();
            if($row['ID']==1){ //si es gerente

                $_SESSION['id_usuario']=$row['ID'];   //se cargan 4 datos a la sesion (se pueden crear mas sin problemas)
                $_SESSION['nombre_usuario']=$row['NOMBRE'];
                $_SESSION['password']=$password;
                $_SESSION['usuario']=$usuario;

                header("Location:./home-gerente.php");
            }
            if($row['ID'] == 2){ //si es empleado

                $_SESSION['tipo_usuario'] = $row['TIPO'];
                header("Location:./home-empleado.php");
            }
            else{
                echo " error al tomar el tipo de usuario";
                include 'logout.php';
            }
        }
        else{                                   //si no existe
              echo $row=$query->fetch();
              echo $query->fetchColumn();
              echo $cantidad;
            //header("Location:../login.php");
        }
    }
?>
