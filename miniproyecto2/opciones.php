<?php
include('seguridadUsuario.php');
require('crud.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/formularios.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Mercosur</title>
</head>
<body>
    <main class="container">
        <h1 class="font-weight-bold">MERCOSUR</h1>
        <div class="botones">
            <a href="paises.php" class="btn-primary">Paises</a><br>
            <a href="productos.php" class="btn-success">Productos</a><br>
            <a href="diplomaticas.php" class="btn-dark">Relaciones Diplomáticas</a><br>
            <a href="comercios.php" class="btn-info">Relaciones Comerciales</a>
        </div>
        <hr>
    </main>
    <footer>
        <a href="salir.php" class="container bb-1  text-danger">Cerrar sesión</a>
    </footer>
    
</body>
</html>