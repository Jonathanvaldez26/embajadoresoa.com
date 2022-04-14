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

		<title>Listado de cursos</title>
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

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
	<!--	<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap4.css" />-->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

   <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">

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
						<h2>Cursos</h2>
					
					</header>

					<div class="row">
							<div class="col">
								<section class="card">
									
									<div class="card-body">
									<button class="btn btn-success" id="nuevoCursos">Insertar Nuevo Curso</button> <br>
										<table class="table table-bordered table-striped mb-0" id="cursosTable">
											<thead>
												<tr>
													<th>#</th>
													<th>NOMBRE DEL CURSO</th>
													<th>FECHA</th>
													<th>HORARIO</th>
													<th>ACCIONES</th>
												</tr>
											</thead>
											<tbody>
											   <tr>
                          
                        </tr>
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



<!-- Modal -->
<div class="modal fade" id="modalNewSession" tabindex="-1" role="dialog" aria-labelledby="modalNewSession"  data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      
       
      
      <div class="modal-content">
        
          
        
        
        <div id="modalHeader" class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <span id="tituloText">Nuevo Curso</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form  enctype="multipart/form-data"  id="form_curso" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="title_theme">Titulo del Curso<span class="required">*</span>
              </label>
              <div class="col-md-10 col-sm-10 ">
                <input type="text" id="title_theme" name="title_theme"  class="form-control textSessionVirtuales">
              </div>
            </div>
           
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="img_backgroung">Programa
              </label>
              <div class="col-md-10 col-sm-10 ">
                <input type="file" id="img_programa" name="img_programa" >   
              </div>
            </div>
            
              <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="img_backgroung">Imagen Curso
              </label>
              <div class="col-md-10 col-sm-10 ">
                <input type="file" id="img_curso" name="img_curso" >   
              </div>
            </div>
            
            
            <!--<div class="item form-group">
              <label for="img_principal" class="col-form-label col-md-3 col-sm-3 label-align">Logo</label>
              <div class="col-md-8 col-sm-8 ">
                <input id="img_titulo" name="img_titulo"  type="file" >
              </div>
            </div>-->
          
          
          
          
          
          
          
          
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha <span class="required">*</span>
              </label>
              <div class="col-md-10 col-sm-10 ">
                    <div class="input-daterange input-group" data-plugin-datepicker="">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-calendar-alt"></i>
														</span>
													</span>
													<input type="text" class="form-control textSessionVirtuales"  id="startFecha" name="startFecha">
													<span class="input-group-text border-left-0 border-right-0 rounded-0">
														a
													</span>
													<input type="text"  class="form-control textSessionVirtuales" id="endFecha" name="endFecha">
											</div>
              </div>
            </div>
          
          
          
         
            
                 <div class="form-row">
										    <div class="form-group col-md-5">
										      <label for="inputEmail4">Horario Inicio</label><span class="required">*</span>
										     <input  id="reloj"   name="reloj" class="form-control textSessionVirtuales"   placeholder="Horario del curso"  type="text">
										    </div>
										    <div class="form-group col-md-5">
										      <label for="inputPassword4">Horario Fin</label><span class="required">*</span>
										      <input   id="relojfin"  name="relojfin"  class="form-control textSessionVirtuales " value="" placeholder="Horario del curso Fin" type="text">
										    </div>
		 							 </div>
            
            
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align">¿El curso es gratuito? <span class="required">*</span>
              </label>
              <div class="col-md-10 col-sm-10 ">
                <div class="form-check">
										  <input class="form-check-input position-static" type="checkbox" id="gratuitoCheck"  name="gratuitoCheck" value="0" >
									</div>
              </div>
            </div>
            
             <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Costos</b> <span class="required">*</span>
              </label>
            </div>
             <div class="item form-group">
           
 
		             <div class="form-row">
										    <div class="form-group col-md-4">
										      <label for="inputEmail4">Estudiantes</label>
										      <input type="text" class="form-control" id="costoPrecioEstudiante" name="costoPrecioEstudiante" value="" placeholder="Costo Estudiante">
										    </div>
										    <div class="form-group col-md-4">
										      <label for="inputPassword4">Residentes y Enfermeras</label>
										      <input type="text" class="form-control" id="costoResidentes" name="costoResidentes" value="" placeholder="Costo Residentes y Enfermeras">
										    </div>
										    <div class="form-group col-md-4">
										      <label for="inputPassword4">Médicos y profesionales de la salud</label>
										      <input type="text" class="form-control" id="costoProfesionales" name="costoProfesionales"  value="" placeholder="Costo Médicos y profesionales de la salud">
										    </div>
		 							 </div>
            </div>

           

            <!--<div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align">URL Streaming <span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 ">
                <input id="url_streaming" name="url_streaming" class=" form-control "  type="text">
              </div>
            </div>-->
              
           
            <div class="ln_solid"></div>
            
            <input    type="hidden" id="updateStatus"  name="updateStatus" value=0>
            <input     type="hidden" id="updateide"   name="updateide"   value="">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="CancelgeneratePlantilla" data-dismiss="modal">Cancelar</button>
          <button  class="btn btn-primary"  id="generateCurso" type="submit">Guardar Curso</button>
             
        </div>
      </form>
      </div>
    </div>

  </div>


		<!-- Vendor -->
		<script type="text/javascript">
			
		

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
		
		
		<script src="js/cursos.js"></script>
		
		<script src="js/moment.min.js"></script>
  
  <!-- bootstrap-datetimepicker -->
    <script src="js/bootstrap-datetimepicker.min.js"></script>
		
	  	
		
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