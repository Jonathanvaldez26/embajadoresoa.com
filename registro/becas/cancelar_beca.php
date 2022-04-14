<?php
include '../../bd/mnpBDsas2.class.php';

$id_beca=$_POST['id_beca'];

//-------------
class datos {
 public $success;
}
 
$respuesta = new datos();
$campos="usadopor";
$valores=array(0);
$condicion=" id=".$id_beca;
$act=new mnpBD('becas');
if($act->actualizar($campos,$valores,$condicion)) {
     
    $respuesta->success = true;
    $respuesta->id_laboratorio = $id_laboratorio;
    $respuesta->mensaje="Beca cancelada correctamente.";
    $respuesta->redireccion="./";                

}else{
        $respuesta->success = false;
        $respuesta->id_laboratorio = 0;
        $respuesta->mensaje="Error al cancelar, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
        $respuesta->redireccion="";
    }


echo json_encode($respuesta);
?>