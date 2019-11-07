<?php
    if(!isset($_SESSION)){
        header("Location:./login.php");
    }
    else{
        if($_SESSION['tipo_usuario'] == 1){
            header("Location:./home-gerente.php");
        }
        else{
            header("Location:./login.php");
        }
    }
?>
<div class="row">
    <div class="col-md-8 mx-auto text-center">
        <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Bienvenido al sistema, Empleado</h5>
                <hr class="my-4">
                <p>Seleccione una opción de lo que desea hacer:</p>
                <a href="/empleado/cliente/ver">
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
    </div>
</div>