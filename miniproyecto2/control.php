<?php
session_start();
include('crud.php');
$correo = $_POST['email'];
$contrasena = $_POST['contrasena'];
$resultado = $MySQLiconn->query("SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'");
$row = $resultado->fetch_assoc();
if($correo==$row['correo'] && $contrasena==$row['contrasena']){
    $_SESSION['nombre'] = $row['nombres'];
    $_SESSION['apellido'] = $row['apellidos'];
    $_SESSION['dni'] = $row['dni'];
    $_SESSION['tipo'] = $row['tipo_user'];
    $_SESSION['correo'] = $row['correo'];
    if($row['tipo_user']=="user_admin"){
        $_SESSION['identificador'] = "1";
        header('Location: usuarios.php');
    }
    if($row['tipo_user']=="user_g"){
        $_SESSION['identificador'] = "2";
        header('Location: opciones.php');
    }
} else {
    header('Location: index.php');
} 