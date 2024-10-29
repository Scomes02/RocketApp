<?php

$host = "localhost";
$User = "root";
$pass = "";
$db = "iniciosesioncapi";
$port = 3306;

$conexion = mysqli_connect($host, $User, $pass, $db);

if(!$conexion){
    echo "Conexion fallida";
}
?>
