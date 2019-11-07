<?php
    //relizar comprobacion de seseion aca antes ejecutar todo

    require("included/connect.php");
    $query=$conn->prepare('SELECT * FROM cliente');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<option value='".$row['ID_CARR']."'>" . $row['DESCRIPCION'] . "</option>"; 
    }
?>