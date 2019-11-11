<?php
    require("included/connect.php");
    $query=$conn->prepare('SELECT * FROM usuarios');
    $query->execute();
    while ($row = $query->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['NOMBRE'] . "</td>";
        echo "<td>" . $row['ESTADO'] . "</td>";
        echo "<td><button  type='button' id_usuario='".$row['ID_USUARIO']."' >Editar</button></td>";
        echo "</tr>"
    }
?>