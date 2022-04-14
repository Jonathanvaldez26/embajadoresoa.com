<?php 
session_start();
date_default_timezone_set ( "America/Mexico_City");
include 'bd/mnpBDsas.class.php';

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
   <!-- <META HTTP-EQUIV="REFRESH" CONTENT="60"> -->

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
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/datatables.min.js"></script>
    
</head>
    
<body>
  <div id="particles-js"></div>



  <div id="content-wrap" >
    
    <main class="row" style="width:90%; margin:0 auto; background-color: #fff; padding: 25px; max-width: 1200px;" >
      <h1 style="text-align: center; color:#010920;">COMENTARIOS DEL CHAT</h1>
      <a href="borrarchat.php?ref=<?php echo $_GET['ref']; ?>" class="btm btn-warning" style="padding: 15px; color: #fff;" >Click aqui para ver las preguntas nuevas.</a>
      <div style="margin-bottom:15px;">
        <table id="example" class="table" style="width:100%">
          <thead>
            <tr>
                <th>#</th>
                <th>Pregunta</th>
                <th>Nombre</th>
                <th>Fecha</th>
                
                <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $query="SELECT * FROM chat p INNER JOIN registrados r ON p.id_registrado=r.id_registrado INNER JOIN paises pa ON r.id_pais=pa.id_pais INNER JOIN estados e ON r.id_estado = e.id_estado WHERE p.id_sesion = ".base64_decode($_GET['ref'])." ORDER BY p.fecha DESC ";
            $registrados=$bd->ExecuteE($query);
            $i=1;
            foreach ($registrados as $registrado){

            ?>
            
              <tr id="<?php echo $registrado['id_pregunta']; ?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $registrado['pregunta']; ?></td>
                <td><?php echo $registrado['nombre']." ".$registrado['apellidop']." ".$registrado['apellidom']; ?></td>
                
                <td><?php echo $registrado['fecha']; ?></td>
                <td><button onclick="confirmarborrar(<?php echo $registrado['id_pregunta']; ?>)" class="btn btn-danger" >Borrar</button></td>

              </tr>
            <?php $i++; } ?>
          </tbody>
        </table>
      </div>
      

    </main>

   <!--[if lt IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. 
    Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
   <![endif]-->   


</script>
<!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyAw_zec3g1wzNxvOba8App7ItK81kzJam4"></script>    
 -->
 
<script type="text/javascript" src="js/particles.js"></script> 
<script type="text/javascript" src="js/app.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
      "pageLength": 50,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    } );



    $('#paises').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    } );
} );

  function confirmarborrar(id_pregunta){
    var r = confirm("Estas seguro de borrar la pregunta?");
      if (r == true) {
        borrarpregunta(id_pregunta);
        } else {
         
        }
      }


   function borrarpregunta(id_pregunta){
      $.ajax({
         url: 'borrar_pregunta.php',
         type: 'POST',
         dataType: 'json',
         data: {id_pregunta: id_pregunta, chat:1}
      })
      .done(function(json) {

         if(json.exito==1){
          window.location.href = "borrarchat.php?ref=<?php echo $_GET['ref']; ?>";
         }
            
      })

      .fail(function() {
         alert("Ups! ocurrio un error, intente de nuevo");
      })

   }
</script>

        
</body>
</html>
