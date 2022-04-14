<?php
session_start();
include 'bd/mnpBDsas.class.php'; 

require('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');
date_default_timezone_set('Mexico/General');



$query="SELECT * FROM registrados WHERE id_registrado = ".$_GET['id_registrado'];
$gafetes=$bd->ExecuteE($query);


$pdf=new FPDF('L','cm', Letter);
$pdf->SetLeftMargin(0);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(0);
$pdf->SetAutoPageBreak(0,0);
foreach ($gafetes as $gafete) {

$pdf->AddPage();
$pdf->Image('fpdf/constancia_ammom-'.$_GET['sesion'].'.jpg',0,0,27.94, 21.59);
$pdf->SetXY(5.55, 8.4);
		$pdf->SetFont('Times','B',28);
		$pdf->Multicell(17,1,utf8_decode($gafete['nombreconstancia']),0,'C');
		$pdf->SetFont('Times','B',15);

		// $url="http://conferenciaenlinea.com.mx/asofarma/ammom/validar_constancia.php?id_registrado=".$_GET['id_registrado']."&id_sesion=".$_GET['sesion'];
	 // 	$nombre_qr_png='qrcode_'.$gafete['id'].'.png';
		// $errorCorrectionLevel = 'L';
		// $matrixPointSize = 4;
		// QRcode::png($url, $nombre_qr_png, $errorCorrectionLevel, $matrixPointSize, 2); 
		// $pdf->Image($nombre_qr_png,24,12.0,2.5,2.5);
		
		// unlink($nombre_qr_png);
		$query="UPDATE sesionesasistentes SET constancia='".date("Y-m-d H:i:s")."' WHERE id_registrado=".$_GET['id_registrado']." AND id_sesion=".$_GET['sesion'];
$gafetes=$bd->ExecuteNonQuery($query);
$pdf->Output("Constancia-".utf8_decode($gafete['nombreconstancia']).".pdf","D");
}

