<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div>
    <form action="control.php" method="POST">
        <h1 class="text-center">Iniciar sesión</h1>
        <input type="email" name="email" placeholder="Correo" class="mt-3">
        <input type="password" name="contrasena" placeholder="Contraseña" class="mt-3">
        <input type="submit" name="submit" value="Iniciar sesion" class="mt-3">
    </form>
    </div>
</body>
</html>