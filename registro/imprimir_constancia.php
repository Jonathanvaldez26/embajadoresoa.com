<?php
session_start();
error_reporting (0);
include '../bd/mnpBDsas.class.php';
require('pdfb/pdfb_m.php');
date_default_timezone_set('Mexico/General');
$fecha_registro= date("Y-m-d H:i:s");
$query="SELECT * FROM gafetes WHERE id=".$_GET['gafete'];
$gafetes=$bd->ExecuteE($query);
foreach($gafetes as $gafete){}

$campos="constancia";
$valores= array(
	$fecha_registro,
);
$usr= new mnpBD("gafetes");
$condicion=" id=".$_GET['gafete'];
if ($usr->actualizar($campos,$valores,$condicion)) {
$pdf=new PDFB('L','cm', Letter);
$pdf->SetLeftMargin(0);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(0);
$pdf->SetAutoPageBreak(0,0);
$pdf->AddPage();
// $pdf->Image("pdfb/Constancia_OA_.jpg",0,0,27.94, 21.59);
$pdf->SetFont('Times','B',26);
$pdf->setXY(6,9.2);
$pdf->MultiCell(16.1,1,utf8_decode($gafete['prefijo']." ".$gafete['nombrecompleto']),0,"C");

$pdf->SetFont('Times','B',18);
$pdf->setXY(6.1,10.8);
$pdf->MultiCell(16.1,1.3,utf8_decode("Por su participación como ".$gafete['categoria']." en:"),0,"C");
// $pdf->Image("pdfb/Arturo-.png",11.5,18,5,1);
$pdf->AutoPrint(true);
$pdf->Output("tmp/constancia_".$gafete['id'].".pdf","F");

?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Constancia</title>
	

</head>
<body onload="cerrarVentana();">
	<iframe src="tmp/constancia_<?=$gafete['id']?>.pdf" style="width: 100%; height: 1300px;"></iframe>
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
<?php }else{
	echo "error";
} ?>