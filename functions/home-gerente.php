<?php
if (!isset($_SESSION)) {
    session_start();
}
include __DIR__ . '/../functions/revisar-permiso.php';
    //si editarCliente existe significa que se quiere editar al empleado
    if(isset($_SESSION['cargo'])){
        if(consultar_permiso($_SESSION['cargo'], 15)){
            //GANACIA POR DIA
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $pordia = $stmt->fetch();

            //PROMEDIO DE GANANCIA POR DIA
            $stmt = prom_ganancia();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $lengthDia = $stmt->rowCount();
            $totalGanDia = 0;
            $promedio = $stmt->fetch();
            $totalGanDia += $promedio['TOTAL'];
            if ($lengthDia  > 0) {
                $totalGanDia = round($totalGanDia/$lengthDia);
            }
            //CANTIDAD DE CLIENTES POR DIA
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $length = $stmt->rowCount();
            $clientes_por_dia = $stmt->fetch();

            //PROMEDIO DE CLIENTES POR DIA
            $stmt = prom_clientes();
            $stmt->bindValue(':lim', 10);
            $stmt->execute();
            $length = $stmt->rowCount();
            $totalDia = 0;
            $promedio = $stmt->fetch();
            $totalDia += $promedio['TOTAL'];
            if ($length>0) {
                $totalDia = floor($totalDia/$length);
            }

            $titulo = 'Gerente';
            ob_start();     //se utiliza para poder guardar en la variable todo el contenido del template
            include __DIR__ . '/../templates/home-gerente.html.php';
            $contenido = ob_get_clean();
            include __DIR__ . '/../templates/layout.html.php';
        } 
        else {
            $_SESSION['error'] = 'No posee permisos para realizar esa acción';
            header('location: ../index.php');
        }
    }
 	else {
        $_SESSION['mensaje'] = 'No se encontró una sesión para ingresar a la URL';
        header('location: ../index.php');
    }

    