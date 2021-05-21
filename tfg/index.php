<?php
session_start();

if(!isset($_SESSION[ "loggedin"])){
  $_SESSION[ "loggedin"] = false;
  $_SESSION["user"] = "";   
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
    <?php echo "<spam>" . $_SESSION["user"] . "</spam>"; ?>
  </div>
  <div class="row">
    <div class="main wrap nes-container">

      <div class="caratula">
        <a href="juegos/arkanoid/arkanoid.php">
          <img src="img/arkanoid.jpg">
        </a>
      </div>
      <div class="caratula">
        <a href="juegos/arkanoid/arkanoid.html">
          <img src="img/naves.jpg">
        </a>
      </div>

    </div>
    <div class="side nes-container is-centered">
      <h2>Juegos mas jugados</h2>
      <p>
        1- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>
      <p>
        2- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>
      <p>3- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

      <hr>
      <h2>Hilos mas vistos</h2>
      <p>
        1- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>
      <p>
        2- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>
      <p>3- Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

    </div>

  </div>
  <div class="footer nes-container is-centered">
    <p>Creado por javier fernandez y miguel hernandez. Suscribete a nuestro resumen diario
      <input type="text" class="InFoot"><button class="nes-btn margin">Suscribete</button>
      Contactanos al: 9123123123
    </p>
  </div>
</body>

</html>