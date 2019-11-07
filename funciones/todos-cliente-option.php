<?php
    //no hare validaciones en un simple select...

    require("included/connect.php");
    $query=$conn->prepare('SELECT * FROM cliente');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<option value='".$row['PATENTE']."'>" . $row['PATENTE'] . "</option>"; 
    }
?>