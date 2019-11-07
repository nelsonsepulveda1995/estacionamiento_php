<?php
    //no hare validaciones en un simple select...

    require("included/connect.php");
    $query=$conn->prepare('SELECT * FROM usuarios');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<option value='".$row['ID_USUARIO']."'>" . $row['NOMBRE'] ."</option>"; 
    }
?>