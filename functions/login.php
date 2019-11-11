<?php
    /*      es lo que estaba en el anterior login.php
        if (isset($error)):
            echo    '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">'
                        . $error .
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        endif;

        //si ya existe una sesion activa redirige automaticamente (o deberia :P )
        if (isset($_SESSION)):
            if(!isset($_SESSION['tipo_usuario'])):
                if($_SESSION['tipo_usuario']==1){
                    header("Location:./home-gerente.php");
                }
                if($_SESSION['tipo_usuario']==1){
                    header("Location:./home-empleado.php");
                }
            endif;
        endif;
    */
    include __DIR__ . '/../includes/connect.php';

    //siempre inicializar las variables;
    $usuario = '';
    $password = '';

    if (isset($_POST['usuario']) AND isset($_POST['password'])) {
        $usuario  = $_POST['usuario'];
        $password = $_POST['password'];

        $query = $pdo->prepare('SELECT `NOMBRE` , `ID` FROM `usuarios` WHERE `USUARIO` = :USUARIO AND `PASSWORD` = :PASSWORD AND `ESTADO` = 1');
        $query->bindValue(':USUARIO', $usuario);
        $query->bindValue(':PASSWORD', $password);
        $query->execute();
        $resultado = $query->fetch(); //el resultado de la consulta se guarda dentro de la variable
        $cantidad = count($resultado); //cuenta la cantidad de filas que se obtuvo
        echo $cantidad;

        if(!isset($_SESSION)){
            session_start(); //se crea una sesion vacia para el usuario

            if($cantidad > 0){ //si existe el usuario deberiamos cargar la sesion con los 4 datos que tenemos
                $row=$resultado;
                if($row['ID']==1){ //si es gerente

                    $_SESSION['id_usuario']=$row['ID'];   //se cargan 4 datos a la sesion (se pueden crear mas sin problemas)
                    $_SESSION['nombre_usuario']=$row['NOMBRE'];
                    $_SESSION['password']=$password;
                    $_SESSION['usuario']=$usuario;

                    header("location: home-gerente.php");
                }
                if($row['ID'] == 2){ //si es empleado

                    $_SESSION['tipo_usuario'] = $row['TIPO'];
                    header("location: home-empleado.php");
                }
                else{
                    echo " error al tomar el tipo de usuario";
                }
            }
            else{                                   //si no existe
                echo 'El usuario no existe';
            }
        }
    } else {
        echo 'No se pudo tomar el $_POST';
    }
?>
