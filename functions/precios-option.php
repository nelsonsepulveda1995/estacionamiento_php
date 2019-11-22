<?php
    //no hare validaciones en un simple select...
    $id = $_POST['key'];
    include __DIR__ . '/../includes/connect.php';
    $query=$pdo->prepare('SELECT * FROM cliente WHERE PATENTE=:PATENTE');
    $query->bindValue(':PATENTE',$id);
    $query->execute();
    $res = $query->fetch();
    $query=$pdo->query('SELECT * FROM precio');
    $query->execute();
    while ($row = $query->fetch()) {
        if ($row['ID_PRECIO']!=3) {
            if ($res['ID']==$row['ID_PRECIO']) {
                echo "<option value='".$row['ID_PRECIO']."' selected>" . $row['PRECIO'] ."</option>"; 
            }else{
                echo "<option value='".$row['ID_PRECIO']."'>" . $row['PRECIO'] ."</option>";
            }
        }
    }
?>