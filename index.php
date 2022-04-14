<?php
include 'bd/mnpBDsas.class.php';

  $sql_sesiones = "SELECT * FROM sesiones WHERE actual = 1";
$sesiones = $bd->ExecuteE($sql_sesiones);
foreach($sesiones as $sesion){
}

header("Location: registro.php?ref=".base64_encode($sesion['id_sesion']));
?>