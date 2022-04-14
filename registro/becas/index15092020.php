<?php 
session_start();
include '../../bd/mnpBDsas.class.php';
if(isset($_SESSION['becas']['id']) && $_SESSION['becas']['login']==true){

}else{
  header("location:login.php");
  exit;
}
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Listado de becados</title>

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="../vendor/animate/animate.css">

		<link rel="stylesheet" href="../vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="../vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="../vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="../vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="../vendor/datatables/media/css/dataTables.bootstrap4.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../css/custom.css">

		<!-- Head Libs -->
		<script src="../vendor/modernizr/modernizr.js"></script>
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
						<h2>BECADOS</h2>
					
					</header>

					<!-- start: page 
					<section class="call-to-action call-to-action-primary call-to-action-top mb-4">
						<div class="container container-with-sidebar">
							
						</div>
					</section>-->

					<?php 
					session_start(); 


					?>
					
					
					<div class="row">
						<div class="col-md-12">
							<?php if(!isset($_GET['action'])){ ?>
							<section class="card">
								<div class="card-body ">
									<h2>BUSCAR MÉDICO</h2>
									<p>Busca el socio al que le asignaras la beca, si no se encuentra te aparecerá un formulario de registro para que lo des de alta y puedas asignarle la beca.</p>
									<div class="container">
  										<div class="row justify-content-md-center">
											<div class="col-md-6 ">
												<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF?>">
						                        	<table class="table table-bordered table-striped mb-0" align="center">
						                          		<tr>
						                            		<td colspan="2">Nombre o cualquier Apellido</td>
						                            	</tr>
						                            	<tr>				                            					                            	
								                            <td><input style="width: 100%; border: inherit; margin: 10px 0;" placeholder="Escribe aqui..." name="nombres" type="text" id="nombres" size="30" /></td>
								                            <td><input class="btn btn-success" type="submit" style="width: 100%;" name="Submit" value="Buscar" /></td>
						                          		</tr>
						                        	</table>
			                      				</form>

			                      				<br />
			                      				<table class="table table-bordered table-striped mb-0" align="center">
			                      					<tr>
			                      						<th>Nombre(s)</th>
			                      						<th>Estatus</th>
			                      					</tr> 
                            						<?php 
                            						$ssql="SELECT id_registrado, prefijo, CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) AS nombrecompleto FROM registrados WHERE"; 
                            						if($_POST[nombres]<>''){
                              							$textoabuscar=$_POST[nombres];
	                            						$textoabuscarsplit=str_word_count($textoabuscar, 1);
                              							$ssql.= " CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) LIKE \"%$textoabuscarsplit[0]%\"";
                              							for($i=1; $i<str_word_count($textoabuscar); $i++){  
                                							$ssql.= " and CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) LIKE \"%$textoabuscarsplit[$i]%\"";
                              							}
                            						}
                            						
                            						if(!isset($_POST[nombres]) || $_POST[nombres]==''){
                              							$ssql="SELECT id_registrado, prefijo, CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) AS nombrecompleto FROM `registrados` WHERE id_registrado=0"; 
                              							$ssql2=" ORDER BY nombrecompleto";
                            						}

                            						$concatenado=$ssql.$ssql2;
                            						$apuntador=$bd->ExecuteE($concatenado);
                            						$i=1;
                            						if (empty($apuntador) && isset($_POST['nombres']) && $_POST['nombres']!="") { ?>
                            							<tr>
                            							<td align="center" colspan="2" >No se encontro ningun médico con ese nombre, favor de registrarlo en la parte de abajo para continuar.</td>
                            						</tr>  
                            						                            							
                            						<?php }else{
                            							foreach ($apuntador as $reg) { ?>
                              						<tr> 
	                                					<td align="center" nowrap>   
	                                						<p align="left"><strong><?php echo $reg['nombrecompleto'];?></strong></p>
	                                					</td>
                                						<td align="center" >
                                 							<?php 
	                                 							$sqlbeca="SELECT * FROM laboratorios l INNER JOIN becas b ON l.id_laboratorio = b.id_laboratorio WHERE b.usado_por =".$reg['id_registrado'];                                 							
	                                 							$resbeca=$bd->ExecuteE($sqlbeca);
	                                 							foreach ($resbeca as $becado) {}
	                                 							if (empty($becado)) {
	                                 								$leyendabeca="<a class=\"btn btn-info\" href=\"?action=becar&id_registrado=".base64_encode($reg['id_registrado'])."\">Asignar beca</a>";
	                                 							}else{
	                                 								$leyendabeca="Beca por ".$becado[nombrecompleto]."";	
	                                 							}                                 
	                                							echo $leyendabeca;
                                							?>
                              							</td> 
                            						</tr>
                            						<?php
                            							$i++;
                          									} 
                          								}
                          							?>
                        						</table>
			                      			</div>
			                      		</div>
									</div>
									<?php if (empty($apuntador) && isset($_POST['nombres']) && $_POST['nombres']!="") { ?>
									<h2>REGISTRAR MÉDICO</h2>
									<p>Llena todos los campos para poder realizar el registro del médico que desea becar.</p>
									<div class="container">
										<div class="row justify-content-md-center">
											<div class="col-md-9">
												<form class="form-horizontal form-bordered" autocomplete="nope" action="" method="POST" onsubmit="return false;" accept-charset="utf-8"  name="ajax-form" id="ajax-form">
													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2">Prefijo</label>
														<div class="col-lg-6">
															<select id="prefijo" name="prefijo" class="form-control">
												              <option value="">(Seleccionar)</option>
												              <option value="DR." selected="">DR.</option>
												              <option value="DRA.">DRA.</option>
												              <option value="ENF.">ENF.</option>
												              <option value="ENF. PER.">ENF. PER.</option>
												              <option value="ENF. QCA.">ENF. QCA.</option>
												              <option value="L.E.">L.E.</option>
												              <option value="L.E.O.">L.E.O.</option>
												              <option value="E.A.S.E.">E.A.S.E.</option>
												              <option value="E.A.S.SE.">E.A.S.SE.</option>
												              <option value="LIC.">LIC.</option>
												              <option value="L.D.">L.D.</option>
												              <option value="LIC. DER.">LIC. DER.</option>
												              <option value="SR.">SR.</option>
												              <option value="SRA.">SRA.</option>
												              <option value="">(VACIO)</option>
												            </select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >Nombre(s)</label>
														<div class="col-lg-6">
															<input type="text" class="form-control" id="nombre" name="nombre" style="text-transform: uppercase;">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >Apellido Paterno</label>
														<div class="col-lg-6">
															<input type="text" class="form-control" id="apellidop" name="apellidop" style="text-transform: uppercase;">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >Apellido Materno</label>
														<div class="col-lg-6">
															<input type="text" class="form-control" id="apellidom" name="apellidom" style="text-transform: uppercase;">
														</div>
													</div>

													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >Correo</label>
														<div class="col-lg-6">
															<input type="email" class="form-control" id="correo" name="correo">
														</div>
													</div>

													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >Teléfono</label>
														<div class="col-lg-6">
															<input type="text" class="form-control" id="telefono" name="telefono" >
														</div>
													</div>

													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >País</label>
														<div class="col-lg-6">
															<select id="pais" name="pais" onchange="actualizaEdos();" class="form-control">
												              <option value="">(Seleccionar)</option>
												              <?php
												              $paises="SELECT * FROM paises";
												              $respaises=$bd->ExecuteE($paises);
												                foreach($respaises as &$pais){
												              ?>
												              <option value="<?php echo $pais['id_pais'] ?>"><?php echo $pais['pais']; ?></option>
												              <?php } ?>
												            </select>															
														</div>
													</div>

													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >Estado</label>
														<div class="col-lg-6">
															<select id="estado" name="estado" class="form-control">
												              <option value="">(Seleccionar)</option>
												            </select>													
														</div>
													</div>

													<div class="form-group row">
														<label class="col-lg-3 control-label text-lg-right pt-2" >Beca</label>
														<div class="col-lg-6">
															<select id="beca" name="beca" class="form-control">
																<option value="">(Seleccionar)</option>
												              <?php
												              $sbecas="SELECT * FROM becas WHERE usado_por = 0 AND id_laboratorio=".$_SESSION['becas']['id'];
												              $resbecas=$bd->ExecuteE($sbecas);
												              foreach ($resbecas as $beca) { ?>
												              	<option value="<?php echo $beca['codigo']?>"><?php echo $beca['codigo']?></option>
												              <?php } ?>
              									            </select>															
														</div>
													</div>												
																										
													<div class="form-group col-lg-9 text-right">													
														<input type="submit" value="Registrar" id="btn-registro" name="btn-registro" class="btn btn-primary btn-modern" data-loading-text="Enviando...">														
													</div>												
												</form>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</section>
						</div>
						<div class="col-md-12">
							<section class="card">								
								<div class="card-body">
									<h2>LISTADO DE BECAS</h2>
									<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
										<thead>
											<tr>
												<th>ID</th>
												<th>CÓDIGO</th>
												<th>DISPONIBLE</th>
												<th>USADO POR</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql_becas="SELECT * FROM becas b  WHERE b.id_laboratorio = ".$_SESSION['becas']['id'];
											$becas  = $bd->ExecuteE($sql_becas);
											$i=1;
											foreach ($becas as &$beca) {
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $beca['codigo']; ?></td>
												<td><?php if ($beca['usado_por']==0) { echo "SI";}else{ echo "NO";} ?></td>
												<td><?php 
												if ($beca['usado_por']!=0) {
													$sql_usado="SELECT * FROM registrados r INNER JOIN becas b ON b.usado_por = r.id_registrado WHERE r.id_registrado =".$beca['usado_por'];
													$registrados= $bd->ExecuteE($sql_usado);
													foreach ($registrados as $registrado) {}
												 echo $registrado['nombre']." ".$registrado['apellidop']." ".$registrado['apellidom']; }else{ echo "SIN USAR"; }?></td>
											</tr>	
											<?php $i++; } ?>												
											
										</tbody>
									</table>
								</div>
							</section>
						<?php }elseif (isset($_GET['action']) && $_GET['action']=="becar" && $_GET['id_registrado']!="") { 
								$sql_registrado="SELECT * FROM registrados WHERE id_registrado =".base64_decode($_GET['id_registrado']);
								$registrados=$bd->ExecuteE($sql_registrado);
								foreach ($registrados as $registrado) {
									$nombrecompleto=$registrado['apellidop']." ".$registrado['apellidom']." ".$registrado['nombre'];
								}
							?>
							<section class="card">
								<div class="card-body ">
									<h2>SELECCIONA LA BECA</h2>									
									<div class="container">
  										<div class="row justify-content-md-center">
											<div class="col-md-10">
												<form class="form-horizontal form-bordered" autocomplete="nope" action="" method="POST" onsubmit="return false;" accept-charset="utf-8"  name="ajax-form" id="ajax-form">									

												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2" >Nombre del Médico</label>
													<div class="col-lg-6">
														<input type="text" class="form-control" disabled value="<?php echo $nombrecompleto; ?>" style="text-transform: uppercase;">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2" >Beca</label>
													<div class="col-lg-6">
														<select id="beca2" name="beca2" class="form-control">
															<option value="">(Seleccionar)</option>
												              <?php
												              $sbecas="SELECT * FROM becas WHERE usado_por = 0 AND id_laboratorio=".$_SESSION['becas']['id'];
												              $resbecas=$bd->ExecuteE($sbecas);
												              foreach ($resbecas as $beca) { ?>
												              	<option value="<?php echo $beca['codigo']?>"><?php echo $beca['codigo']?></option>
												              <?php } ?>
              								            </select>															
													</div>
												</div>

												<div class="form-row">
													<div class="form-group col-lg-9 text-right">
														<a href="./" class="btn btn-danger">Cancelar</a>
														<input type="hidden" name="id_registrado2" id="id_registrado2" value="<?php echo $registrado['id_registrado']; ?>">
														<input type="submit" value="Aplicar Beca" id="btn-becar" name="btn-becar" class="btn btn-primary btn-modern" data-loading-text="Enviando...">
														
													</div>
												</div>

											
												
											</form>
											</div>
										</div>
									</div>
								</div>
							</section>
						<?php } ?>
							</div>
						</div>

					
					
					
					
					
					<!-- end: page -->
				</section>
			</div>

		</section>

		<script type="text/javascript">

			$(function() {
		      $("#btn-becar").click(function(){
		         if($("#becado").val()!="" && $("#beca2").val()!=""){
		         	becar();		           
            	}else{
	              alert("Todos los campos son obligatorios");
	              $("#becado").focus();
	              $("#beca2").focus();	              
	            }
          	  });
		   	});

			function becar(){
		   		$('#modal').modal('show');
      			$.ajax({
          			url: '../../aplicar_beca.php',
          			type: 'POST',
          			dataType: 'json',
          			data: {			            
			            id_registrado: $("#id_registrado2").val(),
			            beca: $("#beca2").val()
          			}
      			})
      			.done(function(json) {
         			if(json.success){
            			$('#modal').modal('hide');
            			alert(json.mensaje);
            			window.location.href = "./";
         			}else{
            			alert(json.mensaje);
         			}
                })

      			.fail(function() {
         			alert("Ups! Ha ocurrido un error, intente de nuevo");
      			})

      			.always(function() {
         			$('#modal').modal('hide');
      			});
		   	}

			$(function() {
		      $("#btn-registro").click(function(){
		         if($("#prefijo").val()!="" && $("#nombre").val()!="" && $("#apellidop").val()!="" && $("#apellidom").val()!="" && $("#correo").val()!="" && $("#telefono").val()!="" && $("#pais").val()!="" && $("#estado").val()!="" && $("#beca").val()!=""){

		            if(validarEmail($("#correo").val())){
              			if (validartelefono($("#telefono").val())) {
                  			registrar();
                		}else{
                  			alert("Por favor ingresa un telefono a 10 digitos");
                  			$("#telefono").focus();
                		}                           
              		}else{
                  		alert("Por favor ingresa un correo valido");
                  		$("#correo").focus();
                	}
            	}else{
	              alert("Todos los campos son obligatorios");
	              $("#prefijo").focus();
	              $("#nombre").focus();
	              $("#apellidop").focus();
	              $("#apellidom").focus();
	              $("#correo").focus();
	              $("#telefono").focus();
	              $("#pais").focus();
	              $("#estado").focus();
	              $("#beca").focus();
	            }
          	  });
		   	});

		   	

		   	function registrar(){
      			$('#modal').modal('show');
      			$.ajax({
          			url: '../../guardar_registrado.php',
          			type: 'POST',
          			dataType: 'json',
          			data: {
			            prefijo: $("#prefijo").val(),
			            nombre: $("#nombre").val().toUpperCase(),
			            apellidop: $("#apellidop").val().toUpperCase(),
			            apellidom: $("#apellidom").val().toUpperCase(),
			            email: $("#correo").val(),
			            telefono: $("#telefono").val(),
			            pais: $("#pais").val(),
			            estado: $("#estado").val(),
			            beca: $("#beca").val()
          			}
      			})
      			.done(function(json) {
         			if(json.id_registrado!=0){
            			$('#modal').modal('hide');
            			alert(json.mensaje);
            			window.location.href = "./";
         			}else{
            			alert(json.mensaje);
         			}
                })

      			.fail(function() {
         			alert("Ups! Ha ocurrido un error, intente de nuevo");
      			})

      			.always(function() {
         			$('#modal').modal('hide');
      			});
   			}


			function actualizaEdos() {
			    var pais = $('#pais').val();
			    $.ajax({
			      url: '../../obtener_estados.php',
			      type: 'POST',
			      dataType: 'json',
			      data: {pais:pais},

			    })
			    .done(function(json) {
			        if(json.success){
			          $("#estado").html(json.html);
			        }
			      })
			    .fail(function() {
			        $('#myModal3').modal('hide');
			        alert("Ocurrio un error al actualizar el estado intenta de nuevo");
			      })

			  }

			function validarEmail(email) {
      			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      			return re.test(email);
   			}

   			function validartelefono(telefono){
    			var te = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    			return te.test(telefono);
   			}
		</script>

		<!-- Vendor -->
		<script src="../vendor/jquery/jquery.js"></script>
		<script src="../vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../vendor/popper/umd/popper.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../vendor/common/common.js"></script>
		<script src="../vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="../vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="../vendor/select2/js/select2.js"></script>
		<script src="../vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="../vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../js/theme.init.js"></script>

		<!-- Examples -->
		<script src="../js/examples/examples.datatables.default.js"></script>
		<script src="../js/examples/examples.datatables.row.with.details.js"></script>
		<script src="../js/examples/examples.datatables.tabletools.js"></script>
	</body>
</html>