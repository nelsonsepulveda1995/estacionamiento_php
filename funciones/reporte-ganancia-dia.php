<?php
    if(isset($_SESSION)){                 //existe la sesion?
        if($_SESSION["ID"]==1){          //es gerente?
            require("included/connect.php");
            $hoy= getdate();            //obtengo la fecha 

            $query=$conn->prepare('SELECT TOTAL FROM ESTADIA WHERE ');  //completar con condicion
            $query->execute();
            $total=0; //guardo el total del buqle

            while ($row = $query->fetch()) {
                # code...
            }
        }
        else { //si la sesion no es la correcta
            # code...
        }
    }

    else { //si no existe la sesion
        header("Location:../login.php");
    }
?>