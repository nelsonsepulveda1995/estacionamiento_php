<?php session_start() ?>

<?php
    //if(($_SESSION['id_usuario'])){            esta validacion no toma la sesion que esta creada
    //   echo
    //}
    //else{
    //    if($_SESSION['id_usuario'] == 1){
    //        header("Location:   home-gerente.html.php");
    //    }
    //}
?>
<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Bienvenido al sistema, Empleado</h5>
        <hr class="my-4">
        <p>Seleccione una opción de lo que desea hacer:</p>
        <a href="/listaempleados.php">
            <button type="button" class="btn  btn-info">
                <i class="fas fa-users" aria-hidden="true"></i> Ver lista de clientes
            </button>
        </a>
        <a href="/empleado/cliente/agregar">
            <button type="button" class="btn  btn-info">
                <i class="fas fa-user-plus"></i> Agregar un nuevo cliente
            </button>
        </a>
        <a href="/gerente/empleados/agregar">
            <button type="button" class="btn -lg btn-info">
                <i class="fas fa-users" aria-hidden="true"></i> Realizar ingreso
            </button>
        </a>
        <a href="/gerente/reportes">
            <button type="button" class="btn -lg btn-info">
                <i class="fas fa-users" aria-hidden="true"></i> Realizar egreso
            </button>
        </a>
        <a href="/gerente/reportes">
            <button type="button" class="btn -lg btn-info">
                <i class="fas fa-users" aria-hidden="true"></i> Ver estadias
            </button>
        </a>
    </div>
</div>