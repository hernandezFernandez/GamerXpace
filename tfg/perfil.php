<?php
session_start();
include 'conexion.php';



if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
  
  $MyBBDD->consulta("SELECT * FROM usuarios where id_usu = '" . $_SESSION["user"] ."'");
    while ($fila = $MyBBDD->extraer_registro()) {

      $user = $fila['id_usu'];
      $naci = $fila['naci'];
      $crea = $fila['create'];
      $puntosMax = $fila['puntosMax'];
      $totalPunt = $fila['TotalPunt'];
    }

} else {
  header("location: login.php");
  echo "<script type='text/javascript'>window.location.replace('login.php')</script>;";
}

if(isset($_POST["Cerrar_Sesion"])){
  $_SESSION["loggedin"] = false;
  $_SESSION["user"] = "";   
  header("location: index.php");
  echo "<script type='text/javascript'>window.location.replace('index.php')</script>;";
}  






?>

<!DOCTYPE html>
<html>

<head>
  <title>Page Title</title>
  <meta charset="UTF-8" />
  <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
  <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />

  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- less -->
  <link rel="stylesheet/less" type="text/css" href="style2.less" />
  <script src="less.min.js" type="text/javascript"></script>


</head>

<body>
  <!-- <img src="img/titulo.gif" alt="Funny image" width="200px" height="200px" style="position: absolute; z-index: 100; animation-name: example; animation-duration: 4s" >  -->

  <div class="header nes-container is-centered">
    <div id="tit">
      <h2>GAMER</h2>
      <H1>X</H1>
      <h4>PACE</h4>
    </div>
  </div>

  <div class="navbar nes-container">
    <a href="index.php" class="nes-btn is-primary">INICIO</a>
    <?php
      if($_SESSION["loggedin"]){
        echo "<a href='perfil.php' class='nes-btn is-primary'>PERFIL</a>";
      } else {
        echo "<a href='login.php' class='nes-btn is-primary'>LOGEARSE</a>";
      }
    ?>
    <a href="foro.php" class="nes-btn is-primary">FORO</a>
  </div>

  <div class="register nes-container ">

    <p>
       usuario: <?php echo $user?>
    </p>
    
    <p>
       Puntuaciones:<br>
       Puntuacion total: <?php echo $totalPunt?><br>
       Puntuacion maxima: <?php echo $puntosMax?>
    </p>
    <p>
       Posicion en el ranking:
    </p>
    <p>
       Fecha de creacion de cuenta: <?php echo $crea?>
    </p>
  
    <form method='POST' action="">
      <button name="Cerrar_Sesion">cerrar sesion</button>
    </form>

  </div>
  <div class="footer nes-container is-centered">
    <p>Creado por javier fernandez y miguel hernandez. Suscribete a nuestro resumen diario
      <input type="text" class="InFoot"><button class="nes-btn margin">Suscribete</button>
      Contactanos al: 9123123123
    </p>
  </div>
</body>
</html>