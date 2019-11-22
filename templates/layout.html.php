<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!--CSS-->
    <?php if(isset($_SESSION['cargo'])): ?>
    <link rel="stylesheet" href="../includes/style.css">
    <?php else: ?>
    <link rel="stylesheet" href="./includes/style.css">
    <?php endif; ?>
    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/8bca061afe.js" crossorigin="anonymous"></script>
    <!-- tablesorter -->
    <script src="js/jquery.tablesorter.js"></script>
    <script src="js/jquery.tablesorter.widgets.js"></script>
    
    <link rel="stylesheet" href="css/jquery.tablesorter.pager.css">
    <script src="js/jquery.tablesorter.pager.js"></script>
    <style>
        .tablesorter-pager .btn-group-sm .btn {
            font-size: 1.2em;
            /* make pager arrows more visible */
        }
    </style>
    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script src="./../functions/script.js"></script>

    <title><?=$titulo?></title>
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <?php if(isset($_SESSION['cargo'])): ?>
            <?php if($_SESSION['cargo'] == 1): ?>
            <a class="navbar-brand" href="home-gerente.php">Estacionamiento</a>
            <?php elseif($_SESSION['cargo'] == 2): ?>
            <a class="navbar-brand" href="home-empleado.php">Estacionamiento</a>
            <?php endif; ?>
            <?php else: ?>
            <a class="navbar-brand" href="index.php">Estacionamiento</a>
            <?php endif;?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" id="buttonNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <?php if(isset($_SESSION['cargo'])): ?>
                    <?php if($_SESSION['cargo'] == 2): ?>
                    <li class="nav-item">
                        <a class="nav-link navMenu" href="./../functions/todos-clientes.php">
                                Ver lista de clientes
                        </a>                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navMenu" href="./../functions/registro-cliente.php">
                                Agregar un nuevo cliente
                        </a>                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navMenu" href="./../functions/ingreso-estadia.php">
                                Realizar ingreso
                        </a>                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navMenu" href="./../functions/egreso-estadia.php">
                                Realizar egreso
                        </a>                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navMenu" href="./../functions/todas-estadias.php">
                                Ver estadias
                        </a>                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navMenu" href="./../functions/pago_abonado.php">
                                Registrar Pago de Abonado
                        </a>                        
                    </li>
                    <?php elseif ($_SESSION['cargo'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./todos-clientes.php">Lista de clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./registro-cliente.php">Agregar cliente</a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <?php if(isset($_SESSION['usuario'])): ?>
                <span class="navbar-text">
                    <a class="nav-link disabled" href="logout.php"><?=$_SESSION['nombre']?></a>
                </span>
                <span class="navbar-text">
                    <a class="nav-link" href="logout.php">Salir</a>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!--contenido-->
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto text-center" id="body">
            
            <?=$contenido?>
            </div>
        </div>
    </div>
</body>

</html>