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
  <link href="/tfg/ness.css" rel="stylesheet" />

  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- less -->
  <link rel="stylesheet/less" type="text/css" href="style2.less" />
  <script src="less.min.js" type="text/javascript"></script>
  <script src="mensajes.js" type="text/javascript"></script>

</head>

<body>

  <div class="header nes-container is-centered">
    <div id="tit">
      <h2>GAMER</h2>
      <H1>X</H1>
      <h4>PACE</h4>
    </div>
  </div>

  <div class="navbar nes-container">
    <a href="/tfg/index.php" class="nes-btn is-primary">INICIO</a>
    <?php
      if($_SESSION["loggedin"]){
        echo "<a href='/tfg/perfil.php?id=" . $_SESSION["user"] . "' class='nes-btn is-primary'>PERFIL:" . $_SESSION["user"] . "</a>";
      } else {
        echo "<a href='/tfg/login.php' class='nes-btn is-primary'>LOGARSE</a>";
      }
    ?>
    
    <a href="/tfg/foro.php" class="nes-btn is-primary">FORO</a>
  </div>

  <script type="text/javascript">
        var usuario = "<?php if(isset($_SESSION["loggedin"])){echo $_SESSION["user"];}; ?>"
  </script>

  <div class="register nes-container ">


  

    <?php 
    if($_SESSION["loggedin"]){
    
    // cambiar hilo
    $MyBBDD->consulta("SELECT autor, id_mensaje, mensaje, DATE_FORMAT(creacion, '%y/%m/%d %T') as creacion FROM `Mensajes` WHERE fk_id_hilo = '" . $_GET["hilo"] . "' ORDER BY `creacion`");
    
    while ($fila = $MyBBDD->extraer_registro()) {
      
      echo "<div class='nes-table-responsive mensaje'>";
        echo "<table class='nes-table is-bordered is-centered'>";
          echo "<tbody>";
            // parte de arriba 
            echo "<tr>";
                  // fecha $fila['img_perf']
              echo "<td colspan='2'>" . $fila['creacion'] . "</td>";
            echo "</tr>";
            // parte de abajo 
            echo "<tr>";
                  // autor 
            $MyBBDD2 = clone $MyBBDD;
            $MyBBDD2->consulta("SELECT img_perf from `usuarios` where id_usu = '". $fila['autor'] . "'");
            $fila2 = $MyBBDD2->extraer_registro();
              echo "<td><p><a href='https://gamerspace69.000webhostapp.com/tfg/perfil.php?id=" . $fila['autor'] . "'> " . $fila['autor'] . "</a></p> <i class='". $fila2['img_perf'] ."'></i></td>";
              
                  //mensaje 
              echo "<td><p>" . $fila['mensaje'] . "</p></td>";
            echo "</tr>";
            echo "<tr>";
            
            $MyBBDD2->consulta("SELECT sum(`like`) as `like` from `likes` where fk_id_mensaje = ". $fila['id_mensaje']);
            while ($fila2 = $MyBBDD2->extraer_registro()) {
              if($fila2['like'] != ""){
                $like = $fila2['like'];
              } else{
                $like = 0;
              }
            }

            $MyBBDD3 = clone $MyBBDD;
            // cambiar usu
            $MyBBDD3->consulta("SELECT `like` FROM `likes` WHERE `fk_id_usu` = '" . $_SESSION["user"] . "' and `fk_id_mensaje`=" . $fila['id_mensaje']);
            while ($fila3 = $MyBBDD3->extraer_registro()) {
              $marca = $fila3['like'] ;
              
            }

            if($marca == 1){
              $marca = "";
            } else{
              $marca = "is-empty";
            }
              
              echo "<td colspan='2' style='text-align: right;'><spam>" . $like . " </spam><i id='" . $fila['id_mensaje'] . "' class='nes-icon is-medium like " . $marca . "' onclick='EnvLike(this)'></i></td>";
              echo "</tr>";
          echo "</tbody>";
        echo "</table>";
      echo "</div>";
      
    };
  } else {
    echo "Para ver los mensajes de este hilo debes de estar registrado";
  }
    ?>

<a class="nes-btn is-primary" href="/tfg/crearMensaje.php?hilo=<?php echo $_GET['hilo'] ?>" <?php if($_SESSION["loggedin"] == false){ echo "style='display: none'";};?> >Crear Mensaje</a>

  </div>
  <div class="footer nes-container is-centered">
    
  <p>Creado por Javier Fernandez y Miguel Hernandez.Contactanos al: 9123123123    </p><br>
    <a href="https://www.youtube.com/"><i class="nes-icon youtube is-medium"></i></a>
  <a href="https://www.instagram.com/"><i class="nes-icon instagram is-medium"></i></a>
  <a href="https://www.twitch.tv/"><i class="nes-icon twitch is-medium"></i></a>
  <a href="https://twitter.com/"><i class="nes-icon twitter is-medium"></i></a>

  </div>
</body>
</html>