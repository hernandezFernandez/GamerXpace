<?php
session_start();
include 'conexion.php';



if(isset($_GET["id"])){
  
  $MyBBDD->consulta("SELECT * FROM usuarios where id_usu = '" . $_GET["id"] ."'");

    while ($fila = $MyBBDD->extraer_registro()) {

      $user = $fila['id_usu'];
      $naci = $fila['naci'];
      $crea = $fila['create'];
      $puntosMax = $fila['puntosMax'];
      $totalPunt = $fila['TotalPunt'];
      $perf = $fila['img_perf'];
      $fech_nac = $fila['naci'];
      $puntosMaxNav = $fila['maxPuntnav'];
      $puntostotalNav = $fila['totalPuntnav'];

    }

    $MyBBDD->consulta("SELECT pos FROM (SELECT id_usu, ROW_NUMBER() OVER(ORDER BY `puntosMax` DESC) AS 'pos' FROM usuarios) as rank WHERE id_usu = '$user'");
    $fila = $MyBBDD->extraer_registro();
    
    $rank =  $fila['pos'];

    $MyBBDD->consulta("SELECT pos FROM (SELECT id_usu, ROW_NUMBER() OVER(ORDER BY `TotalPunt` DESC) AS 'pos' FROM usuarios) as rank WHERE id_usu = '$user'");
    $fila = $MyBBDD->extraer_registro();
    
    $rankT = $fila['pos'];

    $MyBBDD->consulta("SELECT pos FROM (SELECT id_usu, ROW_NUMBER() OVER(ORDER BY `maxPuntnav` DESC) AS 'pos' FROM usuarios) as rank WHERE id_usu = '$user'");
    $fila = $MyBBDD->extraer_registro();
    
    $rankNav = $fila['pos'];

    $MyBBDD->consulta("SELECT pos FROM (SELECT id_usu, ROW_NUMBER() OVER(ORDER BY `totalPuntnav` DESC) AS 'pos' FROM usuarios) as rank WHERE id_usu = '$user'");
    $fila = $MyBBDD->extraer_registro();
    
    $rankNavT = $fila['pos'];
    
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
        echo "<a href='/tfg/perfil.php?id=" . $_SESSION["user"] . "' class='nes-btn is-primary'>PERFIL</a>";
      } else {
        echo "<a href='/tfg/login.php' class='nes-btn is-primary'>LOGEARSE</a>";
      }
    ?>
    
    <a href="/tfg/foro.php" class="nes-btn is-primary">FORO</a>
    <?php echo "<span id='user'>" . $_SESSION["user"] . "</span>"; ?>
  </div>

  <div class="register nes-container ">
    <?php echo "<p>Imagen de perfil: </p><i class='$perf'></i>" ?>
    <p>
       usuario: <?php echo $user?>
    </p>
    
    <p>
       arkanoid:<br><br>

       Puntuacion total:  <?php echo $totalPunt?><br>
       Puntuacion maxima: <?php echo $puntosMax?><br>
       ranking:<br>
       -Puntuacion maxima: <?php echo $rank?><br>
       -Puntuacion total:  <?php echo $rankT?><br><br>

       SpaceInvader:<br><br>

       Puntuacion total:  <?php echo$puntosMaxNav?><br>
       Puntuacion maxima: <?php echo$puntostotalNav?><br>
       ranking<br>
       -Puntuacion maxima: <?php echo $rankNav?><br>
       -Puntuacion total:  <?php echo $rankNavT?><br>

       
    </p>
    <p>
       fecha de nacimiento: <?php echo $fech_nac?><br>
       Fecha de creacion de cuenta: <?php echo $crea?>
    </p>
  <?php 
    if($_SESSION['user'] == $_GET["id"]){
      echo "<form method='POST' action=''>";
      echo    "<button name='Cerrar_Sesion'>cerrar sesion</button>";
      echo "</form>";
    }
    ?>
  </div>
  <div class="footer nes-container is-centered">
    
    <p>Creado por javier fernandez y miguel hernandez.Contactanos al: 9123123123
    </p><br>
  <i class="nes-icon youtube is-medium"></i>
  <i class="nes-icon instagram is-medium"></i>
  <i class="nes-icon twitch is-medium"></i>
  <i class="nes-icon twitter is-medium"></i>

  </div>
</body>
</html>