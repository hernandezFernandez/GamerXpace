<?php
session_start();

if(!isset($_SESSION[ "loggedin"])){
  $_SESSION[ "loggedin"] = false;
  $_SESSION["user"] = "";   
}

include 'conexion.php';
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

  <div class="row">
    <div class="main wrap nes-container">

      <div class="caratula">
        <a href="/tfg/juegos/arkanoid/arkanoid.php">
          <img src="img/arkanoid.jpg">
        </a>
      </div>
      <div class="caratula">
        <a href="/tfg/juegos/naves/naves.php">
          <img src="img/naves.jpg">
        </a>
      </div>

    </div>
    <div class="side nes-container is-centered">
      <h2>Ranking mayores puntuaciones</h2>
      <?php 
      $MyBBDD->consulta("SELECT `id_usu`, `puntosMax` FROM `usuarios` ORDER BY puntosMax DESC LIMIT 3");
      $linea = 1;
      while ($fila = $MyBBDD->extraer_registro()) {
        echo "<p>" . $linea . ".- <a href='https://gamerspace69.000webhostapp.com/tfg/perfil.php?id=" . $fila["id_usu"] . "'>" . $fila["id_usu"] . "</a><br> Puntuacion: " . $fila["puntosMax"] . ".</p>";
        $linea += 1;
      }
    ?>

      <h2>Hilos mas comentados</h2>
      <?php 
      $MyBBDD->consulta("SELECT fk_id_hilo as tema, count(id_mensaje) as total FROM Mensajes GROUP BY fk_id_hilo ORDER BY total DESC LIMIT 3");
      $linea = 1;
      $MyBBDD2 = clone $MyBBDD;
      while ($fila = $MyBBDD->extraer_registro()) {
        $MyBBDD2->consulta("SELECT tema, id_tema FROM hilos where id_tema =". $fila['tema']);
        $fila2 = $MyBBDD2->extraer_registro();
        echo "<p>" . $linea . ".- <a href='https://gamerspace69.000webhostapp.com/tfg/mensajes.php?hilo=" . $fila2["id_tema"] . "'>" . $fila2["tema"] . "</a><br>Mensajes: " . $fila["total"] . ".</p>";
        
        $linea += 1;
      }
    ?>
    </div>

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