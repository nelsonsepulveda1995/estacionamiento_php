<div class="row">
    <div class="col-md-6 mx-auto">
    <?php
    include "included/head.php";
if (!empty($errors)) :
    ?>
    <div class="errors">
        <p>El abonado no pudo ser creado debido a:</p>
        <ul>
        <?php
            foreach ($errors as $error) :
                ?>
                <li><?= $error ?></li>
                <?php
            endforeach; ?>
        </ul>
    </div>

<?php 
    endif;
    if(!isset($_SESSION)){
        header("Location:./login.php");
    }
?>

<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Alta de abonado</h5>
            <form class="#" action="" method="POST">
                <select name="" id="select_clientes" require>       <!-- Ingresar en el select los clientes que no son abonados -->

                </select>

                <?php
                    echo('<br>');
                    echo('<h5>el precio para abonado  es de 5000pe<h5>')
                ?>
                <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Registrar Abonado">
            </form>
        </div>
    </div>
</div>

<?php
    include "included/fooder.php"
?>