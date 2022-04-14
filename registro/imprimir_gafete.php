<?php
session_start();
error_reporting (0);
include '../bd/mnpBDsas.class.php';
require('pdfb/pdfb_m.php');
date_default_timezone_set('Mexico/General');
$query="SELECT * FROM gafetes WHERE id=".$_GET['gafete'];
$gafetes=$bd->ExecuteE($query);
foreach($gafetes as $gafete){}



$pdf=new PDFB('P','cm', Letter);
$pdf->SetLeftMargin(0);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(0);
$pdf->SetAutoPageBreak(0,0);
$pdf->AddPage();
$pdf->BarCode(str_pad($gafete['id'], 5, "0", STR_PAD_LEFT), "C128A", 8.8, 21.8,4,2.5, .80, .80, 1, 3, "", "PNG");
$pdf->SetFont('Times','B',20);
$pdf->setXY(6.1,19.5);
$pdf->MultiCell(9.1,0.8,utf8_decode($gafete['nombrecompleto']),0,"C");
$pdf->AutoPrint(true);
$pdf->Output("tmp/gafete_".$gafete['id'].".pdf","F");
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gafete</title>
	

</head>
<body onload="cerrarVentana();">
	<iframe src="tmp/gafete_<?=$gafete['id']?>.pdf?<?=date('i')?>" style="width: 100%; height: 1300px;"></iframe>
	<script>
		function cerrarVentana()
		{
			setTimeout("cerrar();", 15000);
		} 
		function cerrar() {
			window.close();
		}
	</script>
</body>
</html>