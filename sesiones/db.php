<?php

$conexion = new mysqli('localhost','root','','sesiones');

if($conexion->connect_errno) {
    die('Hubo un problema con el servidor');
}