<?php 
setlocale(LC_TIME, 'spanish');

include '../bd/mnpBDsas.class.php';

$queryComprobantes = "SELECT cursos_registro_pagos.id as id_cursos_pagos, registrados.id_registrado, estatus_pago.estatus_pago,cursos.nombre_curso,registrados.nombre,
registrados.apellidop,registrados.apellidom,cursos_registro_pagos.comprobante_text
FROM `cursos_registro_pagos` INNER JOIN precios_cursos ON cursos_registro_pagos.id_precio_curso = precios_cursos.id INNER JOIN cursos ON precios_cursos.id_cursos = cursos.id 
INNER JOIN registrados ON registrados.id_registrado = cursos_registro_pagos.id_registrado 
INNER JOIN estatus_pago ON estatus_pago.id = cursos_registro_pagos.id_estatus_pago
WHERE estatus_pago.id in(4) AND id_forma_pago = 2"; 
$datosOperation = $bd->ExecuteE($queryComprobantes);
$tabla = ""; 
$i = 0 ; 
 if(!empty($datosOperation)){
    foreach($datosOperation as $datoOperation){ 
        $i ++; 
        $nombreCompleto = $datoOperation['nombre'].' '.$datoOperation['apellidop'].' '.$datoOperation['apellidom']; 
        $idCursoRegistro = $datoOperation['id_cursos_pagos']; 
        $cursos = $datoOperation['nombre_curso']; 
        $estatusPago = $datoOperation['estatus_pago']; 
          $succes   =  "<button class='btn btn-success seeVersion' id='btnVersion".$i."'  onclick='ModalConfirmacion( ".$idCursoRegistro.",1)'   name='btnVersion'><i class='fa fa-check'></i></button>";
          $delete   =  "<button class='btn btn-danger deleteVersion' id='btnDelte".$i."'  onclick='ModalConfirmacion(".$idCursoRegistro.",0)'   name='btnVersion'><i class='fa fa-times'></i></button>";
          $print    =  "<a class='btn btn-primary seeVersion' id='btnVersion".$i."' href='../plataforma/comprobantes/".$datoOperation['comprobante_text']."' download='".$datoOperation['comprobante_text']."'   name='btnVersion'><i class='fa  fa-print'></i></a>";
          
          $acciones = $succes.' '.$delete.' '.$print; 
          
          $validacionAcciones = $datoOperation['comprobante_text'] == "" || $datoOperation['comprobante_text'] == null  ? "No hay Acciones" : $acciones; 
          
          $accionesOK        = $datoOperation['estatus_pago'] == 3 ? "Sin acciones" : $validacionAcciones; 
          
        $tabla .= '{
            "conce": "' . $i . '",
            "nombre":"' . $nombreCompleto . '",
            "curso":  "' .$cursos.'" ,
            "estatus":  "' .$estatusPago.'" ,
            "acciones": "'.$validacionAcciones.'"
            },';
    }
    $tabla = substr($tabla, 0, strlen($tabla) - 1);
    $datos = '{"data":[' . $tabla . ']}';
    print_r($datos);
 }else{
    $datos = '{"data":[]}';
    print_r($datos);
 }