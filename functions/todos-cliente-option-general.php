<?php
    //no hare validaciones en un simple select...
    include __DIR__ . '/../includes/connect.php';
    $patente=$pdo->prepare('SELECT PATENTE FROM estadia WHERE EGRESO IS NULL');
    $patente->execute();
    $flag = 0;
    while ($rowPat = $patente->fetch()) {
        $flag = 1;
        $query=$pdo->prepare('SELECT * FROM cliente WHERE PATENTE = :PATENTE');
        $query->bindValue(':PATENTE',$rowPat['PATENTE']);
        $query->execute();
        while ($row = $query->fetch()) {
            echo "<option value='".$row['PATENTE']."'>" . $row['PATENTE'] . "</option>"; 
        } 
    }
    if ($flag == 0) {
        echo "<option value='-1'>No se encontraron patentes con salida pendiente.</option>";
    }
    
?>