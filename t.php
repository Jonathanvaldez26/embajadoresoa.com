<?php 
session_start();
date_default_timezone_set ( "America/Mexico_City");
include '../bd/mnpBDsas.class.php';
if (isset($_SESSION['registrado']['login']) && $_SESSION['registrado']['login']=true) {
 
}else{
  header("location:index.php");
  exit();
}
if (!isset($_GET['ref']) OR $_GET['ref']=="" ) {
  session_destroy();
 ?>
  <script type="text/javascript">
    alert("Ocurrio un error con la referencia de la sesión, ingrese nuevamente.");
    window.location.href = "index.php";
  </script>
<?php }

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->

<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-164258261-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-164258261-6');
</script>


  <!--- Basic Page Needs
   ================================================== -->
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta charset="utf-8">
  <title>Transmisión en vivo</title>
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
    
<body onload="setTimeout('actualizarHora();', 1000);">
  <!-- <body onload="setTimeout('actualizarHora();', 100000);"> -->
  <div id="particles-js"></div>

  <div id="content-wrap">

    <!-- main  -->

    <main class="row" style="max-width: 100%;">
      <h1 style="font-size: 30px !important ;">COVID-19. Las distintas caras de la pandemia<br>¿Qué estamos aprendiendo en el mundo en el año 2020?</h1>
      <div class="col-md-8" style="margin: 15px 0;">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/413800695"></iframe>
        </div>
        <div class="info">
          <p></p>
        </div>
      </div>
      <div class="col-md-4" style="margin: 15px 0;">
        <!-- <iframe class="embed-responsive-item" src="https://vimeo.com/live-chat/395613012/" style="width: 100%;" height="550" frameborder="0"></iframe> -->
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Escribe una pregunta al ponente</h3>
          </div>
          <div class="panel-body" id="mc-signup">
            <form id="form-pregunta" class="group" autocomplete="nope" action="" method="POST" onsubmit="return false;" accept-charset="utf-8">
              <input type="text" name="pregunta" id="pregunta" style="background: #d9edf7; width: 100%;">
              <input type="hidden" name="registrado" id="registrado" value="<?php echo $_SESSION['registrado']['id_registrado']; ?>">
              <button class="login100-form-btn" style="background:#d9edf7;" id="btn-enviar">Enviar</button>
            </form>
          </div> 
        </div>

        <div class="panel panel-primary">
  <div class="panel-heading">

    <a data-toggle="collapse" style="color:#fff" data-parent="#accordion" href="#collapseOne">
       Chat Grupal
    </a> 

                                </div>

        <div id="chat" class="panel-body panel-collapse collapse in" style="max-height:400px; overflow: scroll;">

                                  <ul class="chat">
                                    <!--------------Buscar todas las preguntas que existan-->
                                    <?php 
                                    
                                      $consultapreguntas="SELECT id_sesion, c.id_registrado, pregunta, fecha, nombreconstancia FROM chat as c INNER JOIN registrados as r ON c.id_registrado = r.id_registrado WHERE id_sesion = ".base64_decode($_GET['ref'])." ORDER BY fecha DESC";
                                      $preguntas=$bd->ExecuteE($consultapreguntas);
                                      ?>
                                      <?php if($preguntas!=null):?>
                                        <?php foreach ($preguntas as $pregunta):?>
                                          <!--Aqui las preguntas-->
                                          <?php 
                                          $fecha = $pregunta['fecha'];
                                          $nuevafecha = strtotime ( '-0 hour' , strtotime ( $fecha ) ) ;
                                          $pregunta["fecha_hora"] = date ( 'Y-m-d H:i:s' , $nuevafecha );
                                          ?>
                                          <?php  if($pregunta["id_registrado"]==$_SESSION['registrado']['id_registrado']){ ?>
                                          <li class="right clearfix"><span class="chat-img pull-right">
                                            <img src="https://placehold.it/50/55C1E7/fff&amp;text=Yo" alt="User Avatar" class="img-circle">
                                          </span>
                                          <div class="chat-body clearfix">
                                            <div class="header">
                                              <small class=" text-muted">
                                                <span class="glyphicon glyphicon-time"></span><?php echo $pregunta['fecha_hora']; ?>
                                              </small>
                                              <strong class="pull-right primary-font"><?php echo $pregunta["nombreconstancia"]; ?>
                                              </strong>
                                            </div>
                                            <p style="color: black;">
                                             <?php echo $pregunta["pregunta"]; ?>
                                           </p>
                                         </div>
                                       </li>
                                       <?php  }else{ ?>
                                       <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                          <img src="https://placehold.it/50/55C1E7/fff&amp;text=X" alt="User Avatar" class="img-circle">
                                        </span>
                                        <div class="chat-body clearfix">
                                          <div class="header">
                                            <strong class="primary-font">
                                              <?php echo $pregunta["nombreconstancia"]; ?>
                                            </strong> 
                                            <small class="pull-right text-muted">
                                              <span class="glyphicon glyphicon-time"></span><?php echo $pregunta['fecha']; ?>
                                            </small>
                                          </div>
                                          <p style="color: black;">
                                            <?php echo $pregunta["pregunta"]; ?>
                                          </p>
                                        </div>
                                      </li> 
                                      <?php  } ?>                                                 
                                      <!--Fin de preguntas-->
                                    <?php endforeach; ?>
                                  <?php else: ?>
                                    No hay Preguntas
                                  <?php endif; ?>
    
                                <!--fin del listado e preguntas-->                                    
                              </ul>
                                  
                            </div>
                            <div class="panel-footer">
                              <div class="input-group">
                                <input id="preguntachat" name="preguntachat" class="form-control input-sm" placeholder="Escribe tu pregunta aqui" type="text">
                                <span class="input-group-btn">
                                  <button class="btn btn-warning btn-sm <?php if($curso->enlinea==1){echo 'disabled';}?>" id="btn-chat" onclick="preguntar();">
                                    Enviar</button>
                                  </span>
                                </div>
                              </div>
                            </div>


                          </div>

      </div>
    </main>

  </div>



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
      $("#btn-enviar").click(function(){
         if($("#pregunta").val()!=""){
            enviar()
            }else{
              alert("Necesita escribir algo.");
              $("#pregunta").focus();
            }
          });
      });

   function enviar(){
      $.ajax({
         url: 'enviar_pregunta.php',
         type: 'POST',
         dataType: 'json',
         data: {pregunta: $("#pregunta").val(),registrado: <?php echo $_SESSION['registrado']['id_registrado']; ?> ,referencia: <?php echo base64_decode($_GET['ref']); ?> }
      })
      .done(function(json) {
        alert(json.mensaje);
          $('input[type="text"]').val('');
            
      })

      .fail(function() {
         alert("Error al enviar su pregunta");
      })

   }

