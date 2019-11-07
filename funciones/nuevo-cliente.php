<?php
    //requiere probar si funciona
    require("incuded/connect.php");

    $patente=$_POST["patente"];
    $dni=$_POST["dni"];
    $id=$_POST["id"];

    $query=$conn->prepare("INSERT INTO cliente (`PATENTE`, `DNI`, `ID`)VALUES(:PATENTE,:DNI,:ID)");
    $query->bindParam(':PATENTE',$patente);
    $query->bindParam(':DNI',$dni);
    $query->bindParam(':ID',$id);
    $query->execute();
?>

