<?php
include 'bd/mnpBDsas.class.php';

$pais=$_POST['pais'];
$query="SELECT * FROM estados WHERE id_pais =".$pais;
$estados=$bd->ExecuteE($query);
$html="";  
foreach ($estados as $estado){
  $html.='<option value="'.$estado['id_estado'].'">'.$estado['estado'].'</option>';
}                
                      
class respuesta {
 public $success;
 public $html;
}

$respuesta = new respuesta();
$respuesta->success = true;
$respuesta->html = $html;

echo json_encode($respuesta);
?>