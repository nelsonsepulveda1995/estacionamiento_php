<?php
session_start();

$servername = "localhost"; $username = "root"; $password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=estacionamiento", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e){
    echo"Connection failed: " . $e->getMessage();
    }

function cerrar(){
    global $conn;
    $conn = null;
}
?>