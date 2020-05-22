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
    <script src="js/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#pais1').change(function(){
                var pais1 = $('#pais1').val();
                console.log(pais1);
                
                $.post('crud.php',{nombre:pais1},function(data){
                    $('#pais2').html(data);
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
                        <h6>Pais 1</h6>
                        <select class="custom-select form-control" name="pais1" id="pais1">
                            <?php if(isset($_GET['editarRe'])){?>
                                <option value="<?php echo $getROW[3]?>"><?php echo "Editar: $getROW[1]";?></option>
                            <?php } else {?>
                                <option value="0">Seleccione Pais</option>
                            <?php } 

                            $res_op=$MySQLiconn->query('SELECT * FROM paises;');
                            while($row_op=$res_op->fetch_array()){ 
                            ?>
                                <option value="<?php echo $row_op[0] ?>"><?php echo "$row_op[1]" ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>Pais 2</h6>
                        <select name="pais2" id="pais2" class="custom-select form-control">
                        
                        <?php if(isset($_GET['editarRe'])){
                            $resultados_editar = $MySQLiconn->query("SELECT id, pais FROM paises WHERE id != all(SELECT id_pais2 FROM relaciones WHERE id_pais1 =".$getROW[3].") AND id != ".$getROW[3]);
                            echo "<option value = ".$getROW[3].">".$getROW[2]."</option>";
                            while($row = $resultados_editar ->fetch_array()){
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
                        <h6>Fecha</h6>
                        <input type="date" name="fecha" class="w-100 form-control" value="<?php if(isset($_GET['editarRe'])){echo "$getROW[5]";} ?>">
                    </div>
                    
                    
                    <div class="form-group">
                    <?php if(isset($_GET['editarRe'])){?>
                        <input type="submit" value="Editar" name="EditarRelacion" class="btn btn-success w-100">
                    <?php }else{?> 
                        <input type="submit" value="Agregar" name="AgregarRelacion" class="btn btn-success w-100">
                    <?php }?>
                    </div>
                    
                </form>
            </div>
            <hr>

            <table class="table table-bordered table-sm">
                <thead class="thead-dark table-bordered">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Pais 1</th>
                    <th scope="col">Pais 2</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" colspan="2">Acciones</th>
                  </tr>
                </thead>
                <tbody class="table-bordered">
                <?php
                    $res=$MySQLiconn->query('SELECT r.id, p1.pais, p2.pais, r.fecha_relacion FROM relaciones r JOIN paises p1 ON r.id_pais1 = p1.id JOIN paises p2 ON r.id_pais2 = p2.id ORDER BY p1.pais;');
                    while($row=$res->fetch_array()){ 
                    ?>
                    <tr>
                    <th scope="row"><?php echo $row[0]; ?></th>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><a href="?editarRe=<?php echo $row[0]; ?>"><i class="fas fa-edit h5 mb-0 mr-2 text-warning"></i></a>
                    <a href="?eliminarRe=<?php echo $row[0]; ?>"><i class="fas fa-trash h5 mb-0 text-danger"></i></a></td>
                    </tr>
                    <?php } ?>                
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>