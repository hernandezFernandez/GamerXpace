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
$pass2 = "";
$naci = "";
$user_err ="";
$pass_err = "";
$pass2_err = "";
$naci_err = "";

$user_bd = "";
$pass_bd = "";


if ($_POST) {

  // Comprobamos que no hay ningun campo vacio
  if(empty(trim($_POST["usuario"]))){
    $user_err = "Por favor ingrese su usuario.";
  } else{
    $user = trim($_POST["usuario"]);
  }

  if(empty(trim($_POST["pass"]))){
    $pass_err = "Por favor ingrese su contraseña.";
  } else{
    $pass = trim($_POST["pass"]);
  }
// comprobamos que las contraseñas coinciden
  if(empty(trim($_POST["pass2"]))){
    $pass2_err = "Por favor comfirme su contraseña.";
  } else if($pass != $_POST["pass2"]){
    $pass2 = trim($_POST["pass2"]);
  }

  if(empty(trim($_POST["nacimiento"]))){
    $naci_err = "Por favor comfirme su contraseña.";
  } else{
    $naci = trim($_POST["nacimiento"]);
  }

  // Si no hay errores añadimos el usuario a la bbdd
  if(empty($username_err) && empty($password_err) && empty($pass2_err) && empty($naci_err)){
    
    // Comprobamos que el usuario no existe ya en la bbdd

    $MyBBDD->consulta("SELECT id_usu FROM usuarios where id_usu = '" . $user ."'");
    while ($fila = $MyBBDD->extraer_registro()) {
      $user_bd = $fila['id_usu'];
    }
// si no existe lo agregamos a la bbdd
    if($user_bd != $user){    
      
      $user = $_POST["usuario"];
      $pass = md5($_POST["pass"]);
      $nac = $_POST["nacimiento"];

      $MyBBDD->consulta("INSERT INTO usuarios (id_usu, pass, naci) VALUES ('$user' , '$pass', '$nac')");

                  // Iniciamos la sesion
                  $_SESSION["loggedin"] = true;
                  $_SESSION["user"] = $user;          
                  // Redirigimos a la pagina de inicio
                  echo "<script type='text/javascript'>window.location.replace('index.php')</script>;";
                  header("location: index.php");
                  echo "<script type='text/javascript'>window.location.replace('index.php')</script>;";

      } else {
        // Mensaje de error si el usuario ya existe
        $user_err = "Usuario en uso";
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
        <label for="nombre">Nombre de Usuario</label>
        <input type="text" id="nombre" name="usuario" class="nes-input" required>

        <?php echo $user_err ?>

      </div>
      <div class="input">
        <label for="pass">Contraseña</label>
        <input type="password" id="pass" name="pass" class="nes-input" required>

        <?php echo $pass_err ?>

      </div>
      <div class="input">
        <label for="pass">Confirma Contraseña</label>
        <input type="password" id="pass" name="pass2" class="nes-input" required>

        <?php echo $pass2_err ?>

      </div>
      <div class="input">
        <label for="name_field">Fecha de nacimiento</label>
        <input type="date" id="name_field" name="nacimiento" class="nes-input" required>

        <?php echo $naci_err ?>

      </div>
      <div class="input">
        <button type='submit' name='registrar' class='nes-btn'>Registrar</button>
      </div>
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