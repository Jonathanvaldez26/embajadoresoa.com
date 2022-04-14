<?php
include '../../bd/mnpBDsas2.class.php';

$id_registrado=$_POST['id_registrado_edit'];
$nombre=$_POST['nombre'];
$apellidop=$_POST['apellidop'];
$apellidom=$_POST['apellidom'];
$correo=$_POST['correo'];
$pais=$_POST['pais'];
$nombreconstancia=$nombre." ".$apellidop;



//-------------
class datos {
 public $success;
}
 
$respuesta = new datos();
$campos="nombre,apellidop,apellidom,email,id_pais";
$valores=array($nombre,$apellidop,$apellidom,$correo,$pais);
$condicion=" id_registrado=".$id_registrado;
$act=new mnpBD('registrados');
if($act->actualizar($campos,$valores,$condicion)) {
     
    $respuesta->success = true;
    $respuesta->id_laboratorio = $id_laboratorio;
    $respuesta->mensaje="Datos actualizados correctamente.";
    $respuesta->redireccion="index.php";                

}else{
        $respuesta->success = false;
        $respuesta->id_laboratorio = 0;
        $respuesta->mensaje="Error al actualizar, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
        $respuesta->redireccion="";
    }


echo json_encode($respuesta);
?>