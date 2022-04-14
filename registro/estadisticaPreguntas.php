<?php 
session_start();
include '../bd/mnpBDsas.class.php';
if(isset($_SESSION['admin']['id']) && $_SESSION['admin']['login']==true){

}else{
  header("location:login.php");
  exit;
}
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Estadisticas</title>

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="vendor/animate/animate.css">

		<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
	<!--	<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap4.css" />-->
		 <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
	   <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

	</head>
	
	<body>
		<section class="body">

			

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include('main-menu.php') ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body pb-0">
					<header class="page-header">
						<h2>ESTADISTICAS</h2>
					
					</header>

					<!-- start: page 
					<section class="call-to-action call-to-action-primary call-to-action-top mb-4">
						<div class="container container-with-sidebar">
							
						</div>
					</section>-->

					<!-- REGISTRADOS -->

					<div class="row">
							<div class="col">
								<section class="card">
									
									<div class="card-body">
									
									<?php 
	                                           $queryPregunta = "select * from preguntas_cli";
				                               $preguntas  = $bd->ExecuteE($queryPregunta);
				foreach($preguntas as $pregunta){
	                                 ?>
									<center>	<h3> <?=$pregunta['id']?>. <?=$pregunta['pregunta']?></h3></center>
									

										 <?php 
                                             if($pregunta['id'] == 1 || $pregunta['id'] == 2 ||  $pregunta['id'] == 3
                                               ||  $pregunta['id'] == 6 ||  $pregunta['id'] == 7 ||  $pregunta['id'] == 8
                                               ||  $pregunta['id'] == 9 ||  $pregunta['id'] == 10 ||  $pregunta['id'] == 11
                                               ||  $pregunta['id'] == 12 ||  $pregunta['id'] == 13){
										 ?>

										<table class="table table-bordered mb-0 display tablesEst" id="datatable">
											<thead>
												<tr>
													<th>#</th>
													<th>RESPUESTAS</th>
													<th>TOTAL</th>
													
												</tr>
											</thead>
											<tbody>
												<?php
													$sql_labs="SELECT COUNT(registro_encuesta_cli.respuestas_preg) as total,respuestas_encuestas_cli.respuesta  FROM registro_encuesta_cli INNER JOIN preguntas_cli ON registro_encuesta_cli.pregunta_id = preguntas_cli.id INNER JOIN respuestas_encuestas_cli ON respuestas_encuestas_cli.id = registro_encuesta_cli.respuestas_preg
	WHERE  preguntas_cli.id = ".$pregunta['id']."
	GROUP BY respuestas_encuestas_cli.respuesta
	ORDER BY total DESC";
												$laboratorios  = $bd->ExecuteE($sql_labs);
												$i=1;
												foreach ($laboratorios as &$laboratorio) {
												?>
												<tr >
													<td><?php echo $i; ?></td>
													<td><?php echo $laboratorio['respuesta']; ?></td>
													<td><?php echo $laboratorio['total']; ?></td>
													
																							  
																								
												</tr>	
												<?php $i++; } ?>												
												
											</tbody>
										</table>
                                         <?php
                                     }else if($pregunta['id'] == 4 || $pregunta['id'] == 14){
                                     	?>
                                               
										 <table class="table table-bordered mb-0 display tablesEst" id="datatable-tabletools">
											<thead>
												<tr>
													<th>#</th>
													<th>COMENTARIO</th>
												
													
												</tr>
											</thead>
											<tbody>
												<?php
												$sql_comenetario="SELECT registro_encuesta_cli.respuestas_preg FROM registro_encuesta_cli
												WHERE  registro_encuesta_cli.pregunta_id = ".$pregunta['id']."";
												$comentarios  = $bd->ExecuteE($sql_comenetario);
												$i=1;
												foreach ($comentarios as &$comentario) {
												?>
												<tr >
													<td><?php echo $i; ?></td>
													<td><?php echo $comentario['respuestas_preg']; ?></td>											
												</tr>	
												<?php $i++; } ?>												
												
											</tbody>
										</table>







                                         <?php
                                             }else if($pregunta['id'] == 5){
                                         ?>


                                                <table class="table table-bordered mb-0 display tablesEst" id="datatable-tabletools">
											<thead>
												<tr>
													<th>#</th>
													<th>PAIS</th>
												    <th>TOTAL</th>
													
												</tr>
											</thead>
											<tbody>
												<?php
												$sql_pais="SELECT COUNT(*) as total ,`respuestas_preg` as pais FROM `registro_encuesta_cli`
												WHERE  registro_encuesta_cli.pregunta_id = ".$pregunta['id']."  GROUP BY respuestas_preg ";
												$paises  = $bd->ExecuteE($sql_pais);
												$i=1;
												foreach ($paises as &$pais) {
												?>
												<tr >
													<td><?php echo $i; ?></td>
													<td><?php echo $pais['pais']; ?></td>	
													<td><?php echo $pais['total']; ?></td>											
												</tr>	
												<?php $i++; } ?>												
												
											</tbody>
										</table>







										<?php
										  }
										}
										?>
										
									</div>
								</section>
							</div>
						</div>
					
						
						<!-- AREA COMERCIAL -->
						<!--  -->
						
					<!-- end: page -->
				</section>
			</div>

		</section>

		<!-- Vendor -->
		

		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="vendor/popper/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.js"></script>
		<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="vendor/nanoscroller/nanoscroller.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="vendor/select2/js/select2.js"></script>
		<!--<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>-->
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<!-- Examples -->
		<!--<script src="js/examples/examples.datatables.default.js"></script>
		<script src="js/examples/examples.datatables.row.with.details.js"></script>
		<script src="js/examples/examples.datatables.tabletools.js"></script>-->

        <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>   

<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>  



		<script>
			
          $(document).ready(function() {
 
            $('.tablesEst').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
        }); 

		</script>
	</body>
</html>