<?php
session_start(); 
include 'bd/mnpBDsas.class.php';

/** Se agrega la libreria PHPExcel */
require_once 'PHPExcel/PHPExcel.php';

$id_sesion=base64_decode($_GET[id_sesion]);

$consql="SELECT s.id_registrado, s.nombre, s.telefono, s.apellidop, s.apellidom, s.email, p.pais, e.estado, sa.fecha_hora AS Inicio_Conexion, sa.fin_conexion AS Fin_Conexion, TIMEDIFF( sa.fin_conexion, sa.fecha_hora ) AS Tiempo_Activo FROM registrados AS s INNER JOIN estados AS e ON e.id_estado = s.id_estado INNER JOIN paises AS p ON p.id_pais = s.id_pais INNER JOIN sesionesasistentes AS sa ON sa.id_registrado = s.id_registrado WHERE sa.id_sesion =".base64_decode($_GET['ref'])." GROUP BY s.email ORDER BY s.nombreconstancia ASC";
//$consql.="ORDER BY s.nombreconstancia ASC";

$apuntador=$bd->ExecuteE($consql);

  date_default_timezone_set('America/Mexico_City');
  if (PHP_SAPI == 'cli')
    die('Este archivo solo se puede ver desde un navegador web');

  // Se crea el objeto PHPExcel
  $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("AMMOM") //Autor
               ->setLastModifiedBy("AMMOM") //Ultimo usuario que lo modificó
               ->setTitle("Reporte Excel")
               ->setSubject("Reporte Excel")
               ->setDescription("")
               ->setKeywords("")
               ->setCategory("");

    // Se agregan los titulos del reporte
               $objPHPExcel->setActiveSheetIndex(0)
               ->setCellValue('A1', 'Titulo')
               ->setCellValue('B1', 'Nombre(s)')
               ->setCellValue('C1', 'Apellido Paterno')
               ->setCellValue('D1', 'Apellido Materno')
               ->setCellValue('E1', 'Correo ')
               ->setCellValue('F1', 'Pais')
               ->setCellValue('G1', 'Estado')
               ->setCellValue('H1', 'Telefono')


    // colocamos el numero de la fila donde empezarán a mostrarse los resultados
               $i=2;

    //Se agregan los datos        
               foreach($apuntador as &$reg ){

                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $reg['Prefijo'])
                ->setCellValue('B'.$i, $reg['nombre'])
                ->setCellValue('C'.$i, $reg['apellidop'])
                ->setCellValue('D'.$i, $reg['apellidom'])
                ->setCellValue('E'.$i, $reg['email'])
                ->setCellValue('F'.$i, $reg['pais'])
                ->setCellValue('G'.$i, $reg['estado'])
                ->setCellValue('H'.$i, $reg['telefono']);

                $i++;
               }

               for($i = 'A'; $i <= 'H'; $i++){
                $objPHPExcel->setActiveSheetIndex(0)      
                ->getColumnDimension($i)->setAutoSize(TRUE);
               }

    // Se asigna el nombre a la hoja
               $objPHPExcel->getActiveSheet()->setTitle('Reporte');

    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
               $objPHPExcel->setActiveSheetIndex(0);

    // Inmovilizar paneles 
    //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
               $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,2);

    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
               header('Content-Type: application/vnd.ms-excel; charset=utf-8');
               header('Content-Disposition: attachment;filename="ReporteAsistentes.xlsx"');
               header('Cache-Control: max-age=0');

               $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
               $objWriter->save('php://output');
               exit;
              
              
              ?>