<?php 
session_start();
date_default_timezone_set ( "America/Mexico_City");
include 'bd/mnpBDsas.class.php';


$sql = "SELECT * FROM sesiones WHERE id_sesion = '".base64_decode($_GET['ref'])."'";
$sesiones = $bd->ExecuteE($sql);
foreach($sesiones as $sesion){
  $stream = $sesion;
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
                <img src="img/ammom-blanco.png" style="margin: 0 auto; padding: 20px 0;" class="img-responsive">
              </div> 
              <div class="logo col-xs-6">
                <img src="img/logo-aval.png" style="margin: 0 auto; padding: 20px 0;" class="img-responsive">
              </div> 

            <div id="main-content" class="twelve columns" style="background: #020a1fc2">

               <h1 style="font-size: 30px !important ;">COVID-19. Las distintas caras de la pandemia<br>¿Qué estamos aprendiendo en el mundo en el año 2020?</h1>

               <hr>

               <!-- Ingresar a la sesión -->
               <div id="mc-signup">

                <h3 style="color: #fff; text-transform: uppercase;">Ingresa tu correo para descargar tu constancia</h3>

                  <form id="form-ingresar" class="group" autocomplete="nope" action="" method="POST" onsubmit="return false;" accept-charset="utf-8">
                          
                     <input type="email" value="" name="email" class="email" id="email" required>                       
                                       
                     <button class="login100-form-btn" id="btn-ingresar">Buscar</button>
                       
                  </form>

               </div> <!-- /sign-up form -->

            </div><!-- /main-content form -->

            
            
      </main>	      

   </div><!-- /content-wrap --> 
    	

   <!-- modals
   =================================================== -->
	
 	<!-- footer
   =================================================== -->
   <footer class="group">         

     	<ul class="footer-social">
         <li><a href="" style="color: #fff;">AVISO DE PRIVACIDAD</a></li>
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
         url: 'buscar_constancia.php',
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
            alert(json.mensaje);
            window.location.href = json.redireccion;
          }
            
            
         }else{
            alert(json.mensaje);
         }
            
      })

      .fail(function() {
         alert("Ups! ocurrio un error, intente de nuevo");
      })

      .always(function() {
         $('#modal').modal('hide');
      });
   }

function validarEmail(email) {
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      return re.test(email);
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
