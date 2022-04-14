<?php 
session_start();
date_default_timezone_set ( "America/Mexico_City");
include 'bd/mnpBDsas.class.php';
include 'mailing.php';
$consulta="SELECT * FROM registrados r INNER JOIN paises p ON r.id_pais=p.id_pais INNER JOIN estados e ON r.id_estado = e.id_estado WHERE r.id_registrado=".$_POST['id_registrado'];
// $consulta="SELECT * FROM registrados r INNER JOIN paises p ON r.id_pais=p.id_pais INNER JOIN estados e ON r.id_estado = e.id_estado WHERE r.id_registrado=1";
$rescon=$bd->ExecuteE($consulta);
foreach($rescon as &$registrado){}

$html='
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Sistema de Transmisión en vivo</title>
    <style>
    @media only screen and (max-width: 620px) {
    table[class=body] h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
    }
    table[class=body] p,
    table[class=body] ul,
    table[class=body] ol,
    table[class=body] td,
    table[class=body] span,
    table[class=body] a {
    font-size: 16px !important;
    }
    table[class=body] .wrapper,
    table[class=body] .article {
    padding: 10px !important;
    }
    table[class=body] .content {
    padding: 0 !important;
    }
    table[class=body] .container {
    padding: 0 !important;
    width: 100% !important;
    }
    table[class=body] .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
    }
    table[class=body] .btn table {
    width: 100% !important;
    }
    table[class=body] .btn a {
    width: 100% !important;
    }
    table[class=body] .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
    }
    }
    .image-fluid{
    height:auto !important;
    max-width:600px !important;
    width: 400px !important;
    }
    /* -------------------------------------
    PRESERVE THESE STYLES IN THE HEAD
    ------------------------------------- */
    @media all {
    .externalClass {
    width: 100%;
    }
    .externalClass,
    .externalClass p,
    .externalClass span,
    .externalClass font,
    .externalClass td,
    .externalClass div {
    line-height: 100%;
    }
    .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
    }
    #MessageViewBody a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
    }
    .btn-primary a:hover {
    background-color: #34495e !important;
    border-color: #34495e !important;
    }
    }
    </style>
  </head>
  <body class="" style="; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">¡Registro exitoso!</span>
    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #fff;">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: rgb(2,3,31); border-radius: 3px;">
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">                    
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                        <p style="text-align: center;"><img width="200" src="https://embajadoresoa.com/img/logo_embajadores_.png"></p>
                        <h3 style="font-family: sans-serif;margin: 0;margin-bottom: 15px;text-align: center;color: #fff;font-weight: 600;font-size: 18px;">Estimado(a) '.$registrado['nombre'].' '.$registrado['apellidop'].' '.$registrado['apellidom'].'.</h3>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color: #fff;">Gracias por registrarte a <strong>Embajadores OA </strong>, que se llevará acabo el Viernes, 03 de diciembre del 2021.</p>                    

                        
                        </td>
                    </tr>                    
                  </table>
                </td>
              </tr>
             
            </table>
            
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"></td>
      </tr>
    </table>
    
  </body>
</html>';




$mailin = new Mailin('masivos@grupolahe.com', 'KAIU4Sb1CfDyFMcm');
    $mailin->
    addTo($registrado['email'], $registrado['nombreconstancia'])->
    setFrom('masivos@grupolahe.com', 'Asofarma')->
    // setReplyTo('no-reply@seminariointernacional.com.mx','14 SIEI')->
    setSubject('Registro exitoso a Embajadores OA')->
    
    setHtml($html);
    
    $res = $mailin->send();