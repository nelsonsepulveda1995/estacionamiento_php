<?php
    //requiere probar si funciona
    require("incuded/connect.php");

    $usuario=$_POST["usuario"];
    $password=$_POST["password"];

    $query=$conn->prepare("SELECT (`NOMBRE`,`TIPO`) FROM USUARIO WHERE USUARIO =:USUARIO AND `PASSWORD` =`:PASSWORD` AND ESTADO = 1");
    $query->bindParam(':USUARIO',$usuario);
    $query->bindParam(':PASSWORD',$password);
    $query->execute();
    $cantidad=$query->fetchColumn(); //toma la cantidad de columnas devueltas (probar)

    if($cantidad > 0 && $cantidad < 2){ //si existe el usuario deberiamos cargar la sesion con los 4 datos que tenemos

    }
    else{   //si no existe
        
    }
?>
