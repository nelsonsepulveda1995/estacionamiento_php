<?php
    //no hare validaciones en un simple select...

    include __DIR__ . '/../includes/connect.php';
    $query=$pdo->prepare('SELECT * FROM cliente');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<option value='".$row['PATENTE']."'>" . $row['PATENTE'] . "</option>"; 
    }
?>