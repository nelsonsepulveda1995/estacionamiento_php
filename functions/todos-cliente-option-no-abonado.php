<?php
    //no hare validaciones en un simple select...

    include __DIR__ . '/../includes/connect.php';
    $patente=$pdo->prepare('SELECT * FROM cliente');
    $patente->execute();
    $flag = 0;
    while ($rowPat = $patente->fetch()) {
        $flag = 1;
        $query=$pdo->prepare('SELECT DISTINCT PATENTE FROM estadia WHERE PATENTE = :PATENTE AND EGRESO IS NULL');
        $query->bindValue(':PATENTE',$rowPat['PATENTE']);
        $query->execute();
        while ($row = $query->fetch()) {
            $flag = 3;
        }
        if ($flag != 3) {
            $query=$pdo->prepare('SELECT DISTINCT PATENTE FROM estadia WHERE PATENTE = :PATENTE AND EGRESO IS NOT NULL');
            $query->bindValue(':PATENTE',$rowPat['PATENTE']);
            $query->execute();
            while ($row = $query->fetch()) {
                $flag = 2;
                echo "<option value='".$row['PATENTE']."'> Egreso-" . $row['PATENTE'] . "</option>"; 
            }
        }
        if ($flag == 1) {
            echo "<option value='".$rowPat['PATENTE']."'> Sin estadia-" . $rowPat['PATENTE'] . "</option>";
        }

    }
    if ($flag == 0) {
        echo "<option value='-1'>No se encontraron patentes con posibilidad de ingreso.</option>";
    }
?>