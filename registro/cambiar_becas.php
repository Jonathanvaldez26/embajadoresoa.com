<?php
include '../bd/mnpBDsas.class.php';

$id_curso=$_POST['id_curso'];
$id_laboratorio=$_POST['id_laboratorio'];

$query="SELECT count(*) as total FROM becas b INNER JOIN laboratorios l ON b.id_laboratorio = l.id_laboratorio WHERE b.id_laboratorio =".$id_laboratorio." AND b.id_curso = ".$id_curso;
$becas=$bd->ExecuteE($query);
                
                      
class respuesta {
 public $success;
 public $becas;
}

foreach ($becas as $beca){
$respuesta = new respuesta();
$respuesta->success = true;
$respuesta->becas = $beca['total'];
}

echo json_encode($respuesta);
?>