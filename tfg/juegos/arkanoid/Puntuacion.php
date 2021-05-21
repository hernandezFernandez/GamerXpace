<?php

include '../../conexion.php';

$datos = json_decode(stripslashes($_POST['datos']));
// no funciona la consulta por algun motivo
$MyBBDD->consulta("SELECT * FROM usuarios where id_usu = '" . $datos->user . "'");
    while ($fila = $MyBBDD->extraer_registro()) {

      $punt_actu = $fila['TotalPunt'];
      $puntosMax = $fila['puntosMax'];
      
    }




$MyBBDD->consulta("UPDATE usuarios SET TotalPunt= '" . $punt_actu + $datos->punt  . "'  WHERE id_usu = '" . $datos->user . "'");

if( $puntosMax < $datos->punt){
  $MyBBDD->consulta("UPDATE usuarios SET puntosMax= '" . $datos->punt  . "'  WHERE id_usu = '" . $datos->user . "'");

}

echo $datos->punt;

?>