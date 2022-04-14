<?php 
session_start();
include '../bd/mnpBDsas2.class.php';
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
		<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap4.css" />

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
											$queryTalleres = "select COUNT(*) as total FROM registrados WHERE constanciacongreso != '0000-00-00 00:00:00'";
											$talleres  = $bd->ExecuteE($queryTalleres);
										?>
	                    
										<!-- <h3>CONSTANCIAS DESCARGADAS:<?= $talleres[0]['total'] ?> </h3> -->
										
										<table class="table table-bordered mb-0" id="datatable-tabletools">
											<thead>
												<tr>
													<th>ID</th>
													<th>NOMBRE</th>
													<th>CORREO</th>
													<th>TELÉFONO</th>
													<th>ESPECIALIDAD</th>
													<th>PÁIS</th>
													<th>ESTADO</th>
													<th>REGISTRADO</th>
													<!-- <th>CONSTANCIA</th> -->
													<th>PLATAFORMA</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql_labs="SELECT * FROM registrados r LEFT JOIN paises p ON r.id_pais = p.id_pais LEFT JOIN estados e ON r.id_estado = e.id_estado GROUP BY r.email";
												$laboratorios  = $bd->ExecuteE($sql_labs);
												$i=1;
												foreach ($laboratorios as &$laboratorio) {
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $laboratorio['nombre']." ".$laboratorio['apellidop']." ".$laboratorio['apellidom']; ?></td>
													<td><?php echo $laboratorio['email']; ?></td>
													<td><?php echo $laboratorio['telefono']; ?></td>
													<td><?php echo $laboratorio['especialidad']; ?></td>
													<td><?php echo $laboratorio['pais']; ?></td>
													<td><?php echo $laboratorio['estado']; ?></td>
													<td><?php 
														$sql_becas="SELECT * FROM becas WHERE usadopor =".$laboratorio['id_registrado'];
														$becas = $bd->ExecuteE($sql_becas);
														foreach ($becas as $beca) {}
															if (empty($becas)) {
																$leyenda="PRE REGISTRADO";
															}else{
																$leyenda=$beca['codigo'];
															}
															echo $leyenda;
													?></td>	
													<!-- <td><?php echo $laboratorio['constanciacongreso']; ?></td> -->
													<td><?php 													
															if ($laboratorio['datos']==1) {
																$leyenda="ENTRO A LA PLATAFORMA";
															}else{
																$leyenda="SIN ACCESO";
															}
															echo $leyenda;
													?></td>

																								
												</tr>	
												<?php $i++; } ?>												
												
											</tbody>
										</table>
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
		<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<!-- Examples -->
		<script src="js/examples/examples.datatables.default.js"></script>
		<script src="js/examples/examples.datatables.row.with.details.js"></script>
		<script src="js/examples/examples.datatables.tabletools.js"></script>
	</body>
</html>