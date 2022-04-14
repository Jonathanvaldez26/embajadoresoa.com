2<?php
include '../bd/mnpBDsas2.class.php';

$id_laboratorio=$_POST['id_laboratorio3'];
$laboratorio=$_POST['laboratorio'];
$prefijo=$_POST['prefijo'];
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];
$email=$_POST['correo'];



//-------------
class datos {
 public $success;
}
 
$respuesta = new datos();
$campos="nombrecompleto,pref_beca,nombreusuario,contrasena,email";
$valores=array($laboratorio,$prefijo,$usuario,$contrasena,$email);
$condicion=" id_laboratorio=".$id_laboratorio;
$act=new mnpBD('laboratorios');
if($act->actualizar($campos,$valores,$condicion)) {
     
    $respuesta->success = true;
    $respuesta->id_laboratorio = $id_laboratorio;
    $respuesta->mensaje="Datos del laboratorio actualizados correctamente.";
    $respuesta->redireccion="index.php";                

}else{
        $respuesta->success = false;
        $respuesta->id_laboratorio = 0;
        $respuesta->mensaje="Error al actualizar laboratorio, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
        $respuesta->redireccion="";
    }


echo json_encode($respuesta);
?>