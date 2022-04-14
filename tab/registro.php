<?php 
setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
setlocale(LC_TIME, 'spanish');
session_start();
date_default_timezone_set ( "America/Mexico_City");
include 'bd/mnpBDsas.class.php';


$sql = "SELECT * FROM sesiones WHERE id_sesion = '".base64_decode($_GET['ref'])."'";
$sesiones = $bd->ExecuteE($sql);
foreach($sesiones as $sesion){
}

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->

<head>

	<!--- Basic Page Needs
   ================================================== -->
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta charset="utf-8">
	<title>Sistema de Transmisión en vivo</title>
   <meta name="description" content="">  
   <meta name="author" content="">

   <!-- Mobile Specific Metas
   ================================================== -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="css/base.css">
   <link rel="stylesheet" href="css/vendor.css">
   <link rel="stylesheet" href="css/main.css"> 
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- Modernizr
   =================================================== -->
   <script src="js/modernizr.js"></script>

   <!-- Favicons
   =================================================== -->
   <link rel="shortcut icon" href="favicon.png" >

   <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    
</head>
    
<body>
  <div id="particles-js"></div>

   <!--[if lt IE 9]>
   	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. 
   	Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
   <![endif]-->   

   <!-- content-wrap -->
   <div id="content-wrap">

      <!-- main  -->
      <div class="logos row" style="background: none !important;" >
        <header class="site-header">

            </header>
      </div>
      <main class="row">

        <div class="logo col-xs-6">
          <img src="img/logo-colegio.png" style="width: 200px; margin:20px auto;" class="img-responsive">
        </div>

        <div class="logo col-xs-6">
          <img src="img/asofarma-negro.png" style="margin: 30px auto;" class="img-responsive">
        </div>
                
                

            <div id="main-content" class="twelve columns fondo" style="color: #ffffff !important;">

               <h1 style="font-size: 30px !important;"><?php echo $sesion['tema']; ?></h1>

               <hr style="border: #707273">
               <p >12 de Junio del 2020.</p>
				
				<p >
				19hrs CDMX
				</p>
				
               <p ><strong>Nota: Podrá ingresar a la sesión 15 minutos antes de dar inicio.</strong></p>

               <!-- <div id="counter" class="group">
                  <span><em>days</em></span> 
                  <span><em>hours</em></span>
                  <span><em>minutes</em></span>
                  <span><em>seconds</em></span> 
               </div>  -->                 

               <!-- Ingresar a la sesión -->
               <div id="mc-signup">

                <h3 style="text-transform: uppercase;">Ingresa tu correo para entrar a la sesión</h3>

                  <form id="form-ingresar" class="group" autocomplete="nope" action="" method="POST" onsubmit="return false;" accept-charset="utf-8">
                          
                     <input type="email" value="" name="email" class="email" id="email" required autofocus placeholder="ingrese su email aquí">                       
                                       
                     <button class="login100-form-btn" id="btn-ingresar">Ingresar</button>
                       
                  </form>

               </div> <!-- /sign-up form -->

            </div><!-- /main-content form -->

            <div class="modal-toggles fondo" style=" padding-bottom: 30px;">
              <a href="https://wa.me/525578882173?text=ASOFARMA GINECOLOGIA" class="whatsapp" target="_blank"><p>Soporte <br>Técnico</p> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
               <ul>
                    <li class="about-us"><a id="" href="#mod-about">Ver Programa</a></li>
                    <li class="location hide"><a id="modal-registro" href="#mod-registro">Registro</a></li>
               </ul>
            </div><!-- /modal-toggles --> 	

            <div style="text-align: center; background: #ffffff;" class="col-md-12"><!-- rgba(255, 255, 255,0.85)-->
              
				
				<img src="img/demus-logo.png" style="width: 150px;  display: inline-block; margin: 20px auto;" class="img-responsive">
            </div>
            
      </main>	      

   </div><!-- /content-wrap --> 
    	

   <!-- modals
   =================================================== -->
	      
	<section id="mod-about" >

	   <!-- Modal toggle -->
	   <div class="modal-toggle">
	      <a href="#" title="close" id="modal-close">Cerrar</a>
	   </div>	        	

	   <div class="row about-header">

			<div class="twelve columns">	

			   <!-- <div class="icon-wrap">
			      <i class="icon"></i>
			   </div> -->

				<h1>PROGRAMA.</h1>			         

			</div>

	   </div> <!-- /about-header -->                   	

		<div class="row about-content">

      <div class="row" style="margin:10px 0;background: none;">
        <div class="col-md-12 columns mob-whole">
          <img src="img/poster_sesion_12junio.jpg" style="width: 100%;" class="img-responsive">
        </div>
      </div>

    </div> <!-- /about-content --> 

   </section><!-- /mod-about -->

   <section id="mod-registro" >

      <!-- Modal toggle -->
      <div class="modal-toggle">
         <a href="#" title="close" id="modal-close"><span>Cerrar</span></a>
      </div>

      <div class="row about-header">

      <div class="twelve columns">  

         <!-- <div class="icon-wrap">
            <i class="icon"></i>
         </div> -->

        <h1>REGISTRO.</h1>               

      </div>

     </div> <!-- /about-header --> 

      <div class="row about-content">

      <form id="form-registro" class="group" autocomplete="nope" action="" method="POST" onsubmit="return false;" accept-charset="utf-8">
         <div class="form-group">
          <div class="col-md-3">
            <label class="col-form-label">Prefijo</label>
            <select id="prefijo" name="prefijo" class="form-control">
              <option value="">(Seleccionar)</option>
              <option value="DR.">DR.</option>
              <option value="DRA.">DRA.</option>
              <option value="SR.">SR.</option>
              <option value="SRA.">SRA.</option>
            </select>
          </div>
          <div class="col-md-9">
            <label class="col-form-label">Nombre(s)</label>
            <input class="form-control" type="text" name="nombre" id="nombre">
          </div>
            
         </div>

         <div class="form-group">
          <div class="col-md-6">
            <label class="col-form-label">Apellido Paterno</label>
            <input class="form-control" type="text" name="apellidop" id="apellidop">
          </div>

          <div class="col-md-6">
            <label class="col-form-label">Apellido Materno</label>
            <input class="form-control" type="text" name="apellidom" id="apellidom">
          </div>
         </div>

         <div class="form-group">
           <div class="col-md-6">
             <label class="col-form-label">Correo</label>
             <input type="email" name="email-registro" id="email-registro" class="form-control">
           </div>
           <div class="col-md-6">
             <label class="col-form-label">Telefono</label>
             <input type="text" name="telefono" id="telefono" class="form-control">
           </div>
         </div>

         <div class="form-group">
          <div class="col-md-6">
            <label class="col-form-label">País</label>
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

          <div class="col-md-6">
            <label class="col-form-label">Estado</label>
            <select id="estado" name="estado" class="form-control">
              <option value="">(Seleccionar)</option>
            </select>
          </div>
         </div>

         <div class="form-group">
          <div class="col-md-12" style="text-align: center;">
            <label class="col-form-label">Deseas recibir información de los próximos WEBINAR</label>
            <div class="radio">
              <label>
                <input type="radio" value="1" id="recibir_correo" name="recibir_correo"> SI
              </label>
              <label>
                <input type="radio" value="0" id="recibir_correo" name="recibir_correo"> NO
              </label>
            </div>
          </div>
         </div>

         <div class="form-group" style="text-align: center;">
          <button class="login100-form-btn" style="margin-top: 20px;" id="btn-registro">Registrarte</button>
         </div>
        </form>

    </div> <!-- /about-content --> 

   </section><!-- /mod-about -->


 	<!-- footer
   =================================================== -->
   <footer class="group">         

     	<ul class="footer-social">
         <li><a href="archivos/Aviso_Privacidad.pdf" style="color: #fff;">AVISO DE PRIVACIDAD</a></li>
     	</ul>   

     	<ul class="footer-copyright">
         <li>&copy; Copyright 2020</li>
         <li>Diseñado por <a title="Styleshout" href="https://grupolahe.com/">Grupo Lahe</a></li>
      </ul>  
        
   </footer> 

   <div id="preloader"> 
    	<div id="loader">
     	</div>
   </div> 

   <div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        Un momento por favor...
      </div>
    </div>
  </div>
