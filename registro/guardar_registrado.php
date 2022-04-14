<?php
include '../bd/mnpBDsas.class.php';
$prefijo = $_POST['prefijo'];
$nombre=$_POST['nombre'];
$email=$_POST['email'];
$ciudad=$_POST['ciudad'];
$cedpro=$_POST['cedula'];
$categoria=$_POST['categoria'];
$nombrecontancia= $prefijo." ".$nombre." ".$apellidop." ".$apellidom;
date_default_timezone_set('America/Mexico_City');
$fecha_registro= date("Y-m-d H:i:s");

$campos="correo,nombrecompleto,prefijo,ciudad,cedula,categoria,fecha_impresion";
$valores= array(
    $email,
    $nombre,
    $prefijo,
    $ciudad,
    $cedpro,
    $categoria,
    $fecha_registro
);


//-------------
class datos {
   public $success;
   public $id_registrado;
   public $mensaje;
}

$respuesta = new datos();

$usr= new mnpBD("gafetes");
if ($usr->insertar($campos,$valores)) {
    $sql_registrados="SELECT * FROM gafetes WHERE correo='".$email."'";
    $registrados  = $bd->ExecuteE($sql_registrados);
    foreach ($registrados as &$registrado) {}
        $id_registrado=$registrado['id'];
    $respuesta->success = true;
    $respuesta->id_registrado = $id_registrado;
    $respuesta->mensaje="Tu registro se realizo exitosamente.";
    $respuesta->redireccion="imprimir_gafete.php?gafete=".$id_registrado;


}else{
    $respuesta->success = false;
    $respuesta->id_registrado = 0;
    $respuesta->mensaje="Error al registrarse, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
}

echo json_encode($respuesta);
?>