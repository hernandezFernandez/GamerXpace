<?php
// cambiar usuario a session
include 'conexion.php';

$datos = json_decode(stripslashes($_POST['datos']));

$MyBBDD->consulta("SELECT * FROM `hilos` WHERE `tema` = '" . $datos->tema . "'");

$fila = $MyBBDD->extraer_registro();
  if($fila == ""){
    $MyBBDD->consulta("INSERT INTO `hilos`(`tema`, `autor`) VALUES ('" . $datos->tema . "', '" . $datos->usu . "')");
  } else {
    echo "El tema ya existe";
  }






?>