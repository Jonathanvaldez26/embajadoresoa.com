<?php
include '../bd/mnpBDsas2.class.php';

$nomlaboratorio=$_POST['laboratorio'];
$prefijo=$_POST['prefijo'];
$becas=$_POST['becas'];
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];
$correo=$_POST['correo'];
$id_curso=$_POST['id_curso'];
date_default_timezone_set('America/Mexico_City');
$fecha_registro= date("Y-m-d H:i:s");
$lab=$_POST['lab'];

$campos="nombrecompleto,pref_beca,numbecados,nombreusuario,contrasena,email,fecha_registro";
$valores= array(
    $nomlaboratorio,
    $prefijo,
    $becas,
    $usuario,
    $contrasena,
    $correo,
    $fecha_registro
);


//-------------
class datos {
 public $success;
 public $id_laboratorio;
 public $mensaje;
 public $redireccion;
}
 
$respuesta = new datos();

$sql_labs="SELECT * FROM laboratorios WHERE nombrecompleto='".$nomlaboratorio."'";
$laboratorios  = $bd->ExecuteE($sql_labs);
foreach ($laboratorios as &$laboratorio) {}

    if (!empty($laboratorio)) {
        $respuesta->success = false;
        $respuesta->id_laboratorio = 0;
        $respuesta->mensaje="El laboratorio ".$laboratorio['nombrecompleto']." ya está dado de alta en nuestro sistema.";
        $respuesta->redireccion="";
    }else{
        $usr= new mnpBD("laboratorios");
        if($usr->insertar($campos,$valores)){
            $sql_labs="SELECT * FROM laboratorios WHERE nombrecompleto='".$nomlaboratorio."'";
            $laboratorios  = $bd->ExecuteE($sql_labs);
            foreach ($laboratorios as &$laboratorio) {}

            $becasinsertar=$laboratorio['numbecados'];
            $sql_becas="SELECT max(id) as id FROM becas";
            $becas  = $bd->ExecuteE($sql_becas);
            foreach ($becas as &$beca) {
                if($beca[id]>=1){
                    $id_beca=$beca[id];
                }else{
                    $id_beca=0;
                }
            }

            for ($x = 0; $x < $becasinsertar ; $x++) { 
                $id_beca++;
                $codigo=substr(strtoupper($_REQUEST[prefijo]), 0, 3)."".str_pad($id_beca, 3, "0", STR_PAD_LEFT)."".generaPass();  
                $campos2="id_laboratorio,codigo,id_curso";
                $valores2=array(
                    $laboratorio['id_laboratorio'],
                    $codigo,
                    $id_curso
                );
                $usr2= new mnpBD("becas");
                if($usr2->insertar($campos2,$valores2)){
                    $id_laboratorio=$laboratorio['id_laboratorio'];
                    $respuesta->success = true;
                    $respuesta->id_laboratorio = $id_laboratorio;
                    $respuesta->mensaje="El laboratorio y sus becas han sido dadas de alta exitosamente.";
                    $respuesta->redireccion="index.php";
                }else{
                    $respuesta->success = false;
                    $respuesta->id_laboratorio = 0;
                    $respuesta->mensaje="Error al registrar las becas, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
                    $respuesta->redireccion="";
                }
            
            }


        }
    }

    
        
        
        

function generaPass(){
  //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHMNPRTUVWXYZ1234567890";
  //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena=strlen($cadena);

  //Se define la variable que va a contener la contraseña
        $pass = "";
  //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass=3;

  //Creamos la contraseña
        for($i=1 ; $i<=$longitudPass ; $i++){
    //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
          $pos=rand(0,$longitudCadena-1);

    //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
          $pass .= substr($cadena,$pos,1);
        }
        return $pass;
      }
echo json_encode($respuesta);
?>