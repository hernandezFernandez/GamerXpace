<?php
session_start();


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
  header("location: index.php");
  echo "<script type='text/javascript'>window.location.replace('index.php')</script>;";
}

// añadimos el fichero de conexion a la bd
include 'conexion.php';
// Creacion de variables
$user = "";
$pass = "";

$user_err ="";
$pass_err = "";

$user_bd = "";
$pass_bd = "";


if ($_POST) {
  // comprobamos que no hay ningun campo vacio
  if(empty(trim($_POST["usuario"]))){
    $user_err = "Por favor ingrese su usuario.";
  } else{
    $user = trim($_POST["usuario"]);
  }

  if(empty(trim($_POST["contra"]))){
    $pass_err = "Por favor ingrese su contraseña.";
  } else{
    $pass = trim($_POST["contra"]);
  }

  
// si ningun campo tiene errores comprobamos el usuario y la contraseña en la bbdd
  if(empty($username_err) && empty($password_err)){
    // hacemos el select
    $MyBBDD->consulta("SELECT id_usu, pass FROM usuarios where id_usu = '" . $user ."'");
    while ($fila = $MyBBDD->extraer_registro()) {

      $user_bd = $fila['id_usu'];
      $pass_bd = $fila['pass'];
      
    }
// comprobamos que el usuario y la contraseña coinciden
    if($user_bd == $user){                    
         if($pass_bd == md5($pass)){
                  
                  // Guardamos que se ha iniciado la sesion
                  $_SESSION["loggedin"] = true;
                  $_SESSION["user"] = $user;                          
                  
                  // Redirigimos a la pagina de inicio
                  header("location: index.php");
                  echo "<script type='text/javascript'>window.location.replace('index.php')</script>;";
              } else{
                  // Mensaje de error si la contraseña es erronea
                  $pass_err = "La contraseña que has ingresado no es válida.";
              }
      } else{
          //Mensaje de error si el usuario es erroneo
          $user_err = "No existe cuenta registrada con ese nombre de usuario.";
      }
  }
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
    <a href="login.php" class="nes-btn is-primary">LOGEARSE</a>
    <a href="foro.php" class="nes-btn is-primary">FORO</a>
  </div>

  <div class="register nes-container is-centered">

    <form method='POST' action="">


      <div class="input">
        <label for="usuario">Nombre de Usuario</label>
        <input type="text" id="usuario" class="nes-input" name="usuario" required>
        <?php echo $user_err ?>
      </div>
      <div class="input">
        <label for="contra">Contraseña</label>
        <input type="password" id="contra" class="nes-input" name="contra" required>
        <?php echo $pass_err ?>
      </div>
      <div class="input">
        <button type='submit' name='login' class='nes-btn'>Login</button>
      </div>
    </form>
    <a href="register.php">Si aun no estas registrado click aqui</a>

  </div>
  <div class="footer nes-container is-centered">
    <p>Creado por javier fernandez y miguel hernandez. Suscribete a nuestro resumen diario
      <input type="text" class="InFoot"><button class="nes-btn margin">Suscribete</button>
      Contactanos al: 9123123123
    </p>
  </div>
</body>

</html>
<!-- formulario de registro que lleva los datos a index para crear las cookies -->