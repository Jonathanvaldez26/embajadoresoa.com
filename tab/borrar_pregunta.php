<?php
session_start(); 
date_default_timezone_set('America/Mexico_City');
include 'bd/mnpBDsas.class.php';
  $pregunta=$_POST['id_pregunta'];


class respuesta {
 public $success;
 public $id_pregunta;
 public $exito;
}
$respuesta = new respuesta();

  if ($_POST['chat']==1) {
    $usr=new mnpBD('chat');
  }else{
    $usr=new mnpBD('preguntas');
  }
  
  
  if ($usr->delete("id_pregunta=".$pregunta)) {
    $respuesta->success = true;
    $respuesta->id_pregunta = $pregunta;
    $respuesta->exito = 1;
  }else{
    $respuesta->success = false;
    $respuesta->id_pregunta = $pregunta;
    $respuesta->exito = 0;
  }
                





echo json_encode($respuesta);
?>


