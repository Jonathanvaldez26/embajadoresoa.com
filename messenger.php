<?php
session_start(); 
date_default_timezone_set('America/Mexico_City');
include 'bd/mnpBDsas.class.php';
if(isset($_GET['pregunta'])){
  $pregunta=$_GET['pregunta'];
  $id_registrado=$_SESSION['registrado']['id_registrado'];
  $curso=$_GET['ref'];
  date_default_timezone_set('America/Mexico_City');
  $fecha= date("Y-m-d H:i:s");

  $campos='id_sesion, id_registrado, pregunta, fecha'; 
  $datos=array($curso,$id_registrado, $pregunta,$fecha);
  $usr=new mnpBD('chat');
  $usr->insertar($campos,$datos);

  $consultapreguntas="SELECT * FROM chat WHERE id_pregunta=1";
  $pregunta=$bd->ExecuteE($consultapreguntas);

  $fecha = $pregunta['fecha'];
  $nuevafecha = strtotime ( '-0 hour' , strtotime ( $fecha ) ) ;
  $pregunta['fecha'] = date ( 'Y-m-d H:i:s' , $nuevafecha );
  $html='<li class="right clearfix"><span class="chat-img pull-right">
  <img src="http://placehold.it/50/FA6F57/fff&amp;text=Yo" alt="User Avatar" class="img-circle">
</span>
<div class="chat-body clearfix">
  <div class="header">
    <small class=" text-muted">
      <span class="glyphicon glyphicon-time"></span>'.$pregunta['fecha'].'
    </small>
    <strong class="pull-right primary-font">'.$pregunta['nombreconstancia'].'
    </strong>
  </div>
  <p>
   '.$pregunta['pregunta'].'
 </p>
</div>
</li>';

class respuesta {
 public $success;
 public $html;
}

$respuesta = new respuesta();
$respuesta->success = true;
$respuesta->html = $html;

}




echo json_encode($respuesta);
?>


