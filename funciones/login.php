<?php
    //requiere probar si funciona
    require("incuded/connect.php");

    $usuario  = $_POST["usuario"];
    $password = $_POST["password"];

    $query = $conn->prepare("SELECT (`NOMBRE`,`TIPO`) FROM USUARIO WHERE USUARIO =:USUARIO AND `PASSWORD` =`:PASSWORD` AND ESTADO = 1");
    $query->bindParam(':USUARIO',$usuario);
    $query->bindParam(':PASSWORD',$password);
    $query->execute(); //el resultado de la consulta queda guardado aca
    $cantidad = $query->fetchColumn(); //toma la cantidad de columnas devueltas (probar)

    if(!isset($_SESSION)){
        session_start(); //se crea una sesion vacia para el usuario

        if($cantidad > 0 && $cantidad < 2){ //si existe el usuario deberiamos cargar la sesion con los 4 datos que tenemos
            $row=$query->fetch();
            if($row['TIPO']==1){ //si es gerente

                $_SESSION['tipo_usuario']=$row['TIPO'];   //se cargan 4 datos a la sesion (se pueden crear mas sin problemas)
                $_SESSION['nombre_usuario']=$row['NOMBRE'];
                $_SESSION['password']=$password;
                $_SESSION['usuario']=$usuario;

                header("Location:./home-gerente.php");
            }
            if($row['TIPO'] == 2){ //si es empleado

                $_SESSION['tipo_usuario'] = $row['TIPO'];
                header("Location:./home-empleado.php");
            }
            else{
                echo "error al tomar el tipo de usuario";
            }
        }
        else{   //si no existe
            header("Location:/login.php");
        }
    }
?>
