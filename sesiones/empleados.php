<?php 
include('seguridad2.php'); 
include('crud.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epmpleados</title>
    <link rel="stylesheet" href="empleados.css">
    <script src="https://kit.fontawesome.com/ef09053d88.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div>
            <h3>Bienvenido <?php echo $_SESSION['nombre'] ?></h3>
            <p>Usuario: General</p>
        </div>
        <div>
            <a class="salir" href="salir.php">Cerrar sesion</a>
        </div>
    </header>
    <section class="main">
    <div class="formulario">
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php if(isset($_GET['editar'])) echo $row['nombre'] ?>">
        <input type="text" name="apellido" placeholder="Apellido" value="<?php if(isset($_GET['editar'])) echo $row['apellido'] ?>">
        <input type="text" name="dni" placeholder="DNI" value="<?php if(isset($_GET['editar'])) echo $row['dni'] ?>">
        <input type="text" name="correo" placeholder="Correo" value="<?php if(isset($_GET['editar'])) echo $row['correo'] ?>">
        <input type="text" name="cargo" placeholder="Cargo" value="<?php if(isset($_GET['editar'])) echo $row['cargo'] ?>">
        <?php if(isset($_GET['editar'])){ ?>
        <input type="submit" value="Editar" name="update">
        <?php } else { ?>
        <input type="submit" value="Registrar" name="registro">
        <?php } ?>
    </form>
    </div>
    <div>
        <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Correo</th>
            <th>Cargo</th>
            <th>Acciones</th>
        </tr>
        <?php
        $resultado = $conexion->query("SELECT * FROM empleados");
        while($row = $resultado->fetch_assoc()) {?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['apellido'] ?></td>
            <td><?php echo $row['dni'] ?></td>
            <td><?php echo $row['correo'] ?></td>
            <td><?php echo $row['cargo'] ?></td>
            <td><a class="editar" href="?editar=<?php echo $row['id']; ?>">Editar</a>
            <a class="rojo" href="?del=<?php echo $row['id']; ?>"><i class="fas fa-trash h5 mb-0"></a></td>
        </tr>
        <?php } ?>
        </table>
    </div>
    </section>
</body>
</html>