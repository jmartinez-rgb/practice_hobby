<?php
require_once('db.php');
/* --------------------------------------------------------------------------------- */
/* Página - Paises*/
// no es seguro, falta validar

if(isset($_POST['AgregarUser'])){
    $select = $MySQLiconn->query("SELECT MAX(id) FROM usuarios");
    $id = $select ->fetch_array();
    $id = intval($id[0])+1;

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $tipo = $_POST['tipo'];
    $resultado = $MySQLiconn->query("INSERT INTO usuarios VALUES($id, '$correo', '$contrasena','$nombre', '$apellido', '$dni', '$tipo')");
    header('Location: usuarios.php');
}
if(isset($_GET['editar'])){
    $resultado = $MySQLiconn->query("SELECT * FROM usuarios WHERE id=".$_GET['editar']);
    $getROW = $resultado->fetch_assoc();
}
if(isset($_POST['EditarUser'])){
    $resultado = $MySQLiconn->query("UPDATE usuarios SET correo='".$_POST['correo']."', contrasena='".$_POST['contrasena']."', nombres='".$_POST['nombre']."', apellidos='".$_POST['apellido']."', dni='".$_POST['dni']."', tipo_user='".$_POST['tipo']."' WHERE id=".$_GET['editar']);
    header('Location: usuarios.php');
}
if(isset($_GET['eliminar'])){
    $resultado = $MySQLiconn->query("DELETE FROM usuarios WHERE id=".$_GET['eliminar']);
    header('Location: usuarios.php');
}

if(isset($_POST['AgregarPais'])){
    $id = $MySQLiconn->query("SELECT id FROM paises");
    $num = $id->num_rows;
    $num = $num+1;

    $NombrePais = $MySQLiconn ->real_escape_string($_POST['NombrePais']);
    
    $sql = $MySQLiconn->query("INSERT INTO paises VALUES($num,'$NombrePais')");
    if(!$sql){
        echo $MySQLiconn->error;
    }
    header('Location: paises.php');
    
}

if(isset($_GET['eliminarPa'])){
    $sql = $MySQLiconn->query("DELETE FROM paises WHERE id=".$_GET['eliminarPa']);
    header('Location: paises.php');
}
if(isset($_GET['editarPa'])){
    $sql = $MySQLiconn->query("SELECT * FROM paises WHERE id=".$_GET['editarPa']);
    $getROW = $sql->fetch_array();
}
if(isset($_POST['EditarPais'])){
    $sql = $MySQLiconn->query("UPDATE paises SET pais='".$_POST['NombrePais']."' WHERE id=".$_GET['editarPa']);
    header('Location: paises.php');
}

/* --------------------------------------------------------------------------------- */

/*Página - Productos*/

/*Hay que cambiar esto*/



