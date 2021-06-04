<?php
// cambiar usuario a session
include 'conexion.php';

$datos = json_decode(stripslashes($_POST['datos']));

$MyBBDD->consulta("INSERT INTO `Mensajes`(`autor`, `mensaje`, `fk_id_hilo`) VALUES ('" . $datos->usu . "', '" . $datos->mens . "','" . $datos->idHilo . "')");


echo $datos->idHilo . " " . $datos->mens  . " " . $datos->usu;

?>