<?php
include('seguridad.php'); 
include('crud.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="listado.css">
</head>
<body>
    <header>
        <div>
            <h3>Bienvenido <?php echo $_SESSION['nombre'] ?></h3>
            <p>Usuario: Administrador</p>
        </div>
        <div>
            <a class="salir" href="salir.php">Cerrar sesion</a>
        </div>
    </header>
    <section class="main">
    <div>
        <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Tipo de usuario</th>
        </tr>
        <?php
        $resultado = $conexion->query("SELECT * FROM usuarios");
        while($row = $resultado->fetch_assoc()) {?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['apellido'] ?></td>
            <td><?php echo $row['correo'] ?></td>
            <td><?php echo $row['tipo_user'] ?></td>
        </tr>
        <?php } ?>
        </table>
    </div>
    </section>
</body>
</html>