</div>

   
<!-- Script
=================================================== -->
<script type="text/javascript">
   $(function() {
      $("#btn-ingresar").click(function(){
         if($("#email").val()!=""){
            if(validarEmail($("#email").val())){
               consultar();                
              }else{
                  alert("Por favor ingresa un correo valido");
                  $("#email").focus();
               }
            }else{
              alert("Por favor ingresa tu correo");
              $("#email").focus();
            }
          });
      });

   function consultar(){
      $('#modal').modal('show');
      $.ajax({
         url: 'ingresar_sesion.php',
         type: 'POST',
         dataType: 'json',
         data: {email: $("#email").val(),referencia: <?php echo base64_decode($_GET['ref']); ?> }
      })
      .done(function(json) {

         if(json.id_registrado!=0){
          $('#modal').modal('hide');
          if (json.activo==0) {
            alert(json.mensaje);
            window.location.href = json.redireccion;
          }else{
            window.location.href = json.redireccion;
            // alert("La Transmisión aun no comienza");
            // window.location.href = "index.php";
          }
            
            
         }else{
            alert(json.mensaje);
            $('#modal-registro').removeClass('hide');

            $("#modal-registro").click();
            $("#email-registro").val($("#email").val());

         }
            
      })

      .fail(function() {
         alert("Ups! ocurrio un error, intente de nuevo");
      })

      .always(function() {
         $('#modal').modal('hide');
      });
   }



   $(function() {
      $("#btn-registro").click(function(){
         if($("#prefijo").val()!="" && $("#nombre").val()!="" && $("#apellidop").val()!="" && $("#apellidom").val()!="" && $("#email-registro").val()!="" && $("#telefono").val()!="" && $("#pais").val()!="" && $("#estado").val()!=""){

            if(validarEmail($("#email-registro").val())){
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
              $("#prefijo").focus();
              $("#nombre").focus();
              $("#apellidop").focus();
              $("#apellidom").focus();
              $("#email-registro").focus();
              $("#telefono").focus();
              $("#pais").focus();
              $("#estado").focus();
            }
          });
      });


   function registrar(){
      $('#modal').modal('show');
      $.ajax({
          url: 'guardar_registrado.php',
          type: 'POST',
          dataType: 'json',
          data: {
            prefijo: $("#prefijo").val(),
            nombre: $("#nombre").val().toUpperCase(),
            apellidop: $("#apellidop").val().toUpperCase(),
            apellidom: $("#apellidom").val().toUpperCase(),
            email: $("#email").val(),
            telefono: $("#telefono").val(),
            pais: $("#pais").val(),
            estado: $("#estado").val(),
            recibir_correo: $('input:radio[name=recibir_correo]:checked').val(),
            referencia: <?php echo base64_decode($_GET['ref']); ?>
          }
      })
      .done(function(json) {

         if(json.id_registrado!=0){
            $('#modal').modal('hide');
            alert(json.mensaje);
            enviarcorreo(json.id_registrado);
            consultar()
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

   function enviarcorreo(id_registrado){
    $.ajax({
          url: 'enviar_correo_registro.php',
          type: 'POST',
          dataType: 'json',
          data: { id_registrado:id_registrado }
      })

    // .fail(function() {
    //      alert("Error al enviar correo");
    //   })
   }

   function actualizaEdos() {
    var pais = $('#pais').val();
    $.ajax({
      url: 'obtener_estados.php',
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
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyAw_zec3g1wzNxvOba8App7ItK81kzJam4"></script>    
 --><script src="js/jquery.fittext.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.placeholder.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/main.js?ts=<?=time()?>&quot;"></script> 
<script src="js/bootstrap.js"></script>   
<script type="text/javascript" src="js/particles.js"></script> 
<script type="text/javascript" src="js/app.js"></script>
        
</body>
</html>
