<?php
session_start();
require('crud.php');
$correo = $_POST['correo'];
$resultado = $conexion->query("SELECT * FROM usuarios where correo='$correo'");
$fila = $resultado->fetch_assoc();
if($correo == $fila['correo']){
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellido'] = $fila['apellido'];
    $_SESSION['correo'] = $fila['correo'];
    $_SESSION['tipo'] = $fila['tipo_user'];
    if($_SESSION['tipo']=='user_admin'){
        $_SESSION['user'] = '1';
        header('Location: usuarios.php');
    }else{
        $_SESSION['user'] = '2';
        header('Location: empleados.php');
    }
}else {
    header('Location: index.php?errorusuario=si');
}