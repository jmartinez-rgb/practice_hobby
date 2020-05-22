<?php
include("seguridadAdmin.php");
include('crud.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/formularios.css">
    <script src="https://kit.fontawesome.com/ef09053d88.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <style>
        input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<main>
    <div class="registro-tabla mt-3 ml-5 mr-5">
      <div class="contenedor-form">
        <form class="p-2" method="POST">
          <div class="form-group">
              <h2 class="text-center">Registro usuarios</h2>
              <input type="email" name="correo" class="w-100 form-control" placeholder="Correo" value="<?php if(isset($_GET['editar'])) echo $getROW['correo'] ?>">
              <input type="password" name="contrasena" class="w-100 form-control" placeholder="Contraseña" value="<?php if(isset($_GET['editar'])) echo $getROW['contrasena'] ?>">
              <input type="text" name="nombre" class="w-100 form-control" placeholder="Nombre" value="<?php if(isset($_GET['editar'])) echo $getROW['nombres'] ?>">
              <input type="text" name="apellido" class="w-100 form-control" placeholder="Apellido" value="<?php if(isset($_GET['editar'])) echo $getROW['apellidos'] ?>">
              <input type="text" name="dni" class="w-100 form-control" placeholder="dni" value="<?php if(isset($_GET['editar'])) echo $getROW['dni'] ?>">
              <select name="tipo" class="custom-select form-control">
            <?php if(isset($_GET['editar'])){?>
                <option value="<?php echo $getROW['tipo_user']?>"><?php if($getROW['tipo_user']=="user_admin"){ echo "Editar: Administrador";} else{echo "Editar: Usuario";}?></option>
            <?php } else {?>
                <option value="0">Seleccione tipo de usuario</option>
            <?php } ?>
                <option value="user_g">Usuario</option>
                <option value="user_admin">Administrador</option>
              </select>
          </div>
            
          <div class="form-group">
            <?php if(isset($_GET['editar'])){ ?>
              <input type="submit" value="Editar" class="btn btn-success w-100" name="EditarUser">
            <?php } else{ ?>                
              <input type="submit" value="Agregar" class="btn btn-success w-100" name="AgregarUser">
            <?php } ?>
          </div>
          <hr>
          <a href="salir.php" class="btn btn-danger w-100">Cerrar sesion</a>
        </form>
      </div>
        <hr>
        <table class="table table-bordered table-sm ">
          <thead class="thead-dark table-bordered">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Correo</th>
              <th scope="col">Contraseña</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">DNI</th>
              <th scope="col">Tipo de usuario</th>
              <th scope="col" colspan="3">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-bordered">
            <?php
            $res=$MySQLiconn->query('SELECT * FROM usuarios ORDER BY id');
            while($row=$res->fetch_assoc()){ 
            ?>
            <tr>
              <th scope="row"><?php echo $row['id']; ?></th>
              <td><?php echo $row['correo']; ?></td>
              <td><?php echo $row['contrasena']; ?></td>
              <td><?php echo $row['nombres']; ?></td>
              <td><?php echo $row['apellidos']; ?></td>
              <td><?php echo $row['dni']; ?></td>
              <td><?php if($row['tipo_user']=="user_admin") {echo "Administrador";}else{echo "Usuario";}?></td>
              <?php if($_SESSION['dni']==$row['dni']){
                  continue;
              }else{ ?>
              <td><a href="?editar=<?php echo $row['id']; ?>"><i class="fas fa-edit h5 mb-0 mr-2 text-warning"></i></a>
              <a href="?eliminar=<?php echo $row['id']; ?>"><i class="fas fa-trash h5 mb-0 text-danger"></i></a>
              </td>
              <?php } ?>
            </tr>
            <?php } ?>                  
          </tbody>
        </table>
    </div>
  </main>

</body>
</html>