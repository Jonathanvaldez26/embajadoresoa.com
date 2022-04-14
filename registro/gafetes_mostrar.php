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

    <title>GAFETES</title>

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
        <?php include('main-menu.php') ?>
        <!-- end: sidebar -->

        <section role="main" class="content-body pb-0">
          <header class="page-header">
            <h2>GAFETES IMPRESOS</h2>
          
          </header>

          <!-- start: page 
          <section class="call-to-action call-to-action-primary call-to-action-top mb-4">
            <div class="container container-with-sidebar">
              
            </div>
          </section>-->

          <!-- REGISTRADOS -->

          <div class="row">
              <div class="col">
                <section class="card">
                  
                  <div class="card-body row">
                    <?php 
                    

                      $sql_categorias="SELECT categoria FROM gafetes GROUP BY categoria";
                      $categorias=$bd->ExecuteE($sql_categorias);
                      foreach($categorias as $categoria){
                        $querygafetes = "select COUNT(*) as total FROM gafetes WHERE categoria = '".$categoria['categoria']."'";
                        $gafetes  = $bd->ExecuteE($querygafetes);
                    ?>
                      <div class="col-xl-4">
                        <section class="card card-featured-left card-featured-quaternary">
                          <div class="card-body">
                            <div class="widget-summary">
                              <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-quaternary">
                                  <i class="fas fa-user"></i>
                                </div>
                              </div>
                              <div class="widget-summary-col">
                                <div class="summary">
                                  <h4 class="title">Total de <?=$categoria['categoria']?></h4>
                                  <div class="info">
                                    <strong class="amount"><?=$gafetes[0]['total']?></strong>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                    <?php } ?>
                    
                    <div class="col-xl-12">
                      <table class="table table-bordered mb-0" id="datatable-tabletools">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CATEGORIA</th>
                            <th>FECHA IMPRESIÓN</th>
                            <!-- <th>ACCIONES</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql_gafetes="SELECT * FROM gafetes GROUP BY nombrecompleto";
                          $gafetes  = $bd->ExecuteE($sql_gafetes);
                          $i=1;
                          foreach ($gafetes as &$gafete) {
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $gafete['nombrecompleto']." ".$gafete['apellidop']." ".$gafete['apellidom']; ?></td>
                            <td><?php echo $gafete['categoria']; ?></td>
                            <td><?php echo $gafete['fecha_impresion']; ?></td>
                            <!-- <td><?php if ($gafete['categoria']=="ASISTENTE") { echo '<a class="btn btn-success" href="imprimir_constancia.php?gafete='.$gafete['id'].'" target="_blank">IMPRIMIR CONSTANCIA</a>'; } ?></td> -->
                                                  
                          </tr> 
                          <?php $i++; } ?>                        
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          
            
            <!-- AREA COMERCIAL -->
            <!--  -->
            
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