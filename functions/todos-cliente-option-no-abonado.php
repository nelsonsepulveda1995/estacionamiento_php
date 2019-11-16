<?php
    //no hare validaciones en un simple select...

    require("included/connect.php");
    $query=$conn->prepare('SELECT * FROM cliente where ID=2');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<option value='".$row['PATENTE']."'>" . $row['PATENTE'] . "</option>"; 
    }
?>