<?php
session_start();
error_reporting (0);
require '../virtual/bd/mnpBDsas.class.php'; 

require('pdfb/pdfb_m.php');
date_default_timezone_set('Mexico/General');



$query="SELECT * FROM gafetes WHERE categoria='PROFESOR' ";
$gafetes=$bd->ExecuteE($query);

$pdf=new PDFB('P','cm', Letter);
$pdf->SetLeftMargin(0);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(0);
$pdf->SetAutoPageBreak(0,0);


foreach ($gafetes as $gafete) {
	$pdf->AddPage();
	$pdf->BarCode(str_pad($gafete['id'], 5, "0", STR_PAD_LEFT), "C128A", 8.8, 21.8,4,2.5, .80, .80, 1, 3, "", "PNG");
	$pdf->SetFont('Times','B',20);
	$pdf->setXY(6.1,20);
	$pdf->MultiCell(9.1,0.8,utf8_decode(mb_strtoupper($gafete['prefijo']." ".$gafete['nombrecompleto']." ".$gafete['apellidop']." ".$gafete['apellidom'])),0,"C");
}

$pdf->Output("profesores.pdf","I");
?>
 