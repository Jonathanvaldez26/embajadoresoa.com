<?php 
session_start();
include '../virtual/bd/mnpBDsas.class.php';
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

		<title>Accesos</title>


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
		<style>
		.textos
		{
			color: #000;
		}
	</style>

</head>

<body>
	<section class="body">



		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php include('main-menu.php') ?>
			<!-- end: sidebar -->

			<section role="main" class="content-body pb-0">
				<header class="page-header">
					<h2>PORCENTAJES</h2>
					
				</header>

				<div class="row">
					<div class="col">
						<section class="card">
							<div class="card-body">
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
									<thead>
										<tr>
											<th>ID</th>
											<th>NOMBRE</th>
											<th>CORREO</th>
											<th>PAÍS</th>
											<th>ESTADO</th>
											<th>ESPECIALIDAD</th>
											<th>FECHA</th>
											<th>IP</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$sql_registrados="
										SELECT lg.id_logeo,lg.id_registrado,reg.nombre,reg.apellidop,reg.apellidom,reg.correo,lg.id_sesion,lg.fecha_hora,lg.ip,p.pais,e.estado,reg.especialidad   FROM logeos as lg INNER JOIN registrados reg ON lg.id_registrado=reg.id_registrado INNER JOIN paises p ON reg.id_pais = p.id_pais INNER JOIN estados e ON reg.id_estado = e.id_estado WHERE  lg.id_registrado <> '1' AND reg.correo != ''";
										$registrados  = $bd->ExecuteE($sql_registrados);
										$i=1;
										foreach ($registrados as &$registrado) {
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $registrado['nombre']." ".$registrado['apellidop']." ".$registrado['apellidom']; ?></td>
												<td><?php echo $registrado['correo'] ?></td>
												<td><?php echo $registrado['pais'] ?></td>
												<td><?php echo $registrado['estado'] ?></td>
												<td><?php echo $registrado['especialidad'] ?></td>
												<td><?php echo $registrado['fecha_hora'] ?></td>
												<td><?php echo $registrado['ip'] ?></td>
											</tr>	
											<?php $i++; } ?>												

										</tbody>
									</table>
								</div>
							</section>
						</div>
					</div>

					<!-- end: page -->
				</section>
			</div>

		</section>

		<!-- Vendor -->	
		<script type="text/javascript">
			$(document).ready(function() {
				$('[id^=detail-]').hide();
				$('.toggle').click(function() {
					$input = $( this );
					$target = $('#'+$input.attr('data-toggle'));
					$target.slideToggle();
				});
			});
		</script>		

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