<?php
session_start(); 
date_default_timezone_set('America/Mexico_City');
include 'bd/mnpBDsas.class.php';
class respuesta {
   public $success;
}

$respuesta = new respuesta();
$respuesta->success = false;

if(isset($_POST['id_socio']) and isset($_POST['sesion']) and is_numeric($_POST['id_socio']) and $_POST['sesion']!=""){
	$sql="SELECT * FROM sesiones WHERE id_sesion='".$_POST['sesion']."' and activo=1";
	$sesiones= $bd->ExecuteE($sql);
	foreach($sesiones as $sesion){
		$campos = 'fin_conexion';
		$datos = array(date('Y-m-d H:i:s'));
		$condicion = 'id_sesion='.$sesion['id_sesion'].' AND id_registrado='.$_POST['id_socio'];

		$usr = new mnpBD("sesionesasistentes");

		if($usr->actualizar($campos, $datos, $condicion)){
			$respuesta->success = true;
		}
	}
}

echo json_encode($respuesta);
?>