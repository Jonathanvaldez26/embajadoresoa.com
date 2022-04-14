<?php 
include '../bd/mnpBDsas.class.php';


  $idSession       = $_POST['idSession']; 
 $statusCambio    = $_POST['statusCambio']; 

$act=new mnpBD('cursos_registro_pagos');
if($statusCambio == 1)
{
		$campos        ="id_estatus_pago";
		$valores       = array(3);
		$condicion     = 'id ='.$idSession;
	  $actualizar  	 = $act->actualizar($campos,$valores,$condicion);
	  if($actualizar){
	  	 echo json_encode(array(
	                 "response"  => "ok",
	                 "message"  => "El Comprobante de pago fue aceptado" 
	                 
	                 )); 
	  }else{
	  	 echo json_encode(array(
	                 "response"  => "error",
	                 "message"  => "Error al actualizar el comprobante aceptado" 
	                 
	                 )); 
	  }
	
}else{
	  $campos        ="id_estatus_pago";
		$valores       = array(5);
		$condicion     = 'id ='.$idSession;
	  $actualizar    =  $act->actualizar($campos,$valores,$condicion);
	   if($actualizar){
	  	 echo json_encode(array(
	                 "response"  => "ok",
	                 "message"  => "El Comprobante de pago  no fue aceptado" 
	                 
	                 )); 
	  }else{
	  	 echo json_encode(array(
	                 "response"  => "error",
	                 "message"  => "Error al actualizar el comprobante no  aceptado" 
	                 
	                 )); 
	  }
}
