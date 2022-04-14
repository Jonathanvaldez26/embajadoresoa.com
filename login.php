<?php
session_start(); 
include '../../dato_sociedad.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Acceso al <?=utf8_encode($nombre_del_sistema)?></title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">

    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

    <script>
$(document).ready(function(){
  // despues del código
  $('.cargar').click();
});
</script>
  </head>

  <body class="login">
    <?php
      if(isset($_SESSION[mensaje])){
    ?>
    <div class="alert alert-<?=$_SESSION[tipo]?> fade in">
        <button class="close close-sm" type="button" data-dismiss="alert">
                      <i class="fa fa-times"></i>
                    </button>
                    <strong>Mensaje!</strong>
                    <?=$_SESSION[mensaje];?>&#10;
                  </div>
                  <?
                  unset($_SESSION[mensaje]);
                  unset($_SESSION[tipo]);
                }
                ?>
    <div>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="../../images/logo_sociedad.png" class="img-responsive" style="margin: 10px auto;" >
            <p>Bienvenido al Sistema en Línea para el registro de médicos becados de la <br><strong>XLIV Reunión Anual de la Academia Mexicana de Neurología</strong>, del 2 al 7 de noviembre del 2020.<br><br>Para accesar al Sistema es necesario contar con un nombre de usuario y contraseña,si tiene algún problema no dude en enviarnos un correo a <a href="mailto:marco.gonzalez@grupolahe.com?Subject=Problemas%20al%20accesar%20al%20sistema%20de%20becas%20Neurología%202020" target="_top">marco.gonzalez@grupolahe.com</a></p>
            <form autocomplete="off" action="" method="POST" onsubmit="return false;" accept-charset="utf-8" >
              <h1>Acceso al sistema</h1>
              <div>
                <input type="text" class="form-control usuario" id="usuario" name="usuario" placeholder="Usuario" />
              </div>
              <div>
                <input type="password" class="form-control password" id="password" name="password" placeholder="Contraseña" />
              </div>

              <!-- CAMBIAR CONTRASEÑA -->

              <div>
                <input type="text" class="form-control usuario-cambio hide" id="usuario-cambio" name="usuario-cambio" placeholder="Usuario" />
              </div>
              <div>
                <input type="password" class="form-control password-cambio hide" id="password-cambio" name="password-cambio" placeholder="Contraseña" />
              </div>


              <div>
                <a class="btn btn-default submit" id="btn-login">Ingresar</a>
                <a class="btn btn-default hide" id="bnt-cambiopassword">Actualizar Contraseña</a>
                <input type="hidden" name="id_laboratorio" id="id_laboratorio" value="0">

              </div>

              <div class="clearfix"></div>

              <div class="separator">
    
                <div class="clearfix"></div>
                <br />

                <div style="text-align: center;">
                  <h5>Powered by</h5>
                  <img src="https://grupolahe.com/images/lahe/logo-ok.png" style="margin: 0 auto; width: 200px;">
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(function() {
        $("#btn-login").click(function(){
          if($("#usuario").val()!="" && $("#password").val()!=""){
            consultar();                
            }else{
              alert("Por favor ingresa tu usuario y contraseña");
              $("#usuario").focus();
              $("#password").focus();
            }
          });
      });

      function consultar(){
        $('#modal').modal('show');
        $.ajax({
          url: 'iniciar-sesion.php',
          type: 'POST',
          dataType: 'json',
          data: {usuario: $("#usuario").val(), password: $("#password").val()},
        })
        .done(function(json) {

        	if(json.id_laboratorio!=0){
            	if(json.redireccion==1){
            		$('#modal').modal('hide');
              		alert(json.mensaje);
				   	$("#usuario-cambio").val(json.nombreusuario);
				   	$("#id_laboratorio").val(json.id_laboratorio);
				   	$("#usuario-cambio").attr("disabled",true);

      				$("#usuario").remove();
      				$("#password").remove();
      				$("#btn-login").remove();

      				$('.usuario-cambio').removeClass('hide');
      				$('.password-cambio').removeClass('hide');
      				$('#bnt-cambiopassword').removeClass('hide');

            	}
            	$('#modal').modal('hide');
       			window.location.href = json.redireccion;

            }else{
            	$('#modal').modal('hide');
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

      	$(function() {
        	$("#bnt-cambiopassword").click(function(){
         		if($("#usuario-cambio").val()!="" && $("#password-cambio").val()!=""){
         			var id_laboratorio 
         			id_laboratorio = document.getElementById('id_laboratorio').value;
           			cambiarpassword(id_laboratorio);                
           		}else{
            		alert("Por favor ingresa tu usuario y contraseña");
	        		$("#password-cambio").focus();
     			}
     		});
      	});

      function cambiarpassword(id_laboratorio){

      	$.ajax({
          url: 'cambiar-password.php',
          type: 'POST',
          dataType: 'json',
          data: {id_laboratorio: id_laboratorio, password_cambio: $("#password-cambio").val()},
        })

        .done(function(json) {
      		if(json.success){
      			$('#modal').modal('hide');
            	alert(json.mensaje);
       			window.location.href = json.redireccion;
      		}else{
        		alert("Error al actualizar su contraseña intente de nuevo, si el error sigue mandar un correo a marco.gonzalez@grupolahe.com");
      		}

    	})
    	
    	.fail(function() {
      		alert("Ups! ocurrio un error, intente de nuevo");
    	})
    	
    	.always(function() {
      		$('#modal').modal('hide');
   		});



      }
    </script>

    <div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            Un momento por favor...
          </div>
        </div>
      </div>
    </div>
    
    <script src="js/jquery.min.js"></script>


    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
