<?php
// cambiar usuario a session
include 'conexion.php';

$datos = json_decode(stripslashes($_POST['datos']));

$MyBBDD->consulta("SELECT * FROM `likes` WHERE `fk_id_mensaje` = " . $datos->idMen . " AND `fk_id_usu`= '" . $datos->usu . "'");
$fila = $MyBBDD->extraer_registro();
  if($fila != ""){
    if($datos->like == "up"){
      $MyBBDD->consulta("UPDATE `likes` SET `like` = b'1' WHERE `fk_id_mensaje` = " . $datos->idMen . " AND `fk_id_usu`= '" . $datos->usu . "'");
      $func = "like1";
    } else if($datos->like == "down"){
      $MyBBDD->consulta("UPDATE `likes` SET `like` = b'0' WHERE `fk_id_mensaje` = " . $datos->idMen . " AND `fk_id_usu`= '" . $datos->usu . "'");
      $func = "like0";
    }
  } else {
    $MyBBDD->consulta("INSERT INTO `likes`(`fk_id_mensaje`, `like`, `fk_id_usu`) VALUES (" . $datos->idMen . ", 1,'" . $datos->usu ."')");
    $func = "funciona";
  }


  




echo $datos->idMen . " " . $datos->like . " " . $func  . " " . $datos->usu;

?>