<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Nuevo curso</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

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
		<link rel="stylesheet" href="vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="vendor/bootstrap-multiselect/css/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="vendor/dropzone/basic.css" />
		<link rel="stylesheet" href="vendor/dropzone/dropzone.css" />
		<link rel="stylesheet" href="vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="vendor/summernote/summernote-bs4.css" />
		<link rel="stylesheet" href="vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="vendor/codemirror/theme/monokai.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

	</head>
	
	<body>
		<section class="body">

			<header class="header"></header>

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include('main-menu.php') ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body pb-0">
					<header class="page-header">
						<h2>AGREGAR NUEVO CURSO</h2>
					
					</header>

					<!-- start: page 
					<section class="call-to-action call-to-action-primary call-to-action-top mb-4">
						<div class="container container-with-sidebar">
							
						</div>
					</section>-->
					
					
					
					<div class="row">
							<div class="col">
								<section class="card">
									
									<form class="form-horizontal form-bordered" method="get">
										
										
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputHelpText">NOMBRE DEL CURSO</label>
												<div class="col-lg-6">
													<input type="text" class="form-control" id="nomcurso" style="text-transform: uppercase;">
													<!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
												</div>
											</div>
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">IMG MINIATURA</label>
												<div class="col-lg-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fas fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Cambiar</span>
																<span class="fileupload-new">Buscar archivo</span>
																<input type="file" />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Borrar</a>
														</div>
													</div>
												</div>
											</div>
										
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">IMG DETALLES</label>
												<div class="col-lg-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fas fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Cambiar</span>
																<span class="fileupload-new">Buscar archivo</span>
																<input type="file" />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Borrar</a>
														</div>
													</div>
												</div>
											</div>
										
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">FECHA Y HORA</label>
												
											<div class="col-lg-3">
													<div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="fas fa-calendar-alt"></i>
															</span>
														</span>
														<input id="date" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="día/mes/año" class="form-control">
													</div>
												</div>
											
											<div class="col-lg-3">
													<div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="far fa-clock"></i>
															</span>
														</span>
														<input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'>
													</div>
												</div>
											 
											</div>
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputHelpText">AVAL ACADEMICO</label>
												<div class="col-lg-6">
													<input type="text" class="form-control" id="nomcurso" placeholder="UNAM, CONAMEGE">
													<!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
												</div>
											</div>
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputHelpText">PUNTOS PARA RECERTIFICACIÓN</label>
												<div class="col-lg-6">
													<input type="text" class="form-control" id="nomcurso" placeholder="16 puntos ante el CMMR">
													<!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
												</div>
											</div>
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">COORDINADORES</label>
												<div class="col-lg-6">
													<div class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'><p>Acad. Emérito Dr. Erick Marin...</p></div>
													
													<span class="help-block">Escribe un nombre por línea.</span>
													
												</div>
											</div>
										
										<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">PROGRAMA</label>
												<div class="col-lg-6">
													<div class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'><p>Escribir el programa o copiar y pegar</p></div>
													
													<span class="help-block">Puedes hacerlo en HTML</span>
													
												</div>
											</div>
										<br>
								<div class="form-row">
									<div class="form-group col-lg-9 text-right">
										<input type="submit" value="Subir curso" class="btn btn-primary btn-modern" data-loading-text="Enviando...">
									</div>
								</div>
										<br><br>
									</form>
									
								</section>
							</div>
						</div>
					
					
					
					
					
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
		<script src="vendor/jquery-ui/jquery-ui.js"></script>
		<script src="vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="vendor/select2/js/select2.js"></script>
		<script src="vendor/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
		<script src="vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="vendor/fuelux/js/spinner.js"></script>
		<script src="vendor/dropzone/dropzone.js"></script>
		<script src="vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="vendor/codemirror/lib/codemirror.js"></script>
		<script src="vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="vendor/codemirror/mode/xml/xml.js"></script>
		<script src="vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="vendor/codemirror/mode/css/css.js"></script>
		<script src="vendor/summernote/summernote-bs4.js"></script>
		<script src="vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="vendor/ios7-switch/ios7-switch.js"></script>
		
		<script src="vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<!-- Examples -->
		<script src="js/examples/examples.advanced.form.js"></script>
	</body>
</html>