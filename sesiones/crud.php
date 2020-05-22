<?php

include_once('db.php');
if($_SESSION['user']=='1' || $_SESSION['user']=="2"){
    if(isset($_POST['registro'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $correo = $_POST['correo'];
        $cargo = $_POST['cargo'];
        $id = NULL;
        $statement = $conexion->prepare("INSERT INTO empleados(id, nombre, apellido, dni, correo, cargo) VALUES(?, ?, ?, ?, ?, ?)");
        $statement->bind_param('ssssss',$id, $nombre, $apellido, $dni, $correo, $cargo);
        $statement->execute();
        header('Location: empleados.php');
    }
    if(isset($_GET['editar'])){
        $resultado = $conexion->query("SELECT * FROM empleados WHERE id=".$_GET['editar']);
        $row = $resultado->fetch_assoc();
    }
    if(isset($_POST['update'])){
        $resultado = $conexion->query("UPDATE empleados SET nombre='".$_POST['nombre']."', apellido='".$_POST['apellido']."', dni='".$_POST['dni']."', correo='".$_POST['correo']."', cargo='".$_POST['cargo']."' WHERE id=".$_GET['editar']);
        header('Location: empleados.php');
    }
    if(isset($_GET['del'])){
        $resultado = $conexion->query("DELETE FROM empleados WHERE id=".$_GET['del']);
        header('Location: empleados.php');
    }
}