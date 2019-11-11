<?php
    //no hare validaciones en un simple select...

    require("included/connect.php");
    $query=$conn->prepare('SELECT * FROM cliente');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<tr id='".$row['PATENTE']."'>"
        echo "<td>'".$row['PATENTE']."'</td>";
        echo "<td>'".$row['DNI']."'</td>";
        echo "<td>'".$row['ID']."'</td>";
?>