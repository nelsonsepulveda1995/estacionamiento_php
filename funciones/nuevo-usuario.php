<?php
    //requiere probar si funciona
    require("incuded/connect.php");

    $nombre=$_POST["nombre"];
    $usuario=$_POST["usuario"];
    $password=$_POST["password"];
    $id=$_POST["id"];


    $query=$conn->prepare("INSERT INTO usuario (`nombre`,`usuario`,'password', `ID`)VALUES(  `:usuario`, `:PASSWORD`, `:ID`)");
    $query->bindParam(':nombre',$nombre);
    $query->bindParam(':usuario',$usuario);
    $query->bindParam(':ID',$id);
    $query->bindParam(':PASSWORD',$password);

    $query->execute();
?>
