<?php 
session_start();
include '../virtual/bd/mnpBDsas.class.php';
if (isset($_GET['a'])) {

}else{
  if(isset($_SESSION['admin']['id']) && $_SESSION['admin']['login']==true){
  }else{
    header("location:login.php");
    exit;
  }
}

?><!doctype html>
<html class="fixed sidebar-left-collapsed">
  <head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>REGISTRADOS</title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

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


        <!-- end: sidebar -->

        <section role="main" class="content-body pb-0">
          <header class="page-header" style="left:0;" >
            
              <h2>REGISTRO AUTOMATIZADO</h2>
            
            
          
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
                  <p>Escanea el código QR o ingresa el nombre del doctor para poder imprimir su gafete.</p>
                  <div class="container">
                    <div class="row justify-content-md-center">
                      <div class="col-md-6 ">
                        <form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF?>">
                          <table class="table table-bordered table-striped mb-0" align="center">
                            <tr>
                              <td colspan="2">Escanea el código QR o nombre y apellidos</td>
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
                            if(is_numeric($_POST[nombres])){
                               $ssql="SELECT id_registrado, prefijo, CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) AS nombrecompleto FROM registrados WHERE modalidad = 2 AND id_registrado = ".$_POST[nombres];
                            }else{
                              $ssql="SELECT id_registrado, prefijo, CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) AS nombrecompleto FROM registrados WHERE modalidad = 2 AND"; 
                              if($_POST[nombres]<>''){
                                $textoabuscar=$_POST[nombres];
                                $textoabuscarsplit=str_word_count($textoabuscar, 1);
                                  $ssql.= " CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) LIKE \"%$textoabuscarsplit[0]%\"";
                                  for($i=1; $i<str_word_count($textoabuscar); $i++){  
                                    $ssql.= " and CONCAT( `apellidop` , \" \", `apellidom` , \" \", `nombre` ) LIKE \"%$textoabuscarsplit[$i]%\"";
                                  }
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
                                    $sql_gafetes="SELECT count(*) as registrado,fecha_impresion,id FROM gafetes WHERE id_registrado =".$reg['id_registrado'];
                                    $resgafetes=$bd->ExecuteE($sql_gafetes);
                                    foreach ($resgafetes as $gafete) {
                                      if ($gafete['registrado']==0) {
                                        $leyendagafete="<a class=\"btn btn-info\" href=\"?action=nuevo&id_registrado=".base64_encode($reg['id_registrado'])."\">Imprimir gafete</a>";
                                      }else{
                                        $leyendagafete="<a class=\"btn btn-warning\" href=\"?action=reimpresion&gafete=".base64_encode($gafete['id'])."\">Gafete impreso el: ".$gafete[fecha_impresion]."<br>Imprimir gafete</a>";  
                                      }
                                    }
                                    
                                    echo $leyendagafete;
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
                            <label class="col-lg-3 control-label text-lg-right pt-2" >Prefijo</label>
                            <div class="col-lg-6">
                               <select id="prefijo" name="prefijo" class="form-control">
                                <option value="">(Seleccionar)</option>
                                <option value="DR.">DR.</option>
                                <option value="DRA.">DRA.</option>
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
                            <label class="col-lg-3 control-label text-lg-right pt-2" >Telefono</label>
                            <div class="col-lg-6">
                              <input type="text" name="telefono" id="telefono" class="form-control">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2" >País</label>
                            <div class="col-lg-6">
                              <select id="pais" name="pais" onchange="actualizaEdos();" class="form-control">
                                <option value="">(Seleccionar)</option>
                                <option value="156">México</option>
                                <?php
                                  $paises="SELECT * FROM paises WHERE id_pais != 156";
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
                            <label class="col-lg-3 control-label text-lg-right pt-2" >Especialidad</label>
                            <div class="col-lg-6">
                              <select id="especialidad" name="especialidad" class="form-control">
                                <option value="">Seleccione especialidad</option>
                                <?php
                                $especialidades="SELECT * FROM tbl_especialidades ORDER BY Desc_especialidad ASC";
                                $resespecialidades=$bd->ExecuteE($especialidades);
                                foreach($resespecialidades as &$especialidad){
                                  ?>
                                  <option value="<?php echo $especialidad['Desc_especialidad'] ?>"><?php echo $especialidad['Desc_especialidad']; ?></option>
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
            
            <?php }elseif ($_GET['action']=='nuevo' OR $_GET['action']=='reimpresion') { 
              if ($_GET['action']=='nuevo') {
                $sql_registrados="SELECT * FROM registrados WHERE id_registrado =".base64_decode($_GET['id_registrado']);
                $res=$bd->ExecuteE($sql_registrados);
                foreach ($res as $registrado) {}
              }else{
                $sql_gafetes="SELECT * FROM gafetes WHERE id =".base64_decode($_GET['gafete']);
                $res=$bd->ExecuteE($sql_gafetes);
                foreach ($res as $gafete) {
                  $sql_registrados="SELECT * FROM registrados WHERE id_registrado =".$gafete['id_registrado'];
                  $res=$bd->ExecuteE($sql_registrados);
                  foreach ($res as $registrado) {}
                }
              }
              
              
                
            ?>
              <div class="container">
                <div class="row justify-content-md-center">
                  <div class="col-md-9">
                    <center><h1>Verifica que tus datos sean correctos</h1></center>
                    <form class="form-horizontal form-bordered" autocomplete="nope" action="" method="POST" onsubmit="return false;" accept-charset="utf-8"  name="ajax-form" id="ajax-form">
                      <div class="form-group row">
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Prefijo</label>
                          <select id="prefijo" name="prefijo" class="form-control">
                            <option value="">(Seleccionar)</option>
                            <option <? if($registrado['prefijo']=="DR."){ echo "selected";} ?> value="DR.">DR.</option>
                            <option <? if($registrado['prefijo']=="DRA."){ echo "selected";} ?> value="DRA.">DRA.</option>
                          </select>
                        </div>
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Nombre(s)</label>
                          <input type="text" class="form-control" value="<?=$registrado['nombre']?>" id="nombre" name="nombre" style="text-transform: uppercase;">
                        </div>
                        </div>


                      <div class="form-group row">
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Apellido Paterno</label>
                          <input type="text" class="form-control" id="apellidop" value="<?=$registrado['apellidop']?>" name="apellidop" style="text-transform: uppercase;">
                        </div>

                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Apellido Materno</label>
                          <input type="text" class="form-control" id="apellidom" value="<?=$registrado['apellidom']?>" name="apellidom" style="text-transform: uppercase;">
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Correo</label>
                          <input type="email" class="form-control" id="correo" value="<?=$registrado['correo']?>" name="correo">
                        </div>

                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Telefono</label>
                          <input type="text" name="telefono" id="telefono" value="<?=$registrado['telefono']?>" class="form-control">
                        </div>

                      </div>

                      <div class="form-group row">
                        
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >País</label>
                          <input type="hidden" id="estadoPart" name="estadoPart" value="<?=  $registrado['id_estado'] ?>">
                          <select id="pais" name="pais" onchange="actualizaEdos();" class="form-control">

                            <option value="">(Seleccionar)</option>
                            <?php
                              $paises="SELECT * FROM paises";
                              $respaises=$bd->ExecuteE($paises);
                              foreach($respaises as &$pais){
                                $variablep= $pais['id_pais']  == $registrado['id_pais'] ?  "selected" : ""; 
                            ?>
                              <option <?=$variablep?> value="<?php echo $pais['id_pais'] ?>"><?php echo $pais['pais']; ?></option>
                            <?php } ?>
                          </select>                    
                        </div>
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Estado</label>
                          <select id="estado" name="estado" class="form-control">
                            <option value="">(Seleccionar)</option>
                          </select>                
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Especialidad</label>
                          <select id="especialidad" style="text-transform: uppercase;" name="especialidad" class="form-control">
                            <option value="">Seleccione especialidad</option>
                              <option value="Gastroenterología">Gastroenterología</option>
                              <option value="Cirugia">Cirugía</option>
                              <option value="Cirugia del aparato digestivo">Cirugía del aparato digestivo</option>
                              <option value="COLOPROCTOLOGÍA">COLOPROCTOLOGÍA</option>
                              <option value="Endoscopía Gastroeintestinal">Endoscopia Gastrointestinal</option>
                              <option value="GASTROENTEROLOGÍA Y NUTRICIÓN PEDIÁTRICA">GASTROENTEROLOGÍA Y NUTRICIÓN PEDIÁTRICA</option>
                              <option value="MEDICINA GENERAL">MEDICINA GENERAL</option>
                              <option value="MEdicina Interna">Medicina Interna</option>
                            <?php
                            $especialidades="SELECT * FROM tbl_especialidades ORDER BY Desc_especialidad ASC";
                            $resespecialidades=$bd->ExecuteE($especialidades);
                            foreach($resespecialidades as &$especialidad){
                              $variable  =  $especialidad['Desc_especialidad']  == $registrado['especialidad'] ?  "selected" : ""; 
                              ?>
                              <option <?=$variable?> value="<?php echo $especialidad['Desc_especialidad'] ?>"><?php echo $especialidad['Desc_especialidad']; ?></option>
                            <?php } ?>
                          </select>              
                        </div>
                        <div class="col-lg-6">
                          <label class="control-label text-lg-right pt-2" >Cédula Profesional</label>
                          <input type="text" name="cedula" id="cedula" value="<?=$registrado['cedpro']?>" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-lg-12">
                          <label class="control-label text-lg-right pt-2" >Categoria</label>
                          <select id="categoria" style="text-transform: uppercase;" name="categoria" class="form-control">
                            <option value="">Seleccione categoria</option>
                            <option <? if($gafete['categoria']=="ASISTENTE"){ echo "selected";} ?> value="ASISTENTE">ASISTENTE</option>
                            <option <? if($gafete['categoria']=="PROFESOR"){ echo "selected";} ?> value="PROFESOR">PROFESOR</option>
                            <option <? if($gafete['categoria']=="STAFF"){ echo "selected";} ?> value="STAFF">STAFF</option>
                          </select>
                        </div>
                      </div>
                      
         
                      <div class="form-group col-lg-12  text-center">    
                      <input type="hidden" name="id_registrado" id="id_registrado" value="<?=$registrado['id_registrado']?>">
                        <input style="margin-bottom: 50px;" type="submit" value="Imprimir Gafete" id="btn-registro" name="btn-registro" class="btn btn-primary btn-modern" data-loading-text="Enviando...">                            
                      </div>                        
                    </form>
                      </div>
                    </div>
                  </div>
            <?php } ?>
            
              </div>
            </div>

          
          
          
          
          
          <!-- end: page -->
        </section>
      </div>

    </section>



    <script type="text/javascript">

      <?php if ($_GET['action']=="nuevo" OR $_GET['action']=="reimpresion") { ?>
        $(document).ready(function () {
          var pais = $("#pais").val();
          var idEstado = $("#estadoPart").val(); 
          actualizaEdosConsulta(pais,idEstado,1);
   
        });
        function actualizaEdosConsulta(pais,idEstado,operation) {
          pais = $('#pais').val();
          $.ajax({
            url: 'obtener_estadosPais.php',
            type: 'POST',
            dataType: 'json',
            data: {pais:pais,
                   idEstado:idEstado,
                   operation : operation
                 },

          })
          .done(function(json) {
              if(json.success){
              
                $("#estado").html(json.html);
              }
            })
         

        }
      <?php } ?>

      $(function() {
          $("#btn-registro").click(function(){
             if($("#prefijo").val()!="" && $("#nombre").val()!="" && $("#apellidop").val()!="" && $("#apellidom").val()!="" && $("#correo").val()!="" && $("#pais").val()!="" && $("#estado").val()!="" && $("#especialidad").val()!="" && $("#cedula").val()!="" && $("#telefono").val()!="" <? if ($_GET['action']=="nuevo" OR $_GET['action']=="reimpresion") { echo ' && $("#categoria").val()!=""'; } ?> ){

                if(validarEmail($("#correo").val())){
                if (validartelefono($("#telefono").val())) {
                  registrar();
                }else{
                  alert("Por favor ingresa un telefono a 10 digitos");
                  $("#telefono").focus();
                }

              }else{
                alert("Por favor ingresa un correo valido");
                $("#email").focus();
              }
              }else{
                alert("Todos los campos son obligatorios");
                
              }
              });
        });

        

        function registrar(){
            $('#modal').modal('show');
            $.ajax({
              <?php if ($_GET['action']=="nuevo" OR $_GET['action']=="reimpresion") { ?>
                url: 'actualizar_registro.php',
              <?php }else{ ?>
                url: '../presencial/guardar_registrado.php',
              <?php } ?>
                
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
                  cedula: $("#cedula").val(),
                  especialidad: $("#especialidad").val(),
                  id_registrado: $("#id_registrado").val(),
                  categoria: $("#categoria").val(),
                  gafete: <?php if(!isset($_GET['gafete'])) { echo 0; }else{ echo base64_decode($_GET['gafete']); }?>
                }
            })
            .done(function(json) {
              if(json.id_registrado!=0){
                  $('#modal').modal('hide');
                  alert(json.mensaje);
                  <?php if ($_GET['action']=="nuevo" OR $_GET['action']=="reimpresion") { ?>
                    window.open(json.redireccion)
                    window.location.href ="./";
                  <?php }else{ ?>
                    gafete(json.id_registrado)
                  <?php } ?>
                  
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

        function gafete(id_registrado){
          $.ajax({
            url:'gafete_directo.php',
            type:'post',
            dataType: 'json',
            data:{
              id_registrado:id_registrado,
              categoria:"ASISTENTE",
            }
          })
          .done(function(json) {
            if(json.id_registrado!=0){
                $('#modal').modal('hide');
                alert(json.mensaje);
                window.open(json.redireccion);
                window.location.href ="./";
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
            url: '../presencial/obtener_estados.php',
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