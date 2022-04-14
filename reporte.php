<?php
session_start(); 
include 'bd/mnpBDsas.class.php';

/** Se agrega la libreria PHPExcel */
require_once 'PHPExcel/PHPExcel.php';


$objPHPExcel = new PHPExcel();
  $objPHPExcel->getProperties()
  ->setCreator('LAHE-ALBERT-DEVELOPER')
  ->setTitle('Reporte sesion')
  ->setDescription('Reporte sesion')
  ->setKeywords('Reporte sesion')
  ->setCategory('seiom');

 
  $hoja1 = $objPHPExcel->setActiveSheetIndex(0);
  
  
   $idSession = base64_decode($_GET[ref]);
  

  $hoja1->setTitle('Registro de la session');
  $hoja1->setCellValue('A1', 'ID Registrado');
  $hoja1->setCellValue('B1', 'Nombre');
  $hoja1->setCellValue('C1', 'Apellido Paterno');
  $hoja1->setCellValue('D1', 'Apellido Materno');
  $hoja1->setCellValue('E1', 'Prefijo');
  $hoja1->setCellValue('F1', 'Nombre Constancia');
  $hoja1->setCellValue('G1', 'Telfono');
  $hoja1->setCellValue('H1', 'Email');
  $hoja1->setCellValue('I1', 'Pais');
  $hoja1->setCellValue('J1', 'Estado');
  $hoja1->setCellValue('K1', 'Especialidad');
  $hoja1->setCellValue('L1', 'Cedula');
  $hoja1->setCellValue('M1', 'Conectado');
  $hoja1->setCellValue('N1', 'Fin');
  $hoja1->setCellValue('O1', 'Tiempo de Conexión');

   $sql = "
          SELECT registrados.id_registrado,registrados.email,
          registrados.nombre,registrados.apellidop,registrados.apellidom,
          registrados.prefijo,registrados.nombreconstancia,registrados.telefono,
          registrados.fecha_registro,sesionesasistentes.fecha_hora,sesionesasistentes.fin_conexion,
           paises.pais,estados.estado,registrados.cedula,registrados.especialidad,TIMEDIFF( sesionesasistentes.fin_conexion, sesionesasistentes.fecha_hora ) AS Tiempo_Activo FROM registrados INNER JOIN sesionesasistentes ON sesionesasistentes.id_registrado = registrados.id_registrado
           INNER JOIN sesiones on sesiones.id_sesion = sesionesasistentes.id_sesion inner join paises ON paises.id_pais = registrados.id_pais 
           INNER JOIN estados ON estados.id_estado = registrados.id_estado WHERE sesionesasistentes.id_sesion = ".$idSession.""; 
  $resultado=$bd->ExecuteE($sql);
  $column = 1; 
    foreach ($resultado as $datos) {
      
       //$dataRow[] = $row;
          $column++; 
          $hoja1->setCellValue('A'.$column,$datos['id_registrado']);
          $hoja1->setCellValue('B'.$column,$datos['nombre']);
          $hoja1->setCellValue('C'.$column,$datos['apellidop']);
          $hoja1->setCellValue('D'.$column,$datos['apellidom']);
          $hoja1->setCellValue('E'.$column,$datos['prefijo']);
          $hoja1->setCellValue('F'.$column,$datos['nombreconstancia']);
          $hoja1->setCellValue('G'.$column,$datos['telefono']);
          $hoja1->setCellValue('H'.$column,$datos['email']);
          $hoja1->setCellValue('I'.$column,$datos['pais']);
          $hoja1->setCellValue('J'.$column,$datos['estado']);
          $hoja1->setCellValue('K'.$column,$datos['especialidad']);
          $hoja1->setCellValue('L'.$column,$datos['cedula']);
          $hoja1->setCellValue('M'.$column,$datos['fecha_hora']);
          $hoja1->setCellValue('N'.$column,$datos['fin_conexion']);
          $hoja1->setCellValue('O'.$column,$datos['Tiempo_Activo']);
       
     }
     







   //$hoja1->getStyle('B5')->applyFromArray($styleTitleBlack);




  header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header('Content-Disposition: attachment;filename="Reporte de la sesion.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('php://output');