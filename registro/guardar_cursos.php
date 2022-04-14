<?php
setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
setlocale(LC_TIME, 'spanish');
date_default_timezone_set ( "America/Mexico_City");
include '../bd/mnpBDsas.class.php';


$nombreCurso  = $_POST['title_theme']; 
$fechaInicio  = $_POST['startFecha']; 
$fehcaFin     = $_POST['endFecha']; 


$horaInicio   = $_POST['relojfin']; 
$horaFin      = $_POST['relojfin']; 

$freee        = $_POST['freee']; 


$imgCurso = $_FILES['img_curso']; 
$folder      = '../frontpage/img/cursos/detalles/';



  $fechaInicioSave  = fechaparaDB($fechaInicio); 
  $fechaFinSave     = fechaparaDB($fehcaFin) ;
  $mes      = utf8_encode(strftime("%B",strtotime($fechaInicioSave))); 
 
 if($fechaInicioSave != $fechaFinSave)
 {
 	
 	$no_fecha = 2 ;
  $insertInformacion  = guardarInformacionCursos($nombreCurso,$fechaInicioSave,$fechaFinSave,$horaInicio,$horaFin,$no_fecha,$mes); 
 	
 	
 }else{
 	echo "no pasa"; 
 }






//$uploadImagnes = validacionImagenes($imgCurso,$folder,1); 

//var_dump($uploadImagnes); 




function guardarInformacionCursos($nombreCurso,$fechaInicio,$fechaFin,$horaInicio,$horaFin,$no_fecha,$mes)
{
	    $cursosRegistroPagosInsert    = new mnpBD("cursos");
		  $campos = 'nombre_curso,fecha,fechafin,hora,hora_fin,mes,no_fechas,fecha_registro'; 
		  $valor  = array($nombreCurso,$fechaInicio,$fechaFin,$horaInicio,$horaFin,$no_fecha,$mes,date('Y-m-d H:i:s')); 
			$insertCurso = $cursosRegistroPagosInsert->insertar($campos,$valor);
	    if($insertCurso)
	    {
	    	return true;
	    }else{
	    	return false; 
	    }
	
	
}



function validacionImagenes($imagen,$folder,$idUltimate)
{
       
       
         $type   = $imagen["type"];
        $tmp_n  = $imagen["tmp_name"];
        $size   = $imagen["size"];
        if($imagen["name"] == ""){
          
             return  array('response' => "ok", 'message' => "Imagen Cargada Default", 'nameArchivo' => "");
        }
     
        if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png'  && $type != 'image/gif' ) {
            return  array(
                "response" => "error",
                "type"     => "saveUsuario",
                "message"  => "Error, Solo se aceptan archivos JPG.",
                "data"     => "",
            );
        } else if ($size > 5000 * 5000) {
            return  array(
                "response" => "error",
                "type"     => "saveUsuario",
                "message"  => "Error, el tamaño máximo permitido es un 5MB.",
                "data"     => "",
            );
        } else {
            $temp        = explode(".", $imagen["name"]); 
            $newfilename = date('H-i-s') . $idUltimate . '-' . 'curso.' . end($temp);
            
            if (move_uploaded_file($imagen["tmp_name"], $folder . $newfilename)) {
                return  array('response' => "ok", 'message' => "Imagen Cargada", 'nameArchivo' => $newfilename);
            }else{
                return array(
                    "response" => "error",
                    "type"     => "saveUsuario",
                    "message"  => "Error, al subir la foto.",
                    "data"     => "",
                );
            }
        }

    }
    
    
    function fechaparaDB($fecha)
    {

        $arrFec    = explode("/", $fecha);
        $arrayVali = $arrFec[2] . "-" . $arrFec[0] . "-" . $arrFec[1];
        return $arrayVali;
    }
    
    function fechaMes($fecha)
    {
    	  $arrFec    = explode("/", $fecha);
        $arrayVali =  $arrFec[0]; 
        return $arrayVali;
    	
    }


   function meses($mes)
   {
   	 $meses =  array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
       'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
     
     return  $meses[$mes];   
   }