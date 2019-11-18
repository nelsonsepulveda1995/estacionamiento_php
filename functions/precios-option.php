<?php
    //no hare validaciones en un simple select...

    require("included/connect.php");
    $query=$conn->query('SELECT * FROM precio');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<option value='".$row['ID_PRECIO']."'>" . $row['PRECIO'] ."</option>"; 
    }
?>