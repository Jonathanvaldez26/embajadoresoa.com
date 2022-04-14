<?php 
session_start();
error_reporting(0);
include '../bd/mnpBDsas.class.php';
$prefijo = $_POST['prefijo'];
$nombre=$_POST['nombre'];
$email=$_POST['email'];
$telefono=$_POST['telefono'];
$pais=$_POST['ciudad'];
$cedpro=$_POST['cedula'];
$categoria=$_POST['categoria'];
$nombrecontancia= $prefijo." ".$nombre." ".$apellidop." ".$apellidom;
date_default_timezone_set('America/Mexico_City');
$fecha_registro= date("Y-m-d H:i:s");

class datos {
 public $success;
 public $id_registrado;
 public $mensaje;
 public $gafete;
 public $redireccion;
}

$campos="correo,nombrecompleto,prefijo,ciudad,cedula,fecha_impresion,categoria";
$valores= array(
    $email,
    $nombre,
    $prefijo,
    $pais,
    $cedpro,
    $fecha_registro,
    $categoria
);
$usr= new mnpBD("gafetes");
$condicion=" id=".$_POST['id_registrado'];
if ($usr->actualizar($campos,$valores,$condicion)) {
	$respuesta->success = true;
	$respuesta->id_registrado = $_POST['id_registrado'];
	$respuesta->gafete=$_POST['gafete'];
	$respuesta->mensaje="Gracias por actualizar la información";
	$respuesta->redireccion="imprimir_gafete.php?gafete=".$_POST['gafete'];
}


echo json_encode($respuesta);


?>