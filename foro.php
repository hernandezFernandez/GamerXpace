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
  <script src="mensajes.js" type="text/javascript"></script>

</head>

<body>
  <script type="text/javascript">
        var usuario = "<?php if(isset($_SESSION["loggedin"])){echo $_SESSION["user"];}; ?>"
  </script>

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


  <div class="nes-table-responsive">
  <table class="nes-table is-bordered is-centered">
    <thead>
      <tr>
        <th>Tema</th>
        <th>Autor</th>
        <th>Ultimo mensaje</th>
        <th>Resp</th>
        <!-- <th>Votos</th> -->
        <th>Creacion</th>


      </tr>
    </thead>
    <tbody>

    <?php 
    
    $MyBBDD->consulta("SELECT * FROM hilos");

    while ($fila = $MyBBDD->extraer_registro()) {

      echo "<tr>";
      echo "<td> <a href='mensajes.php?hilo=". $fila['id_tema'] . "'>" . $fila['tema'] . "</a></td>";
      echo "<td>" . $fila['autor'] . "</td>";

      $MyBBDD2 = clone $MyBBDD;
      $MyBBDD2->consulta("SELECT `autor`, `creacion` FROM `Mensajes` WHERE `fk_id_hilo` =". $fila['id_tema'] . " ORDER BY creacion DESC ");
      $fila2 = $MyBBDD2->extraer_registro();

      if($fila2['autor'] != ""){
        echo "<td>" . $fila2['autor'] . "<br>" . $fila2['creacion'] . "</td>";
                } else{
        echo "<td> No hay mensajes </td>";
                }

     
      
      $MyBBDD2 = clone $MyBBDD;
      $MyBBDD2->consulta("SELECT count(id_mensaje) as total FROM Mensajes where fk_id_hilo = ". $fila['id_tema']);
      $fila2 = $MyBBDD2->extraer_registro();

      echo "<td>" . $fila2['total'] . "</td>";
      // $MyBBDD2 = clone $MyBBDD;
      //       $MyBBDD2->consulta("SELECT sum(`like`) as `like` from `likes` where fk_id_hilo = ". $fila['id_tema']);
      //       while ($fila2 = $MyBBDD2->extraer_registro()) {
      //         if($fila2['like'] != ""){
      //           $like = $fila2['like'];
      //         } else{
      //           $like = 0;
      //         }
      //       }
      // echo "<td>" . $like . "</td>";

      echo "<td>" . $fila['create'] . "</td>";

      echo "</tr>";

    };

    ?>

    </tbody>
  </table>
  <br>
  <p id="error"></p>
  <section >
  <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-default').showModal();" <?php if($_SESSION["loggedin"] == false){ echo "style='display: none'";};?> >
    Crear Hilo
  </button>
  <dialog class="nes-dialog" id="dialog-default">
    <form method="dialog">
      <p class="title">Crear texto</p>
      <input type="text" id="tema">
      <menu class="dialog-menu">
        <button class="nes-btn">cancelar</button>
        <button class="nes-btn is-primary" onclick="enviarHilo(this)">crear</button>
      </menu>
    </form>
  </dialog>
</section>
</div>
  
  <!-- <p>Nuevo juego a punto de salir   Creador: javier  ultimo mensaje:  cantidad de mensajes:  like: </p> -->

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