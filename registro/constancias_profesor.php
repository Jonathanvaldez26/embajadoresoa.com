<?php
session_start();
error_reporting (0);
require '../virtual/bd/mnpBDsas.class.php'; 

require('pdfb/pdfb_m.php');
date_default_timezone_set('Mexico/General');



$query="SELECT * FROM gafetes WHERE categoria='PROFESOR' ";
$gafetes=$bd->ExecuteE($query);

$pdf=new PDFB('L','cm', Letter);
$pdf->SetLeftMargin(0);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(0);
$pdf->SetAutoPageBreak(0,0);


foreach ($gafetes as $gafete) {
	$pdf->AddPage();
	$pdf->SetFont('Times','B',26);
$pdf->setXY(6.1,8.1);
$pdf->MultiCell(16.1,1,utf8_decode(mb_strtoupper($gafete['prefijo']." ".$gafete['nombrecompleto']." ".$gafete['apellidop']." ".$gafete['apellidom'])),0,"C");

$pdf->SetFont('Times','B',18);
$pdf->setXY(6.1,9.85);
$pdf->MultiCell(16.1,1.3,utf8_decode("Por su participación como ASISTENTE a"),0,"C");

$pdf->Image("img/firma.png",11.3,17.4,4.77,1.79);
}

$pdf->Output("profesores.pdf","I");
?>