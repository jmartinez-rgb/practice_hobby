<?php
require('crud.php');
include('seguridadUsuario.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/formularios.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/ef09053d88.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#comercio1').change(function(){
                var comercio1 = $('#comercio1').val();
                
                
                $.post('crud.php',{comercio:comercio1},function(data){
                    $('#comercio2').html(data);
                })
                
            });

        }); 
    </script>
    <title>Mercosur</title>
</head>
<body>
    <main>
    <a href="opciones.php" class="btn btn-danger ml-5 mt-3 p-0"><i class="far fa-arrow-alt-circle-left h1 mt-1 mb-1 ml-3 mr-3"></i></a>
        <div class="registro-tabla mt-3 ml-5 mr-5">
            <div class="contenedor-form">
                <form class="p-2" method="POST">
                    <div class="form-group">
                        <h6>Exportador</h6>
                        <select class="custom-select form-control" name="comercio1" id="comercio1">
                            <?php if(isset($_GET['editarCo'])){ ?>
                            <option value="<?php echo $id_pais1; ?>">Editar: <?php echo $pais1; ?></option>
                            <?php }else{ ?>
                            <option value="0">Seleccione pais</option>
                            <?php }?>

                            <?php $res_op = $MySQLiconn->query("SELECT * FROM paises;");
                            while($row_op = $res_op->fetch_array()){ 
                            ?>
                                <option value="<?php echo $row_op[0] ?>"><?php echo "$row_op[1]" ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>Comprador</h6>
                        <select class="custom-select form-control" name="comercio2" id="comercio2">
                        <?php if(isset($_GET['editarCo'])){
                            $res_paises2 = $MySQLiconn->query("SELECT id, pais FROM paises WHERE id = any(SELECT id_pais2 FROM relaciones WHERE id_pais1 = $id_pais1) AND id != $id_pais2");
                            echo "<option value = ".$id_pais2.">".$pais2."</option>";
                            while($row = $res_paises2 ->fetch_array()){
                                $html = $html."<option value= ".$row[0].">".$row[1]."</option>";
                            }
                            echo $html;
                            ?>
                        <?php } else {?>
                            <option value="0">Seleccione Pais</option>
                        <?php } ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>Producto</h6>
                        <select class="custom-select form-control" name="producto" id="producto">
                        <?php if(isset($_GET['editarCo'])){?>
                            <option value="<?php echo $id_producto?>"><?php echo $producto; ?></option>
                            <?php $res_op = $MySQLiconn->query("SELECT id,descripcion FROM productos WHERE id!=$id_producto;");
                            while($row_op = $res_op->fetch_array()){ 
                            ?>
                                <option value="<?php echo $row_op[0] ?>"><?php echo "$row_op[1]" ?></option>
                            <?php } ?>
                        <?php }else{?>
                            <option value="0">Seleccione producto</option>
                            <?php $res_op = $MySQLiconn->query("SELECT id,descripcion FROM productos;");
                            while($row_op = $res_op->fetch_array()){ 
                            ?>
                                <option value="<?php echo $row_op[0] ?>"><?php echo "$row_op[1]" ?></option>
                            <?php } ?>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>Cantidad de venta</h6>
                        <input type="text" name="cantidad" class="w-100 form-control" value="<?php if(isset($_GET['editarCo'])){echo $cant_vendida; } ?>">
                    </div>
                    <div class="form-group">
                    <?php if(isset($_GET['editarCo'])){?>
                        <input type="submit" value="Editar" class="btn btn-success w-100" name="EditarComercio">
                    <?php }else{ ?>
                    
                        <input type="submit" value="Agregar" class="btn btn-success w-100" name="AgregarComercio">
                    
                    <?php } ?>
                    </div>
                </form>
            </div>
            <hr>
            <table class="table table-bordered table-sm">
                <thead class="thead-dark table-bordered">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Exportador</th>
                    <th scope="col">Comprador</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad vendida</th>
                    <th scope="col">Pago</th>
                    <th scope="col" colspan="2">Acciones</th>
                  </tr>
                </thead>
                <tbody class="table-bordered">
                <?php $res = $MySQLiconn->query("SELECT e.id, p1.pais,p2.pais, pro.descripcion, e.cantidad_vendida, e.total FROM exportaciones e JOIN productos pro ON e.id_productos = pro.id JOIN relaciones r on r.id = e.id_relaciones JOIN paises p1 ON p1.id = r.id_pais1 JOIN paises p2 ON p2.id = r.id_pais2"); 
                while ($row = $res ->fetch_array()){
                ?>
                  <tr>
                    <th scope="row"> <?php echo $row[0] ?></th>
                    <td><?php echo $row[1] ?></td>
                    <td><?php echo $row[2] ?></td>
                    <td><?php echo $row[3] ?></td>
                    <td><?php echo $row[4] ?></td>
                    <td><?php echo $row[5] ?></td>
                    <td><a href="?editarCo=<?php echo $row[0]; ?>"><i class="fas fa-edit h5 mb-0 mr-2 text-warning"></i></a>
                    <a href="?eliminarCo=<?php echo $row[0]; ?>"><i class="fas fa-trash h5 mb-0 text-danger"></i></a></td>
                  </tr>
                <?php }?>                 
                </tbody>
            </table>
        </div>
    </main>  
</body>
</html>