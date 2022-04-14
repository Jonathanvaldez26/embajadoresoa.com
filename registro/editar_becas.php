<?php
include '../bd/mnpBDsas2.class.php';

$id_laboratorio=$_POST['id_laboratorio2'];
$becados=$_POST['becas2'];




$sql_labs="SELECT * FROM laboratorios WHERE id_laboratorio='".$id_laboratorio."'";
    $laboratorios  = $bd->ExecuteE($sql_labs);
    foreach ($laboratorios as &$laboratorio) {}


$sql_becas="SELECT count(*) as total FROM becas WHERE id_laboratorio =".$laboratorio['id_laboratorio'];
$becas= $bd->ExecuteE($sql_becas);
foreach ($becas as $beca) {}
    $becasnuevas=$becados-$beca['total'];
    $nuevasbecas=$becasnuevas+$laboratorio['numbecados'];

//-------------
class datos {
 public $success;
}


 
$respuesta = new datos();
if ($becados < $beca['total']) {
    $respuesta->success = false;
    $respuesta->id_laboratorio = 0;
    $respuesta->mensaje="El numero de becas, no puede ser menor al que ya se tiene.";
    $respuesta->redireccion="";
}else{
    $campos="numbecados";
    $valores=array($nuevasbecas);
    $condicion=" id_laboratorio=".$id_laboratorio;
    $act=new mnpBD('laboratorios');
    if($act->actualizar($campos,$valores,$condicion)) {
    

        $sql_becas="SELECT max(id) as id FROM becas";
        $becas  = $bd->ExecuteE($sql_becas);
        foreach ($becas as &$beca) {

          if($beca[id]>=1){
            $id_beca=$beca[id];
          }else{
            $id_beca=0;
          }
        }
        for ($x = 0; $x < $becasnuevas; $x++) { 
            $id_beca++;
            $codigo=substr(strtoupper($laboratorio['pref_beca']), 0, 3)."".str_pad($id_beca, 3, "0", STR_PAD_LEFT)."".generaPass();  
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
                $respuesta->mensaje="Becas actualizadas correctamente";
                $respuesta->redireccion="index.php";
            }else{
                $respuesta->success = false;
                $respuesta->id_laboratorio = 0;
                $respuesta->mensaje="Error al actualizar las becas, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
                $respuesta->redireccion="";
            }
            
        }
    
        

    }else{
        $respuesta->success = false;
        $respuesta->id_laboratorio = 0;
        $respuesta->mensaje="Error al actualizar laboratorio, intente nuevamente si el error sigue enviar un correo a marco.gonzalez@grupolahe.com";
        $respuesta->redireccion="";
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