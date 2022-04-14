<?php 
session_start();
  if(isset($_SESSION['becas']['id']) && $_SESSION['becas']['login']==true){
      header("location:index.php");
      exit;
  }
  include '../../bd/mnpBDsas2.class.php';
  if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $query="SELECT * FROM laboratorios WHERE nombreusuario='".$_POST['usuario']."' and contrasena='".$_POST['password']."' limit 1";
    $resultados=$bd->ExecuteE($query);
    foreach ($resultados as &$resultado) {
      $_SESSION['becas']['id']=$resultado['id_laboratorio'];
      $_SESSION['becas']['nombre']=$resultado['nombrecompletos'];
      $_SESSION['becas']['login']=true;
      header("location:index.php");
      exit;
    }
    $_SESSION["admin"]['error']="Usuario o contraseña incorrecto";
  }
?>
<!doctype html>
<html class="fixed">
  <head>

    <!-- Basic -->
    <meta charset="UTF-8">
    <title>Admin Becas </title>

    

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

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../css/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="../css/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">

    <!-- Head Libs -->
    <script src="../vendor/modernizr/modernizr.js"></script>

  </head>
  <body>
    <!-- start: page -->
    <section class="body-sign">
      <div class="center-sign">
        

        <div class="panel card-sign">
          
          <div class="card-body">
            <form role="form" method="post" data-toggle="validator">
              <div class="form-group mb-3">
                <label>Usuario</label>
                <div class="input-group">
                  <input id="usuario" name="usuario" type="text" class="form-control form-control-lg" />
                  <span class="input-group-append">
                    <span class="input-group-text">
                      <i class="fas fa-user"></i>
                    </span>
                  </span>
                </div>
              </div>

              <div class="form-group mb-3">
                <div class="clearfix">
                  <label class="float-left">Contraseña</label>
                </div>
                <div class="input-group">
                  <input name="password" id="password" type="password" class="form-control form-control-lg" />
                  <span class="input-group-append">
                    <span class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </span>
                  </span>
                </div>
              </div>

              <?
                            if (isset($_SESSION['becas']['error'])) {
                        ?> 
                          
                            <label class="bg-danger" style="color: #fff;"><?=$_SESSION['becas']['error'];?></label><BR>
                          
                        <?
                         unset($_SESSION['becas']['error']);
                         }
                        ?>

              <div class="row">
                
                <div class="col-sm-12 text-right">
                  
                  <button type="submit" class="btn btn-primary mt-2 btn-block">Entrar</button>
                </div>
              </div>

            </form>
          </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">&copy; Grupo LAHE 2020. </p>
      </div>
    </section>
    <!-- end: page -->

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
    
    <!-- Theme Base, Components and Settings -->
    <script src="../js/theme.js"></script>
    
    <!-- Theme Custom -->
    <script src="../js/custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <script src="../js/theme.init.js"></script>

  </body>
</html>