<?php 
session_start();
include '../virtual/bd/mnpBDsas.class.php';
$sql_registados="SELECT * FROM registrados WHERE id_registrado=".$_POST['id_registrado'];
$registrados=$bd->ExecuteE($sql_registados);
foreach($registrados as $registrado){}
 $nombrecontancia = $registrado['prefijo']." ".$registrado['nombre']." ".$registrado['apellidop']." ".$registrado['apellidom'];
date_default_timezone_set('America/Mexico_City');
$fecha_registro= date("Y-m-d H:i:s");

class datos {
 public $success;
 public $id_registrado;
 public $mensaje;
 public $gafete;
 public $redireccion;
}


    $campos="id_registrado,nombrecompleto,categoria,fecha_impresion,id_cajero";
    $valores= array(
        $_POST['id_registrado'],
        $nombrecontancia,
        $_POST['categoria'],
        $fecha_registro,
        0

    );
    $usr= new mnpBD("gafetes");
    if ($usr->insertar($campos,$valores)) {
      $query="SELECT * FROM gafetes WHERE id_registrado=".$_POST['id_registrado']." and categoria='".$_POST['categoria']."'";
      $gafetes=$bd->ExecuteE($query);
      foreach($gafetes as $gafete){}

      $respuesta->success = true;
        $respuesta->id_registrado = $_POST['id_registrado'];
        $respuesta->gafete=$gafete['id'];
        $respuesta->mensaje="En un momento se imprimira su gafete";
        $respuesta->redireccion="imprimir_gafete.php?gafete=".$gafete['id'];

    }else{
      $respuesta->success = false;
        $respuesta->id_registrado = 0;
        $respuesta->gafete=0;
        $respuesta->mensaje="Error al generar su gafete";
        $respuesta->redireccion="./";
    }
      

echo json_encode($respuesta);


?>