<?php
require('crud.php');
include('seguridadUsuario.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/formularios.css">
    <script src="https://kit.fontawesome.com/ef09053d88.js" crossorigin="anonymous"></script>
    <title>Mercosur</title>
</head>
<body>
  <main>
  <a href="opciones.php" class="btn btn-danger ml-5 mt-3 p-0 mr-5"><i class="far fa-arrow-alt-circle-left h1 mt-1 mb-1 ml-3 mr-3"></i></a>
    <div class="registro-tabla mt-3 ml-5 mr-5">
      <div class="contenedor-form">
        <form class="p-2" method="POST">
          <div class="form-group">
              <h6>Nombre</h6>
              <input type="text" name="NombrePais" class="w-100 form-control" value="<?php if(isset($_GET['editarPa'])) echo $getROW[1] ?>">
          </div>
            
          <div class="form-group">
            <?php if(isset($_GET['editarPa'])){ ?>
              <input type="submit" value="Editar" class="btn btn-success w-100" name="EditarPais">
            <?php } else{ ?>                
              <input type="submit" value="Agregar" class="btn btn-success w-100" name="AgregarPais">
            <?php } ?>
          </div>
        </form>
      </div>
        <hr>
        <table class="table table-bordered table-sm ">
          <thead class="thead-dark table-bordered">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Nombre</th>
              <th scope="col" colspan="3">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-bordered">
            <?php
            $res=$MySQLiconn->query('SELECT * FROM paises ORDER BY id');
            while($row=$res->fetch_array()){ 
            ?>
            <tr>
              <th scope="row"><?php echo $row[0]; ?></th>
              <td><?php echo $row[1]; ?></td>
              <td><a href="?editarPa=<?php echo $row[0]; ?>"><i class="fas fa-edit h5 mb-0 mr-2 text-warning"></i></a>
              <a href="?eliminarPa=<?php echo $row[0]; ?>"><i class="fas fa-trash h5 mb-0 text-danger"></i></a>
              </td>
            </tr>
            <?php } ?>                  
          </tbody>
        </table>
    </div>
  </main>
</body>

</html>