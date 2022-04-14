<?php
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
include 'bd/mnpBDsas.class.php';
$email=utf8_decode($_POST['email']);
$referencia=$_POST['referencia'];
date_default_timezone_set('America/Mexico_City');
$fecha= date("Y-m-d H:i:s");

$sql_registrados="SELECT * FROM registrados WHERE email='".$email."'";
  $sql_sesiones = "SELECT * FROM sesiones WHERE id_sesion = ".$referencia;
$sesiones = $bd->ExecuteE($sql_sesiones);
foreach($sesiones as $sesion){
}
$dia=$sesion['fecha'];
$hora = date('H:i',strtotime($sesion['hora']."-25 minute"));
$fecha2 = $dia." ".$hora;

if ($email=="marco.gonzalez@grupolahe.com") {
    $fecha2= "2020-01-01 00:00:00";
}


//-------------
class datos {
 public $success;
 public $id_registrado;
 public $mensaje;
 public $redireccion;
 public $activo;
}

 $respuesta = new datos();
 $respuesta->success = false;
 $respuesta->id_registrado=0;
 $respuesta->mensaje="Al parecer no estas registrado en nuestro sistema, registrate para que puedas acceder a la transmisión en vivo.";
 $respuesta->redireccion="";
 $respuesta->activo="";
//------------
$registrados  = $bd->ExecuteE($sql_registrados);
foreach ($registrados as &$registrado) {

    if ($registrado['activo']==0) {
        $respuesta->success = false;
        $respuesta->id_registrado=$registrado['id_registrado'];
        $respuesta->mensaje=utf8_encode("No puedes acceder a nuestro sistema, por algun incumplimiento en nuestras normas.");
        $respuesta->redireccion="index.php";
        $respuesta->activo=0;

    }else{


        if($fecha < $fecha2){
            $respuesta->success = false;
            $respuesta->id_registrado=$registrado['id_registrado'];
            // $respuesta->mensaje="Usted ya esta registrado en nuestro sistema, la sesión ha terminado.";
            $respuesta->mensaje="Usted ya esta registrado en nuestro sistema, pero aun no puedes ingresar debido a que la sesión no ha comenzado.";
            $respuesta->redireccion="index.php";
            $respuesta->activo=0;
            $resco2=$bd->RecordCount("registrados_sesion","id_registrado=".$registrado['id_registrado']." AND id_sesion = ".$referencia);
            if ($resco2 > 0) {
               
            }else{
                $campos='id_registrado, id_sesion, fecha'; 
                $datos=array($registrado['id_registrado'],$referencia,$fecha);
                $usr=new mnpBD('registrados_sesion');
                $usr->insertar($campos,$datos);
            }
            
        }else{
            if ($sesion['activo']==0) {
                $respuesta->success = false;
            $respuesta->id_registrado=$registrado['id_registrado'];
            $respuesta->mensaje="La sesión termino.";
            $respuesta->redireccion="index.php";
            $respuesta->activo=0;
            }else{
                session_start();

            $_SESSION['id_registrado']=$registrado['id_registrado'];
            
            $_SESSION['registrado']['id_registrado']=$registrado['id_registrado'];
            $_SESSION['registrado']['login']=true;
            $_SESSION['registrado']['nombrecompleto']=utf8_encode($registrado['nombreconstancia']);

            $rescon=$bd->RecordCount("sesionesasistentes","id_registrado=".$registrado['id_registrado']." AND id_sesion = ".$referencia);
            if ($rescon > 0) {
                $campos='id_registrado, id_sesion, ip, fecha_hora'; 
                $datos=array($_SESSION['registrado']['id_registrado'],$referencia, get_real_ip(),$fecha);
                $usr=new mnpBD('logeos');
                $usr->insertar($campos,$datos);
                
                    $respuesta->success = true;
                    $respuesta->id_registrado=$registrado['id_registrado'];
                    $respuesta->mensaje="Presione aceptar para ingresar a la transmisión";
                    $respuesta->redireccion="transmision.php?ref=".base64_encode($referencia);
                    $respuesta->activo=1;
                
                
            }else{
                $campos='id_registrado, id_sesion, ip, fecha_hora'; 
                $datos=array($_SESSION['registrado']['id_registrado'],$referencia, get_real_ip(),$fecha);
                $usr=new mnpBD('logeos');
                $campos2 = 'id_registrado, id_sesion, fecha_hora';
                $datos2 = array($_SESSION['registrado']['id_registrado'], $referencia, $fecha);
                $usr2 = new mnpBD('sesionesasistentes');
                
                if($usr2->insertar($campos2,$datos2) && $usr->insertar($campos,$datos)){
                    $respuesta->success = true;
                    $respuesta->id_registrado=$registrado['id_registrado'];
                    // $respuesta->mensaje="Presione aceptar para ingresar a la transmisión";
                    $respuesta->redireccion="transmision.php?ref=".base64_encode($referencia);
                    $respuesta->activo=1;
                }
            }
            
            

            
        }

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