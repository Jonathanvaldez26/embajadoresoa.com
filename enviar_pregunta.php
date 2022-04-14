<?php
include 'bd/mnpBDsas.class.php';
$pregunta=$_POST['pregunta'];
$registrado=$_POST[registrado];
$referencia=$_POST[referencia];
$referencia=$_POST['referencia'];
date_default_timezone_set('America/Mexico_City');
$fecha= date("Y-m-d H:i:s");

//-------------
class datos {
 public $success;
 public $exito;
}

 $respuesta = new datos();



    $campos='id_registrado, id_sesion, pregunta, fecha'; 
    $datos=array($registrado,$referencia, $pregunta,$fecha);
    $usr=new mnpBD('preguntas');
    if($usr->insertar($campos,$datos)){
        $respuesta->success = true;

        $respuesta->mensaje="Su pregunta fue enviada exitosamente";
    }else{
        $respuesta->success = false;
        $respuesta->mensaje="Erro al enviar su pregunta, intente nuevamente.";
    }
//------------

echo json_encode($respuesta);
?>