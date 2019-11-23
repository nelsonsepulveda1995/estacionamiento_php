<?php session_start() ?>

<?php
    if (isset($_SESSION['error'])){
        echo    '<div class="alert alert-danger alert-dismissible fade show mt-5 text-center" role="alert">'
                    . $_SESSION['error'] .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        unset($_SESSION['error']);
    }
?>

<div class="card card-signin my-5">
    <div class="card-body">
        <h5 class="card-title text-center">Bienvenido al sistema, Gerente</h5>
        <hr class="my-4">
    </div>
</div>