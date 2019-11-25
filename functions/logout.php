<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION = [];
    session_destroy();
    header('location: ../index.php');
?>