if(isset($_POST['AgregarProducto'])){
    
    $id = $MySQLiconn->query("SELECT id FROM productos");
    $num = $id->num_rows;
    $num = $num+1;

    $descripcion = $MySQLiconn->real_escape_string($_POST['descripcion']);
    $stock = intval($MySQLiconn->real_escape_string($_POST['stock']));
    $precio_u = floatval($MySQLiconn->real_escape_string($_POST['precio_u']));
    
    $sql = $MySQLiconn->query("INSERT INTO productos
    VALUES($num,'$descripcion',$stock,$precio_u)");
    if(!$sql){
        echo $MySQLiconn->error;
    }
    header('Location: productos.php');
}

if(isset($_GET['eliminarP'])){
    $sql = $MySQLiconn->query("DELETE FROM productos WHERE id=".$_GET['eliminarP']);
    header('Location: productos.php');
}

if(isset($_GET['editarP'])){
    $sql = $MySQLiconn->query("SELECT * FROM productos WHERE id=".$_GET['editarP']);
    $getROW = $sql->fetch_array();
}

if(isset($_POST['EditarProducto'])){
    $id = intval($_GET['editarP']);
    $descripcion = $_POST['descripcion'];
    $precio_unitario = floatval($_POST['precio_u']);
    $sql = $MySQLiconn->query("UPDATE productos SET id=$id,descripcion='$descripcion',precio_unitario=$precio_unitario WHERE id=$id");
    header('Location: productos.php');
}
/* --------------------------------------------------------------------------------- */

/*Página - Diplomaticas*/
if(isset($_POST['AgregarRelacion'])){
    $id = $MySQLiconn->query("SELECT id FROM relaciones");
    $num = $id->num_rows;
    $num = $num+1;
    
    $pais1 = intval($_POST['pais1']);
    $pais2 = intval($_POST['pais2']);
    $fecha = $_POST['fecha'];
    if($pais1>0 and $pais2>0){
        $sql = $MySQLiconn->query("INSERT INTO relaciones VALUES($num,$pais1,$pais2,'$fecha')");
        if(!$sql){
            echo $MySQLiconn->error;
            
        }
    }
}

if(isset($_GET['eliminarRe'])){
    $sql = $MySQLiconn->query("DELETE FROM relaciones WHERE id=".$_GET['eliminarRe']);
    header('Location: diplomaticas.php');
}

if(isset($_GET['editarRe'])){
    $sql = $MySQLiconn->query("SELECT r.id, p1.pais, p2.pais, r.id_pais1, r.id_pais2, r.fecha_relacion FROM relaciones r JOIN paises p1 ON r.id_pais1 = p1.id JOIN paises p2 ON r.id_pais2 = p2.id WHERE r.id = ".$_GET['editarRe']);
    $getROW = $sql->fetch_array();
}

if(isset($_POST['EditarRelacion'])){
    $sql = $MySQLiconn->query("UPDATE relaciones SET id_pais1=".$_POST['pais1'].", id_pais2=".$_POST['pais2'].", fecha_relacion='".$_POST['fecha']."' WHERE id=".$_GET['editarRe']);
    header('Location: diplomaticas.php');
}

if(isset($_POST['nombre'])){
    $pais = $_POST['nombre'];
    $pais = intval($pais);
    $html = "<option value = '0' >Seleccionar Pais</option>";
    if($pais>0){
        
        $resultados = $MySQLiconn->query("SELECT id, pais FROM paises WHERE id != all(SELECT id_pais2 FROM relaciones WHERE id_pais1 =".$pais.") AND id != ".$pais);
        while($row = $resultados ->fetch_array()){
            $html= $html."<option value= ".$row[0].">".$row[1]."</option>";
        }
        
        echo $html;
    }else{
        echo $html;
    }

}
/* --------------------------------------------------------------------------------- */
/*Página - Comercios*/
if(isset($_POST['comercio'])){
    $comercio = $_POST['comercio'];
    $comercio = intval($comercio);
    $html = "<option value = '0' >Seleccionar Pais</option>";
    echo $comercio;
    if($comercio>0){
        
        $resultados = $MySQLiconn->query("SELECT id, pais FROM paises WHERE id = any(SELECT id_pais2 FROM relaciones WHERE id_pais1 =".$comercio.") ");
        while($row = $resultados ->fetch_array()){
            $html= $html."<option value= ".$row[0].">".$row[1]."</option>";
        }
        echo $html;
    }else{
        echo $html;
    }

}


if(isset($_POST['AgregarComercio'])){
    $id = $MySQLiconn->query("SELECT MAX(id) FROM exportaciones");
    $num = $id->fetch_array();
    $num = intval($num[0])+1;
    
    $comercio1 = intval($_POST['comercio1']);
    $comercio2 = intval($_POST['comercio2']);
    $producto = intval($_POST['producto']);
    $cantidad = intval($_POST['cantidad']);

    if($comercio1>0 and $comercio2>0 and $producto>0){
        $select = $MySQLiconn -> query("SELECT id FROM relaciones WHERE id_pais1 = $comercio1 AND id_pais2 = $comercio2");
        $id_relaciones = $select -> fetch_array();
        $id_relaciones = $id_relaciones[0];

        $select = $MySQLiconn -> query("SELECT precio_unitario FROM productos WHERE id = $producto");
        $res_productos = $select -> fetch_array();
        $productos_pre = floatval($res_productos[0]);


        $total_pago = $cantidad * $productos_pre;
        $insert = $MySQLiconn -> query("INSERT INTO exportaciones VALUES ($num,$id_relaciones,$producto,$cantidad,$total_pago)");

    }
    header("Location: comercios.php");
}

if(isset($_GET['eliminarCo'])){
    $id = intval($_GET['eliminarCo']);
    $delete = $MySQLiconn -> query("DELETE FROM exportaciones WHERE id = $id");
    header("Location: comercios.php");
}

if(isset($_GET['editarCo'])){
    $id = intval($_GET['editarCo']);

    $exportaciones = $MySQLiconn -> query("SELECT p1.pais, p2.pais, p1.id, p2.id, pro.id, pro.descripcion, e.cantidad_vendida FROM exportaciones e JOIN productos pro ON e.id_productos = pro.id JOIN relaciones r on r.id = e.id_relaciones JOIN paises p1 ON p1.id = r.id_pais1 JOIN paises p2 ON p2.id = r.id_pais2 WHERE e.id = $id");
    $res_exportaciones = $exportaciones ->fetch_array();
    $pais1 = $res_exportaciones[0];
    $pais2 = $res_exportaciones[1];
    $id_pais1 = $res_exportaciones[2];
    $id_pais2 = $res_exportaciones[3];
    $id_producto = $res_exportaciones[4];
    $producto = $res_exportaciones[5];
    $cant_vendida = $res_exportaciones[6];

}

if(isset($_POST['EditarComercio'])){
    $id = intval($_GET['editarCo']);

    $comercio1 = intval($_POST['comercio1']);
    $comercio2 = intval($_POST['comercio2']);
    $producto = intval($_POST['producto']);
    $cantidad = intval($_POST['cantidad']);

    if($comercio1>0 and $comercio2>0 and $producto>0){
        $select = $MySQLiconn -> query("SELECT id FROM relaciones WHERE id_pais1 = $comercio1 AND id_pais2 = $comercio2");
        $id_relaciones = $select -> fetch_array();
        $id_relaciones = $id_relaciones[0];

        $select = $MySQLiconn -> query("SELECT precio_unitario FROM productos WHERE id = $producto");
        $res_productos = $select -> fetch_array();
        $productos_pre = floatval($res_productos[0]);

        $total = $cantidad * $productos_pre;       

        $update = $MySQLiconn -> query("UPDATE exportaciones SET id_relaciones = $id_relaciones , id_productos = $producto, cantidad_vendida=$cantidad, total = $total WHERE id=$id");
        
    }
    header("Location: comercios.php");
}

