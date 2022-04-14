<?php
include 'bd/mnpBDsas.class.php';
$email=utf8_decode($_POST['email']);
$referencia=$_POST['referencia'];
date_default_timezone_set('America/Mexico_City');
$fecha= date("Y-m-d H:i:s");
$fecha2 = '2020-04-23 19:30:00';

$sql_registrados="SELECT * FROM registrados WHERE email='".$email."'";
$sql_sesiones = "SELECT * FROM sesiones WHERE id_sesion = ".$referencia;
$sesiones = $bd->ExecuteE($sql_sesiones);
foreach($sesiones as $sesion){
}

//-------------
class datos {
 public $success;
 public $id_registrado;
 public $mensaje;
 public $redireccion;
}

 $respuesta = new datos();
 $respuesta->success = false;
 $respuesta->id_registrado=0;
 $respuesta->mensaje="No estás registrado.";
 $respuesta->redireccion="";
//------------
$registrados  = $bd->ExecuteE($sql_registrados);
foreach ($registrados as &$registrado) {

    if ($registrado['id_registrado']!=0) {
       $rescon=$bd->RecordCount("sesionesasistentes","id_registrado=".$registrado['id_registrado']." AND id_sesion = ".$referencia);
       if ($rescon >0) {
            $respuesta->success = true;
            $respuesta->id_registrado=$registrado['id_registrado'];
            $respuesta->mensaje="En un momento su constancia se descargara.";
            $respuesta->redireccion="descargar_constancia.php?id_registrado=".$registrado['id_registrado']."&sesion=".$referencia;
       }else{
            $respuesta->success = false;
            $respuesta->id_registrado=$registrado['id_registrado'];
            $respuesta->mensaje="Al parecer no ingresaste a la sesión.";
            $respuesta->redireccion="";
       }
    }

    }

function get_real_ip()
            { 
                if (isset($_SERVER["HTTP_CLIENT_IP"])){
                    return $_SERVER["HTTP_CLIENT_IP"];
                }
                elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                    return $_SERVER["HTTP_X_FORWARDED_FOR"];
                }
                elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
                    return $_SERVER["HTTP_X_FORWARDED"];
                }
                elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
                    return $_SERVER["HTTP_FORWARDED_FOR"];
                }
                elseif (isset($_SERVER["HTTP_FORWARDED"])){
                    return $_SERVER["HTTP_FORWARDED"];
                }
                else{
                    return $_SERVER["REMOTE_ADDR"];
                }
            }
echo json_encode($respuesta);
?>