</script>
<script>
  function actualizarHora(){

        $.ajax({

          url: 'actualizarHora2.php',

          type: 'POST',

          dataType: 'json',

          data: {id_socio: <?php echo $_SESSION['registrado']['id_registrado']?>, sesion: '<?php echo base64_decode($_GET['ref'])?>'},

        })

        .done(function() {

          setTimeout("actualizarHora();", 30000);

        })

        .fail(function() {

          alert("Ocurrio un error de conexion, refresca el navegador para seguir conectado");

        });



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
<script src="js/main.js"></script> 
<script src="js/bootstrap.js"></script>   
<script type="text/javascript" src="js/particles.js"></script> 
<script type="text/javascript" src="js/app.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e98795e35bcbb0c9ab1d0c3/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script type="text/javascript">
      function preguntar () {
        $( "#btn-chat" ).addClass( "disabled" );
        $("#btn-chat").html('Enviando...'); 
        var pregunta=document.getElementById('preguntachat').value;
        if(pregunta!=""){
          $.ajax({
            url : 'messenger.php',
            data : { pregunta:pregunta,ref:<?php echo base64_decode($_GET["ref"]); ?>},
            type : 'GET',
            dataType : 'json',
            success : function(json) {
              if(json.success){
                document.getElementById('preguntachat').value="";
                $( "#btn-chat" ).removeClass( "disabled" );
                $("#btn-chat").html("Enviar"); 
              }else{
                alert("Ocurrio un error");
              }
            },
            error : function(jqXHR, status, error) {
             alert('Disculpe, ha ocurrido un problema');
           },
           complete : function(jqXHR, status) {

           }
         }); 
        }
      }
      $(document).ready(function() {

      var refreshId =  setInterval( function(){

   $('#chat').load('preguntaschat.php?ref=<?php echo base64_decode($_GET['ref']) ?>');//actualizas el div

    }, 100000000 );

});
      
    </script>

        
</body>
</html>
