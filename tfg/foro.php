<?php
session_start();
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
        echo "<a href='perfil.php' class='nes-btn is-primary'>PERFIL</a>";
      } else {
        echo "<a href='login.php' class='nes-btn is-primary'>LOGEARSE</a>";
      }
    ?>
    <a href="foro.php" class="nes-btn is-primary">FORO</a>
  </div>

  <div class="register nes-container ">


  <div class="nes-table-responsive">
  <table class="nes-table is-bordered is-centered">
    <thead>
      <tr>
        <th>Tema</th>
        <th>Autor</th>
        <th>Ultimo mensaje</th>
        <th>Resp</th>
        <th>Votos</th>
        <th>Creacion</th>


      </tr>
    </thead>
    <tbody>

    <?php 
    
    $MyBBDD->consulta("SELECT * FROM hilos");

    while ($fila = $MyBBDD->extraer_registro()) {

      echo "<tr>";
      echo "<td>" . $fila['tema'] . "</td>";
      echo "<td>" . $fila['autor'] . "</td>";
      echo "<td>" . "ultimo emsaje" . "</td>";
      echo "<td>" . "resp" . "</td>";
      echo "<td>" . $fila['votos'] . "</td>";
      echo "<td>" . $fila['create'] . "</td>";

      echo "</tr>";

    };

    ?>

    </tbody>
  </table>
</div>
  
  <!-- <p>Nuevo juego a punto de salir   Creador: javier  ultimo mensaje:  cantidad de mensajes:  like: </p> -->

  </div>
  <div class="footer nes-container is-centered">
    <p>Creado por javier fernandez y miguel hernandez. Suscribete a nuestro resumen diario
      <input type="text" class="InFoot"><button class="nes-btn margin">Suscribete</button>
      Contactanos al: 9123123123
    </p>
  </div>
</body>
</html>