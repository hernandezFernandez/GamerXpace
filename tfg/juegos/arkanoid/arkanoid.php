<?php
session_start();
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
  <link rel="stylesheet/less" type="text/css" href="/tfg/style2.less" />
  <script src="/tfg/less.min.js" type="text/javascript"></script>


</head>

<body>

  <div class="header nes-container is-centered">
    <div id="tit">
      <h2 >GAMER</h2><H1>X</H1><h4>PACE</h4>
    </div>
    </div>
 
  <div class="navbar nes-container">
    <a href="/tfg/index.php" class="nes-btn is-primary">INICIO</a>
    <?php
      if($_SESSION["loggedin"]){
        echo "<a href='/tfg/perfil.php' class='nes-btn is-primary'>PERFIL</a>";
      } else {
        echo "<a href='/tfg/login.php' class='nes-btn is-primary'>LOGEARSE</a>";
      }
    ?>
    <a href="/tfg/foro.php" class="nes-btn is-primary">FORO</a>
  </div>

  <div class="row">

    <div class="main nes-container" id="main">
      <button id="play">play</button>
      <div id="juego">
        <canvas id="myCanvas"></canvas>
      </div>
    
    
      <br>
      <div>
        <button id="iz">IZQUIERDA</button>
        <button id="der">DERECHA</button>
      </div>
    
      <script type="text/javascript">
        var usuario = "<?php if(isset($_SESSION["loggedin"])){echo $_SESSION["user"];}; ?>"
      </script>

      <script src="juego3.js" type="text/javascript"></script>

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
      Contactanos al: 9123123123</p>
  </div>
</body>
</body>

</html>





