<?php
    //requiere probar si funciona borrar sesion
    if(isset($_SESSION)){
        $_SESSION = array();
        session_destroy();
    }
?>
