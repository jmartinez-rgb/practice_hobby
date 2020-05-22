<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semaforo inteligente</title>
    <link rel="stylesheet" href="css/s5-ejercicio1.css">
</head>
<body>
    <form class="formulario" method="POST">
        <input type="number" placeholder="Vehiculos en la via 1" name="via1">
        <input type="number" placeholder="Vehiculos en la via 2" name="via2">
        <input type="submit" value="enviar" name="enviar">
    </form>
    <?php
    
    if(isset($_POST['enviar'])){
        $via1 = $_POST['via1'];
        $via2 = $_POST['via2'];
    }
    
    ?>
    <section class="formulario">
        <h1>Via 1: <?php  if(isset($_POST['enviar'])){echo $via1." vehiculos";}?> </h1>
        <h1>Via 2: <?php  if(isset($_POST['enviar'])){echo $via2." vehiculos";}?> </h1>
    </section>
    <div class="semaforos">
        <h1 class="vehiculo1">Via 1</h1>
        <div class="semaforo2">
            <div class="circulo verde via1" <?php if(isset($_POST['enviar'])){if($via1>$via2 && $via2>=0){echo 'style="animation: constante 2s ease infinite;animation-delay:8s;"';}else if($via2>$via1 && $via1>=0){echo 'style="animation: rojo 2s ease;"';}else if($via1==0 && $via2==0){echo 'style="opacity: 1;"';}else if($via1==$via2 && $via1>0 && $via2>0){echo 'style="opacity:1;"';}} ?>></div>
            <div class="circulo amarillo via1" <?php if(isset($_POST['enviar'])){if($via2>$via1 && $via1>=0){echo 'style="animation: rojo 2s ease;animation-delay:2s;"';}else if($via1==0 && $via2==0){echo 'style="opacity=0.5"';}} ?>></div>
            <div class="circulo rojo via1" <?php if(isset($_POST['enviar'])){if($via1>$via2 && $via2>=0){echo 'style="animation: constante 8s ease;"';}else if($via1<$via2 && $via1>=0){echo 'style="animation: constante 2s ease infinite;animation-delay:4s;"';}} ?>></div>
        </div>
        <div class="semaforo">
            <div class="circulo verde via2" <?php if(isset($_POST['enviar'])){if($via2>$via1 && $via1>=0){echo 'style="animation: constante 2s ease infinite;animation-delay:8s;"';}else if($via2<$via1 && $via2>=0){echo 'style="animation: rojo 2s ease;"';}else if($via1==0 && $via2==0){echo 'style="opacity: 1;"';}} ?>></div>
            <div class="circulo amarillo via2" <?php if(isset($_POST['enviar'])){if($via1>$via2 && $via2>=0){echo 'style="animation: rojo 2s ease;animation-delay:2s;"';}else if($via1==0 && $via2==0){echo 'style="opacity=0.5"';}} ?>></div>
            <div class="circulo rojo via2" <?php if(isset($_POST['enviar'])){if($via2<$via1 && $via2>=0){echo 'style="animation: constante 2s ease infinite;animation-delay:4s;"';}else if($via2>$via1 && $via1>=0){echo 'style="animation: constante 8s ease;"';}else if($via1==$via2 && $via1>0 && $via2>0){echo 'style="opacity:1;"';}} ?>></div>
        </div>
        <h1 class="vehiculo2">Via 2</h1>
    </div>
</body>
</html>