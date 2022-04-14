<?php 
session_start();
date_default_timezone_set ( "America/Mexico_City");
include 'bd/mnpBDsas.class.php';

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en" style="background-color: #ededed;"> <!--<![endif]-->

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
      <h1 style="text-align: center; color:#010920;">PREGUNTAS PARA EL PONENTE</h1>
      <?php if ($_GET['borrar']==1) { ?>
       <a href="preguntas_ponente.php?ref=<?php echo $_GET['ref']; ?>&borrar=1" class="btm btn-warning" style="padding: 15px; color: #fff;" >Click aqui para ver las preguntas nuevas.</a>
      <?php }else{  ?>
      <a href="preguntas_ponente.php?ref=<?php echo $_GET['ref']; ?>" class="btm btn-warning" style="padding: 15px; color: #fff;" >Click aqui para ver las preguntas nuevas.</a>
      <?php } ?>
      <div style="margin-bottom:15px;">
        <table id="example" class="table" style="width:100%">
          <thead>
            <tr>
                <th>#</th>
                <th>Pregunta</th>
                <th>Nombre</th>
                <th>Pais</th>
                <th>estado</th>
                <th>Fecha</th>
                <?php if ($_GET['borrar']==1){ ?>
                <th>Acciones</th>
                <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php

            $query="SELECT * FROM preguntas p INNER JOIN registrados r ON p.id_registrado=r.id_registrado INNER JOIN paises pa ON r.id_pais=pa.id_pais INNER JOIN estados e ON r.id_estado = e.id_estado WHERE p.id_sesion = ".base64_decode($_GET['ref'])." ORDER BY p.fecha DESC ";
            $registrados=$bd->ExecuteE($query);
            $i=1;
            foreach ($registrados as $registrado){

            ?>
            
              <tr id="<?php echo $registrado['id_pregunta']; ?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $registrado['pregunta']; ?></td>
                <td><?php echo $registrado['nombre']." ".$registrado['apellidop']." ".$registrado['apellidom']; ?></td>
                <td><?php echo $registrado['pais']; ?></td>
                <td><?php echo $registrado['estado']; ?></td>
                <td><?php echo $registrado['fecha']; ?></td>
                <?php if ($_GET['borrar']==1){ ?>
                <td><button onclick="confirmarborrar(<?php echo $registrado['id_pregunta']; ?>,0)" class="btn btn-danger" >Borrar</button></td>
                º<?php } ?>

              </tr>
            <?php $i++; } ?>
          </tbody>
        </table>
      </div>

      <?php if($_GET['borrar']==1){ ?>
        <div style="margin-bottom:15px;">
          <h1 style="text-align: center; color:#010920;">COMENTARIOS CHAT</h1>
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
                <td><button onclick="confirmarborrar(<?php echo $registrado['id_pregunta']; ?>,1)" class="btn btn-danger" >Borrar</button></td>

              </tr>
            <?php $i++; } ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
      <?php 
      $sql="SELECT *FROM sesionesasistentes as sa INNER JOIN registrados as s on s.id_registrado=sa.id_registrado WHERE sa.id_sesion=".base64_decode($_GET['ref'])." group by s.id_registrado order by id_pais, id_estado";
      $total_asistentes=$bd->RecordCount("sesionesasistentes","id_sesion = ".base64_decode($_GET['ref']));
      $asistentes=$bd->ExecuteE($sql);

    $paisesdif = array();
    $paisestot = array();
    $ciudadesdif = array();
    $ciudadestot = array();
   foreach ($asistentes as &$asistente) {
    //---------------------------------------------------
          if (!in_array($asistente[id_pais],$paisesdif)) {
            array_push($paisesdif, $asistente[id_pais]);
            }
            array_push($paisestot, $asistente[id_pais]);
    //---------------------------------------------------
          if (!in_array($asistente[id_estado],$ciudadesdif)) {
            array_push($ciudadesdif, $asistente[id_estado]);
            }
            array_push($ciudadestot, $asistente[id_estado]);
    //---------------------------------------------------
    }
      ?>

      <h1 style="text-align: center; color:#010920;">ESTADISTICAS<br><small>Total de asistentes:<?php echo $total_asistentes; ?></small></h1>
      <h1 style="text-align: center; color:#010920;">Total por país<br></h1>
      <div style="margin-bottom:15px;">
        <table class="table table-hover">
          <thead><th>Pais</th><th>Visitantes</th><th>Porcentaje %</th></thead>
            <?php 
              $paisesdif2=$paisesdif;
              $mayorp=0;
              foreach ($paisesdif as $pais) {
                $sqlp="SELECT pais FROM paises WHERE id_pais=".$pais;
                $nombrepais=$bd->ExecuteE($sqlp);
                foreach ($nombrepais as $pa) {
                  # code...
                }
                $buscar = (array_keys($paisestot, $pais));
            ?>
            <tr>
              <td>
                <?php echo $pa[pais]?>
              </td>
              <td>
                <?php echo count($buscar)?>
              </td>
              <td>
                <?php echo round($porcentaje=(count($buscar)*100)/$total_asistentes,2)?>%
                <?php 
                  if($porcentaje>=$mayorp){
                    $mayorp=$porcentaje;
                    $idmayor=$pais;
                  }
                ?>
              </td>
            </tr>
          <?php 
                }
            //---------------------------------------------------
          ?>
    </table>
      </div>


      <h1 style="text-align: center; color:#010920;">Total por estado<br></h1>
      <div style="margin-bottom:15px;">
        <table class="table table-hover">
        <thead><th>Ciudad</th><th>Visitantes</th><th>Porcentaje %</th></thead>
    <?php 
     $ciudadesdif2=$ciudadesdif;
     $mayorc=0;
    foreach ($ciudadesdif as $ciudad) {
        $sqlc="SELECT estado FROM estados WHERE id_estado=".$ciudad;
        $nombreciudad=$bd->ExecuteE($sqlc);
        foreach ($nombreciudad as $ci) {
                  # code...
                }
        $buscar = (array_keys($ciudadestot, $ciudad));
                  ?>
          <tr>
            <td>
              <?php echo $ci[estado]?>
            </td>
            <td>
              <?php echo count($buscar)?>
            </td>
            <td>
              <?php echo round($porcentajec=(count($buscar)*100)/$total_asistentes,2) ?>%
              <?php 
                if($porcentajec>=$mayorc){
                  $mayorc=$porcentajec;
                  $idmayorc=$ciudad;
                }
              ?>
            </td>
          </tr>
          <?php 
    }
  ?>
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

  function confirmarborrar(id_pregunta,chat){
    var r = confirm("Estas seguro de borrar la pregunta?");
      if (r == true) {
        borrarpregunta(id_pregunta,chat);
        } else {
         
        }
      }


   function borrarpregunta(id_pregunta,chat){
      $.ajax({
         url: 'borrar_pregunta.php',
         type: 'POST',
         dataType: 'json',
         data: {id_pregunta: id_pregunta,chat:chat}
      })
      .done(function(json) {

         if(json.exito==1){
          window.location.href = "preguntas_ponente.php?ref=<?php echo $_GET['ref']; ?>&borrar=1";
         }
            
      })

      .fail(function() {
         alert("Ups! ocurrio un error, intente de nuevo");
      })

   }
</script>

        
</body>
</html>
