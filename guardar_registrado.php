<?php
include 'bd/mnpBDsas.class.php';
$prefijo = $_POST['prefijo'];
$nombre=$_POST['nombre'];
$apellidop=$_POST['apellidop'];
$apellidom=$_POST['apellidom'];
$email=$_POST['email'];
$telefono=$_POST['telefono'];
$pais=$_POST['pais'];
$estado=$_POST['estado'];
$especialidad=$_POST['especialidad'];
$cedula=$_POST['cedula'];
$recibir_correo=$_POST['recibir_correo'];
$nombrecontancia= $prefijo." ".$nombre." ".$apellidop." ".$apellidom;
date_default_timezone_set('America/Mexico_City');
$fecha_registro= date("Y-m-d H:i:s");

$campos="email,nombre,apellidop,apellidom,prefijo,nombreconstancia,telefono,id_pais,id_estado,especialidad,cedula,recibir_correo,fecha_registro";
$valores= array(
    $email,
    $nombre,
    $apellidop,
    $apellidom,
    $prefijo,
    $nombrecontancia,
    $telefono,
    $pais,
    $estado,
    $especialidad,
    $cedula,
    $recibir_correo,
    $fecha_registro
);


//-------------
class datos {
 public $success;
 public $id_registrado;
 public $mensaje;
}
 
$respuesta = new datos();

$usr= new mnpBD("registrados");
if ($usr->insertar($campos,$valores)) {
    $sql_registrados="SELECT * FROM registrados WHERE email='".$email."'";
    $registrados  = $bd->ExecuteE($sql_registrados);
    foreach ($registrados as &$registrado) {}
        $id_registrado=$registrado['id_registrado'];
        $respuesta->success = true;
        $respuesta->id_registrado = $id_registrado;
        $respuesta->mensaje="Tu registro se realizo exitosamente.";
        

    }else{
        $respuesta->success = false;
        $respuesta->id_registrado = 0;
        $respuesta->mensaje="Error al registrarse, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
    }

echo json_encode($respuesta);
?>