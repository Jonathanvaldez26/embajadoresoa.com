<?php 
setlocale(LC_TIME, 'spanish');

include '../bd/mnpBDsas.class.php';

$queryCursos = "SELECT cursos.id,cursos.nombre_curso,cursos.fecha,cursos.fechafin,cursos.hora,cursos.hora_fin FROM `cursos`"; 
$datosOperation = $bd->ExecuteE($queryCursos);
$tabla = ""; 
$i = 0 ; 
 if(!empty($datosOperation)){
    foreach($datosOperation as $datoOperation){ 
        $i ++; 
       
          
          
        $tabla .= '{
            "conce": "' . $i . '",
            "nombreCurso":"' . $datoOperation['nombre_curso'] . '",
            "fecha":  "' .$datoOperation['fecha'].'" ,
            "horario":  "' .$datoOperation['hora'].'" ,
            "acciones": "hola"
            },';
    }
    $tabla = substr($tabla, 0, strlen($tabla) - 1);
    $datos = '{"data":[' . $tabla . ']}';
    print_r($datos);
 }else{
    $datos = '{"data":[]}';
    print_r($datos);
 }